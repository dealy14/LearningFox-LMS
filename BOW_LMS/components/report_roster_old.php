</UL>
<?
$db = new db;
$db->connect();
$db->query("SELECT name,ID FROM groups");
while($db->getRows())
{ 
$gID = $db->row("ID");
$gname[$gID] = $db->row("name");
}


function getGname($gname,$usergroup)
{
$myug=explode("_",$usergroup);
return $gname[$myug[0]];
}


	
function hTop($xlink,$xstr,$order,$direction)
{
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
	$upTxt.="<TD><FONT FACE=VERDANA SIZE=1 COLOR=#FFFFFF><B>".$tdd[0]."</TD>";
	$boTxt.="<TD BGCOLOR=".$bg." ALIGN=LEFT><A HREF='$xlink&order=".$tdd[1]."&direction=$direction'><IMG SRC='images/$img' BORDER='0' ALT='Sort By ".$tdd[0]." $direction'></TD>";	
	$x++;
	}
echo "<TR BGCOLOR=#000000><TD COLSPAN=".count($mystr)." ALIGN=RIGHT>&nbsp; <A HREF='#' onClick=\"window.print();\"><IMG SRC='images/printer.gif' BORDER='0' ALT='Print This Report'></A></TD></TR><TR BGCOLOR=#000000>".$upTxt."</TR>\n<TR>".$boTxt."</TR>";	
}
?>
<IMG SRC="images/report_roster.gif" BORDER="0" ALIGN="ABSMIDDLE"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Report was run on: <?echo date(ymd);?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="3" WIDTH="100%">
<?
hTop("index.php?section=reports&report=roster&sid=$sid","Last Name|lname,First Name|fname,Middle Name|mname,Register Date|date_of_reg,Last Log in|date_of_mod,Dept.|user_group,Email|email,User Name|username,Pass Word|password,User Level|userlevel",$order,$direction);

if($order!="" && $direction!="")
{
$extr="ORDER BY $order $direction";
}
	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM students $extr");
	$nx=0;
	while($db->getRows())
	{ 
	$date_of_reg = $db->row("date_of_reg");
	$date_of_mod = $db->row("date_of_mod");
	$date_of_hire = $db->row("date_of_hire");
	$fname = $db->row("fname");
	$lname = $db->row("lname");
	$mname = $db->row("mname");
	$org_ID = $db->row("org_ID");
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
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$lname?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$fname?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$mname?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$date_of_reg?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$date_of_mod?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=getGname($gname,$user_group)?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$email?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$username?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?=$password?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php if($lms_userlevel>=3){echo$userlevel;}else{echo"*****";}?></TD>
	</TR>
	<?
	}
?>
</TABLE>
</TD></TR></TABLE>
<UL>