<?php
	require_once("../../config_database/config.php");
?>

<?php
	$BASE_URL = "http://search.twitter.com/search.json?q=";
	$sql1 = "SELECT i.idea_name, i.idea_msg, n.node_lat,n.node_long,c.circle_isOn
	FROM idea i 
		INNER JOIN node n ON i.pk_idea = n.frn_idea
		INNER JOIN circle c ON c.pk_circle = n.frn_circle";

	if (!($results=$mysqli->query($sql1)))
	{
		printf("There was an error processing your request \n make sure that all the correct fields are filled \n". $mysqli->error);
	}
	
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
	
	function important_text($name) {
		$yql_query_url = "https://query.yahooapis.com/v1/public/yql?q=".urlencode("select * from search.termextract where context = '$name'")."&format=json";
		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json = curl_exec($session);
		$phpObj = json_decode($json,true);
		//$phpObj->query->results->result as $word;
		//echo $word."<br/>";
		//echo $json;
		print_r($phpObj["query"]["results"]["Result"]);
		/*foreach($phpObj->query->results->result as $result){
			echo $result."<br/>";
		}*/
	}
		
	
	
	function get_twitter_count($row) {
		$name = $row['idea_name'];
		$lat = $row['node_lat'];
		$long = $row['node_long'];
		}
		
		
	
	while($row = $results->fetch_assoc()){
		$term = $row['idea_name'];
		important_text($term);
		$lat = $row['node_lat'];
		$long = $row['node_long'];
		$twitter_call = $BASE_URL . "%23".$term."&geocode=".$lat.",".$long.",10km";
		$data = file_get_the_contents($twitter_call);
		$tweets = substr_count($data,"created_at");
		//echo $twitter_call." ".$tweets."<br/>";
		
		$sql = "UPDATE node AS n INNER JOIN idea AS i ON n.frn_idea = i.pk_idea
					SET n.node_new_hits = '$tweets'
					WHERE i.idea_name = '$term'";
		}
?>