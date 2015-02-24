<?php

$useremailsession = pg_escape_string($_SESSION['useremail']);
// pull basic information for providers and store in varibles
$basicinfoquery = "SELECT 
userid,
username,
firstlogin,
lastlogintime,
updated,
orgname,
address,
address2,
city,
state,
zip,
phone,
fax
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
	$username = pg_result($basicinforesult, $lt, 1);
	$firstlogin = pg_result($basicinforesult, $lt, 2);
	$lastlogintime = pg_result($basicinforesult, $lt, 3);
	$updated = pg_result($basicinforesult, $lt, 4);
	$orgname = pg_result($basicinforesult, $lt, 5);
	$orgaddress = pg_result($basicinforesult, $lt, 6);
	$orgaddress2 = pg_result($basicinforesult, $lt, 7);
	$orgcity = pg_result($basicinforesult, $lt, 8);
	$orgstate = pg_result($basicinforesult, $lt, 9);
	$orgzip = pg_result($basicinforesult, $lt, 10);
	$orgphone = pg_result($basicinforesult, $lt, 11);
	$orgfax = pg_result($basicinforesult, $lt, 12);
}

// remove any stray junctions between this user and locations that exist in the temp user/locations junction table
$removeuserloc = "DELETE FROM azcase_user_locations_junction WHERE userid = $userid;";
// remove silently
pg_send_query($connection, $removeuserloc);

// format updated date
$updated = date("M j, Y", strtotime($updated));

// format address
$printorgaddress = $orgaddress;
if (!$orgaddress2) { 
	$printorgaddress .= '; '; 
}else{ 
	$printorgaddress .=  ' ' . $orgaddress2 . '; '; 
}
$printorgaddress .= $orgcity . ' ';
$printorgaddress .= $orgstate . ' ';
$printorgaddress .= $orgzip . ' '; 

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
	$sitestable = "<h1>No Existing Sites</h1><p>Please add some sites <a href=\"existinglocations.php\">here</a>! Thanks!</p>";
}else{

// create table to add sites to with form to batch edit or delete
$sitestable = "<h1>Existing Sites</h1>
<form name=\"editremove\" action=\"editremovesites.php\" method=\"POST\">
<input type=\"submit\" name=\"edit\" value=\"Edit Selected Sites &#62;&#62;\" />
<input type=\"submit\" name=\"remove\" value=\"Remove Selected Sites &#62;&#62;\" />
<input type=\"button\" class=\"check\" value=\"Check All\" />
<br /><br />
<table class=\"hoursTable\"><tr>
<th>Select</th>
<th>Edit</th>
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
	$sitestable .= "<td align=\"center\"><input type=\"checkbox\" name=\"$siteid\" value=\"t\" /></td>
	<td><a href=\"editsite.php?siteid=$siteid\">Edit</a></td>";
}elseif ($verified==2) {
	$sitestable .= "<td align=\"center\" colspan = 2><b>NOT VERIFIED</b></td>";
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
<br />
<input type=\"submit\" name=\"edit\" value=\"Edit Selected Sites &#62;&#62;\" />
<input type=\"submit\" name=\"remove\" value=\"Remove Selected Sites &#62;&#62;\" />
<input type=\"button\" class=\"check\" value=\"Check All\" />
</form>
";

} // close if then if sites exist


// sum number of school year sites for dashboard metric
$countsysitesquery = "SELECT count(*) FROM azcase_sites WHERE verified = 1 AND summer = FALSE AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
$countsysitesresult = pg_query($connection, $countsysitesquery);
$countsysites = pg_result($countsysitesresult, 0, 0);

if ($countsysites>0) {
	$countsysites = number_format($countsysites);
	$countsysitesdiv = "<div class=\"m\"><div class=\"mlabel\">Number of School-Year Sites:</div><div class=\"mnumber\">$countsysites</div></div>";
}else{}

// sum number of summer sites for dashboard metric
$countsumsitesquery = "SELECT count(*) FROM azcase_sites WHERE verified = 1 AND summer = TRUE AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
$countsumsitesresult = pg_query($connection, $countsumsitesquery);
$countsumsites = pg_result($countsumsitesresult, 0, 0);

if ($countsumsites>0) {
	$countsumsites = number_format($countsumsites);
	$countsumsitesdiv = "<div class=\"m\"><div class=\"mlabel\">Number of Summer Sites:</div><div class=\"mnumber\">$countsumsites</div></div>";
}else{}


// sum number of children served during the school year for dashboard metric
$countsyservedquery = "SELECT sum(served) FROM azcase_site_survey WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid) AND siteid IN (SELECT siteid FROM azcase_sites WHERE verified = 1 AND summer = FALSE);";
$countsyservedresult = pg_query($connection, $countsyservedquery);
$countsyserved = pg_result($countsyservedresult, 0, 0);

if ($countsyserved>0) {
	$countsyserved = number_format($countsyserved);
	$countsyserveddiv = "<div class=\"m\"><div class=\"mlabel\">Number of Children Served (School-Year):</div><div class=\"mnumber\">$countsyserved</div></div>";
}else{}

// sum number of children served during the summer for dashboard metric
$countsumservedquery = "SELECT sum(served) FROM azcase_site_survey WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid) AND siteid IN (SELECT siteid FROM azcase_sites WHERE verified = 1 AND summer = TRUE);";
$countsumservedresult = pg_query($connection, $countsumservedquery);
$countsumserved = pg_result($countsumservedresult, 0, 0);

if ($countsumserved>0) {
	$countsumserved = number_format($countsumserved);
	$countsumserveddiv = "<div class=\"m\"><div class=\"mlabel\">Number of Children Served (Summer):</div><div class=\"mnumber\">$countsumserved</div></div>";
}else{}


// pull locations for map and create map setup
$locationquery = "SELECT locationid, name, namesp, address, address2, city, state, zip, lat, lon FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
$record = pg_query($connection, $locationquery);

// if no locations exist in the search radius, then don't attempt to create the map 
if (pg_numrows($record)==0) {
}else{

$markersLayer = '
		var markersLayer =  new Array();
		markersLayer = [
	';

$iconsLayer = '
		var iconsLayer =  new Array();
		iconsLayer = [
	';

$shadowsLayer = '
		var shadowsLayer =  new Array();
		shadowsLayer = [
	';

$contentsLayer = '
		var contentsLayer =  new Array();
		contentsLayer = [
	';

$titlesLayer = '
		var titlesLayer =  new Array();
		titlesLayer = [
	';

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

// add lat and lon to markersLayer
$markersLayer .= "[$lat, $lon]";

//format address for printing
if ($address=="") {
	$comma = "";
}else{
	$comma = ", ";
}

$printaddress = $address . $comma . $city . ', ' . $state . ' ' . $zip;

//pick spanish name for location if spanish name exists and user chose spanish
if ($language==2 && $namesp != '') {
	$name = $namesp;
}else{}

//string replace for "&" and "<", which are illegal in KML
$name = str_replace("&", "and", $name);
$name = str_replace("<", " ", $name);
//escape name string
$name = addslashes($name);
$name = trim($name);


$iconsLayer .= "['http://maps.nijel.org/azcase/icons/icon.png']";
$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/icon.shadow.png']";

// clear variables
$schoolyearsites = '';
$summersites = '';

// add school year entry to pop-up if there are school year programs at the site
$countquery = "SELECT count(*) FROM azcase_sites WHERE summer = FALSE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
$countresult = pg_query($connection, $countquery);
$countschoolyear = pg_result($countresult, 0, 0);

if ($countschoolyear>0) {

	$schoolyearsites = "<h2>School Year Programs</h2><ul>";
	// pull and store all the school year sites associated with this location
	$sitequery = "SELECT siteid, name, namesp FROM azcase_sites WHERE summer = FALSE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
	$record1 = pg_query($connection, $sitequery);
	  for ($lt1 = 0; $lt1 < pg_numrows($record1); $lt1++) {
	    $siteid = pg_result($record1, $lt1, 0);
	    $sitename = pg_result($record1, $lt1, 1);
	    $sitenamesp = pg_result($record1, $lt1, 2);

		//string replace for "&" and "<", which are illegal for sitename and sitenamesp
		$sitename = str_replace("&", "and", $sitename);
		$sitename = str_replace("<", " ", $sitename);
		//escape name string
		$sitename = addslashes($sitename);
		$sitename = trim($sitename);

		//string replace for "&" and "<", which are illegal for sitename and sitenamesp
		$sitenamesp = str_replace("&", "and", $sitenamesp);
		$sitenamesp = str_replace("<", " ", $sitenamesp);
		//escape name string
		$sitenamesp = addslashes($sitenamesp);
		$sitenamesp = trim($sitenamesp);

		//pick spanish name for sites if spanish name exists and user chose spanish
		if ($language==2 && $sitenamesp != '') {
			$sitename = $sitenamesp;
		}else{}

		$schoolyearsites .= '<li><a href=\"http://maps.nijel.org/azcase/site.php?siteid=';
		$schoolyearsites .= $siteid;
		$schoolyearsites .= '&locationid=';
		$schoolyearsites .= $locationid;
		$schoolyearsites .= '&language=';
		$schoolyearsites .= $language;
		$schoolyearsites .= '&searchstreet=';
		$schoolyearsites .= $address;
		$schoolyearsites .= '&searchcity=';
		$schoolyearsites .= $city;
		$schoolyearsites .= '&searchstate=';
		$schoolyearsites .= $state;
		$schoolyearsites .= '&searchzip=';
		$schoolyearsites .= $zip;
		$schoolyearsites .= '&zoom=13';
		$schoolyearsites .= '\">';
		$schoolyearsites .= $sitename;
		$schoolyearsites .= '</a> | <a href=\"http://maps.nijel.org/azcase/editsite.php?siteid=';
		$schoolyearsites .= $siteid;
		$schoolyearsites .= '\">Edit</a></li>';

	}

	$schoolyearsites .= "</ul>";

} //close if ($countschoolyear>0) {


// add summer entry to pop-up if there are summer programs at the site
$countquery = "SELECT count(*) FROM azcase_sites WHERE summer = TRUE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
$countresult = pg_query($connection, $countquery);
$countsummer = pg_result($countresult, 0, 0);

if ($countsummer>0) {

	$summersites = '<h2>Summer Programs</h2><ul>';
	// pull and store all the school year sites associated with this location
	$sitequery = "SELECT siteid, name, namesp FROM azcase_sites WHERE summer = TRUE AND verified = 1 AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE locationid = $locationid) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
	$record1 = pg_query($connection, $sitequery);
	  for ($lt1 = 0; $lt1 < pg_numrows($record1); $lt1++) {
	    $siteid = pg_result($record1, $lt1, 0);
	    $sitename = pg_result($record1, $lt1, 1);
	    $sitenamesp = pg_result($record1, $lt1, 2);

		//string replace for "&" and "<", which are illegal for sitename and sitenamesp
		$sitename = str_replace("&", "and", $sitename);
		$sitename = str_replace("<", " ", $sitename);
		//escape name string
		$sitename = addslashes($sitename);
		$sitename = trim($sitename);

		//string replace for "&" and "<", which are illegal for sitename and sitenamesp
		$sitenamesp = str_replace("&", "and", $sitenamesp);
		$sitenamesp = str_replace("<", " ", $sitenamesp);
		//escape name string
		$sitenamesp = addslashes($sitenamesp);
		$sitenamesp = trim($sitenamesp);

		//pick spanish name for sites if spanish name exists and user chose spanish
		if ($language==2 && $sitenamesp != '') {
			$sitename = $sitenamesp;
		}else{}

		$summersites .= '<li><a href=\"http://maps.nijel.org/azcase/site.php?siteid=';
		$summersites .= $siteid;
		$summersites .= '&locationid=';
		$summersites .= $locationid;
		$summersites .= '&language=';
		$summersites .= $language;
		$summersites .= '&searchstreet=';
		$summersites .= $address;
		$summersites .= '&searchcity=';
		$summersites .= $city;
		$summersites .= '&searchstate=';
		$summersites .= $state;
		$summersites .= '&searchzip=';
		$summersites .= $zip;
		$summersites .= '&zoom=13';
		$summersites .= $zoom;
		$summersites .= '\">';
		$summersites .= $sitename;
		$summersites .= '</a> | <a href=\"http://maps.nijel.org/azcase/editsite.php?siteid=';
		$summersites .= $siteid;
		$summersites .= '\">Edit</a></li>';

	}

	$summersites .= "</ul>";

} //close if ($countsummer>0) {


$contentsLayer .= '["<h1>';
$contentsLayer .= $name;
$contentsLayer .= '</h1><b>Address:</b> ';
$contentsLayer .= $printaddress;
$contentsLayer .= ' <br \> ';
$contentsLayer .= $schoolyearsites;
$contentsLayer .= $summersites;
$contentsLayer .= '"]';

$titlesLayer .= "['$name']";


// add commas to the ends of arrays if not the last recotd pulled, close array if it is the last record
if ($lt+1==pg_numrows($record)) {
	$markersLayer .= '];';
	$iconsLayer  .= '];';
	$shadowsLayer .= '];';
	$contentsLayer .= '];';
	$titlesLayer .= '];';
}else{	
	$markersLayer .= ',';
	$iconsLayer  .= ',';
	$shadowsLayer .= ',';
	$contentsLayer .= ',';
	$titlesLayer .= ',';
}

} // close locations loop 

// store map javascript
if ($language==2) { 
	$mapjslang = '&language=es';
}else{}

$mapjs = "
<!--****Google Maps Key Script****-->
<script type=\"text/javascript\" src=\"http://maps.googleapis.com/maps/api/js?key=AIzaSyC70RNwqu3YmSo5D-iEYDCQRWRB0Gt9QOQ&sensor=false$mapjslang\"></script>

<!--****Javascript that creates the map****-->
<script type=\"text/javascript\">
var map;
var markers = [];
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();


function setupMarkers() {
";
$mapjs .= $markersLayer;
$mapjs .= $iconsLayer;
$mapjs .= $shadowsLayer;
$mapjs .= $titlesLayer;

$mapjs .= "
    for (var i = 0; i < markersLayer.length; i++) {
        var markerLatLng = new google.maps.LatLng(markersLayer[i][0], markersLayer[i][1]);
	var image = new google.maps.MarkerImage(iconsLayer[i][0],
		new google.maps.Size(32, 32), 
		new google.maps.Point(0,0), 
		new google.maps.Point(0, 32)
		);

	var shadow = new google.maps.MarkerImage(shadowsLayer[i][0],
		new google.maps.Size(51, 37), 
		new google.maps.Point(0,0), 
		new google.maps.Point(0, 37)
		);

        var marker = new google.maps.Marker({
		position: markerLatLng,
		map: map,
		shadow: shadow,
		icon: image,
		title: titlesLayer[i][0]
	});
	
	bounds.extend(markerLatLng);
	map.fitBounds(bounds);

	attachSecretMessage(marker, i);
 
        markers.push(marker);
    }

}

function attachSecretMessage(marker, i) {
";

$mapjs .= $contentsLayer;

$mapjs .= "
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.close();
		infowindow.setContent(contentsLayer[i][0]);
		infowindow.open(map,marker);
	});
}


function initialize() {
	var centerLatLon = new google.maps.LatLng(33.448523, -112.073784);
	var myOptions = {
		center: centerLatLon,
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControlOptions: {
		      style: google.maps.ZoomControlStyle.SMALL
		},
		panControl: false

	};
        map = new google.maps.Map(document.getElementById(\"afterschoolgmap\"), myOptions);

	setupMarkers();

}

function launchInfoWindow(x) {
    // window.scroll(0, 0);
    // markers[x].setMap(map);
    google.maps.event.trigger(markers[x], \"click\");
}


</script>
";

$mapdiv = "<p><b>Locations of Your Sites</b></p><div id=\"afterschoolgmap\" style=\"border: 2px solid #979797; background-color: #e5e3df; width: 400px; height: 400px;\"></div>";
//add in the number of sites and kids served below the map div
$mapdiv .= $countsysitesdiv;
$mapdiv .= $countsyserveddiv;
$mapdiv .= $countsumsitesdiv;
$mapdiv .= $countsumserveddiv;
// set the onload in body tag if map is present
$bodytag = "<body onload=\"initialize()\">";

} // close if locations exist

// pull data and create JS for pie chart with activites at all locations
// set initial values to zero
$charactercount = 0;
$leadershipcount = 0;
$mentoringcount = 0;
$nutritioncount = 0;
$preventioncount = 0;
$sportscount = 0;
$supportservicescount = 0;
$academiccount = 0;
$communitycount = 0;
$artscount = 0;
$stemcount = 0;
$collegecount = 0;

$sitespiequery = "SELECT 
character,
leadership,
mentoring,
nutrition,
prevention,
sports,
supportservices,
academic,
community,
arts,
stem,
college
FROM azcase_sites WHERE verified = 1 AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
$sitespieresult = pg_query($connection, $sitespiequery);

// if no locations exist in the search radius, then don't attempt to create the map 
if (pg_numrows($sitespieresult)==0) {
}else{

for ($lt = 0; $lt < pg_numrows($sitespieresult); $lt++) {
	$character = pg_result($sitespieresult, $lt, 0);
	$leadership = pg_result($sitespieresult, $lt, 1);
	$mentoring = pg_result($sitespieresult, $lt, 2);
	$nutrition = pg_result($sitespieresult, $lt, 3);
	$prevention = pg_result($sitespieresult, $lt, 4);
	$sports = pg_result($sitespieresult, $lt, 5);
	$supportservices = pg_result($sitespieresult, $lt, 6);
	$academic = pg_result($sitespieresult, $lt, 7);
	$community = pg_result($sitespieresult, $lt, 8);
	$arts = pg_result($sitespieresult, $lt, 9);
	$stem = pg_result($sitespieresult, $lt, 10);
	$college = pg_result($sitespieresult, $lt, 11);

// count each variable 
if ($character=='t') {
	$charactercount = $charactercount + 1;
}else{}
	
if ($leadership=='t') {
	$leadershipcount = $leadershipcount + 1;
}else{}

if ($mentoring=='t') {
	$mentoringcount = $mentoringcount + 1;
}else{}

if ($nutrition=='t') {
	$nutritioncount = $nutritioncount + 1;
}else{}

if ($prevention=='t') {
	$preventioncount = $preventioncount + 1;
}else{}

if ($sports=='t') {
	$sportscount = $sportscount + 1;
}else{}

if ($supportservices=='t') {
	$supportservicescount = $supportservicescount + 1;
}else{}

if ($academic=='t') {
	$academiccount = $academiccount + 1;
}else{}

if ($community=='t') {
	$communitycount = $communitycount + 1;
}else{}

if ($arts=='t') {
	$artscount = $artscount + 1;
}else{}

if ($stem=='t') {
	$stemcount = $stemcount + 1;
}else{}

if ($college=='t') {
	$collegecount = $collegecount + 1;
}else{}

} // close 

// set up the JS for the pie chart
$chartjs = "<script type=\"text/javascript\" src=\"http://www.google.com/jsapi\"></script>
<script type=\"text/javascript\">
	google.load(\"visualization\", \"1\", {packages:['corechart']});
";

$chartjs .= "
	google.setOnLoadCallback(drawActivitiesBar);
	function drawActivitiesBar() {

	var data = google.visualization.arrayToDataTable([
		['Activites', 'Number of Sites'],
		['Tutoring/Academic Enrichment', $academiccount],
		['Arts and Culture', $artscount],
		['Sports and Recreation', $sportscount],
		['STEM', $stemcount],
		['College and Career Readiness', $collegecount],
		['Volunteering/Community Service', $communitycount],
		['Leadership', $leadershipcount],
		['Character Education', $charactercount],
		['Prevention', $preventioncount],
		['Nutrition', $nutritioncount],
		['Mentoring', $mentoringcount],
		['Support Services', $supportservicescount]
	]);

	var options = {
		width: 400,
		height: 200,
		legend: {position: 'none'},
		hAxis: {title: 'Number of Sites'},
		isStacked: false,
		colors: ['#BC2122'],
		backgroundColor: '#F7F5F6',
		chartArea:{width:\"54%\",left:\"42%\",height:\"80%\",top:\"5%\"}
	};


	var chart = new google.visualization.BarChart(document.getElementById('ActivitiesBar'));
	chart.draw(data, options);
	}
";

$activitiesdiv = "<p><b>Distribution of Activities Across All Sites</b></p><div id=\"ActivitiesBar\"></div>";

} // close if sites don't exist


// pull data and create JS for all age range data chart
// set initial values to zero
$age5count = 0;
$age6count = 0;
$age7count = 0;
$age8count = 0;
$age9count = 0;
$age10count = 0;
$age11count = 0;
$age12count = 0;
$age13count = 0;
$age14count = 0;
$age15count = 0;
$age16count = 0;
$age17count = 0;
$age18count = 0;

$siteagequery = "SELECT 
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
age18
FROM azcase_sites WHERE verified = 1 AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid);";
$sitesageresult = pg_query($connection, $siteagequery);

// if no locations exist in the search radius, then don't attempt to create the map 
if (pg_numrows($sitesageresult)==0) {
}else{

for ($lt = 0; $lt < pg_numrows($sitesageresult); $lt++) {
	$age5 = pg_result($sitesageresult, $lt, 0);
	$age6 = pg_result($sitesageresult, $lt, 1);
	$age7 = pg_result($sitesageresult, $lt, 2);
	$age8 = pg_result($sitesageresult, $lt, 3);
	$age9 = pg_result($sitesageresult, $lt, 4);
	$age10 = pg_result($sitesageresult, $lt, 5);
	$age11 = pg_result($sitesageresult, $lt, 6);
	$age12 = pg_result($sitesageresult, $lt, 7);
	$age13 = pg_result($sitesageresult, $lt, 8);
	$age14 = pg_result($sitesageresult, $lt, 9);
	$age15 = pg_result($sitesageresult, $lt, 10);
	$age16 = pg_result($sitesageresult, $lt, 11);
	$age17 = pg_result($sitesageresult, $lt, 12);
	$age18 = pg_result($sitesageresult, $lt, 13);

if ($age5=='t') {
	$age5count = $age5count + 1;
}else{}

if ($age6=='t') {
	$age6count = $age6count + 1;
}else{}

if ($age7=='t') {
	$age7count = $age7count + 1;
}else{}

if ($age8=='t') {
	$age8count = $age8count + 1;
}else{}

if ($age9=='t') {
	$age9count = $age9count + 1;
}else{}

if ($age10=='t') {
	$age10count = $age10count + 1;
}else{}

if ($age11=='t') {
	$age11count = $age11count + 1;
}else{}

if ($age12=='t') {
	$age12count = $age12count + 1;
}else{}

if ($age13=='t') {
	$age13count = $age13count + 1;
}else{}

if ($age14=='t') {
	$age14count = $age14count + 1;
}else{}

if ($age15=='t') {
	$age15count = $age15count + 1;
}else{}

if ($age16=='t') {
	$age16count = $age16count + 1;
}else{}

if ($age17=='t') {
	$age17count = $age17count + 1;
}else{}

if ($age18=='t') {
	$age18count = $age18count + 1;
}else{}

} // close query

if (!$chartjs) {
	$chartjs = "<script type=\"text/javascript\" src=\"http://www.google.com/jsapi\"></script>
	<script type=\"text/javascript\">
		google.load(\"visualization\", \"1\", {packages:['corechart']});
	";
}else{}

$chartjs .= "
	google.setOnLoadCallback(drawAgeChart);
	function drawAgeChart() {

	var data = google.visualization.arrayToDataTable([
		['Ages', 'Number of Sites'],
		['Age 5', $age5count],
		['Age 6', $age6count],
		['Age 7', $age7count],
		['Age 8', $age8count],
		['Age 9', $age9count],
		['Age 10', $age10count],
		['Age 11', $age11count],
		['Age 12', $age12count],
		['Age 13', $age13count],
		['Age 14', $age14count],
		['Age 15', $age15count],
		['Age 16', $age16count],
		['Age 17', $age17count],
		['Age 18', $age18count]
	]);

	var options = {
		width: 400,
		height: 200,
		legend: {position: 'none'},
		vAxis: {title: 'Number of Sites'},
		isStacked: false,
		backgroundColor: '#F7F5F6',
		chartArea:{width:\"75%\",height:\"75%\",top:\"5%\"}
	};


	var chart = new google.visualization.ColumnChart(document.getElementById('AgeChart'));
	chart.draw(data, options);
	}
";

$agediv = "<p><b>Distribution of Ages Served Across Your Sites</b></p><div id=\"AgeChart\"></div>";

} // close if sites exist

// close the js if we made any pie or bar charts 
if (!$chartjs) {
}else{
	$chartjs .= "</script>";
}

// apply the map initilize body tag if we're making a map
if (!$bodytag) {
	echo "<body>";
}else{
	echo $bodytag;
}

?>
<h1>Provider Dashboard</h1>
<table width="875">
	<tr>
		<td valign="top">
			<?php echo $activitiesdiv; ?>
		</td>
		<td rowspan = "2" valign="top">

			<?php echo $mapdiv; ?>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<?php echo $agediv; ?>
		</td>
	</tr>
</table>
<br />
<h1>Your Organization's Information</h1>
<p><a href="editprovider.php">Edit These Data and Assign Other Users to Manage Data</a> | <i>Last Updated:</i> <?php echo $updated; ?></p>
<table class="hoursTable">
	<tr>
		<td ><b>Organization Name</b></td>
		<td><?php echo $orgname; ?></td>
	</tr> 
	<tr class="alt">
		<td ><b>Address</b></td>
		<td><?php echo $printorgaddress; ?></td>
	</tr> 
	<tr>
		<td ><b>Phone</b></td>
		<td><?php echo $orgphone; ?></td>
	</tr> 
	<tr class="alt">
		<td ><b>Fax</b></td>
		<td><?php echo $orgfax; ?></td>
	</tr> 
	<tr>
		<td ><b>Email</b></td>
		<td><?php echo $_SESSION['useremail']; ?></td>
	</tr> 
</table>
<br />
<br />
<h1>Add New Sites</h1>
<form name="add" action="existinglocations.php" method="POST">
<input type="submit" name="action" value="Add New Sites &#62;&#62;" />
</form>
<br />
<br />
<?php 

echo $sitestable;

// create footer
require('footer.php');

echo $mapjs;

echo $chartjs;

?>

<script language="JavaScript">
$(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('Uncheck All')
    },function(){
        $('input:checkbox').removeAttr('checked');
        $(this).val('Check All');        
    })
})
</script>



