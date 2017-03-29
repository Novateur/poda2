<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	if(!isset($_SESSION['username']))
	{
		header("location:login.php");
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
				<div class="col l3"><h1></h1></div>
				<div class="col l6"><br/>
					<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Change Password</h4>
					<div>
						<?php
							if(isset($_POST['submit']))
							{
								echo "You're submitting ooo!!";
							}
						?>
						<form id="myForm" method="post" action="">
							<div id="change_pass_msg"></div><br/>
							<span style="font-size:18px">Current password</span><br/>
							<input type="password" name="current_pass" id="current_pass"/><br/>
							<span style="font-size:18px">New password</span><br/>
							<input type="password" name="new_pass" id="new_pass"/><br/>
							<span style="font-size:18px">Confirm new password</span><br/>
							<input type="password" name="con_new_pass" id="con_new_pass"/><br/>
							<button type="submit" name="submit" class="waves-effect waves-light btn">Submit</button>
						</form>
					</div>
				</div>
				<div class="col l3"></div>
			</div>
    
        
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
		$('#myForm').submit(function(e){
			e.preventDefault();
			var current_pass,new_pass,con_new_pass;
			current_pass = $('#current_pass').val();
			new_pass = $('#new_pass').val();
			con_new_pass = $('#con_new_pass').val();
			if(current_pass=="" || new_pass=="" || con_new_pass=="")
			{
				if(current_pass=="")
				{
					document.getElementById("current_pass").style.border="1px solid red";
				}				
				if(new_pass=="")
				{
					document.getElementById("new_pass").style.border="1px solid red";
				}				
				if(con_new_pass=="")
				{
					document.getElementById("con_new_pass").style.border="1px solid red";
				}
			}
			else
			{
				if(new_pass == con_new_pass)
				{
					$.ajax({
						url:"handler/change_password.php",
						type:"POST",
						data: new FormData(this),
						cache:false,
						contentType:false,
						processData:false,
						success:function(data)
						{
							if(data=="updated")
							{
								Materialize.toast("Your password has been changed successfully",8000);
							}
							else
							{
								Materialize.toast(data,8000);
							}
						}
					})
				}
				else
				{
					Materialize.toast("Password mismatched",5000);
				}
			}
		})
      </script>
    </body>
  </html>
