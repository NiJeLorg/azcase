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
//require('header.php');

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


// accept site id
$locationid = $_REQUEST['locationid'];

// grab search terms if coming from search page
$zoom = $_REQUEST['zoom'];
$searchstreet = $_REQUEST['searchstreet'];
$searchcity = $_REQUEST['searchcity'];
$searchstate = $_REQUEST['searchstate'];
$searchzip = $_REQUEST['searchzip'];


?>
<body>
<h1>Admin Edit Location</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="adminsearchlocations.php?zoom=<?php echo $zoom; ?>&searchstreet=<?php echo $searchstreet; ?>&searchcity=<?php echo $searchcity; ?>&searchstate=<?php echo $searchstate; ?>&searchzip=<?php echo $searchzip; ?>">&#60;&#60; Back to Your Search Results For Locations</a></p>
<p>Please edit any data below. Thanks!</p>
<?php

// add in the new locations form
require('admineditlocationform.php'); 

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');


?>
