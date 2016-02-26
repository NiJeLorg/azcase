<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

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

// set temp_pass to something else so the link no longer works
function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

$randompassword = generateRandomString();
$md5temppass = md5($randompassword);

$updatetemppass = "UPDATE azcase_users SET temp_pass = '$md5temppass' WHERE userid = $userid;";
pg_send_query($connection, $updatetemppass);


?>
<body>
<h1>New Password Saved</h1>
<p>Thank you for updating your password. Using that password you should now be able to login at the <a href="http://azafterschool.org/directory/">provider login page</a>.</p>
<div id="clear"></div>
<br /><br />
</body>
</html>

