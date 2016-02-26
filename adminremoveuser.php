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

// grab data and clean up for database query
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];


// pull user/org info
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
FROM azcase_users WHERE userid = $userid;";
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
}

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


?>
<body>
<h1>Remove User</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="adminsearchusers.php?userid=<?php echo $userid; ?>&searchusername=<?php echo $searchusername; ?>&searchuseremail=<?php echo $searchuseremail; ?>&searchorgname=<?php echo $searchorgname; ?>">&#60;&#60; Back to Your Search Results For Users</a></p>
<p>If you would like to remove this user, please click the "Remove User" button below. <b>Please note that this operation cannot be undone!</b></p>

<form name="removeprovider" action="processadminremoveuser.php" method="POST">
<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
<input type="hidden" name="searchusername" value="<?php echo $searchusername; ?>" />
<input type="hidden" name="searchuseremail" value="<?php echo $searchuseremail; ?>" />
<input type="hidden" name="searchorgname" value="<?php echo $searchorgname; ?>" />
<table class="hoursTable">
	<tr>
		<th>Remove</th>
		<th>Name</th>
		<th>Organization Name</th>
		<th>Email</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Fax</th>
		<th>Last Updated</th>
	</tr>
	<tr>
		<td><input type="submit" name="remove" value="Remove User &#62;&#62;" /></td>
		<td><?php echo $username; ?></td>
		<td><?php echo $orgname; ?></td>
		<td><?php echo $useremail; ?></td>
		<td><?php echo $printaddress; ?></td>
		<td><?php echo $phone; ?></td>
		<td><?php echo $fax; ?></td>
		<td><?php echo $updated; ?></td>
	</tr>
</table>
</form>
<br />
<br />

<?php
// pull sites connected to this user and create a table for the html
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
college
FROM azcase_sites WHERE (verified = 1 OR verified = 2) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid) ORDER BY name, summer;";
$sitesresult = pg_query($connection, $sitesquery);

// loop though sites if user has sites associated - if not skip
if (pg_numrows($sitesresult)==0) {
	$sitestable = "";
}else{

// create table to add sites to with form to batch edit or delete
$sitestable = "<h1>Associated Sites</h1>
<p>The following sites are associated with the above user. <b>By removing the above user, you will also remove their association with the sites below. You will not remove these sites from the system.</b></p> 
<table class=\"hoursTable\"><tr>
<th>Verified?</th>
<th>Site Name</th>
<th>Address</th>
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
}elseif ($lt&1) {
	$trclass = "<tr class=\"alt\">";
}else{
	$trclass = "<tr>";
}

// Add (SUMMER SITE) to the end of the site name 
if ($summer=='t') {
	$sitename = $sitename . ' <b>(SUMMER SITE)</b>';
}else{}

// add a new row to the sites table
$sitestable .= $trclass;

// if verified is 2, then don't allow editing or checkbox
if ($verified==1) {
	$sitestable .= "<td align=\"center\"><b>VERIFIED</b></td>";
}elseif ($verified==2) {
	$sitestable .= "<td align=\"center\"><b>NOT VERIFIED</b></td>";
}

$sitestable .= "<td>$sitename</td>
<td>$printsiteaddress</td>
<td>$activities</td>
<td>$agesserved</td>
<td>$siteupdated</td>
</tr>";

} // close site loop

// close up the sites table
$sitestable .= "
</table>
";

} // close if then if sites exist

echo $sitestable;



// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>

