<?php
require_once("memeWrite.php");

$_imageUrl = $_GET["url"];
$_line1 = $_GET["line1"];
$_line2 = $_GET["line2"];
$_path = $_GET["path"];

writeImageToFile($_imageUrl, $_line1, $_line2, $_path);

?>