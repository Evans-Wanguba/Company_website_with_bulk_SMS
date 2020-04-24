<?php

require_once 'AfricasTalkingGateway.php';

class GroupMessage
{
	private $gmidentity;
	private $gmmessage;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['gmidentity']) && isset($_REQUEST['gmmessage']))
		{
			#sanitization
			$this->gmidentity       =   mysql_real_escape_string($_REQUEST['gmidentity']);
			$this->gmmessage        =   mysql_real_escape_string($_REQUEST['gmmessage']);
			#check empty
			if(!empty($this->gmidentity) && !empty($this->gmmessage))
			{
				if($group_msg == 1)
				{
					# GET PHONE NUMBERS AND GROUP DATA
					$gd = mysql_query("SELECT * FROM `sms_group_members` WHERE `group`='$this->gmidentity'");
						while($userdata = mysql_fetch_array($gd))
						{
							$user_id = $userdata['member'];
							# get phone number
							$user_tbl_check = mysql_query("SELECT * FROM `sms_contacts` WHERE `id`='$user_id'");
								$data_nos = mysql_fetch_array($user_tbl_check);
								$listNos .= $data_nos['phone_number'].",";
						}
					$grd = mysql_query("SELECT * FROM `sms_groups` WHERE `id`='$this->gmidentity'");
						$group_data = mysql_fetch_array($grd);
							$groupName = $group_data['group_name'];

						# SMS Code	
						$username                      = $as_username;
						$apikey                        = $as_key;
						if($as_sender_id == "")
						{
							$from                      = "SMSLEOPARD";
						}else{
							$from                      = $as_sender_id;
						}
						$recipients                    = $listNos;
						$message                       = $this->gmmessage;

						$gateway                       = new AfricasTalkingGateway($username, $apikey);
						try
						{
							$results = $gateway->sendMessage($recipients, $message, $from);
							if($results)
							{
								$date     = date('d-M-Y H:i:s');
								//save record
								$saveRecord = mysql_query("INSERT INTO `sms_logs`(`sent_to`,`message`,`date`,`by`)
									                                       VALUES('$groupName','$this->gmmessage','$date','{$_SESSION['bulkadmin']}')");
								if($mybalance < $setminimum)
								{
									$savemin = mysql_query("INSERT INTO `sms_activity`(`activity_log`)
									                                        VALUES('lowcredit')");
								}

							}
								if($saveRecord)
								{
									echo '<p style="color:green"><i class="fa fa-check-square"></i> Message sent</p>';
								}
						}
						catch ( AfricasTalkingGatewayException $e )
						{
							echo "Encountered an error while sending: ".$e->getMessage();
						}
				}else{
					echo '<p style="color:orange"><i class="fa fa-lock"></i> Sorry, you do not have permissions to send open messages</p>';
				}
			}else{
					echo '<p style="color:orange">Please provide phone number and message</p>';
			}
		}
	}
}

$groupmessage = new GroupMessage();

?>
