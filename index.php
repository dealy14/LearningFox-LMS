<?php
session_start();
require_once("conf.php");

$section = $_REQUEST['section'];
$logout = $_REQUEST['logout'];
?>
<html dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<title><?php echo TEXT_SITE_TITLE; ?></title>
	<!--[if IE]>    
	<style type="text/css">
	.dock {
		position: expression(inQuirksMode() ? "absolute" : "fixed") !important;
		top: expression(inQuirksMode() ? ((document.documentElement.scrollTop || document.body.scrollTop) + (document.documentElement.clientHeight || document.body.clientHeight) - this.offsetHeight) + "px" : "fixed") !important;
		width: expression(inQuirksMode() ? (document.documentElement.clientWidth || document.body.clientWidth) + "px" : "100%") !important;
		left: expression(inQuirksMode() ? (document.documentElement.scrollLeft || document.body.scrollLeft) + "px" : "0") !important;
	}
	</style>
	<![endif]-->    
	<script type="text/javascript">
	function openWindow(winName){
		window.open(winName,"FAQs", "width=950,height=650,resizable=no,scrollbars=no,toolbar=no,status=no,menubar=no,copyhistory=no,left=100,top=100,screenX=100,location=no,screenY=100");
	}
	</script>
	<link rel="stylesheet" type="text/css" href="<?php echo $dir_css."index_style.css"; ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo $dir_css."header_style.css"; ?>" />
</head>
<body id="lcPage" bgcolor="#fffff">
<div id="mainContainer">
<div id="divItemProperties" style="display:none;" title="More Information">
<iframe style="width:97%;" name="ifMoreInfo" id="ifMoreInfo" frameborder="0" 
scrolling="auto" marginheight="0" marginwidth="0" allowtransparency="yes" 
src="/includes/CoursePlayer/LoadingPlaceholder.htm"></iframe>
</div>
<div id="ldcWriteReviewDiv" title="Submit a Review" style="display:none;">
<iframe src="/includes/CoursePlayer/LoadingPlaceholder.htm" name="ldcWriteReviewDivFrame" 
id="ldcWriteReviewDivFrame" frameborder="0" marginheight="0" marginwidth="0" 
scrolling="no" width="100%" height="350"></iframe>
</div>
<div id="ldcReadReviewsDiv" title="Reviews" style="display:none;">
<iframe src="/includes/CoursePlayer/LoadingPlaceholder.htm" name="ldcReadReviewsDivFrame" 
id="ldcReadReviewsDivFrame" frameborder="0" marginheight="0" marginwidth="0" 
scrolling="no" width="95%" height="500"></iframe>
</div>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td align="center" width="100%" bgcolor="#fff" background="/images/skins/lc/images/clear1x1.gif">
	<table class="pageheader" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td valign="top"><img src="<?php echo PATH_LOGO_FILE; ?>" align="default" border="0" hspace="0" vspace="0"  alt="" /></td>
		</tr>
		<tr>
	 	<td class="navbar">
			<?php if ($show_top_menu) { require_once($dir_components.'top_menu.php'); } ?>
	 	</td>
		</tr>
		<tr>
		 <td align="right" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; background-color:#ffffff;">
			<?php if(!is_null($sid) && $session_error=="none"){ ?>
				Logged in as: <b><?php echo $lms_username; ?></b>
			<?php } ?>
		 </td>
		</tr>
	</tbody>
	</table>
</td></tr>
</table>
<table id="ldcLCPageContentContainerTable" width="100%" cellspacing="0" 
align="center" cellpadding="0" border="0">
	<tr>
	<?php /* Left navigation menu (navbar2.php) */
	if((!is_null($sid) && $session_error=="none" && $show_left_navbar))
	{
		?>
		<td id="ldcLCPageLeftNavTD">
		<?php include($dir_components."navbar2.php"); ?>
		</td>
	<?php } ?>
	<td id="ldcLCPageContentTD" valign="top" align="left">
	<div id="ldcLCPageContent">
		<?php include_once($mysection); ?>
	</div>
	</td>
	</tr>
</table>
</div>
</body>
</html>