<?php
/**
* 
*/
class DeleteContact
{
	private $contactreference;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_GET['contactreference']))
		{
			#sanitization
			$this->contactreference     =  mysql_real_escape_string($_GET['contactreference']);
			#check empty
			if(!empty($_GET['contactreference']))
			{
				if($remove_group_contact ==1)
				{
					$date = date('d-M-Y H:i:s');
					#delete Records
					$deleteContact = mysql_query("DELETE FROM `sms_contacts` WHERE `id`='$this->contactreference'");
					#delete from groups
					$deleteGContact = mysql_query("DELETE FROM `sms_group_members` WHERE `member`='$this->contactreference'");

					if($deleteContact && $deleteGContact){
						# Write log
						$logtext = $_SESSION['bulkadmin']." has deleted a contact on ".date('d-M-Y H:i:s');
						$log = mysql_query("INSERT INTO `sms_activity`(`activity_log`)VALUES('$logtext')");
						header('location:../all-contacts.php');
					}

				}else{
					header('location:../all-contacts.php?permit=null');		
				}
			}else{	
					header('location:../all-contacts.php');
			}
		}else{
			header('location:../all-contacts.php');
		}
	}
}

$delcon = new DeleteContact();

?>
