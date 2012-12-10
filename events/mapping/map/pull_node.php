<?php 
	header('Content-type: application/json');

	require_once("../../config_database/config.php");
?>

<?php

	$sql1 = "SELECT i.idea_name, i.idea_msg, n.node_lat,n.node_long,n.pk_node, n.node_new_hits,c.circle_isOn, c.circle_fillColor,c.circle_strokeColor
	FROM idea i 
		INNER JOIN node n ON i.pk_idea = n.frn_idea
		INNER JOIN circle c ON c.pk_circle = n.frn_circle";

	if (!($result=$mysqli->query($sql1)))
	{
		printf("There was an error processing your request \n make sure that all the correct fields are filled \n". $mysqli->error);

	}

	
	$jsondata = array();
	
	while ($row = $result->fetch_array())
	{
	
		$jsondata[]= array('name'=>$row["idea_name"], 
							  'msg'=>$row["idea_msg"], 
						 'lat'=>$row["node_lat"],
						 'lng'=>$row["node_long"],
						 'fill'=>$row["circle_fillColor"],
						 'stroke'=>$row["circle_strokeColor"],
						 'hits'=>$row["node_new_hits"],
						 'key'=>$row["pk_node"],
						 'isOn'=>$row["circle_isOn"]);
	};


	echo json_encode($jsondata);

	
	$mysqli->close();
?>




