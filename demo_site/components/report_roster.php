</UL>
<?php

$db = new db;
$db->connect();
$db->query("SELECT count(ID) as totals FROM students WHERE orgID='$lms_org'");
while($db->getRows())
{ 
$totals = $db->row("totals");
}


function getGname($gname,$usergroup)
{
$myug=explode("_",$usergroup);
return $gname[$myug[0]];
}


	
function hTop($xlink,$xstr,$order,$direction,$cnt,$totals)
{
$nav_link=explode("&cnt=",$xlink);
$order_link=explode("&direction=",$xlink);
if($cnt>=50)
{
$last_link="<A HREF='$nav_link[0]&cnt=".($cnt-50)."&order=$order'><IMG SRC='images/_back.gif' BORDER='0'></A> <B><FONT COLOR='#FFFFFF'><BR>Last 50";
}
if($cnt<=($totals-50))
{
$next_link="<A HREF='$nav_link[0]&cnt=".($cnt+50)."&order=$order'><IMG SRC='images/_next.gif' BORDER='0'></A> <B><FONT COLOR='#FFFFFF'><BR>Next 50";
}
$page_expr="Page ".round(($cnt+50)/50)." of ".round(($totals)/50);

$mystr=explode(",",$xstr);
$x=0;
	while($x<count($mystr))
	{
	$tdd=explode("|",$mystr[$x]);
	  if($tdd[1]==$order)
	  {
	  $bg="#FFFFFF";
	    if($direction=="ASC")
		{
		$img="arrow_up.gif";
		$direction="DESC";		
		}
		else
		{
		$img="arrow_down.gif";
		$direction="ASC";
		}
	  }
	  else
	  {
	  $bg="#c6c6c6";
	  $img="arrow_down.gif";
	  }
	if(is_null($direction))
	{
	$direction="ASC";
	}  
	$upTxt.="<TD><FONT FACE=VERDANA SIZE=1 COLOR=#FFFFFF><B>".$tdd[0]."</TD>";
	$boTxt.="<TD BGCOLOR=".$bg." ALIGN=CENTER><A HREF='$order_link[0]&order=$tdd[1]&direction=$direction&cnt=$cnt'><IMG SRC='images/$img' BORDER='0' ALT='Sort By ".$tdd[0]." $direction'></TD>";	
	$x++;
	}
echo "<TR BGCOLOR=#000000><TD ALIGN='CENTER'><FONT FACE='VERDANA' SIZE='1'>$last_link</TD><TD ALIGN='CENTER'><FONT FACE='VERDANA' SIZE='1'>$next_link</TD><TD COLSPAN='2'><FONT FACE='VERDANA' SIZE='1' COLOR='#FFFFFF'><B>$page_expr</TD><TD COLSPAN=".(count($mystr)-4)." ALIGN=RIGHT>&nbsp; <A HREF='#' onClick=\"window.print();\"><IMG SRC='images/printer.gif' BORDER='0' ALT='Print This Report'></A></TD></TR><TR BGCOLOR=#000000>".$upTxt."</TR>\n<TR>".$boTxt."</TR>";	
}
?>
<IMG SRC="images/report_roster.gif" BORDER="0" ALIGN="ABSMIDDLE"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Report was run on: <?php echo date(ymd);?>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="3" WIDTH="100%">
<?php
hTop("index.php?section=reports&report=$report&sid=$sid&direction=$direction&cnt=$cnt","Last Name|lname,First Name|fname,Company|address,Email|email,User Name|username,Pass Word|password,User Level|userlevel",$order,$direction,$cnt,$totals);

if(!$cnt)
{
$cnt=0;
}
$lim= "limit $cnt, 50";


if($order!="" && $direction!="")
{

$extr="ORDER BY $order $direction";
}
	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM students WHERE orgID='$lms_org' $extr $lim");
	$nx=0;
	while($db->getRows())
	{ 
	$date_of_reg = $db->row("date_of_reg");
	$date_of_mod = $db->row("date_of_mod");
	$date_of_hire = $db->row("date_of_hire");
	$fname = $db->row("fname");
	$lname = $db->row("lname");
	$mname = $db->row("mname");
	$org_ID = $db->row("orgID");
	$user_group = $db->row("user_group");
	$user_subgroup = $db->row("user_subgroup");
	$date_of_birth = $db->row("date_of_birth");
	$sex = $db->row("sex");
	$phone = $db->row("phone");
	$email = $db->row("email");
	$address = $db->row("address");
	$city = $db->row("city");
	$state = $db->row("state");
	$zip = $db->row("zip");
	$username = $db->row("username");
	$password = $db->row("password");
	$userlevel = $db->row("userlevel");
	$ID = $db->row("ID");	
	?>
	<TR>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $lname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $fname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $address;?></TD>	  
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $email;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $username;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php if($lms_userlevel>=3){echo $userlevel;}else{echo"*****";}?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $userlevel?></TD>	  
	</TR>
	<?php
	}
?>
</TABLE>
</TD></TR></TABLE>
<UL>