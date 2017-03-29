<?php
	ob_start();
    include 'wcaccess.php';
	require_once("includes/db.inc");
	require_once("includes/functions.php");
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);
?>
<!DOCTYPE html>
  <html>
    <head>
        <title>View Order</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="inc/materialize/css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>        
    </head>
    <body>
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo">Logo</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="index.php">Timeline</a></li>
<!--                        <li class="active"><a href="view.php">View Order</a></li>-->
<!--                        <li><a href="design.php">Design</a></li>-->
                        <li><a href="register.php">Register</a></li>
                  </ul>
            </div>
        </nav>

        <div class="container">
			<div class="row">    
				<div class="col s2">
				<h1></h1>
				</div>			
				<div class="col s8">
					<h3>Add city/location point</h3>
					<div id="response_msg"></div>
					<form id="add_city_form">
						<label>City</label><br/>
						<input type="text" name="city" id="city" placeholder="City"/><br/>
						<label>State</label><br/>
						<select class="browser-default" id="state" name="state">
								<?php
									get_all_states();
								?>
						</select><br/>
						<button type="submit" name="submit" id="submit" class="waves-effect waves-light btn">Save</button>
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
		
		$('#add_city_form').submit(function(e){
			e.preventDefault();
			var state,city;
			state = $('#state').val();
			city = $('#city').val();
			if(state=="" || city=="")
			{
				if(state=="")
				{
					document.getElementById("state").style.border="1px solid red";
				}				
				if(city=="")
				{
					document.getElementById("city").style.border="1px solid red";
				}
			}
			else
			{
				$.ajax({
					url:"handler/add_city.php",
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
							$('#state').val("");
							$('#city').val("");
							$('#response_msg').html("City has been added successfully");
						}
						else
						{
							$('#response_msg').html("Error: We could not add the city");
						}
					}
				})
			}
		})
      </script>
    </body>
  </html>
