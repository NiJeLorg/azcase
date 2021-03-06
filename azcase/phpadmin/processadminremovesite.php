<?php

session_start(); 

// connect to database
require("connect.php");

global $connection;

// bring search data across
$siteid = $_REQUEST['siteid'];

// remove from duplicate record table
$removedup = "DELETE FROM azcase_admin_azcase_sites_duplicates WHERE siteid1_id = $siteid OR siteid2_id = $siteid;";
// remove silently
pg_send_query($connection, $removedup);

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


header("Location: https://azcase.nijel.org/php/endadminremovesite.php");
?>

