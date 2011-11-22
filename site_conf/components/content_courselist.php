<div style="width:656px;">
<?php
function getCourseCategory($category_id)
{
   $db = new db;
   $db->connect();
   $db->query("SELECT category_name FROM course_categories WHERE category_id=$category_id");
   while($db->getRows())
   { 
	  return $db->row("category_name");
   }
   $db->close();
   return "";
}
//*************************************************************************************
//course list
//*************************************************************************************
//for non-orgID usage;
if($lms_orgID!="on")
{
?>
<h2 align="center">Courses</h2>
<p>Courses</p>


	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" width="100%">
	<?php
	  $db = new db;
	  $db->connect();
	  $db->query("SELECT created,name,ID,type,category_id FROM course WHERE status='active'");
	  $color_cnt = 0;
	  while($db->getRows())
	  {
		  $course_ID=$db->row("ID");
		  $course_name=$db->row("name");
		  $created=$db->row("created");
		  $type=$db->row("type");
		  $category_id=$db->row("category_id");
		 if($color_cnt == 0)
		 {
		 ?>
		 <tr class="descriptor_row">
		 	<td><FONT FACE="VERDANA" SIZE="2">&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Name&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Course Type&nbsp;</FONT></td>
			<td><FONT FACE="VERDANA" SIZE="2">Category&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Creation Date&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">View Details&nbsp;</FONT></td>
		</tr>
		 <?php
		 }
		 
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
	    <TD><FONT FACE="VERDANA" SIZE="2"><B><?php echo $course_name;?></B></FONT></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $type;?>&nbsp;</FONT></TD>
		<TD><FONT FACE="VERDANA" SIZE="2"><?php echo getCourseCategory($category_id); ?>&nbsp;</FONT></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $created;?>&nbsp;</FONT></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=coursedetails&sid=<?php echo $sid; ?>&course_ID=<?php echo $course_ID;?>">Details</A>]</FONT></TD>
	  </TR>
	<?php  
	  }
	?>
	  </TABLE>
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
		<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8" width="100%">
		<?php
	  		$color_cnt = 0;
		  $db = new db;
		  $db->connect();
		  $db->query("SELECT created,name,ID,type,category_id FROM course WHERE status='active' AND ID='' $db_clause");
		  while($db->getRows())
		  {
		  $course_ID=$db->row("ID");
		  $course_name=$db->row("name");
		  $created=$db->row("created");
		  $type=$db->row("type");
          $category_id=$db->row("category_id");
		 if($color_cnt == 0)
		 {
		 ?>
		 <tr class="descriptor_row">
		 	<td><FONT FACE="VERDANA" SIZE="2">&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Name&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Course Type&nbsp;</FONT></td>
			<td><FONT FACE="VERDANA" SIZE="2">Category&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Creation Date&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">View Details&nbsp;</FONT></td>
		</tr>
		 <?php
		 }
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
		    <TD><FONT FACE="VERDANA" SIZE="2"><B><?php echo $course_name;?>&nbsp;</B></FONT></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $type;?>&nbsp;</FONT></TD>
			<TD><FONT FACE="VERDANA" SIZE="2"><?php echo getCourseCategory($category_id); ?>&nbsp;</FONT></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $created;?>&nbsp;</FONT></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=coursedetails&sid=<?php echo $sid; ?>&course_ID=<?php echo $course_ID;?>">Details</A>]</FONT></TD>
		  </TR>
		<?php  
		  }
		?>
		</TABLE>
	    
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
   

	    <p>Surveys&nbsp;</p>

	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" width="100%">
	<?php
	
	  $color_cnt = 0;
	  $dbt = new db;
	  $dbt->connect();
	  $dbt->query("SELECT name, ID, type FROM tests WHERE status='active';");
	  while($dbt->getRows())
	  {
	  	$survey_ID=$dbt->row("ID");
		$survey_name=$dbt->row("name");
		$type=$dbt->row("type");

		 if($color_cnt == 0)
		 {
		 ?>
		 <tr class="descriptor_row">
		 	<td><FONT FACE="VERDANA" SIZE="2">&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Name&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Survey Type&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">View Details&nbsp;</FONT></td>
		</tr>
		 <?php
		 }
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
		  <TR BGCOLOR="<?=$bgcol;?>">
		    <TD><IMG SRC="images/course_list1.gif" BORDER="0" ALIGN="ABSMIDDLE"></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2"><B><?php echo $survey_name;?>&nbsp;</B></FONT></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $type;?>&nbsp;</FONT></TD>
		    <TD><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=surveydetails&sid=<?php echo $sid; ?>&survey_ID=<?php echo $survey_ID;?>">Details</A>]</FONT></TD>
		  </TR>
		<?php  
		
	  }
	
	?>
	</TABLE>

</div>