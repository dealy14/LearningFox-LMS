<?php
require_once("../../conf.php");

$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

if($level=="sub")
{
	//get the next order number of any tests on the sub level under this lesson;
	$result=MetabaseQuery($database,"SELECT order_num FROM lessons_tests WHERE course_id=$course_id AND lesson_id=$lesson_id ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}
	
	//get the next order number of any topics on the sub level under this lesson;
	$result=MetabaseQuery($database,"SELECT order_num FROM lessons_topics WHERE course_id=$course_id AND lesson_id=$lesson_id ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}

	//sort the array in reverse order, take the first element vakue and add 1 to get the next number;
	rsort ($order_num);
	reset ($order_num);
	$order_num = $order_num[0]+1;	
	
	//add the test to the main library;
	$success=MetabaseGetSequenceNextValue($database, 'test_id', &$value);
	$query="INSERT INTO tests (test_id,modified,created,title,time_limit,time_req,randomize,randomize_limit,description,launch_str,scoring,passing,fail_action,retake)VALUES('$value','$modified','$created','New Test $order_num','0','0','n','','$description','$launch_str','Not Scored','$passing','Nothing','no')";
	$result=MetabaseQuery($database,$query);	
	
	//add the thread;
	$query="INSERT INTO lessons_tests (test_id,lesson_id,course_id,order_num)VALUES('$value','$lesson_id','$course_id','$order_num')";
	$result=MetabaseQuery($database,$query);	
		
	echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";	
}
else
{


	//get the next order number of any tests on the root level under this course;
	$result=MetabaseQuery($database,"SELECT order_num FROM courses_tests WHERE course_id=$course_id  ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}
	
	//get the next order number of any topics on the root level under this course;
	$result=MetabaseQuery($database,"SELECT order_num FROM courses_topics WHERE course_id=$course_id ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}
	
	//get the next order number of any lessons;
	$result=MetabaseQuery($database,"SELECT order_num FROM courses_lessons WHERE course_id=$course_id  ORDER BY order_num ASC");
	$end_of_result=MetabaseEndOfResult($database,$result);
	for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
	{
	$order_num[]=(MetabaseFetchResult($database,$result,$row,"order_num"));
	}	

	//sort the array in reverse order, take the first element vakue and add 1 to get the next number;
	rsort ($order_num);
	reset ($order_num);
	$order_num = $order_num[0]+1;	
	
	//add the test to the main library;
	$success=MetabaseGetSequenceNextValue($database, 'test_id', &$value);
	$query="INSERT INTO tests (test_id,modified,created,title,time_limit,time_req,randomize,randomize_limit,description,launch_str,scoring,passing,fail_action,retake)VALUES('$value','$modified','$created','New Test $order_num','0','0','n','','$description','$launch_str','Not Scored','$passing','Nothing','no')";
	$result=MetabaseQuery($database,$query);	
	
	//add the thread;
	$query="INSERT INTO courses_tests (test_id,course_id,order_num)VALUES('$value','$course_id','$order_num')";
	$result=MetabaseQuery($database,$query);	
		
	echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";	

}
?>
