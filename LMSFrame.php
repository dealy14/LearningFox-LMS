<?php
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

include("conf.php");

$db = new db;
$db->connect();

$qryCrseNm = "select course_id from course where id = " . $_SESSION["course_id"];
$rsCrseNm = mysql_query($qryCrseNm);
$rowCrseNm = mysql_fetch_object($rsCrseNm);
$totalCnt = mysql_result( mysql_query( "select count(*) from user_sco_info " .
							"where course_id = '" . $rowCrseNm->course_id . "' and " .
							"user_id = " . $_SESSION['student_id'] . " and " .
							"lesson_status not like('%completed%') and " .
							"(sco_entry='ab-initio' or sco_entry='resume') order by sequence"), 0);

$qryScoNm = "select * from user_sco_info where course_id = '" . $rowCrseNm->course_id . "' and user_id = " . 
 				$_SESSION['student_id'] . " and lesson_status not like('%completed%') and " .
				"(sco_entry='ab-initio' or sco_entry='resume') order by sequence";

//die($qryScoNm);

$rsScoNm = mysql_query($qryScoNm);

//if($totalCnt > 1){
echo "<script type='text/javascript'>\n";
echo "var fldrNm = \"uploadfiles/$rowCrseNm->course_id\";\n";
echo "var arrLnks = new Array($totalCnt);\n";
echo "var arrScoId = new Array($totalCnt);\n";
$itrCnt = 0;
//$datScoNm1 = mysql_fetch_object($rsScoNm);

//$_SESSION["sco_id"] = $datScoNm1->sco_id;
$cntSco420 = 1;

while($datScoNm = mysql_fetch_object($rsScoNm)){
	if($cntSco420 == 1){
		$_SESSION["sco_id"] = $datScoNm->sco_id;
		$cntSco420++;
	}
echo "arrScoId[$itrCnt]=\"$datScoNm->sco_id\";\n";
echo "arrLnks[$itrCnt] = \"uploadfiles/$rowCrseNm->course_id/$datScoNm->launch\"; \n";
$itrCnt ++;
}
//echo "top.Content.location= arrLnks[0];\n";
echo "</script>\n";
//}

//echo $qryScoNm;

?>
<html>
<head>
<meta http-equiv="expires" content="Tue, 20 Aug 1999 01:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<title>ADL Sample Run-Time Environment Version 1.2.2</title>
<script language="javascript1.2" type="text/javascript" src="scorm1.2API.js.php">

</script>
<script language="javascript1.2" type="text/javascript">
var API=null;
function init(){

API=new scormAPI("APIAdapter","100");	
//alert(API.LMSInitialize("")); 
}
function logout_onclick(){
/*var a=confirm("Whether you want to logout yourself or not?");
if(a==true){
		initialize=true;
		//alert(sco_id);
		sco_entry='resume';
		sco_exit="logout";
		alert("hello");
		API.LMSFinish("");
		return true;
	}else{
			return false;
		}
		*/

}
</script>
</head>

<body onLoad="init();" bgcolor="#FFFFFF" onUnload="logout_onclick();" >

<!--  For MS IE Use the Java 1.3 JRE Plug-in instead of the Browser's JVM
      Netscape 4.x can't use the plug-in because it's liveconnect doesn't work with the Plug-in
-->
<script language="javascript" type="text/javascript">
	var sco_id;	

function GetXmlHttpObject(handler) {
	var objXMLHttp=null;
	if (window.XMLHttpRequest) {
		objXMLHttp=new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return objXMLHttp;
}

function stateChanged() {
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
		//alert(xmlHttp.responseText);
		//top.frames["LMSFrame"].sco_id = xmlHttp.responseText;
		top.glbSCOID= xmlHttp.responseText;
		//alert("sco = " + top.glbSCOID);
	}
	else {
		//alert(xmlHttp.status);
	}
}

function htmlData(url) {
	if (url.length==0) {
		document.getElementById("txtResult").innerHTML="";
		return;
	}
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null) {
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	url=url+"&sid="+Math.random();
	//alert("Frame = " + url);
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true) ;
	xmlHttp.send(null);
}

function previousSCO(){
	var2 = String(top.Content.location);
	var1 = var2.substring(var2.indexOf("uploadfiles"))
	for(i=0;i<arrLnks.length;i++){
		if(var1 == arrLnks[i] && i != 0){
			sco_id=String(arrScoId[i-1]);				
			htmlData("data_processing.php?sco_id="+sco_id);
			top.Content.location = arrLnks[i-1];
		}
	}
}

function nextSCO(){
	var2 = String(top.Content.location);
	var1 = var2.substring(var2.indexOf("uploadfiles"))
	for(i=0;i<arrLnks.length;i++){
		if(var1 == arrLnks[i] && i != arrLnks.length-1){
			sco_id=String(arrScoId[i+1]);	
			//ajaxFunction1();
			htmlData("data_processing.php?sco_id="+sco_id);
			//alert(sco_id);
			//alert(sco_id);
			return arrLnks[i+1];
		}
	}
}

function doConfirm(){
	alert("You are going to exit from the lesson");
	API.LMSFinish("");
}

function suspendtest(){

	initialize=true;
	 sco_entry="resume";
	 sco_exit="suspend";
	 API.LMSFinish("");
	//alert(API.LMSGetValue("cmi.core.lesson_status"));	
}

top.glbSCOID="<?php echo $_SESSION["sco_id"];?>";

</script>

<form name="buttonform">
	<table width="800">
    	<tr valign="top"> 
       		<td>
	          <!--IMG ALIGN="Left" SRC="/adl/adlLogo.gif"/-->
    	   	</td>
       		<td><strong>
				<font color="black" size="3" face="Tahoma">
					<div style="margin-left:280px">
					Learning Content Packages launching window
					</div>
				</font>
			</strong></td>
    	</tr>
	</table> 
     
    <input type="hidden" name="control" value="" />            
   
<!--NOLAYER-->
	
    <table width="600" align="left" cellspacing=0>
	    <tr>
	      <td>&nbsp;</td>
	      <td align="left">&nbsp;</td>
	      <TD ALIGN="center">&nbsp;</TD>
	      <td align="left">&nbsp;</td>
	      <td>&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	    </tr>
	    <tr>
		   <td>
	        <!--
			<input type="button" value="Log In" id="login" name="login" language="javascript"
	                 onclick="return login_onclick();">&nbsp;
			-->
		   </td>
	       <td align="left">
	          <input type="button" value="Log Out" id="logout" name="logout" 
	                 language="javascript" onClick="return logout_onclick();"  style="visibility:hidden" />
		   </td>
	       <td align="center">
	          <input type="button" align="right" value="    Quit    " name="quit" language="javascript"
	                onclick="doConfirm();"  style="visibility:hidden" >
		   </td>
	       <td align="left">
	          <input type="button" align ="left" value="Suspend" id="suspend" name="suspend" 
			  		language="javascript" onclick="return suspendtest();"  style="visibility:hidden" >&nbsp;
		   </td>
	       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	       <td align="center"> 
	        	<?php if($totalCnt > 1) { ?>
		          <input type="button" align ="right" value="<- Previous" id="previous" name="previous"
				  			language="javascript" onclick="return previousSCO();" style="visibility:hidden" /> 
				<?php } ?>
		   </td>
	       <td align="center">
	         	<?php if($totalCnt > 1) { ?>
	              <input type="button" align ="right" value="    Next ->    " id="next" name="next" 
				 			language="javascript" onclick="return nextSCO();" style="visibility:hidden" />
				<?php } ?>
		   </td>
	    </tr>
	</table>   

<!--/NOLAYER-->

</form>
</body>
</html>