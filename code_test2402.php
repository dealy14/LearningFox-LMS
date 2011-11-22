<?php
	//require_once("../conf.php");
	//echo " Get Row = ".$_GET['ref'];
	session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
include("conf.php");

$db = new db;
$db->connect();

$qryCrseNm = "select course_id from course where id = ".$_GET['ref'];
$rsCrseNm = mysql_query($qryCrseNm);
$rowCrseNm = mysql_fetch_object($rsCrseNm);

$totalCnt = mysql_result(mysql_query("select count(*) from user_sco_info where course_id = '".$rowCrseNm->course_id."' and user_id=".$_SESSION['student_id']." and lesson_status not like('%completed%') and (sco_entry='ab-initio' or sco_entry='resume') order by sequence"),0);

$qryScoNm = "select ui.user_id,ui.course_id,ui.launch,ui.lesson_status,ui.sco_entry,ui.type,itfo.course_id,itfo.ctitle,itfo.title FROM user_sco_info ui,item_info itfo where itfo.course_id='".$rowCrseNm->course_id."' and ui.course_id = '".$rowCrseNm->course_id."' and ui.user_id=".$_SESSION['student_id']." and lesson_status not like('%completed%') and (ui.sco_entry='ab-initio' or ui.sco_entry='resume')";
//die($qryScoNm);

//$rsScoNm = mysql_query($qryScoNm);
	/*$qryins= "SELECT * FROM item_info WHERE course_id='".$rowCrseNm->course_id."'ORDER BY sequence;";
	$db = new db;
	$db->connect();
	$db->query($qryins);
	global $ctitle;
	while($db->getRows())
	{
		$ctitle =$db->row('ctitle');
		$title=$db->row('title');
	}*/
	//$rsScoNm = mysql_query($qryScoNm);
	/*echo "<script language='Javascript'>\n";
	echo "var fldrNm = \"uploadfiles/$rowCrseNm->course_id\";\n";
	echo "var arrLnks = new Array($totalCnt);\n";
	echo "arrLnks[0]=\"complete.php\";\n";
	$itrCnt = 0;*/
	//while($datScoNm = mysql_fetch_array($rsScoNm))
	$db = new db;
	$db->connect();
	$db->query($qryScoNm);
	//if($ctitle==""){echo "Course Title";}else{echo $ctitle;}
	echo " Course Title "."<br>";
	while($db->getRows())
	{
	/*echo "arrLnks[$itrCnt] = \"uploadfiles/$rowCrseNm->course_id/$datScoNm->launch\"; \n";	
	$itrCnt ++;
	}
	echo "</script>\n";
	for($i=0;$i<=$itrCnt;$i++)
	{*/
	$launch=$db->row('launch');
	$courseid =$db->row('course_id'); 
	$title =$db->row('title');
	echo "<br>";
	?>
		<!--<script>alert("begin");</script>-->
		<a href="uploadfiles/<?php echo $courseid;?>/<?php echo $launch;?>" target='Content' onClick='init()'><?php echo $title; ?></a>
		<!--<script>alert("end");</script>-->
	<?php 
		echo "<script> var arrLnks = new Array($totalCnt);
		      arrLnks[0]='uploadfiles/$courseid/$launch';</script>";
	}
	
?>

<html>
<head>
<meta http-equiv="expires" content="Tue, 20 Aug 1999 01:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<title>eLearning LMS</title>
<?php include("scorm1.2API.js.php"); ?>
<script language="javascript1.2" type="text/javascript"> 
var API=null;
function init(){
	alert("code file API working");
	 API=new scormAPI("APIAdapter","100");	 
	// alert(API.LMSCommit(""));
	API=top.frames['LMSFrame'].API;
	//alert(API.LMSInitialize(""));
	if(arrLnks[0]!=""){
	 window.top.Content.location=arrLnks[0];	 
	 }else{
	 window.top.Content.location="complete.php";
	 }
}	
var glbSCOID;
</script>
</head>
<body>
</body>
</html>
<!--$db->query($qryScoNm);
	while($db->getRows())
	{
		$type=$db->row('type');
			
		if($type == "sco")
		{
			
			$launch=$db->row('launch');
			
			//echo "<br><a href='#' onclick='LMSMain.php?window=yes&section=admin&sid=".$_GET['sid']."&ref=".$_GET['ref']."&user_id=".$_GET['user_id']."'>".$title."</a><br>";
			//href path = uploadfiles/".$cid."/".$launch.";
		//echo "<script>window.location.href='LMSMain.php?window=yes&section=admin&sid=".$_GET['sid']."&ref=".$_GET['ref']."&user_id=".$_GET['user_id']."';
		}
	}-->