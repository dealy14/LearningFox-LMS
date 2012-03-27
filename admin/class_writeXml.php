<?php
require_once("../conf.php");
function courseXml($cid,$cname)
{
$rxml.="<tree>\n";
$rxml.="\t<imageList>\n";
$rxml.="\t\t<image name=\"lesson2\" file=\"images/lesson_sm.gif\"/>\n";
$rxml.="\t\t<image name=\"home\" file=\"images/course_tree.gif\"/>\n";
$rxml.="\t</imageList>\n";
$rxml.="\t<root name=\" $course_name\" oImage=\"home\" cImage=\"home\">\n";

$db = new db;
$db->connect();
$db->query("SELECT courses_r.lesson_name,courses_r.lesson_ID FROM courses_r WHERE courses_r.course_ID='$cID' ORDER BY lesson_order ASC");
while($db->getRows())
{ 
$lname = $db->row("lesson_name");
$lID =  $db->row("lesson_ID");
$rxml.="\t<folder name=\" $lname\" auto=\"yes\">\n";
$db2 = new db;
$db2->connect();
$db2->query("SELECT lessons_r.topic_name,lessons_r.topic_ID FROM lessons_r WHERE lessons_r.lesson_ID='$lID' ORDER BY topic_order ASC");
while($db2->getRows()):
$tname = $db2->row("topic_name");
$tID =  $db2->row("topic_ID");
$rxml.="\t\t<leaf name=\" $tname\" image=\"\" link=\"javascript:top.top1.getEdit(top.top1.topicItemSelect,'$tID','topic');\"/>\n";
endwhile;
$rxml.="\t</folder>\n";
}
$rxml.="\t</root>\n";
$rxml.="</tree>";
to_file($dir_xml.$cid."xml",$rxml,"w+");
}
?>