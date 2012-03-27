<?php
require_once("../conf.php");

function update_LMS($payment_data, $dir_usercourselist) {
	
	$payment_date = $payment_data['payment_date'];
	$course_array = $payment_data['course_info'];
	/*
	$body .=  "\n\n".$sql;
	$body .=  "\n\n".$ac_message;
	$fp=fopen("log.txt",'a');
	fwrite($fp, $body . "\n\n");
	fclose($fp);
	*/
	
	
	$username = $payment_data['email'];
    $password = generatePassword(5, 4);
	$password_hashed = sha1($username.$password);
	
    $sql1 = "SELECT * FROM `students` WHERE `username` = '" . $username . "'";

    $db = new db;

    /*
	    $sql2 = "INSERT INTO students (" .
                "`date_of_reg` , `date_of_mod`  , `fname` ," .
                "`lname` , `mname` , `orgID` , `user_group` , `user_subgroup` ," .
                "`date_of_birth` , `sex` , `phone` , `email` , `address`," .
                "`city` , `state` , `zip` , `username` , `password` ," .
                "`userlevel` )	VALUES (" .
                "CURDATE(), CURDATE() , '" . $payment_data['first_name'] .
                "', '" . $payment_data['last_name'] . "', '', '', '', '', '00000000', " .
				"'na', '" . $payment_data['phone'] . "', '" . $payment_data['email'] . 
				"', '" . $payment_data['address'] . " " . $payment_data['address2'] . 
				"', '" . $payment_data['city'] . "', '" . $payment_data['state'] . 
				"', '" . $payment_data['zip'] . "', '" . $username . 
				"', '" . 
				$db->escape_string($password_hashed) . 
				"', '1' );";
*/


		
	$db->connect();
	$db->query($sql1);
	if (!$db->getRows()) {  // if no student in DB with given email, insert the new student
		register_student($payment_data['payment_date'],$payment_data['first_name'],$payment_data['last_name'],
						$payment_data['phone'],$payment_data['email'],$payment_data['address'],
						$payment_data['address2'],$payment_data['city'],$payment_data['state'],
						$payment_data['zip'],$db->escape_string($password_hashed));
		$db->connect();
		$db->query($sql1); // re-run query to grab newly-inserted student record
						// NOTE: this may seem redundant, but we need to grab 
						//       the autonumber ID of the new record
		$db->getRows();
	
	}
	else{ //student already exists
    	//do not re-send password, as it is now hashed
    	$password = "<password not displayed>";
	}

	$lms_userID = $db->row('ID');
	//$password = $db->row('password');
	$db->close();
	
	//$lms_userID = 13;
	//$course_ID = 54;
	
	$userfile = $dir_usercourselist . $lms_userID;
	
	//echo "lms_userID =".$lms_userID."<br>";
	//echo "userfile =".$userfile."<br>";
	
	$ac_message = "";
	
	if (file_exists($userfile)) {
		$userfile = file($userfile);
		$userdata = explode("|", $userfile[0]);
		
		$db->connect();
		
		foreach ($course_array as $course){
			$course_ID = $course['courseid'];
			
			insertAction("INSERT INTO course_history ".
			"(user_ID,course_status,start_date,course_id) ".
			"VALUES ('" . $lms_userID . "','Not Attempted',CURDATE()," . $course_ID . ")");
			
			register_student_in_course($lms_userID,'course-'.$course_ID);
			
			if (!in_array($course_ID, $userdata)) {
				$newfile = implode("|", $userdata);
				to_file($dir_usercourselist . $lms_userID, "$newfile|$course_ID", "w+");
				$ac_message .= $course['coursename']." has been added to your enrollment list.\n";
				} else {
				$ac_message .= $course['coursename']." is already in your enrollment list.\n";
			}
		}
		
		$db->close();

		} else {
		/* echo "<pre>";
		print_r($course_array);
		echo "</pre>";
		*/
		foreach ($course_array as $course){
			$course_id_array[] = $course['courseid'];
			$course_names[] = $course['coursename'];
		}
		$newfile = implode("|",$course_id_array);
		$course_list = implode(", ",$course_names);
		
		to_file($dir_usercourselist . $lms_userID, $newfile, "w+");
		$ac_message.= "The following course(s) were added to your enrollment list: \n\t".$course_list;
		
	}
	send_pass_email($payment_data['email'], $password, $ac_message);
	//echo $ac_message;
}

/* -------------end of function update_LMS-------------------------- */

function register_student($dateofreg,$firstname,$lastname,$phone,$email,$address,$address2,$city,$state,$zip,$password){

		 $sql = "INSERT INTO students (
		`date_of_reg` ,	`date_of_mod`  , `fname` ,
		`lname` , `mname` ,	`orgID` , `user_group` , `user_subgroup` ,
		`date_of_birth` , `sex` , `phone` , `email` , `address`,
		`city` , `state` , `zip` , `username` , `password` ,
		`userlevel` )	VALUES (
		'" . $dateofreg . "', CURDATE() , '" . $first_name .
		"', '" . $last_name . "', '', '', '', '', '00000000', 
		'na', '" . $phone . "', '" . $email . 
		"', '" . $address . " " . $address2 . 
		"', '" . $city . "', '" . $state . 
		"', '" . $zip . "', '" . $email . 
		"', '" . $password . "', '1' );";
		
		$db = new db;
		$db->connect();
		$db->query($sql);
		$db->close();
}

function register_student_in_course($studentid,$courseid){
	
	/* 
	  SUMMARY: 
			This function uses existing SCORM course data, along with
			student/user identification, to enable a given student
			access to specified course.
			
	  TABLES: 
			item_info			Contains SCORM course data
			user_sco_info		Contains student-course correlation records
	*/
	
	$db = new db;
	
	$sql="select * from item_info where course_id='".$courseid."'";
	$db->connect();
	$db->query($sql);
	$db->getRows();
	
	$sco_identifier = $db->row("identifier");
	$course_launch_file = $db->row("launch");
	$data_from_lms = $db->row("data_from_lms");
	$prerequisites = $db->row("prerequisites");
	$masteryscore = $db->row("masteryscore");
	$maximumtime = $db->row("maximumtime");
	$timelimitaction = $db->row("timelimitaction");
	$sequence = $db->row("sequence");
	$type = $db->row("type");
	$cmi_credit = $db->row("cmi_credit");
	
	$db->connect();
	
	if($db->getRows()){
			$insrt="insert into user_sco_info set user_id=" . $studentid . ",course_id='".
						$courseid ."',sco_id='". $sco_identifier ."',launch='". 
						$course_launch_file . "',data_from_lms='" . $data_from_lms .
						"',lesson_status='not attempted',prerequisite='" . $prerequisites . "',".
						"sco_exit='',sco_entry='ab-initio',masteryscore='" . $masteryscore . 
						"',maximumtime='" . $maximumtime . "',timelimitaction='" . $timelimitaction .
						"',sequence=" . $sequence . ",type='" . $type . "',cmi_credit='" . $cmi_credit ."'";
			
			insertAction($insrt);

		}
	
	$db->close();
	
}

function send_pass_email($email, $password, $ac_message) {
    $admin_email = $default_email; // from conf.php
	$subject = 'Course Account information';
    
	//override email for debugging
	//$email = "ryan@rammons.net";
	$domain_in_caps = toupper($domain_name);
	$to = $email;    //  user/purchaser/student email
    $body = "Thank you very much for your purchase! You may now log in at any time " .
			"to see the course(s) you have purchased, as well as any other previously " .
			"purchased courses, by visiting: \n" .
			"$lms_url_fq/index.php?section=login.\n\n\n";
			
    $body .= "To log in to your account, you'll need your username and password. \n\n" .
			 "Your username is simply your email address: " . $to . "\n" .
			 "Your randomly generated password is: " . $password . " \n\n\n";
			 
	$body .= $ac_message . "\n\n";
	
	$body .= "If you have any questions, concerns or comments, please contact us at " .
				$admin_email . ".\n\n\n";
    
	$body .= "THIS IS AN AUTOMATED MESSAGE FROM $domain_in_caps\n\n\n" .
    			"\n" . date('m/d/Y');
    
	$headers = "From: " . $admin_email . "\r\n";

    mail($to, $subject, $body, $headers);
}

function generatePassword($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
	
	$password = '';
	$alt = time() % 2;
	
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
			} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	
	return $password;
}
?>