# Initial implementation

Implemention involves the following steps, running 2 EC2 instances on the same subnet, by running the same CloudFormation script twice.

---

## Step 1:

Create a key pair on AWS by executing below command on your terminal. Ensure AWS CLI is installed and configured with a default profile on your localhost.

```sh
aws ec2 create-key-pair --key-name MyKeyPair --region us-east-1
```

---

## Step 2:

Navigate to AWS CloudFormation and import the `stack.yaml` file as a `New Stack with existing resources` and Choose `Upload file` and Create Stack.

Wait for `CREATE_COMPLETE` status on the CloudFormation stack and open the `Outputs` tab, click on the `WebsiteURL` to open the site.

---

## Services used

- AWS CLI
- AWS CloudFormation
- AWS EC2
- Amazon VPC
