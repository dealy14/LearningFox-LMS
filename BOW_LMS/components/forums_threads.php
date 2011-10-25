

	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  <TR BGCOLOR="#000000">
	    <TD>&nbsp;</TD>
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Thread</TD>
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Started by</TD>
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Replies</TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Last Post</TD>			
	    <TD><FONT FACE="VERDANA" SIZE="2">&nbsp;</TD>
	  </TR>	
	<?php

	  
	  $db = new db;	
	  $db->connect();
	  $db->query("SELECT forum_messages.*,count(forum_messages.ID) as posts,max(created) as last_post, students.fname,students.lname FROM forum_threads,forum_messages,students WHERE forum_threads.topicsID=$thread_ID AND forum_messages.threadID=forum_threads.ID AND students.ID=forum_threads.userID GROUP BY threadID");
	  while($db->getRows())
	  {
	  $ID=$db->row("ID");

			 if(!$color_cnt||$color_cnt==1)
			 {
			 $bgcol="#f8f8ff";
			 $color_cnt=2;
			 }
			 else
			 {
			 $bgcol="#FFFFFF";	 
			 $color_cnt=1;	 
			 }
			 
	?>
	  <TR BGCOLOR="<?php echo $bgcol;?>">
	    <TD><FONT FACE="VERDANA" SIZE="2"><IMG SRC="images/f_bullet.gif" BORDER="0" ALIGN="ABSMIDDLE"></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $db->row("subject");?></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $db->row("fname")." ".$db->row("lname");?></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo ($db->row("posts")-1);?></TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo substr($db->row("last_post"),4,2);?>-<?php echo substr($db->row("last_post"),6,2);?>-<?php echo substr($db->row("last_post"),0,4);?></TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=messages&sid=<?php echo $sid; ?>&thread_ID=<?php echo $db->row("ID");?>"><IMG SRC="images/lastpost.gif" BORDER="0" ALT="View Related Posts"></TD>
	  </TR>
	<?php  
	  }
	?>
	</TABLE>
<?php
//echo "SELECT SELECT forum_messages.* FROM forum_threads,forum_messages WHERE forum_threads.topicsID=$thread_ID AND forum_messages.threadID=forum_threads.ID";
?>

