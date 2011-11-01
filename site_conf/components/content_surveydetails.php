<?php
####################################################################################
# Action to add to the user's course list
####################################################################################
if( isset( $_GET['survey_ID'] ) && !empty( $_GET['survey_ID'] ) && !ereg('[^0-9]',  $_GET['survey_ID']  ) )
{
	$survey_ID= $_GET['survey_ID'];
	if($_GET['addcourse']=="yes")
	{
		/*
			$userfile = $dir_usercourselist.'t'.$lms_userID;
		  if(file_exists($userfile))
		  {
			  $userfile=file($userfile);
			  $userdata=explode("|",$userfile[0]);
				if(!in_array($survey_ID,$userdata))
				{
					$newfile=implode("|",$userdata);
					to_file($dir_usercourselist.'t'.$lms_userID,"$newfile|$survey_ID","w+");
					$ac_message="This course has been <B>added</B> to your enrollment list.";
				}
				else
				{
					$ac_message="This course is <B>already</B> in your enrollment list.";    
				}
		  }
		  else
		  {
			  to_file($dir_usercourselist.'t'.$lms_userID,$survey_ID,"w+");
			  $ac_message="This course has been <B>added</B> to your enrollment list.";
		  }
		  */
		  
		  //*************************************
		  //add course to database.
		  //*************************************
		  //check if alreaddy in list
		  $dbsurvey = new db;
		  $dbsurvey->connect();
		  $dbsurvey->query("SELECT id FROM user_surveys WHERE survey=$survey_ID and student=$lms_userID");
		  if($dbsurvey->getRows())
		  {
			$ac_message="This course is <B>already</B> in your enrollment list."; 
		  }
		  else
		  {
		  	$dbi = new db;
			$dbi->connect();
			$dbi->query("insert into user_surveys ( survey, student) values ($survey_ID, $lms_userID);");
			$dbi->getRows();
			$ac_message="This course has been <B>added</B> to your enrollment list.";
		  }
	}
}

####################################################################################
# Get Info for the page
####################################################################################

  $db = new db;
  $db->connect();
  $db->query("SELECT name,description,type FROM tests WHERE ID='$survey_ID'");
  while($db->getRows())
  { 
  $name=$db->row("name");
  $type=$db->row("type");
  $description=$db->row("description");
  }
?>


<P>
<A HREF="index.php?section=courselist&sid=<?php echo $sid; ?>">Back to Course List.</A>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="550"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2" ALIGN="RIGHT">
    <?php
    if(is_null($ac_message))
    {
    echo"<FONT FACE='VERDANA' SIZE='2'> Add this course to your enrollment list <A HREF='index.php?section=surveydetails&sid=$sid&survey_ID=$survey_ID&addcourse=yes'><IMG SRC='images/import.gif' BORDER='0' ALIGN='absmiddle' ALT='Add this course to your enrollment list'></A>";
    }
    else
    {
    echo"<FONT FACE='VERDANA' SIZE='2' COLOR='RED'>$ac_message";
    }
    ?>
    </TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Course Name:</B> <?php echo $name;?><BR></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Course Description:</B></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><?php echo nl2br($description);?></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2" ALIGN="RIGHT">
    <?php
    if(is_null($ac_message))
    {
    echo"<FONT FACE='VERDANA' SIZE='2'> Add this course to your enrollment list <A HREF='index.php?section=surveydetails&sid=$sid&course_ID=$course_ID&addcourse=yes'><IMG SRC='images/import.gif' BORDER='0' ALIGN='absmiddle' ALT='Add this course to your enrollment list'></A>";
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
                                                                                                                                                                                                                                                                                                                                         