<?php 
	header('Content-type: application/json');

	require_once("../../config_database/config.php");
?>

<?php
	
	$node = $mysqli->real_escape_string($_GET['node']);

	$sql_update = "UPDATE node SET node_attending = CASE WHEN node_attending IS NULL THEN 0 ELSE node_attending END + 1 WHERE pk_node = '$node'";
	if(!$mysqli->query($sql_update)){
		printf("Error : ".$mysqli->error . "\n");	
	}

?>