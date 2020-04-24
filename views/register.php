<?php
@$pictureid = $_GET['pictureid'];
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$area=$_POST['area'];
$phoneno=$_POST['phoneno'];
$username=$_POST['username'];
$password=md5($_POST['password']);
$confpassword=md5($_POST['confpassword']);
mysql_connect("localhost","root","")or die("could not connet to mysql server");
mysql_select_db("besttreeseedlings")or die("could not connect to database");
if($password <> $confpassword)
{
?>
<script>
alert("Password does not match Confirm Password");
location.href="userdetails.php?pictureid=<?php echo $pictureid ?>";
</script>	
<?php
}
else
{
$result=mysql_query("insert into userdetails (firstname, middlename, lastname, emailaddress, city_town, phonenumber, username, password, adddate) values ('$fname', '$mname', '$lname', '$email', '$area', '$phoneno', '$username', '$password', Now())")or die("couldn't run query");
if($result)
{
?>
<script>
alert("Data entry successful");
location.href="login.php";
</script>
<?php
}
	else
{
?>
<script>
alert("Data entry failed");
location.href="userdetails.php";
</script>
<?php
}
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
<center><a href="index.php">HOME</a> | <a href="login.php?pictureid=<?php echo $pictureid ?>">SIGN IN</a>
<br><br>
<form method="post">
<table border="0" cellspacing="0" cellpadding="10">
<tr>
<td valign="top">
First Name</td><td><input type="text" name="fname">
</td>
</tr>
<tr><td>
Middle Name</td><td><input type="text" name="mname">
</td>
</tr>
<tr><td>
Last Name</td><td><input type="text" name="lname">
</td>
</tr>
<tr><td>
Email Address</td><td><input type="email" name="email">
</td>
</tr>
<tr><td>
City_Town</td><td><input type="text" name="area">
</td>
</tr>
<tr><td>
Phone Number</td><td><input type="text" name="phoneno">
</td>
</tr>
<tr><td>
Username</td><td><input type="text" name="username">
</td>
</tr>
<tr><td>
Password</td><td><input type="password" name="password">
</td>
</tr>
<tr><td>
Confirm Password</td><td><input type="password" name="confpassword">
</td>
</tr>
<tr><td colspan="2" align="center">
<input type="submit" name="submit" value="Submit"><br><br>
</tr>
</table>
</form>
</center>
</body>
</html>