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


if($obtable=="asset")
{
$obtable="course";
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

function orderObjects(obj,cidnameval)
{
	//alert("object_manager.php?obtable=<?php echo $obtable;?>&order="+obj+"&cidval="+cidnameval);
	document.location.href="object_manager.php?obtable=<?php echo $obtable; ?>&order="+obj+"&cidval="+cidnameval;
	top.top1.getEdit(top.top1.courseItemSelect,cidnameval,'course');
}

function orderAssets(anum){
	document.location.href="object_asset_manager.php?asset="+anum;
	top.rmain.location="assets.php?asset="+anum;
	//top.object_manager.object_tree.location="assets.php";
}
function orderAssetsCName(cn,anum){
	//alert('still on object manager');
	//document.getElementById('icname').value = anum;
	document.location.href="object_asset_manager.php?asset="+cn+"&obtable=asset&courseName="+anum;
	top.top1.getEdit(top.top1.courseItemSelect,cn,'asset');
	//top.rmain.location="assets.php?asset="+cn;
}
function pushassetfrmval(cn,anum){
	//document.getElementById('icname').value = anum;
	document.location.href="object_asset_manager.php?asset="+cn;
	top.rmain.location="assets.php?asset="+cn;
}


function searchAssets(sa){
	document.location.href="object_search_manager.php?asset="+sa;
	top.rmain.location="assets.php?asset="+sa;
}

function checkreturn(crdata){
	//var test = crdata;
	document.getElementById('cidv').value = crdata;
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


	if(currItem == null){
		//alert('phase 1');
		eval("document.all."+rID+".style.background=\"#CCCCCC\";");
		top.top1.curr<?php echo $obtable;?> =rID;
	}else if((currItem != null) && (document.getElementById('cidv').value == '')){
		//alert('phase 2');
		var subcurrItem = currItem.substring(1);
		
		//alert(currItem+' =currItem & rID='+rID+' =cidv= '+document.getElementById('cidv').value);
		//alert(top.top1.firstID+' FIRST ID');
		if((currItem != rID) && (rID != 'm'+top.top1.firstID)){
			eval("document.all."+rID+".style.background=\"#CCCCCC\";");
		}
		//else if((currItem != rID) && (rID != 'm26')){
		//}
		else{
			eval("document.all."+currItem+".style.background=\"#CCCCCC\";");
		}
		
		top.top1.curr<?php echo $obtable;?> =currItem;
		top.top1.getEdit(top.top1.courseItemSelect,subcurrItem,'course');

		top.object_manager.object_tree.location='object_tree.php?cid='+subcurrItem;
		
	}else if((currItem != null) && (document.getElementById('cidv').value != null)){
		//alert('phase 3');
		eval("document.all."+rID+".style.background=\"#CCCCCC\";");
		top.top1.curr<?php echo $obtable;?> =rID;
	}
	//document.location.href="object_manager.php";

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
	 .cltabs a{text-decoration:none;}
	 .cltabs a:hover{color:#003366;text-decoration:underline;}
	<?php include("admin_css.php");?>
	</STYLE>

</head>

<script>
	function closeObman(){
		top.document.all.manager.cols="0,*";
	}
	function openStudents()
	{
		closeObman();
		top.object_manager.object_tree.location='object_tree.php?cid=26';
		//top.rmain.location="object_manager2.php";
		//top.object_manager.object_tree.location='object_manager.php';
	}
	function toggle_manager()
	{
		top.document.all.manager.cols="400,*";
		
		//check if there are objects, if any select the first one and display its properties. otherwise leave blanck properties.
		if( firstID != "")
		{//select the first item
			getEdit(top.top1.courseItemSelect,firstID,'course');
		}
		else
		{//there is no first item to select
			top.rmain.location = 'blanks.php';
		}
	}
</script>

<body BGCOLOR="#EFF7FF" RIGHTMARGIN="0" LEFTMARGIN="0" TOPMARGIN="0">
<?php
	/*
	if($asset == ''){
		$asset = 'assettest';
	}else{
		$asset = 'may unod';
	}*/
?>


 <?php
 	//print_r($_REQUEST['cidval']);
 ?>

<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
  <TR>
    <TD bgcolor="#EFF7FF" COLSPAN="4">
	<!--<IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="394">-->
	
	</TD>
  </TR>
  <TR><TD BGCOLOR="#93BEE2">
<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="1" WIDTH="100%">
  <TR>
    <TD bgcolor="#93BEE2" COLSPAN="4"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="394"></TD>
  </TR>
  <TR>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Name</SPAN></B></TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Created</SPAN></B></TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Course Type</SPAN></B></TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">ID</SPAN></B></TD>
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


$db = new db;
$db->connect();
$db->query("SELECT name,ID,created,course_type $topic_sql_extra FROM $obtable ORDER BY $order");
$xm=0;
while($db->getRows())
{ 
	$day  = $db->row("created");
	$domain = split('/',$day);
	$var = $domain[1]."/".$domain[2]."/".$domain[0];
	$createDate = date('m/d/Y', strtotime($var));
	$ID=$db->row("ID");
	if($obtable=="course")
	{
	  $course_link = "top.object_manager.object_tree.location='object_tree.php?cid=$ID';";
	  //$course_link = "top.object_manager.object_tree.location='object_tree.php?cid=$ID&sessiontest=hahaha';";
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
	
	//$_SESSION['testing'] = 'testingliwat';
	//echo $course_link.'<br />';
	?>
	<script>
		function getsessiondata(getdata){
			var gdata = getdata;
			//window.location = 'object_manager.php?testing='+gdata;
			//window.location.reload;
			parent.object_top.pushDatatop(getdata);
		}
		function pushnamedata(pndata){
			//parent.object_top.pushnametop(pndata);	
			parent.object_top.pushnametop(pndata);
				
		}
	</script>

	 <form name="courseidval" id="courseidval" method="post">
		<input type="hidden" id="cidv" name="cidv" class="civ">
	 </form> 
	  <TR CLASS="bkg" ID="m<?php echo $ID;?>">
		<TD NOWRAP><SPAN CLASS="innerl">
			<A HREF="#" TARGET="rmain" onClick="setBKG('m<?php echo $ID;?>');<?php echo $course_link;?>top.top1.getEdit(top.top1.<?php echo $obtable;?>ItemSelect,'<?php echo $ID;?>','<?php echo $obtable.$topic_extra;?>');getsessiondata('<?php echo $ID;?>');pushnamedata('<?php echo $db->row("name");?>');checkreturn('<?php echo $db->row("name");?>');return false;"><IMG SRC="<?php echo $rimage;?>" alt="<?php echo $db->row("name");?>" BORDER="0" ALIGN="ABSMIDDLE"></A> <?php echo $db->row("name");?></TD>
		<TD><SPAN CLASS="innerl"><?php echo $createDate;?></TD>
		<TD><SPAN CLASS="innerl"><?php echo $db->row("course_type");?></TD>
		<TD><SPAN CLASS="innerl"><?php echo $db->row("ID");?></TD>
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
//top.rmain.location='frame_edit_object.php?obtable=<?php echo $obtable;?>&ID=<?php echo $ID;?>';

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
