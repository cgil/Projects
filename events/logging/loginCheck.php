<?php
	require_once("../header_files/loginHeader.php");
	require_once("../config_database/config.php");
?>

<?php
	$login_username = $mysqli->real_escape_string($_POST['username']);
	$login_password = $mysqli->real_escape_string($_POST['password']);
	$login_sql = "SELECT * FROM users WHERE username = '$login_username' AND password = '$login_password'";
	$login_result = $mysqli->query($login_sql);
	if(!$login_result)
	{
		printf("Error: " . $mysqli->error);
	}
	
	$num_rows = $login_result->num_rows;
	if($num_rows == 1) /* Successful login */
	{
		$row = mysqli_fetch_assoc($login_result);
		$_SESSION['id'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../home/home.php">';
	}
	else /* Unsuccessful login */
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=loginPage.php">';
	}
?>

<?php $mysqli->close(); ?>

<?php
	require_once("../header_files/footer.php");
?>