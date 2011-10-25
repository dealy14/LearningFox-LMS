<style>
		.librarydoc-content{
			overflow:auto;
		}
		.liblink{
			clear:both;
			overflow:auto;
			margin-top:1px;
			padding:5px;
			background-color:#BAF5F5;
		}
		.links{
			float:left;
			width:450px;
		}
		.links a{
			color:#990000;
			text-decoration:none;
		}
		.links a:hover{
			color:#990000;
			background-color:#CCCCCC;
			text-decoration:none;
		}
		.del{
			float:left;
			margin-left:20px;
		}
	</style>
	
<div class="librarydoc-content">	
	<?php
	$i++;
	$qryDoc = "SELECT * FROM library";		
	$rsDoc = mysql_query($qryDoc);
	while($userDoc = mysql_fetch_assoc($rsDoc)){
		$wordcheck = '.doc';
		$pdfcheck = '.pdf';
		
		
		$strcheck_word = strpos($userDoc['filename'],$wordcheck);
		print '<div class="liblink">';
		print '<div class="links"><a href="../demo_site/libdocs/'.$userDoc['filename'].'">'.$i++.' '.$userDoc['filename'].'</div>
			   <div class="del"><a href="del_libdocs.php?libdocid='.$userDoc['libdocID'].'">Delete</div><br />';
		print '</div>';
		
	}
	?>
</div>