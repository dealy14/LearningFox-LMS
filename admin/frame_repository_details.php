<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>
<?php

$ID       = $_REQUEST["ID"];

?>

<FRAMESET ROWS="0,60,*" COLS="*" FRAMEBORDER="YES" BORDER="0" FRAMESPACING=0">
	<FRAME NAME="edit_main" noresize SRC="repository.php?ID=<?php echo $ID;?>" FRAMEBORDER="NO" BORDER="0" BORDERCOLOR="0" FRAMESPACING="0">
</FRAMESET>	

<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>

</BODY>
</HTML>
