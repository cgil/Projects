function Oodle(_circle, _id) 
{ 
	this.type = "Oodle";
	this.id = _id;
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
	
	this.maxSpeed = 10;
	this.health = 100;
	this.attackPower = 0.8;
	this.points = 0;
	
}

