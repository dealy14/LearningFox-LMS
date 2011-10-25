<?php session_start(); 
require_once("conn.php");
 ?>

<style>

#news-content{
	overflow:auto;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	margin-top:0px;
	width:650px;
	
		
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
	width:640px;
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
	width:637px;
	margin-left:-45px;
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
</style>
<div style="width:800px;">
<div id="news-content">
	<div class="nc-title">News Section</div>
	<?php
  
		if(isset($_SESSION['uploadedlink'])){

			echo '<div class="session">'.$_SESSION['uploadedlink'].'</div>';
			unset($_SESSION['uploadedlink']);
		}
	?>
	<div class="nc-main">
		<div class="ncm-content">
			<?php
				
				if($_GET['nc'] == 'ncreate'){
					$lbg_c = 'class="list_bg"';
				}else if($_GET['nc'] == 'nlist'){
					$lbg_l = 'class="list_bg"';
				}
			
			?>
				
				<div class="news-content" style="border:1px solid #eeeeee;">

					<ul>
						<li <?=$lbg_l?>><a HREF="index.php?section=news&sid=<?php echo $sid; ?>&nc=nlist";>News List</a></li>
						<li <?=$lbg_c?>><a HREF="index.php?section=news&sid=<?php echo $sid; ?>&nc=ncreate";>Create News</a></li>
					</ul>
				</div>
			
			<?php
				if(($_GET['nc'] == 'ncreate') ){
					include 'news_create.php';
				}
			?>
			
		</div>
	</div>
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

