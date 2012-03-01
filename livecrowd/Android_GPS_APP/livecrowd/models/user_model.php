<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');
?> 

<?php
//Model - User

/* Update existing user credentials
 * latitude
 * longitude
 * event
 */
function updateUser($ustreamUID,$longitude,$latitude,$event){
	global $mysqli;
	$update_query = "UPDATE user SET user_latitude = ?, user_longitude = ?, user_event = ? WHERE user_ustreamUID = ?";
	try{	 
		if($stmt = $mysqli->prepare($update_query)){
			$stmt->bind_param('ssss',$latitude, $longitude, $event, $ustreamUID);
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

//Find if user is already in database
function findUser($ustreamUID){
	global $mysqli;
	$select_query = "SELECT user_ustreamUID FROM user WHERE user_ustreamUID = ?";
	try{
		if($stmt = $mysqli->prepare($select_query)){
			$stmt->bind_param('s',$ustreamUID);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows > 0){
				return 1;
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

//Add a new user
function insertUser($ustreamUID){
	global $mysqli;
	$insert_query = "INSERT INTO user (user_ustreamUID) VALUES(?)";
	try
	{
		if($stmt = $mysqli->prepare($insert_query)){
			$stmt->bind_param('s',$ustreamUID);
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

//Get all of the users at an event: return array of users
function findEventUsers($event){
	global $mysqli;
	$select_query = "SELECT user_ustreamUID FROM user WHERE user_event = ?";
	try
	{
		if($stmt = $mysqli->prepare($select_query)){
			$stmt->bind_param('s',$event);
			$stmt->execute();
			
			$stmt->store_result();
			if($stmt->num_rows > 0){
				$stmt->bind_result($ustreamUID);
				while ($stmt->fetch()) {
					$userArr[] = $ustreamUID;
				}
				return $userArr;
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

function selectAll($ustreamUID){
	global $mysqli;
	$select_query = "SELECT user_ustreamUID,user_latitude,user_longitude,user_event FROM user WHERE user_ustreamUID = ?";
	try
	{
		if($stmt = $mysqli->prepare($select_query)){
			$stmt->bind_param('s',$ustreamUID);
			$stmt->execute();
			
			$stmt->store_result();
			if($stmt->num_rows > 0){
				$stmt->bind_result($ustreamUID,$lat,$long,$event);
				while ($stmt->fetch()) {
					$tempArr['ustreamUID'] = $ustreamUID;
					$tempArr['latitude'] = $lat;
					$tempArr['longitude'] = $long;
					$tempArr['event'] = $event;
					$userArr[] = $tempArr;
				}
				return $userArr;
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

function selectUserEvent($ustreamUID){
	global $mysqli;
	$select_query = "SELECT user_event FROM user WHERE user_ustreamUID = ?";
	try
	{
		if($stmt = $mysqli->prepare($select_query)){
			$stmt->bind_param('s',$ustreamUID);
			$stmt->execute();
			
			$stmt->store_result();
			if($stmt->num_rows > 0){
				$stmt->bind_result($event);
				return $event;
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