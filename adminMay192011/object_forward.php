<?php

if($action=="create")
{
	if($obtype=="Topic")
	{
	header("location:create_topic.php");
	}
	else if($obtype=="Lesson")
	{
	header("location:create_lesson.php");
	}
	else if($obtype=="WBT Course")
	{
	header("location:create_course.php?type=wbt");
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body bgcolor="#336699">
&nbsp;
</body>
</html>
