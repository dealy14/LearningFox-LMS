<?php
session_start();
include("../conf.php");
include("dUnzip2.inc.php");

echo $upload_max_filesize=ini_get("upload_max_filesize");
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
	if(frm.category_id.value==''){
		alert('Please select Category.');
		frm.category_id.focus();
		return false;
	}
}
</script>
</head>
<body  BGCOLOR="#EFF7FF">
<?php
$courseid = $_GET["id"];
$ctype=$_GET['ctype'];
//echo $_GET['cn'];
$_SESSION['coursename']=$_GET['cn'];
if($_POST['status']!=1){
	$upload_max_filesize=ini_get("upload_max_filesize");
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="return validChk(this);">
	<input type="hidden" name="status" value="1" />
	<input type="hidden" name="cn" value="<?php echo $_GET['cn'];?>" />
	<input type="hidden" name="courseid" value="<?php echo $courseid; ?>" />
	<input type="hidden" name="course_type" value="<?php echo $ctype; ?>" />
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr height="20">
	<td colspan="5"></td>
	</tr>
	<tr>
	<td colspan="5" class="class1">Import Course&nbsp;</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
	<td colspan="5"> <span class="class1">Enter the name of the Zip file containing your course content that you wish to import :</span></td>
	</tr>
	<tr>
	<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
	<td width="23%" align="right"><span class="class1">Zip File</span> : </td>
	<td colspan="4"><input name="file" id="file" size="30" type="file" />&nbsp;</td>
	</tr>
	<tr>
	<td align="right">&nbsp;</td>
	<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="5" align="left">Whether you want to credit the course or not ? (Mandatory element for SCORM 1.2) </td>
	</tr>
	<tr>
	<td align="right">&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td align="right">&nbsp;</td>
	<td width="2%"><input type="radio" value="credit" name="radio_credit" checked="checked" />&nbsp;</td>
	<td width="10%">Credit&nbsp;</td>
	<td width="2%"><input type="radio" value="no-credit" name="radio_credit"  />&nbsp;</td>
	<td width="73%">No Credit&nbsp;</td>
	</tr>
	<tr>
	<td align="right">&nbsp;</td>
	<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
	<td align="right">&nbsp;Select Category:</td>
	<td colspan="4">
	<select id="category_id" name="category_id">
	<option value="">Select Category</option>
	<?php
	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM course_categories");
	while($db->getRows())
	{
		echo $category_id = $db->row("category_id");
		$category_name = $db->row("category_name");
		?>
		<option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
		<?php
		}	
	$db->close();		  
	?>
	</select>
	</td>
	</tr>
	<tr>
	<td align="right">&nbsp;</td>
	<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
	<td align="right">&nbsp;</td>
	<td colspan="4"><input name="submit" type="submit" value="Submit" />&nbsp;</td>
	</tr>
	</table>
	</form>
	<?php
	}else{
	$db = new db;
	$db->connect();
	$str="select ID from course where ID=(select MAX(ID) from course)";
	$db->query($str);
	$fileno=0;
	while($db->getRows()){
		$p =$db->row("ID");
		$fileno=str_replace("course-","",$p);
	}
	$fileno=$fileno+1;
	$courseid="course-".$fileno;
	
	//echo $courseid;
	
	//echo "Type: " . $_FILES["file"]["type"] . "hello<br />";
	if ($_FILES["file"]["type"]=="application/octet-stream" || $_FILES["file"]["type"]=="application/zip" || $_FILES["file"]["type"]=="application/x-zip-compressed"){
		if ($_FILES["file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}else{
			
			if(!file_exists("../uploadfiles"))
				mkdir("uploadfiles",0777);
			/*if(!file_exists("uploadfiles/".$_POST['cn']))
				mkdir("uploadfiles/".$_POST['cn'],0777);*/
			
			if (file_exists("../uploadfiles/". basename($_FILES["file"]["name"],".zip"))){
				echo '<strong>'.$_FILES["file"]["name"] . " already exists.</.strong> ";
				}else{
				move_uploaded_file($_FILES["file"]["tmp_name"],"../uploadfiles/". $_FILES["file"]["name"]);
				$file420 = $_FILES["file"]["name"];
				
				//$file = getcwd() . "uploadfiles".$_FILES['file']['name'];
				//echo $file;
				// Or:
				$file = $_SERVER['DOCUMENT_ROOT'].'/LMS/uploadfiles/'.$_FILES['file']['name'];
				
				
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
				$file1 = "../uploadfiles/".$courseid;
				//die($file1);
				if(!file_exists($file1))
					mkdir($file1,0777);
				//chdir($file1);
				
				// $zip = new dUnzip2($file);
				// $zip->unzipAll($file1);
				//@unlink($file);
				$zip = new ZipArchive();
				$x = $zip->open($file);
				if ($x === true) {
					$zip->extractTo($file1); // change this to the correct site path
					$zip->close();
					
					unlink($file);
				}
				//die( getcwd()); 
				// 
				//..............function ends here..................//
				
				/*---------Checking whether index file within a directory  exist or not starts-------------------*/
				
				$file_dir=$_SERVER['DOCUMENT_ROOT']."/LMS/uploadfiles/".$courseid;
				//$file_jayant_420 = basename($file,".zip");
				//echo $file_jayant_420;
				$dir_name=basename($file_dir);
				$ims_path=1;
				
				function ListFolder($path,$jay420)
				{
					
					//using the opendir function
					$dir_handle = @opendir($path) or die("Unable to open $path");
					
					$path=str_replace($_SERVER['DOCUMENT_ROOT']."/import_test/","",$path);
					
					//echo $path."<br>";
					//Leave only the lastest folder name
					$dirname = end(explode("/", $path));
					//display the target folder.
					//echo ("<li>$dirname\n");
					//echo "<ul>\n";
					while (false !== ($file = readdir($dir_handle)))
					{
						//echo $dir_name;
						$sub_dir = substr(strrchr($path, "/"), 1);
						//echo $dir."hii"."<br>";
						
						if($file!="." && $file!="..")
						{
							if (is_dir($path."/".$file))
							{
								//Display a list of sub folders.
								//ListFolder($path."/".$file,$jay420);
							}
							else
							{
								//Display a list of files.
								if(preg_match("/imsmanifest/i",$file,$matches) ){
									//print_r($matches);
									//echo "Filename: <a href = 'html/$file'  target = '_blank'>$file</a><BR>";
									//$res = 0;
									
									//echo "<li><a href ='uploadfiles/".$jay420."/sco/".trim($sub_dir)."/".trim($file)."' >".trim($file)."</a></li>";
									//echo "<li><a href ='".$path."/".trim($file)."' >".trim($file)."</a></li>";
									
									global $ims_path;
									$ims_path=$path."/".trim($file);
									
									
								}
								
							}
						}
						
					}
					//echo "</ul>\n";
					//echo "</li>\n";
					
					//closing the directory
					closedir($dir_handle);
				}
				
				//echo '<ul class="dmxtree" id="FolderView">';
				ListFolder($file_dir,$file_jayant_420);
				//echo $ims_path."hiii";
				$manifest_path=$ims_path;
				
				//echo '</ul>';
				
				/*------checking for index file ends here-------------*/
				//echo $file_store."hello";
				
				/*............ code to read the imsmanifest.xml file from the uploaded folder......*/
				/*...code to read title tag in imsmanifest.xml file....*/
				// DOMElement->getElementsByTagName() -- Gets elements by tagname 
				// nodeValue : The value of this node, depending on its type. 
				// Load XML File. You can use loadXML if you wish to load XML data from a string 
				
				$objDOM = new DOMDocument(); 
				//$path=$_SERVER['DOCUMENT_ROOT']."/LMS/admin/uploadfiles/".basename($file,".zip")."/sco/imsmanifest.xml";
				// $path1=$manifest_path;
				//echo $manifest_path."hello";
				
				// echo $path1;
				
				$objDOM->load("$manifest_path"); //make sure path is correct 
				
				
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
					//echo "$task :: $detail :: $detail1 <br>"; 
					} 
				
				
				/*.....end reading title......*/
				/*... insert values realted to course and resourses into database....*/
				$sitemap=new SimpleXMLElement("$manifest_path",null,true);      
				$studentid=$_SESSION['student_id'];
				$z=0;
				$scormversion="";
				$course_title="";
				$catalog_entry="";
				$descript="";
				$keyword="";
				$catalog_name="";
				/*-----------------------Metadata entry----------------------------------------*/
				function displayChildrenRecursive1($xmlObj,$depth=0) {
					
					global $scormversion,$courseid,$course_title,$catalog_entry,$descript,$keyword,$catalog_name;
					foreach($xmlObj->children() as $child) {
						
						
						if($child->getName()=="general"){
							
							foreach($child->children() as $x)
								{					
								if($x->getName()=="title"){
									
									foreach($x->children() as $x1)
										$course_title=$x1;
									//echo $x1;
									}	
								
								if($x->getName()=="catalogentry"){
									//echo " CatalogEntry==";
									foreach($x->children() as $x1){
										if($x1->getName()=="catalog"){
											$catalog_name=$x1;
										}
										if($x1->getName()=="entry")
										{
											foreach($x1->children() as $e)
												$catalog_entry=$e;
											}						
										
									}
								}
								if($x->getName()=="description"){
									//echo "  Description==".$x;
									foreach($x->children() as $x1){
										//echo $x1;	
										$descript=$x1;
									}
								}
								if($x->getName()=="keyword"){
									//echo " Keywords==";
									foreach($x->children() as $x1){
										//echo $x1;
										if($keyword==""){
											$keyword=$x1;
										}
										else{
											$keyword=$keyword.",".$x1;
										}
										
									}
									
								}
								
								}	
							//echo $qry_meta;
							$qry_meta='insert into course_metdata_info set course_id="'.$courseid.'",version="'.$scormversion.'",title="'.$course_title.'",description="'.$descript.'",catalogentry="'.$catalog_entry.'",keywords="'.$keyword.'",catalogname="'.$catalog_name.'"';						
							$db=new db;
							$db->connect();
							$db->query($qry_meta);		
							
							
						}
						
						displayChildrenRecursive1($child,$depth+1);
						}   
				}
				/*-----------------------Metadata Entry Ends..................................*/
				function displayChildrenRecursive($xmlObj,$depth=0) {
					global $courseid,$z,$manifest_path,$scormversion;
					global $course_title,$catalog_entry,$descript,$keyword,$catalog_name;
					//$z=0;
					foreach($xmlObj->children() as $child) {
						
						$pre=$child->children("http://www.adlnet.org/xsd/adlcp_rootv1p2");
						$prerequisites=$pre->prerequisites;
						$masteryscore=$pre->masteryscore;
						$timelimit=$pre->timelimitaction;
						$maxtime=$pre->maxtimeallowed;
						$data_from_lms=$pre->datafromlms;
						$metapath=$_SERVER['DOCUMENT_ROOT']."/LMS/uploadfiles/".$courseid."/".$pre->location;
						
						if($child->getName()=="metadata"){
							foreach($child->children() as $p){
								if($p->getName()=="schemaversion"){
									//echo "<br>"."Scorm version==".$p;	
									$scormversion=$p;
									}	
								}	
						}
						if($pre->location !=""){
							//echo $metapath."--";
							$sitemap1=new SimpleXMLElement($metapath,null,true);
							displayChildrenRecursive1($sitemap1);
							}	
						
						//Metadata entry starts here...........
						if($child->getName()=="general")
						{
							foreach($child->children() as $k){
								if($k->getName()=="title")
								{
									foreach($k->children() as $d){
										$course_title=$d;
									}
								}
								if($k->getName()=="description")
								{
									foreach($k->children() as $d){
										$descript=$d;
									}
								}
								if($k->getName()=="catalogentry")
								{
									foreach($k->children() as $d){
										if($d->getName()=="catalog"){
											$catalog_name=$d;
										}
										foreach($d->children() as $s){
											$catalog_entry=$s;						
										}
									}
								}
								if($k->getName()=="keyword"){
									foreach($k->children() as $f){
										if($keyword==""){
											$keyword=$f;
										}
										else{
											$keyword=$keyword.",".$f;
										}
									}
								}
							}
							$qry_meta1='insert into course_metdata_info set course_id="'.$courseid.'",version="'.$scormversion.'",title="'.$course_title.'",description="'.$descript.'",catalogentry="'.$catalog_entry.'",keywords="'.$keyword.'",catalogname="'.$catalog_name.'"';						
							$db=new db;
							$db->connect();
							$db->query($qry_meta1);	
							
						}
						//Metadata entry ends here..........
						if($child->getName()=="item" ){
							
							foreach($child->children() as $x)
							{
								if($x->getName()=="title")
									$title=$x;								
								//echo "<br>"."::::".$x->getName()."::::::-->".$x;
								}	
							$objDOM = new DOMDocument(); 
							$objDOM->load("$manifest_path"); //make sure path is correct 
							
							$note1=$objDOM->getElementsByTagName("resource");
							foreach($note1 as $value2)
							{
								$task1=$value2->getAttribute("identifier");
								$task2=$value2->getAttribute("type");
								$task3=$value2->getAttribute("adlcp:scormtype");
								$task4=$value2->getAttribute("href");
								
								if($task1==$child["identifierref"])
								{
									$resourceid=$task1;
									$scotype=$task3;
									$launch=$task4;
									$webtype=$task2;
									
								}
								if($child["identifierref"]==''){
									$launch='';
									$scotype='';
									}							
								
								
							}
							$sco_id=$child["identifier"];
							$title=$title;
							$sequence=$z;
							$lesson_status="not attempted";
							$exit='';
							$entry='ab-initio';
							$masteryscore=$masteryscore;
							$prerequisites=$prerequisites;
							$max_time=$maxtime;
							$timelimit=$timelimit;	
							
							$insrt="insert into item_info set course_id='".$courseid."',identifier='".$sco_id."',type='".$scotype."'";
							$insrt.=",title='".$title."',launch='".$launch."',prerequisites='".$prerequisites."',masteryscore='".$masteryscore."',";
							$insrt.="maximumtime='".$max_time."',data_from_lms='".$data_from_lms."',cmi_credit='".$_POST['radio_credit']."',timelimitaction='".$timelimit."',sequence=".$z;
							//echo $insrt;
							$db=new db;
							$db->connect();
							$db->query($insrt);
							//echo $insrt."<br><br>";
							/*$insrt="insert into crab_course_info set course_id='".$courseid."',identifier='".$child["identifier"]."',resource_ref='".$child["identifierref"]."',";
							$insrt.="title='".$title."',sequence=".$z;						
							$str="insert into user_sco_info set user_id=0,course_id='".$courseid."'";
							$str.=",sco_id='".$child["identifier"]."',lesson_status='not attempted',sco_exit='',sco_entry='ab-initio',masteryscore='".$masteryscore;
							$str.="',prerequisite='".$prerequisites."',maximumtime='".$maxtime."',timelimitaction='".$timelimit."',sequence=".$z;
							echo "<br>update user_sco_info set identifierref='".$child["identifierref"]."' where sco_id='".$child["identifier"]."'<br>";
							echo "$str"."<br><br>";*/
							$z++;													
							
						}
						
						displayChildrenRecursive($child,$depth+1);
						}   
				}
				
				displayChildrenRecursive($sitemap);
				/*.... INSERTION OF RECORDS ENDS HERE....*/						
				/*..............end reading imsmanifest.xml file....................*/
				
				
				//$file1=$file420;
				$qry_metadata="select * from course_metdata_info where course_id='".$courseid."'";
				$db->connect();
				$db->query($qry_metadata);
				while($db->getRows()){
					$sco_version=$db->row("version");
					$keyword=$db->row("keywords");
					$desc=$db->row("description");
					$catalog_name=$db->row("catalogentry");
					$catalog_entry=$db->row("catalogentry");
					$catalog_name=$db->row('catalogname');
					break;
				}
				
				$courseid1 = $_POST["courseid"];
				$db->connect();	
				
				//$str="insert into crab_lessons set course_id='".$courseid."',lesson_name='".$file1."',folder_name='".$_POST['cn']."/".$file1."',file_name='".$filename."',date_of_creation='".date('m/d/y'."'");
				$str='insert into course set created="'.date("m/d/y").'",name="'.$task.'",type="wbt",course_type="'.$_POST['course_type'].'",folder_name="/LMS/uploadfiles/'.$courseid.'",course_id="'.$courseid.'",cmi_credit="'.$_POST['radio_credit'].'",sco_version="'.$sco_version.'",keyword="'.$keyword.'",description2="'.$desc.'",catalog_name="'.$catalog_name.'",catalog_entry="'.$catalog_entry.'",link="", category_id='.$_POST['category_id'].'';
				
				//echo $str;
				
				$db->query($str);
				
				echo "<script>alert('The course content has been successfuly imported.');</script>";									
				//echo "<script> window.close();";
				echo "<script>window.close();if (window.opener && !window.opener.closed) { window.opener.parent.location.reload(); } </script>";
				
				
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
	$courseid1 = $_GET["id"];
else
$courseid1 = $_POST["courseid"];

//include("listcourse.php");
?>				 				 
<!--  the code to display the listing ends.	-->
</td></tr></table>
</body>
</html>