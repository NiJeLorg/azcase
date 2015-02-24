<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// connect to database
require("connect.php");

// store email address submitted
$useremail = stripslashes($_REQUEST['useremail']);
$useremail = trim($useremail);


// check for valid email address
require('EmailAddressValidator.php');

$validator = new EmailAddressValidator;
if ($validator->check_email_address($useremail)) {

/* Verify that user is in database */
$countquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$useremail';";
$countresult = pg_query($connection, $countquery);
$countemail = pg_result($countresult, 0, 0);

if ($countemail>0) {
	/* Notify that no email exists and kill script */
	require('header.php');
	echo "<h1>Email Address Already in Use</h1><p>The email address you entered is already in use in the system. If you need to request a new password using that email address <a href=\"http://maps.nijel.org/azcase/forgotpassword.php\">go here</a>. If you'd like to sign up will a different email account, please go back and try again with another email address.</p><p>Email address entered: <b>$useremail</b></p>";
	require('footer.php');
	die();
}else{}


// bring in other entered data
$username = stripslashes($_REQUEST['username']);
$password = stripslashes($_REQUEST['password']);
$rtpassword = stripslashes($_REQUEST['rtpassword']);
$orgname = stripslashes($_REQUEST['orgname']);
$address = stripslashes($_REQUEST['address']);
$address2 = stripslashes($_REQUEST['address2']);
$city = stripslashes($_REQUEST['city']);
$state = stripslashes($_REQUEST['state']);
$zip = stripslashes($_REQUEST['zip']);
$phone = stripslashes($_REQUEST['phone']);
$fax = stripslashes($_REQUEST['fax']);

$username = pg_escape_string($username);
$password = pg_escape_string($password);
$rtpassword = pg_escape_string($rtpassword);
$orgname = pg_escape_string($orgname);
$address = pg_escape_string($address);
$address2 = pg_escape_string($address2);
$city = pg_escape_string($city);
$state = pg_escape_string($state);
$zip = pg_escape_string($zip);
$phone = pg_escape_string($phone);
$fax = pg_escape_string($fax);
$useremailpg = pg_escape_string($useremail);

if (!$password) {
	unset($password);
}elseif ($password<>$rtpassword) {
	die("Password fields did not match. Please try again.");
}else{
	$md5pass = md5($password);
}

// set updated
$lastlogintime = date('Y-m-d H:i:s');
$updated = date('Y-m-d H:i:s');


// add new user to users table
$insertuser = "INSERT INTO azcase_users (\"userid\", \"useremail\", \"username\", \"password\", \"admin\", \"firstlogin\", \"lastlogintime\", \"updated\", \"orgname\", \"address\", \"address2\", \"city\", \"state\", \"zip\", \"phone\", \"fax\") VALUES (DEFAULT, '$useremailpg', '$username', '$md5pass', FALSE, TRUE, '$lastlogintime', '$updated', '$orgname', '$address', '$address2', '$city', '$state', '$zip', '$phone', '$fax')";
pg_send_query($connection, $insertuser);
$res1 = pg_get_result($connection);
$pgerror1 = pg_result_error($res1);

if ($pgerror1!=FALSE) {
	require('header.php');
	echo "<h1>Save Error</h1><p>An error occured when you attempted to submit your user information. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
	require('footer.php');
	$to = "jd@nijel.org";
	$subject = "AZ Afterschool Program Directory Error: processnewprovider.php Failed";
	$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewprovider.php\nFailed Query: $insertuser\nError: $pgerror1";
	mail($to,$subject,$message);
	die ();
}else{}

$url = "http://azafterschool.org/directory/";
$to = "$useremail";
$subject = "Your Account Information for the AZ Afterschool Program Directory";
$message = "
Hello $username,
<br /><br />
Thank you for signing up for an account on the <a href=\"$url\">AZ Afterschool Program Directory</a>. You can now <a href=\"$url\">login</a> to the system to begin adding your out-of-school-time locations and sites. 
<br /><br />

Thanks,
<br />
Arizona Center for Afterschool Excellence
";
$headers = "From: Genevieve Burns <gburns@azafterschool.org> \r\n";
$headers .= "Content-type: text/html\r\n"; 
mail($to,$subject,$message,$headers);


?>

<?php
}else{
	echo "<h1>Invalid Email Address</h1><p>The email address you entered was invalid. Please go back and try again.</p><p>Email address entered: <b>$useremail</b></p>";
}

header('Location: http://maps.nijel.org/azcase/endnewprovider.php');
?>

