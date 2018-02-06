<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// connect to database
require("connect.php");

// pull userid for ease of use later
$useremailsession = pg_escape_string($_SESSION['useremail']);
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

// loop though sites for this user and insert sites/users junction for new user
$assignloop = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
$assignloopresult = pg_query($connection, $assignloop);
for ($lt = 0; $lt < pg_numrows($assignloopresult); $lt++) {
	$userassignuserid = pg_result($assignloopresult, $lt, 0);
	if ($_REQUEST["$userassignuserid"]=='t') {
		// delete from junction table
		$assigndeletefrom = "DELETE FROM azcase_user_sites_junction WHERE userid = $userassignuserid AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
		pg_send_query($connection, $assigndeletefrom);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		// kill if error encountered
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Provider Dashboard</a></p><p>An error occured when you attempted to remove another user from manageing your data. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processremoveassignusers.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processremoveassignusers.php\nFailed Query: $assigndeletefrom\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

	}else{} // if assignuser
} // close siteid/userid insert loop

header("Location: https://azcase.nijel.org/phpsite/endremoveassignusers.php");
?>

