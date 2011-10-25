<?php
      if(isset($_POST['btnDel']) && !is_null($_POST["btnDel"]))
	  {
		  mysql_query("DELETE FROM user_own_messages WHERE RECORDID=".$_POST['btnDel']." AND OWNERID=".mysql_escape_string($_SESSION['lms_userID']));
	  }

	  $qryMapping = "SELECT * FROM user_message_mapping WHERE USERID=".mysql_escape_string($_SESSION['lms_userID']);
	  $rsMapping = mysql_query($qryMapping);
	  if($mapping = mysql_fetch_assoc($rsMapping))
	  {
		  $lastMessageId = $mapping["LASTMESSAGEID"];
	      mysql_free_result($rsMapping);
		  $qryMessage = "SELECT * FROM user_messages WHERE MESSAGEID>".$lastMessageId;
		  $rsMessage = mysql_query($qryMessage);
		  while($message = mysql_fetch_assoc($rsMessage))
		  {
			mysql_query("INSERT INTO user_own_messages (OWNERID,MESSAGEID) VALUES (".mysql_escape_string($_SESSION['lms_userID']).",".$message["MESSAGEID"].")");
		  }
		  mysql_free_result($rsMessage);
		  // update lastmessageid
		  $qryMaxMessage = "SELECT MAX(MESSAGEID) AS MAXMESSAGEID FROM user_messages";
		  $rsMaxMessage = mysql_query($qryMaxMessage);
		  if($maxMessage = mysql_fetch_assoc($rsMaxMessage))
		      mysql_query("UPDATE user_message_mapping SET LASTMESSAGEID=".$maxMessage["MAXMESSAGEID"]." WHERE USERID=".mysql_escape_string($_SESSION['lms_userID']));
		  mysql_free_result($rsMaxMessage);
	  }
	  else
	  {
		  $qryMaxMessage = "SELECT MAX(MESSAGEID) AS MAXMESSAGEID FROM user_messages";
		  $rsMaxMessage = mysql_query($qryMaxMessage);
		  if($maxMessage = mysql_fetch_assoc($rsMaxMessage))
		  {
			  if(empty($maxMessage["MAXMESSAGEID"]))
			  {
				  mysql_query("INSERT INTO user_message_mapping (USERID,LASTMESSAGEID) VALUES (".mysql_escape_string($_SESSION['lms_userID']).",0)");
			  }
			  else
			  {
		          mysql_query("INSERT INTO user_message_mapping (USERID,LASTMESSAGEID) VALUES (".mysql_escape_string($_SESSION['lms_userID']).",".$maxMessage["MAXMESSAGEID"].")");
			  }
		  }
		  mysql_free_result($rsMaxMessage);
	  }
?>
<div style="width:656px;">
<h2 align="center">Messages</h2>
    <form id="form1" method="post">
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" width="100%">
	<?php
	  $color_cnt = 0;
	  $qryOwnMessage = "SELECT user_own_messages.RECORDID,user_own_messages.MESSAGEID,user_messages.CREATEDATE,user_messages.MESSAGE,user_messages.TYPE,students.username FROM user_own_messages LEFT JOIN user_messages ON user_own_messages.MESSAGEID=user_messages.MESSAGEID LEFT JOIN students ON user_messages.USERID=students.ID WHERE user_own_messages.OWNERID=".mysql_escape_string($_SESSION['lms_userID'])." ORDER BY user_own_messages.MESSAGEID DESC";
	  $rsOwnMessage = mysql_query($qryOwnMessage);
	  if(mysql_num_rows($rsOwnMessage) > 0)
	  {
	?>
        <tr class="descriptor_row">
		 	<td><FONT FACE="VERDANA" SIZE="2">&nbsp;</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Name</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Create Date</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Content</FONT></td>
		 	<td><FONT FACE="VERDANA" SIZE="2">Type</FONT></td>
		</tr>
    <?php
	    while($ownMessage = mysql_fetch_assoc($rsOwnMessage))
		{
			$id = $ownMessage["RECORDID"];
			$name = $ownMessage["username"];
			$createDate = date("m/d/Y",strtotime($ownMessage["CREATEDATE"]));
			$content = $ownMessage["MESSAGE"];
			$content = str_replace('&quot;','"',$content);
			$type = $ownMessage["TYPE"];
			
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
        <tr>
             <td><button type="submit" name="btnDel" value="<?php echo($id) ?>">Del</button></td>
             <td><?php echo($name); ?></td>
             <td><?php echo($createDate); ?></td>
             <td><?php echo($content); ?></td>
             <td><?php echo($type); ?></td>
        </tr>
    <?php
			
		}
	  }
	  else
	  {
		  echo("<tr><td colspan='5'>no new messages</td></tr>");
	  }
	?>
	</TABLE>
    </form>
</div>