<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8" WIDTH="80%">
<?php
  $db = new db;
  $db->connect();
  $db->query("SELECT created,name,ID,type FROM course WHERE status='active'");
  while($db->getRows())
  {
  $course_ID=$db->row("ID");
  $course_name=$db->row("name");
  $created=$db->row("created");
  $type=$db->row("type");
?>
  <TR BGCOLOR="#FFFFFF">
    <TD><A HREF="#"><FONT FACE="VERDANA" SIZE="2"><IMG SRC="images/course_list1.gif" BORDER="0" ALIGN="ABSMIDDLE"></A> <B><?php echo $course_name;?></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Course Type: <?php echo $type;?></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Created on: <?php echo $created;?></TD>
    <TD><A HREF="#"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=coursedetails&sid=<?php echo $sid; ?>&course_ID=<?php echo $course_ID;?>">Details</A>]</TD>
  </TR>
<?php  
  }
?>
</TABLE>

