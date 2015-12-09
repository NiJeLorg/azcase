<?php
ini_set('session.cache_limiter', 'private');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// language traslation script
require('language.php');

define("MAPS_HOST", "maps.googleapis.com");

$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/json";
$params = "&sensor=false";

$zoom = $_REQUEST['zoom'];
$language = $_REQUEST['language'];
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

if ($zoom == "9") {
	$latlonbounds = 1.0;
}elseif ($zoom == "11") {
	$latlonbounds = 0.3;
}elseif ($zoom == "12") {
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

// set up selected advanced search filters selected
$academic = $_REQUEST['academic'];
$arts = $_REQUEST['arts'];
$sports = $_REQUEST['sports'];
$community = $_REQUEST['community'];
$character = $_REQUEST['character'];
$leadership = $_REQUEST['leadership'];
$nutrition = $_REQUEST['nutrition'];
$prevention = $_REQUEST['prevention'];
$mentoring = $_REQUEST['mentoring'];
$supportservices = $_REQUEST['supportservices'];
$stem = $_REQUEST['stem'];
$college = $_REQUEST['college'];
$age5_8 = $_REQUEST['age5_8'];
$age9_11 = $_REQUEST['age9_11'];
$age12_14 = $_REQUEST['age12_14'];
$age15_18 = $_REQUEST['age15_18'];
$charge = $_REQUEST['charge'];
$feeassistance = $_REQUEST['feeassistance'];
$scholarship = $_REQUEST['scholarship'];
$desassistance = $_REQUEST['desassistance'];
$transportation = $_REQUEST['transportation'];
$food = $_REQUEST['food'];
$spanish = $_REQUEST['spanish'];
$otherlanguage = $_REQUEST['otherlanguage'];
$summer = $_REQUEST['summer'];
$mcdiscount = $_REQUEST['mcdiscount'];


// build sites part of query filter
$wheresites = '';
$whereactivity = '';
$whereages = '';
$whereother = '';
$wheresummer = '';
$summersearch = '';
$categorysearch = '';
$agesearch = '';
$othersearch = '';

// if user's chosen school year only programs (summer=1) then set summer = FALSE and stick in an AND before summer if any other options are selected
if ($summer==1) {
	$wheresummer .= " AND summer = FALSE";
	$summersearch .= $langtext['Programs that are open ONLY during the school year'];
}elseif ($summer==2){
	$wheresummer .= " AND summer = TRUE";
	$summersearch .= $langtext['Programs that are open ONLY during the summer'];
}elseif ($summer==3){
	$summersearch .= $langtext['Programs that are open during BOTH the school year and summer'];
}else{}

// bracket around activity categories if any activity categories are checked
if ($academic=="TRUE" || $arts=="TRUE" || $sports=="TRUE" || $community=="TRUE" || $character=="TRUE" || $leadership=="TRUE" || $nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
	$whereactivity .= ' (';
}else{} 

if ($academic=="TRUE") {
	$whereactivity .= " academic = 'TRUE'";
	if ($arts=="TRUE" || $sports=="TRUE" || $community=="TRUE" || $character=="TRUE" || $leadership=="TRUE" || $nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Tutoring/Academic Enrichment'] . '; ';
}else{}

if ($arts=="TRUE") {
	$whereactivity .= " arts = 'TRUE'";
	if ($sports=="TRUE" || $community=="TRUE" || $character=="TRUE" || $leadership=="TRUE" || $nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Arts and Culture'] . '; ';
}else{}

if ($sports=="TRUE") {
	$whereactivity .= " sports = 'TRUE'";
	if ($community=="TRUE" || $character=="TRUE" || $leadership=="TRUE" || $nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Sports and Recreation'] . '; ';
}else{}


if ($community=="TRUE") {
	$whereactivity .= " community = 'TRUE'";
	if ($character=="TRUE" || $leadership=="TRUE" || $nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Volunteering/Community Service'] . '; ';
}else{}

if ($character=="TRUE")	{
	$whereactivity .= " character = 'TRUE'";
	if ($leadership=="TRUE" || $nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Character Education'] . '; ';
}else{}

if ($leadership=="TRUE") {
	$whereactivity .= " leadership = 'TRUE'";
	if ($nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Leadership'] . '; ';
}else{}

if ($nutrition=="TRUE") {
	$whereactivity .= " nutrition = 'TRUE'";
	if ($prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Nutrition'] . '; ';
}else{}

if ($prevention=="TRUE") {
	$whereactivity .= " prevention = 'TRUE'";
	if ($mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Prevention'] . '; ';
}else{}

if ($mentoring=="TRUE")	{
	$whereactivity .= " mentoring = 'TRUE'";
	if ($supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Mentoring'] . '; ';
}else{}

if ($supportservices=="TRUE") {
	$whereactivity .= " supportservices = 'TRUE'";
	if ($stem=="TRUE" || $college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Support Services (medical, dental, mental health, etc.)'] . '; ';
}else{}

if ($stem=="TRUE") {
	$whereactivity .= " stem = 'TRUE'";
	if ($college=="TRUE") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= $langtext['Science, Technology, Engineering, and Mathematics'] . '; ';
}else{}

if ($college=="TRUE") {
	$whereactivity .= " college = 'TRUE'";
	$categorysearch .= $langtext['College and Career Readiness'];
}else{}


// bracket around activity categories if any activity categories are checked
if ($academic=="TRUE" || $arts=="TRUE" || $sports=="TRUE" || $community=="TRUE" || $character=="TRUE" || $leadership=="TRUE" || $nutrition=="TRUE" || $prevention=="TRUE" || $mentoring=="TRUE" || $supportservices=="TRUE" || $stem=="TRUE" || $college=="TRUE") {
	$whereactivity .= ')';
}else{} 


// bracket around age categories if any age categories are checked
if ($age5_8=="TRUE" || $age9_11=="TRUE" || $age12_14=="TRUE" || $age15_18=="TRUE") {
	$whereages .= ' (';
}else{} 

if ($age5_8=="TRUE") {	
	$whereages .= " (age5 = 'TRUE' OR age6 = 'TRUE' OR age7 = 'TRUE' OR age8 = 'TRUE')";
	if ($age9_11=="TRUE" || $age12_14=="TRUE" || $age15_18=="TRUE") {
		$whereages .= " OR";
	}else{}
	$agesearch .= "5-8; ";
}else{}

if ($age9_11=="TRUE") {	
	$whereages .= " (age9 = 'TRUE' OR age10 = 'TRUE' OR age11 = 'TRUE')";
	if ($age12_14=="TRUE" || $age15_18=="TRUE") {
		$whereages .= " OR";
	}else{}
	$agesearch .= "9-11; ";
}else{}

if ($age12_14=="TRUE") {	
	$whereages .= " (age12 = 'TRUE' OR age13 = 'TRUE' OR age14 = 'TRUE')";
	if ($age15_18=="TRUE") {
		$whereages .= " OR";
	}else{}
	$agesearch .= "12-14; ";
}else{}

if ($age15_18=="TRUE") {	
	$whereages .= " (age15 = 'TRUE' OR age16 = 'TRUE' OR age17 = 'TRUE' OR age18 = 'TRUE')";
	$agesearch .= "15-18";
}else{}

// bracket around age categories if any age categories are checked
if ($age5_8=="TRUE" || $age9_11=="TRUE" || $age12_14=="TRUE" || $age15_18=="TRUE") {
	$whereages .= ')';
}else{} 


// bracket around other categories if other categories are checked
if ($charge=="FALSE" || $feeassistance=="TRUE" || $desassistance=="TRUE" || $scholarship=="TRUE" || $mcdiscount=="TRUE" || $transportation=="TRUE" || $food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
	$whereother .= ' (';
}else{} 

if ($charge=="FALSE") {
	$whereother .= " charge = 'FALSE'";
	if ($feeassistance=="TRUE" || $desassistance=="TRUE" || $scholarship=="TRUE" || $mcdiscount=="TRUE" || $transportation=="TRUE" || $food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['No Fee'] . '; ';
}else{}

if ($feeassistance=="TRUE") {
	$whereother .= " feeassistance = 'TRUE'";
	if ($desassistance=="TRUE" || $scholarship=="TRUE" || $mcdiscount=="TRUE" || $transportation=="TRUE" || $food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['Financial Assistance Available'] . '; ';
}else{}

if ($desassistance=="TRUE") {
	$whereother .= " desassistance = 'TRUE'";
	if ($scholarship=="TRUE" || $mcdiscount=="TRUE" || $transportation=="TRUE" || $food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['Accepts DES Child Care Subsidy'] . '; ';
}else{}

if ($scholarship=="TRUE") {
	$whereother .= " scholarship = 'TRUE'";
	if ($mcdiscount=="TRUE" || $transportation=="TRUE" || $food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['Scholarships Available'] . '; ';
}else{}

if ($mcdiscount=="TRUE") {
	$whereother .= " mcdiscount = 'TRUE'";
	if ($transportation=="TRUE" || $food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['Multiple Child Discount Available'] . '; ';
}else{}

if ($transportation=="TRUE") {
	$whereother .= " transportation = 'TRUE'";
	if ($food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['Transportation Provided'] . '; ';
}else{}

if ($food=="TRUE") {
	$whereother .= " (breakfast = 'TRUE' OR lunch = 'TRUE' OR dinner = 'TRUE' OR snacks = 'TRUE')";
	if ($spanish=="TRUE" || $otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['Provides Snacks and/or Meals'] . '; ';
}else{}

if ($spanish=="TRUE") {
	$whereother .= " spanish = 'TRUE'";
	if ($otherlanguage=="TRUE") {
		$whereother .= " OR";
	}else{}
	$othersearch .= $langtext['Spanish-speaking Staff'] . '; ';
}else{}

if ($otherlanguage=="TRUE") {
	$whereother .= " otherlanguage = 'TRUE'";
	$othersearch .= $langtext['Other Languages Spoken'] . '; ';
}else{}

// bracket around other categories if other categories are checked
if ($charge=="FALSE" || $feeassistance=="TRUE" || $desassistance=="TRUE" || $scholarship=="TRUE" || $mcdiscount=="TRUE" || $transportation=="TRUE" || $food=="TRUE" || $spanish=="TRUE" || $otherlanguage=="TRUE") {
	$whereother .= ')';
}else{} 

// put the three where statements together

if (!$whereactivity && !$whereages && !$whereother) {
}elseif ($whereactivity <> '' && $whereages <> '' && $whereother <> '') {
	$wheresites = $whereactivity . ' AND ' . $whereages . ' AND ' . $whereother;
}elseif ($whereactivity <> '' && $whereages <> '') {
	$wheresites = $whereactivity . ' AND ' . $whereages;
}elseif ($whereactivity <> '' && $whereother <> '') {
	$wheresites = $whereactivity . ' AND ' . $whereother;
}elseif ($whereages <> '' && $whereother <> '') {
	$wheresites = $whereages . ' AND ' . $whereother;
}elseif ($whereactivity <> '') {
	$wheresites = $whereactivity;
}elseif ($whereages <> '') {
	$wheresites = $whereages;
}elseif ($whereother <> '') {
	$wheresites = $whereother;
}else{}


// show only verified programs
if (!$wheresites) {
	$wheresites = "verified = 1";
}else{
	$wheresites = "($wheresites) AND verified = 1";
}

// tack on summer where statement after the verified
$wheresites .= $wheresummer;

$yousearchedfor = '<br /><b>';
$yousearchedfor .= $langtext['You searched for'];
$yousearchedfor .= ':</b><ul>';

// set up you searched for fields
if (!$summersearch) {
}else{
	$yousearchedfor .= '<li><b>' . $summersearch . '</b></li>';
}

if (!$categorysearch) {
}else{
	$yousearchedfor .= '<li><b>' . $langtext['Activities'] . ':</b> ' . $categorysearch . '</li>';
}

if (!$agesearch) {
}else{
	$yousearchedfor .= '<li><b>' . $langtext['Ages Served'] . ':</b> ' . $agesearch . '</li>';
}

if (!$othersearch) {
}else{
	$yousearchedfor .= '<li><b>' . $langtext['Other Options Chosen'] . ':</b> ' . $othersearch . '</li>';
}

$yousearchedfor .= "</ul>";

// set up sidebar table and style
$sidebar = "<table width=\"275\">";

$locationquery = "SELECT locationid, name, namesp, address, address2, city, state, zip, lat, lon FROM azcase_locations WHERE the_geom && ST_expand($searchgeom, $latlonbounds) AND ST_distance($searchgeom, the_geom) < $latlonbounds AND locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE $wheresites)) ORDER BY ST_distance($searchgeom, the_geom);";
$record = pg_query($connection, $locationquery);

// if no locations exist in the search radius, then return a polite fail
if (pg_numrows($record)==0) {
	echo "<body>";
	echo $langtext['No Locations Match Your Search Criteria. Unfortunately, your search returned no matching results. Please go back and pick a new location or select different search criteria. Thank you.'];
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
// trim name
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

// escape name for KML
$name = addslashes($name);

// clear variables
$schoolyearsites = '';
$summersites = '';


// don't add school year program listings if user picked summer = TRUE
if ($summer=="TRUE") {
}else{
// add school year entry to pop-up if there are school year programs at the site
$countquery = "SELECT count(*) FROM azcase_sites WHERE $wheresites AND summer = FALSE AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE $wheresites AND locationid = $locationid);";
$countresult = pg_query($connection, $countquery);
$countschoolyear = pg_result($countresult, 0, 0);

if ($countschoolyear>0) {

	$schoolyearsites = '<h2>' . $langtext['School Year Programs'] . '</h2><ul style=\"line-height: 1.7em; \">';
	// pull and store all the school year sites associated with this location
	$sitequery = "SELECT siteid, name, namesp FROM azcase_sites WHERE $wheresites AND summer = FALSE AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE $wheresites AND locationid = $locationid);";
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

		// if signed the make it count pledge, add in quality icon
		$wp_pledge_id = '';
		$pledgeIDquery = "SELECT wp_pledge_id FROM azcase_sites_locations_junction WHERE siteid = $siteid AND locationid = $locationid;";
		$pledgerecord = pg_query($connection, $pledgeIDquery);
		for ($pledgecount = 0; $pledgecount < pg_numrows($pledgerecord); $pledgecount++) {
			$wp_pledge_id = pg_result($pledgerecord, $pledgecount, 0);
		}

		if (!$wp_pledge_id) {
			// remove extraneous characters
			$search =  '!"#$%&/()=?*+\'-.,;:_' ;
			$search = str_split($search);
			$sitenamesearch = str_replace($search, "", $sitename);
			$preps = array(' and', ' an', ' a', ' the', ' or', ' of', ' by');
			$sitenamesearch = str_replace($preps, "", $sitenamesearch);
			//let's only use the first three words for matching
			$sitenamesearch = explode(" ", $sitenamesearch);
			$sitenamesearch = array_slice($sitenamesearch, 0, 3);
			$sitenamesearch = implode(" ", $sitenamesearch);

			$WPUrl = "http://azafterschool.org/wp-json/posts?type=pledge&filter[s]=" . urlencode($sitenamesearch);
			$pledgeQuery = file_get_contents($WPUrl);
			$pledgeData = json_decode($pledgeQuery);
			if ($pledgeData) {
				$wp_pledge_id = 1;
			}
		}

		if ($wp_pledge_id) {
			$pledgeIcon = '<img src=\"http://azcase.nijel.org/phpsite/Pledge_Icon.png\" style=\"width: 24px; height: 24px; padding-left: 5px; margin-bottom: -7px;\" />';
		} else {
			$pledgeIcon = '';
		}

		$schoolyearsites .= '<li><a href=\"http://azcase.nijel.org/phpsite/advancedsite.php?siteid=';
		$schoolyearsites .= $siteid;
		$schoolyearsites .= '&locationid=';
		$schoolyearsites .= $locationid;
		$schoolyearsites .= '&language=';
		$schoolyearsites .= $language;
		$schoolyearsites .= '&searchstreet=';
		$schoolyearsites .= $searchstreet;
		$schoolyearsites .= '&searchcity=';
		$schoolyearsites .= $searchcity;
		$schoolyearsites .= '&searchstate=';
		$schoolyearsites .= $searchstate;
		$schoolyearsites .= '&searchzip=';
		$schoolyearsites .= $searchzip;
		$schoolyearsites .= '&zoom=';
		$schoolyearsites .= $zoom;
		$schoolyearsites .= '&academic=';
		$schoolyearsites .= $academic;
		$schoolyearsites .= '&arts=';
		$schoolyearsites .= $arts;
		$schoolyearsites .= '&sports=';
		$schoolyearsites .= $sports;
		$schoolyearsites .= '&sports=';
		$schoolyearsites .= $sports;
		$schoolyearsites .= '&community=';
		$schoolyearsites .= $community;
		$schoolyearsites .= '&character=';
		$schoolyearsites .= $character;
		$schoolyearsites .= '&leadership=';
		$schoolyearsites .= $leadership;
		$schoolyearsites .= '&nutrition=';
		$schoolyearsites .= $nutrition;
		$schoolyearsites .= '&prevention=';
		$schoolyearsites .= $prevention;
		$schoolyearsites .= '&mentoring=';
		$schoolyearsites .= $mentoring;
		$schoolyearsites .= '&supportservices=';
		$schoolyearsites .= $supportservices;
		$schoolyearsites .= '&stem=';
		$schoolyearsites .= $stem;
		$schoolyearsites .= '&college=';
		$schoolyearsites .= $college;
		$schoolyearsites .= '&age5_8=';
		$schoolyearsites .= $age5_8;
		$schoolyearsites .= '&age9_11=';
		$schoolyearsites .= $age9_11;
		$schoolyearsites .= '&age12_14=';
		$schoolyearsites .= $age12_14;
		$schoolyearsites .= '&age15_18=';
		$schoolyearsites .= $age15_18;
		$schoolyearsites .= '&charge=';
		$schoolyearsites .= $charge;
		$schoolyearsites .= '&feeassistance=';
		$schoolyearsites .= $feeassistance;
		$schoolyearsites .= '&scholarship=';
		$schoolyearsites .= $scholarship;
		$schoolyearsites .= '&desassistance=';
		$schoolyearsites .= $desassistance;
		$schoolyearsites .= '&transportation=';
		$schoolyearsites .= $transportation;
		$schoolyearsites .= '&food=';
		$schoolyearsites .= $food;
		$schoolyearsites .= '&spanish=';
		$schoolyearsites .= $spanish;
		$schoolyearsites .= '&otherlanguage=';
		$schoolyearsites .= $otherlanguage;
		$schoolyearsites .= '&summer=';
		$schoolyearsites .= $summer;
		$schoolyearsites .= '&mcdiscount=';
		$schoolyearsites .= $mcdiscount;
		$schoolyearsites .= '\">';
		$schoolyearsites .= $sitename;
		$schoolyearsites .= '</a>' . $pledgeIcon . '</li>';


	}

	$schoolyearsites .= "</ul>";

} //close if ($countschoolyear>0) {
} //close if ($summer==TRUE) { 

// add summer entry to pop-up if there are summer programs at the site
$countquery = "SELECT count(*) FROM azcase_sites WHERE $wheresites AND summer = TRUE AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE $wheresites AND locationid = $locationid);";
$countresult = pg_query($connection, $countquery);
$countsummer = pg_result($countresult, 0, 0);

if ($countsummer>0) {

	$summersites = '<h2>' . $langtext['Summer Programs'] . '</h2><ul style=\"line-height: 1.7em; \">';
	// pull and store all the school year sites associated with this location
	$sitequery = "SELECT siteid, name, namesp FROM azcase_sites WHERE $wheresites AND summer = TRUE AND siteid IN (SELECT siteid FROM azcase_sites_locations_junction WHERE $wheresites AND locationid = $locationid);";
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

		// if signed the make it count pledge, add in quality icon
		$wp_pledge_id = '';
		$pledgeIDquery = "SELECT wp_pledge_id FROM azcase_sites_locations_junction WHERE siteid = $siteid AND locationid = $locationid;";
		$pledgerecord = pg_query($connection, $pledgeIDquery);
		for ($pledgecount = 0; $pledgecount < pg_numrows($pledgerecord); $pledgecount++) {
			$wp_pledge_id = pg_result($pledgerecord, $pledgecount, 0);
		}

		if (!$wp_pledge_id) {
			// remove extraneous characters
			$search =  '!"#$%&/()=?*+\'-.,;:_' ;
			$search = str_split($search);
			$sitenamesearch = str_replace($search, "", $sitename);
			$preps = array(' and', ' an', ' a', ' the', ' or', ' of', ' by');
			$sitenamesearch = str_replace($preps, "", $sitenamesearch);
			//let's only use the first three words for matching
			$sitenamesearch = explode(" ", $sitenamesearch);
			$sitenamesearch = array_slice($sitenamesearch, 0, 3);
			$sitenamesearch = implode(" ", $sitenamesearch);

			$WPUrl = "http://azafterschool.org/wp-json/posts?type=pledge&filter[s]=" . urlencode($sitenamesearch);
			$pledgeQuery = file_get_contents($WPUrl);
			$pledgeData = json_decode($pledgeQuery);
			if ($pledgeData) {
				$wp_pledge_id = 1;
			}
		}

		if ($wp_pledge_id) {
			$pledgeIcon = '<img src=\"http://azcase.nijel.org/phpsite/Pledge_Icon.png\" style=\"width: 24px; height: 24px; padding-left: 5px; margin-bottom: -7px;\" />';
		} else {
			$pledgeIcon = '';
		}

		$summersites .= '<li><a href=\"http://azcase.nijel.org/phpsite/advancedsite.php?siteid=';
		$summersites .= $siteid;
		$summersites .= '&locationid=';
		$summersites .= $locationid;
		$summersites .= '&language=';
		$summersites .= $language;
		$summersites .= '&searchstreet=';
		$summersites .= $searchstreet;
		$summersites .= '&searchcity=';
		$summersites .= $searchcity;
		$summersites .= '&searchstate=';
		$summersites .= $searchstate;
		$summersites .= '&searchzip=';
		$summersites .= $searchzip;
		$summersites .= '&zoom=';
		$summersites .= $zoom;
		$summersites .= '&academic=';
		$summersites .= $academic;
		$summersites .= '&arts=';
		$summersites .= $arts;
		$summersites .= '&sports=';
		$summersites .= $sports;
		$summersites .= '&sports=';
		$summersites .= $sports;
		$summersites .= '&community=';
		$summersites .= $community;
		$summersites .= '&character=';
		$summersites .= $character;
		$summersites .= '&leadership=';
		$summersites .= $leadership;
		$summersites .= '&nutrition=';
		$summersites .= $nutrition;
		$summersites .= '&prevention=';
		$summersites .= $prevention;
		$summersites .= '&mentoring=';
		$summersites .= $mentoring;
		$summersites .= '&supportservices=';
		$summersites .= $supportservices;
		$summersites .= '&stem=';
		$summersites .= $stem;
		$summersites .= '&college=';
		$summersites .= $college;
		$summersites .= '&age5_8=';
		$summersites .= $age5_8;
		$summersites .= '&age9_11=';
		$summersites .= $age9_11;
		$summersites .= '&age12_14=';
		$summersites .= $age12_14;
		$summersites .= '&age15_18=';
		$summersites .= $age15_18;
		$summersites .= '&charge=';
		$summersites .= $charge;
		$summersites .= '&feeassistance=';
		$summersites .= $feeassistance;
		$summersites .= '&scholarship=';
		$summersites .= $scholarship;
		$summersites .= '&desassistance=';
		$summersites .= $desassistance;
		$summersites .= '&transportation=';
		$summersites .= $transportation;
		$summersites .= '&food=';
		$summersites .= $food;
		$summersites .= '&spanish=';
		$summersites .= $spanish;
		$summersites .= '&otherlanguage=';
		$summersites .= $otherlanguage;
		$summersites .= '&summer=';
		$summersites .= $summer;
		$summersites .= '&mcdiscount=';
		$summersites .= $mcdiscount;
		$summersites .= '\">';
		$summersites .= $sitename;
		$summersites .= '</a>' . $pledgeIcon . '</li>';

	}

	$summersites .= "</ul>";

} //close if ($countsummer>0) {


$contentsLayer .= '["<h1>';
$contentsLayer .= $name;
$contentsLayer .= '</h1><b>';
$contentsLayer .= $langtext['Address'];
$contentsLayer .= ':</b> ';
$contentsLayer .= $printaddress;
$contentsLayer .= ' <br \> ';
$contentsLayer .= $schoolyearsites;
$contentsLayer .= $summersites;
$contentsLayer .= ' <br /><b>';
$contentsLayer .= $langtext['Public Transit Directions To Here From'];
$contentsLayer .= ' </b><br /><form action=\"http://maps.google.com/maps\" method=\"get\" target=\"_top\"><input type=\"hidden\" name=\"f\" value=\"d\" /><input type=\"hidden\" name=\"source\" value=\"s_d\" /><input type=\"text\" name=\"saddr\" id=\"saddr\" value=\"';
$contentsLayer .= $printsearchaddress;
$contentsLayer .= '\" /><input type=\"submit\" value=\"Go!\" /><input type=\"hidden\" name=\"daddr\" value=\"';
$contentsLayer .= $printaddress;
$contentsLayer .= '\" /><input type=\"hidden\" name=\"hl\" value=\"en\" /><input type=\"hidden\" name=\"mra\" value=\"ls\" /><input type=\"hidden\" name=\"dirflg\" value=\"r\" /></form>"]';

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
<p><a href="advancedsearchhome.php?language=<?php echo $language; ?>">&#60;&#60; <?php echo $langtext['Search Again']; ?></a></p>
<h1><?php echo $langtext['Search Results']; ?></h1>
<table width="100%">
	<tr>
		<td align="left">
			<b><?php echo $langtext['Search Address']; ?>:</b> <?php echo $printsearchaddress; ?><br />
			<?php echo $yousearchedfor; ?>
		</td>
		<td align="right" valign="center" width="300">
			<form name="search" action="advancedsearch.php" method="POST">
			<?php echo $langtext['Choose Language']; ?>: 
			<select name="language">
			<option value="1" <?php if ($language==1) { echo "selected='selected'"; } else {} ?>>English</option>
			<option value="2" <?php if ($language==2) { echo "selected='selected'"; } else {} ?>>Español</option>
			</select>
			<input type="hidden" name="zoom" value="<?php echo $zoom; ?>">
			<input type="hidden" name="searchstreet" value="<?php echo $searchstreet; ?>">
			<input type="hidden" name="searchcity" value="<?php echo $searchcity; ?>">
			<input type="hidden" name="searchstate" value="<?php echo $searchstate; ?>">
			<input type="hidden" name="searchzip" value="<?php echo $searchzip; ?>">
			<input type="hidden" name="academic" value="<?php echo $academic; ?>">
			<input type="hidden" name="arts" value="<?php echo $arts; ?>">
			<input type="hidden" name="sports" value="<?php echo $sports; ?>">
			<input type="hidden" name="community" value="<?php echo $community; ?>">
			<input type="hidden" name="character" value="<?php echo $character; ?>">
			<input type="hidden" name="leadership" value="<?php echo $leadership; ?>">
			<input type="hidden" name="nutrition" value="<?php echo $nutrition; ?>">
			<input type="hidden" name="prevention" value="<?php echo $prevention; ?>">
			<input type="hidden" name="mentoring" value="<?php echo $mentoring; ?>">
			<input type="hidden" name="supportservices" value="<?php echo $supportservices; ?>">
			<input type="hidden" name="stem" value="<?php echo $stem; ?>">
			<input type="hidden" name="college" value="<?php echo $college; ?>">
			<input type="hidden" name="age5_8" value="<?php echo $age5_8; ?>">
			<input type="hidden" name="age9_11" value="<?php echo $age9_11; ?>">
			<input type="hidden" name="age12_14" value="<?php echo $age12_14; ?>">
			<input type="hidden" name="age15_18" value="<?php echo $age15_18; ?>">
			<input type="hidden" name="charge" value="<?php echo $charge; ?>">
			<input type="hidden" name="feeassistance" value="<?php echo $feeassistance; ?>">
			<input type="hidden" name="scholarship" value="<?php echo $scholarship; ?>">
			<input type="hidden" name="desassistance" value="<?php echo $desassistance; ?>">
			<input type="hidden" name="transportation" value="<?php echo $transportation; ?>">
			<input type="hidden" name="food" value="<?php echo $food; ?>">
			<input type="hidden" name="spanish" value="<?php echo $spanish; ?>">
			<input type="hidden" name="otherlanguage" value="<?php echo $otherlanguage; ?>">
			<input type="hidden" name="summer" value="<?php echo $summer; ?>">
			<input type="hidden" name="mcdiscount" value="<?php echo $mcdiscount; ?>">
			<input type="submit" name="submit" value="<?php echo $langtext['Set']; ?>">
			</form>
		</td>
	<tr>
</table>
<table border="0" width="100%">
	<tr>
		<td width="300" valign="top">
			<div id="the_side_bar" style="height:550px;overflow:auto;"><?php echo $sidebar; ?></div>
		</td>
		<td width="70%">
			<!--****Google Map****-->
			<div id="afterschoolgmap" style="border: 2px solid #979797; background-color: #e5e3df; width: 100%; height: 550px;"></div>
			<!--****End Google Map****-->
		</td>
	</tr>
</table>

<?php

// create footer
require('footer.php');
?>

<!--****Google Maps Key Script****-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC70RNwqu3YmSo5D-iEYDCQRWRB0Gt9QOQ&sensor=false<?php if ($language==2) { echo '&language=es';} else{} ?>"></script>

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
