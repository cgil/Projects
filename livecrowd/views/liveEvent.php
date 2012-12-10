<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config/config.php');

//Controllers
require_once(__ROOT__.'/controllers/event.php');

//Models
require_once(__ROOT__.'/models/event_model.php');

?> 

<!DOCTYPE html>
<html>
  <head>
    <link href="http://www.nodefy.com/livecrowd/CSS/main.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="http://www.nodefy.com/livecrowd/Images/favicon.ico" type="image/x-icon">
    <script language="JavaScript" src="http://www.nodefy.com/livecrowd/javascript/event.js"></script>
	<script type="text/javascript">

	function handleForm(){
	  var actionType=document.forms["myform"]["search"].value;
	  var textInput=document.forms["myform"]["textInput"].value;

	  if (textInput==null || textInput=="")
	  {
		return false;
	  }
	  if(actionType == 1){
		  get_events(textInput,actionType);
		  return false;
	  }
	  else if(actionType == 2){
			//Create  
			return false;
	  }

	}
	
	function resize(channel){
	
		document.getElementById("utv"+channel).style+="height : 500px;";
		
	}
	
    </script>
  </head>
  <body>
	<div class="main_container">
        <div id="header">
            <?php require_once(__ROOT__.'/views/header.php'); ?>
        </div>
        
        <div class="input_container">
            <form name="myform" method="post">
                <select name="search" class="dropdown">
                <option value="1">Search</option>
                <option value="2">Create</option>
                </select>
                <input name="textInput" type="text" />
                <input type="button" onClick="handleForm()" value="Go" class="subbutton2">
            </form>
        </div>
        <?php 
		$userEvent = "hack";
		if(isset($_GET['event']))
			$userEvent = $_GET['event'];

		
		$userArr = getUsers($userEvent);
		if($userArr){
		$tempUserData = formUserData($userArr);
		
		$userData = normalizeGPSValues($tempUserData);
		foreach($userData as $user){
			$channel = $user['channel'];
			$ustreamUID = $user['ustreamUID'];
			$x = $user['x'];
			$y = $user['y'];
			
		?>
 			<div class="random"  onMouseOver="resize('<?php  echo $channel ?>')">
           <iframe class="frame2" id="<?php echo $channel ?>" style="left: <?php echo $x ?>px; top: <?php echo $y ?>px;" src="http://www.ustream.tv/embed/<?php  echo $channel ?>" ></iframe>
           
           </div>
            
 
        <?php
		}
		
		}
		?>
        
        
        
        <div class="event_container">
            <img src="../Images/rashid_event.jpg" alt="stadium"/> 
        </div>
        
        <div id="event_search">
        </div>
    
    </div>


  </body>
</html>