<?php
	require_once("../../../config_database/config.php");
?>

<?php
	
	/* $sql = "INSERT INTO image(frn_node,image_name,image_location)
			VALUES('$thisNode','$thisName','$thisLocation')"; */
		
	$frn_node = 1;
		
	for($i=0; $i < count($_FILES); $i++){
		if (($_FILES["file_".$i]["type"] == "image/gif")
  			|| ($_FILES["file_".$i]["type"] == "image/jpeg")
  			|| ($_FILES["file_".$i]["type"] == "image/png" )
  			&& ($_FILES["file_".$i]["size"] < 30000)
			&&  ($_FILES["file_".$i]["error"] == 0)){
	
			$sbImage = "../../../Images/nodeImages/".rand(0,99)."_".$_FILES["file_".$i]["name"];
  			move_uploaded_file($_FILES["file_".$i]["tmp_name"],$sbImage);
   
  		}
		else{
  			$sbImage = "";
  		}  
		
		
	   if($sbImage != ""){
		   $rows[] = $frn_node . "'," .
					 "'" . $sbImage . "'," .
					 "'" . $sbImage;
	
			$sql = "INSERT INTO image(frn_node,image_name,image_location) VALUES('" . implode("','", $rows) . "')";
			 if (!$mysqli->query($sql)) {
				  printf("There was an error processing your request\n make sure that all the correct fields are filled. ".$mysqli->error);
			 }
			 unset($rows);
	   } 
  
		
		
		
	}
?>


		


<?php
	$mysqli->close();	
?>