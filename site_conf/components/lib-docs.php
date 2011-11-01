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
<table width="80%" border="1" cellpadding="2" cellpadding="2">
  <tr>
    <td>
    <div class="TreeMenu" id="CategoryTree">
        <ul>
            <li class="Opened">
                <img class="s" src="images/tree/space.gif" onclick="javascript:ChangeStatus(this);" />
                <ul>
<?php
$qryUser = "SELECT library.targetID,library.userID,students.username FROM library LEFT JOIN students ON library.userID=students.ID GROUP BY library.targetID ORDER BY library.targetID ASC";
$rsUser = mysql_query($qryUser);
while($user = mysql_fetch_assoc($rsUser)){
	if($user['targetID']=='0')
	    echo "<li class='Closed'><img class='s' src='images/tree/space.gif' onclick='javascript:ChangeStatus(this);' /><a href='#' onclick='javascript:ChangeStatus(this);'>Board Meeting Documents</a>";
	elseif($user['targetID']=='-1')
	    echo "<li class='Closed'><img class='s' src='images/tree/space.gif' onclick='javascript:ChangeStatus(this);' /><a href='#' onclick='javascript:ChangeStatus(this);'>Priority</a>";
	else
	    echo "<li class='Closed'><img class='s' src='images/tree/space.gif' onclick='javascript:ChangeStatus(this);' /><a href='#' onclick='javascript:ChangeStatus(this);'>".$user['username']." Folder</a>";
	echo "<ul>";
	$qryDoc = "SELECT * FROM library WHERE targetID=".$user['targetID'];
	$rsDoc = mysql_query($qryDoc);
	while($userDoc = mysql_fetch_assoc($rsDoc))
	{
		$wordcheck = '.doc';
	    $pdfcheck = '.pdf';
	    $strcheck_word = strpos($userDoc['filename'],$wordcheck);
		print '<li class="Child"><img class="s" src="images/tree/space.gif" /><a href="libdocs/'.$userDoc['filename'].'" target="_blank">'.$userDoc['filename'].'</a>';
		if($lms_userlevel>=3)
		    print '&nbsp;&nbsp;(<a href="index.php?section=library&sid='.$_GET['sid'].'&lib=2&op=del&fid='.$userDoc['libdocID'].'" style="color:red;" onclick="return window.confirm(&quot;are you sure to delete this file?&quot;);">Del</a>)';
		print '</li>';	
    }
	mysql_free_result($rsDoc);
	echo "</ul></li>";
}
mysql_free_result($rsUser);
/*
print '';
$cnt=0;
$qryDoc = "SELECT * FROM library";		
$rsDoc = mysql_query($qryDoc);
while($userDoc = mysql_fetch_assoc($rsDoc)){
	$wordcheck = '.doc';
	$pdfcheck = '.pdf';
	$cnt++;
	echo "<tr><td width='100px' align='center'>".$cnt."</td>";
	$strcheck_word = strpos($userDoc['filename'],$wordcheck);
	//print '<li><a href="libdocs/'.$userDoc['filename'].'"><img src="images/'.$userDoc['img_type'].'.jpg" border=0>'.$userDoc['filename'].'</a></li>';
	print '<td><a href="libdocs/'.$userDoc['filename'].'" target="_blank">'.$userDoc['filename'].'</a></td></tr>';	
}
print '';
*/
?>
                </ul>
            </li>
        </ul>
    </div>
    </td>
  </tr>
</table>
</div>