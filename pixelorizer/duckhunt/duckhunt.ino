
/*
  DUCK HUNT GAME:
  Using BLACK as an empty square
*/

#define ROWS 16
#define COLS 32
#define LANDHEIGHT 2

const int RED[3] = {4095,0,0};
const int GREEN[3] =  {0,4095,0};
const int BLUE[3] = {0,0,4095};
const int BLACK[3] = {0,0,0};
const int WHITE[3] = {4095,4095,4095};
const int YELLOW[3] = {3000,3000,0};
const int DUCKCENTER[3] = {3000,3200,0};

int grid[ROWS][COLS][3];

//The cell the laser pointer hits , -1 if none
int shotX = 0;
int shotY = 0;

int playerPoints = 0;

//Create a floor
void formTerrain() {
  for(int i = 0; i < LANDHEIGHT; i++) {
     for(int j = 0; j < COLS; j++) {
       grid[i][j][0] = GREEN[0];
       grid[i][j][1] = GREEN[1];
       grid[i][j][2] = GREEN[2];
     }
  }
}

//Form a duck given center point of duck
void formDuck(int x, int y) {
  //Right now a duck is a cross
  if( freeCell(x,y) ) {
     grid[x][y][0] = DUCKCENTER[0]; 
     grid[x][y][1] = DUCKCENTER[1]; 
     grid[x][y][2] = DUCKCENTER[2]; 
  }
  if ( freeCell(x,y) ) {
     grid[x][y][0] = YELLOW[0];
     grid[x][y][1] = YELLOW[1];
     grid[x][y][2] = YELLOW[2];
  }
  if ( freeCell(x-1,y) ) {
     grid[x-1][y][0] = YELLOW[0];
     grid[x-1][y][1] = YELLOW[1];
     grid[x-1][y][2] = YELLOW[2];
  }
  if ( freeCell(x+1,y) ) {
     grid[x+1][y][0] = YELLOW[0];
     grid[x+1][y][1] = YELLOW[1];
     grid[x+1][y][2] = YELLOW[2];
  }
  if ( freeCell(x,y-1) ) {
     grid[x][y-1][0] = YELLOW[0];
     grid[x][y-1][1] = YELLOW[1];
     grid[x][y-1][2] = YELLOW[2];
  }
  if ( freeCell(x,y+1) ) {
     grid[x][y+1][0] = YELLOW[0];
     grid[x][y+1][1] = YELLOW[1];
     grid[x][y+1][2] = YELLOW[2];
  } 
}

//Initialize the game
void initialize() {
  int randomHeight;
  int randomSide;
  int numDucks = 4;
  
  for(int i = 0; i < numDucks; i++) {
     randomHeight = random(LANDHEIGHT, ROWS-ROWS/4);
     randomSide = random(0,1);
     if ( randomSide == 1) {
       randomSide = COLS;
     }  
     
     grid[randomHeight][randomSide][0] = DUCKCENTER[0];
     grid[randomHeight][randomSide][1] = DUCKCENTER[1];
     grid[randomHeight][randomSide][2] = DUCKCENTER[2];
  }
}

int hasDuck(int x, int y) {
   if (( (grid[x][y][0] == YELLOW[0]) && (grid[x][y][1] == YELLOW[1]) && (grid[x][y][2] == YELLOW[2]) ) || 
     ( grid[x][y][0] == DUCKCENTER[0] && grid[x][y][1] == DUCKCENTER[1] && grid[x][y][2] == DUCKCENTER[2]  ) ) {
      return 1;
   } 
   return 0;
}

void findAndRemoveDuck(int x, int y) {
  int centerX, centerY;
  if(grid[x][y][0] == DUCKCENTER[0] && grid[x][y][1] == DUCKCENTER[1] && grid[x][y][2] == DUCKCENTER[2] ) {
    centerX = x;
    centerY = y;
  }
  else {
    if ( grid[x-1][y][0] == DUCKCENTER[0] && grid[x-1][y][1] == DUCKCENTER[1] && grid[x-1][y][2] == DUCKCENTER[2] ) {
      centerX = x-1;
      centerY = y;
    }
    if ( grid[x+1][y][0] == DUCKCENTER[0] && grid[x+1][y][1] == DUCKCENTER[1] && grid[x+1][y][2] == DUCKCENTER[2] ) {
      centerX = x+1;
      centerY = y;
    }
    if ( grid[x][y-1][0] == DUCKCENTER[0] && grid[x][y-1][1] == DUCKCENTER[1] && grid[x][y-1][2] == DUCKCENTER[2] ) {
      centerX = x;
      centerY = y-1;
    }
    if ( grid[x][y+1][0] == DUCKCENTER[0] && grid[x][y+1][1] == DUCKCENTER[1] && grid[x][y+1][2] == DUCKCENTER[2] ) {
      centerX = x;
      centerY = y+1;
    }  
  }
  
  removeDuck(centerX, centerY);
  
}

//Get the next step
void nextStep() {
  //Check if hit duck
  if( hasDuck(shotX, shotY) ) {
      removeDuck(shotX, shotY);
      playerGetsPoint();
  }
  
  for (int i = 0; i < ROWS; i++) {
    for(int j = 0; j < COLS; j++) {
      if (grid[i][j][0] == DUCKCENTER[0] && grid[i][j][1] == DUCKCENTER[1] && grid[i][j][2] == DUCKCENTER[2]) {
        findAndRemoveDuck(i,j);
        duckMove(i, j);
      }
    } 
  }
}

void playerGetsPoint() {
  playerPoints++;
}

void removeDuck(int x, int y) {
  if ( freeCell(x,y) ) {
     grid[x][y][0] = BLACK[0];
     grid[x][y][1] = BLACK[1];
     grid[x][y][2] = BLACK[2];
  }
  if ( freeCell(x-1,y) ) {
     grid[x-1][y][0] = BLACK[0];
     grid[x-1][y][1] = BLACK[1];
     grid[x-1][y][2] = BLACK[2];
  }
  if ( freeCell(x+1,y) ) {
     grid[x+1][y][0] = BLACK[0];
     grid[x+1][y][1] = BLACK[1];
     grid[x+1][y][2] = BLACK[2];
  }
  if ( freeCell(x,y-1) ) {
     grid[x][y-1][0] = BLACK[0];
     grid[x][y-1][1] = BLACK[1];
     grid[x][y-1][2] = BLACK[2];
  }
  if ( freeCell(x,y+1) ) {
     grid[x][y+1][0] = BLACK[0];
     grid[x][y+1][1] = BLACK[1];
     grid[x][y+1][2] = BLACK[2];
  } 
}

//Move the duck to x, y
void duckMove(int x, int y) {
  int randomUp = random(0,1);
  int randomSide = random(0,1);
  formDuck(x + randomSide, y + randomUp);
}

//Is the given x cell empty and on the grid
int freeCell(int x, int y) {
  if (x >= 0 && x < COLS && 
    ( grid[x][y][0] != BLACK[0] || grid[x][y][1] != BLACK[1] || grid[x][y][2] != BLACK[2]  ) && 
    ( grid[x][y][0] != GREEN[0] || grid[x][y][1] != GREEN[1] || grid[x][y][2] != GREEN[2]  ) ) {
    if (y >= 0 && y < ROWS && 
      ( grid[x][y][0] != BLACK[0] || grid[x][y][1] != BLACK[1] || grid[x][y][2] != BLACK[2] ) && 
      grid[x][y] != GREEN) {
      return 1;
    }
  }

  return 0;
}
