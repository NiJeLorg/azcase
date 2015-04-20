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


// grab data and clean up for database query and for return to last page
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];

// pass new email
$useremail = $_REQUEST['useremail'];

// get data for user id passed
$basicinfoquery = "SELECT 
username,
useremail
FROM azcase_users WHERE userid = $userid;";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$username = pg_result($basicinforesult, $lt, 0);
	$useremail1 = pg_result($basicinforesult, $lt, 1);
}

?>
<body>
<h1>Users Removed from Managing Data for <?php echo $username; ?> (<?php echo $useremail1; ?>)</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="adminsearchhome.php">&#60;&#60; Back to Search For Users, Sites and Locations</a> | <a href="adminsearchusers.php?searchusername=<?php echo $searchusername; ?>&searchuseremail=<?php echo $searchuseremail; ?>&searchorgname=<?php echo $searchorgname; ?>">&#60;&#60; Back to Your User Search Results</a></p>

<?php

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');
?>

