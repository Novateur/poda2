<?php
	require_once('../includes/db.inc');
	require_once('../includes/functions.php');
	
	if(isset($_POST['cities']))
	{
		$cities=$_POST['cities'];
		array_map('sanitize',$cities);
		$cities = implode(',',$cities);
		
		$sql="DELETE FROM cities WHERE id IN ({$cities})";
		$query=$connection->query($sql);
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
		echo "Select the cities to delete";
	}
?>