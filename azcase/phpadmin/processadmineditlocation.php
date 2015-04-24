<?php

session_start(); 

// connect to database
require("connect.php");


global $connection;

// bring search data across
$locationid = $_REQUEST['locationid'];

// bring in other entered data
$locationname = stripslashes($_REQUEST['locationname']);
$locationnamesp = stripslashes($_REQUEST['locationnamesp']);
$address = stripslashes($_REQUEST['address']);
$address2 = stripslashes($_REQUEST['address2']);
$city = stripslashes($_REQUEST['city']);
$state = stripslashes($_REQUEST['state']);
$zip = stripslashes($_REQUEST['zip']);

$locationname = pg_escape_string($locationname);
$locationnamesp = pg_escape_string($locationnamesp);
$address = pg_escape_string($address);
$address2 = pg_escape_string($address2);
$city = pg_escape_string($city);
$state = pg_escape_string($state);
$zip = pg_escape_string($zip);


// set updated
$updated = date('Y-m-d H:i:s');

// if the user changed email addresses - update email in azcase_users and log user out in next script

$updatelocation = "UPDATE azcase_locations SET \"updated\" = '$updated', \"name\" = '$locationname', \"namesp\" = '$locationnamesp', \"address\" =  '$address', \"address2\" = '$address2', \"city\" = '$city', \"state\" = '$state', \"zip\"= '$zip', \"lat\" = NULL, \"lon\" = NULL, the_geom = NULL WHERE locationid = $locationid;";
pg_send_query($connection, $updatelocation);
$res1 = pg_get_result($connection);
$pgerror1 = pg_result_error($res1);

if ($pgerror1!=FALSE) {
	require('header.php');
	echo "<h3>Save Error</h3><p>An error occured when you attempted to submit your information. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
	require('footer.php');
	$to = "jd@nijel.org";
	$subject = "AZ Afterschool Program Directory Error: processadmineditlocation.php Failed";
	$message = "\nPage: processadmineditlocation.php\nFailed Query: $updatelocation\nError: $pgerror1";
	mail($to,$subject,$message);
	die ();
}else{}

// geocode data after location update
require('geocode.php');


header("Location: http://104.131.19.183/php/endadmineditlocation.php");
?>

