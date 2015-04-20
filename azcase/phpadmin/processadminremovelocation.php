<?php

session_start(); 

// connect to database
require("connect.php");

// login to the system
require('login.php');

// processing login script
//displayLogin();

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
// bring search data across
$locationid = $_REQUEST['locationid'];
$zoom = $_REQUEST['zoom'];
$searchstreet = $_REQUEST['searchstreet'];
$searchcity = $_REQUEST['searchcity'];
$searchstate = $_REQUEST['searchstate'];
$searchzip = $_REQUEST['searchzip'];


// remove user associations with locations
$removeusersite = "DELETE FROM azcase_user_locations_junction WHERE locationid = $locationid;";
// remove silently
pg_send_query($connection, $removeusersite);

// remove site associations with locations
$removelocsite = "DELETE FROM azcase_sites_locations_junction WHERE locationid = $locationid;";
// remove silently
pg_send_query($connection, $removelocsite);

// remove site survey data with this location
$removesitesurvey = "DELETE FROM azcase_site_survey WHERE locationid = $locationid;";
// remove silently
pg_send_query($connection, $removesitesurvey);

// remove site 
$removelocation = "DELETE FROM azcase_locations WHERE locationid = $locationid;";
// remove silently
pg_send_query($connection, $removelocation);

// close admin = TRUE
}else{}

// close logged_in
}else{}


header("Location: http://maps.nijel.org/azcase_dev/azcase/phpadmin/endadminremovelocation.php?zoom=$zoom&searchstreet=$searchstreet&searchcity=$searchcity&searchstate=$searchstate&searchzip=$searchzip");
?>

