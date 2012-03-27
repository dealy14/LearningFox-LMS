<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Select Course Type</title>
<script type="text/javascript">
function call_scorm(ctype,action){
	window.resizeTo(800,450);
	window.open('import_form.php?subaction=spAdd&ctype='+ctype,'ttt','toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=600,height=800,screenX=150,screenY=150,top=150,left=150')
	//alert("str="+str+" str1="+str1);
}
function call_nonscorm(ctype,action){
	window.resizeTo(225,125);
	window.open('create_course.php?subaction=spAdd&ctype='+ctype,'ttt','toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=200,height=200,screenX=150,screenY=150,top=150,left=150');
}
</script>
</head>

<body bgcolor="#EFF7FF" topmargin="0" rightmargin="0" leftmargin="0">
<?php
if($_POST['rad_type']=='Scorm 1.2' ){
echo "<script>call_scorm('".$_POST['rad_type']."','".$_POST['val']."');</script>";
}else{
	if($_POST['rad_type']=='Non-Scorm')
	echo "<script>call_nonscorm('".$_POST['rad_type']."','".$_POST['val']."');</script>";
	}

?>
<table BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
	<input type="hidden" name="val" value="<?php echo $_GET['subaction'];?>" />
	 <tr>
	 <td colspan="2"><span class="ttl">Select the type of course.</span></td>
	 </tr>
	 <TR>
  		<TD><INPUT type="radio" id="scormradio" name="rad_type" value="Scorm 1.2" CLASS="input"></TD>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl><label for="scormradio">SCORM conformant 1.2 course</SPAN></TD>
	 </TR> 
	 <TR> 
	  	<TD><INPUT type="radio" id="nonscormradio" name="rad_type" value="Non-Scorm" CLASS="input"></TD>	
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl><label for="nonscormradio">Non-SCORM conformant course</label></SPAN></TD>
	 </TR> 
	 <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT">
	     <INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS=submit onClick="top.window.close();">
	     <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Continue "  CLASS=submit>
	    </TD>
	 </TR>				  
</form>
</table>
</body>
</html>
