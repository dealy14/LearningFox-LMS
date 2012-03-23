<?php require_once("conn.php"); ?>
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
	.linkdoc ul{
		border:1px solid red;
		border:1px solid #eeeeee;
		margin-left:0px;
	}
</style>

<?php

if($_GET['lib'] == '1'){
	$lbg_1 = 'class="list_bg"';
}else if($_GET['lib'] == '2'){
	$lbg_2 = 'class="list_bg"';
}else{
	$lbg_2 = 'class="list_bg"';
}
if(isset($_GET['lib'])&&!is_null($_GET['lib'])&&isset($_GET['op'])&&!is_null($_GET['op'])&&($_GET['lib']=='2')&&($_GET['op']=='del')&&isset($_GET['fid'])&&!is_null($_GET['fid'])&&preg_match("/^\d+$/",$_GET['fid']))
{
	if($lms_userlevel>=3)
	{
		$qryDoc = "SELECT filename FROM library WHERE libdocID=".trim($_GET['fid']);
	    $rsDoc = mysql_query($qryDoc);
		$delResult = false;
	    if($userDoc = mysql_fetch_assoc($rsDoc))
		{
			$file = $_SERVER["DOCUMENT_ROOT"]."/LMS/anlm/libdocs/".$userDoc['filename'];
			if(file_exists($file))
			{
				$delResult = unlink($file);
			}
		}
		mysql_free_result($rsDoc);
		if($delResult)
		    mysql_query("DELETE FROM library WHERE libdocID=".trim($_GET['fid']));
	}
}
?>
<div style="width:800px;margin-top:20px;">	
<div class="library-content">
	<div class="library-content">
		<div class="style1">Repository</div>
		<div class="linkdoc">
			<ul>
				<li <?php echo $lbg_1?;>><a HREF="index.php?section=library&sid=<?php echo $sid; ?>&lib=1";>Links</a></li>
				<li <?php echo $lbg_2;?>><a HREF="index.php?section=library&sid=<?php echo $sid; ?>&lib=2";>Documents</a></li>
			</ul>
		</div>
	</div>
	
	<?php
		if($_GET['lib'] == "1"){
	?>
		<div style="height:150px;"><?php include 'lib-links.php'; ?></div>
		<br />
		<br />
				<br />
		<div class="library-content">
			<?php
				if(isset($_SESSION['uploadedlink'])){
				echo '<div class="uploadedlink"><p class="logsession">'.$_SESSION['uploadedlink'].'</p></div>';
				unset($_SESSION['uploadedlink']);
				}
			?>
			
	
			<div align="center" style="background-color:#F8F0E5;">			
			
			<div style="text-align:left; margin-left:10px;"><strong>Submit a link of your file</strong></div>
			<form name="liblinks" id="liblinks" method="post" action="linkpost.php?section=library&sid=<?php echo $_GET['sid']; ?>&lib=1">
			http://<input type="text" name="links" id="links" size="40" />
			<input type="submit" value="Submit" /> 
			</form>
			</div>
		</div>
	<?php
		}else{
	?>
		<div style="height:150px;"><?php include 'lib-docs.php'; ?></div>
		<br />
		<br />
		<div class="librarydoc-content">
			<?php
				if(isset($_SESSION['uploadeddoc'])){
						echo '<div class="uploadedlink"><p class="logsession">'.$_SESSION['uploadeddoc'].'</p></div>';
					unset($_SESSION['uploadeddoc']);
				}
				
				if($_REQUEST['update_folder']=='yes')
				{
				    $update_view="display: block";
				}
				else
				{
				    $update_view='display: none';
				}
				if($_REQUEST['update_folder_id']!=0)
				{
				$folder_query = "SELECT folder_name FROM library_folders WHERE folder_id=".intval($_REQUEST['update_folder_id']);
				//var_dump($folder_query);
				$folder_result = mysql_query($folder_query);
			
				while($row = mysql_fetch_assoc($folder_result))
				{
				    $folder_name= $row['folder_name'];
				}
				}
			?>
			<br />
			<div align="center" style="background-color:#F8F0E5; <?php echo $update_view; ?>;">				
			<div style="text-align:left; margin-left:10px;"><strong>Edit Folder</strong></div>
			<form name="folder_update_form" id="folder_update_form" method="post" action="repository_operations.php?section=library&sid=<?php echo $_GET['sid']; ?>&operation=update_folder">
			<table>
			<tr>
			<td>
			Folder Name: <?php echo $folder_name; ?><br /><input type="hidden" name="update_folder_id" id="update_folder_id" size="40" value="<?php echo $_REQUEST['update_folder_id']; ?>" />
			</td>
			</tr>
			<tr>
			<td>
			Renamed by: <input type="text" name="update_folder_name" id="update_folder_name" size="40" />
			<input type="submit" value="Rename"/> 
			</td></tr></table>
			</form>			
			</div><br/>
			<div align="center" style="background-color:#F8F0E5;">			
			
			<div style="text-align:left; margin-left:10px;"><strong>Create New Folder</strong></div>
			<form name="folder_create_form" id="folder_create_form" method="post" action="repository_operations.php?section=library&sid=<?php echo $_GET['sid']; ?>&operation=create_folder">
			Folder Name: <input type="text" name="new_folder_name" id="new_folder_name" size="40" />
			<input type="button" value="Create" onclick="createFolder();" /> 
			</form>
			<br>
			</div>
			<script type="text/javascript">
			function createFolder()
			{
			   document.forms["folder_create_form"].submit();
			}
			</script>
			<br />
			<div align="center" style="background-color:#F8F0E5;">			
			<div style="text-align:left; margin-left:10px;"><strong>Upload files here:</strong></div>
			<form enctype="multipart/form-data" action="docpost.php?section=library&sid=<?php echo $_GET['sid']; ?>&lib=2" method="POST">
			<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
			<p style="text-align:left; padding-left:130px;">Upload to:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php 
			$result = mysql_query("SELECT folder_id, folder_name FROM library_folders");
            while ($row = mysql_fetch_array($result))
            {
		         $folder_id=$row["folder_id"];
		         $folder_name=$row["folder_name"];
                 echo "<input type='radio' id='folder_id' name='folder_id' value='".$folder_id."' />".$folder_name."&nbsp;&nbsp;";
		    }
			 mysql_free_result($result); 
			?>
            <!--<label for="rdbUploadToP" title="Priority"><input type="radio" id="rdbUploadToP" name="rdbUploadTo" value="priority" />Priority</label>&nbsp;&nbsp;<label for="rdbUploadToG" title="Global"><input type="radio" id="rdbUploadToG" name="rdbUploadTo" value="global" checked="checked" />Board Meeting Documents</label>&nbsp;&nbsp;<label for="rdbUploadToO" title="Own"><input type="radio" id="rdbUploadToO" name="rdbUploadTo" value="own" />Own</label>-->
            </p>
			Choose a file to upload: <input name="uploadedfile" id="uploadedfile" type="file" /><br />
			<input type="submit" value="Upload File" />
			</form>
			</div>
		</div>
	<?php
		}
	?>
</div>
</div>