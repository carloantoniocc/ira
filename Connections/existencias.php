<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_existencias = "localhost";
$database_existencias = "existencias";
$username_existencias = "usr_ira";
$password_existencias = "-SNE&+S4";
$existencias = mysql_pconnect($hostname_existencias, $username_existencias, $password_existencias) or die(mysql_error());
?>