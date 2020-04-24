<?php

session_start();

/**
* Get all user data into database and possibly send a text
* Order data receiver
*/
class EditUser
{
	private $attach,$euphone,$euopenmessage,$eugroupmessage,$eubroadcast,$euviewlogs,$euaddcontact,$euaddgroup,$euremovecg,$euviewcredits;

	
	function __construct()
	{
		require_once 'topfile.php';
		require_once('AfricasTalkingGateway.php');

		if(isset($_REQUEST['euphone']) && 
			isset($_REQUEST['euopenmessage']) && 
			isset($_REQUEST['eugroupmessage']) && 
			isset($_REQUEST['eubroadcast']) && 
			isset($_REQUEST['euviewlogs']) && 
			isset($_REQUEST['euaddcontact']) && 
			isset($_REQUEST['euaddgroup']) && 
			isset($_REQUEST['euremovecg']) && 
			isset($_REQUEST['attach']) && 
			isset($_REQUEST['euviewcredits']))
		{
			$this->attach     		  =   $_REQUEST['attach'];
			$this->euphone     		  =   $_REQUEST['euphone'];
			$this->euopenmessage      =   $_REQUEST['euopenmessage'];
			$this->eugroupmessage     =   $_REQUEST['eugroupmessage'];
			$this->eubroadcast        =   $_REQUEST['eubroadcast'];
			$this->euviewlogs         =   $_REQUEST['euviewlogs'];
			$this->euaddcontact       =   $_REQUEST['euaddcontact'];
			$this->euaddgroup         =   $_REQUEST['euaddgroup'];
			$this->euremovecg         =   $_REQUEST['euremovecg'];
			$this->euviewcredits      =   $_REQUEST['euviewcredits'];

			# validations
			if(
				empty($this->euphone) ||  
				empty($this->euopenmessage) || 
				empty($this->eugroupmessage) || 
				empty($this->eubroadcast) || 
				empty($this->euviewlogs) || 
				empty($this->euaddcontact) || 
				empty($this->euaddgroup) || 
				empty($this->euremovecg) || 
				empty($this->euviewcredits))
			{
			  	exit("<h5 style='color:orange'>Please fill all required fields</h5>");
			}


			$code     = rand(1000,9999);

			# insert into database

			$update = "UPDATE `sms_users`
				SET 
				`open_msg`='$this->euopenmessage',
				`group_msg`='$this->eugroupmessage',
				`broadcast_msg`='$this->eubroadcast',
				`credit_permit`='$this->euviewcredits',
				`contact_permit`='$this->euaddcontact',
				`group_permit`='$this->euaddgroup',
				`view_logs`='$this->euviewlogs',
				`remove_group_contact`='$this->euremovecg',
				`phone`='$this->euphone'
				WHERE `id`='$this->attach'
			";
			
			if($update_run   =  mysql_query($update))
			{
				echo "<h5 style='color:green;'><i class='fa fa-check-square'></i> User details updated</h5>";
			}
		}

		
	}
	
}

# new order
$order = new EditUser();

?>