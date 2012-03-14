<?php
#Site Branding Configuration

$site_title = "Cosmos Consulting LearnCenter";
$logo_file = $dir_images."logo.png";

$buttombanner="<img src=\"images/buttombanner.gif\" />";

#############################################################################################
#Require the "Session Component"
#############################################################################################
if($section!="" && $section!="elearning" && $section!="catelog" && 
  		$section!="catelog_subpage" && $section!="get_started" && 
		$section!="contact" && $section!="login" && $section!="register") {
	require_once($dir_components."session_check.php");
}

#############################################################################################
#Set up switch statements to catch the "section" values and alter them 
#############################################################################################

switch($section)
{
  case '':
  	$mylogin="html/login.html";
  	$mysection=$dir_components."content_login.php";
	break;

  case 'get_started':
	$mysection=$dir_components."content_getstarted.php";
	break;  

  case 'login':
	$mylogin="html/login.html";
  	$mysection=$dir_components."content_login.php";
  	break;

  case 'messageboard':
	$mysection=$dir_components."board/mboard.php";
  	break; 

  case 'msg':
  	$mysection=$dir_components."board/msg/".$_GET['count'].".html";
  	break; 

  case 'library':
  	$mysection=$dir_components."library.php";
  	break;  

  case 'forums':
  	$mysection=$dir_components."forums_listing.php";
  	break;   

  case 'add_member':
  	$mysection="html/add_form.html";
  	break;

  default:  // Almost all components will be set with the pass-through $section variable
  	$mysection=$dir_components."content_$section.php";
}
?>