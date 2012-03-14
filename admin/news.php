<?php 
session_start(); 
require_once('../conn.php');
//$db = mysql_connect("safetytraindemo.db.8609376.hostedresource.com", "safetytraindemo", "RZ8Lk55auNQv1e") or die(mysql_error());
//$dbName = mysql_select_db("safetytraindemo") or die(mysql_error());
 ?>
<style>
#news-content{
	overflow:auto;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	margin-top:20px;
	
}
.nc-title{
	text-align:center;
	font-weight:bold;
	margin-bottom:30px;
	margin-top:30px;
	overflow:auto;
}
.nc-main{
}
.nm-content{
}

.ncm-content{
	margin:0 auto;
	width:800px;
}
.ncmc-headline{
	color:#FFFFFF;
	background-color:#333333;
	font-weight:bold;
	padding:5px;
}
.ncmc-text{
	margin-top:5px;
	text-indent:20px;
	text-align:justify;
}
.news-content{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	margin-top:-20px;
}
.news-content ul li{
	list-style-type:none;
	margin-bottom:5px;	
	padding:2px;
}
.news-content ul li a{
}
.list_bg{
	background-color:#666666;
}
.list_bg a{
	color:#FFFFFF;
	text-decoration:none;
}
.uploadedlink{
	background-color:#333333;
	color:#FFFFFF;
	text-align:center;
}
.session{
	margin-bottom:20px;
	color:#64D7C6;
}

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
		if(isset($_SESSION['uploadedlink'])){
			echo '<div class="session">'.$_SESSION['uploadedlink'].'</div>';
			unset($_SESSION['uploadedlink']);
		}
	?>


	
	<div class="library-content">
	<div class="library-content">
		<div class="style1">News Section</div>
			<?php
				
				if($_GET['nc'] == 'ncreate'){
					$lbg_c = 'class="list_bg"';
				}else if($_GET['nc'] == 'nlist'){
					$lbg_l = 'class="list_bg"';
				}
			?>
				
				<div style="border:1px solid #eeeeee;">
					<ul>
						<li <?=$lbg_l?>><a HREF="news.php?section=news&nc=nlist&sid=<?php print $_GET['sid']; ?>";>News List</a></li>
						<li <?=$lbg_c?>><a HREF="news.php?section=news&nc=ncreate&sid=<?php print $_GET['sid']; ?>";>Create News</a></li>
					</ul>
				</div>
			
			<?php
				if(($_GET['nc'] == 'ncreate') ){
					include 'news_create.php';
				}
			?>
			
		</div>
	</div>


<?php
if(($_GET['nc'] == 'nlist') && ($_GET['news'] == '') && ($_GET['nla'] == '')){
	include 'news_list.php';
}
if(($_GET['nc'] != '') && ($_GET['news'] != '')){
	include 'news_content.php';
}

if(($_GET['nc'] == '') && ($_GET['news'] != '') && ($_GET['nla'] != '') && ($_GET['nla'] == 'edit')){
	include 'news_edit.php';
}

if(($_GET['nc'] == '') && ($_GET['news'] != '') && ($_GET['nla'] != '') && ($_GET['nla'] == 'delete')){
	include 'news_edit.php';
}
?>
<!--
<div id="news-content">
	<div class="nc-title">News Section</div>
	<div class="nc-main">
		<div class="ncm-content">
			<div class="ncmc-headline">Headlines</div>
			<div class="ncmc-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
		</div>
	</div>
</div>
-->
