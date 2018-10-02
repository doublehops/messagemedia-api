#!/usr/bin/python3.6

###############################################################################
##
##  Deploy code to environments.
##
###############################################################################

import sys
import os


#####  DEFINE VARIABLES

src = '.'
webpath = "/var/www/messagemedia-api"

# Dictionary of environments and hosts
environments = {'staging': {'dhweb'},
               }


##### START SCRIPT

try:
    sys.argv[1]
except:
    print("You must supply an environment to deploy to.")
    sys.exit()

environment = sys.argv[1]

if environment not in environments:
    print("Environment", environment ,"not available")
    sys.exit()

for host in environments[environment]:
    print("Deploying for host:",host)

    dest = host +":"+ webpath
    excludePath = os.getcwd() +"/dev/deploy-exclude"

    os.system('rsync -avz --exclude-from '+ excludePath +' '+ src +' '+ dest)
