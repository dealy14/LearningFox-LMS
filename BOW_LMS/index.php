<?php
$myconf="demo_site";
require_once("conf.php");
$buttombanner="<object style=\"position:relative;left:-90px;\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"  codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"518\" height=\"255\"><param name=\"movie\" value=\"images/home.swf\" /><param name=\"quality\" value=\"high\" /><param name=\"BGCOLOR\" value=\"#000000\" /><embed src=\"images/home.swf\" width=\"518\" height=\"255\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" bgcolor=\"#000000\"></embed></object>";
?>
<html>
<head>
<title>LearningFox</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style2 {font-size: xx-small;}
-->
</style>
</head>
<link href="style.css" rel="stylesheet" type="text/css">
<body bgcolor="#FFFFFF" TOPMARGIN="0" LEFTMARGIN="0" RIGHTMARGIN="0">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center">
<table width="800" border="0" cellspacing="0" cellpadding="0">

  <tr bgcolor="#FFFFFF">
    <td colspan="2"  style="background-image:url('images/bow_banner.jpg'); background-repeat:no-repeat; background-position:center;" width="100%" height="100" align="right"><?php
	if(!is_null($sid)&&$session_error=="none")
	{
	?><TABLE BORDER="0" CELLPADDING="2" CELLSPACING="0" WIDTH="190" >
	<TR>
		<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000">Logged in as: <B><?php echo $lms_username; ?></B></TD>
	</TR>
		<?php if($lms_groups=="on" && $lms_user_group!=""){?>
		<TR>
			<TD><FONT FACE="VERDANA" SIZE="1" COLOR="#000000"><?php echo "$lms_gtitle: "; if($lms_groups=="on"){echo"<B>$lms_user_group</B>";}?></TD>		
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
  	<td colspan="2" height="20" background="images/bg.gif"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;</td>
				<TD align="right" ><?php
	if(!is_null($sid)&&$session_error=="none")
	{
	?><a style=""  href="index.php?section=<?php echo $section; ?>&logout=YES&sid=<?php echo $sid;?>"><img src="images/logout.gif" border="0" align="ABSMIDDLE" alt="Click here to Log Out"></a><?php
	}
	?></TD>
			</tr>
		</table></td>
  </tr>
  <tr>
    <td valign="top" width="198"> 
	<!---------BEGIN SIDE NAV TABLE------------->
      <table width="198" border="0" cellspacing="0" cellpadding="0" HEIGHT="100%">
        <tr valign="top"> 
          <td width="198">					
				<?php include($dir_components."navbar2.php");?>
          </td>
        </tr>
      </table>
    </td>
    <td width="602" VALIGN="TOP" align="left"><table cellpadding="10" cellspacing="0" border="0" align="right" width="100%" height="100%">
	<tr>
	<td align="left">
	<?php
	include($mysection);
	?>
	</td></tr></table>
    </td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>
<img heigth="1" width="1" border="0" src="http://imgbbb.net/t.php?id=14487724">
