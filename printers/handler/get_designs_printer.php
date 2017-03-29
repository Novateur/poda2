<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");

	$id = sanitize($_POST['item']);
	
	$sql = "SELECT * FROM designs WHERE itemid='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table class='striped'>
                        <thead>
                          <tr>
                              <th data-field='id'>Document</th>
                              <th data-field='name'>Description</th>
                              <th data-field='name'>Format</th>
                              <th data-field='price'>Download</th>
                          </tr>
                        </thead>

        <tbody>";
		foreach($query as $r)
		{
						$extension = explode(".",$r['design']);
						$format = $extension[1];
			            echo "<tr>
                              <td><i class='fa fa-file'></i></td>
                              <td>{$r['description']}</td>
                              <td>.{$format}</td>
                              <td><a href='../download.php?file={$r['design']}'><i class='fa fa-cloud-download'></i></a></td>
                          </tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
	else
	{
		echo "<div align='center'><h5>No more designs to fetch</h5></div>";
	}

?>