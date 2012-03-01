int totalBlobs = 0;
int leftPressed = 0;
ArrayList<Blobs> blobs;

void setup(){
 smooth();
 size(800,500);
 background(125,255,255); 
 blobs = new ArrayList<Blobs>();
 leftPressed = 0;
}

void draw(){
  background(125,255,255); 
  if(mousePressed && mouseButton == LEFT){
    leftPressed = 1;
  }

  update();
}

void update(){
  int xMove, yMove;
  int[] whereToMove = new int[2];
  int colliding = 0;
  for (Blobs b1 : blobs){ 
    whereToMove = b1.decideWhereToMove(blobs);
    xMove = whereToMove[0];
    yMove = whereToMove[1];
    b1.isInside(xMove,yMove);
    
    for(Blobs b2 : blobs){
      if(b2 == b1)
        continue;
      if(blobsColliding(b1, b2, b1.xMove*b1.xSpeed,b1.yMove*b1.ySpeed) == 1){
        colliding = 1;
      }
    }
    
    
   // println("xMove: " + xMove + "  yMove: " + yMove);
    if(colliding == 0)
      b1.blobMove(xMove, yMove);
    else
    {
     //b1.blobMove(int(random(0,10)),int(random(0,10))); 
    }
    
    
    colliding = 0;
    b1.drawMob();
  }
}
  
  static int[] direction(int[] from, int[] to)
  {
    int[] dir = new int[2];
    dir[0] = (to[0]-from[0]);
    dir[1] = (to[1]-from[1]);
    return dir;
  }
  
  static int[] centerOfMass(ArrayList<Blobs> blobs)
  {
   int[] centre = new int[2];
   int sumX=0, sumY=0;
   for(Blobs b : blobs)
   {
    sumX += b.xPos;
    sumY += b.yPos;
   }
   centre[0] = sumX / blobs.size();
   centre[1] = sumY / blobs.size();
   
   return centre;
  }

  static int distance(Blobs b1, Blobs b2)
  {  
    int distance = (int)sqrt(pow(b1.xPos-b2.xPos,2)+pow(b1.yPos-b2.yPos,2));
    return distance;
  }

//Returns true if the (blobs) are touching, or false if they are not
int blobsColliding(Blobs b1, Blobs b2, int xMove,int yMove){
    //compare the distance to combined radii
    int dx = b2.xPos - xMove - b1.xPos;
    int dy = b2.yPos - yMove - b1.yPos;
    int radii = b1.r + b2.r;
    if ( ( dx * dx )  + ( dy * dy ) < radii * radii ){
        return 1;
    }
    else{
        return 0;
    }
}

void mouseReleased() {
  if(leftPressed == 1) {
    blobs.add(new Blobs());
    totalBlobs++; 
  } else {
    leftPressed = 0;
  }
}

class Blobs{
  int age;
  int life;
  int maxAge = 100;
  int xPos = mouseX;
  int yPos = mouseY;
  int xSpeed = 1, ySpeed = 1;
  int fleeing = 0;
  int timer = 5000;
  
  int r = 10;
  int visionRadius= r + int(random(0,50));
  int xMove;
  int yMove;
  int raceMax = 3;
  int race = int(random(0,raceMax));
  color blobColor = color(250/raceMax * race, 
    235/raceMax * race, 70/raceMax * race);
  float m = r*.1;
    
  void Blobs(){
   this.age = 0;
   this.life = 100;
  }
  
  void blobMove(int xMove, int yMove){

   this.xPos += xMove*xSpeed; 
   this.yPos += yMove*ySpeed;
   this.xSpeed = 1;
   this.ySpeed = 1;
  }

  void die(){
   this.life = 0; 
  }
  
  int[] location()
  {
   int[] myLocation = new int[2];
    myLocation[0] = this.xPos;
    myLocation[1] = this.yPos;
   return myLocation; 
  }
  
  int[] decideWhereToMove(ArrayList<Blobs> blobs)
  {
    int[] whereToMove = new int[2];

    ArrayList<Blobs> nearbyBlobs = findNearbyBlobs(blobs, this.r);
    if(nearbyBlobs.size() > 0)
    {
      int[] centre = centerOfMass(nearbyBlobs);
      int[] dir = direction(this.location(), centre);
      whereToMove[0] = dir[0]==0?0:(dir[0]/abs(dir[0]))*int(random(0,5))*-1;
      whereToMove[1] = dir[1]==0?0:(dir[1]/abs(dir[1]))*int(random(0,5))*-1;      
      
    }
    else
    {
      whereToMove[0] = int(random(-5,5));
      whereToMove[1] = int(random(-5,5));
    }
    
    xMove = whereToMove[0];
    yMove= whereToMove[1];
   return whereToMove; 
  }
  
  ArrayList<Blobs> findNearbyBlobs(ArrayList<Blobs> allBlobs, int r)
  {
    ArrayList<Blobs> nearbyBlobs = new ArrayList<Blobs>();
    for(Blobs b: allBlobs)
    {
       if(this.race == b.race)
        continue;
       if(distance(this,b)<= b.visionRadius + b.r){
        nearbyBlobs.add(b); 
       }
        
    }
    return nearbyBlobs;
  }
  

  
  void loseLife(int damage){
    this.life -= damage;  
  }
  
  void increaseLife(int health){
   this.life += health;
  }
  
  void increaseAge(){
   this.age++;
   if(this.age == this.maxAge)
    this.die(); 
  }
  
  void drawMob(){
   fill(blobColor);
  
   ellipse(xPos, yPos, 2*this.r, 2*this.r) ;
   noFill();
   stroke(150);
    ellipse(xPos, yPos, 2 *this.visionRadius, 2*this.visionRadius);

   
   

  }
  
  void isInside(int xMove, int yMove){
    if (this.xPos > width-this.r) {
      this.xPos = width-this.r;
      this.xSpeed *= -1;
    } 
    else if (xPos < this.r) {
      this.xPos = this.r;
      this.xSpeed *= -1;
    } 
    else if (this.yPos > height-this.r) {
      this.yPos = height-this.r;
      this.ySpeed *= -1;
    } 
    else if (this.yPos < this.r) {
      this.yPos = this.r;
      this.ySpeed *= -1;
    }
  }
}

