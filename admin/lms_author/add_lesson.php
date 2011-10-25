<?php
require_once("../../conf.php");

$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');
	
	//get the next order number of the lesson;
	$result=MetabaseQuery($database,"SELECT order_num FROM courses_lessons WHERE course_id=$course_id ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}
	
	//get the next order number of the topics;
	$result=MetabaseQuery($database,"SELECT order_num FROM courses_topics WHERE course_id=$course_id ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}
	
	//get the next order number of the lesson;
	$result=MetabaseQuery($database,"SELECT order_num FROM courses_tests WHERE course_id=$course_id ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}	
	
	rsort ($order_num);
	reset ($order_num);
	$order_num = $order_num[0]+1;
	

	//add the lsson to the main library;
	$success=MetabaseGetSequenceNextValue($database, 'lesson_id', &$value);
	$query="INSERT INTO lessons (lesson_id,title,created,modified)VALUES('$value','New Lesson $order_num','$created','$modified')";
	$result=MetabaseQuery($database,$query);
	
	//add the threads;
	$query="INSERT INTO courses_lessons (lesson_id,course_id,order_num)VALUES('$value','$course_id','$order_num')";
	$result=MetabaseQuery($database,$query);	
	
	echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";

?>
