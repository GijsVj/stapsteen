<?php
session_start();

$_SESSION = array();

session_destroy();

header("location: stapsteen-fr.php");
exit;
?>