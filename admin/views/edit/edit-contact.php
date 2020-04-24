<?php
/**
* 
*/



class Edit_Contact
{
	private $identity;
	private $newcname;
	private $newcorg;
	private $newcphone;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['newcname']) && isset($_REQUEST['newcorg']) && isset($_REQUEST['newcphone']) && isset($_REQUEST['identity']))
		{
			#sanitization
			$this->newcname           = ucwords(mysql_real_escape_string($_REQUEST['newcname']));
			$this->newcorg            = ucwords(mysql_real_escape_string($_REQUEST['newcorg']));
			$this->newcphone          = mysql_real_escape_string($_REQUEST['newcphone']);
			$this->identity           = mysql_real_escape_string($_REQUEST['identity']);

			#check empty
			if(!empty($this->newcname) && !empty($this->newcorg) && !empty($this->identity) && !empty($this->newcphone))
			{
				$date = date('d-M-Y H:i:s');

				//verify phone number
						if(strpos($this->newcphone,'+') !== false)
						{
							$update = mysql_query("UPDATE `sms_contacts` SET 
								`contact_name`='$this->newcname',
								`organization`='$this->newcorg',
								`phone_number`='$this->newcphone'
								WHERE `id`='$this->identity'");

							if($update)
								{
									# Write log
									$logtext = $_SESSION['bulkadmin']." has update contact ".$this->newcname." >>> ".$this->newcphone." >>> ".$this->newcorg." on ".date('d-M-Y H:i:s');

									$log = mysql_query("INSERT INTO `sms_activity`(`activity_log`)VALUES('$logtext')");

									echo '<p style="color:green"><i class="fa fa-check-square"></i> Contact Updated</p>';

								}else{
									echo mysql_error();
								}
						}else{
						echo '<p style="color:orange">Phone number should be in full international format (+25478*****)</p>';
						}
			}else{
			echo '<p style="color:orange">Please fill all fields</p>';
			}
		}
	}
}

$newclass = new Edit_Contact();

?>
