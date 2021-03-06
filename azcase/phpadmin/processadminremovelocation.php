<?php

session_start(); 

// connect to database
require("connect.php");

global $connection;


$locationid = $_REQUEST['locationid'];

// remove from duplicate record table
$removedup = "DELETE FROM azcase_admin_azcase_locations_duplicates WHERE locationid1_id = $locationid OR locationid2_id = $locationid;";
// remove silently
pg_send_query($connection, $removedup);


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


header("Location: https://azcase.nijel.org/php/endadminremovelocation.php");
?>

