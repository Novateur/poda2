<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$state = sanitize($_POST['state']);
	$city = sanitize($_POST['city']);

	$query=$connection->query("INSERT INTO cities(city,state) VALUES ('{$city}',{$state})");
	if($query)
	{
		echo "added";
	}
	else
	{
		echo "error";
	}
?>
