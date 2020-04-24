<?php
require_once 'database/topfile.php';
?>
<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8">
<title>Dashboard | OneplaceSMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="ico.png">

<!-- Stylesheets -->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" href="rs-plugin/css/settings.css">
<link rel="stylesheet" href="css/theme.css">
<link rel="stylesheet" href="css/colors/turquoise.css" id="switch_style">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,700">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Javascripts --> 
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="js/jquery.nicescroll.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script> 
<script type="text/javascript" src="js/jquery.forms.js"></script> 
<script type="text/javascript" src="js/switch.js"></script> 
<script type="text/javascript" src="js/custom.js"></script> 
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50960990-1', 'slashdown.nl');
  ga('send', 'pageview');
</script>
</head>

<body>

<!-- Header -->
<header>
  <!-- Navigation -->
  <div class="navbar yamm navbar-default" id="sticky">
    <div class="container">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="index.php" class="navbar-brand">         
        <!-- Logo -->
        <div id="logo"> <img id="default-logo" src="images/logo-2.png" alt="Starhotel" style="height:44px;"> </div>
        </a> </div>
      <div id="navbar-collapse-grid" class="navbar-collapse collapse">
        <ul class="nav navbar-nav"> 

          <li class="active"> <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li> <a href="all-contacts.php"><i class="fa fa-book"></i> Contacts</a></li>

          <li> <a href="all-groups.php"><i class="fa fa-group"></i> Groups</a></li>
          
          <li> <a href="message-logs.php"><i class="fa fa-file-text-o"></i> Message Logs</a></li>

          <?php if($level==1){ ?>

          <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated"><i class="fa fa-cogs"></i> Settings<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="manage-users.php">Manage Users</a></li>
              <li><a href="system-settings.php">System Settings</a></li>
              <li><a href="sms-settings.php">SMS Settings</a></li>
              <li><a href="admin-settings.php">Admin Settings</a></li>
            </ul>
          </li>

          <?php }else{ ?> 

          <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated"><i class="fa fa-cogs"></i> Settings<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="admin-settings.php">Profile Settings</a></li>
            </ul>
          </li>

          <?php } ?>

          <li> <a href="logout" style="color:brown;"><i class="fa fa-sign-out"></i> Logout</a></li>

        </ul>

      </div>
    </div>
  </div>
</header>

<!-- Parallax Effect -->
<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<div class="container">
  <div class="row"> 
    <!-- Slider -->
    <section class="room-slider standard-slider mt50">
      <div class="col-sm-12 col-md-8">
            
            <div class="col-md-12" style="text-align:center; color:#dcdcdc; padding:20px; border-radius:1px;">

              <a href="all-contacts.php" style="text-decoration:none;"><div class="col-md-4">
                <i class="fa fa-user" style="font-size:50px;"></i><br>
                <font style="font-size:15px;">Contacts </font>
              </div></a>
              <a href="all-groups.php" style="text-decoration:none;"><div class="col-md-4">
                <i class="fa fa-group" style="font-size:50px;"></i><br>
               <font style="font-size:15px;">Create Groups</font>
              </div></a>
              <a href="message-logs.php" style="text-decoration:none;"><div class="col-md-4">
                <i class="fa fa-file-text-o" style="font-size:50px;"></i><br>
                <font style="font-size:15px;">Message Logs</font>
              </div></a>

                <div style="clear:both; margin-bottom:20px;"></div>

              <a href="manage-users.php" style="text-decoration:none;"><div class="col-md-4">
                <i class="fa fa-user-plus" style="font-size:50px;"></i><br>
                <font style="font-size:15px;">Manage Users</font>
              </div></a>
              <a href="sms-settings.php" style="text-decoration:none;"><div class="col-md-4">
                <i class="fa fa-paper-plane" style="font-size:50px;"></i><br>
               <font style="font-size:15px;">SMS Settings</font>
              </div></a>
              <a href="admin-settings.php" style="text-decoration:none;"><div class="col-md-4">
                <i class="fa fa-cog" style="font-size:50px;"></i><br>
                <font style="font-size:15px;">Admin Settings</font>
              </div></a>
            </div>

            <?php if($mybalance <= $setminimum){ ?>
            <div class="col-md-12" style="color:#606060; text-align:center; padding:20px; border-radius:4px;">
                <div class="col-md-12">
                  <font style="color:orange; font-size:26px;">Your Credits Balance is going low</font><br><br>
                  <a href="#" data-toggle="modal" data-target="#topup" class="btn btn-default">Purchase Credits</a> 
                </div>
            </div> 
            <?php } ?>

      </div>
    </section>
    
    <!-- side -->
    <?php include_once 'side.php'; ?>
    
  </div>
</div>



<!-- Footer -->
<footer>
 
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-6"> &copy; 2015 Oneplace Technologies LTD All Rights Reserved </div>
      </div>
    </div>
  </div>
</footer>


<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

</body>

</html>