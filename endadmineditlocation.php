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

// bring search data across
$locationid = $_REQUEST['locationid'];
$zoom = $_REQUEST['zoom'];
$searchstreet = $_REQUEST['searchstreet'];
$searchcity = $_REQUEST['searchcity'];
$searchstate = $_REQUEST['searchstate'];
$searchzip = $_REQUEST['searchzip'];


// pull basic information for providers and store in varibles
$locationquery = "SELECT name, namesp, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid;";
$record = pg_query($connection, $locationquery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
    $name = pg_result($record, $lt, 0);
    $namesp = pg_result($record, $lt, 1);
    $address = pg_result($record, $lt, 2);
    $address2 = pg_result($record, $lt, 3);
    $city = pg_result($record, $lt, 4);
    $state = pg_result($record, $lt, 5);
    $zip = pg_result($record, $lt, 6);
}

$pagecontent = "
<body>
<h1>Location Data Saved</h1>
<p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchlocations.php?zoom=$zoom&searchstreet=$searchstreet&searchcity=$searchcity&searchstate=$searchstate&searchzip=$searchzip\">&#60;&#60; Back to Your Search Results For Locations</a></p>
<p>Thank you for updating this location. Please check below to make sure the information is correct.</p>
<h1>Location Information</h1>
<p>
<table class=\"hoursTable\">
	<tr>
		<td ><b>Location Name</b></td>
		<td>$name</td>
	</tr> 
	<tr class=\"alt\">
		<td ><b>Location Name (Espanol)</b></td>
		<td>$namesp</td>
	</tr> 
	<tr>
		<td ><b>Address</b></td>
		<td>$address</td>
	</tr> 
	<tr class=\"alt\">
		<td ><b>Address Line 2</b></td>
		<td>$address2</td>
	</tr> 
	<tr>
		<td ><b>City</b></td>
		<td>$city</td>
	</tr> 
	<tr class=\"alt\">
		<td ><b>State</b></td>
		<td>$state</td>
	</tr> 

	<tr class=\"alt\">
		<td ><b>Zip</b></td>
		<td>$zip</td>
	</tr> 
</table>
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

