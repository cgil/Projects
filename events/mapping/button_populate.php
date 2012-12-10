<?php
	require_once("../config_database/config.php");

?>



<?
	$num = rand(5,80);
	$sql = "UPDATE node SET node_new_hits = node_new_hits + '$num'";
	if(!$mysqli->query($sql)){
		printf($mysqli->error);
	}


?>