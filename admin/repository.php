<?php 
$db = mysql_connect("cosmoscolms.db.8685149.hostedresource.com", "cosmoscolms", "tTTS9wVUUW7ZjY") or die(mysql_error());
$dbName = mysql_select_db("cosmoscolms") or die(mysql_error());
 ?>
<style>
	.library-content{
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
	}
	.library-content ul li{
		list-style-type:none;
		padding:2px;	
	}
	.library-content ul li a{
	}
	.style1{
		font-weight:bold;
		text-align:center;
	}
	.librarylink-content ul li{
		margin:0;
		padding-bottom:5px;
	}
	.librarylink-content ul li a{
		border:0;
	}
	.uploadedlink{
		background-color:#333333;
		color:#FFFFFF;
		text-align:center;
	}
	
	.list_bg{
	background-color:#666666;
	}
	.list_bg a{
		color:#FFFFFF;
		text-decoration:none;
	}
</style>

<?php
if($_GET['lib'] == '1'){
	$lbg_1 = 'class="list_bg"';
}else if($_GET['lib'] == '2'){
	$lbg_2 = 'class="list_bg"';
}else{
	$lbg_1 = 'class="list_bg"';
}
?>	
<div class="library-content">
	<div class="library-content">
		<div class="style1">Repository</div>
		<div style="border:1px solid #eeeeee;">
			<ul>
				<li <?=$lbg_1?>><a HREF="repository.php?section=library&sid=<?php echo $sid; ?>&lib=1";>Links</a></li>
				<li <?=$lbg_2?>><a HREF="repository.php?section=library&sid=<?php echo $sid; ?>&lib=2";>Documents</a></li>
			</ul>
		</div>
	</div>
	
	<?php
		if($_GET['lib'] == "1"){
	?>
		<div class="library-content">
			<?php
				if(isset($_SESSION['uploadedlink'])){
				echo '<div class="uploadedlink"><p class="logsession">'.$_SESSION['uploadedlink'].'</p></div>';
				unset($_SESSION['uploadedlink']);
				}
			?>
			<?php include 'lib-links.php'; ?>
		</div>
	<?php
		}else{
	?>
		<div class="library-content">
			<?php
				if(isset($_SESSION['uploadeddoc'])){
						echo '<div class="uploadedlink"><p class="logsession">'.$_SESSION['uploadeddoc'].'</p></div>';
					unset($_SESSION['uploadeddoc']);
				}
			?>
			<?php include 'lib-docs.php'; ?>
		</div>
	<?php
		}
	?>
</div>