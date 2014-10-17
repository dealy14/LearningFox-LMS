<?php
require_once('conf.php');
#include the export-xls.class.php file
require('includes/export-xls.class.php');

$user_id = $_GET['uid'];
$filename = 'course_list.xls';

#create an instance of the class
$xls = new ExportXLS($filename);

#lets set some headers for top of the spreadsheet
$header = "Course Enrollment Listing"; // single first col text
$xls->addHeader($header);
#add blank line
$header = null;
$xls->addHeader($header);
#add 2nd header as an array of columns
$header[] = "Course Title";
$header[] = "Purchased";
$header[] = "Expires";
$header[] = "Status";
$xls->addHeader($header);

/*$row = array();
$row[] = array(0 =>'course test1', 1=>'2014-01-01', 2=>'2015-03-01', 3=>'Incomplete');
$row[] = array(0 =>'course test2', 1=>'2014-02-01', 2=>'2015-02-01', 3=>'Failed');
$xls->addRow($row);
*/

$cID = array();
$cname = array();

//get course info;
$db = new db;
$db->connect();
$db->query("SELECT created,name,ID,type FROM course WHERE status='active'");
while($db->getRows())
{
    $course_ID=$db->row("ID");
    $cID[$course_ID]=$db->row("ID");
    $cname[$course_ID]=$course_name=$db->row("name");
}
//get user course history info;
$db = new db;
$db->connect();
$db->query("SELECT * FROM course_history WHERE user_ID='$user_id'");
$rows=0;
while($db->getRows())
{
    $row = array();
    $courseid=$db->row("course_ID");
    $row[] = $cname[$courseid];
    $row[] = $db->row("enroll_date");
    $expiration_date = LMS_Utility::get_expiration_date($db->row("enroll_date"));
    $days_remaining = LMS_Utility::date_diff(date('Y-m-d'),$expiration_date);
    $row[] = $db->row("enroll_date")." (".$days_remaining ." days)";
    $row[] = ucfirst(($db->row("course_status")));
    $xls->addRow($row);

    $rows++;
}
$xls->sendFile();
?>