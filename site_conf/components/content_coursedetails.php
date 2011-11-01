<?php
####################################################################################
# Action to add to the user's course list
####################################################################################
$course_ID=$_GET['course_ID'];
if($addcourse=="yes")
{
$userfile = $dir_usercourselist.$lms_userID;
//echo file_exists($userfile)."hello";
  if(file_exists($userfile))
  {
 	
  $userfile=file($userfile);
  $userdata=explode("|",$userfile[0]);
    if(!in_array($course_ID,$userdata))
    {
	
    $newfile=implode("|",$userdata);
    to_file($dir_usercourselist.$lms_userID,"$newfile|$course_ID","w+");
    $ac_message="This course has been <B>added</B> to your enrollment list.";
	/*..Code written by Mr.Balwant....starts here..*/
	$db=new db;
	$qry="select course_id from course where id=".$course_ID;
	$db->connect();
	$db->query($qry);
	while($db->getRows())
	{
		$courseid=$db->row("course_id");
	}
	$str="select * from item_info where type='sco' and course_id='".$courseid."'";
	
	$db->connect();
	$db->query($str);
	$i=0;
	while($db->getRows())
	{
		$str = $db->row("identifier");	
		$clean = preg_replace("/[^0-9]/","",$str);
		$array[$str]=$clean;
		//echo $array["$row->identifier"]."<br><br><br>";
		$i++;
	} 
	
	asort($array);
	foreach($array as $key=>$val)
	{
		$str1="select * from item_info where identifier='".$key."' and course_id='".$courseid."'";
			$db->connect();
			$db->query($str1);
			while($db->getRows()){
					//echo $insrt1."<br>";
					$insrt1="insert into user_sco_info set user_id=".$lms_userID.",course_id='".$courseid."',sco_id='".$db->row("identifier")."',";
					$insrt1.="launch='".$db->row("launch")."',data_from_lms='".$db->row("data_from_lms")."',lesson_status='not attempted',prerequisite='".$db->row("prerequisites")."',";
					$insrt1.="sco_exit='',sco_entry='ab-initio',masteryscore='".$db->row("masteryscore")."',maximumtime='".$db->row("maximumtime")."',";
					$insrt1.="timelimitaction='".$db->row("timelimitaction")."',sequence=".$db->row("sequence").",type='".$db->row("type")."',";
					$insrt1.="cmi_credit='".$db->row("cmi_credit")."'";
					$db->connect();
					$db->query($insrt1);
			}
		
		} 

	/*..Code ends here..*/
	
    }
    else
    {
    $ac_message="This course is <B>already</B> in your enrollment list.";    
    }
  }
  else
  {
 
  to_file($dir_usercourselist.$lms_userID,$course_ID,"w+");
  $ac_message="This course has been <B>added</B> to your enrollment list.";
  /*..Code written by Mr.Balwant....starts here..*/
	$db=new db;
	$qry="select course_id from course where id=".$course_ID;
	$db->connect();
	$db->query($qry);
	while($db->getRows())
	{
		$courseid=$db->row("course_id");
	}
	$str="select * from item_info where type='sco' and course_id='".$courseid."'";
	
	$db->connect();
	$db->query($str);
	$i=0;
	while($db->getRows())
	{
		$str = $db->row("identifier");	
		$clean = preg_replace("/[^0-9]/","",$str);
		$array[$str]=$clean;
		//echo $array["$row->identifier"]."<br><br><br>";
		$i++;
	} 
	
	asort($array);
	foreach($array as $key=>$val)
	{
		$str1="select * from item_info where identifier='".$key."' and course_id='".$courseid."'";
			$db->connect();
			$db->query($str1);
			while($db->getRows()){
					//echo $insrt1."<br>";
					$insrt1="insert into user_sco_info set user_id=".$lms_userID.",course_id='".$courseid."',sco_id='".$db->row("identifier")."',";
					$insrt1.="launch='".$db->row("launch")."',data_from_lms='".$db->row("data_from_lms")."',lesson_status='not attempted',prerequisite='".$db->row("prerequisites")."',";
					$insrt1.="sco_exit='',sco_entry='ab-initio',masteryscore='".$db->row("masteryscore")."',maximumtime='".$db->row("maximumtime")."',";
					$insrt1.="timelimitaction='".$db->row("timelimitaction")."',sequence=".$db->row("sequence").",type='".$db->row("type")."',";
					$insrt1.="cmi_credit='".$db->row("cmi_credit")."'";
					$db->connect();
					$db->query($insrt1);
			}
		
		} 

	/*..Code ends here..*/
  }
}
####################################################################################
# Get Info for the page
####################################################################################

  $db = new db;
  $db->connect();
  $db->query("SELECT created,name,description,type FROM course WHERE ID='$course_ID'");
  while($db->getRows())
  { 
  $name=$db->row("name");
  $created=$db->row("created");
  $type=$db->row("type");
  $description=$db->row("description");
  }
?>


<P>
<A HREF="index.php?section=courselist&sid=<?php echo $sid;?>">Back to Course List.</A>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="550"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2" ALIGN="RIGHT">
    <?php
    if(is_null($ac_message))
    {
    echo"<FONT FACE='VERDANA' SIZE='2'> Add this course to your enrollment list <A HREF='index.php?section=coursedetails&sid=$sid&course_ID=$course_ID&addcourse=yes'><IMG SRC='images/import.gif' BORDER='0' ALIGN='absmiddle' ALT='Add this course to your enrollment list'></A>";
    }
    else
    {
    echo"<FONT FACE='VERDANA' SIZE='2' COLOR='RED'>$ac_message";
    }
    ?>
    </TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Course Name:</B> <?php echo $name;?><BR><B>Created on: </B><?php echo $created;?></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Course Description:</B></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><?php echo nl2br($description);?></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Objectives:</TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><OL>
<?php
  $db2 = new db;
  $db2->connect();
  $db2->query("SELECT objective FROM objectives WHERE course_ID='$course_ID'");
  $xg=0;
  while($db2->getRows())
  { 
  $objective=$db2->row("objective");
  echo"<LI>".nl2br($objective);
  $xg++;
  }
      if($xg<1)
      {
      echo"None.";
      }
?>
    </OL></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2" ALIGN="RIGHT">
    <?php
    if(is_null($ac_message))
    {
    echo"<FONT FACE='VERDANA' SIZE='2'> Add this course to your enrollment list <A HREF='index.php?section=coursedetails&sid=$sid&course_ID=$course_ID&addcourse=yes'><IMG SRC='images/import.gif' BORDER='0' ALIGN='absmiddle' ALT='Add this course to your enrollment list'></A>";
    }
    else
    {
    echo"<FONT FACE='VERDANA' SIZE='2' COLOR='RED'>$ac_message";
    }
    ?>
    </TD>
  </TR>
</TABLE>
</TD></TR></TABLE>                                                                                                                                                                                                                                                                                                                                        