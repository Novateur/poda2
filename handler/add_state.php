<?php

require_once("../includes/db.inc");
require_once("../includes/functions.php");

	$state = sanitize($_POST['state']);
	if(!verify_state($state))
	{
		$query=$connection->query("INSERT INTO states(states) VALUES ('{$state}')");
		if($query)
		{
			echo "added";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo $state." is already in your record";
	}
?>
