<?php
session_start();

if(isset($_POST['database_conf']))
{
header("location:#second_settings");
$username = $_POST['username']; 
$password = $_POST['password'];
$result = mysql_query("select username, password from tbluser where username='$username' and password='$password'") or die(mysql_error());
$rows = mysql_fetch_array($result) or die(mysql_error());
$row = mysql_num_rows($result) or die(mysql_error());
}

if(isset($_POST['admin_conf']))
{
header("location:#third_settings");
$username = $_POST['username']; 
$password = $_POST['password'];
$result = mysql_query("select username, password from tbluser where username='$username' and password='$password'") or die(mysql_error());
$rows = mysql_fetch_array($result) or die(mysql_error());
$row = mysql_num_rows($result) or die(mysql_error());
}

if(isset($_POST['bulksms_conf']))
{
header("location:#fourth_settings");
$username = $_POST['username']; 
$password = $_POST['password'];
$result = mysql_query("select username, password from tbluser where username='$username' and password='$password'") or die(mysql_error());
$rows = mysql_fetch_array($result) or die(mysql_error());
$row = mysql_num_rows($result) or die(mysql_error());
}

if(isset($_POST['pesapalapi_conf']))
{
header("location:#success_settings");
$username = $_POST['username']; 
$password = $_POST['password'];
$result = mysql_query("select username, password from tbluser where username='$username' and password='$password'") or die(mysql_error());
$rows = mysql_fetch_array($result) or die(mysql_error());
$row = mysql_num_rows($result) or die(mysql_error());
}
?>

<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/style.css">

<div class="container">

<div id="first_settings" class="overlay">
	<div class="popup">
		<!--<div class="col-md-12">
			CONNECT TO DATABASE SERVER -> ADMIN CREDENTIALS -> PESAPAL CONFIGURATIONS -> BULK SMS CONFIGURATIONS <br>
		</div>-->
		<h3>CONNECT TO DATABASE SERVER</h3>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<form method="post">
			<input type="text" name="host" placeholder="Enter server hostname" class="form-control"><br>
			<input type="text" name="username" placeholder="Enter server username" class="form-control"><br>
			<input type="text" name="password" placeholder="Enter server password" class="form-control"><br>
			<input type="text" name="database" placeholder="Enter database name" class="form-control"><br>
			<input type="submit" name="database_conf" value="Next" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>

<div id="second_settings" class="overlay">
	<div class="popup">
		<h3>ADMIN CREDENTIALS</h3>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<form method="post">
			<input type="text" name="email" placeholder="Enter Admin Email" class="form-control"><br>
			<input type="text" name="phoneno" placeholder="Enter Admin Phone Number" class="form-control"><br>
			<input type="text" name="username" placeholder="Enter Admin Username" class="form-control"><br>
			<input type="text" name="password" placeholder="Enter Admin Password" class="form-control"><br>
			<input type="submit" name="admin_conf" value="Next" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>

<div id="third_settings" class="overlay">
	<div class="popup">
		<h3>BULK SMS CONFIGURATIONS</h3>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<form method="post">
			<input type="text" name="africastalking_username" placeholder="Enter Africastalking Username" class="form-control"><br>
			<input type="text" name="africastalking_api_key" placeholder="Enter Africastalking API Key" class="form-control"><br>
			<input type="text" name="senderid" placeholder="Enter Sender ID" class="form-control"><br>
			<input type="submit" name="bulksms_conf" value="Next" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>

<div id="fourth_settings" class="overlay">
	<div class="popup">
		<h3>PESAPAL CONFIGURATIONS</h3>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<form method="post">
			<input type="text" name="customer_key" placeholder="Enter Cutomer Key as provided by Pesapal merchant" class="form-control"><br>
			<input type="text" name="customer_secret" placeholder="Enter Cutomer Secret as provided by Pesapal merchant" class="form-control"><br>
			<input type="submit" name="pesapalapi_conf" value="Install" class="btn btn-success">
			</form>
		</div>
	</div>
</div>

<div id="success_settings" class="overlay">
	<div class="popup">
		<!--<img src="../images/logo.png" /><br>-->
		<h3>Congratulations!</h3>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<p>Installation completed successfully.</p>
			<input type="button" onclick="window.location.href='../views/homepage.php';" value="Proceed" class="btn btn-success">
		</div>
	</div>
</div>

</div>