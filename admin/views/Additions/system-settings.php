<?php
/**
* 
*/
class SystemSettings
{
	private $twofactor;
	private $resettype;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['twofactor']) && isset($_REQUEST['resettype']))
		{
			if($level==1)
			{
				#sanitization
				$this->twofactor        =  mysql_real_escape_string($_REQUEST['twofactor']);
				$this->resettype        =  ucwords(mysql_real_escape_string($_REQUEST['resettype']));
				#check empty
				if(!empty($this->resettype) && !empty($this->twofactor))
				{
					#check against database for record
						$update = mysql_query("UPDATE `sms_settings` SET `security_2_factor`='$this->twofactor',`password_reset_type`='$this->resettype'");
							if($update)
								{
									# Write log
									$logtext = $_SESSION['bulkadmin']." has updated system settings on ".date('d-M-Y H:i:s');
									$log = mysql_query("INSERT INTO `sms_activity`(`activity_log`)VALUES('$logtext')");

									echo '<p style="color:green"><i class="fa fa-check-square"></i> Settings updated</p>';

								}else{
									echo mysql_error();
								}
				}else{
					echo '<p style="color:orange">Please fill all fields</p>';
				}
			}else{
					echo '<p style="color:orange">You dont have permission to change settings</p>';
				}
		}
	}
}

$systemsettings = new SystemSettings();

?>
