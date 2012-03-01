<?php
	require_once("../config_database/config.php");
?>

<?php

	/*Should write function to validate username, email, password===password2 */

	if(isset($_POST['username']) && trim($_POST['username']) != "")
	{
		if(isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] === $_POST['password2'])
		{
			$rows[] = $mysqli->real_escape_string($_POST['username']) . "'," .
				"'" . $mysqli->real_escape_string($_POST['email']) . "'," .
				"'" . $mysqli->real_escape_string($_POST['password']);
				
			$sql = "INSERT INTO users(username,email,password) VALUES('" . implode("','", $rows) . "')";
			if (!$mysqli->query($sql))
			{
				printf("There was an error processing your request \n make sure that all the correct fields are filled");
				unset($rows);
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=registerPage.php">';
			}
			
			unset($rows);
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=registerSuccessful.php">';
		}
	}
	else
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=registerPage.php">';
	}
	
?>

<?php $mysqli->close(); ?>