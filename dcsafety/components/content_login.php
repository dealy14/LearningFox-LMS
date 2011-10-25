<?php
if($submit=="yes" && !is_null($uname) && !is_null($pwd))
{
echo"<P><BR><P><BR><I><B>Validating Information....";
$userEntry=0;

//compare login info;

 
  $db = new db;
  $db->connect();
  $db->query("SELECT ID,fname,lname,email,userlevel,user_group FROM students WHERE username='$uname' AND password='$pwd'");
  $xx=0;
  while($db->getRows())
  { 
  $userdata[]=$db->row("fname")." ".$db->row("lname");
  $userdata[]=$db->row("email");
  $userdata[]=$db->row("userlevel");
  $userID=$db->row("ID");
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
			//if session expiraton is turned on - add data;
			if($lms_session_expire!=0)
			{
			$stime=(time() + $lms_session_expire);
			}
		$userdata=@implode("||",$userdata);
		to_file($dir_sessions.".".$sid,"$userID||$stime||$userdata||$user_group_name||$user_subgroup_name||$user_group","w+");
		
//if groups is turned on - copy group file over;
/*
       if($lms_groups=="on")
	   {

	   $temp_c = file($dir_groupfiles.$user_group.".grp");
	   $temp_cx = explode("|",$temp_c[0]);
	   $mycs=file($dir_usercourselist.$userID);
	   $mycsx= explode("|",$mycs[0]);
	     $myx=0;
		 while($myx<count($temp_cx))
		 {
		   if(!in_array($temp_cx[$myx],$mycsx,TRUE))
		   {
		   $mycsx[]=$temp_cx[$myx];
		   }
		 $myx++;
		 }
	   $newval=@implode("|",$mycsx);	 
	   to_file($dir_usercourselist.$userID,$newval,"w+");	

	   //copy over enrollment list;
	   //copy($dir_groupfiles.$user_group.".grp",$dir_usercourselist.$userID);	   
	
	   }		
*/	   
	?>
	<SCRIPT>document.location.href="<?php echo "index.php?section=landing&sid=$sid";?>";</SCRIPT>	
	<?php
	}
	else
	{
	echo"<P><B>Invalid username/password, Please try again!</B></P>";	
	?>
	<FORM NAME="myform" METHOD="POST" ACTION="index.php?section=login&submit=yes">
	<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="0">
	  <TR>
	    <TD><FONT FACE="VERDANA" SIZE="2"><B>UserName:</TD>
	    <TD><INPUT TYPE="TEXT" NAME="uname"></TD>
	  </TR>
	  <TR>
	    <TD><FONT FACE="VERDANA" SIZE="2"><B>Password:</TD>
	    <TD><INPUT TYPE="password" NAME="pwd"></TD>
	  </TR>
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
	  </TR>
	</TABLE>
	</FORM>	
	<?php
	}
}
/*
else if(($submit=="yes" && is_null($uname)) || ($submit=="yes" && is_null($pwd)))
{
echo"<P><B>Invalid username/password, Please try again!</B></P><BR><BR>";	
}
*/
else
{
?>
	<P><BR>
	<?php
	if($session_error!="none")
	{
	echo"<P><B><FONT COLOR='RED'>$session_error</P>";
	}
	?>
	<P><BR>
	<FORM NAME="myform" METHOD="POST" ACTION="index.php?section=login&submit=yes">
	<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="0">
	  <TR>
	    <TD><FONT FACE="VERDANA" SIZE="2"><B>UserName:</TD>
	    <TD><INPUT TYPE="TEXT" NAME="uname"></TD>
	  </TR>
	  <TR>
	    <TD><FONT FACE="VERDANA" SIZE="2"><B>Password:</TD>
	    <TD><INPUT TYPE="password" NAME="pwd"></TD>
	  </TR>
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
	  </TR>
	</TABLE>
	</FORM>
<?php
}
?>
