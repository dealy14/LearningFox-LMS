	<style>
		.newslist{
			margin-top:20px;
		}
		a{
			color:#990000;
			text-decoration:none;
		}
		a:hover{
			color:#990000;
			background-color:#CCCCCC;
			text-decoration:none;
		}
		.mainnews{
			margin-top:10px;
		}
		.newsc{
			clear:both;
			overflow:auto;
			padding-top:1px;
			padding-bottom:1px;
			background-color:#BAF5F5;
		}
		.news_ul{
			float:left;
			width:450px;
			padding:2px;
			margin-bottom:2px;
		}
		.news_ul a{
			text-decoration:none;
			color:#990000;
		}
		.news_edit{
			float:left;
			width:60px;
			padding:2px;
			margin-bottom:2px;
			color:#990000;
		}
		.news_delete{
			float:left;
			width:60px;
			padding:2px;
			margin-bottom:2px;
			color:#990000;
		}
		</style>
		<div class="mainnews">
			<?php
				$i++;
				$qryNews = "SELECT * FROM news";		
				$rsNews = mysql_query($qryNews);
				while($userNews = mysql_fetch_assoc($rsNews)){
			?>
			<div class="newsc">
				<div class="news_ul">
				<?php		
						print '<a href="news.php?section=news&sid='.$_GET['sid'].'&nc=nlist&news='.$userNews['id'].'">'.$i++.'. '.$userNews['title'].'</a>';
				?>
				</div>
				<div class="news_edit"><a href="news.php?section=news&sid=<?=$_GET['sid']?>&news=<?=$userNews['id']?>&nla=edit">Edit</a></div>
				<div class="news_delete"><a href="news.php?section=news&sid=<?=$_GET['sid']?>&news=<?=$userNews['id']?>&nla=delete&nname=<?=$userNews['title']?>">Delete</a></div>
			<div><br />
				<?php
				}
			?>
		</div>
			
	
