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
<div align="center">
<?php if($lms_userlevel>=3){?>
<P>
<hr width="70%" />
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD>
<TABLE BORDER="0" CELLSPACING="" CELLPADDING="4" WIDTH="100%">
  <TR>
    <TD rowspan="2" width="130"><A HREF="../admin/admin.php?sid=<?php echo $sid;?>" TARGET="_blank"><IMG SRC="images/lp_admin.gif" BORDER="0"></A></TD>
    <TD align="left">
      <A HREF="../admin/admin.php?sid=<?php echo $sid;?>" TARGET="_blank"><h4><FONT FACE="Arial, Helvetica, sans-serif" color="#003366">Administration</FONT></h4></A>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Create and manage course content, cours availability, tests, LMS properties etc.</font></p></TD>
  </TR>
  <tr>
  		<td align="right"><FONT FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="#" onClick="window.open('../admin/admin.php?sid=<?php echo $sid;?>','ADMIN','fullscreen,scrollbars=yes');">more</A>]</B></FONT></td>
  </tr>
</TABLE>
</TD></TR></TABLE>
<hr WIDTH="70%" />
<?php }?>

<?php if($lms_userlevel>=2){?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD >
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR >
    <TD rowspan="2" width="130"><A HREF="index.php?section=reports&sid=<?php echo $sid;?>"><IMG SRC="images/lp_reports.gif" BORDER="0"></A></TD>
    <TD align="left">
     <A HREF="index.php?section=reports&sid=<?php echo $sid;?>"><h4><FONT FACE="Arial, Helvetica, sans-serif" color="#003366">Reports </FONT></h4></A>
           <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">View students' course details, learning status, test scores etc.</font></p></TD>
  </TR>
  <tr>
  		<td align="right"><FONT FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=reports&sid=<?php echo $sid;?>">more</A>]</B></FONT></td>
  </tr>
</TABLE>
</TD></TR></TABLE>
<hr WIDTH="70%" />
<?php }?>
<!--
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD  >
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR >
    <TD rowspan=2><IMG SRC="images/lp_news.gif" BORDER="0"></TD>
    <TD align="left"><FONT FACE="VERDANA" SIZE="2">Latest news and resources tailored to your educational interests. <B>[<A HREF="#">more</A>]</B></TD>
  </TR>
  <tr>
  		<td></td>
  </tr>
</TABLE>
</TD></TR></TABLE>
<hr WIDTH="70%" />
-->

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR>
    <TD rowspan="2" width="130"><A HREF="index.php?section=enrollment_ic&sid=<?php echo $sid; ?>"><IMG SRC="images/lp_enrollment.gif" BORDER="0"></A></TD>
    <TD align="left">
     <A HREF="index.php?section=enrollment_ic&sid=<?php echo $sid; ?>"><h4><FONT FACE="Arial, Helvetica, sans-serif" color="#003366">Enrollment</FONT></h4></A>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Your specific list of courses. You can take courses from the course list and add them to your enrollment list.</font></p> </TD>
  </TR>
  <tr>
  		<td align="right"><FONT FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=enrollment&sid=<?php echo $sid;?>">more</A>]</B></FONT></td>
  </tr>
</TABLE>
</TD></TR></TABLE>
<hr   WIDTH="70%" />
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD >
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR >
    <TD rowspan="2" width="130"><A HREF="index.php?section=courselist&sid=<?php echo $sid;?>"><IMG SRC="images/lp_courselist.gif" BORDER="0"></A></TD>
    <TD align="left">
     <A HREF="index.php?section=courselist&sid=<?php echo $sid;?>"><h4><FONT FACE="Arial, Helvetica, sans-serif" color="#003366">Library</FONT></h4></A>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Additional courses and tests which you may add to your enrollment list.</font></p></TD>
  </TR>
  <tr>
  		<td align="right"><FONT FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=courselist&sid=<?php echo $sid;?>">more</A>]</B></FONT></td>
  </tr>
</TABLE>
</TD></TR></TABLE>
<hr WIDTH="70%" />

<!--
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><IMG SRC="images/lp_search.gif" BORDER="0"></TD>
    <TD align="left"><FONT FACE="VERDANA" SIZE="2">Search for courses, tests, learning resources in the course list or your enrollment list.<B>[<A HREF="#">more</A>]</B></TD>
  </TR>
  <tr>
  		<td></td>
  </tr>
</TABLE>
</TD></TR></TABLE>
<hr  WIDTH="70%"/>
-->
</div>