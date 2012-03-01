function createNode(node_name,node_msg,node_lat,node_long){
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
			//DO NOTHING WITH RESPONSE		
		}
	  }
/*
	xmlhttp.open("POST","map/like_node.php?node="+node,true);
	xmlhttp.send();
*/
		
	var n_name=encodeURIComponent(node_name);
	var n_message=encodeURIComponent(node_msg);
	var n_lat=encodeURIComponent(node_lat);
	var n_long=encodeURIComponent(node_long);
	
	var parameters="node_name="+n_name+"&node_msg="+n_message+"&node_lat="+n_lat+"&node_long="+n_long;
	xmlhttp.open("POST", "../mapping/new_idea/Controller/idea_query.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(parameters);

}




function validateFields(node_lat,node_long)
{
	var node_name=document.new_node.node_name.value;
	var node_msg=document.new_node.node_msg.value;
	
	var registerErrors=document.getElementById("loginErrors");
	var errors="";

/*
	var position = /^-?\d{1,6}$/i;
	*/

	
	if(node_name=="") errors += "Give your node a name.<br/>";
	if(node_msg=="") errors += "Give your node a description.<br/>";
	/*
	if(!(node_lat.match(position))) errors += "Latitude: 6 or less integers.<br/>";
	if(!(node_long.match(position))) errors += "Longitude: 6 or less integers.<br/>";
	*/

	registerErrors.innerHTML=errors;
	
	if(errors == ""){
		createNode(node_name,node_msg,node_lat,node_long);
	}
	
	return errors=="";
	
}



