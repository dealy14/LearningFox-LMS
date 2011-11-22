<HTML>
<HEAD>
<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
<TITLE>Course Layouts</TITLE>
</STYLE>
</HEAD>
<BODY BGCOLOR="#93BEE2" TOPMARGIN="0" LEFTMARGIN="0" RIGHTMARGIN="0">
<?php
$total_pics=6;
$x=1;
While($x<=$total_pics)
{
echo"<A HREF='#' onClick=\"top.window.opener.document.editForm.layout.value=$x;window.opener.document.rlayout.src='images/templates/$x.gif';return false;\"><IMG SRC='images/templates/$x.gif' BORDER='0'></A><BR>";
$x++;
}
?>
</BODY>
</HTML>