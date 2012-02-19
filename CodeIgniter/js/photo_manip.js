function photo_popup(image,name){
		document.getElementById('light').style.display='block';
		document.getElementById('fade').style.display='block';
		document.getElementById('photo_insert').innerHTML = "<img src="+image+" width='500' alt="+name+"/>";
		document.getElementById("lightbox_container").style.position="fixed";
}

function get_photos_js(album_id,token){
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function(){
  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		var photos_resp = xmlhttp.responseText;
		document.getElementById("photos").innerHTML = photos_resp;
    }
  }
	xmlhttp.open("GET","http://www.nodefy.com/CodeIgniter/scope/Get_album_photos/"+album_id+"/"+token,true);
	xmlhttp.send();
} 

function get_albums_js(album_id){
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function(){
  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		var albums_resp = xmlhttp.responseText;
		document.getElementById("albums").innerHTML = albums_resp;
    }
  }
	xmlhttp.open("GET","http://www.nodefy.com/CodeIgniter/scope/Get_albums_by_ajax/"+album_id,true);
	xmlhttp.send();
} 
