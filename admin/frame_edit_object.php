<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<?php
$obtable     = $_REQUEST['obtable'];
$selectedTab = $_REQUEST['selectedTab'];
$ID          = $_REQUEST['ID'];
//echo " ssid = ".$sid= $_GET['sid'];
//print_r($_REQUEST);
//print $obtable;

//if($selectedTab==1)
if($obtable=="course" && $selectedTab==1)
{
//echo $obtable."hello";
$loadFrame = "edit_".$obtable."_bottom.php?ID=$ID";
}


// for asset right bottom frame to load
else if($obtable=="asset" && $selectedTab==1){
	$loadFrame = "assets.php?ID=$ID";
}

else if($obtable=="topic" && $selectedTab=="2")
{
$loadFrame = "edit_topic_code.php?ID=$ID";
//$loadFrame = "test_edit.asp";
}
else if($obtable=="topic" && $selectedTab=="3")
{
$loadFrame = "edit_topic_link.php?ID=$ID";
}
else if($obtable=="lesson" && $selectedTab=="1")
{
$loadFrame = "edit_lesson_bottom.php?ID=$ID";
}
else if($obtable=="lesson" && $selectedTab=="2")
{
$loadFrame = "edit_lesson_torder.php?ID=$ID";
}
else if($obtable=="lesson" && $selectedTab=="3")
{
$loadFrame = "edit_lesson_link.php?ID=$ID";
}


else if($obtable=="course" && $selectedTab=="1")
{
$loadFrame = "edit_course_bottom.php?ID=$ID";
}
else if($obtable=="course" && $selectedTab=="2")
{
$loadFrame = "edit_course_layout.php?ID=$ID";
}
else if($obtable=="course" && $selectedTab=="3")
{
$loadFrame = "edit_course_torder.php?ID=$ID";
}
else if($obtable=="course" && $selectedTab=="4")
{
$loadFrame = "edit_course_publish.php?ID=$ID";
}
if($obtable=="topic" && $ID!="blank")
{
$topic_extra="&type=$type&loc=$loc";
}

if($ID=="blank")
{
$loadFrame="blank.php";
$topic_extra="";
}
//die("obtable = " . $obtable. " and id = " . $ID. " and topic = " . $topic. " and tab = " .$selectedTab);
?>
<FRAMESET ROWS="0,60,*" COLS="*" FRAMEBORDER="YES" BORDER="0" FRAMESPACING=0">
	<FRAME NAME="edit_post" SCROLLING="NO" SRC="blank.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	<FRAME NAME="edit_top" SCROLLING="NO" SRC="edit_<?php echo $obtable ?>_top.php?sid=<?php echo $_GET['sid'] ?>&ID=<?php echo $ID.$topic_extra ?>&selectedTab=<?php echo $selectedTab ?>" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	<FRAME NAME="edit_main" noresize SRC="<?php echo $loadFrame.$topic_extra ?>" FRAMEBORDER="NO" BORDER="0" BORDERCOLOR="0" FRAMESPACING="0">
</FRAMESET>	
<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>
</BODY>
</HTML>
