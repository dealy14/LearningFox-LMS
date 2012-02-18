<?php
################################################################################################
#Object SQL
################################################################################################
//topics;
$object_sql["full_topic_insert"]="INSERT INTO topic (modified,created,name,time_limit,time_req,topic_type,content_location,content_link,content,test_link) VALUES ('$modified','$created','$topic_name','$time_limit','$time_req','$topic_type','$content_location','$content_link','$content',".( 0+$test_link).")";
$object_sql["topic_update1"]="UPDATE topic SET modified='$modified',name='$topic_name',time_limit='$time_limit',time_req='$time_req',topic_type='$topic_type',content_link='$content_link',content_location='$content_location',test_link='$test_link' WHERE ID=$ID";
$object_sql["topic_update2"]="UPDATE topic SET modified='$modified', content='".addslashes($content)."' WHERE ID=$ID";
$object_sql["topic_update3"]="UPDATE topic SET modified='$modified', content_link='$content_link' WHERE ID=$ID";
$object_sql["topic_delete"]="DELETE FROM topic WHERE ID=$ID";

//Lessons;
$object_sql["full_lesson_insert"]="INSERT INTO lesson (modified,created,name) VALUES ('$modified','$created','$name')";
$object_sql["lesson_update1"]="UPDATE lesson SET modified='$modified',name='$name' WHERE ID=$ID";
$object_sql["lesson_delete"]="DELETE FROM lesson WHERE ID=$ID";
$object_sql["lesson_delete2"]="DELETE FROM lessons_r WHERE ID=$ID";

//Courses;
$object_sql["full_wbtcourse_insert"]="INSERT INTO course (modified,created,name,type,status) VALUES ('$modified','$created','$name','$type','not active')";
$object_sql["course_update1"]="UPDATE course SET modified='$modified',name='$name',status='$status',description='$description', link='$url' WHERE ID=$ID";
$object_sql["course_delete1"]="DELETE FROM course WHERE ID=$ID";
$object_sql["course_delete2"]="DELETE FROM courses_r WHERE ID=$ID";

//objectives;
$object_sql["objective_insert"]="INSERT INTO objectives (objective,course_ID,link) VALUES ('$objective','$course_ID','$link')";
$object_sql["objective_save"]="UPDATE objectives SET objective='$objective',link='$link' WHERE ID=$oID";
$object_sql["objective_delete"]="DELETE FROM objectives WHERE ID=$oID";

//refereneces;

$object_sql["ref_insert"]="INSERT INTO ref (rname,filename,description,course_ID) VALUES ('$rname','$filename','$description','$course_ID')";
	
	if($fname!="")
	{
	$new_name = explode("\\",$fname);
	//echo"<SCRIPT>alert('".$new_name[(count($new_name)-1)]."');</SCRIPT>";  
	$rthefile =  $new_name[(count($new_name)-1)];
	$sp_ref="filename='$rthefile',";
	}else{$sp_ref="";}
	
$object_sql["ref_save"]="UPDATE ref SET $sp_ref description='$description',rname='$rname' WHERE ID=$oID";
$object_sql["ref_delete"]="DELETE FROM ref WHERE ID=$oID";

?>
