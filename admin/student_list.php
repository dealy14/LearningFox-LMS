<?php
require_once("../conf.php");

if($order=="")
{
$order="date_of_reg";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>

<SCRIPT>
<!-- Ajax for reset course operation operation -->
function GetXmlHttpObject(handler)
{
var objXMLHttp=null;
if (window.XMLHttpRequest)
{
objXMLHttp=new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
}
return objXMLHttp;
}

function stateChanged()
{
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{

var x= xmlHttp.responseText;
alert("Course has been reset successfully.");

}
else {
//alert(xmlHttp.status);
}
}

function htmlData(url)
{
var x=confirm('Do you want to reset all the courses for the selected student ?');
if(x==true){
if (url.length==0)
{
document.getElementById("txtResult").innerHTML="";
return;
}
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
{
alert ("Browser does not support HTTP Request");
return;
}

url=url
//alert("Frame = " + url);
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true) ;
xmlHttp.send(null);
}
}

<!-- ajax code ends here -->
function orderObjects(the_order)
{
top.top1.studentOrder=the_order;
document.location.href="student_list.php?order="+the_order;
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
    top.top1.currStudent=sRow;
}

function openDetails(rID)
{
//alert('open details');
top.rmain.student_details.location="frame_student_details.php?ID="+rID;
parent.document.all.smanager.cols="450,*";
}
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
    <TD bgcolor="#EFF7FF" COLSPAN="4"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="394"></TD>
  </TR>
  <TR><TD BGCOLOR="#93BEE2">
<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="0" WIDTH="100%">
  <TR>
    <TD bgcolor="#93BEE2" COLSPAN="4"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="394"></TD>
  </TR>
  <TR>
    <TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">Registration Date</TD>
    <TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">First Name</TD>
    <TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">Last Name</TD>
	<TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">Action</TD>
    <TD bgcolor="#93BEE2" NOWRAP><B><SPAN CLASS="innerl">Last Login</TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">User<br>Level</TD>
    
  </TR>
<?php

$db = new db;
$db->connect();
$db->query("SELECT * FROM students ORDER BY $order");
$xm=0;
while($db->getRows())
{ 
$ID=$db->row("ID");
$rimage="images/student_2.gif";  
?>
  <TR CLASS="bkg" ID="m<?php echo $ID;?>">
    <TD><SPAN CLASS="innerl" NOWRAP><A HREF="#" TARGET="rmain" onClick="setBKG('<?php echo $ID;?>');openDetails(<?php echo $ID;?>);return false;"><IMG SRC="<?php echo $rimage;?>" BORDER="0" ALIGN="ABSMIDDLE"></A> <?php echo $db->row("date_of_reg");?></TD>
    <TD><SPAN CLASS="innerl" NOWRAP><?php echo $db->row("fname");?></TD>
    <TD><SPAN CLASS="innerl" NOWRAP><?php echo $db->row("lname");?></TD>
	 <TD><SPAN CLASS="innerl" NOWRAP><a href="javascript:htmlData('reset_course.php?userid=<?php echo $db->row("ID");?>');">Reset</a></TD>
    <TD><SPAN CLASS="innerl" NOWRAP><?php echo $db->row("date_of_mod");?></TD>
    <TD><SPAN CLASS="innerl" NOWRAP><?php echo $db->row("userlevel");?></TD>
   
  </TR>
<?php
$rcount[]=$ID;
$xm++;
}
?>
<SCRIPT language="javascript" type="text/javascript">
<!--
var totalRows=<?php echo count($rcount);?>;
var storedRows="<?php echo @implode(",",$rcount);?>";
if(top.top1.currStudent>=1)
{
eval("document.all.m"+top.top1.currStudent+".style.background=\"#cccccc\"");
}
<?php
if(isset($rcount[0]))
{
?>
setBKG('<?php echo $rcount[0];?>');
openDetails(<?php echo  $rcount[0];?>);
<?php
}
?>
-->
</SCRIPT>
 
</TABLE>
</TD></TR></TABLE>

</body>
</html>
