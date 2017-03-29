<?php

	require_once("includes/db.inc");
	require_once("includes/functions.php");
	
	$file = $_GET['file'];
	
	header('Content-type: application/octet-stream');
	header('Content-Disposition: attachment;filename="'.$file.'"');
	readfile('designs/'.$file);
	exit();
	
?>