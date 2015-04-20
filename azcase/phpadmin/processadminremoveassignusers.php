<?php

session_start(); 

// connect to database
require("connect.php");

// grab data and clean up for database query and for return to last page
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];

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
			echo "<h3>Save Error</h3><p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a> | <a href=\"adminsearchusers.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your User Search Results</a></p><p>An error occured when you attempted to remove another user from manageing your data. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processadminremoveassignusers.php Failed";
			$message = "\nPage: processadminremoveassignusers.php\nFailed Query: $assigndeletefrom\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

	}else{} // if assignuser
} // close siteid/userid insert loop

header("Location: http://maps.nijel.org/azcase_dev/azcase/phpadmin/endadminremoveassignusers.php?userid=$userid&searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname");
?>

