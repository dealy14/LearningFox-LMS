<div id="container">
	<div id="main">
	
		<?php include 'includes/header.php'; ?>
		
		<div id="main-content">
			<?php include 'includes/left-nav.php'; ?>
			
			<div id="main-content-b" >
			<h3 align="center" class="title"><?php echo $settings['mboard_title']; ?></h3>
			
			<div align="center" ><center>
			<table border="0" width="95%"><tr>
			<td >
			
			<p><a href="../index.php"><b>Back to Main</b></a></p>
			<p><a href="#new"><b>New topic</b></a></p>
			<hr>
			<p align="center"><b>Recent topics</b></p>
			<ul>
			<?php
			include_once 'threads.txt';
			?>
			</ul>
			<hr></td>
			</tr></table>
			</center></div>
			
			<p align="center"><a name="new"></a><b>Add new topic</b></p>
			<div align="center"><center>
			<table border="0"><tr>
			<td>
			<form method=post action="mboard.php" name="form" onSubmit="return mboard_checkFields();">
			<p><input type="hidden" name="a" value="addnew"><b>Name:</b><br><input type=text name="name" size=30 maxlength=30><br>
			E-mail (optional):<br><input type=text name="email" size=30 maxlength=50><br>
			<b>Subject:</b><br><input type=text name="subject" size=30 maxlength=100><br><br>
			<b>Message:</b><br><textarea cols=50 rows=9 name="message"></textarea><br>
			Insert styled text: <a href="Javascript:insertspecial('B')"><b>Bold</b></a> |
			<a href="Javascript:insertspecial('I')"><i>Italic</i></a> |
			<a href="Javascript:insertspecial('U')"><u>Underlined</u></a><br>
			<input type="checkbox" name="nostyled" value="Y"> Disable styled text</p>
			<?php
			if ($settings['smileys']) {
				echo '
				<p><a href="javascript:openSmiley(\''.$settings['mboard_url'].'/smileys.htm\')">Insert smileys</a>
				(Opens a new window)<br><input type="checkbox" name="nosmileys" value="Y"> Disable smileys</p>
				';
			}
			?>
			<p><input type=submit value="Add new topic">
			</form>
			</td>
			</tr></table>
			</center></div>
			</div>
		</div>
	</div>
	<div id="footer">
		<?php include 'includes/footer.php'; ?>
	</div>
</div>
<?php
//printDownHTML();
//exit();