<script type="text/javascript">
	<!--
	function launchCourse(cnum){
		window.open('LMSMain.php?ref='+cnum+'&user_id=<?php echo $lms_userID;?>');
	}
	-->
</script>

<div id="contentEnrollment">
<?php
$sfile=$dir_usercourselist.$lms_userID;
$gfile=$dir_groupfiles.$lms_usergroup_file.".grp";
$mycourses = array();
$mygcourses = array();

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
            $enroll_date[$ecourse_ID]=$db->row("enroll_date");
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
        <th NOWRAP width="55%" class="table-header">
            Course Title
        </th>
        <th width="10%" >Purchased</th>
        <th width="10%" >Expires</th>
        <th width="10%" >Status</th>
        <th width="10%" >&nbsp;</th>
        <th width="10%" >&nbsp;</th>
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
				$enroll_date[$mygcourses[$x]]="NA";
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
				<tr bgcolor="<?=$bgcol;?>">
				<td valign="top" >
                    <a href="#" style="text-decoration:none;color:#000000;" >
                    <b><?php echo $cname[$mycourses[$x]]; ?></b>
                    </a>
				</td>
                <td>
                    <?=$enroll_date[$cID[$mycourses[$x]]]; ?>
                </td>
				<td>
                    <?php
                    $expiration_date = LMS_Utility::get_expiration_date($enroll_date[$cID[$mycourses[$x]]]);
                    $days_remaining = LMS_Utility::date_diff(date('Y-m-d'),$expiration_date);
                    ?>
                    <?=$expiration_date." (".$days_remaining ." days)";?>
                </td>
                <td>
                    <?=ucfirst(($course_status[$mycourses[$x]]));?>
                </td>
                <td>
                    <?php if (LMS_Utility::is_enrollment_expired_by_expire_date($expiration_date)) {?>
                        <a href='#' title="You must re-purchase this course to gain access."> Expired </a>
                    <?php }else { ?>
                        <a href='#' onClick='launchCourse(<?php echo $cID[$mycourses[$x]]; ?>);return false;'> Launch Course </a>
                    <?php } ?>
                </td>
                <td>
                    <?php // Certificate generation link
                       $cert_text = "Certificate";
                       if($course_status[$mycourses[$x]]=="completed" or
                           $course_status[$mycourses[$x]]=="passed" or
                           $course_status[$mycourses[$x]]=="failed"){ ?>
                        <a href="certificate.php?ref=<?=$cID[$mycourses[$x]];?>&userid=<?=$lms_userID;?>"
                           target="_blank" title="Click to generate your completion certificate.">
                            <?=$cert_text;?>
                        </a>
                    <?php } else { ?>
                        <a href="#" title="Certificate available after completion."
                           class="disabled-link"><?=$cert_text;?></a>
                    <?php } ?>
                </td>
				<!--
				<td Valign="TOP">
				<?php
				if($course_status[$mycourses[$x]]!="Complete") {echo "<font COLOR='RED'>";}
				echo $course_status[$mycourses[$x]];?>&nbsp;</font>
				</td>
				<td Valign="TOP">
				<?php if($course_status[$mycourses[$x]]=="completed" or 
				$course_status[$mycourses[$x]]=="passed" or 
				$course_status[$mycourses[$x]]=="failed")
				{
					?>
					[<a href="index.php?section=courselaunch&action=restart&sid=<?php
					echo $sid; ?>&course_ID=<?php echo $cID[$mycourses[$x]]; ?>">Reset
					</a>]
					<?php } else{ ?>
					[<a href="index.php?section=courselaunch&sid=<?php echo $sid;?>&course_ID=<?=$cID[$mycourses[$x]];?>">Details</a>]
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
?>
</table>
</div>
<br/>
<div id="export_data" class="large bold">
    <a href="#" title="Download a copy as an Excel spreadsheet">Export to Excel</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="#" title="Download a copy as a PDF">Print to PDF</a>
</div>