<?php
	ob_start();
	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");
	
	$email=sanitize($_POST['email']);
	$password=sha1(md5($_POST['password']));
	
	
	$sql="SELECT * FROM printers WHERE email='{$email}' AND password='{$password}'";
	$query = $connection->query($sql);
	if($query->rowCount()==1)
	{
		$_SESSION['username']=$email;
		echo "yes";
	}
	else
	{
		echo "no";
	}
?>