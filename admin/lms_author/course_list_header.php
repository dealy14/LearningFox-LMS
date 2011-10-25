<html>
<head>
	<title>Untitled</title>
<STYLE TYPE="text/css">
  .col_text{font-family:verdana;font-size=10;}
</STYLE>	
<SCRIPT>
function order_list(order)
{
top.clist.list.location="course_list.php?order_by="+order+"&direction="+top.clist.list.direction;
}

function hideMenu()
{
top.document.all.tester.style.visibility="hidden";
}
document.oncontextmenu = function(){return false}
document.onclick = hideMenu;
</SCRIPT>
</head>
<body BGCOLOR="#CCCCCC" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
		<TR>
		<TD BACKGROUND="images/cheader_bkg.gif" WIDTH="8"><IMG SRC="images/cheader_left.gif"></TD>
		<TD onMouseOver="this.style.cursor='default';" onClick="order_list('title');" ID="col1" ALIGN="CENTER" BACKGROUND="images/cheader_bkg.gif" WIDTH="126"><SPAN CLASS="col_text">Name</TD>
	    <TD BACKGROUND="images/cheader_bkg.gif" WIDTH="8"><IMG SRC="images/cheader_inner.gif"></TD>
		<TD onMouseOver="this.style.cursor='default';" onClick="order_list('status');" ID="col2" ALIGN="CENTER" BACKGROUND="images/cheader_bkg.gif" WIDTH="50"><SPAN CLASS="col_text">Status</TD>
		<TD BACKGROUND="images/cheader_bkg.gif" ALIGN="RIGHT" WIDTH="8"><IMG SRC="images/cheader_right.gif"></TD>					
		</TR>	
			
</TABLE>
</body>
</html>