Message Media code test - API
===============================


API NOTES
===========

This API was created to pass the Message Media coding test. 

## Installation

A provisioner has been created to install all dependencys for both a local VM for development and the production servers. The 
provisioning process for both is the same. 

### Install Vagrant, Ansible and Virtualbox onto your workstation.

Install Vagrant, Ansible and Virtualbox onto your workstation.
Clone the repository: `git clone git@bitbucket.org:doublehops/messagemedia-api.git` in your working directory.
Run `vagrant up` to install and start the virtual machine.

### Provision your local dev VM

Add line to /etc/hosts by typing
`echo '192.168.30.65 messagemedia.api' | sudo tee -a /etc/hosts`

Copy these lines to your `~/.ssh/config` file:
```
Host messagemedia.api
User vagrant
Hostname messagemedia.api
IdentityFile /{your_working_path}/messagemedia-api/.vagrant/machines/default/virtualbox/private_key
```

Be sure you can ssh into the vm with `ssh messagemedia.api` and exit back out.

To install the application on a local or remote server, these steps are the same:

- Run `dev/provision.sh <host>`. Host could be either local_dev, messagemedia-api-prod, messagemedia-api-stg, etc... Check script for details

Now point your browser to an endpoint such as `http://messagemedia.api/api/token` and you should see the token returned indicating that the webserver and API is running as expected.

### Documentation - (Example - not installed for Message Media coding test)
Documentation can be found at `http://messagemedia.api/doc/index.html`

Documentation can be updated by modifying file `dev/doc/swagger.yml`. Keep running `dev/bin/doc-convert-watch.sh` which will watch your changes and modify the JSON file automatically for you.


### Notes on getting API testing (Example - not setup for Message Media coding test)

The testing script will run migrations and reset the database before each test. To run the tests, ssh into the vm and from `/var/www` 
type `test-api frontend/tests/api`. You can also add `-vvv` to the command to make the test print a more verbose output.

### Deployment

Currently, deployment can be done via the Rsync script by also defining which envionment you wish to deploy to. For example, `dev/deploy.py staging`. This script will move any modified files, run pending migrations and update the local configuration file. The script should be run from the host machine and requires that you have the required hosts added to `~/.ssh/config`.

Note: This should be replaced with a continuous integration tool.
