function drawMarkersOnMap(map, nodes)
{
	var nodeIcon = new GIcon(G_DEFAULT_ICON);
	nodeIcon.iconSize = new google.maps.Size(20, 20);
	nodeIcon.iconAnchor = new google.map.Point(10, 10);
	nodeIcon.image = "Images/node.png"
	for (var node in nodes) {
		var markerOptions = {title:node.name, icon:nodeIcon};
		GEvent.addListener(marker, "click", function() {
            marker.openInfoWindowHtml(node.msg);
          });
        var marker = new GMarker(new google.maps.LatLng(node.lat, node.lng), markerOptions);
        map.addOverlay(marker);
    }
}