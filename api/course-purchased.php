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
//$authorized_ip = '174.37.45.113';
$authorized_host = "3dcartstores.com";

//$remote_host = $_SERVER['REMOTE_HOST'];
//$server_name = $_SERVER['SERVER_NAME'];

$remote_ip = $_SERVER['REMOTE_ADDR'];

$hostname = gethostbyaddr($remote_ip);

$regexPattern = "/".$authorized_host."$/";

//$hostname="3dcartstores.com";

//mail("ryan@rammons.net","Script Accessed by ".$hostname,"","From:admin@learningfox.com");
if (0==preg_match($regexPattern,$hostname))
    exit( "Not authorized." );
else
    echo "Authorized.".$br.$hr;

//mail("ryan@rammons.net","Authorized Access by ".$hostname,"","From:admin@learningfox.com");

$formData = print_r($_REQUEST, true);

//Verify that the XML file was saved without error before continuing
if ($_FILES["file"]["error"] > 0)  {
  	mail("ryan@rammons.net","Error","Error: ".$_FILES["file"]["error"],"From:admin@learningfox.com");
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

$numFiles=0;
foreach($_FILES as $eachFile)
{
     if($eachFile['size'] > 0)
        $numFiles++;
}


//Get the file contents as a string, then HTML-encode ampersands
//                              (SimpleXML chokes on non-encoded &'s...)
$data = ereg_replace("& ", "&amp; ", file_get_contents($file));

mail("ryan@rammons.net","Begin parsing XML",$data." - number of files: ".$numFiles."\n\r".$formData,"From:admin@learningfox.com");

//Parse the XML file's contents

try {
	$order = new SimpleXMLElement($data);
} catch (Exception $e) {
    mail("ryan@rammons.net","SimpleXMLElement parse excetion","Caught exception: ".$e->getMessage(),"From:admin@learningfox.com"); 
}

mail("ryan@rammons.net","Parse of XML successful","","From:admin@learningfox.com");

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


mail("ryan@rammons.net","Order info",implode(",",$paymentData),"From:admin@learningfox.com");


//Write values to the LMS database and generate/send credentials to user
update_LMS($paymentData, $dir_usercourselist, $paymentData['courseid']);

//echo $hr.$br."lms_userID =".$lms_userID;
//echo "userfile =".$userfile;
//echo $ac_message;

echo "Probably successful.";
?>