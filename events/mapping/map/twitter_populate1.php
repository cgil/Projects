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
	
	/*function get_twitter_count($name,$lat,$long) {
		$yql_query_url = "https://query.yahooapis.com/v1/public/yql?q=".urlencode("select * from search.termextract where context = '$name'")."&format=json";
		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json = curl_exec($session);
		$phpObj = json_decode($json,true);
		$text = ($phpObj["query"]["results"]["Result"]);
		$twitter_call = $BASE_URL ."%23". $name."&geocode=".$lat.",".$long.",10km";
		$data = file_get_the_contents($twitter_call);
		$tweets = substr_count($data,"created_at");
		if (is_array($text) == false){
			$twitter_call = $BASE_URL ."%23". $name."&geocode=".$lat.",".$long.",10km";
			$data = file_get_the_contents($twitter_call);
			$tweets = substr_count($data,"created_at");
			if ($tweets == 0){
				$twitter_call = $BASE_URL . $text."&geocode=".$lat.",".$long.",10km";
				$data = file_get_the_contents($twitter_call);
				$tweets .= substr_count($data,"created_at");
			}
		}
		else{
			foreach ($text as $word) {
				$twitter_call = $BASE_URL . $word."&geocode=".$lat.",".$long.",10km";
				$data = file_get_the_contents($twitter_call);
				$tweets .= substr_count($data,"created_at");
			}
		}
		return $tweets;
	}*/
	
	function get_searches($name){
		$name = addslashes($name);
		$yql_query_url = "https://query.yahooapis.com/v1/public/yql?q=".urlencode("select * from search.termextract where context = '$name'")."&format=json";
		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json = curl_exec($session);
		$phpObj = json_decode($json,true);
		$text = ($phpObj["query"]["results"]["Result"]);
		if (is_array($text)){
			$text[] = "%23".$text[0];
			$text[] = "%23".$text[1];
			$text[] = $name;
			return $text;
		}
		else if($text != ""){
			$text_array = array("%23".$text,$name,$text);
			return $text_array;
		}
		else 
		{
			$text_array = array($name, "%23".$name);
			return $text_array;
		}
		
	}
	
	function get_twitter_count($search, $lat, $long){
		$twitter_call = "http://search.twitter.com/search.json?q=".$search."&geocode=".$lat.",".$long.",10km";
		$data = file_get_the_contents($twitter_call);
		$count = substr_count($data,"created_at");
		return $count;
	}
		
	while($row = $results->fetch_assoc()){
		$BASE_URL = "http://search.twitter.com/search.json?q=";
		$term = $row['idea_name'];
		$lat = $row['node_lat'];
		$long = $row['node_long'];
		$search_terms = get_searches($term);
		foreach($search_terms as $searches){
			echo $searches."</br>";
			}
		$tweets = 1;
		foreach($search_terms as $search_term)
		{
			$tweets += get_twitter_count($search_term,$lat,$long);
		}
		$tweets *= 18;
		echo $term." ".$tweets."<br/>";
		
		$sql = "UPDATE node AS n INNER JOIN idea AS i ON n.frn_idea = i.pk_idea
					SET n.node_new_hits = '$tweets'
					WHERE i.idea_name = '$term'";
					
		$mysqli->query($sql);
		
		}
?>