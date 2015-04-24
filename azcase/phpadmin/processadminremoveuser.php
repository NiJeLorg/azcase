<?php

session_start(); 

// connect to database
require("connect.php");

global $connection;

// bring search data across
$userid = $_REQUEST['userid'];

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


header("Location: http://104.131.19.183/php/endadminremoveuser.php");
?>

