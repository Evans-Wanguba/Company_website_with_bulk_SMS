<?php
$permit = "";
require_once 'database/topfile.php';
if(isset($_GET['permit']) && ($_GET['permit']=='null')){
$permit = "<p style='color:orange'>Sorry, you dont have permission to delete contacts</font>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8">
<title>Contacts | OneplaceSMS</title>
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

          <li class="active"> <a href="all-contacts.php"><i class="fa fa-book"></i> Contacts</a></li>

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

<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<div class="container">
  <div class="row"> 
    <section class="room-slider standard-slider mt50">

      <div class="col-sm-12 col-md-8">
        <?php
        if($contact_permit ==1)
        {
          $clogs = mysql_query("SELECT * FROM `sms_contacts` order by id DESC");
            if(mysql_num_rows($clogs)==0)
            {
        ?>
          <div style="border:1px dotted orange; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:orange; ">You have no contacts. Click on + sign on the right to add</font>
              <a href="#" data-toggle="modal" data-target="#addcontact" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
          </div>
          <p align="center" class="mt50" style="font-size:36px;opacity:0.1;">I'm a lumberjack and its ok, I sleep all <br>night and I work all day</p>
            <?php
            }else{
            ?>
            <div style="border:1px dotted #dcdcdc; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:#dcdcdc; "><?php echo mysql_num_rows($clogs); ?> Contacts</font>
              <?php echo $permit; ?>
              <a href="#" data-toggle="modal" data-target="#addcontact" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
            </div>
            <table class="table table-striped mt20">
              <tbody>
                <tr style="background-color:#00ccff; color:white;">
                  <th>Name</th>
                  <th>Organization</th>
                  <th>Phone Number</th>
                  <th>Added By</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
            <?php
              while($cdata = mysql_fetch_array($clogs)){
                $cid                = $cdata['id'];
                $contact_name       = $cdata['contact_name'];
                $organization       = $cdata['organization'];
                $date               = $cdata['date'];
                $phone_number       = $cdata['phone_number'];
                $added_by           = $cdata['added_by'];
            ?>
                <tr>
                  <td><?php echo $contact_name; ?></td>
                  <td><?php echo $organization; ?></td>
                  <td><?php echo $phone_number; ?></td>
                  <td><?php echo $added_by; ?></td>
                  <td><?php echo $date; ?></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#edit<?php echo $cid; ?>" title="Edit" ><i style="color:#00ccff;" class="fa fa-pencil"></i></a> 
                    <a href="#" data-toggle="modal" data-target="#sendmessage<?php echo $cid; ?>" title="Quick Message"><i style="color:green;" class="fa fa-paper-plane"></i></a>
            <?php if($remove_group_contact ==1){ ?>
                    <a href="#" data-toggle="modal" data-target="#delete<?php echo $cid; ?>" title="Remove"><i style="color:brown;" class="fa fa-remove"></i></a> 
            <?php } ?>
                  </td>
                </tr>
            <!--#----------------------------------------------------------
              EDIT MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="edit<?php echo $cid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?php echo $contact_name; ?></h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="cname" accesskey="E">Name</label>
                        <input name="cname" type="text" id="cname<?php echo $cid; ?>" class="form-control" value="<?php echo $contact_name; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="corg" accesskey="E">Organization</label>
                        <input name="corg" type="text" id="corg<?php echo $cid; ?>" class="form-control" value="<?php echo $organization; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="cphone" accesskey="E">Phone Number</label>
                        <input name="cphone" type="text" id="cphone<?php echo $cid; ?>" class="form-control" value="<?php echo $phone_number; ?>"/>
                    </div>
                    <div id="cresp<?php echo $cid; ?>"></div>
                  </div>
                  <div class="modal-footer" id="footedit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="#" value="<?php echo $cid; ?>" type="button" id="cclick<?php echo $cid; ?>" class="btn btn-primary">Update </a>
                  </div>
                </div>
              </div>
            </div>

            <!--#----------------------------------------------------------
              SEND INLINE MESSAGE MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="sendmessage<?php echo $cid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">SMS <?php echo $contact_name; ?> (<?php echo $phone_number; ?>)</h4>
                  </div>
                  <div class="modal-body">
                        <input name="openphonenumber" type="hidden" id="inlineno<?php echo $cid; ?>" value="<?php echo $phone_number; ?>" class="form-control" placeholder="Please enter phone number" />
                    <div class="form-group">
                        <label for="phonenumber" accesskey="E">Message</label>
                        <textarea name="message" id="inlinemsg<?php echo $cid; ?>" class="form-control" placeholder="Please enter message"></textarea>
                    </div>
                    <div id="inlinemessagetext<?php echo $cid; ?>"></div>
                  </div>
                  <div class="modal-footer" id="message">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="#" type="button" value="<?php echo $cid; ?>" id="sendinlinemsg<?php echo $cid; ?>" class="btn btn-primary">Send Message</a>
                  </div>
                </div>
              </div>
            </div>

             <!--#----------------------------------------------------------
              SEND INLINE MESSAGE MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="delete<?php echo $cid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete <?php echo $contact_name; ?> (<?php echo $phone_number; ?>)</h4>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete <?php echo $contact_name; ?> ? <br>
                    <p style="color:orange;"> Deleting will remove the contact from all active groups</p>                
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                    <a href="database/delete-contact.php?contactreference=<?php echo $cid; ?>" type="button" id="sendopenmessage" class="btn btn-danger">Yes, Delete</a>
                  </div>
                </div>
              </div>
            </div>


            <?php } } ?>
            
              </tbody>
            </table>
            <?php 
            }else if($contact_permit ==2){ 
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
<div class="modal fade mt100" id="addcontact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Contact</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="cname" accesskey="E">Name</label>
            <input name="cname" type="text" id="cname" value="" class="form-control" placeholder="Please enter contact name" />
        </div>
        <div class="form-group">
            <label for="corg" accesskey="E">Organization</label>
            <input name="corg" type="text" id="corg" value="" class="form-control" placeholder="Please enter contact organization"/>
        </div>
        <div class="form-group">
            <label for="cphone" accesskey="E">Phone Number</label>
            <input name="cphone" type="text" id="cphone" value="" class="form-control" placeholder="Please enter contact phone number"/>
        </div>
        <div id="cresp"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="cclick" class="btn btn-primary">Add Contact</button>
      </div>
    </div>
  </div>
</div>

<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

</body>

</html>