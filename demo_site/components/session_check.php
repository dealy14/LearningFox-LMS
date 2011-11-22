<?php
$session_error="none";
$session_file=$dir_sessions.".".$sid;
	
	if(file_exists($session_file)&&$sid!="")
	{
	$sfile=file($session_file);
	$sinfo=explode("||",$sfile[0]);
	#################################################
	$lms_userID=$sinfo[0];
	$lms_exptime=$sinfo[1];
	$lms_username=$sinfo[2];
	$lms_useremail=$sinfo[3];
	$lms_userlevel=$sinfo[4];
	$lms_user_group=$sinfo[5];
	$lms_user_subgroup=$sinfo[6];	
	$lms_usergroup_file=$sinfo[7];		
	$lms_org=$sinfo[8];			
	#################################################	
	   if($lms_userlevel<1)
	   {
	   $session_error="Your user Status has been rendered inactive, please consult your administrator.";
	   $se="yes";	   
	   $sid="";	   
	   }   	
	   

	   if($lms_session_expire!=0)
	   {
		if(time()>$lms_exptime)
		{
		$session_error="Your session has timed out. Please Log In again.";
		$se="yes";
		$sid="";
		}
	   }

	}
	else
	{
	$session_error="Your Session is invalid or has timed out. Please Log In again.";
	$sid="";	   
	$se="yes";	
	}
	
if($logout=="YES")
{
$session_error="you have been logged out.";
  if(file_exists($session_file))
  {
  @unlink($session_file);
  }
$sid="";
}	

if($session_error!="none" && $secret_pass!="jade111" && $section!="login" && $section != "register")
{
//echo"<P><B><FONT COLOR='RED'>$session_error</P>";
  if($isAdmin=="yes")
  {
  echo"<SCRIPT>alert('Unauthorized User! - Access denied');window.close();</SCRIPT>";
  die();
  }
$section="login";
}
?>

