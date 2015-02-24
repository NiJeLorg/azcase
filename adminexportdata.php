<?php
ini_set('session.cache_limiter', 'private');
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

// build CSV export tables for sites and locations
// sites CSV header
$siterow_0 = array( );
$siterow_0[] = 'Site ID';
$siterow_0[] = 'Verified?';
$siterow_0[] = 'Updated';
$siterow_0[] = 'Site Name';
$siterow_0[] = 'Site Name (Spanish)';
$siterow_0[] = 'Site Phone';
$siterow_0[] = 'Site Fax';
$siterow_0[] = 'Site Email';
$siterow_0[] = 'Site Website';
$siterow_0[] = 'Summer Site?';
$siterow_0[] = 'Age 5';
$siterow_0[] = 'Age 6';
$siterow_0[] = 'Age 7';
$siterow_0[] = 'Age 8';
$siterow_0[] = 'Age 9';
$siterow_0[] = 'Age 10';
$siterow_0[] = 'Age 11';
$siterow_0[] = 'Age 12';
$siterow_0[] = 'Age 13';
$siterow_0[] = 'Age 14';
$siterow_0[] = 'Age 15';
$siterow_0[] = 'Age 16';
$siterow_0[] = 'Age 17';
$siterow_0[] = 'Age 18';
$siterow_0[] = 'Tutoring/Academic Enrichment';
$siterow_0[] = 'Arts and Culture';
$siterow_0[] = 'Sports and Recreation';
$siterow_0[] = 'Volunteering/Community Service';
$siterow_0[] = 'Science, Technology, Engineering, and Mathematics';
$siterow_0[] = 'College and Career Readiness';
$siterow_0[] = 'Leadership';
$siterow_0[] = 'Character Education';
$siterow_0[] = 'Prevention';
$siterow_0[] = 'Nutrition';
$siterow_0[] = 'Mentoring';
$siterow_0[] = 'Support Services (medical, dental, mental health, etc.)';
$siterow_0[] = 'Monday Morning Start Time';
$siterow_0[] = 'Monday Morning End Time';
$siterow_0[] = 'Monday Afternoon Start Time';
$siterow_0[] = 'Monday Afternoon End Time';
$siterow_0[] = 'Tuesday Morning Start Time';
$siterow_0[] = 'Tuesday Morning End Time';
$siterow_0[] = 'Tuesday Afternoon Start Time';
$siterow_0[] = 'Tuesday Afternoon End Time';
$siterow_0[] = 'Wednesday Morning Start Time';
$siterow_0[] = 'Wednesday Morning End Time';
$siterow_0[] = 'Wednesday Afternoon Start Time';
$siterow_0[] = 'Wednesday Afternoon End Time';
$siterow_0[] = 'Thursday Morning Start Time';
$siterow_0[] = 'Thursday Morning End Time';
$siterow_0[] = 'Thursday Afternoon Start Time';
$siterow_0[] = 'Thursday Afternoon End Time';
$siterow_0[] = 'Friday Morning Start Time';
$siterow_0[] = 'Friday Morning End Time';
$siterow_0[] = 'Friday Afternoon Start Time';
$siterow_0[] = 'Friday Afternoon End Time';
$siterow_0[] = 'Saturday Start Time';
$siterow_0[] = 'Saturday End Time';
$siterow_0[] = 'Sunday Start Time';
$siterow_0[] = 'Sunday End Time';
$siterow_0[] = 'This sites charge a fee?';
$siterow_0[] = 'Charge Frequency';
$siterow_0[] = 'Cost';
$siterow_0[] = 'Fee assistance available?';
$siterow_0[] = 'Scholarships available?';
$siterow_0[] = 'Accepts DES child care subsidy?';
$siterow_0[] = 'Multiple child discount available?';
$siterow_0[] = 'Other financial assistance available?';
$siterow_0[] = 'Transportation provided?';
$siterow_0[] = 'Snacks provided?';
$siterow_0[] = 'Breakfast provided?';
$siterow_0[] = 'Lunch provided?';
$siterow_0[] = 'Dinner provided?';
$siterow_0[] = 'What percentage of your clientèle receive a free or reduced lunch at their school?';
$siterow_0[] = 'Spanish spoken?';
$siterow_0[] = 'Other languages spoken?';
$siterow_0[] = 'What is the capacity of this site?';
$siterow_0[] = 'Does this site run at capacity?';
$siterow_0[] = 'On a typical day this site is operating, how many children or teens attend at this site?';
$siterow_0[] = 'Does everyone pay the same amount at this site?';
$siterow_0[] = 'Is sliding scale assistance available at this site?';
$siterow_0[] = 'Please describe what other financial assistance is available at this site.';
$siterow_0[] = 'What is the average monthly transportation cost to this site?';
$siterow_0[] = 'What is the number of full-time, paid staff at this site?';
$siterow_0[] = 'What is the number of part-time, paid staff at this site?';
$siterow_0[] = 'What is the number of volunteer staff at this site?';
$siterow_0[] = 'On a typical day, how many staff members are working at this site?';
$siterow_0[] = 'Do you provide referrals for needed parental services at this site?';
$siterow_0[] = 'Do you provide parent education at this site?';
$siterow_0[] = 'Do you provide information and handouts to parents at this site?';
$siterow_0[] = 'Please describe any other items or services provided to parents at this site';
$siterow_0[] = 'What percentage of your total clientele at this site are African American?';
$siterow_0[] = 'What percentage of your total clientele at this site are Asian American?';
$siterow_0[] = 'What percentage of your total clientele at this site are Latino?';
$siterow_0[] = 'What percentage of your total clientele at this site are Native American?';
$siterow_0[] = 'What percentage of your total clientele at this site are White?';
$siterow_0[] = 'What percentage of your total clientele at this site are another race or ethnicity?';
$siterow_0[] = 'Which response best describes the type of program operating at the site?';
$siterow_0[] = 'What percentage of your program budget at this site comes from the federal government?';
$siterow_0[] = 'What percentage of your program budget at this site comes from the state or local government?';
$siterow_0[] = 'What percentage of your program budget at this site comes from parent fees?';
$siterow_0[] = 'What percentage of your program budget at this site comes from grants?';
$siterow_0[] = 'What percentage of your program budget at this site comes from religious organizations?';
$siterow_0[] = 'What is the biggest barrier to operating at full attendence at this site?';
$siterow_0[] = 'Please describe any other barriers you see to operating at full attendence at this site.';
$siterow_0[] = 'When hiring staff for this site, do you require fingerprinting?';
$siterow_0[] = 'When hiring staff for this site, do you require drug test?';
$siterow_0[] = 'When hiring staff for this site, do you require background check?';
$siterow_0[] = 'When hiring staff for this site, do you require personal references?';
$siterow_0[] = 'When hiring staff for this site, do you require other?';
$siterow_0[] = 'How often do you provide staff training/professional development throughout the year for staff at this site?';
$siterow_0[] = 'Approximately how many hours of training/professional development do you provide to your staff at this site per year?';
$siterow_0[] = 'Most used delivery method for your staff\'s training/professional development at this site.';
$siterow_0[] = 'Second most used delivery method for your staff\'s training/professional development at this site.';
$siterow_0[] = 'Third most used delivery method for your staff\'s training/professional development at this site.';
$siterow_0[] = 'Fourth most used delivery method for your staff\'s training/professional development at this site.';
$siterow_0[] = 'Least used delivery method for your staff\'s training/professional development at this site.';
$siterow_0[] = 'Who trains your staff for this site? Our own staff?';
$siterow_0[] = 'Who trains your staff for this site? Arizona Association of Supportive Child Care?';
$siterow_0[] = 'Who trains your staff for this site? Arizona Center for Afterschool Excellence?';
$siterow_0[] = 'Who trains your staff for this site? Arizona Department of Health Services?';
$siterow_0[] = 'Who trains your staff for this site? National Afterschool Association?';
$siterow_0[] = 'Who trains your staff for this site? National Institute on Out-of-School Time (NIOST)?';
$siterow_0[] = 'Who trains your staff for this site? Southwest Human Development?';
$siterow_0[] = 'Who trains your staff for this site? Other?';
$siterow_0[] = 'Name the one most important area in which your staff needs the most training at this site.';
$siterow_0[] = 'Please describe if "other" selected.';
$siterow_0[] = 'Name the second most important area in which your staff needs the most training at this site.';
$siterow_0[] = 'Please describe if "other" selected.';
$siterow_0[] = 'Do you evaluate the quality of your program at this site?';
$siterow_0[] = 'How do you assess the quality of your program at this site?';
$siterow_0[] = 'How frequently do the children/teens at your site have the opportunity to plan activities/projects?';
$siterow_0[] = 'How often do the children/teens at your site have the opportunity to create rules and expectations that are followed?';
$siterow_0[] = 'Do you and/or your staff regularly collaborate with the schools attended by the children/teens at this site? ';
$siterow_0[] = 'How often do you collaborate with the schools attended by the children/teens at this site? ';

// set CSV counter to row 1
$ltcsv = 1;

$sitequery = "SELECT 
siteid,
updated,
name,
namesp,
phone,
fax,
email,
url,
summer,
age5,
age6,
age7,
age8,
age9,
age10,
age11,
age12,
age13,
age14,
age15,
age16,
age17,
age18,
arts,
character,
leadership,
mentoring,
nutrition,
prevention,
sports,
supportservices,
academic,
community,
monstartmorning,
tuestartmorning,
wedstartmorning,
thustartmorning,
fristartmorning,
monendmorning,
tueendmorning,
wedendmorning,
thuendmorning,
friendmorning,
monstartafter,
tuestartafter,
wedstartafter,
thustartafter,
fristartafter,
monendafter,
tueendafter,
wedendafter,
thuendafter,
friendafter,
satstartweekend,
sunstartweekend,
satendweekend,
sunendweekend,
charge,
costfrequency,
costamount,
feeassistance,
desassistance,
scholarship,
mcdiscount,
otherassistance,
transportation,
snacks,
breakfast,
lunch,
dinner,
freelunch,
spanish,
otherlanguage,
verified,
stem,
college
FROM azcase_sites WHERE verified = 1 OR verified = 2 ORDER BY updated, name;";
$record = pg_query($connection, $sitequery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
$siteid = pg_result($record, $lt, 0);
$updated = pg_result($record, $lt, 1);
$name = pg_result($record, $lt, 2);
$namesp = pg_result($record, $lt, 3);
$phone = pg_result($record, $lt, 4);
$fax = pg_result($record, $lt, 5);
$email = pg_result($record, $lt, 6);
$url = pg_result($record, $lt, 7);
$summer = pg_result($record, $lt, 8);
$age5 = pg_result($record, $lt, 9);
$age6 = pg_result($record, $lt, 10);
$age7 = pg_result($record, $lt, 11);
$age8 = pg_result($record, $lt, 12);
$age9 = pg_result($record, $lt, 13);
$age10 = pg_result($record, $lt, 14);
$age11 = pg_result($record, $lt, 15);
$age12 = pg_result($record, $lt, 16);
$age13 = pg_result($record, $lt, 17);
$age14 = pg_result($record, $lt, 18);
$age15 = pg_result($record, $lt, 19);
$age16 = pg_result($record, $lt, 20);
$age17 = pg_result($record, $lt, 21);
$age18 = pg_result($record, $lt, 22);
$arts = pg_result($record, $lt, 23);
$character = pg_result($record, $lt, 24);
$leadership = pg_result($record, $lt, 25);
$mentoring = pg_result($record, $lt, 26);
$nutrition = pg_result($record, $lt, 27);
$prevention = pg_result($record, $lt, 28);
$sports = pg_result($record, $lt, 29);
$supportservices = pg_result($record, $lt, 30);
$academic = pg_result($record, $lt, 31);
$community = pg_result($record, $lt, 32);
$monstartmorning = pg_result($record, $lt, 33);
$tuestartmorning = pg_result($record, $lt, 34);
$wedstartmorning = pg_result($record, $lt, 35);
$thustartmorning = pg_result($record, $lt, 36);
$fristartmorning = pg_result($record, $lt, 37);
$monendmorning = pg_result($record, $lt, 38);
$tueendmorning = pg_result($record, $lt, 39);
$wedendmorning = pg_result($record, $lt, 40);
$thuendmorning = pg_result($record, $lt, 41);
$friendmorning = pg_result($record, $lt, 42);
$monstartafter = pg_result($record, $lt, 43);
$tuestartafter = pg_result($record, $lt, 44);
$wedstartafter = pg_result($record, $lt, 45);
$thustartafter = pg_result($record, $lt, 46);
$fristartafter = pg_result($record, $lt, 47);
$monendafter = pg_result($record, $lt, 48);
$tueendafter = pg_result($record, $lt, 49);
$wedendafter = pg_result($record, $lt, 50);
$thuendafter = pg_result($record, $lt, 51);
$friendafter = pg_result($record, $lt, 52);
$satstartweekend = pg_result($record, $lt, 53);
$sunstartweekend = pg_result($record, $lt, 54);
$satendweekend = pg_result($record, $lt, 55);
$sunendweekend = pg_result($record, $lt, 56);
$charge = pg_result($record, $lt, 57);
$costfrequency = pg_result($record, $lt, 58);
$costamount = pg_result($record, $lt, 59);
$feeassistance = pg_result($record, $lt, 60);
$desassistance = pg_result($record, $lt, 61);
$scholarship = pg_result($record, $lt, 62);
$mcdiscount = pg_result($record, $lt, 63);
$otherassistance = pg_result($record, $lt, 64);
$transportation = pg_result($record, $lt, 65);
$snacks = pg_result($record, $lt, 66);
$breakfast = pg_result($record, $lt, 67);
$lunch = pg_result($record, $lt, 68);
$dinner = pg_result($record, $lt, 69);
$freelunch = pg_result($record, $lt, 70);
$spanish = pg_result($record, $lt, 71);
$otherlanguage = pg_result($record, $lt, 72);
$verified = pg_result($record, $lt, 73);
$stem = pg_result($record, $lt, 74);
$college = pg_result($record, $lt, 75);

// pull address location for this site
$siteaddressquery = "SELECT locationid, address, address2, city, state, zip FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteid);";
$siteaddressresult = pg_query($connection, $siteaddressquery);
for ($lt1 = 0; $lt1 < pg_numrows($siteaddressresult); $lt1++) {
	$locationid = pg_result($siteaddressresult, $lt1, 0);
	$siteaddress = pg_result($siteaddressresult, $lt1, 1);
	$siteaddress2 = pg_result($siteaddressresult, $lt1, 2);
	$sitecity = pg_result($siteaddressresult, $lt1, 3);
	$sitestate = pg_result($siteaddressresult, $lt1, 4);
	$sitezip = pg_result($siteaddressresult, $lt1, 5);
}

// pull any associated site survey data
$sitesurveyquery = "SELECT
capacity,
atcapacity,
served,
costsame,
slidescale,
otherassistancedescription,
transportcost,
fulltimestaff,
parttimestaff,
volunteerstaff,
workingstaff,
parentreferrals,
parenteducation,
parentinfo,
parentotherdescription,
africanamerican,
asianamerican,
white,
latino,
nativeamerican,
otherrace,
programtype,
budgetfederal,
budgetlocal,
budgetfees,
budgetgrant,
budgetreligious,
barriersfull,
barriersfulltext,
fingerprint,
drugtest,
backgroundcheck,
personalrefs,
othercheck,
prodevelop,
prodevelophours,
prodevelop_rankmost1,
prodevelop_rank2,
prodevelop_rank3,
prodevelop_rank4,
prodevelop_rankleast5,
training_ownstaff,
training_aascc,
training_azcase,
training_azdhs,
training_naa,
training_niost,
training_shd,
training_other,
training_needs,
training_needsother,
training_needssecond,
training_needssecond_other,
evaluate_program,
evaluate_type,
youth_planactivity,
youth_makerules,
collab_school,
collab_schoolfreq
FROM azcase_site_survey WHERE siteid = $siteid AND locationid = $locationid;";
$sitesurveyresult = pg_query($connection, $sitesurveyquery);
for ($lt2 = 0; $lt2 < pg_numrows($sitesurveyresult); $lt2++) {
$capacity = pg_result($sitesurveyresult, $lt2, 0);
$atcapacity = pg_result($sitesurveyresult, $lt2, 1);
$served = pg_result($sitesurveyresult, $lt2, 2);
$costsame = pg_result($sitesurveyresult, $lt2, 3);
$slidescale = pg_result($sitesurveyresult, $lt2, 4);
$otherassistancedescription = pg_result($sitesurveyresult, $lt2, 5);
$transportcost = pg_result($sitesurveyresult, $lt2, 6);
$fulltimestaff = pg_result($sitesurveyresult, $lt2, 7);
$parttimestaff = pg_result($sitesurveyresult, $lt2, 8);
$volunteerstaff = pg_result($sitesurveyresult, $lt2, 9);
$workingstaff = pg_result($sitesurveyresult, $lt2, 10);
$parentreferrals = pg_result($sitesurveyresult, $lt2, 11);
$parenteducation = pg_result($sitesurveyresult, $lt2, 12);
$parentinfo = pg_result($sitesurveyresult, $lt2, 13);
$parentotherdescription = pg_result($sitesurveyresult, $lt2, 14);
$africanamerican = pg_result($sitesurveyresult, $lt2, 15);
$asianamerican = pg_result($sitesurveyresult, $lt2, 16);
$white = pg_result($sitesurveyresult, $lt2, 17);
$latino = pg_result($sitesurveyresult, $lt2, 18);
$nativeamerican = pg_result($sitesurveyresult, $lt2, 19);
$otherrace = pg_result($sitesurveyresult, $lt2, 20);
$programtype = pg_result($sitesurveyresult, $lt2, 21);
$budgetfederal = pg_result($sitesurveyresult, $lt2, 22);
$budgetlocal = pg_result($sitesurveyresult, $lt2, 23);
$budgetfees = pg_result($sitesurveyresult, $lt2, 24);
$budgetgrant = pg_result($sitesurveyresult, $lt2, 25);
$budgetreligious = pg_result($sitesurveyresult, $lt2, 26);
$barriersfull = pg_result($sitesurveyresult, $lt2, 27);
$barriersfulltext = pg_result($sitesurveyresult, $lt2, 28);
$fingerprint = pg_result($sitesurveyresult, $lt2, 29);
$drugtest = pg_result($sitesurveyresult, $lt2, 30);
$backgroundcheck = pg_result($sitesurveyresult, $lt2, 31);
$personalrefs = pg_result($sitesurveyresult, $lt2, 32);
$othercheck = pg_result($sitesurveyresult, $lt2, 33);
$prodevelop = pg_result($sitesurveyresult, $lt2, 34);
$prodevelophours = pg_result($sitesurveyresult, $lt2, 35);
$prodevelop_rankmost1 = pg_result($sitesurveyresult, $lt2, 36);
$prodevelop_rank2 = pg_result($sitesurveyresult, $lt2, 37);
$prodevelop_rank3 = pg_result($sitesurveyresult, $lt2, 38);
$prodevelop_rank4 = pg_result($sitesurveyresult, $lt2, 39);
$prodevelop_rankleast5 = pg_result($sitesurveyresult, $lt2, 40);
$training_ownstaff = pg_result($sitesurveyresult, $lt2, 41);
$training_aascc = pg_result($sitesurveyresult, $lt2, 42);
$training_azcase = pg_result($sitesurveyresult, $lt2, 43);
$training_azdhs = pg_result($sitesurveyresult, $lt2, 44);
$training_naa = pg_result($sitesurveyresult, $lt2, 45);
$training_niost = pg_result($sitesurveyresult, $lt2, 46);
$training_shd = pg_result($sitesurveyresult, $lt2, 47);
$training_other = pg_result($sitesurveyresult, $lt2, 48);
$training_needs = pg_result($sitesurveyresult, $lt2, 49);
$training_needsother = pg_result($sitesurveyresult, $lt2, 50);
$training_needssecond = pg_result($sitesurveyresult, $lt2, 51);
$training_needssecond_other = pg_result($sitesurveyresult, $lt2, 52);
$evaluate_program = pg_result($sitesurveyresult, $lt2, 53);
$evaluate_type = pg_result($sitesurveyresult, $lt2, 54);
$youth_planactivity = pg_result($sitesurveyresult, $lt2, 55);
$youth_makerules = pg_result($sitesurveyresult, $lt2, 56);
$collab_school = pg_result($sitesurveyresult, $lt2, 57);
$collab_schoolfreq = pg_result($sitesurveyresult, $lt2, 58);
}


// clean up sites data for csv export
//change updated to Month, Day Year format
if (!$updated) {
	$updated = 'Not Updated';
}else{
	$updated = date('n/d/Y', strtotime($updated)); 
}

// format url
if (!$url) {
}else{
	$http = "http://";
	$url = str_replace($http, "", $url);
	$url = $http . $url;  
}

// format summer
if (!$summer) {
}elseif ($summer=='t') {
	$summer = 'Yes';
}elseif ($summer=='f') {
	$summer = 'No';
}else{}

// format address
$printaddress = $siteaddress;
if (!$siteaddress2) { 
	$printaddress .= '; '; 
}else{ 
	$printaddress .=  ' ' . $siteaddress2 . '; '; 
}
$printaddress .= $sitecity . ' ';
$printaddress .= $sitestate . ' ';
$printaddress .= $sitezip . ' '; 


if (!$age5) {
}elseif ($age5=='t') {
	$age5 = 'Yes';
}elseif ($age5=='f') {
	$age5 = 'No';
}else{}

if (!$age6) {
}elseif ($age6=='t') {
	$age6 = 'Yes';
}elseif ($age6=='f') {
	$age6 = 'No';
}else{}

if (!$age7) {
}elseif ($age7=='t') {
	$age7 = 'Yes';
}elseif ($age7=='f') {
	$age7 = 'No';
}else{}

if (!$age8) {
}elseif ($age8=='t') {
	$age8 = 'Yes';
}elseif ($age8=='f') {
	$age8 = 'No';
}else{}

if (!$age9) {
}elseif ($age9=='t') {
	$age9 = 'Yes';
}elseif ($age9=='f') {
	$age9 = 'No';
}else{}

if (!$age10) {
}elseif ($age10=='t') {
	$age10 = 'Yes';
}elseif ($age10=='f') {
	$age10 = 'No';
}else{}

if (!$age11) {
}elseif ($age11=='t') {
	$age11 = 'Yes';
}elseif ($age11=='f') {
	$age11 = 'No';
}else{}

if (!$age12) {
}elseif ($age12=='t') {
	$age12 = 'Yes';
}elseif ($age12=='f') {
	$age12 = 'No';
}else{}

if (!$age13) {
}elseif ($age13=='t') {
	$age13 = 'Yes';
}elseif ($age13=='f') {
	$age13 = 'No';
}else{}

if (!$age14) {
}elseif ($age14=='t') {
	$age14 = 'Yes';
}elseif ($age14=='f') {
	$age14 = 'No';
}else{}

if (!$age15) {
}elseif ($age15=='t') {
	$age15 = 'Yes';
}elseif ($age15=='f') {
	$age15 = 'No';
}else{}

if (!$age16) {
}elseif ($age16=='t') {
	$age16 = 'Yes';
}elseif ($age16=='f') {
	$age16 = 'No';
}else{}

if (!$age17) {
}elseif ($age17=='t') {
	$age17 = 'Yes';
}elseif ($age17=='f') {
	$age17 = 'No';
}else{}

if (!$age18) {
}elseif ($age18=='t') {
	$age18 = 'Yes';
}elseif ($age18=='f') {
	$age18 = 'No';
}else{}

if (!$arts) {
}elseif ($arts=='t') {
	$arts = 'Yes';
}elseif ($arts=='f') {
	$arts = 'No';
}else{}

if (!$character) {
}elseif ($character=='t') {
	$character = 'Yes';
}elseif ($character=='f') {
	$character = 'No';
}else{}

if (!$leadership) {
}elseif ($leadership=='t') {
	$leadership = 'Yes';
}elseif ($leadership=='f') {
	$leadership = 'No';
}else{}

if (!$mentoring) {
}elseif ($mentoring=='t') {
	$mentoring = 'Yes';
}elseif ($mentoring=='f') {
	$mentoring = 'No';
}else{}

if (!$nutrition) {
}elseif ($nutrition=='t') {
	$nutrition = 'Yes';
}elseif ($nutrition=='f') {
	$nutrition = 'No';
}else{}

if (!$prevention) {
}elseif ($prevention=='t') {
	$prevention = 'Yes';
}elseif ($prevention=='f') {
	$prevention = 'No';
}else{}

if (!$sports) {
}elseif ($sports=='t') {
	$sports = 'Yes';
}elseif ($sports=='f') {
	$sports = 'No';
}else{}

if (!$supportservices) {
}elseif ($supportservices=='t') {
	$supportservices = 'Yes';
}elseif ($supportservices=='f') {
	$supportservices = 'No';
}else{}

if (!$academic) {
}elseif ($academic=='t') {
	$academic = 'Yes';
}elseif ($academic=='f') {
	$academic = 'No';
}else{}

if (!$community) {
}elseif ($community=='t') {
	$community = 'Yes';
}elseif ($community=='f') {
	$community = 'No';
}else{}

if (!$stem) {
}elseif ($stem=='t') {
	$stem = 'Yes';
}elseif ($stem=='f') {
	$stem = 'No';
}else{}

if (!$college) {
}elseif ($college=='t') {
	$college = 'Yes';
}elseif ($college=='f') {
	$college = 'No';
}else{}

// format times for html
// format monday times
if (!$monstartmorning || $monstartmorning=='00:00:00') {
	$monstartmorning = "";
}else{
	$monstartmorning = date("g:i A", strtotime($monstartmorning));
}

if (!$monendmorning || $monendmorning=='00:00:00') {
	$monendmorning = "";
}else{
	$monendmorning = date("g:i A", strtotime($monendmorning));
}

if (!$monstartafter || $monstartafter=='00:00:00') {
	$monstartafter = "";
}else{
	$monstartafter = date("g:i A", strtotime($monstartafter));
}

if (!$monendafter || $monendafter=='00:00:00') {
	$monendafter = "";
}else{
	$monendafter = date("g:i A", strtotime($monendafter));
}	

// format tuesday times
if (!$tuestartmorning || $tuestartmorning=='00:00:00') {
	$tuestartmorning = "";
}else{
	$tuestartmorning = date("g:i A", strtotime($tuestartmorning));
}

if (!$tueendmorning || $tueendmorning=='00:00:00') {
	$tueendmorning = "";
}else{
	$tueendmorning = date("g:i A", strtotime($tueendmorning));
}

if (!$tuestartafter || $tuestartafter=='00:00:00') {
	$tuestartafter = "";
}else{
	$tuestartafter = date("g:i A", strtotime($tuestartafter));
}

if (!$tueendafter || $tueendafter=='00:00:00') {
	$tueendafter = "";
}else{
	$tueendafter = date("g:i A", strtotime($tueendafter));
}

// format wednesday times
if (!$wedstartmorning || $wedstartmorning=='00:00:00') {
	$wedstartmorning = "";
}else{
	$wedstartmorning = date("g:i A", strtotime($wedstartmorning));
}

if (!$wedendmorning || $wedendmorning=='00:00:00') {
	$wedendmorning = "";
}else{
	$wedendmorning = date("g:i A", strtotime($wedendmorning));
}

if (!$wedstartafter || $wedstartafter=='00:00:00') {
	$wedstartafter = "";
}else{
	$wedstartafter = date("g:i A", strtotime($wedstartafter));
}

if (!$wedendafter || $wedendafter=='00:00:00') {
	$wedendafter = "";
}else{
	$wedendafter = date("g:i A", strtotime($wedendafter));
}

// format thursday times
if (!$thustartmorning || $thustartmorning=='00:00:00') {
	$thustartmorning = "";
}else{
	$thustartmorning = date("g:i A", strtotime($thustartmorning));
}

if (!$thuendmorning || $thuendmorning=='00:00:00') {
	$thuendmorning = "";
}else{
	$thuendmorning = date("g:i A", strtotime($thuendmorning));
}

if (!$thustartafter || $thustartafter=='00:00:00') {
	$thustartafter = "";
}else{
	$thustartafter = date("g:i A", strtotime($thustartafter));
}

if (!$thuendafter || $thuendafter=='00:00:00') {
	$thuendafter = "";
}else{
	$thuendafter = date("g:i A", strtotime($thuendafter));
}

// format friday times
if (!$fristartmorning || $fristartmorning=='00:00:00') {
	$fristartmorning = "";
}else{
	$fristartmorning = date("g:i A", strtotime($fristartmorning));
}

if (!$friendmorning || $friendmorning=='00:00:00') {
	$friendmorning = "";
}else{
	$friendmorning = date("g:i A", strtotime($friendmorning));
}

if (!$fristartafter || $fristartafter=='00:00:00') {
	$fristartafter = "";
}else{
	$fristartafter = date("g:i A", strtotime($fristartafter));
}

if (!$friendafter || $friendafter=='00:00:00') {
	$friendafter = "";
}else{
	$friendafter = date("g:i A", strtotime($friendafter));
}

// format saturday times
if (!$satstartweekend || $satstartweekend=='00:00:00') {
	$satstartweekend = "";
}else{
	$satstartweekend = date("g:i A", strtotime($satstartweekend));
}

if (!$satendweekend || $satendweekend=='00:00:00') {
	$satendweekend = "";
}else{
	$satendweekend = date("g:i A", strtotime($satendweekend));
}

// format sunday times
if (!$sunstartweekend || $sunstartweekend=='00:00:00') {
	$sunstartweekend = "";
}else{
	$sunstartweekend = date("g:i A", strtotime($sunstartweekend));
}

if (!$sunendweekend || $sunendweekend=='00:00:00') {
	$sunendweekend = "";
}else{
	$sunendweekend = date("g:i A", strtotime($sunendweekend));
}

// format additional data
if (!$charge) {
	$charge = '';
}elseif ($charge=='t') {
	$charge = 'Yes';
}elseif ($charge=='f') {
	$charge = 'No';
}else{}

if (!$costfrequency) {
	$costfrequency = '';
}elseif ($costfrequency==1) {
	$costfrequency = 'Weekly';
}elseif ($costfrequency==2) {
	$costfrequency = 'Monthly';
}elseif ($costfrequency==3) {
	$costfrequency = 'Quarterly';
}elseif ($costfrequency==4) {
	$costfrequency = 'Per School Semester';
}elseif ($costfrequency==5) {
	$costfrequency = 'Annual';
}elseif ($costfrequency==6) {
	$costfrequency = 'Summer';
}else{}

if (!$costamount) {
	$costamount = '';
}else{	
	$costamount = '$' . number_format($costamount, 2);
}

if (!$feeassistance) {
	$feeassistance = '';
}elseif ($feeassistance=='t') {
	$feeassistance = 'Yes';
}elseif ($feeassistance=='f') {
	$feeassistance = 'No';
}else{}
	
if (!$desassistance) {
	$desassistance = '';
}elseif ($desassistance=='t') {
	$desassistance = 'Yes';
}elseif ($desassistance=='f') {
	$desassistance = 'No';
}else{}

if (!$scholarship) {
	$scholarship = '';
}elseif ($scholarship=='t') {
	$scholarship = 'Yes';
}elseif ($scholarship=='f') {
	$scholarship = 'No';
}else{}
	
if (!$mcdiscount) {
	$mcdiscount = '';
}elseif ($mcdiscount=='t') {
	$mcdiscount = 'Yes';
}elseif ($mcdiscount=='f') {
	$mcdiscount = 'No';
}else{}

if (!$otherassistance) {
	$otherassistance = '';
}elseif ($otherassistance=='t') {
	$otherassistance = 'Yes';
}elseif ($otherassistance=='f') {
	$otherassistance = 'No';
}else{}

if (!$transportation) {
	$transportation = '';
}elseif ($transportation=='t') {
	$transportation = 'Yes';
}elseif ($transportation=='f') {
	$transportation = 'No';
}else{}

if (!$breakfast) {
	$breakfast = '';
}elseif ($breakfast=='t') {
	$breakfast = 'Yes';
}elseif ($breakfast=='f') {
	$breakfast = 'No';
}else{}

if (!$snacks) {
	$snacks = '';
}elseif ($snacks=='t') {
	$snacks = 'Yes';
}elseif ($snacks=='f') {
	$snacks = 'No';
}else{}

if (!$lunch) {
	$lunch = '';
}elseif ($lunch=='t') {
	$lunch = 'Yes';
}elseif ($lunch=='f') {
	$lunch = 'No';
}else{}

if (!$dinner) {
	$dinner = '';
}elseif ($dinner=='t') {
	$dinner = 'Yes';
}elseif ($dinner=='f') {
	$dinner = 'No';
}else{}

if (!$freelunch) {
 	$freelunch = '';
}else{
	$freelunch = $freelunch . '%';
}

if (!$spanish) {
	$spanish = '';
}elseif ($spanish=='t') {
	$spanish = 'Yes';
}elseif ($spanish=='f') {
	$spanish = 'No';
}else{}

if (!$otherlanguage) {
	$otherlanguage = '';
}elseif ($otherlanguage=='t') {
	$otherlanguage = 'Yes';
}elseif ($otherlanguage=='f') {
	$otherlanguage = 'No';
}else{}

if ($verified==1) {
	$verified = 'Yes';
}elseif ($verified==2) {
	$verified = 'No';
}else{
	$verified = '';
}

if (!$atcapacity) {
	$atcapacity = '';
}elseif ($atcapacity=='t') {
	$atcapacity = 'Yes';
}elseif ($atcapacity=='f') {
	$atcapacity = 'No';
}else{}

if (!$costsame) {
	$costsame = '';
}elseif ($costsame=='t') {
	$costsame = 'Yes';
}elseif ($costsame=='f') {
	$costsame = 'No';
}else{}

if (!$slidescale) {
	$slidescale = '';
}elseif ($slidescale=='t') {
	$slidescale = 'Yes';
}elseif ($slidescale=='f') {
	$slidescale = 'No';
}else{}

if (!$transportcost) {
	$transportcost = '';
}else{
	$transportcost = '$' . number_format($transportcost, 2);
}

if (!$parentreferrals) {
	$parentreferrals = '';
}elseif ($parentreferrals=='t') {
	$parentreferrals = 'Yes';
}elseif ($parentreferrals=='f') {
	$parentreferrals = 'No';
}else{}
  
if (!$parenteducation) {
	$parenteducation = '';
}elseif ($parenteducation=='t') {
	$parenteducation = 'Yes';
}elseif ($parenteducation=='f') {
	$parenteducation = 'No';
}else{}

if (!$parentinfo) {
	$parentinfo = '';
}elseif ($parentinfo=='t') {
	$parentinfo = 'Yes';
}elseif ($parentinfo=='f') {
	$parentinfo = 'No';
}else{}

if (!$africanamerican) {
 	$africanamerican = '';
}else{
	$africanamerican = $africanamerican . '%';
}

if (!$asianamerican) {
 	$asianamerican = '';
}else{
	$asianamerican = $asianamerican . '%';
}

if (!$white) {
 	$white = '';
}else{
	$white = $white . '%';
}

if (!$latino) {
 	$latino = '';
}else{
	$latino = $latino . '%';
}

if (!$nativeamerican) {
 	$nativeamerican = '';
}else{
	$nativeamerican = $nativeamerican . '%';
}

if (!$otherrace) {
 	$otherrace = '';
}else{
	$otherrace = $otherrace . '%';
}

if (!$programtype) {
	$programtype = '';
}elseif ($programtype==1) {
	$programtype = '21st Century Community Center';
}elseif ($programtype==2) {
	$programtype = 'Faith-based Program';
}elseif ($programtype==3) {
	$programtype = 'Public School Based Program';
}elseif ($programtype==4) {
	$programtype = 'Private School Based Program';
}elseif ($programtype==5) {
	$programtype = 'Home Based Program';
}elseif ($programtype==6) {
	$programtype = 'Corporate Run Program';
}elseif ($programtype==7) {
	$programtype = 'Community Based Program';
}else{}

if (!$budgetfederal) {
 	$budgetfederal = '';
}else{
	$budgetfederal = $budgetfederal . '%';
}

if (!$budgetlocal) {
 	$budgetlocal = '';
}else{
	$budgetlocal = $budgetlocal . '%';
}

if (!$budgetfees) {
 	$budgetfees = '';
}else{
	$budgetfees = $budgetfees . '%';
}

if (!$budgetgrant) {
 	$budgetgrant = '';
}else{
	$budgetgrant = $budgetgrant . '%';
}

if (!$budgetreligious) {
 	$budgetreligious = '';
}else{
	$budgetreligious = $budgetreligious . '%';
}

if (!$barriersfull) {
	$barriersfull = '';
}elseif ($barriersfull==1) {
	$barriersfull = 'Children/teens lose interest';
}elseif ($barriersfull==2) {
	$barriersfull = 'Insufficient/inadequate recruitment of children/teens';
}elseif ($barriersfull==3) {
	$barriersfull = 'Lack of available transportation to the site';
}elseif ($barriersfull==4) {
	$barriersfull = 'Lack of staff';
}elseif ($barriersfull==5) {
	$barriersfull = 'Program fees charged';
}elseif ($barriersfull==6) {
	$barriersfull = 'Other';
}elseif ($barriersfull==7) {
	$barriersfull = 'Parent perception';
}elseif ($barriersfull==8) {
	$barriersfull = 'Child perception';
}else{}

if (!$fingerprint) {
	$fingerprint = '';
}elseif ($fingerprint=='t') {
	$fingerprint = 'Yes';
}elseif ($fingerprint=='f') {
	$fingerprint = 'No';
}else{}

if (!$drugtest) {
	$drugtest = '';
}elseif ($drugtest=='t') {
	$drugtest = 'Yes';
}elseif ($drugtest=='f') {
	$drugtest = 'No';
}else{}

if (!$backgroundcheck) {
	$backgroundcheck = '';
}elseif ($backgroundcheck=='t') {
	$backgroundcheck = 'Yes';
}elseif ($backgroundcheck=='f') {
	$backgroundcheck = 'No';
}else{}

if (!$personalrefs) {
	$personalrefs = '';
}elseif ($personalrefs=='t') {
	$personalrefs = 'Yes';
}elseif ($personalrefs=='f') {
	$personalrefs = 'No';
}else{}

if (!$othercheck) {
	$othercheck = '';
}elseif ($othercheck=='t') {
	$othercheck = 'Yes';
}elseif ($othercheck=='f') {
	$othercheck = 'No';
}else{}

if (!$prodevelop) {
	$prodevelop = '';
}elseif ($prodevelop==1) {
	$prodevelop = 'Monthly';
}elseif ($prodevelop==2) {
	$prodevelop = 'Quarterly';
}elseif ($prodevelop==3) {
	$prodevelop = 'Semi-annually';
}elseif ($prodevelop==4) {
	$prodevelop = 'Annually';
}elseif ($prodevelop==5) {
	$prodevelop = 'Less than once a year';
}else{}

if (!$prodevelop_rankmost1) {
	$prodevelop_rankmost1 = '';
}elseif ($prodevelop_rankmost1==1) {
	$prodevelop_rankmost1 = 'On-line training';
}elseif ($prodevelop_rankmost1==2) {
	$prodevelop_rankmost1 = 'Workshops/conferences';
}elseif ($prodevelop_rankmost1==3) {
	$prodevelop_rankmost1 = 'Trainers specializing in specific subject matter';
}elseif ($prodevelop_rankmost1==4) {
	$prodevelop_rankmost1 = 'Peer to peer coaching';
}elseif ($prodevelop_rankmost1==5) {
	$prodevelop_rankmost1 = 'Supervision';
}else{}

if (!$prodevelop_rank2) {
	$prodevelop_rank2 = '';
}elseif ($prodevelop_rank2==1) {
	$prodevelop_rank2 = 'On-line training';
}elseif ($prodevelop_rank2==2) {
	$prodevelop_rank2 = 'Workshops/conferences';
}elseif ($prodevelop_rank2==3) {
	$prodevelop_rank2 = 'Trainers specializing in specific subject matter';
}elseif ($prodevelop_rank2==4) {
	$prodevelop_rank2 = 'Peer to peer coaching';
}elseif ($prodevelop_rank2==5) {
	$prodevelop_rank2 = 'Supervision';
}else{}

if (!$prodevelop_rank3) {
	$prodevelop_rank3 = '';
}elseif ($prodevelop_rank3==1) {
	$prodevelop_rank3 = 'On-line training';
}elseif ($prodevelop_rank3==2) {
	$prodevelop_rank3 = 'Workshops/conferences';
}elseif ($prodevelop_rank3==3) {
	$prodevelop_rank3 = 'Trainers specializing in specific subject matter';
}elseif ($prodevelop_rank3==4) {
	$prodevelop_rank3 = 'Peer to peer coaching';
}elseif ($prodevelop_rank3==5) {
	$prodevelop_rank3 = 'Supervision';
}else{}

if (!$prodevelop_rank4) {
	$prodevelop_rank4 = '';
}elseif ($prodevelop_rank4==1) {
	$prodevelop_rank4 = 'On-line training';
}elseif ($prodevelop_rank4==2) {
	$prodevelop_rank4 = 'Workshops/conferences';
}elseif ($prodevelop_rank4==3) {
	$prodevelop_rank4 = 'Trainers specializing in specific subject matter';
}elseif ($prodevelop_rank4==4) {
	$prodevelop_rank4 = 'Peer to peer coaching';
}elseif ($prodevelop_rank4==5) {
	$prodevelop_rank4 = 'Supervision';
}else{}

if (!$prodevelop_rankleast5) {
	$prodevelop_rankleast5 = '';
}elseif ($prodevelop_rankleast5==1) {
	$prodevelop_rankleast5 = 'On-line training';
}elseif ($prodevelop_rankleast5==2) {
	$prodevelop_rankleast5 = 'Workshops/conferences';
}elseif ($prodevelop_rankleast5==3) {
	$prodevelop_rankleast5 = 'Trainers specializing in specific subject matter';
}elseif ($prodevelop_rankleast5==4) {
	$prodevelop_rankleast5 = 'Peer to peer coaching';
}elseif ($prodevelop_rankleast5==5) {
	$prodevelop_rankleast5 = 'Supervision';
}else{}

if (!$training_ownstaff) {
	$training_ownstaff = '';
}elseif ($training_ownstaff=='t') {
	$training_ownstaff = 'Yes';
}elseif ($training_ownstaff=='f') {
	$training_ownstaff = 'No';
}else{}

if (!$training_aascc) {
	$training_aascc = '';
}elseif ($training_aascc=='t') {
	$training_aascc = 'Yes';
}elseif ($training_aascc=='f') {
	$training_aascc = 'No';
}else{}

if (!$training_azcase) {
	$training_azcase = '';
}elseif ($training_azcase=='t') {
	$training_azcase = 'Yes';
}elseif ($training_azcase=='f') {
	$training_azcase = 'No';
}else{}

if (!$training_azdhs) {
	$training_azdhs = '';
}elseif ($training_azdhs=='t') {
	$training_azdhs = 'Yes';
}elseif ($training_azdhs=='f') {
	$training_azdhs = 'No';
}else{}

if (!$training_naa) {
	$training_naa = '';
}elseif ($training_naa=='t') {
	$training_naa = 'Yes';
}elseif ($training_naa=='f') {
	$training_naa = 'No';
}else{}

if (!$training_niost) {
	$training_niost = '';
}elseif ($training_niost=='t') {
	$training_niost = 'Yes';
}elseif ($training_niost=='f') {
	$training_niost = 'No';
}else{}

if (!$training_shd) {
	$training_shd = '';
}elseif ($training_shd=='t') {
	$training_shd = 'Yes';
}elseif ($training_shd=='f') {
	$training_shd = 'No';
}else{}

if (!$training_other) {
	$training_other = '';
}elseif ($training_other=='t') {
	$training_other = 'Yes';
}elseif ($training_other=='f') {
	$training_other = 'No';
}else{}

if (!$training_needs) {
	$training_needs = '';
}elseif ($training_needs==2) {
	$training_needs = 'Advancement of Physical/Intellectual Development';
}elseif ($training_needs==3) {
	$training_needs = 'Enhancement of Social and Emotional Development';
}elseif ($training_needs==4) {
	$training_needs = 'Positive Relationships with Families';
}elseif ($training_needs==5) {
	$training_needs = 'Observing and Recording Principles of Child Growth and Development';
}elseif ($training_needs==6) {
	$training_needs = 'Commitment to Professionalism';
}elseif ($training_needs==7) {
	$training_needs = 'Effective Program Operation';
}elseif ($training_needs==8) {
	$training_needs = 'Health and Safety Issues';
}elseif ($training_needs==9) {
	$training_needs = 'Availability of Community Services and Resources, including those available to children with special needs';
}elseif ($training_needs==11) {
	$training_needs = 'Youth engagement';
}elseif ($training_needs==10) {
	$training_needs = 'Other';
}else{}

if (!$training_needssecond) {
	$training_needssecond = '';
}elseif ($training_needssecond==2) {
	$training_needssecond = 'Advancement of Physical/Intellectual Development';
}elseif ($training_needssecond==3) {
	$training_needssecond = 'Enhancement of Social and Emotional Development';
}elseif ($training_needssecond==4) {
	$training_needssecond = 'Positive Relationships with Families';
}elseif ($training_needssecond==5) {
	$training_needssecond = 'Observing and Recording Principles of Child Growth and Development';
}elseif ($training_needssecond==6) {
	$training_needssecond = 'Commitment to Professionalism';
}elseif ($training_needssecond==7) {
	$training_needssecond = 'Effective Program Operation';
}elseif ($training_needssecond==8) {
	$training_needssecond = 'Health and Safety Issues';
}elseif ($training_needssecond==9) {
	$training_needssecond = 'Availability of Community Services and Resources, including those available to children with special needs';
}elseif ($training_needssecond==11) {
	$training_needssecond = 'Youth engagement';
}elseif ($training_needssecond==10) {
	$training_needssecond = 'Other';
}else{}

if (!$evaluate_program) {
	$evaluate_program = '';
}elseif ($evaluate_program=='t') {
	$evaluate_program = 'Yes';
}elseif ($evaluate_program=='f') {
	$evaluate_program = 'No';
}else{}

if (!$evaluate_type) {
	$evaluate_type = '';
}elseif ($evaluate_type==1) {
	$evaluate_type = 'Informal self-assessment';
}elseif ($evaluate_type==4) {
	$evaluate_type = 'Formal self-assessment with agreed upon criteria';
}elseif ($evaluate_type==5) {
	$evaluate_type = 'Parent/client survey';
}elseif ($evaluate_type==6) {
	$evaluate_type = 'Host school evaluation';
}elseif ($evaluate_type==7) {
	$evaluate_type = 'Nationally recognized assessment or accreditation tool';
}elseif ($evaluate_type==8) {
	$evaluate_type = 'Other';
}else{}

if (!$youth_planactivity) {
	$youth_planactivity = '';
}elseif ($youth_planactivity==1) {
	$youth_planactivity = 'At least weekly';
}elseif ($youth_planactivity==2) {
	$youth_planactivity = 'Monthly';
}elseif ($youth_planactivity==3) {
	$youth_planactivity = 'Quarterly';
}elseif ($youth_planactivity==4) {
	$youth_planactivity = 'Annually';
}elseif ($youth_planactivity==5) {
	$youth_planactivity = 'Less than annually';
}else{}

if (!$youth_makerules) {
	$youth_makerules = '';
}elseif ($youth_makerules==1) {
	$youth_makerules = 'At least weekly';
}elseif ($youth_makerules==2) {
	$youth_makerules = 'Monthly';
}elseif ($youth_makerules==3) {
	$youth_makerules = 'Quarterly';
}elseif ($youth_makerules==4) {
	$youth_makerules = 'Annually';
}elseif ($youth_makerules==5) {
	$youth_makerules = 'Less than annually';
}else{}

if (!$collab_school) {
	$collab_school = '';
}elseif ($collab_school=='t') {
	$collab_school = 'Yes';
}elseif ($collab_school=='f') {
	$collab_school = 'No';
}else{}

if (!$collab_schoolfreq) {
	$collab_schoolfreq = '';
}elseif ($collab_schoolfreq==1) {
	$collab_schoolfreq = 'Weekly';
}elseif ($collab_schoolfreq==2) {
	$collab_schoolfreq = 'Monthly';
}elseif ($collab_schoolfreq==3) {
	$collab_schoolfreq = 'Quarterly';
}elseif ($collab_schoolfreq==4) {
	$collab_schoolfreq = 'Less than quarterly';
}else{}


// add these data to csv row
${'siterow_'.$ltcsv}[] = "$siteid";
${'siterow_'.$ltcsv}[] = "$verified";
${'siterow_'.$ltcsv}[] = "$updated";
${'siterow_'.$ltcsv}[] = "$name";
${'siterow_'.$ltcsv}[] = "$namesp";
${'siterow_'.$ltcsv}[] = "$phone";
${'siterow_'.$ltcsv}[] = "$fax";
${'siterow_'.$ltcsv}[] = "$email";
${'siterow_'.$ltcsv}[] = "$url";
${'siterow_'.$ltcsv}[] = "$summer";
${'siterow_'.$ltcsv}[] = "$age5";
${'siterow_'.$ltcsv}[] = "$age6";
${'siterow_'.$ltcsv}[] = "$age7";
${'siterow_'.$ltcsv}[] = "$age8";
${'siterow_'.$ltcsv}[] = "$age9";
${'siterow_'.$ltcsv}[] = "$age10";
${'siterow_'.$ltcsv}[] = "$age11";
${'siterow_'.$ltcsv}[] = "$age12";
${'siterow_'.$ltcsv}[] = "$age13";
${'siterow_'.$ltcsv}[] = "$age14";
${'siterow_'.$ltcsv}[] = "$age15";
${'siterow_'.$ltcsv}[] = "$age16";
${'siterow_'.$ltcsv}[] = "$age17";
${'siterow_'.$ltcsv}[] = "$age18";
${'siterow_'.$ltcsv}[] = "$academic";
${'siterow_'.$ltcsv}[] = "$arts";
${'siterow_'.$ltcsv}[] = "$sports";
${'siterow_'.$ltcsv}[] = "$community";
${'siterow_'.$ltcsv}[] = "$stem";
${'siterow_'.$ltcsv}[] = "$college";
${'siterow_'.$ltcsv}[] = "$leadership";
${'siterow_'.$ltcsv}[] = "$character";
${'siterow_'.$ltcsv}[] = "$prevention";
${'siterow_'.$ltcsv}[] = "$nutrition";
${'siterow_'.$ltcsv}[] = "$mentoring";
${'siterow_'.$ltcsv}[] = "$supportservices";
${'siterow_'.$ltcsv}[] = "$monstartmorning";
${'siterow_'.$ltcsv}[] = "$monendmorning";
${'siterow_'.$ltcsv}[] = "$monstartafter";
${'siterow_'.$ltcsv}[] = "$monendafter";
${'siterow_'.$ltcsv}[] = "$tuestartmorning";
${'siterow_'.$ltcsv}[] = "$tueendmorning";
${'siterow_'.$ltcsv}[] = "$tuestartafter";
${'siterow_'.$ltcsv}[] = "$tueendafter";
${'siterow_'.$ltcsv}[] = "$wedstartmorning";
${'siterow_'.$ltcsv}[] = "$wedendmorning";
${'siterow_'.$ltcsv}[] = "$wedstartafter";
${'siterow_'.$ltcsv}[] = "$wedendafter";
${'siterow_'.$ltcsv}[] = "$thustartmorning";
${'siterow_'.$ltcsv}[] = "$thuendmorning";
${'siterow_'.$ltcsv}[] = "$thustartafter";
${'siterow_'.$ltcsv}[] = "$thuendafter";
${'siterow_'.$ltcsv}[] = "$fristartmorning";
${'siterow_'.$ltcsv}[] = "$friendmorning";
${'siterow_'.$ltcsv}[] = "$fristartafter";
${'siterow_'.$ltcsv}[] = "$friendafter";
${'siterow_'.$ltcsv}[] = "$satstartweekend";
${'siterow_'.$ltcsv}[] = "$satendweekend";
${'siterow_'.$ltcsv}[] = "$sunstartweekend";
${'siterow_'.$ltcsv}[] = "$sunendweekend";
${'siterow_'.$ltcsv}[] = "$charge";
${'siterow_'.$ltcsv}[] = "$costfrequency";
${'siterow_'.$ltcsv}[] = "$costamount";
${'siterow_'.$ltcsv}[] = "$feeassistance";
${'siterow_'.$ltcsv}[] = "$scholarship";
${'siterow_'.$ltcsv}[] = "$desassistance";
${'siterow_'.$ltcsv}[] = "$mcdiscount";
${'siterow_'.$ltcsv}[] = "$otherassistance";
${'siterow_'.$ltcsv}[] = "$transportation";
${'siterow_'.$ltcsv}[] = "$snacks";
${'siterow_'.$ltcsv}[] = "$breakfast";
${'siterow_'.$ltcsv}[] = "$lunch";
${'siterow_'.$ltcsv}[] = "$dinner";
${'siterow_'.$ltcsv}[] = "$freelunch";
${'siterow_'.$ltcsv}[] = "$spanish";
${'siterow_'.$ltcsv}[] = "$otherlanguage";
${'siterow_'.$ltcsv}[] = "$capacity";
${'siterow_'.$ltcsv}[] = "$atcapacity";
${'siterow_'.$ltcsv}[] = "$served";
${'siterow_'.$ltcsv}[] = "$costsame";
${'siterow_'.$ltcsv}[] = "$slidescale";
${'siterow_'.$ltcsv}[] = "$otherassistancedescription";
${'siterow_'.$ltcsv}[] = "$transportcost";
${'siterow_'.$ltcsv}[] = "$fulltimestaff";
${'siterow_'.$ltcsv}[] = "$parttimestaff";
${'siterow_'.$ltcsv}[] = "$volunteerstaff";
${'siterow_'.$ltcsv}[] = "$workingstaff";
${'siterow_'.$ltcsv}[] = "$parentreferrals";
${'siterow_'.$ltcsv}[] = "$parenteducation";
${'siterow_'.$ltcsv}[] = "$parentinfo";
${'siterow_'.$ltcsv}[] = "$parentotherdescription";
${'siterow_'.$ltcsv}[] = "$africanamerican";
${'siterow_'.$ltcsv}[] = "$asianamerican";
${'siterow_'.$ltcsv}[] = "$latino";
${'siterow_'.$ltcsv}[] = "$nativeamerican";
${'siterow_'.$ltcsv}[] = "$white";
${'siterow_'.$ltcsv}[] = "$otherrace";
${'siterow_'.$ltcsv}[] = "$programtype";
${'siterow_'.$ltcsv}[] = "$budgetfederal";
${'siterow_'.$ltcsv}[] = "$budgetlocal";
${'siterow_'.$ltcsv}[] = "$budgetfees";
${'siterow_'.$ltcsv}[] = "$budgetgrant";
${'siterow_'.$ltcsv}[] = "$budgetreligious";
${'siterow_'.$ltcsv}[] = "$barriersfull";
${'siterow_'.$ltcsv}[] = "$barriersfulltext";
${'siterow_'.$ltcsv}[] = "$fingerprint";
${'siterow_'.$ltcsv}[] = "$drugtest";
${'siterow_'.$ltcsv}[] = "$backgroundcheck";
${'siterow_'.$ltcsv}[] = "$personalrefs";
${'siterow_'.$ltcsv}[] = "$othercheck";
${'siterow_'.$ltcsv}[] = "$prodevelop";
${'siterow_'.$ltcsv}[] = "$prodevelophours";
${'siterow_'.$ltcsv}[] = "$prodevelop_rankmost1";
${'siterow_'.$ltcsv}[] = "$prodevelop_rank2";
${'siterow_'.$ltcsv}[] = "$prodevelop_rank3";
${'siterow_'.$ltcsv}[] = "$prodevelop_rank4";
${'siterow_'.$ltcsv}[] = "$prodevelop_rankleast5";
${'siterow_'.$ltcsv}[] = "$training_ownstaff";
${'siterow_'.$ltcsv}[] = "$training_aascc";
${'siterow_'.$ltcsv}[] = "$training_azcase";
${'siterow_'.$ltcsv}[] = "$training_azdhs";
${'siterow_'.$ltcsv}[] = "$training_naa";
${'siterow_'.$ltcsv}[] = "$training_niost";
${'siterow_'.$ltcsv}[] = "$training_shd";
${'siterow_'.$ltcsv}[] = "$training_other";
${'siterow_'.$ltcsv}[] = "$training_needs";
${'siterow_'.$ltcsv}[] = "$training_needsother";
${'siterow_'.$ltcsv}[] = "$training_needssecond";
${'siterow_'.$ltcsv}[] = "$training_needssecond_other";
${'siterow_'.$ltcsv}[] = "$evaluate_program";
${'siterow_'.$ltcsv}[] = "$evaluate_type";
${'siterow_'.$ltcsv}[] = "$youth_planactivity";
${'siterow_'.$ltcsv}[] = "$youth_makerules";
${'siterow_'.$ltcsv}[] = "$collab_school";
${'siterow_'.$ltcsv}[] = "$collab_schoolfreq";

$ltcsv++;

} // close site loop

$sitefile = fopen("export/allsites.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $ltcsv; $i++) {
	fputcsv($sitefile, ${'siterow_'.$i});
}

fclose($sitefile); 


// create csv and kml exports for all locations
// sites CSV header
$locationrow_0 = array( );
$locationrow_0[] = 'Location ID';
$locationrow_0[] = 'Location Name';
$locationrow_0[] = 'Location Name (Spanish)';
$locationrow_0[] = 'Address';
$locationrow_0[] = 'Address Line 2';
$locationrow_0[] = 'City';
$locationrow_0[] = 'State';
$locationrow_0[] = 'Zip';

// kml body variable
// set CSV counter to row 1
$ltcsv = 1;

$locationquery = "SELECT locationid, name, namesp, address, address2, city, state, zip, lat, lon FROM azcase_locations ORDER BY name;";
$record = pg_query($connection, $locationquery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
    $locationid = pg_result($record, $lt, 0);
    $name = pg_result($record, $lt, 1);
    $namesp = pg_result($record, $lt, 2);
    $address = pg_result($record, $lt, 3);
    $address2 = pg_result($record, $lt, 4);
    $city = pg_result($record, $lt, 5);
    $state = pg_result($record, $lt, 6);
    $zip = pg_result($record, $lt, 7);
    $lat = pg_result($record, $lt, 8);
    $lon = pg_result($record, $lt, 9);

// add these data to csv row
${'locationrow_'.$ltcsv}[] = "$locationid";
${'locationrow_'.$ltcsv}[] = "$name";
${'locationrow_'.$ltcsv}[] = "$namesp";
${'locationrow_'.$ltcsv}[] = "$address";
${'locationrow_'.$ltcsv}[] = "$address2";
${'locationrow_'.$ltcsv}[] = "$city";
${'locationrow_'.$ltcsv}[] = "$state";
${'locationrow_'.$ltcsv}[] = "$zip";


// pull site data and link to sites for kml
// clear variables
$schoolyearsites = '';
$summersites = '';

// add school year entry to pop-up if there are school year programs at the site
$countquery = "SELECT count(*) FROM azcase_sites WHERE summer = FALSE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid);";
$countresult = pg_query($connection, $countquery);
$countschoolyear = pg_result($countresult, 0, 0);

if ($countschoolyear>0) {

	$schoolyearsites = '<h2>School Year Programs</h2><ul>';
	// pull and store all the school year sites associated with this location
	$sitequery = "SELECT siteid, name FROM azcase_sites WHERE summer = FALSE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid);";
	$record1 = pg_query($connection, $sitequery);
	  for ($lt1 = 0; $lt1 < pg_numrows($record1); $lt1++) {
	    $siteid = pg_result($record1, $lt1, 0);
	    $sitename = pg_result($record1, $lt1, 1);

		//string replace for "&" and "<", which are illegal for sitename and sitenamesp
		$sitename = str_replace("&", "and", $sitename);
		$sitename = str_replace("<", " ", $sitename);
		//escape name string
		$sitename = addslashes($sitename);
		$sitename = trim($sitename);

		$schoolyearsites .= '<li><a href="http://maps.nijel.org/azcase/site.php?siteid=';
		$schoolyearsites .= $siteid;
		$schoolyearsites .= '&locationid=';
		$schoolyearsites .= $locationid;
		$schoolyearsites .= '">';
		$schoolyearsites .= $sitename;
		$schoolyearsites .= '</a></li>';

	}

	$schoolyearsites .= "</ul>";

} //close if ($countschoolyear>0) {


// add summer entry to pop-up if there are summer programs at the site
$countquery = "SELECT count(*) FROM azcase_sites WHERE summer = TRUE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid);";
$countresult = pg_query($connection, $countquery);
$countsummer = pg_result($countresult, 0, 0);

if ($countsummer>0) {

	$summersites = '<h2>Summer Programs</h2><ul>';
	// pull and store all the school year sites associated with this location
	$sitequery = "SELECT siteid, name FROM azcase_sites WHERE summer = TRUE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid);";
	$record1 = pg_query($connection, $sitequery);
	  for ($lt1 = 0; $lt1 < pg_numrows($record1); $lt1++) {
	    $siteid = pg_result($record1, $lt1, 0);
	    $sitename = pg_result($record1, $lt1, 1);

		//string replace for "&" and "<", which are illegal for sitename and sitenamesp
		$sitename = str_replace("&", "and", $sitename);
		$sitename = str_replace("<", " ", $sitename);
		//escape name string
		$sitename = addslashes($sitename);
		$sitename = trim($sitename);

		$summersites .= '<li><a href="http://maps.nijel.org/azcase/site.php?siteid=';
		$summersites .= $siteid;
		$summersites .= '&locationid=';
		$summersites .= $locationid;
		$summersites .= '">';
		$summersites .= $sitename;
		$summersites .= '</a></li>';

	}

	$summersites .= "</ul>";

} //close if ($countsummer>0) {

//string replace for "&" and "<", which are illegal for location name
$name = str_replace("&", "and", $name);
$name = str_replace("<", " ", $name);
//escape name string
$name = addslashes($name);
$name = trim($name);

$kmlbody .= "	<Placemark>
		<name>$name</name>
		<description><![CDATA[<b>Address:</b> $address $address2, $city, $state $zip <br />$schoolyearsites $summersites<br />]]></description>
		<Point>
			<coordinates>$lon,$lat</coordinates>
		</Point>
	</Placemark>
";

$ltcsv++;

} // close location loop


// create csv file
$locationfile = fopen("export/alllocations.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $ltcsv; $i++) {
	fputcsv($locationfile, ${'locationrow_'.$i});
}

fclose($locationfile); 

// put together the locations kml
$kmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns:geo=\"http://www.opengis.net/kml/2.2\">
<Document>
  <name>Arizona Afterschool Program Directory All Locations</name>
  <description>Arizona Afterschool Program Directory All Locations KML File</description>
";

$kmlfooter = "
</Document>
</kml>
";

$kml = $kmlheader . $kmlbody . $kmlfooter;

$locationkmlfile = fopen("export/alllocations.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// create users data export
// create csv and kml exports for all locations
// sites CSV header
$userrow_0 = array( );
$userrow_0[] = 'User ID';
$userrow_0[] = 'User Name';
$userrow_0[] = 'User Email';
$userrow_0[] = 'Updated';
$userrow_0[] = 'Organization Name';
$userrow_0[] = 'Organization Address';
$userrow_0[] = 'Organization Phone';
$userrow_0[] = 'Organization Fax';

$ltcsv = 1;

$basicinfoquery = "SELECT 
userid,
username,
useremail,
updated,
orgname,
address,
address2,
city,
state,
zip,
phone,
fax
FROM azcase_users ORDER BY username;";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
	$username = pg_result($basicinforesult, $lt, 1);
	$useremail = pg_result($basicinforesult, $lt, 2);
	$updated = pg_result($basicinforesult, $lt, 3);
	$orgname = pg_result($basicinforesult, $lt, 4);
	$address = pg_result($basicinforesult, $lt, 5);
	$address2 = pg_result($basicinforesult, $lt, 6);
	$city = pg_result($basicinforesult, $lt, 7);
	$state = pg_result($basicinforesult, $lt, 8);
	$zip = pg_result($basicinforesult, $lt, 9);
	$phone = pg_result($basicinforesult, $lt, 10);
	$fax = pg_result($basicinforesult, $lt, 11);

//change updated to Month, Day Year format
if (!$updated) {
	$updated = 'Not Updated';
}else{
	$updated = date('n/d/Y', strtotime($updated)); 
}

// format address
$printaddress = $address;
if (!$address2) { 
	$printaddress .= '; '; 
}else{ 
	$printaddress .=  ' ' . $address2 . '; '; 
}
$printaddress .= $city . ' ';
$printaddress .= $state . ' ';
$printaddress .= $zip . ' '; 


// add these data to csv row
${'userrow_'.$ltcsv}[] = "$userid";
${'userrow_'.$ltcsv}[] = "$username";
${'userrow_'.$ltcsv}[] = "$useremail";
${'userrow_'.$ltcsv}[] = "$updated";
${'userrow_'.$ltcsv}[] = "$orgname";
${'userrow_'.$ltcsv}[] = "$printaddress";
${'userrow_'.$ltcsv}[] = "$phone";
${'userrow_'.$ltcsv}[] = "$fax";

$ltcsv++; 

}

// create csv file
$userfile = fopen("export/allusers.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $ltcsv; $i++) {
	fputcsv($userfile, ${'userrow_'.$i});
}

fclose($userfile); 




?>
<body>
<h1>Admin: Export Data for All Locations and Sites</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a></p>
<h2>Export all data for Sites</h2>
<a href="exportcsv.php?filename=allsites.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<h2>Export all data for Locations</h2>
<a href="exportcsv.php?filename=alllocations.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="exportcsv.php?filename=alllocations.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />
<h2>Export all data for Users</h2>
<a href="exportcsv.php?filename=allusers.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?php

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>
