<?php
require_once("../conf.php");

$order       = $_REQUEST["order"];

if($order=="")
{
$order="qname";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>

<SCRIPT>
function orderObjects(the_order)
{
	if(the_order=="name")
	{
	the_order="qname";
	}
	if(the_order=="type")
	{
	the_order="question_type";
	}
top.top1.questionOrder=the_order;
document.location.href="question_list.php?order="+the_order;
}


function setBKG(sRow)
{
//return all other rows back to their former colors;
  x=0;
  rowArray=storedRows.split(",");
    while(x<rowArray.length)
    {
    eval("document.all.m"+rowArray[x]+".style.background=\"#FFFFFF\"");
    x++;
    }

//set the new row to the highlight color;
    eval("document.all.m"+sRow+".style.background=\"#cccccc\"");
    top.top1.currQuestion=sRow;
}

function openDetails(rID,rname)
{
top.rmain.details.location="frame_question_details.php?ID="+rID+"&psname="+escape(rname);
}
top.top1.test_object="question";
</SCRIPT>

	<title>Untitled</title>
	<STYLE TYPE="text/css">
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
    <TD bgcolor="#EFF7FF" COLSPAN="4"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="295"></TD>
  </TR>
  <TR><TD BGCOLOR="#93BEE2">
<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="0" WIDTH="100%">
  <TR>
    <TD bgcolor="#93BEE2" COLSPAN="4"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="296"></TD>
  </TR>
  <TR>
    <TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">Name</TD>
    <TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">Type</TD>
    <TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">ID</TD>
  </TR>
<?php
$db = new db;
$db->connect();
$db->query("SELECT * FROM questions ORDER BY $order");
$xm=0;
while($db->getRows())
{ 
$ID=$db->row("ID");
$rimage="images/question.gif";  
?>
  <TR CLASS="bkg" ID="m<?php echo $ID;?>">
    <TD><SPAN CLASS="innerl" NOWRAP><A HREF="#" TARGET="rmain" onClick="setBKG('<?php echo $ID;?>');openDetails(<?php echo $ID;?>,'<?php echo $db->row("qname");?>');return false;"><IMG SRC="<?php echo $rimage;?>" BORDER="0" ALIGN="ABSMIDDLE"></A> <?php echo$db->row("qname");?></TD>
    <TD><SPAN CLASS="innerl" NOWRAP><?php echo $db->row("question_type");?></TD>
    <TD><SPAN CLASS="innerl" NOWRAP><?php echo $db->row("ID");?></TD>
  </TR>
<?php
$rcount[]=$ID;
$xm++;
}
?>
<SCRIPT>
var totalRows=<?php echo count($rcount);?>;
var storedRows="<?php echo @implode(",",$rcount);?>";
if(top.top1.currQuestion>=1)
{
eval("document.all.m"+top.top1.currQuestion+".style.background=\"#cccccc\"");
}
</SCRIPT>
 
</TABLE>
</TD></TR></TABLE>

</body>
</html>
