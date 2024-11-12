import ressources.LCD1602 as LCD1602
import time

def setup():
	LCD1602.init(0x27, 1)	# init(slave address, background light)
	LCD1602.write(0, 0, 'Greetings!!')
	LCD1602.write(1, 1, 'from HiPi.io')
	time.sleep(2)

try:
	setup()
	while True:
			pass
except KeyboardInterrupt:
	exit()