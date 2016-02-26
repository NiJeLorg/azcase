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

$siteid = $_REQUEST['siteid'];
$siteid_old = $_REQUEST['siteid_old'];
$locationid = $_REQUEST['locationid'];
$locationid_old = $_REQUEST['locationid_old'];

// pull userid for ease of use later
$useremailsession = pg_escape_string($_SESSION['useremail']);
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

// pull site name and location
$sitenamequery = "SELECT name FROM azcase_sites WHERE siteid = $siteid;";
$sitenameresult = pg_query($connection, $sitenamequery);
for ($lt = 0; $lt < pg_numrows($sitenameresult); $lt++) {
	$sitename = pg_result($sitenameresult, $lt, 0);
}

$locationquery = "SELECT name, address, address2, city, state, zip, locationid FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteid);";
$locationresult = pg_query($connection, $locationquery);
for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
	$locationname = pg_result($locationresult, $lt, 0);
	$address = pg_result($locationresult, $lt, 1);
	$address2 = pg_result($locationresult, $lt, 2);
	$city = pg_result($locationresult, $lt, 3);
	$state = pg_result($locationresult, $lt, 4);
	$zip = pg_result($locationresult, $lt, 5);		
	$locationid = pg_result($locationresult, $lt, 6);		
}
// format address
$printaddress = $address;
if (!$address2) { 
	$printaddress .=  '; '; 
}else{ 
	$printaddress .=  ' ' . $address2 . '; ';
}
if (!$city) { 
}else{ 
	$printaddress .= $city . ' ';
}
if (!$state) { 
}elseif (!$zip) {
	$printaddress .= $state;	
}else{ 
	$printaddress .= $state . ' ';
}
if (!$zip) { 
}else{ 
	$printaddress .= $zip; 
}

?>
<body>
<h1>Edit Additional Information for <?php echo $sitename; ?></h1>
<p>Please complete this form below for the site, <b><?php echo $sitename; ?></b>, located at <b><?php echo $locationname; echo ' (' . $printaddress . ')'; ?></b>. Please note that these forms are <i>optional</i>, but the data you enter below will greatly assist the Arizona Center for Afterschool Excellence in our advocacy work. Thanks!</p>
<?php

// add in the new locations form
require('editsitesurveyform.php'); 

// close logged_in
}else{}

// create footer
require('footer.php');

?>

<script type="text/javascript">
function toggle(obj) {
	var el = document.getElementById(obj);
	if ( el.style.display == 'none' ) {
		el.style.display = '';
	}
	else {
	}
}

</script>






