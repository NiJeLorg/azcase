<?php
// connect to database
require("connect.php");
$timestamp = date("Y-m-d H:i:s");
$timestamp = "'$timestamp'";

// pull userid for ease of use later
$basicinfoquery = "SELECT 
userid
FROM azcase_users;";

$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);

// If there is a check box in the box named with the userid update the user's rewemail and sites updated times to now
if ($_REQUEST["$userid"]=='t') {

$setreneweddate = 'UPDATE azcase_users SET renewalemail = '.$timestamp.' WHERE userid='.$userid.';';


pg_send_query($connection, $setreneweddate);

$updatesitesdate = 'UPDATE azcase_sites SET updated = '.$timestamp.' WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid='.$userid.');'; 

pg_send_query($connection, $updatesitesdate);

// send former page back with a true to confirm update
$renewed = "true";
}else{}

//close loop
}

header("Location: http://maps.nijel.org/azcase/emailalertstatus.php?renew=$renewed");

?>
