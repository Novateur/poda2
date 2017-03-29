<?php
	ob_start();
    include 'wcaccess.php';
	require_once("includes/db.inc");
	require_once("includes/functions.php");
	
	if(!isset($_SESSION['admin']))
	{
		header("location:login.php");
	}
	
?>
<!DOCTYPE html>
  <html>
    <head>
        <title>Admin :: Dashboard</title>
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
                        <li><a href="welcome.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                  </ul>
            </div>
        </nav>

        <div class="container">
			<div class="row">    			
				<div class="col s12"><br/>
					<h4>Welcome <?php echo $_SESSION['admin']; ?></h4>
					  <a href='index.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-bar-chart"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Timeline</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>
					  <a href='view_assigned_orders.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-cog"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Orders</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>
					  <a href='view_printers.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-user"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Printers</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>
					  <a href='view_states.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-home"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>States</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>
					  <a href='view_cities.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-map-marker"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Cities</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>
					  <a href='#' onclick="alert('THE WEB PAGE IS STILL UNDER CONSTRUCTION, COMING SOON!!...')"><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-anchor"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>API Link</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>					  					  					  						  
					  <a href='logout.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-sign-out"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Logout</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>					  					  

				</div>            
			</div>
    
        
        </div>
		    <div id="delete_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete city
                    </h5>
                    <p>
						Do you really want to delete this city ?
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn"></span>
                </div>
                    </form>
            </div>			    
			<div id="multi_del_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete cities
                    </h5>
                    <p>
						Do you really want to perform a multiple delete action,once you proceed with this action
						there is no going back
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn_multi"></span>
                </div>
                    </form>
            </div>		    
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="inc/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="js/main.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
		
		$(document).ready(function(){
			get_cities();
		})

      </script>
    </body>
  </html>
