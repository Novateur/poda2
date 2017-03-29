<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	$id = sanitize($_POST['id']);
	
	$sql = "UPDATE printers SET blocked=NULL WHERE id={$id}";
	$query = $connection->exec($sql);
	if($query)
	{
		echo "unblocked";
	}
	else
	{
		echo "error";
	}
	
?>