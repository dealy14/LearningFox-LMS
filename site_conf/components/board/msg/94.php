<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Test Topic</title>
<meta content="text/html; charset=windows-1250">
<link href="http://learningfox.com/CEC/site_conf/components/board/styleb.css" type="text/css" rel="stylesheet">
<!--[if IE 5]><style type="text/css">@import "http://localhost/LMS/site_conf/components/board/styleIE.css";</style><![endif]-->
<!--[if IE 6]><style type="text/css">@import "http://localhost/LMS/site_conf/components/board/styleIE.css";</style><![endif]-->
<!--[if IE 7]><style type="text/css">@import "http://localhost/LMS/site_conf/components/board/styleIE.css";</style><![endif]-->
<META HTTP-EQUIV="Expires" CONTENT="-1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<script language="Javascript" src="javascript.js">
<!--
//-->

</script>
<script>

//var url=gup("admin");

</script>

</head>
<body>
<div id="container2" style="border:1px solid #000000;">
	<div id="main">
	
<div id="main-content">
<h3 align="center" class="title">Message Board</h3>

<div align="center"><center>
<table border="0" width="95%"><tr>
<td>

<p align="center"><a href="#new">Post a reply</a> ||
<script>
var url=window.location.search.substring(1);
var gy = url.split('&');
for(i=0;i<gy.length; i++)
{
  var ft = gy[i].split('=');
  if(ft[0] == "admin")
  {
   // alert(ft[1]);
	document.write('<a href="http://learningfox.com/CEC/admin/mboard.php?sid=12998952504ac65f55e92c5">Back to Message Board</a>');
	break;
	}
	else
	{
	document.write('<a href="index.php?section=messageboard&sid=<?php echo $_GET['sid']; ?>">Back to Message Board</a>');
	break;
	}
}
</script>


<hr>
<p align="center"><b>Test Topic</b></p>

<p><a href="http://learningfox.com/CEC/site_conf/components/board/mboard.php?sid=<?php echo $_GET['sid']; ?>&a=delete&num=94&up=0"><img
src="http://learningfox.com/CEC/site_conf/components/board/images/delete.gif" width="16" height="14" border="0" alt="Delete this post"></a>
Submitted by Marvin   on 02/Oct/2009 <br><font class="ip">68.91.91.145</font></p>

<p><b>Message</b>:</p>

<p>This is a trial test for entering a message.</p>

<hr>

<p align="center"><b>Replies to this post</b></p>
<ul>
<!-- zacni --><p>No replies yet</p>
</ul>
<hr></td>
</tr></table>
</center></div>

<p align="center"><a name="new"></a><b>Reply to this post</b></p>
<div align="center"><center>
<table border="0"><tr>
<td>
<form method=post action="http://learningfox.com/CEC/site_conf/components/board/mboard.php?sid=<?php echo $_GET['sid']; ?>" name="form" onSubmit="return mboard_checkFields();">
<p><input type="hidden" name="a" value="reply"><b>Name:</b><br><input type=text name="name" size=30 maxlength=30><br>
E-mail (optional):<br><input type=text name="email" size=30 maxlength=50><br>
<b>Subject:</b><br><input type=text name="subject" value="Re: Test Topic" size=30 maxlength=100><br><br>
<b>Message:</b><br><textarea cols=50 rows=9 name="message"></textarea>
<input type="hidden" name="orig_id" value="94">
<input type="hidden" name="orig_name" value="Marvin">
<input type="hidden" name="orig_subject" value="Test Topic">
<input type="hidden" name="orig_date" value="02/Oct/2009"><br>
<p><input type=submit value="Submit reply">
</form>
</td>
</tr></table>
</center></div>

			</div>
		</div></div>
</body>
</html>