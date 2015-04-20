<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

global $connection;

if ($admin=='t') {

// grab data and clean up for database query
$locationid = $_REQUEST['locationid'];
$zoom = $_REQUEST['zoom'];
$searchstreet = $_REQUEST['searchstreet'];
$searchcity = $_REQUEST['searchcity'];
$searchstate = $_REQUEST['searchstate'];
$searchzip = $_REQUEST['searchzip'];


// pull data for siteid 
$locationquery = "SELECT name, namesp, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid;";
$record = pg_query($connection, $locationquery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
    $name = pg_result($record, $lt, 0);
    $namesp = pg_result($record, $lt, 1);
    $address = pg_result($record, $lt, 2);
    $address2 = pg_result($record, $lt, 3);
    $city = pg_result($record, $lt, 4);
    $state = pg_result($record, $lt, 5);
    $zip = pg_result($record, $lt, 6);
}

// format updated date
$updated = date("M j, Y", strtotime($updated));


?>
<body>
<h3>Remove Location</h3>
<p>If you would like to remove this location, please click the "Remove Location" button below. <strong>Please note that this operation cannot be undone!</strong></p>

<form name="removelocation" action="processadminremovelocation.php" method="POST">
<input type="hidden" name="locationid" value="<?php echo $locationid; ?>" />
<input type="hidden" name="zoom" value="<?php echo $zoom; ?>" />
<input type="hidden" name="searchstreet" value="<?php echo $searchstreet; ?>" />
<input type="hidden" name="searchcity" value="<?php echo $searchcity; ?>" />
<input type="hidden" name="searchstate" value="<?php echo $searchstate; ?>" />
<input type="hidden" name="searchzip" value="<?php echo $searchzip; ?>" />
<table class="hoursTable">
	<tr>
		<th>Remove</th>
		<th>Location Name</th>
		<th>Location Name (Espanol)</th>
		<th>Address</th>
		<th>Address Line 2</th>
		<th>City</th>
		<th>State</th>
		<th>Zip</th>
	</tr>
	<tr>
		<td><input type="submit" name="remove" value="Remove Location &#62;&#62;" /></td>
		<td><?php echo $name; ?></td>
		<td><?php echo $namesp; ?></td>
		<td><?php echo $address; ?></td>
		<td><?php echo $address2; ?></td>
		<td><?php echo $city; ?></td>
		<td><?php echo $state; ?></td>
		<td><?php echo $zip; ?></td>
	</tr>
</table>
</form>
<br />
<br />

<?php
// pull sites connected to this location and create a table for the html
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
FROM azcase_sites WHERE (verified = 1 OR verified = 2) AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid) ORDER BY name, summer;";
$sitesresult = pg_query($connection, $sitesquery);

// loop though sites if user has sites associated - if not skip
if (pg_numrows($sitesresult)==0) {
	$sitestable = "";
}else{

// create table to add sites to with form to batch edit or delete
$sitestable = "<h3>Associated Sites</h3>
<p>The following sites are associated with the above location. <strong>By removing the above location, you will also remove their association with the sites below. You will not remove these sites from the system.</strong></p> 
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
	$sitename = $sitename . ' <strong>(SUMMER SITE)</strong>';
}else{}

// add a new row to the sites table
$sitestable .= $trclass;

// if verified is 2, then don't allow editing or checkbox
if ($verified==1) {
	$sitestable .= "<td align=\"center\"><strong>VERIFIED</strong></td>";
}elseif ($verified==2) {
	$sitestable .= "<td align=\"center\"><strong>NOT VERIFIED</strong></td>";
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

