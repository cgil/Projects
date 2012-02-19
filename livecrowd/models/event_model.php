<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');
?> 

<?php

//Create a new event
function createEvent($name, $lat, $long){
	global $mysqli;
	$insert_query = "INSERT INTO event (event_name,event_location) VALUES(?, ?, ?)";
	try
	{
		if($stmt = $mysqli->prepare($insert_query)){
			$stmt->bind_param('sss',$name,$lat,$long);
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
function updateUserEvent($ustreamUID,$event){
	global $mysqli;
	$update_query = "UPDATE user SET user_event = ? WHERE user_ustreamUID = ?";
	try{	 
		if($stmt = $mysqli->prepare($update_query)){
			$stmt->bind_param('ss', $event, $ustreamUID);
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

function searchEvent($event){
	global $mysqli;
	$sql = "SELECT event_name FROM event WHERE event_name LIKE ? LIMIT 10";	
	
	try{	 
		if($stmt = $mysqli->prepare($sql)){
			$stmt->bind_param('s', $event);
			$stmt->execute();
			
			$stmt->store_result();
			if($stmt->num_rows > 0){
				$stmt->bind_result($name);
				while ($stmt->fetch()) {
					$eventArr[] = $name;
				}
				return $eventArr;
			}
		}
		
		if($stmt->error){
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