<?php
######################################################################
# SLDB: Simple Database Storage for LSL 1.02
######################################################################
# Copyright (C) 2009 aubreTEC Labs
# http://aubretec.com/products/sldb
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################

######################################################################
# DATABASE CONFIGURATION
#
# SLDB assumes you will be using a MySQL database.  For other database
# types, some adjustments may be necessary.
#
# dbhost:   Database hostname
# dbuser:   Database username
# dbpass:   Database password
# dbname:   Database name
######################################################################

$dbhost = 'localhost';
$dbuser = 'sldb';
//$dbpass = 'RjqC5mYVZ9YzdCw7';
$dbpass = 'phuzzl3';
$dbname = 'sldb';
$datatable = 'otms_textures';
$user_table = 'sldb_users';

mysql_connect($dbhost, $dbuser, $dbpass) or die('ERROR: CANNOT CONNECT TO DATABASE.');
mysql_select_db($dbname) or die('ERROR: CANNOT SELECT DATABASE. \n' . mysql_error());

?>