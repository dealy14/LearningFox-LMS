<?php
include("../conf.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
function call_scorm(ctype,action){
window.resizeTo(800,400);
window.open('import_form.php?subaction=spAdd&ctype='+ctype,'ttt','toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=600,height=800,screenX=150,screenY=150,top=150,left=150')
//alert("str="+str+" str1="+str1);
}
function call_nonscorm(ctype,action){
window.resizeTo(200,100);
window.open('create_course.php?subaction=spAdd&ctype='+ctype,'ttt','toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=200,height=200,screenX=150,screenY=150,top=150,left=150');

}
function uploadafile(){

	var file_length = document.getElementById("upfile").uploadedfile.value.length;
	var file_ext = document.getElementById("upfile").uploadedfile.value.substring(file_length-3);
	var file_name = document.getElementById("upfile").filename.value;
	var asset_num = document.getElementById("upfile").assetnum.value;
	
	if((file_name) == ""){
		alert('Filename is Empty, Try Again');
		return false;
	}else if((asset_num) == "none"){
		alert('Choose an Asset Number');
		return false;
	}else{
		if( file_ext == '' ){
			alert('File is Empty, Try Again');
			return false;
		}else{
			if( (file_ext == "pdf") || (file_ext == "PDF") || (file_ext == "fla") || (file_ext == "swf") || (file_ext == "jpg") || (file_ext == "JPG") || (file_ext == "bmp") || (file_ext == "BMP") || (file_ext == "gif") || (file_ext == "GIF") || (file_ext == "doc") )
			{
				return true;
			}else{
				alert('Upload must be an electronic file Only');
				return false;
			}
		}
	}
	
}
</script>
</head>

<body bgcolor="#EFF7FF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<?php


if($_POST['rad_type']=='Scorm 1.2' ){
echo "<script>call_scorm('".$_POST['rad_type']."','".$_POST['val']."');</script>";
}else{
	if($_POST['rad_type']=='Non-Scorm')
	echo "<script>call_nonscorm('".$_POST['rad_type']."','".$_POST['val']."');</script>";
	}

?>
<?php
	
	/*
	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM ref");
	$nx=0;
	while($db->getRows()){ 
		$date_of_reg = $db->row("filename");
		print '<b>'.$date_of_reg.'</b><br />';
	}
	*/
	$filename = $_FILES['uploadedfile']['name'];
	$substr = substr($filename, -3, 3);
		if(!empty($_POST['filename']))
	{
		if($_POST['assetnum'] != "none"){
			if(($substr == "fla") || ($substr == "swf") || ($substr == "jpg") || ($substr == "JPG") || ($substr == "bmp") || ($substr == "BMP") || ($substr == "gif") || ($substr == "GIF") || ($substr == "pdf") || ($substr == "PDF") || ($substr == "doc")){
				//$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
				//$name = $_FILES["pictures"]["name"][$key];
				//move_uploaded_file($tmp_name, "$uploads_dir/$name");
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], "efiles/".$_FILES['uploadedfile']['name'])){
					echo 'file uploaded<br />';
		
				
					$db = new db;
					$db->connect();
					$query="INSERT INTO `efiles` (`assetnum` ,`name` ,`filename` ,`created`)	VALUES('".mysql_escape_string($_POST['assetnum'])."','".mysql_escape_string($_FILES['uploadedfile']['name'])."','".mysql_escape_string($_POST['filename'])."', NOW())"; 
					//insertAction("INSERT INTO efiles (ID,name,created)VALUES('".mysql_escape_string($_FILES['uploadedfile']['name'])."', NOW()");
																					
					$result = mysql_query($query);
					   
					if(!$result){
						print mysql_error();
						exit;
					}
					
				}else{
					echo 'File not uploaded , error on File\'s tmp_name<br />';
				}
			}
		}else{
			echo 'File not uploaded, Choose an Asset Number<br />';
		}
	}
	else{
	}
?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="upfile" id="upfile" >
<input type="hidden" name="val" value="<?php echo $_GET['subaction'];?>" />
	<TR>
		<td colspan="2" valign="top">
		Filename: <input name="filename" type="text" />
		</td>
	  </tr>
	<tr>
		<td colspan="2" valign="top">
		Asset #:
		<select name="assetnum" id="assetnum">
			<option name="none" value="none">- Select Asset -</option>
			<option name="none" value="a1">Asset 1</option>
			<option name="none" value="a2">Asset 2</option>
			<option name="none" value="a3">Asset 3</option> 
		</select>
		</td>
	</tr>
	
	  	<td colspan="2" valign="top">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
		Choose a file to upload: 
		</td>
	  </tr>
	  <TR>
		<td colspan="2" valign="top">
		<input name="uploadedfile" type="file" />
		</td>
	  </tr>
	  <TR>                                              
	    <TD ALIGN="RIGHT">
			<INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS="submit" onClick="top.window.close();">
			<INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Continue "  CLASS="submit" onClick="uploadafile();">
		</TD>
	  </TR>				  
	  </form>
 </TABLE>

<!--
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
<form action="<?php //$_SERVER['PHP_SELF'];?>" method="post">
<input type="hidden" name="val" value="<?php //echo $_GET['subaction']; ?>" />
<tr>
<td colspan="2"><span class="ttl">Select the type of course.</span></td>
  <TR>
  		<TD><INPUT type="radio" name="rad_type" value="Scorm 1.2" CLASS="input"></TD>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>SCORM conformant 1.2 course</SPAN></TD>
 </TR> 
	  <TR> 
	  	<TD><INPUT type="radio" name="rad_type" value="Non-Scorm" CLASS="input"></TD>	
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>Non-SCORM conformant course</SPAN></TD>
	  </TR> 
	  <tr>
	  	<td colspan="2" valign="top">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
		Choose a file to upload: <input name="uploadedfile" type="file" /><br />
		</td>
	  </tr>
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS=submit onClick="top.window.close();"><INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Continue "  CLASS=submit></TD>
	  </TR>				  
	  </form>
	  </TABLE>
-->	  
</body>
</html>
