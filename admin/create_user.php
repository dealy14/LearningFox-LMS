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
	if(objFrm.email.value == ""){
		alert("Kindly Specify the email address");
		objFrm.email.focus();
		return false;
	}
	
	if(objFrm.username.value == ""){
		alert("Kindly Specify the username");
		objFrm.username.focus();
		return false;
	}
	
	if(objFrm.password.value == ""){
		alert("Kindly Specify the password");
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
while($db->getRows())
{ 
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
	<td><font face="verdana" size="2"><strong>Select User Level :</strong></font></td>
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
</tr>
<TR>
  <TD COLSPAN="2" ALIGN="center"><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
</TR>
</TABLE>
</FORM>
</body>
<?php
}
else {
require_once("../includes/class_db_mysql.php");
$obj1 = new db();
$obj1->connect();

	$fname = ucwords($_POST["fname"]);
	$lname = ucwords($_POST["lname"]);
	$user_group = $_POST["user_group"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$orgID = $_POST["orgID"];
	$ssn = $_POST["ssn"];
	$user_level = $_POST["user_level"];
	$ip = str_replace(".","",$_SERVER['REMOTE_ADDR']);
	
	$qry = "insert into students set
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
		ip = $ip";
		
	//echo $qry;
	$rsltSet = mysql_query($qry);
	$cnt = mysql_affected_rows();
	//$cnt = 1;
	//echo $cnt;
	if($cnt > 0){
		echo "<script> alert('User Added'); window.close();</script>";
		/*echo "<script>top.window.opener.objReload('course');window.close()</script>";*/
		/*echo "<script> alert(opener.parent.location.href);</script>";*/
	}
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