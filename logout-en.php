<?php
session_start();

$_SESSION = array();

session_destroy();

header("location: stapsteen-en.php");
exit;
?>