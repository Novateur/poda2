<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
?>
<!DOCTYPE html>
  <html>
    <head>
        <title>View Order</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../inc/materialize/css/materialize.css"  media="screen,projection"/>
	  <link type="text/css" rel="stylesheet" href="../css/font-awesome.css"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>        
    </head>
    <body>
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo">Logo</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
<!--                        <li class="active"><a href="view.php">View Order</a></li>-->
<!--                        <li><a href="design.php">Design</a></li>-->
                        <li><a href="register.php"><i class="fa fa-pencil"></i> Register</a></li>
                  </ul>
            </div>
        </nav>

        <div class="container">
			<div class="row">    
				<div class="col s2">
				<h1></h1>
				</div>			
				<div class="col s8"><br/>
					<form id="login_form">
					<div class="input-field col s12">
						<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Login into your account</h4>
						<div id="response_msg"></div>
					</div>
					<div class="input-field col s12">
                        <input id="email" type="email" class="validate" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12">
						<input id="password" type="password" class="validate" name="password">
						<label for="email">Password</label>
                    </div>                    
					<div class="input-field col s12">
						<button id="submit" type="submit" class="waves-effect waves-light btn">Login</button> | 
						<a href="#" onclick="$('#reset_modal').openModal()">forgot password?</a>
                    </div>
					</form>
					<div class="input-field col s12">
						<p>If you don't have an account, click here to <a href="register.php">Register</a>
						
                    </div>
				</div>            
				<div class="col s2"></div>
			</div>
    
        
        </div>
		    <div id="reset_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Password reset
                    </h5><br/>
                    <p>
						<div id="reset_msg"></div>
						<div class="input-field col s12">
							<input id="reset_email" type="email" class="validate" name="reset_email">
							<label for="email">Registered Email address</label>
						</div>
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <button type="button" class="waves-effect waves btn-flat" onclick="reset_email()">Continue</button>
                </div>
                    </form>
            </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="../inc/materialize/js/materialize.min.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
		
		function reset_email()
		{
			var email = $('#reset_email').val();
			if(email=="")
			{
				document.getElementById("reset_email").style.border="1px solid red";
			}
			else
			{
				$('#reset_msg').html("Sending your request...");
				$.post("handler/reset_password.php",{email:email},function(response){
					if(response=="reseted")
					{
						$('#reset_modal').closeModal();
						Materialize.toast("Your password has been changed, check your mail",8000);
						//$('#response_msg').htm("Your password has been changed successfully login to your email to view your new password");
					}
					else
					{
						$('#reset_msg').html(response);
					}
				})
			}
		}
		$('#login_form').submit(function(e){
			e.preventDefault();
			var email,password;
			email = $('#email').val();
			password = $('#password').val();
			
			if(email=="" || password=="")
			{
				if(email=="")
				{
					document.getElementById("email").style.border="1px solid red";
				}				
				if(password=="")
				{
					document.getElementById("password").style.border="1px solid red";
				}
			}
			else
			{
				$.ajax({
					url:"handler/login.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						//alert(data);
						if(data=="yes")
						{	
							location.replace("welcome.php");
							
						}
						else
						{
							//$('#response_msg').html("Invalid Username/Password combination");
							Materialize.toast("Invalid Username/Password combination",8000);
						}
					}
				})
			}
		})
      </script>
    </body>
  </html>
