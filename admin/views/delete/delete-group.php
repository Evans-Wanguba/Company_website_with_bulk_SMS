<?php
/**
* 
*/
class DeleteGroup
{
	private $groupreference;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_GET['groupreference']))
		{
			#sanitization
			$this->groupreference     =  mysql_real_escape_string($_GET['groupreference']);
			#check empty
			if(!empty($_GET['groupreference']))
			{
				if($remove_group_contact ==1)
				{
					$date = date('d-M-Y H:i:s');
					#delete Records
					$deleteGroup = mysql_query("DELETE FROM `sms_groups` WHERE `id`='$this->groupreference'");
					#delete from groups
					$deleteGContact = mysql_query("DELETE FROM `sms_group_members` WHERE `group`='$this->groupreference'");

					if($deleteGroup && $deleteGContact){
						# Write log
						$logtext = $_SESSION['bulkadmin']." has deleted a group on ".date('d-M-Y H:i:s');
						$log = mysql_query("INSERT INTO `sms_activity`(`activity_log`)VALUES('$logtext')");
						header('location:../all-groups.php');
					}

				}else{
					header('location:../all-groups.php?permit=null');		
				}
			}else{	
					header('location:../all-groups.php');
			}
		}else{
			header('location:../all-groups.php');
		}
	}
}

$delgrp = new DeleteGroup();

?>
