<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
top.top1.courseItemSelect=2;

function openTemplates()
{
var mywin=window.open('templates.php','nothing','width=307,height=450,SCROLLBARS=YES,status=YES');
}
</SCRIPT>

<?php

//break file here;
if(file_exists($dir_layout.$ID))
{
$layout_s = file($dir_layout.$ID);
$rlayout = explode("|",$layout_s[0]);

$mywidth=$rlayout[0];
$myheight=$rlayout[1];
$mylayout=$rlayout[2];

$my_a_type=$rlayout[3];
$my_a_size=$rlayout[4];
$my_a_frame=$rlayout[5];

$my_b_type=$rlayout[6];
$my_b_size=$rlayout[7];
$my_b_frame=$rlayout[8];

$my_c_type=$rlayout[9];
$my_c_size=$rlayout[10];
$my_c_frame=$rlayout[11];

$my_d_type=$rlayout[12];
$my_d_size=$rlayout[13];
$my_d_frame=$rlayout[14];
}
else
{
to_file($dir_layout.$ID,"800|600|1|content|*|blank.html|toc|250|toc.html|nav|34|nav.html|none|NA|NA","w+");
echo"<SCRIPT>document.location.reload();</SCRIPT>";
}

if(!$mylayout||$mylayout==1)
{
$a_type="toc";
$a_size="250";
$a_frame="toc.html";

$b_type="content";
$b_size="*";
$b_frame="blank.html";

$c_type="nav";
$c_size="34";
$c_frame="nav.html";

$d_type="none";
$d_size="NA";
$d_frame="NA";
}

else if($mylayout==2)
{
$a_type="content";
$a_size="*";
$a_frame="blank.html";

$b_type="toc";
$b_size="250";
$b_frame="toc.html";

$c_type="nav";
$c_size="34";
$c_frame="nav.html";

$d_type="none";
$d_size="NA";
$d_frame="NA";
}

else if($mylayout==3)
{
$a_type="header";
$a_size="*";
$a_frame=$my_a_frame;

$b_type="toc";
$b_size="250";
$b_frame="toc.html";

$c_type="content";
$c_size="*";
$c_frame="blank.html";

$d_type="nav";
$d_size="34";
$d_frame="nav.html";
}

else if($mylayout==4)
{
$a_type="header";
$a_size="*";
$a_frame=$my_a_frame;

$b_type="content";
$b_size="*";
$b_frame="blank.html";

$c_type="nav";
$c_size="34";
$c_frame="nav.html";

$d_type="none";
$d_size="NA";
$d_frame="NA";
}

else if($mylayout==5)
{
$a_type="content";
$a_size="*";
$a_frame="blank.html";

$b_type="nav";
$b_size=$my_b_size;
$b_frame="nav.html";

$c_type="none";
$c_size="NA";
$c_frame="NA";

$d_type="none";
$d_size="NA";
$d_frame="NA";
}

else if($mylayout==6)
{
$a_type="content";
$a_size="*";
$a_frame="blank.html";

$b_type="none";
$b_size="NA";
$b_frame="NA";

$c_type="none";
$c_size="NA";
$c_frame="NA";

$d_type="none";
$d_size="NA";
$d_frame="NA";
}
?>

<STYLE TYPE="text/css">
#fa2{FONT-COLOR:#000000;}
#toc1{BACKGROUND:#000000}
#toc2{BACKGROUND:#000000}
#toc3{FONT-FAMILY:VERDANA}
<?php include("admin_css.php");?>
</STYLE>
	<title>Untitled</title>	

</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">

<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=course_layout" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo$ID;?>">
<INPUT TYPE="HIDDEN" NAME="formAction" VALUE="UPDATE">


	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	 <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP" NOWRAP><SPAN CLASS="hdr">Course Properties:</SPAN>

	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4">
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Course Layout:</SPAN><BR><BR>
		<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 100" Height = "22" MAYSCRIPT>   
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
		  {Change,javascript:1,_self,images/import.gif}    		
		">
		<param name="javascript:1" value="openTemplates();">
		</applet>
	   </TD>
	    <TD COLSPAN="3"><IMG SRC="images/templates/<?echo$mylayout;?>.gif" NAME="rlayout"></TD>	
	  <INPUT TYPE="HIDDEN" NAME="layout" CLASS="input" VALUE="<?php echo $mylayout;?>">		
	  </TR> 
	  <TR>
	    <TD><SPAN CLASS=ttl>Launch Width:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="l_w" CLASS="input" VALUE="<?php echo $mywidth;?>" SIZE="4"></TD>	
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>Launch Height:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="l_h" CLASS="input" VALUE="<?php echo $myheight;?>" SIZE="4"></TD>	
	  </TR> 

	 <INPUT TYPE="HIDDEN" NAME="a_type" CLASS="input" VALUE="<?php echo $a_type;?>">
	  <TR>
	    <TD><SPAN CLASS=ttl>[A] Frame Size:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="a_size" CLASS="input" VALUE="<?php echo $a_size;?>" SIZE="4" ID="fa1"></TD>	
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>[A] Frame Location:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="a_loc" CLASS="input" VALUE="<?php echo $a_frame;?>" ID="fa2"></TD>	
	  </TR> 

	 <INPUT TYPE="HIDDEN" NAME="b_type" CLASS="input" VALUE="<?php echo $b_type;?>">
	  <TR>
	    <TD><SPAN CLASS=ttl>[B] Frame Size:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="b_size" CLASS="input" VALUE="<?php echo $b_size;?>" SIZE="4" ID="fb1"></TD>	
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>[B] Frame Location:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="b_loc" CLASS="input" VALUE="<?php echo $b_frame;?>" ID="fb2"></TD>	
	  </TR> 

	 <INPUT TYPE="HIDDEN" NAME="c_type" CLASS="input" VALUE="<?php echo $c_type;?>">
	  <TR>
	    <TD><SPAN CLASS=ttl>[C] Frame Size:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="c_size" CLASS="input" VALUE="<?php echo $c_size;?>" SIZE="4" ID="fc1"></TD>	
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>[C] Frame Location:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="c_loc" CLASS="input" VALUE="<?php echo $c_frame;?>" ID="fc2"></TD>	
	  </TR> 

	 <INPUT TYPE="HIDDEN" NAME="d_type" CLASS="input" VALUE="<?php echo $d_type;?>">
	  <TR>
	    <TD><SPAN CLASS=ttl>[D] Frame Size:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="d_size" CLASS="input" VALUE="<?php echo $d_size;?>" SIZE="4" ID="fd1"></TD>	
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>[D] Frame Location:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="d_loc" CLASS="input" VALUE="<?php echo $d_frame;?>" ID="fd2"></TD>	
	  </TR> 

	</TABLE>
</FORM>


	</TD>
	<TD BACKGROUND="images/bev_right.gif" WIDTH="8"></TD>	
	  </TR>
	  <TR>
	    <TD><IMG SRC="images/bev_left_b_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_bottom.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_b_corner.gif"></TD>	
	  </TR>		
	</TABLE>


</BODY>