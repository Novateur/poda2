<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$state = sanitize($_POST['state']);
	
	$sql = "SELECT * FROM cities WHERE state='{$state}' ORDER BY city";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<option value=''>--Choose city--</option>";
		foreach($query as $r)
		{
			echo "<option value='{$r['id']}'>{$r['city']}</option>";
		}
	}
	else
	{
		echo "<option value=''>--Choose city--</option>";
	}
?>