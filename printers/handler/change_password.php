<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");
	
	$current_pass = sha1(md5($_POST['current_pass']));
	$new_pass = sha1(md5($_POST['new_pass']));
	
	if(confirm_password($current_pass))
	{
		$sql = "UPDATE printers SET password='{$new_pass}' WHERE password='{$current_pass}' AND email='{$_SESSION['username']}'";
		$query = $connection->exec($sql);
		if($query)
		{
			echo "updated";
		}
		else
		{
			echo "An error occured while processing your request";
		}
	}
	else
	{
		echo "It seems password does not exist,try again";
	}
?>