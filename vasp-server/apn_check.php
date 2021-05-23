<?php

//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

 function responseLog($center,$response){

$log  = "Time: ".date("F j, Y, g:i a").PHP_EOL.
        "Center Name: ".($center->name).PHP_EOL.
        "Address: ".($center->address).PHP_EOL.       
	"District: ".($center->district_name).PHP_EOL. 
	"Pincode: ".($center->pincode).PHP_EOL. 

	"-------------------------".PHP_EOL.
"Sessions: ".PHP_EOL.(json_encode($center->sessions,JSON_PRETTY_PRINT)).PHP_EOL. 
"Center: ".PHP_EOL.(json_encode($center,JSON_PRETTY_PRINT)).PHP_EOL.
"Raw JSON: ".PHP_EOL.($response).PHP_EOL.
"---------------------------------------------------".PHP_EOL;

//Save string to log, use FILE_APPEND to append.
file_put_contents('./logs/log_'.date("j.n.Y").'_'.($center->district_name).'.log', $log, FILE_APPEND);

}


$curl = curl_init();
$date = date("d-m-Y");

if(empty($_GET['pincode'] )){
	$pin = "261001";	
}
else{
	$pin = $_GET['pincode'];
}

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByPin?pincode='.$pin.'&date='.$date,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept-Language: en_US',
    'User-Agent: PostmanRuntime/7.26.8'
  ),
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
	$isAvailable = 3; // For error
echo $isAvailable;	
exit();
	
}

curl_close($curl);
$sessObj = json_decode($response);

$isAvailable = 0; // not available

foreach($sessObj->centers as $center){
	if($isAvailable == 2){
		break;
			}

	foreach($center->sessions as $session ){
		if($session->min_age_limit < 45){
							
	if($session->available_capacity_dose1 > 0){
		$isAvailable = 2; // available
		
		responseLog($center,$response);
		
				}
		else{
			$isAvailable = 1; //all booked
		}			
			break;
	
						}
	}
}



echo $isAvailable;

//echo $response;

?>
