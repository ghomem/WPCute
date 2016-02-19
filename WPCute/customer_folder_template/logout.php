<?php

$REDIRURL = "http://mysite.eu/website";

// we must not be called directly
session_start();
if ( !isset($_SESSION['userid'] ) ) die("Don't go there Dave");

session_destroy();
header("Location: ".$REDIRURL);

?>

