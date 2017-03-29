<?php
	require_once('../includes/db.inc');
	require_once('../includes/functions.php');
	
	if(isset($_POST['states']))
	{
		$states=$_POST['states'];
		//array_map('sanitize',$states);
		//$states = implode(',',$states);
		
		/*$sql="DELETE FROM states WHERE id IN ({$articles})";
		$query=$connection->query($sql);
		if($query)
		{
			echo "deleted";
		}
		else
		{
			echo "error";
		}*/
		foreach($states as $state)
		{
			$sql="DELETE FROM states WHERE id={$state}";
			$query=$connection->query($sql);
			if($query)
			{
				$sql="DELETE FROM cities WHERE state={$state}";
				$query=$connection->query($sql);
			}
		}
		echo "deleted";
	}
	else
	{
		//echo "error";
	}
?>