<?php
/**
* 
*/
class DeleteGContact
{
	private $userReference,$groupReference;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_GET['userReference']) && isset($_GET['groupReference']))
		{
			#sanitization
			$this->userReference     =  mysql_real_escape_string($_GET['userReference']);
			$this->groupReference    =  mysql_real_escape_string($_GET['groupReference']);
			#check empty
			if(!empty($_GET['groupReference']) && !empty($this->userReference))
			{
				if($remove_group_contact ==1)
				{
					$date = date('d-M-Y H:i:s');
					#delete from groups

					$deleteGContact = mysql_query("DELETE FROM `sms_group_members` WHERE `member`='$this->userReference' && `group`='$this->groupReference'");

					if($deleteGContact){
						# Write log
						$logtext = $_SESSION['bulkadmin']." has deleted a user from a group on ".date('d-M-Y H:i:s');
						$log = mysql_query("INSERT INTO `sms_activity`(`activity_log`)VALUES('$logtext')");
						header('location:../view-group.php?groupId='.$this->groupReference);
					}
				}else{
					header('location:../view-group.php?permit=null&&groupId='.$this->groupReference);		
				}
			}else{	
					header('location:../view-group.php?groupId='.$this->groupReference);
			}
		}else{
			header('location:../view-group.php?groupId='.$this->groupReference);
		}
	}
}

$delgcon = new DeleteGContact();

?>
