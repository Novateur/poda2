<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");

	//$id = sanitize($_POST['item']);
	$id = get_company_id();
	$sql_pag = "SELECT COUNT(*) FROM orders WHERE printer_name='{$id}'";
	$totalpage=$connection->query($sql_pag);
	$totalpage->setFetchMode(PDO::FETCH_ASSOC);
	foreach($totalpage as $t)
	{
		$totalpage1=array_shift($t);
	}
	$limit=20;
	$page=$_GET['page'];
	if($page)
	{
		$start=($page-1) * $limit;
	}
	else
	{
		$start=0;
	}
	$sql = "SELECT * FROM orders WHERE printer_name='{$id}' LIMIT $start,$limit";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>Order Number</th>
                              <th data-field='name'>Name</th>
                              <th data-field='name'>Packs</th>
                              <th data-field='price'>Price</th>
                              <th data-field='price'>Designs</th>
                              <th data-field='price'>progress</th>
                              <th data-field='price'>Update progress</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
						//$extension = explode(".",$r['design']);
						//$format = $extension[1];
			            echo "<tr>
                              <td>{$r['orderno']}</td>
                              <td>{$r['name']}</td>
							  <td>{$r['packs']}</td>
                              <td>&#8358;".number_format($r['amount'],2)."</td>";
							  if(has_designs($r['itemid']))
							  {
									echo "<td style='font-size:14px'>[ (".get_num_designs($r['itemid']).") <button type='button' class='waves-effect waves-light btn' onclick=\"get_designs_printer({$r['itemid']})\">View designs</button> ]"."</td>";
							  }
							  else
							  {
									echo "<td>No design yet</td>";
                              }
                          echo "<td>No progress</td>
                          <td>";
						  if($r['progress']=="")
						  {
							echo "<button type='button' class='waves-effect waves-light btn' onclick=\"update_progress({$r['id']},{$page})\">Update progress</button></td>";
						  }
						  else
						  {
							echo "{$r['progress']} [ <button type='button' class='waves-effect waves-light btn' onclick=\"update_progress({$r['id']},{$page})\">Re-update</button> ]";
						  }
						  echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
							echo"<div class='row'>";
							echo "<div class='col s12'>";
								echo "<div align='center'id='paginate1'>";																
									$previous=$page-1;
									$next=$page+1;
									$total_num_pages=ceil($totalpage1/$limit);
									if($total_num_pages>1)
									{
										echo "Page {$page} of {$total_num_pages} pages<br/>";
										if($previous>=1)
										{
											echo "<a href='#{$previous}' onclick=\"paginate_assigned_orders({$previous})\" data-role='button'>Previous</a> ";
										}
										for($i=1;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<button type='button'>{$i}</button> ";
											}
											else
											{
												echo "<a href='#{$i}' onclick=\"paginate_assigned_orders({$i})\" data-role='button'>{$i}</a> ";
											}
										}									
										if($next<=$total_num_pages)
										{
											echo "<a href='#{$next}' onclick=\"paginate_assigned_orders({$next})\" data-role='button'>Next</a>";
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