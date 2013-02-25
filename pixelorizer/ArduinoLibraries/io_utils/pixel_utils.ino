static int RED_COLOR[3] = {4095, 0, 0};
static int GREEN_COLOR[3] = {0, 4095, 0};
static int BLUE_COLOR[3] = {0, 0, 4095};
static int WHITE_COLOR[3] = {4095, 4095, 4095};
static int BLANK_COLOR[3] = {0, 0, 0};
static int PURPLE_COLOR[3] = {4095, 4095, 0};

static int channels[16][3] = {{0,1,2},
                     {3,4,5},
                     {6,7,8},
                     {9,10,11},
                     {12,13,14},
                     {15,16,17},
                     {18,19,20},
                     {21,22,23},
                     {24,25,26},
                     {27,28,29},
                     {30,31,32},
                     {33,34,35},
                     {36,37,38},
                     {39,40,41},
                     {42,43,44},
                     {45,46,47}};


void setColor(int row, int color[3]) {
  Tlc.set(channels[row][0], color[0]);
  Tlc.set(channels[row][1], color[1]);
  Tlc.set(channels[row][2], color[2]);
}

void setColumn(int row[16][3]) {
  for (int i = 0; i < 16; i++) {
    setColor(i, row[i]);
  }
}
