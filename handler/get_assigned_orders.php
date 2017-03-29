<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	//$id = sanitize($_POST['item']);
	
	$sql_pag = "SELECT COUNT(*) FROM orders";
	$totalpage=$connection->query($sql_pag);
	$totalpage->setFetchMode(PDO::FETCH_ASSOC);
	foreach($totalpage as $t)
	{
		$totalpage1=array_shift($t);
	}
	$limit=20 ;
	$page=$_GET['page'];
	if($page)
	{
		$start=($page-1) * $limit;
	}
	else
	{
		$start=0;
	}
	$sql = "SELECT * FROM orders LIMIT $start,$limit";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table class='striped'>
                        <thead>
                          <tr>
                          	  <th data-field='price'>Order number</th>
                              <th data-field='id'>Name</th>
                              <th data-field='name'>Packs</th>
                              <th data-field='name'>Price</th>
                              <th data-field='price'>Printer name</th>
                              <th data-field='price'>Printer city</th>
                              <th data-field='price'>Printer state</th>
                              <th data-field='price'>Download</th>
                              <th data-field='price'>Delete</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
						$extension = explode(".",$r['design']);
						$format = $extension[1];
			            echo "<tr>
			            	  <td>{$r['orderno']}</td>
                              <td>{$r['name']}</td>
                              <td>{$r['packs']}</td>
                              <td>&#8358;".number_format($r['amount'],2)."</td>
                              <td>".get_company_name_location($r['printer_name'])."</td>
                              <td>".get_city_name($r['printer_city'])."</td>
                              <td>".get_state_name($r['printer_state'])."</td>";
							  if(has_designs($r['itemid']))
							  {
									echo "<td style='font-size:14px'>[ (".get_num_designs($r['itemid']).") <a href='#' onclick=\"get_designs({$r['itemid']})\">View</a> ] [ <a href='#' onclick=\"upload_design({$r['itemid']})\">Add more</a> ]"."</td>";
							  }
							  else
							  {
									echo "<td><button type='button' onclick=\"upload_design({$r['itemid']})\" class='waves-effect waves-light btn'><i class='fa fa-cloud-upload'></i></button></td>";
                              }
							  echo "<td><a href='#' onclick=\"delete_orders({$r['itemid']},{$page})\"><i class='fa fa-trash'></i></a></td>
                          </tr>";
		}
		echo "</tbody>";
		echo "</table>";
							echo"<div class='row'>";
							echo "<div class='col s12'>";
								echo "<div align='center'id='paginate1' class='pagination'>";																
									$previous=$page-1;
									$next=$page+1;
									$total_num_pages=ceil($totalpage1/$limit);
									if($total_num_pages>1)
									{
										echo "Page {$page} of {$total_num_pages} pages<br/>";
										if($previous>=1)
										{
											echo "<li class='waves-effect'><a href='#' onclick=\"paginate({$previous})\"><i class='material-icons'>chevron_left</i></a></li>";
										}
										for($i=1;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<li class='active' style='color:#fff'>{$i}</li>";
											}
											else
											{
												echo "<li class='waves-effect'><a href='#' onclick=\"paginate({$i})\">{$i}</a></li>";
											}
										}									
										if($next<=$total_num_pages)
										{
											echo "<li class='waves-effect'><a href='#' onclick=\"paginate({$next})\"><i class='material-icons'>chevron_right</i></a></li>";
										}
									}
								echo "</div>";
							echo "</div>";
						echo "</div>";
	}
	else
	{
		echo "<div align='center'><h5>No more designs to fetch</h5></div>";
	}

?>