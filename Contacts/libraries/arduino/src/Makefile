JAVAC = javac
CLASS_FILES = Arduino.class 
JAR_CMD = jar cvf
JAR_NAME = Arduino.jar
PACKAGE_PATH = cc/arduino
JFLAGS = -classpath /Applications/Processing.app/Contents/Resources/Java/core.jar:/Applications/Processing.app/Contents/Resources/Java/libraries/serial/library/serial.jar -d .
 
Default: $(CLASS_FILES)
	    $(JAR_CMD) $(JAR_NAME) $(PACKAGE_PATH)

%.class: %.java
	    $(JAVAC) $(JFLAGS) $<

clean:
	rm -rf *.class *.jar cc/

