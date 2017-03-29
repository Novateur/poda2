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
				<div class="col s2">
				<h1></h1>
				</div>			
				<div class="col s8"><br/>
					<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Add your office locations</h4>
					<div class="col s12" style="background-color:#f3d9da;font-size:16px;border-radius:3px;padding:10px;color:#963539">Kindly add all your office locations across Nigeria</div>
					<div id="response_msg"></div>
					<div class="col s12">
							<?php
								get_company_locations();
							?>
					</div>
					<form id="add_location">
						<div class="input-field col s6">
							<select id="state" class="browser-default" name="state" onchange="get_cities(this.value)">
								<?php
									get_all_states();
								?>
							</select>
						</div>
						<div class="input-field col s6">
							<select class="browser-default" id="city"name="city">
								<option value="">--Choose city--</option>
							</select>
						</div>						
						<div class="input-field col s10">
							<textarea rows="7" name="addr" id="addr" placeholder="Type your office address..."></textarea>
						</div>					
						<div class="input-field col s2">
							<button type="submit" class="waves-effect waves-light btn">Add</button>
						</div>
					</form>					
				</div>            
				<div class="col s2"></div>
			</div>
    
        
        </div>
		    <div id="delete_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete location
                    </h5>
                    <p>
						Do you really want to delete this location ?
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn"></span>
                </div>
                    </form>
            </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="../inc/materialize/js/materialize.min.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
		
			function get_cities(val)
			{
				if(val=="")
				{
					$('#city').html("<option value=''>--Choose city--</option>");
				}
				else
				{
					$.post("../handler/get_cities.php",{state:val},function(response){
						$('#city').html(response);
					})
				}
			}
			$('#add_location').submit(function(e){
				e.preventDefault();
				var state,city,address;
				state = $('#state').val();
				city = $('#city').val();
				address = $('#addr').val();
				
				if(state=="" || city=="" || address=="")
				{
					if(address=="")
					{
						document.getElementById("addr").style.border="1px solid red";
					}					
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
						url:"../handler/add_locations.php",
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
								location.reload(true);
								//Materialize.toast("hello world",5000);
							}
							else
							{
								$('#response_msg').html("Error: We could not add the city");
							}
						}
					})
				}
			})
			function delete_location(id)
			{
				$('#paste_btn').html("<button type='button' onclick=\"cont_del("+id+")\">Ok</button>");
				$('#delete_modal').openModal();
			}
			function cont_del(id)
			{
				$.post("../handler/delete_location.php",{id:id},function(response){
					if(response=="deleted")
					{
						location.reload(true);
					}
					else
					{
						$('#delete_modal').closeModal();
						$('#response_msg').html("Oops an error occured");
					}
				})
			}
      </script>
    </body>
  </html>
