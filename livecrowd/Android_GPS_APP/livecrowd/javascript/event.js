function get_events(eventName,actionType){
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function(){
  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		var events_resp = JSON.parse(xmlhttp.responseText);
		if(events_resp){
			var theHTML = "<a href='http://www.nodefy.com/livecrowd/views/liveEvent.php?event="+events_resp+"'>"+ events_resp +"</a>";
			document.getElementById("event_search").innerHTML = theHTML;
		}
    }
  }
	xmlhttp.open("GET","http://www.nodefy.com/livecrowd/controllers/search.php?actionType="+actionType+"&eventName="+eventName,true);
	xmlhttp.send();
} 