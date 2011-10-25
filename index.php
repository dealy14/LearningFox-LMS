<?php
session_start();
$myconf="demo_site";


require_once("conf.php");
$buttombanner="<img src=\"images/buttombanner.gif\" />";
?>
<html>
<head>
<title>LMS</title>
<link rel="stylesheet" href="style/style.css" type="text/css" />
<link rel="stylesheet" href="style1.css" type="text/css" />
<style type="text/css">
<!--
.rightborder { 
border-right: 1px solid #000000; 
} 
.leftborder { 
border-left: 1px solid #000000; 
border-right: 1px solid #000000; 
border-bottom: 1px solid #000000; 
border-style: thin; 
} 

.style2 {font-size: xx-small}
.descriptor_row
{
background:#003366;
font-size:x-small;
color:#FFFFFF;
border:#FFFFFF;
}
-->
</style>
<script type="text/javascript">
function openWindow(winName)
{
    window.open(winName,"FAQs", "width=950,height=650,resizable=no,scrollbars=no,toolbar=no,status=no,menubar=no,copyhistory=no,left=100,top=100,screenX=100,location=no,screenY=100");
}
</script>
</head>
<link href="style.css" rel="stylesheet" type="text/css">
<body bgcolor="#FFFFFF" TOPMARGIN="0" LEFTMARGIN="0" RIGHTMARGIN="0">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
       <td align="center">
         <table width="800" height="600" border="0" cellspacing="0" cellpadding="0" class="leftborder">
              <tr bgcolor="#FFFFFF">
              <td colspan="2"  style="background-image:url('site_conf/images/det_banner.jpg'); background-repeat:no-repeat; background-position:center;" width="100%" height="100" align="right">
	          <?php
	          if(!is_null($sid)&&$session_error=="none")
	          {
		            $_SESSION['lms_username']=$lms_username;
					?><TABLE BORDER="0" CELLPADDING="2" CELLSPACING="0" WIDTH="190" >
					<TR>
						<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000">Logged in as: <B><?php echo $lms_username; ?></B></TD>
					</TR>
						<?php
						if($lms_groups=="on" && $lms_user_group!=""){
						?>
						<TR>
							<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000"><?php echo"$lms_gtitle: "; if($lms_groups=="on"){echo"<B>$lms_user_group</B>";}?></TD>		
						</TR>	
						<TR>
							<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000"><?php echo "$lms_sgtitle: "; if($lms_groups=="on"){echo"<B>$lms_user_subgroup</B>";}?></TD>
								
						</TR>	
						<tr>
							<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000"><?php if($section=="reports" && $report){echo"<A HREF='index.php?section=reports&sid=$sid'>Back to Detailed Reports Section";}?></FONT></TD>
						</tr>
						<?php }?>
				
					</TABLE>
					<?php	
	           }
	          ?></td>
              </tr>
			  <tr>
				  <td colspan="2" height="20" background="images/bg.gif">
				      <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
						 <tr>
							<td>&nbsp;</td>
							<TD align="right"><?php
				if(!is_null($sid)&&$session_error=="none")
				{
				?><a style=""  href="index.php?section=<?php echo $section; ?>&logout=YES&sid=<?php echo $sid; ?>"><img src="images/logout.gif" border="0" align="ABSMIDDLE" alt="Click here to Log Out"></a><?php
				}
				?></TD>
						</tr>
					</table></td>
			  </tr>
             <tr>
			    <?php
			    if(is_null($sid)||$session_error!="none")
				{
				    $nav_display = 'display: none';
				}
			    ?>
                <td valign="top" style=" <?php echo $nav_display; ?> ">
				<!---------BEGIN SIDE NAV TABLE------------->
				<table width="198" border="0" cellspacing="0" cellpadding="0" >
                  <tr valign="top" bordercolor="#FFFFFF"> 
                     <td width="198" bordercolor="#FFFFFF"><?php		  
					 if((!is_null($sid)&&$session_error=="none"))
					 {
						include($dir_components."navbar2.php");
					 }
					 ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td></td>
		    </tr>
      </table>
	</td>
	<td class="boxcontent" VALIGN="TOP" >
	<?php 
	include($mysection);
	?></td>
  </tr>
</table>
</td>
</tr>
</table>
<hr width="200px;">
</body>
</html>
