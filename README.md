# Provisioning the application

> The first version of the application is ready and now it has to be provisioned on a server. Typically a virtual machine / server on the on-premise environment / cloud.

### Initial implementation

Implemention involves the following steps, all the steps are been done manually. There is no automation in place.

1. Create a server by choosing a server hardware and installing O.S
2. Download & install updates for each outdated package & dependency of O.S
3. Install a web-server to host the application
4. Install runtime for application
5. Download the `application` folder to web-server's home directory for hosting
6. Create a new ssh key to be used later to connect from localhost
7. Configure the O.S level firewall to open up traffic on port 80
8. Open the application on the browser

> Open up `initial_implementation` folder of this branch to view folder containing the application to download to the webserver after running Steps 1 - 4 on a new virtual machine.

### Revised implementation

Implentation involves provisioning AWS CloudFormation with user-data as a bash script for servers based on Linux O.S OR power-shell script for servers based on Windows O.S.

> Open up `revised_implementation` folder of this branch to view folder containing a CloudFormation script to provison a EC2 virtual machine on AWS with user-data.
