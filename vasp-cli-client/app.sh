#!/bin/sh
# VASP, Vaccine Appointment Schedular by Pratham
 # edit Pincodes in pincode.txt list
 
while : $RESPONSE -lt  2;
do
	
while read PIN; do
  
RESPONSE=$(curl http://192.168.199.151/api/vaccine/apn_check.php?pincode=$PIN)

case $RESPONSE in
2)
	echo "Slots Available for $PIN"
	
	while read mobile; do
 		curl http://192.168.199.151/api/vaccine/send_apn_otp.php?mobile=$mobile
	done </usr/local/src/vasp/mobile.txt
	
 

	# Edit Mobile number List in mobile.txt
		sleep 160
	;;
1)
	echo "All Slots Booked for $PIN"
	;;
0)
	echo "Slot Unavailable for $PIN"
	;;
*)
	echo "API Response Error"	
	;;
esac


done </usr/local/src/vasp/pincodes.txt

sleep 6
done
