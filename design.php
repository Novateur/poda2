<?php
    include 'wcaccess.php';
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);
//
//        // Get the PHP helper library from twilio.com/docs/php/install
//            require('/services/Twilio.php'); // Loads the library
//            // Your Account Sid and Auth Token from twilio.com/user/account
//            $account_sid = 'ACd1075aeb55a161ac7e1e5c28468cbf18'; 
//            $auth_token = '3fb92f0007c07c1d3ced68f7ae8dbe9e'; 
//            $client = new Services_Twilio($sid, $token);
//            $sms = $client->account->sms_messages->create("+15005550006", "+14108675309", "All in the game, yo", array());
//            echo $sms->sid;

?>
<!DOCTYPE html>
  <html>
    <head>
        <title>Design Order</title>
      <!--Import Google Icon Font-->
      <link href="material-design-icons/iconfont/material-icons.css" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="inc/materialize/css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
    </head>
    <body>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo">Logo</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="index.php">Timeline</a></li>
<!--                        <li><a href="view.php">View Order</a></li>-->
<!--                        <li class="active"><a href="design.php">Design</a></li>-->
                        <li><a href="register.php">Register</a></li>
                  </ul>
            </div>
        </nav>
        
        <div class="row container" >
            <div class="col s6"><h1>Message Centre</h1></div>
            <div class="col s6">
                <h5>You are here: 
                    <a href="index.php" class="breadcrumb pink-text">Timeline</a>
                    <a href="view.php" class="breadcrumb pink-text">View order</a>
                    <a href="design.php" class="breadcrumb pink-text">Design</a>
                </h5>
            </div>
            <?php $orderNo = $_GET['OrderID'];?>
            <?php $item = $_GET['line_item'];?>
            <?php $customerDetails = $podaobj->customerDetails($orderNo);
            $customerName = $customerDetails[first_name]." ".$customerDetails[last_name];
            $bilAddress = $customerDetails[billing_address][address_1]." <br/>".$customerDetails[billing_address][address_2]." <br/>".$customerDetails[billing_address][city]." <br/>".$customerDetails[billing_address][state]." <br/>".$customerDetails[billing_address][country];
            $bilPhone = $customerDetails[billing_address][phone];
            $bilEmail = $customerDetails[billing_address][email];
            $shipAddress = $customerDetails[shipping_address][address_1]." <br/>".$customerDetails[shipping_address][address_2]." <br/>".$customerDetails[shipping_address][city]." <br/>".$customerDetails[shipping_address][state]." <br/>".$customerDetails[shipping_address][country];
            $shipPhone = $customerDetails[shipping_address][email];
            $shipEmail = $customerDetails[shipping_address][email];
            ?>
            <?php $orderDetails = $podaobj->viewOrder($orderNo);?>
                <div class="col s4"><label>Order Number: <?php echo $orderNo ?></label></div>
                <div class="col s4"><label>Order By: <?php echo $customerName; ?></label></div>
                <div class="col s4"><label>Item under design: <?php echo $item; ?></label></div>
        </div>
        
               
        <div class="row container">
            <div class="col s12 card-pane1 grey lighten-2">
                <h5 class=""><?php echo $customerName; ?></h5>
                <span class="">Last Message: Tues, January 29 2016</span>
            </div>
        </div>  
         <div class="row container">
             <div class="col s10 card-panel">
                 <p class="pink-text">This is a simple text message that is to be sent</p>
             </div>
             <div class="col s2 card-panel">
                 <p class="right-align">12:00AM</p>
             </div>
        </div>
        <div class="row container">
            <form class="col s9">
              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">mode_edit</i>
                  <textarea name="smsmsg" id="icon_prefix2" class="materialize-textarea" length="150">Hi <?php echo $customerName.", "?></textarea>
                  <label for="icon_prefix2">Message</label>
                </div>
              </div>
            </form>
            <div class="col s1">
                <br/><br/>
<!--                <a class="btn-floating blue"><i class="material-icons">attach_file</i></a>-->
            </div>
            <div class="col s2">
                <br/><br/>
                <button id="smsbtn" type="button" class="waves-effect waves-light btn-large">Send SMS<i class="material-icons right">send</i></button>
            
            </div>
            <script>
                jQuery('#smsbtn').click(function() {
                alert(  $("#icon_prefix2").val()  );
            });
            </script>
        </div>        
        <hr/ class="container">
        <div class="row container">
            <div class="col s4">
              <h5>Billing Details</h5>
                  <label>Address: </label><span><?php echo $bilAddress; ?></span><br/>
            </div>
            <div class="col s4">
              <h5>Shipping Details</h5> 
                  <label>Address: </label><span><?php echo $shipAddress; ?></span><br/>
            </div>
            <div class="col s4">
              <h5>Contact Details</h5> 
                <p>Billing Contact</p>
                  <label>Email: </label><span><?php echo $bilEmail; ?></span><br/>
                  <label>Phone Number: </label><span><?php echo $bilPhone; ?></span><br/> 
                <p>Shipping Contact</p>
                  <label>Email: </label><span><?php echo $shipEmail; ?></span><br/>
                  <label>Phone Number: </label><span><?php echo $shipPhone; ?></span><br/> 
            </div>
        
        </div>
    </body>
  </html>
