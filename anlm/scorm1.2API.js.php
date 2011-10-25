<?php
session_start();
include("../conf.php");
$db = new db;
$db->connect();
$user_sco="select * from user_sco_info where user_id=".$_SESSION['student_id']." and course_id='".$_SESSION['course_identifier']."' and user_id=".$_SESSION['student_id']." and lesson_status not like('%completed%') and  (sco_entry='ab-initio' or sco_entry='resume') order by sequence ";
$db->connect();
$db->query($user_sco);
$masterscory='y';
//$credit_flag="no-credit";
while($db->getRows()){
$lesson_status=$db->row("lesson_status");
if($db->row('masterscory')>0){
	$masterycore=$db->row('masteryscore');
	//$credit_flag="credit";
	}
	$lesson_status=$db->row("lesson_status");
	$sco_entry=$db->row("sco_entry");
	$raw_score=$db->row("score");
	$total_time=$db->row("total_time");
	$lesson_location=$db->row("lesson_location");
	$launch_data=$db->row("data_from_lms");
	$suspend_data=$db->row("suspend_data");
	$credit_flag=$db->row("cmi_credit");
	if($suspend_data==''){
			$suspend_data='none';
	}
	$total_time=$db->row("total_time");	
	break;	
}
$db->connect();
$db->query($user_sco);
while($db->getRows()){
if($db->row('masteryscore')>0){
	$masteryscore=$db->row('masteryscore');
	$maximumtimeallowed=$db->row('maximumtime');
	$timelimitaction=$db->row('timelimitaction');
	break;
	}
}
if($total_time==''){
	$total_time='0000:00:00.00';
	}
$user_info="select * from students where id=".$_SESSION['student_id'];
$db->connect();
$db->query($user_info);
while($db->getRows()){
	$_SESSION['student_name']=$db->row('lname')." ,".$db->row('fname');
	}
?>
var time_start="0000:00:00.00";
var secondsPerMinute = 60;
var minutesPerHour = 60;
function convertSecondsToHHMMSS(intSecondsToConvert) {
var hours = convertHours(intSecondsToConvert);
var minutes = getRemainingMinutes(intSecondsToConvert);
minutes = (minutes == 60) ? "00" : minutes;
var seconds = getRemainingSeconds(intSecondsToConvert);
if(String(hours).length < 2){
	hours="0"+hours;
}
if(String(minutes).length < 2){
	minutes="0"+minutes;
}
if(String(seconds).length < 2){
	seconds="0"+seconds;
}
return hours+":"+minutes +":"+seconds;
}
function convertHours(intSeconds){
var minutes = convertMinutes(intSeconds);
var hours = Math.floor(minutes/minutesPerHour);
return hours;
}
function convertMinutes(intSeconds) {
return Math.floor(intSeconds/secondsPerMinute);
}
function getRemainingSeconds(intTotalSeconds) {
return (intTotalSeconds%secondsPerMinute);
}
function getRemainingMinutes(intSeconds) {
var intTotalMinutes = convertMinutes(intSeconds);
return (intTotalMinutes%minutesPerHour);
}

function HMStoSec1(T) { // h:m:s
  var A = T.split(/\D+/) ; return (A[0]*60 + +A[1])*60 + +A[2] }
 
function clock(){
  var time = new Date()
  var hr = time.getHours()
  var min = time.getMinutes()
  var sec = time.getSeconds()
  if(hr < 10){
    hr = " " + hr
    }
  if(min < 10){
    min = "0" + min
    }
  if(sec < 10){
    sec = "0" + sec
    } 
 
  setTimeout("clock()", 1000)
  return ( hr + ":" + min + ":" + sec)
  } 
  
 function AddTime (first, second) {
 	
        var sFirst = first.split(":");
        var sSecond = second.split(":");
        var cFirst = sFirst[2].split(".");
        var cSecond = sSecond[2].split(".");
        var change = 0;
        
        FirstCents = 0;  //Cents
        if (cFirst.length > 1) {
            FirstCents = parseInt(cFirst[1],10);
        }
        SecondCents = 0;
        if (cSecond.length > 1) {
            SecondCents = parseInt(cSecond[1],10);
        }
        var cents = FirstCents + SecondCents;
        change = Math.floor(cents / 100);
        cents = cents - (change * 100);
        if (Math.floor(cents) < 10) {
            cents = "0" + cents.toString();
        }
   
        var secs = parseInt(cFirst[0],10)+parseInt(cSecond[0],10)+change;  //Seconds
        change = Math.floor(secs / 60);
        secs = secs - (change * 60);
        if (Math.floor(secs) < 10) {
            secs = "0" + secs.toString();
        }

        mins = parseInt(sFirst[1],10)+parseInt(sSecond[1],10)+change;   //Minutes
        change = Math.floor(mins / 60);
        mins = mins - (change * 60);
        if (mins < 10) {
            mins = "0" + mins.toString();
        }
		
        hours = parseInt(sFirst[0],10)+parseInt(sSecond[0],10)+change;  //Hours
        if (hours < 10) {
            hours = "0" + hours.toString();
        }
																						
        if (cents != '0') {
            return hours + ":" + mins + ":" + secs + '.' + cents;
        } else {
            return hours + ":" + mins + ":" + secs;
        }
    }
				
    function TotalTime() {
        total_time = AddTime(cmi.core.total_time, cmi.core.session_time);
        return '&'+underscore('cmi.core.total_time')+'='+escape(total_time);
    }
	
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
//alert(xmlHttp.responseText);
}
else {
//alert(xmlHttp.status);
}
}

function htmlDataApi(url,passData)
{
if (url.length==0)
{
//document.getElementById("txtResult").innerHTML="";
return;
}
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
{
alert ("Browser does not support HTTP Request");
return;
}

url=url;
//alert(passData);
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("POST",url,true) ;
xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttp.setRequestHeader("Content-length", passData.length);
xmlHttp.setRequestHeader("Connection", "close");
xmlHttp.send(passData);
} 
var API=null;
var errorCode="0";
var lesson_status;
var lesson_location="<?php echo $lesson_location;?>";
var initialize=false;
var cmi_core_children;
var student_id=<?php echo $_SESSION['student_id'];?>;
var student_name="<?php echo $_SESSION['student_name'];?>";
var credit_flag = "<?php echo $credit_flag;?>";
var lesson_status="<?php echo $lesson_status;?>";
var sco_entry="<?php echo $sco_entry;?>";
var sco_exit='';
var raw_score="<?php echo $raw_score;?>";
var cmi_total_time = "<?php echo $total_time;?>";
var start_time;
var end_time;
var launch_data = "<?php echo $launch_data;?>";
var session_time = "<?php echo $_SESSION['session_time'];?>";
var cmi_suspend_data = "<?php echo $suspend_data;?>";
var sco_id;
var data_model_name='';
var cmi_objectives_n_id;
var cmi_objectives_n_score_raw;
var interaction_id=new Array();
var interaction_type=new Array();
var interaction_response=new Array();
var interaction_result=new Array();
var interaction_student_response=new Array();
var interaction_weighting=new Array();
var interaction_std_response=new Array();
var interaction_time=new Array();
var interaction_latency=new Array();
var objectives_id=new Array();
var objectives_score_raw=new Array();
var objectives_score_max=new Array();
var objectives_score_min=new Array();
var objectives_status=new Array();
var cmi_intobjectives_id=new Array();
var cmi_comments;
var cmi_comments_from_lms='';
var max_interactions;
var no_of_objectives;
var cmi_masteryscore = "<?php echo $masteryscore;?>";
var cmi_time_allowed = "<?php echo $maximumtimeallowed;?>";
var cmi_time_limit_action = "<?php echo $timelimitaction;?>";
var pref_audio;
var pref_language;
var pref_speed;
var pref_text;
var pattern_no;
//alert("val = " + sco_id);
var i=0;
var cmi_interaction_id;
var cmi_score_max='';
var cmi_score_min='';
var lesson_mode="normal";
var prev_val;
var sub_objective;
var cmi_correct_responses;
function scormAPI(name,id){
this.name=name;
this.id=id;
this.LMSInitialize=LMSInitialize;
this.LMSGetValue=LMSGetValue;
this.LMSSetValue=LMSSetValue;
this.LMSGetLastError=LMSGetLastError;
this.LMSGetErrorString=LMSGetErrorString;
this.LMSGetDiagnostic=LMSGetDiagnostic;
this.LMSCommit=LMSCommit;
this.LMSFinish=LMSFinish;
}
function LMSInitialize(param){
	if(param==""){
					if(!initialize){
					
										initialize=true;
										sco_id="<?php echo $_SESSION['sco_id'];?>";
										errorCode="0";																			
										cmi_objectives_n_id='';
										cmi_objectives_n_score_raw='';
										sco_entry='ab-initio';
										no_of_objectives=0;
										cmi_comments='';
										sub_objective=0;
										max_interactions=0;
										session_time="0000:00:00.00";
										pattern_no=0;
										cmi_correct_responses=0;
										//alert("initialize time="+sco_id);
										//cmi_total_time="0000:00:00.00";
										return "true";
									}else{
												errorCode="101";
										   		return "false";
										  }	
							}else{
			initialize=false;
			errorCode="201";	
			 return "false";
		  }
		   												
}
function LMSGetValue(param){
if(initialize==true){
	if(param=="cmi.core._children"){
	errorCode="0";
	cmi_core_children="student_id,student_name,lesson_location,credit,lesson_status,entry,score,total_time,lesson_mode,exit,session_time";
	return cmi_core_children;
	}else if(param=="cmi.core.student_id"){
			errorCode="0";
			if(initialize==true){
				return student_id;
			}else{
						errorCode="101";
						return "";
				}
						
	}else if(param=="cmi.core.student_name"){
			errorCode="0";
			return student_name;
	}else if(param=="cmi.core.lesson_location"){
			if(LMSGetLastError()==0){
			//core sco location
			//html page
			//start the sco where the student left off.
			return lesson_location;
			}else return lesson_location;
	}else if(param=="cmi.core.credit"){
	        // whether the student id credit or no-credit.......if(credit_flag=="credit")..then do accordingly
				errorCode="0";
				return credit_flag;
	}else if(param=="cmi.core.lesson_status"){	
			return lesson_status;
	}else if(param=="cmi.core.entry"){
			if(sco_entry=="resume"){
				sco_entry='';
			}
			if(sco_exit=='suspend'){
			sco_entry='';
			}			
			return sco_entry;
	}else if(param=="cmi.core.score._children"){
				cmi_core_score="raw,min,max";
				return cmi_core_score;		
	}else if(param=="cmi.core.score.raw"){	
				errorCode="0";			
				return raw_score;
	}else if(param=="cmi.core.score.max"){
				errorCode="0";
				return cmi_score_max;
	}else if(param=="cmi.core.score.min"){
				errorCode="0";
				return cmi_score_min;
	}else if(param=="cmi.core.total_time"){
				errorCode="0";
				//cmi_total_time=AddTime(cmi_total_time,session_time);
				return cmi_total_time;
	}else if(param=="cmi.core.session_time"){
				errorCode="404";
				return "";
	}else if(param=="cmi.core.lesson_mode"){
				errorCode="0";
				if(credit_flag=='credit'){
				lesson_mode="normal";
				}
				if(credit_flag=='no-credit'){
				lesson_mode="browse";
				}
				return lesson_mode;
	}else if(param=="cmi.core.exit"){
				errorCode="404";
				return "";
	}else if(param=="cmi.suspend_data"){
					errorCode="0";
					return cmi_suspend_data;					
	}else if(param=="cmi.launch_data"){
						errorCode="0";
						return launch_data;
	}else if(param=="cmi.launch_data._children"){
							errorCode="202";
							return "";
	}else if(param=="cmi.launch_data._count"){
								errorCode="203";
								return "";
	}else if(param=="cmi.comments"){
				errorCode="0";
				return cmi_comments;
	}else if(param=="cmi.comments_from_lms"){
			errorCode="0";
			return cmi_comments_from_lms;
	}else if(param.substring(0,14)=="cmi.objectives"){
				var n,q;
				n=no_of_objectives;
				for(q=0;q<=n;q++){
				if(param=="cmi.objectives._children"){
				errorCode="0";
				return "id,score,status";
				}
				if(param=="cmi.objectives._count"){
					errorCode="0";
					return n;
				}
				if(param=="cmi.objectives."+q+".id"){
					errorCode=0;
					return objectives_id[n];
						
				}
				if(param=="cmi.objectives."+q+".score._children"){
					errorCode = "0";						
					return "raw,min,max";
				}
				if(param=="cmi.objectives."+q+".score.raw"){
					errorCode="0";
					if(objectives_score_raw.length > 0){
					return objectives_score_raw[q];
					}else{
							return "";
							}
					
				}
				if(param=="cmi.objectives."+q+".score.max"){
					errorCode="0";
					return objectives_score_max[q];					
				}
				if(param=="cmi.objectives."+q+".score.min"){
					errorCode="0";
					return objectives_score_min[q];
				}
				if(param=="cmi.objectives."+q+".status"){
					errorCode="0";
					no_of_objectives++;
					return objectives_status[q];
				}
			}
				
	}else if(param=="cmi.student_data._children"){
			errorCode="0";
			return "mastery_score,max_time_allowed,time_limit_action";
	}else if(param=="cmi.student_data.mastery_score"){
			errorCode="0";
			//alert(cmi_masteryscore);
			return cmi_masteryscore;
	}else if(param=="cmi.student_data.max_time_allowed"){
			errorCode="0";
			return cmi_time_allowed;
	}else if(param=="cmi.student_data.time_limit_action"){
			errorCode="0";
			return cmi_time_limit_action;
	}else if(param.substring(0,16)=="cmi.interactions"){
				
				var n,x;
				x = max_interactions;
				//alert(n);
				if(param=="cmi.interactions._children"){
					errorCode="0";
					return "id,objectives,time,type,correct_responses,weighting,student_response,result,latency";
				}
				if(param=="cmi.interactions._count"){
					errorCode="0";
					var z=interaction_id.length;
					return z;
				}
				
				for(n=0;n<=x;n++){
				if(param=="cmi.interactions."+n+".objectives._count"){
					
					errorCode="0";
					return sub_objective;
				}
				
				if(param=="cmi.interactions."+n+".id"){
						errorCode="404";
						return "";	
				}
				
				for(i=0;i<=sub_objective;i++){
					if(param=="cmi.interactions."+n+".objectives."+i+".id"){
							errorCode = "404";
							return "";
					}	
				}
				if(param=="cmi.interactions."+n+".time"){
						errorCode="404";
						return "";
				}
				
				if(param=="cmi.interactions."+n+".type"){
						errorCode="404";
						return "";	
				}
				if(param=="cmi.interactions."+n+".correct_responses._count"){
					errorCode="0";
					return cmi_correct_responses;
				}
				if(param=="cmi.interactions."+n+".correct_responses.0.pattern"){
						errorCode="404";
						return "";
											
				}		
				if(param=="cmi.interactions."+n+".weighting"){
						errorCode="404";
						return "";	
				}
				if(param=="cmi.interactions."+n+".student_response"){
						errorCode="404";
						return "";	
				}
				if(param=="cmi.interactions."+n+".result"){
						errorCode="404";
						return "";
				}
				if(param=="cmi.interactions."+n+".latency"){
					errorCode="404";
					return "";
					
				}
			}
					
		}else if(param=="cmi.core.none"){
				errorCode="201";
				return "";
		}else if(param=="cmi.student_preference._children"){
 			errorCode="0";
 			return "audio,language,speed,text";
 		}else if(param=="cmi.student_preference.audio"){
 			errorCode="0";
			return pref_audio; 
		}else if(param=="cmi.student_preference.language"){
 			errorCode="0";
			return pref_language;
 		}else if(param=="cmi.student_preference.speed"){
 			errorCode="0";
			return pref_speed;	
 		}else if(param=="cmi.student_preference.text"){
 			errorCode="0";
			return pref_text;
 }else{
			
			data_model_name=param;
			errorCode="401";
			return "false";
		}
 }else{
 			errorCode="301";
			return "";
		}		
	
}
function LMSSetValue(param1,param2){

if(initialize==true){
		
		if(param1=="cmi.core._children"){
		errorCode="402";
		return "false";
		}else if(param1=="cmi.core.student_id" || param1=="cmi.core.student_name"){
			errorCode="403";
			return "false";
		}else if(param1=="cmi.core.lesson_location"){
				
				if(param2.length > 255){
				errorCode="405";
				return "false";
				}else{
						lesson_location=param2;
						errorCode="0";
						return "true";
						}
	   }else if(param1=="cmi.core.credit"){
	   			errorCode="403";
				return "false";
		}else if(param1=="cmi.core.lesson_status"){
				if(isNaN(param2)){
						
							if(param2=="passed" || param2=="completed" || param2=="failed" || param2=="incomplete" || param2=="browsed" || param2=="incomplete"){
										lesson_status=param2;
										errorCode="0";
										return "true";
									}else{
											errorCode="405";
											return "false";
										 }
								}else{
										errorCode="405";
										return "false";													
																																									
									}		   	
		}else if(param1=="cmi.core.lesson_mode"){
					errorCode="403";
					return "false";
		}else if(param1=="cmi.core.entry"){
				errorCode="403";
				return "false";
		}else if(param1=="cmi.core.score._children"){
				errorCode="402";
				return "false";
		}else if(param1=="cmi.core.score.raw"){
				if(!isNaN(param2)){
							if(param2 >= 0){	
							raw_score=param2;
							errorCode="0";
							return "true";
							}else{
									errorCode="405";
									return "false";
								 }
					}else{
									errorCode="405";
									return "false";
							 }							
		
		}else if(param1=="cmi.core.score.max"){
					if(param2 >= 0){
					errorCode="0";
					cmi_score_max=param2;
					return "true";
					}else{
							errorCode="405";
							return "false";
						 }
		}else if(param1=="cmi.core.score.min"){
					if(param2 >= 0){
					errorCode="0";
					cmi_score_min=param2;
					return "true";
					}else{
							errorCode="405";
							return "false";
						 }
		}else if(param1=="cmi.core.total_time"){
				errorCode="403";
				return "false";
		}else if(param1=="cmi.core.session_time"){
				a = param2;
								var flag1,flag2;
								//var cnfrmStruc = /^\d{0,4}(:)\d{0,2}(:)\d{0,2}(.)\d{0,2}$/
								flag1=false;
								flag2=false;
								//var cnfrmStruc = /^\d{0,4}\:\d{0,2}\:\d{0,2}\.\d{0,2}$/
								
								var cnfrmStruc = /^\d{0,4}:\d{0,2}:\d{2}(.*)\d{0,2}$/
								
								if (a.search(cnfrmStruc)==-1){ //if match failed
								errorCode="405";
								flag1=true;
								return "false";
								}
								
								var cnfrmStruc1 = /\D$/
								//alert(a.search(cnfrmStruc1));
								if (a.search(cnfrmStruc1)!=-1){ //if match failed
									errorCode="405";
									flag1=true;
									return "false";
								}
								if(flag1==false && flag2==false){
								session_time=param2;
								//alert(param1+"=="+interaction_time[n]);
								errorCode="0";
								return "true";
								}
				
		}else if(param1=="cmi.core.exit"){
		
				if(param2=="logout" || param2=="time-out" || param2=="suspend" || param2==""){
				errorCode="0";
				sco_exit=param2;
				return "true";
				}else{
							errorCode="405";
							return "false";
					 } 				
		}else if(param1=="cmi.suspend_data"){
					if(param2.length <= 4096 ){ 
					cmi_suspend_data=param2;
					errorCode="0";
					return "true";
					}else{
							errorCode = "405";
							return "false";
						 }
		}else if(param1=="cmi.launch_data"){
				errorCode="403";
				return "false";
		}else if(param1=="cmi.comments"){
					if(param2.length <= 4096){
					cmi_comments=cmi_comments+param2;
					errorCode="0";
					return "true";
					}else{
							errorCode="405";
							return "false";
						  }
		}else if(param1=="cmi.comments_from_lms"){
				errorCode="403";
				return "false";
		}else if(param1.substring(0,14)=="cmi.objectives"){
				var n,z;
				n=no_of_objectives;
				var a =  param1;
				var arrDots = Array();
				var arrCnt = 0;
				var val420,n,m;
				var arrValues = Array();
				for(i=0;i < a.length;i++){
					if(a.charAt(i) == "."){
						arrDots[arrCnt]=i;
						arrCnt++;				
					}
				}

				arrCnt = 0;

				for(i=0;i < arrDots.length;i++){
					val420 = a.substring(arrDots[i]+1,arrDots[i+1]);

					if(!isNaN(val420)){
					arrValues[arrCnt]= val420;
					arrCnt++;
				}
			}
					
				n = arrValues[0];
				m = arrValues[1];
				if(n== no_of_objectives){
					n=n;
				}
				if(n==no_of_objectives+1){
					no_of_objectives++;
				}
				if(n>no_of_objectives+1){
					errorCode="201";
					return "false";
				}
				if(param1=="cmi.objectives._children"){
					errorCode="402";
					return "false";
				}
				if(param1=="cmi.objectives._count"){
					errorCode="402";
					return "false";
				}
							
				if(param1=="cmi.objectives."+n+".id"){
					if(param2.length == 0 || param2.length > 255 ){
						errorCode="405";
						return "false";
					}else{
					objectives_id[n]=param2;
					errorCode="0";
					return "true";
					}
				}
				
				if(param1=="cmi.objectives."+n+".score._children"){
					errorCode="402";
					return "false";				
				}
				if(param1=="cmi.objectives."+n+".score.raw"){
					if(param2 >= 0){
					objectives_score_raw[n]=param2;
					
					errorCode="0";
					return "true";
					}else{
																		
							errorCode="405";
							return "false";
						}
				}
				if(param1=="cmi.objectives."+n+".score.max"){
					if(param2 >= 0){
					objectives_score_max[n]=param2;
					errorCode="0";
					return "true";
					}else{
							errorCode="405";
							return "false";
							}
				}
				if(param1=="cmi.objectives."+n+".score.min"){
					if(param2 >= 0){
					objectives_score_min[n]=param2;
					errorCode="0";
					return "true";
					}else{
								errorCode="405";
								return "false";
						}
				}
				if(param1=="cmi.objectives."+n+".status"){
					if(param2=="passed" || param2=="completed" || param2=="failed" || param2=="incomplete" || param2=="browsed" || param2=="not attempted"){
					objectives_status[n]=param2;
					errorCode="0";
					return "true";
					}else{
								errorCode="405";
								return "false";
							}
				}
			
				
		}else if(param1.substring(0,16)=="cmi.interactions"){
				var n,z;
				
				var a =  param1;
				var arrDots = Array();
				var arrCnt = 0;
				var val420,n,m;
				var arrValues = Array();
				for(i=0;i < a.length;i++){
					if(a.charAt(i) == "."){
						arrDots[arrCnt]=i;
						arrCnt++;				
					}
				}

				arrCnt = 0;

				for(i=0;i < arrDots.length;i++){
					val420 = a.substring(arrDots[i]+1,arrDots[i+1]);

					if(!isNaN(val420)){
					arrValues[arrCnt]= val420;
					arrCnt++;
				}
			}
			 
				n = arrValues[0];
				m = arrValues[1];
				if(m==pattern_no){
				m=m;
				}
				if(m == pattern_no+1){
					pattern_no++;
				} 
				if(m > pattern_no+1){
					
					errorCode="201";
					return "false";
				}
				if(n == max_interactions){
					n=n;
				}
				if(n==max_interactions+1){
					max_interactions++;
				}
				if(n>max_interactions+1){
					errorCode="201";
					return "false";
				}
				//n=max_interactions;
			
				if(param1=="cmi.interactions._children"){
					errorCode="402";
					return "false";
				}
				if(param1=="cmi.interactions._count"){
					errorCode="402";
					return "false";
				}
				if(param1=="cmi.interactions."+n+".id"){
					if(param2.length!=0 && param2.length <=255){
					interaction_id[n]=param2;
					//alert(param1+"=="+interaction_id[n]);
					errorCode="0";
					return "true";
					}else{
							errorCode="405";
							return "false";
							}
				}
				if(param1=="cmi.interactions."+n+".objectives._count"){
						//alert("set="+param1+n);
						errorCode="402";
						return "false";
				}				
				if(param1=="cmi.interactions."+n+".objectives."+m+".id"){
					if(param2.length <= 255 && param2.length!=0){
					cmi_intobjectives_id[sub_objective]=param2;
					errorCode="0";
					sub_objective++;
					return "true";
					}else{
							errorCode="405";
							return "false";
							}
				}
				if(param1=="cmi.interactions."+n+".type"){
					if(param2 == "true-false" || param2 == "choice" || param2 == "fill-in" || param2 == "matching" || param2 == "performance" || param2 == "sequencing" || param2 == "likert" || param2 == "numeric" ){
					interaction_type[n]=param2;
					//alert(param1+"=="+interaction_type[n]);
					errorCode="0";
					return "true";
					}else{
							 errorCode="405";
							 return "false";
						}
				}	
				if(param1=="cmi.interactions."+n+".time"){
								a = param2;
								var flag1,flag2,flag3,flag4,flag5;
								flag1=false;
								flag2=false;
								flag3=false;
								flag4=false;
								flag5=false;
								var cnfrmStruc = /^\d{0,4}:\d{0,2}:\d{2}(.*)\d{0,2}$/
								var flagNine = true;
									
									if (a.search(cnfrmStruc)==-1){ //if match failed
									     flag1=true;
									}									
										val1 = a.indexOf(":");
										if (val1 == 4 || val1 == 2){
											//alert("val = " + a.indexOf(":",4));
											for(i=0;i < val1;i++){
												if(a.charAt(i) == "9"){
													flagNine = false;
													break;
												}
											}
											if(!flagNine)
											flag2=true;
										}
										
										if(val1 == 2){
											flagNine2 = true;
											for(i=val1;i< a.length;i++){
												if(a.charAt(i) == "9"){
													flagNine2 = false;
													break;
												}
											}
											if(!flagNine2)
												flag3=true;
										}
									
										if(val1 == 4){
											flagNine3 = true;
											for(i=val1;i< a.length;i++){
												if(a.charAt(i) == "9"){
													flagNine3 = false;
													break;
												}
											}
											if(!flagNine3)
												flag4=true;
										}
									var cnfrmStruc1 = /\D$/
									//alert(a.search(cnfrmStruc1));
									if (a.search(cnfrmStruc1)!=-1){ //if match failed
											flag5=true;
											
									}
										if(flag1==false && flag2 == false && flag3==false && flag4 == false && flag5 == false){
											interaction_time[n]=param2;
											//alert(param1+"=="+interaction_time[n]);
											errorCode="0";
											return "true";
										}else{
													errorCode="405";
													return "false";
												}
						
				}	
				if(param1=="cmi.interactions."+n+".correct_responses._count"){
						errorCode="402";
						return "false";
				}
				if(param1=="cmi.interactions."+n+".correct_responses.0.pattern"){
					
					interaction_response[n]=param2;
					//alert(param1+"=="+interaction_response[n]);
					cmi_correct_responses++;
					errorCode="0";
					return "true";
				}
				if(param1=="cmi.interactions."+n+".weighting"){
						if(!isNaN(param2)){
						interaction_weighting[n]=param2;
						//alert(param1+"=="+interaction_weighting[n]);
						errorCode="0";
						return "true";
						}else{
								errorCode="405";
								return "false";
							}
								
				}
				if(param1=="cmi.interactions."+n+".student_response"){
						interaction_std_response[n]=param2;
						//alert(param1+"=="+interaction_std_response[n]);
						errorCode="0";
						return "true";
						
				}					
				if(param1=="cmi.interactions."+n+".result"){
						if(param2 == 'correct' || param2 == 'wrong' || param2 == 'unanticipated' || (!isNaN(param2)) || param2 == 'neutral'){
						interaction_result[n]=param2;
						//alert(param1+"=="+interaction_result[n]);
						errorCode="0";
						return "true";
						}else{
								errorCode="405";
								return "false";
							 }
				}
																		
				if(param1=="cmi.interactions."+n+".latency"){
						a = param2;
								var flag1,flag2;
								//var cnfrmStruc = /^\d{0,4}(:)\d{0,2}(:)\d{0,2}(.)\d{0,2}$/
								flag1=false;
								flag2=false;
								//var cnfrmStruc = /^\d{0,4}\:\d{0,2}\:\d{0,2}\.\d{0,2}$/
								
								var cnfrmStruc = /^\d{0,4}:\d{0,2}:\d{2}(.*)\d{0,2}$/
								
								if (a.search(cnfrmStruc)==-1){ //if match failed
								errorCode="405";
								flag1=true;
								return "false";
								}
								
								var cnfrmStruc1 = /\D$/
								//alert(a.search(cnfrmStruc1));
								if (a.search(cnfrmStruc1)!=-1){ //if match failed
									errorCode="405";
									flag1=true;
									return "false";
								}
								if(flag1==false && flag2==false){
								interaction_latency[n]=param2;
								//max_interactions++;
								//alert(param1+"=="+interaction_latency[n]);
								cmi_correct_responses=0;
								sub_objective=0;
								errorCode="0";
								return "true";
								}
								
						
			}			
				
		}else if(param1=="cmi.student_data._children"){
				errorCode="402";
				return "false";					
		}else if(param1=="cmi.student_data.mastery_score"){
				errorCode="403";
				return "false";
		}else if(param1=="cmi.student_data.max_time_allowed"){
				errorCode="403";
				return "false";
		}else if(param1=="cmi.student_data.time_limit_action"){
				errorCode="403";
				return "false";
		}else if(param1=="cmi.core.none"){
				errorCode="201";
				return "false";
		}else if(param1=="cmi.student_preference._children"){
			errorCode="402";
			return "false";
	}else if(param1=="cmi.student_preference.audio"){
			if(param2.length<=0|| isNaN(param2)){
				errorCode="405";
				return "false";
			}
			if(param2 >= -1 && param2 <= 100){
			pref_audio=param2;
			errorCode="0";
			return "true";
			}else{
					errorCode="405";
					return "false";
					}
			
	}else if(param1=="cmi.student_preference.language"){
			
			if(param2.length <= 255){
			pref_language=param2;
			errorCode="0";
			return "true";
			}else{
					errorCode="405";
					return "false";
					}
			
	}else if(param1=="cmi.student_preference.speed"){
			if(param2.length <= 0 || isNaN(param2)){
			errorCode="405";
			return "false";
			}
			if(param2 >= -100 && param2 <= 100){
			pref_speed=param2;
			errorCode="0";
			return "true";
			}else{
					errorCode="405";
					return "false";
					}
	}else if(param1=="cmi.student_preference.text"){
			if(param2.length <= 0 || isNaN(param2)){
			errorCode="405";
			return "false";
			}
			if(param2==-1 || param2==0 || param2==1){
			pref_text=param2;
			errorCode="0";
			return "true";
			}else{
					errorCode="405";
					return "false";
				  }
	}else{
					data_model_name=param1;
					errorCode="401";
					return "false";
			}
	}else{
			
			errorCode="301";
			return "false";
			}
					
	}
function LMSGetLastError(){

return errorCode;

}
function LMSGetErrorString(param){
         	
		    var errorString=new Array();
			errorString["101"] = "General exception";
       	    if (param != "") {
            
			var errorString = new Array();
            errorString["0"] = "No error";
			errorString["101"] = "General Exception";
           	errorString["201"] = "Invalid argument error";
            errorString["202"] =  "Element cannot have children";
            errorString["203"] = "Element not an array - cannot have count";
            errorString["301"] = "Not initialized";
            errorString["401"] = "Not implemented error";
            errorString["402"] = "Invalid set value, element is a keyword";
            errorString["403"] = "Element is read only";
            errorString["404"] = "Element is write only";
            errorString["405"] = "Incorrect data type";
            return errorString[param];
     		
	    } else {
           return "";
        }
	
}
function LMSGetDiagnostic(param){
	if(param!=""){
					return errorCode;
				  }
				  return "";	
}
function LMSCommit(param){
	if(initialize==true){
		if(param==""){
			
			return "true";
			}else{
						errorCode=201;
						return "false";
				} 
	}else{
				errorCode="301";
				return "false";
		}				

}
function LMSFinish(param){
	if(initialize==true){
		if(param==""){
		
			//alert(cmi_suspend_data);
			errorCode="0";
			if(lesson_status=="incomplete" || sco_exit=="logout" || sco_exit=="suspend"){
					
									initialize=true;
									//alert(sco_id);
									sco_entry='resume';
									sco_exit="logout";
									
			}
			var str_scoid=top.glbSCOID;
				cmi_total_time = AddTime("<?php echo $total_time;?>",session_time);	
			var data="lesson_status="+lesson_status+"&sco_id="+str_scoid+"&sco_entry="+sco_entry+"&sco_exit="+sco_exit+"&total_time="+cmi_total_time+"&score="+raw_score+"&lesson_location="+lesson_location+"&suspend_data="+cmi_suspend_data+"&session_time="+session_time;
			//alert("chil="+LMSGetValue("cmi.objectives.0.score._children"));
			
			cmi_total_time = AddTime("<?php echo $total_time;?>",session_time);		
			//alert(lesson_status);
			htmlDataApi("insert_into_db.php",data);	
			//end_time=clock();
			//sco_entry='';
				
				if(lesson_status=="completed" || lesson_status=="failed" || lesson_status=='passed'){
				var link;
				link=top.frames['LMSFrame'].nextSCO();
				//alert("link="+link);
					if(link==undefined){
							alert("Course Has Been Completed.");
							top.close();
							
					}else{
								top.Content.location=link;
						 }
				}
			
			//alert("finishwa"+lesson_status+top.frames["LMSFrame"].sco_id);	
			initialize=false;			
			return "true";
			}else{
					errorCode="201";
					return "false";
			}
	}else{
				errorCode = "301";
				//alert("not");
				return "false";
			}
	
}
