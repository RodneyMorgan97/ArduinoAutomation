// Demo code for Grove - Temperature Sensor V1.1/1.2
// Loovee @ 2015-8-26
 
#include <math.h>
#include <CurieTime.h>
#include <Servo.h>
 
const int B=4250;                 // B value of the thermistor
const int R0 = 100000;            // R0 = 100k
const int pinTempSensor = A2;     // Grove - Temperature Sensor connect to A5
const int lightPin = A1;
const int led1 = 4;
const int servoPin = A0;
Servo blind;
bool isBlindOpen = true;
int maxTemp = 80;
int maxLight = 501;
void setup()
{
    Serial.begin(9600);
    Serial1.begin(9600);
    //pinMode(pinTempSensor, INPUT);
    setTime(6, 49, 00, 8, 10, 2016);
    blind.attach(servoPin);
    //open blind to line up with bool
    blind.write(180);
}
 
void loop()
{
//  Serial.println(maxLight);
//  Serial.println(maxTemp);
    Serial.println("Loop Start");
    char clockTime[16];
    sprintf(clockTime, "  %2d:%2d:%2d   ", hour(), minute(), second());
    char dateTime[16];
    sprintf(dateTime, "   %2d/%2d/%4d   ", month(),day(), year());
    double temperature = readTemp();
    int lightLevel = readLightLevel();
    
    //output our current values for debugging purposes
    //debugPrint();

    Serial.print("Blinds open: ");
    Serial.println(isBlindOpen);
    Serial.print("temperature = ");
    Serial.println(readTemp());
    Serial.print("light = ");
    Serial.println(readLightString());
    Serial.print("light level = ");
    Serial.println(analogRead(lightPin));
    Serial.print(dateTime);
    Serial.println(clockTime);
    Serial.println(" ");
    Serial.println("----------------------");
    
  
  //check if we need to configure a value
  configVals();

  if( lightLevel > maxLight)
  {
    if(isBlindOpen)
    {
      //closeBlind();
      isBlindOpen = false;
      Serial.println("closing blind");
      blind.write(180);
    }
  }
   if(lightLevel < maxLight)
  {
    if(!isBlindOpen)
    {
      //openBlind();
      isBlindOpen = true;
      Serial.println("opening blind");
      blind.write(0);
    }
  }
  
  if(temperature >= maxTemp)
  {
    digitalWrite(led1, HIGH);
  }
 else
 {
  digitalWrite(led1, LOW);
 }
    delay(2000);
}

int readLightLevel()
{
  return analogRead(lightPin); 
}

void configVals()
{
  if(Serial1.available() > 0)
  {
      String param1  = Serial1.readStringUntil(',');
      String param2 = Serial1.readStringUntil('\0');

     if(param1 == "t")
     {
       maxTemp = param2.toInt();     
     }

     else if (param1 == "l")
     {
       maxLight = param2.toInt(); 
     }
  }
}

//void debugPrint()
//{
//    Serial.print("temperature = ");
//    Serial.println(readTemp());
//    Serial.print("light = ");
//    Serial.println(readLightLevel());
//    Serial.print("light level = ");
//    Serial.println(analogRead(lightPin));
//    Serial.print(dateTime);
//    Serial.println(clockTime);
//    Serial.println(" ");
//    Serial.println("----------------------");
//}

double readTemp()
{
  int a = analogRead(pinTempSensor );
    //int a = 5;
    double R = 1023.0/((double)a)-1.0;
    R = 100000.0*R;
 
    double temperature=1.0/(log(R/100000.0)/B+1/298.15)-273.15;//convert to temperature via datasheet ;
    temperature = temperature - 35;
    temperature = temperature*1.8 + 32;
    return temperature;
}

String readLightString()
{
  int lightLevel = analogRead(lightPin);
  if(lightLevel < 10)
  {
    return "Dark";
  }
  else if (lightLevel < 200)
  {
    return "Dim";
  }
  else if (lightLevel < 500)
  {
    return "Light";
  
  }else if (lightLevel < 800)
  {
    return "Bright";
  }
  else
  {
    return "Very Bright";
  }
}


void closeBlind()
{
  isBlindOpen = false;
  blind.write(0); 
  return;
}

void openBlind()
{
  isBlindOpen = true;
  blind.write(180); 
  return;
}

