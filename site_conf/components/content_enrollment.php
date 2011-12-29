<div id="contentEnrollment">

<h2 align="center">Your Transcript</h2>
<div align="center">
<?php include($dir_components."enrollment_toolbar.php"); ?>
</div>

<?php
$sfile=$dir_usercourselist.$lms_userID;
$gfile=$dir_groupfiles.$lms_usergroup_file.".grp";
if(file_exists($sfile)||file_exists($gfile))
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
	if(count($mycourses)>=1||count($mygcourses)>=1)
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
		$db->query("SELECT * FROM course_history WHERE user_ID=$lms_userID");
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
if($mycourses[0]!="" || $mygcourses[0]!="")
{
	?>
	Courses
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" width="100%">
	<TR  class="descriptor_row">
	<td><font face="VERDANA" SIZE="1">&nbsp;</font></td>		
	<td NOWRAP><font face="VERDANA" SIZE="2">Course Title</font></td>
	<td NOWRAP><font face="VERDANA" SIZE="2">Date Started</font></td>
	<td NOWRAP><font face="VERDANA" SIZE="2">Last Attempt</font></td>	   
	<td NOWRAP><font face="VERDANA" SIZE="2">Course Status</font></td>
	<td><font face="VERDANA" SIZE="1">&nbsp;</font></td>	   
	</TR>
	<?php
}
###############################################################################
# Personal Enrollment List here
###############################################################################	    
if($mycourses[0]!="")
{
	$x=0;
	while($x<count($mycourses))
	{
		if(@!in_array($mycourses[$x],$mygcourses))
		{
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
			else
			{
				$bgcol="#FFFFFF";	 
				$color_cnt=1;
			}
			?>
			<?php if(!is_null($cID[$mycourses[$x]])&&($course_status[$mycourses[$x]]=="completed" || $course_status[$mycourses[$x]]=="passed" || $course_status[$mycourses[$x]]=="failed"))
			{
				?>
				<TR bgcolor="<?php echo $bgcol;?>">
				<td VALIGN="TOP"><font face="VERDANA" SIZE="2"><IMG SRC="images/course_list2.gif" BORDER="0" ALT="Click for more details on <?php echo $cname[$mycourses[$x]]; ?>"></font></td>
				<td VALIGN="TOP"><font face="VERDANA" SIZE="2"><B><?php echo $cname[$mycourses[$x]]; ?></B></font></td>	   
				<td VALIGN="TOP"><font face="VERDANA" SIZE="2"><?php echo $start_date[$mycourses[$x]]; ?></font></td>
				<td VALIGN="TOP"><font face="VERDANA" SIZE="2"></font></td>
				<td VALIGN="TOP"><font face="VERDANA" SIZE="2"><?php if($course_status[$mycourses[$last_usage[$mycourses[$x]]]]!="completed")
				{
					echo "<font color='RED'>";
				}
				echo $course_status[$mycourses[$x]];?></font></td>
				<td VALIGN="TOP"><font face="VERDANA" SIZE="2">[<A HREF="index.php?section=courselaunch&sid=<?php echo $sid; ?>&course_ID=<?php echo $cID[$mycourses[$x]]?>">Details</A>]</font></td>
				</TR>
				<?php }?>
			<?php  
		}
		$x++;
	}
	}	 
###############################################################################
# Group Enrollment List here
###############################################################################
if(count($mygcourses)>=1&&$mygcourses[0]!=""&&$lms_groups=="on")
{
	?>
	<tr>
	<td colspan="6" bgcolor="#FFFFFF"><font face="VERDANA" SIZE="2">The courses below were added to your list by your administrator.</font></td>
	</tr>
	<?php
	$xn=0;
	while($xn<count($mygcourses))
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
		else
		{
			$bgcol="#FFFFFF";	 
			$color_cnt=1;
		}
		?>
					
		<?php if(!is_null($cID[$mygcourses[$xn]]) && 
					($course_status[$mycourses[$x]]=="completed" || 
					 $course_status[$mycourses[$x]]=="passed" || 
					 $course_status[$mycourses[$x]]=="failed")){ ?>
		     <tr bgcolor="<?php echo $bgcol; ?>">
		       <td Valign="TOP"><a href="#">
			   	 <font face="Verdana" size="2">
				  <img src="images/course_list3.gif" border="0" 
				 		alt="Click for more details on <?php echo $cname[$mygcourses[$xn]];?>">
				 </font></a>
			   </td>
		       <td Valign="TOP">
			   		<a href="#" style="text-decoration:none;color:#000000;">
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
		   				  if ($course_status[$mygcourses[$xn]] != "completed")
						  		{ echo "<font color='RED'>"; }
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
</div>
