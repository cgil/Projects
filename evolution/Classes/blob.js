function Blob(_circle, _id) 
{ 
	this.type = "Blob";
	this.id = _id;
	this.status = "alive";
	this.circle = _circle;
	this.velocity = 
	{
    	x: 0,
        y: 0
    }
	this.focusVector =
	{
		x: 100,
		y: 100	
	}
	this.maxSpeed = 16;
	this.health = 100;
}

