<?php
	require_once("../header_files/header.php");
	require_once("../config_database/config.php");
?>

<?php
	echo "Welcome, " . $_SESSION['username'] . "!";
?>

<a href="../logging/logout.php">Logout</a>

<?php $mysqli->close(); ?>

<?php
	require_once("../header_files/footer.php");
?>