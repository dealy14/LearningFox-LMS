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

$db = new db;
$db->connect();
$action = $_REQUEST['action'];
$formAction = $_REQUEST['formAction'];
###############################################################################
# actions for updating topic properties
###############################################################################


if($action=="topic1" && $formAction=="UPDATE")
{
	$sql = "UPDATE topic SET modified='" . $db->escape_string($modified) . "',name='" . $db->escape_string($topic_name) . 
								"',time_limit='" . $db->escape_string($time_limit) . "',time_req='" . $db->escape_string($time_req) .
								"',topic_type='" . $db->escape_string($topic_type) . "',content_link='" . $db->escape_string($content_link) .
								"',content_location='" . $db->escape_string($content_location) . "',test_link='" . $db->escape_string($test_link) .
								"' WHERE ID=$ID";
	$db->query($sql);

	include($dir_includes."write_topic.php");
	echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}

if($action=="topic2" && $formAction=="UPDATE")
{
	include($dir_includes."write_topic.php");
	$sql = "UPDATE topic SET modified='" . $db->escape_string($modified) . "',content='" . $db->escape_string($content) . "' WHERE ID=$ID";
	$db->query($sql);
	echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}

/*
if($action=="topic3" && $formAction=="UPDATE")
{
insertAction($object_sql["topic_update3"]);
echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}
*/

if(($action=="topic1" || $action == "topic2" || $action == "topic3") && $formAction=="DELETE")
{
	$db->query("DELETE FROM topic WHERE ID=$ID");
	unlink($dir_topics.$ID);
	echo"<SCRIPT>top.top1.objReload('topic');window.close();</SCRIPT>";
}


###############################################################################
# actions for updating lesson properties
###############################################################################
if($action=="lesson1" && $formAction=="UPDATE")
{
	$sql = "UPDATE lesson SET modified='" . $db->escape_string($modified) . "',name='" . $db->escape_string($name) . "' WHERE ID=$ID";
	$db->query($sql);
	echo"<SCRIPT>top.top1.objReload('lesson');window.close();</SCRIPT>";
}

if($action=="lesson1" && $formAction=="DELETE")
{
	$sql = "DELETE FROM lesson WHERE ID=$ID";
	$db->query($sql);
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
	
	$sql = "INSERT INTO lessons_r (lesson_name,lesson_ID,topic_name,topic_ID,topic_order) " . 
			"VALUES('" . $db->escape_string($lname) . "','" . $db->escape_string($lesson_ID) . "','" .
			$db->escape_string($$text_var) . "','" . $db->escape_string($topicID[$jnum]) . "', $x)";
	$db->query($sql);
//	insertAction("INSERT INTO lessons_r (lesson_name,lesson_ID,topic_name,topic_ID)VALUES('$lname','$lesson_ID','".$$text_var."','$topicID[$jnum]')");
//	insertAction("INSERT INTO lessons_r (lesson_name,lesson_ID,topic_name,topic_ID,topic_order)VALUES('$lname','$lesson_ID','".$$text_var."','$topicID[$jnum]','')");
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
	  $db->query("UPDATE lessons_r set topic_name='" . $db->escape_string($topic_name[$x]) . 
	  			 "',topic_order=" . $topic_order[$x] . " WHERE ID=" . $gID[$x]);
  	  $x++;
  }
  echo"<SCRIPT>top.rmain.edit_main.mReload();</SCRIPT>";
}

if($action=="lesson2" && $formAction=="DELETE")
{
	$db->query("DELETE FROM lessons_r WHERE ID=$ID");
	echo"<SCRIPT>top.rmain.edit_main.mReload();</SCRIPT>";
}

if($action=="lesson3" && $formAction=="DELETE")
{
	$db->query("DELETE FROM lesson WHERE ID=$lesson_id");
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
	$qryup="update efiles set filename='".$db->escape_string($_POST['filename']).
		   "',sco_version='".$db->escape_string($_POST['sco_version'])."',description2='".$db->escape_string($_POST['description']).
		   "',keyword='".$db->escape_string($_POST['keyword'])."',catalog_entry='".$db->escape_string($_POST['catalog_entry']).
		   "',catalog_name='".$db->escape_string($_POST['catalog_name'])."',status='".$db->escape_string($_POST['status']).
		   "',c_description='".$db->escape_string($_POST['c_description'])."',purpose='".$db->escape_string($_POST['purpose']).
		   "',contribute='".$db->escape_string($_POST['contribute'])."',entity='".$db->escape_string($_POST['entity']).
		   "',classifiedkeyword='".$db->escape_string($_POST['classifiedkeyword'])."',role='".$db->escape_string($_POST['role']).
		   "',`date`='".$db->escape_string($_POST['date'])."' ,structure='".$db->escape_string($_POST['structure']).
		   "' ,format='".$db->escape_string($_POST['format'])."',size='".$db->escape_string($_POST['size']).
		   "',md_scheme='".$db->escape_string($_POST['mdscheme'])."',md_catalog='".$db->escape_string($_POST['mdcatalog']).
		   "',md_entry='".$db->escape_string($_POST['mdentry']).
		   "',learning_resource_type='".$db->escape_string($_POST['learning_resource_type']).
		   "',cost='".$db->escape_string($_POST['cost'])."',copyright='".$db->escape_string($_POST['copyright']).
		   "',right_description='".$db->escape_string($_POST['right_description']).
		   "' ,interactive_type='".$db->escape_string($_POST['interactive_type']).
		   "',interactive_level='".$db->escape_string($_POST['interactive_level']).
		   "',typical_learning_time='".$db->escape_string($_POST['typical_learning_time']).
		   "',location='".$db->escape_string($_POST['location'])."' where ID=".$_POST['ID'];
	$db->query($qryup);
	echo "<script>alert('Record Saved');</script>";
	courseXml($ID,$dir_xml);
	echo"<SCRIPT>top.object_manager.object_tree.location.reload();</SCRIPT>";
/*echo"<SCRIPT>top.rmain.location='assets.php?assetID='+aID+'&obtable=asset';</SCRIPT>";*/
	echo"<SCRIPT>top.top1.objReload('".$_REQUEST['assetnumber']."');</SCRIPT>";

}

if($_REQUEST['action']=="course1" && $_POST['formAction']=="UPDATE")
{
	$qryup="update course set name='".$db->escape_string($_POST['name'])."',sco_version='".$db->escape_string($_POST['sco_version']).
				"',description2='".$db->escape_string($_POST['description'])."',keyword='".$db->escape_string($_POST['keyword']).
				"',catalog_entry='".$db->escape_string($_POST['catalog_entry']).
				"',catalog_name='".$db->escape_string($_POST['catalog_name'])."',status='".$db->escape_string($_POST['status']).
				"',c_description='".$db->escape_string($_POST['c_description'])."',purpose='".$db->escape_string($_POST['purpose']).
				"',contribute='".$db->escape_string($_POST['contribute'])."',entity='".$db->escape_string($_POST['entity']).
				"',classifiedkeyword='".$db->escape_string($_POST['classifiedkeyword'])."',role='".$db->escape_string($_POST['role']).
				"',date='".$db->escape_string($_POST['date'])."' ,structure='".$db->escape_string($_POST['structure']).
				"' ,format='".$db->escape_string($_POST['format'])."',size='".$db->escape_string($_POST['size']).
				"',md_scheme='".$db->escape_string($_POST['mdscheme'])."',md_catalog='".$db->escape_string($_POST['mdcatalog']).
				"' ,md_entry='".$db->escape_string($_POST['mdentry']).
				"',learning_resource_type='".$db->escape_string($_POST['learning_resource_type']).
				"',cost='".$db->escape_string($_POST['cost'])."',copyright='".$db->escape_string($_POST['copyright']).
				"',right_description='".$db->escape_string($_POST['right_description']).
				"' ,interactive_type='".$db->escape_string($_POST['interactive_type']).
				"',interactive_level='".$db->escape_string($_POST['interactive_level']).
				"',typical_learning_time='".$db->escape_string($_POST['typical_learning_time']).
				"',location='".$db->escape_string($_POST['location'])."' where ID=".$_POST['ID'];
//  ,md-scheme='".$_POST['md-scheme']."',md-catalog='".$_POST['md-catalog']."'   
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
	$db->query("DELETE FROM course WHERE ID=$ID");
	unlink($dir_xml.$ID.".xml");
	echo"<SCRIPT>top.top1.objReload('course');</SCRIPT>";
	echo"<SCRIPT>top.rmain.edit_main.location='blank.php';</SCRIPT>";
}

if($_REQUEST['action']=="asset1" && $_POST['formAction']=="DELETE")
{
	$cID = $_REQUEST['ID'];
	$db->query("DELETE FROM efiles WHERE ID=$cID");
	//unlink($dir_xml.$ID.".xml");  TODO:  Check as to why this was deleted
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
	$sql = "INSERT INTO courses_r (course_name,course_ID,lesson_name,lesson_ID,lesson_order) " . 
		   "VALUES('" . $db->escape_string($lname) . "','" . $db->escape_string($course_ID) . "','".
		   $db->escape_string($$text_var)."','" . $db->escape_string($topicID[$jnum]) . "','')";
	$db->query($sql);
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
	while($x<count($ID)) {
		$sql = "UPDATE courses_r set lesson_name='" . $db->escape_string($topic_name[$x]) . 
			   "',lesson_order=" . $topic_order[$x] . " WHERE ID=" . $ID[$x];
		$db->query($sql);
  $x++;
  }
	courseXml($cid,$dir_xml);
	echo"<SCRIPT>top.object_manager.object_tree.location.reload();</SCRIPT>";
}

if($action=="course2" && $formAction=="DELETE")
{
	$db->query("DELETE FROM courses_r WHERE ID=$ID");
	courseXml($cid,$dir_xml);
	echo"<SCRIPT>top.object_manager.object_tree.location.reload();</SCRIPT>";
	echo"<SCRIPT>top.rmain.edit_main.location='blank.php';</SCRIPT>";
}

###############################################################################
# actions for course objectives
###############################################################################

if($action=="objective" && $formAction=="SAVE")
{
//insertAction($object_sql["objective_save"]);
	$oID = $_REQUEST['oID'];
	$objective = $_REQUEST['objective'];
	$sql = "UPDATE objectives SET objective='" . $db->escape_string($_REQUEST['objective']) . 
 			"',link='" . $db->escape_string($link) . "' WHERE ID=" . $_REQUEST['$oID'];
	$db->query($sql);
/*echo"<SCRIPT>alert('Obective Saved'); top.rmain.edit_main.location.reload();</SCRIPT>"; jayant*/
	echo"<SCRIPT>alert('Obective Saved'); top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="objective" && $formAction=="DELETE")
{
	$db->query("DELETE FROM objectives WHERE ID=" . intval($_REQUEST['oID']));
	echo"<SCRIPT>alert('Objective Deleted');top.rmain.edit_main.location.reload();</SCRIPT>";
}

###############################################################################
# actions for course references
###############################################################################

if ($action=="ref" && $formAction=="SAVE")
{
	$description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
	$rname = isset($_REQUEST['rname']) ? $_REQUEST['rname'] : '';
	$oID = isset($_REQUEST['oID']) ? intval($_REQUEST['oID']) : 0;
	$db->query("UPDATE ref SET description='" . $db->escape_string($description) . 
			   "',rname='" . $db->escape_string($rname) . "' WHERE ID=$oID");
	$thefile = $_FILES['thefile']['name'];
	if (strlen($thefile) > 0)
	{
		move_uploaded_file($_FILES['thefile']['tmp_name'], $dir_references.$thefile);
		$db->query("UPDATE ref SET filename='" . $db->escape_string($thefile) . "' WHERE ID=$oID");
	}
	echo "<SCRIPT>alert('Reference Saved');top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="ref" && $formAction=="DELETE")
{
    $db->query("DELETE FROM ref WHERE ID=" . intval($_REQUEST['oID']));
    echo "<SCRIPT>alert('Reference Deleted'); top.rmain.edit_main.location.reload();</SCRIPT>";
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
	$db->query("INSERT INTO forums (orgID,maxposts) VALUES(' " . $db->escape_string($org_ID) ." ','100')");
	echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="forums" && $formAction=="SAVE")
{
	$db->query ("UPDATE forums SET maxposts=$maxposts WHERE ID=$fID");
}
if($action=="forums" && $formAction=="DELETE")
{
	$db->query("DELETE FROM forums WHERE ID=" . intval($fID));
	echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="create_forum_topic" && $formAction=="SAVE")
{
	$sql = "INSERT INTO forum_topics (title,status,courseID,forumID) " .
		   " VALUES('New Topic','off',1,$forumID)";
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
 		$xtra=",courseID=$courseID";
  	else
  		$xtra = '';
	$db->query("UPDATE forum_topics SET title='" . $db->escape_string($title) . "',status='" . $db->escape_string($status) .
			   "' $xtra WHERE ID=$fID");
}

if($action=="forum_topics" && $formAction=="DELETE")
{
	$db->query("DELETE FROM forum_topics WHERE ID=$fID");
}

###############################################################################
# actions for updating LMS properties
###############################################################################
if($action=="field" && $formAction=="SAVE")
{
	$db->query("update reg_form set display='" . $db->escape_string($display) . 
			   "',forder=$forder,status='" . $db->escape_string($status) . "' WHERE ID=$fID");
//	echo"update reg_form set stored='y' WHERE ID='$field'";
	echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

if($action=="field" && $formAction=="store")
{
	$db->query("UPDATE reg_form SET stored='y' WHERE ID=$field");
	echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}
if($action=="field" && $formAction=="DELETE")
{
	$db->query("UPDATE reg_form SET stored='n' WHERE ID=" . intval($fID));
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
	to_file($dir_lms, $pval, "w+");
	echo"<SCRIPT>top.rmain.edit_main.location.reload();</SCRIPT>";
}

###############################################################################
# actions for groups
###############################################################################
if($action=="group1" && $formAction=="UPDATE")
{
	$sql = "UPDATE groups SET name='" . $db->escape_string($_REQUEST['name']) .
			   "',sname='" . $db->escape_string($_REQUEST['sname']) . "' WHERE ID=" . intval($_REQUEST['ID']);
	$db->query($sql);
    echo"<SCRIPT>top.rmain.group_list.location.reload();</SCRIPT>";
}

if($action=="group1" && $formAction=="DELETE")
{
	$db->query("DELETE FROM groups WHERE ID=" . intval($_REQUEST['ID']));
    echo"<SCRIPT>top.rmain.group_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}
if($action=="group2" && $formAction=="DELETE")
{
	$db->query("DELETE FROM groups WHERE ID=" . intval($_REQUEST['ID']));
    echo"<SCRIPT>top.rmain.group_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}
if($action=="group2" && $formAction=="UPDATE")
{
    $group_ID = $_REQUEST['group_ID'];
	$db->query("SELECT ID FROM subgroups WHERE group_ID=" . intval($group_ID));
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
    $sub_name = $_REQUEST['sub_name'];
    $sub_sname = $_REQUEST['sub_sname'];
	$ID = $_REQUEST['ID'];
    $db->query("update subgroups set sub_name='" . $db->escape_string($sub_name) . 
    		   "',sub_sname='" . $db->escape_string($sub_sname) . "' WHERE ID=" . intval($ID));
}
if($action=="subgroup" && $formAction=="DELETE")
{
    $db->query("DELETE FROM subgroups WHERE ID=" . intval($_REQUEST['ID']));
    echo"<SCRIPT>top.rmain.details.edit_main.location.reload();</SCRIPT>";
}

###############################################################################
# actions for tests
###############################################################################
if($action=="test1" && $formAction=="SAVE")
{
 $randomize=isset($_REQUEST['randomize']) ? $db->escape_string($_REQUEST['randomize']) : 'N';  // Default to No
 $rand_total=$_REQUEST['rand_total'];  // Not used AFAIK
 $db->query("update tests set name='" . $db->escape_string($_REQUEST['name']) . 
 			"',type='" . $db->escape_string($_REQUEST['type']) . "',randomize='$randomize' WHERE ID=" . intval($_REQUEST['ID']));
  echo"<SCRIPT>top.rmain.test_list.location.reload();</SCRIPT>";
}
if($action=="test1" && $formAction=="DELETE")
{
 $db->query("DELETE FROM tests WHERE ID=" . intval($_REQUEST['ID']));
 echo"<SCRIPT>top.rmain.test_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}

if($action=="question1" && $formAction=="SAVE")
{
	$db->query("UPDATE questions SET question='" . $db->escape_string($question) . "',qname='" . $db->escape_string($qname) . 
			   "',question_type='" . $db->escape_string($question_type) . "',choice_1='" . $db->escape_string($choice_1) . 
			   "',choice_2='" . $db->escape_string($choice_2) . "',choice_3='" . $db->escape_string($choice_3) . 
			   "',choice_4='" . $db->escape_string($choice_4) . "',correct_answ='" . $db->escape_string($correct_answ) . 
			   "' WHERE ID=" . intval($ID));
	echo"<SCRIPT>top.rmain.test_list.location.reload();</SCRIPT>";
//echo"update tests set name='$name',type='$type',randomize='$randomize' WHERE ID=$ID";
}
if($action=="question1" && $formAction=="DELETE")
{
	$ID = intval($_REQUEST['ID']);
	$db->query("DELETE FROM questions WHERE ID=$ID");
	$db->query("DELETE FROM tests_r WHERE question_ID=$ID");
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
	$db->query("INSERT INTO tests_r (test_ID,question_ID,question_order) " .
			   "VALUES(" . intval($lesson_ID) . ", " . intval($topicID[$jnum]) . ", 0)");
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
  	$db->query("UPDATE tests_r set question_order=" . intval($topic_order[$x]) . " WHERE ID=" . intval($gID[$x]));
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
	$db->query("DELETE FROM tests WHERE ID=" . intval($ID));
	$db->query("DELETE FROM tests_r WHERE test_ID=" . intval($ID));
	echo"<SCRIPT>top.rmain.test_list.location.reload();top.rmain.details.edit_main.location='blank.php';</SCRIPT>";
}

if($action=="test3" && $formAction=="REMOVE")
{
	$db->query("DELETE FROM tests_r WHERE ID=" . intval($rmvID));
	echo"<SCRIPT>top.rmain.details.edit_main.location.reload();</SCRIPT>";
}
?>
</body>
</html>
