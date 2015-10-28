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

// pull userid for ease of use later
$useremailsession = pg_escape_string($_SESSION['useremail']);
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

// set updated
$updated = date('Y-m-d H:i:s');

// create loop to dertermine whihc sites where chosen
$siteidloopquery = "SELECT siteid FROM azcase_sites WHERE (verified = 1 OR verified = 2) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
$siteidloopresult = pg_query($connection, $siteidloopquery);
for ($lt = 0; $lt < pg_numrows($siteidloopresult); $lt++) {
	$siteidloop = pg_result($siteidloopresult, $lt, 0);
	if ($_REQUEST["$siteidloop"]=='t') {

		//update site to set summer = FALSE and set newsite in junction table to FALSE
		$updatesite = "UPDATE azcase_sites SET updated = '$updated', verified = 3 WHERE siteid = $siteidloop;";
		pg_send_query($connection, $updatesite);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to remove a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $updatesite\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

	}else{} // close if ($_REQUEST["$siteidloop"]=='t')
} // close for loop

// close logged_in
}else{}


header("Location: http://azcase.nijel.org/phpsite/thankyouremovebatchsite.php");
?>

