<?php

require_once 'AfricasTalkingGateway.php';

class SingleMessage
{
	private $openphonenumber;
	private $openmessage;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['openphonenumber']) && isset($_REQUEST['openmessage']))
		{
			#sanitization
			$this->openphonenumber  =mysql_real_escape_string($_REQUEST['openphonenumber']);
			$this->openmessage      =mysql_real_escape_string($_REQUEST['openmessage']);
			#check empty
			if(!empty($this->openphonenumber) && !empty($this->openmessage))
			{
				if($open_msg == 1)
				{
					if(strpos($this->openphonenumber,'+') !== false)
					{
						# SMS Code	
						$username                      = $as_username;
						$apikey                        = $as_key;
						if($as_sender_id == "")
						{
							$from                      = "SMSLEOPARD";
						}else{
							$from                      = $as_sender_id;
						}
						$recipients                    = $this->openphonenumber;
						$message                       = $this->openmessage;

						$gateway                       = new AfricasTalkingGateway($username, $apikey);
						try
						{
							$results = $gateway->sendMessage($recipients, $message, $from);
							if($results)
							{
								$date     = date('d-M-Y H:i:s');
								//save record
								$saveRecord = mysql_query("INSERT INTO `sms_logs`(`sent_to`,`message`,`date`,`by`)
									                                       VALUES('$recipients','$message','$date','{$_SESSION['bulkadmin']}')");
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
						echo '<p style="color:orange">Phone number should be in full international format (+25478*****)</p>';
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

$singlemessage = new SingleMessage();

?>
