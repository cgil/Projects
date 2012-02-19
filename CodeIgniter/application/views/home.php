<!DOCTYPE HTML>
<html>
   <head>
   	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Friendscope</title>
      <meta name="description" content="View your friend's friends pictures." /> 
   	  <meta name="keywords" content="social networking, social, network, hot, spot, trends, popular, friends, facebook, face, book, photo's, creepy, stalk, view, look at, look, hack photo's" /> 
      <meta http-equiv="content-language" content="en">
      <link rel="stylesheet" type="text/css" href="
	  	<?php echo base_url(); ?>CSS/main.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="
	  	<?php echo base_url(); ?>CSS/lightbox.css" media="screen" />
      <link rel="icon" href="<?php echo base_url(); ?>Images/favicon.ico" type="image/x-icon">
		<script language="JavaScript" src="<?php echo base_url(); ?>js/photo_manip.js"></script>      
   </head>
   <body>
   		 <div id="banline">
			<img src="<?php echo base_url(); ?>Images/ban_line.png" alt="BanLine" height="55" width="100%" />
		 </div>
      <div id="wrapper">
		 <div id="backimg">
			<img src="<?php echo base_url(); ?>Images/background.png" alt="background" />
		 </div>
		 <div id="backimg2">
			<img src="<?php echo base_url(); ?>Images/background2.png" alt="background2" />
		 </div>
         <div id="header">
            <?= $header ?>
         </div>
         <div id="search" style="width:inherit;">
               <?= $search ?>
         </div>
         <div id="main" style="width:900px;">
            <div id="info" style="width:inherit;">
               <?= $info ?>
            </div>
            <div id="albums" style="width:inherit;">
               <?= $albums ?>
            </div>
            <div id="photos" style="width:inherit;">
               <?= $photos ?>
            </div>
            <div id="friendbar" style="width:inherit;">
               <?= $friendbar ?>
            </div>
         </div>
         <div id="footer" style="width:inherit;">
            <?= $footer ?>
         </div>
      </div>
   </body>
</html>