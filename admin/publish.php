<?php 
require_once("../conf.php");
?>
<HTML>
<BODY BGCOLOR="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0" BOTTOMMARGIN="0">
<IMG SRC="images/publish.gif">
<?php
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
if(!is_dir($main_dir."$ID/"))
{
makeCourse($dir_template."template1/", $main_dir."$ID/");
}


//Begin head of TOC file;
$filename = $dir_template."template1/lib/toc_head.html";
$fd = fopen ($filename, "r");
$tconf.=addslashes(fread ($fd, filesize ($filename)));
fclose ($fd);

//read layout file here;
if(file_exists($dir_layout.$ID))
{
$layout_s = file($dir_layout.$ID);
$rlayout = explode("|",$layout_s[0]);

$mywidth=$rlayout[0];
$myheight=$rlayout[1];
$mylayout=$rlayout[2];

$my_a_type=$rlayout[3];
$my_a_size=$rlayout[4];
$my_a_frame=$rlayout[5];

$my_b_type=$rlayout[6];
$my_b_size=$rlayout[7];
$my_b_frame=$rlayout[8];

$my_c_type=$rlayout[9];
$my_c_size=$rlayout[10];
$my_c_frame=$rlayout[11];

$my_d_type=$rlayout[12];
$my_d_size=$rlayout[13];
$my_d_frame=$rlayout[14];
}

if($mylayout==5||$mylayout==4)
{
$useTopic=0;
$useNav=1;
}
else if($mylayout==6)
{
$useTopic=0;
$useNav=0;
}
else
{
$useTopic=1;
$useNav=1;
}

//write the functions and create conf.js;

$jconf="
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<TITLE>LT Online Course Demo</TITLE>
<SCRIPT>
/*
--------------------------------------------------------------------------------------------------
Write Configuration Structure here;
--------------------------------------------------------------------------------------------------
*/

//TOC related properties;
var useToc=$useTopic;
var useNav=$useNav;
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
$db->query("SELECT lesson_name FROM courses_r WHERE course_ID='$ID' AND lesson_order>='1' ORDER BY lesson_order ASC");
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



$db = new db;
$db->connect();
$db->query("SELECT courses_r.lesson_order,courses_r.lesson_name,lessons_r.topic_name,lessons_r.topic_order,lessons_r.topic_ID FROM courses_r,lessons_r WHERE courses_r.course_ID='$ID' AND lessons_r.lesson_ID=courses_r.lesson_ID ORDER BY courses_r.lesson_order,lessons_r.topic_order ASC");
$xm=0;
while($db->getRows())
{
$tID = $db->row("topic_ID");
$lnum = $db->row("lesson_order");
$nlname = $db->row("lesson_name");
$tname = $db->row("topic_name");
$tnum = $db->row("topic_order");
$jconf.="	lessons[$lnum][$tnum] = \"$tname|$lnum.$tnum.html\";
";

//----------add more to the toc file here-----;
if($tnum==1)
{
$tconf.="

  <TR><TD COLSPAN='2' BGCOLOR='#93BEE2' NOWRAP><IMG SRC='images/crv.gif'><B><FONT FACE='VERDANA' SIZE='1'>$nlname</B></TD></TR>
";
}
$tconf.="<TR CLASS='rbkg' ID=r".($xm+1).">
      <TD WIDTH='20' BGCOLOR='#FFFFFF' HALIGN='RIGHT'><B><FONT FACE='VERDANA' SIZE='1'><IMG SRC='images/spcr2.gif' NAME='rimg".($xm+1)."' HEGHT='18' WIDTH='18' ALT='Topic not completed'></TD>
      <TD NOWRAP><FONT FACE='VERDANA' SIZE='1'><A HREF='#' CLASS='text' onClick=\"top.t_cnt=".($xm+1).";top.setBG(top.t_cnt);top.lesson_number=$lnum;top.topic_number=$tnum;top.setLocations();top.content.location='blank.html';top.navState();top.setLessonLoc();top.pushToArray();\">$tname <BR><IMG SRC='images/spcr2.gif' HEIGHT='1' WIDTH='226' BORDER='0'></TD>
</TR>
";

//copy the HTML course files over;
copy($dir_topics.$tID,$main_dir."$ID/course/$lnum.$tnum.html");
$xm++;
}
$total_topics=$xm;

$jconf.="

/*
--------------------------------------------------------------------------------------------------
Define root-level properties for lesson count
--------------------------------------------------------------------------------------------------
*/	
//Root-Level properties (do not change!!);
var bName = navigator.appName;		
var lesson_number=1;
var topic_number=1;
var t_cnt=1;
var Alltopics=$total_topics;
var past_t_cnt;
var nav_last;
var nav_next;
var bType;
var tocLink=\"\";
var total_lessons=lessons.length-1;	
var toc_loaded=\"no\";
var toc_firstLoad=\"yes\";
var indexItem=\"toc\";
";


//copy static functions here;
$filename = $dir_template."template1/lib/write_functions_2.html";
$fd = fopen ($filename, "r");
$jconf.=addslashes(fread ($fd, filesize ($filename)));
fclose ($fd);

//build HTML frame set here;


$mainFrameRows="0,0,*,35";
$mainFrameCols="*";
$secondFrameRows="*";
$secondFrameCols="250,*";


if($mylayout==1)
{
$jconf.="

<FRAMESET ROWS='$mainFrameRows' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0' COLS='$mainFrameCols'> 
  <FRAME NAME='datapost' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='data' SCROLLING='NO' SRC='../includes/lt_track.php?user_ID=\<?php echo \$user_ID\?>&course_ID=$ID' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
    <FRAMESET ROWS='$secondFrameRows' COLS='$secondFrameCols' FRAMEBORDER='YES' BORDER='0' FRAMESPACING='1' BORDERCOLOR='#93BEE2'>	
	<FRAME NAME='tocs' SCROLLING='AUTO' noresize SRC='toc.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
	<FRAME NAME='content' SCROLLING='AUTO' SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
   </FRAMESET>
  <FRAME NAME='nav' SCROLLING='NO' noresize SRC='nav.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>    
</FRAMESET>
<NOFRAMES>
<BODY BGCOLOR='#FFFFFF'  TOPMARGIN='0' LEFTMARGIN='0' MARGINHEIGHT='0' MARGINWIDTH='0'></NOFRAMES>
</BODY>
</HTML>
";
}

else if($mylayout==2)
{

$jconf.="

<FRAMESET ROWS='$mainFrameRows' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0' COLS='$mainFrameCols'> 
  <FRAME NAME='datapost' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='data' SCROLLING='NO' SRC='../includes/lt_track.php?user_ID=\<?php echo \$user_ID\?>&course_ID=$ID' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
    <FRAMESET ROWS='*' COLS='*,250' FRAMEBORDER='YES' BORDER='0' FRAMESPACING='1' BORDERCOLOR='#93BEE2'>
	<FRAME NAME='content' SCROLLING='AUTO' SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>	
	<FRAME NAME='tocs' SCROLLING='AUTO' noresize SRC='toc.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
   </FRAMESET>
  <FRAME NAME='nav' SCROLLING='NO' noresize SRC='nav.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>    
</FRAMESET>
<NOFRAMES>
<BODY BGCOLOR='#FFFFFF'  TOPMARGIN='0' LEFTMARGIN='0' MARGINHEIGHT='0' MARGINWIDTH='0'></NOFRAMES>
</BODY>
</HTML>
";

}

else if($mylayout==3)
{

$jconf.="

<FRAMESET ROWS='0,0,50,*,35' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0' COLS='$mainFrameCols'> 
  <FRAME NAME='datapost' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='data' SCROLLING='NO' SRC='../includes/lt_track.php?user_ID=\<?php echo \$user_ID\?>&course_ID=$ID' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='header' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
    <FRAMESET ROWS='$secondFrameRows' COLS='$secondFrameCols' FRAMEBORDER='YES' BORDER='0' FRAMESPACING='1' BORDERCOLOR='#93BEE2'>	
	<FRAME NAME='tocs' SCROLLING='AUTO' noresize SRC='toc.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
	<FRAME NAME='content' SCROLLING='AUTO' SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
   </FRAMESET>
  <FRAME NAME='nav' SCROLLING='NO' noresize SRC='nav.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>    
</FRAMESET>
<NOFRAMES>
<BODY BGCOLOR='#FFFFFF'  TOPMARGIN='0' LEFTMARGIN='0' MARGINHEIGHT='0' MARGINWIDTH='0'></NOFRAMES>
</BODY>
</HTML>
";
}

else if($mylayout==4)
{

$jconf.="

<FRAMESET ROWS='0,0,50,*,35' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0' COLS='$mainFrameCols'> 
  <FRAME NAME='datapost' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='data' SCROLLING='NO' SRC='../includes/lt_track.php?user_ID=\<?php echo \$user_ID\?>&course_ID=$ID' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='header' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='content' SCROLLING='AUTO' SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='nav' SCROLLING='NO' noresize SRC='nav.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>    
</FRAMESET>
<NOFRAMES>
<BODY BGCOLOR='#FFFFFF'  TOPMARGIN='0' LEFTMARGIN='0' MARGINHEIGHT='0' MARGINWIDTH='0'></NOFRAMES>
</BODY>
</HTML>
";
}

else if($mylayout==5)
{

$jconf.="

<FRAMESET ROWS='0,0,*,35' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0' COLS='$mainFrameCols'> 
  <FRAME NAME='datapost' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='data' SCROLLING='NO' SRC='../includes/lt_track.php?user_ID=\<?php echo \$user_ID\?>&course_ID=$ID' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='content' SCROLLING='AUTO' SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='nav' SCROLLING='NO' noresize SRC='nav.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>    
</FRAMESET>
<NOFRAMES>
<BODY BGCOLOR='#FFFFFF'  TOPMARGIN='0' LEFTMARGIN='0' MARGINHEIGHT='0' MARGINWIDTH='0'></NOFRAMES>
</BODY>
</HTML>
";
}

else if($mylayout==6)
{

$jconf.="

<FRAMESET ROWS='0,0,*' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0' COLS='$mainFrameCols'> 
  <FRAME NAME='datapost' SCROLLING='NO' noresize SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='data' SCROLLING='NO' SRC='../includes/lt_track.php?user_ID=\<?php \$user_ID\?>&course_ID=$ID' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>
  <FRAME NAME='content' SCROLLING='AUTO' SRC='blank.html' FRAMEBORDER='NO' BORDER='0' FRAMESPACING='0'>   
</FRAMESET>
<NOFRAMES>
<BODY BGCOLOR='#FFFFFF'  TOPMARGIN='0' LEFTMARGIN='0' MARGINHEIGHT='0' MARGINWIDTH='0'></NOFRAMES>
</BODY>
</HTML>
";
}

//Finish TOC file;

$tconf.="
</TABLE>
</TABLE>
<FORM NAME=\"loadtoc\">
  <INPUT TYPE=\"HIDDEN\" NAME=\"loaded\" VALUE=\"YES\">
</FORM>
<SCRIPT>
top.indexItem=\"toc\";
top.toc_loaded=\"yes\";
top.setBG(top.t_cnt);
if(top.toc_firstLoad==\"no\")
{
top.checkReset();
}
top.toc_firstLoad=\"no\";
</SCRIPT>
</BODY>
</HTML>
";

//write out index.html;
to_file($main_dir."$ID/index.php",$jconf,"w+");

//write out toc.html;
to_file($main_dir."$ID/toc.html",$tconf,"w+");

//if all of the above was successfull, clear out all the students' course historied and have them restart;
//insertAction("UPDATE course_history SET course_status='Incomplete',lesson=0,topic=0,last_au=0,completed_aus='',custom_inf='',total_score=0 WHERE course_ID=$ID");
insertAction("DELETE FROM course_history WHERE course_ID=$ID");

echo"<SCRIPT>setTimeout('window.close();',2000)</SCRIPT>";
?>
</BODY>
</HTML>