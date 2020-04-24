<?php
require_once 'database/topfile.php';
if(!isset($_GET['groupId']))
{
header('location:all-groups.php');
}

if($group_permit > 1){
  header('location:all-groups.php');
}


if(isset($_GET['groupId'])) 
{
  $groupId = mysql_real_escape_string($_GET['groupId']);

  $group_data = mysql_query("SELECT * FROM `sms_groups` WHERE `id`='$groupId'");

    if(mysql_num_rows($group_data)==0){
        header('location:all-groups.php');
    }else{
    $datag = mysql_fetch_array($group_data);
      $gname = $datag['group_name'];
      $gby   = $datag['created_by'];
      $gdate = $datag['date'];
  }
}

?>
<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8">
<title>Groups | OneplaceSMS</title>
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

          <li> <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li > <a href="all-contacts.php"><i class="fa fa-book"></i> Contacts</a></li>

          <li class="active"> <a href="all-groups.php"><i class="fa fa-group"></i> Groups</a></li>
          
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

<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<div class="container">
  <div class="row"> 
    <section class="room-slider standard-slider mt50">

      <div class="col-sm-12 col-md-8">
        <?php
        $groupcontacts = mysql_query("SELECT * FROM `sms_group_members` WHERE `group`='$groupId' order by id DESC");
        if($group_permit ==1)
        {

        ?>
        <div style="padding:15px;">
            <h2><?php echo $gname; ?></h2>
            <font style="color:#dcdcdc">Created by <b><?php echo $gby; ?></b> on <b><i><?php echo $gdate; ?></i></b></font>
            <?php if(mysql_num_rows($groupcontacts) > 0){ ?>
            <a href="#" data-toggle="modal" title="SMS Group" data-target="#smsgroup" class="pull-right" style="font-size:22px;"><i class="fa fa-envelope"></i></a>
            <?php } ?>
        </div>
        <?php    
            if(mysql_num_rows($groupcontacts)==0)
            {
        ?>

          <div style="border:1px dotted orange; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:orange; ">No members. Click on + sign on the right to add</font>
              <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
          </div>
          <p align="center" class="mt50" style="font-size:36px;opacity:0.1;">I'm a lumberjack and its ok, I sleep all <br>night and I work all day</p>
            <?php
            }else{
            ?>
            <div style="border:1px dotted #dcdcdc; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:#dcdcdc; "><?php echo mysql_num_rows($groupcontacts); ?> Members</font>
              <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
            </div>
            <table class="table table-striped mt20">
              <tbody>
                <tr style="background-color:#00ccff; color:white;">
                  <th>Member Name</th>
                  <th>Added By</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
            <?php
              while($gmdata = mysql_fetch_array($groupcontacts)){                
                    $member       = $gmdata['member'];
                    $added_by     = $gmdata['added_by'];
                    $added_date   = $gmdata['date'];
                    $memberid     = $gmdata['id'];

                    $member_data = mysql_query("SELECT * FROM `sms_contacts` WHERE `id`='$member'");
                      $mdata = mysql_fetch_array($member_data);
                        $member_name  = $mdata['contact_name'];
                        $member_no    = $mdata['phone_number'];
                        $organization = $mdata['organization'];  
                        $dmid         = $mdata['id'];          
            ?>
                <tr>
                  <td><?php echo $member_name; ?> (<?php echo $member_no; ?>)</td>
                  <td><?php echo $added_by; ?></td>
                  <td><?php echo $added_date; ?></td>
                  <td>
            <?php if($remove_group_contact ==1){ ?>
                    <a href="#" data-toggle="modal" data-target="#deletegm<?php echo $memberid; ?>" title="Remove"><i style="color:brown;" class="fa fa-remove"></i></a> 
            <?php } ?>
                  </td>
                </tr>

             <!--#----------------------------------------------------------
              REMOVE USER FROM GROUP
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="deletegm<?php echo $memberid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Remove <?php echo $member_name; ?></h4>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to remove <?php echo $member_name; ?> from <?php echo $gname; ?> ? <br> 
                    <p style="color:orange;">The user will stop receiving group notifications</p>            
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                    <a href="database/delete-user-from-group.php?userReference=<?php echo $dmid; ?>&&groupReference=<?php echo $groupId; ?>" type="button" id="sendopenmessage" class="btn btn-danger">Yes, Delete</a>
                  </div>
                </div>
              </div>
            </div>


            <?php } } ?>
            
              </tbody>
            </table>
            <?php 
            }else if($group_permit == 2){ 
            ?>
          <div style="border:1px dotted brown; padding:15px; border-radius:1px; text-align:center;">
              <font style="font-size:22px; color:brown; "><i class="fa fa-lock"></i> Sorry, this page is restricted</font>
            </div>
            <p align="center" class="mt50" style="font-size:36px;opacity:0.1;">I'm a lumberjack and its ok, I sleep all <br>night and I work all day</p>
        <?php
        } 
        ?>
            
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

<!-- Modal -->
<div class="modal fade bs-example-modal-lg mt100" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Group Members</h4>
      </div>
      <div class="modal-body col-md-12">
      <?php
            $add = mysql_query("SELECT * FROM `sms_contacts` order by contact_name DESC");
              while($dAdd = mysql_fetch_array($add)){
                  $cid = $dAdd['id'];

                  $linkToGroup = mysql_query("SELECT * FROM `sms_group_members` WHERE `member`='$cid' && `group`='$groupId'");
                  if(mysql_num_rows($linkToGroup) == 0){
                      #PICK TO ADD DATA
                      $addName   = $dAdd['contact_name'];
                      $addphone  = $dAdd['phone_number'];
                      $addorg    = $dAdd['organization'];
          ?>
        <div class="col-md-6">
            <div class="form-group">
                <input type="checkbox" value="<?php echo $cid; ?>" class="checkBoxClass" /> 
                <?php echo $addName." (".$addphone.") <font style='color:#88D9E3;'> ".$addorg."</font>"; ?>
            </div>
                <input type="hidden" id="thisgroup" value="<?php echo $groupId; ?>"/>
        </div>
        <?php 

        }
        } 

        ?>
      </div>
      <div class="modal-body col-md-12">
        <div id="addtoresp"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="addtgroup" class="btn btn-primary">Add Members</button>
      </div>
    </div>
  </div>
</div>


 <!-- Modal -->
        <div class="modal fade mt100" id="smsgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">SMS <?php echo $gname; ?></h4>
              </div>
              <div class="modal-body">

                <div class="form-group">
                    <label for="phonenumber" accesskey="E">Message</label>
                    <textarea name="message" id="vmessage" class="form-control" placeholder="Please enter message"></textarea>
                    <input type="hidden" id="vgroupno" value="<?php echo $groupId; ?>">
                </div>

                <div id="vresp"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="vgroup" class="btn btn-primary">Send Group Message</button>
              </div>
            </div>
          </div>
        </div>

<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>



</body>

</html>