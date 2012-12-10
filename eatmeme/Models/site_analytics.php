<?php
require_once('config/config.php');
?> 

<?php

//Create a new event
function insertNewVisitor($ipAddress){
	global $mysqli;
	$insert_query = "INSERT INTO siteVisitors (ipAddress) VALUES(?)";
	try
	{
		if($stmt = $mysqli->prepare($insert_query)){
			$stmt->bind_param('s',$ipAddress);
			$stmt->execute();
		}
		if($stmt->error){
			throw new Exception('Mysqli stmt Error('. $stmt->error);
		}
		else
			return 1;
	}
	catch(Exception $e)
	{
		trigger_error($e->getMessage());
		return 0;
	}
	return 0;
}

//Update a users current event
function updateReturningUser($ipAddress){
	global $mysqli;
	$update_query = "UPDATE siteVisitors SET ipAddress = ? WHERE ipAddress = ?";
	try{	 
		if($stmt = $mysqli->prepare($update_query)){
			$stmt->bind_param('ss', $ipAddress, $ipAddress);
			$stmt->execute();
		}
		if($stmt->error){
			throw new Exception('Mysqli stmt Error('. $stmt->error);
		}		
		else
			return 1;
	}
	catch(Exception $e)
	{
		trigger_error($e->getMessage());
		return 0;
	}
	
	return 0;	
}

//Return true if visitor has already visited before
function searchForUser($ipAddress)
{
	global $mysqli;
	$sql = "SELECT * FROM siteVisitors WHERE ipAddress = ? LIMIT 10";	
	
	try
	{	 
		if ($stmt = $mysqli->prepare($sql))
		{
			$stmt->bind_param('s', $ipAddress);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows > 0)
			{
				return 1;
			}
		}
		
		if ($stmt->error)
		{
			throw new Exception('Mysqli stmt Error('. $stmt->error);
		}		
		
	}
	catch (Exception $e)
	{
		trigger_error($e->getMessage());
		return 0;
	}
	return 0;	
}

//Returns all unique visitors to page
function getVisitorsCount()
{
	global $mysqli;
	$sql = "SELECT * FROM siteVisitors";	
	
	try
	{	 
		if($stmt = $mysqli->prepare($sql))
		{
			$stmt->execute();
			$stmt->store_result();
			
			return $stmt->num_rows;
		}
		
		if($stmt->error)
		{
			throw new Exception('Mysqli stmt Error('. $stmt->error);
		}		
		
	}
	catch(Exception $e)
	{
		trigger_error($e->getMessage());
		return 0;
	}
	return 0;	
}

?>