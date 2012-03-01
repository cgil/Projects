<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');

//Models
require_once(__ROOT__.'/models/event_model.php');
?> 

<?php

//Create new event
function newEvent($event, $userData){
	createEvent($event,$userData['latitude'], $userData['longitude']);
	updateUserEvent($userData['ustreamUID'],$event);
}

//Join existing event
function joinEvent($userData){
	updateUserEvent($userData['ustreamUID'],$userData['event']);
}

//Search for events
function search($event){
	$eventArr = searchEvent($event);
	echo json_encode($eventArr);
	
}

if(isset($_REQUEST['actionType']) && isset($_REQUEST['eventName'] )){
	if($_REQUEST['actionType'] == 1){ //SEARCH EVENTS
		search($_REQUEST['eventName']);
	}
	else if($_REQUEST['actionType'] == 2){ //CREATE EVENT
		newEvent($_REQUEST['eventName'],$userData);
	}
}

?>