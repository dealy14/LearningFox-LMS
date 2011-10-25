<?php
####################################################################################
# Action to add to the user's course list
####################################################################################
if($addcourse=="yes")
{
$userfile = $dir_usercourselist.$lms_userID;
  if(file_exists($userfile))
  {
  $userfile=file($userfile);
  $userdata=explode("|",$userfile[0]);
    if(!in_array($course_ID,$userdata))
    {
    $newfile=implode("|",$userdata);
    to_file($dir_usercourselist.$lms_userID,"$newfile|$course_ID","w+");
    $ac_message="This course has been <B>added</B> to your enrollment list.";
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
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="80%"><TR><TD BGCOLOR="#CCCCCC">
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
                                                                                                                                                                                                                                                                                                                                         