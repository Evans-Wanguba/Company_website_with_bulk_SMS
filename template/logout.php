<?php
/**
* LOGOUT LOGGED SESSIONS
*/
session_start();

class Logout
{
	
	function __construct()
	{
		if(isset($_SESSION['sandbox'])){
			unset($_SESSION['sandbox']);
			header('location:../sms-login.php');
		}
		if(isset($_SESSION['bulkadmin'])){
			unset($_SESSION['bulkadmin']);
			header('location:../sms-login.php');
		}
	}
}

$logout = new Logout();

?>