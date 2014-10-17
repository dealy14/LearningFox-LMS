<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ryanwammons
 * Date: 10/16/14
 * Time: 4:41 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("../conf.php");
require_once("LMS_functions.php");

$paymentData['store'] = "store";
$paymentData['orderid'] = "orderid999";
$paymentData['invoice_number'] = "invoice_number999";
$paymentData['payment_date'] = "2014-10-15";
$paymentData['first_name'] = "Ryan";
$paymentData['last_name'] = "Ammons";
$paymentData['email'] = $_GET['email'];//"ryan@rammons.net";
$paymentData['address'] = "address1";
$paymentData['address2'] = "address2";
$paymentData['city'] = "Alexandria";
$paymentData['state'] = "VA";
$paymentData['zip'] = "22312";
$paymentData['country'] = "USA";
$paymentData['phone'] = "555-555-5555";
$paymentData['ip'] = "255.255.255.255";


//test course_id
$course_array[0]['courseid'] = $_GET['courseid'];
$course_array[0]['coursename'] = $_GET['coursename'];

$paymentData['course_info'] = $course_array;

//Write values to the LMS database and generate/send credentials to user
update_LMS($paymentData, $dir_usercourselist);