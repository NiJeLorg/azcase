<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// login to the system
require('login.php');

// processing login script
////displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// show map with all current location and list all current locations where the organization operates then prompt user to add  locations
// pull user id for ease of use below
$useremailsession = pg_escape_string($_SESSION['useremail']);
$useridquery = "SELECT userid FROM azcase_users WHERE useremail = '$useremailsession';";
$useridresult = pg_query($connection, $useridquery);
for ($lt = 0; $lt < pg_numrows($useridresult); $lt++) {
	$userid = pg_result($useridresult, $lt, 0);
}

// pull locations for map and create map setup
$locationquery = "SELECT locationid, name, namesp, address, address2, city, state, zip, lat, lon FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid)) ORDER BY lat, lon;";
$record = pg_query($connection, $locationquery);

// if no locations exist in the search radius, then don't attempt to create the map 
if (pg_numrows($record)==0) {
	// if no locations for user, redirect to page for adding new locations
	header("Location: http://azcase.nijel.org/phpsite/azcase/newlocations.php"); 

}else{

// create header - create here to allow redirect above
require('header.php');

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

// set up sidebar table and style
$sidebar = "<table width=\"275\">";

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

// set style as numers for first twenty points, then regular icon for subsequent points

if ($lt==0) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue01.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue01.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue01.png\" alt=\"1\" /></td>";
}elseif ($lt==1) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue02.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue02.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue02.png\" alt=\"2\" /></td>";
}elseif ($lt==2) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue03.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue03.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue03.png\" alt=\"3\" /></td>";
}elseif ($lt==3) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue04.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue04.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue04.png\" alt=\"4\" /></td>";
}elseif ($lt==4) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue05.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue05.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue05.png\" alt=\"5\" /></td>";
}elseif ($lt==5) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue06.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue06.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue06.png\" alt=\"6\" /></td>";
}elseif ($lt==6) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue07.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue07.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue07.png\" alt=\"7\" /></td>";
}elseif ($lt==7) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue08.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue08.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue08.png\" alt=\"8\" /></td>";
}elseif ($lt==8) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue09.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue09.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue09.png\" alt=\"9\" /></td>";
}elseif ($lt==9) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue10.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue10.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue10.png\" alt=\"10\" /></td>";
}elseif ($lt==10) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue11.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue11.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue11.png\" alt=\"11\" /></td>";
}elseif ($lt==11) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue12.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue12.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue12.png\" alt=\"12\" /></td>";
}elseif ($lt==12) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue13.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue13.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue13.png\" alt=\"13\" /></td>";
}elseif ($lt==13) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue14.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue14.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue14.png\" alt=\"14\" /></td>";
}elseif ($lt==14) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue15.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue15.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue15.png\" alt=\"15\" /></td>";
}elseif ($lt==15) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue16.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue16.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue16.png\" alt=\"16\" /></td>";
}elseif ($lt==16) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue17.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue17.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue17.png\" alt=\"17\" /></td>";
}elseif ($lt==17) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue18.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue18.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue18.png\" alt=\"18\" /></td>";
}elseif ($lt==18) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue19.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue19.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue19.png\" alt=\"19\" /></td>";
}elseif ($lt==19) {
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue20.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/darkblue20.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/darkblue20.png\" alt=\"20\" /></td>";
}else{
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/icon.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/icon.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://azcase.nijel.org/phpsite/azcase/icons/icon.png\" alt=\"icon\" /></td>";
}


//add the name of the location and a link connecting it to the map
$sidebar .= "<td><a href=\"javascript:launchInfoWindow($lt)\">$name</a></td></tr>";

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

		$schoolyearsites .= '<li><a href=\"http://azcase.nijel.org/phpsite/azcase/site.php?siteid=';
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
		$schoolyearsites .= '</a> | <a href=\"http://azcase.nijel.org/phpsite/azcase/editsite.php?siteid=';
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

		$summersites .= '<li><a href=\"http://azcase.nijel.org/phpsite/azcase/site.php?siteid=';
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
		$summersites .= '</a> | <a href=\"http://azcase.nijel.org/phpsite/azcase/editsite.php?siteid=';
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

// close sidebar
$sidebar .= "</table>";

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
var infowindow = new google.maps.InfoWindow({\"maxWidth\": 300});
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
		var image = {
			url: iconsLayer[i][0],
			size: new google.maps.Size(32, 32),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(12, 32)
		};

		var shadow = {
			url: shadowsLayer[i][0],
			size: new google.maps.Size(51, 37),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(0, 37)
		};
		
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
		mapTypeId: google.maps.MapTypeId.ROADMAP
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



} // close if locations exist

?>
<body onload="initialize()">
<h1>Where Does Your Organization Operate?</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a></p>
<p>The map below shows all the <b>existing locations where you operate</b>. If all the locations where you operate are on the map below, just click <a href="newsites.php">"Skip Adding New Locations"</a> below and you can start adding new sites at these locations. If not, click <a href="newlocations.php">"Add New Locations"</a> below and there you can add new locations where you operate to our system.</p>
<h2>Your Organization's Existing Locaitons</h2>
<table border="0">
	<tr>
		<td width="300" valign="top">
			<div id="the_side_bar" style="height:550px;overflow:auto;"><?php echo $sidebar; ?></div>
		</td>
		<td>
			<!--****Google Map****-->
			<div id="afterschoolgmap" style="border: 2px solid #979797; background-color: #e5e3df; width: 550px; height: 550px;"></div>
			<!--****End Google Map****-->
		</td>
	</tr>
</table>
<br />
<table>
	<tr>
		<td>
			<form name="skip" action="newsites.php" method="POST"><input type="submit" name="action" value="Skip Adding New Locations &#62;&#62;" /></form>
		</td>
		<td>	
			<form name="addnewlocations" action="newlocations.php" method="POST"><input type="submit" name="action" value="Add New Locations &#62;&#62;" /></form>
		</td>
	<tr>
</table>


<?php

// close logged_in
}else{}

// create footer
require('footer.php');

echo $mapjs;

?>
