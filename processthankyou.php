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

$thankyou = $_REQUEST['thankyou'];

if ($thankyou==1 || !$thankyou) {
	header("Location: http://maps.nijel.org/azcase_dev/providerhome.php");
}elseif ($thankyou==2) {
	header("Location: http://maps.nijel.org/azcase_dev/newsites.php");
}else{}


// close logged_in
}else{}

?>
