#include "Tlc5940.h"
#define ROWS 16
#define COLS 32
int colors[ROWS][COLS];
void setup() {
  //Serial.begin(9600);
  decoderSetup();
  encoderSetup();
  Tlc.init();
  
  for(int i = 0; i < ROWS; i++) {
    for(int j = 0; j < COLS; j++) {
      colors[i][j] = int(4095);
    } 
  }
}

//int colors[8][3] = {{4095, 0 ,0},
//                    {0, 4095, 0},
//                    {0, 0, 4095},
//                    {4095, 2048, 2048},
//                    {4095, 1024, 1024},
//                    {3073, 1024, 2048},
//                    {1024, 1024, 3073},
//                    {4095, 4095, 4095}};

    
      //Channel 1: R1
      //Channel 2: G1
      //Channel 3: B1
      //Channel 4: R2
      //Channel 5: G2
      //Channel 6: B2
      


/*
int colors[8][3] = {{4095, 2043 ,0},
                    {4095, 0 ,2043},
                    {2043, 0 ,4095},
                    {0, 2043 ,4095},
                    {2043, 4095 ,0},
                    {0, 4095 ,2043},
                    {2043, 4095 ,2043},
                    {2043, 2043 ,4095}
                    };
                    
*/
         


void loop() {
  
  //test the decoder output!
  outputLED();
  //for each column
  //unsigned long m = micros();
  for (int c = 0; c < COLS; c++) {
    //int k = i%4;
    //selectColumn(15);
    outputPT();
    
    for(int r = 0; r < ROWS; r++) {
      Tlc.set(r%16, colors[r][c]);
      Tlc.set(r%16, colors[r][c]);
      Tlc.set(r%16, colors[r][c]);
    }
    /*
    //1
    int offset = 0;
    Tlc.set(1, colors[k][0]);
    Tlc.set(2, colors[k][1]);
    Tlc.set(3, colors[k][2]);
    //2
    offset += 4;
    Tlc.set(4, colors[k+offset][0]);
    Tlc.set(5, colors[k+offset][1]);
    Tlc.set(6, colors[k+offset][2]);
    //3
    offset += 4;
    Tlc.set(4, colors[k+offset][0]);
    Tlc.set(5, colors[k+offset][1]);
    Tlc.set(6, colors[k+offset][2]);
*/
    while(Tlc.update()); 
    selectColumn(c);
    outputLED();
    delayMicroseconds(1000);
  }
}
