<?php
session_start();
$_SESSION['sco_id']=$_GET['sco_id'];

echo ($_SESSION['sco_id']);
?>
