<?php

session_start();
/**
* Get all user data into database and possibly send a text
* Order data receiver
*/
class User
{
	private $admin_email, $admin_username, $admin_phone,$admin_password, $as_username, $as_api_key, $as_sender_id;

	
	function __construct()
	{
		require_once '../../en-us/database/config.php';

		if(isset($_REQUEST['admin_email']) && isset($_REQUEST['admin_phone']) && isset($_REQUEST['admin_username']) && isset($_REQUEST['admin_password']) && isset($_REQUEST['as_username']) && isset($_REQUEST['as_api_key']) && isset($_REQUEST['as_sender_id']))
		{
			$this->admin_email         =   $_REQUEST['admin_email'];
			$this->admin_username      =   $_REQUEST['admin_username'];
			$this->admin_phone         =   $_REQUEST['admin_phone'];
			$this->admin_password      =   $_REQUEST['admin_password'];
			$this->as_username         =   $_REQUEST['as_username'];
			$this->as_api_key          =   $_REQUEST['as_api_key'];
			$this->as_sender_id        =   $_REQUEST['as_sender_id'];

			# validations
			if(empty($this->admin_email) || empty($this->admin_phone) || empty($this->admin_username) || empty($this->admin_password) || empty($this->as_username) || empty($this->as_api_key))
			{
			  	exit("<h5 style='color:orange'>Please fill all required fields</h5>");
			}

			if (!preg_match("/^[a-zA-Z ]*$/",$this->admin_username))
			{
				exit("<h5 style='color:orange'>Username should not contain numbers or special characters</h5>");
			}

			if(strlen($this->admin_username) < 6)
			{
				exit("<h5 style='color:orange'>Username should be a minimum of 6 letters</h5>");
			}

			if(strlen($this->admin_password) < 8)
			{
				exit("<h5 style='color:orange'>Password should be a minimum of 8 letters</h5>");
			}

			if(! filter_var($this->admin_email, FILTER_VALIDATE_EMAIL))
			{
				exit("<h5 style='color:orange'>Please check your email format</h5>");
			}

			#verify email
			$verify_email = mysql_query("SELECT * FROM `sms_users` WHERE `email`='$this->admin_email'");
			if(mysql_num_rows($verify_email) > 0)
			{
				exit("<h5 style='color:orange'>The email address you gave is already registered</h5>");
			}

			#verify username
			$verify_username = mysql_query("SELECT * FROM `sms_users` WHERE `username`='$this->admin_username'");
			if(mysql_num_rows($verify_username) > 0)
			{
				exit("<h5 style='color:orange'>The username you gave is already in use</h5>");
			}

			$code     = rand(1000,9999);

			# get date today
			$date     = date('d-M-Y H:i:s');
			#encrypt database
			$encpass  = md5($this->admin_password);

			# insert into database
			$saveUser         =  "INSERT INTO `sms_users`
			(`email`,`username`,`password`,`date`,`login_pass`,`level`,`open_msg`,`group_msg`,`broadcast_msg`,`credit_permit`,`contact_permit`,`group_permit`,`view_logs`,`remove_group_contact`,`phone`) 
			VALUES('$this->admin_email','$this->admin_username','$encpass','$date','$code','1','1','1','1','1','1','1','1','1','$this->admin_phone')";

			if($saveUser_run   =  mysql_query($saveUser))
			{

				$saveAsCr      =  "INSERT INTO `sms_settings`(`as_username`,`as_key`,`as_sender_id`,`system_name`,`minbalance`,`security_2_factor`,`password_reset_type`) 
												VALUES('$this->as_username','$this->as_api_key','$this->as_sender_id','Oneplace SMS','10','1','Email')";

					if($saveAsCr_run = mysql_query($saveAsCr))
					{
						# send mail to user
						$to = $this->admin_email;
			            $subject = 'Oneplace SMS';
						$message ='<html>
			                            <head>
			                               	<title>Oneplace SMS</title>
			                                    </head>
			                                        <body>
			                                          <div style="margin:0 auto;  background-color:#fff; font-family:Calibri Light; border-radius:5px; padding:10px;">

			                                            	<h5 style="color:#000; font-size:20px;">Welcome to Oneplace SMS</h5>

			                                            	A great SMS System created by Oneplace Technologies LTD and working on the Africastalking SMS API<br>



			                                            	<br><br>
			                                            	<i>For more queries, contact us at</i><br>

			                                            	<div style="clear:both; border-bottom:1px solid #dcdcdc;"></div>
			                                            		<p style="color:#606060; font-size:14px;">
			                                            		Oneplace Technologies<br>
			                                            		P.O Box 80063,00200<br>
			                                            		Nairobi - Kenya<br>
			                                            		Email: info@oneplacetechnologies.com . kanyikennedy@gmail.com | Phone: +254 705 992 941<br><br>

			                                            		+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			                                            		<br>
			                                            		This system is distributed as open source. <br>
			                                            		You can do anything you want with it<br>
			                                            		Make sure the system footer remains "Developed by Oneplace Technologies"			                                            		
			                                            		+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

			                                            		</p>
			                                            	</div>
			                                          </div>
			                                        </body>
			                                       </html>';
				            $headers  = 'MIME-Version: 1.0' . "\r\n";
				            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				            $headers .= 'From: Oneplace SMS<info@oneplacetechnologies.com>' . "\r\n";
				            $headers.='X-Mailer: PHP/' . phpversion()."\r\n";

				            $send = mail($to, $subject, $message, $headers);

				            echo $this->json_encoder("okay");
					}
			}
		}

		
	}
	
	public function json_encoder($data)
	{
		$message = [];
		
		if(is_array($data))
		{
			foreach($data as $key => $value)
			{
				$message[$key] = $value;
			}
		}else{
			$message = ['feedback'=>$data];
		}
		
		header('Content-type: application/json');		
		return json_encode($message);
	}
}

# new order
$order = new User();

?>