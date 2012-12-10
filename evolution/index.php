<?php
/*********************** Include this in every PHP page ***********************/
//Set the directory path to file root
set_include_path($_SERVER["DOCUMENT_ROOT"]);
/******************************************************************************/
?> 
<!DOCTYPE HTML>
<html>
  <head>
  	<title>Evolution</title>
    <link href="CSS/main.css" rel="stylesheet" type="text/css">
    <script src="Libraries/math.js" type="text/javascript"></script>
    <script src="Libraries/kineticJS.js" type="text/javascript"></script>
    <script src="Classes/blob.js" type="text/javascript"></script>
    <script src="Classes/oodle.js" type="text/javascript"></script>
    
    <script src="main.js" type="text/javascript"></script>
  </head>
  <body>
    <div id="container"></div>
  </body>
</html>