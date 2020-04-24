<?php 
if(isset($_POST['forgot']))
{
$email_to = $_POST['email'];
if($email_to == "" || $email_to == " ")
{
?>
<script>
alert("Fill in your email address!");
window.location.href="forgot.php";
</script>
<?php
}
else
{
$email_to = $_POST['email'];
mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("kamande") or die(mysql_error());
$sql = mysql_query("select * from tbluser where email='$email_to'") or die(mysql_error());
$rows = mysql_fetch_array($sql) or die(mysql_error());
$row = mysql_num_rows($sql) or die(mysql_error());
if($row == 1)
{	
$response = @fsockopen("www.google.com", 80);					  
if($response)
{
require_once('phpmailer/class.phpmailer.php');
	$encrypt = md5(1999*6+$row['userid']);
	$reset_link = "http://www.latchtechnologies/pages/reset.php?userid=".$encrypt; //use bit.ly to shorten the link
	$report_to = "ewanguba@gmail.com";
	$mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "ewanguba@gmail.com";
    $mail->Password = "wanguba2011";
	$mail->SMTPSecure = "ssl";  
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "25"; 
    $mail->setFrom('ewanguba@gmail.com', 'Latch Technologies Limited');
    $mail->AddAddress('kelvinkimutai1@gmail.com', 'Our Client');
    $mail->Subject  =  'Account password reset';
    $mail->IsHTML(true);
    $mail->Body    = 'Hi there '.$rows['username'].',
	                  <br />
					  this mail was sent to you to reset your pssword, click on the link below to proceed,
					  <br />
					  '.$reset_link.'
					  <br />
					  If you did not perform this action, please notify us through '.$report_to.' 
					  <br />
					  cheers :)
					  <br />
					  Latch Technologies Limited';	
if($mail->Send())
{
?>
<script>
alert("A password reset link has been sent to your email "<?php echo $email_to."."; ?>);
window.location.href="forgot.php";
</script>
<?php
}
else
{
?>
<script>
alert("Your account password reset request failed!");
window.location.href="forgot.php";
</script>
<?php
}
}
else
{
?>
<script>
alert("Please check your internet connection then try again!");
window.location.href="forgot.php";
</script>
<?php
}
}
else
{
?>
<script>
alert("It seems your email is not registered with us!");
window.location.href="forgot.php";
</script>
<?php
}
}
}
?>