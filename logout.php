<?php
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

require("connect.php");
//require("login.php");

// Logout script

/**
 * Delete cookies - the time must be in the past,
 * so just negate what you added when creating the
 * cookie.
 */
if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
   setcookie("cookname", "", time()-60*60*24*100, "/");
   setcookie("cookpass", "", time()-60*60*24*100, "/");
}

//header
require('header.php');

/* Kill session variables */
unset($_SESSION['useremail']);
unset($_SESSION['password']);
$_SESSION = array(); // reset session array
session_destroy();   // destroy session.
echo "<body><h1>Logged Out</h1>\n";
echo "<p>You have successfully <b>logged out</b>. Back to <a href=\"index.php\">home</a></p>";

//footer
require('footer.php');
?>
