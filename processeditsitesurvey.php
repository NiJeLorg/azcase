<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 


// connect to database
require("connect.php");

// login to the system
require('login.php');

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

// set updated
$updated = date('Y-m-d H:i:s');

// store data passed
$siteid = $_REQUEST['siteid'];
$locationid = $_REQUEST['locationid'];
$capacity = $_REQUEST['capacity'];
$atcapacity = $_REQUEST['atcapacity'];
$served = $_REQUEST['served'];
$costsame = $_REQUEST['costsame'];
$slidescale = $_REQUEST['slidescale'];
$otherassistancedescription = stripslashes($_REQUEST['otherassistancedescription']);
$transportcost = $_REQUEST['transportcost'];
$fulltimestaff = $_REQUEST['fulltimestaff'];
$parttimestaff = $_REQUEST['parttimestaff'];
$volunteerstaff = $_REQUEST['volunteerstaff'];
$workingstaff = $_REQUEST['workingstaff'];
$parentreferrals = $_REQUEST['parentreferrals'];
$parenteducation = $_REQUEST['parenteducation'];
$parentinfo = $_REQUEST['parentinfo'];
$parentotherdescription = stripslashes($_REQUEST['parentotherdescription']);
$africanamerican = $_REQUEST['africanamerican'];
$asianamerican = $_REQUEST['asianamerican'];
$latino = $_REQUEST['latino'];
$nativeamerican = $_REQUEST['nativeamerican'];
$white = $_REQUEST['white'];
$otherrace = $_REQUEST['otherrace'];
$programtype = $_REQUEST['programtype'];
$budgetfederal = $_REQUEST['budgetfederal'];
$budgetlocal = $_REQUEST['budgetlocal'];
$budgetfees = $_REQUEST['budgetfees'];
$budgetgrant = $_REQUEST['budgetgrant'];
$budgetreligious = $_REQUEST['budgetreligious'];
$barriersfull = $_REQUEST['barriersfull'];
$barriersfulltext = stripslashes($_REQUEST['barriersfulltext']);
$fingerprint = $_REQUEST['fingerprint'];
$drugtest = $_REQUEST['drugtest'];
$backgroundcheck = $_REQUEST['backgroundcheck'];
$personalrefs = $_REQUEST['personalrefs'];
$othercheck = $_REQUEST['othercheck'];
$prodevelop = $_REQUEST['prodevelop'];
$prodevelophours = $_REQUEST['prodevelophours'];
$prodevelop_rankmost1 = $_REQUEST['prodevelop_rankmost1'];
$prodevelop_rank2 = $_REQUEST['prodevelop_rank2'];
$prodevelop_rank3 = $_REQUEST['prodevelop_rank3'];
$prodevelop_rank4 = $_REQUEST['prodevelop_rank4'];
$prodevelop_rankleast5 = $_REQUEST['prodevelop_rankleast5'];
$training_ownstaff = $_REQUEST['training_ownstaff'];
$training_aascc = $_REQUEST['training_aascc'];
$training_azcase = $_REQUEST['training_azcase'];
$training_azdhs = $_REQUEST['training_azdhs'];
$training_naa = $_REQUEST['training_naa'];
$training_niost = $_REQUEST['training_niost'];
$training_shd = $_REQUEST['training_shd'];
$training_other = stripslashes($_REQUEST['training_other']);
$training_needs = $_REQUEST['training_needs'];
$training_needsother = stripslashes($_REQUEST['training_needsother']);
$training_needssecond = $_REQUEST['training_needssecond'];
$training_needssecond_other = stripslashes($_REQUEST['training_needssecond_other']);
$evaluate_program = $_REQUEST['evaluate_program'];
$evaluate_type = $_REQUEST['evaluate_type'];
$youth_planactivity = $_REQUEST['youth_planactivity'];
$youth_makerules = $_REQUEST['youth_makerules'];
$collab_school = $_REQUEST['collab_school'];
$collab_schoolfreq = $_REQUEST['collab_schoolfreq'];

$otherassistancedescription = pg_escape_string($otherassistancedescription);
$parentotherdescription = pg_escape_string($parentotherdescription);
$barriersfulltext = pg_escape_string($barriersfulltext);
$training_other = pg_escape_string($training_other);
$training_needsother = pg_escape_string($training_needsother);
$training_needssecond_other = pg_escape_string($training_needssecond_other);


if ($atcapacity=="TRUE") {
}else{
	$atcapacity = "FALSE";
}

if ($costsame=="TRUE") {
}else{
	$costsame = "FALSE";
}

if ($slidescale=="TRUE") {
}else{
	$slidescale = "FALSE";
}

if ($parentreferrals=="TRUE") {
}else{
	$parentreferrals = "FALSE";
}

if ($parenteducation=="TRUE") {
}else{
	$parenteducation = "FALSE";
}

if ($parentinfo=="TRUE") {
}else{
	$parentinfo = "FALSE";
}

if ($fingerprint=="TRUE") {
}else{
	$fingerprint = "FALSE";
}

if ($drugtest=="TRUE") {
}else{
	$drugtest = "FALSE";
}

if ($backgroundcheck=="TRUE") {
}else{
	$backgroundcheck = "FALSE";
}

if ($personalrefs=="TRUE") {
}else{
	$personalrefs = "FALSE";
}

if ($othercheck=="TRUE") {
}else{
	$othercheck = "FALSE";
}

if ($training_ownstaff=="TRUE") {
}else{
	$training_ownstaff = "FALSE";
}

if ($training_aascc=="TRUE") {
}else{
	$training_aascc = "FALSE";
}

if ($training_azcase=="TRUE") {
}else{
	$training_azcase = "FALSE";
}

if ($training_azdhs=="TRUE") {
}else{
	$training_azdhs = "FALSE";
}

if ($training_naa=="TRUE") {
}else{
	$training_naa = "FALSE";
}

if ($training_niost=="TRUE") {
}else{
	$training_niost = "FALSE";
}

if ($training_shd=="TRUE") {
}else{
	$training_shd = "FALSE";
}

if ($evaluate_program=="TRUE") {
}else{
	$evaluate_program = "FALSE";
}

if ($collab_school=="TRUE") {
}else{
	$collab_school = "FALSE";	
}

if (!$transportcost) {
	$transportcost = "NULL";
}else{}


// insert new site survey into database
require('inserteditsitesurvey.php');


// close logged_in
}else{}

header("Location: http://azcase.nijel.org/phpsite/thankyoueditsite.php");
?>

