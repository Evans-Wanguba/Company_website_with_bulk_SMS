<?php
session_start();
@mysql_connect("localhost","root","") or die(mysql_error());
@mysql_select_db("kamande") or die(mysql_error());
$result = @mysql_query("select * from tbluser") or die(mysql_error());
if(isset($_POST['submit']))
{
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

<div class="container">
<h3>MANAGE USERS</h3>
<a href=""><h4>Add User</h4></a>
	<table class="table table-bordered">
		<tr>
			<th>Email</th>
			<th>Username</th>
			<th>Password</th>
			<th>User Level</th>
			<th>Phone Number</th>
			<th>Date</th>
		</tr>
		<?php
		while($rows_fetched = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td>Password: <?php echo $rows_fetched['password']; ?></td>
			<td>Username: <?php echo $rows_fetched['username']; ?></td>
			<td>Password: <?php echo $rows_fetched['password']; ?></td>
			<td>Username: <?php echo $rows_fetched['username']; ?></td>
			<td>Password: <?php echo $rows_fetched['password']; ?></td>
			<td>Username: <?php echo $rows_fetched['username']; ?></td>
			<td>
				<a href="">Edit</a> | <a href="">Delete</a> | <a href="">Details</a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>

<?php include '../template/adminfooter.php'; ?>