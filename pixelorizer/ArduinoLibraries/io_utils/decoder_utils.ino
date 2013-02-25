/* select lines for both demuxs */
int sel_0   = 7;
int sel_1   = 6;
int sel_2   = 5;
int sel_3   = 4;
int sel_4   = 12;

/* Switches output between leds and phototransistors
 * 1 for LEDs, 0 for phototransistors
 */
int sel_led = 2;

/* decoderSetup()
 * sets the pins as output pins.
 */
void decoderSetup() {
  pinMode(sel_0, OUTPUT);
  pinMode(sel_1, OUTPUT);
  pinMode(sel_2, OUTPUT);
  pinMode(sel_3, OUTPUT);
  pinMode(sel_4, OUTPUT);
  pinMode(sel_led, OUTPUT);
}

/* selectColumn(int col)
 * Sets the output on sel_0 through sel_4 to select 
 * column col as the output of the two demuxs.
 */
void selectColumn(int col) {
  if ((col & 1) == 1) {
    digitalWrite(sel_0, HIGH);
  }
  else {
    digitalWrite(sel_0, LOW);
  }

  if (((col >> 1) & 1) == 1) {
    digitalWrite(sel_1, HIGH);
  }
  else {
    digitalWrite(sel_1, LOW);
  }

  if (((col >> 2) & 1) == 1) {
    digitalWrite(sel_2, HIGH);
  }
  else {
    digitalWrite(sel_2, LOW);
  }

  if (((col >> 3) & 1) == 1) {
    digitalWrite(sel_3, HIGH);
  }
  else {
    digitalWrite(sel_3, LOW);
  }

  if (((col >> 4) & 1) == 1) {
    digitalWrite(sel_4, HIGH);
  }
  else {
    digitalWrite(sel_4, LOW);
  }
  
}

/* outputLED()
 * Output to the LEDs
 */
void outputLED() {
  digitalWrite(sel_led, LOW);
}

/* outputPT()
 * Output to the phototransistors
 */
void outputPT() {
  digitalWrite(sel_led, HIGH);
}



