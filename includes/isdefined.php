<?php
function is_set_and_defined($thevar)
{
 if(isset($_GET[$thevar]) && !empty($_GET[$thevar]) )
 	return $_GET[$thevar];
 elseif(isset($_POST[$thevar]) && !empty($_POST[$thevar]) )
 	return $_POST[$thevar];
 else
 	return false;
}
$addcourse = is_set_and_defined('addcourse'  ) ;
$course_ID = is_set_and_defined('course_ID'  ) ;
$logout    = is_set_and_defined('logout'     ) ;
$report    = is_set_and_defined('report'     ) ;
$section   = is_set_and_defined('section'    ) ;
$submit    = is_set_and_defined('submit'     ) ;
$sid       = is_set_and_defined('sid'        ) ;
$cnt       = is_set_and_defined('cnt'        ) ;
$uname     = is_set_and_defined('uname'      ) ;
$pwd       = is_set_and_defined('pwd'        ) ;
$org_id    = is_set_and_defined('org_id'     ) ;
/*
echo "addcourse= $addcourse<BR>";
echo "course_ID= $course_ID<BR>";
echo "logout= $logout<BR>";
echo "report= $report<BR>";
echo "section= $section<BR>";
echo "sid= $sid<BR>";
echo "cnt= $cnt<BR>";
*/
?>