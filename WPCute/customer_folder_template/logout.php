<?php

require_once("../config.php");

// if we have a session we clean it up first - that is the main function here
// otherwise, ie, if we were called directly for some reason, we just redirect

// of course the friendly redirect on direct invocation of this page confirms
// user existence; we could do 404 instead but an accidental double-click on
// the logout link would bring up and error page - and that happens when people
// user a "file explorer"

session_start();

if ( isset($_SESSION['userid'] ) ) 
{
  session_destroy();
}
else
{

  // place holder for avoiding user existence disclosure at the cost less friendliness

  /* $mymsg = str_replace("{{ DUMMYURL }}", $_SERVER['REQUEST_URI'], $MSG404);
  header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
  print $mymsg;
  die( ); */ 

}

header("Location: ".$REDIRURL);

?>

