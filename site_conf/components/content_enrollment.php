<div id="contentEnrollment">
<!--
<h2 align="center">Your Transcript</h2>
<div align="center"><?php 
/* include($dir_components."enrollment_toolbar.php"); */ ?>
</div>
-->
<?php
$sfile=$dir_usercourselist.$lms_userID;
$gfile=$dir_groupfiles.$lms_usergroup_file.".grp";
if(file_exists($sfile) || file_exists($gfile))
{
	if(file_exists($sfile))
	{
		$mycourses=file($sfile);
		$mycourses=explode("|",$mycourses[0]);
	}
	if(file_exists($gfile))
	{
		$mygcourses=file($gfile);
		$mygcourses=explode("|",$mygcourses[0]);
	}
	if(count($mycourses) >= 1 || count($mygcourses) >= 1)
	{
		//get course info;
		$db = new db;
		$db->connect();
		$db->query("SELECT created,name,ID,type FROM course WHERE status='active'");
		while($db->getRows())
		{
			$course_ID=$db->row("ID");
			$cID[$course_ID]=$db->row("ID");
			$cname[$course_ID]=$course_name=$db->row("name");
			$ccreated[$course_ID]=$db->row("created");
			$ctype[$course_ID]=$db->row("type");
		}
		//get user course history info;
		$db = new db;
		$db->connect();
		$db->query("SELECT * FROM course_history WHERE user_ID='$lms_userID'");
		while($db->getRows())
		{
			$ecourse_ID=$db->row("course_ID");
			$start_date[$ecourse_ID]=$db->row("start_date");	 
			$last_usage[$ecourse_ID]=$db->row("last_usage");
			$course_status[$ecourse_ID]=$db->row("course_status");
			$elesson[$ecourse_ID]=$db->row("lesson");		 
			$etopic[$ecourse_ID]=$db->row("topic");
		}
	}
}
if($mycourses[0] != "" || $mygcourses[0] != "")
{
	?>
	<table border="0" cellspacing="1" cellpadding="4" width="100%">
	<tr class="descriptor_row">
	<th NOWRAP width="80%">
	<font face="Verdana" size="2" >Course Title</font>
	</th>
	<th width="20%">
	<font face="Verdana" size="2">&nbsp;</font>
	</th>
	</tr>
	<?php } ?>
<?php
###############################################################################
# Personal Enrollment List here
###############################################################################	    
if ($mycourses[0] != "") /* start IF_A1 */ {
	$x=0;
	while($x<count($mycourses)) /* start WHILE_A1 */ {
		if(@!in_array($mycourses[$x],$mygcourses)) /* start IF_B1 */ {
			if($start_date[$mycourses[$x]]=="")
			{
				$start_date[$mycourses[$x]]="NA";
				$last_usage[$mycourses[$x]]="NA";
				$course_status[$mycourses[$x]]="Not Started";
			}
			if(!$color_cnt||$color_cnt==1)
			{
				$bgcol="#f8f8ff";
				$color_cnt=2;
			}
			else {
				$bgcol="#FFFFFF";	 
				$color_cnt=1;
			}
			?>
			<?php if (!is_null($cID[$mycourses[$x]])) /* start IF_B2 */ { ?>
				<tr bgcolor="<?php echo $bgcol; ?>">
				<td valign="top">
				<a href="#" style="text-decoration:none;color:#000000;" >
				<font face="Verdana" size="2">
				<b><?php echo $cname[$mycourses[$x]]; ?></b>
				</font>
				</a>
				</td>	
				<td>
				<a href='#' onClick='launchCourse(<?php echo $cID[$mycourses[$x]]; ?>);return false;'> Launch Course </a>
				</td>   
				<!--
				<td Valign="TOP">
				<font face="Verdana" size="2">
				<?php if($course_status[$mycourses[$x]]!="Complete")
				{
					echo"<font COLOR='RED'>";
				}
				echo $course_status[$mycourses[$x]];?>&nbsp;</font>
				</td>
				<td Valign="TOP">
				<?php if($course_status[$mycourses[$x]]=="completed" or 
				$course_status[$mycourses[$x]]=="passed" or 
				$course_status[$mycourses[$x]]=="failed")
				{
					?>
					<font face="Verdana" size="2">
					[<a href="index.php?section=courselaunch&action=restart&sid=<?php
					echo $sid; ?>&course_ID=<?php echo $cID[$mycourses[$x]]; ?>">Reset
					</a>]
					</font>
					<?php }else{ ?>
					<font face="Verdana" size="2">
					[<a href="index.php?section=courselaunch&sid=<?php echo $sid;?>&course_ID=<?php echo $cID[$mycourses[$x]];?>">Details</a>]
					</font>
					<?php }  /* end IF_B3 */ ?>
				</td>
				-->
				</tr>
				<?php	 
				}  /* end IF_B2 */
			?>
			<?php
			}  /* end IF_B1 */ 
		?>
		<?php
		$x++;
	}
	/* end WHILE_A1 */ 
}
/*
###############################################################################
# Group Enrollment List here
###############################################################################
if(count($mygcourses) >=1 && $mygcourses[0] !="" && $lms_groups == "on")
{
	?>
	<tr>
	<td colspan="6" bgcolor="#FFFFFF"><font face="Verdana" size="2"><br>The courses below were added to your list by your administrator.</font></td>
	</tr>
	<?php
	$xn=0;
	while($xn < count($mygcourses))
	{
		if($start_date[$mygcourses[$xn]]=="")
		{
			$start_date[$mygcourses[$xn]]="NA";
			$last_usage[$mygcourses[$xn]]="NA";
			$course_status[$mygcourses[$xn]]="Not Started";
		}
		if(!$color_cnt||$color_cnt==1)
		{
			$bgcol="#f8f8ff";
			$color_cnt=2;
		}
		else {
			$bgcol="#FFFFFF";	 
			$color_cnt=1;
		}
		?>
		<?php if(!is_null($cID[$mygcourses[$xn]]))
		{
			?>
			<tr bgcolor="<?php echo $bgcol; ?>">
			<td Valign="TOP"><a href="#">
			<font face="Verdana" size="2">
			<img src="images/course_list3.gif" border="0" 
			alt="Click for more details on <?php echo $cname[$mygcourses[$xn]];?>">
			</font></a>
			</td>
			<td Valign="TOP">
			<a href="#" STYLE="text-decoration:none;color:#000000;">
			<font face="Verdana" size="2">
			<b><?php echo $cname[$mygcourses[$xn]];?></b>
			</font>
			</a>
			</td>	   
			<td Valign="TOP"><font face="Verdana" size="2"><?php echo $start_date[$mygcourses[$xn]];?></font></td>
			<td Valign="TOP"><font face="Verdana" size="2"><?php echo $last_usage[$mygcourses[$xn]];?></font></td>
			<td Valign="TOP">
			<font face="Verdana" size="2">
			<?php 
			if ($course_status[$mygcourses[$xn]] != "Complete")
			{
				echo "<font COLOR='RED'>";
			}
			echo $course_status[$mygcourses[$xn]];
			?>
			</font>
			</td>
			<td Valign="TOP">
			<font face="Verdana" size="2">
			[<a href="index.php?section=courselaunch&sid=<?php echo $sid;?>&course_ID=<?php echo $cID[$mygcourses[$xn]];?>">Details</a>]
			</font>
			</td>
			</tr>
			<?php } ?>
		<?php 
		$xn++;
	}
}
if($mycourses[0]!="" || $mygcourses[0]!="")
{
	?>
	</table>
	<?php
	}   
if(count($mycourses)<1||$mycourses[0]=="")
{
	echo"<p>You have no courses in your personal enrollment list at this time.<br>Add courses by going to the <a href='index.php?section=courselist&sid=$sid'>Course List</a> section to see what's available..</p>";
}
else if(count($mygcourses)<1||$mygcourses[0]=="")
{
	echo"<p>You have no courses in your group enrollment list at this time.</p>";
}
?>
<?php
//*************************************
//survey list
//*************************************
//surveys enrolled for the logedin student
$dbsurvey = new db;
$dbsurvey->connect();
$dbsurvey->query("SELECT user_surveys.ID,user_surveys.student,user_surveys.survey,tests.name,tests.type,tests.description FROM user_surveys, tests WHERE user_surveys.survey = tests.ID and user_surveys.student=$lms_userID");
?>
<p>Surveys</p>
<table border="0" cellspacing="1" cellpadding="4" width="100%">
<tr class="descriptor_row">
<td><font face="Verdana" size="2" >&nbsp;</font></td>		
<td NOWRAP><font face="Verdana" size="2">Survey Title</font></td>  
<td NOWRAP><font face="Verdana" size="2" >Survey Type</font></td>
<td><font face="Verdana" size="2">&nbsp;</font></td>	   
</tr>
<?php
while($dbsurvey->getRows())
{
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
	<tr bgcolor="<?php echo $bgcol;?>" >
	<td Valign="TOP"><a href="#"><font face="Verdana" size="2"><img src="images/course_list2.gif" border="0" alt="Click for more details on <?php echo  $dbsurvey->row("name");?>"></font></a></td>
	<td Valign="TOP"><a href="#" STYLE="text-decoration:none;color:#000000;"><font face="Verdana" size="2"><b><?php echo $dbsurvey->row("name");?></b></font></a></td>	   
	<td Valign="TOP"><font face="Verdana" size="2"><?php echo  $dbsurvey->row("type");?></font></td>
	<td Valign="TOP"><font face="Verdana" size="2">[<a target="_blank" href= "surveys/survey.php?sid=<?php echo $sid;?>&survey_ID=<?php echo $dbsurvey->row('survey');?>">Launch</a>]</font></td>
	</tr>
	<?php
}
*/
?>
</table>
</div>
<script type="text/javascript">
<!--

function launchCourse(cnum)
{
	window.open('LMSMain.php?ref='+cnum+'&user_id=<?php echo $lms_userID;?>');
}
-->
</script>