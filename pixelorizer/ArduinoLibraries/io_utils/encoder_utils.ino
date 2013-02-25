int read_0 = 12;
int read_1 = 11;
int read_2 = 10;
int read_3 = 9;
int read_valid = 8;


/* encoderSetup()
 * sets the pins as input pins.
 */
void encoderSetup() {
  pinMode(read_0, INPUT);
  pinMode(read_1, INPUT);
  pinMode(read_2, INPUT);
  pinMode(read_3, INPUT);
  pinMode(read_valid, INPUT);
}

/* getEncoderValue()
 * returns the value output from the 
 * encoder as an integer
 */
int getEncoderValue() {
  int temp = 0;
  if (digitalRead(read_valid) == LOW)
    return -1;
  
  temp += read_0;
  temp += read_1 << 1;
  temp += read_2 << 2;
  temp += read_3 << 3;
  
  return temp;
}
     
