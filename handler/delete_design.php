<?php
	
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	$id=sanitize($_POST['id']);
	
	$sql = "SELECT design FROM designs WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount()>0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			unlink("../designs/{$r['design']}");
			$sql="DELETE FROM designs WHERE id={$id}";
			$query = $connection->query($sql);
			if($query)
			{
				echo "deleted";
			}
			else
			{
				echo "error";
			}
		}
	}
	else
	{
		echo "Couldn't fetch design";
	}


?>