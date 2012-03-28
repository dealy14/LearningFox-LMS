<?php
session_start();

// code to send the outlook calendar entry

if(isset($_GET["action"]) && $_GET["action"] == "eventRegistration"){


//$dtStart = '20090808T131415Z';//yyyymmddThhmmssZ
$dtStart = $_POST["start_date"]."T131415Z"; //"T".$_POST["start_time"]."Z";
//$dtEnd = '20090808T151617Z';
$dtEnd = $_POST["end_date"]."T151617Z"; //"T".$_POST["end_time"]."Z";
//--------------------
//create text file
$ourFileName = "icsFile/calendar.txt";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file1");
fclose($ourFileHandle);
//
//edit temp file
$myFile = "icsFile/calendar.txt";
$fh = fopen($myFile, 'w') or die("can't open file2");

$stringData = "
BEGIN:VCALENDAR
PRODID:-//Microsoft Corporation//Outlook 11.0 MIMEDIR//EN
VERSION:2.0
METHOD:REQUEST
BEGIN:VEVENT
ORGANIZER:MAILTO:organizer@domain.com
DTSTAMP:".date('Ymd').'T'.date('His')."
DTSTART:$dtStart
DTEND:$dtEnd
TRANSP:OPAQUE
SEQUENCE:0
UID:".date('Ymd').'T'.date('His')."-".rand()."-projectcrownweb.org
SUMMARY:Registration details 
DESCRIPTION: These are the registration details.
PRIORITY:5
X-MICROSOFT-CDO-IMPORTANCE:1
CLASS:PUBLIC
END:VEVENT
END:VCALENDAR";

fwrite($fh, $stringData);
fclose($fh);
//$_POST["location"]

//email temp file
$fileatt = "icsFile/calendar.txt"; // Path to the file
$fileatt_type = "application/octet-stream"; // File Type
$fileatt_name = "meeting.ics"; // Filename that will be used for the file as the attachment

$email_from = "CRAFT@nw7.esrd.net"; // Who the email is from
$email_subject = "Registration Details"; // The Subject of the email
$email_message = "Class at this - ". $_POST["location"]; // Message that the email has in it

$email_to = $_POST["email"]; // Who the email is too

$headers = "From: ".$email_from;

$file = fopen($fileatt,'rb');
$data = fread($file,filesize($fileatt));
fclose($file);

$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

$headers .= "MIME-Version: 1.0" .
"Content-Type: multipart/mixed;" .
" boundary=\"{$mime_boundary}\"";

$email_message .= "This is a multi-part message in MIME format." .
"--{$mime_boundary}" .
"Content-Type:text/html; charset=\"iso-8859-1\"" .
"Content-Transfer-Encoding: 7bit" .
$email_message . "";

$data = chunk_split(base64_encode($data));

$email_message .= "--{$mime_boundary}" .
"Content-Type: {$fileatt_type};" .
" name=\"{$fileatt_name}\"" .
//"Content-Disposition: attachment;" .
//" filename=\"{$fileatt_name}\"" .
"Content-Transfer-Encoding: base64" .
$data . "" .
"--{$mime_boundary}--";

$ok = @mail($email_to, $email_subject, $email_message, $headers);

if($ok) {
	echo "<script> alert('Mail send.'); parent.parent.GB_hide();</script>";
} else {
die("Sorry but the email could not be sent. Please go back and try again!");
}


}

// code to send the outlook calendar entry
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Learningfox User Registration</title>
<script language="JavaScript1.2">
var xmlhttp = false;
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}
		else if (window.ActiveXObject) {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		function preSearch(file,mode,qry,type) {
			var theQuery = qry;
			//alert(theQuery);
			if(theQuery !== "") {
					document.getElementById('result').innerHTML = "Searching...";
				var url = file + '?mode=' +mode + '&qry=' + theQuery+'&type='+type;
				xmlhttp.open('GET',   url, true);
				xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById('result').innerHTML = xmlhttp.responseText;
					}
				};
				xmlhttp.send(null);  
			}
		}
		
function chckusr(theFrm,type)
{
	//alert(type);
	respo = true;
	//alert("value = " + document.regFrm.username.value);
	if(document.regFrm.username.value == "" )
	{
		//alert("Can't leave this field blank.  Kindly specify your desired user name.");
		//document.regFrm.username.focus();
		//respo = false;
	}
	else
		respo = true;
		
	if(respo)
		preSearch('check.php','usremail',document.regFrm.username.value,type);	
}		
</script>
<script language="javascript" type="text/javascript">
 
		
function validFrm(frm1)
{
	//document.write(frm1.txt_pass.value);	
	if(frm1.fname.value==""){
		alert('Specify your first name.');
		frm1.fname.focus();
		return false;
	}
	if(frm1.lname.value==""){
		alert('Specify last name.');
		frm1.lname.focus();
		return false;
	}
	
/*	if(frm1.buisness_type.value=="none"){
		alert('Select a buisness type.');
		frm1.buisness_type.focus();
		return false;
	}
*/	
	if(frm1.email.value==""){
		alert('Specify your emailID.');
		frm1.email.focus();
		return false;
	}else{
			var val=emailCheck(frm1.email.value,frm1.buisness_type.value);		
			if(val==true){
				//return true;
			}else{
					frm1.email.focus();
					return false;
			}
	}
	if(frm1.cemail.value==""){
		alert('Confirm your emailID.');
		frm1.cemail.focus();
		return false;
	}else{
	
		if(frm1.email.value==frm1.cemail.value){
			
			//return true;
			
		}else{
			alert('Your confirmation email ID does not match with email id');
			frm1.cemail.value="";
			frm1.cemail.focus();
			return false;
		}
	}
	
/*		if(frm1.ph1.value==""){
		alert('Specify your country code.');
		frm1.ph1.focus();
		return false;
		}
		
		if(isNaN(frm1.ph1.value)){
		
		alert('Enter numeric values country code part of your phone field');
		frm1.ph1.focus();
		return false;
		}
			
		if(frm1.ph2.value==""){
		alert('Specify your phone number in numeric values.');
		frm1.ph2.focus();
		return false;
		}
		if(isNaN(frm1.ph2.value)){
		alert('Specify your phone number in numeric values.');
		frm1.ph2.focus();
		return false;
		}
		if(frm1.ph3.value==""){
		alert('Specify your phone number.');
		frm1.ph3.focus();
		return false;
		}		
		if(isNaN(frm1.ph3.value)){
		alert('Specify your phone number in numeric values.');
		frm1.ph3.focus();
		return false;
		}
	
*/	if(frm1.username.value==""){
		alert('Specify your user name.');
		frm1.username.focus();
		return false;
	}
	if(frm1.password.value==""){
		alert('Specify your password.');
		frm1.password.focus();
		return false;
	}
	if(frm1.cpassword.value==""){
		alert('Specify your confirm password.');
		frm1.cpassword.focus();
		return false;
	}	
	if(frm1.password.value!=frm1.cpassword.value){
		alert('Your confirm password field does not match.');
		frm1.cpassword.focus();
		return false;
	}
	if(frm1.security_question.value=="none")
	{
		alert('Select your password security question.');
		frm1.security_question.focus();
		return false;
	}		
	if(frm1.security_answer.value==""){
		alert('Give your answer for the security question.');
		frm1.security_answer.focus();
		return false;
	}
	
return true;	
}
		
		
</script>
<SCRIPT LANGUAGE="JavaScript">



/*1.0: Original  */
// -->

<!-- Begin
function emailCheck (emailStr,btype) {

/* The following variable tells the rest of the function whether or not
to verify that the address ends in a two-letter country or well-known
TLD.  1 means check it, 0 means don't. */

var checkTLD=1;

/* The following is the list of known TLDs that an e-mail address must end with. */

var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;

/* The following pattern is used to check if the entered e-mail address
fits the user@domain format.  It also is used to separate the username
from the domain. */

var emailPat=/^(.+)@(.+)$/;

/* The following string represents the pattern for matching all special
characters.  We don't want to allow special characters in the address. 
These characters include ( ) < > @ , ; : \ " . [ ] */

var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";

/* The following string represents the range of characters allowed in a 
username or domainname.  It really states which chars aren't allowed.*/

var validChars="\[^\\s" + specialChars + "\]";

/* The following pattern applies if the "user" is a quoted string (in
which case, there are no rules about which characters are allowed
and which aren't; anything goes).  E.g. "jiminy cricket"@disney.com
is a legal e-mail address. */

var quotedUser="(\"[^\"]*\")";

/* The following pattern applies for domains that are IP addresses,
rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal
e-mail address. NOTE: The square brackets are required. */

var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;

/* The following string represents an atom (basically a series of non-special characters.) */

var atom=validChars + '+';

/* The following string represents one word in the typical username.
For example, in john.doe@somewhere.com, john and doe are words.
Basically, a word is either an atom or quoted string. */

var word="(" + atom + "|" + quotedUser + ")";

// The following pattern describes the structure of the user

var userPat=new RegExp("^" + word + "(\\." + word + ")*$");

/* The following pattern describes the structure of a normal symbolic
domain, as opposed to ipDomainPat, shown above. */

var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");

/* Finally, let's start trying to figure out if the supplied address is valid. */

/* Begin with the coarse pattern to simply break up user@domain into
different pieces that are easy to analyze. */

var matchArray=emailStr.match(emailPat);

if (matchArray==null) {

/* Too many/few @'s or something; basically, this address doesn't
even fit the general mould of a valid e-mail address. */

alert("Email address seems incorrect (check @ and .'s)");
return false;
}
var user=matchArray[1];
var domain=matchArray[2];

// Start by checking that only basic ASCII characters are in the strings (0-127).

for (i=0; i<user.length; i++) {
if (user.charCodeAt(i)>127) {
alert("Ths username contains invalid characters.");
return false;
   }
}
for (i=0; i<domain.length; i++) {
if (domain.charCodeAt(i)>127) {
alert("Ths domain name contains invalid characters.");
return false;
   }
}

// See if "user" is valid 

if (user.match(userPat)==null) {

// user is not valid

alert("The username doesn't seem to be valid.");
return false;
}

/* if the e-mail address is at an IP address (as opposed to a symbolic
host name) make sure the IP address is valid. */

var IPArray=domain.match(ipDomainPat);
if (IPArray!=null) {

// this is an IP address

for (var i=1;i<=4;i++) {
if (IPArray[i]>255) {
alert("Destination IP address is invalid!");
return false;
   }
}
return true;
}
		//alert(domain);
			
   			
			if(btype=='Network' || btype=='CMS Contractor'){
				if(btype=='CMS Contractor' && (domain=='csc.com' || domain=='esource.net' || domain=='umich.edu' || domain=='arborresearch.org')){
					return true;
				}
				for(var i=1;i<=18;i++){
					if(domain=='nw'+i+'.esrd.net'){
						return true;
					}
				}
				alert("Invalid email id format.");
				return false;
			}
			
			if(btype=='Corporate Dialysis Facility' && (domain!='fmc-na.com' || domain!='davita.com' || domain!='dciinc.org')){
			
				alert("Invalid email id format.");
				return false;
			}
			if((btype=='CMS Users') && domain!='cms.hhs.gov'){
					alert("Invalid email id format.");
					return false;
			}
			if(btype=='CMS Contractor' && (domain!='csc.com' && domain!='esource.net' && domain!='umich.edu' && domain!='arborresearch.org')){
				alert("Invalid email id format.");
				return false;
			}
			
			//return true;
// Domain is symbolic name.  Check if it's valid.
 
var atomPat=new RegExp("^" + atom + "$");
var domArr=domain.split(".");
var len=domArr.length;
for (i=0;i<len;i++) {
if (domArr[i].search(atomPat)==-1) {
//alert(domArr[i]);
alert("The domain name does not seem to be valid.");
return false;
}else{
   			
   }
}

/* domain name seems valid, but now make sure that it ends in a
known top-level domain (like com, edu, gov) or a two-letter word,
representing country (uk, nl), and that there's a hostname preceding 
the domain or country. */

if (checkTLD && domArr[domArr.length-1].length!=2 && 
domArr[domArr.length-1].search(knownDomsPat)==-1) {
alert("The address must end in a well-known domain or two letter " + "country.");
return false;
}

// Make sure there's a host name preceding the domain.

if (len<2) {
alert("This address is missing a hostname!");
return false;
}

// If we've gotten this far, everything's valid!
return true;
}

//  End -->
</script>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php

function gen_trivial_password($len = 6)
{
    $r = '';
    for($i=0; $i<$len; $i++)
        $r .= chr(rand(0, 25) + ord('a'));
    return $r;
}
function genConfirmationNumber($len = 14)
{
    $r = '';
    for($i=0; $i<$len; $i++)
        $r .= chr(rand(0, 25) + ord('a'));
    return $r;
}

//..................waiting list check ..................
if($_GET['avail'] == 0 && $_GET['action']!='wait' && $_POST['action']!='register_need' && $_GET['newuser']!='yes'){
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" style="border:1px solid #C7CAB9" bgcolor="">
<tr height="30px"><td align="center" style="color:#FFFFFF; background-color:#1D2D3A;"><strong>*WAITING LIST* *WAITING LIST* *WAITING LIST*</strong></td></tr>
<tr>
  <td align="justify">&nbsp;</td>
</tr>
<tr><td align="justify">Thank you for interest in registering for the CROWNWeb/QIPS Instructor-Led classes. Unfortunately, this class is full. The waiting list will allow you to be placed in a queue. In the event cancelations occur, you will receive another email informing you of seat availability. If you wish to be placed on the waiting list for this class, <a href="register.php?action=wait&id=<?php echo $_GET['id'];?>&avail=<?php echo $_GET['avail'];?>">click here</a>.  If not, click “Close”.</td></tr>
<tr>
  <td align="justify">&nbsp;</td>
</tr>
<tr>
  <td align="justify">&nbsp;</td>
</tr>
</table>
<?php

}else{
	if($_POST['Submit']=='Submit'){
		$db=new db();
		$db->connect();
	
		$data = array();
		if (isset($_POST['fname']))
			$data['fname'] = "'" . $db->escape_string(trim($_POST['fname'])) . "'";
		if (isset($_POST['lname']))
			$data['lname'] = "'" . $db->escape_string(trim($_POST['lname'])) . "'";
		if (isset($_POST['email']))
			$data['lname'] = "'" . $db->escape_string(trim($_POST['email'])) . "'";
			
	$ph1=htmlentities(addslashes($_POST["ph1"]),ENT_QUOTES);
	$ph2=htmlentities(addslashes($_POST["ph2"]),ENT_QUOTES);
	$ph3=htmlentities(addslashes($_POST["ph3"]),ENT_QUOTES);
	$phone=$ph1."-".$ph2."-".$ph3;	
	$username=htmlentities(addslashes($_POST["username"]),ENT_QUOTES);
	$password=htmlentities(addslashes($_POST["password"]),ENT_QUOTES);
	$buisness_type=htmlentities(addslashes($_POST["buisness_type"]),ENT_QUOTES);
	$security_question=htmlentities(addslashes($_POST["security_question"]),ENT_QUOTES);
	$security_answer=htmlentities(addslashes($_POST["security_answer"]),ENT_QUOTES);
	$provider_number=htmlentities(addslashes($_POST["provider_number"]),ENT_QUOTES);
	$organization_name=htmlentities(addslashes($_POST["organization_name"]),ENT_QUOTES);

	require_once("conf.php");
	// abs_event  added by ZT-MS 031109 checking
	$rsDEvent = mysql_query("select * from abs_events where id = ".$_GET["id"]);
	$rowDEvent = mysql_fetch_assoc($rsDEvent); 
	$date3 = strftime("%m/%d/%Y", strtotime($rowDEvent["date_added"]));
	$seatno=(int)$rowDEvent["maximum"]-(int)$rowDEvent["seats"];
	$seatno=(int)$seatno+1;
	?>
	<input type="hidden" name="abbLoc" id="abbLoc" value="<?php echo $rowDEvent["abrevationLoc"];?>" />
	<input type="hidden" name="seatdate" id="seatdate" value="<?php echo $date3;?>" />
	<input type="hidden" name="seatno" id="seatno" value="<?php echo $seatno;?>" />
	<input type="hidden" name="classid" id="classid" value="<?php echo $_GET['id'];?>" />
	<input type="hidden" name="avail" id="avail" value="<?php echo $_GET['avail'];?>" />
	<input type="hidden" name="newuser" id="newuser" value="<?php echo $_GET['newuser'];?>" />

<?php
	// end ZT - MS
	if($_POST['avail']<=0 && $_POST['classid']!='' && $_POST['classid']!=0){
	
	 // echo "if 1 <br/>";
		//$selSeat="select max(waiting) 'waitNo' from class_students"; 
		$selMaxWait="select max(waiting) 'wait' from class_students where class_id=".$_POST['classid'];
		$rowWait=mysql_fetch_assoc(mysql_query($selMaxWait));
		$wait=51+(int)$rowWait['wait'];
		
		$confirmation=$_POST['abbLoc']."-".$_POST['seatdate']."-".$wait;
	//	$confirmation=genConfirmationNumber();
	
	}else{
	    //  echo "else 1 <br/>"; 
		$confirmation=$_POST['abbLoc']."-".$_POST['seatdate']."-".$_POST['seatno'];
	}	
	$myconf="demo_site";
	
//	echo $confirmation;
	require_once("conf.php");
	
	$db=new db();
	$db->connect();
	$chuser="select * from students where username='".$username."'";
	$rs=mysql_query($chuser);
	$cnt=mysql_num_rows($rs);
	//$password=gen_trivial_password();
	//echo $cnt."<br/>";
	if($cnt>=1){
	  // echo $cnt;
		echo "<font style='font-size:14px;color:#D90650; font-family:Verdana, Arial, Helvetica, sans-serif;'>Username already exists in the database.Kindly choose another one.</font>";
		echo "<a href='javascript:window.history.back();'>go back</a>";
	}else if($_GET['newuser'] == "yes"){
	 // echo "else if <br/>"; 
	$insrt="insert into students set fname='".$fname."',lname='".$lname."',email='".$email."',phone='".$phone."',username='".trim($username)."',password='".trim($password)."',buisness_type='".$buisness_type."',security_question='".$security_question."',security_answer='".$security_answer."',provider_number='".$provider_number."',userlevel=2,confirmation_number='',organization_name='".$organization_name."',reg_date=CURRENT_DATE()";
	}
	else{
	//echo "else 2 <br/>"; 
	$insrt="insert into students set fname='".$fname."',lname='".$lname."',email='".$email."',phone='".$phone."',username='".trim($username)."',password='".trim($password)."',buisness_type='".$buisness_type."',security_question='".$security_question."',security_answer='".$security_answer."',provider_number='".$provider_number."',userlevel=2,confirmation_number='".$confirmation."',organization_name='".$organization_name."',reg_date=CURRENT_DATE()";
	
/*		echo$insrt="insert into students (fname,lname,email,phone,username,password,buisness_type,security_question,security_answer,provider_number,userlevel,date_of_reg) values ('$fname','$lname','$email','$phone','trim($username)','trim($password)','$buisness_type','$security_question','$security_answer','$provider_number','2','date(m/d/Y)')";
*/			mysql_query($insrt) or die(mysql_error());
			$uid=mysql_insert_id();
			// insert students against a class name
			if($_POST['classid']!='' && $_POST['classid']!=0){
				$insrtClass="insert into class_students set user_id=".$uid.",class_id=".$_POST['classid'];
				mysql_query($insrtClass);
			}
			//md5 salt code...
/*			$pass=md5($uid.trim($password));
			$update="update students set password='".trim($pass)."' where ID=".$uid;
			mysql_query($update);	
*/		//	echo $update;
			// Seats reduction based on registration................
			if($_POST['classid']!='' && $_POST['classid']!=0 && $_POST['avail']!=0 && $_POST['avail']!=''){
							
				$selUp="update abs_events set seats=seats-1 where id=".$_POST['classid'];
				mysql_query($selUp);	
				$selTitle="select * from abs_events where id=".$_POST['classid'];
				$row=mysql_fetch_assoc(mysql_query($selTitle));
			
			}
		//	echo 'avail='.$_POST["avail"].' cid='.$_POST["classid"]."<br>";
			if($_POST['avail'] <= 0 && $_POST['classid']!='' && $_POST['classid']!=0){
				$selMax="select max(waiting) 'maxi' from class_students";
				$rowMax=mysql_fetch_assoc(mysql_query($selMax));
				$updateC="update class_students set waiting=".((int)$rowMax['maxi']+1)." where user_id=".$uid." and class_id=".$_POST['classid'];
				
				mysql_query($updateC);
				$selTitle="select * from abs_events where id=".$_POST['classid'];
				$row=mysql_fetch_assoc(mysql_query($selTitle));
				$subject = 'CROWNWeb/QIPS  Wait List Confirmation';
				$messageWait='<b>CROWNWeb Registration info</b>\n
				Dear '.$fname.' '.$lname.',\n
				Thank  you for interest in registering for the CROWNWeb/QIPS Instructor-Led classes.  Unfortunately, this class is full. The waiting list will allow you to be placed  in a queue. In the event cancelations occur, you will receive another email  informing you of seat availability.\n
				Please save this email for future reference.\nEvent :'.$row['title'].'\nAttending : '.$fname.' '.$lname."\n";
	  if($_POST['classid']!=''){
		$messageWait.='Start Time :'.$row['time1'].'\nStart Date :'.$row['date_added'];
	  
	  }
	  $messageWait.='Confirmation  number : '.$confirmation.'\n';
	  	  if($_POST['classid']!=''){
		$messageWait.='To withdraw from the waiting list, click the link below. You will be asked to enter the confirmation number shown above.\n	http://www.projectcrownweb.org/crownweb/crown/confirmation.php?cid='.$_POST['classid'].'CRAFT@nw7.esrd.net\n';
	  }
	    $messageWait.='\n
		* * * * * * * * * * * * * * * * * * * * * * * * * *\n
			 Having trouble with the link? Simply copy and 
			 paste the entire address listed below into your 
			 web browser:CRAFT@nw7.esrd.net\n
		* * * * * * * * * * * * * * * * * * * * * * * * * *';
				
			}else{
					$subject = 'CROWNWeb/QIPS Registration Confirmation';
			}
			
				
			$random_hash = md5(date('r', time())); 
			//define the headers we want passed. Note that they are separated with \r\n 
			//$headers = "From: CRAFT@nw7.esrd.net\r\nReply-To: CRAFT@nw7.esrd.net"; 
			//add boundary string and mime type specification 
			//$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 
			//$headers .= 'Cc:CRAFT@nw7.esrd.net' . "\r\n".'X-Mailer: PHP/' . phpversion();
			//$headers .= 'Cc:balwant.jassal@absoluteinfotech.com' . "\r\n".'X-Mailer: PHP/' . phpversion();
			$boundary =	"----=_NextPart_000_0059_01BEA6E2.1A467F40";
			$headers = "FROM: CRAFT@nw7.esrd.net"." \r\n";
			$headers .= 'CC:CRAFT@nw7.esrd.net'." \r\n";
			$headers .= "Reply-To:CRAFT@nw7.esrd.net"." \r\n";
			$headers .= "Return-Path:CRAFT@nw7.esrd.net"." \r\n";
			$headers .= "MIME-Version: 1.0 \r\n";
			$headers .= "Content-Type: multipart/alternative; boundary = $boundary"." \r\n\r\n";
			$headers .= "This is a MIME encoded message."." \r\n\r\n";
			
			//text version
			$headers .= "--$boundary"."\n"."Content-Type: text/plain; charset=ISO_8859-1"."\r\n"."Content-Transfer_Encoding: 7bit"." \r\n\r\n";
			
			$message.="CROWNWeb Registration info.\n\n"; 
			$message.="Dear ".$fname." ".$lname.",\n\n ";
			$message.="Your registration has been confirmed. Please save this email  for future reference.\n\n";
			$message.="Event \t\t\t\t: ".$row['title']."\n";
			$message.="Attending\t\t\t: ".$fname." ".$lname."\n";
	  		if($_POST['classid']!='')
	      	{
				$message.="Start Date\t\t:".$row['date_added']."\n";
				$message.="End Date\t \t:".$row['end_date']."\n";
				$message.="Start Time \t\t:".$row['time1']."\n";
				$message.="End Time\t \t:".$row['time2']."\n";
	      	}
	  			//$message.="Confirmation  number\t: ".$confirmation."\n";
				$message.="User name\t\t    :".trim($_POST['username'])."\n";
			//$message.='Confirmation  number : '.$confirmation.'\n User name : '.trim($_POST['username']).'\n Password : '.trim($password).'\n';
	  	  if($_POST['classid']!='')
		  {
			$message.="\n To cancel your online registration, click the link below. You will be asked to enter the confirmation number shown above.\n\n";
			$message.="http://www.projectcrownweb.org/crownweb/crown/confirmation.php?cid=".$_POST['classid'];
	    	$message.="\n For information regarding Facility location and nearby business please call the Facility Directly at ".$row['facility_phone']."\n";
		  }
		$message.="For information regarding the training class, please call the CROWNWeb Training team at (813) 383-1530 ext 3278 \n\n";
		$message.="* * * * * * * * * * * * * * * * * * * * * * * * * * \n";
		$message.="Having trouble with the link? Simply copy and paste the entire address listed below into your web browser:\n";
		$message.="CRAFT@nw7.esrd.net \n\n"; 
		$message.="* * * * * * * * * * * * * * * * * * * * * * * * * * \n";
		   $to = $email;
			$subject = "CROWNWeb/QIPS Registration Confirmation";
			$message.= "Below are your login details :-\n";
			$message.="Course name\t: ".$row['title']."\n";
			$message.="User name \t :".trim($_POST["username"])."\n";
		//	$message.="Password \t  :".$password."\n";  blocked by sathya 201009
			$message.="  \t\t\t\t\t   Thanks   ";
			
				if($_POST['avail'] <= 0 && $_POST['classid']!='' && $_POST['classid']!=0){
						//mail($to, $subject, $messageWait,$headers);
				}else{
					if($to != "" && $subject != "" && $message != "" && $headers != "")
					{
						mail($to,$subject,$message,$headers);
					}
					else 
					{
						echo "<script> alert('Mail not send.'); window.close(); </script>";
					}
					 /*if($to != "" && $subject != "" && $message != "" && $headers != "")
							
					      mail($to, $subject1,$message1,$headers);*/
						//mail("jayakumar_rathnam@hotmail.com", $subject, $message,$headers);
						
				}
			//echo "<font style='font-size:14px;color:#12210E; font-family:Verdana, Arial, Helvetica, sans-serif;'>Thank for completing the registration. You will receive a confirmation email with the class details.</font>";
			
			
			/*echo "<script>window.close();alert('Your registration is complete.You can get an confirmation email from us soon with your login credentials.Thanks!'); </script>";*/
			?>
			
	<table align="center" width="100%" cellpadding="2" cellspacing="2" border="0">
	<tr style="background-color:#1D2D3A;color:#FFFFFF;">
	   	<td colspan="2"><div align="center"><strong>Thanks for registration with LMS</strong></div></td>
  	</tr>
	<tr><td colspan="2">&nbsp; </td></tr>
	<tr><td colspan="1"><!--Send a request for meeting:--></td><td align="right"><form action="register.php?action=eventRegistration" method="post">
	  <input type="hidden" name="start_date" value="<?php echo strftime("%m/%d/%Y", strtotime($row["date_added"]));?>" />
	  <input type="hidden" name="end_date" value="<?php echo strftime("%m/%d/%Y", strtotime($row["end_date"]));?>" />
	<input type="hidden" name="email" value="<?php echo $to;?>" />
	<input type="hidden" name="location" value="<?php echo $row["address"]." ".$row['location'];?>"/>
	<input type="hidden" name="start_time" value="<?php echo mktime($row["time1"],0,0,0,0,0); ?>" />
	<input type="hidden" name="end_time" value="<?php echo mktime($row["time2"],0,0,0,0,0); ?>" />
	<!--<input type="image" src="images/out-look.png" height="30px" width="60px"/>--></form></td></tr>
	
	<tr><td colspan="2"><?php echo "<font style='font-size:14px;color:#12210E; font-family:Verdana, Arial, Helvetica, sans-serif;'>Thank you for taking the time to register for your Learning Management System (LMS) account! Please take a moment to explore the LMS taking advantage of the newly released online tutorials as well as surveys to provide your much anticipated feedback. If you have any questions about this registration or the LMS in general, please contact us at CRAFT@nw7.esrd.net.</font>"; ?></td>
	</tr>
	
	<tr><td colspan="2">&nbsp;</td></tr>
	<?php
	if($_POST['newuser']!='yes'){
	?>
	<tr>
		<td width="22%" align="right" valign="top"><strong>Title :</strong> </td>
		<td width="78%" align="left" valign="top"><?php echo $row['title'];?></td>
	</tr>
	<!--<tr>
		<td align="right" valign="top"><strong>Description :</strong> </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
	    <td align="center"><div style="margin:10px; text-align:justify;">
          <?php
					echo html_entity_decode(stripslashes($rowDEvent["description"]),ENT_QUOTES);//$row->ftext;
				?>
        </div></td>
	</tr>-->
	<tr>
	  <td align="right" valign="top"><strong>Seats Available :</strong> </td>
	  <td align="left" valign="top">&nbsp;<?php echo $row['seats'];?></td>
  </tr>
	<tr>
		<td align="right" valign="top"><strong>Training City  :</strong> </td>
		<td align="left" valign="top"><div align="left"><?php echo $row['location'];?>&nbsp;</div></td>
	</tr>
	<tr>
		<td align="right" valign="top"><strong>Address  :</strong> </td>
		<td align="left" valign="top"><?php echo html_entity_decode(stripslashes($row["address"]),ENT_QUOTES);?></td>
	</tr>

	<tr>
		<td align="right" valign="top"><strong>Start Date :</strong></td>
		<td align="left" valign="top"><?php //echo html_entity_decode(stripslashes($rowDEvent["date_added"]),ENT_QUOTES);
			$date = date('m/d/Y', strtotime($row["date_added"]));
			echo $date;
?></td>
	</tr>
	<tr>
	  <td align="right" valign="top"><strong>End Date :</strong> </td>
	  <td align="left" valign="top"><?php echo strftime("%m/%d/%Y", strtotime($row["end_date"]));?></td>
  </tr>
	<tr>
		<td align="right" valign="top"><strong>Starting Time :</strong> </td>
		<td align="left" valign="top"><?php echo html_entity_decode(stripslashes(strftime("%m/%d/%Y", strtotime($row["time1"]))),ENT_QUOTES);?></td>
	</tr>
	<tr>
		<td align="right" valign="top"><strong>Ending Time :</strong> </td>
		<td align="left" valign="top"><?php echo html_entity_decode(stripslashes(strftime("%m/%d/%Y", strtotime($row["time2"]))),ENT_QUOTES);?></td>
	</tr>
	<?php
	}
	?>
	<!--
	<tr>
		<td align="right" valign="top"><strong>Phone Number :</strong> </td>
		<td align="left" valign="top"><?php echo html_entity_decode(stripslashes($row["phone"]),ENT_QUOTES);?></td>
	</tr>-->
	<tr><td colspan="2" style="font-size:13px;"><br/>
	<!--<div  style="margin-left:10px;"><strong>For information regarding Facility location and  nearby businesses please call the Facility directly at &nbsp;<font color="#000099">--><?php echo html_entity_decode(stripslashes($row["facility_phone"]),ENT_QUOTES);?><!--</font> <br/>
	    <br/>
	For information regarding the training class, please call the CROWNWeb Training team at <font color="#000099">(813) 383-1530 ext 3278</font></strong></div>--></td></tr>
	<tr>
	  <td align="right" valign="top">&nbsp;</td>
	  <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
<?php
			
		}
	}else{
	
	?>
	<form action="register.php" method="post" onsubmit="return validFrm(this);" name="regFrm">
	<input type="hidden" name="action" value="register_need" />
	<input type="hidden" name="classid" id="classid" value="<?php echo $_GET['id'];?>" />
	<input type="hidden" name="avail" id="avail" value="<?php echo $_GET['avail'];?>" />
	<input type="hidden" name="newuser" id="newuser" value="<?php echo $_GET['newuser'];?>" />
	<table width="100%" height="406" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #C7CAB9" bgcolor="">
	  <tr>
		<td align="left" bgcolor="#324E64">&nbsp;</td>
		<td height="26" align="left" bgcolor="#324E64"><strong><font color="#FFFFFF" size="2">Create Your Account </font></strong></td>
		<td height="26" colspan="4" align="left" bgcolor="#324E64">&nbsp;</td>
	  </tr>
	  
	  <tr>
	    <td height="45" colspan="6" >
		
		<?php
		$myconf="demo_site";
		
		require_once("conf.php");
		$db=new db();
		$db->connect();

	/*$rsDEvent = mysql_query("select * from abs_events where id = ".$_GET["id"]);
	$rowDEvent = mysql_fetch_assoc($rsDEvent); 
	$date3 = strftime("%m/%d/%Y", strtotime($rowDEvent["date_added"]));
	$seatno=(int)$rowDEvent["maximum"]-(int)$rowDEvent["seats"];
	$seatno=(int)$seatno+1;*/
?>
		<table align="center" width="100%" cellpadding="2" cellspacing="2" border="0">
<!--	<input type="hidden" name="abbLoc" id="abbLoc" value="<?php echo $rowDEvent["abrevationLoc"];?>" />
	<input type="hidden" name="seatdate" id="seatdate" value="<?php echo $date3;?>" />
	<input type="hidden" name="seatno" id="seatno" value="<?php echo $seatno;?>" />
-->	
	<!--<tr style="background-color:#1D2D3A;color:#FFFFFF;">
	
	   	<td colspan="2"><div align="center"><strong>CROWNWeb/QIPS Instructor-Led Training</strong><strong> Details </strong></div></td>
  	</tr>-->
	<?php
	if($_GET['newuser']!='yes'){
	?>
	<tr>
		<td  align="left" valign="top" width="15%"><strong>Title :</strong> </td><td width="45%" align="left" valign="top"><?php echo html_entity_decode(stripslashes($rowDEvent["title"]),ENT_QUOTES);?></td>
		<td width="15%" align="left" valign="top"><strong>Training City  :</strong> </td><td width="25%" align="left" valign="top"><div align="left"><a href="map.php?location=<?php echo stripslashes($rowDEvent["address"]);?>&ph=<?php echo stripslashes($rowDEvent["facility_phone"]);?>" title="View location on google map"  rel="gb_page_center[700, 600]"><?php echo substr(html_entity_decode(stripslashes($rowDEvent["location"]),ENT_QUOTES),0,50)."";?></a>&nbsp;</div><?php //echo html_entity_decode(stripslashes($rowDEvent["location"]),ENT_QUOTES);?></td>
	</tr>
	<!--<tr>
		<td align="right" valign="top"><strong>Description :</strong> </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
	    <td align="center"><div style="margin:10px; text-align:justify;">
          <?php
					echo html_entity_decode(stripslashes($rowDEvent["description"]),ENT_QUOTES);//$row->ftext;
				?>
        </div></td>
	</tr>-->
	
	<tr>
		<td align="left" valign="top"><strong>Address  :</strong> </td><td align="left" valign="top"><?php echo html_entity_decode(stripslashes($rowDEvent["address"]),ENT_QUOTES);?></td>
		<td align="left" valign="top"><strong>Seats Available :</strong> </td><td align="left" valign="top">&nbsp;<?php echo html_entity_decode(stripslashes($rowDEvent["seats"]),ENT_QUOTES);?></td>
	</tr>
	

	<tr>
		<td align="left" valign="top"><strong>Start Date :</strong></td> <td align="left" valign="top"><?php echo date('m/d/Y', strtotime($rowDEvent["date_added"]));?></td>
		<td align="left" valign="top"><strong>End Date :</strong> </td><td align="left" valign="top"><?php //echo html_entity_decode(stripslashes($rowDEvent["date_added"]),ENT_QUOTES);
			$date = strftime("%m/%d/%Y", strtotime($rowDEvent["end_date"]));
			echo $date;
?></td>
	</tr>
	
	<tr>
		<td align="left" valign="top"><strong>Starting Time :</strong> </td><td align="left" valign="top"><?php echo html_entity_decode(stripslashes(strftime("%m/%d/%Y", strtotime($rowDEvent["time1"]))),ENT_QUOTES);?></td>
		<td align="left" valign="top"><strong>Ending Time :</strong> </td>	<td align="left" valign="top"><?php echo html_entity_decode(stripslashes(strftime("%m/%d/%Y", strtotime($rowDEvent["time2"]))),ENT_QUOTES);?></td>
	</tr>
	
	<!--
	<tr>
		<td align="right" valign="top"><strong>Phone Number :</strong> </td>
		<td align="left" valign="top"><?php echo html_entity_decode(stripslashes($rowDEvent["phone"]),ENT_QUOTES);?></td>
	</tr>-->
<!--	<tr><td colspan="2" style="font-size:13px;"><br/><div  style="margin-left:10px;"><strong>For information regarding Facility location and nearby business please call the Facility Directly at  <font color="#000099"><?php echo html_entity_decode(stripslashes($rowDEvent["facility_phone"]),ENT_QUOTES);?></font> <br/><br/>
	For information regarding the training class, please call the CROWNWeb Training team at <font color="#000099">(813) 383-1530 ext 3278</font></strong></div></td></tr>-->
	</table> </td>
      </tr>
	  <?php
	}
	  ?>
	  <tr>
		<td height="30" colspan="6" align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><div style="vertical-align:top;"><font color="#FF0000">All fields are mandatory(*) </font></div></strong></td><!--<td colspan="4" valign="bottom" align="center"><a href="mailto:CRAFT@nw7.esrd.net?subject=CROWNWeb/QIPS send a meeting request"><img src="images/outlook.jpg" height="30px" width="50px"/></a></td>-->
	  </tr>
	  
	  <tr>
		<td width="1%" align="left" bgcolor="">&nbsp;</td>
		<td width="60%" height="15" align="left" bgcolor=""><strong>First Name </strong> </td>
		<td colspan="4" align="left" bgcolor=""><strong>Last Name</strong> </td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="30" align="left" bgcolor=""><input name="fname" type="text" id="fname" size="25" />
		  &nbsp;<strong style="vertical-align:top;"></strong><font color="#FF0000">*</font></td>
		<td colspan="4" align="left" bgcolor=""><input name="lname" type="text" id="lname" size="25" />&nbsp;<strong style="vertical-align:top;"></strong><font color="#FF0000">*</font></td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		
		<td height="24"  align="left" bgcolor=""><strong>Organization Name </strong></td>
		<td  colspan="4" height="23" align="left" bgcolor=""><strong> Email Address</strong></td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		
		<td height="24"  align="left" bgcolor=""><input name="organization_name" type="text" id="organization_name" size="25" />&nbsp;</td>
		<td colspan="4" height="31" align="left" bgcolor=""><input name="email" type="text" id="email" size="25" />&nbsp;<strong style="vertical-align:top;"><font color="#FF0000">*</font></strong></td>
	  </tr>
	  
	  
	  <tr>
	    <td align="left" bgcolor="">&nbsp;</td>
	   
	    <td height="24" align="left" bgcolor=""><strong>Provider Number </strong></td>
		 <td height="24" colspan="4" align="left" bgcolor=""><strong>Confirm Email Address </strong></td>
      </tr>
	  <tr>
	    <td align="left" bgcolor="">&nbsp;</td>
		 <td height="23" align="left" bgcolor=""><input name="provider_number" type="text" id="provider_number" size="25" />
		  &nbsp;</td>
	    <td height="24" colspan="4" align="left" bgcolor=""><input name="cemail" type="text" id="cemail" size="25" />&nbsp;<strong style="vertical-align:top;"><font color="#FF0000"><strong style="vertical-align:top;"><font color="#FF0000">*</font></strong></font></strong></td>
      </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="21" align="left" bgcolor=""><strong>Phone Number</strong></td>
		<td height="24" colspan="4" align="left" bgcolor=""><strong>Password</strong></td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="26" align="left" bgcolor=""><input name="ph1" type="text" id="ph1" size="3" />
                          -&nbsp;<input name="ph2" type="text" id="ph2" size="3" />
                          -&nbsp;<input name="ph3" type="text" id="ph3" size="10" />
                          <!--<input name="phone" type="text" id="phone" size="25" />-->&nbsp;<strong style="vertical-align:top;"><font color="#FF0000">&nbsp;<strong style="vertical-align:top;"></strong></font></strong></td>
		<td height="23" colspan="4" align="left" bgcolor=""><!--<input name="ph1" type="text" id="ph1" size="3" />
                          -&nbsp;<input name="ph2" type="text" id="ph2" size="3" />
                          -&nbsp;<input name="ph3" type="text" id="ph3" size="10" />
                          <!--<input name="phone" type="text" id="phone" size="25" />&nbsp;<strong style="vertical-align:top;"><font color="#FF0000">&nbsp;<strong style="vertical-align:top;"></strong></font></strong>-->
	    <input name="password" type="password" id="password" size="25" /></td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="21" align="left" bgcolor=""><strong>Username  </strong>(Create new username)</td>
		<td height="21" colspan="4" align="left" bgcolor=""><strong>Confirm Password</strong>&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="26" align="left" bgcolor=""><div style="margin-left:0px">
		  <input name="username" type="text" id="username"   onblur = "chckusr(this,'master_cap_stack')"/>&nbsp;<strong style="vertical-align:top;"><font color="#FF0000">*</font></strong>
		  <br />
		  <span id="result" style="font-size:9px"></span></div></td>
		<td height="26" colspan="4" align="left" bgcolor=""><!--<font  color="#FF0000">Auto-Generated</font>-->
	    <input name="cpassword" type="password" id="cpassword" size="25" /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" bgcolor="">&nbsp;</td>
	    <td height="30" align="left" bgcolor="">&nbsp;</td>
	    <td height="30" colspan="4" align="left" bgcolor="">&nbsp;</td>
      </tr>
	  <tr>
	    <td align="left" bgcolor="">&nbsp;</td>
	    <td height="30" align="left" bgcolor=""><strong>Password Security Question </strong></td>
	    <td height="30" colspan="4" align="left" bgcolor="">&nbsp;<strong>Answer</strong></td>
      </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="30" align="left" bgcolor=""><select name="security_question" id="security_question">
          <option value="none">Choose security question.</option>
          <option value="What's your pet name?">What's your pet name?</option>
          <option value="What's your Favorite food?">What's your Favorite food?</option>
          <option value="What's your mother maiden name?">What's your mother maiden name?</option>
          <option value="What's your Favorate actor name?">What's your Favorite actor name?</option>
          <option value="What's your nick name?">What's your nick name?</option>
        </select>
	    &nbsp;<strong style="vertical-align:top;"><font color="#FF0000">*</font></strong></td>
		<td height="30" colspan="4" align="left" bgcolor=""><input type="text"  name="security_answer" id="security_answer" size="25" />
	    &nbsp;<strong style="vertical-align:top;"><font color="#FF0000">*</font></strong></td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="24" align="left" bgcolor="">&nbsp;</td>
		<td height="24" colspan="4" align="left" bgcolor="">&nbsp;</td>
	  </tr>
	  <tr>
		<td height="14" colspan="6" align="left" bgcolor="">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" bgcolor="">&nbsp;</td>
		<td height="29" colspan="5" align="center" bgcolor=""><input name="Submit" type="submit" value="Submit" style="background-color:#000000; color:#FFFFFF; width:120px; height:30px; font-size:14px; font-weight:bolder;" /></td>
	  </tr>
	</table>
	</form>
</body>
	</html>
	<?php
	}
}	
	?>