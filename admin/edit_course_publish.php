<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>

<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
.rows {BACKGROUND:#EFF7FF;}
</STYLE>

<SCRIPT>
top.top1.courseItemSelect=4;
function publish1(ID)
{
newWin = window.open("publish.php?ID="+ID,"nothing","width=250,height=100");
}
</SCRIPT>
</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	

	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD VALIGN="TOP" BGCOLOR="#EFF7FF">

<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="0">
  <TR>
    <TD VALIGN="MIDDLE">&nbsp;
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 120" Height = "70" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="EFF7FF">
		<param name="backHighColor" value="EFF7FF">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  {_,javascript:1,_self,images/publish1.gif}    		
		">
		<param name="javascript:1" value="publish1(<?php echo $ID;?>);">
		</applet>


</TD>
<TD><SPAN CLASS="ttl">Publish the course in a standard, web-based format for use with the online LMS.</CLASS></TD>

  </TR>
  <TR>
    <TD VALIGN="MIDDLE">&nbsp;
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 120" Height = "70" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="EFF7FF">
		<param name="backHighColor" value="EFF7FF">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  {_,_,_,images/publish2.gif}    		
		">
		<param name="javascript:1" value="rupdate();">
		</applet>


</TD>
<TD><SPAN CLASS="ttl">Publish the course and package for downloading via Win-Zip file format..</CLASS></TD>

  </TR>
</TABLE>

	</TD>
	<TD BACKGROUND="images/bev_right.gif" WIDTH="8"></TD>	
	  </TR>
	  <TR>
	    <TD><IMG SRC="images/bev_left_b_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_bottom.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_b_corner.gif"></TD>	
	  </TR>		
	</TABLE>
</body>
</html>
<SCRIPT>
