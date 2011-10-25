<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <title>Untitled</title>
</head>

<body BGCOLOR="#336699">
<?php
$action = $_REQUEST['action'];

if($action=="topic")
{
    insertAction($object_sql["full_topic_insert"]);
    echo"<SCRIPT>top.window.opener.objReload('topic');window.close();</SCRIPT>";
}

if($action=="lesson")
{
    insertAction($object_sql["full_lesson_insert"]);
    echo"<SCRIPT>top.window.opener.objReload('lesson');window.close();</SCRIPT>";
}

if($action=="course" && $type=="wbt")
{
    insertAction($object_sql["full_wbtcourse_insert"]);
    echo"<SCRIPT>top.window.opener.objReload('course');window.close();</SCRIPT>";
}

if($action=="objective")
{
    insertAction($object_sql["objective_insert"]);
    echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="ref")
{
    insertAction($object_sql["ref_insert"]);
    echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="group")
{
    $name = $_REQUEST['name'];
    $sname = $_REQUEST['sname'];
    insertAction("INSERT INTO groups (name,sname)VALUES('$name','$sname')");
    echo"<SCRIPT>top.window.opener.objReload();window.close();</SCRIPT>";
}

if($action=="subgroup")
{
    $sub_name = $_REQUEST['sub_name'];
    $sub_sname = $_REQUEST['sub_sname'];
    $group_ID = $_REQUEST['group_ID'];
    insertAction("INSERT INTO subgroups (sub_name,sub_sname,group_ID)VALUES('$sub_name','$sub_sname','$group_ID')");
    echo"<SCRIPT>top.rmain.details.edit_main.location.reload();</SCRIPT>";
}

if($action=="test")
{
    $name = $_REQUEST['name'];
	$type = $_REQUEST['type'];
    insertAction("INSERT INTO tests (name,type,randomize)VALUES('$name','$type','N')");
    echo"<SCRIPT>top.window.opener.objReload();window.close();</SCRIPT>";
}

if($action=="question")
{
    $question = $_REQUEST['question'];
	$qname = $_REQUEST['qname'];
	$question_type = $_REQUEST['question_type'];
	$choice_1 = $_REQUEST['choice_1'];
	$choice_2 = $_REQUEST['choice_2'];
	$choice_3 = $_REQUEST['choice_3'];
	$choice_4 = $_REQUEST['choice_4'];
	$correct_answ = $_REQUEST['correct_answ'];
   
    insertAction("INSERT INTO questions (question,qname,question_type,choice_1,choice_2,choice_3,choice_4,correct_answ) VALUES ('$question','$qname','$question_type','$choice_1','$choice_2','$choice_3','$choice_4','$correct_answ')");
    echo"<SCRIPT>top.window.opener.objReload();window.close();</SCRIPT>";
}


?>
<!--tester-->

</body>
</html>
