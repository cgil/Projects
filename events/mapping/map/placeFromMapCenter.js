function placeFromMapCenter(map)
{
	var latlang = map.getCenter();
	latlang = new String(latlang);
	var coordparts = latlang.split(/[(,)]+?/);
	var lati = coordparts[1];
	var longi = coordparts[2];
	var latlng = new google.maps.LatLng(lati, longi);

	geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
   		  var result=results[0].address_components;
          var info=[];
          for(var i=0;i<result.length;++i)
          {
              if(result[i].types[0]=="administrative_area_level_1"){info.push(result[i].long_name)}
              if(result[i].types[0]=="locality"){info.unshift(result[i].long_name)}
          }
		  var citystate = info.join(',');
          return citystate;
        } 
		else{
			thiscity = "hi";
			return thiscity;
		}
    });

}