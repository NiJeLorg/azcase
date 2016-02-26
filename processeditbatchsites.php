<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// connect to database
require("connect.php");

// login to the system
require('login.php');

// processing login script
//displayLogin();

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



// set updated
$updated = date('Y-m-d H:i:s');

// set data variables first, then loop through siteids
$academic = $_REQUEST['activityacademic'];
$arts = $_REQUEST['activityarts'];
$sports = $_REQUEST['activitysports'];
$community = $_REQUEST['activitycommunity'];
$character = $_REQUEST['activitycharacter'];
$leadership = $_REQUEST['activityleadership'];
$nutrition = $_REQUEST['activitynutrition'];
$prevention = $_REQUEST['activityprevention'];
$mentoring = $_REQUEST['activitymentoring'];
$supportservices = $_REQUEST['activitysupportservices'];
$stem = $_REQUEST['activitystem'];
$college = $_REQUEST['activitycollege'];


if ($academic=="TRUE") {
}else{
	$academic = "FALSE";
}

if ($arts=="TRUE") {
}else{
	$arts = "FALSE";
}

if ($sports=="TRUE") {
}else{
	$sports = "FALSE";
}

if ($community=="TRUE") {
}else{
	$community = "FALSE";
}

if ($character=="TRUE") {
}else{
	$character = "FALSE";
}

if ($leadership=="TRUE") {
}else{
	$leadership = "FALSE";
}

if ($nutrition=="TRUE") {
}else{
	$nutrition = "FALSE";
}

if ($prevention=="TRUE") {
}else{
	$prevention = "FALSE";
}

if ($mentoring=="TRUE") {
}else{
	$mentoring = "FALSE";
}

if ($supportservices=="TRUE") {
}else{
	$supportservices = "FALSE";
}

if ($stem=="TRUE") {
}else{
	$stem = "FALSE";
}

if ($college=="TRUE") {
}else{
	$college = "FALSE";
}

$age5 = $_REQUEST['age5'];
$age6 = $_REQUEST['age6'];
$age7 = $_REQUEST['age7'];
$age8 = $_REQUEST['age8'];
$age9 = $_REQUEST['age9'];
$age10 = $_REQUEST['age10'];
$age11 = $_REQUEST['age11'];
$age12 = $_REQUEST['age12'];
$age13 = $_REQUEST['age13'];
$age14 = $_REQUEST['age14'];
$age15 = $_REQUEST['age15'];
$age16 = $_REQUEST['age16'];
$age17 = $_REQUEST['age17'];
$age18 = $_REQUEST['age18'];

if ($age5=="TRUE") {
}else{
	$age5 = "FALSE";
}

if ($age6=="TRUE") {
}else{
	$age6 = "FALSE";
}

if ($age7=="TRUE") {
}else{
	$age7 = "FALSE";
}

if ($age8=="TRUE") {
}else{
	$age8 = "FALSE";
}

if ($age9=="TRUE") {
}else{
	$age9 = "FALSE";
}

if ($age10=="TRUE") {
}else{
	$age10 = "FALSE";
}

if ($age11=="TRUE") {
}else{
	$age11 = "FALSE";
}

if ($age12=="TRUE") {
}else{
	$age12 = "FALSE";
}

if ($age13=="TRUE") {
}else{
	$age13 = "FALSE";
}

if ($age14=="TRUE") {
}else{
	$age14 = "FALSE";
}

if ($age15=="TRUE") {
}else{
	$age15 = "FALSE";
}

if ($age16=="TRUE") {
}else{
	$age16 = "FALSE";
}

if ($age17=="TRUE") {
}else{
	$age17 = "FALSE";
}

if ($age18=="TRUE") {
}else{
	$age18 = "FALSE";
}

$monstartmorning = $_REQUEST['monstartmorning'];
$monendmorning = $_REQUEST['monendmorning'];
$monstartafter = $_REQUEST['monstartafter'];
$monendafter = $_REQUEST['monendafter'];

$tuestartmorning = $_REQUEST['tuestartmorning'];
$tueendmorning = $_REQUEST['tueendmorning'];
$tuestartafter = $_REQUEST['tuestartafter'];
$tueendafter = $_REQUEST['tueendafter'];

$wedstartmorning = $_REQUEST['wedstartmorning'];
$wedendmorning = $_REQUEST['wedendmorning'];
$wedstartafter = $_REQUEST['wedstartafter'];
$wedendafter = $_REQUEST['wedendafter'];

$thustartmorning = $_REQUEST['thustartmorning'];
$thuendmorning = $_REQUEST['thuendmorning'];
$thustartafter = $_REQUEST['thustartafter'];
$thuendafter = $_REQUEST['thuendafter'];

$fristartmorning = $_REQUEST['fristartmorning'];
$friendmorning = $_REQUEST['friendmorning'];
$fristartafter = $_REQUEST['fristartafter'];
$friendafter = $_REQUEST['friendafter'];

$satstartweekend = $_REQUEST['satstartweekend'];
$satendweekend = $_REQUEST['satendweekend'];

$sunstartweekend = $_REQUEST['sunstartweekend'];
$sunendweekend = $_REQUEST['sunendweekend'];

$charge = $_REQUEST['charge'];
$costfrequency = $_REQUEST['costfrequency'];
$costamount = $_REQUEST['costamount'];
$feeassistance = $_REQUEST['feeassistance'];
$scholarship = $_REQUEST['scholarship'];
$desassistance = $_REQUEST['desassistance'];
$mcdiscount = $_REQUEST['mcdiscount'];
$otherassistance = $_REQUEST['otherassistance'];
$transportation = $_REQUEST['transportation'];
$snacks = $_REQUEST['snacks'];
$breakfast = $_REQUEST['breakfast'];
$lunch = $_REQUEST['lunch'];
$dinner = $_REQUEST['dinner'];
$freelunch = $_REQUEST['freelunch'];
$spanish = $_REQUEST['spanish'];
$otherlanguage = $_REQUEST['otherlanguage'];

if ($charge=="TRUE") {
}else{
	$charge = "FALSE";
}

if ($feeassistance=="TRUE") {
}else{
	$feeassistance = "FALSE";
}

if ($scholarship=="TRUE") {
}else{
	$scholarship = "FALSE";
}

if ($desassistance=="TRUE") {
}else{
	$desassistance = "FALSE";
}

if ($mcdiscount=="TRUE") {
}else{
	$mcdiscount = "FALSE";
}

if ($otherassistance=="TRUE") {
}else{
	$otherassistance = "FALSE";
}

if ($transportation=="TRUE") {
}else{
	$transportation = "FALSE";
}

if ($snacks=="TRUE") {
}else{
	$snacks = "FALSE";
}

if ($breakfast=="TRUE") {
}else{
	$breakfast = "FALSE";
}

if ($lunch=="TRUE") {
}else{
	$lunch = "FALSE";
}

if ($dinner=="TRUE") {
}else{
	$dinner = "FALSE";
}

if ($spanish=="TRUE") {
}else{
	$spanish = "FALSE";
}

if ($otherlanguage=="TRUE") {
}else{
	$otherlanguage = "FALSE";
}

// create loop to dertermine which sites where chosen
$siteidloopquery = "SELECT siteid, name, namesp, phone, fax, email, url, summer FROM azcase_sites WHERE (verified = 1 OR verified = 2) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid) ORDER BY name, summer;";
$siteidloopresult = pg_query($connection, $siteidloopquery);
for ($lt = 0; $lt < pg_numrows($siteidloopresult); $lt++) {
	$siteidloop = pg_result($siteidloopresult, $lt, 0);
	if ($_REQUEST["$siteidloop"]=='t') {
		$sitename = pg_result($siteidloopresult, $lt, 1);
		$sitenamesp = pg_result($siteidloopresult, $lt, 2);
		$phone = pg_result($siteidloopresult, $lt, 3);
		$fax = pg_result($siteidloopresult, $lt, 4);
		$email = pg_result($siteidloopresult, $lt, 5);
		$url = pg_result($siteidloopresult, $lt, 6);
		$summer = pg_result($siteidloopresult, $lt, 7);

		//escape strings
		$sitename = pg_escape_string($sitename);
		$sitenamesp = pg_escape_string($sitenamesp);
		$phone = pg_escape_string($phone);
		$fax = pg_escape_string($fax);
		$email = pg_escape_string($email);
		$url = pg_escape_string($url);

		// store old locationid/siteid 
		$siteid_old = $siteidloop;

		if ($summer=='t') {
			$summer = 'TRUE';
		}else{
			$summer = 'FALSE';
		}

		// get related location id
		$locationquery = "SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteidloop;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt1 = 0; $lt1 < pg_numrows($locationresult); $lt1++) {
			$locationid = pg_result($locationresult, $lt1, 0);		
		}

		// insert new sites into database and connect site to users and locations
		require('inserteditbatchsites.php');

	}else{} // close if ($_REQUEST["$siteidloop"]=='t')
} // close for loop

// close logged_in
}else{}


header("Location: http://azcase.nijel.org/phpsite/editbatchsitesurvey.php");
?>

