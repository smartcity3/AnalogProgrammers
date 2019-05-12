#include <math.h>
#include <arduino.h>
#define SEALEVELPRESSURE_HPA (1013.25)
float readPressure(float altitudegps)
{
  float temp=(1-6.87535*0.000001*altitudegps);
  temp=pow(temp,5.2561);
  float pressure= SEALEVELPRESSURE_HPA*temp;
  
  return  pressure;
}
float readTemperature(void)
{
  int RawValue = analogRead(34);
  float Voltage = ((RawValue * 3300) / 4096.0) ; // 5000 to get millivots.
  float tempC = (Voltage*0.01)+1.01;
  return tempC;
}
float readAltitude(float altitudegps)
{
  return altitudegps*(random(-0.01,0.01));
}
