<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
$sel_item = $_REQUEST["sel_item"];
$ID       = $_REQUEST["ID"];
$psname   = $_REQUEST["psname"];

if(!$sel_item)
{
$sel_item=1;
}
if($sel_item==1 && $ID)
{
$pagesource="group_details.php?ID=$ID&group_name=$psname";
}
else if($sel_item==2)
{
$pagesource="subgroup_details.php?ID=$ID&group_name=$psname";
}
else if($sel_item==3)
{
$pagesource="assign_courses.php?ID=$ID&group_name=$psname";
}
else
{
$pagesource="blank.php";
}
?>
<html>
<head>
	<title>Untitled</title>
</head>

<FRAMESET ROWS="0,60,*" COLS="*" FRAMEBORDER="YES" BORDER="0" FRAMESPACING=0">
	<FRAME NAME="edit_post" SCROLLING="NO" SRC="blank.php" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	<FRAME NAME="edit_top" SCROLLING="NO" SRC="group_details_top.php?ID=<?php echo $ID;?>&group_name=<?php echo $psname;?>&sel_item=<?php echo $sel_item;?>" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
	<FRAME NAME="edit_main" noresize SRC="<?php echo $pagesource;?>" FRAMEBORDER="NO" BORDER="0" BORDERCOLOR="0" FRAMESPACING="0">
</FRAMESET>	

<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>

</BODY>
</HTML>
