
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
<SCRIPT language="javascript" type="text/javascript">
window.location.reload;
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
alert("Courses have been reset successfully.");

}
else {
//alert(xmlHttp.status);
}
}

function htmlData(url)
{
var x=confirm('Do you want to reset all the courses for all the students?');
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
<!--
function objReload(sp)
{
top.top1.objReload(sp);
}



function addObject()
{
/*
alert('create_'+top.top1.currobject+'.php');
window.open('create_'+top.top1.currobject+'.php?subaction=spAdd','ttt','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=600,height=800,screenX=150,screenY=150,top=150,left=150')
//window.open('create_'+top.top1.currobject+'.php?subaction=spAdd','ttt','height=500,width=500')
//alert(document.all.asset1.style.visibility);
*/
	//alert(document.all.getval.value);
	if(document.all.getval.value == ''){
		window.open('select_course_type.php?subaction=spAdd','ttt','height=250,width=300');
	}else if(document.all.getval.value == 'course'){
		window.open('select_course_type.php?subaction=spAdd','ttt','height=250,width=300');
	}else{
		window.open('select_course_type_asset.php?subaction=spAdd','ttt','height=250,width=300');
	}
}

var rTree;
function objectTree()
{

	if(rTree=="closed"||rTree==null)
	{
	parent.document.all.objectManager.rows="60,*,300";
	document.tree.src="images/obtree_off.gif";
	document.tree.alt="Show Object Listings";
	rTree="open";
	}
	else
	{
	parent.document.all.objectManager.rows="60,*,0";	
	document.tree.src="images/obtree_on.gif";
	document.tree.alt="Show Object Tree";
	rTree="closed";
	}
	return rTree;

}


function getRight(rtable)
{
//var myID = eval("top.top1."+rtable+"ID");
top.object_manager.object_main.location="object_manager.php?obtable="+rtable;
top.rmain.location="frame_edit_object.php?sid=<?php echo $_GET['sid'] ?>&selectedTab="+eval("top.top1."+rtable+"ItemSelect")+"&ID=blank&obtable="+rtable;
}

function jumpMenu(selObj,restore){ //v3.0
  eval(selObj.options[selObj.selectedIndex].value);
  if (restore) selObj.selectedIndex=0;
}
//-->
</SCRIPT>	

<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" width="100%">
  <TR>
    <TD COLSPAN="3">&nbsp;
    </TD>
  </TR>
  <TR>
  <?php

  /*
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = "200" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="93BEE2">
		<param name="backHighColor" value="93BEE2">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  { View ,_,_}  
		  {|By Name,javascript:1,_,_}
		  {|By Created,javascript:2,_,_}   
		  {|By Modified,javascript:3,_,_}  
		  {|By ID,javascript:4,_,_}  
	 	  { Add ,javascript:5,_self,images/add.gif}   
	 	  { Find ,search.php,_self,images/search.gif}  	
		">
		<param name="javascript:1" value="parent.object_main.orderObjects('name')">
		<param name="javascript:2" value="parent.object_main.orderObjects('created')">
		<param name="javascript:3" value="parent.object_main.orderObjects('modified')">
		<param name="javascript:4" value="parent.object_main.orderObjects('ID')">
		<param name="javascript:5" value="addObject();">
		<param name="javascript:6" value="objectTree();">
	  </applet>
	  */
	 
	  ?>

<td width="1%"><form name="form1">
  <select name="menu1" onChange="jumpMenu(this,0)">
    <option value="" selected="selected">order</option>
    <option value="javascript:parent.object_main.orderObjects('name');">by name</option>
    <option value="javascript:parent.object_main.orderObjects('created')">by created</option>
    <option value="javascript:parent.object_main.orderObjects('modified')">by modified</option>
    <option value="javascript:parent.object_main.orderObjects('ID')">by ID</option>
  </select></form></td>
  <td valign="top" width="1%" NOWRAP><a href="javascript:addObject();" target="_self" class="thebutton" ><img border="0" src="images/add.gif" alt="add"> Add </a></td>
  <td valign="top" width="1%" NOWRAP><a href="javascript:htmlData('reset_all_courses.php');" target="_self" class="thebutton" ><img border="0" src="images/view.gif" alt="add"> Reset All Courses </a></td>
  <td width="5%">
  </td>
   <td valign="top" width="1%" NOWRAP>
   <script>
   	function searchasset(){
		var search_val = document.getElementById("search_asset").s_asset.value;
		parent.object_main.searchAssets(search_val);
	}
	
	function pushDatatop(pdata){
		//alert(pdata);
		document.getElementById('cidmain').value = pdata;
		if(pdata != ''){
			document.all.asset1.style.visibility = 'visible';
			document.all.asset2.style.visibility = 'visible';
			document.all.asset3.style.visibility = 'visible';
        }
		//document.location.href="object_search_manager.php?asset="+pdata;
		//top.rmain.location="assets.php?asset="+sa;
	}
	
	
	</script>
	<form name="search_asset" id="search_asset" method="post" onSubmit="searchasset()">
		Search:<input type="text" name="s_asset" id="s_asset">
		<input type="submit" value="Submit"> 
	</form>
   </td>
  

 <?php
  /*
  <td><a href="search.php" target="_self" class="thebutton" ><img src="images/search.gif" border="0" alt="Find"> Find </a></td>
  */
  ?>
<!--<A HREF="#" onClick="objectTree();"><img src="images/obtree_on.gif" border="0"></A>-->

<TD ALIGN="RIGHT" NOWRAP valign="top" width="1%">&nbsp;</TD>

  <?php
  /*
  <TD ALIGN="RIGHT" NOWRAP valign="top" width="1%">
<a href="javascript:top.top1.closeObman();" class="thebutton" style="width:16px;"><img src="images/x2.gif" alt="" width="16" height="16" border="0" ></a></TD>
 */
  ?>
  </TR>
  
  
</TABLE>

 <style>
 	.cltabs a{
		border:1px solid #CCCCCC;
		padding:0px 15px 0px 15px;
	}
	.cltabs a:hover{
		background-color:#999999;
		/*color:#FFFFFF;*/
		color:#000000;
	}
	.cltabs a:active{
		background-color:#999999;
	}
	.cltabs2{
		visibility:hidden;
	}
	.cltabs2 a{
		border:1px solid #CCCCCC;
		padding:0px 15px 0px 15px;
	}
	.cltabs2 a:hover{
		background-color:#999999;
		/*color:#FFFFFF;*/
		color:#000000;
	}
	.cltabs2 a:active{
		background-color:#999999;
	}
	.tabtable{
	}
 </style>
 <?php
 	$test = 'testing';
 ?>
 <script type="text/javascript" language="javascript">
<!--
 	function pushnametop(pnt){
		//alert(document.getElementById('cidmain').value);
		document.getElementById('cidv').value = pnt;
	}
	
	
	function gotocourse(gtc,cidmainval){
		//alert(document.getElementById('cidv').value);
		document.all.getval.value="course";
		parent.object_main.orderObjects(gtc,document.getElementById('cidmain').value);
		document.all.coursemain.style.background="#FFFFFF";
		document.all.coursemain.style.border="1px solid #666666";
		document.all.asset1.style.border="1px solid #999999";
		document.all.asset2.style.border="1px solid #999999";
		document.all.asset3.style.border="1px solid #999999";
		document.all.asset1.style.background="";
		document.all.asset2.style.background="";
		document.all.asset3.style.background="";
		document.all.asset1.style.visibility = 'hidden';
		document.all.asset2.style.visibility = 'hidden';
		document.all.asset3.style.visibility = 'hidden';
	}
	function gotoassetnum1(gotoan1,cidval){
		document.all.getval.value="asset";
		var frmval = document.getElementById('cidv').value;
		//alert(frmval+' ==');
		//parent.object_main.orderAssets(gotoan1);
		parent.object_main.orderAssetsCName(gotoan1,frmval);
		document.all.asset1.style.background="#FFFFFF";
		document.all.asset1.style.border="1px solid #666666";
		document.all.coursemain.style.border="1px solid #999999";
		document.all.asset2.style.border="1px solid #999999";
		document.all.asset3.style.border="1px solid #999999";
		document.all.coursemain.style.background="";
		document.all.asset2.style.background="";
		document.all.asset3.style.background="";
	}
	function pushfrmval(gotoan1,cidval){
		document.all.getval.value="asset";
		var frmval = document.getElementById('icname').value;
		parent.object_main.pushassetfrmval(gotoan1,frmval);
	}
	
	
	function gotoassetnum2(gotoan2){
		document.all.getval.value="asset";
		var frmval = document.getElementById('cidv').value;
		//parent.object_main.orderAssets(gotoan2);
		parent.object_main.orderAssetsCName(gotoan2,frmval);
		document.all.asset2.style.background="#FFFFFF";
		document.all.asset2.style.border="1px solid #666666";
		document.all.coursemain.style.border="1px solid #999999";
		document.all.asset1.style.border="1px solid #999999";
		document.all.asset3.style.border="1px solid #999999";
		document.all.coursemain.style.background="";
		document.all.asset1.style.background="";
		document.all.asset3.style.background="";
	}
	function gotoassetnum3(gotoan3){
		document.all.getval.value="asset";
		var frmval = document.getElementById('cidv').value;
		//parent.object_main.orderAssets(gotoan3);
		parent.object_main.orderAssetsCName(gotoan3,frmval);
		document.all.asset3.style.background="#FFFFFF";
		document.all.asset3.style.border="1px solid #666666";
		document.all.coursemain.style.border="1px solid #999999";
		document.all.asset2.style.border="1px solid #999999";
		document.all.asset3.style.border="1px solid #999999";
		document.all.coursemain.style.background="";
		document.all.asset1.style.background="";
		document.all.asset2.style.background="";
	}
// -->
</script>
 <style>
 .innerl {FONT-FAMILY:VERDANA;FONT-SIZE:12;FONT-COLOR:#000000;}
 .civ {
 	border:0;
}
 </style>

 <form name="courseidval" id="courseidval" method="post">
	<input type="hidden" id="cidv" name="cidv" class="civ">
	<input type="hidden" id="cidmain" name="cidmain" class="civ">
	<input type="hidden" id="getval" name="getval" value="" class="civ">
 </form>

 <table border="0" cellpadding="0" cellpadding="0" class="tabtable">
	<tr>
		<!--javascript:top.rmain.location='itworks.php'-->
		<!--top.object_manager.object_tree.location-->
		<td class="cltabs" id="coursemain"><SPAN CLASS="innerl"><a href="#" onClick="gotocourse('name');">Courses</a></SPAN></td>
		<td class="cltabs2" id="asset1"><SPAN CLASS="innerl"><a href="#" onClick="gotoassetnum1('asset1');">Assets 1</a></SPAN></td>
		<td class="cltabs2" id="asset2"><SPAN CLASS="innerl"><a href="#" onClick="gotoassetnum2('asset2');">Assets 2</a></SPAN></td>
		<td class="cltabs2" id="asset3"><SPAN CLASS="innerl"><a href="#" onClick="gotoassetnum3('asset3');">Assets 3</a></SPAN></td>	
	</tr>
 </table> 
  


</body>
</html>
<!--<SCRIPT>-->	
