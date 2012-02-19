<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');

//Models
require_once(__ROOT__.'/models/user_model.php');

//Controllers
require_once(__ROOT__.'/controllers/ustreamAPI.php');
?> 

<?php
//Get users at an event
function getUsers($event){
	
	$userArr = findEventUsers($event);
	return $userArr;
	
}

//Create a userData object
function formUserData($userArr){
	foreach ($userArr as $ustreamUID) {
		
		$tempArr = selectAll($ustreamUID);
		
		$channel = getChannel($ustreamUID);
		$tempArr[0]['channel'] = $channel;

		$userData[] = $tempArr[0];
	}

	return $userData;
}

?>