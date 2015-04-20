<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// login to the system
require('login.php');

// create header
require('header.php');

// processing login script
displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// store email address submitted
$userid = $_REQUEST['userid'];
$password = stripslashes($_REQUEST['password']);
$rtpassword = stripslashes($_REQUEST['rtpassword']);
$password = pg_escape_string($password);
$rtpassword = pg_escape_string($rtpassword);

if (!$password) {
	unset($password);
}elseif ($password<>$rtpassword) {
	die("Password fields did not match. Please try again.");
}else{
	$md5pass = md5($password);
}

/* update user table with new password */
$passquery = "UPDATE azcase_users SET password = '$md5pass' WHERE userid = $userid;";
pg_send_query($connection, $passquery);
$res1 = pg_get_result($connection);
$pgerror = pg_result_error($res1);
if ($pgerror!=FALSE) {
	/* Notify that link was broken and kill script */
	echo "<h1>Password Reset Failed</h1><p>The password you entered was not accepted by the system. Please go back to the <a href=\"http://azafterschool.org/directory/\">provider login page</a> and request a new password again.</p>";
	die();
}else{}

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

   /* Kill session variables */
   unset($_SESSION['useremail']);
   unset($_SESSION['password']);
   $_SESSION = array(); // reset session array
   session_destroy();   // destroy session.


?>
<body>
<h1>New Password Saved</h1>
<p>Thank you for updating your password. You must <a href="providerhome.php">login again</a> with this new password to continue.</p>

<?

// close logged_in
}else{}

// create footer
require('footer.php');

?>


