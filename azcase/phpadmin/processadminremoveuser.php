<?php

session_start(); 

// connect to database
require("connect.php");

global $connection;

// bring search data across
$userid = $_REQUEST['userid'];

// remove from duplicate record table
$removedup = "DELETE FROM azcase_admin_azcase_users_duplicates WHERE userid1_id = $userid OR userid2_id = $userid;";
// remove silently
pg_send_query($connection, $removedup);

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


header("Location: http://azcase.nijel.org/php/endadminremoveuser.php");
?>

