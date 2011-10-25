<?php
####################################################################################################################################################################
## Include Some JavaScript for the non-LMS version
####################################################################################################################################################################
$qr.="\n";
//copy static JavaScript functions here;
$filename = $dir_includes."quiz_modules/1_js";
$fd = fopen ($filename, "r");
$qr.=fread ($fd, filesize ($filename));
fclose ($fd);
####################################################################################################################################################################
## Include the content from the topic code (to be changed later)
####################################################################################################################################################################
$qr.=nl2br($content);

####################################################################################################################################################################
## Begin Quiz Table
####################################################################################################################################################################
$qr.="
<FORM NAME=\"myquiz\" METHOD=\"POST\" ACTION=\"../../includes/lt_testpost.php?&course_ID=\$course_ID\" onSubmit=\"checkTest();\">
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=1 WIDTH=100%><TR><TD BGCOLOR=#d8d8d8>
<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>
  <TR>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>Number</TD>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>Question</TD>	
  </TR>
";

####################################################################################################################################################################
## Database Quiz Extraction
####################################################################################################################################################################
	$db = new db;
	$db->connect();
	$db->query("SELECT questions.question,questions.choice_1,questions.choice_2,questions.choice_3,questions.choice_4,questions.correct_answ,questions.question_type FROM questions,tests_r WHERE tests_r.test_ID='$test_link' AND tests_r.question_order>0 AND questions.ID=tests_r.question_ID ORDER BY tests_r.question_order ASC");
	$xm=1;
	while($db->getRows())
	{ 
	$qr.="
	  <TR>
	    <TD BGCOLOR=#FFFFFF VALIGN=TOP><FONT FACE=VERDANA SIZE=2><B>$xm.</TD>
	    <TD BGCOLOR=#FFFFFF><FONT FACE=VERDANA SIZE=2><B>".nl2br($db->row("question"))."
		<UL>
			<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=2>
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name=q[$xm] value=A><FONT FACE=VERDANA SIZE=2><B>A</B></TD>
				<TD><FONT FACE=VERDANA SIZE=2> ".nl2br($db->row("choice_1"))."</TD>
			  </TR>
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name=q[$xm] value=B><FONT FACE=VERDANA SIZE=2><B>B</B></TD>
				<TD><FONT FACE=VERDANA SIZE=2> ".nl2br($db->row("choice_2"))."</TD>
			  </TR>			
	";
	if($db->row("question_type")!="TF")
	{
	$qr.="
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name=q[$xm] value=C><FONT FACE=VERDANA SIZE=2><B>C</B></TD>
				<TD><FONT FACE=VERDANA SIZE=2> ".nl2br($db->row("choice_3"))."</TD>
			  </TR>
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name=q[$xm] value=D><FONT FACE=VERDANA SIZE=2><B>D</B></TD>
				<TD><FONT FACE=VERDANA SIZE=2> ".nl2br($db->row("choice_4"))."</TD>
			  </TR>			
	";
	}		
	$qr.="	    
			</TABLE>
			</UL>
		</TD>	
	  </TR>	
	";
	$xm++;
	}
####################################################################################################################################################################
##  End db Extraction here, begin closing Quiz Table
####################################################################################################################################################################	
    $qr.="
	  <TR>
	    <TD BGCOLOR=Black COLSPAN=2 ALIGN=RIGHT><INPUT TYPE=SUBMIT NAME=SUBMIT VALUE=\"Submit Answers\"></TD>	
	  </TR>
    ";  
$qr.="</TABLE></TD></TR></TABLE>
<INPUT TYPE='HIDDEN' NAME='test_ID' VALUE='$test_link'>
</FORM>
";

####################################################################################################################################################################
## Stuff in standard "html" variable
####################################################################################################################################################################
$html="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<html>\n<head>\n<title>LearningTrak</title>\n</head>\n<BODY TOPMARGIN=0 LEFTMARGIN=0 RIGHTMARGIN=0>".addslashes($qr)."</BODY>\n</HTML>";

####################################################################################################################################################################
## Publish to file
####################################################################################################################################################################
to_file($dir_topics.$ID,$html,"w+");
?>
