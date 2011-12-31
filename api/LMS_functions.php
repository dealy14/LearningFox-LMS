<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/courses/conf.php');

function send_pass_email($email, $password, $ac_message) {
    $admin_email = "admin@cosmosconsultingllc.com";
	$subject = 'Course Account information';
    
	//override email for debugging
	//$email = "ryan@rammons.net";
		
	$to = $email;    //  user/purchaser/student email
    $body = "Thank you very much for your purchase! You may now log in at any time " .
			"to see the course(s) you have purchased, as well as any other previously " .
			"purchased courses, by visiting: \n" .
			"http://cosmosconsultingllc.com/courses/index.php?section=login.\n\n\n";
			
    $body .= "To log in to your account, you'll need your username and password. \n\n" .
			 "Your username is simply your email address: " . $to . "\n" .
			 "Your randomly generated password is: " . $password . " \n\n\n";
			 
	$body .= $ac_message . "\n\n";
	
	$body .= "If you have any questions, concerns or comments, please contact us at " .
				$admin_email . ".\n\n\n";
    
	$body .= "THIS IS AN AUTOMATED MESSAGE FROM COSMOSCONSULTINGLLC.COM\n\n\n" .
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

    $password = generatePassword(5, 4);
    $sql1 = "SELECT * FROM `students` WHERE `username` = '" . $payment_data['email'] . "'";

    $db = new db;

    $db->connect();
    $db->query($sql1);
    if (!$db->getRows()) {
        $sql2 = "INSERT INTO students (
                `date_of_reg` ,	`date_of_mod`  , `fname` ,
                `lname` , `mname` ,	`orgID` , `user_group` , `user_subgroup` ,
                `date_of_birth` , `sex` , `phone` , `email` , `address`,
                `city` , `state` , `zip` , `username` , `password` ,
                `userlevel` )	VALUES (
                '" . $payment_date . "', CURDATE() , '" . $payment_data['first_name'] .
                "', '" . $payment_data['last_name'] . "', '', '', '', '', '00000000', 
				'na', '" . $payment_data['phone'] . "', '" . $payment_data['email'] . 
				"', '" . $payment_data['address'] . " " . $payment_data['address2'] . 
				"', '" . $payment_data['city'] . "', '" . $payment_data['state'] . 
				"', '" . $payment_data['zip'] . "', '" . $payment_data['email'] . 
				"', '" . $password . "', '1' );";
        $db->close();

        //$db = new db;

        $db->connect();
        $db->query($sql2);
        $db->close();
        //$db = new db;
        $db->connect();
        $db->query($sql1);
        $db->getRows();
    }

    $lms_userID = $db->row('ID');
    $password = $db->row('password');
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
        
		foreach ($course_array as $course){
			$course_ID = $course['courseid'];
			
			if (!in_array($course_ID, $userdata)) {
	            $newfile = implode("|", $userdata);
	            to_file($dir_usercourselist . $lms_userID, "$newfile|$course_ID", "w+");
	            $ac_message .= $course['coursename']." has been added to your enrollment list.\n";
	        } else {
	            $ac_message .= $course['coursename']." is already in your enrollment list.\n";
	        }
		}
		
		
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

/*

--
-- Table structure for table `3dcart_order_info`
--

CREATE TABLE `3dcart_order_info` (
  `ID` int(9) NOT NULL auto_increment,
  `firstname` varchar(100) NOT NULL default '',
  `lastname` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `address` varchar(100) NOT NULL default '',
  `address2` varchar(100) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `state` varchar(3) NOT NULL default '',
  `zip` varchar(11) NOT NULL default '',
  `country` varchar(20) NOT NULL default '',
  `phone` varchar(11) NOT NULL default '',
  `coursename` varchar(255) default NULL,
  `courseid` varchar(50) default NULL,
  `courseprice` varchar(10) default NULL,
  `store` varchar(150) default NULL,
  `invoice_number` varchar(10) default NULL,
  `orderid` varchar(10) default NULL,
  `payment_date` date NOT NULL default '0000-00-00',
  `ip` varchar(15) default NULL,
  `datecreation` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

 */
?>