<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<?php
if($selectedTab==1)
{
$loadFrame = "edit_".$obtable."_bottom.php?ID=$ID";
}
else if($obtable=="topic" && $selectedTab=="2")
{
$loadFrame = "edit_topic_code.php?ID=$ID";
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


if($obtable=="topic")
{
$topic_extra="&type=$type&loc=$loc";
}

//?selectedTab=echo$selectedTab;
?>
<FRAMESET ROWS="0,60,*" COLS="*" FRAMEBORDER="YES" BORDER="0" FRAMESPACING=0">
	<FRAME NAME="edit_post" SCROLLING="NO" SRC="blank.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	<FRAME NAME="edit_top" SCROLLING="NO" SRC="edit_lms_properties_top.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	<FRAME NAME="edit_main" noresize SRC="edit_lms_properties.php" FRAMEBORDER="NO" BORDER="0" BORDERCOLOR="0" FRAMESPACING="0">
</FRAMESET>	

<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>

</BODY>
</HTML>
