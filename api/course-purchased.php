<?php
//Get all db and site configuration
require_once('LMS_functions.php');
//HTML tags
$br="<br>";
$hr="<hr>";
//POST Authenticity check
// Ensure that the POST's remote IP is an 
//	authorized/whitelisted IP.

$remote_ip = $_SERVER['REMOTE_ADDR'];
$server_ip = $_SERVER['SERVER_ADDR'];
//For Cosmos, we expect it to be originating from the same server
$authorized_ip = $server_ip;  

if ($authorized_ip != $remote_ip)
	exit( "Not authorized." );
else
	echo "Authorized.".$br.$hr;

$order = $_POST;

$paymentData['store'] = $order['store'];
$paymentData['orderid'] = $order['orderid'];
$paymentData['invoice_number'] = $order['invoice_number'];
$paymentData['payment_date'] = $order['payment_date'];
$paymentData['first_name'] = $order['first_name'];
$paymentData['last_name'] = $order['last_name'];
$paymentData['email'] = $order['email'];
$paymentData['address'] = $order['address'];
$paymentData['address2'] = $order['address2'];
$paymentData['city'] = $order['city'];
$paymentData['state'] = $order['state'];
$paymentData['zip'] = $order['zip'];
$paymentData['country'] = $order['country'];
$paymentData['phone'] = $order['phone'];
$paymentData['ip'] = $order['ip'];

if (isset($_REQUEST['course_info'])){
	
/*	$temp = $_REQUEST['course_info'];
	$temp2 = stripslashes($temp);
	$temp3 = unserialize($temp2);
	mail("ryan@rammons.net","temps", "temp: " . $temp . "\ntemp2: " . 
			$temp2."\n\ntemp3: ".$temp3,
			 "From: admin@cosmosconsultingllc.com");  */
	if (magic_quotes_gpc)
		$temp = unserialize(stripslashes($_REQUEST['course_info']));
	else
		$temp = unserialize($_REQUEST['course_info']);
	
	$paymentData['course_info'] = $temp;
	
}
else{
	die("course_info not set!");
}

//var_dump($paymentData);
/* foreach ($paymentData as $key=>$value){	echo $key.": ".$value.$br; } */

//Write values to the LMS database and generate/send credentials to user
update_LMS($paymentData, $dir_usercourselist);

//echo $hr.$br."lms_userID =".$lms_userID;
//echo "userfile =".$userfile;
//echo $ac_message;
//echo "Probably successful.";
?>