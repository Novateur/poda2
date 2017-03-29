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
        <div class="row container" >
            <div class="col s6"><h3>View Order</h3></div>
            <div class="col s6">
                <h5>You are here: 
                    <a href="index.php" class="breadcrumb pink-text">Timeline</a>
                    <a href="view.php" class="breadcrumb pink-text">View order</a>
                </h5>
            </div>
                    
<!--
                  <div class="col s6">
                    
                  </div>
-->
            <?php $orderNo = $_GET['Order'];?>
            <?php 
            $customerDetails = $podaobj->customerDetails($orderNo);
//            print_r($customerDetails);
            $customerName = $customerDetails[first_name]." ".$customerDetails[last_name];
            $bilAddress = $customerDetails[billing_address][address_1]." <br/>".$customerDetails[billing_address][address_2]." <br/>".$customerDetails[billing_address][city]." <br/>".$customerDetails[billing_address][state]." <br/>".$customerDetails[billing_address][country];
            $bilPhone = $customerDetails[billing_address][phone];
            $bilEmail = $customerDetails[billing_address][email];
            $shipAddress = $customerDetails[shipping_address][address_1]." <br/>".$customerDetails[shipping_address][address_2]." <br/>".$customerDetails[shipping_address][city]." <br/>".$customerDetails[shipping_address][state]." <br/>".$customerDetails[shipping_address][country];
            $shipPhone = $customerDetails[shipping_address][email];
            $shipEmail = $customerDetails[shipping_address][email];
            
            $orderDetails = $podaobj->viewOrder($orderNo);
			$lineItems = $podaobj->lineItems($orderNo);
			$lineItemsCount = $podaobj->lineItemsCount($orderNo);                            
			$metaCount = count($orderDetails[line_item_meta]);
			?>
            <div class="col s6"><label>Order Number: <?php echo $orderNo ?></label></div>
            <div class="col s6"><label>Order By: <?php echo $customerName; ?></label></div>
        </div>
        <div class="row container">
            <div class="col s6"><h4><?php echo $lineItemsCount . " ";if($lineItemsCount > 1){echo "items";}else{echo "item";}?> Ordered</h4></div>
            <div id="response_msg"></div>
			<div>         
                    <table class="striped">
                        <thead>
                          <tr>
                              <th data-field="id">Product Name</th>
                              <th data-field="name">Packs</th>
                              <th data-field="price">Total</th>
<!--                              <th data-field="price">SKU</th>-->
                              <th data-field="price">Assign printer</th>
                              <th data-field="price">Upload designs</th>
                          </tr>
                        </thead>

                        <tbody>
        <?php                   
         for($i=0; $i<$lineItemsCount; $i++){
		 $itemid = $lineItems[$i][id];
            $itemName = $lineItems[$i][name];
            $packs =  $lineItems[$i][quantity];
            $total =  $lineItems[$i][total];
            $sku =  $lineItems[$i][sku];
            $link_address = "design.php?OrderID=".$orderNo."&"."line_item=".$itemName;
            echo "<tr>";
            echo "<td>".$itemName."</td>";
            echo "<td>".$packs."</td>";
            echo "<td>&#8358;".number_format($total,2)."</td>";
			if(has_been_assigned($itemid))
			{
				echo "<td style='font-size:14px'>".get_printer($itemid)."<br/>[ <a href='#' onclick=\"assign_to_printer('{$packs}','{$itemName}','{$total}','{$orderNo}',{$itemid})\"><i class='fa fa-retweet'></i> Re-assign</a> ] [ <a href='#' onclick=\"remove_as_assigned({$itemid})\"><i class='fa fa-trash'></i> Remove</a> ]"."</td>";
            }
			else
			{
				echo "<td>"."<button type='button' class='waves-effect waves-light btn' onclick=\"assign_to_printer('{$packs}','{$itemName}','{$total}','{$orderNo}',{$itemid})\">Assign</button>"."</td>";
            }
			if(has_designs($itemid))
			{
				echo "<td style='font-size:14px'>[ (".get_num_designs($itemid).") <a href='#' onclick=\"get_designs({$itemid})\">View designs</a> ] [ <a href='#' onclick=\"upload_design({$itemid})\">Add more</a> ]"."</td>";
            }
			else
			{
				echo "<td>"."<a href='#' id='cd{$randId}' onclick=\"upload_design({$itemid})\" class=\"waves-effect waves-light btn\">Upload Design</a>"."</td>";
			}
			echo "</tr>";                
        }           
            ?>
                            
                         
                        </tbody>
              </table>
            </div>           
        </div>
        <hr/ class="container">
        <div class="row container">
            <div class="col s4">
              <h5>Billing Details</h5>
                  <label>Address: </label><span><?php echo $bilAddress; ?></span><br/>
            </div>
            <div class="col s4">
              <h5>Shipping Details</h5> 
                  <label>Address: </label><span><?php echo $shipAddress; ?></span><br/>
            </div>
            <div class="col s4">
              <h5>Contact Details</h5> 
                <p>Billing Contact</p>
                  <label>Email: </label><span><?php echo $bilEmail; ?></span><br/>
                  <label>Phone Number: </label><span><?php echo $bilPhone; ?></span><br/> 
                <p>Shipping Contact</p>
                  <label>Email: </label><span><?php echo $shipEmail; ?></span><br/>
                  <label>Phone Number: </label><span><?php echo $shipPhone; ?></span><br/> 
            </div>
            <div id="my_modal" class="modal">
                <div class="modal-content">
                    <h5>
                        Upload your design
                    </h5>
                    <p>
                        <form id="design_upload_form">
                            <label>Design file</label><br/>
                            <input type="file" name="file1" id="file1"/><br/><br/>
                            <label>Description</label><br/>
                            <textarea rows="9" name="desc" id="desc" class="materialize-textarea" placeholder="Your brief description goes here..."></textarea>
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
								<select id="state" class="browser-default" name="state" onchange="get_cities_drop(this.value)">
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
                    
                </div><br/><br/>
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
        
        </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="inc/jQuery/jquery.js"></script>
      <script type="text/javascript" src="inc/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="js/main.js"></script>
	 <script>
        $('.button-collapse').sideNav();
        $('.modal-trigger').leanModal();
     
      </script>
    </body>
  </html>
