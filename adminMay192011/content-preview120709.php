<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>
	<frameset rows="20%,80%" ROWS="2" frameborder="yes" border="1" framespacing="0" >
	<FRAME NAME="les_top" SCROLLING="yes" SRC="preview-top.php" FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	<frameset cols="35%,65%" COLS="2" frameborder="yes" border="1" framespacing="0" style="border:1px solid #000099;">
	<FRAME NAME="les_main" SRC="show-listing.php?ref=<?php echo $_GET['ref'];?> " FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	<FRAME NAME="les_tree" SCROLLING="yes" SRC="blank_import.php?ref=<?php echo $_GET['ref'];?>" FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	</frameset>
</frameset>

<NOFRAMES><BODY BGCOLOR="#FFFFFF" TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>

</BODY>
</HTML>