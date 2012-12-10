<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');
require_once(__ROOT__.'/controllers/event.php');
?> 

<?php
	function file_get_the_contents($url) {
		$ch = curl_init();
		$timeout = 10; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		return $file_contents;
	}

//Get a users channel
function getChannel($username) {
	$text = file_get_the_contents('http://api.ustream.tv/json/channel/' . $username
			. '/listAllChannels?key=BFB059F029979EED85D4E9C36B1A18D3');
	$phpObj = json_decode($text,true);
	foreach($phpObj['results'] as $res) {
		if ($res['status'] == 'live') {
			//echo($res['id']);
			return $res['id'];
		}
	}
	
	//no live streams detected so just return the first streamid
	
	return $phpObj['results']['0']['id'];
}

function normalizeGPSValues($userArray) {
	$centerLat = 40.443877;
	$centerLon = -79.944081;
	$height = 530;
	$width = 1250;
	$retArray = Array();
	
	$latSum = 0;
	$lonSum = 0;
	$latMax = 0;
	$lonMax = 0;
	$numUsers = 0;

	
	foreach($userArray as $user) {
		$numUsers = $numUsers+1;
		//curLat =  $center['latitude'] - $user['user_latitude'];
		//$curLon =  $center['longitude'] - $user['user_longitude'];
		
		$curLat =  $centerLat - (float) $user['latitude'];
		$curLon =  $centerLon - (float) $user['longitude'];
	
		if (abs($curLat) > $latMax) {
			$latMax = abs($curLat);
		}
		if (abs($curLon) > $lonMax) {
			$lonMax = abs($curLon);
		}
		
		$latSum += $curLat;
		$lonSum += $curLon;
	}
	$index = 0;
	foreach($userArray as $user) {
		//$curLat =  $center['latitude'] - $user['user_latitude'];
		//$curLon =  $center['longitude'] - $user['user_longitude'];
		
		$curLat =  $centerLat - $user['latitude'];
		$curLon =  $centerLon - $user['longitude'];
		
		$normalLat = $curLat/ $latMax; //number between -1 and 1
		$normalLon = $curLon/ $lonMax;
		
		$curX = ($width / 2) + ($normalLat)*500;
		$curY = ($height / 2) + ($normalLon)*240;
		$username = $user['ustreamUID'];
		
		$tempArray = Array();
		$user['x'] = $curX;
		$user['y'] = $curY;
		$userArray[$index] = $user;
		$index++;
	}
	return $userArray;
}	
	



//getChannel('nzukee');
?>