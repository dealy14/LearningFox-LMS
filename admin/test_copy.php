<?php 
require_once("../conf.php");


function makeCourse($from_path, $to_path) { 

  mkdir($to_path, 0777); 
  $this_path = getcwd(); 
  	if (is_dir($from_path)) { 
	  chdir($from_path); 
	  $handle=opendir('.'); 
	  	while (($file = readdir($handle))!==false) { 
	  	  if (($file != ".") && ($file != "..")) { 
	  		if (is_dir($file)) { 
	  		makeCourse($from_path.$file."/",
	  		$to_path.$file."/"); 
	  		chdir($from_path); 
	  		} 
	  		if (is_file($file)){ 
	  		copy($from_path.$file, $to_path.$file); 
	  		} 
	  	  } 
	  	} 
	  closedir($handle); 
	  } 
}

//set up the template directory;
if(!is_dir($main_dir."new_test/"))
{
makeCourse($dir_template, $main_dir."new_test/");
}

//write the functions and create conf.js;

$jconf="
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<SCRIPT>
/*
--------------------------------------------------------------------------------------------------
Write Configuration Structure here;
--------------------------------------------------------------------------------------------------
*/

//TOC related properties;
var linkToc=1;
var highLight=\"#ffff80\";
var rolloverText=\"RED\";
var normalText=\"#000000\";
var visImage=\"images/ch1.gif\";
var timeLimit=0;
var timeReq=0;

/*
--------------------------------------------------------------------------------------------------
Course Structure
--------------------------------------------------------------------------------------------------
*/
var lesson_names = new Array();
var lessons = new Array();
";

$db = new db;
$db->connect();
$db->query("SELECT lesson_name FROM courses_r WHERE course_ID='1' AND lesson_order>='1' ORDER BY lesson_order ASC");
$xm=1;
while($db->getRows())
{ 
$rID=$db->row("ID");
$lname = $db->row("lesson_name");
$jconf.="	lesson_names[$xm]=\"$lname\";
	lessons[$xm] = new Array();

";
$xm++;
}

$jconf.="

";

$db = new db;
$db->connect();
$db->query("SELECT courses_r.lesson_order,lessons_r.topic_name,lessons_r.topic_order,lessons_r.topic_ID FROM courses_r,lessons_r WHERE courses_r.course_ID='1' AND lessons_r.lesson_ID=courses_r.lesson_ID ORDER BY courses_r.lesson_order,lessons_r.topic_order ASC");
$xm=0;
while($db->getRows())
{
$tID = $db->row("topic_ID");
$lnum = $db->row("lesson_order");
$tname = $db->row("topic_name");
$tnum = $db->row("topic_order");
$jconf.="	lessons[$lnum][$tnum] = \"$tname|course/$lnum.$tnum.html\";
";
copy($dir_topics.$tID,$main_dir."new_test/course/$lnum.$tnum.html");
$x++;
}


$filename = $dir_template."functions";
$fd = fopen ($filename, "r");
$jconf.=addslashes(fread ($fd, filesize ($filename)));
fclose ($fd);
to_file($main_dir."new_test/functions.html",$jconf,"w+");
?>