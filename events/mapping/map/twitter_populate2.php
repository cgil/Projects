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
		$url = stripslashes($url);
		echo $url;
		$ch = curl_init($url);
		$timeout = 0; // set to zero for no timeout
		//curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		echo $file_contents;
		return $file_contents;
	}
	
	function get_searches($name){
		$name = addslashes($name);
		$yql_query_url = "https://query.yahooapis.com/v1/public/yql?q=".urlencode("select * from search.termextract where context = '$name'")."&format=json";
		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json = curl_exec($session);
		$phpObj = json_decode($json,true);
		$text = ($phpObj["query"]["results"]["Result"]);
		curl_close($session);
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
		if ($data == ""){
			$data = file_get_the_contents($twitter_call);
		}
	
		$count = substr_count($data,"created_at");
		//echo $twitter_call." ".$count."<br/>";
		return $count;
	}
		
	while($row = $results->fetch_assoc()){
		$BASE_URL = "http://search.twitter.com/search.json?q=";
		$term = $row['idea_name'];
		$lat = $row['node_lat'];
		$long = $row['node_long'];
		$search_terms = get_searches($term);
		foreach($search_terms as $searches){
			//echo $searches."</br>";
			}
		$tweets = 1;
		if ($term == "Chuck Testa"){
			$tweets = 20;
		}
		foreach($search_terms as $search_term)
		{
			$tweets += get_twitter_count($search_term,$lat,$long);
			//echo $search_term." ".$tweets;
		}
		$tweets *= 18;
		//echo $term." ".$tweets."<br/>";
		
		$sql = "UPDATE node AS n INNER JOIN idea AS i ON n.frn_idea = i.pk_idea
					SET n.node_hits = '$tweets'
					WHERE i.idea_name = '$term'";
					
		$mysqli->query($sql);
		
		}
?>