<?php
session_start();

$myconf="demo_site";

require_once("conf.php");
$buttombanner="<img src=\"images/buttombanner.gif\" />";
?>

<html dir="ltr">

<head>

    <meta http-equiv="Content-Type" content="text/html;" charset="utf-8">

    <title>Cosmos Consulting  LearnCenter</title>

    <style type="text/css">

        .dock

        {

        	position: fixed;

	        bottom: 0;

            overflow: hidden;

            margin:0 auto;

            width: 100%;

        }        

    </style>

    <!--[if IE]>    

    <style type="text/css">

        .dock

        {

            position:expression(inQuirksMode() ? "absolute" : "fixed") !important;

            top: expression(inQuirksMode() ? ((document.documentElement.scrollTop || document.body.scrollTop) + (document.documentElement.clientHeight || document.body.clientHeight) - this.offsetHeight) + "px" : "fixed") !important;

            width: expression(inQuirksMode() ? (document.documentElement.clientWidth || document.body.clientWidth) + "px" : "100%") !important;

            left: expression(inQuirksMode() ? (document.documentElement.scrollLeft || document.body.scrollLeft) + "px" : "0") !important;

        }

    </style>

    <![endif]-->    
<style type="text/css">
<!--
.rightborder { 
border-right: 1px solid #000000; 
} 
.leftborder { 
border-left: 1px solid #000000; 
border-right: 1px solid #000000; 
border-bottom: 1px solid #000000; 
border-style: thin; 
} 

.style2 {font-size: xx-small}
.descriptor_row
{
background:#003366;
font-size:x-small;
color:#FFFFFF;
border:#FFFFFF;
}
-->
</style>
</head>

<body id="lcPage" bgcolor="#FFFFFF" style="direction: ltr"

    leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

    <div style="display: none">

        <form id="learn" action="/learncenter.asp?sessionid=3-28351FC0-727D-4795-A1B2-D679BDFAB4DA&page=1&id=178414" method="post">

        </form>

    </div>

    

    <div id="divItemProperties" style="display:none;" title="More Information">

        <iframe style="width:97%;" name="ifMoreInfo" id="ifMoreInfo" frameborder="0" scrolling="auto" marginheight="0" marginwidth="0" allowtransparency="yes" src="/includes/CoursePlayer/LoadingPlaceholder.htm"></iframe>

    </div>

<div id="ldcWriteReviewDiv" title="Submit a Review" style="display:none;">

<iframe src="/includes/CoursePlayer/LoadingPlaceholder.htm" name="ldcWriteReviewDivFrame" id="ldcWriteReviewDivFrame" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" width="100%" height="350"></iframe>

</div>

<div id="ldcReadReviewsDiv" title="Reviews" style="display:none;">

<iframe src="/includes/CoursePlayer/LoadingPlaceholder.htm" name="ldcReadReviewsDivFrame" id="ldcReadReviewsDivFrame" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" width="95%" height="500"></iframe>

</div>


<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" width="100%" bgcolor="#FFFFFF" background="/images/skins/lc/images/clear1x1.gif"><link rel="stylesheet" type="text/css" href="header_style.css" />

<table class="pageheader" align="center" border="0" cellpadding="0" cellspacing="0" width="960">

     <tbody>

         <tr>

             <td valign="top"><img src="images/cosmosheader4.png" align="default" border="0" hspace="0" vspace="0"  alt="" /></td>

         </tr>

         <tr>

             <td class="navbar">

             <table class="topnav" align="right" border="0" cellpadding="5">

                 <tbody>

                     <tr>

                         <td class="topnav-link"><a href="index.php">Home</a></td>

                         <td class="topnav-link" width="170"><a href="index.php?section=elearning">eLearning <br /></a></td>

                         <td class="topnav-link"><a href="http://www.cosmosconsultingllc.com/services.htm">Consulting</a></td>

                         

                         <td class="topnav-link"><a href="index.php?section=faqs">FAQ/Help</a></td>

                         <td class="topnav-link"><a href="index.php?section=contact">Contact Us</a></td>

                         <td class="topnav-link" id="loginState">
						 <?php 
						 if(is_null($sid) or $session_error!="none")
	                     { 
						      ?>
							  <a href="index.php?section=login&sid=<?php echo $sid; ?>">Login</a>
							  <?php 
						 }
						 else
						 {
						     ?>
							 <a style=""  href="index.php?section=<?php echo $section; ?>&logout=YES&sid=<?php echo $sid; ?>">Log out</a>
							 <?php
						 }
						 ?>
						 </td>

                     </tr>

                 </tbody>

             </table>

             </td>

         </tr>
<tr><td align="right" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;">
    <?php
	if(!is_null($sid)&&$session_error=="none")
	{
	?>Logged in as: <B><?php echo $lms_username;
	}
	?></td></tr>
     </tbody>

</table>

</td></tr>

</table>

<table id="ldcLCPageContentContainerTable" width="100%" cellspacing="0" align="center" cellpadding="0" border="0">
	
	<?php 
	if((!is_null($sid)&&$session_error=="none"))
	{
		include($dir_components."navbar2.php");
	}
	else
	{
	      include("navbar.php"); 
    }
    ?>

	 
	 <td id="ldcLCPageLeftNavShadowTD" width="14" bgcolor="#EAEBED" valign="bottom" align="left" nowrap></td>
	 
	 <td id="ldcLCPageContentTD" valign="top" align="left"><div id="ldcLCPageContent">

<?php 

include($mysection);
 ?>

</div></td></tr>



</table>
<table align="center" class="pagefooter">

    <tr>

        <td class="footer-txt"><!--&#169; 2010 HR NAV +  |  <a href="#">Lorem Ipsum</a> | <a href="#">Consectetuer</a> | <a href="#">Nisl sit amet</a>--></td>

    </tr>

</table>
</body>

</html>