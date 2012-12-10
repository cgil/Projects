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

   nodeObject = JSON.parse(xmlhttp.responseText);
   
   for(var i in nodeObject){
	   
   	alert(nodeObject[i].msg);
   }
    //document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	
    }
  }
xmlhttp.open("GET","pull_node.php",true);
xmlhttp.send();
}