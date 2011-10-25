<?php
require("../conf.php");
?>
<head>
<script language="javascript" type="text/javascript">
function htmlData()
{
	if (window.XMLHttpRequest)
		xmlHttp=new XMLHttpRequest();
	else if (window.ActiveXObject)
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")
url="calc_time.php"+"?user_id="+"<?php echo $_GET['user_id'];?>"+"&course="+"<?php echo $_GET['ref'];?>";
//alert(url);

xmlHttp.open("GET",url,true) ;
xmlHttp.send(null);
//alert('hllo');
}
//htmlData();
</script>
<script language="javascript1.2" type="text/javascript">
function test()
{
	alert("hello");
	window.location.href="calc_time.php";
}
</script>
<title>LMS</title>
</head>
<body onLoad="htmlData();"  onunload="htmlData();">
<!--onunload="javascript:document.forms[0].submit();" -->
<form action="calc_time.php?status=1" method="post" onSubmit="javascript:test();">
<input type="hidden" name="end_date" value="<?php echo date("H:i:s");?>" />

<?php

###########################################
# Start timing code
###########################################
$start_time_hr=date("h");
$start_time_min=date("i");
$start_time_sec=date("s");
$_SESSION['start_time']=$start_time_hr.":".$start_time_min.":".$start_time_sec;
echo $_SESSION['start_time'];
echo $_SESSION['lesson_status'];
$db = new db;
$db->connect();
$str="select folder_name from course where ID=".$_GET['ref'];
$db->query($str);
$db->getRows();
$file_dir=$_SERVER['DOCUMENT_ROOT'].$db->row("folder_name");

													$file_jayant_420 = basename($file,".zip");
													echo $file_jayant_420;
													$dir_name=basename($file_dir);
													
													function ListFolder($path,$jay420)
													{
														//using the opendir function
														$dir_handle = @opendir($path) or die("Unable to open $path");
													 
														$path=str_replace($_SERVER['DOCUMENT_ROOT']."/lms/demo_site/","",$path);													
														//Leave only the lastest folder name
														$dirname = end(explode("/", $path));
														//display the target folder.
														echo ("<li>$dirname\n");
														echo "<ul>\n";
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
																	ListFolder($path."/".$file,$jay420);
																}
																else
																{
																	//Display a list of files.
												if(preg_match("/htm/i",$file,$matches) || preg_match("/php/i",$file,$matches)){
												
												/*---code to get the title of  file------*/
												$title="";
												$fp=fopen($path."/".trim($file),"r");
												while(!feof($fp)){
												$read=fgets($fp,4096);
												if(stristr($read,"<title>")){
												$title=strip_tags($read);
												}
												
												
												}
												/*-----code ends--------*/
																		
							echo "<li><a href ='".$path."/".trim($file)."' target='Content' >".$file."</a></li>";

																		//exit();
																	}else{
																			if(preg_match("/jpg/i",$file,$matches)||preg_match("/gif/i",$file,$matches)){
																			//echo "<li><a target='Content' href ='".$path."/".trim($file)."' >".trim($file)."</a></li>";
																			}	
																		}
																	
																}
															} 
														}
														echo "</ul>\n";
														echo "</li>\n";
														//closing the directory
														closedir($dir_handle);
													}
													echo '<ul class="dmxtree" id="FolderView">';
													ListFolder($file_dir,$file_jayant_420);
													echo '</ul>';
													
													//echo "listing".$_GET['ref'].$_GET['user_id'];
																			?>																	
																			</body>