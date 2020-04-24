<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'pesapi';
@mysql_connect($hostname,$username,$password) or die("The Server is down. Contact System Administrator via email: ewanguba@gmail.com");
@mysql_select_db($database) or die("The Server is down. Contact System Administrator via email: ewanguba@gmail.com");
?>