<?php
require_once("../../conf.php");

	$success=MetabaseGetSequenceNextValue($database, 'question_id', &$value);
	$query="INSERT INTO test_questions (question_id,test_id,question_type,question_order,question,question_a,question_b,question_c,question_d,question_e,question_blank,question_answer)VALUES('$value','$test_id','mc','0','$question','$question_a','$question_b','$question_c','$question_d','$question_e','$question_blank','a')";
	$result=MetabaseQuery($database,$query);	

?>
