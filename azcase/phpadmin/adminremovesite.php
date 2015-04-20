<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// accept site id
$siteid = $_REQUEST['siteid'];

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
FROM azcase_sites WHERE siteid = $siteid;";
$sitesresult = pg_query($connection, $sitesquery);
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
}

// format updated date
$siteupdated = date("M j, Y", strtotime($siteupdated));

// format ages
require('formatage.php');

// format activity categories
require('formatactivity.php');

// pull address location for this site
$siteaddressquery = "SELECT address, address2, city, state, zip, locationid FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteid);";
$siteaddressresult = pg_query($connection, $siteaddressquery);
for ($lt1 = 0; $lt1 < pg_numrows($siteaddressresult); $lt1++) {
	$siteaddress = pg_result($siteaddressresult, $lt1, 0);
	$siteaddress2 = pg_result($siteaddressresult, $lt1, 1);
	$sitecity = pg_result($siteaddressresult, $lt1, 2);
	$sitestate = pg_result($siteaddressresult, $lt1, 3);
	$sitezip = pg_result($siteaddressresult, $lt1, 4);
	$locationid = pg_result($siteaddressresult, $lt1, 5);
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
	$sitename = $sitename . ' <strong>(SUMMER SITE)</strong>';
}else{}


?>
<body>
<h3 class='azcase-text-color'>Remove Site</h3>
<p>If you would like to remove this site, please click the "Remove Site" button below. <strong>Please note that this operation cannot be undone!</strong></p>

<form name="removesite" action="processadminremovesite.php" method="POST">
<input type="hidden" name="siteid" value="<?php echo $siteid; ?>" />
<table class="table">
	<tr>
		<th>Site Name</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Activites</th>
		<th>Ages Served</th>
		<th>Last Updated</th>
	</tr>
	<tr>
		<td><?php echo $sitename; ?></td>
		<td><?php echo $printsiteaddress; ?></td>
		<td><?php echo $phone; ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $activities; ?></td>
		<td><?php echo $agesserved; ?></td>
		<td><?php echo $siteupdated; ?></td>
	</tr>
</table>
<br />
<input class="btn btn-default" type="submit" name="remove" value="Remove Site &#62;&#62;" />
</form>

<?php
// create footer
require('footer.php');

?>

