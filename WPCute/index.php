<?php

/* 
   This script authenticates a user and serves him a folder with with same name
   if it exists. Otherwise it goes back to the login form.

   This is kind of a http "homes" share where the authentication is done against
   Wordpress and the folder contents are maintained manually (sftp, etc).
*/ 

/* definitions */ 

$WPDIR = "../../website/";
$REDIRBASE = "http://mysite.com/myfiles/customers/";
$REDIRERROR = "http://mysite.com/website/404";

/* helper functions */

function can_redirect ($user_login, $user_pass) {

    // can't do anything if the subfolder does not exist
    if ( !file_exists ($user_login) )
       return false;

    if ( wp_user_pass_ok ($user_login, $user_pass) ) {
        $_SESSION['userid'] = $user_login;
        $_SESSION['password'] = $user_pass;
        session_write_close();
        return true;
    }

   //print "can redir is false";
   return false;
}

function wp_user_pass_ok($user_login, $user_pass) {
   $user = wp_authenticate($user_login, $user_pass);
  
   // checks user auth, leave place for further WP related checks
   if ( is_wp_error($user) )
      return false;
   return true;
}

/* main code */

// we need this to auth against Wordpress
define('WP_USE_THEMES', false);
require( $WPDIR."/wp-load.php");

// flag that controls the auth status
$must_go_on = false;

session_start();

// either we have a session or we got creds via POST ...
if ( isset($_SESSION['userid'] ) ) {
    $myuser = $_SESSION['userid'];
    $must_go_on = file_exists ($myuser);
} else {
    if (isset ($_POST['userid'] ) ) {
        $myuser = $_POST['userid'];
        $mypass = $_POST['password'];
        $must_go_on = can_redirect($myuser,$mypass);
    }
}

if ( $must_go_on ) {
   header("Location: ".$REDIRBASE.$myuser);
}

// .. or we will get the login form below

?>

<html>
<head>
    <title>Login | My Site </title>
    <meta name="description" content=" | " />
    <meta charset="UTF-8" />
    <link rel='stylesheet' id='options_typography_Righteous-css'  href='//fonts.googleapis.com/css?family=Righteous&#038;subset=latin' type='text/css' media='all' />
    <link rel="stylesheet" type="text/css" media="all" href="http://mysite.com/website/wp-content/themes/theme52175/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="all" href="http://mysite.com/website/wp-content/themes/theme52175/bootstrap/css/responsive.css" />
    <link rel="stylesheet" type="text/css" media="all" href="http://mysite.com/website/wp-content/themes/CherryFramework/css/camera.css" />
    <link rel="stylesheet" type="text/css" media="all" href="http://mysite.com/website/wp-content/themes/theme52175/style.css" />
    <link rel='stylesheet' id='contact-form-7-css'  href='http://mysite.com/website/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=4.3.1' type='text/css' media='all' />
    <style type='text/css'>
        body { background-color:#222222 }
        body { font-weight: normal;}
    </style>

    <style type='text/css'>
        h1 { font: normal 24px/28px Roboto, sans-serif;  color:#ffffff; }
        h2 { font: normal 24px/28px Roboto, sans-serif;  color:#ffffff; }
        h3 { font: normal 24px/28px Roboto, sans-serif;  color:#ffffff; }
        h4 { font: normal 18px/22px Roboto, sans-serif;  color:#ffffff; }
        h5 { font: normal 16px/20px Roboto, sans-serif;  color:#ffffff; }
        h6 { font: normal 12px/20px Roboto, sans-serif;  color:#ffffff; }
     </style>

    <! -- override base definitions for form behaviour -->
    <style type='text/css'>
	body {
	  padding-top: 40px;
	  padding-bottom: 40px;
	}
	.form-signin {
	  max-width: 330px;
	  padding: 15px;
	  margin: 0 auto;
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	  margin-bottom: 10px;
	}
	.form-signin .checkbox {
	  font-weight: normal;
	}
	.form-signin .form-control {
	  position: relative;
	  height: auto;
	  width: 100%;
	  -webkit-box-sizing: border-box;
	     -moz-box-sizing: border-box;
		  box-sizing: border-box;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}
    </style>
</head>

<body class="home page page-id-203 page-template page-template-page-home page-template-page-home-php">

  <div class="container" >

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">CUSTOMER LOGIN</h2>
        <label for="inputUser" class="sr-only">Username</label>
        <input type="text" id="inputUser" class="form-control" name="userid" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      </form>

    </div> <!-- /container -->


</body>
</html>
