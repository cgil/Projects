<?php

	require_once("../config_database/config.php");

	$comment = $_POST["comments"];
	$pk_node = $_POST["pk_node"];
	echo $comment." ".$pk_node."</br>";
	//$msqli->real_escape_string($comment);
	$myquery = "INSERT INTO comment(comment_comment, frn_node) VALUES ('$comment','$pk_node')";
	if(!$mysqli->query($myquery)){
		printf("Failed to insert " . $comment . " into database". $mysqli->error. "<br/>");
		var_dump($myquery);
	}
?>

<meta HTTP-EQUIV="REFRESH" content="0"; url="../node_page.php?node=<?php echo $pk_node ?>">
