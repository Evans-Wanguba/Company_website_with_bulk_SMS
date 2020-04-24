<?php

/**
* written by Kanyi for Oneplace Technologies
* written in the simplest form to allow nerds to understand
* Distributed as open source http://oneplacesms.com/terms
* 
* 
* This file creates and writes the actual config file 
*/
class WriteFile
{
	private $host,$username,$password,$database;

	function __construct()
	{
		if(isset($_REQUEST['host']) && isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['database']))
		{
			
			# sanitize REQUEST variables
			$this->host       =  $_REQUEST['host'];
			$this->username   =  $_REQUEST['username'];
			$this->password   =  $_REQUEST['password'];
			$this->database   =  $_REQUEST['database'];


			# make sure important fields are not empty

			if(empty($this->host) || empty($this->username) || empty($this->database))
			{
				exit("<h5 style='color:orange'>Please fill all required fields</h5>");
			}

			# test server connection

			if(@mysql_connect($this->host,$this->username,$this->password))
			{
				# test database selection

				if(mysql_select_db($this->database))
				{

					# Write config file

					$myfile = fopen("../../en-us/database/config.php", "w");

					if($myfile)
					{

					$txt = "
<?php\n
	# Simple Connection File\n

	# PROUDLY POWERED BY ONEPLACE TECHNOLOGIES LTD\n
	/**
	* written by Kanyi for Oneplace Technologies
	* written in the simplest form to allow nerds to understand
	* Distributed as open source http://oneplacesms.com/terms
	* 
	* 
	* This file is actually the login file
	* This file can be edited inline anytime your server credentials change
	*/
	
	##################CONNECT TO SERVER####################################################
	@mysql_connect('".$this->host."','".$this->username."','".$this->password."') or die('Cannot connect');\n

	##################SELECT YOUR DATABASE#################################################

	mysql_select_db('".$this->database."') or die('Cannot select database');\n

	/**
	* This code has been made as simple as possible
	* You can do your own manipulation to enable OOP login procedure
	* http://oneplacesms.com/terms
	* 
	* 
	*/
	
?>";

						$write_config_file = fwrite($myfile, $txt);
											 fclose($myfile);
						if ($write_config_file) {

								#######################################CREATE  TABLES################################################
								mysql_query("								
									CREATE TABLE IF NOT EXISTS `sms_users` (
									  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  `email` varchar(250) NOT NULL,
									  `username` varchar(20) NOT NULL,
									  `password` varchar(32) NOT NULL,
									  `date` varchar(30) NOT NULL,
									  `level` int(1) NOT NULL,
									  `open_msg` int(1) NOT NULL,
									  `group_msg` int(1) NOT NULL,
									  `broadcast_msg` int(1) NOT NULL,
									  `credit_permit` int(1) NOT NULL,
									  `contact_permit` int(1) NOT NULL,
									  `group_permit` int(1) NOT NULL,
									  `view_logs` int(1) NOT NULL,
									  `remove_group_contact` int(1) NOT NULL,
									  `login_pass` int(5) NOT NULL,
									  `phone` varchar(20) NOT NULL,
									  `log_permit` int(1) NOT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;
								");
								#############################################################################################################
								#######################################CREATE  TABLES################################################
								mysql_query("								
									CREATE TABLE IF NOT EXISTS `sms_settings` (
									  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  `as_username` varchar(50) NOT NULL,
									  `as_key` varchar(250) NOT NULL,
									  `as_sender_id` varchar(11) NOT NULL,
									  `system_name` varchar(100) NOT NULL,
									  `security_2_factor` int(1) NOT NULL,
									  `minbalance` int(2) NOT NULL,
									  `broadcast_authority` int(1) NOT NULL,
									  `password_reset_type` varchar(10) NOT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;
								");
								#############################################################################################################
								#######################################CREATE  TABLES####################################################
								mysql_query("								
									CREATE TABLE IF NOT EXISTS `sms_logs` (
									  `id` int(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  `sent_to` varchar(30) NOT NULL,
									  `message` text NOT NULL,
									  `date` varchar(30) NOT NULL,
									  `by` varchar(100) NOT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;
								");
								#############################################################################################################
								#######################################CREATE  TABLES####################################################
								mysql_query("								
									CREATE TABLE IF NOT EXISTS `sms_group_members` (
									  `id` int(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  `group` int(12) NOT NULL,
									  `member` int(12) NOT NULL,
									  `added_by` varchar(100) NOT NULL,
									  `date` varchar(30) NOT NULL
									) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;
								");
								#############################################################################################################
								#######################################CREATE  TABLES####################################################
								mysql_query("								
									CREATE TABLE IF NOT EXISTS `sms_groups` (
									  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  `group_name` varchar(100) NOT NULL,
									  `created_by` varchar(100) NOT NULL,
									  `date` varchar(30) NOT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;
								");
								#############################################################################################################
								#######################################CREATE  TABLES####################################################
								mysql_query("								
									CREATE TABLE IF NOT EXISTS `sms_contacts` (
									  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  `contact_name` varchar(250) NOT NULL,
									  `phone_number` varchar(20) NOT NULL,
									  `organization` varchar(100) NOT NULL,
									  `added_by` varchar(100) NOT NULL,
									  `date` varchar(30) NOT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;
								");
								#############################################################################################################
								#######################################CREATE  TABLES####################################################
								mysql_query("								
									CREATE TABLE IF NOT EXISTS `sms_activity` (
									  `id` int(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  `activity_log` text NOT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;
								");
								#############################################################################################################

								echo 'success';

						}else{
						echo "<h5 style='color:orange'>Unable to create configs file</h5>";
					}

					}else{
						echo "<h5 style='color:orange'>Unable to create config file</h5>";
					}
					
					
				}else{

					die("<h5 style='color:orange'>Database provided does not exist</h5>");
				}

			}else{

				die("<h5 style='color:orange'>Connection Failed</h5>");
			}

		}
	}
}

$writefile = new WriteFile();

?>