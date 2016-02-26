<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require("header.php");

$useremailsession = pg_escape_string($_SESSION['useremail']);
// check to see if user changed their email - if so log out and if not print new data
$countquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$useremailsession';";
$countresult = pg_query($connection, $countquery);
$countemail = pg_result($countresult, 0, 0);

if ($countemail>0) {

	// pull basic information for providers and store in varibles
	$basicinfoquery = "SELECT 
	userid,
	username,
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
	FROM azcase_users WHERE useremail = '$useremailsession';";
	$basicinforesult = pg_query($connection, $basicinfoquery);
	for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
		$userid = pg_result($basicinforesult, $lt, 0);
		$username = pg_result($basicinforesult, $lt, 1);
		$firstlogin = pg_result($basicinforesult, $lt, 2);
		$lastlogintime = pg_result($basicinforesult, $lt, 3);
		$updated = pg_result($basicinforesult, $lt, 4);
		$orgname = pg_result($basicinforesult, $lt, 5);
		$orgaddress = pg_result($basicinforesult, $lt, 6);
		$orgaddress2 = pg_result($basicinforesult, $lt, 7);
		$orgcity = pg_result($basicinforesult, $lt, 8);
		$orgstate = pg_result($basicinforesult, $lt, 9);
		$orgzip = pg_result($basicinforesult, $lt, 10);
		$orgphone = pg_result($basicinforesult, $lt, 11);
		$orgfax = pg_result($basicinforesult, $lt, 12);
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

}else{
}

echo $pagecontent;

// create footer
require('footer.php');
?>

