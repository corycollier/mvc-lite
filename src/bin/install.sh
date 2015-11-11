#!/bin/bash

echo "################################################################################"
echo "#"
echo "# MVCLite Installation script"
echo "#"
echo "################################################################################"

# establish the document root of the application
cd ..
DOCUMENT_ROOT="`pwd`/pub"
ETC_PATH="`pwd`/etc"
APP_PATH="`pwd`/app"
LIB_PATH="`pwd`/lib"
VAR_PATH="`pwd`/var"

#prompt for the server name
echo -n "Enter the name of the website (test.com, example.com, etc ...): "
read SERVER_NAME

#prompt for the server admin
echo -n "Enter the administrator of the website (youremail@domain.com): "
read SERVER_ADMIN

# Prompt for the web user
echo -n "Enter the name of the web process user (apache, www, www-data, etc ...): "
read WEB_USER

# ensure the web user and the server name are lowercased
SERVER_NAME=`echo "${SERVER_NAME}" | awk '{print tolower($0)}'`
SERVER_ADMIN=`echo "${SERVER_ADMIN}" | awk '{print tolower($0)}'`
WEB_USER=`echo "${WEB_USER}" | awk '{print tolower($0)}'`

# copy the virtual host template, and update placeholder values
cp ./etc/vhost.conf.template "./etc/${SERVER_NAME}.conf"
perl -pi -e "s/SERVER_NAME/${SERVER_NAME}/g" "./etc/${SERVER_NAME}.conf"
perl -pi -e "s/SERVER_ADMIN/${SERVER_ADMIN}/g" "./etc/${SERVER_NAME}.conf"
perl -pi -e "s:DOCUMENT_ROOT:${DOCUMENT_ROOT}:g" "./etc/${SERVER_NAME}.conf"

# set the web process to own the var path
chown -R "${WEB_USER}:" "${VAR_PATH}"
 
echo "################################################################################"
echo "#"
echo "# Virtual host file created in ${ETC_PATH}/${SERVER_NAME}.conf"
echo "#"
echo "################################################################################"
