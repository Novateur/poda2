<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$term = sanitize($_POST['term']);
	
	$sql = "SELECT * FROM printers WHERE company_name LIKE '%".$term."%' ";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>Company name</th>
                              <th data-field='name'>Telephone</th>
                              <th data-field='name'>Email</th>
                              <th data-field='price'>Locations</th>
                              <th data-field='price'>Block</th>
                              <th data-field='price'>Delete</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
			            echo "<tr>
                              <td>{$r['company_name']}</td>
                              <td>{$r['telephone']}</td>
                              <td>{$r['email']}</td>
                              <td><button onclick=\"fetch_locations({$r['id']})\"><i class='fa fa-home'></i></button></td>
                              <td>";
							  	if($r['blocked']==NULL)
								{
									echo "<button onclick=\"block_printer({$r['id']},'search')\"><i class='fa fa-times'></i></button></td>";
								}
								else
								{
									echo "<button onclick=\"unblock_printer({$r['id']},'search')\"><i class='fa fa-minus'></i></button></td>";
								}
                              echo "<td><button onclick=\"delete_printer({$r['id']},'search')\"><i class='fa fa-trash'></i></button></td>
                              <td>{$r['orderno']}</td>
                          </tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
	else
	{
		echo "<div align='center'><h4>No printer was found</h4></div>";
	}

?>