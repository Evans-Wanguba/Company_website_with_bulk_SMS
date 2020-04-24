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
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>

<div class="container">

<h3>MANAGE MESSAGES</h3>

<ul class="nav nav-tabs">
<li class="active"><a href="#menu1" role="tab" data-toggle="tab">Group SMS</a></li>
<li><a href="#menu2" role="tab" data-toggle="tab">Single SMS</a></li>
<li><a href="#menu3" role="tab" data-toggle="tab">Newsletters</a></li>
<li><a href="#menu4" role="tab" data-toggle="tab">Contacts</a></li>
</ul>

<div class="tab-content">

<div id="menu1" class="tab-pane active">
	<a href=""><h4>Add Menu 1</h4></a>
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
		while($rows_fetched0 = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td>Password: <?php echo $rows_fetched0['password']; ?></td>
			<td>Username: <?php echo $rows_fetched0['username']; ?></td>
			<td>Password: <?php echo $rows_fetched0['password']; ?></td>
			<td>Username: <?php echo $rows_fetched0['username']; ?></td>
			<td>Password: <?php echo $rows_fetched0['password']; ?></td>
			<td>Username: <?php echo $rows_fetched0['username']; ?></td>
			<td>
				<a href="">Edit</a> | <a href="">Delete</a> | <a href="">Details</a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>

<div id="menu2" class="tab-pane">
	<a href=""><h4>Add Menu 2</h4></a>
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
		while($rows_fetched1 = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td>Password: <?php echo $rows_fetched1['password']; ?></td>
			<td>Username: <?php echo $rows_fetched1['username']; ?></td>
			<td>Password: <?php echo $rows_fetched1['password']; ?></td>
			<td>Username: <?php echo $rows_fetched1['username']; ?></td>
			<td>Password: <?php echo $rows_fetched1['password']; ?></td>
			<td>Username: <?php echo $rows_fetched1['username']; ?></td>
			<td>
				<a href="">Edit</a> | <a href="">Delete</a> | <a href="">Details</a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>

<div id="menu3" class="tab-pane">
	<a href=""><h4>Add Menu 3</h4></a>
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
		while($rows_fetched2 = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td>Password: <?php echo $rows_fetched2['password']; ?></td>
			<td>Username: <?php echo $rows_fetched2['username']; ?></td>
			<td>Password: <?php echo $rows_fetched2['password']; ?></td>
			<td>Username: <?php echo $rows_fetched2['username']; ?></td>
			<td>Password: <?php echo $rows_fetched2['password']; ?></td>
			<td>Username: <?php echo $rows_fetched2['username']; ?></td>
			<td>
				<a href="">Edit</a> | <a href="">Delete</a> | <a href="">Details</a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>

<div id="menu4" class="tab-pane">
	<a href=""><h4>Add Menu 4</h4></a>
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
		while($rows_fetched3 = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td>Password: <?php echo $rows_fetched3['password']; ?></td>
			<td>Username: <?php echo $rows_fetched3['username']; ?></td>
			<td>Password: <?php echo $rows_fetched3['password']; ?></td>
			<td>Username: <?php echo $rows_fetched3['username']; ?></td>
			<td>Password: <?php echo $rows_fetched3['password']; ?></td>
			<td>Username: <?php echo $rows_fetched3['username']; ?></td>
			<td>
				<a href="">Edit</a> | <a href="">Delete</a> | <a href="">Details</a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>

</div>
	
</div>

<?php include '../template/adminfooter.php'; ?>