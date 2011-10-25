<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<SCRIPT>
window.resizeTo(350,600);
</SCRIPT>
<STYLE TYPE="text/css">
.input {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#000000;BORDER-RIGHT:#000000;BORDER-LEFT:#000000;BORDER-BOTTOM:#000000;BACKGROUND:#93BEE2}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.submit {FONT-FAMILY:VERDANA;BACKGROUND:#336699;}
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="thisform" METHOD="POST" ACTION="create_objects_sql.php?action=question">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
	  <TR>
	    <TD><SPAN CLASS=ttl>Question ID:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="qname" CLASS="input"></TD>		
	  </TR>	  
	  <TR>
	    <TD><SPAN CLASS=ttl>Question Type:</SPAN></TD>
	    <TD>
		<SELECT NAME="question_type" CLASS="input">
		  <OPTION VALUE="MC" SELECTED>Multiple Choice</OPTION>
		  <OPTION VALUE="TF">True/False</OPTION>		  
		</SELECT>
		</TD>		
	  </TR>	 
	  
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Question:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="question" ROWS="3" COLS="35" CLASS="input"></TEXTAREA></TD>		
	  </TR>	
	  
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice A:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_1" ROWS="2" COLS="35" CLASS="input"></TEXTAREA></TD>		
	  </TR>  
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice B:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_2" ROWS="2" COLS="35" CLASS="input"></TEXTAREA></TD>		
	  </TR> 
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice C:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_3" ROWS="2" COLS="35" CLASS="input"></TEXTAREA></TD>		
	  </TR> 
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice D:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_4" ROWS="2" COLS="35" CLASS="input"></TEXTAREA></TD>		
	  </TR> 	 
	   	  
	  <TR>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>Correct Choice:</SPAN></TD>
	    <TD>
		<SELECT NAME="correct_answ" CLASS="input">
		  <OPTION VALUE="A" SELECTED>A</OPTION>
		  <OPTION VALUE="B">B</OPTION>
		  <OPTION VALUE="C">C</OPTION>
		  <OPTION VALUE="D">D</OPTION>		  		  	  
		</SELECT>
		</TD>		
	  </TR>	 		  	  	   		  	  	
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS=submit onClick="top.window.close();"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  CLASS=submit></TD>
	  </TR>				  
	</TABLE>

</FORM>
</body>
</html>
