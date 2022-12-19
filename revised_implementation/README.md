# Revised implementation

Implentation involves provisioning AWS CloudFormation stack, to create 2 EC2 instances on multiple subnets / different availability zones.

> BONUS: You will be also introduced to `aws-cdk` in this scenario

---

## Install the AWS CDK

Install the AWS CDK Toolkit globally using the following Node Package Manager command.

```sh
npm install -g aws-cdk
```

Run the following command to verify correct installation and print the version number of the AWS CDK.

```sh
cdk --version
```

---

## Bootstrapping

Deploying stacks with the AWS CDK requires dedicated Amazon S3 buckets and other containers to be available to AWS CloudFormation during deployment. Creating these is called [bootstrapping](https://docs.aws.amazon.com/cdk/v2/guide/bootstrapping.html)

Ensure for

- <ACCOUNT-NUMBER> - Replace value with your AWS account number
- <REGION> - Replace value with `us-east-1`

```sh
cdk bootstrap aws://<ACCOUNT-NUMBER>/<REGION>
```

---

## Deployment

Entire stack is present within the `cdk-deployment/lib/cdk-deployment-stack.ts`

Deploy this to your account:

```sh
cdk deploy
```

---

## Services used

- AWS CDK
- AWS CloudFormation
- Amazon VPC
