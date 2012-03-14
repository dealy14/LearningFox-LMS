<?php
$qryNews = "SELECT * FROM news WHERE id='".$_GET['news']."'";		
$rsNews = mysql_query($qryNews);
while($userNews = mysql_fetch_assoc($rsNews)){
?>

<div id="news-content">
	<div class="nc-main">
		<div class="ncm-content">
			<div class="ncmc-headline"><? echo $userNews['title']?></div>
			<div class="ncmc-text"><? echo $userNews['content']?></div>
		</div>
	</div>
</div>

<?php
	}
?>