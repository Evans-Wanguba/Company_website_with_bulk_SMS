<?php
/**
* 
*/
class AdminSettings
{
	private $oldpassword,$newpassword,$confirmnewpassword;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['oldpassword']) && isset($_REQUEST['newpassword']) && isset($_REQUEST['confirmnewpassword']))
		{
				#sanitization
				$this->oldpassword        =  mysql_real_escape_string($_REQUEST['oldpassword']);
				$this->newpassword        =  mysql_real_escape_string($_REQUEST['newpassword']);
				$this->confirmnewpassword =  mysql_real_escape_string($_REQUEST['confirmnewpassword']);
				#check empty
				if(!empty($this->oldpassword) && !empty($this->newpassword) && !empty($this->confirmnewpassword))
				{
					if(md5($this->oldpassword)==$pdata)
					{
						if($this->newpassword == $this->confirmnewpassword)
						{
							if(strlen($this->newpassword) < 8)
							{
								$enc = md5($this->newpassword);

								$update = mysql_query("UPDATE `sms_users` SET `password`='$enc' WHERE `id`='$uid'");
									if($update)
										{
											# Write log
											$logtext = $_SESSION['bulkadmin']." has changed account password on ".date('d-M-Y H:i:s');
											$log = mysql_query("INSERT INTO `sms_activity`(`activity_log`)VALUES('$logtext')");

											echo '<p style="color:green"><i class="fa fa-check-square"></i> SMS Settings updated</p>';

										}else{
											echo mysql_error();
										}
							}else{
								echo '<p style="color:orange">Password length should be at least 8 characters</p>';
							}
						}else{
							echo '<p style="color:orange">The new passwords do not match</p>';
						}
					}else{	
						echo '<p style="color:orange">Old password is not correct</p>';
					}

				}else{
					echo '<p style="color:orange">Please fill all fields</p>';
				}
		}
	}
}

$adminsettings = new AdminSettings();

?>
