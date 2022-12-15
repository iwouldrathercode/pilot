# Server availability

> Application is on a single EC2 in a default VPC. The entire workload is depending on one single instance of an EC2 server running on AWS, which means if a subnet is down / if the application on the single server is down, then there is no fallback plan in place, the company needs a fallback plan just in-case if the single server is down.

### Initial implementation

Implemention involves the following steps, running 2 EC2 instances on the same subnet, by running the same CloudFormation script twice.

> Open up `initial_implementation` folder of this branch to view folder containing the steps to follow.

### Revised implementation

Implentation involves provisioning AWS CloudFormation stack, to create 2 EC2 instances on multiple subnets / different availability zones.

> Open up `revised_implementation` folder of this branch to view folder containing a CloudFormation script to provison high availability.

> BONUS: You will be also introduced to `aws-cdk` in this scenario
