<?php

#error reporting
error_reporting(-1); //Respect whatever is set in php.ini (sysadmin knows better??)
#Don't display errors
ini_set('display_errors',0);
ini_set('display_startup_errors',0);

# This is the database name
$dbname='care2xkhl';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='root';

# Database user password, default is empty char
$dbpassword='kaligana';

# Database host name, default = localhost
$dbhost='localhost';

# Hospitals Logo Filename in directory gui/img/common/default/
$hospital_logo='logo.gif';

# First key used for simple chaining protection of scripts
$key='2.67452802362E+28';

# Second key used for accessing modules
$key_2level='2.48431445375E+26';

# 3rd key for encrypting cookie information
$key_login='1.69264361013E+27';

# Main host address or domain
$main_domain='mail.smsmedia.info';

# Host address for images
$fotoserver_ip='localhost';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysql';
?>
