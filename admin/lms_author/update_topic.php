<?php
require_once("../../conf.php");

if($item_level=="root" && $section=="properties")
{

	if($do_action=="UPDATE" && $topic_id!="")
	{
	$query="UPDATE topics set title='$title',modified='$modified',description='$description',time_limit='$time_limit',time_req='$time_req',launch_str='$launch_str' WHERE topic_id=$topic_id";
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
		$query="UPDATE courses_topics SET order_num='$order_num' WHERE course_id=$course_id AND topic_id=$topic_id";
		$result=MetabaseQuery($database,$query);	
		echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";											
		}
	}
	
	if($do_action=="DELETE" && $topic_id!="")
	{
	
	$query="DELETE FROM courses_topics WHERE topic_id=$topic_id";
	$result=MetabaseQuery($database,$query);
		
	$query="DELETE FROM topics WHERE topic_id=$topic_id";
	$result=MetabaseQuery($database,$query);
	
	echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";
	}	
	
	
}
else if($item_level!="root" && $section=="properties")
{

	if($section=="properties")
	{
		if($do_action=="UPDATE" && $topic_id!="")
		{
		$query="UPDATE topics set title='$title',modified='$modified',description='$description',time_limit='$time_limit',time_req='$time_req',launch_str='$launch_str' WHERE topic_id=$topic_id";
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
			$query="UPDATE lessons_topics SET order_num='$order_num' WHERE course_id=$course_id AND lesson_id=$lesson_id AND topic_id=$topic_id";
			$result=MetabaseQuery($database,$query);	
			echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";											
			}
		}
		
		if($do_action=="DELETE" && $topic_id!="")
		{
		
		$query="DELETE FROM lessons_topics WHERE topic_id=$topic_id AND lesson_id=$lesson_id AND course_id=$course_id";
		$result=MetabaseQuery($database,$query);
			
		$query="DELETE FROM topics WHERE topic_id=$topic_id";
		$result=MetabaseQuery($database,$query);
		
		echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";
		}	
	
	}

}
else if($section=="content")
{

	$query="UPDATE topics set modified='$modified', content='$content' WHERE topic_id=$topic_id";
	$result=MetabaseQuery($database,$query);

}
else if($section=="code")
{

	$query="UPDATE topics set modified='$modified', code='$code' WHERE topic_id=$topic_id";
	$result=MetabaseQuery($database,$query);

}
?>
