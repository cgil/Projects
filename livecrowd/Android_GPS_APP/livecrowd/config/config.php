<?php
{
	$user = "contra66_cgil";
	$password = "cgil1";
	$database = "contra66_livecrowd";
	$host = "localhost";
	try
	{
		$mysqli = new MySQLi($host,$user,$password,$database);
		if($mysqli->connect_error)
		{
			throw new Exception('Mysqli Connection Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}
	}
	catch(Exception $e)
	{
		trigger_error($e->getMessage());
	}
}	
?>