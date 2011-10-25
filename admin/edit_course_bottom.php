<?php
require_once("../conf.php");

$ID = $_REQUEST[ 'ID' ];

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
/*

<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 110" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="EFF7FF">
		<param name="backHighColor" value="EFF7FF">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  {Add Objectives,create_objects_sql.php?action=objective&course_ID=<?php echo $ID;?>,edit_post,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>
//

		<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 110" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="EFF7FF">
		<param name="backHighColor" value="EFF7FF">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  {Add References,create_objects_sql.php?action=ref&course_ID=<?php echo $ID;?>,edit_post,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>

*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
top.top1.courseItemSelect=1;
</SCRIPT>

<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
</STYLE>

	<title>Untitled</title>	
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">




	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	 <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP" NOWRAP><SPAN CLASS="hdr">Course Properties:</SPAN>
<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=course1" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd); ?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $rID; ?>">
<INPUT TYPE="HIDDEN" NAME="formAction" id="formAction">
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  
	  <!-- new form start-->
	  <TR>
	    <TD><SPAN CLASS=ttl>Course Title:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT TYPE="TEXT" NAME="name" CLASS="input" VALUE="<?php echo $name;?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Keywords:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="keyword" ROWS="3" COLS="40" CLASS="input"><?php echo $keyword; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>SCO Description:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="description" ROWS="5" COLS="40" CLASS="input"><?php echo $description; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>SCO Catalog:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="catalog_name" ROWS="1" COLS="40" CLASS="input"><?php echo $catalog_name; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>SCO Entry:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="catalog_entry" ROWS="1" COLS="40" CLASS="input"><?php echo $catalog_entry; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Classified Description:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="c_description" ROWS="5" COLS="40" CLASS="input"><?php echo $c_description; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Purpose:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="purpose" ROWS="5" COLS="40" CLASS="input"><?php echo $purpose; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Contribute:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="contribute" ROWS="5" COLS="40" CLASS="input"><?php echo $contribute; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Entity:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="entity" ROWS="5" COLS="40" CLASS="input"><?php echo $entity; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Classified Keyword:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="classifiedkeyword" ROWS="5" COLS="40" CLASS="input"><?php echo $classifiedkeyword; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Role:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT TYPE="TEXT" NAME="role" CLASS="input" VALUE="<?php echo $role;?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Version</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="sco_version" CLASS="input" VALUE="<?php echo $sco_version; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Status:</SPAN></TD>
	    <TD align="left" valign="top"><?php input_list("status","active,not active",0,$status,"CLASS=input") ?></TD>		
	  </TR> 
	  <TR>
	    <TD><SPAN CLASS=ttl>Date:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="date" CLASS="input" VALUE="<?php echo $date; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Structure:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="structure" CLASS="input" VALUE="<?php echo $structure; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Format:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="format" CLASS="input" VALUE="<?php echo $format; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Size:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="size" CLASS="input" VALUE="<?php echo $size; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>MD Scheme:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="mdscheme" CLASS="input" VALUE="<?php echo $mdscheme; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>MD Catalog:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="mdcatalog" CLASS="input" VALUE="<?php echo $mdcatalog; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>MD Entry:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="mdentry" CLASS="input" VALUE="<?php echo $mdentry; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Learning Resource Type:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="learning_resource_type" CLASS="input" VALUE="<?php echo $learning_resource_type; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Cost:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="cost" CLASS="input" VALUE="<?php echo $cost; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Copyright & other Restrictions:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="copyright" ROWS="5" COLS="40" CLASS="input"><?php echo $copyright; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Rights Descriptions:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="right_description" ROWS="5" COLS="40" CLASS="input"><?php echo $right_description; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Interactive Type:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="interactive_type" CLASS="input" VALUE="<?php echo $interactive_type; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Interactive Level:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="interactive_level" CLASS="input" VALUE="<?php echo $interactive_level; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Typical Learning Time:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="typical_learning_time" CLASS="input" VALUE="<?php echo $typical_learning_time; ?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Location:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="location" ROWS="5" COLS="40" CLASS="input"><?php echo $location; ?></TEXTAREA></TD>		
	  </TR>
	  
	  <!-- new form end-->
	  
	  <!--
	  <TR>
	    <TD><SPAN CLASS=ttl>Course Title:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT TYPE="TEXT" NAME="name" CLASS="input" VALUE="<?php echo $name;?>"></TD>		
	  </TR> 	
	  
	  <TR>
	    <TD><SPAN CLASS=ttl>Status:</SPAN></TD>
	    <TD align="left" valign="top"><?php input_list("status","active,not active",0,$status,"CLASS=input") ?></TD>		
	  </TR>  
	  
	  <?php if($url!=""){
	  ?>
	 <TR>
	    <TD><SPAN CLASS=ttl>URL:</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="url" CLASS="input" VALUE="<?php echo $url; ?>"></TD>		
	  </TR> 
	  <?php
	  }
	  ?>
	   <TR>
	    <TD><SPAN CLASS=ttl>Sco version</SPAN></TD>
	    <TD align="left" valign="top"><INPUT  TYPE="TEXT" NAME="sco_version" CLASS="input" VALUE="<?php echo $sco_version; ?>"></TD>		
	  </TR> 
	  <TR>
	    <TD><SPAN CLASS=ttl>Description:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="description" ROWS="5" COLS="40" CLASS="input"><?php echo $description; ?></TEXTAREA></TD>		
	  </TR>
		<TR>
	    <TD><SPAN CLASS=ttl>Keywords:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="keyword" ROWS="3" COLS="40" CLASS="input"><?php echo $keyword; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Catalog Name:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="catalog_name" ROWS="1" COLS="40" CLASS="input"><?php echo $catalog_name; ?></TEXTAREA></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Catalog Entry:</SPAN></TD>
	    <TD align="left" valign="top"><TEXTAREA NAME="catalog_entry" ROWS="1" COLS="40" CLASS="input"><?php echo $catalog_entry; ?></TEXTAREA></TD>		
	  </TR>-->
</TABLE>

</FORM>
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" width="100%">
	  <TR>
	    <TD COLSPAN="3"><HR></TD>
	  </TR>
	  <TR>
	    <TD colspan="2"><SPAN CLASS=ttl><B>Objectives:</SPAN></TD>
	    <TD ALIGN="RIGHT" nowrap="nowrap"  width="1%"><a href="create_objects_sql.php?action=objective&course_ID=<?php echo $ID; ?>" target="edit_post" class="thebutton" ><img border="0" src="images/import.gif" alt="Add Objectives"> Add Objectives </a>
	    </TD>
	  </TR>

<?php
$db = new db;
$db->connect();
$db->query("SELECT * FROM objectives WHERE course_ID=$ID");
$ox=1;
while($db->getRows())
{ 
$oID=$db->row("ID");
$objective = $db->row("objective");
?>


<FORM NAME="thisObjective_<?php echo $ox;?>" METHOD="POST" ACTION="update_objects_sql.php?action=objective" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="formAction">
<INPUT TYPE="HIDDEN" NAME="course_ID" VALUE="<?php echo $ID;?>">
<INPUT TYPE="HIDDEN" NAME="oID" VALUE="<?php echo $oID;?>">
	  <TR>
	    <TD VALIGN="TOP"><SPAN CLASS=ttl>Objective  #<?php echo $ox;?>:</SPAN></TD>
	    <TD NOWRAP VALIGN="TOP" colspan="2"><TEXTAREA ROWS="2" COLS="40" id="objective" NAME="objective" WRAP="virtual" CLASS="input"><?php echo $objective;?></TEXTAREA> &nbsp;&nbsp;<A HREF="#" onClick="document.thisObjective_<?php echo $ox;?>.formAction.value='SAVE';document.thisObjective_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/save.gif" BORDER="0" ALIGN="ABSMIDDLE"></A> &nbsp;&nbsp;<A HREF="#" onClick="document.thisObjective_<?php echo $ox;?>.formAction.value='DELETE';document.thisObjective_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/delete.gif" BORDER="0" ALIGN="ABSMIDDLE"></A></TD>		
	  </TR>
</FORM>
<?php
$ox++;
}
?>

	  <TR>
	    <TD COLSPAN="3"><HR></TD>
	  </TR>
	  <TR>
	    <TD colspan="2"><SPAN CLASS=ttl><B>References:</SPAN></TD>
	    <TD ALIGN="RIGHT" nowrap="nowrap">
		<a href="create_objects_sql.php?action=ref&course_ID=<?php echo$ID; ?>" target="edit_post" class="thebutton" ><img border="0" src="images/import.gif" alt="Add References"> Add References </a>
	    </TD>
	  </TR>
<?php
$db = new db;
$db->connect();
$db->query("SELECT * FROM ref WHERE course_ID=".$rID);
$rx=1;
while($db->getRows())
{ 
$oID=$db->row("ID");
$rfname = $db->row("rname");
$description = $db->row("description");
?>


<FORM NAME="thisRef_<?php echo $rx;?>" METHOD="POST" ENCTYPE="multipart/form-data" ACTION="update_objects_sql.php?action=ref" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="formAction">
<INPUT TYPE="HIDDEN" NAME="fname">
<INPUT TYPE="HIDDEN" NAME="course_ID" VALUE="<?php echo $ID;?>">
<INPUT TYPE="HIDDEN" NAME="oID" VALUE="<?php echo $oID;?>">
	  <TR>
	    <TD VALIGN="TOP"><SPAN CLASS=ttl>Reference  #<?php echo $rx;?>:</SPAN></TD>
		<TD VALIGN="TOP" colspan="2"><INPUT TYPE="TEXT" NAME="rname" id="rname"  VALUE="<?php echo $rfname;?>" CLASS="input"></TD>
	  </TR>	
	  <TR>
	    <TD VALIGN="TOP"><SPAN CLASS=ttl>&nbsp;</SPAN></TD>
		<TD VALIGN="TOP" colspan="2"> <INPUT TYPE="file" VALUE="upload" CLASS="input" NAME="thefile" id="thefile">&nbsp;</TD>
	  </TR>	  
	  <TR>
	    <TD VALIGN="TOP"><SPAN CLASS=ttl>&nbsp;</SPAN></TD>
	    <TD NOWRAP VALIGN="TOP" colspan="2"><TEXTAREA ROWS="2" COLS="40" NAME="description" id="description" WRAP="virtual" CLASS="input"><?php echo $description;?></TEXTAREA> &nbsp;&nbsp;<A HREF="#" onClick="document.thisRef_<?php echo $rx;?>.formAction.value='SAVE';document.thisRef_<?php echo $rx;?>.fname.value=document.thisRef_<?php echo $rx;?>.thefile.value;document.thisRef_<?php echo $rx;?>.submit();return false;"><input type="button"  name="button1" id="button1" value="Submit"  /></A> &nbsp;&nbsp;<A HREF="#" onClick="document.thisRef_<?php echo $rx;?>.formAction.value='DELETE';document.thisRef_<?php echo $rx;?>.submit();return false;"><IMG SRC="images/delete.gif" BORDER="0" ALIGN="ABSMIDDLE"></A></TD>		
	  </TR>
</FORM>

<?php
$rx++;
}
?>


	  <!--<TR BGCOLOR="#EFF7FF" >
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel"   CLASS="submit"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  CLASS="submit"></TD>
	  </TR>-->			  
	</TABLE>



	</TD>
	<TD BACKGROUND="images/bev_right.gif" WIDTH="8"></TD>	
	  </TR>
	  <TR>
	    <TD><IMG SRC="images/bev_left_b_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_bottom.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_b_corner.gif"></TD>	
	  </TR>		
	</TABLE>


</BODY>