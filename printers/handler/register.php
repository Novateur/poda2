<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");
	
	
	$name = sanitize($_POST['company_name']);
	$phone = sanitize($_POST['phone']);
	$email = sanitize($_POST['email']);
	$password = sha1(md5($_POST['password']));

	if(!verify_email($email))
	{
		$query=$connection->query("INSERT INTO printers(company_name,telephone,email,password) VALUES 
		('{$name}','{$phone}','{$email}','{$password}')");
		if($query)
		{
			$_SESSION['username']=$email;
			echo "added";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "Account already exit,please try <a href='login.php'>Logging in</a>";
	}
?>