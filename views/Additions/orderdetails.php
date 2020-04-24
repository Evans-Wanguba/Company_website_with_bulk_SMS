<?php
session_start();
$pictureid=$_GET['pictureid'];
if($_SESSION['username'])
{
mysql_connect("localhost","root","") or die('cannot connect to the server'); 
mysql_select_db("besttreeseedlings") or die('database selection problem');
$sql="select * from picturedetails where pictureid='$pictureid'";
$resultset=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($resultset);

$username = $_SESSION['username'];
$sql0="select * from userdetails where username='$username'";
$resultset0=mysql_query($sql0) or die(mysql_error());
$row0=mysql_fetch_array($resultset0);
$id=$row0['id'];

$search = $row['seedid'];
$sql1="select * from seedlingsdetails where seedid='$search'";
$resultset1=mysql_query($sql1) or die(mysql_error());
$row1=mysql_fetch_array($resultset1);
$seedid=$row1['seedid'];
$price=$row1['price'];
$quantityindb=$row1['quantity'];

if(isset($_POST['submit']))
{
$quantity=$_POST['quantity'];
if($quantity > $quantityindb)
{
?>
<script>
alert("You ordered for more than is available");
location.href="orderdetails.php?pictureid=<?php echo $row['pictureid'] ?>";
</script>
<?php	
}
else{
$cost=$price * $quantity;
$reminder = $quantityindb - $quantity;
mysql_query("update seedlingsdetails set quantity = '$reminder' where seedid='$search'")or die("couldn't run query");
$result=mysql_query("insert into orderdetails(id,seedid,quantity,cost)
values('$id','$seedid','$quantity','$cost')")or die("couldn't run query");
if($result)
{
?>
<script>
alert("Your order was successful");
location.href="index.php";
</script>
<?php
}
	else
{
?>
<script>
alert("Your order failed");
location.href="orderdetails.php?pictureid=<?php echo $row['pictureid'] ?>";
</script>
<?php
}
?>
<html>
<head>
<title>
BEST SEEDLINGS 
</title>
</head>
<body>
<center><a href="index.php">HOME</a> | <a href="logout.php">SIGN OUT</a>
<br><br>
<form method="post">
<img src="admin/uploads/<?php echo $row['pnameold']; ?>" alt="Resized Image"><br><br>
<font color="red"><b>SEEDLINGS REMAINING IN STOCK ARE <?php echo $quantityindb; ?></b></font><br><br>
<body>
<center><a href="index.php">HOME</a>
<br><br>
Welcome <b><?php echo $_SESSION['username']; ?></b>
<br><br>
<form method="post">
<img src="admin/uploads/<?php echo $row['pnameold']; ?>" alt="Resized Image"><br><br>
<font color="red"><b>SEEDLINGS REMAINING IN STOCK ARE <?php echo $quantityindb; ?></b></font><br><br>
<table border="0" cellspacing="0" cellpadding="10">
<tr>
<td>
Price: </td><td colspan="2"><?php echo $row1['price']." KES"; ?></td>
</tr>
<tr><td>
Quantity: </td><td><input type="text" name="quantity"  value="">&nbsp
</td><td><input type="submit" name="calculate" value="Calculate Cost"></td>
</tr>
<tr><td>
Cost: </td><td colspan="2"><input type="text" name="cost" readonly="true" value=""></td>
</tr>
<tr><td align="center" colspan="3">
<input type="submit" name="submit" value="Order"></td>
</tr>
</table>
</form>
</center>
</body>
</html>
<?php
}
}
else
{
if(isset($_POST['calculate']))
{
$quantity=$_POST['quantity'];
$cost=$price * $quantity;
?>
<html>
<head>
<title>
BEST SEEDLINGS 
</title>
</head>
<body>
<center><a href="index.php">HOME</a> | <a href="logout.php">SIGN OUT</a>
<br><br>
Welcome <b><?php echo $_SESSION['username']; ?></b>
<br><br>
<form method="post">
<img src="admin/uploads/<?php echo $row['pnameold']; ?>" alt="Resized Image"><br><br>
<font color="red"><b>SEEDLINGS REMAINING IN STOCK ARE <?php echo $quantityindb; ?></b></font><br><br>
<table border="0" cellspacing="0" cellpadding="10">
<tr>
<td>
Price: </td><td colspan="2"><?php echo $row1['price']." KES"; ?></td>
</tr>
<tr><td>
Quantity: </td><td><input type="text" name="quantity"  value="<?php echo $quantity; ?>">&nbsp
</td><td><input type="submit" name="calculate" value="Calculate Cost"></td>
</tr>
<tr><td>
Cost: </td><td colspan="2"><input type="text" name="cost" readonly="true" value="<?php echo $cost; ?>"></td>
</tr>
<tr><td align="center" colspan="3">
<input type="submit" name="submit" value="Order"></td>
</tr>
</table>
</form>
</center>
</body>
</html>
<?php
}
else
{
?>
<html>
<head>
<title>
BEST SEEDLINGS 
</title>
</head>
<body>
<center><a href="index.php">HOME</a> | <a href="logout.php">SIGN OUT</a>
<br><br>
Welcome <b><?php echo $_SESSION['username']; ?></b>
<br><br>
<form method="post">
<img src="admin/uploads/<?php echo $row['pnameold']; ?>" alt="Resized Image"><br><br>
<font color="red"><b>SEEDLINGS REMAINING IN STOCK ARE <?php echo $quantityindb; ?></b></font><br><br>
<table border="0" cellspacing="0" cellpadding="10">
<tr>
<td>
Price: </td><td colspan="2"><?php echo $row1['price']." KES"; ?></td>
</tr>
<tr><td>
Quantity: </td><td><input type="text" name="quantity"  value="">&nbsp
</td><td><input type="submit" name="calculate" value="Calculate Cost"></td>
</tr>
<tr><td>
Cost: </td><td colspan="2"><input type="text" name="cost" readonly="true" value=""></td>
</tr>
<tr><td align="center" colspan="3">
<input type="submit" name="submit" value="Order"></td>
</tr>
</table>
</form>
</center>
</body>
</html>
<?php
}
}
}
else
{
header("location:login.php?pictureid=".$pictureid);
}
?>