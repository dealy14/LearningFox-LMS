<?php
/* Main Configuration File */

# Set the LMS version--either:
#		1. Company/Demonstration or
#		2. Customer-facing/Content-provider
$lms_version = "demo_site";
//$lms_version = "content_site";

if ("demo_site"==$lms_version) {
	$show_top_menu = true;
	$show_left_navbar = true;
	$post_login_redirect_section = "landing";

}
elseif ("content_site"==$lms_version) {
	$show_top_menu = false;
	$show_left_navbar = false;
	$post_login_redirect_section = "enrollment";	
}
else{
	$show_top_menu = true;
	$show_left_navbar = true;
	$post_login_redirect_section = "landing";
}

$default_email = "admin@safetytrainingsystem.com";

// Site-specific configuration file found under /site_config/<$lms_version>.php

#####################################################################
#Configure error handling options
#####################################################################
$error_level =  E_ALL & ~E_NOTICE;
//$error_level =  E_ALL; // for development or detailed debugging
error_reporting($error_level); 

#####################################################################
#Configure Directory values:
#####################################################################
//$ID = $_REQUEST["ID"];

// Domain name and related info
$domain_name = "safetytrainingsystem.com/";
$lms_url = "LMS/";
$lms_url_fq = $domain_name . $lms_url;
/*
$domain_name = "hosting.ammonsdatasolutions.com/";

$lms_url = "cosmos/";
$lms_url_fq = $domain_name . $lms_url;
*/

// This check is necessary for Go Daddy. It does not change
// $_SERVER['DOCUMENT_ROOT'] to include the subdirectory if the domain
// is mapped to a subdirectory of the hosting account. It does, however,
// change $_SERVER['SUBDOMAIN_DOCUMENT_ROOT']. See
// <http://www.robertmullaney.com/2010/09/09/subdomains-document-root/> for
// more info.
// NOTE: If the site is not in a subdirectory-domain, SUBDOMAIN_DOCUMENT_ROOT 
//  	is simply unset in some configurations.
if ($_SERVER['DOCUMENT_ROOT'] === $_SERVER['SUBDOMAIN_DOCUMENT_ROOT']
		or !isset($_SERVER['SUBDOMAIN_DOCUMENT_ROOT']))
	$main_dir = $_SERVER['DOCUMENT_ROOT'] . "/" . $lms_url;
else
	$main_dir = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] . "/" . $lms_url;

/* Web-server path values - URLs */
$dir_images = "/" . $lms_url . "site_conf/images/";
$dir_css = "/" . $lms_url . "site_conf/css/"; 

/* Filesystem Path Values */
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

// Set error handler options
$err_cfg = array();
$err_cfg['debug'] = 1; //0=off; 1=on
$err_cfg['adminEmail'] = $default_email;
$err_cfg['logFile'] = $dir_admin."error_log.txt";
require_once($dir_includes."error_handler.php");

// initialize any expected, yet unset POST/GET variables
require_once($dir_includes."isdefined.php");

#####################################################################
#Branding and special site configurations
#####################################################################
#Site Branding Configuration

define(TEXT_SITE_TITLE, "Cosmos Consulting LearnCenter");
define(PATH_LOGO_FILE, $dir_images."logo.png");
define(TEXT_COMPANY_NAME, "Cosmos");
define(TEXT_LMS_FULL_SYSTEM_NAME, "Learning Safety Management System (LSMS)");

require_once($dir_siteconf.$lms_version.'.php');

#####################################################################
#Configure Database Options:
#$db_type = mysql or odbc
#####################################################################
$db_type="mysql";
$lms_session_expire=0;

#####################################################################
#Global values/lists
#####################################################################
/* User Access Levels
	For such a simple lookup, decided against a new database table*/
$user_levels = array(1 => 'Regular User', 
					2 => 'Manager (Reports access)', 
					3 => 'Administrator (full access)');

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