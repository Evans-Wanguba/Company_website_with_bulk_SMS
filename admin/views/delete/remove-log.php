<?php


class RemoveLog
{
	private $logid;

	function __construct()
	{
		require_once 'topfile.php';

		if(isset($_GET['logid']))
		{
			#sanitization
			$this->logid  =mysql_real_escape_string($_GET['logid']);
			#check empty
			if(!empty($this->logid))
			{
				if($level == 1)
				{

					$deletequery = "DELETE FROM `sms_logs` WHERE `id`='$this->logid'";
						if($deletequery_run = mysql_query($deletequery))
						{
							header('location:../message-logs.php?status=deleted');
						}else{
							header('location:../message-logs.php?status=something-went-wrong');
						}
				}else{
					header('location:../message-logs.php?status=invalid-permissions');
				}
			}else{
					header('location:../message-logs.php');
			}
		}
	}
}

$removelog = new RemoveLog();

?>
