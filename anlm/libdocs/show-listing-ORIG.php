<?php
require("../conf.php");
//print $_SERVER['DOCUMENT_ROOT'].'<br />';
$db = new db;
$db->connect();
$str="select folder_name from course where ID=".$_GET['ref'];
//echo $str;
$db->query($str);
$db->getRows();
//print $db->row("folder_name").'<br />';
//die("folder = ". $db->row("folder_name"));
//$file_dir=$_SERVER['DOCUMENT_ROOT']."/lms/admin/uploadfiles/".$db->row("folder_name");

// ->> for iloilo travel code
$file_dir=$_SERVER['DOCUMENT_ROOT'].'/kenneth'.$db->row("folder_name");
// ->> for localhost
//$file_dir=$_SERVER['DOCUMENT_ROOT'].''.$db->row("folder_name");

//$file_dir=$_SERVER['DOCUMENT_ROOT']."/import_test/uploadfiles/".basename($file,".zip");
													$file_jayant_420 = basename($file,".zip");
													echo $file_jayant_420;
													$dir_name=basename($file_dir);
													
													
													function ListFolder($path,$jay420)
													{
													
														//using the opendir function
														$dir_handle = @opendir($path) or die("Unable to open $path");
													 
														//$path=str_replace($_SERVER['DOCUMENT_ROOT']."/lms/admin/","",$path);
														$path=str_replace("/home/iloilotr/public_html/","",$path);
														  //echo $path."<br>";
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
																		//print_r($matches);
																		//echo "Filename: <a href = 'html/$file'  target = '_blank'>$file</a><BR>";
																		//$res = 0;
																		
							//echo "<li><a href ='uploadfiles/".$jay420."/sco/".trim($sub_dir)."/".trim($file)."' >".trim($file)."</a></li>";
							echo "<li><a href ='http://iloilotravel.com/".$path."/".trim($file)."' target='les_tree' >".trim($file)."</a></li>";

																		//exit();
																	}else{
																			if(preg_match("/jpg/i",$file,$matches)||preg_match("/gif/i",$file,$matches)){
																			//echo "<li><a target='les_tree' href ='".$path."/".trim($file)."' >".trim($file)."</a></li>";
																			echo "<li><a target='les_tree' href ='http://iloilotravel.com/".$path."/".trim($file)."' >".trim($file)."</a></li>";
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
																			?>