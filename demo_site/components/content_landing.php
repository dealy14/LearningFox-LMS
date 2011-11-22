<?php
/*
  $db = new db;
  $db->connect();
  $db->query("SELECT ID,fname,lname,email,userlevel FROM students WHERE username='$uname' AND password='$pwd'");
  $xx=0;
  while($db->getRows())
  { 
  $userdata[]=$db->row("fname")." ".$db->row("lname");
  $userdata[]=$db->row("email");
  $userdata[]=$db->row("userlevel");
  $userID=$db->row("ID");
  $xx++;
  }
*/
//echo"$lms_userID|$lms_exptime|$lms_username|$lms_useremail|$lms_userlevel";
?>
<?php if($lms_userlevel>=3){?>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><A HREF="../admin/admin.php?sid=<?php echo $sid;?>" TARGET="_blank"><IMG SRC="images/lp_admin.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Create and manage course content, cours availability, tests, LMS properties etc. <B>[<A HREF="#" onClick="window.open('../admin/admin.php?sid=<?php echo $sid;?>','ADMIN','fullscreen,scrollbars=yes');">more</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
<?}?>

<?php if($lms_userlevel>=2){?>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><A HREF="index.php?section=reports&sid=<?php echo $sid;?>"><IMG SRC="images/lp_reports.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">View students' course details, learning status, test scores etc. <B>[<A HREF="index.php?section=reports&sid=<?php echo $sid;?>">more</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
<?php }?>
<!--
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><IMG SRC="images/lp_news.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Latest news and resources tailored to your educational interests. <B>[<A HREF="#">more</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
-->

<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><A HREF="index.php?section=enrollment&sid=<?php echo $sid; ?>"><IMG SRC="images/lp_enrollment.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Your specific list of courses. You can take courses from the course list and add them to your enrollment list. <B>[<A HREF="index.php?section=enrollment&sid=<?php echo $sid;?>">more</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>

<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><A HREF="index.php?section=courselist&sid=<?php echo $sid;?>"><IMG SRC="images/lp_courselist.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Additional courses and tests which you may add to your enrollment list.<B>[<A HREF="index.php?section=courselist&sid=<?php echo $sid;?>">more</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>

<!--
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><IMG SRC="images/lp_search.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Search for courses, tests, learning resources in the course list or your enrollment list.<B>[<A HREF="#">more</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
-->
