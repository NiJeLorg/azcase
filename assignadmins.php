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
$email = stripslashes($_REQUEST['email']);
$email = trim($email);


// check for valid email address
require('EmailAddressValidator.php');

$validator = new EmailAddressValidator;
if ($validator->check_email_address($email)) {

// search for the email in the database. if the email doesn't exist, ask user to try again or sign up for a new account.

// check to see if user entered their own email address and return an error
if ($email==$_SESSION['useremail']) {
	require('header.php');
	echo "<h1>This Account's Email Address Entered</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Provider Dashboard</a> | <a href=\"editprovider.php\">&#60;&#60; Back to Editing Your Organizational Information</a></p><p>You entered the email address for your account in the previous step. Please go back and enter a different email address. Thanks!</p>";
	require('footer.php');
	die();
}else{}

$emailpg = pg_escape_string($email);
$emailsession = pg_escape_string($_SESSION['useremail']);

/* If user is not in system, have provider create a new account for that user */
$countusersquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$emailpg';";
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
	FROM azcase_users WHERE useremail = '$emailsession';";
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
	echo "<body><h1>Add New User to Administer the AZ Afterschool Program Directory</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Provider Dashboard</a> | <a href=\"adminsettings.php\">&#60;&#60; Back to Admin Settings</a></p><p><b>$email</b> does not currently have an account in our system. If you would like to assign $email to administer this system, please sign $email up for an account below.</p>";
	echo "<span class=\"required\">* Required</span>
<form name=\"editprovider\" action=\"processassignadminusers.php\" method=\"POST\" onSubmit=\"return validateForm();\">
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
	$updateuser = "UPDATE azcase_users SET admin = TRUE WHERE useremail = '$emailpg';";
	pg_send_query($connection, $updateuser);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h1>Save Error</h1><p>An error occured when you attempted to submit your user information. An email was sent to NiJeL and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: assignadmins.php Failed";
		$message = "User:" . $_SESSION['useremail'] . "\nPage: assignadmins.php\nFailed Query: $updateuser\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}


	echo "<body><h1>User Assigned to Administer the AZ Afterschool Program Directory</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Provider Dashboard</a> | <a href=\"adminsettings.php\">&#60;&#60; Back to Admin Settings</a></p><p>The user $email has been assigned to administer the AZ Afterschool Program Directory, and an email has been sent to them to let them know. Please have them log in to the system to begin administering the system, and please <a href=\"ticketing.php\">report any issues</a> that you may have. Thanks!</p>";


	/* Send email lettign new user know they've been assigned to manage data  */
	$subject = "AZ Afterschool Program Directory | You Have Been Granted Administrative Access";
	$headers = "From: Genevieve Burns <gburns@azafterschool.org> \r\n";
	$headers .= "Content-type: text/html\r\n"; 
	$url = "http://azafterschool.org/directory/";

	$message = "
Hello $email,
<br /><br />
You've been given access by " .  $_SESSION['useremail'] . " to administer the AZ Afterschool Program Directory. Please visit the link below and log in to the system to access the administrative area. 
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

// close logged_in
}else{}

// create footer
require('footer.php');

echo $assignjs;
?>

