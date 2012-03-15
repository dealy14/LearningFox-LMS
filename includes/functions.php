<?php

#########################################################################
#General Form Element funcions
#########################################################################
//--------------------General form element functions;
function form_table($action,$color)
{
?>
<FORM METHOD="POST" NAME="theform" ACTION="<?php echo $action;?>">
<TABLE BORDER="0" CELLPADDING="0 CELLSPACING="0"><TR><TD BGCOLOR="<?php echo $color;?>">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
<?php
}

function form_table2($method,$action,$color)
{
?>
<FORM METHOD="<?php echo $method;?>" NAME="theform" ACTION="<?php echo $action;?>">
<TABLE BORDER="0" CELLPADDING="0 CELLSPACING="0"><TR><TD BGCOLOR="<?php echo $color;?>">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
<?php
}

function table($color)
{
?>
<FORM>
<TABLE BORDER="0" CELLPADDING="0 CELLSPACING="0"><TR><TD BGCOLOR="<?php echo $color;?>">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
<?php
}

function table_open($values)
{
?>
<TABLE <?php echo $values;?>>
<?php
}

function table2($color,$cellspacing,$cellpadding,$border)
{
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD BGCOLOR="<?php echo $color;?>">
<TABLE BORDER="<?php echo $border;?>" CELLSPACING="<?php echo $cellspacing;?>" CELLPADDING="<?php echo $cellpadding;?>">
<?php
}

function end_table()
{
?>
</TABLE>
</TD></TR></TABLE>
</FORM>
<?php
}

function end_norm_table()
{
?>
</TABLE>
</TD></TR></TABLE>
<?php
}

function end_table_open()
{
?>
</TABLE>
<?php
}

function row($td,$td_number,$td_values,$standard_val)
{
?>
<TR>
<?php
	if($td_values!="0")
	{
	$x=0;
	$values=explode("||",$td_values);
		while ($x<$td_number)
		{
		echo"  <TD $td>$standard_val $values[$x]</TD>\n";
		$x++;
		}
	}	
?>
</TR>
<?php	
}

function row_edit($td,$td_number,$td_values,$submit_style,$formlink)
{
?>
<TR><FORM METHOD="POST" ACTION="<?php echo $formlink;?>">
<?php
	if($td_values!="0")
	{
	$x=0;
	$values=explode("||",$td_values);
		while ($x<$td_number)
		{
		if($values[$x]=="")
		{
		echo"  <TD $td>&nbsp;</TD>\n";
		}
		else
		{
		echo"  <TD $td><INPUT TYPE='SUBMIT' NAME='sort' VALUE='$values[$x]' $submit_style></TD>\n";
		}
		$x++;
		}
	}	
?>
</FORM></TR>
<?php	
}

function row_edit_toolbar1($td,$td_number,$td_values,$formlink)
{
?>
<TR>
<?php
echo"  <TD COLSPAN='$td_number' $td>";
	if($td_values!="0")
	{
	$x=0;
	$values=explode("||",$td_values);
		while ($x<$td_number)
		{
		if($values[$x]=="")
		{
		echo"&nbsp;";
		}
		else
		{
		echo"$values[$x]";
		}
		$x++;
		}
	}	
echo"</TD>\n";
?>
</TR>
<?php	
}

function end_row()
{
echo"</TR>";
}

function input_text($type,$name,$value)
{
?>
<INPUT TYPE="<?php echo $type;?>" NAME="<?php echo $name;?>" VALUE="<?php echo $value;?>">
<?php
}

function input_text2($type,$name,$value,$extra,$styles)
{
?>
<INPUT TYPE="<?php echo $type;?>" NAME="<?php echo $name;?>" VALUE="<?php echo $value;?>" SIZE="<?php echo $extra;?>" <?php echo $styles;?>>
<?php
}

function input_list($name,$alist,$mult,$selected,$styles)
{
if($mult>=1)
{
$multiple="MULTIPLE SIZE='$mult'";
}

if(is_integer($mult))
{
echo"<SELECT NAME=\"$name\" $multiple $styles>\n";
}
else
{
$mmult=explode("||",$mult);
  if($mmult[2]>=1)
  {
  $multiple="MULTIPLE SIZE='$mmult[2]'";
  }
echo"<SELECT NAME=\"$name\" $multiple $styles>\n";  
}

if(!is_integer($alist))
{
	if(file_exists($alist))
	{
		$pairs=file($alist);
	}
	else
	{
	$pairs=explode(",",trim($alist));
	}
}
if(!is_integer($selected))
{
echo "\t<OPTION VALUE='".trim($selected)."' SELECTED>$selected</OPTION>\n";
}


//-----------------------------------find out if it is a db extract function;
if(!is_integer($mult))
{
//use the mult input for option SQL paramaters in table||column format;
$nSQL = explode("||",$mult);
$dbextract = new db;
$dbextract->connect();
  $subq=explode("|",$nSQL[1]);
  if(count($subq)>1)
  {
  $nsubq=@implode(",",$subq);
  }
  else
  {
  $subq[1]=$subq[0];
  $nsubq=$subq[0];
  }
//$sql="SELECT $nSQL[1] FROM $nSQL[0] ORDER BY ID ASC";
	$sql="SELECT $nsubq FROM $nSQL[0] ORDER BY ID ASC";
	$dbextract->query($sql);
	while($dbextract->getRows())
	{
	echo "\t<OPTION VALUE='".trim($dbextract->row($subq[0]))."'>".$dbextract->row($subq[1])."</OPTION>\n";
	}
}


//-----------------------------------find out if it is an autonum function;
else if($pairs[0]=="autonum")
{
	if($pairs[1]=="+")
	{
		$x = $pairs[2];
		while($x<=$pairs[3])
		{
			 if($x=="$selected" && is_integer($selected))
			 {
			 echo "\t<OPTION VALUE='$x' SELECTED>$x</OPTION>\n";
			 }
			 else
			 {
			 echo "\t<OPTION VALUE='$x'>$x</OPTION>\n";
			 }			
		  $x++;
		}
	}	
	else if($pairs[1]=="-")
	{
		$x = $pairs[2];
		while($x>=$pairs[3])
		{
			 if($x=="$selected" && is_integer($selected))
			 {
			 echo "\t<OPTION VALUE='$x' SELECTED>$x</OPTION>\n";
			 }
			 else
			 {
			 echo "\t<OPTION VALUE='$x'>$x</OPTION>\n";
			 }		
		  $x--;
		}	
	}

//echo$sql;
}


//-----------------------------------normal;
else
{
	$rn=0;
	while ($rn<count($pairs))
	{
		$values=explode("||",$pairs[$rn]);
		 if(count($values)<2)
		 {
		 $value1=ereg_replace("\n","",$values[0]);
		 }
		 else
		 {
		 $value1=ereg_replace("\n","",$values[1]);
		 }
		 if($rn=="$selected" && is_integer($selected))
		 {
		 echo "\t<OPTION VALUE='".trim($values[0])."' SELECTED>$value1</OPTION>\n";
		 }
		 else
		 {
		 echo "\t<OPTION VALUE='".trim($values[0])."'>$value1</OPTION>\n";
		 }
	$rn++;
	
	}	
	
	}
	//echo$sql;
	echo"</SELECT>\n";
}

function input_list2($name,$alist,$sp,$mult,$selected,$value,$styles)
{
if($mult>=1)
{
$multiple="MULTIPLE HEIGHT='$mult'";
}
echo"<SELECT NAME=\"$name\" $multiple $styles>\n";
if(file_exists($alist))
{
$pairs=file($alist);
}
else
{
$pairs=explode(",",trim($alist));
}

$rn=0;
	if($value!="")
	{
		 if($value!="0")
		 {
		 echo"\t<OPTION VALUE='$value' SELECTED>$value</OPTION>\n";
		 }
	}
while ($rn<count($pairs))
{
	$values=explode($sp,$pairs[$rn]);
	 if(count($values)<2)
	 {
		 if($sp=="--")
		 {
		 $value1=$values[0];
		 }
		 else
		 {
		 $value1=$values[0];
		 }
	 }
	 else
	 {
	 	 if($sp=="--")
		 {
		 $value1=$values[0];
		 }
		 else
		 {
		 $value1=$values[1];
		 }
	 }
	 if($rn=="$selected"&&$value=="0")
	 {
	 echo"\t<OPTION VALUE='$values[0]' SELECTED>$value1</OPTION>\n";
	 }
	 else
	 {
	 echo"\t<OPTION VALUE='$values[0]'>$value1</OPTION>\n";
	 }
$rn++;

}	
echo"</SELECT>\n";
}

function input_list3($name,$alist,$mult,$styles)
{
if($mult>=1)
{
$multiple="MULTIPLE HEIGHT='$mult'";
}
echo"<SELECT NAME=\"$name\" $multiple $styles>\n";
if(file_exists($alist))
{
$pairs=file($alist);
}
else
{
$pairs=explode(",",trim($alist));
}

$rn=0;
while ($rn<count($pairs))
{
	$values=explode("||",$pairs[$rn]);
	 if(count($values)<2)
	 {
	 $value1=$values[0];
	 }
	 else
	 {
	 $value1=$values[1];
	 }
	 if($rn=="$selected")
	 {
	 echo"\t<OPTION VALUE='$values[0]' SELECTED>$value1</OPTION>\n";
	 }
	 else
	 {
	 echo"\t<OPTION VALUE='$values[0]'>$value1</OPTION>\n";
	 }
$rn++;

}	
echo"</SELECT>\n";
echo"<!-- $sql -->";
}

function input_button($name,$val)
{
echo"<INPUT TYPE='SUBMIT' NAME=\"$name\" VALUE='$val'>";
}

function input_button2($name,$val,$styles)
{
echo"<INPUT TYPE='SUBMIT' NAME=\"$name\" VALUE='$val' $styles>";
}

function next_step($setup_file,$s_cnt)
{
$s_cnt=$s_cnt+1;
header("location:$setup_file?s_cnt=$s_cnt");
}

function text_area($name,$cols,$rows,$value,$styles)
{
echo"\n<TEXTAREA NAME=\"$name\" COLS='$cols' ROWS='$rows' $styles>$value</TEXTAREA>\n";
}

#########################################################################
#General frame reload functions
#########################################################################
function reload()
{
?><SCRIPT>parent.left.rl();</SCRIPT>.<?php
}

function reload1()
{
?><SCRIPT>parent.left.x1.rl();</SCRIPT><?php
}

function reload2()
{
?><SCRIPT>parent.left.structure.rl();</SCRIPT>.<?php
}

function load_brother($load,$target,$url)
{
  if($load=="yes")
  {
  echo"<SCRIPT>parent.$target.location='$url';</SCRIPT>";
  }
}
#########################################################################
#General DB Insert functions
#########################################################################
function insertAction($qstring)
{
// echo "<SCRIPT>alert('.$qstring.'+fdh)</SCRIPT>";
$dbinsert1 = new db;
$dbinsert1->connect();
$dbinsert1->query($qstring);
}

function auotInsert($table,$main_dir)
{
	$tcols=file($main_dir."sql/table_".$table);
	$x=0;
	while($x<count($tcols))
	{
	  if($x==0)
	  {
		$tsql.=$tcols[$x];
		$t2sql.="'".$$tcols[$x]."'";	  
	  }
	  else
	  {
		$tsql.=",".$tcols[$x];
		$t2sql.=",'".$$tcols[$x]."'";	 	  
	  }

	$x++;
	}
	$sql="INSERT INTO $table ($tsql) VALUES (".$t2sql.")";
	return $sql;
	//insertAction($sql);
}

#########################################################################
#Write to a flat_file quickly
#########################################################################
function to_file($the_file,$content,$type)
{
//$content=trim($content);
$con = fopen($the_file, "$type");
fputs($con, stripslashes($content));
fclose($con);
}


#########################################################################
#Pass variables on a query string normally or URL Encoded
#########################################################################
function pass_vars($rstring,$urlenc)
{
$ts=explode("||",$rstring);
	if($urlenc<1)
	{
	$nstring = implode("&amp;",$ts);
	}
	else
	{
	$nstring = urlencode(implode("&",$ts));	
	}
echo$nstring;
}

#########################################################################
#Random Student Verification Question
#########################################################################
function random_q($propability,$course_ID,$sid)
{
$dbextract = new database1;
$dbextract->connect($dbextract->host, $dbextract->user, $dbextract->pass);
$sql="SELECT COUNT(ID) FROM vquestions WHERE course_ID='$course_ID'";
$dbextract->makequery($sql);$dbextract->makeresult($dbextract->mydb);
while($dbextract->next_record()):
$temp_cnt=$dbextract->Record["COUNT(ID)"];
endwhile;

//decide if we are going to ask a question;
$seed_propability=$propability;

$temp_num=(mt_rand(1,100));
	if($temp_num<=$seed_propability)
	{
	//we will ask a question - now we must choose the question;
	$question_num=(rand(1,$temp_cnt)-1);
	$sql="SELECT question,student_field FROM vquestions WHERE course_ID='$course_ID' AND student_field='$question_num'";
	$dbextract->makequery($sql);$dbextract->makeresult($dbextract->mydb);
	while($dbextract->next_record()):
	$question=$dbextract->Record["question"];
	endwhile;
		if($question!="")
		{
		?><SCRIPT>window.open('sv.php?course_ID=<?echo"$course_ID&amp;question_num=$question_num&amp;sid=$sid";?>','','width=500,height=300,scrollbars=yes,resizable=yes,');</SCRIPT><?php
		}
	}
}

#########################################################################
#a Custom function to record to userlog;
######################################################################### 
	function toLog($action,$section,$sid,$REMOTE_ADDR,$dir_userlogs)
	{
	$user_info[]=date(ymd);
	$user_info[]=date("h:iA");
	$user_info[]=$REMOTE_ADDR;
	$user_info[]=$section;
	$user_info[]=$action;
	$lcontent = implode("||",$user_info);
	to_file("$dir_userlogs$sid.txt",$lcontent."\n","a+");
	}
	
#########################################################################
#Evaluate Wrong number of V Questions answers and decide to lock out student;
#########################################################################
function verify($sid,$wrong_num,$reject_page,$reject_result,$admin_email,$REMOTE_ADDR,$dir_tracking)
{
$dbextract = new database1;
$dbextract->connect($dbextract->host, $dbextract->user, $dbextract->pass);
$sql="SELECT wrong,email,notification FROM x_vq_scores WHERE user_ID='$sid'";
$dbextract->makequery($sql);$dbextract->makeresult($dbextract->mydb);
while($dbextract->next_record()):
$wrong=$dbextract->Record["wrong"];
$email=$dbextract->Record["email"];
$sent=$dbextract->Record["notification"];
endwhile;
  if($wrong>=$wrong_num)
  {
  $reject = explode("|",$reject_result);
	  if($reject[0]=="lockout")
	  {
	  //choose a random number for verification;
	  $random_number = md5 (uniqid (rand()));
	  data_action("UPDATE x_students set status='hold',v_num='$random_number' WHERE license='$sid'");
	  @toLog("Account Lockout - Auto","NA",$sid,$REMOTE_ADDR,$dir_userlogs);
	  }
	  if($sent!="sent")
	  {
		  if($reject[1]!=0)
		  {
		  mail($email, "Your Account Status", "You have been locked out of your Cyberdriving account.\n\nIn order to unlock your account we ask that you please verify your identity by copying the code below and using it to log in along with your Drivers License number.\n\nCopy this code: $random_number\n\nClick here to unlock you account: http://208.158.122.130/frames.php?section=unlock&sid=$sid\n(You can also copy the address above and paste it in the Address bar of your browser to get there, then copy and paste the code as instructed.", "From: $admin_email\nReply-To: $admin_email\nX-Mailer: PHP/" );
		  }
		  if($reject[2]!="0")
		  {
		  mail($admin_email, "Account Status of User $sid", "You have been locked out - sorry", "From: $admin_email\nReply-To: $email\nX-Mailer: PHP/" );
		  }
		  data_action("UPDATE x_vq_scores set notification='sent' WHERE user_ID='$sid'");
	  }
	  if($reject[0]=="0"&&$reject[3]!=0)
	  {
	  //delete all user accounts from system in following tables;
	  //x_student;
	  //user's temp table;
	  //x_quiz;
	  //x_vq_questions; 
	  } 
  ?><SCRIPT>parent.location.href="<?php echo $reject_page;?>";</SCRIPT><?php
  die();
  }
  
}

#########################################################################
#Write the course structure XML;
#########################################################################
function courseXml($cid,$dir_xml)
{
$db = new db;
$db->connect();
$db->query("SELECT name FROM course WHERE ID='$cid'");

	while($db->getRows())
	{ 
	$cname = $db->row("name");
	}

$rxml.="<tree>\n";
$rxml.="\t<imageList>\n";
$rxml.="\t\t<image name=\"lesson2\" file=\"images/lesson_sm.gif\"/>\n";
$rxml.="\t\t<image name=\"home\" file=\"images/course_tree.gif\"/>\n";
$rxml.="\t</imageList>\n";
$rxml.="\t<root name=\" $cname\" oImage=\"home\" cImage=\"home\">\n";

$db = new db;
$db->connect();
$db->query("SELECT courses_r.lesson_name,courses_r.lesson_ID, courses_r.lesson_order FROM courses_r WHERE courses_r.course_ID='$cid' ORDER BY lesson_order ASC");
	
	while($db->getRows())
	{ 
	$lname = $db->row("lesson_name");
	$xlID =  $db->row("lesson_ID");
	$lorder =  $db->row("lesson_order");
		if($lorder>=1)
		{
		$rxml.="\t<folder name=\" $lname\" auto=\"yes\">\n";
		$db2 = new db;
		$db2->connect();
		$db2->query("SELECT lessons_r.topic_name,lessons_r.topic_ID, lessons_r.topic_order FROM lessons_r WHERE lessons_r.lesson_ID='$xlID' ORDER BY topic_order ASC");
			
			while($db2->getRows()):
			$tname = $db2->row("topic_name");
			$torder =  $db2->row("topic_order");
			$tID =  $db2->row("topic_ID");
				if($torder>=1)
				{
				$rxml.="\t\t<leaf name=\" $tname\" image=\"\" link=\"javascript:top.top1.getEdit(top.top1.topicItemSelect,'$tID','topic');\"/>\n";
				}
			endwhile;
		
		$rxml.="\t</folder>\n";
		}
	}

$rxml.="\t</root>\n";
$rxml.="</tree>";
to_file($dir_xml.$cid.".xml",$rxml,"w+");
}

#########################################################################
#Make Fields on demand;
#########################################################################

function makeField($field_name,$values)
{

	if($field_name=="password")
	{
	echo"<INPUT TYPE='PASSWORD' NAME='$field_name' VALUE='$values' CLASS='input'>";
	}
	else if($field_name=="sex")
	{
	input_list("sex","m,f",0,$values,"CLASS=input");
	}
	else if($field_name=="user_group")
	{
	?>
    <SELECT NAME="user_group" STYLE="FONT-SIZE:10;">	
	<?php
	  $db = new db;
	  $db->connect();
	  $db->query("SELECT groups.name,subgroups.sub_name,subgroups.ID,subgroups.group_ID FROM groups,subgroups WHERE groups.ID=subgroups.group_ID ORDER by groups.name ASC");
	  while($db->getRows())
	  { 
	  $name=$db->row("name");
	  $subname=$db->row("sub_name");
	  $subID=$db->row("ID");	
	  $group_ID=$db->row("group_ID");
	  
	  $select_test=$group_ID."_".$subID;
	  
	  if($select_test==$values)
	  {
	  $ms="SELECTED";
	  }
	  ?>
	    <OPTION VALUE="<?php echo $group_ID."_".$subID;?>" <?php echo $ms;?>><?php echo "$name: $subname";?></OTPION>
	  <?php	
	  $ms="";  
	  }	
	 ?>
	 </SELECT>	 
	 <?php 
	}
	else
	{
	echo"<INPUT TYPE='TEXT' NAME='$field_name' VALUE='$values' CLASS='input'>";
	}
}

function makeFieldEdit($field_name,$value)
{

	if($field_name=="sex")
	{
	input_list("sex","m,f",0,$value,"CLASS=input");
	}
	else
	{
	echo"<INPUT TYPE='TEXT' NAME='$field_name' VALUE='$value' CLASS='input'>";
	}
}
?>
