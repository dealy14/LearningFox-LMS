<style>
		.librarydoc-content{
			float:left;
			width:600px;
			margin-left:0px;
		}
		.librarydoc-content ul li{
			list-style-type:decimal;
		}
		.librarydoc-content ul li a{
			border:0;
		}
	</style>
<div class="librarydoc-content">
<table width="60%" border="1" cellpadding="2" cellpadding="2">
<tr><td>
<?php
print '';
$qryDoc = "SELECT * FROM library WHERE userID ='".$_SESSION['lms_userID']."'";		
$rsDoc = mysql_query($qryDoc);
while($userDoc = mysql_fetch_assoc($rsDoc)){
	$wordcheck = '.doc';
	$pdfcheck = '.pdf';
	
	$strcheck_word = strpos($userDoc['filename'],$wordcheck);
	//print '<li><a href="libdocs/'.$userDoc['filename'].'"><img src="images/'.$userDoc['img_type'].'.jpg" border=0>'.$userDoc['filename'].'</a></li>';
	print '<a href="libdocs/'.$userDoc['filename'].'" target="_blank">'.$userDoc['filename'].'</a>';	
}
print '';

?>
</td></tr>
</table>
</div>