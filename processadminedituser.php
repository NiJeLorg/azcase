<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// connect to database
require("connect.php");

// login to the system
require('login.php');

// processing login script
//displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

global $connection;
/* Verify that user partner is admin or not */
$useremailsession = pg_escape_string($_SESSION['useremail']);
$partnerquery = "SELECT admin FROM azcase_users WHERE useremail = '$useremailsession';";
$result = pg_query($connection, $partnerquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$admin = pg_result($result, $lt, 0);
}

if ($admin=='t') {

// bring search data across
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];
$useremailold = $_REQUEST['useremailold'];


// store email address submitted
$useremail = stripslashes($_REQUEST['useremail']);
$useremail = trim($useremail);


// check for valid email address
require('EmailAddressValidator.php');

$validator = new EmailAddressValidator;
if ($validator->check_email_address($useremail)) {

/* Verify that useremail is not in currently in use if ($useremail!=$_SESSION['useremail']) */
if ($useremail!=$_SESSION['useremail']) {
	// prep email for db
	$useremailpg = pg_escape_string($useremail);	
	$countquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$useremailpg';";
	$countresult = pg_query($connection, $countquery);
	$countemail = pg_result($countresult, 0, 0);

	if ($countemail>1) {
	/* Notify that no email exists and kill script */
		require('header.php');
		echo "<h1>Email Address Already in Use</h1><p>The email address you entered is already in use in the system. Please go back and change the email address entered.</p><p>Email address entered: <b>$useremail</b></p>";
		require('footer.php');
		die();
	}else{}
}else{}

// bring in other entered data
$username = stripslashes($_REQUEST['username']);
$orgname = stripslashes($_REQUEST['orgname']);
$address = stripslashes($_REQUEST['address']);
$address2 = stripslashes($_REQUEST['address2']);
$city = stripslashes($_REQUEST['city']);
$state = stripslashes($_REQUEST['state']);
$zip = stripslashes($_REQUEST['zip']);
$phone = stripslashes($_REQUEST['phone']);
$fax = stripslashes($_REQUEST['fax']);

$username = pg_escape_string($username);
$orgname = pg_escape_string($orgname);
$address = pg_escape_string($address);
$address2 = pg_escape_string($address2);
$city = pg_escape_string($city);
$state = pg_escape_string($state);
$zip = pg_escape_string($zip);
$phone = pg_escape_string($phone);
$fax = pg_escape_string($fax);
$useremailpg = pg_escape_string($useremail);


// set updated
$updated = date('Y-m-d H:i:s');

// if the user changed email addresses - update email in azcase_users and log user out in next script

$updateuser = "UPDATE azcase_users SET \"useremail\" = '$useremailpg', \"username\" = '$username', \"updated\" = '$updated', \"orgname\" = '$orgname', \"address\" =  '$address', \"address2\" = '$address2', \"city\" = '$city', \"state\" = '$state', \"zip\"= '$zip', \"phone\" = '$phone', \"fax\" = '$fax' WHERE userid = $userid;";
pg_send_query($connection, $updateuser);
$res1 = pg_get_result($connection);
$pgerror1 = pg_result_error($res1);

if ($pgerror1!=FALSE) {
	require('header.php');
	echo "<h1>Save Error</h1><p>An error occured when you attempted to submit your user information. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
	require('footer.php');
	$to = "jd@nijel.org";
	$subject = "AZ Afterschool Program Directory Error: processadminedituser.php Failed";
	$message = "User:" . $_SESSION['useremail'] . "\nPage: processadminedituser.php\nFailed Query: $updateuser\nError: $pgerror1";
	mail($to,$subject,$message);
	die ();
}else{}

// if the email address has been changed, set password to random and email new user asking them to reset their password
if ($useremail!=$useremailold) {
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	$randompassword = generateRandomString();
	$md5pass = md5($randompassword);

	$randompassword = generateRandomString();
	$md5temp_pass = md5($randompassword);

	$uquery = "UPDATE azcase_users SET password = '$md5pass', temp_pass = '$md5temp_pass' WHERE userid = $userid;";
	pg_send_query($connection, $uquery);

	/* Send new password to this email address */
	$subject = "AZ Afterschool Program Directory | User Account Changes";
	$headers = "From: AzCASE <azcase.directory@gmail.com> \r\n";
	$headers .= "Content-type: text/html\r\n"; 
	$url = "https://azcase.nijel.org/phpsite/resetpassword.php?42=$randompassword";

	$message = "
Hello $useremail,
<br /><br />
An administrator at the Arizona Center for Afterschool Excellence updated your account information and in the process, changed your email address. We require that you choose a new password when your email address is changed, so please follow the link below to set your new password in the Arizona Afterschool Program Directory.
<br /><br />
<a href=\"$url\">$url</a>
<br /><br />
Thanks,
<br />
Arizona Center for Afterschool Excellence
	";
	
	mail($useremail,$subject,$message,$headers);

}else{} /* if ($useremail==$useremailold) { */

?>

<?php
}else{
	echo "<h1>Invalid Email Address</h1><p>The email address you entered was invalid. Please go back and try again.</p><p>Email address entered: <b>$useremail</b></p>";
}

// close admin = TRUE
}else{}

// close logged_in
}else{}


header("Location: https://azcase.nijel.org/phpsite/endadminedituser.php?userid=$userid&searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname");
?>

