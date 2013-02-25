// Learning Processing
// Daniel Shiffman
// http://www.learningprocessing.com

// Example 13-10: Two-dimensional array of objects

// 2D Array of objects
Cell[][] grid; 

//displayGrid is an array of colors of what we're physically displaying on the screen
int displayGrid[][][];

// Number of columns and rows in the grid
int cols = 32;
int rows = 16;

void setup() {
  size(512,256);
  grid = new Cell[cols][rows];
  displayGrid = new int[cols][rows][];
  int pixelSize = 16;
  
  // The counter variables i and j are also the column and row numbers
  // In this example, they are used as arguments to the constructor for each object in the grid.
  for (int i = 0; i < cols; i ++ ) {
    for (int j = 0; j < rows; j ++ ) {
      // Initialize each object
      grid[i][j] = new Cell(i*pixelSize,j*pixelSize,pixelSize,pixelSize,i + j);
    }
  }
}

void draw() {
  background(0);
  for (int i = 0; i < cols; i ++ ) {     
    for (int j = 0; j < rows; j ++ ) {
      // Oscillate and display each object
      grid[i][j].oscillate();
      grid[i][j].display(i, j);
    }
  }
  
  //Send and display the displayGrid to arduino
  displayGridSend();
  
}

//Send data to display grid
void displayGridSend() {
    
}

