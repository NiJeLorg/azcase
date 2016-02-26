<?php
ini_set('session.cache_limiter', 'nocache');
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
$siteid = $_REQUEST['siteid'];
$searchname = $_REQUEST['searchname'];
$searchemail = $_REQUEST['searchemail'];
$searchphone = $_REQUEST['searchphone'];


// remove user associations with sites
$removeusersite = "DELETE FROM azcase_user_sites_junction WHERE siteid = $siteid;";
// remove silently
pg_send_query($connection, $removeusersite);

// remove site associations with locations
$removelocsite = "DELETE FROM azcase_sites_locations_junction WHERE siteid = $siteid;";
// remove silently
pg_send_query($connection, $removelocsite);

// remove site survey data
$removesitesurvey = "DELETE FROM azcase_site_survey WHERE siteid = $siteid;";
// remove silently
pg_send_query($connection, $removesitesurvey);

// remove site 
$removesite = "DELETE FROM azcase_sites WHERE siteid = $siteid;";
// remove silently
pg_send_query($connection, $removesite);

// close admin = TRUE
}else{}

// close logged_in
}else{}


header("Location: http://azcase.nijel.org/phpsite/endadminremovesite.php?searchname=$searchname&searchemail=$searchemail&searchphone=$searchphone");
?>

