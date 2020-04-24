<?php
session_start();
if(isset($_POST['submit']))
{
mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("kamande") or die(mysql_error());
$username = $_POST['username']; 
$password = $_POST['password'];
$result = mysql_query("select username, password from tbluser where username='$username' and password='$password'") or die(mysql_error());
$rows = mysql_fetch_array($result) or die(mysql_error());
$row = mysql_num_rows($result) or die(mysql_error());
if($row == 1)
{
$_SESSION['username'] = $rows['username'];
header("location:home.php");
}
else
{
?>
<script>
alert("Your cedentials seem to be invalid.");
window.location.href="login.php";
</script>
<?php
}
}
?>

<?php include '../template/adminheader.php'; ?>

<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/style.css">

<h3>MANAGE PAYMENTS</h3>
<a href=""><h4>Add Payment</h4></a>
<form method="post">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" />
			</td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" id="password" />
			<input type="checkbox" title="Show Password" onchange="document.getElementById('password').type = this.checked ? 'text':'password'">
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Log In" /></td>
		</tr>
	</table>
</form>

<?php include '../template/adminfooter.php'; ?>