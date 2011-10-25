<?php 
require_once("../conf.php");

$db = new db;
$db->connect();
$db->query("SELECT * FROM topic WHERE ID=$ID");
$xm=0;
while($db->getRows())
{ 
$rID=$db->row("ID");
$content = $db->row("content");
$content_link = $db->row("content_link");
$test_link = $db->row("test_link");
$content_location = $db->row("content_location");
$topic_type = $db->row("topic_type");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
top.top1.topicItemSelect=2;
</SCRIPT>

<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
	TABLE#controlTheShit
	        {
	        background-color:#EFF7FF; padding:1px;
	        }
	.cbtn
	        {
	        height:18;
	        BORDER-LEFT: #EFF7FF 1px solid;
	        BORDER-RIGHT: #EFF7FF 1px solid;
	        BORDER-TOP: #EFF7FF 1px solid;
	        BORDER-BOTTOM: #EFF7FF 1px solid;
	        }
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">


	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Topic Content:</SPAN>
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  <TR>
	    <TD>
		<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=topic2" onSubmit="set_x();" target="edit_post">
		<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
		<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo$rID;?>">
		<INPUT TYPE="HIDDEN" NAME="formAction">
		<INPUT TYPE="HIDDEN" NAME="content_location" VALUE="<?php echo $content_location;?>">
		<INPUT TYPE="HIDDEN" NAME="topic_type" VALUE="<?php echo $topic_type;?>">
		<INPUT TYPE="HIDDEN" NAME="test_link" VALUE="<?php echo $test_link;?>">
		<INPUT TYPE="HIDDEN" NAME="content_link" VALUE="<?php echo $content_link;?>">
        <input type="HIDDEN" name="content" value='<?php echo stripSlashes($content);?>'>
		
		
		
		
		
		
	<script LANGUAGE="JavaScript">
	screen_width = document.body.clientWidth - 40;   
	screen_height = document.body.clientHeight - 70; 	
	
	function button_over(doStuffButton)
	        {
	        doStuffButton.style.backgroundColor = "#EFF7FF";
	        doStuffButton.style.borderColor = "#FFFFFF #666666 #666666 #FFFFFF";
	        }
	function button_out(doStuffButton)
	        {
	        doStuffButton.style.backgroundColor = "#EFF7FF";
	        doStuffButton.style.borderColor = "#EFF7FF";
	        }
	function button_down(doStuffButton)
	        {
	        doStuffButton.style.backgroundColor = "#EFF7FF";
	        doStuffButton.style.borderColor = "#666666 #FFFFFF #FFFFFF #666666";
	        }
	function button_up(doStuffButton)
	    {
	    doStuffButton.style.backgroundColor = "#EFF7FF";
	        doStuffButton.style.borderColor = "#EFF7FF";
	    }
	</script>
	
	
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="controlTheShit">
				  <tr> 
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("Bold")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/bold.gif" alt="Bold">
				    </div></td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("Italic")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/italic.gif" alt="Italic">
				    </div></td>
				    <td width="56" height="23">&nbsp;</td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("InsertOrderedList")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/numlist.gif" alt="Numbered List">
				    </div></td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("InsertUnorderedList")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/bullist.gif" alt="Unordered List">
				    </div></td>
				    <td width="56" height="23">&nbsp;</td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("JustifyLeft")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/left.gif" alt="Left Justify">
				    </div></td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("JustifyCenter")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/center.gif" alt="Center">
				    </div></td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("JustifyRight")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/right.gif" alt="Right Justify">
				    </div></td>
				    <td width="56" height="23">&nbsp;</td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("Indent")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/inindent.gif" alt="Indent">
				    </div></td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("Outdent")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/deindent.gif" alt="Outdent">
				    </div></td>
				    <td width="56" height="23">&nbsp;</td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("Cut")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/cut.gif" alt="Cut">
				    </div></td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("Copy")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/copy.gif" alt="Copy">
				    </div></td>
				    <td width="23" height="23"><div class="cbtn" onClick='doStuff("Paste")'     onmouseover="button_over(this);" onMouseOut="button_out(this);"     onmousedown="button_down(this);" onMouseUp="button_up(this);">
				        <img hspace="1" vspace=1 align=absmiddle src="images/paste.gif" alt="Paste">
				    </div></td>
				  </tr>
				  <!--
				  <TR>
				    <td>&nbsp;</td>	  
				    <td width="23" height="23"><div class="cbtn" onClick='addImage();'     onmouseover="button_over(this);" onmouseout="button_out(this);"     onmousedown="button_down(this);" onmouseup="button_up(this);"><img hspace="1" vspace=1 align=absmiddle src="images/image.gif" alt="Insert Image"></div></td>	  	  
					<td width="23" height="23"><div class="cbtn" onClick='addImage();'     onmouseover="button_over(this);" onmouseout="button_out(this);"     onmousedown="button_down(this);" onmouseup="button_up(this);"><img hspace="1" vspace=1 align=absmiddle src="images/link.gif" alt="Insert Image"></div></td>	  	  
					<td>&nbsp;</td>
					<td COlSPAN="2" height="23"><FONT FACE="Arial" SIZE="1">Font Size</td>	  	  
				    <td COLSPAN="11"></td>	  	  		
				  </TR>
				  -->
				</table>
				<iframe width="100%" height="300" id=bpStuffEditor></iframe><br>
				
				
				        <script>
				
				        bpStuffEditor.document.write("<?php //this blurb strips windows-style line-feeds
				       //'cause the vb or javascript or whatever
				       //this nasty shit is chokes on 'em
				       //otherwise this is where you pre-load the editor
				       //with content if you wanna
				   $explodeResult = explode("\r\n",$content);
				   $total = sizeof ($explodeResult);
				   for ($count = 0; $count < $total; $count ++) {
				         print($explodeResult[$count]);
						
				   }
				   ?>");
				
				  function doStuff(stuff) {
				  var tr = frames.bpStuffEditor.document.selection.createRange()
				  tr.execCommand(stuff)
				  tr.select()
				  set_x();
				  frames.bpStuffEditor.focus()
				  }
				  
				  function addImage()
				  {
				  //tempWin=window.open('image_upload.php','nothing','height=200,width=200');
				  
				  var tr = frames.bpStuffEditor.document.selection.createRange()
				  tr.execCommand('InsertImage','',prompt('Image URL'))
				  tr.select()
				  set_x();
				  frames.bpStuffEditor.focus();	
				  
				  }
				
				function set_x() {
				var x = bpStuffEditor.document.body.innerHTML;
				document.editForm.content.value = x;
				}
				
				frames.bpStuffEditor.document.designMode = "on";
				
				frames.bpStuffEditor.document.onkeyup = set_x;
				//document.onclick = hideMenu;
				
				       </script>		
		
		</form>
	    </TD>		
	  </TR>	  	  			  
	</TABLE>
	</TD>
	<TD BACKGROUND="images/bev_right.gif" WIDTH="8"></TD>	
	  </TR>
	  <TR>
	    <TD><IMG SRC="images/bev_left_b_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_bottom.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_b_corner.gif"></TD>	
	  </TR>		
	</TABLE>
</BODY>