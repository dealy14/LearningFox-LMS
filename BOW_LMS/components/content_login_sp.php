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
	
echo"<P><BR><P><BR><I><B>Validating Information....</I></B>";
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
  $user_org=$db->row("orgID");  
  $user_group=$db->row("user_group");  
  $user_subgroup=$db->row("user_subgroup");    
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
		to_file($dir_sessions.".".$sid,"$userID||$stime||$userdata||$user_group_name||$user_subgroup_name||$user_group||$user_org||","w+");	   
	?>
	<SCRIPT>document.location.href="<?php echo"index.php?section=landing&sid=$sid";?>";</SCRIPT>	
	<?php
	}
	else
	{
	echo"<P><B><FONT COLOR='RED'>Invalid username/password$extra_text, Please try again!</FONT></B></P>";	
    include($dir_sites.$myconf."/".$mylogin);	
	}
}
else
{
?>
	<P><BR>
	<?php
	if($session_error!="none" && $se=="yes")
	{
	echo"<P><B><FONT COLOR='RED'>$session_error</B></FONT></P>";
	}
    include($dir_sites.$myconf."/".$mylogin);	
}
?>
