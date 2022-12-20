import * as cdk from 'aws-cdk-lib';
import * as ec2 from 'aws-cdk-lib/aws-ec2';
import * as autoscaling from 'aws-cdk-lib/aws-autoscaling';
import * as elbv2 from 'aws-cdk-lib/aws-elasticloadbalancingv2';

export class CdkDeploymentStack extends cdk.Stack {
  constructor(scope: cdk.App, id: string, props?: cdk.StackProps) {
    super(scope, id, props);

    /**
     * We created a VPC with a single NAT Gateway. 
     * By default, the VPC construct creates a PUBLIC and a PRIVATE 
     * subnet groups with subnets in 3 availability zones.
     */
    const vpc = new ec2.Vpc(this, 'vpc_for_server_avaiability', { natGateways: 1 });

    /**
     * Our Application Load Balancer will be provisioned in PUBLIC subnets, 
     * whereas our EC2 instances will be provisioned in PRIVATE subnets.
     * By setting the internetFacing prop to true, we allocate a public IPv4 address to
     * our load balancer.
     */
    const alb = new elbv2.ApplicationLoadBalancer(this, 'alb_for_server_avaiability', {
      vpc,
      internetFacing: true
    });

    /**
     * A listener to our ALB.
     * port: 
     *    Now that we are set the port to 80, CDK will automatically add 
     *    a rule to the ALB's security group to open inbound traffic on 
     *    port 80 from the world.
     * open:
     *    Whether everyone on the internet should be able to reach our application load balancer. 
     *    The default value is true.
     */
    const listener = alb.addListener('listener_for_http', {
      port: 80,
      open: true
    });

    /**
     * Selecting our Instance Type / Hardware of the EC2 instance
     */
    const instanceType = ec2.InstanceType.of(
      ec2.InstanceClass.BURSTABLE2,
      ec2.InstanceSize.MICRO
    );

    /**
     * Selecting the AMI / machine image for the EC2 instance
     */
    const machineImage = new ec2.AmazonLinuxImage({
      generation: ec2.AmazonLinuxGeneration.AMAZON_LINUX_2
    })

    /**
     * Crafting the user-data for the EC2 instance
     */
    const userData = ec2.UserData.forLinux();
    userData.addCommands(
      'yum update -y',
      'yum install httpd git -y',
      'amazon-linux-extras install -y php7.2 -y',
      'cd ~',
      'git clone https://github.com/iwouldrathercode/pilot.git',
      'cd pilot',
      'git checkout 02-server-availability',
      'cp revised_implementation/application/index.php /var/www/html/index.php',
      'systemctl start httpd',
      'systemctl enable httpd',
      'usermod -a -G apache ec2-user',
      'chown -R ec2-user:apache /var/www',
      'chmod 2775 /var/www && find /var/www -type d -exec sudo chmod 2775 {} \;',
      'find /var/www -type f -exec sudo chmod 0664 {} \;',
      'systemctl start httpd',
      'systemctl enable httpd',
    );

    /**
     * Autoscaling group with the 
     * Newly created VPC
     * InstanceType, AMI & user-date for EC2
     * Min and Max capacity ranges for EC2
     */
    const asg = new autoscaling.AutoScalingGroup(this, 'asg_revised_implementation', {
      vpc,
      instanceType,
      machineImage,
      userData,
      minCapacity: 2,
      maxCapacity: 3
    });

    /**
     * Target group for ALB assgining to the EC2 of ASG
     */
    listener.addTargets('target-group-for-alb', {
      port: 80,
      targets: [asg],
      healthCheck: {
        path: '/',
        unhealthyThresholdCount: 2,
        healthyThresholdCount: 5,
        interval: cdk.Duration.seconds(30),
      },
    });

    /**
     * Scaling policy to scale based on no. of requests per min.
     */
    asg.scaleOnRequestCount('requests-per-minute', {
      targetRequestsPerMinute: 60,
    });

    /**
     * Scaling policy to scale only if CPU Utilization
     * is over and above 75%
     */
    asg.scaleOnCpuUtilization('cpu-util-scaling', {
      targetUtilizationPercent: 75,
    });

    /**
     * Output the DNS for ALB after CDK creates stack
     */
    new cdk.CfnOutput(this, 'dns-for-alb', {
      value: alb.loadBalancerDnsName,
    });

  }
}