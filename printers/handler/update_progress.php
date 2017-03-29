<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");
	
	$progress = sanitize($_POST['progress']);
	$id = sanitize($_POST['assigned_id']);
	
	$sql = "UPDATE orders SET progress='{$progress}' WHERE id='{$id}'";
	$query = $connection->exec($sql);
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "error";
	}
	
?>