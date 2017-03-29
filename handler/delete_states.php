<?php
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$id = sanitize($_POST['id']);


	$query=$connection->query("DELETE FROM states WHERE id={$id}");
	if($query)
	{
		$query=$connection->query("DELETE FROM cities WHERE state='{$id}'");
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