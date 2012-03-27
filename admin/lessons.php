<?php
//require_once("../conf.php");
?>
<HTML>
<HEAD>
<TITLE>:::APPLICATION:::</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</HEAD>
<?php
/*$isAdmin="yes";
require_once($dir_components."session_check.php");*/
?>
<FRAMESET ROWS="135,0,*,40" ID="toolbar" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0" COLS="*"> 
  <FRAME NAME="top1" SCROLLING="NO" noresize SRC="top.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
  <FRAME NAME="top2" SCROLLING="NO" noresize SRC="blank.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	<FRAMESET ROWS="*" COLS="0,*" ID="manager" FRAMEBORDER="YES" BORDER="2" FRAMESPACING="2" BORDERCOLOR="#336699">
	  <FRAME NAME="object_manager" SRC="frame_lessons_manager.php" FRAMEBORDER="YES" BORDER="2" FRAMESPACING="2">   
	     <FRAMESET ROWS="*" COLS="*,20" ID="helpme" FRAMEBORDER="no" BORDER="0" FRAMESPACING=0">
	     	<FRAME NAME="rmain" SRC="splash.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
		<FRAME NAME="help" SCROLLING="NO" noresize SRC="help.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	     </FRAMESET>	
	</FRAMESET>		
  <FRAME NAME="mbottom" SCROLLING="NO" noresize SRC="bottom.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">	 	
</FRAMESET>
<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>

</BODY>
</HTML>
