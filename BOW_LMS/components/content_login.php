<?php
if($lms_orgID=="off")
{
$org_id="something";
}


if($submit=="yes" && !is_null($uname) && !is_null($pwd) && !is_null($org_id))
{

	if($lms_orgID=="on")
	{
	$extra_clause="AND students.orgID='$org_id' AND students.orgID!=''";
	$extra_text="/orgID";
	}
	
	echo"<P></p><BR><P></p><BR><I><B>Validating Information....</B></i>";
	$userEntry=0;

//compare login info;

 
  $db = new db;
  $db->connect();
  $sql = "SELECT orgs.name, students.ID, students.fname, students.lname, students.email, students.userlevel, students.user_group, students.user_subgroup, students.orgID FROM students, orgs WHERE students.username='$uname' AND students.password='$pwd' AND students.orgID=orgs.org_ID $extra_clause";
  echo $sql;
  $db->query($sql);
  $xx=0;
  while($db->getRows())
  { 
  $userdata[]=$db->row("fname")." ".$db->row("lname");
  $userdata[]=$db->row("email");
  $userdata[]=$db->row("userlevel");
  $userID=$db->row("ID");
  $user_org=$db->row("orgID");  
  $user_group=$db->row("user_group");  
  $user_subgroup=$db->row("user_subgroup");  
  $user_org_name=$db->row("name"); 
  $user_group_file=$db->row("user_group")."_".$db->row("user_subgroup"); 
  $xx++;
  }


  

//if it's good - assign an okay value to userEntry, then extract session info;
	if($xx>=1)
	{
		//if groups is on - get group name and sub group name and add info to session;
		  if($lms_groups=="on")
		  {
			  $db = new db;
			  $db->connect();
			  $db->query("SELECT groups.name,subgroups.sub_name FROM groups,subgroups WHERE groups.ID=$user_group AND subgroups.ID=$user_subgroup");
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
		to_file($dir_sessions.".".$sid,"$userID||$stime||$userdata||$user_group_name||$user_subgroup_name||$user_group_file||$user_org||$user_org_name","w+");	   
	?>
	<SCRIPT>document.location.href="<?php echo "index.php?section=landing&sid=$sid";?>";</SCRIPT>	
	<?php
	}
	else
	{
	echo"<P><B><FONT COLOR='RED'>Invalid username/password$extra_text, Please try again!</FONT></B></P>";	
	?>
	<FORM NAME="myform" METHOD="POST" ACTION="index.php?section=login&submit=yes">
	<TABLE BORDER="0" style=".login" id="login" CELLPADDING="3" CELLSPACING="0" bordercolor="#003366"  >
	<?php
	if($lms_orgID=="on")
	{
	?>
	  <TR>
	    <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Organization ID:</B></FONT></TD>
	    <TD><INPUT TYPE="TEXT" NAME="org_id"></TD>
	  </TR>	
        <?php
	}
	?>	
	  <TR>
	    <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>UserName:</B></FONT></TD>
	    <TD><INPUT TYPE="TEXT" NAME="uname"></TD>
	  </TR>
	  <TR>
	    <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Password:</B></FONT></TD>
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
	<P><BR>
	<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="0"><TR><TD ALIGN="TOP">
	<FORM NAME="myform" METHOD="POST" ACTION="index.php?section=login&submit=yes">
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
	</FORM>
	</TD>
	<TD VALIGN="TOP">
	<!--include message here-->
	</TD>
	</TR></TABLE>
<?php
}
?><br />
<br />
<br />

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="518" height="255" title="ready set go">
  <param name="movie" value="images/home.swf" />
  <param name="quality" value="high" />
  <embed src="images/home.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="518" height="255"></embed>
</object>
	