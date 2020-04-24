<?php
/**
* 
*/
class ChangePhone
{
	private $upphone;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['upphone']))
		{
				#sanitization
				$this->upphone        =  mysql_real_escape_string($_REQUEST['upphone']);
				#check empty
				if(!empty($this->upphone))
				{
					if(strpos($this->upphone,'+') !== false)
					{

						$update = mysql_query("UPDATE `sms_users` SET `phone`='$this->upphone' WHERE `id`='$uid'");
							if($update)
								{
									# Write log
									$logtext = $_SESSION['bulkadmin']." has updated phone number on ".date('d-M-Y H:i:s');
									$log = mysql_query("INSERT INTO `sms_activity`(`activity_log`)VALUES('$logtext')");

									echo '<p style="color:green"><i class="fa fa-check-square"></i> Phone Number updated</p>';

								}else{
									echo mysql_error();
								}
					}else{
						echo '<p style="color:orange">Phone number should be in full international format (+25478*****)</p>';
					}

				}else{
					echo '<p style="color:orange">Please provide a phone number</p>';
				}
		}
	}
}

$changephone = new ChangePhone();

?>
