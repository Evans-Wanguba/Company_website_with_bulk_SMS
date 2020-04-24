<?php
/**
* 
*/
class NewGroup
{
	private $newgroupname;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_REQUEST['newgroupname']))
		{
			#sanitization
			$this->newgroupname    =  ucwords(mysql_real_escape_string($_REQUEST['newgroupname']));

			#check empty
			if(!empty($this->newgroupname))
			{
				$date = date('d-M-Y H:i:s');
				#check against database for record
					$duplicate=mysql_query("SELECT * FROM `sms_groups` WHERE `group_name`='$this->newgroupname'");

						if(mysql_num_rows($duplicate)==0)
							{
								$insert = mysql_query("INSERT INTO `sms_groups`(`group_name`,`created_by`,`date`)
									VALUES('$this->newgroupname','{$_SESSION['bulkadmin']}','$date')");
									if($insert)
									{
											echo '<p style="color:green"><i class="fa fa-check-square"></i> Group added</p>';
									}else{
											echo mysql_error();
									}
							}else{
								echo '<p style="color:orange"> Group exists</p>';
							}
			}else{
			echo '<p style="color:orange">Please fill all fields</p>';
			}
		}
	}
}

$newgroup = new NewGroup();

?>
