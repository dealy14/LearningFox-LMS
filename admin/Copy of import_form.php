<?php
include("../conf.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">

td.class1{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:14px;
color:#990033;
background:#99CCFF;
font-weight:900;
text-decoration:blink;
}
</style>
<STYLE TYPE="text/css" >
	 #m1 {BACKGROUND-COLOR:#FFFFFF;}
	 .innerl {FONT-FAMILY:VERDANA;FONT-SIZE:10;FONT-COLOR:000000;}
	 .bkg {BACKGROUND-COLOR:#FFFFFF;}
	 .bkg2 {BACKGROUND-COLOR:#FFFFCC;}
	<?php include("admin_css.php");?>
	.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style2 {
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</STYLE>
<script language="javascript1.1" type="text/javascript">
function validChk(frm){
	if(frm.file.value==''){
		alert('Please specify the course content.');
		frm.file.focus();
		return false;
	}
}
</script>
</head>
<body  BGCOLOR="#EFF7FF">
<?php
$courseid = $_GET["id"];
?>
<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onsubmit="return validChk(this);">
<input type="hidden" name="status" value="1" />
<input type="hidden" name="courseid" value="<?php echo $courseid; ?>" />
<table width="75%" border="0" cellspacing="0" cellpadding="0">
  <tr height="30">
    <td colspan="2"><?php if($_POST['status']==1){
	
	echo "Type: " . $_FILES["file"]["type"] . "<br />";
				if ($_FILES["file"]["type"]=="application/zip" || $_FILES["file"]["type"]=="application/x-zip-compressed"){
							 if ($_FILES["file"]["error"] > 0) {
									 echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
							 }else{
									/*echo "Upload: " . $_FILES["file"]["name"] . "<br />";
									echo "Type: " . $_FILES["file"]["type"] . "<br />";
									echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
									echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";*/
									
									 if (file_exists("uploadfiles/" . $_FILES["file"]["name"])){
    					  							echo '<strong>'.$_FILES["file"]["name"] . " already exists.</.strong> ";
      									}else{
     												 move_uploaded_file($_FILES["file"]["tmp_name"],"uploadfiles/" . $_FILES["file"]["name"]);
													
													
													 //$file = getcwd() . "uploadfiles".$_FILES['file']['name'];
													//echo $file;
													// Or:
													$file = $_SERVER['DOCUMENT_ROOT'].'/lms/admin/uploadfiles/'.$_FILES['file']['name'];
													$file_store=$file;
													
																							
													//$zip = zip_open($file);
													//................function starts here.......................// 
													function unzip($zipfile)
													{
													$file1 = basename($zipfile,".zip");
													chdir("uploadfiles");
													//echo $file1;
														if(!file_exists($file1))
															mkdir($file1,0777);
															chdir($file1);
													
														$zip = zip_open($zipfile);
														while ($zip_entry = zip_read($zip)) {
															zip_entry_open($zip, $zip_entry);
															if (substr(zip_entry_name($zip_entry), -1) == '/') {
																$zdir = substr(zip_entry_name($zip_entry), 0, -1);
																if (file_exists($zdir)) {
																	trigger_error('Directory "<b>' . $zdir . '</b>" exists', E_USER_ERROR);
																	return false;
																}
																mkdir($zdir);
															}
													  
															else {
																$name = zip_entry_name($zip_entry);
																if (file_exists($name)) {
																	trigger_error('File "<b>' . $name . '</b>" exists', E_USER_ERROR);
																	return false;
																}
																$fopen = @fopen($name, "w");
												@fwrite($fopen, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)), zip_entry_filesize($zip_entry));
															}
															zip_entry_close($zip_entry);
														}
														zip_close($zip);
														return true;
													}							 
													 
													 unzip($file);
													 unlink($file);
													 //..............function ends here..................//
													 
													 /*---------Checking whether index file within a directory  exist or not starts-------------------*/
													$file_dir=$_SERVER['DOCUMENT_ROOT']."/lms/admin/uploadfiles/".basename($file,".zip");
													$mydir = dir($file_dir);
													//echo $file_dir;
													$res = 1;
													
													while(($file = $mydir->read()) !== false)
													{
														if(is_dir($mydir->path.$file)) 
														{
															//echo "Directory: $file<BR>";
														 } 
														else 
														{
															//echo $file ."<br>";
															if($file != false){
																	if(preg_match("/index/i",$file,$matches)){
																		//print_r($matches);
																		//echo "Filename: <a href = 'html/$file'  target = '_blank'>$file</a><BR>";
																		$res = 0;
																		//exit();
																	}
																	
															}
															}
													
													   } 
													 //echo " res = " . $res;
													 	if($res != 1)
														{
															
															//rmdir($file_dir);														
															
															while(($file = $mydir->read()) !== false)
															{
																if(is_dir($mydir->path.$file)) 
																{
																	//echo "Directory: $file<BR>";
																}else{
																	if($file != false){
																		unlink($file);
																	}
																}
															}
															
															unlink($file_dir);
															echo "<script> alert('No Index File'); window.history.go(-1);</script>";
															//exit();
														}
													/*------checking for index file ends here-------------*/
													echo $file_store."hello";
													$file1=basename($file_store,".zip");
													$courseid = $_POST["courseid"];
													
							$str="insert into crab_lessons set course_id='".$courseid."',folder_name='".$file1."',file_name='".$file1."',date_of_creation='".date('m/d/y'."'");
									echo $str;
									$db = new db;
									$db->connect();
									$db->query($str);
									echo '<strong>The course content has been successfuly imported.</strong>';
																			 
													 
													 
													 
											}
									
				
								   }
				 }else{
				 		
						echo '<strong>The course content file should be in the zip format.</strong>';
						}
				}
	?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="class1">Import Course&nbsp;</td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td colspan="2"> <span class="style2">Enter the name of the Zip file containing your course content that you wish to import :</span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="13%" align="right"><span class="style2">Zip File</span> : </td>
    <td width="87%"><input name="file" id="file" size="30" type="file" />&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="submit" type="submit" value="Submit" />&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
