<?php
session_start();
require_once("db.inc");

function sanitize($input)
{
	$my_input=htmlspecialchars(addslashes(trim($input)));
	return $my_input;
}
function sanitize_content($input)
{
	$my_input = strip_tags(addslashes(trim($input)));
	return $my_input;
}

function get_time_interval_sm($date){
	$mydate=date("Y-m-d h:i:s");
	$theDiff="";
	$datetime1 = date_create($date);
	$datetime2 = date_create($mydate);
	$interval = date_diff($datetime1, $datetime2);
	$min = $interval->format('%i');
	$sec = $interval->format('%s');
	$hour = $interval->format('%h');
	$mon = $interval->format('%m');
	$day = $interval->format('%d');
	$year = $interval->format('%y');
	if($interval->format('%i%h%d%m%y')=="00000"){
		if($sec<10){
			return "just now";
		}
		else{
			return $sec." seconds ago ";
		}
	}
	else if($interval->format('%h%d%m%y')=="0000"){
		if($min==1){
			return $min." minute ago";
		}
		else{
			return $min." minutes ago";
		}
	}
	else if($interval->format('%d%m%y')=="000"){
		if($hour==1){
			return $hour." hour ago";
		}
		else{
			return $hour." hours ago";
		}
	}
	else if($interval->format('%m%y')=="00"){
		if($day==1){
			return "Yesterday";
		}
		else if($day < 7){
			return $day." days ago";
		}
		else if($day==7){
			return "1 week ago";
		}
		else if($day < 14){
			$rem_day = $day-7;
			return "1 week ".$rem_day." days ago";
		}
		else if($day==14){
			return "2 weeks ago";
		}
		else if($day<21){
			$rem_day = $day-14;
			return "2 weeks ".$rem_day." days ago";
		}
		else if($day==21){
			return "3 weeks ago";
		}
		else{
			$rem_day = $day-21;
			return "3 weeks ".$rem_day." days ago";
		}
	}
	else if($interval->format('%y')=="0"){
		if($mon==1){
			return $mon." month ago";
		}
		else{
			return $mon." months ago";
		}
	}
	else{
		if($year==1){
			return $year." year";
		}
		else{
			return $year." years ago";
		}
	}
}

function get_all_states()
{
	global $connection;
	$sql = "SELECT * FROM states ORDER BY states";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<option value=''>--Choose state--</option>";
		foreach($query as $r)
		{
			echo "<option value='{$r['id']}'>{$r['states']}</option>";
		}
	}
	else
	{
		echo "<option value=''>--Choose state--</option>";
	}
}

function verify_state($state)
{
	global $connection;
	$sql = "SELECT * FROM states WHERE states='{$state}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function verify_email($email)
{
	global $connection;
	$sql = "SELECT email FROM printers WHERE email='{$email}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get_city_name($id)
{
	global $connection;
	$sql = "SELECT city FROM cities WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['city'];
		}
	}
}

function get_state_name($id)
{
	global $connection;
	$sql = "SELECT states FROM states WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['states'];
		}
	}
}

function get_company_name()
{
	global $connection;
	$sql = "SELECT company_name FROM printers WHERE email='{$_SESSION['username']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['company_name'];
		}
	}
}

function get_company_locations()
{
	global $connection;
	$comp_id = get_company_id();
	$sql = "SELECT * FROM locations WHERE company='{$comp_id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<p>".get_city_name($r['city'])." | ".get_state_name($r['state'])."<br/>{$r['addr']}<span style='float:right'><button type='button' class='waves-effect waves-light btn' onclick=\"delete_location({$r['id']})\"><i class='fa fa-trash'></i></button></span><p>";
		}
	}
}

function get_company_id()
{
	global $connection;
	$sql = "SELECT id FROM printers WHERE email='{$_SESSION['username']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['id'];
		}
	}
}

function confirm_registration()
{
	global $connection;
	$comp_id = get_company_id();
	$sql = "SELECT city FROM locations WHERE company='{$comp_id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function confirm_printer($id)
{
	global $connection;
	$sql = "SELECT itemid FROM orders WHERE itemid='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get_company_name_location($comp_id)
{
	global $connection;
	$sql = "SELECT company_name FROM printers WHERE id='{$comp_id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['company_name'];
		}
	}
}

function has_designs($itemid)
{
	global $connection;
	$sql = "SELECT * FROM designs WHERE itemid='{$itemid}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function has_been_assigned($itemid)
{
	global $connection;
	$sql = "SELECT * FROM orders WHERE itemid='{$itemid}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get_printer($itemid)
{
	global $connection;
	$sql = "SELECT * FROM orders WHERE itemid='{$itemid}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return get_company_name_location($r['printer_name']).",".get_city_name($r['printer_city']).",".get_state_name($r['printer_state']);
		}
	}
}

function get_num_designs($itemid)
{
	global $connection;
	$sql = "SELECT * FROM designs WHERE itemid='{$itemid}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return $query->rowCount();
	}

}

function get_printer_profile()
{
	global $connection;
	$sql = "SELECT * FROM printers WHERE email='{$_SESSION['username']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<form id='profile_form' method='post' action=''>";
		foreach($query as $r)
		{
			echo "<div style='font-size:18px'>Company name:</div><br/>
			<input type='text' name='company_name' value='{$r['company_name']}'/><br/>
			<div style='font-size:18px'>Telephone number:</div><br/>
			<input type='text' name='telephone' value='{$r['telephone']}'/><br/>
			<div style='font-size:18px'>Email address:</div><br/>
			<input type='text' name='email' value='{$r['email']}'/><br/>
			<button type='submit' name='submit' class='waves-effect waves-light btn'>Update</button><br/>";
		}
		echo "</form>";
	}
	else
	{
		echo "<h4>Company's details could not be fetched</h4>";
	}

}

function confirm_password($password)
{
	global $connection;
	$sql = "SELECT password FROM printers WHERE password='{$password}' AND email='{$_SESSION['username']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>