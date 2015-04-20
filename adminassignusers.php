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

global $connection;
/* Verify that user partner is admin or not */
$useremailsession = pg_escape_string($_SESSION['useremail']);
$partnerquery = "SELECT admin FROM azcase_users WHERE useremail = '$useremailsession';";
$result = pg_query($connection, $partnerquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$admin = pg_result($result, $lt, 0);
}

if ($admin=='t') {

// grab data and clean up for database query and for return to last page
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];

// get data for user id passed
$basicinfoquery = "SELECT 
username,
useremail
FROM azcase_users WHERE userid = $userid;";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$username = pg_result($basicinforesult, $lt, 0);
	$useremail = pg_result($basicinforesult, $lt, 1);
}



// store email address submitted
$email = stripslashes($_REQUEST['email']);
$email = trim($email);


// check for valid email address
require('EmailAddressValidator.php');

$validator = new EmailAddressValidator;
if ($validator->check_email_address($email)) {

// search for the email in the database. if the email doesn't exist, ask user to try again or sign up for a new account.
if(!get_magic_quotes_gpc()){
	$email = addslashes($email);
}

// check to see if user entered their own email address and return an error
if ($email==$_SESSION['useremail']) {
	require('header.php');
	echo "<h1>This Account's Email Address Entered</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Provider Dashboard</a> | <a href=\"editprovider.php\">&#60;&#60; Back to Editing Your Organizational Information</a></p><p>You entered the email address for your account in the previous step. Please go back and enter a different email address. Thanks!</p>";
	require('footer.php');
	die();
}else{}

/* If user is not in system, have provider create a new account for that user */
$countusersquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$email';";
$countusersresult = pg_query($connection, $countusersquery);
$countusers = pg_result($countusersresult, 0, 0);

if ($countusers==0) {
	// select data from this user to populate for new user
	$basicinfoquery = "SELECT 
	orgname,
	address,
	address2,
	city,
	state,
	zip,
	phone,
	fax
	FROM azcase_users WHERE userid = $userid;";
	$basicinforesult = pg_query($connection, $basicinfoquery);
	for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
		$orgname = pg_result($basicinforesult, $lt, 0);
		$address = pg_result($basicinforesult, $lt, 1);
		$address2 = pg_result($basicinforesult, $lt, 2);
		$city = pg_result($basicinforesult, $lt, 3);
		$state = pg_result($basicinforesult, $lt, 4);
		$zip = pg_result($basicinforesult, $lt, 5);
		$phone = pg_result($basicinforesult, $lt, 6);
		$fax = pg_result($basicinforesult, $lt, 7);
	}
	
	// create form for new user
	echo "<body><h1>Add New User to Assist in Managing Data</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a> | <a href=\"adminsearchusers.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your User Search Results</a></p><p><b>$email</b> does not currently have an account in our system. If you would like to assign $email to assist in managing data, please sign $email up for an account below.</p>";
	echo "<span class=\"required\">* Required</span>
<form name=\"editprovider\" action=\"processadminassignusers.php\" method=\"POST\" onSubmit=\"return validateForm();\">
<input type=\"hidden\" name=\"userid\" value=\"$userid\">
<input type=\"hidden\" name=\"searchusername\" value=\"$searchusername\">
<input type=\"hidden\" name=\"searchuseremail\" value=\"$searchuseremail\">
<input type=\"hidden\" name=\"searchorgname\" value=\"$searchorgname\">
<table cellpadding=\"2\">
	<tr>
		<td align=\"right\" width=\"125\"><b>Their Name: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"username\" value=\"\" /><span class=\"required\">*</span></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Their Email: </b></td>
		<td align=\"left\"><input type=\"email\" name=\"useremail\" value=\"$email\" /><span class=\"required\">* This will be their login id.</span></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Password: </b></td>
		<td align=\"left\">User will set their new password later.</a></td>
	</tr>	
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Organization Name: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"orgname\" value=\"$orgname\" /></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Address: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"address\" value=\"$address\" /></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Address Line 2: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"address2\" value=\"$address2\" /></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>City: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"city\" value=\"$city\" /></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>State: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"state\" size = \"2\" value=\"$state\" /></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Zip: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"zip\" size = \"10\" value=\"$zip\" /></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Phone: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"phone\" size = \"10\" value=\"$phone\" /></td>
	</tr>
	<tr>
		<td align=\"right\" width=\"125\"><b>Fax: </b></td>
		<td align=\"left\"><input type=\"text\" name=\"fax\" size = \"10\" value=\"$fax\" /></td>
	</tr>
	<tr>
		<td colspan=\"2\" align=\"right\"><input type=\"image\" src=\"save.jpg\" alt=\"Save\" name=\"action\" value=\"Save\" /></td>
	</tr>
	</table>
<br />
</p>
</form>
";

$assignjs = "
<!-- validate that the fields are identical -->
<script type=\"text/javascript\" language=\"JavaScript\">

function validateForm() {
var username = document.editprovider.username.value;
var useremail = document.editprovider.useremail.value;

if (username.length < 1) {
        alert(\"Please enter your name.\");
	document.editprovider.username.focus();
        return false;
    }

if (useremail.length < 1) {
        alert(\"Please enter an email address.\");
	document.editprovider.useremail.focus();
        return false;
    }

return true;

}

</script>
";


}else{
// if a user is in the system already, loop through the current users linkages to sites and assign these sites to the new user
	// pull userid
	$newuseridquery = "SELECT userid FROM azcase_users WHERE useremail = '$email';";
	$newuseridresult = pg_query($connection, $newuseridquery);
	for ($lt = 0; $lt < pg_numrows($newuseridresult); $lt++) {
		$userassignuserid = pg_result($newuseridresult, $lt, 0);
	}

	// if user has already been assigned to manage these data, then say so
	$countjuncquery = "SELECT count(*) FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userassignuserid) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid IN (SELECT userid FROM azcase_users WHERE userid = $userid));";
	$countjuncresult = pg_query($connection, $countjuncquery);
	$countjunc = pg_result($countjuncresult, 0, 0);

	if ($countjunc>0) {
		require('header.php');
		echo "<h1>User Already Assigned to Manage Data for $username ($useremail)</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a> | <a href=\"adminsearchusers.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your User Search Results</a></p><p>You attempted to assign a user that was already assigned to manage data for $username ($useremail). Please go back and select another email address. Thanks!</p>";
		require('footer.php');
		die ();
	}else{
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
				echo "<h1>Save Error</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a> | <a href=\"adminsearchusers.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your User Search Results</a></p><p>An error occured when you attempted to assign another user to manage your data. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
				require('footer.php');
				$to = "jd@nijel.org";
				$subject = "AZ Afterschool Program Directory Error: adminassignusers.php Failed";
				$message = "User:" . $_SESSION['useremail'] . "\nPage: adminassignusers.php\nFailed Query: $assigninsertinto\nError: $pgerror1";
				mail($to,$subject,$message);
				die ();
			}else{}

		} // close siteid/userid insert loop
	} // close if ($countjunc>0) {

	echo "<body><h1>User Assigned to Manage Data for $username ($useremail)</h1><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a> | <a href=\"adminsearchusers.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your User Search Results</a></p><p>The user $email has been assigned to managing data with $username ($useremail), and an email has been sent to them to let them know. Please have them log in to the system to review these data. Thanks!</p>";

	$basicinfoquery = "SELECT 
	orgname
	FROM azcase_users WHERE userid = $userid;";
	$basicinforesult = pg_query($connection, $basicinfoquery);
	for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
		$orgname = pg_result($basicinforesult, $lt, 0);
	}


	/* Send email lettign new user know they've been assigned to manage data  */
	$subject = "AZ Afterschool Program Directory | Access to Data for $orgname";
	$headers = "From: Genevieve Burns <gburns@azafterschool.org> \r\n";
	$headers .= "Content-type: text/html\r\n"; 
	$url = "http://azafterschool.org/directory/";

	$message = "
Hello $email,
<br /><br />
You've been given access by an AZ Afterschool Program Directory administrator to manage the data for $orgname in the Directory. Please visit the link below and log in to the system to access these data. 
<br /><br />
<a href=\"$url\">$url</a>
<br /><br />
Thanks,
<br />
Arizona Center for Afterschool Excellence
	";
	
	mail($email,$subject,$message,$headers);

} // close countusers 


}else{
	echo "<h1>Invalid Email Address</h1><p>The email address you entered was invalid. Please go back and try again.</p><p>Email address entered: <b>$email</b></p>";
}


// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

echo $assignjs;
?>

