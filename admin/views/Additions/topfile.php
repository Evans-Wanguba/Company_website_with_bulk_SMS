<?php

session_start();

		require_once __DIR__ . '/config.php';
		require_once __DIR__ . '/AfricasTalkingGateway.php';

		if(isset($_SESSION['bulkadmin']))
		{
			error_reporting(0);
			
			$loggedUser = "SELECT * FROM `sms_users` WHERE `username`='{$_SESSION['bulkadmin']}'";

			if($loggedUser_run = mysql_query($loggedUser))
			{
				$userData = mysql_fetch_array($loggedUser_run);
 				$level            			= $userData['level'];
 				$uid            			= $userData['id'];
				$open_msg         			= $userData['open_msg'];
				$group_msg        			= $userData['group_msg'];
				$broadcast_msg    			= $userData['broadcast_msg'];
				$credit_permit    			= $userData['credit_permit'];
				$contact_permit   			= $userData['contact_permit'];
				$group_permit     			= $userData['group_permit'];
				$remove_group_contact       = $userData['remove_group_contact'];
				$log_permit                 = $userData['view_logs'];
				$phone                      = $userData['phone'];
				$us                         = $userData['username'];
				$pdata                      = $userData['password'];
			}

			$settings = "SELECT * FROM `sms_settings`";

			if($settings_run = mysql_query($settings))
			{
				$settingvalues = mysql_fetch_array($settings_run);
				// Account settings details
				$as_username                = $settingvalues['as_username'];                                                                                                  
				$as_key                     = $settingvalues['as_key'];
				$as_sender_id               = $settingvalues['as_sender_id'];
				$setminimum                 = $settingvalues['minbalance'];
				$security_2_factor          = $settingvalues['security_2_factor'];
				$broadcast_authority        = $settingvalues['broadcast_authority'];
				$password_reset_type        = $settingvalues['password_reset_type'];
			}

            $gateway    = new AfricasTalkingGateway($as_username, $as_key);
                try
                    {
                        $data              = $gateway->getUserData();
                        $bal               = $data->balance;

                        $dal               = explode(".", $bal);
                        $mybalance         = (int) $dal[0];
                    }
                catch ( AfricasTalkingGatewayException $e )
                    {
                        echo "Encountered an error while fetching user data: ".$e->getMessage()."\n";
                    }

		}else{
			header('location:sms-login.php');
		}

?>