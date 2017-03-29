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
				<div class="col l12"><br/>
					<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Assigned orders</h4>
					<div id="paste_assigned_orders">

					</div>
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
			<div id="design_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        View designs
                    </h5>
					<p id="design_response"></p>
                    <p id="paste_designs">
						
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                </div>
            </div>
			<div id="update_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Update progress
                    </h5>
                    <p>
						<label>Update progress level</label><br/><br/>
					 <form id="update_form">
						<select class="browser-default" name="progress" id="progress">
							<option value="">--Choose your progress stage--</option>
							<option value='initiated'>Initiated</option>
							<option value='in progress'>In progress</option>
							<option value='finished'>Finished</option>
							<option value='cancelled'>Cancelled</option>
							<option value='failed'>Failed</option>
						</select>
						<input type="hidden" id="assigned_id" name="assigned_id"/>
						<input type="hidden" id="assigned_page" name="assigned_page"/>
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn"><button type="submit">Ok</button></span>
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
			get_assigned_orders_printer();
		})

      </script>
    </body>
  </html>
