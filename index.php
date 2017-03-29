<?php
	ob_start();
    include 'wcaccess.php';
	require_once("includes/db.inc");
	require_once("includes/functions.php");
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>
      <?php
        include("includes/admin_header.php");
      ?>
        <div class="container"><h3>Order Timeline</h3></div>
        <div class="container">
            <table class="striped">
                <thead>
                  <tr>
                  <th data-field="id">Assigned</th>
                      <th data-field="id">Order Number</th>
                      <th data-field="name">Date Ordered</th>
                      <th data-field="price">Status</th>
                      <th data-field="price">No of Items</th>
                      <th data-field="price">Total (NGN)</th>
                      <th data-field="price">Action</th>
                  </tr>
                </thead>

            <tbody>
                <?php
                $result = $podaobj->getOrder();
                $orderCount = count($result);
                for($i=0; $i<$orderCount; $i++){
                    $link_address = "view.php?Order=".$result[$i][order_number];
                    echo "<tr>";
    //                echo "<td>".$i."</td>";
					  $time = preg_replace('/[A-Z]+/',' ',$result[$i][created_at]);
                    echo "<td>".Yes."</td>";
                    echo "<td>".$result[$i][order_number]."</td>";
                    echo "<td><span style='font-size:12px'>".get_time_interval_sm($time)."</span><br/>{$time}</td>";
                    echo "<td>".$result[$i][status]."</td>";
                    echo "<td>".$result[$i][total_line_items_quantity]."</td>";
                    echo "<td>&#8358;".number_format($result[$i][total],2)."</td>";
                    echo "<td>"."<a href='".$link_address."'class=\"waves-effect waves-light btn\">View </a>"."</td>";
                    echo "</tr>";                
                }            
                ?>
            </tbody>
      </table>
        
        </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
        