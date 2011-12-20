<?php
//Get all db and site configuration
require_once('LMS_functions.php');

//HTML tags
$br="<br>";
$hr="<hr>";

//POST Authenticity check
// Ensure that the origin of the POST form action is *.3dcartstores.com.
$authorized_host = "3dcartstores.com";
$remote_ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($remote_ip);
$regexPattern = "/".$authorized_host."$/";

//$hostname="3dcartstores.com";
if (0==preg_match($regexPattern,$hostname))
    exit( "Not authorized." );
else
    echo "Authorized.".$br.$hr;

//                              (SimpleXML chokes on non-encoded &'s...)
//$data = ereg_replace("& ", "&amp; ", file_get_contents($file));

//Get the POST variable 'xml' and HTML-dencode
$data = html_entity_decode($_POST['xml'], ENT_QUOTES, 'UTF-8');

mail("ryan@rammons.net","Begin parsing XML - XML POST Data Field",htmlentities($data),"From:admin@learningfox.com");

//Parse the XML file's contents
try {
	$order = new SimpleXMLElement($data);
} catch (Exception $e) {
    mail("ryan@rammons.net","SimpleXMLElement parse excetion","Caught exception: ".$e->getMessage(),"From:admin@learningfox.com"); 
}

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

/*foreach ($paymentData as $key=>$value){
    echo $key.": ".$value.$br;
}*/

mail("ryan@rammons.net","Order info",implode(",",$paymentData),"From:admin@learningfox.com");

//Write values to the LMS database and generate/send credentials to user
update_LMS($paymentData, $dir_usercourselist, $paymentData['courseid']);

//echo $hr.$br."lms_userID =".$lms_userID;
//echo "userfile =".$userfile;
//echo $ac_message;

echo "Probably successful.";
?>