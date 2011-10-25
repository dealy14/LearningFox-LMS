<div id="menu">
<br />
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
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=enrollment&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Enrollment List</A> </font></td>
              </tr>		
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=courselist&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Library </A> </font></td>
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
<?php if($lms_userlevel>=2){?>
<table width="186"  border="0" cellspacing="0" cellpadding="0">
             <tr>
			 	<td width="186"><img src="images/menutop.gif" /></td>
			 </tr>
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=reports&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">Reports</A> </font></td>
              </tr>		
			  <?php }?>
			  <?php if($lms_userlevel>=3){?>
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="#" onClick="window.open('../admin/admin.php?sid=<?php echo $sid; ?>','ADMIN','fullscreen,scrollbars=yes')"; STYLE="text-decoration:none;COLOR:#3E3E3E;">Admin Interface</A> </font></td>
              </tr>		
		
			  <tr>
			 	<td width="186"><img src="images/menubottom.gif" /></td>
			  </tr>
</table>
<br />
	  <?php }?>	


<table width="186"  border="0" cellspacing="0" cellpadding="0">
             <tr>
			 	<td width="186"><img src="images/menutop.gif" /></td>
			 </tr>
              <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=news&sid=<?php echo $sid; ?>" STYLE="text-decoration:none;COLOR:#3E3E3E;">News</A> </font></td>
              </tr>		
			
			  <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=messageboard&sid=<?php echo $sid; ?>" ; STYLE="text-decoration:none;COLOR:#3E3E3E;">Message Board</A> </font></td>
              </tr>		
			  
			   <tr > 
                <td width="186" background="images/menubg.gif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#3E3E3E"><img src="images/bullet.gif" align="absmiddle"> <A HREF="index.php?section=library&sid=<?php echo $sid; ?>"; STYLE="text-decoration:none;COLOR:#3E3E3E;">Repository</A> </font></td>
              </tr>		
			  <tr>
			 	<td width="186"><img src="images/menubottom.gif" /></td>
			  </tr>
</table>

</div>