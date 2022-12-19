import * as cdk from 'aws-cdk-lib';
import * as ec2 from 'aws-cdk-lib/aws-ec2';
import * as autoscaling from 'aws-cdk-lib/aws-autoscaling';
import * as elbv2 from 'aws-cdk-lib/aws-elasticloadbalancingv2';

export class LoadBalancedAppStack extends cdk.Stack {
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

    const asg = new autoscaling.AutoScalingGroup(this, '02-server-availability-revised_implementation', {
      vpc,
      instanceType: ec2.InstanceType.of(
        ec2.InstanceClass.BURSTABLE2,
        ec2.InstanceSize.MICRO
      ),
      machineImage: new ec2.AmazonLinuxImage({
        generation: ec2.AmazonLinuxGeneration.AMAZON_LINUX_2
      }),
      userData: userData,
      minCapacity: 2,
      maxCapacity: 3
    });

    listener.addTargets('target_group_for_alb', {
      port: 80,
      targets: [asg],
      healthCheck: {
        path: '/',
        unhealthyThresholdCount: 2,
        healthyThresholdCount: 5,
        interval: cdk.Duration.seconds(30),
      },
    });

    asg.scaleOnRequestCount('requests-per-minute', {
      targetRequestsPerMinute: 60,
    });


    asg.scaleOnCpuUtilization('cpu-util-scaling', {
      targetUtilizationPercent: 75,
    });


    new cdk.CfnOutput(this, 'DNS_for_alb', {
      value: alb.loadBalancerDnsName,
    });

  }
}

const app = new cdk.App();
new LoadBalancedAppStack(app, 'alb-asg-app-stack', {
  tags: {
    "Name": "02-server-availability-revised_implementation",
    "Project": "pilot",
    "Branch": "02-sever-availability",
    "Implementation": "revised"
  }
})
