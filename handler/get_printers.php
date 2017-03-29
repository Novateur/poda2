<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$city = sanitize($_POST['city']);
	$state = sanitize($_POST['state']);
	
	$sql = "SELECT * FROM locations WHERE city='{$city}' AND state='{$state}' ORDER BY city";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<option value=''>--Choose printer--</option>";
		foreach($query as $r)
		{
			echo "<option value='{$r['company']}'>".get_company_name_location($r['company'])."</option>";
		}
	}
	else
	{
		echo "<option value=''>--Choose printer--</option>";
	}
?>