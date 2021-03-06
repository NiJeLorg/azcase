<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

global $connection;

// grab data and clean up for database query and for return to last page
$userid = $_REQUEST['userid'];

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
		echo "<body><h3 class=\"azcase-text-color\">Add New User to Assist in Managing Data</h3><p><strong>$email</strong> does not currently have an account in our system. If you would like to assign $email to assist in managing data, please sign $email up for an account below.</p>";
		echo "<a class=\"btn btn-default\" href=\"/addUsers/\" role=\"button\">Add A User</a>";

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
			echo "<h3 class=\"azcase-text-color\">User Already Assigned to Manage Data for $username ($useremail)</h3><p>You attempted to assign a user that was already assigned to manage data for $username ($useremail). Please go back and select another email address. Thanks!</p>";
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
					echo "<h3>Save Error</h3><p>An error occured when you attempted to assign another user to manage your data. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
					require('footer.php');
					$to = "jd@nijel.org";
					$subject = "AZ Afterschool Program Directory Error: adminassignusers.php Failed";
					$message = "\nPage: adminassignusers.php\nFailed Query: $assigninsertinto\nError: $pgerror1";
					mail($to,$subject,$message);
					die ();
				}else{}

			} // close siteid/userid insert loop
		} // close if ($countjunc>0) {

		echo "<body><h3 class=\"azcase-text-color\">User Assigned to Manage Data for $username ($useremail)</h3><p>The user $email has been assigned to managing data with $username ($useremail), and an email has been sent to them to let them know. Please have them log in to the system to review these data. Thanks!</p>";

		$basicinfoquery = "SELECT 
		orgname
		FROM azcase_users WHERE userid = $userid;";
		$basicinforesult = pg_query($connection, $basicinfoquery);
		for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
			$orgname = pg_result($basicinforesult, $lt, 0);
		}


		/* Send email lettign new user know they've been assigned to manage data  */
		$subject = "AZ Afterschool Program Directory | Access to Data for $orgname";
		$headers = "From: AzCASE <azcase.directory@gmail.com> \r\n";
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
	echo "<h3 class=\"azcase-text-color\">Invalid Email Address</h3><p>The email address you entered was invalid. Please go back and try again.</p><p>Email address entered: <strong>$email</strong></p>";
}


// create footer
require('footer.php');

?>

