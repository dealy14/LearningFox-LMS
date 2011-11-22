<?php 

$session_file=$dir_sessions.".".$sid;

	if(file_exists($session_file)&&$sid!="")
	{
	//echo "if";
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
	}
?>
<script type="text/javascript">
function changePassword()
{
window.open('changepassword.php','ChangePassword','resizable=0,width=650,height=550,scrollbars=0');
}
</script>
<div id="menu">
<br />
<td id="ldcLCPageLeftNavTD" align="left" bgColor="#EAEBED" noWrap vAlign="top" width="180">
<table width="186"  border="0" cellspacing="0" cellpadding="0">
             <tr>
			 	<td width="186"><img src="images/menutop.gif" /></td>
			 </tr>
			  <tr> 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><A HREF="index.php?section=landing&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#000000;"><B>Global Navigation</B></A></font></td>
              </tr>
			  <?php
			  if($lms_userlevel!=1){
			  ?>
           <!--   <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=register&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">New Users</A></font></td>
              </tr>
			  
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=login&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Log In</A></font></td>
              </tr>-->
			  <?php
			  
			  	}
			?>
			   <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=landing&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Main</A> </font></td>
              </tr>			
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=enrollment&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Your Transcript</A> </font></td>
              </tr>		
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=courselist&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Courses </A> </font></td>
              </tr>		  
			  
			 <?php $status="no"; if($lms_userlevel>=2){ $status="yes"?>
			  <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=reports&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Reports</A> </font></td>
              </tr>		
			    <?php }?>
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=news&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">News</A> </font></td>
              </tr>		
			
			  <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=messageboard&sid=<?php echo $sid; ?>" ; STYLE="text-decoration:none;COLOR:#3E3E3E;">Message Board</A> </font></td>
              </tr>		
			  
			   <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=library&sid=<?php echo $sid; ?>"; STYLE="text-decoration:none;COLOR:#3E3E3E;">Repository</A> </font></td>
              </tr>		
			  
<!--	
          	  <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=forums&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">User Forums</A> </font></td>
              </tr>			  	  	 
              <tr > 
                <td width="186" background="images/menubg.gif"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><A HREF="index.php?section=search&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Search</A> </font></td>
              </tr>		
              <tr > 
                <td width="186" background="images/menubg.gif"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><A HREF="index.php?section=news&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">What's New</A> </font></td>
              </tr>		
-->

			  <tr>
			 	<td width="186"><img src="images/menubottom.gif" /></td>
			  </tr>
</table>
<br />
<?php
//echo "level = ".$lms_userlevel;
 if($lms_userlevel>=3){
 
  ?>
<table width="186"  border="0" cellspacing="0" cellpadding="0">
             <tr>
			 	<td width="186"><img src="images/menutop.gif" /></td>
			 </tr>
            
		
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="#" onClick="window.open('admin/admin.php?sid=<?php echo $sid; ?>','ADMIN','fullscreen,scrollbars=yes')"; STYLE="text-decoration:none;COLOR:#3E3E3E;">Admin Interface</A> </font></td>
              </tr>		
		
			  <tr>
			 	<td width="186"><img src="images/menubottom.gif" /></td>
			  </tr>
</table>
<br />
	  <?php }?>	
<table width="186"  border="0" cellspacing="0" cellpadding="0">  

   <tr>
			 	<td width="auto" style="padding-left:15px;"><td><a href="javascript:changePassword();" STYLE="COLOR:#3E3E3E;"> Change Password</a></td></td>
			  </tr>
			  </table>

</td>

</div>