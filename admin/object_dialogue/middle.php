<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT>
var imgOnArray = new Array();
var imgOffArray = new Array();
var imgTextArray = new Array();

function returnImgs()
{
var n = 0;
 while(n < imgOnArray.length)
 {
 eval("document.img"+n+".src=\""+imgOffArray[n]+"\"");
 n++;
 }
}

function swImage(tosrc,iname,setObj)
{
returnImgs();
eval("document."+iname+".src=\""+tosrc+"\"");
top.bottom.document.myform.obtype.value=setObj;
}

function writeImgs()
{
var x = 0;
 while(x < imgOnArray.length)
 {
 document.write("<A HREF=# onClick=\"swImage('"+imgOnArray[x]+"','img"+x+"','"+imgTextArray[x]+"');return false;\"><IMG src='"+imgOffArray[x]+"' NAME='img"+x+"'alt='Create "+imgTextArray[x]+" Object' border=0></A> &nbsp;");
 x++;
 }
}
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
<TR>
<TD>
<?php if($obtype=="lp")
{
?>


<?php
}
else if($obtype=="co"||$obtype=="")
{
?>
<SCRIPT>
top.descr.document.desc.src="../images/wizards/co.gif";

imgOnArray[0] = "../images/wizards/c_wbt_on.gif";
imgOffArray[0] = "../images/wizards/c_wbt_off.gif";	
imgTextArray[0] = "WBT Course";	

imgOnArray[1] = "../images/wizards/c_ilt_on.gif";
imgOffArray[1] = "../images/wizards/c_ilt_off.gif";	
imgTextArray[1] = "ILT Course";			

imgOnArray[2] = "../images/wizards/c_test_on.gif";
imgOffArray[2] = "../images/wizards/c_test_off.gif";	
imgTextArray[2] = "Test Course";		
writeImgs();	
</SCRIPT>
<?php
}
else if($obtype=="le")
{
?>
<SCRIPT>
top.descr.document.desc.src="../images/wizards/co.gif";

imgOnArray[0] = "../images/wizards/lesson_on.gif";
imgOffArray[0] = "../images/wizards/lesson_off.gif";	
imgTextArray[0] = "Lesson";	
	
writeImgs();	
</SCRIPT>
<?php
}
else if($obtype=="to")
{
?>
<SCRIPT>
top.descr.document.desc.src="../images/wizards/co.gif";

imgOnArray[0] = "../images/wizards/topic_on.gif";
imgOffArray[0] = "../images/wizards/topic_off.gif";	
imgTextArray[0] = "Topic";	
	
writeImgs();	
</SCRIPT>
<?php
}
else if($obtype=="te")
{
?>
<SCRIPT>
top.descr.document.desc.src="../images/wizards/co.gif";

imgOnArray[0] = "../images/wizards/test_on.gif";
imgOffArray[0] = "../images/wizards/test_off.gif";	
imgTextArray[0] = "Basic Test";	
	
writeImgs();	
</SCRIPT>
<?php
}
?>  
</TD>
</TR>  
</TABLE>
</body>
</html>
