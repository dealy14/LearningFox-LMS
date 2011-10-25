<?php
require_once("../conf.php");
to_file($main_dir."chat/mychat.php","<B>".$username.":</B> ".$mytalk."\n","a+");
?>
