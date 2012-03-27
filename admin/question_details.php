<?php
require_once("../conf.php");


$ID       = $_REQUEST["ID"];

$db = new db;
$db->connect();
$db->query("SELECT * FROM questions WHERE ID='$ID'");
$xm=0;
while($db->getRows())
{ 
$rID=$db->row("ID");
$qname = $db->row("qname");
$question_type = $db->row("question_type");
$question = $db->row("question");
$choice_1 = $db->row("choice_1");
$choice_2 = $db->row("choice_2");
$choice_3 = $db->row("choice_3");
$choice_4 = $db->row("choice_4");
$correct_answ = $db->row("correct_answ");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
//top.top1.lessonItemSelect=1;
</SCRIPT>

<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">

<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=question1" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $ID;?>">
<INPUT TYPE="HIDDEN" NAME="formAction">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Question Properties:</SPAN>
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  <TR>
	    <TD><SPAN CLASS=ttl>Question ID:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="qname" CLASS="input" VALUE="<?php echo $qname;?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Survey Type:</SPAN></TD>
		<?php
		if($question_type=="MC")
		{
		$question_type="MC||Multiple Choice";
		}
		else if($question_type=="TF")
		{
		$question_type="TF||True/False";		
		}
		?>
	    <TD><?php input_list("question_type","$question_type,MC||Multiple Choice,TF||True/False",0,0,"CLASS=input");?></TD>		
	  </TR>  	  	
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Question:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="question" ROWS="6" COLS="65" CLASS="input"><?php echo $question;?></TEXTAREA></TD>		
	  </TR>	
	  
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice A:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_1" ROWS="4" COLS="65" CLASS="input"><?php echo $choice_1;?></TEXTAREA></TD>		
	  </TR>  
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice B:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_2" ROWS="4" COLS="65" CLASS="input"><?php echo $choice_2;?></TEXTAREA></TD>		
	  </TR> 
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice C:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_3" ROWS="4" COLS="65" CLASS="input"><?php echo $choice_3;?></TEXTAREA></TD>		
	  </TR> 
	  <TR>
	    <TD COLSPAN="2"><SPAN CLASS=ttl>Choice D:</SPAN></TD>
	  </TR>		  
	  <TR>
	    <TD COLSPAN="2"><TEXTAREA NAME="choice_4" ROWS="4" COLS="65" CLASS="input"><?php echo $choice_4;?></TEXTAREA></TD>		
	  </TR> 
	  <TR>
	    <TD><SPAN CLASS=ttl>Correct Answer:</SPAN></TD>
	    <TD><?php input_list("correct_answ","A,B,C,D",0,$correct_answ,"CLASS=input");?></TD>		
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

</FORM>
</BODY>