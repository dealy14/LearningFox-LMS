<?php

$myconf="demo_site";


require_once("../conf.php");
if( isset( $_GET[ "test_link"]) && ! ereg('[^0-9]',  $_GET['survey_ID']) )
{
	$test_link = $_GET[ "test_link"];
}
else
{
	$test_link = "1";
}

####################################################################################################################################################################
## Include Some JavaScript for the non-LMS version
####################################################################################################################################################################
$qr.="\n";
//copy static JavaScript functions here;
/*
$filename = $dir_includes."quiz_modules/1_js";
$fd = fopen ($filename, "r");
$qr.=fread ($fd, filesize ($filename));
fclose ($fd);
*/
####################################################################################################################################################################
## Include the content from the topic code (to be changed later)
####################################################################################################################################################################
$qr.=nl2br($content);

####################################################################################################################################################################
## Begin Quiz Table
####################################################################################################################################################################
$qr.="<"."?xml version=\"1.0\"?".">
<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\"
			\"http://www.wapforum.org/DTD/wml_1.1.xml\">

<wml>
";

####################################################################################################################################################################
## Database Quiz Extraction
####################################################################################################################################################################
	$db = new db;
	$db->connect();
	$db->query("SELECT questions.question,questions.choice_1,questions.choice_2,questions.choice_3,questions.choice_4,questions.correct_answ,questions.question_type FROM questions,tests_r WHERE tests_r.test_ID='$test_link' AND tests_r.question_order>0 AND questions.ID=tests_r.question_ID ORDER BY tests_r.question_order ASC");
	$xm=1;
	while($db->getRows())
	{ 
	$qr.="
	<card id=\"step$xm\" title=\"Part $xm\">
	<p>
	".nl2br($db->row("question")).":
	<select name=\"q".$xm."\">
	<option value=\"".nl2br($db->row("choice_1"))."\">".nl2br($db->row("choice_1"))."</option>
	<option value=\"".nl2br($db->row("choice_2"))."\">".nl2br($db->row("choice_2"))."</option>	
	";
	if($db->row("question_type")!="TF")
	{
	
	$qr.="
	<option value=\"".nl2br($db->row("choice_3"))."\">".nl2br($db->row("choice_3"))."</option>
	<option value=\"".nl2br($db->row("choice_4"))."\">".nl2br($db->row("choice_4"))."</option>	
	";
	
	}
	
    $qr.="
	</select>
	</p>
	
	<do type=\"accept\" label=\"NEXT\">
	<go href=\"#step".($xm+1)."\"/>
	</do>
	</card>	
    ";  
		
	$xm++;
	}
####################################################################################################################################################################
##  End db Extraction here, begin closing Quiz Table
####################################################################################################################################################################	

$qr.="
	<card id=\"step".$xm."\" title=\"Part ".$xm."\">
	<p>
	Submit survey info.
	</p>
	
	<do type=\"accept\" label=\"Submit Survey\">
	<go  href=\"survey_post.php\" method=\"post\">
	<postfield name=\"test_ID\" value=\"".$test_link."\"/>
	<postfield name=\"add_survey\" value=\"yes\"/>
";	
	$g=0;
	while($g<($xm-1))
	{
	$qr.="<postfield name=\"answers[".($g-0)."]\" value=\"$"."(q".($g+1).")\"/>      
	";
	$g++;
	}	
		
$qr.="		
	</go>
	</do>
	</card>		
</wml>	
";	


####################################################################################################################################################################
## Stuff in standard "html" variable
####################################################################################################################################################################
//$html=addslashes($qr);

####################################################################################################################################################################
## Publish to file
####################################################################################################################################################################
echo addslashes($qr) ;
?>