	<style>
		.librarylink-content{
			float:left;
			width:600px;
			margin-left:0px;
		}
		.style1{
			font-weight:bold;
		}
		.librarylink-content ul li{
			margin:0;
			list-style-type:decimal;
			padding-bottom:5px;
		}
		.librarylink-content ul li a{
			border:0;
		}
	</style>
			
		<div class="librarylink-content">
		<table width="80%" border="1" cellpadding="2" cellpadding="2">

			<?php
				print '';
				$cnt=0;
				$qryLink = "SELECT * FROM library_link WHERE userID ='".$_SESSION['lms_userID']."'";		
				$rsLink = mysql_query($qryLink);
				while($userLink = mysql_fetch_assoc($rsLink)){
					$cnt++;
					echo "<tr><td align='center'>".$cnt."</td>";
					print '<td><a href="'.$userLink['links'].'" target="_blank">'.$userLink['links'].'</a></td></tr>';
				}
				print '';	
			?>
			</table>
		</div>
	