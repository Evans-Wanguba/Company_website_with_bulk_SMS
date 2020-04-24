<?php
session_start();

@$pictureid = $_GET['pictureid'];

if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
mysql_connect("localhost","root","")or die("could not connet to mysql server");
mysql_select_db("besttreeseedlings")or die("could not connect to database");
$result=mysql_query("select username,password from userdetails where username='$username'and password='$password'");
$row=mysql_num_rows($result);
if($row==1)
{
$_SESSION['username'] = $row['username'];
header("location:buyitem.php");
}
else
{
?>
<script>
alert("Register first to log in");
location.href="userdetails.php";
</script>
<?php
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>
BEST SEEDLINGS 
</title>
</head>
<body>
<center><a href="index.php">HOME</a> | <a href="userdetails.php">SIGN UP</a>
<br><br>
<form method="POST">
<table border="0" cellspacing="0" cellpadding="5">
<tr>
<td valign="top">
<label>Username&nbsp
</td>
<td>
<input type="text" name="username" placeholder="username"></label><br><br>
</td>
</tr>
<tr>
<td valign="top">
<label>Password&nbsp
</td>
<td>
<input type="password" name="password" id="password" placeholder="password"></label>&nbsp
<input type="checkbox" onClick="document.getElementById('password').type = this.checked ? 'text' : 'password'">Show Password<br><br>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="login" value="Sign In">
</td>
</tr>
<tr>
<td colspan="2" align="center">
<a href="userdetails.php">Sign Up</a>
</td>
</tr>
</table>
</form>
</center>
</body>
</html>