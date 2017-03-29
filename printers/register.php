<?php
	require_once("../includes/functions.php");
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../inc/materialize/css/materialize.css"  media="screen,projection"/>
	  <link type="text/css" rel="stylesheet" href="../css/font-awesome.css"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
    </head>

    <body >
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo">Logo</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
<!--                        <li><a href="view.php">View Order</a></li>-->
<!--                        <li><a href="design.php">Design</a></li>-->
                        <li><a href="login.php"><i class="fa fa-sign-out"></i> Login</a></li>
                  </ul>
            </div>
        </nav>
            <div class="container">
                <div class="row">
					<div class="col s2"><h1></h1></div>
					<div class="col s8">
						<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Create account</h4>
						<form id="reg_press">
							<div class="row">
								<div class="input-field col s12">
									<div id="response_msg"></div>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="company_name" type="text" class="validate" name="company_name">
									<label class="" for="company_name">Company/Press Name</label> <!--make autocomplete-->
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
								  <input id="phone" type="text" class="validate" name="phone">
								  <label for="email">Telephone</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
								  <input id="email" type="email" class="validate" name="email">
								  <label for="email">Email</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
								  <input id="password" type="password" class="validate" name="password">
								  <label for="email">Password</label>
								</div>
							</div>						
	   
							<div class="row">
								<div class="input-field col s12">
									<button id="submit" type="submit" class="waves-effect waves-light btn">Register</button>
								</div>
							</div>							
							<div class="row">
								<div class="col s12">
									<p>Already have an account?, Click here to <a href="login.php">Login</a></p>
								</div>
							</div>
						</form>
					</div>
					<div class="col s2"></div>
                </div>
            </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="../inc/materialize/js/materialize.min.js"></script>
        <script>
			$(document).ready(function(){
				$('select').material_select();
			});
            
		$('#reg_press').submit(function(e){
			e.preventDefault();
			var company,phone,email,password;
			company = $('#company_name').val();
			phone = $('#phone').val();
			email = $('#email').val();
			password = $('#password').val();
			if(company=="" || phone=="" || email=="" || password=="")
			{
				if(company=="")
				{
					document.getElementById("company_name").style.border="1px solid red";
				}				
				if(phone=="")
				{
					document.getElementById("phone").style.border="1px solid red";
				}				
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
					url:"handler/register.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						//alert(data);
						if(data=="added")
						{	
							location.assign("welcome.php");
						}
						else if(data=="error")
						{
							$('#response_msg').html("Error: An error occured while adding the new printer");
						}
						else
						{
							$('#response_msg').html(data);
						}
					}
				})
			}
		})

        </script>
    </body>
  </html>