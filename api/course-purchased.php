<?php
//Get all db and site configuration
require_once('LMS_functions.php');
//HTML tags
$br="<br>";
$hr="<hr>";
//POST Authenticity check
// Ensure that californiaeducationconnection.com server IP is in fact
// the origin of the POST form action.
//Static IP for californiaeducationconnection.com
$authorized_ip = '174.37.45.113';
//$authorized_ip = '68.178.254.198'; //Static IP for learningfox.com
$remote_ip = $_SERVER['REMOTE_ADDR'];
//$authorized_ip = '70.179.77.227';//local IP for testing
//echo $br."authorized_ip==remote_ip? ".($authorized_ip==$remote_ip);
/*if ($authorized_ip != $remote_ip)
	exit( "Not authorized." );
else
echo "Authorized.".$br.$hr;
//Retrieve POSTed temporary XML file
$file = $_FILES["file"]["tmp_name"];
//Get the file contents as a string, then HTML-encode ampersands
//                              (SimpleXML chokes on non-encoded &'s...)
	$data = ereg_replace("& ", "&amp; ", file_get_contents($file));
//Parse the XML file's contents
$order = new SimpleXMLElement($data);
$paymentData['store'] = $order->Store;
$paymentData['orderid'] = $order->OrderID;
$paymentData['invoice_number'] = $order->InvoiceNumber;
$paymentData['payment_date'] = $order->Date;
$paymentData['first_name'] = $order->Student->FirstName;
$paymentData['last_name'] = $order->Student->LastName;
$paymentData['email'] = $order->Student->Email;
$paymentData['address'] = $order->Student->Address;
$paymentData['address2'] = $order->Student->Address2;
$paymentData['city'] = $order->Student->City;
$paymentData['zip'] = $order->Student->ZipCode;
$paymentData['state'] = $order->Student->StateCode;
$paymentData['country'] = $order->Student->CountryCode;
$paymentData['phone'] = $order->Student->Phone;
$paymentData['ip'] = $order->Student->IP;
$paymentData['courseid'] = $order->Course->CourseID;
$paymentData['coursename'] = $order->Course->CourseName;
$paymentData['courseprice'] = $order->Course->CoursePrice;
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

//$foobar = print_r($_REQUEST,true);
//mail("ryan@rammons.net","foobar",$foobar,"From: admin@cosmosconsultingllc.com");

if (isset($_REQUEST['course_info'])){
/*
	$temp = $_REQUEST['course_info'];
	$temp2 = unserialize($temp);
	mail("ryan@rammons.net","temps", "temp: " . $temp . "\ntemp2: " . 
			print_r($temp2), "From: admin@cosmosconsultingllc.com");
*/
	
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

/*
foreach ($paymentData as $key=>$value)
{
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