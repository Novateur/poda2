<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$packs = sanitize($_POST['packs']);
	$name = sanitize($_POST['name']);
	$price = sanitize($_POST['price']);
	$itemid = sanitize($_POST['itemid']);
	$orderno = sanitize($_POST['orderno']);
	$state = sanitize($_POST['state']);
	$city = sanitize($_POST['city']);
	$printers = sanitize($_POST['printers']);
	
	if(confirm_printer($itemid))
	{
		$query=$connection->query("UPDATE orders SET printer_state='{$state}',printer_city='{$city}',printer_name='{$printers}',orderno='{$orderno}' WHERE itemid='{$itemid}'");
	}
	else
	{
		$query=$connection->query("INSERT INTO orders(name,packs,amount,itemid,printer_state,printer_city,printer_name,orderno) 
		VALUES ('{$name}','{$packs}','{$price}','{$itemid}','{$state}','{$city}','{$printers}','{$orderno}')");
	}
	if($query)
	{
		echo "inserted";
	}
	else
	{
		echo "error";
	}
?>