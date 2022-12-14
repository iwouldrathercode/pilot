# Creating an isolated network

> The virtual machine / server is ready, but we see other team members also creating their projects within the same environment. We want an isolated network space where resources can be deployed

### Initial implementation

Implemention involves the following steps, all the steps are been done manually. There is no automation in place.

1. Create a server VPC with only Public Subnets
2. Create a server VPC with only Private Subnets
3. Create a server VPC with Public & Private Subnets

> Open up `initial_implementation` folder of this branch to view folder containing the steps to follow.

### Revised implementation

Implentation involves provisioning AWS CloudFormation stack.

> Open up `revised_implementation` folder of this branch to view folder containing a CloudFormation script to provison our network.
