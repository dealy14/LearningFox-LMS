<?php
if($SUBMIT)
{
$username=$$lms_username_link;

//fist - if unique is ON - do a search to qualify;
if($lms_unique=="on")
{
  $db = new db;
  $db->connect();
  $db->query("SELECT ID FROM students WHERE username='$username'");
  $xx=0;
  while($db->getRows())
  { 
  $xx++;
  }
    if($xx>=1)
    {
    echo"Sorry - someone already has that username, please choose another.";
    $reg_unique="no";
    }
}
if($reg_unique!="no")
{
  //assemble SQL String here;
  $db = new db;
  $db->connect();
  $db->query("SELECT field_name FROM reg_form");
  $nx=0;
  $sqla="INSERT INTO students (";
  while($db->getRows())
  { 
  $rname=$db->row("field_name");
  $sqlb.=$rname.",";
  $sqlc.="'".$$rname."',";
  $nx++;
  }
  
  
  $sql = $sqla.$sqlb."userlevel,date_of_reg,date_of_mod)VALUES(".$sqlc."'$lms_default_userlevel','$date_of_reg','$date_of_mod')";
  //echo $sql;
  insertAction($sql);
  echo"Thank you for registering.<P>Please <A HREF='index.php?section=login'>click here</A> to log in and continue.";
}

}//End Submit IF;

if($reg_unique=="no"||is_null($SUBMIT))
{
?>
<FORM NAME="myform" ACTION="index.php?section=register&SUBMIT=yes" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="date_of_reg" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="date_of_mod" VALUE="<?php echo date(ymd);?>">
<TABLE BORDER="0" CELLPADDING="5" CELLSPACING="0">
<?php
$db = new db;
$db->connect();
$db->query("SELECT * FROM reg_form WHERE stored = 'y' AND forder>=1 AND status='on' ORDER BY forder ASC");
$nx=0;
while($db->getRows())
{ 
$mvals = $db->row("field_name");
?>
<TR>
  <TD><FONT FACE="VERDANA" SIZE="2" <B><?php echo$db->row("display");?>:</TD>
  <TD><?php makeField($db->row("field_name"),$$mvals);?></TD>
</TR>
<?php
$nx++;

}
?>
<TR>
  <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
</TR>
</FORM>
</TABLE>

<?php
}
?>
