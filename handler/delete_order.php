<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$id = sanitize($_POST['id']);
	
	$sql = "DELETE FROM orders WHERE itemid={$id}";
	$query = $connection->query($sql);
	if($query)
	{
		echo "removed";
	}
	else
	{
		echo "error";
	}
	
?>