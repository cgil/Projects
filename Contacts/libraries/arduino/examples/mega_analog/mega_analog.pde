import processing.serial.*;
import cc.arduino.*;
import ddf.minim.*;
import ddf.minim.signals.*;

Minim minim;
AudioOutput out;
SineWave sine;
Arduino arduino;

color off = color(4, 79, 111);
color on = color(84, 145, 158);

boolean soundON = false;
int scl;
void setup() {
  size(600, 600);
  scl = width/5;
  smooth();
  arduino = new Arduino(this, Arduino.list()[2], 57600);
  minim = new Minim(this);
  out = minim.getLineOut(Minim.STEREO);
  sine = new SineWave(440, 0.5, out.sampleRate());
  sine.portamento(200);
if (soundON){
  out.addSignal(sine);}
}

int i;
void draw() {
  background(off);
  i=0;
  for (int y=0; y<=3; y++){
    for (int x=0; x<=3; x++){
      int c = round(map(arduino.analogRead(i), 0, 1023, 0, 255));
      fill(255,255,255,c);
      int s = round(map(arduino.analogRead(i), 0, 1023, 0, scl*2));
      if (soundON){
      int f = round(map(arduino.analogRead(8), 0, 1023, 440, 4000));
      sine.setFreq(f);}
      ellipse(scl+x*scl, scl+y*scl, s, s);
      i++;
    }
  }
}

void stop()
{
  out.close();
  minim.stop();
  
  super.stop();
}
