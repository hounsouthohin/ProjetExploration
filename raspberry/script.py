import ressources.LCD1602 as LCD1602
import RPi.GPIO as GPIO
import time
import mysql.connector
from mysql.connector import Error

"""mettre num de table pour statistique + mettre un WHERE sur les update du trigger"""

DHTPIN = 17
GPIO.setmode(GPIO.BCM)

def create_server_connection(host_name, user_name, user_password, db_name):
    connection = None
    try:
        connection = mysql.connector.connect(
            host=host_name,
            user=user_name,
            passwd=user_password,
            database=db_name
        )
        print("MySQL Database connection successful")
    except Error as err:
        print(f"Error: '{err}'")

    return connection

connection = create_server_connection("localhost", "root", "cegep", "BD_Final")

def insert_data(connection, query):
    cursor = connection.cursor()
    try:
        cursor.execute(query)
        cursor.fetchall()
        print("ok")
    except Error as err:
        print(f"Error: '{err}'")

def afficher_moy(connection, query):
    cursor = connection.cursor()
    try:
        cursor.execute(query)
        return cursor.fetchall()        
    except Error as err:
        print(f"Error: '{err}'")



MAX_UNCHANGE_COUNT = 100

STATE_INIT_PULL_DOWN = 1
STATE_INIT_PULL_UP = 2
STATE_DATA_FIRST_PULL_DOWN = 3
STATE_DATA_PULL_UP = 4
STATE_DATA_PULL_DOWN = 5

def setup(moyHum, moyTemp):
	LCD1602.init(0x27, 1)	# init(slave address, background light)
	LCD1602.write(0, 0, moyHum)
	LCD1602.write(1, 0, moyTemp)
	time.sleep(2)

def lireCapteur():
	GPIO.setup(DHTPIN, GPIO.OUT, initial=GPIO.HIGH)
	time.sleep(0.05)
 
    # Then, LOW for at least 18ms (we use 0.02s which is 20ms)
	GPIO.output(DHTPIN, GPIO.LOW)
	time.sleep(0.02)

    # Wait for the response from DHT11.
    # (No pull-up needed, they are already installed on the sensor board)
    #GPIO.setup(DHTPIN, GPIO.IN)
    # The following line does the same but activates the pull-up some DHT11 board need (not ours!)
	GPIO.setup(DHTPIN, GPIO.IN, pull_up_down=GPIO.PUD_UP)

	unchanged_count = 0
	last = -1
	data = []
	while True:
		current = GPIO.input(DHTPIN)
		data.append(current)
		if last != current:
			unchanged_count = 0
			last = current
		else:
			unchanged_count += 1
			if unchanged_count > MAX_UNCHANGE_COUNT:
				break

	state = STATE_INIT_PULL_DOWN

	lengths = []
	current_length = 0

	for current in data:
		current_length += 1

		if state == STATE_INIT_PULL_DOWN:
			if current == GPIO.LOW:
				state = STATE_INIT_PULL_UP
			else:
				continue
		if state == STATE_INIT_PULL_UP:
			if current == GPIO.HIGH:
				state = STATE_DATA_FIRST_PULL_DOWN
			else:
				continue
		if state == STATE_DATA_FIRST_PULL_DOWN:
			if current == GPIO.LOW:
				state = STATE_DATA_PULL_UP
			else:
				continue
		if state == STATE_DATA_PULL_UP:
			if current == GPIO.HIGH:
				current_length = 0	
				state = STATE_DATA_PULL_DOWN
			else:
				continue
		if state == STATE_DATA_PULL_DOWN:
			if current == GPIO.LOW:
				lengths.append(current_length)
				state = STATE_DATA_PULL_UP
			else:
				continue
	if len(lengths) != 40:
		print ("Data not good, skip 1")
		return False

	shortest_pull_up = min(lengths)
	longest_pull_up = max(lengths)
	halfway = (longest_pull_up + shortest_pull_up) / 2
	bits = []
	the_bytes = []
	byte = 0

	for length in lengths:
		bit = 0
		if length > halfway:
			bit = 1
		bits.append(bit)
    #print ("bits: %s, length: %d" % (bits, len(bits)))
	for i in range(0, len(bits)):
		byte = byte << 1
		if (bits[i]):
			byte = byte | 1
		else:
			byte = byte | 0
		if ((i + 1) % 8 == 0):
			the_bytes.append(byte)
			byte = 0
    #print (the_bytes)
	checksum = (the_bytes[0] + the_bytes[1] + the_bytes[2] + the_bytes[3]) & 0xFF
	if the_bytes[4] != checksum:
		print ("Data not good, skip 2")
		return False

	return the_bytes[0], the_bytes[2]



try:
	setup()
	compteur = 0
	moyTemp = 0.0
	moyHum = 0.0
	while True:
		result = lireCapteur()
		compteur += 1

		if result:
			humidity, temperature = result
			print ("humidity: %s %%,  Temperature: %s °C" % (humidity, temperature))
			query = ("INSERT INTO Statistique(humidite, temperature) VALUES (%s, %s)"(humidity, temperature))
			insert_data(connection, query)
		time.sleep(1)
		if compteur == 60:
			compteur = 0
			query = ("SELECT moyTemp FROM ")

		
except KeyboardInterrupt:
	exit()