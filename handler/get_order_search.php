<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$term = sanitize($_POST['term']);
	
	$sql = "SELECT * FROM orders WHERE name LIKE '%".$term."%' OR orderno LIKE '%".$term."%'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>Name</th>
                              <th data-field='name'>Packs</th>
                              <th data-field='name'>Price</th>
                              <th data-field='price'>Printer name</th>
                              <th data-field='price'>Printer city</th>
                              <th data-field='price'>Printer state</th>
                              <th data-field='price'>Order number</th>
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
                              <td>{$r['name']}</td>
                              <td>{$r['packs']}</td>
                              <td>&#8358;".number_format($r['amount'],2)."</td>
                              <td>".get_company_name_location($r['printer_name'])."</td>
                              <td>".get_city_name($r['printer_city'])."</td>
                              <td>".get_state_name($r['printer_state'])."</td>
                              <td>{$r['orderno']}</td>";
							  if(has_designs($r['itemid']))
							  {
									echo "<td>(".get_num_designs($r['itemid']).") <a href='#' onclick=\"get_designs({$itemid})\">View designs</a> | <a href='#' onclick=\"upload_design({$itemid})\">Add more</a>"."</td>";
							  }
							  else
							  {
									echo "<td><a href='download.php?file={$r['design']}'><i class='fa fa-cloud-upload' data-role='button'></i></a></td>";
                              }
							  echo "<td><a href='#' onclick=\"delete_design({$r['id']},{$id})\"><i class='fa fa-trash' data-role='button'></i></a></td>
                          </tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
	else
	{
		echo "<div align='center'><h5>No more orders to fetch</h5></div>";
	}

?>