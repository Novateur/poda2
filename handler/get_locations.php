<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$id = sanitize($_POST['id']);
	
	$sql = "SELECT * FROM locations WHERE company = {$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
				echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>State</th>
                              <th data-field='name'>City</th>
                              <th data-field='name'>Address</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
			echo "<tr>
				<td>".get_state_name($r['state'])."</td>
				<td>".get_city_name($r['city'])."</td>
				<td>{$r['addr']}</td>
			</tr>";
		}
		echo "</tbody>
		</table>";
	}
	else
	{
		echo "No location has been added yet";
	}
	
?>