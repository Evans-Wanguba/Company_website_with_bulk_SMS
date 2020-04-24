<?php

require_once 'AfricasTalkingGateway.php';

class InlineMessage
{
	private $inlineno;
	private $inlinemsg;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['inlineno']) && isset($_REQUEST['inlinemsg']))
		{
			#sanitization
			$this->inlineno       =mysql_real_escape_string($_REQUEST['inlineno']);
			$this->inlinemsg      =mysql_real_escape_string($_REQUEST['inlinemsg']);
			#check empty
			if(!empty($this->inlineno) && !empty($this->inlinemsg))
			{
				if($open_msg == 1)
				{
					if(strpos($this->inlineno,'+') !== false)
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
						$recipients                    = $this->inlineno;
						$message                       = $this->inlinemsg;

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

$inlinemessage = new InlineMessage();

?>
