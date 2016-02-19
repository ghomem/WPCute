<?php

$MYSITE="mysite.eu";
$TOPDIR="myfiles/customers";
$ERRORMSG="Don't go there Dave";

// security checks

// we need to have a session
session_start();
if ( !isset($_SESSION['userid'] ) ) die( $ERRORMSG );

//our username must match current URL directory
$curdir = basename ( $_SERVER['REQUEST_URI'] );
$myuser = $_SESSION['userid'];

// if the URL has params this test will fail, as it should since the URL should not have params
if ( $curdir != $myuser) die( $ERRORMSG) ;

// we need to be redirected from our own website
$referer = $_SERVER['HTTP_REFERER'];
$referer_parse = parse_url($referer);

if ($referer_parse['host'] != $MYSITE || $referer_parse['host'] == "www".$MYSITE ) die( $ERRORMSG );

?>

