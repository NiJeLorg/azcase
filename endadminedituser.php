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
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];


// pull basic information for providers and store in varibles
$basicinfoquery = "SELECT 
userid,
username,
useremail,
firstlogin,
lastlogintime,
updated,
orgname,
address,
address2,
city,
state,
zip,
phone,
fax
FROM azcase_users WHERE userid = $userid;";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
	$username = pg_result($basicinforesult, $lt, 1);
	$useremail = pg_result($basicinforesult, $lt, 2);
	$firstlogin = pg_result($basicinforesult, $lt, 3);
	$lastlogintime = pg_result($basicinforesult, $lt, 4);
	$updated = pg_result($basicinforesult, $lt, 5);
	$orgname = pg_result($basicinforesult, $lt, 6);
	$orgaddress = pg_result($basicinforesult, $lt, 7);
	$orgaddress2 = pg_result($basicinforesult, $lt, 8);
	$orgcity = pg_result($basicinforesult, $lt, 9);
	$orgstate = pg_result($basicinforesult, $lt, 10);
	$orgzip = pg_result($basicinforesult, $lt, 11);
	$orgphone = pg_result($basicinforesult, $lt, 12);
	$orgfax = pg_result($basicinforesult, $lt, 13);
}

// format updated date
$updated = date("M j, Y", strtotime($updated));

// format address
$printorgaddress = $orgaddress;
if (!$orgaddress2) { 
	$printorgaddress .= '; '; 
}else{ 
	$printorgaddress .=  ' ' . $orgaddress2 . '; '; 
}
$printorgaddress .= $orgcity . ' ';
$printorgaddress .= $orgstate . ' ';
$printorgaddress .= $orgzip . ' '; 

$pagecontent = "
<body>
<h1>User Data Saved</h1>
<p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchusers.php?userid=$userid&searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your Search Results For Users</a></p>
<p>Thank you for updating this user's account information. Please check below to make sure the information is correct.</p>
<h1>User Account Information</h1>
<p><i>Last Updated:</i> $updated
<table class=\"hoursTable\">
	<tr>
		<td ><b>Name</b></td>
		<td>$username</td>
	</tr> 
	<tr class=\"alt\">
		<td ><b>Email</b></td>
		<td>$useremail</td>
	</tr> 
	<tr>
		<td ><b>Organization Name</b></td>
		<td>$orgname</td>
	</tr> 
	<tr class=\"alt\">
		<td ><b>Address</b></td>
		<td>$printorgaddress</td>
	</tr> 
	<tr>
		<td ><b>Phone</b></td>
		<td>$orgphone</td>
	</tr> 
	<tr class=\"alt\">
		<td ><b>Fax</b></td>
		<td>$orgfax</td>
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

