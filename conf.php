<?php
#####################################################################
#Configure Directory values:
#####################################################################
//error_reporting(0);
//$ID       = $_REQUEST["ID"];

// 
//$web_dir="http://localhost/LMS/";
//$web_dir="http://localhost/";
$main_dir= $_SERVER['DOCUMENT_ROOT']."/courses/"; 


$dir_includes = $main_dir."includes/";
$dir_surveys =  $main_dir."surveys/";
$dir_sql = $main_dir."sql/";
$dir_admin = $main_dir."admin/";
$dir_xml = $dir_admin."course_xml/";
$dir_topics = $dir_admin."topics/";
$dir_template = $dir_admin."template/";
$dir_layout = $dir_admin."layout/";
$dir_lms_conf = $main_dir."lms_conf/.lmsconf1";
$dir_components = $main_dir."site_conf/components/";
$dir_siteconf = $main_dir."site_conf/";
$dir_users = $main_dir."users/";
$dir_sessions = $dir_users."sessions/";
$dir_usercourselist = $dir_users."courselist/";
$dir_testlogs = $dir_users."test_logs/";
$dir_groupfiles = $dir_admin."groups/";
$dir_orgfile = $dir_admin."orgs/";
$dir_references = $main_dir."references/";

include($dir_includes."isdefined.php");

#####################################################################
#include special site configurations
#####################################################################
if(!is_null($myconf))
{
	require_once($dir_siteconf.$myconf);
}

#####################################################################
#Configure Database Options:
#$db_type = mysql or odbc
#####################################################################
$db_type="mysql";

$lms_session_expire=0;
#####################################################################
#Include Various Items:
#####################################################################
//include($main_dir."listvariables.php");
//listvariables();
include($dir_includes."class_db_".$db_type.".php");
include($dir_includes."class_fdb.php");
include($dir_includes."functions.php");
include($dir_includes."stored_sql.php");
include($dir_includes."clear_cache.php");
//include($dir_lms_conf);
?>
