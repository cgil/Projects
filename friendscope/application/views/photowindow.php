<head>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div class="picture-box">
<?php
##TRASH REALLY, JUST TESTING
$imgsrc1 = "http://profile.ak.fbcdn.net/hprofile-ak-ash2/371793_1160936468_1120988847_q.jpg";
$imgsrc2 = "http://desmond.imageshack.us/Himg262/scaled.php?tn=1&server=262&filename=twitterrl3.png&res=crop";
$photo1 = array();
$photo1[1] = $imgsrc1;
$photo2 = array();
$photo2[1] = $imgsrc1;
$data = array();
$data[] = $photo1;
$data[] = $photo2;

##DISPLAYS PICTURES
foreach($data as $photo_obj){
	echo "<a href='".$photo_obj[1]."' style='width:150px; height:140px; float:middle;'>";
	echo "<br/>";
	echo "<img class='image' src='".$photo_obj[1]."' style='display:inline; max-height:140px; max-width:140px;'>";
	echo "<br/></a>";
}
?>
</div>
</body>