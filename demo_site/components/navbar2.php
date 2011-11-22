              <tr bgcolor="#9E95BF"> 
                <td WIDTH="186"><img src="images/folder.gif" width="24" height="21" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><A HREF="index.php?section=landing&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#000000;"><B>My Account Page</B></A></font></td>
              </tr>
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="index.php?section=register&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#993300;">New Users</A> </font></td>
              </tr>
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="index.php?section=login&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#993300;">Log In</A> </font></td>
              </tr>		
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="index.php?section=enrollment&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#993300;">Enrollment List</A> </font></td>
              </tr>		
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="index.php?section=courselist&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#993300;">Course List</A> </font></td>
              </tr>
<!--			  	  	 
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="index.php?section=search&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#993300;">Search</A> </font></td>
              </tr>		
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="index.php?section=news&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#993300;">What's New</A> </font></td>
              </tr>		
-->
			  <?php if($lms_userlevel>=2){?>
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/report_bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="index.php?section=reports&sid=<?php echo $sid;?>" STYLE="text-decoration:none;COLOR:#993300;">Detailed Reports</A> </font></td>
              </tr>		
			  <?php }?>
			  <?php if($lms_userlevel>=3){?>
              <tr bgcolor="#E0DEE8"> 
                <td WIDTH="186"><img src="images/admin_bullet.gif" align="absmiddle"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#993300"><A HREF="#" onClick="window.open('../admin/admin.php?sid=<?php echo $sid;?>','ADMIN','fullscreen,scrollbars=yes')"; STYLE="text-decoration:none;COLOR:#993300;">Admin Interface</A> </font></td>
              </tr>		
			  <?php }?>					  			  				  	   