<script type="text/javascript">
function newUser() {
	window.open('register.php?newuser=yes','Register','resizable=0,width=650,height=650,scrollbars=0');
	}

function forgetPassword() {
	window.open('forget_password.php','ForgotPassword','resizable=0,width=550,height=550,scrollbars=0');
}

function changePassword() {
	window.open('changepassword.php','ChangePassword','resizable=0,width=650,height=550,scrollbars=0');
}
</script>

<?php

if($lms_orgID=="off") {
	$org_id="something";
}

if($submit=="yes" && !is_null($uname) && !is_null($pwd) && !is_null($org_id)) /* start IF_C1 */ {
	if($lms_orgID=="on") {
		$extra_clause="AND orgID = '$org_id' AND orgID != ''";
		$extra_text="/orgID";
	}
	echo"<p><br><p><br><I><b>Validating Information...";
	$userEntry=0;

	$pwd = sha1($uname.$pwd); //hash the input value for comparison to stored, hashed value
	
	//compare login info;
	$db = new db;
	$db->connect();
	$db->query("SELECT ID,fname,lname,email,userlevel,user_group,orgID FROM students " .
					"WHERE username='$uname' AND password='".
					$db->escape_string($pwd)."' $extra_clause");

	$xx=0;
	while($db->getRows()) {  
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
    if($xx>=1) /* start IF_C2 */ {
		  //if groups is on - get group name and sub group name and add info to session;

		  if($lms_groups=="on") {
		      $mygroup = explode("_",$user_group);
			  $db = new db;
			  $db->connect();
			  $db->query("SELECT groups.name,subgroups.sub_name FROM " .
			  				"groups, subgroups WHERE groups.ID = '$mygroup[0]' AND subgroups.ID = '$mygroup[1]'");
			  while($db->getRows()) { 
			      $user_group_name=$db->row("name");  
			      $user_subgroup_name=$db->row("sub_name");  
			  }
		  }

		  //Update last_login date
		  $db = new db;
		  $db->connect();
		  $db->query("UPDATE students SET last_login=CURRENT_DATE() WHERE ID=".$userID);
		  
		  //Ceate a session file here;
		  $sid = uniqid (rand());
          $_SESSION['lms_sessionID'] = $sid;
		  $_SESSION['lms_userID'] = $userID;
		  
		  //if session expiraton is turned on - add data;
		  if($lms_session_expire != 0) {
			  $stime=(time() + $lms_session_expire);
		  }

		  $userdata=@implode("||", $userdata);
		  to_file($dir_sessions . "." . $sid,
		  			"$userID||$stime||$userdata||$user_group_name||$user_subgroup_name||$user_group||$user_org||",
					"w+");	   

	// Redirect to the LANDING content page via javascript
   ?><script type="text/javascript">
		window.location.href="<?php echo "index.php?section=$post_login_redirect_section&sid=$sid";?>";
	</script>

   	<?php  } /* end IF_C2 */

    else  /* start ELSE_C2 */ {
     echo "<p><b><font color='red'>Invalid username/password$extra_text, Please try again!</font></b></p>"; ?>

    <form name="myform" method="post" action="index.php?section=login&submit=yes">
		<table align="right">
		   <!--
			 <tr><td><a href="javascript:newUser();" >Register as New User</a></td></tr>
		     <tr><td><a href="javascript:forgetPassword();"> Forgot Password</a></td></tr>		 
			-->
		   <!-- 
		     <tr><td><a href="javascript:changePassword();"> Change Password</a></td></tr>
			-->
		</table>
		 
		<br/><br/>
		
		<table border="1" id="login" cellpadding="4" cellspacing="0" align="center">
	    
			<?php if($lms_orgID=="on") { ?>
			    <tr>
			      <td align="right"><font face="Verdana" size="2"><b>Organization ID:</b></font></td>
			      <td><input type="text" name="org_id"></td>
			    </tr>
		    <?php } ?>
			<tr>
		      <td align="right"><font face="Verdana" size="2"><b>UserName:</b></font></td>
		      <td><input type="text" name="uname"></td>
		    </tr>
			<tr>
		      <td align="right"><font face="Verdana" size="2"><b>Password:</b></font></td>
		      <td><input type="password" name="pwd"></td>
		    </tr>
	    
			<tr>
		      <td colspan="2" align="right">
			  	<!--<input type="image" src="images/submit.gif" border="0">-->
                <INPUT TYPE="IMAGE" SRC="images/login.jpg" BORDER="0">
			  </td>
		    </tr>
		</table>

		<br/><br/>

		 <div style="height:280px; margin-left:20px; "  align="center">
  <table align="center">
	  <tr><td style="padding-left:5px;"><font size="2">With <?php 
	  			echo TEXT_COMPANY_NAME."'s ".TEXT_LMS_FULL_SYSTEM_NAME; 
				?>, you can:</font></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"><li style="list-style:disc">         Take online courses</li></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"> <li style="list-style:disc">         Access custom reports</li></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"> <li style="list-style:disc">         Store and share documents</li></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"> <li style="list-style:disc">         Create messages and share messages/li></td></tr>
  </table>
  </div>

</form>

<?php  } /* end ELSE_C2 */

}///* end IF_C1 *///

else if(($submit=="yes" && is_null($uname)) || ($submit=="yes" && is_null($pwd))) {
	echo"<p><b>Invalid username/password, Please try again!</b></p><br><br>";
}
else if($submit=="yes" && $org_id=="") {
	echo"<p><b>Invalid username/password, Please try again!</b></p><br><br>";	
}

else /* start ELSE_C1 */ { ?>
   <p>
	  <?php
		if($session_error!="none" && $se=="yes") {
			echo "<p><b><font color='red'>$session_error</p>";
		} 
	  ?>
   </p>

   <table border="0" cellpadding="4" cellspacing="0" align="center">
	  <tr>
	    <td align="TOP"><form name="myform" method="post" action="index.php?section=login&submit=yes">
	      <table border="0" cellpadding="4" cellspacing="0">
		    <?php
	  		 if($lms_orgID=="on") {	?>
	           <tr>
	             <td align="right"><font face="Verdana" size="2"><b>Organization ID:</b></font></td>
	             <td><input type="text" name="org_id"></td>
	           </tr>
		    <?php } ?>

	          <tr>
	            <td align="right"><font face="Verdana" size="2"><b>UserName:</b></font></td>
	            <td><input type="text" name="uname"></td>
	          </tr>

	          <tr>
	            <td align="right"><font face="Verdana" size="2"><b>Password:</b></font></td>
	            <td><input type="password" name="pwd"></td>
	          </tr>

	          <tr>
	            <td colspan="2" align="right">
             <!--<input type="image" src="images/submit.gif" border="0">-->
                <INPUT TYPE="IMAGE" SRC="images/login.jpg" BORDER="0">
                </td>
	          </tr>

	        </table>
	      </form></td>

	    <td valign="top"><!--include message here--></td>
	  </tr>
	</table>

	<!--
		<a href="javascript:newUser();" >New LMS user </a>
		<a href="javascript:forgetPassword();"> Forgot Password</a>
	-->

	<br/>

	<div style="height:280px; margin-left:20px; " align="center" >
  <table align="center">
	  <tr><td style="padding-left:5px;"><font size="2">With <?php 
	  			echo TEXT_COMPANY_NAME."'s ".TEXT_LMS_FULL_SYSTEM_NAME; 
				?>, you can:</font></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"><li style="list-style:disc">         Take online courses</li></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"> <li style="list-style:disc">         Access custom reports</li></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"> <li style="list-style:disc">         Store and share documents</li></td></tr>
	  <tr><td height="25px" style="padding-left:15px;"> <li style="list-style:disc">         Create messages and share messages</li></td></tr>
  </table>
  </div>

<?php } /* end ELSE_C1 */ ?>

<!-- Set initial focus in first form field (Depends on org setting) -->

<?php if($lms_orgID=="on") { ?>
	<script type="text/javascript">
	<!-- 
		document.myform.org_id.focus(); 
	-->
	</script>

<?php } else { ?>
	<script type="text/javascript">
	<!-- 
		document.myform.uname.focus();
	-->
	</script>
<?php } ?>