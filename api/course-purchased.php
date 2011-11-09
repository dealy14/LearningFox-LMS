<?php
//Get all db and site configuration
require_once('LMS_functions.php');

//HTML tags
$br="<br>";
$hr="<hr>";

//POST Authenticity check
// Ensure that 3dcart.com is in fact the origin of the POST form action.

//echo $_SERVER['HTTP_REFERER'];

//$authorizedDomain="localhost";
$authorizedDomain="learningfox.com";

if (!preg_match("/".$authorizedDomain."/", $_SERVER['HTTP_REFERER']))
    exit( "Not authorized." );
else
    echo "Authorized.".$br.$hr;

//echo $_SERVER['HTTP_REFERER'];

//Verify that the XML file was saved without error before continuing
if ($_FILES["file"]["error"] > 0)  {
  	echo "Error: ".$_FILES["file"]["error"].$br;
	die();
}
/*else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  echo "<br><br>";
  }*/

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

/*foreach ($paymentData as $key=>$value){
    echo $key.": ".$value.$br;
}*/
//echo $hr;

//Write values to the LMS database and generate/send credentials to user
update_LMS($paymentData, $dir_usercourselist, $paymentData['courseid']);

//echo $hr.$br."lms_userID =".$lms_userID;
//echo "userfile =".$userfile;
//echo $ac_message;

echo "Probably successful.";
?>