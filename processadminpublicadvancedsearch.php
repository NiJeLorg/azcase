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
$azcongress = $_REQUEST['azcongress'];
$stateleg = $_REQUEST['stateleg'];
$elemschooldistrict = $_REQUEST['elemschooldistrict'];
$unionschooldistrict = $_REQUEST['unionschooldistrict'];
$city = $_REQUEST['city'];
$activity = $_REQUEST['activity'];
$ages = $_REQUEST['ages'];
$summer = $_REQUEST['summer'];
$summary1 = $_REQUEST['summary1'];
$cd1 = $_REQUEST['cd1'];
$sld1 = $_REQUEST['sld1'];
$elm1 = $_REQUEST['elm1'];
$union1 = $_REQUEST['union1'];
$city1 = $_REQUEST['city1'];
$activity1 = $_REQUEST['activity1'];
$ages1 = $_REQUEST['ages1'];
$summary3 = $_REQUEST['summary3'];
$cd3 = $_REQUEST['cd3'];
$sld3 = $_REQUEST['sld3'];
$elm3 = $_REQUEST['elm3'];
$union3 = $_REQUEST['union3'];
$city3 = $_REQUEST['city3'];
$activity3 = $_REQUEST['activity3'];
$ages3 = $_REQUEST['ages3'];
$summary4 = $_REQUEST['summary4'];
$cd4 = $_REQUEST['cd4'];
$sld4 = $_REQUEST['sld4'];
$elm4 = $_REQUEST['elm4'];
$union4 = $_REQUEST['union4'];
$city4 = $_REQUEST['city4'];
$activity4 = $_REQUEST['activity4'];
$ages4 = $_REQUEST['ages4'];
$summary5 = $_REQUEST['summary5'];
$cd5 = $_REQUEST['cd5'];
$sld5 = $_REQUEST['sld5'];
$elm5 = $_REQUEST['elm5'];
$union5 = $_REQUEST['union5'];
$city5 = $_REQUEST['city5'];
$activity5 = $_REQUEST['activity5'];
$ages5 = $_REQUEST['ages5'];
$summary6 = $_REQUEST['summary6'];
$cd6 = $_REQUEST['cd6'];
$sld6 = $_REQUEST['sld6'];
$elm6 = $_REQUEST['elm6'];
$union6 = $_REQUEST['union6'];
$city6 = $_REQUEST['city6'];
$activity6 = $_REQUEST['activity6'];
$ages6 = $_REQUEST['ages6'];
$summary7 = $_REQUEST['summary7'];
$cd7 = $_REQUEST['cd7'];
$sld7 = $_REQUEST['sld7'];
$elm7 = $_REQUEST['elm7'];
$union7 = $_REQUEST['union7'];
$city7 = $_REQUEST['city7'];
$activity7 = $_REQUEST['activity7'];
$ages7 = $_REQUEST['ages7'];
$summary8 = $_REQUEST['summary8'];
$cd8 = $_REQUEST['cd8'];
$sld8 = $_REQUEST['sld8'];
$elm8 = $_REQUEST['elm8'];
$union8 = $_REQUEST['union8'];
$city8 = $_REQUEST['city8'];
$activity8 = $_REQUEST['activity8'];
$ages8 = $_REQUEST['ages8'];
$summary9 = $_REQUEST['summary9'];
$cd9 = $_REQUEST['cd9'];
$sld9 = $_REQUEST['sld9'];
$elm9 = $_REQUEST['elm9'];
$union9 = $_REQUEST['union9'];
$city9 = $_REQUEST['city9'];
$activity9 = $_REQUEST['activity9'];
$ages9 = $_REQUEST['ages9'];
$summary10 = $_REQUEST['summary10'];
$cd10 = $_REQUEST['cd10'];
$sld10 = $_REQUEST['sld10'];
$elm10 = $_REQUEST['elm10'];
$union10 = $_REQUEST['union10'];
$city10 = $_REQUEST['city10'];
$activity10 = $_REQUEST['activity10'];
$ages10 = $_REQUEST['ages10'];
$summary11 = $_REQUEST['summary11'];
$cd11 = $_REQUEST['cd11'];
$sld11 = $_REQUEST['sld11'];
$elm11 = $_REQUEST['elm11'];
$union11 = $_REQUEST['union11'];
$city11 = $_REQUEST['city11'];
$activity11 = $_REQUEST['activity11'];
$ages11 = $_REQUEST['ages11'];
$summary12 = $_REQUEST['summary12'];
$cd12 = $_REQUEST['cd12'];
$sld12 = $_REQUEST['sld12'];
$elm12 = $_REQUEST['elm12'];
$union12 = $_REQUEST['union12'];
$city12 = $_REQUEST['city12'];
$activity12 = $_REQUEST['activity12'];
$ages12 = $_REQUEST['ages12'];
$summary13 = $_REQUEST['summary13'];
$cd13 = $_REQUEST['cd13'];
$sld13 = $_REQUEST['sld13'];
$elm13 = $_REQUEST['elm13'];
$union13 = $_REQUEST['union13'];
$city13 = $_REQUEST['city13'];
$activity13 = $_REQUEST['activity13'];
$ages13 = $_REQUEST['ages13'];
$summary14 = $_REQUEST['summary14'];
$cd14 = $_REQUEST['cd14'];
$sld14 = $_REQUEST['sld14'];
$elm14 = $_REQUEST['elm14'];
$union14 = $_REQUEST['union14'];
$city14 = $_REQUEST['city14'];
$activity14 = $_REQUEST['activity14'];
$ages14 = $_REQUEST['ages14'];
$summary15 = $_REQUEST['summary15'];
$cd15 = $_REQUEST['cd15'];
$sld15 = $_REQUEST['sld15'];
$elm15 = $_REQUEST['elm15'];
$union15 = $_REQUEST['union15'];
$city15 = $_REQUEST['city15'];
$activity15 = $_REQUEST['activity15'];
$ages15 = $_REQUEST['ages15'];

// set to TRUE or FLASE
if ($azcongress=='t') {$azcongress = 'TRUE';}else{$azcongress = 'FALSE';}
if ($stateleg=='t') {$stateleg = 'TRUE';}else{$stateleg = 'FALSE';}
if ($elemschooldistrict=='t') {$elemschooldistrict = 'TRUE';}else{$elemschooldistrict = 'FALSE';}
if ($unionschooldistrict=='t') {$unionschooldistrict = 'TRUE';}else{$unionschooldistrict = 'FALSE';}
if ($city=='t') {$city = 'TRUE';}else{$city = 'FALSE';}
if ($activity=='t') {$activity = 'TRUE';}else{$activity = 'FALSE';}
if ($ages=='t') {$ages = 'TRUE';}else{$ages = 'FALSE';}
if ($summer=='t') {$summer = 'TRUE';}else{$summer = 'FALSE';}

if ($summary1=='t') {$summary1 = 'TRUE';}else{$summary1 = 'FALSE';}
if ($cd1=='t') {$cd1 = 'TRUE';}else{$cd1 = 'FALSE';}
if ($sld1=='t') {$sld1 = 'TRUE';}else{$sld1 = 'FALSE';}
if ($elm1=='t') {$elm1 = 'TRUE';}else{$elm1 = 'FALSE';}
if ($union1=='t') {$union1 = 'TRUE';}else{$union1 = 'FALSE';}
if ($city1=='t') {$city1 = 'TRUE';}else{$city1 = 'FALSE';}
if ($activity1=='t') {$activity1 = 'TRUE';}else{$activity1 = 'FALSE';}
if ($ages1=='t') {$ages1 = 'TRUE';}else{$ages1 = 'FALSE';}

if ($summary3=='t') {$summary3 = 'TRUE';}else{$summary3 = 'FALSE';}
if ($cd3=='t') {$cd3 = 'TRUE';}else{$cd3 = 'FALSE';}
if ($sld3=='t') {$sld3 = 'TRUE';}else{$sld3 = 'FALSE';}
if ($elm3=='t') {$elm3 = 'TRUE';}else{$elm3 = 'FALSE';}
if ($union3=='t') {$union3 = 'TRUE';}else{$union3 = 'FALSE';}
if ($city3=='t') {$city3 = 'TRUE';}else{$city3 = 'FALSE';}
if ($activity3=='t') {$activity3 = 'TRUE';}else{$activity3 = 'FALSE';}
if ($ages3=='t') {$ages3 = 'TRUE';}else{$ages3 = 'FALSE';}

if ($summary4=='t') {$summary4 = 'TRUE';}else{$summary4 = 'FALSE';}
if ($cd4=='t') {$cd4 = 'TRUE';}else{$cd4 = 'FALSE';}
if ($sld4=='t') {$sld4 = 'TRUE';}else{$sld4 = 'FALSE';}
if ($elm4=='t') {$elm4 = 'TRUE';}else{$elm4 = 'FALSE';}
if ($union4=='t') {$union4 = 'TRUE';}else{$union4 = 'FALSE';}
if ($city4=='t') {$city4 = 'TRUE';}else{$city4 = 'FALSE';}
if ($activity4=='t') {$activity4 = 'TRUE';}else{$activity4 = 'FALSE';}
if ($ages4=='t') {$ages4 = 'TRUE';}else{$ages4 = 'FALSE';}

if ($summary5=='t') {$summary5 = 'TRUE';}else{$summary5 = 'FALSE';}
if ($cd5=='t') {$cd5 = 'TRUE';}else{$cd5 = 'FALSE';}
if ($sld5=='t') {$sld5 = 'TRUE';}else{$sld5 = 'FALSE';}
if ($elm5=='t') {$elm5 = 'TRUE';}else{$elm5 = 'FALSE';}
if ($union5=='t') {$union5 = 'TRUE';}else{$union5 = 'FALSE';}
if ($city5=='t') {$city5 = 'TRUE';}else{$city5 = 'FALSE';}
if ($activity5=='t') {$activity5 = 'TRUE';}else{$activity5 = 'FALSE';}
if ($ages5=='t') {$ages5 = 'TRUE';}else{$ages5 = 'FALSE';}

if ($summary6=='t') {$summary6 = 'TRUE';}else{$summary6 = 'FALSE';}
if ($cd6=='t') {$cd6 = 'TRUE';}else{$cd6 = 'FALSE';}
if ($sld6=='t') {$sld6 = 'TRUE';}else{$sld6 = 'FALSE';}
if ($elm6=='t') {$elm6 = 'TRUE';}else{$elm6 = 'FALSE';}
if ($union6=='t') {$union6 = 'TRUE';}else{$union6 = 'FALSE';}
if ($city6=='t') {$city6 = 'TRUE';}else{$city6 = 'FALSE';}
if ($activity6=='t') {$activity6 = 'TRUE';}else{$activity6 = 'FALSE';}
if ($ages6=='t') {$ages6 = 'TRUE';}else{$ages6 = 'FALSE';}

if ($summary7=='t') {$summary7 = 'TRUE';}else{$summary7 = 'FALSE';}
if ($cd7=='t') {$cd7 = 'TRUE';}else{$cd7 = 'FALSE';}
if ($sld7=='t') {$sld7 = 'TRUE';}else{$sld7 = 'FALSE';}
if ($elm7=='t') {$elm7 = 'TRUE';}else{$elm7 = 'FALSE';}
if ($union7=='t') {$union7 = 'TRUE';}else{$union7 = 'FALSE';}
if ($city7=='t') {$city7 = 'TRUE';}else{$city7 = 'FALSE';}
if ($activity7=='t') {$activity7 = 'TRUE';}else{$activity7 = 'FALSE';}
if ($ages7=='t') {$ages7 = 'TRUE';}else{$ages7 = 'FALSE';}

if ($summary8=='t') {$summary8 = 'TRUE';}else{$summary8 = 'FALSE';}
if ($cd8=='t') {$cd8 = 'TRUE';}else{$cd8 = 'FALSE';}
if ($sld8=='t') {$sld8 = 'TRUE';}else{$sld8 = 'FALSE';}
if ($elm8=='t') {$elm8 = 'TRUE';}else{$elm8 = 'FALSE';}
if ($union8=='t') {$union8 = 'TRUE';}else{$union8 = 'FALSE';}
if ($city8=='t') {$city8 = 'TRUE';}else{$city8 = 'FALSE';}
if ($activity8=='t') {$activity8 = 'TRUE';}else{$activity8 = 'FALSE';}
if ($ages8=='t') {$ages8 = 'TRUE';}else{$ages8 = 'FALSE';}

if ($summary9=='t') {$summary9 = 'TRUE';}else{$summary9 = 'FALSE';}
if ($cd9=='t') {$cd9 = 'TRUE';}else{$cd9 = 'FALSE';}
if ($sld9=='t') {$sld9 = 'TRUE';}else{$sld9 = 'FALSE';}
if ($elm9=='t') {$elm9 = 'TRUE';}else{$elm9 = 'FALSE';}
if ($union9=='t') {$union9 = 'TRUE';}else{$union9 = 'FALSE';}
if ($city9=='t') {$city9 = 'TRUE';}else{$city9 = 'FALSE';}
if ($activity9=='t') {$activity9 = 'TRUE';}else{$activity9 = 'FALSE';}
if ($ages9=='t') {$ages9 = 'TRUE';}else{$ages9 = 'FALSE';}

if ($summary10=='t') {$summary10 = 'TRUE';}else{$summary10 = 'FALSE';}
if ($cd10=='t') {$cd10 = 'TRUE';}else{$cd10 = 'FALSE';}
if ($sld10=='t') {$sld10 = 'TRUE';}else{$sld10 = 'FALSE';}
if ($elm10=='t') {$elm10 = 'TRUE';}else{$elm10 = 'FALSE';}
if ($union10=='t') {$union10 = 'TRUE';}else{$union10 = 'FALSE';}
if ($city10=='t') {$city10 = 'TRUE';}else{$city10 = 'FALSE';}
if ($activity10=='t') {$activity10 = 'TRUE';}else{$activity10 = 'FALSE';}
if ($ages10=='t') {$ages10 = 'TRUE';}else{$ages10 = 'FALSE';}

if ($summary11=='t') {$summary11 = 'TRUE';}else{$summary11 = 'FALSE';}
if ($cd11=='t') {$cd11 = 'TRUE';}else{$cd11 = 'FALSE';}
if ($sld11=='t') {$sld11 = 'TRUE';}else{$sld11 = 'FALSE';}
if ($elm11=='t') {$elm11 = 'TRUE';}else{$elm11 = 'FALSE';}
if ($union11=='t') {$union11 = 'TRUE';}else{$union11 = 'FALSE';}
if ($city11=='t') {$city11 = 'TRUE';}else{$city11 = 'FALSE';}
if ($activity11=='t') {$activity11 = 'TRUE';}else{$activity11 = 'FALSE';}
if ($ages11=='t') {$ages11 = 'TRUE';}else{$ages11 = 'FALSE';}

if ($summary12=='t') {$summary12 = 'TRUE';}else{$summary12 = 'FALSE';}
if ($cd12=='t') {$cd12 = 'TRUE';}else{$cd12 = 'FALSE';}
if ($sld12=='t') {$sld12 = 'TRUE';}else{$sld12 = 'FALSE';}
if ($elm12=='t') {$elm12 = 'TRUE';}else{$elm12 = 'FALSE';}
if ($union12=='t') {$union12 = 'TRUE';}else{$union12 = 'FALSE';}
if ($city12=='t') {$city12 = 'TRUE';}else{$city12 = 'FALSE';}
if ($activity12=='t') {$activity12 = 'TRUE';}else{$activity12 = 'FALSE';}
if ($ages12=='t') {$ages12 = 'TRUE';}else{$ages12 = 'FALSE';}

if ($summary13=='t') {$summary13 = 'TRUE';}else{$summary13 = 'FALSE';}
if ($cd13=='t') {$cd13 = 'TRUE';}else{$cd13 = 'FALSE';}
if ($sld13=='t') {$sld13 = 'TRUE';}else{$sld13 = 'FALSE';}
if ($elm13=='t') {$elm13 = 'TRUE';}else{$elm13 = 'FALSE';}
if ($union13=='t') {$union13 = 'TRUE';}else{$union13 = 'FALSE';}
if ($city13=='t') {$city13 = 'TRUE';}else{$city13 = 'FALSE';}
if ($activity13=='t') {$activity13 = 'TRUE';}else{$activity13 = 'FALSE';}
if ($ages13=='t') {$ages13 = 'TRUE';}else{$ages13 = 'FALSE';}

if ($summary14=='t') {$summary14 = 'TRUE';}else{$summary14 = 'FALSE';}
if ($cd14=='t') {$cd14 = 'TRUE';}else{$cd14 = 'FALSE';}
if ($sld14=='t') {$sld14 = 'TRUE';}else{$sld14 = 'FALSE';}
if ($elm14=='t') {$elm14 = 'TRUE';}else{$elm14 = 'FALSE';}
if ($union14=='t') {$union14 = 'TRUE';}else{$union14 = 'FALSE';}
if ($city14=='t') {$city14 = 'TRUE';}else{$city14 = 'FALSE';}
if ($activity14=='t') {$activity14 = 'TRUE';}else{$activity14 = 'FALSE';}
if ($ages14=='t') {$ages14 = 'TRUE';}else{$ages14 = 'FALSE';}

if ($summary15=='t') {$summary15 = 'TRUE';}else{$summary15 = 'FALSE';}
if ($cd15=='t') {$cd15 = 'TRUE';}else{$cd15 = 'FALSE';}
if ($sld15=='t') {$sld15 = 'TRUE';}else{$sld15 = 'FALSE';}
if ($elm15=='t') {$elm15 = 'TRUE';}else{$elm15 = 'FALSE';}
if ($union15=='t') {$union15 = 'TRUE';}else{$union15 = 'FALSE';}
if ($city15=='t') {$city15 = 'TRUE';}else{$city15 = 'FALSE';}
if ($activity15=='t') {$activity15 = 'TRUE';}else{$activity15 = 'FALSE';}
if ($ages15=='t') {$ages15 = 'TRUE';}else{$ages15 = 'FALSE';}


// if the user changed email addresses - update email in azcase_users and log user out in next script

$update = "UPDATE azcase_publicadvancedsearch SET 
\"azcongress\" = $azcongress,
\"stateleg\" = $stateleg,
\"elemschooldistrict\" = $elemschooldistrict,
\"unionschooldistrict\" = $unionschooldistrict,
\"city\" = $city,
\"activity\" = $activity,
\"ages\" = $ages,
\"summer\" = $summer,
\"summary1\" = $summary1,
\"cd1\" = $cd1,
\"sld1\" = $sld1,
\"elm1\" = $elm1,
\"union1\" = $union1,
\"city1\" = $city1,
\"activity1\" = $activity1,
\"ages1\" = $ages1,
\"summary3\" = $summary3,
\"cd3\" = $cd3,
\"sld3\" = $sld3,
\"elm3\" = $elm3,
\"union3\" = $union3,
\"city3\" = $city3,
\"activity3\" = $activity3,
\"ages3\" = $ages3,
\"summary4\" = $summary4,
\"cd4\" = $cd4,
\"sld4\" = $sld4,
\"elm4\" = $elm4,
\"union4\" = $union4,
\"city4\" = $city4,
\"activity4\" = $activity4,
\"ages4\" = $ages4,
\"summary5\" = $summary5,
\"cd5\" = $cd5,
\"sld5\" = $sld5,
\"elm5\" = $elm5,
\"union5\" = $union5,
\"city5\" = $city5,
\"activity5\" = $activity5,
\"ages5\" = $ages5,
\"summary6\" = $summary6,
\"cd6\" = $cd6,
\"sld6\" = $sld6,
\"elm6\" = $elm6,
\"union6\" = $union6,
\"city6\" = $city6,
\"activity6\" = $activity6,
\"ages6\" = $ages6,
\"summary7\" = $summary7,
\"cd7\" = $cd7,
\"sld7\" = $sld7,
\"elm7\" = $elm7,
\"union7\" = $union7,
\"city7\" = $city7,
\"activity7\" = $activity7,
\"ages7\" = $ages7,
\"summary8\" = $summary8,
\"cd8\" = $cd8,
\"sld8\" = $sld8,
\"elm8\" = $elm8,
\"union8\" = $union8,
\"city8\" = $city8,
\"activity8\" = $activity8,
\"ages8\" = $ages8,
\"summary9\" = $summary9,
\"cd9\" = $cd9,
\"sld9\" = $sld9,
\"elm9\" = $elm9,
\"union9\" = $union9,
\"city9\" = $city9,
\"activity9\" = $activity9,
\"ages9\" = $ages9,
\"summary10\" = $summary10,
\"cd10\" = $cd10,
\"sld10\" = $sld10,
\"elm10\" = $elm10,
\"union10\" = $union10,
\"city10\" = $city10,
\"activity10\" = $activity10,
\"ages10\" = $ages10,
\"summary11\" = $summary11,
\"cd11\" = $cd11,
\"sld11\" = $sld11,
\"elm11\" = $elm11,
\"union11\" = $union11,
\"city11\" = $city11,
\"activity11\" = $activity11,
\"ages11\" = $ages11,
\"summary12\" = $summary12,
\"cd12\" = $cd12,
\"sld12\" = $sld12,
\"elm12\" = $elm12,
\"union12\" = $union12,
\"city12\" = $city12,
\"activity12\" = $activity12,
\"ages12\" = $ages12,
\"summary13\" = $summary13,
\"cd13\" = $cd13,
\"sld13\" = $sld13,
\"elm13\" = $elm13,
\"union13\" = $union13,
\"city13\" = $city13,
\"activity13\" = $activity13,
\"ages13\" = $ages13,
\"summary14\" = $summary14,
\"cd14\" = $cd14,
\"sld14\" = $sld14,
\"elm14\" = $elm14,
\"union14\" = $union14,
\"city14\" = $city14,
\"activity14\" = $activity14,
\"ages14\" = $ages14,
\"summary15\" = $summary15,
\"cd15\" = $cd15,
\"sld15\" = $sld15,
\"elm15\" = $elm15,
\"union15\" = $union15,
\"city15\" = $city15,
\"activity15\" = $activity15,
\"ages15\" = $ages15
WHERE gid = 1;";
pg_send_query($connection, $update);
$res1 = pg_get_result($connection);
$pgerror1 = pg_result_error($res1);
if ($pgerror1!=FALSE) {
	require('header.php');
	echo "<h1>Save Error</h1><p>An error occured when you attempted to submit your information. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
	require('footer.php');
	$to = "jd@nijel.org";
	$subject = "AZ Afterschool Program Directory Error: processadminpublicadvancedsearch.php Failed";
	$message = "User:" . $_SESSION['useremail'] . "\nPage: processadminpublicadvancedsearch.php\nFailed Query: $update\nError: $pgerror1";
	mail($to,$subject,$message);
	die ();
}else{}



// close admin = TRUE
}else{}

// close logged_in
}else{}


header("Location: https://azcase.nijel.org/phpsite/adminpublicadvancedsearch.php");
?>

