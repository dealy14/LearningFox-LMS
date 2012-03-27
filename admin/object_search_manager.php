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
			alert('hello world');
			getEdit(top.top1.courseItemSelect,firstID,'course');
		}
		else
		{//there is no first item to select
			top.rmain.location = 'blanks.php';
			alert('testing');
		}
	}
</script>

<SCRIPT language="javascript" type="text/javascript">
<!--
var currentObj = "<?php echo $obtable;?>";
var currItem = top.top1.curr<?php echo $obtable;?>;
top.top1.currOrder="<?php echo $order;?>";
top.top1.currobject="<?php echo $obtable;?>";

function orderObjects(obj)
{
document.location.href="object_manager.php?obtable=<?php echo $obtable;?>&order="+obj;
top.top1.getEdit(top.top1.courseItemSelect,'26','course');
}

function orderAssets(anum){
document.location.href="object_asset_manager.php?asset="+anum;
top.rmain.location="assets.php?asset="+anum;
//top.object_manager.object_tree.location="assets.php";
}

function searchAssets(sa){
	document.location.href="object_search_manager.php?asset="+sa;
	top.rmain.location="assets.php?asset="+sa;
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
	 .cltabs a{text-decoration:none;}
	 .cltabs a:hover{color:#003366;text-decoration:underline;}
	<?php include("admin_css.php");?>
	</STYLE>
<script>
function searchAssets(sa){
	document.location.href="object_search_manager.php?asset="+sa;
	top.rmain.location="assets.php?asset="+sa;
}
</script>
</head>

<!-- --------->


<body BGCOLOR="#EFF7FF" RIGHTMARGIN="0" LEFTMARGIN="0" TOPMARGIN="0">


<?php
	//echo $_REQUEST['asset'].'<br />';
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
    <TD bgcolor="#93BEE2" COLSPAN="3"><SPAN CLASS="innerl"><b>SEARCH RESULTS</b></SPAN></TD>
  </TR>
  <tr>
		<td><TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl"><?php echo $assetlist; ?></SPAN></B></TD></td>
  </tr>
  <TR>
    <TD bgcolor="#93BEE2"  style="width:330px;"><B><SPAN CLASS="innerl">Name</SPAN></B></TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">Created</SPAN></B></TD>
    <TD bgcolor="#93BEE2"><B><SPAN CLASS="innerl">ID</SPAN></B></TD>
  </TR>
 </TABLE>
 </TD>
 </TR>
</TABLE>

<script>
   	function searchassetresult(){
		alert();
		//document.location.href="object_asset_manager.php?asset=asset2";
		//var search_val = document.getElementById("search_asset").s_asset.value;
		//parent.object_main.orderAssets(sar);
	}
	
</script>
   
<?php
	print_r($_REQUEST['anum']);
	
	$assetval = $_REQUEST['asset'];
	//print $assetval;
	
	$db = new db;
	$db->connect();
	//$db->query("SELECT * FROM efiles WHERE filename='$assetval' ORDER BY created");
	$db->query("SELECT * FROM efiles WHERE filename LIKE '%$assetval%' ORDER BY created");
	$xm=0;
	
	print '<table>'; 
	while($db->getRows())
	{
	
		$expl_img = explode(".",$db->row("name"));
		//$expl_img[1];
		
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
		
		$assetnumval = $db->row("assetnum");
		
		if($assetnumval == 'a1'){
			$anvlink = 'asset1';
		}else if($assetnumval == 'a2'){
			$anvlink = 'asset2';
		}else if($assetnumval == 'a3'){
			$anvlink = 'asset3';
		}
		
		//onClick="javascript:parent.object_main.orderAssets('asset1')"
		//searchassetresult()
		print '<tr>';
		print '<td style="width:420px;"><SPAN CLASS="innerl"><a href="object_asset_manager.php?asset='.$anvlink.'&assetID='.$db->row("ID").'"><img src="'.$imgext.'" border="0">'.$db->row("filename").'</a></SPAN></td>';
		print '<td style="width:380px;"><SPAN CLASS="innerl">'.$db->row("created").'</SPAN></td>';
		print '<td style="width:120px;"><SPAN CLASS="innerl">'.$db->row("ID").'</SPAN></td>';
		print '</tr>';
	
	}
	print '</table>'
	
?>
</body>
</html>
