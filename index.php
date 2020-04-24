<?php
	session_start();
	@$pictureid=$_GET['pictureid'];
	if(isset($_POST['search']))
	{
		$item=$_POST['item'];
		@mysql_connect("localhost","root","") or die('cannot connect to the server'); 
		@mysql_select_db("besttreeseedlings") or die('database selection problem');
		$sql="select a.seedname,a.price,b.* from seedlingsdetails a,picturedetails b where a.seedid=b.seedid and seedname = '$item'";
		$result_set=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_array($result_set);
		?>
		<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BEST SEEDLINGS </title>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.min.js"></script>

		<link href="style/style.css" rel="stylesheet" type="text/css">
		</head>
		<body>
		<?php include 'template/header.php'; ?>
		<br><br>
		<div style="text-align:center;">
		<form method="post">
			<input type="text" name="item" placeholder="Search Item Name" class="form-control">
			<input type="submit" name="search" value="search" class="btn btn-primary">
		</form>
		<h3>Click on the images below for a better view.</h3>
		<table border="1" cellspacing="0">
		<td><div><b>Seedling Name:</b> <?php echo $row['seedname']; ?></div>
		<div><a href="orderdetails.php?pictureid=<?php echo $row['pictureid'] ?>"><img src="admin/uploads/<?php echo $row['pname']; ?>" alt="Resized Image"></a></div>
		<div><b>Price:</b> <?php echo $row['price']; ?></div>
		</td>
		</table>
		</div>
		</center>
		<?php include 'template/footer.php'; ?>
		</body>
		</html>
		<?php
	}
	if(isset($_SESSION['username']))
	{
		?>
		<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BEST SEEDLINGS </title>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.min.js"></script>

		<link href="style/style.css" rel="stylesheet" type="text/css">
		</head>
		<body>
		<?php include 'template/header.php'; ?>
		<br><br>
		Welcome <b><?php echo $_SESSION['username']; ?></b>
		<br><br>
		<div style="text-align:center;">
		<form method="post">
			<input type="text" name="item" placeholder="Search Item Name" class="form-control">
			<input type="submit" name="search" value="search" class="btn btn-primary">
		</form>
		<h3>Click on the images below for a better view.</h3>
		<table border="1" cellspacing="0">
		<?php
		mysql_connect("localhost","root","") or die('cannot connect to the server'); 
		mysql_select_db("besttreeseedlings") or die('database selection problem');
		$sql="select a.seedname,a.price,b.* from seedlingsdetails a,picturedetails b where a.seedid=b.seedid";
		$result_set=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_array($result_set))
		{
		$rows = $row['pname'];
		?>
		<td><div><b>Seedling Name:</b> <?php echo $row['seedname']; ?></div>
		<div><a href="orderdetails.php?pictureid=<?php echo $row['pictureid'] ?>"><img src="admin/uploads/<?php echo $rows; ?>" alt="Resized Image"></a></div>
		<div><b>Price:</b> <?php echo $row['price']; ?></div>
		</td>
		<?php
		}
		?>
		</table>
		</div>
		</center>
		<?php include 'template/footer.php'; ?>
		</body>
		</html>
		<?php
	}
	else
	{
		?>
		<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BEST SEEDLINGS </title>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.min.js"></script>

		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		</head>
		<body>
		<?php include 'template/header.php'; ?>
		<br><br>
		<div class="container">
		<div class="row col-md-12">
			<div class="col-md-6">
				<form method="post">
					<input type="text" name="item" placeholder="Search Item Name" class="form-control">
					<input type="submit" name="search" value="search" class="btn btn-primary">
				</form>
			</div>
			<div class="col-md-6 pull-right">
				<a href="http://www.facebook.com" target="_blank"><img src="images/facebook.png" height="25" /></a>&nbsp;&nbsp;
				<a href="http://www.twitter.com" target="_blank"><img src="images/twitter.png" height="25" /></a>&nbsp;&nbsp;
				<a href="http://www.linkedin.com" target="_blank"><img src="images/linkedin.png" height="25" /></a>&nbsp;&nbsp;
				<a href="http://www.googleplus.com" target="_blank"><img src="images/googleplus.png" height="25" /></a>
			</div>
			
		</div>
		
		<h3>Click on the images below for a better view.</h3>
		<hr>

		<?php

		$conn = mysqli_connect("localhost","root","") or die('cannot connect to the server'); 
		mysqli_select_db($conn, "besttreeseedlings") or die('database selection problem');
		$sql="select a.seedname,a.price,b.* from seedlingsdetails a,picturedetails b where a.seedid=b.seedid";
		$result_set=mysqli_query($conn, $sql) or die(mysqli_error());
		$rowsnum =mysqli_num_rows($result_set);

		$data = array();
		?>
		<div class="col-md-12">
		<?php
		while($row=mysqli_fetch_array($result_set))
		{
			?>
			<div class="col-md-3"><div><b>Seedling Name:</b> <?php echo $row['seedname']; ?></div>
			<div><a href="login.php?pictureid=<?php echo $row['pictureid']; ?>"><img src="admin/uploads/<?php echo $row['pname']; ?>" alt="Resized Image"></a></div>
			<div><b>Price:</b> <?php echo $row['price']; ?></div>
			</div>
			<?php
		}
		?>
		</div>
		<hr>
		&nbsp;
		</div>
		</center>
		<?php include 'template/footer.php'; ?>
		</body>
		</html>
		<?php
	}
?>