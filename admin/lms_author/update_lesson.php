<?php
require_once("../../conf.php");

if($item_level=="root")
{
	if($do_action=="UPDATE" && $lesson_id!="")
	{
	//$modified=date('Y-m-d H:i:s');
	$query="UPDATE lessons set title='$title',modified='$modified' WHERE lesson_id=$lesson_id";
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
			$query="UPDATE courses_lessons SET order_num='$order_num' WHERE course_id=$course_id AND lesson_id=$lesson_id";
			$result=MetabaseQuery($database,$query);	
			echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";											
			}	
	
	}
	
	if($do_action=="DELETE" && $lesson_id!="")
	{
	
	$query="DELETE FROM courses_lessons WHERE lesson_id=$lesson_id";
	$result=MetabaseQuery($database,$query);
	
	$query="DELETE FROM lessons_topics WHERE lesson_id=$lesson_id";
	$result=MetabaseQuery($database,$query);
	
	$query="DELETE FROM lessons_tests WHERE lesson_id=$lesson_id";
	$result=MetabaseQuery($database,$query);
		
	$query="DELETE FROM lessons WHERE lesson_id=$lesson_id";
	$result=MetabaseQuery($database,$query);
	
	echo"<SCRIPT>top.course_tree.location.reload();</SCRIPT>";
	}	
}
?>
