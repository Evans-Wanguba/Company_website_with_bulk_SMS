<?php

class AfricasTalkingGatewayException extends Exception{}

class AfricasTalkingGateway
{
  protected $_username;
  protected $_apiKey;
  
  protected $_requestBody;
  protected $_requestUrl;
  
  protected $_responseBody;
  protected $_responseInfo;
  
  const SMS_URL          = 'https://api.africastalking.com/version1/messaging';
  const VOICE_URL        = 'https://voice.africastalking.com/call';
  const USER_DATA_URL    = 'https://api.africastalking.com/version1/user';
  const SUBSCRIPTION_URL = 'https://api.africastalking.com/version1/subscription';

  /*
   * Turn this on if you run into problems. It will print the raw HTTP response from our server
   */
  const Debug             = False;
  
  const HTTP_CODE_OK      = 200;
  const HTTP_CODE_CREATED = 201;
  
  public function __construct($username_, $apiKey_)
  {
    $this->_username = $username_;
    $this->_apiKey   = $apiKey_;
    
    $this->_requestBody = null;
    $this->_requestUrl  = null;
    
    $this->_responseBody = null;
    $this->_responseInfo = null;    
  }
  
  public function sendMessage($to_, $message_, $from_ = null, $bulkSMSMode_ = 1, Array $options_ = array())
  {
    /*
     * The optional from_ parameter should be populated with the value of a shortcode or alphanumeric that is 
     * registered with us 
     * The optional  bulkSMSMode_ will be used by the Mobile Service Provider to determine who gets billed for a 
     * message sent using a Mobile-Terminated ShortCode. The default value is 1 (which means that 
     * you, the sender, gets charged). This parameter will be ignored for messages sent using 
     * alphanumerics or Mobile-Originated shortcodes.
     * Other options can be passed into the assiative options_ array. These are:
     * - enqueue : Useful when sending a lot of messages at once where speed is of the essence
     * - keyword : Specify which subscription product to use to send messages for premium rated short codes
     * - linkId  : Specified when responding to an on-demand content request on a premium rated short code
     * - retryDurationInHours: Specified for premium MT messages. We will retry this message over the 
     *   durarion of time specified in cases where we receive an Insuffient_Balance delivery report
     */
    
    if ( strlen($to_) == 0 || strlen($message_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply both to and message parameters');
    }
    
    $params = array(
		    'username' => $this->_username,
		    'to'       => $to_,
		    'message'  => $message_,
		    );
    
    if ( $from_ !== null ) {
      $params['from']        = $from_;
      $params['bulkSMSMode'] = $bulkSMSMode_;
    }
    
    if ( count($options_) > 0 ) {
      $allowedKeys = array (
			    'enqueue',
			    'keyword',
			    'linkId',
			    'retryDurationInHours'
			    );
      foreach ( $options_ as $key => $value ) {
	if ( in_array($key, $allowedKeys) && strlen($value) > 0 ) {
	  $params[$key] = $value;
	} else {
	  throw new AfricasTalkingGatewayException("Invalid key in options array: [$key]");
	}
      }
    }
    
    $this->_requestUrl  = self::SMS_URL;
    $this->_requestBody = http_build_query($params, '', '&');
    $this->execute('POST');
    
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_CREATED ) {
      throw new AfricasTalkingGatewayException($this->_responseBody);
    }
    
    return $this->_responseBody->SMSMessageData->Recipients;
  }
  
  public function call($from_, $to_)
  {
    if ( strlen($from_) == 0 || strlen($to_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply both from and to parameters');
    }
    
    $params = array(
		    'username' => $this->_username,
		    'from'     => $from_,
		    'to'       => $to_
		    );
    
    $this->_requestUrl  = self::VOICE_URL;
    $this->_requestBody = http_build_query($params, '', '&');
    $this->execute('POST');
    
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_CREATED ) {
      throw new AfricasTalkingGatewayException($this->_responseBody);
    }
  }
  
  public function fetchMessages($lastReceivedId_)
  {
    $username = $this->_username;
    $this->_requestUrl = self::SMS_URL.'?username='.$username.'&lastReceivedId='.intval($lastReceivedId_);
    
    $this->execute('GET');      
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_OK ) {
      throw new AfricasTalkingGatewayException($this->_responseBody);
    }
    return $this->_responseBody->SMSMessageData->Messages;
  }
  
  public function fetchPremiumSubscriptions($shortCode_, $keyword_, $lastReceivedId_)
  {
    $username = $this->_username;
    $this->_requestUrl  = self::SUBSCRIPTION_URL.'?username='.$username.'&shortCode='.$shortCode_;
    $this->_requestUrl .= '&keyword='.$keyword_.'&lastReceivedId='.intval($lastReceivedId_);
    
    $this->execute('GET');      
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_OK ) {
      throw new AfricasTalkingGatewayException($this->_responseBody);
    }
    
    return $this->_responseBody->SubscriptionData->Subscriptions;
  }

  public function createSubscription($phoneNumber_, $shortCode_, $keyword_)
  {
    if ( strlen($phoneNumber_) == 0 || 
	 strlen($shortCode_) == 0   ||
	 strlen($keyword_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply phoneNumber, shortCode and keyword');
    }
    
    $params = array(
		    'username'    => $this->_username,
		    'phoneNumber' => $phoneNumber_,
		    'shortCode'   => $shortCode_,
		    'keyword'     => $keyword_
		    );
    
    $this->_requestUrl  = self::SUBSCRIPTION_URL."/create";
    $this->_requestBody = http_build_query($params, '', '&');
    
    $this->execute('POST');
    
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_CREATED ) {
      throw new AfricasTalkingGatewayException($this->_responseBody);
    }
    
    return $this->_responseBody->status;
  }

  public function deleteSubscription($phoneNumber_, $shortCode_, $keyword_)
  {
    if ( strlen($phoneNumber_) == 0 || 
	 strlen($shortCode_) == 0   ||
	 strlen($keyword_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply phoneNumber, shortCode and keyword');
    }
    
    $params = array(
		    'username'    => $this->_username,
		    'phoneNumber' => $phoneNumber_,
		    'shortCode'   => $shortCode_,
		    'keyword'     => $keyword_
		    );
    
    $this->_requestUrl  = self::SUBSCRIPTION_URL."/delete";
    $this->_requestBody = http_build_query($params, '', '&');
    $this->execute('POST');
    
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_CREATED ) {
      throw new AfricasTalkingGatewayException($this->_responseBody);
    }
    
    return $this->_responseBody->status;
  }

  
  public function getUserData()
  {
    $username = $this->_username;
    $this->_requestUrl = self::USER_DATA_URL.'?username='.$username;
    $this->execute('GET');
    
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_OK ) {
      throw new AfricasTalkingGatewayException($this->_responseBody);
    }
    
    return $this->_responseBody->UserData;
  }

  
  protected function execute ($verb_)
  {
    $ch = curl_init();
    try {
      switch (strtoupper($verb_)){
      case 'GET':
	$this->executeGet($ch);
	break;
      case 'POST':
	$this->executePost($ch);
	break;
      default:
	throw new InvalidArgumentException('Current verb (' . $verb_ . ') is not implemented.');
      }
    }
    catch (InvalidArgumentException $e){
      curl_close($ch);
      throw $e;
    }
    catch (Exception $e){
      curl_close($ch);
      throw $e;
    }
  }
  
  protected function doExecute (&$curlHandle_)
  {
    $this->setCurlOpts($curlHandle_);
    $responseBody = curl_exec($curlHandle_);
    
    if ( self::Debug ) {
      echo "Full response: ".print_r($responseBody, true)."\n";
    }
    
    $this->_responseInfo = curl_getinfo($curlHandle_);
    
    if ( $this->_responseInfo['http_code'] == self::HTTP_CODE_OK ||
	 $this->_responseInfo['http_code'] == self::HTTP_CODE_CREATED ) {
      
      $this->_responseBody = json_decode($responseBody);
      
    } else {
      
      $this->_responseBody = $responseBody;
      
    }
    
    curl_close($curlHandle_);
  }
  
  protected function executeGet ($ch_)
  {
    $this->doExecute($ch_);
  }
  
  protected function executePost ($ch_)
  {
    curl_setopt($ch_, CURLOPT_POSTFIELDS, $this->_requestBody);
    curl_setopt($ch_, CURLOPT_POST, 1);
    $this->doExecute($ch_);
  }
  
  protected function setCurlOpts (&$curlHandle_)
  {
    curl_setopt($curlHandle_, CURLOPT_TIMEOUT, 60);
    curl_setopt($curlHandle_, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curlHandle_, CURLOPT_URL, $this->_requestUrl);
    curl_setopt($curlHandle_, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandle_, CURLOPT_HTTPHEADER, array ('Accept: application/json',
							 'apikey: ' . $this->_apiKey));
  }
}
