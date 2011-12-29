<?php
	session_start();
	session_register("username");
	
	//$launch_size=file($dir_layout.$course_ID);
	$hw=explode("|", $launch_size[0]);
	//include($dir_includes."lt_track.php");
?>
	
<script type="text/javascript">
	function launchCourse(cnum) {
		//newWin=window.open('../'+cnum+'/index.php?user_ID=<?php echo $lms_userID;?>',
				//	'LT_COURSE','width=<?php echo $hw[0];?>, height=<?php echo $hw[1];?>');
		window.open('LMSMain.php?ref='+cnum+'&user_id=<?php echo $lms_userID;?>');
	}
</script>
	
<?php
	
	//* Balwant code starts here *//

	if(isset($_GET['action'])) {
		if($_GET['action']=='restart') {
			$upuser_sco = "update user_sco_info set lesson_status='not attempted', " .
			 				"sco_exit='', sco_entry='ab-initio', total_time='00:00:00.00', " . 
							"score=0, lesson_location=''";
			$upuser_sco .= " where user_id = " . $lms_userID . " and course_id='course-" . $course_ID . "'";
			$db = new db;
			$db->connect();
			$db->query($upuser_sco);
			//echo $upuser_sco;
			//echo "<script language='javascript'>window.open('LMSMain.php?ref=".$_GET['courseid'].
					//"&user_id=".$_GET['userid']."');</script>";
			//echo "<script>alert('".$upuser_sco."');";
		}
	}

	//* Balwant code ends here *//
	
	
	####################################################################################
	# Get Info for the page
	####################################################################################
	//echo "hello".$course_ID.$lms_userID;
	//$time = date(g:i ); 
	// print strftime('%c');
	
	// echo strftime('%l:%M %p', strtotime('14:35:00'));
	$db = new db;
	$db->connect();
	$db->query("SELECT created,name,description,type FROM course WHERE ID='$course_ID'");
  	while($db->getRows()) {   
	  $name=$db->row("name");
	  $created=$db->row("created");
	  $type=$db->row("type");
	  $description=$db->row("description");
	}  
  	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM course_history WHERE user_ID='$lms_userID' AND course_ID='$course_ID'");
	$xg=0;
	while($db->getRows()) { 
 		$ecourse_ID=$db->row("course_ID");
		$start_date=$db->row("start_date");	 
		$last_usage=$db->row("last_usage");
		$elesson = $db->row("lesson");		 
		$etopic = $db->row("topic");			 
		$course_status = $db->row("course_status");	
		$total_time = date("H:i:s", mktime (0,0,$db->row("total_time")));		
		$total_score = $db->row("total_score");	
	 	$xg++; 
    }

	$smessage = " Start course";	 
	if($xg >= 1) {
		$smessage=" Continue course";

		//get total score average;
		if(file_exists($dir_testlogs . $lms_userID . "_" . $course_ID)) {
			$scores = file($dir_testlogs . $lms_userID . "_" . $course_ID);
			$allscores = explode("|", $scores[0]);
			$score_total = array_sum($allscores);
			$score_average = round($score_total/(count($allscores) - 1)); } 
		?>
	
		<table border="0" cellspacing="2" cellpadding="0" width="600">
		  <tr>
		    <td colspan="4" bgcolor="#eaeaea"><img src="images/c_progress.gif"></td>
		  </tr>
		  <tr bgcolor="#eaeaea">
		    <td><font face='Verdana' size='2'><b>Date Started:</b></font</td>
		    <td><font face='Verdana' size='2'><?php echo $start_date; ?></font</td>	
		    <td><font face='Verdana' size='2'><b>Course Status:</b></font</td>
		    <td><font face='Verdana' size='2'><?php echo $course_status; ?></font</td>	
		  </tr>
		  <tr bgcolor="#eaeaea">
		    <td><font face='Verdana' size='2'><b>Last Attempt:</b></font</td>
		    <td><font face='Verdana' size='2'><?php echo $last_usage; ?></font</td>	
		    <td><font face='Verdana' size='2'><b>Total Time:</b></font></td>
		    <td><font face='Verdana' size='2'><?php echo $total_time; ?></font</td>	
		  </tr>
		  <tr bgcolor="#eaeaea">
		    <td><font face='Verdana' size='2'><b>Last Lesson/topic:</b></font></td>
		    <td><font face='Verdana' size='2'><?php echo "$elesson/$etopic"; ?></font</td>	
		    <td><font face='Verdana' size='2'><b>Score Average:</b></font></td>
		    <td><font face='Verdana' size='2'><?php echo $total_score; ?>%</font></td>	
		  </tr>    
		</table>

	<?php } ?>

<p>
	<a href="index.php?section=enrollment&sid=<?php echo $sid; ?>">Back to Enrollment List.</a>
</p>

<table border="0" cellspacing="0" cellpadding="0" width="600">
  <tr>
     <td bgcolor="#eaeaea">
		<table border="0" cellspacing="0" cellpadding="4" width="100%">
		  <tr bgcolor="#eaeaea">
			<td colspan="2" align="right">
				<font face='Verdana' size='2'><?php 
					echo $smessage; 
					?>
				  <a href='' onClick='launchCourse(<?php echo $course_ID; ?>); return false;'>
				  <img src='images/import.gif' border='0' align='absmiddle' alt='Begin this course'></a>
				</font>
			</td>
		  </tr>
		<tr bgcolor="#FFFFFF">
		  <td colspan="2">
			<font face="Verdana" size="2">
				<b>Course Name:</b> <?php echo $name; ?><br>
				<b>Created on:</b> <?php echo $created; ?>
			</font>
		  </td>
		</tr>
		<tr bgcolor="#FFFFFF">
	      <td colspan="2"><font face="Verdana" size="2"><b>Course Description:</b></font></td>
	  	</tr>
	  	<tr bgcolor="#FFFFFF">
	      <td colspan="2"><font face="Verdana" size="2"><?php echo nl2br($description);?></font></td>
	  	</tr>
		<tr bgcolor="#FFFFFF">
	      <td colspan="2"><font face="Verdana" size="2"><b>Objectives:</b></font></td>
	  	</tr>
	  	<tr bgcolor="#FFFFFF">
		  <td colspan="2">
		    <font face="Verdana" size="2">
		     <ol>
		 	  <?php 
			    $db2 = new db;
			    $db2->connect();
			    $db2->query("SELECT objective FROM objectives WHERE course_ID='$course_ID'");
			    while($db2->getRows()) {
			  	  $objective = $db2->row("objective");
				  echo "<li>" . nl2br($objective) . "</li>";
			    }
			  ?>
		     </ol>
			</font>
		  </td>
		</tr>
	  	<tr bgcolor="#FFFFFF">
	      <td colspan="2"><font face="Verdana" size="2"><b>Library References:</b></font></td>
	  	</tr>
	  	<tr bgcolor="#FFFFFF">
		  <td colspan="2"><font face="Verdana" size="2">
		    <ul>
		  	<?php
			  $db2 = new db;
			  $db2->connect();
			  $db2->query("SELECT * FROM ref WHERE course_ID='$course_ID'");
			  while($db2->getRows()) { 
			  	echo "<li><i><a href='../references/" . $db2->row("filename") . "'" . 
						" TARGET='_blank'>" . $db2->row("rname") . "</i></a>: ";
			  	echo nl2br($db2->row("description")) . "</li>";
			  }
			?>
		    </ul>
			</font>
		  </td>
		</tr>  
		<tr bgcolor="#eaeaea">
	   	  <td colspan="2" align="right">
		    <font face='Verdana' size='2'><?php echo $smessage; ?>
		      <a href='#' onClick='launchCourse($course_ID);return false;'>
			  <img src='images/import.gif' border='0' align='absmiddle' alt='Begin this course'>
			  </a>
			</font>
		  </td>
		</tr>
      </table>
    </td>
  </tr>
</table>