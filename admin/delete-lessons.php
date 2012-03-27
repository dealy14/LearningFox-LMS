<?php
include("../conf.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body bgcolor="#EFF7FF">
<?php
$str="delete from course where id=".$_GET['ref'];
$db=new db;
$db->connect();
$db->query($str);
$file_dir=$_SERVER['DOCUMENT_ROOT']."/lms/demo_site/uploadfiles/".$_GET['fn'];		
//echo $file_dir;												
function SureRemoveDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }
    if ($DeleteMe){
        closedir($dh);
        @rmdir($dir);
    }
}

SureRemoveDir($file_dir,true);	

?>
<div style="margin:20px; font-family:Verdana; font-size:12px"> Lesson Deleted.</div>
</body>
</html>
