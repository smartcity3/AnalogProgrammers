//include
//{
#include <SPI.h>
#include <Wire.h>
#include <LoRa.h>
#include <TinyGPS++.h>
#include <Arduino.h>

#include "bmm150.h"
#include "bmm150_defs.h"
#include "bme.h"
#include <Ultrasonic.h>



// GPIO5  -- SX1278's SCK
// GPIO19 -- SX1278's MISO
// GPIO27 -- SX1278's MOSI
// GPIO18 -- SX1278's CS
// GPIO14 -- SX1278's RESET
// GPIO26 -- SX1278's IRQ(Interrupt Request)


#define SCK     5    // GPIO5  -- SX1278's SCK
#define MISO    19   // GPIO19 -- SX1278's MISnO
#define MOSI    27   // GPIO27 -- SX1278's MOSI
#define SS      18   // GPIO18 -- SX1278's CS
#define RST     14   // GPIO14 -- SX1278's RESET
#define DI0     26   // GPIO26 -- SX1278's IRQ(Interrupt Request)
#define BAND 868E6



Ultrasonic ultrasonic(4, 22, 10000);
//lm35 34
int ba = 35;
TinyGPSPlus gps;
BMM150 bmm = BMM150();



float GPScanx ;
float GPScany ;
uint8_t lora_switch = 0;
String last_lora_packet = "";
String now_lora_packet = "";
float* values = 0;
int temp = 0;
double c = 85;
float ultra;
int id = 1;
float maxlen = 80;
int batt = 100;

uint32_t the_milis;
uint32_t alti_millis;
//}



static void smartDelay(unsigned long ms)
{
  unsigned long start = millis();
  do
  {
    while (Serial1.available())
      gps.encode(Serial1.read());
  } while (millis() - start < ms);
}

int ogkos(int ultra)
{
  int ultra_pers;
  ultra_pers = ((maxlen - ultra));
  ultra_pers = map(ultra_pers, 2, maxlen, 0, 100);
  return ultra_pers;
}

void getdata()
{
  temp = int((float)readTemperature() * 10);
  GPScany = gps.location.lat();
  GPScanx = gps.location.lng();
  ultra = ultrasonic.Ranging(CM); // CM or INC
  battery_up();
  // Serial.println(temp);
  //Serial.println(ultra);
  Serial.println();
}

void battery_up()
{
  //94k+300k
  //float batt_temp = (394.0f / 100.0f) * 3.30f * float(analogRead(ba)) / 4096.0f; // LiPo battery
  float batt_temp = (3.30f * float(analogRead(ba)) / 4096.0f); // LiPo battery
  batt_temp = (batt_temp + (batt_temp * 0.313));

  batt = map(batt_temp, 2.8, 4.2, 0, 100);
  //batt = batt_temp*10;
  Serial.println(batt);
  Serial.println();
  Serial.println(batt_temp);
}

void senddata()
{
  Serial.println("ok_send");
  int GPScany_temp = int((float)GPScany * 10000);
  int GPScanx_temp = int((float)GPScanx * 10000);
  Serial.println("ok_send2");
  int ultra_temp = ogkos(ultra);
  Serial.println(ultra_temp);
  LoRa.beginPacket();
  LoRa.print(GPScany_temp, HEX);
  LoRa.print(",");
  LoRa.print(GPScanx_temp, HEX);
  LoRa.print(",");
  LoRa.print(temp, HEX);
  LoRa.print(",");
  LoRa.print(64, HEX);
  LoRa.print(",");
  LoRa.print(ultra_temp, HEX);
  LoRa.print(",");
  LoRa.print(batt, HEX);
  LoRa.print(",");
  LoRa.print(id, HEX);
  LoRa.endPacket();
  Serial.println("ok_sendf");
  delay(1);
  LoRa.receive();
  delay(1);
}

void setup() {

  Serial.begin(115200);
  while (!Serial); //if just the the basic function, must connect to a computer
  delay(1000);
  Serial.println("LoRa Receiver");

  SPI.begin(SCK, MISO, MOSI, SS);
  LoRa.setPins(SS, RST, DI0);

  if (!LoRa.begin(868E6)) {
    Serial.println("Starting LoRa failed!");
    while (1);
  }

  the_milis = millis();
  delay(100);
  Serial.println("start");
  LoRa.beginPacket();
  LoRa.print("start transmit");
  LoRa.endPacket();
  delay(1);
  LoRa.receive();
}

void loop() {
  // try to parse packet
  // int packetSize = LoRa.parsePacket();

  switch (lora_switch) {
    case 0://///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      smartDelay(100);
      getdata();

      if (millis() - the_milis > 1000)
      {
        Serial.println("ok");
        c++;
        the_milis = millis();
        //if (c > 84) {
        Serial.println("ok2");
        senddata();
        Serial.println("ok3");
        c = 0;
        //}
      }
      if (temp > 100)
      {
        the_milis = millis();
        senddata();
      }
      delay(2);
      break;

    case 1://////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      break;

    case 3:		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      break;

    case 4:     //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      break;
  }
}
