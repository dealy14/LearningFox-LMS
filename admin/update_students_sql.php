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
###############################################################################
# actions for updating students
###############################################################################
 $ID = $_REQUEST['ID'];

if($_REQUEST['action']=="student_details" && $_REQUEST['formAction']=="UPDATE")
{


  //assemble SQL String here;
  $db = new db;
  $db->connect();
  $db->query("SELECT field_name FROM reg_form WHERE forder>=1 AND status='on' AND stored='y'");
  $nx=0;
  $sqla="UPDATE students set ";
  while($db->getRows())
  { 
  $rname=$db->row("field_name");
  $sqlb.=$rname."='".$$rname."',";
  $nx++;
  }
  
  
  $sql = $sqla.$sqlb."userlevel='$userlevel' WHERE ID='$ID'";
  //echo $sql;
  insertAction($sql);

echo "<SCRIPT>top.rmain.student_list.location.reload();</SCRIPT>";
}
###############################################################################
# actions for deleting students
###############################################################################
if($_REQUEST['action']=="student_details" && $_REQUEST['formAction']=="DELETE")
{

/*echo "<SCRIPT>alert('delete..');</SCRIPT>";
*///assemble SQL String here;
$db = new db;
$db->connect();
//$db->query("SELECT field_name FROM reg_form WHERE forder>=1 AND status='on' AND stored='y'");
//$nx=0;
//$sqla="UPDATE students set ";
//while($db->getRows())
//{
//$rname=$db->row("field_name");
//$sqlb.=$rname."='".$$rname."',";
//$nx++;
//}


//$sql = $sqla.$sqlb."userlevel='$userlevel' WHERE ID='$ID'";
//echo $sql;
$sql = "delete from students where ID = '$ID'";
//insertAction($sql);
$db->query($sql);

/*echo"<SCRIPT>opener.location.reload(true);</SCRIPT>";*/
echo"<SCRIPT>top.rmain.location.reload();</SCRIPT>";
}


?>
</body>
</html>
