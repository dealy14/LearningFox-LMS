<?php
/*
session_register ("count");
$count="tester1";
*/
?>

Hello visitor, you have seen this page <?php echo $count; ?> times.<p>;

<?php
/*# the <?php echo $SID?> is necessary to preserve the session id
# in the case that the user has disabled cookies
*/
?>

To continue, <A HREF="nextpage.php?<?php echo $SID;?>">click here</A>
