# Revised implementation

Implemention involves creating a AWS CloudFormation stack by uploading the appropriate `.yaml` file.

---

## Create a server VPC with only Public Subnets:

Import the `vpc-public-subnets-stack.yaml` file on AWS CloudFormation

---

## Create a server VPC with only Private Subnets:

Import the `vpc-private-subnets-stack.yaml` file on AWS CloudFormation

---

## Create a server VPC with Public & Private Subnets:

Import the `vpc-public-private-subnets-ipv4-stack.yaml` file on AWS CloudFormation.

Optionally `vpc-public-private-subnets-ipv4-ipv6-stack.yaml` can be uploaded for VPC with ipv6 support.

## Services used

- AWS CloudFormation
- Amazon VPC
