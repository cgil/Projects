<?php
	$BASE_URL = "http://search.twitter.com/search.json?q=";
	$twitter_last_id = 0;
	
	$twitter_query = "";
	$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
	
	$sql1 = "SELECT i.idea_name, i.idea_msg, n.node_lat,n.node_long,c.circle_isOn
	FROM idea i 
		INNER JOIN node n ON i.pk_idea = n.frn_idea
		INNER JOIN circle c ON c.pk_circle = n.frn_circle";

	if (!($query=$mysqli->query($sql1)))
	{
		printf("There was an error processing your request \n make sure that all the correct fields are filled \n". $mysqli->error);

	}
	//Array of nodes	
	$result = $query->fetch_assoc();
	
	$mysqli->close();
	print $result;
/*
	
foreach ($location_array as $i => $value) {
	$location = $location_array[$i];
	
	$session = curl_init($yql_query_url);  
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);  
    $json = curl_exec($session);
    $phpObj =  json_decode($json); 
	 
	if(!is_null($phpObj->query->results)){  
      // Parse results and extract data to display  
      foreach($phpObj->query->results->event as $event){  
        $events .= "<div><h2>" . $event->name . "</h2><p>";  
        $events .= html_entity_decode(wordwrap($event->description, 80, "<br/>"));  
        $events .="</p><br/>$event->venue_name<br/>$event->venue_address<br/>";  
        $events .="$event->venue_city, $event->venue_state_name";  
        $events .="<p><a href=$event->ticket_url>Buy Tickets</a></p></div>";  
      }  
    }  
	 
*/