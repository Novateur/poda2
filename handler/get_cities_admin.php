<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

		
	$sql_pag = "SELECT COUNT(*) FROM states";
	$totalpage=$connection->query($sql_pag);
	$totalpage->setFetchMode(PDO::FETCH_ASSOC);
	foreach($totalpage as $t)
	{
		$totalpage1=array_shift($t);
	}
	$limit=10;
	$page=$_GET['page'];
	if($page)
	{
		$start=($page-1) * $limit;
	}
	else
	{
		$start=0;
	}
	$sql = "SELECT * FROM cities LIMIT $start,$limit";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<form id='ma_multi_del'>";
		echo "<input type='checkbox' id='States' name='mark_all' onclick=\"man(this)\"/>
		<label for='States' style='color:black'>Mark all</label> &nbsp;";
		echo "<button type='button' id='delete_btn' style='display:none' class='waves-effect waves-light btn' onclick=\"multi_del_cities({$page})\">Delete</button>";
		echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>Cities</th>
                              <th data-field='id'>States</th>
                              <th data-field='price'>Delete</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
			            echo "<tr>
                              <td><input type='checkbox' id='{$r['city']}' value='{$r['id']}' name='cities[]' class='cities' onclick=\"update_check_cities(this.value)\"/>
									<label for='{$r['city']}' style='color:black'>{$r['city']}</label>
								</td>
                              <td>".get_state_name($r['state'])."</td>
                              <td><button type='button' onclick=\"delete_city({$r['id']},{$page})\" class='waves-effect waves-light btn'><i class='fa fa-trash'></i></button></td>
                          </tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</form>";
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
											echo "<li class='waves-effect'><a href='#{$previous}' onclick=\"paginate_city({$previous})\"><i class='material-icons'>chevron_left</i></a></li>";
										}
										for($i=1;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<li class='active' style='color:#fff'>{$i}</li>";
											}
											else
											{
												echo "<li class='waves-effect'><a href='#{$i}' onclick=\"paginate_city({$i})\">{$i}</li> ";
											}
										}									
										if($next<=$total_num_pages)
										{
											echo "<li class='waves-effect'><a href='#{$next}' onclick=\"paginate_city({$next})\" data-role='button'><i class='material-icons'>chevron_right</i</li>";
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