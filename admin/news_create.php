<?php
?>
<form action="form_upload.php" method="post" name="fu" id="fu">
	<div class="ncmc-text">
		<div class="nleft">Title:</div><div class="nright"><input type="text" name="fu_title" id="fu_title" /></div>
		<div class="nleft">Content:</div><div class="nright"><textarea name="fu_content" id="fu_content" cols="50" rows="20"></textarea></div>
		<input type="hidden" name="sid" id="sid" value="<? echo $_GET['sid']?>">
		<div class="nleft"><input type="submit" value="Submit" name="fu_submit" /></div>
	</div>
</form> 