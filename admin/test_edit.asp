<HTML>
<HEAD>
<STYLE TYPE="text/css">
BODY {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px;
	SCROLLBAR-HIGHLIGHT-COLOR: #EFF7FF; 
	BORDER-LEFT: 0px; 
	SCROLLBAR-SHADOW-COLOR: #336699; 
	SCROLLBAR-3DLIGHT-COLOR: #ffffff; 
	SCROLLBAR-ARROW-COLOR: #000000; 
	SCROLLBAR-TRACK-COLOR: #EFF7FF; 
	BORDER-BOTTOM: 0px; 
	SCROLLBAR-DARKSHADOW-COLOR: #ffffff; 
	SCROLLBAR-BASE-COLOR: #93BEE2
}
</STYLE>
<SCRIPT>
top.top1.topicItemSelect=2;
</SCRIPT>
</HEAD>
<BODY BGCOLOR="#93BEE2" RIGHTMARGIN="0" TOPMARGIN="0" LEFTMARGIN="0">
<%
  Set ae=Server.CreateObject("CFDEV.Activedit")

  ae.Inc="../activedit/inc"
%>
<?php echo"hello!!!!";?>
<form type="myform" method="post" name="tester">
  <%
    ae.Width="100%"
    ae.Height="100%"
    ae.Name="testedit"
    ae.Content="<b>Default Content</b>"
    ae.ImageURL="http://cj458753-b/dev2/admin2/course_images/"
    ae.ImagePath="E:\dev_rescued\new_dev\admin2\course_images\"
    ae.ButtonColor="#93BEE2"
    ae.Write()
  %>
  <!--<input type="submit" value="Post">-->
</form>

<SCRIPT>
//alert(document.tester.testedit.value);
</SCRIPT>
<!--ae.BaseURL="http://cj458753-b/"-->
</BODY>
</HTML>