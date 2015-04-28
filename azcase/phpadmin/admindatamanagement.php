<?php
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

global $connection;

// grab data and clean up for database query and for retunr to last page
$userid = $_REQUEST['userid'];

// pull user/org info
$basicinfoquery = "SELECT 
username,
useremail
FROM azcase_users WHERE userid = $userid;";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$username = pg_result($basicinforesult, $lt, 0);
	$useremail = pg_result($basicinforesult, $lt, 1);
}


$where = "siteid IN (SELECT azcase_sites.siteid
FROM azcase_user_sites_junction
JOIN azcase_users ON azcase_users.userid = azcase_user_sites_junction.userid
JOIN azcase_sites ON azcase_sites.siteid = azcase_user_sites_junction.siteid
WHERE azcase_users.userid=$userid)";

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
email,
verified
FROM azcase_sites WHERE (verified = 1 OR verified = 2) AND $where ORDER BY name, summer;";
$sitesresult = pg_query($connection, $sitesquery);

// if any no users are found, then print no users found, if not skip
if (pg_numrows($sitesresult)==0) {
	$sitestable = "<h3 class=\"azcase-text-color\">No Sites Associated With $username ($useremail)</h3>";
}else{

// create table to add users with edit and remove links
$sitestable = "<h3 class=\"azcase-text-color\">Sites Associated with $username ($useremail)</h3>
<table class=\"table\"><tr>
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

// create ability for admins to add new users
$adminassign = "
<h3 class=\"azcase-text-color\">Assign Other Users to Manage Data for $username ($useremail)</h3>
<p>If you would like to add other users to assist in managing data for $username ($useremail), please enter their email address below.</p>
<form name=\"search\" action=\"adminassignusers.php\" method=\"POST\">
<input type=\"hidden\" name=\"userid\" value=\"$userid\">
<div class=\"col-md-6\">
	<div class=\"form-group\">
		<label>Email: </label>
		<input class=\"form-control\" type=\"email\" name=\"email\" value=\"\"/>
	</div>
</div>
<input class=\"btn btn-default\" type=\"submit\" name=\"action\" value=\"Search\" />
<br />
</p>
</form>
";

// show who has access to manage users for this user
$otherusersquery = "SELECT userid, username, useremail FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
$otherusersresult = pg_query($connection, $otherusersquery);

// loop though sites if user has sites associated - if not skip
if (pg_numrows($otherusersresult)==0) {
}else{

$otheruserstable = "<h4 class=\"azcase-text-color\">Other Users Assigned to Manage Data for $username ($useremail)</h4>
<p>If you would like to remove any users from data management, please select them below.</p>
<form name=\"editremove\" action=\"processadminremoveassignusers.php\" method=\"POST\">
<input type=\"hidden\" name=\"userid\" value=\"$userid\">
<table class=\"table\"><tr>
<th>Select</th>
<th>Name</th>
<th>Email</th>
</tr>
";

for ($lt = 0; $lt < pg_numrows($otherusersresult); $lt++) {
	$assigneduserid = pg_result($otherusersresult, $lt, 0);
	$assignedusername = pg_result($otherusersresult, $lt, 1);
	$assigneduseremail = pg_result($otherusersresult, $lt, 2);

if ($lt&1) {
	$trclass = "<tr class=\"alt\">";
}else{
	$trclass = "<tr>";
}

// add a new row to the sites table
$otheruserstable .= $trclass;
$otheruserstable .= "<td align=\"center\"><input type=\"checkbox\" name=\"$assigneduserid\" value=\"t\" /></td>
<td>$assignedusername</td>
<td>$assigneduseremail</td>
</tr>";

} // close other users loop

// close up the sites table
$otheruserstable .= "
</table>
<br />
<input class=\"btn btn-default\" type=\"submit\" name=\"remove\" value=\"Remove Selected Users From Management\" />
</form>
";

} // close if then if other users exist


} // close if then if users exist

?>
<body>

<?php
echo $sitestable;
echo $adminassign;
echo $otheruserstable;


// create footer
require('footer.php');

?>
