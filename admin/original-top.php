<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
/*
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = "700" Height = "25" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="true">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="right">		         		
		<param name="backColor" value="336699">
		<param name="backHighColor" value="336699">
		<param name="fontColor" value="FFFFFF">
		<param name="fontHighColor" value="ffffca">
		<param name="font" value="VERDANA,11,0">
		<param name="menuItemsFile" value="menu1.txt">
		<param name="javascript:1" value="newObject()">
		<param name="javascript:2" value="openGroups()">
		<param name="javascript:3" value="toggle_manager()">
		<param name="javascript:4" value="openStudents()">
		<param name="javascript:5" value="openGroups()">		
		<param name="javascript:6" value="openTests()">				
</applet>
*/
?>
<html>
<head>
	<title>Untitled</title>
<SCRIPT>
var helpstate;
var currtopic;
var currcourse;
var currlesson;
var currTest;
var currQuestion;
var currGroup;
var currOrder="name";
var topicItemSelect=1;
var lessonItemSelect=1;
var courseItemSelect=1;
var courseID;
var lessonID;
var topicID;
var currobject="topic";
var currStudent;
var groupOrder;
var testOrder;
var questionOrder;
var test_object="test";
var firstID="";

function objReload(obreload)
{
  if(top.object_manager.object_main.currentObj==obreload)
  {
  top.object_manager.object_main.location="object_manager.php?obtable="+obreload+"&order="+currOrder;
  }
}

function newObject()
{
var newObj = window.open('object_dialogue/w.html','test','width=599,height=372');
}

function openLessons()
{
top.document.all.listings.cols="350,*";
top.left.location="http://www.yahoo.com";
this.helpstate="open";
return helpstate;
}

function openGroups()
{
top.document.all.toolbar.rows="27,27,*";
top.top2.location="top_group.php";
}

function closeHelp()
{
top.document.all.listings.cols="0,*";
}

function toggle_manager()
{
	top.document.all.manager.cols="400,*";
	alert(firstID);
	//check if there are objects, if any select the first one and display its properties. otherwise leave blanck properties.
	if( firstID != "")
	{//select the first item
		getEdit(top.top1.courseItemSelect,firstID,'course');
	}
	else
	{//there is no first item to select
		top.rmain.location = 'blank.php';
	}
}

function closeObman()
{
top.document.all.manager.cols="0,*";
}

function getEdit(selectItem,ID,obtable)
{
top.rmain.location="frame_edit_object.php?selectedTab="+selectItem+"&ID="+ID+"&obtable="+obtable;
}

function openStudents()
{
closeObman();
top.rmain.location="frame_student_manager.php";
}

function openGroups()
{
closeObman();
top.rmain.location="frame_group_manager.php";
}

function openTests()
{
closeObman();
top.rmain.location="frame_test_manager.php";
}
function openLessons()
{
	closeObman();
top.rmain.location="frame_student_manager.php";
	//alert("hello");
}

</SCRIPT>		

<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body BGCOLOR="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0" BOTTOMMARGIN="0"><table  width="100%" height="25" border="0"cellpadding="0" cellspacing="0" ><tr><td class="banner">&nbsp;</td></tr><tr><td class="top_menu_container" align="left"><table class="mytopmenu" height="25" border="0" cellpadding="0" cellspacing="0" >
<tr>
	<td class="top_menu_item"><a href="javascript:toggle_manager();" target="_self" ><img src="images/new2.gif" alt="object library" width="28" height="23" border="0" align="absmiddle" > Course Library </a></td>
	<td class="space" ></td>
	<td class="top_menu_item"><a href="javascript:openTests();" target="_self" ><img src="images/test_new.gif" alt="object library" width="28" height="23" border="0" align="absmiddle"> Survey Objects</a></td>
	<td class="space" ></td>
	<td class="top_menu_item"><a href="javascript:openGroups();" target="_self" ><img src="images/group.gif" alt="object library" width="28" height="23" border="0" align="absmiddle"> Groups</a></td>
	<td class="space" ></td>
	<td class="top_menu_item"><a href="javascript:openStudents();" target="_self" ><img src="images/student_2.gif" alt="object library" width="28" height="23" border="0" align="absmiddle"> Student Profiles </a></td>
	<!-- code by jayant -->
	<td class="space" ></td>
	<td class="top_menu_item"><a href="javascript:openLessons();" target="_self" ><img src="images/student_2.gif" alt="object library" width="28" height="23" border="0" align="absmiddle"> Lessons </a></td>
	
	<!-- code by jayant -->
	<?php
	/*
	<td class="space" ></td>
	<td><a href="frame_edit_lms.php" target="rmain" ><img src="images/lms_tools.gif" alt="object library" width="28" height="23" border="0" align="middle"></a>	</td>
	<td><a href="frame_edit_lms.php" target="rmain" > LMS Properties</a>
	</td>
	*/
	?>
</tr>
</table></td></tr></table>
</body>
</html>
