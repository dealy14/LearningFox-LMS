

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
	    <TD><FONT FACE="VERDANA" SIZE="2"><B>Posted:</B> <?php echo substr($db->row("created"),4,2);?>-<?php echo substr($db->row("created"),6,2);?>-<?php echo substr($db->row("created"),0,4);?><BR><B>Subject:</B> <?php echo $db->row("subject");?><P><?=nl2br($db->row("message"));?><P><?php echo $db->row("fname");?> <?php echo $db->row("lname");?></TD>
	  </TR>
	<?php  
	  }
	?>
	</TABLE>
<?php
//echo "SELECT SELECT forum_messages.* FROM forum_threads,forum_messages WHERE forum_threads.topicsID=$thread_ID AND forum_messages.threadID=forum_threads.ID";
?>

