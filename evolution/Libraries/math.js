

/*
 * Vector math functions
 */
function dot(a, b)
{
	return ((a.x * b.x) + (a.y * b.y));
}

function magnitude(a)
{
	return Math.sqrt((a.x * a.x) + (a.y * a.y));
}

function add(a, b)
{
	return {
		x: a.x + b.x,
		y: a.y + b.y
	};
}

function angleBetween(a, b)
{
	return Math.acos(dot(a, b) / (magnitude(a) * magnitude(b)));
}

function rotate(a, angle)
{
	var ca = Math.cos(angle);
	var sa = Math.sin(angle);
	var rx = a.x * ca - a.y * sa;
	var ry = a.x * sa + a.y * ca;
	return {
		x: rx * -1,
		y: ry * -1
	};
}

function invert(a)
{
	return {
		x: a.x * -1,
		y: a.y * -1
	};
}

function cross(a, b)
{
	return {
		x: 0,
		y: 0,
		z: (a.x * b.y) - (b.x * a.y)
	};
}


//Calculate the normal vector
function getNormal(_creature1, _creature2)
{
	var x1 = _creature1.circle.getX();
	var y1 = _creature1.circle.getY();
	var x2 = _creature2.circle.getX();
	var y2 = _creature2.circle.getY();
	
	var dx = x2 - x1;
	var dy = y2 - y1;
	var normal = {
				x: dx,
				y: dy
	};
	
	var normalizedNormal = normalizeNormal(normal);
	return normalizedNormal;
}

//General case get Normal
function calculateNormal(_pos1, _pos2)
{
	var x1 = _pos1.x;
	var y1 = _pos1.y;
	var x2 = _pos2.x;
	var y2 = _pos2.y;
	
	var dx = x2 - x1;
	var dy = y2 - y1;
	var normal = {
				x: dx,
				y: dy
	};
	
	var normalizedNormal = normalizeNormal(normal);
	return normalizedNormal;
	
}

//Normalize the normal vector
function normalizeNormal(normal)
{

	var mag = magnitude(normal);

	if (mag == 0) {
		return {
			x: 0,
			y: 0
		};
	}
	else {
		return {
			x: normal.x / mag,
			y: normal.y / mag
		};
	}	
}