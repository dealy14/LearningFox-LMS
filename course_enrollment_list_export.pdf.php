<?php
session_start();

require_once("includes/mpdf/mpdf.php");
require_once("conf.php");

$cID = array();
$cname = array();
$user_id = $_GET['uid'];

$html ='<!DOCTYPE html>
<html>
<head>
    <title>Course Enrollment List</title>
    <style>
        td {
            padding:5px;
            border-color: gray;
            border-width: 1px;
        }
    </style>
</head>
<body>
<h3>Course Enrollment List</h3>
<table>
<tr>
    <th>Course Title</th>
    <th>Purchased</th>
    <th>Expires</th>
    <th>Status</th>
</tr>';


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
$row = array();
while($db->getRows())
{
    $courseid=$db->row("course_ID");
    $row[$rows][] = $cname[$courseid];
    $row[$rows][] = $db->row("enroll_date");
    $expiration_date = LMS_Utility::get_expiration_date($db->row("enroll_date"));
    $days_remaining = LMS_Utility::date_diff(date('Y-m-d'),$expiration_date);
    $row[$rows][] = $db->row("enroll_date")." (".$days_remaining ." days)";
    $row[$rows][] = ucfirst(($db->row("course_status")));
    $rows++;
}

foreach($row as $r){
    $html .= "<tr><td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td></tr>";
}

$html .= '</table>
</body>
</html>';

$mpdf=new mPDF();
$mpdf->AddPage("P");
$mpdf->WriteHTML($html);
$mpdf->Output("course_list.pdf","D");
exit;
?>