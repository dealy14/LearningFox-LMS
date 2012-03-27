<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Forget password retrival</title>
<script language="javascript1.2">
function validForm(frm){

	if(frm.username.value==''){
		alert('Kindly enter the user name first');
		frm.username.focus();
		return false;
	}
	
}
</script>
<link href="style.css" rel="stylesheet" type="text/css" >
</head>
<?php
require_once("conf.php");
if(isset($_POST['attempt'])){
	
	$attempt=$_POST['attempt'];
	
}else{
	
	$attempt=0;

}
if(isset($_POST['username'])){
	
	$uname=$_POST['username'];

}else{
		$uname=$_GET['un'];
}
$db=new db;
$db->connect();
function gen_trivial_password($len = 6)
{
    $r = '';
    for($i=0; $i<$len; $i++)
        $r .= chr(rand(0, 25) + ord('a'));
    return $r;
}
if($_POST['username']!=''){
	 $select="select * from students where username='".addslashes($_POST['username'])."' and security_question='".htmlentities(addslashes($_POST["security_question"]),ENT_QUOTES)."' and security_answer='".htmlentities(addslashes($_POST["security_answer"]),ENT_QUOTES)."'";
	$rsxx=mysql_query($select);
	while($row = mysql_fetch_array($rsxx))
	  {
	   //echo "password ".$row['password'];
	   $to      = $row['email'];
	//	echo "password ".$row['password'];
		$subject = 'Password for LMS website';
 $message = "Below are your new login details for LMS :- \n\r User name :\t".stripslashes($row['username'])."\n\r Password :\t".$row['password']."\n\rThanks";
		//$headers  = 'MIME-Version: 1.0' . "\r\n";
		//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
		$headers = 'From: learningfox@learningfox.com';
		//$headers1 = $headers;
	
	   //echo " <br/>to address ".$to;
		//mail($to, $subject, $message, $headers);
		if(mail("$to","$subject","$message","$headers"))
						{
							echo "<script>alert('Your password has been mailed successfully.Kindly check your email account.'); window.close();</script>";
						}
						else
						{
							echo "<script>alert('Mail has not been sent'); window.close();</script>";
						}
			
		//echo "<script>alert('Your password has been mailed successfully.Kindly check your email account.'); window.close();<//script>";
	   } 
	   
//echo $select;
/*	echo $cnt=mysql_affected_rows();
	if($cnt>=1){
	 
		$selx="select count(*) from students where username='".addslashes($_POST['username'])."'";
		$rsx=mysql_result(mysql_query($selx),0);
		$sel="select * from students where username='".addslashes($_POST['username'])."'";
		
		$rs=mysql_query($sel);
		$row=mysql_fetch_assoc($rs);
		//echo $pass=gen_trivial_password();
		//$password=md5($row['ID'].$pass);
		//$upd="update students set password='".addslashes($password)."' where username='".addslashes($_POST['username'])."' and ID=".$row['ID'];
		//mysql_query($upd);
		if($rsx>=1){
		$to      = $row['email'];
	//	echo "password ".$row['password'];
		$subject = 'Password for LMS website';
	echo $message = '<strong>Below are your new login details for LMS :-</strong> <br/> User name :<b>'.stripslashes($row['username']).'</b><br/> Password :<b>'.stripslashes($pass).'</b><br/> Thanks';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
		$headers .= 'From: www.learningfox.com' . "\r\n";
	
	   echo " <br/>to address".$to;
		mail($to, $subject, $message, $headers);
			
		echo "<script>alert('Your password has been mailed successfully.Kindly check your email account.'); window.close();</script>";
		}else{
					
						echo "<script>alert('Your email is not matched with user name.So unable to retrieve password.'); window.close();</script>";
						if($attempt>=3){
							
							echo "Your account has been locked. Plz send an email to administrator for further enquiries.";
						}
		}
	}else{
				echo "<script>alert('Sorry information provided does not match with info entered earlier.');</script>";
				if($attempt>=3){
							$upstatus="update students set active='no' where username='".$uname."'";
							mysql_query($upstatus);
							echo '<strong>Your account has been locked. Plz send an email to administrator for further proceedings.</strong><br/><a style="font-size:14px; text-decoration:none;" href="mailto:CRAFT@nw7.esrd.net?subject=CROWNWeb/QIPS Training Login Trouble"><strong>CRAFT@nw7.esrd.net</strong></a>';
							$x="true";
						}
				
	}*/
}

?>
<body>
<?php
if($x!="true"){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" style="background-color:#213442; color:#FFFFFF;" ><strong>Kindly enter the following information:-</strong> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <form action="forget_password.php" method="post" onsubmit="return validForm(this);">
 <input type="hidden" id="attempt" name="attempt"  value="<?php echo ++$attempt;?>" />
  <tr>
    <td align="right" \>User Name : </td>
    <td align="left"><input type="text" name="username" id="username" value="<?php echo $uname;?>" />&nbsp;</td>
  </tr>
  <tr>
    <td align="right" >&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
     <td align="right" >Security Question  : </td>
    <td align="left"><select name="security_question" id="security_question">
		<option value="0">Choose security question.</option>
      <option value="What's your pet name?">What's your pet name?</option>
      <option value="What's your favourate food?">What's your favourate food?</option>
      <option value="What's your mother maiden name?">What's your mother maiden name?</option>
      <option value="What's your Favorate actor name?">What's your Favorate actor name?</option>
      <option value="What's your nick name?">What's your nick name?</option>
    </select>   &nbsp;</td>
  </tr>
  <tr>
    <td align="right" >&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
     <td align="right">Security Answer : </td>
     <td align="left"><input type="text" name="security_answer" id="security_answer" value="" />&nbsp;</td>
  </tr>
 <!-- <tr>
    <td align="right" style="color:#FFFFFF;">Email Address : </td>
    <td align="left"><input type="text" name="email" id="email" value="" />&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>-->
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left"><input type="submit" value="submit" name="submit" />&nbsp;</td>
  </tr>
  </form>
</table>
<?php
}
?>
</body>
</html>
