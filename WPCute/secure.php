<?php

require_once("config.php");

// Summary: we are here because we reached a specific BASEDIR/username URL
// to avoid disclosing the existence / non-existence of username we send
// a 404 reply with the default 404 Apache page in all error conditions

// of course, after autentication at BASEDIR the single BASEDIR/username
// that matches the username will work fine

// prepare 404 just in case

$mymsg = str_replace("{{ DUMMYURL }}", $_SERVER['REQUEST_URI'], $MSG404);

// we need to have a session
session_start();
if ( !isset($_SESSION['userid'] ) ) 
{
  // we send a 404 to falsely indicate that the page does not exist
  header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
  print $mymsg;
  die();
}

//the username contained in the session must match the requested URL directory
$myuser = $_SESSION['userid'];
$curdir = basename ( $_SERVER['REQUEST_URI'] );

// if the URL has params this test will fail, as it should since the URL should not have params
if ( $curdir != $myuser) 
{
  // we send a 404 to falsely indicate that the page does not exist
  header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
  print $mymsg;
  die( $ERRORMSG );
}

?>
