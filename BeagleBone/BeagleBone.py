'''**************************************************************************/
Controleverything.com- H3LIS331DL 3-Axis Linear Accelerometer I2C Mini Module
A versatile motion-sensing system-in-a-chip

Firmware v1.0 - Python
Author - Amanpal Singh

3-Axis Accelerometer
10,000 g High-Shock Survivability
+/-100g/+/-200g/+/-400g Dynamically Selectable Scales
5V I2C Mini Module Form-Factor
2 Devices per I2C Port
0x18 I2C Start Address

Hardware Version - Rev A.
Platform - Raspberry Pi

/**************************************************************************/'''

#Setting Up smbus libraries
import smbus
import time
import math
import csv
import numpy as np
import datetime
import paho.mqtt.client as mqtt
import json

mqttc = mqtt.Client()
mqttc.connect("test.mosquitto.org", 1883, 60)

bus = smbus.SMBus(1)

#####################
# H3LIS331DL Accel(X) Registers #
#####################
H3LIS331DL_X_ADDRESS		= 0x18
H3LIS331DL_WHO_AM_I_X		= 0x0F
H3LIS331DL_CTRL_REG1_X		= 0x20
H3LIS331DL_CTRL_REG2_X		= 0x21
H3LIS331DL_CTRL_REG3_X		= 0x22
H3LIS331DL_CTRL_REG4_X		= 0x23
H3LIS331DL_CTRL_REG5_X		= 0x24
H3LIS331DL_HP_FIL_RST_X		= 0x25
H3LIS331DL_REFERENCE_X		= 0x26
H3LIS331DL_STATUS_REG_A		= 0x27
H3LIS331DL_OUT_X_L_A		= 0x28
H3LIS331DL_OUT_X_H_A		= 0x29
H3LIS331DL_OUT_Y_L_A		= 0x2A
H3LIS331DL_OUT_Y_H_A		= 0x2B
H3LIS331DL_OUT_Z_L_A		= 0x2C
H3LIS331DL_OUT_Z_H_A		= 0x2D
H3LIS331DL_INT_1_CFG		= 0x30
H3LIS331DL_INT_1_SRC		= 0x31
H3LIS331DL_INT_1_THS		= 0x32
H3LIS331DL_INT_1_DURATION	= 0x33
H3LIS331DL_INT_2_CFG		= 0x34
H3LIS331DL_INT_2_SRC		= 0x35
H3LIS331DL_INT_2_THS		= 0x36
H3LIS331DL_INT_2_DURATION	= 0x37

# accel_scale defines all possible FSR's of the accelerometer:
H3LIS331DL_A_SCALE_100G		= 0x00 # 000:  100g
H3LIS331DL_A_SCALE_200G		= 0x10 # 001:  200g
H3LIS331DL_A_SCALE_400G		= 0x30 # 010:  400g
	
# accel_oder defines all possible output data rates of the accelerometer:
	
H3LIS331DL_A_POWER_DOWN 	= 0x00 # Power-down mode
H3LIS331DL_A_NORMAL_MODE	= 0x20 # ODR
H3LIS331DL_A_ODR_0_5		= 0x40 # 0.5 Hz ,Low Power
H3LIS331DL_A_ODR_1		= 0x60 # 1 Hz ,Low Power
H3LIS331DL_A_ODR_2		= 0x80 # 2 Hz ,Low Power
H3LIS331DL_A_ODR_5		= 0xA0 # 5 Hz ,Low Power
H3LIS331DL_A_ODR_10		= 0xC0 # 10 Hz ,Low Power
 
#Normal Mode ODR
H3LIS331DL_A_ODR_50		= 0x00 # 50 Hz ,Normal Mode	
H3LIS331DL_A_ODR_100		= 0x08 # 100 Hz ,Normal Mode
H3LIS331DL_A_ODR_400		= 0x10 # 400 Hz ,Normal Mode
H3LIS331DL_A_ODR_1000		= 0x18 # 1000 Hz ,Normal Mode


aRes = 100.0 / 32768.0   # 100g

def initialise():
		
# init accel--Sets up the accelerometer to begin reading.

	#100 Hz data rate. Normal Mode.
	#all axes enabled.
	bus.write_byte_data(H3LIS331DL_X_ADDRESS, H3LIS331DL_CTRL_REG1_X, 0x2F)
	# HPF bypassed. Normal mode. HPc = 8 selected
	bus.write_byte_data(H3LIS331DL_X_ADDRESS, H3LIS331DL_CTRL_REG2_X, 0x00)
	#Interrupt active high,Push-pull
	#Accel data ready signal on INT1_X pin
	bus.write_byte_data(H3LIS331DL_X_ADDRESS, H3LIS331DL_CTRL_REG3_X, 0x00)
	#Continuous update,100g FSr,4-wire interface
	bus.write_byte_data(H3LIS331DL_X_ADDRESS, H3LIS331DL_CTRL_REG4_X, 0x00)


#Read the accelerometer output registers.
# This will read all six accelerometer output registers.
# Reading the  AccelerometerX-Axis Values from the Register
def readAcclx():
        Accl_l = bus.read_byte_data(H3LIS331DL_X_ADDRESS,H3LIS331DL_OUT_X_L_A)
        Accl_h = bus.read_byte_data(H3LIS331DL_X_ADDRESS,H3LIS331DL_OUT_X_H_A)
	Accl_total = (Accl_l | Accl_h <<8)
	return Accl_total  if Accl_total < 32768 else Accl_total - 65536

# Reading the  Accelerometer Y-Axis Values from the Register
def readAccly():
        Accl_l = bus.read_byte_data(H3LIS331DL_X_ADDRESS,H3LIS331DL_OUT_Y_L_A)
        Accl_h = bus.read_byte_data(H3LIS331DL_X_ADDRESS,H3LIS331DL_OUT_Y_H_A)
	Accl_total = (Accl_l | Accl_h <<8)
	return Accl_total  if Accl_total < 32768 else Accl_total - 65536

# Reading the  Accelerometer Z-Axis Values from the Register
def readAcclz():
        Accl_l = bus.read_byte_data(H3LIS331DL_X_ADDRESS,H3LIS331DL_OUT_Z_L_A)
        Accl_h = bus.read_byte_data(H3LIS331DL_X_ADDRESS,H3LIS331DL_OUT_Z_H_A)
	Accl_total = (Accl_l | Accl_h <<8)
	return Accl_total  if Accl_total < 32768 else Accl_total - 65536

def AcclDataTotal():
        atotal = (((readAcclx()**2)+(readAccly()**2)+(readAcclz()**2))**0.5)
        return atotal



def calcAccel():

# Return the accel raw reading times our pre-calculated g's / (ADC tick):
	return aRes * accelDataTotal()
	
def setAccelScale():

	#We need to preserve the other bytes in CTRL_REG2_X. So, first read it:
	temp = bus.read_byte_data(H3LIS331DL_X_ADDRESS,CTRL_REG2_X)
	#Then mask out the accel scale bits:
	temp &= 0xFF^(0x3 << 3)
	#Then shift in our new scale bits:
	temp |= aScl << 3
	#And write the new register value back into CTRL_REG2_X:
	bus.write_byte_data(H3LIS331DL_X_ADDRESS,CTRL_REG2_X, temp)


def setAccelODR():

	#We need to preserve the other bytes in CTRL_REG1_X. So, first read it:
	temp = bus.read_byte_data(H3LIS331DL_X_ADDRESS,CTRL_REG1_X)
	#Then mask out the accel ODR bits:
	temp &= 0xFF^(0xF << 4)
	#Then shift in our new ODR bits:
	temp |= (aRate << 4)
	#And write the new register value back into CTRL_REG1_X:
	bus.write_byte_data(H3LIS331DL_X_ADDRESS,CTRL_REG1_X, temp)

#Initialising the Device.
initialise()

while True:
	#time init
	tsInit = int(time.time())
	tsEnd = int(time.time())

	#array declaration
	acclList = []
	
	while (tsEnd - tsInit) < 5:
	
		#Read our Accelerometer values
		Acclx = readAcclx()
		Accly = readAccly()
		Acclz = readAcclz()
		AcclXnorm = Acclx/math.sqrt(Acclx * Acclx + Accly * Accly + Acclz * Acclz)
		acclList.append(AcclXnorm)
		tsEnd = int(time.time())
		
	acclNP = np.array(acclList)
	SDx = np.std(acclNP)

	
	fecha = datetime.datetime.now()
	print(fecha)
	
	Acclx = readAcclx()
	Accly = readAccly()
	Acclz = readAcclz()

	#Normalise Accelerometer raw values.
	AcclXnorm = Acclx/math.sqrt((Acclx * Acclx) + (Accly * Accly) + (Acclz * Acclz))
	AcclYnorm = Accly/math.sqrt((Acclx * Acclx) + (Accly * Accly) + (Acclz * Acclz))
	AcclZnorm = Acclz/math.sqrt((Acclx * Acclx) + (Accly * Accly) + (Acclz * Acclz))
	
	Atotal = AcclDataTotal()
	
	
	#Convert Accelerometer raw to g values
	Atotal = Atotal * aRes #49/1000
	
	##Convert Accelerometer values to degrees
	AcclXangle =  (math.atan2(Accly,Acclz)+3.14)*57.3
	AcclYangle =  (math.atan2(Acclz,Acclx)+3.14)*57.3
	AcclZangle =  (math.atan2(Acclx,Accly)+3.14)*57.3
	
	AcclXIncl = math.atan2(AcclYnorm,AcclXnorm) * 180.0 / math.pi
	
	fecha2 = str(fecha)
	
	ejes = [AcclXnorm,AcclYnorm,AcclZnorm,SDx, AcclXIncl, fecha2]
	misEjes = json.dumps(ejes)
	
	mqttc.publish("pruebas/iot_tutorial/from_beagle", misEjes);


	
	
	
