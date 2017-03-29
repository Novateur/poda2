<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	if(!isset($_SESSION['username']))
	{
		header("location:../login.php");
	}
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);
?>
<!DOCTYPE html>
	<?php
		include("../includes/printers_header.php");
	?>

        <div class="container">
			<div class="row">    			
				<div class="col s12"><br/>
					<h4>Welcome <?php echo get_company_name(); ?></h4>
					  <a href='add_location.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-map-marker"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Locations</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>					  					  					  
					  <a href='profile.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-user"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Profile</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>					  
					  <a href='view_orders.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-bar-chart"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>Orders</h5>
							  </span>
							</div>
						  </div>
						</div>
					  </div></a>					  
					  <a href='change_password.php'><div class="col s4">
						<div class="card-panel grey lighten-5 z-depth-1">
						  <div class="row valign-wrapper">
							<div class="col s2">
							  <h4><i class="fa fa-key"></i></h4> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="black-text">
								<h5>change password</h5>
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
      <script type="text/javascript" src="../inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="../inc/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/main.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
		
		$(document).ready(function(){
			get_cities();
		})

      </script>
    </body>
  </html>
