# Initial implementation

Implemention involves the following steps, all the steps are been done manually. There is no automation in place.

1. Create a server by choosing a server hardware and installing O.S
2. Download & install updates for each outdated package & dependency of O.S
3. Install a web-server to host the application
4. Install runtime for application
5. Download the `application` folder to web-server's home directory for hosting
6. Create a new ssh key to be used later to connect from localhost
7. Configure the O.S level firewall to open up traffic on port 80
8. Open the application on the browser

---

## Steps 1 - 4:

Follow through steps needed to create a hypervisor on your on-premise virtual machine OR create an EC2 virtual machine on AWS cloud by following aws docs. which details the steps to provisiong one EC2 on AWS Management Console manually.

[Tutorial: Get started with Amazon EC2 Linux instances](https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/EC2_GetStarted.html)

---

### Step 5:

Once the instance is launched download the application folder's index.html to web-server's home directory, for webserver such as nginx the default directory is `/var/www/html`

Finally html file will be at `/var/www/html/index.html`.

---

## Steps 6 - 7:

Not listed here, refer your server's network settings to apply the settings applicable

### Step 8:

Open the DNS of the server on a browser tab
