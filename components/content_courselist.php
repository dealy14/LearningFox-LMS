<?php

//*************************************************************************************
//course list
//*************************************************************************************
//for non-orgID usage;
if($lms_orgID!="on")
{
?>
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#EAEAEA">
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	<?php
	  $db = new db;
	  $db->connect();
	  $db->query("SELECT created,name,ID,type FROM course WHERE status='active'");
	  while($db->getRows())
	  {
		  $course_ID=$db->row("ID");
		  $course_name=$db->row("name");
		  $created=$db->row("created");
		  $type=$db->row("type");

		 if(!$color_cnt||$color_cnt==1)
		 {
		 $bgcol="#f8f8ff";
		 $color_cnt=2;
		 }
		 else
		 {
		 $bgcol="#FFFFFF";	 
		 $color_cnt=1;	 
		 }
	?>
	  <TR BGCOLOR="<?php echo $bgcol;?>">
	  	<TD><IMG SRC="images/course_list1.gif" BORDER="0" ALIGN="ABSMIDDLE"></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><B><?php echo $course_name;?></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2">Course Type: <?php echo $type;?></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2">Created on: <?php echo $created;?></TD>
	    <TD><A HREF="#"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=coursedetails&sid=<?php echo $sid; ?>&course_ID=<?php echo $course_ID;?>">Details</A>]</TD>
	  </TR>
	<?php  
	  }
	?>
		</TABLE>
		</TD></TR></TABLE>
<?php
}
else
{

	if(file_exists($dir_orgfile.$lms_org))
	{
	//open org course files;
	$org_courses=file($dir_orgfile.$lms_org);
	$course_list=explode("||","||".$org_courses[0]);
	
	if(count($course_list)>=1)
	{
	$db_clause=@implode(" OR ID=",$course_list);
	}
	
	//echo"SELECT created,name,ID,type FROM course WHERE status='active' $db_clause";
	?>
		<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8">
		<?php
		  $db = new db;
		  $db->connect();
		  $db->query("SELECT created,name,ID,type FROM course WHERE status='active' AND ID='' $db_clause");
		  while($db->getRows())
		  {
		  $course_ID=$db->row("ID");
		  $course_name=$db->row("name");
		  $created=$db->row("created");
		  $type=$db->row("type");

			 if(!$color_cnt||$color_cnt==1)
			 {
			 $bgcol="#f8f8ff";
			 $color_cnt=2;
			 }
			 else
			 {
			 $bgcol="#FFFFFF";	 
			 $color_cnt=1;	 
			 }
		?>
		  <TR BGCOLOR="<?php echo $bgcol;?>">
		    <TD><IMG SRC="images/course_list1.gif" BORDER="0" ALIGN="ABSMIDDLE"></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2"><B><?php echo $course_name;?></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2">Course Type: <?php echo $type;?></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2">Created on: <?php echo $created;?></TD>
		    <TD><A HREF="#"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=coursedetails&sid=<?php echo $sid; ?>&course_ID=<?php echo $course_ID;?>">Details</A>]</TD>
		  </TR>
		<?php  
		  }
		?>
		</TABLE>
		</TD></TR></TABLE>
	<?php
	}
	else
	{
	echo"There are no courses at this time.";
	}
}

//*************************************************************************************
//survey list
//*************************************************************************************

?>	
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#EAEAEA">
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	<?php
	
	  $dbt = new db;
	  $dbt->connect();
	  $dbt->query("SELECT name, ID, type FROM tests WHERE status='active';");
	  while($dbt->getRows())
	  {
	  	$survey_ID=$dbt->row("ID");
		$survey_name=$dbt->row("name");
		$type=$dbt->row("type");

		if(!$color_cnt||$color_cnt==1)
		{
			$bgcol="#f8f8ff";
			$color_cnt=2;
		}
		else
		{
			$bgcol="#FFFFFF";	 
			$color_cnt=1;	 
		}
		
		?>
		  <TR BGCOLOR="<?php echo $bgcol;?>">
		    <TD><IMG SRC="images/course_list1.gif" BORDER="0" ALIGN="ABSMIDDLE"></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2"><B><?php echo $survey_name;?></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2">Course Type: <?php echo $type;?></TD>
		    <TD><A HREF="#"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=surveydetails&sid=<?php echo $sid; ?>&survey_ID=<?php echo $survey_ID;?>">Details</A>]</TD>
		  </TR>
		<?php  
		
	  }
	
	?>
	</TABLE>
</TD></TR></TABLE>
