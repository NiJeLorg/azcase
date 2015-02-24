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

// accept site id
$siteid = $_REQUEST['siteid'];

// grab search terms if coming from search page
$searchname = $_REQUEST['searchname'];
$searchemail = $_REQUEST['searchemail'];
$searchphone = $_REQUEST['searchphone'];


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
	$sitename = $sitename . ' <b>(SUMMER SITE)</b>';
}else{}


?>
<body>
<h1>Remove Site</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="adminsearchsites.php?searchname=<?php echo $searchname; ?>&searchemail=<?php echo $searchemail; ?>&searchphone=<?php echo $searchphone; ?>">&#60;&#60; Back to Your Search Results For Sites</a></p>
<p>If you would like to remove this site, please click the "Remove Site" button below. <b>Please note that this operation cannot be undone!</b></p>

<form name="removesite" action="processadminremovesite.php" method="POST">
<input type="hidden" name="siteid" value="<?php echo $siteid; ?>" />
<input type="hidden" name="searchname" value="<?php echo $searchname; ?>" />
<input type="hidden" name="searchemail" value="<?php echo $searchemail; ?>" />
<input type="hidden" name="searchphone" value="<?php echo $searchphone; ?>" />
<table class="hoursTable">
	<tr>
		<th>Remove</th>
		<th>Site Name</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Activites</th>
		<th>Ages Served</th>
		<th>Last Updated</th>
	</tr>
	<tr>
		<td><input type="submit" name="remove" value="Remove Site &#62;&#62;" /></td>
		<td><a href="site.php?siteid=<?php echo $siteid; ?>&locationid=<?php echo $locationid; ?>"><?php echo $sitename; ?></a></td>
		<td><?php echo $printsiteaddress; ?></td>
		<td><?php echo $phone; ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $activities; ?></td>
		<td><?php echo $agesserved; ?></td>
		<td><?php echo $siteupdated; ?></td>
	</tr>
</table>
</form>
<br />
<br />

<?php
// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>

