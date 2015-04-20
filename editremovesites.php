<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// login to the system
require('login.php');

// create header
require('header.php');

// processing login script
displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// pull userid for ease of use later

$useremailsession = pg_escape_string($_SESSION['useremail']);
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

// call different scripts fi edit or remove was selected

//update new sites
//if action = Save For THIS Summer Site and Continue &#62;&#62; then save this site and pass header back to newsummersites
if (!$_REQUEST['remove']) {
	require('editbatchsites.php');
}elseif (!$_REQUEST['edit']) {
	require('removebatchsites.php');
}else{}


// close logged_in
}else{}

// create footer
require('footer.php');


?>

