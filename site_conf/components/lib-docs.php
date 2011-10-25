<style>
		.librarydoc-content{
			float:left;
			width:600px;
			margin-left:0px;
		}
		.librarydoc-content ul li{
			list-style-type:decimal;
		}
		.librarydoc-content ul li a{
			border:0;
		}
.TreeMenu img.s
{
	cursor:pointer;
	vertical-align:middle;
}
.TreeMenu ul
{
	padding:0;
}
.TreeMenu ul li
{
	list-style-type:none;
	padding:0;
}
.Closed ul
{
	display:none;
}
.Child img.s
{
	background:none;
	cursor:default;
}

#CategoryTree ul
{
	margin:0 0 0 17px;
}
#CategoryTree img.s
{
	width:34px;
	height:18px;
}
#CategoryTree .Opened img.s
{
	background:url(images/tree/opened.gif) no-repeat 0 1px;
}
#CategoryTree .Closed img.s
{
	background:url(images/tree/closed.gif) no-repeat 0 1px;
}
#CategoryTree .Child img.s
{
	background:url(images/tree/child.gif) no-repeat 13px 2px;
}

#CategoryTree
{
	margin:3px;
	padding:3px;
}
	</style>
    <script type="text/javascript">
	//<![CDATA]
		function ChangeStatus(o)
		{
			if (o.parentNode)
				o.parentNode.className = o.parentNode.className == "Opened"?"Closed":"Opened";
		}
	//]]>
    </script>
<div class="librarydoc-content">
<table width="80%" border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>
    <div class="TreeMenu" id="CategoryTree">
        <ul>
            <li class="Opened">
                <img class="s" src="images/tree/space.gif" onclick="javascript:ChangeStatus(this);" />
                <ul>
				<?php
				$qryUser = "SELECT folder_id, folder_name FROM library_folders ORDER BY library_folders.folder_id ASC";
				$rsUser = mysql_query($qryUser);
				//echo "result rows: ".mysql_num_rows($rsUser);
				while($user = mysql_fetch_assoc($rsUser))
				{
					echo "<li class='Closed'><img class='s' src='images/tree/space.gif' onclick='javascript:ChangeStatus(this);' /><a href='#' onclick='javascript:ChangeStatus(this);'>".$user['folder_name']."</a>";
					
					if($lms_userlevel>=3)
					{
					     print '&nbsp;&nbsp;(<a href="index.php?section=library&sid='.$_GET['sid'].'&lib=2&update_folder=yes&update_folder_id='.$user['folder_id'].'" style="color:red;" >Edit</a>)';
						 print '&nbsp;&nbsp;(<a href="repository_operations.php?sid='.$_GET['sid'].'&lib=2&operation=delete_folder&delete_folder_id='.$user['folder_id'].'" style="color:red;" onclick="return window.confirm(&quot;Are you sure to delete this folder?&quot;);">Del</a>)';
				    }
					echo "<ul>";
					$qryDoc = "SELECT * FROM library WHERE targetID=".$user['folder_id'];
					$rsDoc = mysql_query($qryDoc);
					while($userDoc = mysql_fetch_assoc($rsDoc))
					{
						$wordcheck = '.doc';
						$pdfcheck = '.pdf';
						$strcheck_word = strpos($userDoc['filename'],$wordcheck);
						print '<li class="Child"><img class="s" src="images/tree/space.gif" /><a href="libdocs/'.$userDoc['filename'].'" target="_blank">'.$userDoc['filename'].'</a>';
						if($lms_userlevel>=3)
							print '&nbsp;&nbsp;(<a href="repository_operations.php?sid='.$_GET['sid'].'&lib=2&operation=delete_file&delete_file_id='.$userDoc['libdocID'].'" style="color:red;" onclick="return window.confirm(&quot;Are you sure to delete this file?&quot;);">Del</a>)';
						print '</li>';	
					}
					mysql_free_result($rsDoc);
					echo "</ul></li>";
				}
				mysql_free_result($rsUser);
				
				?>
                </ul>
            </li>
        </ul>
    </div>
    </td>
  </tr>
</table>
</div>