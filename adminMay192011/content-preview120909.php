<?php session_start(); 
require_once("../conf.php");
$sid=$_GET['sid'];
$course_ID = $_GET['ref'];
$db = new db;
  $db->connect();
  $db->query("SELECT name FROM course WHERE ID='$course_ID'");
  while($db->getRows())
  { 
  $name=$db->row("name");
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?php echo $name ?></title>
</head>
<frameset rows="20%,80%" ROWS="2" frameborder="yes" border="1" framespacing="0" > 
	<FRAME NAME="les_top" SCROLLING="yes" SRC="preview-top.php" FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">  
	<frameset cols="20%,60%,20%" COLS="2" frameborder="yes" border="1" framespacing="0" style="border:1px solid #000099;">  
	<!--<FRAME NAME="les_main" SRC="show-listing.php?studid=<?php echo $_SESSION['student_id'] ?>&ref=<?php echo $_GET['ref'];?> " FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">-->
	<FRAME NAME="les_main" FRAMEBORDER="no" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	<FRAME NAME="les_tree" SCROLLING="no" SRC="content_courselaunch1.php?sid=<?php echo $_GET['sid'] ?>&ref=<?php echo $_GET['ref'];?>" FRAMEBORDER="no" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	<FRAME NAME="les_main" FRAMEBORDER="no" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0"> 
	</frameset>
</frameset>
<!-- <?php echo $web_dir?>demo_site/components/content_courselaunch1.php?sid=<?php echo $_GET['sid'] ?>&ref=<?php echo $_GET['ref']?>
content_courselaunch1.php?ref=<?php echo $_GET['ref'];?>-->
<NOFRAMES><BODY BGCOLOR="#FFFFFF" TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>

</BODY>
</HTML>