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
      <link type="text/css" rel="stylesheet" href="css/font-awesome.css"/>

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
				<div class="col s8"><br/>
					<div class="col s12"><h4 style="text-align:center">Welcome <?php echo get_company_name()?></h4></div><br/>
					<div class="col s12"><h5>Add your office locations</h5></div>
					<div class="col s12" style="color:green">Kindly add all your office locations across Nigeria</div>
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
							<textarea rows="7" name="addr" id="addr" placeholder="Address..."></textarea>
						</div>					
						<div class="input-field col s2">
							<button type="submit" class="waves-effect waves-light btn">Add</button>
						</div>
					</form>					
					<div class="input-field col s12">
						<?php
							if(confirm_registration())
							{
								echo "<a href='printer_welcome.php' id='proceed' data-role='button' class='waves-effect waves-light btn'>Proceed</a>";
							}
						?>
					</div>
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
      <script type="text/javascript" src="inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="inc/materialize/js/materialize.min.js"></script>
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
					$.post("handler/get_cities.php",{state:val},function(response){
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
						url:"handler/add_locations.php",
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
				$.post("handler/delete_location.php",{id:id},function(response){
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
