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

global $connection;
/* Verify that user partner is admin or not */
$useremailsession = pg_escape_string($_SESSION['useremail']);
$partnerquery = "SELECT admin FROM azcase_users WHERE useremail = '$useremailsession';";
$result = pg_query($connection, $partnerquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$admin = pg_result($result, $lt, 0);
}

if ($admin=='t') {

// bring search data across
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];


// remove user associations with locations
$removeuserloc = "DELETE FROM azcase_user_locations_junction WHERE userid = $userid;";
// remove silently
pg_send_query($connection, $removeuserloc);

// remove user associations with sites
$removeusersites = "DELETE FROM azcase_user_sites_junction WHERE userid = $userid;";
// remove silently
pg_send_query($connection, $removeusersites);

// remove user 
$removeuser = "DELETE FROM azcase_users WHERE userid = $userid;";
// remove silently
pg_send_query($connection, $removeuser);

// close admin = TRUE
}else{}

// close logged_in
}else{}


header("Location: http://maps.nijel.org/azcase_dev/endadminremoveuser.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname");
?>

