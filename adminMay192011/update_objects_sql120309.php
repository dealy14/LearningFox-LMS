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

/*
print $ID.' === <br />';
print $_REQUEST['action'].'<br />';
print $_POST['formAction'].'<br />';
print_r($_POST);
exit();
*/

###############################################################################
# actions for updating topic properties
###############################################################################
if($action=="topic1" && $formAction=="UPDATE")
{
insertAction($object_sql["topic_update1"]);

include($dir_includes."write_topic.php");
echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}

if($action=="topic2" && $formAction=="UPDATE")
{
include($dir_includes."write_topic.php");
insertAction($object_sql["topic_update2"]);
echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}

/*
if($action=="topic3" && $formAction=="UPDATE")
{
insertAction($object_sql["topic_update3"]);
echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}
*/

if($action=="topic1" && $formAction=="DELETE")
{
unlink($dir_topics.$ID);
insertAction($object_sql["topic_delete"]);
echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}

if($action=="topic2" && $formAction=="DELETE")
{
unlink($dir_topics.$ID);
insertAction($object_sql["topic_delete"]);
echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}

if($action=="topic3" && $formAction=="DELETE")
{
unlink($dir_topics.$ID);
insertAction($object_sql["topic_delete"]);
echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}

###############################################################################
# actions for updating lesson properties
###############################################################################
if($action=="lesson1" && $formAction=="UPDATE")
{
insertAction($object_sql["lesson_update1"]);
echo"<SCRIPT>top.top1.objReload('lesson');window.close();</SCRIPT>";
}

if($action=="lesson1" && $formAction=="DELETE")
{
insertAction($object_sql["lesson_delete"]);
echo"<SCRIPT>top.top1.objReload('lesson');window.close();</SCRIPT>";
echo"<SCRIPT>top.rmain.edit_main.location='blank.php';</SCRIPT>";
}



if($action=="lesson2" && $formAction=="UPDATE")
{

  $rObjects = explode(",",$topicArray);
  $x=0;


   while($x<count($rObjects))
   {
	if($$rObjects[$x]=="enter")
	{
	$j=explode("_",$rObjects[$x]);
	$jnum=$j[1];
	$text_var = "topic_".$jnum."_text";
	insertAction("INSERT INTO lessons_r (lesson_name,lesson_ID,topic_name,topic_ID)VALUES('$lname','$lesson_ID','".$$text_var."','$topicID[$jnum]')");
	//insertAction("INSERT INTO lessons_r (lesson_name,lesson_ID,topic_name,topic_ID,topic_order)VALUES('$lname','$lesson_ID','".$$text_var."','$topicID[$jnum]','')");
	}

  $x++;
  }


echo"<SCRIPT>window.opener.mReload();window.close();</SCRIPT>";
}

if($action=="lesson3" && $formAction=="UPDATE")
{
  $x=0;
  while($x<count($gID))
  {
  insertAction("UPDATE lessons_r set topic_name='$topic_name[$x]',topic_order='$topic_order[$x]' WHERE ID='$gID[$x]'");
  $x++;
  }
echo"<SCRIPT>top.rmain.edit_main.mReload();</SCRIPT>";
}

if($action=="lesson2" && $formAction=="DELETE")
{
insertAction($object_sql["lesson_delete2"]);
echo"<SCRIPT>top.rmain.edit_main.mReload();</SCRIPT>";
}

if($action=="lesson3" && $formAction=="DELETE")
{
$ID=$lesson_ID;
insertAction($object_sql["lesson_delete"]);
echo"<SCRIPT>top.top1.objReload('lesson');window.close();</SCRIPT>";
echo"<SCRIPT>top.rmain.edit_main.location='blank.php';</SCRIPT>";
}

###############################################################################
# actions for updating course properties
###############################################################################
//if($action=="course1" && $formAction=="UPDATE")
if($_REQUEST['action']=="asset1" && $_POST['formAction']=="UPDATE")
{
/*echo "<script>alert('".$_REQUEST['assetnumber']."from update_objects');</script>";*/
$qryup="update efiles set filename='".$_POST['filename']."',sco_version='".$_POST['sco_version']."',description2='".$_POST['description']."',keyword='".$_POST['keyword']."',catalog_entry='".$_POST['catalog_entry']."',catalog_name='".$_POST['catalog_name']."',status='".$_POST['status']."',c_description='".$_POST['c_description']."',purpose='".$_POST['purpose']."',contribute='".$_POST['contribute']."',entity='".$_POST['entity']."',classifiedkeyword='".$_POST['classifiedkeyword']."',role='".$_POST['role']."',date='".$_POST['date']."' ,structure='".$_POST['structure']."' ,format='".$_POST['format']."',size='".$_POST['size']."',md_scheme='".$_POST['mdscheme']."',md_catalog='".$_POST['mdcatalog']."'   ,md_entry='".$_POST['mdentry']."',learning_resource_type='".$_POST['learning_resource_type']."',cost='".$_POST['cost']."',copyright='".$_POST['copyright']."',right_description='".$_POST['right_description']."' ,interactive_type='".$_POST['interactive_type']."',interactive_level='".$_POST['interactive_level']."',typical_learning_time='".$_POST['typical_learning_time']."',location='".$_POST['location']."' where ID=".$_POST['ID'];
//insertAction($object_sql["course_update1"]);
$db=new db;
$db->connect();
$db->query($qryup);
echo "<script>alert('Record Saved');</script>";
courseXml($ID,$dir_xml);
echo"<SCRIPT>top.object_manager.object_tree.location.reload();</SCRIPT>";
/*echo"<SCRIPT>top.rmain.location='assets.php?assetID='+aID+'&obtable=asset';</SCRIPT>";*/
echo"<SCRIPT>top.top1.objReload('".$_REQUEST['assetnumber']."');</SCRIPT>";

}

if($_REQUEST['action']=="course1" && $_POST['formAction']=="UPDATE")
{

$qryup="update course set name='".$_POST['name']."',sco_version='".$_POST['sco_version']."',description2='".$_POST['description']."',keyword='".$_POST['keyword']."',catalog_entry='".$_POST['catalog_entry']."',catalog_name='".$_POST['catalog_name']."',status='".$_POST['status']."',c_description='".$_POST['c_description']."',purpose='".$_POST['purpose']."',contribute='".$_POST['contribute']."',entity='".$_POST['entity']."',classifiedkeyword='".$_POST['classifiedkeyword']."',role='".$_POST['role']."',date='".$_POST['date']."' ,structure='".$_POST['structure']."' ,format='".$_POST['format']."',size='".$_POST['size']."',md_scheme='".$_POST['mdscheme']."',md_catalog='".$_POST['mdcatalog']."'   ,md_entry='".$_POST['mdentry']."',learning_resource_type='".$_POST['learning_resource_type']."',cost='".$_POST['cost']."',copyright='".$_POST['copyright']."',right_description='".$_POST['right_description']."' ,interactive_type='".$_POST['interactive_type']."',interactive_level='".$_POST['interactive_level']."',typical_learning_time='".$_POST['typical_learning_time']."',location='".$_POST['location']."' where ID=".$_POST['ID'];
//  ,md-scheme='".$_POST['md-scheme']."',md-catalog='".$_POST['md-catalog']."'   
//insertAction($object_sql["course_update1"]);
$db=new db;
$db->connect();
$db->query($qryup);
echo "<script>alert('Record Saved');</script>";
courseXml($ID,$dir_xml);
echo"<SCRIPT>top.object_manager.object_tree.location.reload();</SCRIPT>";
echo"<SCRIPT>top.top1.objReload('course');</SCRIPT>";
}

//if($action=="course1" && $formAction=="DELETE")
if($_REQUEST['action']=="course1" && $_POST['formAction']=="DELETE")
{
/*echo "<script>alert('".$_REQUEST['ID']."');</script>";*/
$cID = $_REQUEST['ID'];
insertAction("DELETE FROM course WHERE ID=$cID");
//insertAction($object_sql["course_delete1"]);
unlink($dir_xml.$ID.".xml");
echo"<SCRIPT>top.top1.objReload('course');</SCRIPT>";
echo"<SCRIPT>top.rmain.edit_main.location='blank.php';</SCRIPT>";
}

if($_REQUEST['action']=="asset1" && $_POST['formAction']=="DELETE")
{
$cID = $_REQUEST['ID'];
insertAction("DELETE FROM efiles WHERE ID=$cID");
//insertAction($object_sql["course_delete1"]);
//unlink($dir_xml.$ID.".xml");
/*echo "<script>top.rmain.location='assets.php'</script>";*/
echo"<SCRIPT>top.top1.objReload('".$_REQUEST['assetnumber']."');</SCRIPT>";
echo"<SCRIPT>top.rmain.edit_main.location='blank.php';</SCRIPT>";
}


if($action=="course2" && $formAction=="UPDATE")
{
  $rObjects = explode(",",$topicArray);
  $x=0;


   while($x<count($rObjects))
   {
	if($$rObjects[$x]=="enter")
	{
	$j=explode("_",$rObjects[$x]);
	$jnum=$j[1];
	$text_var = "topic_".$jnum."_text";
	insertAction("INSERT INTO courses_r (course_name,course_ID,lesson_name,lesson_ID,lesson_order)VALUES('$lname','$course_ID','".$$text_var."','$topicID[$jnum]','')");
	}

  $x++;
  }
courseXml($course_ID,$dir_xml);
echo"<SCRIPT>window.opener.top.object_manager.object_tree.location.reload();</SCRIPT>";
echo"<SCRIPT>window.opener.mReload();window.close();</SCRIPT>";
}

if($action=="course3" && $formAction=="UPDATE")
{
  $x=0;
  while($x<count($ID))
  {
  insertAction("UPDATE courses_r set lesson_name='$topic_name[$x]',lesson_order='$topic_order[$x]' WHERE ID='$ID[$x]'");
  $x++;
  }
courseXml($cid,$dir_xml);
echo"<SCRIPT>top.object_manager.object_tree.location.reload();</SCRIPT>";
/*
echo"<SCRIPT>top.rmain.edit_main.mReload();</SCRIPT>";
*/
}

if($action=="course2" && $formAction=="DELETE")
{
insertAction($object_sql["course_delete2"]);
courseXml($cid,$dir_xml);
echo"<SCRIPT>top.object_manager.object_tree.location.reload();</SCRIPT>";
echo"<SCRIPT>top.rmain.edit_main.location='blank.php';</SCRIPT>";
}

###############################################################################
# actions for course objectives
###############################################################################

if($action=="objective" && $formAction=="SAVE")
{
insertAction($object_sql["objective_save"]);
/*echo"<SCRIPT>alert('Obective Saved'); top.rmain.edit_main.location.reload();</SCRIPT>"; jayant*/
echo"<SCRIPT>alert('Obective Saved'); top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="objective" && $formAction=="DELETE")
{
insertAction($object_sql["objective_delete"]);
/*echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>"; jayant*/
echo"<SCRIPT>alert('Objective Deleted');top.rmain.edit_main.location.reload();</SCRIPT>";
}

###############################################################################
# actions for course references
###############################################################################

if($action=="ref" && $formAction=="SAVE")
{
insertAction($object_sql["ref_save"]);
   if($thefile!="")
   {
   //upload file;
	  copy("$thefile", $dir_references.$rthefile);
	  unlink($thefile);
   }
/*echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>"; jayant*/
echo"<SCRIPT>alert('Reference Saved');top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="ref" && $formAction=="DELETE")
{
insertAction($object_sql["ref_delete"]);
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

###############################################################################
# actions for course layout
###############################################################################

if($action=="course_layout" && $formAction=="UPDATE")
{
$make_layout="$l_w|$l_h|$layout|$a_type|$a_size|$a_loc|$b_type|$b_size|$b_loc|$c_type|$c_size|$c_loc|$d_type|$d_size|$d_loc";
to_file($dir_layout.$ID,$make_layout,"w+");
/*echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";*/
}
###############################################################################
# actions for updating Forums
###############################################################################
if($action=="addForum" && $formAction=="SAVE")
{
insertAction("INSERT INTO forums (orgID,maxposts)VALUES('$org_ID','100')");
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="forums" && $formAction=="SAVE")
{
insertAction("UPDATE forums SET maxposts='$maxposts' WHERE ID=$fID");
}
if($action=="forums" && $formAction=="DELETE")
{
insertAction("DELETE FROM forums WHERE ID=$fID");
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="create_forum_topic" && $formAction=="SAVE")
{
insertAction("INSERT INTO forum_topics (title,status,courseID,forumID)VALUES('New Topic','off','1','$forumID')");
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="forum_topics" && $formAction=="SAVE")
{
	function is_num($s) {
	  for ($i=0; $i<strlen($s); $i++) {
	    if (($s[$i]<'0') or ($s[$i]>'9')) {return false;}
	  }
	return true;
	}
 if(is_num($courseID))
 {
 $xtra=",courseID='$courseID'";
 }
insertAction("UPDATE forum_topics SET title='$title',status='$status' $xtra WHERE ID=$fID");
}

if($action=="forum_topics" && $formAction=="DELETE")
{
insertAction("DELETE FROM forum_topics WHERE ID=$fID");
}

###############################################################################
# actions for updating LMS properties
###############################################################################
if($action=="field" && $formAction=="SAVE")
{
insertAction("update reg_form set display='$display',forder='$forder',status='$status' WHERE ID='$fID'");
echo"update reg_form set stored='y' WHERE ID='$field'";
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="field" && $formAction=="store")
{
insertAction("update reg_form set stored='y' WHERE ID='$field'");
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}
if($action=="field" && $formAction=="DELETE")
{
insertAction("update reg_form set stored='n' WHERE ID='$fID'");
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}
if($action=="lms_properties" && $formAction=="UPDATE")
{
$pval.="<"."?";
$pval.="
$"."lms_groups=\"$rlms_groups\";
$"."lms_gtitle=\"$rlms_gtitle\";
$"."lms_sgtitle=\"$rlms_sgtitle\";
$"."lms_default_userlevel=$rlms_default_userlevel;
$"."lms_orgID=\"$rlms_orgID\";
$"."lms_username_link=\"$rlms_username_link\";
$"."lms_unique=\"$rlms_unique\";
";
$pval.="?".">";
//echo$pval;
to_file($dir_lms_conf,$pval,"w+");
echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";

}

###############################################################################
# actions for groups
###############################################################################
if($action=="group1" && $formAction=="UPDATE")
{
insertAction("update groups set name='$name',sname='$sname' WHERE ID=$ID");
echo"<SCRIPT>top.rmain.group_list.location.reload();</SCRIPT>";
}

if($action=="group1" && $formAction=="DELETE")
{
insertAction("DELETE FROM groups WHERE ID=$ID");
echo"<SCRIPT>top.rmain.group_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}

if($action=="group2" && $formAction=="UPDATE")
{
	$db = new db;
	$db->connect();
	$db->query("SELECT ID FROM subgroups WHERE group_ID=$group_ID");
	while($db->getRows())
	{ 
	$sub_ID = $db->row("ID");
	$newval = implode("|",$rgroup["SG_".$sub_ID]);
	to_file($dir_groupfiles.$group_ID."_".$sub_ID.".grp",$newval,"w+");
	/*
	echo$group_ID."_".$sub_ID.".grp WILL contain $newval and will explode like: ";
	$temv = explode("|",$newval);
	echo$temv[0]."<BR>";
	*/
	}	
	

}

###############################################################################
# actions for subgroups
###############################################################################
if($action=="subgroup" && $formAction=="SAVE")
{
insertAction("update subgroups set sub_name='$sub_name',sub_sname='$sub_sname' WHERE ID=$ID");
}
if($action=="subgroup" && $formAction=="DELETE")
{
insertAction("DELETE FROM subgroups WHERE ID=$ID");
echo"<SCRIPT>top.rmain.details.edit_main.location.reload();</SCRIPT>";
}

###############################################################################
# actions for tests
###############################################################################
if($action=="test1" && $formAction=="SAVE")
{
insertAction("update tests set name='$name',type='$type',randomize='$randomize', rand_total='$rand_total' WHERE ID=$ID");
echo"<SCRIPT>top.rmain.test_list.location.reload();</SCRIPT>";
//echo"update tests set name='$name',type='$type',randomize='$randomize' WHERE ID=$ID";
}
if($action=="test1" && $formAction=="DELETE")
{
insertAction("DELETE FROM tests WHERE ID=$ID");
echo"<SCRIPT>top.rmain.test_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}

if($action=="question1" && $formAction=="SAVE")
{
insertAction("update questions set question='$question',qname='$qname',question_type='$question_type',choice_1='$choice_1',choice_2='$choice_2',choice_3='$choice_3',choice_4='$choice_4',correct_answ='$correct_answ' WHERE ID=$ID");
echo"<SCRIPT>top.rmain.test_list.location.reload();</SCRIPT>";
//echo"update tests set name='$name',type='$type',randomize='$randomize' WHERE ID=$ID";
}
if($action=="question1" && $formAction=="DELETE")
{
insertAction("DELETE FROM questions WHERE ID=$ID");
insertAction("DELETE FROM tests_r WHERE question_ID=$ID");
echo"<SCRIPT>top.rmain.test_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}

if($action=="test2" && $formAction=="UPDATE")
{

  $rObjects = explode(",",$topicArray);
  $x=0;


   while($x<count($rObjects))
   {
	if($$rObjects[$x]=="enter")
	{
	$j=explode("_",$rObjects[$x]);
	$jnum=$j[1];
	$text_var = "topic_".$jnum."_text";
	insertAction("INSERT INTO tests_r (test_ID,question_ID,question_order)VALUES('$lesson_ID','$topicID[$jnum]','0')");
	//echo"INSERT INTO tests_r (test_ID,question_ID,question_order)VALUES('$lesson_ID','$topicID[$jnum]','0')<BR>";
	}

  $x++;
  }
echo"<SCRIPT>window.opener.mReload();window.close();</SCRIPT>";
}

if($action=="test3" && $formAction=="SAVE")
{
  $x=0;
  while($x<count($gID))
  {
  insertAction("UPDATE tests_r set question_order='$topic_order[$x]' WHERE ID='$gID[$x]'");
  //echo"UPDATE tests_r set question_order='$topic_order[$x]' WHERE ID='$gID[$x]'<BR>";
  $x++;
  }
echo"<SCRIPT>top.rmain.details.edit_main.location.reload();</SCRIPT>";
}

/*
------------------------------------------------------------------
delete the entire test while viewing all questions
Don't forget to delete all questions in relational
Table w/ corresponding test ID's!
------------------------------------------------------------------
*/
if($action=="test3" && $formAction=="DELETE")
{
insertAction("DELETE FROM tests WHERE ID=$ID");
insertAction("DELETE FROM tests_r WHERE test_ID=$ID");
echo"<SCRIPT>top.rmain.test_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}

if($action=="test3" && $formAction=="REMOVE")
{
insertAction("DELETE FROM tests_r WHERE ID='$rmvID'");
echo"<SCRIPT>top.rmain.details.edit_main.location.reload();</SCRIPT>";
}
?>
</body>
</html>
