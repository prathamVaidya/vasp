# VASP
Vaccine Appointment System by Pratham

This vaccine appointment system fetches data from the official public Cowin API to check for vaccine availability in the city for 18-44 Age group.
The vasp client service can be run to automatically check for vaccine avalilability and it can send a message when vaccine is available.

It only works for 18-44 Age Group . You can edit the apn_check.php to change the age or feel free to update the code.

## VASP server
It is wirtten in PHP and can be deployed to any hosting or even on a localhost.

### How to setup?
Copy all the files inside vasp-server to your server (where the .htaccess file is present or any other location as you want).

Once deployed on the server you can use 

       <hostname>/apn_check.php?pincode=<pincode>

Here <hostname> is url of your server and <pincode> the pincode of the city

Example : 192.168.199.151/apn_check.php?pincode=261001
       OR www.your-server.com/apn_check.php?pincode=261001


### Status Codes

The results of the url shows the status of the vaccine availabilty:

- 0 For Unavailable (It is for places where even the 18-44 Age Group vaccine camp has not started yet)
- 1 for Available but all booked 
- 2 for Slots Available (Success)
- 3 for Some error (becuase firewall sometimes blocks requests temporarily)

### Logs

The server by default Logs all the data for the available slot and save it in the logs folder.
Note that the logs are accessible by public by default change file permissions accordingly.

## VASP Client
It is written in bash script and can be executed on all major OS like Linux, Windows and Mac

To run in Linux :
       
      cd vasp-cli-client/
       chmod +x app.sh
      ./app.sh
    
To run in Windows :
      https://www.thewindowsclub.com/how-to-run-sh-or-shell-script-file-in-windows-10
      
This will run the Service and it will start checking for Vaccine Availability. Once It get the vaccine available slots it will send a mesage* to your specified number.
    
### Client Condifgurations
    
#### To change Pincodes list 
 Edit the pincodes.txt with one pincode on each line
    
#### To change the text message mobile number list 
 Edit the mobile.txt with one mobile number on each line
    
    
## Free Message Notification (Very Important)
       
The vasp client sends the text message and notifies them about the vaccine slots availability but to do it for free without using any messaging API's I used 
cowin registration API. This API is public and it was meant for authenticating cowin users with there mobile. 
       
So when a vaccine is avaialable this API will be triggered and a mesage saying "This is your OTP for Cowin Verification will be sent to your phone". You dont have to put OTP anywhere. After deploying the vasp if you get this message (when you didn't even requested for an OTP) then it means it is a Vaccine Slot Notification by Vasp. 
       

