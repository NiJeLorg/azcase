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
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];

$searchusername = stripslashes($searchusername);
$searchuseremail = stripslashes($searchuseremail);
$searchorgname = stripslashes($searchorgname);

$searchusername = trim($searchusername);
$searchuseremail = trim($searchuseremail);
$searchorgname = trim($searchorgname);

// print what the user searched for 
$yousearchedfor = '<br /><b>You searched for:</b><ul>';

// set up you searched for fields
if (!$searchusername) {
}else{
	$yousearchedfor .= '<li><b>Name:</b> ' . $searchusername . '</li>';
}

if (!$searchuseremail) {
}else{
	$yousearchedfor .= '<li><b>Email:</b> ' . $searchuseremail . '</li>';
}

if (!$searchorgname) {
}else{
	$yousearchedfor .= '<li><b>Organization Name:</b> ' . $searchorgname . '</li>';
}

$yousearchedfor .= "</ul><br />";



// build where statement
$where = '';
if (!$searchusername && !$searchuseremail && !$searchorgname) {
}else{
	$where = 'WHERE ';
}

if (!$searchusername) {
}else{
	$where .= "((username ILIKE '%$searchusername%') OR (username ILIKE '$searchusername%') OR (username ILIKE '%$searchusername')) ";
}

if ($searchusername!='' && ($searchuseremail!='' || $searchorgname!='')) {
	$where .= 'OR ';
}else{}

if (!$searchuseremail) {
}else{
	$where .= "((useremail ILIKE '%$searchuseremail%') OR (useremail ILIKE '$searchuseremail%') OR (useremail ILIKE '%$searchuseremail')) ";
}

if ($searchuseremail!='' && $searchorgname!='') {
	$where .= 'OR ';
}else{}

if (!$searchorgname) {
}else{
	$where .= "((orgname ILIKE '%$searchorgname%') OR (orgname ILIKE '$searchorgname%') OR (orgname ILIKE '$searchorgname%')) ";
}


// select users data that matches the keywords
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
FROM azcase_users $where;";
$basicinforesult = pg_query($connection, $basicinfoquery);

// if any no users are found, then print no users found, if not skip
if (pg_numrows($basicinforesult)==0) {
	$userstable = "<h1>No Users Found</h1><p><a href=\"adminsearchhome.php\">Go back</a> to the Admin Dashboard to search again.</p>$yousearchedfor";
}else{

// create table to add users with edit and remove links
$userstable = "<h1>Users Search Results</h1>
<p><a href=\"providerhome.php\">&#60;&#60; Back to Your Admin Dashboard</a> | <a href=\"adminsearchhome.php\">&#60;&#60; Back to Search For Users, Sites and Locations</a></p>
$yousearchedfor
<table class=\"hoursTable\"><tr>
<th>Remove</th>
<th>Edit</th>
<th>Sites and Data Management</th>
<th>Name</th>
<th>Organization Name</th>
<th>Email</th>
<th>Address</th>
<th>Phone</th>
<th>Fax</th>
<th>Last Updated</th>
</tr>
";

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

// find out how many sites are associated with this user account
$emailquery = "SELECT count(*)
FROM azcase_user_sites_junction
JOIN azcase_users ON azcase_users.userid = azcase_user_sites_junction.userid
JOIN azcase_sites ON azcase_sites.siteid = azcase_user_sites_junction.siteid
WHERE azcase_users.userid=$userid AND (azcase_sites.verified = 1 OR azcase_sites.verified = 2);";

//connect to db for data query
$emailresult = pg_query($connection, $emailquery);
$sitecount = pg_fetch_result($emailresult, 0, 0);


// format updated date
$updated = date("M j, Y", strtotime($updated));

// format address
$printaddress = $address;
if (!$address2) { 
	$printaddress .= '<br />'; 
}else{ 
	$printaddress .=  ' ' . $address2 . '<br />'; 
}
$printaddress .= $city . ' ';
$printaddress .= $state . ' ';
$printaddress .= $zip . ' '; 

if ($lt&1) {
	$trclass = "<tr class=\"notverified\">";
}else{
	$trclass = "<tr>";
}

// add a new row to the users table
$userstable .= $trclass;

$userstable .= "<td><a href=\"adminremoveuser.php?userid=$userid&searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">Remove</a></td><td><a href=\"adminedituser.php?userid=$userid&searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">Edit</a></td><td style=\"text-align:center\"><a href=\"admindatamanagement.php?userid=$userid&searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">$sitecount Site(s)</a></td>";

$userstable .= "<td>$username</td>
<td>$orgname</td>
<td>$useremail</td>
<td>$printaddress</td>
<td>$phone</td>
<td>$fax</td>
<td>$updated</td>
</tr>";

} // close user loop

// close up the users table
$userstable .= "
</table>
<br />
";

} // close if then if users exist

?>
<body>

<?php
echo $userstable;

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>
