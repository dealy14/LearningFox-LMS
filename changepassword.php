<?php session_start();
//echo "username = ".ucfirst($_SESSION['lms_username']);
//echo "ID = ".$_SESSION['lms_userID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="JavaScript1.2">
function validFrm(frm1)
{

  if(frm1.oldpassword.value==""){
     
		alert('Please enter your Existing password.');
		frm1.oldpassword.focus();
		return false;
		}
 if(frm1.password.value==""){
		alert('Please enter your New password.');
		frm1.password.focus();
		return false;
	}
	if(frm1.cpassword.value==""){
		alert('Please re-enter password.');
		frm1.cpassword.focus();
		return false;
	}	
	if(frm1.password.value!=frm1.cpassword.value){
		alert('Your confirm password field does not match.');
		frm1.cpassword.focus();
		return false;
		}
		//alert(frm1.oldpassword.value);	
//return true;

}		
</script>
</head>
<?php  
include("conf.php");
//require_once("conf.php");
  if(isset($_POST['Submit1']))
     {
	    $pwd = $_POST["oldpassword"];
		$db = new db();
		$db->connect();
		
      $sql="select * from students where password ='".addslashes($_POST["oldpassword"])."' AND ID='".$_SESSION['lms_userID']."'";
	    echo mysql_num_rows($sql)."<br/>";
		
		  $db->query($sql);
		  while($db->getrows())
		  {             
		    $pass = $db->row("password");
			  }   
			 // echo $pass; 
			  $db = new db();
		$db->connect();  
		 $sql="UPDATE students set password ='".addslashes($_POST["password"])."' where password ='".$pass."' AND ID='".$_SESSION['lms_userID']."'";
		  $db->query($sql);          
		  echo "<script>alert('Your password has been changed.'); window.close();</script>";
/*          $result=mysql_query($sql) or die(mysql_error());
		  echo "row =".mysql_num_rows($result);
	      while($row = mysql_fetch_array($result))
	          {
			  echo $pass = $row['oldpassword'];
			   }
*/    }			   
?>
<body>
<form action="changepassword.php" method="post" onsubmit="return validFrm(this);" name="passwordFrm">
<table align="center" width="70%" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td colspan="2" align="left" style="background-color:#213442; color:#FFFFFF;" ><strong>Kindly enter the following information:-</strong> </td>
  </tr>
  <tr><td></td> </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Enter the Existing Password: &nbsp;</td>
    <td><input name="oldpassword" type="password" id="oldpassword" size="25" value="<?php echo $pwd;?>"/>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Enter the New Password:&nbsp;</td>
    <td><input name="password" type="password" id="password" size="25" />&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Confirm Password: &nbsp;</td>
    <td><input name="cpassword" type="password" id="cpassword" size="25" />&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="submit" name="Submit1" id="Submit1"/>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
