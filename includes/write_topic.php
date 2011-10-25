<?php
require_once("../conf.php");
if($content_location=="remote")
{
$html="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html>\n<head>\n<title>LearningTrak</title>\n<BODY onLoad=\"document.location.href='$content_link';\">\n</BODY>\n</HTML>";
to_file($dir_topics.$ID,$html,"w+");
}
else if($topic_type=="test" && $test_link!="")
{
include($dir_includes."quiz_modules/1.php");
}
else if($topic_type=="wireless survey" && $test_link!="")
{
include($dir_includes."quiz_modules/2.php");
}
else 
{
$html="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html>\n<head>\n<title>LearningTrak</title>\n</head>\n<BODY TOPMARGIN=0 LEFTMARGIN=0 RIGHTMARGIN=0>".nl2br($content)."</BODY>\n</HTML>";
to_file($dir_topics.$ID,$html,"w+");
}
?>
