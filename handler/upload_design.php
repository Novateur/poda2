<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$desc = sanitize($_POST['desc']);
	$itemid = sanitize($_POST['design_itemid']);
	$tmp_file2=$_FILES['file1']['tmp_name'];
	$target_file2=basename($_FILES['file1']['name']);
	$size=$_FILES['file1']['size'];
	$type=$_FILES['file1']['type'];
	$extension=strtolower(substr($target_file2,strpos($target_file2,'.')+1));
	
	$rename = rand(0,1000000)."DESIGN".rand(0,1000000).".".$extension;
	
	if($extension=="jpeg" || $extension=="jpg" || $extension=="png" && $size<=5000000)
	{
		$upload_dir2="../designs";
		$db_upload=move_uploaded_file($tmp_file2, $upload_dir2."/".$rename);
		$query=$connection->query("INSERT INTO designs(design,description,itemid) 
		VALUES ('{$rename}','{$desc}','{$itemid}')");
		if($query)
		{
			echo "inserted";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "Your file must be in jpg/jpeg/png format and must be less than 5MB";
	}
?>