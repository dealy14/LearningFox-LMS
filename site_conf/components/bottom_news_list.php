<?php  
require_once($main_dir."conn.php");
?>
	<style>
		.librarydoc-content{
			float:left;
			width:600px;
			margin-left:10px;
		}
		.librarydoc-content ul li{
			list-style-type:decimal;
		}
		.librarydoc-content ul li a{
			border:0;
		}
		#newslist{
			margin-top:20px;
			height:62px;
			overflow-y:scroll;

		}
		.news_ul{
			float:left;
			width:420px;
			padding:2px;
			margin-bottom:2px;
			background-color:#CCCCCC;
		}
		.news_ul a{
			text-decoration:none;
		}
		.news_edit{
			float:left;
			width:90px;
			padding:2px;
			margin-bottom:2px;
			background-color:#CCCCCC;
		}
		.news_delete{
			float:left;
			width:90px;
			padding:2px;
			margin-bottom:2px;
			background-color:#CCCCCC;
		}
	</style>
	<div id="newslist" align="center">
			<?php
				$qryNews = "SELECT * FROM news";		
				$rsNews = mysql_query($qryNews);
				while($userNews = mysql_fetch_assoc($rsNews)){
			?>
			<div class="news_ul" align="left">
			<?php		
					print '<a href="index.php?section=news&sid='.$_GET['sid'].'&nc=nlist&news='.$userNews['id'].'" align="left">'.$userNews['title'].'</a><br />';
			?>
			</div>
				<?php //if($_SESSION['ses_role'] == 'Super Admin'){ ?>
					<div class="news_edit"><a href="index.php?section=news&sid=<?php echo $_GET['sid']; ?>&news=<?php echo $userNews['id']; ?>&nla=edit">Edit</a></div>
					<div class="news_delete"><a href="form_upload.php?section=news&sid=<?php echo $_GET['sid']; ?>&news=<?php echo $userNews['id']; ?>&nla=delete">Delete</a></div>
				<?php
					//}else{
					//}
				}
			?>
	</div>
			
	
