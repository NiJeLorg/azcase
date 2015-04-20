<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// connect to database
require("connect.php");

// login to the system
require('login.php');

// processing login script
displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

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

	if ($countemail>0) {
	/* Notify that no email exists and kill script */
		require('header.php');
		echo "<h1>Email Address Already in Use</h1><p>The email address you entered is already in use in the system. If you need to request a new password using that email address <a href=\"http://maps.nijel.org/azcase_dev/forgotpassword.php\">go here</a>. If you'd like to sign up will a different email account, please go back and try again with another email address.</p><p>Email address entered: <b>$useremail</b></p>";
		require('footer.php');
		die();
	}else{}
}else{}

$useremailsession = pg_escape_string($_SESSION['useremail']);

// pull userid
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

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
if ($useremail!=$_SESSION['useremail']) {
	// update user and email
	$updateuser = "UPDATE azcase_users SET \"useremail\" = '$useremailpg', \"username\" = '$username', \"updated\" = '$updated', \"orgname\" = '$orgname', \"address\" =  '$address', \"address2\" = '$address2', \"city\" = '$city', \"state\" = '$state', \"zip\"= '$zip', \"phone\" = '$phone', \"fax\" = '$fax' WHERE userid = $userid;";
	pg_send_query($connection, $updateuser);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
}else{
	// update user but not email
	$updateuser = "UPDATE azcase_users SET \"username\" = '$username', \"updated\" = '$updated', \"orgname\" = '$orgname', \"address\" =  '$address', \"address2\" = '$address2', \"city\" = '$city', \"state\" = '$state', \"zip\"= '$zip', \"phone\" = '$phone', \"fax\" = '$fax' WHERE userid = $userid;";
	//echo $updateuser;
	pg_send_query($connection, $updateuser);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
}

if ($pgerror1!=FALSE) {
	require('header.php');
	echo "<h1>Save Error</h1><p>An error occured when you attempted to submit your user information. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
	require('footer.php');
	$to = "jd@nijel.org";
	$subject = "AZ Afterschool Program Directory Error: processeditprovider.php Failed";
	$message = "User:" . $_SESSION['useremail'] . "\nPage: processeditprovider.php\nFailed Query: $updateuser\nError: $pgerror1";
	mail($to,$subject,$message);
	die ();
}else{}

?>

<?php
}else{
	echo "<h1>Invalid Email Address</h1><p>The email address you entered was invalid. Please go back and try again.</p><p>Email address entered: <b>$useremail</b></p>";
}

// close logged_in
}else{}


header('Location: http://maps.nijel.org/azcase_dev/endeditprovider.php');
?>

