<?php
require_once("../../conf.php");

if($item_level=="root" && $section=="properties")
{

	if($do_action=="UPDATE" && $test_id!="")
	{
	$query="UPDATE tests set modified='$modified',title='$title',time_limit='$time_limit',time_req='$time_req',randomize='$randomize',randomize_limit='$randomize_limit',description='$description',launch_str='$launch_str',scoring='$scoring',passing='$passing',fail_action='$fail_action',retake='$retake' WHERE test_id=$test_id";
	$result=MetabaseQuery($database,$query);
	
		//take care of order_number:
		if($original_order <> $order_num && $order_num >0)
		{
		//update topic threads (root level);
		$query="UPDATE courses_topics SET order_num='$original_order' WHERE course_id=$course_id AND order_num=$order_num";
		$result=MetabaseQuery($database,$query);	
		//update test threads (root level);
		$query="UPDATE courses_tests SET order_num='$original_order' WHERE course_id=$course_id AND order_num=$order_num";
		$result=MetabaseQuery($database,$query);	
		//update lesson threads;
		$query="UPDATE courses_lessons SET order_num='$original_order' WHERE course_id=$course_id AND order_num=$order_num";
		$result=MetabaseQuery($database,$query);	
		
		//Finally, update the item to the new order number;
		$query="UPDATE courses_tests SET order_num='$order_num' WHERE course_id=$course_id AND test_id=$test_id";
		$result=MetabaseQuery($database,$query);	
		echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";											
		}
	}
	
	if($do_action=="DELETE" && $test_id!="")
	{
	
	$query="DELETE FROM courses_tests WHERE test_id=$test_id";
	$result=MetabaseQuery($database,$query);
		
	$query="DELETE FROM topics WHERE test_id=$test_id";
	$result=MetabaseQuery($database,$query);
	
	echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";
	}	
	
	
}
else if($item_level!="root" && $section=="properties")
{

	if($section=="properties")
	{
		if($do_action=="UPDATE" && $test_id!="")
		{
		$query="UPDATE tests set modified='$modified',title='$title',time_limit='$time_limit',time_req='$time_req',randomize='$randomize',randomize_limit='$randomize_limit',description='$description',launch_str='$launch_str',scoring='$scoring',passing='$passing',fail_action='$fail_action',retake='$retake' WHERE test_id=$test_id";
		$result=MetabaseQuery($database,$query);
		
			//take care of order_number:
			if($original_order <> $order_num && $order_num >0)
			{
			//update topic threads (sub level);
			$query="UPDATE lessons_topics SET order_num='$original_order' WHERE course_id=$course_id AND lesson_id=$lesson_id AND order_num=$order_num";
			$result=MetabaseQuery($database,$query);	
			//update test threads (sub level);
			$query="UPDATE lessons_tests SET order_num='$original_order' WHERE course_id=$course_id AND lesson_id=$lesson_id AND order_num=$order_num";
			$result=MetabaseQuery($database,$query);	
			
			//Finally, update the item to the new order number;
			$query="UPDATE lessons_tests SET order_num='$order_num' WHERE course_id=$course_id AND lesson_id=$lesson_id AND test_id=$test_id";
			$result=MetabaseQuery($database,$query);	
			echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";											
			}
		}
		
		if($do_action=="DELETE" && $test_id!="")
		{
		
		$query="DELETE FROM lessons_tests WHERE test_id=$test_id AND lesson_id=$lesson_id AND course_id=$course_id";
		$result=MetabaseQuery($database,$query);
			
		$query="DELETE FROM tests WHERE test_id=$test_id";
		$result=MetabaseQuery($database,$query);
		
		echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";
		}	
	
	}

}

?>
