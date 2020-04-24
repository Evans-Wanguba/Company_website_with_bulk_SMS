<?php

require_once 'database/topfile.php';

?>
<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8">
<title>Users | OneplaceSMS</title>
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

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

          <li class="index.php"> <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li > <a href="all-contacts.php"><i class="fa fa-book"></i> Contacts</a></li>

		      <li > <a href="all-groups.php"><i class="fa fa-groups"></i> Groups</a></li>
          
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
          $cusers = mysql_query("SELECT * FROM `sms_users` order by id DESC");
            if(mysql_num_rows($cusers)==0)
            {
        ?>
          <div style="border:1px dotted orange; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:orange; ">You have no users yet. Click on + sign on the right to add</font>
              <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
            </div>
            <p align="center" class="mt50" style="font-size:36px;opacity:0.1;">I'm a lumberjack and its ok, I sleep all <br>night and I work all day</p>
            <?php
            }else{
            ?>
            <div style="border:1px dotted #dcdcdc; padding:15px; border-radius:1px;">
              <font style="font-size:22px; color:#dcdcdc; "><?php echo mysql_num_rows($cusers); ?> Contacts</font>
              <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg" class="pull-right" style="font-size:22px;"><i class="fa fa-plus"></i></a>
            </div>
            <table class="table table-striped mt20">
              <tbody>
                <tr style="background-color:#00ccff; color:white;">
                  <th>Username</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
        <?php
              while($adata = mysql_fetch_array($cusers)){
                $aid                = $adata['id'];
                $auser              = $adata['username'];
                $aemail             = $adata['email'];
                $aphone             = $adata['phone'];
                $adate              = $adata['date'];

                $openmsg            = $adata['open_msg'];
                $grpmsg             = $adata['group_msg'];
                $broadcastmsg       = $adata['broadcast_msg'];
                $credit_permit      = $adata['credit_permit'];
                $contact_permit     = $adata['contact_permit'];
                $group_msg          = $adata['group_permit'];
                $view_logs          = $adata['view_logs'];
                $remove_cg          = $adata['remove_group_contact'];

        ?>
                <tr>
                  <td><?php echo $auser; ?></td>
                  <td><?php echo $aemail; ?></td>
                  <td><?php echo $aphone; ?></td>
                  <td><?php echo $adate; ?></td>
                  <td>
                  <?php if($aid > 1){ ?>
                    <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $aid; ?>" title="Edit" ><i style="color:#00ccff;" class="fa fa-pencil"></i></a> 
                    <a href="#" data-toggle="modal" data-target="#delete<?php echo $aid; ?>" title="Remove"><i style="color:brown;" class="fa fa-remove"></i></a>
                  <?php } ?> 
                  </td>
                </tr> 

             <!--#----------------------------------------------------------
              SEND INLINE MESSAGE MODAL
            ----------------------------------------------------------####-->
            <div class="modal fade mt100" id="delete<?php echo $aid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete <?php echo $auser; ?> (<?php echo $aemail; ?>)</h4>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete <?php echo $auser; ?> ? <br>               
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                    <a href="database/delete-contact.php?contactreference=<?php echo $aid; ?>" type="button" id="sendopenmessage" class="btn btn-danger">Yes, Delete</a>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal -->
            <div class="modal fade bs-example-modal-lg<?php echo $aid; ?> mt100" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?php echo $auser; ?></h4>
                  </div>
                  <div class="modal-body col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email" accesskey="E">Email</label>
                            <input name="email" disabled="1" type="email" id="euemail<?php echo $aid; ?>" value="<?php echo $aemail; ?>" class="form-control" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="username" accesskey="E">Username</label>
                            <input name="username" disabled="1" type="text" id="euusername<?php echo $aid; ?>" value="<?php echo $auser; ?>" class="form-control" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <label for="phone" accesskey="E">Phone</label>
                            <input name="phone" type="text" id="euphone<?php echo $aid; ?>" value="<?php echo $aphone; ?>" class="form-control" placeholder="Phone" />
                        </div>
                        <div class="form-group">
                            <label for="password" accesskey="E">Password</label>
                            <input disabled="true" name="password" type="password" id="eupassword<?php echo $aid; ?>" value="********" class="form-control" placeholder="Password" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username" accesskey="E">Send Open Message</label>

                            <select name="subject" id="euopenmessage<?php echo $aid; ?>" class="form-control">
                              <?php if($openmsg ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="username" accesskey="E">Send Group Message</label>
                             <select name="subject" id="eugroupmessage<?php echo $aid; ?>" class="form-control">
                              <?php if($grpmsg ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username" accesskey="E">Send Broadcast Message</label>
                            <select name="subject" id="eubroadcast<?php echo $aid; ?>" class="form-control">
                              <?php if($broadcastmsg ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username" accesskey="E">View Logs</label>
                             <select name="subject" id="euviewlogs<?php echo $aid; ?>" class="form-control">
                              <?php if($view_logs ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username" accesskey="E">Add Contacts</label>
                             <select name="subject" id="euaddcontact<?php echo $aid; ?>" class="form-control">
                              <?php if($contact_permit ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username" accesskey="E">Add Groups</label>
                             <select name="subject" id="euaddgroup<?php echo $aid; ?>" class="form-control">
                              <?php if($group_permit ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username" accesskey="E">Remove Contacts/Groups</label>
                             <select name="subject" id="euremovecg<?php echo $aid; ?>" class="form-control">
                              <?php if($remove_cg ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username" accesskey="E">View Credit Balance</label>
                             <select name="subject" id="euviewcredits<?php echo $aid; ?>" class="form-control">
                              <?php if($credit_permit ==1){ ?>
                              <option value="<?php echo "1"; ?>"><?php echo "Yes"; ?></option>
                              <option value="2">No</option>
                              <?php }else{ ?>
                              <option value="<?php echo "2"; ?>"><?php echo "No"; ?></option>
                              <option value="1">Yes</option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>

                  </div>

                   <div class="modal-body col-md-12">
                      <div id="adduserresp<?php echo $aid; ?>"></div>
                   </div>

                  <div class="modal-footer" id="userfoot">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a type="button" value="<?php echo $aid; ?>" id="adduser<?php echo $aid; ?>" class="btn btn-primary">Update</a>
                  </div>
                </div>
              </div>
            </div>

          <?php } } ?>
            
              </tbody>
            </table>
                
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
        <h4 class="modal-title" id="myModalLabel">New User</h4>
      </div>
      <div class="modal-body col-md-12">
        <div class="col-md-4">
            <div class="form-group">
                <label for="email" accesskey="E">Email</label>
                <input name="email" type="email" id="uemail" value="" class="form-control" placeholder="Email" />
            </div>
            <div class="form-group">
                <label for="username" accesskey="E">Username</label>
                <input name="username" type="text" id="uusername" value="" class="form-control" placeholder="Username" />
            </div>
            <div class="form-group">
                <label for="phone" accesskey="E">Phone</label>
                <input name="phone" type="text" id="uphone" value="" class="form-control" placeholder="Phone" />
            </div>
            <div class="form-group">
                <label for="password" accesskey="E">Password</label>
                <input name="password" type="password" id="upassword" value="" class="form-control" placeholder="Password" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="username" accesskey="E">Send Open Message</label>
                <select name="subject" id="uopenmessage" class="form-control">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username" accesskey="E">Send Group Message</label>
                <select name="subject" id="ugroupmessage" class="form-control">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username" accesskey="E">Send Broadcast Message</label>
                <select name="subject" id="ubroadcast" class="form-control">
                  <option value="1">Yes</option>                  
                  <option value="2">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username" accesskey="E">View Logs</label>
                <select name="subject" id="uviewlogs" class="form-control">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="username" accesskey="E">Add Contacts</label>
                <select name="subject" id="uaddcontact" class="form-control">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username" accesskey="E">Add Groups</label>
                <select name="subject" id="uaddgroup" class="form-control">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username" accesskey="E">Remove Contacts/Groups</label>
                <select name="subject" id="uremovecg" class="form-control">
                  <option value="1">Yes</option>                  
                  <option value="2">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username" accesskey="E">View Credit Balance</label>
                <select name="subject" id="uviewcredits" class="form-control">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
            </div>
        </div>

      </div>

       <div class="modal-body col-md-12">
          <div id="adduserresp"></div>
       </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="adduser" class="btn btn-primary">Add User</button>
      </div>
    </div>
  </div>
</div>

<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

</body>

</html>