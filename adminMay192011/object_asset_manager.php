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
			//alert('hello world');
			getEdit(top.top1.courseItemSelect,firstID,'course');
		}
		else
		{//there is no first item to select
			top.rmain.location = 'blanks.php';
			//alert('testing');
		}
	}
</script>

<SCRIPT language="javascript" type="text/javascript">
<!--
var currentObj = "<?php echo $obtable;?>";
var currItem = top.top1.curr<?php echo $obtable;?>;
top.top1.currOrder="<?php echo $order;?>";
top.top1.currobject="<?php echo $obtable;?>";

/*
function orderObjects(obj)
{
alert('sa object ka');
document.location.href="object_manager.php?obtable=<?php echo $obtable;?>&order="+obj;
top.top1.getEdit(top.top1.courseItemSelect,'26','course');
}
*/
/*
function orderObjects(obj,cidnameval)
{
	alert('sa object ka');
	alert(obj+'=='+cidnameval);
	//alert("object_manager.php?obtable=<?php echo $obtable;?>&order="+obj+"&cidval="+cidnameval);
	document.location.href="object_manager.php?obtable=<?php echo $obtable; ?>&order="+obj+"&cidval="+cidnameval;
	top.top1.getEdit(top.top1.courseItemSelect,cidnameval,'course');
}

function orderAssetsCName(cn,anum){
	//alert(cn+'=='+anum)
	//document.getElementById('icname').value = anum;
	document.location.href="object_asset_manager.php?asset="+cn+"&acname="+anum;
	top.top1.getEdit(top.top1.courseItemSelect,cn,'asset');
	//top.rmain.location="assets.php?asset="+cn+"&obtable=asset";
}
function pushassetfrmval(cn,anum){
	//alert(cn);
	//document.getElementById('icname').value = anum;
}

function orderAssets(anum){
	document.location.href="object_asset_manager.php?asset="+anum;
	top.rmain.location="assets.php?asset="+anum;
	//top.object_manager.object_tree.location="assets.php";
}

//alert(document.getElementById('icname').value);



function setBKG(rID)
{
//document.all.'assetr'+rID.style.color="red";

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

eval("document.all.m"+rID+".style.background=\"#CCCCCC\";");
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
*/


/*****************************************************************/
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
//alert(test);
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

	//document.write(currItem);
	//document.write(rID+ ' -rID  ');
	//alert(currItem);

	if(currItem == null){
		//alert('phase 1');
		eval("document.all."+rID+".style.background=\"#CCCCCC\";");
		top.top1.curr<?php echo $obtable;?> =rID;
	}else if((currItem != null) && (document.getElementById('cidv').value == '')){
		//alert('phase 2');
		var subcurrItem = currItem.substring(1);
		//document.write(subcurrItem);	
		eval("document.all."+currItem+".style.background=\"#CCCCCC\";");
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
/*****************************************************************/

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
	 span.assetrow{FONT-FAMILY:VERDANA;FONT-SIZE:10;FONT-COLOR:000000;}
	<?php include("admin_css.php");?>
	</STYLE>

</head>

<!-- --------->


<body BGCOLOR="#EFF7FF" RIGHTMARGIN="0" LEFTMARGIN="0" TOPMARGIN="0">


<?php

	if($_REQUEST['asset'] == 'asset1'){
		$assetlist = 'ASSET 1';
		$assetnum = 'a1';
	}else if($_REQUEST['asset'] == 'asset2'){
		$assetlist = 'ASSET 2';
		$assetnum = 'a2';
	}else if($_REQUEST['asset'] == 'asset3'){
		$assetlist = 'ASSET 3';
		$assetnum = 'a3';
	}
	
?>

<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
  <TR>
    <TD bgcolor="#EFF7FF" COLSPAN="3"><IMG SRC="images/spcr.gif" HEIGHT="1" WIDTH="394"></TD>
  </TR>
  <TR><TD BGCOLOR="#93BEE2">
<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="1" WIDTH="100%">
  <TR>
    <TD bgcolor="#93BEE2" COLSPAN="3"><B><SPAN CLASS="innerl">
	<?php 
	if($_REQUEST['acname'] == ''){
		echo $_REQUEST['courseName'];
	}else{
		echo $_REQUEST['acname'];
	}
	?></SPAN></B></TD>
  </TR>

  <TR>
    <TD bgcolor="#93BEE2"  style="width:330px;"><B><SPAN CLASS="innerl">Name</SPAN></B></TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Created</SPAN></B></TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">ID</SPAN></B></TD>
  </TR>

<script>
	function setAsset(aID){

		/*
		x=0;
		gcnt = storedRows.split(",");
		
		  if(gcnt.length>=1)
		  {
			while(x<gcnt.length)
			{
			eval("document.all.a"+gcnt[x]+".style.color=\"bluef\";");
			x++;
			}
		  }
		*/
		//alert(aID);
		eval("document.all."+aID+".style.fontWeight=\"bold\";");
		//top.rmain.location="assets.php?assetID="+aID+"&obtable=asset";
		top.top1.getEdit(top.top1.courseItemSelect,aID,'asset');
	}
</script>

<?php
	
	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM efiles WHERE assetnum='$assetnum' ORDER BY created");
	$xm=0;
	
	//print '<table>'; 
	while($db->getRows())
	{
		$expl_img = explode(".",$db->row("name"));
		$ID=$db->row("ID");
		
		if(($expl_img[1] == 'pdf') || ($expl_img[1] == 'PDF')){
			$imgext = 'icons/pdf_icon.jpg';
		}else if(($expl_img[1] == 'jpg') || ($expl_img[1] == 'JPG') || ($expl_img[1] == 'jpeg') || ($expl_img[1] == 'JPEG')){
			$imgext = 'icons/jpg_icon.jpg';
		}else if(($expl_img[1] == 'gif') || ($expl_img[1] == 'GIF')){
			$imgext = 'icons/gif_icons.jpg';
		}else if(($expl_img[1] == 'bmp') || ($expl_img[1] == 'BMP')){
			$imgext = 'icons/bmp_icon.jpg';
		}else if(($expl_img[1] == 'swf') || ($expl_img[1] == 'SWF')){
			$imgext = 'icons/swf_icon.jpg';
		}else if(($expl_img[1] == 'fla') || ($expl_img[1] == 'FLA')){
			$imgext = 'icons/fla_icon.jpg';
		}else if(($expl_img[1] == 'doc') || ($expl_img[1] == 'DOC')){
			$imgext = 'icons/doc_icon.jpg';
		}
		
?>
	<style>
		#<?='a'.$ID?>{
			font-weight:normal;
		}
	</style>
	
	<?php
		$reassetID = 'a'.$_REQUEST['assetID'];
		if($_REQUEST['assetID'] == $ID){
	?>		
		<script>
			var reassetID = '<?=$reassetID?>';
			top.rmain.location="assets.php?assetID="+reassetID;
			//document.all.reassetID.style.color="red";
			//eval("document.all."+reassetID+".style.fontWeight=\"bold\";");
		</script>
	<?php } ?>
	
	<TR CLASS="bkg" id="<?='a'.$ID?>" 
	
	<?php if($_REQUEST['assetID'] == $ID){ ?>
		style="font-weight:bold;"
	<?php }else{ ?> style="font-weight:normal;"<?php }?>
	>
		<td style="width:420px;" ><span class="assetrow"><A HREF="#" onClick="setAsset('<?='a'.$ID?>');"><img src="<?=$imgext?>" border=0></A><?=$db->row("filename")?></SPAN></td>
<?php		
		//print '<tr CLASS="bkg">';
		//print '<td style="width:420px;"><SPAN CLASS="innerl"><a href="#" onClick="setBKG()"><img src="'.$imgext.'" border=0></a>'.$db->row("filename").'</SPAN></td>';
		print '<td style="width:380px;"><span class="assetrow">'.$db->row("created").'</SPAN></td>';
		print '<td style="width:120px;"><span class="assetrow">'.$db->row("ID").'</SPAN></td>';
		print '</tr>';
		
		$lrows[]=$ID;
	}
	//print '</table>';
	
?>

<SCRIPT language="javascript" type="text/javascript" >
<!-- 
var finalCnt = <?php echo count($lrows);?>;

if(currItem != null)
{
eval("document.all."+currItem+".style.color=\"red\";");
}

  <?php
   
    if(count($lrows)>=1)
    {
    $nlrows=implode(",",$lrows);
    }
	
  ?>
var storedRows = "<?php //echo $nlrows;?>";

<?php
//these three lines are used to select the first item by default. 
//$firstID= $lrows[0];
?>
//setBKG('m<?php //echo $firstID;?>');
//top.top1.firstID = '<?php //echo $firstID;?>';
-->
</SCRIPT> 

</TABLE>
</TD></TR></TABLE>
</body>
</html>
