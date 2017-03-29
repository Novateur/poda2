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
					<h4 style="background-color:#b8f9bb;padding:10px;border-radius:3px;color:#4b784d">Assigned orders</h4>
				</div>
				<div class="col s4">
					<input type="text" name="search" id="search" placeholder="Search by product name or order number"/>
					<button type="button" id="search_btn" onclick="search_order()" class="waves-effect waves-light btn">Search</button>
				</div>
				<div class="col s4">
					<select id="state" class="browser-default" name="state" onchange="get_orders_state(this.value)">
								<?php
									get_all_states();
								?>
					</select>
				</div>
				<div class="col s4">
					<select class="browser-default" id="city"name="city" onchange="get_orders_city(this.value)">
								<option value="">--Choose city--</option>
					</select>
				</div>
				<div class="col s12"><br/>
					<div id="response_msg"></div>
					<div id="paste_assigned_orders">
					
					</div>
				</div>            
			</div>
    
        
        </div>
		    <div id="delete_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Delete Order
                    </h5>
                    <p>
						Do you really want to delete this order ?
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <span id="paste_btn"></span>
                </div>
                    </form>
            </div>
			            <div id="my_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Upload your design
                    </h5>
                    <p>
                        <form id="design_upload_form">
                            <label>Design file</label><br/>
                            <input type="file" name="file1" id="file1"/><br/>
                            <label>Description</label><br/>
                            <textarea rows="9" name="desc" id="desc" class='materialize-textarea' placeholder="Your brief description goes here..."></textarea>
							<input type="hidden" name="design_itemid" id="design_itemid"/><br/>
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <button type="submit" class="waves-effect waves-light btn">Upload</button>
                </div>
                        </form>
            </div>           
			<div id="printer_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Assign printer
                    </h5>
                    <p>
                        <form id="assign_printer_form">
							<div class="input-field col s12">
								<select id="state" class="browser-default" name="state" onchange="get_cities(this.value)">
									<?php
										get_all_states();
									?>
								</select>
							</div>
							<div class="input-field col s12">
								<select class="browser-default" id="city"name="city" onchange="get_printers(this.value)">
									<option value="">--Choose city--</option>
								</select>
							</div>
							<div class="input-field col s12">
								<select class="browser-default" id="printers"name="printers">
									<option value="">--Choose printer--</option>
								</select>
							</div>
							<input type="hidden" name="packs" id="packs"/>
							<input type="hidden" name="name" id="name"/>
							<input type="hidden" name="price" id="price"/>
							<input type="hidden" name="orderno" id="orderno"/>
							<input type="hidden" name="itemid" id="itemid"/><br/><br/>
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close waves-effect waves btn-flat">Cancel</button>
                    <button type="submit" class="waves-effect waves-light btn">Assign</button>
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
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="inc/materialize/js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/main.js"></script>
      <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
		
		$(document).ready(function(){
			get_assigned_orders();
		})
		function get_assigned_orders()
		{
			$.get("handler/get_assigned_orders.php?page=1",function(response){
				$('#paste_assigned_orders').html(response);
			})
		}
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
		function get_orders_state(val)
		{
			if(val=="")
			{
				$('#city').html("<option value=''>--Choose city--</option>");
				get_assigned_orders();
			}
			else
			{
				var search = $('#search').val();
				if(search=="")
				{
					$.post("handler/get_order_state.php?page=1",{state:val},function(response){
						$('#paste_assigned_orders').html(response);
						get_cities(val);
					})
				}
				else
				{
					$.post("handler/get_order_state_search.php",{state:val,term:search},function(response){
						$('#paste_assigned_orders').html(response);
						get_cities(val);
					})
				}
			}
		}		
		function get_orders_city(val)
		{
			if(val=="")
			{
				var state = $('#state').val();
				get_orders_state(state);
				//$('#city').html("<option value=''>--Choose city--</option>");
			}
			else
			{
				var search = $('#search').val();
				if(search=="")
				{
					$.post("handler/get_order_city.php?page=1",{city:val},function(response){
						$('#paste_assigned_orders').html(response);
					})
				}
				else
				{
					$.post("handler/get_order_city_search.php",{city:val,term:search},function(response){
						$('#paste_assigned_orders').html(response);
					})
				}
			}
		}
		function search_order()
		{
			var search = $('#search').val();
			if(search=="")
			{
				document.getElementById("search").style.border="1px solid red";
			}
			else
			{
				$.post("handler/get_order_search.php",{term:search},function(response){
					$('#paste_assigned_orders').html(response);
					$('#city').html("<option value=''>--Choose city--</option>");
				})
			}
		}
		function paginate(page_to)
		{
			$.get("handler/get_assigned_orders.php?page="+page_to,function(response){
				$('#paste_assigned_orders').html(response);
			})
		}		
		function paginate_state(page_to,state)
		{
			$.post("handler/get_order_state.php?page="+page_to,{state:state},function(response){
				$('#paste_assigned_orders').html(response);
				get_cities(val);
			})
		}		
		function paginate_city(page_to,city)
		{
			$.post("handler/get_order_city.php?page="+page_to,{city:city},function(response){
				$('#paste_assigned_orders').html(response);
			})
		}
		function delete_orders(id,page)
		{
			$('#paste_btn').html("<button type='button'  class='waves-effect waves-light btn' onclick=\"cont_del_order("+id+","+page+")\">Ok<button>");
			$('#delete_modal').openModal();
		}		
		function delete_orders_state(id,page,state)
		{
			$('#paste_btn').html("<button type='button'  class='waves-effect waves-light btn' onclick=\"cont_del_order_state("+id+","+page+","+state+")\">Ok<button>");
			$('#delete_modal').openModal();
		}		
		function delete_orders_city(id,page,city)
		{
			$('#paste_btn').html("<button type='button'  class='waves-effect waves-light btn' onclick=\"cont_del_order_city("+id+","+page+","+city+")\">Ok<button>");
			$('#delete_modal').openModal();
		}
		function cont_del_order(id,page)
		{
			$.post("handler/delete_order.php",{id:id},function(response){
				if(response=="removed")
				{
					$('#delete_modal').closeModal();
					paginate(page);
				}
				else
				{
					$('#response_msg').html("Error : Order could not be deleted");
				}
			})
		}		
		function cont_del_order_state(id,page,state)
		{
			$.post("handler/delete_order.php",{id:id},function(response){
				if(response=="removed")
				{
					$('#delete_modal').closeModal();
					paginate_state(page,state);
				}
				else
				{
					$('#response_msg').html("Error : Order could not be deleted");
				}
			})
		}		
		function cont_del_order_city(id,page,city)
		{
			$.post("handler/delete_order.php",{id:id},function(response){
				if(response=="removed")
				{
					$('#delete_modal').closeModal();
					paginate_city(page,city);
				}
				else
				{
					$('#response_msg').html("Error : Order could not be deleted");
				}
			})
		}
      </script>
    </body>
  </html>
