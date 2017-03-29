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
					<h3>Add states</h3>
					<div id="response_msg"></div>
					<input type="text" name="add_state" id="add_state"/><br/>
					<button type="button" name="save" id="save" onclick="add_state()" class="waves-effect waves-light btn">Save</button>
				</div>            
				<div class="col s2"></div>
			</div>
			<div class="row">    
				<div class="col s2">
				<h1></h1>
				</div>			
				<div class="col s8">
					<h5>Or upload a csv file</h5>
					<?php
						if (isset($_POST['upload']))
						{
							if(!empty($_FILES['state']['tmp_name']))
							{
								if (is_uploaded_file($_FILES['state']['tmp_name']))
								{
									//echo "<h4>" . "File ". $_FILES['state']['name'] ." uploaded successfully." . "</h4>";
									//echo "<h2>Displaying contents:</h2>";
									//readfile($_FILES['state']['tmp_name']);
								}

								//Import uploaded file to Database
								echo " Already existing records: <br/>";
								$handle = fopen($_FILES['state']['tmp_name'], "r");

								while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
									if(!verify_state($data[0]))
									{
										$import="INSERT into states(states) values('$data[0]')";

										$connection->query($import); //or die(mysql_error());
									}
									else
									{
										echo $data[0]."<br/>";
									}
								}

								fclose($handle);

								print "Import done";

								//view upload form
							}
							else
							{
								echo "Select a csv file to upload";
							}
						}

					?>
					<form enctype='multipart/form-data' action='' method='post'>
						<div class="file-field input-field">
							<div class="btn">
								<span>File</span>
								<input type="file" name="state" id="state">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path" type="text">
							</div>
						</div><br/>
						<button type="submit" name="upload" id="upload" class="waves-effect waves-light btn">Upload</button>
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
		function add_state()
		{
			var state = $('#add_state').val();
			if(state=="")
			{
				document.getElementById("add_state").style.border="1px solid red";
			}
			else
			{
				$.post("handler/add_state.php",{state:state},function(response){
					if(response=="added")
					{
						$('#add_state').val("");
						$('#response_msg').html("You have successfully added a new state");
					}
					else
					{
						$('#response_msg').html(response);
					}
				})
			}
		}
      </script>
    </body>
  </html>
