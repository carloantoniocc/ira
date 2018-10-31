<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ira = "localhost";
$database_ira = "ira";
$username_ira = "root";
$password_ira = "silver";
$ira = mysql_pconnect($hostname_ira, $username_ira, $password_ira) or die(mysql_error());
?>
