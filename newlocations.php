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
////displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// pull user id for ease of use below
$useremailsession = pg_escape_string($_SESSION['useremail']);
$useridquery = "SELECT userid FROM azcase_users WHERE useremail = '$useremailsession';";
$useridresult = pg_query($connection, $useridquery);
for ($lt = 0; $lt < pg_numrows($useridresult); $lt++) {
	$userid = pg_result($useridresult, $lt, 0);
}

// if the user has selected to add a location to their list - store the association in the database first
$setlocation = $_REQUEST['setlocation'];

if (!$setlocation) {
}else{
	// insert new location to temp user/location temp table
	$insertuserloc = "INSERT INTO azcase_user_locations_junction (\"userid\", \"locationid\") VALUES ($userid, $setlocation);";
	pg_send_query($connection, $insertuserloc);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
		$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertuserloc\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}
} // close set location


// create a map that shows both locations where this organization already operates and all other locations. limit to a search radius to limit the number of points
// allow for searching in address box across the top
define("MAPS_HOST", "maps.googleapis.com");

$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/json";
$params = "&sensor=false";

$geocodeaddress = $_REQUEST['geocodeaddress'];

if (!$geocodeaddress) {
}else{

	// form request URL        
    $request_url = $base_url . "?address=" . urlencode($geocodeaddress) . $params;
    //echo $request_url . '<br />';

    $json = json_decode(file_get_contents($request_url));
    $latsearch = $json->results[0]->geometry->location->lat;	
	$lonsearch = $json->results[0]->geometry->location->lng;

	$searchgeom = "ST_GeomFromText('POINT($lonsearch $latsearch)' ,4326)";

} // close if search address entered

// center map on downtown phoenix if no search address is entered
if (!$searchgeom) {
	$latsearch = 33.448523;
	$lonsearch = -112.073784;
	$searchgeom = "ST_GeomFromText('POINT(-112.073784 33.448523)' ,4326)";
}else{
	$pointjs = "
	var point = new google.maps.Marker({
		position: centerLatLon,
		map: map,
		title:\"$geocodeaddress\"
  	});
	";
}

// set data bounding box size
$latlonbounds = 0.25;



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


$locationquery = "SELECT locationid, name, namesp, address, address2, city, state, zip, lat, lon FROM azcase_locations WHERE the_geom && ST_expand($searchgeom, $latlonbounds) AND ST_distance($searchgeom, the_geom) < $latlonbounds ORDER BY ST_distance($searchgeom, the_geom);";
$record = pg_query($connection, $locationquery);

// if no locations exist in the search radius, then return a polite fail
if (pg_numrows($record)==0) {
	echo "<body><h1>No Locations Are Near Your Search Address</h1><p>Unfortunately, the address you entered did not have any locations nearby. If you believe there should be an out-of-school time location there, please use the form below to add this location to the system. If you would like to try searching for another address, please <a href=\"newlocations.php\">go back</a> and enter a new address. Thank you.</a>";
	require('addnewlocationsform.php');	
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


// pick icon depending on if the location is associated with this user or not
$countuserlocationquery = "SELECT count(*) FROM azcase_locations WHERE locationid = $locationid AND locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
$countuserlocationresult = pg_query($connection, $countuserlocationquery);
$countuserlocation = pg_result($countuserlocationresult, 0, 0);

if ($countuserlocation>0) {
	// set icon for user location
	$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/yourlocations.png']";
	$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/yourlocations.shadow.png']";
	
	// set popup for location so user can't select it
	$contentsLayer .= '["<h2>You Operate At This Location</h2>';
	$contentsLayer .= '<h1>';
	$contentsLayer .= $name;
	$contentsLayer .= '</h1><b>Address:</b> ';
	$contentsLayer .= $printaddress;
	$contentsLayer .= ' <br \>"]';
}else{
	// did the user select this location to be added to the map? If so, then pick a different icon
	$countjustaddquery = "SELECT count(*) FROM azcase_user_locations_junction WHERE locationid = $locationid AND userid = $userid;";
	$countjustaddresult = pg_query($connection, $countjustaddquery);
	$countjustadd = pg_result($countjustaddresult, 0, 0);
	if ($countjustadd>0) {
		// set icon for location not assocaited with this user
		$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/justadd.png']";
		$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/justadd.shadow.png']";

		// set popup for location with link for user to select it
		$contentsLayer .= '["<h2>You Selelcted This Location</h2>';
		$contentsLayer .= '<h1>';
		$contentsLayer .= $name;
		$contentsLayer .= '</h1><b>Address:</b> ';
		$contentsLayer .= $printaddress;
		$contentsLayer .= ' <br \>"]';
	}else{
		// set icon for location not assocaited with this user
		$iconsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/icon.png']";
		$shadowsLayer .= "['http://azcase.nijel.org/phpsite/azcase/icons/icon.shadow.png']";

		// set popup for location with link for user to select it
		$contentsLayer .= '["<h2><a href=\"newlocations.php?setlocation=';
		$contentsLayer .= $locationid;
		$contentsLayer .= '&geocodeaddress=';
		$contentsLayer .= $geocodeaddress;
		$contentsLayer .= '\">';
		$contentsLayer .= 'Add This Location</a></h2>';
		$contentsLayer .= '<h1>';
		$contentsLayer .= $name;
		$contentsLayer .= '</h1><b>Address:</b> ';
		$contentsLayer .= $printaddress;
		$contentsLayer .= ' <br \>"]';
	} //close if ($countjustadd>0) {
} // close if ($countuserlocation>0) {

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
	var centerLatLon = new google.maps.LatLng($latsearch, $lonsearch);
	var myOptions = {
		center: centerLatLon,
		zoom: 13,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
        map = new google.maps.Map(document.getElementById(\"afterschoolgmap\"), myOptions);
	$pointjs

	setupMarkers();

}

function launchInfoWindow(x) {
    // window.scroll(0, 0);
    // markers[x].setMap(map);
    google.maps.event.trigger(markers[x], \"click\");
}


</script>
";

// add sidebar that includes locations added from the map
$countnewlocationquery = "SELECT count(*) FROM azcase_user_locations_junction WHERE userid = $userid;";
$countnewlocationresult = pg_query($connection, $countnewlocationquery);
$countnewlocation = pg_result($countnewlocationresult, 0, 0);

if ($countnewlocation>0) {
	$sidebarheading = "<h1>Added Locations From The Map</h1>";
	$sidebar = "<ol>";
	// select locations that have been added by user 
	$newlocationquery = "SELECT locationid FROM azcase_user_locations_junction WHERE userid = $userid;";
	$record = pg_query($connection, $newlocationquery);
	  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
	    $locationid = pg_result($record, $lt, 0);
	
		// pull location information and add to sidebar
		$locationinfoquery = "SELECT name, namesp, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid;";
		$record1 = pg_query($connection, $locationinfoquery);
		  for ($lt1 = 0; $lt1 < pg_numrows($record1); $lt1++) {
		    $name = pg_result($record1, $lt1, 0);
		    $namesp = pg_result($record1, $lt1, 1);
		    $address = pg_result($record1, $lt1, 2);
		    $address2 = pg_result($record1, $lt1, 3);
		    $city = pg_result($record1, $lt1, 4);
		    $state = pg_result($record1, $lt1, 5);
		    $zip = pg_result($record1, $lt1, 6);
		}
	$sidebar .= "<li><b>$name</b><br />$address $address2<br />$city, $state $zip</li><br />";
	} // close newly addded locations
	
	$sidebar .= "</ol>";

}else{}




?>
<body onload="initialize()">
<h1>Where Does Your Organization Operate?</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a> | <a href="existinglocations.php">&#60;&#60; Back to View Your Existing Locations</a></p>
<p>Using the map below, you may select any locations where you organization operates. Please note that the map also includes locations that you currently operate, which are designated by a different icon. See the map legend just below the map. Thank you!</p>
<table border="0">
	<tr>
		<td>
			<form name="search" action="newlocations.php" method="POST"><input type="text" name="geocodeaddress" style="color:#888;" value="Search by Address" onfocus="inputFocus(this)" onblur="inputBlur(this)"/><input type="submit" name="action" value="Search" /></form>
		</td>
		<td width="300" valign="top">
			<?php echo $sidebarheading; ?>
		</td>
	</tr>
	<tr>
		<td>
			<!--****Google Map****-->
			<div id="afterschoolgmap" style="border: 2px solid #979797; background-color: #e5e3df; width: 550px; height: 550px;"></div>
			<!--****End Google Map****-->
		</td>
		<td width="300" valign="top">
			<div id="the_side_bar" style="height:550px;overflow:auto;"><?php echo $sidebar; ?></div>
		</td>
	</tr>
	<tr>
		<td>
			<h2>Map Legend</h2>
			<table>
				<tr>
					<td><img src="icons/yourlocations.png"></td>
					<td valign="center">You Operate At This Location</td>
				</tr>
				<tr>
					<td><img src="icons/icon.png"></td>
					<td valign="center">You May Add This Location</td>
				</tr>
				<tr>
					<td><img src="icons/justadd.png"></td>
					<td valign="center">You Selected This Location</td>
				</tr>
			</table>
		</td>
		<td width="300" valign="bottom" align="right"><form name="addassociatedlocations" action="newsites.php" method="POST"><input type="submit" name="action" value="Save and Continue &#62;&#62;" /></form></td>
	</tr>
</table>
<br />
<?php

// add in the new locations form
require('addnewlocationsform.php'); 

// close logged_in
}else{}

// create footer
require('footer.php');

echo $mapjs;

?>

<script type="text/javascript">
function inputFocus(i){
    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
}
function inputBlur(i){
    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
}
</script>

<script language="javascript">
function toggle(obj) {
	var el = document.getElementById(obj);
	if ( el.style.display == 'none' ) {
		el.style.display = '';
	}
	else {
	}
}
</script>

<script language="javascript">
function disablebutton(obj) {
	var db = document.getElementById(obj);
	db.disabled=true;	
}
</script>



