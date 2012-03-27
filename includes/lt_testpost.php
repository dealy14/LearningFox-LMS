<?php
require_once("../conf.php");

if($section!="reports")
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body TOPMARGIN="0" LEFTMARGIN="0" RIGHTMARGIN="0">
<?php
}
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%"><TR><TD BGCOLOR="#d8d8d8">
<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="1" WIDTH="100%">
  <TR>
    <TD BGCOLOR="#000000" COLSPAN="5"><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Test Results:</TD>	
  </TR>
  <TR>
    <TD BGCOLOR="#000000"><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF">&nbsp;</TD>  
    <TD BGCOLOR="#000000"><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Number</TD>
    <TD BGCOLOR="#000000"><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Question</TD>
    <TD BGCOLOR="#000000"><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Correct Answer</TD>
    <TD BGCOLOR="#000000"><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF"><B>Your Answer</TD>			
  </TR>
<?php
$starting_score=100;
$wrong_answ=0;
//Get String of user's Answers;
$db = new db;
$db->connect();
$db->query("SELECT questions.question,questions.choice_1,questions.choice_2,questions.choice_3,questions.choice_4,questions.correct_answ,questions.question_type FROM questions,tests_r WHERE tests_r.test_ID='$test_ID' AND tests_r.question_order>0 AND questions.ID=tests_r.question_ID ORDER BY tests_r.question_order ASC");
$xm=1;
while($db->getRows())
{ 
if($db->row("correct_answ")=="A")
{
$mansw=$db->row("choice_1");
}
else if($db->row("correct_answ")=="B")
{
$mansw=$db->row("choice_2");
}
else if($db->row("correct_answ")=="C")
{
$mansw=$db->row("choice_3");
}
else if($db->row("correct_answ")=="D")
{
$mansw=$db->row("choice_4");
}

if($q[$xm]=="A")
{
$rmansw=$db->row("choice_1");
}
else if($q[$xm]=="B")
{
$rmansw=$db->row("choice_2");
}
else if($q[$xm]=="C")
{
$rmansw=$db->row("choice_3");
}
else if($q[$xm]=="D")
{
$rmansw=$db->row("choice_4");
}
else
{
$rmansw="Not Answered.";
}

if($db->row("correct_answ")==$q[$xm])
{
$fcol="#000000";
$bgcol="#FFFFFF";
$img="check.gif";
}
else
{
$fcol="#ce0000";
$bgcol="#ffd7d7";
$img="x.gif";
$wrong_answ++;
}
?>
  <TR BGCOLOR="<?php echo $bgcol;?>">
    <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><IMG SRC="<?php echo $img;?>" BORDER="0"></TD>  
    <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2">#<?php echo $xm;?></TD>
    <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo nl2br($db->row("question"));?></TD>
    <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><B><?php echo $db->row("correct_answ");?></B>, <?php echo $mansw;?></TD>
    <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><B><FONT COLOR="<?php echo $fcol;?>"><?php echo $q[$xm];?></B>, <?php echo $rmansw;?></TD>	
  </TR>
<?php
$xm++;
}
$xm=$xm-1;
?>
</TABLE>
</TD></TR></TABLE>
<FONT FACE="VERDANA" SIZE="2">
<P>Your Score was <B><?php echo($xm-$wrong_answ)."</B> out of  <B>$xm</B>, giving you <B>".round((($xm-$wrong_answ)/$xm)*100)."%";?></B> on this Test.<BR>
Scores on the same test <B>will not</B> be re-recorded unless the test is reset by an administrator.

<SCRIPT>
<?php
$rscores=@implode("|",$q);
$myscores = round((($xm-$wrong_answ)/$xm)*100)."||$rscores";
?>
top.data.document.userdata.test_ID.value="<?php echo $test_ID;?>";
top.data.document.userdata.tempscore.value="<?php echo $myscores;?>";
top.data.document.userdata.formAction.value="PUSH_SCORE";
top.data.document.userdata.submit();
</SCRIPT>
</body>
</html>
