<?php
//Get all db and site configuration
require_once('LMS_functions.php');
//HTML tags
$br="<br>";
$hr="<hr>";
//POST Authenticity check
// Ensure that cosmosconsultingllc.com server IP is in fact
// the origin of the POST form action.

//		!!!!!need to change for COSMOS!!!!!

//Static IP for californiaeducationconnection.com
$authorized_ip = '174.37.45.113';
//$authorized_ip = '68.178.254.198'; //Static IP for learningfox.com
$remote_ip = $_SERVER['REMOTE_ADDR'];
//$authorized_ip = '70.179.77.227';//local IP for testing
//echo $br."authorized_ip==remote_ip? ".($authorized_ip==$remote_ip);


//  !!!!NEED to reactivate!!!!!

/*if ($authorized_ip != $remote_ip)
	exit( "Not authorized." );
else
	echo "Authorized.".$br.$hr;
*/

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
/*
	$temp = $_REQUEST['course_info'];
	$temp2 = unserialize($temp);
	mail("ryan@rammons.net","temps", "temp: " . $temp . "\ntemp2: " . 
			print_r($temp2), "From: admin@cosmosconsultingllc.com");
*/
	
	if (magic_quotes_gpc)
		$temp = unserialize(urldecode($_REQUEST['course_info']));
	else
		$temp = unserialize(urldecode($_REQUEST['course_info']));
	$paymentData['course_info'] = $temp;
	
}
else{
	die("course_info not set!");
}

//var_dump($paymentData);

/*
foreach ($paymentData as $key=>$value){
	echo $key.": ".$value.$br;
}
*/

//echo $hr;
//Write values to the LMS database and generate/send credentials to user
update_LMS($paymentData, $dir_usercourselist);
//echo $hr.$br."lms_userID =".$lms_userID;
//echo "userfile =".$userfile;
//echo $ac_message;
//echo "Probably successful.";
?>