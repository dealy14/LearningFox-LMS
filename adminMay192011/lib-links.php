	<style>
		.librarylink-content2{
			overflow:auto;
		}
		.liblink2{
			clear:both;
			overflow:auto;
			margin-top:1px;
			padding:5px;
			background-color:#BAF5F5;
		}
		.links2{
			float:left;
			width:450px;
		}
		.links2 a{
			color:#990000;
			text-decoration:none;
		}
		.links2 a:hover{
			color:#990000;
			background-color:#CCCCCC;
			text-decoration:none;
		}
		.del2{
			float:left;
			margin-left:20px;
		}
	</style>
			
		<div class="librarylink-content2">
			<?php
				$i++;
				$qryLink = "SELECT * FROM library_link";		
				$rsLink = mysql_query($qryLink);
				while($userLink = mysql_fetch_assoc($rsLink)){
					print '<div class="liblink2">';
					print '<div class="links2"><a href="'.$userLink['links'].'">'.$i++.' '.$userLink['links'].'</a></div>
					       <div class="del2"><a href="del_liblinks.php?linkid='.$userLink['linkID'].'">Delete</div><br />';
					print '</div>';
				}
			?>
		</div>
	