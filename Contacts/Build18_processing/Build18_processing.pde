//Carlos Gil, Nick Zukoski, Keith Williams: Build18
import processing.serial.*;

Serial myPort;
PFont myFont;
int maxContacts = 9;

void setup(){  
  println(Serial.list());
  myPort = new Serial(this, Serial.list()[0], 9600);
  myPort.buffer(1);
  myFont = loadFont("buildFont.vlw");
  size(800, 800);
  textFont(myFont,16);
  background(255, 204, 0);
}

void draw(){
  while (myPort.available() > 0) {
    String inBuffer = myPort.readStringUntil('\n');  
    delay(50); 
    if (inBuffer != null) {
    background(255, 204, 0);
    
    //Get an array of all contacts to look up in index
    int[] contactIndex = parser(inBuffer);
    
    //header
    fill(0, 102, 153);
    text("Contact",100,30);
    
    //Display the given contacts
    displayContacts(contactIndex);
    }
  }
}

//NOT WORKING FOR SOME REASON - DELETING BY 0's

//Parse input->create an array of contacts
int[] parser(String inBuffer){
 char DELIM = ',';
 int[] contactIndex = new int[9];
 String[] cardNumbers = split(inBuffer, DELIM);
 for(int i =0; i< cardNumbers.length; i++){
   int realID = get_contactNumber(cardNumbers[i]);
   contactIndex[i] = realID;
   print(cardNumbers[i]);
   print("\n");
 }
 
 return contactIndex;
}


//Use contact Indexes to display the contact information
void displayContacts(int[] contactIndex){
  int space = 1;
  for(int i = 0; i < contactIndex.length; i++){
      if(contactIndex[i] != 0){
        String name = get_name(contactIndex[i]);
        String number = get_number(contactIndex[i]);
        String email = get_email(contactIndex[i]);
    
        int ydisp = (width/contactIndex.length);
        int yPos = ydisp * space;
      
        if(name != null)
          text(name,100,yPos);
        if(number != null)
          text(number,250,yPos);
        if(email != null)
          text(email,450,yPos);
        
        space++;
      }
    
  }  
}


//Get contact name
String get_name(int name){
  if(name == 1)
    return "SpaceX";
  else if(name == 2)
    return "Rachelle";
  else if(name == 3)
    return "Build18";
  else if(name == 4)
    return "Microsoft";
  else if(name == 5)
    return "Nick Zukoski";
  else if(name == 6)
    return "Keith Williams";
  else if(name == 7)
    return "Carlos Gil";
  else if(name == 8)
     return "Rocky"; 
  else if(name == 9)
    return "Luke";
  else
    return null;
}

String get_number(int number){
  if(number == 1)
    return "412-739-365";
  else if(number == 2)
    return "854-972-639";
  else if(number == 3)
    return "536-936-0668";
  else if(number == 4)
    return "482-665-8830";
  else if(number == 5)
    return "217-621-8428";
  else if(number == 6)
    return "910-554-2800";
  else if(number == 7)
    return "412-425-0019";
  else if(number == 8)
     return "446-975-9446"; 
  else if(number == 9)
    return "545-986-4658";
  else
    return null;
}

String get_email(int email){
  if(email == 1)
    return "umbrellasrule@nodefy.com";
  else if(email == 2)
    return "thisrocks@nodefy.com";
  else if(email == 3)
    return "ysosrs@nodefy.com";
  else if(email == 4)
    return "thisstuffiscool@nodefy.com";
  else if(email == 5)
    return "nmz@andrew.cmu.edu";
  else if(email == 6)
    return "kswillia@andrew.cmu.edu";
  else if(email == 7)
    return "cgil@andrew.cmu.edu";
  else if(email == 8)
     return "microwhaaaat@nodefy.com"; 
  else if(email == 9)
    return "lookmahnohands@nodefy.com";
  else
    return null;
}


//Parse cardIndex to contactNumber
int get_contactNumber(String cardIndex){
 if(cardIndex.equals("450BE48C9"))
   return 1;
 else if(cardIndex.equals("450B8D332"))
   return 2;
 else if(cardIndex.equals("450B89FC3"))
   return 3;
 else if(cardIndex.equals("450BE35C2"))
   return 4;
 else if(cardIndex.equals("450BE40F5"))
   return 5;
 else if(cardIndex.equals("450B8E1C1"))
   return 6;
 else if(cardIndex.equals("450B8E7A7"))
   return 7;
 else if(cardIndex.equals("450B9127"))
   return 8;
 else
   return 0;
}
