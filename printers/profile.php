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
				<div class="col l2"><h1></h1></div>
				<div class="col l8"><br/>
					<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Company Details</h4>
					<div>
						<?php
							if(isset($_POST['submit']))
							{
								$name = sanitize($_POST['company_name']);
								$telephone = sanitize($_POST['telephone']);
								$email = sanitize($_POST['email']);
								if($name=="" || $telephone=="" || $email=="")
								{
									echo "All fileds are required";
								}
								else
								{
									$sql = "UPDATE printers SET company_name='{$name}',telephone='{$telephone}',email='{$email}' WHERE email='{$_SESSION['username']}'";
									$query = $connection->query($sql);
									if($query)
									{
										echo "<div style='background-color:#f3d9da;font-size:16px;border-radius:3px;padding:10px;color:#963539'>Records updated successfully</div><br/>";
									}
								}
							}
							get_printer_profile();
						?>
					</div>
				</div>
				<div class="col l2"></div>
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
