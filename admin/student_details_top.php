<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Untitled</title>
<SCRIPT language="javascript" type="text/javascript" >
<!--
function rupdate()
{
	var chckFrame = true;

	for(i = 0; i<parent.frames.length;i++){
		pageName = parent.frames.item(i).location.href.substr(parent.frames.item(i).location.href.lastIndexOf("/")+1,parent.frames.item(i).location.href.length);
		if(pageName=="blank.php"  && parent.frames.item(i).name === "edit_main"){
				chckFrame = false;
				//break;
		}
	}

if(chckFrame){
alert("Record Saved");
top.rmain.student_details.edit_main.document.editForm.formAction.value="UPDATE";
top.rmain.student_details.edit_main.document.editForm.submit();
}
}

function rdelete()
{
	var chckFrame = true;

	for(i = 0; i<parent.frames.length;i++){
		pageName = parent.frames.item(i).location.href.substr(parent.frames.item(i).location.href.lastIndexOf("/")+1,parent.frames.item(i).location.href.length);
		if(pageName=="blank.php"  && parent.frames.item(i).name === "edit_main"){
				chckFrame = false;
				//break;
		}
	}

	if(chckFrame){
			a = confirm("Do You Really Want To Delete ?");
			if(a){
				alert("Deleted");
				top.rmain.student_details.edit_main.document.editForm.formAction.value="DELETE";
				top.rmain.student_details.edit_main.document.editForm.submit();
			}
	}
}

-->
</SCRIPT>

<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0" ><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD ROWSPAN="2" VALIGN="TOP"><IMG SRC="images/edit_students.gif" ALIGN="absmiddle"> &nbsp;</TD>
    <TD COLSPAN="2" VALIGN="TOP">Student Details</TD>
  </TR>
  <TR>
	<TD VALIGN="MIDDLE"><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR><TD VALIGN="MIDDLE" nowrap="nowrap" width="1%"><a href="javascript:rupdate();" class="thebutton"><img border="0" src="images/save.gif" alt="Save Group"> Save Properties</a> 
</TD>
<td nowrap="nowrap" width="1%">
<a href="javascript:rdelete();" class="thebutton"><img src="images/delete.gif" border="0" alt="Delete User"> Delete User</a>
</TD>
</TR></TABLE></TD>
<TD ALIGN="RIGHT"></TD>

  </TR>
</TABLE></body>
</html>
