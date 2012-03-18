<?php
/* Main Configuration File */

# Set the LMS version--either:
#		1. Company/Demonstration or
#		2. Customer-facing/Content-provider
$lms_version = "demonstration";
//$lms_version = "content-provider";


// Site-specific configuration file found under /site_config/<$myconf>.php

#####################################################################
#Configure Directory values:
#####################################################################
//$ID = $_REQUEST["ID"];

/* Web-server path values */
$web_root = "/LMS/";
$dir_images = $web_root."site_conf/images/";
$dir_css = $web_root."site_conf/css/"; 

/* Filesystem Path Values */
$subdomain_root = "/cosmos-content";
$main_dir = $_SERVER['DOCUMENT_ROOT'].$subdomain_root.$web_root; 
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

#####################################################################
#Configure error handling options and include custom error handler
#####################################################################
$error_level =  E_ALL & ~E_NOTICE;
//$error_level =  E_ALL; // for development or detailed debugging
error_reporting($error_level); 

// set error handler options
$err_cfg = array();
$err_cfg['debug'] = 1; //0=off; 1=on
$err_cfg['adminEmail'] = 'ryan@rammons.net';
$err_cfg['logFile'] = $dir_admin."error_log.txt";
require_once($dir_includes."error_handler.php");

// initialize any expected, yet unset POST/GET variables
require_once($dir_includes."isdefined.php");

#####################################################################
#include special site configurations
#####################################################################
if(!is_null($myconf)){
	#Site Branding Configuration
	$site_title = "Cosmos Consulting LearnCenter";
	$logo_file = $dir_images."logo.png";
	
	require_once($dir_siteconf.$myconf.'.php');
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
require_once($dir_includes."class_db_".$db_type.".php");
require_once($dir_includes."class_fdb.php");
require_once($dir_includes."functions.php");
require_once($dir_includes."stored_sql.php");
require_once($dir_includes."clear_cache.php");

//include($dir_lms_conf);
?>