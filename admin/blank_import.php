<?php

require_once("../conf.php");

$ID = $_GET['cID'];

$db = new db;
$db->connect();
$db->query("SELECT * FROM course WHERE ID='$ID'");
$xm=0;
while($db->getRows())
{ 

$rID=$db->row("ID");
$name = $db->row("name");
$status = $db->row("status");
$description= $db->row("description2");
$keyword= $db->row("keyword");
$catalog_name=$db->row("catalog_name");
$catalog_entry=$db->row("catalog_entry");
$sco_version=$db->row("sco_version");
$url=$db->row("link");

$c_description=$db->row("c_description");
$purpose=$db->row("purpose");
$contribute=$db->row("contribute");
$entity=$db->row("entity");
$classifiedkeyword=$db->row("classifiedkeyword");
$role=$db->row("role");
$date=$db->row("date");
$structure=$db->row("structure");
$format=$db->row("format");
$size=$db->row("size");
$learning_resource_type=$db->row("learning_resource_type");
$cost=$db->row("cost");
$mdscheme=$db->row("md_scheme");
$mdcatalog=$db->row("md_catalog");
$mdentry=$db->row("md_entry");
$copyright=$db->row("copyright");
$right_description=$db->row("right_description");
$interactive_type=$db->row("interactive_type");
$interactive_level=$db->row("interactive_level");
$typical_learning_time=$db->row("typical_learning_time");
$location=$db->row("location");
}


?>

<?php
	if($_GET['cID'] != ''){
?>
	
<?php	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
body {
	background-color: #EFF7FF;
}
-->
</style>
</head>

<body>

<div id="cHide">Select the particular course from the left side window.</div>
<br />

<?php
	if($ID != ''){
?>

 	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	<TR>
	    <TD><SPAN CLASS=ttl>Course Title:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$name.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Keywords:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$keyword.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>SCO Description:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$description.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>SCO Catalog:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$catalog_name.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>SCO Entry:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$catalog_entry.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Classified Description:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$c_description.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Purpose:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$purpose.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Contribute:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$contribute.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Entity:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$entity.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Classified Keyword:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$classifiedkeyword.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Role:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$role.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Version</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$sco_version.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Status:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$status.'</b>'; ?></TD>		
	  </TR> 
	  <TR>
	    <TD><SPAN CLASS=ttl>Date:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$date.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Structure:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$structure.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Format:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$format.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Size:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$size.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>MD Scheme:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$mdscheme.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>MD Catalog:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$mdcatalog.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>MD Entry:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$mdentry.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Learning Resource Type:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$learning_resource_type.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Cost:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$cost.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Copyright & other Restrictions:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$copyright.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Rights Descriptions:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$right_description.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Interactive Type:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$interactive_type.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Interactive Level:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$interactive_level.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Typical Learning Time:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$typical_learning_time.'</b>'; ?></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Location:</SPAN></TD>
	    <TD align="left" valign="top"><?php echo '<b>'.$location.'</b>'; ?></TD>		
	  </TR>
	</TABLE>

<?php } ?>
</body>
</html>
