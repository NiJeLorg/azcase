<?php

session_start(); 

// connect to database
require("connect.php");

// grab data and clean up for database query and for return to last page
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];


// store email address submitted
$useremail = stripslashes($_REQUEST['useremail']);
$useremail = trim($useremail);


// check for valid email address
require('EmailAddressValidator.php');

$validator = new EmailAddressValidator;
if ($validator->check_email_address($useremail)) {
	// prep email for db
	$useremailpg = pg_escape_string($useremail);	

	/* Verify that user is in database */
	$countquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$useremailpg';";
	$countresult = pg_query($connection, $countquery);
	$countemail = pg_result($countresult, 0, 0);

	if ($countemail>0) {
		/* Notify that no email exists and kill script */
		require('header.php');
		echo "<h3>Email Address Already in Use</h3><p>The email address you entered is already in use in the system. If you need to request a new password using that email address <a href=\"https://azcase.nijel.org/php/forgotpassword.php\">go here</a>. If you'd like to sign up will a different email account, please go back and try again with another email address.</p><p>Email address entered: <strong>$useremail</strong></p>";
		require('footer.php');
		die();
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

// set dummy temporary password so noone can get in until this user has requested a new password
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

// create random temp-pass so user can change their password
$randomtemppass = generateRandomString();
$md5temppass = md5($randomtemppass);



// set updated
$lastlogintime = date('Y-m-d H:i:s');
$updated = date('Y-m-d H:i:s');

// add new user to users table
$insertuser = "INSERT INTO azcase_users (\"userid\", \"useremail\", \"username\", \"password\", \"admin\", \"firstlogin\", \"lastlogintime\", \"updated\", \"orgname\", \"address\", \"address2\", \"city\", \"state\", \"zip\", \"phone\", \"fax\", \"temp_pass\") VALUES (DEFAULT, '$useremailpg', '$username', '$md5pass', FALSE, TRUE, '$lastlogintime', '$updated', '$orgname', '$address', '$address2', '$city', '$state', '$zip', '$phone', '$fax', '$md5temppass')";
pg_send_query($connection, $insertuser);
$res1 = pg_get_result($connection);
$pgerror1 = pg_result_error($res1);

if ($pgerror1!=FALSE) {
	require('header.php');
	echo "<h3>Save Error</h3><p>An error occured when you attempted to submit your user information. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
	require('footer.php');
	$to = "jd@nijel.org";
	$subject = "AZ Afterschool Program Directory Error: adminprocessassignusers.php Failed";
	$message = "\nPage: adminprocessassignusers.php\nFailed Query: $insertuser\nError: $pgerror1";
	mail($to,$subject,$message);
	die ();
}else{}

// pull userid
$newuseridquery = "SELECT userid FROM azcase_users WHERE useremail = '$useremailpg';";
$newuseridresult = pg_query($connection, $newuseridquery);
for ($lt = 0; $lt < pg_numrows($newuseridresult); $lt++) {
	$userassignuserid = pg_result($newuseridresult, $lt, 0);
}

// loop though sites for this user and insert sites/users junction for new user
$assignloop = "SELECT siteid FROM azcase_user_sites_junction WHERE userid IN (SELECT userid FROM azcase_users WHERE userid = $userid);";
$assignloopresult = pg_query($connection, $assignloop);
for ($lt = 0; $lt < pg_numrows($assignloopresult); $lt++) {
	$userassignsiteid = pg_result($assignloopresult, $lt, 0);
	// insert into junction table
	$assigninsertinto = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\") VALUES ('$userassignuserid', '$userassignsiteid');";
	pg_send_query($connection, $assigninsertinto);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	// kill if error encountered
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a> | <a href=\"adminsearchusers.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your User Search Results</a></p><p>An error occured when you attempted to assign another user to manage data. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: adminprocessassignusers.php Failed";
		$message = "\nPage: adminprocessassignusers.php\nFailed Query: $assigninsertinto\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

} // close siteid/userid insert loop


$url = "https://azcase.nijel.org/php/resetpassword.php?42=$randomtemppass";
$to = "$useremail";
$subject = "AZ Afterschool Program Directory | New Account and Access to Data for $orgname";
$message = "
Hello $username,
<br /><br />
The AZ Afterschool Program Directory administrator created an account for you and has given you acccess to manage the data for $orgname in the AZ Afterschool Program Directory. Please visit the link below to create a new password for you, after which you can log in to the directory and begin managing data for $orgname. Thanks!
<br /><br />
<a href=\"$url\">$url</a>
<br /><br />
Thanks,
<br />
Arizona Center for Afterschool Excellence
";
$headers = "From: AzCASE <azcase.directory@gmail.com> \r\n";
$headers .= "Content-type: text/html\r\n"; 
mail($to,$subject,$message,$headers);

?>

<?php
}else{
	echo "<h3>Invalid Email Address</h3><p>The email address you entered was invalid. Please go back and try again.</p><p>Email address entered: <strong>$useremail</strong></p>";
}

header("Location: https://azcase.nijel.org/php/endadminassignusers.php?useremail=$useremail&userid=$userid&searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname");
?>

