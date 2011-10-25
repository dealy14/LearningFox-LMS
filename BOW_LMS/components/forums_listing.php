<?php
echo"<B><A HREF='index.php?section=$section&sid=$sid'>$lms_org_name Forums</A>";
if($topic_name)
{
echo" > <A HREF='index.php?section=$section&sid=$sid&fsection=threads&topic_ID=$topic_ID&topic_name=".urlencode($topic_name)."'>$topic_name</A>";		
}
if($thread_name)
{
echo " > <A HREF='index.php?section=$section&sid=$sid&fsection=messages&topic_ID=$topic_ID&topic_name=".urlencode($topic_name)."&thread_ID=$thread_ID&thread_name=".urlencode($thread_name)."'>$thread_name</A>";
}
?></B><BR><BR><?php
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
	    <TD><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Maximum Posts</TD>			
	    <TD><FONT FACE="VERDANA" SIZE="2">&nbsp;</TD>
	  </TR>	
	<?php

	  
	  $db = new db;	
	  $db->connect();
	  $db->query("SELECT forum_topics.*,forums.maxposts FROM forums,forum_topics WHERE (forums.orgID='$lms_org' OR forums.orgID='ALL') AND forum_topics.forumID=forums.ID");
	  $x=0;
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
	    <TD><FONT FACE="VERDANA" SIZE="2"><?php echo $db->row("maxposts");?></TD>				
	    <TD><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?php echo $section;?>&fsection=threads&sid=<?php echo $sid; ?>&topic_ID=<?php echo $db->row("ID");?>&topic_name=<?php echo urlencode($db->row("title"))?>"><IMG SRC="images/lastpost.gif" BORDER="0" ALT="View Related Threads"></TD>
	  </TR>
	<?php  
	$x++;
	  }
	  if($x<1)
	  {
	  ?>
	  <TR>
		<TD BGCOLOR="#FFFFFF" COLSPAN="6" ALIGN="CENTER"><FONT FACE="VERDANA" SIZE="2">There are currently no Discussion topics in this Forum.<P>Contact your administrator about creating new Forums.</TD>
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
	  <TR>
		<TD BGCOLOR="#c6c6c6" COLSPAN="6" ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?php echo $section;?>&sid=<?php echo $sid; ?>&fsection=newthread2&topic_ID=<?php echo $topic_ID;?>&thread_ID=not_known&topic_name=<?php echo urlencode($topic_name);?>&thread_name=<?php echo urlencode($thread_name);?>"><IMG SRC="images/newthread.gif" ALT="Begin a new Thread" BORDER="0"></A></TD>
	  </TR>		
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
	  $db->query("SELECT forum_messages.*,count(forum_messages.ID) as posts,max(created) as last_post, students.fname,students.lname, forum_threads.ID as tID FROM forum_threads,forum_messages,students WHERE forum_threads.topicsID=$topic_ID AND forum_messages.threadID=forum_threads.ID AND students.ID=forum_threads.userID GROUP BY threadID");
	  $x=0;
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
	    <TD><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?php echo $section;?>&fsection=messages&sid=<?php echo $sid; ?>&topic_ID=<?php echo $topic_ID;?>&thread_ID=<?php echo $db->row("tID");?>&topic_name=<?php echo urlencode($topic_name);?>&thread_name=<?php echo urlencode($db->row("subject"));?>"><IMG SRC="images/lastpost.gif" BORDER="0" ALT="View Related Posts"></TD>
	  </TR>
	<?php  
	$x++;
	  }
	  if($x<1)
	  {
	  ?>
	  <TR>
		<TD BGCOLOR="#FFFFFF" COLSPAN="6" ALIGN="CENTER"><FONT FACE="VERDANA" SIZE="2">There are currently no threads in this topic.<P>You can easily start a new discussion thread by clicking the "New Thread" Button and posting aquestion or comment.</TD>
	  </TR>		  
	  <?php
	  }
	?>
	  <TR>
		<TD BGCOLOR="#c6c6c6" COLSPAN="6" ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?php echo $section;?>&sid=<?php echo $sid; ?>&fsection=newthread2&topic_ID=<?php echo $topic_ID;?>&thread_ID=not_known&topic_name=<?php echo urlencode($topic_name);?>&thread_name=<?php echo urlencode($thread_name);?>"><IMG SRC="images/newthread.gif" ALT="Begin a new Thread" BORDER="0"></A></TD>
	  </TR>		
	</TABLE>
	
<?php	
break;


###################################################################################################
#Messages/Posts
###################################################################################################
case 'messages':
?>	
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="90%">
	  <TR>
		<TD BGCOLOR="#c6c6c6" COLSPAN="2" ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?php echo $section;?>&sid=<?php echo $sid; ?>&fsection=newthread2&topic_ID=<?php echo $topic_ID;?>&thread_ID=<?php echo $thread_ID;?>&topic_name=<?php echo urlencode($topic_name);?>&thread_name=<?php echo urlencode($thread_name);?>"><IMG SRC="images/newthread.gif" ALT="Begin a new Thread" BORDER="0"></A> <A HREF="index.php?section=<?php echo $section;?>&sid=<?php echo $sid; ?>&fsection=reply&topic_ID=<?php echo $topic_ID;?>&thread_ID=<?php echo $thread_ID;?>&topic_name=<?php echo urlencode($topic_name);?>&thread_name=<?php echo urlencode($thread_name);?>"><IMG SRC="images/reply.gif" ALT="Post a Reply to this Thread." BORDER="0"></TD>
	  </TR>		
	  <TR>
	    <TD BGCOLOR="#c6c6c6"><FONT FACE="VERDANA" SIZE="2"><B>Author</TD>
		<TD BGCOLOR="#c6c6c6"><FONT FACE="VERDANA" SIZE="2"><B>Thread</TD>
	  </TR>		
	<?php

	  
	  $db = new db;	
	  $db->connect();
	  $db->query("SELECT forum_messages.*,students.fname,students.lname,students.email,groups.name, subgroups.sub_name FROM forum_messages,students,groups,subgroups WHERE forum_messages.threadID=$thread_ID AND forum_messages.userID=students.ID AND groups.ID=students.user_group AND subgroups.ID=students.user_subgroup ORDER BY forum_messages.ID DESC");
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
	  	<TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="1"><B>Name:</B><BR><?php echo $db->row("fname");?> <?php echo $db->row("lname");?><BR><B><?php echo $lms_gtitle;?>:</B><BR><?php echo $db->row("name");?><BR><B><?php echo $lms_sgtitle;?>:</B><BR><?php echo $db->row("sub_name");?></TD>
	    <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><B>Subject:</B> <?php echo $db->row("subject");?><BR><B>Posted:</B> <?php echo substr($db->row("created"),4,2);?>-<?php echo substr($db->row("created"),6,2);?>-<?php echo substr($db->row("created"),0,4);?><P><?php echo nl2br($db->row("message"));?><P><FONT SIZE="1">-<?php echo $db->row("fname");?> <?php echo $db->row("lname");?><BR><BR></TD>
	  </TR>
 
	  <TR>
	    <TD BGCOLOR="#6c6c6c" HEIGHT="1" COLSPAN="2"></TD>
	  </TR>	 
	  <TR>
	    <TD BGCOLOR="#d8d8d8" HEIGHT="1" COLSPAN="2"></TD>
	  </TR>	 	
	    	  
	<?php  
	  }
	?>
	  <TR>
		<TD BGCOLOR="#c6c6c6" COLSPAN="2" ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><A HREF="index.php?section=<?php echo $section?>&sid=<?php echo $sid; ?>&fsection=newthread2&topic_ID=<?php echo $topic_ID;?>&thread_ID=<?php echo $thread_ID;?>&topic_name=<?php echo urlencode($topic_name);?>&thread_name=<?php echo urlencode($thread_name);?>"><IMG SRC="images/newthread.gif" ALT="Begin a new Thread" BORDER="0"></A> <A HREF="index.php?section=<?php echo $section?>&sid=<?php echo $sid; ?>&fsection=reply&topic_ID=<?php echo $topic_ID;?>&thread_ID=<?php echo $thread_ID;?>&topic_name=<?php echo urlencode($topic_name);?>&thread_name=<?php echo urlencode($thread_name);?>"><IMG SRC="images/reply.gif" ALT="Post a Reply to this Thread." BORDER="0"></TD>
	  </TR>	
	</TABLE>
<?php
break;

###################################################################################################
#Messages/Posts
###################################################################################################
case 'reply':
if($submitreply)
{
insertAction("INSERT INTO forum_messages (subject,message,replied_to,userID,threadID)VALUES('$subject','$message','no','$user_ID','$thread_ID')");
echo"<SCRIPT>location.href='index.php?section=$section&fsection=messages&sid=$sid&topic_ID=$topic_ID&thread_ID=$thread_ID&thread_name=".urlencode($thread_name)."&topic_name=".urlencode($topic_name)."';</SCRIPT>";
die();
}
?>
<P>Reply to the thread <B><I><?php echo $thread_name;?></I></B>
<FORM METHOD="POST" ACTION="index.php?section=<?php echo $section;?>&sid=<?php echo $sid; ?>&fsection=reply">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4">
	<TR>
		<TD><FONT FACE="VERDANA" SIZE="2"><B>Subject: </TD>
		<TD><INPUT TYPE="TEXT" NAME="subject" SIZE="35" MAXLENGTH="200"></TD>
	</TR>
	<TR>
		<TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Message: </TD>
	</TR>	
	<TR>
		<TD COLSPAN="2"><TEXTAREA NAME="message" ROWS="5" COLS="40"></TEXTAREA></TD>
	</TR>		
	<TR>
		<TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" VALUE="Submit Reply" NAME="submitreply"></TD>
	</TR>		
</TABLE>
<INPUT TYPE="HIDDEN" NAME="thread_ID" VALUE="<?php echo $thread_ID;?>">
<INPUT TYPE="HIDDEN" NAME="topic_ID" VALUE="<?php echo $topic_ID;?>">
<INPUT TYPE="HIDDEN" NAME="user_ID" VALUE="<?php echo $lms_userID;?>">
<INPUT TYPE="HIDDEN" NAME="topic_name" VALUE="<?php echo $topic_name;?>">
<INPUT TYPE="HIDDEN" NAME="thread_name" VALUE="<?php echo $thread_name;?>">
</FORM>
<?php
$fsection="messages";
include($dir_components."forums_listing.php");
break;

###################################################################################################
#Messages/Posts
###################################################################################################
case 'newthread2':
if($addthread)
{
//create new token;
$tokenID=time();
insertAction("INSERT INTO forum_threads (tokenID,userID,topicsID)VALUES('$tokenID','$user_ID','$topic_ID')");
//retreive thread based on token;
$db = new db;	
$db->connect();
$db->query("SELECT ID FROM forum_threads WHERE tokenID=$tokenID");
while($db->getRows())
{
$new_thread_ID=$db->row("ID");
}	  
insertAction("INSERT INTO forum_messages (subject,message,replied_to,userID,threadID)VALUES('$subject','$message','no','$user_ID','$new_thread_ID')");
echo"<SCRIPT>location.href='index.php?section=$section&fsection=messages&sid=$sid&topic_ID=$topic_ID&thread_ID=$new_thread_ID&thread_name=".urlencode($subject)."&topic_name=".urlencode($topic_name)."';</SCRIPT>";
die();
}
?>
<P>Add A New Thread Under <B><I><?php echo $topic_name;?></I></B>
<FORM METHOD="POST" ACTION="index.php?section=<?php echo $section;?>&sid=<?php echo $sid; ?>&fsection=newthread2">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4">
	<TR>
		<TD><FONT FACE="VERDANA" SIZE="2"><B>Subject: </TD>
		<TD><INPUT TYPE="TEXT" NAME="subject" SIZE="35" MAXLENGTH="200"></TD>
	</TR>
	<TR>
		<TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Message: </TD>
	</TR>	
	<TR>
		<TD COLSPAN="2"><TEXTAREA NAME="message" ROWS="5" COLS="40"></TEXTAREA></TD>
	</TR>		
	<TR>
		<TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" VALUE="Add New Thread" NAME="addthread"></TD>
	</TR>		
</TABLE>
<INPUT TYPE="HIDDEN" NAME="thread_ID" VALUE="<?php echo $thread_ID;?>">
<INPUT TYPE="HIDDEN" NAME="user_ID" VALUE="<?php echo $lms_userID;?>">
<INPUT TYPE="HIDDEN" NAME="topic_ID" VALUE="<?php echo $topic_ID;?>">
<INPUT TYPE="HIDDEN" NAME="topic_name" VALUE="<?php echo $topic_name;?>">
<INPUT TYPE="HIDDEN" NAME="thread_name" VALUE="<?php echo $thread_name;?>">
</FORM>
<?php
break;
}//end switch statement;
?>
