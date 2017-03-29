<?php
	ob_start();
    include 'wcaccess.php';
	require_once("includes/db.inc");
	require_once("includes/functions.php");
?>
<!DOCTYPE html>
  <html>
    <head>
        <title>Admin Login</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="inc/materialize/css/materialize.css"  media="screen,projection"/>
	  <link type="text/css" rel="stylesheet" href="css/font-awesome.css"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>        
    </head>
    <body>
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo">Logo</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">

                  </ul>
            </div>
        </nav>

        <div class="container">
			<div class="row">    
				<div class="col s2">
				<h1></h1>
				</div>			
				<div class="col s8"><br/>

					<form method="post" action="">
						<div class="input-field col s12">
							<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d"><i class="fa fa-cog"></i> Admin Login</h4>
							<div id="response_msg"></div>
							<?php
								if(isset($_POST['submit']))
								{
									if($_POST['email']=="admin@poda.ng" && $_POST['password']=="poda")
									{
										$_SESSION['admin'] = "Admin";
										header("location:welcome.php");
									}
									else
									{
										echo "<div style='background-color:#f3d9da;font-size:16px;border-radius:3px;padding:10px;color:#963539'>Invalid Username/Password Combination</div><br/>";
									}
								}
							?>
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
							<button id="submit" type="submit" name="submit" class="waves-effect waves-light btn">Login</button>
						</div>
					</form>
				</div>            
				<div class="col s2"></div>
			</div>
    
        
        </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="inc/materialize/js/materialize.min.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
      </script>
    </body>
  </html>
