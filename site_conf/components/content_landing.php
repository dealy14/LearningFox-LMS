<?php
/*
  $db = new db;
  $db->connect();
  $db->query("SELECT ID,fname,lname,email,userlevel FROM students WHERE username='$uname' AND password='".crypt($pwd,"lF")."'");
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
<div align="center" style="width:800px;">
<?php if($lms_userlevel>=2){?>

<hr width="100%" />
<table border="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><tr><td>
<?php if($lms_userlevel>=3){?>
<table border="0" CELLSPACING="" CELLPADDING="4" WIDTH="390" style="float:left;">
  <tr>
    <TD rowspan="2" width="130"><A HREF="admin/admin.php?sid=<?php echo $sid;?>" TARGET="_blank"><IMG SRC="images/lp_admin.gif" border="0"></A></td>
    <TD align="left"><h4><font FACE="Arial, Helvetica, sans-serif" color="#003366">
      <A HREF="admin/admin.php?sid=<?php echo $sid;?>" TARGET="_blank">Administration</A></font></h4>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Create and manage course content, cours availability, tests, LMS properties etc.</font></p></td>
  </tr>
  <tr>
  		<td align="right"><font FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="#" onClick="window.open('admin/admin.php?sid=<?php echo $sid;?>','ADMIN','fullscreen,scrollbars=yes');">more</A>]</B></font></td>
  </tr>
</table>
<?php }?>
<?php if($lms_userlevel>=2){?>
<table border="0" CELLSPACING="0" CELLPADDING="4" WIDTH="390" style="float:left; margin-left:10px;">
  <TR >
    <TD rowspan="2" width="130"><A HREF="index.php?section=reports&sid=<?php echo $sid;?>"><IMG SRC="images/lp_reports.gif" border="0"></A></td>
    <TD align="left"><h4><font FACE="Arial, Helvetica, sans-serif" color="#003366">
     <A HREF="index.php?section=reports&sid=<?php echo $sid;?>">Reports</A></font></h4>
           <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">View students' course details, learning status, test scores etc.</font></p></td>
  </tr>
  <tr>
  		<td align="right"><font FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=reports&sid=<?php echo $sid;?>">more</A>]</B></font></td>
  </tr>
</table>
<?php }?>
</td></tr></table>

<?php }?>

<hr WIDTH="100%" />

<!--
<P>
<table border="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><tr><TD  >
<table border="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR >
    <TD rowspan=2><IMG SRC="images/lp_news.gif" border="0"></td>
    <TD align="left"><font FACE="VERDANA" SIZE="2">Latest news and resources tailored to your educational interests. <B>[<A HREF="#">more</A>]</B></td>
  </tr>
  <tr>
  		<td></td>
  </tr>
</table>
</td></tr></table>
<hr WIDTH="70%" />
-->

<table border="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><tr><td>
<table border="0" CELLSPACING="0" CELLPADDING="4" WIDTH="390" style="float:left;">
  <tr>
    <TD rowspan="2" width="130"><A HREF="index.php?section=enrollment_ic&sid=<?php echo $sid;?>"><IMG SRC="images/lp_enrollment.gif" border="0"></A></td>
    <TD align="left"><h4><font FACE="Arial, Helvetica, sans-serif" color="#003366">
     <A HREF="index.php?section=enrollment&sid=<?php echo $sid;?>">Your Transcript</A></font></h4>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Your specific list of courses. You can take courses from the course list and add them to your enrollment list.</font></p> </td>
  </tr>
  <tr>
  		<td align="right"><font FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=enrollment&sid=<?php echo $sid;?>">more</A>]</B></font></td>
  </tr>
</table>
<table border="0" CELLSPACING="0" CELLPADDING="4" WIDTH="390" style="float:left; margin-left:10px;">
  <TR >
    <TD rowspan="2" width="130"><A HREF="index.php?section=courselist&sid=<?php echo $sid;?>"><IMG SRC="images/lp_courselist.gif" border="0"></A></td>
    <TD align="left"><h4><font FACE="Arial, Helvetica, sans-serif" color="#003366">
     <A HREF="index.php?section=courselist&sid=<?php echo $sid;?>">Courses</A></font></h4>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Additional courses and tests which you may add to your enrollment list.</font></p></td>
  </tr>
  <tr>
  		<td align="right"><font FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=courselist&sid=<?php echo $sid;?>">more</A>]</B></font></td>
  </tr>
</table>
</td></tr></table>
<hr   WIDTH="100%" />
<table border="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><tr><TD >

<table border="0" CELLSPACING="0" CELLPADDING="4" WIDTH="390" style="float:left;">
  <TR >
    <TD rowspan="2" width="130"><A HREF="index.php?section=courselist&sid=<?php echo $sid;?>"><IMG SRC="images/news.png" border="0"></A></td>
    <TD align="left"><h4><font FACE="Arial, Helvetica, sans-serif" color="#003366">
     <A HREF="index.php?section=news&sid=<?php echo $sid;?>">News</A></font></h4>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">News.</font></p></td>
  </tr>
  <tr>
  		<td align="right"><font FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=news&sid=<?php echo $sid;?>">more</A>]</B></font></td>
  </tr>
</table>
<table border="0" CELLSPACING="0" CELLPADDING="4" WIDTH="390" style="float:left; margin-left:10px;">
  <TR >
    <TD rowspan="2" width="130"><A HREF="index.php?section=courselist&sid=<?php echo $sid;?>"><IMG SRC="images/MessageBoard.png" border="0"></A></td>
    <TD align="left"><h4><font FACE="Arial, Helvetica, sans-serif" color="#003366">
     <A HREF="index.php?section=messageboard&sid=<?php echo $sid;?>">Message Board</A></font></h4>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Message Board.</font></p></td>
  </tr>
  <tr>
  		<td align="right"><font FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=messageboard&sid=<?php echo $sid;?>">more</A>]</B></font></td>
  </tr>
</table>
</td></tr></table>
<hr   WIDTH="100%" />
<table border="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><tr><TD >

<table border="0" CELLSPACING="0" CELLPADDING="4" WIDTH="390" style="float:left;">
  <TR >
    <TD rowspan="2" width="130"><A HREF="index.php?section=courselist&sid=<?php echo $sid;?>"><IMG SRC="images/Repository.png" border="0"></A></td>
    <TD align="left"><h4><font FACE="Arial, Helvetica, sans-serif" color="#003366">
     <A HREF="index.php?section=library&sid=<?php echo $sid;?>">Repository</A></font></h4>
            <p><font color="#666666" size="2" face="Arial, Helvetica, sans-serif">Repository.</font></p></td>
  </tr>
  <tr>
  		<td align="right"><font FACE="Arial, Helvetica, sans-serif" SIZE="2"><B>[<A HREF="index.php?section=library&sid=<?php echo $sid;?>">more</A>]</B></font></td>
  </tr>
</table>
</td></tr></table>
<hr   WIDTH="100%" />
<table align="left" style="padding-left:100px;">
<tr><td align="center"><h4><FONT FACE="Arial, Helvetica, sans-serif" color="#507EA1">
     News Section</FONT></h4></td></tr>
<tr><td align="center">
<?php include 'bottom_news_list.php'; ?>
</td></tr></table>
<!--
<P>
<table border="0" CELLSPACING="0" CELLPADDING="0" WIDTH="70%"><tr><TD BGCOLOR="#CCCCCC">
<table border="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <td><IMG SRC="images/lp_search.gif" border="0"></td>
    <TD align="left"><font FACE="VERDANA" SIZE="2">Search for courses, tests, learning resources in the course list or your enrollment list.<B>[<A HREF="#">more</A>]</B></td>
  </tr>
  <tr>
  		<td></td>
  </tr>
</table>
</td></tr></table>
<hr  WIDTH="70%"/>
-->
</div>