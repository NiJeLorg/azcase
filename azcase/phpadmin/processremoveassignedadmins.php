<?php

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
$assignloop = "SELECT userid FROM azcase_users WHERE userid <> $userid AND admin = TRUE;";
$assignloopresult = pg_query($connection, $assignloop);
for ($lt = 0; $lt < pg_numrows($assignloopresult); $lt++) {
	$userassignuserid = pg_result($assignloopresult, $lt, 0);
	if ($_REQUEST["$userassignuserid"]=='t') {
		// delete from junction table
		$assignquery = "UPDATE azcase_users SET admin = FALSE WHERE userid = $userassignuserid;";
		pg_send_query($connection, $assignquery);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		// kill if error encountered
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a></p><p>An error occured when you attempted to remove an administrator from the system. An email was sent to NiJeL and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processremoveassignedadmins.php Failed";
			$message = "\nPage: processremoveassignedadmins.php\nFailed Query: $assignquery\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

	}else{} // if assignuser
} // close siteid/userid insert loop

header("Location: http://maps.nijel.org/azcase_dev/azcase/phpadmin/endremoveassignedadmins.php");
?>

