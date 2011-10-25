<?php
include("../conf.php");
include("dUnzip2.inc.php");

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
color:#FFFFFF;
background:#253A4A;
font-weight:900;

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
<body  BGCOLOR="#336699">
<?php
$courseid = $_GET["id"];
//echo $_GET['cn'];
$_SESSION['coursename']=$_GET['cn'];
if($_POST['status']!=1){
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="return validChk(this);">
<input type="hidden" name="status" value="1" />
<input type="hidden" name="cn" value="<?php echo $_GET['cn'];?>" />
<input type="hidden" name="courseid" value="<?php echo $courseid; ?>" />
<input type="hidden" name="course_type" value="<?php echo $ctype; ?>" />
<table width="75%" border="0" cellspacing="0" cellpadding="0">
  <tr height="20">
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" class="class1">Import Course&nbsp;</td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td colspan="2"> <span class="class1">Enter the name of the Zip file containing your course content that you wish to import :</span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="13%" align="right"><span class="class1">Zip File</span> : </td>
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
<?php
}else{

//	echo "Type: " . $_FILES["file"]["type"] . "<br />";
				if ($_FILES["file"]["type"]=="application/zip" || $_FILES["file"]["type"]=="application/x-zip-compressed"){
							 if ($_FILES["file"]["error"] > 0) {
									 echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
							 }else{
									if(!file_exists("uploadfiles"))
														mkdir("uploadfiles",0777);
									/*if(!file_exists("uploadfiles/".$_POST['cn']))
														mkdir("uploadfiles/".$_POST['cn'],0777);*/
														
									 if (file_exists("uploadfiles/". basename($_FILES["file"]["name"],".zip"))){
    					  							echo '<strong>'.$_FILES["file"]["name"] . " already exists.</.strong> ";
      									}else{
     												 move_uploaded_file($_FILES["file"]["tmp_name"],"uploadfiles/". $_FILES["file"]["name"]);
													$file420 = $_FILES["file"]["name"];
													
													 //$file = getcwd() . "uploadfiles".$_FILES['file']['name'];
													//echo $file;
													// Or:
													$file = $_SERVER['DOCUMENT_ROOT'].'/lms/admin/uploadfiles/'.$_FILES['file']['name'];
												
																					
													//$zip = zip_open($file);
													//................function starts here.......................// 
													/*function unzip($zipfile)
													{
													
														
													$file1 = "uploadfiles/".$_GET['cn']."/".basename($zipfile,".zip");
													//chdir("uploadfiles");
				
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
																mkdir($zdir,0777);
															}													  
															else {
																$name = zip_entry_name($zip_entry);
																if (file_exists($name)) {
																	trigger_error('File "<b>' . $name . '</b>" exists', E_USER_ERROR);
																	return false;
																}
																$fopen = fopen($name, "w");
												fwrite($fopen, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)), zip_entry_filesize($zip_entry));
															}
															zip_entry_close($zip_entry);
														}
														zip_close($zip);
														return true;
													}							 
													 unzip($file);*/
													 $file1 = "uploadfiles/".basename($file420,".zip");
													 //die($file1);
													 if(!file_exists($file1))
															mkdir($file1,0777);
															//chdir($file1);
															
													 $zip = new dUnzip2($file);
													 $zip->unzipAll($file1);
													 @unlink($file);
													 //die( getcwd()); 
													// 
													 //..............function ends here..................//
													 
													 /*---------Checking whether index file within a directory  exist or not starts-------------------*/
												
													
													/*------checking for index file ends here-------------*/
													//echo $file_store."hello";
													
					/*............ code to read the imsmanifest.xml file from the uploaded folder......*/
					
					$file_path=$_SERVER['DOCUMENT_ROOT']."/lms/admin/uploadfiles/".basename($file,".zip")."/sco";
					echo $file_path;
					$mydir=dir($file_path);
					while(($file = $mydir->read()) !== false)
															{
																if(is_dir($mydir->path.$file)) 
																{
																	//echo "Directory: $file<BR>";
																}else{
																	if($file != false){
																			if($file=="imsmanifest.xml"){
																			/*...code to read title tag in imsmanifest.xml file....*/
																			// DOMElement->getElementsByTagName() -- Gets elements by tagname 
																			  // nodeValue : The value of this node, depending on its type. 
																			  // Load XML File. You can use loadXML if you wish to load XML data from a string 
																			
																		  $objDOM = new DOMDocument(); 
												 //$path=$_SERVER['DOCUMENT_ROOT']."/lms/admin/uploadfiles/".basename($file,".zip")."/sco/imsmanifest.xml";
												  $path1=$file_path."/imsmanifest.xml";
												  echo $path1;

																			  $objDOM->load($path1); //make sure path is correct 
																			
																			
																			  $note = $objDOM->getElementsByTagName("organizations"); 
																			  // for each note tag, parse the document and get values for 
																			  // tasks and details tag. 
																			
																			  foreach($note as $value ) 
																			  { 
																				$tasks = $value->getElementsByTagName("title"); 
																				$task  = $tasks->item(0)->nodeValue; 
																				$details = $value->getElementsByTagName("item"); 
																				$detail  = $details->item(0)->nodeValue; 
																				$course_name=$task;
																				echo "$task :: $detail :: $detail1 <br>"; 
																			  } 

																			/*.....end reading title......*/
																			}
																			
																			//echo $file;
																		//unlink($file);
																	}
																}
															}
					
					
					
					/*..............end reading imsmanifest.xml file....................*/
													
													
													$file1=basename($file420,".zip");
													$courseid = $_POST["courseid"];
													
							//$str="insert into crab_lessons set course_id='".$courseid."',lesson_name='".$file1."',folder_name='".$_POST['cn']."/".$file1."',file_name='".$filename."',date_of_creation='".date('m/d/y'."'");
				$str="insert into course set created='".date("ymd")."',name='".$task."',type='wbt',course_type='".$_POST['course_type']."',folder_name='".$file1."'";
							
									//echo $str;
									$db = new db;
									$db->connect();
									$db->query($str);
									echo "<script>alert('The course content has been successfuly imported.');</script>";
									echo "<script>opener.refresh();</script>";
									echo "<script> window.close();</script>";
			
									
											 
											}
									
				
								   }
				 }else{
				 		
						
						echo '<strong>The course content file should be in the zip format.</strong>';
						}
}
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<!-- the code to display the listing starts -->
<?php
	if(isset($_GET["id"]))
		$courseid = $_GET["id"];
	else
		$courseid = $_POST["courseid"];
		
		//include("listcourse.php");
?>				 				 
<!--  the code to display the listing ends.	-->
</td></tr></table>
</body>
</html>
