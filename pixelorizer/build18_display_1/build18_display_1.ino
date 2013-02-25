// Number of columns and rows in the grid
#define ROWS 16
#define COLS 32

int grid[ROWS][COLS][3];
float angle[ROWS][COLS];

//Prototypes

void initialize() {
  // The counter variables i and j are also the column and row numbers
  // In this example, they are used as arguments to the constructor for each object in the grid.
  for (int i = 0; i < ROWS; i ++ ) {
    for (int j = 0; j < COLS; j ++ ) {
      // Initialize each object
      int _initialColor[3] = {4095, 0, 0};
      grid[i][j][0] = 4095;
      grid[i][j][1] = 0;
      grid[i][j][2] = 0;
      
      angle[i][j] = i+j;
    }
  }
}

void nextStep() {
  int rgbConversionRatio = 16; //Ratio to convert from 255 colors to 4095
  int redColor, greenColor, blueColor, newAngle, sineApprox;
  for (int i = 0; i < COLS; i ++ ) {     
    for (int j = 0; j < ROWS; j ++ ) {
      // Oscillate and get next color
      // Next color calculated using sine wave
      angle[i][j] += 0.02;
      newAngle = angle[i][j];
      
      //Quadratic curve sine approximation
      if (newAngle < 0) {
        sineApprox = 1.27323954 * newAngle + .405284735 * newAngle * newAngle;
      }
      else {
        sineApprox = 1.27323954 * newAngle - 0.405284735 * newAngle * newAngle;
      }
      redColor = int(127 + 127*sineApprox * rgbConversionRatio);
      greenColor = 0 * rgbConversionRatio;
      blueColor = 210 * rgbConversionRatio;
      
      grid[i][j][0] = redColor;
      grid[i][j][1] = greenColor;
      grid[i][j][2] = blueColor;
    }
  }
}
