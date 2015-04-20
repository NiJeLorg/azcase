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

// grab data and clean up for database query
$searchname = $_REQUEST['searchname'];
$searchemail = $_REQUEST['searchemail'];
$searchphone = $_REQUEST['searchphone'];

$searchname = stripslashes($searchname);
$searchemail = stripslashes($searchemail);
$searchphone = stripslashes($searchphone);

$searchname = trim($searchname);
$searchemail = trim($searchemail);
$searchphone = trim($searchphone);

// print what the user searched for 
$yousearchedfor = '<br /><b>You searched for:</b><ul>';

// set up you searched for fields
if (!$searchname) {
}else{
	$yousearchedfor .= '<li><b>Name:</b> ' . $searchname . '</li>';
}

if (!$searchemail) {
}else{
	$yousearchedfor .= '<li><b>Email:</b> ' . $searchemail . '</li>';
}

if (!$searchphone) {
}else{
	$yousearchedfor .= '<li><b>Phone:</b> ' . $searchphone . '</li>';
}

$yousearchedfor .= "</ul><br />";


// build where statement
$where = '';
if (!$searchname) {
}else{
	$where .= "((name ILIKE '%$searchname%') OR (name ILIKE '$searchname%') OR (name ILIKE '%$searchname')) ";
}

if ($searchname!='' && ($searchemail!='' || $searchphone!='')) {
	$where .= 'OR ';
}else{}

if (!$searchemail) {
}else{
	$where .= "((email ILIKE '%$searchemail%') OR (email ILIKE '$searchemail%') OR (email ILIKE '%$searchemail')) ";
}

if ($searchemail!='' && $searchphone!='') {
	$where .= 'OR ';
}else{}

if (!$searchphone) {
}else{
	$where .= "((phone ILIKE '%$searchphone%') OR (phone ILIKE '$searchphone%') OR (phone ILIKE '%$searchphone'))";
}


// select users data that matches the keywords
$sitesquery = "SELECT 
siteid,
name,
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
summer,
updated,
verified,
stem,
college,
phone,
email
FROM azcase_sites WHERE (verified = 1 OR verified = 2) AND ($where) ORDER BY name, summer;";
$sitesresult = pg_query($connection, $sitesquery);

// if any no users are found, then print no users found, if not skip
if (pg_numrows($sitesresult)==0) {
	$sitestable = "<h1>No Sites Found</h1><p><a href=\"providerhome.php\">Go back</a> to the Admin Dashboard to search again.</p>$yousearchedfor";
}else{

// create table to add users with edit and remove links
$sitestable = "<h1>Users Search Results</h1>
<p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a></p>
$yousearchedfor
<p>Please note that sites that are NOT verified are highlighted in a darker shade of grey.</p>
<table class=\"hoursTable\"><tr>
<th>Remove</th>
<th>Edit</th>
<th>Site Name</th>
<th>Address</th>
<th>Phone</th>
<th>Email</th>
<th>Activites</th>
<th>Ages Served</th>
<th>Last Updated</th>
</tr>
";

for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$siteid = pg_result($sitesresult, $lt, 0);
	$sitename = pg_result($sitesresult, $lt, 1);
	$age5 = pg_result($sitesresult, $lt, 2);
	$age6 = pg_result($sitesresult, $lt, 3);
	$age7 = pg_result($sitesresult, $lt, 4);
	$age8 = pg_result($sitesresult, $lt, 5);
	$age9 = pg_result($sitesresult, $lt, 6);
	$age10 = pg_result($sitesresult, $lt, 7);
	$age11 = pg_result($sitesresult, $lt, 8);
	$age12 = pg_result($sitesresult, $lt, 9);
	$age13 = pg_result($sitesresult, $lt, 10);
	$age14 = pg_result($sitesresult, $lt, 11);
	$age15 = pg_result($sitesresult, $lt, 12);
	$age16 = pg_result($sitesresult, $lt, 13);
	$age17 = pg_result($sitesresult, $lt, 14);
	$age18 = pg_result($sitesresult, $lt, 15);
	$arts = pg_result($sitesresult, $lt, 16);
	$character = pg_result($sitesresult, $lt, 17);
	$leadership = pg_result($sitesresult, $lt, 18);
	$mentoring = pg_result($sitesresult, $lt, 19);
	$nutrition = pg_result($sitesresult, $lt, 20);
	$prevention = pg_result($sitesresult, $lt, 21);
	$sports = pg_result($sitesresult, $lt, 22);
	$supportservices = pg_result($sitesresult, $lt, 23);
	$academic = pg_result($sitesresult, $lt, 24);
	$community = pg_result($sitesresult, $lt, 25);
	$summer = pg_result($sitesresult, $lt, 26);
	$siteupdated = pg_result($sitesresult, $lt, 27);
	$verified = pg_result($sitesresult, $lt, 28);
	$stem = pg_result($sitesresult, $lt, 29);
	$college = pg_result($sitesresult, $lt, 30);
	$phone = pg_result($sitesresult, $lt, 31);
	$email = pg_result($sitesresult, $lt, 32);

// format updated date
$siteupdated = date("M j, Y", strtotime($siteupdated));

// format ages
require('formatage.php');

// format activity categories
require('formatactivity.php');

// pull address location for this site
$siteaddressquery = "SELECT address, address2, city, state, zip FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteid);";
$siteaddressresult = pg_query($connection, $siteaddressquery);
for ($lt1 = 0; $lt1 < pg_numrows($siteaddressresult); $lt1++) {
	$siteaddress = pg_result($siteaddressresult, $lt1, 0);
	$siteaddress2 = pg_result($siteaddressresult, $lt1, 1);
	$sitecity = pg_result($siteaddressresult, $lt1, 2);
	$sitestate = pg_result($siteaddressresult, $lt1, 3);
	$sitezip = pg_result($siteaddressresult, $lt1, 4);
}

// format address
$printsiteaddress = $siteaddress;
if (!$siteaddress2) { 
	$printsiteaddress .= '<br />'; 
}else{ 
	$printsiteaddress .=  ' ' . $siteaddress2 . '<br />'; 
}
$printsiteaddress .= $sitecity . ' ';
$printsiteaddress .= $sitestate . ' ';
$printsiteaddress .= $sitezip . ' '; 

if ($verified==2) {
	$trclass = "<tr class=\"notverified\">";
}else{
	$trclass = "<tr>";
}

// Add (SUMMER SITE) to the end of the site name 
if ($summer=='t') {
	$sitename = $sitename . ' <b>(SUMMER SITE)</b>';
}else{}

// add a new row to the sites table
$sitestable .= $trclass;

$sitestable .= "<td><a href=\"adminremovesite.php?siteid=$siteid&searchname=$searchname&searchemail=$searchemail&searchphone=$searchphone\">Remove</a></td><td><a href=\"admineditsite.php?siteid=$siteid&searchname=$searchname&searchemail=$searchemail&searchphone=$searchphone\">Edit</a></td>";

$sitestable .= "<td>$sitename</td>
<td>$printsiteaddress</td>
<td>$phone</td>
<td>$email</td>
<td>$activities</td>
<td>$agesserved</td>
<td>$siteupdated</td>
</tr>";

} // close user loop

// close up the users table
$sitestable .= "
</table>
<br />
";

} // close if then if users exist

?>
<body>

<?php
echo $sitestable;

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>
