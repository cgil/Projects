<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');

//Models
require_once(__ROOT__.'/models/user_model.php');
?> 

<?php
/*	Parse the URI for :
 *	ustreamUID
 *  latitude
 *  longitude
 */
function parseURI(){
	parse_str($_SERVER['QUERY_STRING'],$params);
	
	$ustreamUID = ($params['ustreamUID'])?$params['ustreamUID']:NULL;
	$longitude = ($params['longitude'])?$params['longitude']:NULL;
	$latitude = ($params['latitude'])?$params['latitude']:NULL;
	$event = ($params['event'])?$params['event']:NULL;
	
	echo "uid: " . $ustreamUID . " latitude: " .$latitude . " longitude: " .  $longitude. " event: " . $event."<br/>";
	if($ustreamUID && $longitude && $latitude && $event){
		if(findUser($ustreamUID)){
			updateUser($ustreamUID,$longitude,$latitude,$event);
		}
		else{
			insertUser($ustreamUID);
			updateUser($ustreamUID,$longitude,$latitude,$event);
		}
	}
}

//Begin storing user information
parseURI();

?>

