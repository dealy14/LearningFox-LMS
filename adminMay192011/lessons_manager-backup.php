<?php
include("../conf.php");

if($obtable=="")
{
$obtable="course";
}

if($order=="")
{
$order="name";
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>

<SCRIPT language="javascript" type="text/javascript">
<!--
var currentObj = "<?php echo $obtable;?>";
var currItem = top.top1.curr<?php echo $obtable;?>;
top.top1.currOrder="<?php echo $order;?>";
top.top1.currobject="<?php echo $obtable;?>";

function orderObjects(obj)
{
document.location.href="object_manager.php?obtable=<?php echo $obtable;?>&order="+obj;
}


function setBKG(rID)
{
x=0;
gcnt = storedRows.split(",");

  if(gcnt.length>=1)
  {
    while(x<gcnt.length)
    {
    eval("document.all.m"+gcnt[x]+".style.background=\"#FFFFFF\";");
    x++;
    }
  }

eval("document.all."+rID+".style.background=\"#CCCCCC\";");
top.top1.curr<?php echo $obtable;?> =rID;

}

function swLoad()
{  
  if(top.top1.curr<?php echo $obtable;?>!=null)
  {
    var rcurr<?php echo $obtable;?>=top.top1.curr<?php echo $obtable;?>.substr(1);
    if(Number(rcurr<?php echo $obtable;?>)>=1)
    {
    top.top1.getEdit(top.top1.<?php echo $obtable;?>ItemSelect,rcurr<?php echo $obtable;?>,'<?php echo $obtable.$topic_extra;?>');
    }
  }
}

-->
</SCRIPT>

	<title>Untitled</title>
	<STYLE TYPE="text/css" >
	 #m1 {BACKGROUND-COLOR:#FFFFFF;}
	 .innerl {FONT-FAMILY:VERDANA;FONT-SIZE:10;FONT-COLOR:000000;}
	 .bkg {BACKGROUND-COLOR:#FFFFFF;}
	 .bkg2 {BACKGROUND-COLOR:#FFFFCC;}
	<?php include("admin_css.php");?>
	</STYLE>

</head>

<body BGCOLOR="#EFF7FF" RIGHTMARGIN="0" LEFTMARGIN="0" TOPMARGIN="0">

<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
  <TR>
    <TD bgcolor="#EFF7FF" COLSPAN="4"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="394"></TD>
  </TR>
  <TR><TD BGCOLOR="#93BEE2">
<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="1" WIDTH="100%">
  <TR>
    <TD bgcolor="#93BEE2" COLSPAN="4"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="394"></TD>
  </TR>
  <TR>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Course ID</TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Course Name</TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">File Name</TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Creation Date</TD>
  </TR>
<?php
if($obtable=="topic")
{
	$topic_sql_extra=",topic_type,content_location";
}
elseif($obtable=="course")
{
	$topic_sql_extra=",status";
}
elseif($objtable=="lessons"){
	$topic_sql_extra ="";
}

$db = new db;
$db->connect();
$db->query("SELECT course_id,folder_name,file_name, date_of_creation  FROM crab_lessons ");
$xm=0;
while($db->getRows())
{ 
	$ID=$db->row("ID");
	if($obtable=="course")
	{
	  $course_link = "top.object_manager.object_tree.location='object_tree.php?cid=$ID';";
	  if($db->row("status")=="not active")
	  {
	  	$rimage="images/course_list_inactive.gif";
	  }
	  else
	  {
	  	$rimage="images/course_list_off.gif";  
	  }
	}
	else
	{
		$rimage="images/".$obtable."_list_off.gif";  
	}
	
	if($obtable=="topic")
	{
		$topic_extra="&type=".$db->row("topic_type")."&loc=".$db->row("content_location");
	}
	?>
	
	  <TR CLASS="bkg" ID="m<?php echo $ID;?>">
		<TD NOWRAP><SPAN CLASS="innerl"><A HREF="#" TARGET="les_tree" onClick="setBKG('m<?php echo $ID;?>');<?php echo $course_link;?>top.top1.getEdit(top.top1.<?php echo $obtable;?>ItemSelect,'<?php echo $ID;?>','<?php echo $obtable.$topic_extra;?>');return false;"><IMG SRC="<?php echo $rimage;?>" BORDER="0" ALIGN="ABSMIDDLE"></A> <?php echo $db->row("course_id");?></TD>
		<TD><SPAN CLASS="innerl"><?php echo $db->row("folder_name");?></TD>
		<TD><SPAN CLASS="innerl"><?php echo $db->row("file_name");?></TD>
		<TD><SPAN CLASS="innerl"><?php echo $db->row("date_of_creation");?></TD>
	  </TR>
	<?php
	$lrows[]=$ID;
} 
?>
<SCRIPT language="javascript" type="text/javascript" >
<!-- 
var finalCnt = <?php echo count($lrows);?>;

if(currItem != null)
{
eval("document.all."+currItem+".style.background=\"#CCCCCC\";");
}

  <?php
    if(count($lrows)>=1)
    {
    $nlrows=implode(",",$lrows);
    }
  ?>
var storedRows = "<?php echo $nlrows;?>";
//top.rmain.location='frame_edit_object.php?obtable=<?echo$obtable;?>&ID=<?echo$ID;?>';

<?php
//these three lines are used to select the first item by default. 
$firstID= $lrows[0];
?>
setBKG('m<?php echo $firstID;?>');
top.top1.firstID = '<?php echo $firstID;?>';
-->
</SCRIPT> 
</TABLE>
</TD></TR></TABLE>

</body>
</html>
