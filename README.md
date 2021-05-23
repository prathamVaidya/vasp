# VASP
Vaccine Appointment System by Pratham

This vaccine appointment system helps fetches data from the official public cowin API to check for vaccine availability in the city for 18+.
The vasp client service can be run to automatically check for vaccine avalilability and it can send a message when vaccine is available.

## VASP server
It is wirtten in PHP and can be deployed to any hosting or even on a localhost.

### How to setup?
Copy all the files inside vasp-server to your server (where the .htaccess file is present or any other location as you want).

Once deployed on the server you can use 

<hostname>/apn_check.php?pincode=<pincode>

Here <hostname> is url of your server and <pincode> the pincode of the city

Example : 192.168.199.151/api/vaccine/apn_check.php?pincode=261001


### Status Codes

The results of the url shows the status of the vaccine availabilty:

- 0 For Unavailable (It is for places where even the 18+ vaccine camp has not started yet)
- 1 for Available but all booked 
- 2 for Slots Available (Success)
- 3 for Some error (becuase firewall sometimes blocks requests temporarily)

### Logs

The server by default Logs all the data for the available slot and save it in the logs folder.
Note that the logs are accessible by public by default change file permissions accordingly.

## VASP Client
It is written in bash script and can be executed on all major OS Linux, Windows and Mac

To run in Linux :
      cd cd vasp-cli-client/
      ./app.sh
      
    This will run the Service and it will start checking for Vaccine Availability. Once It get the vaccine available slots it will send a mesage* to your specified number.
    
    ### Client Condifgurations
    
    #### To change Pincodes list for which availability will be check edit the pincodes.txt with one pincode on every line
    
    #### To change the text message mobile number list edit the mobile.txt with one mobile number on every line
    
    
   
