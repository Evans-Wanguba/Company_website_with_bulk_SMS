<?php

    require_once('AfricasTalkingGateway.php');
    require_once 'topfile.php';

    $username   = $as_username;
    $apikey     = $as_key;
    $gateway    = new AfricasTalkingGateway($username, $apikey);
        try
          {
            $data = $gateway->getUserData();
            echo "<h4>Balance:</h4> ".$data->balance;
          }
    catch ( AfricasTalkingGatewayException $e )
    {
      echo "Encountered an error while fetching user data: ".$e->getMessage()."\n";
    }
?>