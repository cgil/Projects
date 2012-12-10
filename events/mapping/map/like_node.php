<?php 
	header('Content-type: application/json');

	require_once("../../config_database/config.php");
?>

<?php
	$node = $mysqli->real_escape_string($_GET['node']);
	$sql_update = "UPDATE node SET node_old_hits = node_new_hits, node_new_hits = CASE WHEN node_new_hits IS NULL THEN 0 ELSE node_new_hits END + 1 WHERE pk_node = '$node'";
	if(!$mysqli->query($sql_update)){
		printf("Error : ".$mysqli->error . "\n");	
	}

?>