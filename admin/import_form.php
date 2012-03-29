<?php
session_start();
include("../conf.php");
include("dUnzip2.inc.php");

//echo $upload_max_filesize=ini_get("upload_max_filesize");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Course Import Form</title>
<style type="text/css">
td.class1{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#990033;
	background:#99CCFF;
	font-weight:900;
}
</style>
<style type="text/css" >
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
</style>
<script type="text/javascript">
function validChk(frm){
	var errors = "";
	
	if(frm.file.value==''){
		errors += "Please specify the course content (Zip file).\n";
	}
	if(frm.category_id.value==''){
		errors += "Please select a category for the course.\n";
	}
	
	if ("" == errors){
		frm.submit.value='Uploading...';
		frm.submit.disabled=true;
		document.getElementById("ulmsg").style.display ="";
		return true;
	}
	else{
		alert(errors);
		return false;
	}
	
	//if inputs are valid, then:
	
}
</script>
</head>
<body bgcolor="#EFF7FF">
<?php
$uploadpath = $main_dir . 'uploadfiles';
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
	<td colspan="5" align="left">Do you want to credit the course? (Mandatory element for SCORM 1.2) </td>
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
	<td width="2%"><input type="radio" id="creditradio" value="credit" name="radio_credit" checked="checked" />&nbsp;</td>
	<td width="10%"><label for="creditradio">Credit&nbsp;</label></td>
	<td width="2%"><input type="radio" id="nocreditradio" value="no-credit" name="radio_credit"  />&nbsp;</td>
	<td width="73%"><label for="nocreditradio">No Credit&nbsp;</label></td>
	</tr>
	<tr>
	<td align="right">&nbsp;</td>
	<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
	<td align="right">&nbsp;Select Category:</td>
	<td colspan="4">
	<?php
	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM course_categories");
	if ($db->getRowCount()==0) 
		trigger_error("The course categories table must have at least one record.",E_USER_ERROR);
	?>
	<select id="category_id" name="category_id">
	<option value="">Select Category</option>
	<?php
	while($db->getRows())
	{
		$category_id = $db->row("category_id");
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
		<td colspan="4"><input id="submit" name="submit" type="submit" value="Submit"/>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="left"><span id="ulmsg" style="display:none;"><b>Please be patient while your file is being uploaded. This may take several minutes.</b></span></td>
	</tr>
	</table>
	</form>
	<?php
	}
else {
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
	if ($_FILES["file"]["type"]=="application/octet-stream" || 
			$_FILES["file"]["type"]=="application/zip" || 
			$_FILES["file"]["type"]=="application/x-zip-compressed"){

		if ($_FILES["file"]["error"] > 0) {
				trigger_error('Unable to access the file you uploaded.', E_USER_ERROR);
				//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
		else {
			if(!file_exists($uploadpath))
				mkdir($uploadpath,0777);
			  
			  /*if(!file_exists("uploadfiles/".$_POST['cn']))
				mkdir("uploadfiles/".$_POST['cn'],0777);*/
			
			if (file_exists($uploadpath . '/'. basename($_FILES["file"]["name"],".zip"))){
				$error_string = $_FILES["file"]["name"] . " already exists.";
				echo '<strong>'.$error_string.'</.strong>';
				error_log($error_string, E_ERROR);
			}
			else {
				move_uploaded_file($_FILES["file"]["tmp_name"],$uploadpath . '/'. $_FILES["file"]["name"]);
				$file420 = $_FILES["file"]["name"];
				
				//$file = getcwd() . "uploadfiles".$_FILES['file']['name'];
				//echo $file;
				// Or:
				$file = $uploadpath . '/'.$_FILES['file']['name'];
 
				$file1 = $uploadpath . '/'.$courseid;
				//die($file1);
				if(!file_exists($file1))
					mkdir($file1,0777);
				//chdir($file1);

				try{
					$zip = new ZipArchive();
					$x = $zip->open($file);
					$zip->extractTo($file1); // change this to the correct site path
					$zip->close();
					unlink($file);				
				}
				catch (Exception $e) {
  					 error_log($e->getMessage(), E_ERROR);
					 trigger_error("Unable to open or extract the uploaded ZIP archive.", E_USER_ERROR);
				}
				
				/*---------Checking whether index file within a directory  exist or not starts-------------------*/

				$file_dir=$uploadpath . '/'.$courseid;
				//$file_jayant_420 = basename($file,".zip");
				//echo $file_jayant_420;
				$dir_name = basename($file_dir);
				$ims_path = 1;

				//echo '<ul class="dmxtree" id="FolderView">';
				ListFolder($file_dir,$file_jayant_420);

				//echo $ims_path."hiii";
				$manifest_path=$ims_path;
				
				//determine whether manifest actually found; if not, trigger an error
				if(!preg_match("/imsmanifest/i",$manifest_path)){
					trigger_error('Unable to find or load the course manifest.', E_USER_ERROR);
				}
				
				//echo '</ul>';
				
				/*------checking for index file ends here-------------*/
				//echo $file_store."hello";
				
				/*............ code to read the imsmanifest.xml file from the uploaded folder......*/
				try{
					$objDOM = new DOMDocument(); 
					// echo $path1;
					$objDOM->load("$manifest_path");	//make sure path is correct 
					
					$note = $objDOM->getElementsByTagName("organizations"); 
					
					// for each note tag, parse the document and get values for 
					// tasks and details tag. 
					foreach($note as $value ) { 
						$tasks = $value->getElementsByTagName("title"); 
						$task  = $tasks->item(0)->nodeValue; 
						$details = $value->getElementsByTagName("item"); 
						$detail  = $details->item(0)->nodeValue; 
						$course_name=$task;
						//echo "$task :: $detail :: $detail1 <br>"; 
					} 
				}
				catch (Exception $e){
					error_log($e->getMessage(), E_ERROR);
					trigger_error("Unable to process the course manifest file.", E_USER_ERROR);
				}
				
				/*... insert values related to course and resourses into database....*/

				try{
					$sitemap = new SimpleXMLElement("$manifest_path",null,true);	
				}
				catch (Exception $e){
					error_log($e->getMessage(), E_ERROR);
					trigger_error("Unable to process the course manifest file.", E_USER_ERROR);
				}
				
				$studentid = $_SESSION['student_id'];
				$z = 0;
				$scormversion = "";
				$course_title = "";
				$catalog_entry = "";
				$descript = "";
				$keyword = "";
				$catalog_name = "";

				/*-----------------------Metadata Entry Ends..................................*/

				displayChildrenRecursive($sitemap);

				/*.... INSERTION OF RECORDS ENDS HERE....*/						
				/*..............end reading imsmanifest.xml file....................*/

				//$file1=$file420;
				try{
					$qry_metadata="select * from course_metdata_info where course_id='".$courseid."'";
					$db->connect();
					$db->query($qry_metadata);
				}
				catch (Exception $e){
					error_log($e->getMessage(), E_ERROR);
					trigger_error("Unable to load course metadata from LMS database.", E_USER_ERROR);
				}
				try{
					while($db->getRows()){
						$sco_version=$db->row("version");
						$keyword=$db->row("keywords");
						$desc=$db->row("description");
						$catalog_name=$db->row("catalogentry");
						$catalog_entry=$db->row("catalogentry");
						$catalog_name=$db->row('catalogname');
						break;
					}
				}
				catch (Exception $e){
					error_log($e->getMessage(), E_ERROR);
					trigger_error("Unable to process course metadata from LMS database.", E_USER_ERROR);
				}
				
				try{
					$courseid1 = $_POST["courseid"];
					$db->connect();
				
				//$str="insert into crab_lessons set course_id='".$courseid."',lesson_name='".$file1."',folder_name='".$_POST['cn']."/".$file1."',file_name='".$filename."',date_of_creation='".date('m/d/y'."'");
				//$str='insert into course set created="'.date("m/d/y").'",name="'.$task.'",type="wbt",course_type="'.$_POST['course_type'].'",folder_name="/LMS/uploadfiles/'.$courseid.'",course_id="'.$courseid.'",cmi_credit="'.$_POST['radio_credit'].'",sco_version="'.$sco_version.'",keyword="'.$keyword.'",description2="'.$desc.'",catalog_name="'.$catalog_name.'",catalog_entry="'.$catalog_entry.'",link="", category_id='.$_POST['category_id'].'';
					$str = sprintf("INSERT INTO course (created, name, type, course_type, ".
								"folder_name, course_id, cmi_credit, sco_version, keyword, ".
								"description2, catalog_name, catalog_entry, link, category_id) " .
							   "VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', ".
							   "'%s', '%s', '%s', '%s')",
							   date('m/d/y'), $db->escape_string($task), 'wbt', 
							   $db->escape_string($_POST['course_type']), 
							   $db->escape_string($uploadpath . '/'.$courseid), 
							   $db->escape_string($courseid), 
							   $db->escape_string($_POST['radio_credit']), 
							   $db->escape_string($sco_version), $db->escape_string($keyword), 
							   $db->escape_string($desc),  $db->escape_string($catalog_name), 
							   $db->escape_string($catalog_entry), '', 
							   $db->escape_string($_POST['category_id']));
					//echo $str;
					
					$db->query($str);
				}
				catch (Exception $e){
					error_log($e->getMessage(), E_ERROR);
					trigger_error("Unable to insert course into LMS database.", E_USER_ERROR);
				}
				
				echo "<script>alert('The course content has been successfuly imported.');</script>";									
				//echo "<script> window.close();";
				echo "<script>window.close();if (window.opener && !window.opener.closed) { window.opener.parent.location.reload(); } </script>";
			}
		 }
		}
		else{
			echo '<strong>The course content file should be in the zip format.</strong>';
			error_log("Attempt to import a non ZIP-file as a course", E_ERROR);
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

<?php
#######################################
## Function Definitions
#######################################

/*-----------------------Metadata entry----------------------------------------*/
function displayChildrenRecursive1($xmlObj,$depth=0) {
	global $scormversion,$courseid,$course_title,$catalog_entry,$descript,$keyword,$catalog_name;
	
	foreach($xmlObj->children() as $child) {
		if($child->getName()=="general"){
  		   try{
			foreach($child->children() as $x){					
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
						if($x1->getName()=="entry"){
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
		  }
		  catch (Exception $e){
		  	error_log($e->getMessage(),E_ERROR);
			trigger_error("Unable to process course manifest entries.", E_USER_ERROR);
		  }
		  
			//echo $qry_meta;
			//$qry_meta='insert into course_metdata_info set course_id="'.$courseid.'",version="'.$scormversion.'",
			//title="'.$course_title.'",description="'.$descript.'",catalogentry="'.$catalog_entry.'",
			//keywords="'.$keyword.'",catalogname="'.$catalog_name.'"';						
			try{
				$db=new db;
				$db->connect();
				$qry_meta=sprintf("insert into course_metdata_info (course_id, version, ".
								"title, description, catalogentry, keywords, catalogname) " .
								"VALUES('%s', '%s', '%s', '%s', '%s','%s', '%s')", 
				$db->escape_string($courseid), $db->escape_string($scormversion), 
				$db->escape_string($course_title), $db->escape_string($descript), 
				$db->escape_string($catalog_entry), $db->escape_string($keyword), 
				$db->escape_string($catalog_name));
				$db->query($qry_meta);
			}
			catch (Exception $e){
				error_log($e->getMessage(),E_ERROR);
				trigger_error("Unable to insert course information into the LMS database.", E_USER_ERROR);
			}
		}
		
		displayChildrenRecursive1($child,$depth+1);
		}   
}


function displayChildrenRecursive($xmlObj,$depth=0) {
	global $uploadpath;
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
		$metapath=$uploadpath .'/'.$courseid."/".urldecode($pre->location);
				
		if($child->getName()=="metadata"){
			try{
			  foreach($child->children() as $p){
				if($p->getName()=="schemaversion"){
					//echo "<br>"."Scorm version==".$p;	
					$scormversion=$p;
					}	
				}
			}
			catch (Exception $e){
				error_log($e->getMessage(),E_ERROR);
				trigger_error("Failed to process Scorm version from manifest.",E_USER_ERROR);
			}
		}
		if($pre->location !=""){
			$metapath = str_replace("\\", "/", $metapath);
			// echo $metapath."--";
			try{
				$sitemap1 = new SimpleXMLElement($metapath, null, true);
			}
			catch (Exception $e){
				error_log($e->getMessage(), E_ERROR);
				trigger_error("Unable to parse course metadata manfest.", E_USER_ERROR);
			}
			displayChildrenRecursive1($sitemap1);
		}	
		
		//Metadata entry starts here...........
		if($child->getName()=="general")
		{
		  try{

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
		  }
		  catch (Exception $e){
		  	error_log($e->getMessage(),E_ERROR);
			trigger_error("Unable to process course manifest entries.", E_USER_ERROR);
		  }
			//$qry_meta1='insert into course_metdata_info set course_id="'.$courseid.'",version="'.$scormversion.'",title="'.$course_title.'",description="'.$descript.'",catalogentry="'.$catalog_entry.'",keywords="'.$keyword.'",catalogname="'.$catalog_name.'"';	
								
		  try{
			$db=new db;
			$db->connect();
			
			$qry_meta1=sprintf("insert into course_metdata_info (course_id, version, ".
								"title, description, catalogentry, keywords, catalogname) " .
								"VALUES('%s', '%s', '%s', '%s', '%s','%s', '%s')", 
					$db->escape_string($courseid), $db->escape_string($scormversion), 
					$db->escape_string($course_title),$db->escape_string($descript), 
					$db->escape_string($catalog_entry), $db->escape_string($keyword), 
					$db->escape_string($catalog_name));
			$db->query($qry_meta1);
		  }
		  catch (Exception $e){
				error_log($e->getMessage(),E_ERROR);
				trigger_error("Unable to insert course information into the LMS database.", E_USER_ERROR);
		  }
		}
		
		//Metadata entry ends here..........
		
		if($child->getName()=="item" ){
			
			foreach($child->children() as $x)
			{
				if($x->getName()=="title")
					$title=$x;								
				//echo "<br>"."::::".$x->getName()."::::::-->".$x;
				}	
			try{
			
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
			}
			catch (Exception $e){
				error_log($e->getMessage(), E_ERROR);
				trigger_error("Unable to load resource within course upload.", E_USER_ERROR);
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
			
			// $insrt="insert into item_info set course_id='".$courseid."',identifier='".$sco_id."',type='".$scotype."'";
			// $insrt.=",title='".$title."',launch='".$launch."',prerequisites='".$prerequisites."',masteryscore='".$masteryscore."',";
			// $insrt.="maximumtime='".$max_time."',data_from_lms='".$data_from_lms."',cmi_credit='".$_POST['radio_credit']."',timelimitaction='".$timelimit."',sequence=".$z;
		 try{
			$db=new db;
			$db->connect();
			$insrt=sprintf("INSERT INTO item_info (course_id, identifier, type, ".
							"title, launch, prerequisites, masteryscore, maximumtime, ".
							"data_from_lms, cmi_credit, timelimitaction, sequence) " .
					"VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d)",
			$db->escape_string($courseid), $db->escape_string($sco_id), $db->escape_string($scotype),
			$db->escape_string($title), $db->escape_string($launch), $db->escape_string($prerequisites),
			$db->escape_string($masteryscore), $db->escape_string($max_time), $db->escape_string($data_from_lms),
			$db->escape_string($_POST['radio_credit']), $db->escape_string($timelimit), $z);
			//echo $insrt;
			$db->query($insrt);
		  }
		  catch (Exception $e){
				error_log($e->getMessage(),E_ERROR);
				trigger_error("Unable to insert course item data ($title) into the LMS database.", E_USER_ERROR);
		  }
			//echo $insrt."<br><br>";
			$z++;													
		}
		displayChildrenRecursive($child,$depth+1);
	}
}

function ListFolder($path,$jay420)
{
	//using the opendir function
	if (false == ($dir_handle = opendir($path))){
		trigger_error("Unable to open a portion of the course data.", E_USER_ERROR);
	}
	$path = str_replace($_SERVER['DOCUMENT_ROOT']."/import_test/","",$path);
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
		
		if($file!="." && $file!="..") {
			if (is_dir($path."/".$file)) {
				//Display a list of sub folders.
				//ListFolder($path."/".$file,$jay420);
			}
			else {
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
?>