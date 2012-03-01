function twitter_populate(cityName,stateAbbr){
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
	  
	  	xmlhttp.open("GET","../mapping/new_feed/db_feed2.php?cityName="+cityName+"&stateAbbr="+stateAbbr,true);


	xmlhttp.send();

}

