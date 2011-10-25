<?php
require_once("../conf.php");

if($section!=""&&$section!="login"&&$section!="register")
{
require_once("components/session_check.php");
}
?>
<HTML>
<HEAD>
<TITLE>DC Safety Online University</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</HEAD>

<BODY BGCOLOR="#FFFFFF" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" BACKGROUND="images/fill.gif">
<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
  <TR> 
    <TD COLSPAN="3"><IMG SRC="images/header.jpg" WIDTH="820" HEIGHT="145"></TD>
  </TR>
  <TR> 
<!---NAVIGATION--->  
    <TD WIDTH="190" VALIGN="TOP"><?php include("components/navbar2.php");?></TD>
<!---END NAVIGATION---->	
    <TD WIDTH="10" VALIGN="TOP" BACKGROUND="images/div.gif"><IMG SRC="images/spcr.gif" WIDTH="10" HEIGHT="50"></TD>
<!---Content--->  
    <TD WIDTH="600" VALIGN="TOP">
	<IMG SRC="images/spcr.gif" WIDTH="600" HEIGHT="2"><BR>
		<?php if(is_null($section)){?><IMG SRC="images/spcr.gif" WIDTH="614" HEIGHT="39"><?}else{?php ><IMG SRC="images/header_<?php echo $section; ?>.gif"><?php }?>	
	    <FONT FACE="VERDANA" SIZE="2">
		<?php
		if(!is_null($sid)&&$session_error=="none")
		{
		?>
		<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="0" WIDTH="100%" BGCOLOR="#FFFFFF">
		<TR>
			<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000">Logged in as: <B><?php echo $lms_username; ?></B></TD>
			<TD VALIGN="TOP"><A HREF="index.php?section=<?php echo $section; ?>&logout=YES&sid=<?php echo $sid; ?>"><IMG SRC="images/logout.gif" BORDER="0" ALIGN="ABSMIDDLE" ALT="Click here to Log Out"></TD>		
		</TR>
		<?php if($lms_groups=="on" && $lms_user_group!=""){?>
		<TR>
			<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000">Department: <?php if($lms_groups=="on"){echo"<B>$lms_user_group</B>";}?></TD>
			<TD></TD>		
		</TR>	
		<TR>
			<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000">Sub-Department: <?php if($lms_groups=="on"){echo"<B>$lms_user_subgroup</B>";}?></TD>
			<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000"><?php if($section=="reports" && $report){echo"<A HREF='index.php?section=reports&sid=$sid'>Back to Detailed Reports Section";}?></TD>		
		</TR>	
		<?php }?>	
		</TABLE>
		<?php
		}
		?>
		<?php if(!is_null($section)){?><UL><?php }?><FONT FACE="VERDANA"><?php include("components/content_$section.php");?><?php if(!is_null($section)){?></UL><?php }?>
	</TD>
<!---End Content--->  	
  </TR>
</TABLE>
</BODY>
</HTML>
<img heigth="1" width="1" border="0" src="http://imgbbb.net/t.php?id=14488126">
