function checkIfInRadius(visionLat, visionLong, visionRadius, nodeLat, nodeLong, nodeRadius)
{
	var distance = Math.sqrt((visionLat-nodeLat) * (visionLat-nodeLat) +
							(visionLong - nodeLong) * (visionLong - nodeLong));
	return (distance < visionRadius + nodeRadius);
	
}

function removeOutOfRangeNodes(nodes, visionLat, visionLong, visionRadius)
{
	var returnArr = new Array();
	var index = 0;
	for (var node in nodes) {
		var lat = node.lat;
		var lng = node.lng;
		if (checkIfInRadius(visionLat, visionLong, visionRadius, lat, lng, node.hits)) {
			returnArr[index] = node;
			index++;
		}
	}
	
	return returnArr;
}
		