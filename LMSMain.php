<?php
session_start();

$_SESSION["student_name"] = "";
$_SESSION["sco_id"] = "";
$_SESSION["course_id"] = "";
$_SESSION["student_id"] = $_GET["user_id"];

//$_SESSION['studentname'] = "Jayant Ahuja";
require_once("conf.php");

$db = new db;
$db->connect();
$_SESSION["course_id"] = $_GET['ref'];
$course_ID = $_GET['ref'];
$lms_userID = $_GET['user_id'];
$db->query("SELECT * FROM course_history WHERE user_ID = '$lms_userID' AND course_ID = '$course_ID'");
$xm = 0;
while($db->getRows()) { 
	  $rlesson = $db->row("lesson");
	  $rtopic = $db->row("topic");
	  $rlast_au = $db->row("last_au");
	  $rcompleted_aus = $db->row("completed_aus");
	  $rcustom_inf = $db->row("custom_inf");
	  $rcourse_status = $db->row("course_status");
	  $rtotal_time = $db->row("total_time");
	  $xm++;
	  }
  if($xm < 1) {
	//insert actions.;
    $start_time = 0;
    $start_date = date(ymd);
    $last_usage = date(ymd);
	$total_time = date("h:i:s");
	$course_ID = $_GET['ref'];
	$lms_userID = $_GET['user_id'];
	//echo "time:-".$total_time."<br>";
    insertAction("INSERT INTO course_history (last_usage,start_date,course_status,course_ID,lesson,topic,last_au,completed_aus,custom_inf,user_ID,total_time,total_score,start_time) VALUES ('$last_usage','$start_date','Incomplete','$course_ID','1','1','1','1','1_1-','$lms_userID','$total_time','0','$start_time')");
    }
	if($xm > 0) {
	  $total_time = date("h:i:s");
	  $last_usage = date(ymd);
	  $course_status = 'Incomplete';
//insertAction("UPDATE course_history SET last_usage = '$last_usage',course_status = '$course_status',total_time = '$total_time' WHERE user_ID = '$lms_userID' AND course_ID = '$course_ID'");
	}

/*--------------------------------------------server side script for preloading ----------------------------*/

$db = new db;
$db->connect();
$qryCrseNm = "select course_id from course where id = " . $_SESSION["course_id"];
$rsCrseNm = mysql_query($qryCrseNm);
$rowCrseNm = mysql_fetch_object($rsCrseNm);
$_SESSION["course_identifier"] = $rowCrseNm->course_id;


$str1="select * from item_info where course_id='".$_SESSION["course_identifier"]."'";
			$db->connect();
			$db->query($str1);
			//echo $str1;
			if($db->getRows()){
					//echo $insrt1."<br>";
					$insrt1="insert into user_sco_info set user_id=".$lms_userID.",course_id='".$_SESSION['course_identifier']."',sco_id='".$db->row("identifier")."',";
					$insrt1.="launch='".$db->row("launch")."',data_from_lms='".$db->row("data_from_lms")."',lesson_status='not attempted',prerequisite='".$db->row("prerequisites")."',";
					$insrt1.="sco_exit='',sco_entry='ab-initio',masteryscore='".$db->row("masteryscore")."',maximumtime='".$db->row("maximumtime")."',";
					$insrt1.="timelimitaction='".$db->row("timelimitaction")."',sequence=".$db->row("sequence").",type='".$db->row("type")."',";
					$insrt1.="cmi_credit='".$db->row("cmi_credit")."'";
					//$db->connect();
					insertAction($insrt1); //$db->query($insrt1); 
					//echo $insrt1;
				
			}

$db->connect();
$totalCnt = mysql_result(mysql_query( "select count(*) from user_sco_info where course_id = '" . 
				$rowCrseNm->course_id . "' and user_id=" . $_SESSION['student_id'] . " and lesson_status not like('%completed%') " .
				"and (sco_entry='ab-initio' or sco_entry='resume') order by sequence"),0);
				
$qryScoNm = "select launch from user_sco_info " .
				"where course_id = '" . $rowCrseNm->course_id . "' and user_id=" . $_SESSION['student_id'] . " and " .
				"lesson_status not like('%completed%') and (sco_entry='ab-initio' or sco_entry='resume') order by sequence";

$rsScoNm = mysql_query($qryScoNm);
//if($totalCnt > 1){
?>

<html>
<head>
	<meta http-equiv="expires" content="Tue, 20 Aug 1999 01:00:00 GMT" />
	<meta http-equiv="Pragma" content="no-cache" />
	<title>Learning Fox</title>
	
	<script type='text/javascript'>
		var fldrNm = "uploadfiles/<?php echo $rowCrseNm->course_id; ?>";
		var arrLnks = new Array(<?php echo $totalCnt; ?>);
		//var arrScoId = new Array(<?php echo $totalCnt; ?>);
		arrLnks[0]='complete.php';
	
	<?php

		$itrCnt = 0;
		
		while($datScoNm = mysql_fetch_object($rsScoNm)){
			//echo "arrScoId[$itrCnt]=\"$datScoNm->sco_id\";\n";
			echo "arrLnks[$itrCnt] = \"uploadfiles/$rowCrseNm->course_id/$datScoNm->launch\"; \n";
			$itrCnt ++;
		}
		//echo "top.Content.location= arrLnks[0];\n";
		echo "</script>\n";
		//}
		
		//echo $qryScoNm;
		
		//****************************************************************************
	
	?>

	
	<script type="text/javascript" src="scorm1.2API.js.php"></script>
	<script type="text/javascript"> 
		var API=null;
		function init(){
			 //API=new scormAPI("APIAdapter","100");	 
			// alert(API.LMSCommit(""));
			API=top.frames['LMSFrame'].API;
			//alert(API.LMSInitialize(""));
			if(arrLnks[0] != ""){
				window.top.Content.location=arrLnks[0];	 
			} else{
			 	window.top.Content.location="complete.php";
			}
		}	
		var glbSCOID;
	</script>
	
</head>

<frameset rows="0,*" onLoad="init();" border="0">
	<frame id="LMSFrame" name="LMSFrame" src="LMSFrame.php" />
 	<frameset cols="0,*" border="0">
    	<frameset rows="0,*">
        	<frame id="code" src="code.php" name="code" />
            <frame src="#" name="menu" />
        </frameset>
		<frame id="Content" name="Content" src="LMSStart.htm" />
	</frameset>
</frameset>
<noframes>Frames must be supported by your browser to use this site.</noframes>

</html>