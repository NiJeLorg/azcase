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
$zoom = $_REQUEST['zoom'];
$searchstreet = $_REQUEST['searchstreet'];
$searchcity = $_REQUEST['searchcity'];
$searchstate = $_REQUEST['searchstate'];
$searchzip = $_REQUEST['searchzip'];


$pagecontent = "
<body>
<h1>Location Removed</h1>
<p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchlocations.php?zoom=$zoom&searchstreet=$searchstreet&searchcity=$searchcity&searchstate=$searchstate&searchzip=$searchzip\">&#60;&#60; Back to Your Search Results For Locations</a></p>
<p>The location was sucessfully removed. From here, you can <a href=\"providerhome.php\">go back</a> to your admin dashboard or <a href=\"adminsearchlocations.php?zoom=$zoom&searchstreet=$searchstreet&searchcity=$searchcity&searchstate=$searchstate&searchzip=$searchzip\">go back</a> to your site search results. Thanks!</p>
<br />
";

echo $pagecontent;

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');
?>

