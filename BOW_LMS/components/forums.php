<?php
switch($fsection)
{
###################################################################################################
#Default Organizational Forum Listing
###################################################################################################
case '':
?>

	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  <TR BGCOLOR="#000000">
	    <TD>&nbsp;</TD>
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Topic</TD>
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Posts</TD>
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Threads</TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Last Post</TD>			
	    <TD><FONT FACE="VERDANA" SIZE="2">&nbsp;</TD>
	  </TR>	
	<?php

	  
	  $db = new db;	
	  $db->connect();
	  $db->query("SELECT forum_topics.* FROM forums,forum_topics WHERE forums.orgID='smc01' AND forum_topics.forumID=forums.ID");
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
			 
				  $db2 = new db;			 
				  $db2->connect();
				  $db2->query("select count(DISTINCT threads.ID) as threads,count(DISTINCT messages.ID) as posts from forum_threads as threads,forum_messages as messages WHERE threads.topicsID=$ID AND messages.threadID=threads.ID");
				  while($db2->getRows())
				  {		
				  $posts = $db2->row("posts");
				  $threads = $db2->row("threads");				  
				  }	 
			 	  
	?>
	  <TR BGCOLOR="<?php echo $bgcol;?>">
	    <TD><FONT FACE="VERDANA" SIZE="2"><IMG SRC="images/f_bullet.gif" BORDER="0" ALIGN="ABSMIDDLE"></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $db->row("title");?></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $posts;?></TD>
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $threads;?></TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $db->row("title");?></TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?=$section?>&fsection=threads&sid=<?php echo $sid; ?>&thread_ID=<?=$db->row("ID");?>"><IMG SRC="images/lastpost.gif" BORDER="0" ALT="View Related Threads"></TD>
	  </TR>
	<?php  
	  }
	?>
	</TABLE>
	
<?php
break;



###################################################################################################
#Thread listing
###################################################################################################
case 'threads':
?>
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
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php substr($db->row("last_post"),4,2);?>-<?php substr($db->row("last_post"),6,2);?>-<?php substr($db->row("last_post"),0,4);?></TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?php echo $section;?>&fsection=messages&sid=<?php echo $sid; ?>&thread_ID=<?php echo $db->row("ID");?>"><IMG SRC="images/lastpost.gif" BORDER="0" ALT="View Related Posts"></TD>
	  </TR>
	<?php  
	  }
	?>
	</TABLE>
	
<?php	
break;


###################################################################################################
#Messages/Posts
###################################################################################################
case 'messages':
?>	
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
	<?php

	  
	  $db = new db;	
	  $db->connect();
	  $db->query("SELECT forum_messages.*,students.fname,students.lname,students.email FROM forum_messages,students WHERE forum_messages.threadID=$thread_ID AND forum_messages.userID=students.ID");
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
	    <TD><FONT FACE="VERDANA" SIZE="2"><B>Posted:</B> <?php substr($db->row("created"),4,2);?>-<?php substr($db->row("created"),6,2);?>-<?php substr($db->row("created"),0,4);?><BR><B>Subject:</B> <?php echo $db->row("subject");?><P><?php echo nl2br($db->row("message"));?><P><?php echo $db->row("fname");?> <?php echo $db->row("lname");?></TD>
	  </TR>
	<?php  
	  }
	?>
	</TABLE>
<?php
break;

}//end switch statement;
?>
