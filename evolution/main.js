window.onload = function() 
{
	/********** Config ***********/
	config = {
		totalBlobs: 9,
		totalOodles: 30,
		stageWidth: 1270,
		stageHeight: 630,
		oodleRadius: 2,
		blobRadius: 40,
		frameRate: 1000,
		
		// physics variables
		gravity : 0, // px / second^2 (default: 10)
		collisionDamper: 0.0, // 20% energy loss (default: 0.2)
		floorFriction: 0, // px / second^2 (default: 5),
		timer: 0
	}
	
	/*****************************/
	
	blobLayer = new Kinetic.Layer();
	oodleLayer = new Kinetic.Layer();
	
	var stage = new Kinetic.Stage({
	  container: "container",
	  width: config.stageWidth,
	  height: config.stageHeight
	});
	
	//Initiate the creature classes
	setupBlobs();
	setupOodles();
	
	
	stage.onFrame(function(frame) 
	{
		animate(frame);
	});
	
	//Ready, Set, Go!
	stage.start();
	
	
	/*********************************** Functionality and logic **********************************************/
	
	//Initiate and setup the stage with Blobs
	function setupBlobs()
	{	
		//Create Blobs
		Blobs = new Array();
		for (var i = 0; i < config.totalBlobs; i++)
		{
			var circle = new Kinetic.Circle(
			{
				x: 150,
				y: 100,
				radius: config.blobRadius,
				fill: "blue",
				stroke: "black",
				strokeWidth: 4,
				draggable: true
			});
			
			var blob = new Blob(circle, i);
			blob.circle.setX(Math.floor(Math.random()*700) );
			blob.circle.setY(Math.floor(Math.random()*500) );
			
			Blobs.push(blob);
			blobLayer.add(Blobs[i].circle);
			
			Blobs[i].circle.on("dragstart", function()
			{
					blob.velocity = {
						x: 0,
						y: 0
					};
			});
	 
			Blobs[i].circle.on("mouseover", function(){
				document.body.style.cursor = "pointer";
			});
	 
			Blobs[i].circle.on("mouseout", function(){
				document.body.style.cursor = "default";
			});
			
		}
		
		stage.add(blobLayer);
	}
	
	//Initiate and setup stage with Oodles
	function setupOodles()
	{		
		//Create Blobs
		Oodles = new Array();
		for (var i = 0; i < config.totalOodles; i++)
		{
			var circle = new Kinetic.Circle(
			{
				x: 150,
				y: 100,
				radius: config.oodleRadius,
				fill: "red",
				stroke: "black",
				strokeWidth: 4,
				draggable: true
			});
			
			var oodle = new Oodle(circle, i);
			//Give them different colors for show
			oodle.circle.setX(Math.floor(Math.random()*700) );
			oodle.circle.setY(Math.floor(Math.random()*500) );
			
			Oodles.push(oodle);
			oodleLayer.add(Oodles[i].circle);
			
			Oodles[i].circle.on("dragstart", function()
			{
					oodle.velocity = {
						x: 0,
						y: 0
					};
			});
	 
			Oodles[i].circle.on("mouseover", function(){
				document.body.style.cursor = "pointer";
			});
	 
			Oodles[i].circle.on("mouseout", function(){
				document.body.style.cursor = "default";
			});
			
		}
		
		stage.add(oodleLayer);
	}
	
	
	
	//Animate the creatures
	function animate(_frame)
	{	
		//Only draw every other frame for efficiency
		if ( config.timer % 2 )
		{
			oodleCenterOfMass = oodlesCenterOfMass();
			//Update Blobs
			var blobsLength = Blobs.length;
			for (var i = 0; i < blobsLength; i++)
			{
				updateBlob(Blobs[i], _frame)
			}
			//Update Oodles
			var oodlesLength = Oodles.length;
			for (var i = 0; i < oodlesLength; i++)
			{
				updateOodle(Oodles[i], _frame)
			}
		
			blobLayer.draw();
			oodleLayer.draw();
			
			//Delete any blobs that died this frame
			removeDeadBlobs();
		}
		config.timer++;
		if (config.timer > 10000)
		{
			config.timer = 1;	
		}
	}
	
	//Calculates blobs movement
	function updateBlob(_blob, _frame)
	{
		var ball = _blob.circle;
		
		var timeDiff = _frame.timeDiff;
		var stage = ball.getStage();
		ball.radius = ball.getRadius().x;
		stage.height = stage.getHeight();
		stage.width = stage.getWidth();
		
		// physics variables
		var gravity = config.gravity; 
		var speedIncrementFromGravityEachFrame = gravity * timeDiff / config.frameRate;

		if (ball.isDragging()) {
			var mousePos = stage.getMousePosition();
	
			if (mousePos !== null) {
				var mouseX = mousePos.x;
				var mouseY = mousePos.y;
	
				var c = 0.06 * timeDiff;
				_blob.velocity = {
					x: c * (mouseX - ball.lastMouseX),
					y: c * (mouseY - ball.lastMouseY)
				};
	
				ball.lastMouseX = mouseX;
				ball.lastMouseY = mouseY;
			}
        }
        else 
		{
			// gravity
			_blob.velocity.y += speedIncrementFromGravityEachFrame;
			
			//Determine movement focus
			setBlobFocus(_blob);
			
			//Move towards blob focus
			moveToFocus(_blob, timeDiff);
			
			//Handle speed boundaries
			handleSpeedBoundary(_blob);
			
			ball.setX(ball.getX() + _blob.velocity.x);
			ball.setY(ball.getY() + _blob.velocity.y);
			
			handleBoundaryCollision(_blob, _frame);
			
			//Check for collision
			handleCollisions(_blob);
	
		}
	}
	
	
	
	//Calculates oodle movement
	function updateOodle(_oodle, _frame)
	{
		var ball = _oodle.circle;
		
		var timeDiff = _frame.timeDiff;
		var stage = ball.getStage();
		var startBallX = ball.getX();
		var startBallY = ball.getY();
		ball.radius = ball.getRadius().x;
		stage.height = stage.getHeight();
		stage.width = stage.getWidth();
		
		// physics variables
		var gravity = config.gravity; 
		var speedIncrementFromGravityEachFrame = gravity * timeDiff / config.frameRate;
		var collisionDamper = config.collisionDamper; 
		var floorFriction = config.floorFriction; 
		var floorFrictionSpeedReduction = floorFriction * timeDiff / config.frameRate;

		if (ball.isDragging()) {
			var mousePos = stage.getMousePosition();
	
			if (mousePos !== null) {
				var mouseX = mousePos.x;
				var mouseY = mousePos.y;
	
				var c = 0.06 * timeDiff;
				_oodle.velocity = {
					x: c * (mouseX - ball.lastMouseX),
					y: c * (mouseY - ball.lastMouseY)
				};
	
				ball.lastMouseX = mouseX;
				ball.lastMouseY = mouseY;
			}
        }
        else 
		{
			//gravity
			_oodle.velocity.y += speedIncrementFromGravityEachFrame;	
			
			//Determine the next target
			setOodleFocus(_oodle);
			
			//Move towards oogles focus
			moveToFocus(_oodle, timeDiff);
			
			//Handle max speed boundary
			handleSpeedBoundary(_oodle);
	
			ball.setX(ball.getX() + _oodle.velocity.x);
			ball.setY(ball.getY() + _oodle.velocity.y);
			
			handleBoundaryCollision(_oodle, _frame);
			
			//Check for collision
			handleCollisions(_oodle);
	
		}
	}
	
	//Get the oodles center of mass
	function oodlesCenterOfMass()
	{
		var centerOfMass = {
			x: stage.width/2,
			y: stage.height/2	
		};
		var xMoment = 0;
		var yMoment = 0;
		var totalMass = 0;
		
		var oodlesLength = Oodles.length;
		if (oodlesLength > 0)
		{
			for (var i = 0; i < oodlesLength; i ++)
			{
				xMoment += (Oodles[i].circle.getRadius().x * Oodles[i].circle.getX());
				yMoment += (Oodles[i].circle.getRadius().y * Oodles[i].circle.getY());
				
				totalMass += Oodles[i].circle.getRadius().x;
			}
			
			if (totalMass > 0 )
			{
				centerOfMass.x = xMoment/totalMass;
				centerOfMass.y = yMoment/totalMass;
			}
		}
		
		return centerOfMass;
	}
	
	
	//Set the Blobs new focus
	function setBlobFocus(_blob)
	{
		blobFlee(_blob);
	}
	
	function blobFlee(_blob)
	{
		var currentPosition = {
			x: _blob.circle.getX(),
			y: _blob.circle.getY()
		};
		var fleeNormal = calculateNormal(currentPosition, oodleCenterOfMass);
		_blob.focusVector.x = _blob.circle.getX() + fleeNormal.x*-1*_blob.circle.getRadius().x;
		_blob.focusVector.y = _blob.circle.getY() + fleeNormal.y*-1*_blob.circle.getRadius().x;
		
	}
	
	//Set the oodles new focus
	function setOodleFocus(_oodle)
	{
		if (Blobs.length > 0 )
		{
			blobTarget = Blobs[0].circle;
			_oodle.focusVector.x = blobTarget.getX();
			_oodle.focusVector.y = blobTarget.getY();
		}
		else
		{
			_oodle.focusVector.x = stage.width/2;
			_oodle.focusVector.y = stage.height/2;
		}
	}
	
	//Move creature towards focus
	function moveToFocus(_creature, _timeDiff)
	{
		var ball = _creature.circle;
		var velocityVector = {
			x: 1,
			y: 1
		}
		var dx = Math.abs(ball.getX() - _creature.focusVector.x);
		var dy = Math.abs(ball.getY() - _creature.focusVector.y);
		
		//Get the direction towards focus
		if (ball.getX() > _creature.focusVector.x)
		{
			velocityVector.x *= -1;
		}
		else if (ball.getX() == _creature.focusVector.x)
		{
			velocityVector.x = 0;
		}
		if (ball.getY() > _creature.focusVector.y)
		{
			velocityVector.y *= -1;
		}
		else if (ball.getY() == _creature.focusVector.y)
		{
			velocityVector.y = 0;
		}
		
		var speedIncrementFromFocusEachFrameX = (dx) *velocityVector.x* _timeDiff / config.frameRate;
		var speedIncrementFromFocusEachFrameY = (dy) *velocityVector.y* _timeDiff / config.frameRate;
		
		_creature.velocity.x += speedIncrementFromFocusEachFrameX;	
		_creature.velocity.y += speedIncrementFromFocusEachFrameY;	
	
	}
	
	//Set Max speed for creatures
	function handleSpeedBoundary(_creature)
	{
		if (Math.abs(_creature.velocity.x) > _creature.maxSpeed)
		{
			if ( _creature.velocity.x >= 0)
			{
				_creature.velocity.x = _creature.maxSpeed;
			}
			else
			{
				_creature.velocity.x = _creature.maxSpeed*-1;
			}
		}
		if (Math.abs(_creature.velocity.y) > _creature.maxSpeed)
		{
			if ( _creature.velocity.y >= 0)
			{
				_creature.velocity.y = _creature.maxSpeed;
			}
			else
			{
				_creature.velocity.y = _creature.maxSpeed*-1;
			}
		}
		
	}
	
	//Handle wall collisions
	function handleBoundaryCollision(_blob, _frame)
	{
		var ball = _blob.circle;
		
		var timeDiff = _frame.timeDiff;
		var stage = ball.getStage();
		var collisionDamper = config.collisionDamper; 
		var floorFriction = config.floorFriction; 
		var floorFrictionSpeedReduction = floorFriction * timeDiff / config.frameRate;
	
		// ceiling condition
		if (ball.getY() < ball.radius) {
			ball.setY(ball.radius);
			_blob.velocity.y *= -1;
			_blob.velocity.y *= (1 - collisionDamper);
		}
	
		// floor condition
		if (ball.getY() > (stage.height - ball.radius)) {
			ball.setY(stage.height - ball.radius);
			_blob.velocity.y *= -1;
			_blob.velocity.y *= (1 - collisionDamper);
		}
	
		// floor friction
		if (ball.getY() == stage.height - ball.radius) {
			if (_blob.velocity.x > 0.1) {
				_blob.velocity.y -= floorFrictionSpeedReduction;
			}
			else if (_blob.velocity.x < -0.1) {
				_blob.velocity.x += floorFrictionSpeedReduction;
			}
			else {
				_blob.velocity.x = 0;
			}
		}
	
		// right wall condition
		if (ball.getX() > (stage.width - ball.radius)) {
			ball.setX(stage.width - ball.radius);
			_blob.velocity.x *= -1;
			_blob.velocity.x *= (1 - collisionDamper);
		}
	
		// left wall condition
		if (ball.getX() < (ball.radius)) {
			ball.setX(ball.radius);
			_blob.velocity.x *= -1;
			_blob.velocity.x *= (1 - collisionDamper);
		}	
	
	}
	
	//Handle Blob and Oodle collisions
	function handleCollisions(_creature)
	{
		var allCreatures = Blobs.concat(Oodles);
		var allCreaturesLength = allCreatures.length;
		
		var blobsLength = Blobs.length;
		var curveDamper = config.collisionDamper; 
		//Loop through every creature to test for collision
		for (var i = 0; i < allCreaturesLength; i++)
		{
			var otherCreature = allCreatures[i];
			
			//Ignore if self and check if blobs are colliding
			if (!compareCreatures(_creature, otherCreature) && areColliding(_creature, otherCreature))
			{
				var normal = getNormal(_creature, otherCreature);
                if (normal !== null) 
				{
					normal.x *= -1;
					normal.y *= -1;
                    var angleToNormal = angleBetween(normal, invert(_creature.velocity));
                    var crossProduct = cross(normal, _creature.velocity);
                    var polarity = crossProduct.z > 0 ? 1 : -1;
                    var collisonAngle = polarity * angleToNormal * 2;
                    var collisionVector = rotate(_creature.velocity, collisonAngle);
					//Conservation of momentum
						handleMomentumTransfer(_creature, otherCreature);
 					
					if (!isNaN(collisionVector.x) && !isNaN(collisionVector.y))
					{
						_creature.velocity.x = collisionVector.x;
						_creature.velocity.y = collisionVector.y;
						_creature.velocity.x *= (1 - curveDamper);
						_creature.velocity.y *= (1 - curveDamper);
					}
					
					if (_creature.type != otherCreature.type)
					{
						if (_creature.type == "Oodle")
						{
							oodleAttack(_creature, otherCreature);
						}
						else
						{
							oodleAttack(otherCreature, _creature);
						}
					}
					
					var escapeCount = 0;
					//bubble ball up to the surface of the curve
                    while (areColliding(_creature, otherCreature) && escapeCount < 20) 
					{
                        _creature.circle.setX(_creature.circle.getX() + (normal.x));
						_creature.circle.setY(_creature.circle.getY() + normal.y);
						
						escapeCount++;
                    }
				}
			}
		}
	}
	
	//Momentum transfer calculate new velocity
	function handleMomentumTransfer(_creature1, _creature2)
	{
		var m1 = _creature1.circle.getRadius().x;
		var m2 = _creature2.circle.getRadius().x;
		
		var vX1 = _creature1.velocity.x;
		var vY1 = _creature1.velocity.y;
		
		var v1Xf = ((m1 - m2)*vX1)/(m1 + m2);
		var v2Xf = (2*m1 * vX1)/(m1 + m2);
		
		var v1Yf = ((m1 - m2)*vY1)/(m1 + m2);
		var v2Yf = (2*m1 * vY1)/(m1 + m2);
		
		_creature1.velocity.x = v1Xf;
		_creature1.velocity.y = v1Yf;
		
		_creature2.velocity.x = v2Xf;
		_creature2.velocity.y = v2Yf;			
	}
	
	//Oodle attacks a blob
	function oodleAttack(_oodle, _blob)
	{
		//Blob looses some health
		var blobRadius = _blob.circle.getRadius();
		blobRadius.x -= _oodle.attackPower;
		blobRadius.y -= _oodle.attackPower;
		if (blobRadius.x <= 5 || blobRadius.y <= 5)
		{
			blobDied(_blob);
		}
		else
		{
			_blob.circle.setRadius(blobRadius);	
		}
		
		//Oodle gains some points for attacking
		_oodle.points += _oodle.attackPower;
	}
	
	//Set blob status to dead
	function blobDied(_blob)
	{
		_blob.status = "dead";
	}
	
	//Clean up dead Blobs
	function removeDeadBlobs()
	{
		if (Blobs.length > 0)
		{
			for (var i = Blobs.length - 1; i >= 0; i--)
			{
				if (Blobs[i].status == "dead")
				{
					var currentBlob = Blobs[i];
					blobLayer.remove(Blobs[i].circle);
					Blobs.splice(i, 1);
				}
			}
		}
		else
		{
			blobLayer.removeChildren();
		}
	}
	
	//Compare if two creatures are the same
	function compareCreatures(_creature1, _creature2)
	{
		if ((_creature1.type == _creature2.type) && (_creature1.id == _creature2.id))
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	//Collision detection
	function areColliding(_blob1, _blob2) 
	{
		var blobX = _blob1.circle.getX();
		var blobY = _blob1.circle.getY();
		var blob2X = _blob2.circle.getX();
		var blob2Y = _blob2.circle.getY();
		var blobRadius = _blob1.circle.getRadius().x;
		var blob2Radius = _blob2.circle.getRadius().x;
		
        //early returns speed it up
        if (blobX - blobRadius > blob2X + blob2Radius) { return; }
        if (blobX + blobRadius < blob2X - blob2Radius) { return; }
        if (blobY - blobRadius > blob2Y + blob2Radius) { return; }
        if (blobY + blobRadius < blob2Y - blob2Radius) { return; }

        //now do the circle distance test
        return blob2Radius + blobRadius > Math.sqrt(Math.pow(Math.abs(blob2X - blobX), 2) + Math.pow(Math.abs(blob2Y - blobY), 2));
    }
	 
  
};
