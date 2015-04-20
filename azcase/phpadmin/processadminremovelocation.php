<?php

session_start(); 

// connect to database
require("connect.php");

global $connection;


$locationid = $_REQUEST['locationid'];

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


header("Location: http://maps.nijel.org/azcase_dev/azcase/phpadmin/endadminremovelocation.php");
?>

