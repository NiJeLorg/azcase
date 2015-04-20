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


define("MAPS_HOST", "maps.googleapis.com");

$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/json";
$params = "&sensor=false";

$zoom = $_REQUEST['zoom'];
$searchstreet = $_REQUEST['searchstreet'];
$searchcity = $_REQUEST['searchcity'];
$searchstate = $_REQUEST['searchstate'];
$searchzip = $_REQUEST['searchzip'];

//format address for printing
if ($searchstreet=="") {
	$comma1 = "";
}else{
	$comma1 = ", ";
}

if ($searchcity=="") {
	$comma2 = "";
}else{
	$comma2 = ", ";
}

$printsearchaddress = $searchstreet . $comma1 . $searchcity . $comma2 . $searchstate . ' ' . $searchzip;

// explode street string to remove everything after a # sign, like apartment numbers
$partsStreet = explode('#', $searchstreet);
$partsStreet1 = $partsStreet[0];

// trim whitespace for OSM
$partsStreet1 = trim($partsStreet1);
$city = trim($searchcity);

// prep strings for url
$streeturl = urlencode($partsStreet1);
$cityurl = urlencode($city);
$zipurl = urlencode($searchzip);

// form request URL        
$request_url = $base_url . "?address=" . $streeturl . ",+" . $cityurl . ",+AZ," . $zipurl . $params;

$json = json_decode(file_get_contents($request_url));

$latsearch = $json->results[0]->geometry->location->lat;
$lonsearch = $json->results[0]->geometry->location->lng;

if ($zoom == "12") {
	$latlonbounds = 0.1;
}elseif ($zoom == "13") {
	$latlonbounds = 0.05;
}else{
	$latlonbounds = 0.03;
}

$searchgeom = "ST_GeomFromText('POINT($lonsearch $latsearch)' ,4326)";


// set up arrays for markers, icons etc. that will get called in a google maps function below
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

$locationquery = "SELECT locationid, name, namesp, address, address2, city, state, zip, lat, lon FROM azcase_locations WHERE the_geom && ST_expand($searchgeom, $latlonbounds) AND ST_distance($searchgeom, the_geom) < $latlonbounds ORDER BY ST_distance($searchgeom, the_geom);";
$record = pg_query($connection, $locationquery);

// if no locations exist in the search radius, then return a polite fail
if (pg_numrows($record)==0) {
	echo "<body>";
	echo "No Locations Match Your Search Criteria. Unfortunately, your search returned no matching results. Please go back and pick a new location or select different search criteria. Thank you.";
	require('footer.php');
	die();
}else{}

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


//string replace for "&" and "<", which are illegal in KML
$name = str_replace("&", "and", $name);
$name = str_replace("<", " ", $name);
// trim name
$name = trim($name);



// set style as numers for first twenty points, then regular icon for subsequent points

if ($lt==0) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue01.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue01.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue01.png\" alt=\"1\" /></td>";
}elseif ($lt==1) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue02.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue02.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue02.png\" alt=\"2\" /></td>";
}elseif ($lt==2) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue03.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue03.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue03.png\" alt=\"3\" /></td>";
}elseif ($lt==3) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue04.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue04.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue04.png\" alt=\"4\" /></td>";
}elseif ($lt==4) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue05.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue05.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue05.png\" alt=\"5\" /></td>";
}elseif ($lt==5) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue06.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue06.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue06.png\" alt=\"6\" /></td>";
}elseif ($lt==6) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue07.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue07.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue07.png\" alt=\"7\" /></td>";
}elseif ($lt==7) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue08.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue08.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue08.png\" alt=\"8\" /></td>";
}elseif ($lt==8) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue09.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue09.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue09.png\" alt=\"9\" /></td>";
}elseif ($lt==9) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue10.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue10.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue10.png\" alt=\"10\" /></td>";
}elseif ($lt==10) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue11.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue11.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue11.png\" alt=\"11\" /></td>";
}elseif ($lt==11) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue12.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue12.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue12.png\" alt=\"12\" /></td>";
}elseif ($lt==12) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue13.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue13.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue13.png\" alt=\"13\" /></td>";
}elseif ($lt==13) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue14.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue14.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue14.png\" alt=\"14\" /></td>";
}elseif ($lt==14) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue15.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue15.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue15.png\" alt=\"15\" /></td>";
}elseif ($lt==15) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue16.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue16.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue16.png\" alt=\"16\" /></td>";
}elseif ($lt==16) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue17.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue17.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue17.png\" alt=\"17\" /></td>";
}elseif ($lt==17) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue18.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue18.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue18.png\" alt=\"18\" /></td>";
}elseif ($lt==18) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue19.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue19.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue19.png\" alt=\"19\" /></td>";
}elseif ($lt==19) {
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue20.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/darkblue20.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/darkblue20.png\" alt=\"20\" /></td>";
}else{
	$iconsLayer .= "['http://maps.nijel.org/azcase/icons/icon.png']";
	$shadowsLayer .= "['http://maps.nijel.org/azcase/icons/icon.shadow.png']";
	$sidebar .= "<tr><td><img src=\"http://maps.nijel.org/azcase/icons/icon.png\" alt=\"icon\" /></td>";
}


//add the name of the location and a link connecting it to the map
$sidebar .= "<td><a href=\"javascript:launchInfoWindow($lt)\">$name</a></td></tr>";

// escape name for KML
$name = addslashes($name);




$contentsLayer .= '["<h1>';
$contentsLayer .= $name;
$contentsLayer .= '</h1><b>';
$contentsLayer .= 'Address';
$contentsLayer .= ':</b> ';
$contentsLayer .= $printaddress;
$contentsLayer .= ' <br /><br /> ';
$contentsLayer .= ' <a href=\"http://maps.nijel.org/azcase/adminremovelocation.php?locationid=';
$contentsLayer .= $locationid;
$contentsLayer .= '&searchstreet=';
$contentsLayer .= $searchstreet;
$contentsLayer .= '&searchcity=';
$contentsLayer .= $searchcity;
$contentsLayer .= '&searchstate=';
$contentsLayer .= $searchstate;
$contentsLayer .= '&searchzip=';
$contentsLayer .= $searchzip;
$contentsLayer .= '&zoom=';
$contentsLayer .= $zoom;
$contentsLayer .= '\">Remove</a> | <a href=\"http://maps.nijel.org/azcase/admineditlocation.php?locationid=';
$contentsLayer .= $locationid;
$contentsLayer .= '&searchstreet=';
$contentsLayer .= $searchstreet;
$contentsLayer .= '&searchcity=';
$contentsLayer .= $searchcity;
$contentsLayer .= '&searchstate=';
$contentsLayer .= $searchstate;
$contentsLayer .= '&searchzip=';
$contentsLayer .= $searchzip;
$contentsLayer .= '&zoom=';
$contentsLayer .= $zoom;
$contentsLayer .= '\">Edit</a>"]';

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

    
} //close locationquery

// close sidebar
$sidebar .= "</table>";

?>
<body onload="initialize()">
<h1>Admin Location Search Results</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="adminsearchhome.php">&#60;&#60; Back to Search For Users, Sites and Locations</a></p>
<table width="100%">
	<tr>
		<td align="left">
			<b>Search Address:</b> <?php echo $printsearchaddress; ?><br />
		</td>
	<tr>
</table>
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

<?php

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');
?>

<!--****Google Maps Key Script****-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC70RNwqu3YmSo5D-iEYDCQRWRB0Gt9QOQ&sensor=false"></script>

<!--****Javascript that creates the map****-->
<script type="text/javascript">
var map;
var markers = [];
var infowindow = new google.maps.InfoWindow({"maxWidth": 300});


function setupMarkers() {

	<?php echo $markersLayer; ?>
	<?php echo $iconsLayer; ?>
	<?php echo $shadowsLayer; ?>
	<?php echo $titlesLayer; ?>



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

		attachSecretMessage(marker, i);
 
        markers.push(marker);
    }

}

function attachSecretMessage(marker, i) {
	<?php echo $contentsLayer; ?>

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.close();
		infowindow.setContent(contentsLayer[i][0]);
		infowindow.open(map,marker);
	});
}


function initialize() {
	var centerLatLon = new google.maps.LatLng(<?php echo $latsearch;?>, <?php echo $lonsearch;?>);
	var myOptions = {
		center: centerLatLon,
		zoom: <?php echo $zoom;?>,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
        map = new google.maps.Map(document.getElementById("afterschoolgmap"), myOptions);
	var point = new google.maps.Marker({
		position: centerLatLon,
		map: map,
		title:"<?php echo $printsearchaddress; ?>"
  	});

	setupMarkers();

}

function launchInfoWindow(x) {
    // window.scroll(0, 0);
    // markers[x].setMap(map);
    google.maps.event.trigger(markers[x], "click");
}


</script>
