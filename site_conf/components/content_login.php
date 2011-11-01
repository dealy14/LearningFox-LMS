<script type="text/javascript">
function newUser()
{
window.open('register.php?newuser=yes','Register','resizable=0,width=650,height=650,scrollbars=0');
}
function forgetPassword()
{
window.open('forget_password.php','ForgotPassword','resizable=0,width=550,height=550,scrollbars=0');
}
function changePassword()
{
window.open('changepassword.php','ChangePassword','resizable=0,width=650,height=550,scrollbars=0');
}
</script>
<?php
if($lms_orgID=="off")
{
$org_id="something";
}


if($submit=="yes" && !is_null($uname) && !is_null($pwd) && !is_null($org_id))
{

	if($lms_orgID=="on")
	{
	$extra_clause="AND orgID='$org_id' AND orgID!=''";
	$extra_text="/orgID";
	}
	
echo"<P><BR><P><BR><I><B>Validating Information....";
$userEntry=0;

//compare login info;

 
  $db = new db;
  $db->connect();
  $db->query("SELECT ID,fname,lname,email,userlevel,user_group,orgID FROM students WHERE username='$uname' AND password='$pwd' $extra_clause");
  $xx=0;
  while($db->getRows())
  {  
	  $userdata[]=$db->row("fname")." ".$db->row("lname");
	  $userdata[]=$db->row("email");
	  $userdata[]=$db->row("userlevel");
	  $userID=$db->row("ID");
	  $_SESSION['lms_userID'] = $userID;
	  //echo "userID - "$userID;
	  $user_org=$db->row("orgID");  
	  $user_group=$db->row("user_group");  
	  $xx++;
  }


  

//if it's good - assign an okay value to userEntry, then extract session info;
	if($xx>=1)
	{
		//if groups is on - get group name and sub group name and add info to session;
		  if($lms_groups=="on")
		  {
		      $mygroup = explode("_",$user_group);
			  $db = new db;
			  $db->connect();
			  $db->query("SELECT groups.name,subgroups.sub_name FROM groups,subgroups WHERE groups.ID='$mygroup[0]' AND subgroups.ID='$mygroup[1]'");
			  while($db->getRows())
			  { 
			      $user_group_name=$db->row("name");  
			      $user_subgroup_name=$db->row("sub_name");  
			  }		  
		  }	
		  //Ceate a session file here;
		  $sid = uniqid (rand());
          $_SESSION['lms_sessionID'] = $sid;
		  $_SESSION['lms_userID'] = $userID;
		  //if session expiraton is turned on - add data;
		  if($lms_session_expire!=0)
		  {
			  $stime=(time() + $lms_session_expire);
		  }
		$userdata=@implode("||",$userdata);
		to_file($dir_sessions.".".$sid,"$userID||$stime||$userdata||$user_group_name||$user_subgroup_name||$user_group||$user_org||","w+");	   
	?>
<SCRIPT>document.location.href="<?php echo "index.php?section=landing&sid=$sid";?>";</SCRIPT>
<?php
	}
	else
	{
	echo"<P><B><FONT COLOR='RED'>Invalid username/password$extra_text, Please try again!</FONT></B></P>";	
	?>

<FORM NAME="myform" METHOD="POST" ACTION="index.php?section=login&submit=yes">
<table align="right"><tr><td><a href="javascript:newUser();" >Register as New User</a></td></tr>
  <tr><td><a href="javascript:forgetPassword();"> Forgot Password</a></td></tr>
 <!-- <tr><td><a href="javascript:changePassword();"> Change Password</a></td></tr>--></table>
  <br/><br/>

  <TABLE BORDER="1" id="login" CELLPADDING="4" CELLSPACING="0">
    <?php
	if($lms_orgID=="on")
	{
	?>
    <TR>
      <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Organization ID:</TD>
      <TD><INPUT TYPE="TEXT" NAME="org_id"></TD>
    </TR>
    <?php
	}
	?>
    <TR>
      <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>UserName:</TD>
      <TD><INPUT TYPE="TEXT" NAME="uname"></TD>
    </TR>
    <TR>
      <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Password:</TD>
      <TD><INPUT TYPE="password" NAME="pwd"></TD>
    </TR>
    <TR>
      <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
    </TR>
  </TABLE>
  
 <br/><br/>
  <ul>
  <li style="list-style:none"><font size="2">With LearningFox's Learning Management System, you can:</font></li>
    <ul>
   <li style="list-style:disc">      Register for instructor-led courses</li>

   <li style="list-style:disc">         Take online courses</li>

   <li style="list-style:disc">         View training records</li>

   <li style="list-style:disc">         Store and share documents</li>

   <li style="list-style:disc">         Create messages via the message board</li>
   </ul>
  </ul>
  
</FORM>
<?php
	}
}
/*
else if(($submit=="yes" && is_null($uname)) || ($submit=="yes" && is_null($pwd)))
{
echo"<P><B>Invalid username/password, Please try again!</B></P><BR><BR>";	
}
else if($submit=="yes" && $org_id=="")
{
echo"<P><B>Invalid username/password, Please try again!</B></P><BR><BR>";	
}
*/
else
{
?>
<P><BR>
  <?php
	if($session_error!="none" && $se=="yes")
	{
	echo"<P><B><FONT COLOR='RED'>$session_error</P>";
	}
	?>
<P>
<table align="right"><tr><td><a href="javascript:newUser();" >Register as New User</a></td></tr>
  <tr><td><a href="javascript:forgetPassword();"> Forgot Password</a></td></tr>
  <!--<tr><td><a href="javascript:changePassword();"> Change Password</a></td></tr>--></table>
  <br/><br/>
<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="0">
  <TR>
    <TD ALIGN="TOP"><FORM NAME="myform" METHOD="POST" ACTION="index.php?section=login&submit=yes">
      <TABLE BORDER="0" CELLPADDING="4" CELLSPACING="0">
          <?php
	if($lms_orgID=="on")
	{
	?>
          <TR>
            <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Organization ID:</TD>
            <TD><INPUT TYPE="TEXT" NAME="org_id"></TD>
          </TR>
          <?php
	}
	?>
          <TR>
            <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>UserName:</TD>
            <TD><INPUT TYPE="TEXT" NAME="uname"></TD>
          </TR>
          <TR>
            <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Password:</TD>
            <TD><INPUT TYPE="password" NAME="pwd"></TD>
          </TR>
          <TR>
            <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
          </TR>
        </TABLE>
      </FORM></TD>
    <TD VALIGN="TOP"><!--include message here--></TD>
  </TR>
</TABLE>
<!--<a href="javascript:newUser();" >New LMS user </a>
  <a href="javascript:forgetPassword();"> Forgot Password</a>
--><br/>
<div style="line-height:20px;">
  <ul>
  <li style="list-style:none;"><font size="2">With LearningFox's Learning Management System, you can:</font></li>
    <ul>
   <li style="list-style:disc">      Register for instructor-led courses</li>

   <li style="list-style:disc">         Take online courses</li>

   <li style="list-style:disc">         View training records</li>

   <li style="list-style:disc">         Store and share documents</li>

   <li style="list-style:disc">         Create messages via the message board</li>
   </ul>
  </ul>
 </div> 
<?php
}
?>
