<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');
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
function getChannel($username){
	$text = file_get_the_contents('http://api.ustream.tv/json/channel/' . $username
			. '/listAllChannels?key=BFB059F029979EED85D4E9C36B1A18D3');
	
	$phpObj = json_decode($text,true);

	if($phpObj['error'])
		return NULL;
		
	foreach($phpObj['results'] as $res) {

			return $res['id'];
	}
	
}

?>