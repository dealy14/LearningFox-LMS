<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/lms/conf.php');
function update_LMS( $ipn_data , $dir_usercourselist )
{
 		 $sql1 = "insert into paypal_order_info (";
		 $sql2 = ") values ( ";
		 $sql1 .= " firstname ";
		 $sql2 .= " '".$ipn_data['first_name']."' "; 		
	
		 if("" != $ipn_data['last_name'] )
		 {		
			 $sql1 .= ", lastname ";		 
			 $sql2 .= ", '".$ipn_data['last_name']."' "; 		
		 }
		 if("" != $ipn_data['payer_email'] )
		 {		 
			 $sql1 .= ", buyer_email ";		 
			 $sql2 .= ", '".$ipn_data['payer_email']."' "; 		
		 }
		 if("" != $ipn_data['payer_id'] )
		 {
		 		 $sql1 .= ", buyer_id ";
				 $sql2 .= ", '".$ipn_data['payer_id']."' ";
		}
		 if("" != $ipn_data['address_street'] )
		 {
		 		 $sql1 .= ", street ";		 
				 $sql2 .= ", '".$ipn_data['address_street']."' "; 		
		 }
		 if("" != $ipn_data['address_city'] )
		 {		 $sql1 .= ", city ";		 $sql2 .= ", '".$ipn_data['address_city']."' "; 		}
		 if("" != $ipn_data['address_state'] )
		 {		 $sql1 .= ", state ";		 $sql2 .= ", '".$ipn_data['address_state']."' "; 		}
		 if("" != $ipn_data['address_zip'] )
		 {		 $sql1 .= ", zipcode ";		 $sql2 .= ", '".$ipn_data['address_zip']."' "; 		}
		 if("" != $ipn_data['verify_sign'] )
		 {		 $sql1 .= ", memo ";		 $sql2 .= ", '".$ipn_data['verify_sign']."' "; 		}
		 if("" != $ipn_data['item_name1'] )
		 {		 $sql1 .= ", itemname ";		 $sql2 .= ", '".$ipn_data['item_name1']."' "; 		}
		 if("" != $ipn_data['item_number1'] )
		 {		 $sql1 .= ", itemnumber ";		 $sql2 .= ", '".$ipn_data['item_number1']."' "; 		}
		 if("" != $ipn_data['payment_date'] )
		 {		 $sql1 .= ", paymentdate ";		 $sql2 .= ", '".$ipn_data['payment_date']."' "; 		}
		 if("" != $ipn_data['payment_type'] )
		 {		 $sql1 .= ", paymenttype ";		 $sql2 .= ", '".$ipn_data['payment_type']."' "; 		}
		 if("" != $ipn_data['txn_id'] )
		 {		 $sql1 .= ", txnid ";		 $sql2 .= ", '".$ipn_data['txn_id']."' "; 		}
		 if("" != $ipn_data['mc_gross1'] )
		 {		 $sql1 .= ", mc_gross ";		 $sql2 .= ", '".$ipn_data['mc_gross1']."' "; 		}
		 if("" != $ipn_data['mc_fee'] )
		 {		 $sql1 .= ", mc_fee ";		 $sql2 .= ", '".$ipn_data['mc_fee']."' "; 		}
		 
		 if("" != $ipn_data['payment_status'] )
		 {				 $sql1 .= ", paymentstatus ";		 $sql2 .= ", '".$ipn_data['payment_status']."' "; 		}
		 if("" != $ipn_data['pending_reason'] )
		 {				 $sql1 .= ", pendingreason ";		 $sql2 .= ", '".$ipn_data['pending_reason']."' "; 		}
		 if("" != $ipn_data['txn_type'] )
		 {				 $sql1 .= ", txntype ";		 $sql2 .= ", '".$ipn_data['txn_type']."' "; 		}
		 
		 if("" != $ipn_data['tax'] )
		 {				 $sql1 .= ", tax ";		 $sql2 .= ", '".$ipn_data['tax']."' "; 		}
		 
		 if("" != $ipn_data['mc_currency'] )
		 {				 $sql1 .= ", mc_currency ";		 $sql2 .= ", '".$ipn_data['mc_currency']."' "; 		}
		 
		 if("" != $ipn_data['reason_code'] )
		 {				 $sql1 .= ",  reasoncode";		 $sql2 .= ", '".$ipn_data['reason_code']."' "; 		}
		 
		 if("" != $ipn_data['address_country_code'] )
		 {				 $sql1 .= ",  country";		 $sql2 .= ", '".$ipn_data['address_country_code']."' "; 		}
		 
		 if("" != $ipn_data['payment_date'] )
		 {				 $sql1 .= ",  datecreation";		 $sql2 .= ", '".$ipn_data['payment_date']."' "; 		}
		 
		 
		 $sql = $sql1.$sql2.");";
		
		/* 
		$body .=  "\n\n".$sql;
		$body .=  "\n\n".$ac_message;
     	$fp=fopen("log.txt",'a');
      	fwrite($fp, $body . "\n\n"); 
      	fclose($fp);
		*/
		 $db = new db;
		$db->connect();
		$db->query( $sql );
		$db->close();
		
	
		
		 
		$sql1 = "SELECT * FROM `students` WHERE `username` = '".$ipn_data['payer_email']."'";
		//$db = new db;
		$db->connect();
		$db->query( $sql1 );
		if( !$db->getRows() )
		{
			$sql2="INSERT INTO students (
						`date_of_reg` ,	`date_of_mod`  , `fname` ,
						`lname` , `mname` ,	`orgID` , `user_group` , `user_subgroup` ,
						`date_of_birth` , `sex` , `phone` , `email` , `address` ,
						`city` , `state` , `zip` , `username` , `password` ,
						`userlevel` )	VALUES (
						'".$ipn_data['payment_date']."', NOW() , '".$ipn_data['first_name']."', '".$ipn_data['last_name']."', '', 'paypal', 'paypal', 'paypal', '00000000', 'na', '0000000000', '".$ipn_data['payer_email']."', '".$ipn_data['address_street']."', '".$ipn_data['address_city']."', '".$ipn_data['address_state']."', '".$ipn_data['address_zip']."', '".$ipn_data['payer_email']."', 'pass', '0' );";
					
				$db->close();	
				//$db = new db;
				$db->connect();
				$db->query( $sql2 );
				$db->close();
		
				//$db = new db;
				$db->connect();
				$db->query( $sql1 );
				$db->getRows();
		}
		
		$lms_userID = $db->row('ID');
		$db->close();
		//$lms_userID = 13;
		$course_ID = 54;
		$userfile = $dir_usercourselist.$lms_userID;
		echo "lms_userID =".$lms_userID;
		echo "userfile =".$userfile;
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

		echo $ac_message;
		
}/*-------------end of function update_LMS--------------------------*/


$ipn_data['first_name']            = "fname";
$ipn_data['last_name']             = "lname";
$ipn_data['payer_email']           = "test@test.com";
$ipn_data['payer_id']              = "buyer_id";
$ipn_data['address_street']        = "street";		 
$ipn_data['address_city']          = "city";
$ipn_data['address_state']         = "state";
$ipn_data['address_zip']           = "zipcode";
$ipn_data['verify_sign']           = "memo";
$ipn_data['item_name1']            = "itemname";
$ipn_data['item_number1']          = "itemnumber";
$ipn_data['payment_date']          = date ("Y-m-d H:i:s", "13:15:59 May 19, 2009 PDT");
$ipn_data['payment_type']          = date ("Y-m-d H:i:s", "13:15:59 May 19, 2009 PDT");
$ipn_data['payment_date']          = "13:15:59 May 19, 2009 PDT";
$ipn_data['payment_type']          = "13:15:59 May 19, 2009 PDT";
$ipn_data['txn_id']                = "txnid";
$ipn_data['mc_gross1']             = "mc_gross";
$ipn_data['mc_fee']                = "mc_fee";
$ipn_data['payment_status']        = "paymentstatus";
$ipn_data['pending_reason']        = "pendingreason";
$ipn_data['txn_type']              = "txntype";
$ipn_data['tax']                   = "tax";
$ipn_data['mc_currency']           = "mc_currency ";
$ipn_data['reason_code']           = "reasoncode";
$ipn_data['address_country_code']  = "country";

update_LMS( $ipn_data ,$dir_usercourselist);
?>
<body>
</body>
</html>
