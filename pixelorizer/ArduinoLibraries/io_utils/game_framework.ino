static int NUM_COLUMNS = 32;
static int FLICKER_COLUMN = 0;  
static int COL_DISPLAY_TIME = 750; //time to let leds display for (micro seconds)
static int ENCODER_PROPAGATION_TIME = 5; //time to let encoder propogate PT signals (microseconds)
static int boardBuffer[32][16][3];

/*void loop() {
  int r = -1;
  int c = -1;
  outputPT();
  for (int col = 0; col < NUM_COLUMNS; col++) {
    selectColumn(col);
    //let the outputs propagte,
    delayMicroseconds(ENCODER_PROPAGATION_TIME);
    
    int row = getEncoderValue();
    
    if (row != -1) {
      //input found!
      r = row;
      c = col;
      break;
    }
  }
  
  nextFrame(r,c);
  
  outputLED();
  for (int col = 0; col < NUM_COLUMNS; col++) {
    //update the column with the new board buffer
    setColumn(boardBuffer[col]);
    
    //unground all of the led columns so that there are no flicker trails
    selectColumn(FLICKER_COLUMN);
    
    //update the TLCs
    while(Tlc.update());
    selectColumn(col);
    
    //hold the display
    delayMicroseconds(COL_DISPLAY_TIME);
  }
  
}
*/

void nextFrame(int row, int col) {
  
}
