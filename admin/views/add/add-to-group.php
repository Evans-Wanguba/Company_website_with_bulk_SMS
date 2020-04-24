<?php
/**
* 
*/
class AddToGroup
{
	private $thisgroup;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['thisgroup']))
		{
			#sanitization
			$this->thisgroup     =  mysql_real_escape_string($_REQUEST['thisgroup']);
			#check empty
			if(!empty($_REQUEST['chkArray']))
			{
				if($group_permit ==1)
				{
					$date = date('d-M-Y H:i:s');
					#Add Records
					foreach ($_REQUEST['chkArray'] as $record) 
					{

						$linkToGroup = mysql_query("SELECT * FROM `sms_group_members` WHERE `member`='$record' && `group`='$this->thisgroup'");
	                  	
	                  	if(mysql_num_rows($linkToGroup) == 0)
	                  	{
							$insertToGroup = "INSERT INTO `sms_group_members`(`group`,`member`,`added_by`,`date`) 
							VALUES('$this->thisgroup','$record','{$_SESSION['bulkadmin']}','$date')";

							if(mysql_query($insertToGroup)){
								echo '<p style="color:green"><i class="fa fa-check-square"></i> Group Members Updated</p>';
							}
						}
					}
				}else{
					echo '<p style="color:orange">You dont have permission to send messages to this group</p>';		
				}
			}else{	
					echo '<p style="color:orange">Please select contacts to add</p>';
			}
		}
	}
}

$addtogroup = new AddToGroup();

?>
