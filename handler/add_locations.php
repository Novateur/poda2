<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$company_id = get_company_id();
	$state = sanitize($_POST['state']);
	$city = sanitize($_POST['city']);
	$addr = sanitize($_POST['addr']);

	$query=$connection->query("INSERT INTO locations(company,city,state,addr) VALUES ({$company_id},'{$city}',{$state},'{$addr}')");
	if($query)
	{
		echo "added";
	}
	else
	{
		echo "error";
	}
?>