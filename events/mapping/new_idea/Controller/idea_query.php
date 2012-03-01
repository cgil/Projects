<?php 
	require_once("../../../config_database/config.php");
?>

<?php

	/*Should write function to validate username, email, password===password2 */

	if(isset($_POST['node_name']) && trim($_POST['node_name']) != "")
	{
			//Random number to insert as humanID instead of authenticating: for demo				
			$randHumID = rand(1,15);

			$idearows[] = $mysqli->real_escape_string($_POST['node_name']) . "'," .
				"'" . $randHumID . "'," .
				"'" . $mysqli->real_escape_string($_POST['node_msg']);
				
			$node_latitude = $mysqli->real_escape_string($_POST['node_lat']);
			$node_longitude = $mysqli->real_escape_string($_POST['node_long']);
			
			
				
			$sql1 = "INSERT INTO idea(idea_name,frn_human,idea_msg) VALUES('" . implode("','", $idearows) . "')";

			
			if (!$mysqli->query($sql1))
			{
				printf("sql1 :There was an error processing your request \n make sure that all the correct fields are filled");
				unset($rows);
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../View/idea_input.php">';
			}
			//last idea row inserted
			$id_idea = $mysqli->insert_id;
			
			
			
			$sql3 = "INSERT INTO circle(circle_fillColor,circle_strokeColor) VALUES('FF00F0','0F4F82')";
	
			if (!$mysqli->query($sql3))
			{
				printf("sql3: There was an error processing your request \n make sure that all the correct fields are filled");
				unset($rows);
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../View/idea_input.php">';
			}
			
			//last node row inserted
			$id_circle = $mysqli->insert_id;
			
			$sql2 = "INSERT INTO node(frn_idea,node_lat,node_long,frn_circle) VALUES('".$id_idea."','".$node_latitude."','". $node_longitude."','".$id_circle."')";
			
			if (!$mysqli->query($sql2))
			{
				printf("sql2: There was an error processing your request \n make sure that all the correct fields are filled");
				unset($rows);
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../View/idea_input.php">';
			}
			
			
			unset($rows);
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../../init_map.php">';

	}
	else
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../View/idea_input.php">';
	}
	

	$mysqli->close();
?>




