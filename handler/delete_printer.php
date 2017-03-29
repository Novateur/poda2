<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$id = sanitize($_POST['id']);


	$query=$connection->query("DELETE FROM printers WHERE id={$id}");
	if($query)
	{
		$query=$connection->query("DELETE FROM locations WHERE company='{$id}'");
		if($query)
		{
			echo "deleted";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "error";
	}
?>