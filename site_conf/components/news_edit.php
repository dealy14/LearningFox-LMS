<?php
$qryNews = "SELECT * FROM news WHERE id='".$_GET['news']."'";		
$rsNews = mysql_query($qryNews);
while($userNews = mysql_fetch_assoc($rsNews)){
?>
<form action="form_upload.php" method="post" name="fu" id="fu">
	<div class="ncmc-text">

<?php
print '<div class="nleft">Title:</div><div class="nright"><input type="text" name="fu_title" id="fu_title" value="'.$userNews['title'].'" /></div>
		<div class="nleft">Content:</div><div class="nright"><textarea name="fu_content" id="fu_content" cols="50" rows="20" value="'.$userNews['content'].'">'.$userNews['content'].'</textarea></div>
		<input type="hidden" name="sid" id="sid" value="'.$_GET['sid'].'">
		<input type="hidden" name="news_id" id="news_id" value="'.$_GET['news'].'">
		<input type="hidden" name="nla" id="nla" value="'.$_GET['nla'].'">
		<input type="hidden" name="uid" id="uid" value="'.$_SESSION['lms_userID'].'">';
}
?>
		<div class="nleft"><input type="submit" value="Submit" name="fu_submit" /></div>
	</div>
</form>
		