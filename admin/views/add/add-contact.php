<?php
/**
* 
*/

class New_Contact
{
	private $cname;
	private $corg;
	private $cphone;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['cname']) && isset($_REQUEST['corg']) && isset($_REQUEST['cphone']))
		{
			if($contact_permit==1)
			{
				#sanitization
				$this->cname           =ucwords(mysql_real_escape_string($_REQUEST['cname']));
				$this->corg            =ucwords(mysql_real_escape_string($_REQUEST['corg']));
				$this->cphone          =mysql_real_escape_string($_REQUEST['cphone']);

				#check empty
				if(!empty($this->cname) && !empty($this->corg) && !empty($this->cphone))
				{
					$date = date('d-M-Y H:i:s');

					//verify phone number
							if(strpos($this->cphone,'+') !== false)
							{
								#check against database for record
								$duplicate=mysql_query("SELECT * FROM `sms_contacts` WHERE `phone_number`='$this->cphone'");

								if(mysql_num_rows($duplicate)==0)
								{
									$insert = mysql_query("INSERT INTO `sms_contacts`(`contact_name`,`organization`,`phone_number`,`added_by`,`date`)
										VALUES('$this->cname','$this->corg','$this->cphone','{$_SESSION['bulkadmin']}','$date')");
										if($insert)
										{
												echo '<p style="color:green"><i class="fa fa-check-square"></i> Contact added</p>';
										}else{
												echo mysql_error();
										}
								}else{
									echo '<p style="color:orange"> Phone number exists</p>';
								}
							}else{
							echo '<p style="color:orange">Phone number should be in full international format (+25478*****)</p>';
							}
				}else{
				echo '<p style="color:orange">Please fill all fields</p>';
				}
			}else{
				echo '<p style="color:orange">You dont have permission to add contacts</p>';
				}
		}
	}
}

$newclass = new New_Contact();

?>
