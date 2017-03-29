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
      <?php
        include("includes/admin_header.php");
      ?>

        <div class="container">
			<div class="row">    			
				<div class="col s12"><br/>
					<h3 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Printers</h3>
					<input type='text' name='search' id='search' placeholder='Search for a printer by name...'/><button type='button' class='waves-effect waves-light btn' name='search_btn' id='search_btn' onclick="do_printer_search()">Search</button>
					<div id="paste_printers">
					
					</div>
				</div>            
			</div>
    
        
        </div>
		    <div id="delete_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete printer
                    </h5>
                    <p>
						Do you really want to delete this printer ?
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn"></span>
                </div>
                    </form>
            </div>		    
			<div id="view_location_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        View location
                    </h5>
                    <p id="paste_location">
						
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Close</button>
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
			get_printers_view();
		})

      </script>
    </body>
  </html>
