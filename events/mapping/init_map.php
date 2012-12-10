<?php
	require_once("../../nodefy_beta/header_files/header.php");
	require_once("../../nodefy_beta/config_database/config.php");
?>


<script language="javascript" src="../../nodefy_beta/mapping/map/my_geolocation.js"></script>
<script language="javascript" src="../../nodefy_beta/mapping/map/twitter_pop.js"></script>
<script language="javascript" src="../../nodefy_beta/mapping/map/placeFromMapCenter.js"></script>



<script type="text/javascript">

var geocoder;
var map;

function initialize() {
	
  geocoder = new google.maps.Geocoder();
	
  var myOptions = {
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  var markersArray = [];
  var circleArray = [];

  
  //Get Initial User Geo-location
  get_user_geolocation(map);


	function request_data()
	{
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{		

		var x = 1;
		var y=0;
	   nodeObject = JSON.parse(xmlhttp.responseText);
	   
	  // drawMarkersOnMap(map, nodeObject);
	   
	   
	   
	   
	  function deleteOverlays() {
		if (markersArray) {
		  for (i in markersArray) {
			markersArray[i].setMap(null);
			if(i < circleArray.length){
				circleArray[i].setMap(null);
			}
		  }
		  markersArray.length = 0;
		  circleArray.length = 0;
		}
	  } 
	   
	   deleteOverlays();
	   
	   for(var i in nodeObject){
	   		name = nodeObject[i].name;
			msg = nodeObject[i].msg;
			lat = nodeObject[i].lat;
			lng = nodeObject[i].lng;
			fillCol = "#"+nodeObject[i].fill;
			strokeCol = "#"+nodeObject[i].stroke;
			thecenter = new google.maps.LatLng(lat,lng); 
			theradius = nodeObject[i].hits* 5;
			key = nodeObject[i].key;
			x +=200;
			
			var populationOptions = {
			  strokeColor: strokeCol,
			  strokeOpacity: 0.8,
			  strokeWeight: 2,
			  fillColor: fillCol,
			  fillOpacity: 0.11,
			  map: map,
			  center: thecenter,
			  radius: theradius
			};
			cityCircle = new google.maps.Circle(populationOptions);
			markersArray.push(cityCircle);
			var image = new google.maps.MarkerImage('../Images/leaf_small.png',
		  	// This marker is 20 pixels wide by 32 pixels tall.
		 	 new google.maps.Size(22, 22),
		 	 // The origin for this image is 0,0.
		 	 new google.maps.Point(0,0),
		 	 // The anchor for this image is the base of the flagpole at 0,32.
		 	 new google.maps.Point(3, 17) );
		 	 
			var nodeMarker = new google.maps.Marker({
				title:name,
				position: new google.maps.LatLng(lat,lng),
				map: map,
				icon:image
			});
			nodeMarker.set('message', msg);
			nodeMarker.set('name', name);
			nodeMarker.set('hits', theradius);
			nodeMarker.set('key', key);
			google.maps.event.addListener(nodeMarker, 'click',
			 function() {
				 var info = new google.maps.InfoWindow({
					 content:"<b>" + this.get('name') + "</b>: " + this.get('message')+"<br/><br/><form><input type=\"button\" value=\"spread\" onclick=\"growThis(0,"+this.get('key')+")\" class=\"likebutton\" /> <input type=\"button\" value=\"attending\" onclick=\"growThis(1,"+this.get('key')+")\" class=\"attendingbutton\" /></form>"

				 });
				 info.open(map, this);
			 });
  		}
		window.setTimeout(request_data,4000);

		}
	  }
	xmlhttp.open("GET","map/pull_node.php",true);
	xmlhttp.send();
	}

	request_data();
	
}



/* Geocode search bar */

  function codeAddress(type) {
	if(type == 'search'){
    	var address = document.getElementById("address").value;
	} else if(type == 'create'){
		var address = document.getElementById("create_address").value;
	}
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if(type == 'search'){
			map.setCenter(results[0].geometry.location);
			
			
			/* Get city and state abbr */
		  	var result=results[0].address_components;
          	var info=[];
          	for(var i=0;i<result.length;++i)
          	{
              	if(result[i].types[0]=="administrative_area_level_1"){info.push(result[i].long_name)}
              	if(result[i].types[0]=="locality"){info.unshift(result[i].long_name)}
          	}
			
			twitter_populate(info[0],info[1]);
			
			request_data();
		} else if(type == 'create'){
			var coords = new String(results[0].geometry.location);
			var parts = coords.split(/[(,)]+?/);
			var node_lati = parts[1];
			var node_longi = parts[2];
			validateFields(node_lati,node_longi);
		}
       /* var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        }); */
      } else {
        /* alert("Geocode was not successful for the following reason: " + status); */
      }
    });
  }



/* Grow Node */
function growThis(type,node){
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			request_data();	
		}
	  }
	  
	if(type == 0){
		xmlhttp.open("GET","map/like_node.php?node="+node,true);
	}
	else if(type == 1){
		xmlhttp.open("GET","map/attending_node.php?node="+node,true);
	}

	xmlhttp.send();

}


</script>

<div class="collection">

	<div class="searchbox">
    <form><input type="text" name="searchbar" class="searchbar" id="address"/> <input type="button" name="search" value="search" class="searchbutton" onclick="codeAddress('search')"/></form>
    </div>    
    <div class="map_container">
        <div id="map_canvas">
        </div>       
    </div>
    
    
 
<?php

 	require($DOCUMENT_ROOT . "ticker_box/news_ticker/ticker.html");

?>

<?php

	require_once("../../nodefy_beta/mapping/new_idea/View/idea_input.php");
	
?>

</div>

<?php
	require_once("../../nodefy_beta/header_files/footer.php");
?>