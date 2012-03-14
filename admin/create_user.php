<?php
require_once("../conf.php");
//if($type=="")
//{
//$type="wbt";
//}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<STYLE TYPE="text/css">
.input {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#000000;BORDER-RIGHT:#000000;BORDER-LEFT:#000000;BORDER-BOTTOM:#000000;BACKGROUND:#93BEE2}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.submit {FONT-FAMILY:VERDANA;BACKGROUND:#336699;}
</STYLE>
	<title>Create User</title>	
<script language="javascript" type="text/javascript">
function valFrm(objFrm){
var regex = /^([a-z0-9_\-\.]+)@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
	if(objFrm.email.value == ""){
		alert("Please specify the email address");
		objFrm.email.focus();
		return false;
	}
	if(!(regex.test(objFrm.email.value)))
	{
		alert("Please specify a valid email address");
		objFrm.email.focus();
		return false;
	}
	if(objFrm.username.value == ""){
		alert("Please specify the username");
		objFrm.username.focus();
		return false;
	}
	
	if(objFrm.password.value == ""){
		alert("Please specify the password");
		objFrm.password.focus();
		return false;
	}
	
	if(objFrm.password.value != objFrm.password_confirmation.value){
		alert("The passwords you have entered do not match.");
		objFrm.password.focus();
		return false;
	}
	
	
return true;	
}
</script>	
</head>
<?php
//if(!$frame||$frame=="")
//{
?>
<!--
<SCRIPT>
//setInterval("window.focus();",3600);
window.resizeTo(300,150);
</SCRIPT>
<FRAMESET ROWS="30,*" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0" COLS="*"> 
<FRAME NAME="formpost" SCROLLING="NO" noresize SRC="create_course.php?frame=top" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<FRAME NAME="data" noresize SRC="create_course.php?frame=bottom&subaction=<?php //echo $subaction;?>" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
</FRAMESET>
<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>-->
<?php
//}
//else if($frame=="top")
//{
//echo $_SERVER['HTTP_REFERER'];
?>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<?php
	if(!isset($_POST["sub1"])){
?>
<IMG SRC="images/course2.gif" ALIGN="absmiddle"> <SPAN CLASS=hdr>Add A User:</SPAN>
<FORM NAME="myform" ACTION="create_user.php" METHOD="POST" onSubmit="return valFrm(this);">
<INPUT TYPE="HIDDEN" NAME="date_of_reg" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="date_of_mod" VALUE="<?php echo date(ymd);?>">
<input type="hidden" name="sub1" value="submit">
<TABLE BORDER="0" CELLPADDING="5" CELLSPACING="0">
<?php
$db = new db;
$db->connect();
$db->query("SELECT * FROM reg_form WHERE stored = 'y' AND forder>=1 AND status='on' ORDER BY forder ASC");
$nx=0;
while($db->getRows()) { 
  $mvals = $db->row("field_name");
  ?>
	<TR>
	  <TD><FONT FACE="VERDANA" SIZE="2"><B><?php echo$db->row("display");?>:</FONT></TD>
	  <TD><?php makeField($db->row("field_name"),$$mvals);?></TD>
	</TR>
  <?php
  $nx++;
}
?>
<tr>
	<TD><FONT FACE="VERDANA" SIZE="2"><B>Confirm password:</FONT></TD>
	<TD><input type="password" name="password_confirmation" value="" class="input"></TD>
</tr>
<tr>
	<td><font face="verdana" size="2"><strong>Select User Level:</strong></font></td>
	<td>
		<select name="user_level">
			<?php 
				for($i=0;$i<=4;$i++){
			?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
				}
			?>
		</select>
		&nbsp;(0=most restrictive; 4=full admin)
</tr>
<TR>
  <TD COLSPAN="2" ALIGN="center"><br><br><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
</TR>
</TABLE>
</FORM>
</body>
<?php
}
else {
	require_once("../includes/class_db_mysql.php");
	$db = new db();
	$db->connect();

	$fname = ucwords($_POST["fname"]);
	$lname = ucwords($_POST["lname"]);
//	$user_group = $_POST["user_group"];	Not in form
	$email = $_POST["email"];
	$username = $_POST["username"];
	$provider_number = $_POST['provider_number'];
	$password = $_POST["password"];
	$phone = $_POST['phone'];
//	$orgID = $_POST["orgID"];  			Not in form
//	$ssn = $_POST["ssn"];  				Not in form
	$user_level = $_POST["user_level"];
	$ip = ip2long($_SERVER['REMOTE_ADDR']);
	
/*	$qry = "insert into students set
		date_of_reg = '".date("Y-m-d")."',
		fname = '".$fname."',
		lname = '". $lname."',
		orgID = '". $orgID."',
		user_group = '". $user_group."',
		email = '".$email."',
		username = '".$username."',
		password = '".$password."',
		userlevel = ".$user_level.",
		ssn = '".$ssn."',
		ip = $ip"; */
		
		
	$qry = sprintf("INSERT INTO students (date_of_reg, fname, lname, email, username, provider_number, `password`, phone, userlevel, ip) " .
				  "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %u)", 	
				  date('Y-m-d'), $db->escape_string($fname), $db->escape_string($lname), $db->escape_string($email),
				  $db->escape_string($username), $db->escape_string($provider_number), $db->escape_string($password), 
				  $db->escape_string($phone), $user_level, $ip);
	$db->query($qry);
	$db->close();
	//echo $qry;
	//$rsltSet = $db->query($qry);
	//$cnt = mysql_affected_rows();
	//$cnt = 1;
	//echo $cnt;
	//if($cnt > 0){
		echo "<script> alert('User Added'); window.close();</script>";
		/*echo "<script>top.window.opener.objReload('course');window.close()</script>";*/
		/*echo "<script> alert(opener.parent.location.href);</script>";*/
	//}
}
?>
<!--
<SCRIPT>
function setTextData(elName)
{
eval("top.formpost.document.myform."+elName+".value=document.thisform."+elName+".value;");
}



</SCRIPT>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="thisform" METHOD="POST" ACTION="create_objects_sql.php?action=course" target="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="subaction" VALUE="<?php echo$subaction;?>">
<INPUT TYPE="HIDDEN" NAME="type" VALUE="<?php echo $type;?>">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
	  <TR>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>Course Title:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="name" CLASS="input"></TD>		
	  </TR> 	
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS=submit onClick="top.window.close();"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  CLASS=submit></TD>
	  </TR>				  
	</TABLE>

</FORM>-->
</body><?php
//}
?>
</html>
