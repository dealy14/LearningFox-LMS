<?php
$count="tester1";
session_register ("count");
?>

Hello visitor, you have seen this page <?php echo $count; ?> times.<p>;

<?php
/*# the <?=SID?> is necessary to preserve the session id
# in the case that the user has disabled cookies*/
?>

To continue, <A HREF="nextpage.php?<?php echo SID;?>">click here</A>
