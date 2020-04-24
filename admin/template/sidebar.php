    
    <section id="reservation-form" class="mt50 clearfix">
      <div class="col-sm-12 col-md-4">
        <form class="reservation-vertical clearfix" role="form" method="post" name="reservationform" id="reservationform">
          <h2 class="lined-heading"><span>Dashboard</span></h2>
          <div class="price">

          <?php if($credit_permit == 1){ ?>

            <h4>Balance:</h4>
            <?php
                  require_once('database/topfile.php');
                  echo $bal;                  
            ?>
            <br>

            <span> <a href="#" data-toggle="modal" data-target="#topup"><i class="fa fa-plus"></i> top up</a></span></div>

          <?php } ?>

          <?php if($open_msg == 1){ ?>

          <a href="#" data-toggle="modal" data-target="#myModal" type="submit" class="btn btn-primary btn-block"><i class="fa fa-paper-plane"></i> Open Message</a><br>
          
          <?php } ?>

          <div style="border:1px dotted #dcdcdc; text-align:center; padding:10px; border-radius:1px;">
            <h4>Sender Id :<?php if($as_sender_id == ""){echo "SMSLEOPARD";}else{echo $as_sender_id;} ?></h4>
          </div>

        </form>

        <!-- Modal -->
        <div class="modal fade mt100" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Open Message</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="openphonenumber" accesskey="E">Phone Number</label>
                    <input name="openphonenumber" type="text" id="openphonenumber" value="" class="form-control" placeholder="Please enter phone number" />
                </div>
                <div class="form-group">
                    <label for="phonenumber" accesskey="E">Message</label>
                    <textarea name="message" id="openmessage" class="form-control" placeholder="Please enter message"></textarea>
                </div>
                <div id="openmessagetext"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="sendopenmessage" class="btn btn-primary">Send Message</button>
              </div>
            </div>
          </div>
        </div>

         <!-- Modal -->
        <div class="modal fade mt100" id="topup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">How to top up</h4>
              </div>
              <div class="modal-body">
                  1. Go to MPESA Menu<br>
                  2. Select Lipa Na MPESA Paybill<br>
                  3. Enter Business Number <b style="color:#80D7E1;">525900</b><br>
                  4. Enter Account Number <b style="color:#80D7E1;"><?php echo $as_username; ?>.api</b><br>
                  5. Enter Amount<br>
                  6. Enter MPESA PIN<br>
                  7. Send<br><br>
                  Incase of any problems, contact Africas Talking support team at <b>info@africastalking.com</b>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>