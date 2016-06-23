<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// language traslation script
require('language.php');

$siteid = $_REQUEST['siteid'];
$locationid = $_REQUEST['locationid'];
$language = $_REQUEST['language'];
$zoom = $_REQUEST['zoom'];
$language = $_REQUEST['language'];
$searchstreet = $_REQUEST['searchstreet'];
$searchcity = $_REQUEST['searchcity'];
$searchstate = $_REQUEST['searchstate'];
$searchzip = $_REQUEST['searchzip'];
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

$searchurl = 'advancedsearch.php?';
$searchurl .= 'language=';
$searchurl .= $language;
$searchurl .= '&searchstreet=';
$searchurl .= $searchstreet;
$searchurl .= '&searchcity=';
$searchurl .= $searchcity;
$searchurl .= '&searchstate=';
$searchurl .= $searchstate;
$searchurl .= '&searchzip=';
$searchurl .= $searchzip;
$searchurl .= '&zoom=';
$searchurl .= $zoom;
$searchurl .= '&academic=';
$searchurl .= $academic;
$searchurl .= '&arts=';
$searchurl .= $arts;
$searchurl .= '&sports=';
$searchurl .= $sports;
$searchurl .= '&sports=';
$searchurl .= $sports;
$searchurl .= '&community=';
$searchurl .= $community;
$searchurl .= '&character=';
$searchurl .= $character;
$searchurl .= '&leadership=';
$searchurl .= $leadership;
$searchurl .= '&nutrition=';
$searchurl .= $nutrition;
$searchurl .= '&prevention=';
$searchurl .= $prevention;
$searchurl .= '&mentoring=';
$searchurl .= $mentoring;
$searchurl .= '&supportservices=';
$searchurl .= $supportservices;
$searchurl .= '&stem=';
$searchurl .= $stem;
$searchurl .= '&college=';
$searchurl .= $college;
$searchurl .= '&age5_8=';
$searchurl .= $age5_8;
$searchurl .= '&age9_11=';
$searchurl .= $age9_11;
$searchurl .= '&age12_14=';
$searchurl .= $age12_14;
$searchurl .= '&age15_18=';
$searchurl .= $age15_18;
$searchurl .= '&charge=';
$searchurl .= $charge;
$searchurl .= '&feeassistance=';
$searchurl .= $feeassistance;
$searchurl .= '&scholarship=';
$searchurl .= $scholarship;
$searchurl .= '&desassistance=';
$searchurl .= $desassistance;
$searchurl .= '&transportation=';
$searchurl .= $transportation;
$searchurl .= '&food=';
$searchurl .= $food;
$searchurl .= '&spanish=';
$searchurl .= $spanish;
$searchurl .= '&otherlanguage=';
$searchurl .= $otherlanguage;
$searchurl .= '&summer=';
$searchurl .= $summer;
$searchurl .= '&mcdiscount=';
$searchurl .= $mcdiscount;



//format searchaddress for printing
if ($searchstreet=="") {
	$comma1 = "";
}else{
	$comma1 = ", ";
}

if ($searchstreet=="") {
	$comma2 = "";
}else{
	$comma2 = ", ";
}

$printsearchaddress = $searchstreet . $comma1 . $searchcity . $comma2 . $searchstate . ' ' . $searchzip;


// select location information from location table
$locationquery = "SELECT name, namesp, address, address2, city, state, zip, lat, lon FROM azcase_locations WHERE locationid = $locationid;";
$record = pg_query($connection, $locationquery);
  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
    $locationname = pg_result($record, $lt, 0);
    $locationnamesp = pg_result($record, $lt, 1);
    $address = pg_result($record, $lt, 2);
    $address2 = pg_result($record, $lt, 3);
    $city = pg_result($record, $lt, 4);
    $state = pg_result($record, $lt, 5);
    $zip = pg_result($record, $lt, 6);
    $lat = pg_result($record, $lt, 7);
    $lon = pg_result($record, $lt, 8);
}


// select sites data from sites table
$sitequery = "SELECT 
updated,
name, 
namesp, 
phone,
fax,
email,
pubemail,
url,
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
monstartmorning,
tuestartmorning,
wedstartmorning,
thustartmorning,
fristartmorning,
monendmorning,
tueendmorning,
wedendmorning,
thuendmorning,
friendmorning,
monstartafter,
tuestartafter,
wedstartafter,
thustartafter,
fristartafter,
monendafter,
tueendafter,
wedendafter,
thuendafter,
friendafter,
satstartweekend,
sunstartweekend,
satendweekend,
sunendweekend,
charge,
costfrequency,
costamount,
feeassistance,
desassistance,
scholarship,
mcdiscount,
otherassistance,
transportation,
snacks,
breakfast,
lunch,
dinner,
freelunch,
spanish,
otherlanguage,
summer,
stem,
college
FROM azcase_sites WHERE siteid = $siteid;";
$record = pg_query($connection, $sitequery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
$updated = pg_result($record, $lt, 0);
$sitename = pg_result($record, $lt, 1); 
$sitenamesp = pg_result($record, $lt, 2); 
$phone = pg_result($record, $lt, 3);
$fax = pg_result($record, $lt, 4);
$email = pg_result($record, $lt, 5);
$pubemail = pg_result($record, $lt, 6);
$url = pg_result($record, $lt, 7);
$age5 = pg_result($record, $lt, 8);
$age6 = pg_result($record, $lt, 9);
$age7 = pg_result($record, $lt, 10);
$age8 = pg_result($record, $lt, 11);
$age9 = pg_result($record, $lt, 12);
$age10 = pg_result($record, $lt, 13);
$age11 = pg_result($record, $lt, 14);
$age12 = pg_result($record, $lt, 15);
$age13 = pg_result($record, $lt, 16);
$age14 = pg_result($record, $lt, 17);
$age15 = pg_result($record, $lt, 18);
$age16 = pg_result($record, $lt, 19);
$age17 = pg_result($record, $lt, 20);
$age18 = pg_result($record, $lt, 21);
$arts = pg_result($record, $lt, 22);
$character = pg_result($record, $lt, 23);
$leadership = pg_result($record, $lt, 24);
$mentoring = pg_result($record, $lt, 25);
$nutrition = pg_result($record, $lt, 26);
$prevention = pg_result($record, $lt, 27);
$sports = pg_result($record, $lt, 28);
$supportservices = pg_result($record, $lt, 29);
$academic = pg_result($record, $lt, 30);
$community = pg_result($record, $lt, 31);
$monstartmorning = pg_result($record, $lt, 32);
$tuestartmorning = pg_result($record, $lt, 33);
$wedstartmorning = pg_result($record, $lt, 34);
$thustartmorning = pg_result($record, $lt, 35);
$fristartmorning = pg_result($record, $lt, 36);
$monendmorning = pg_result($record, $lt, 37);
$tueendmorning = pg_result($record, $lt, 38);
$wedendmorning = pg_result($record, $lt, 39);
$thuendmorning = pg_result($record, $lt, 40);
$friendmorning = pg_result($record, $lt, 41);
$monstartafter = pg_result($record, $lt, 42);
$tuestartafter = pg_result($record, $lt, 43);
$wedstartafter = pg_result($record, $lt, 44);
$thustartafter = pg_result($record, $lt, 45);
$fristartafter = pg_result($record, $lt, 46);
$monendafter = pg_result($record, $lt, 47);
$tueendafter = pg_result($record, $lt, 48);
$wedendafter = pg_result($record, $lt, 49);
$thuendafter = pg_result($record, $lt, 50);
$friendafter = pg_result($record, $lt, 51);
$satstartweekend = pg_result($record, $lt, 52);
$sunstartweekend = pg_result($record, $lt, 53);
$satendweekend = pg_result($record, $lt, 54);
$sunendweekend = pg_result($record, $lt, 55);
$charge = pg_result($record, $lt, 56);
$costfrequency = pg_result($record, $lt, 57);
$costamount = pg_result($record, $lt, 58);
$feeassistance = pg_result($record, $lt, 59);
$desassistance = pg_result($record, $lt, 60);
$scholarship = pg_result($record, $lt, 61);
$mcdiscount = pg_result($record, $lt, 62);
$otherassistance = pg_result($record, $lt, 63);
$transportation = pg_result($record, $lt, 64);
$snacks = pg_result($record, $lt, 65);
$breakfast = pg_result($record, $lt, 66);
$lunch = pg_result($record, $lt, 67);
$dinner = pg_result($record, $lt, 68);
$freelunch = pg_result($record, $lt, 69);
$spanish = pg_result($record, $lt, 70);
$otherlanguage = pg_result($record, $lt, 71);
$summer = pg_result($record, $lt, 72);
$stem = pg_result($record, $lt, 73);
$college = pg_result($record, $lt, 74);
}


// select site survey data from site survey table
$sitesurveyquery = "SELECT 
slidescale,
otherassistancedescription,
transportcost,
parentreferrals,
parenteducation,
parentinfo,
parentotherdescription,
programtype
FROM azcase_site_survey WHERE siteid = $siteid AND locationid = $locationid;";
$record = pg_query($connection, $sitesurveyquery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
$slidescale = pg_result($record, $lt, 0);
$otherassistancedescription = pg_result($record, $lt, 1);
$transportcost = pg_result($record, $lt, 2);
$parentreferrals = pg_result($record, $lt, 3);
$parenteducation = pg_result($record, $lt, 4);
$parentinfo = pg_result($record, $lt, 5);
$parentotherdescription = pg_result($record, $lt, 6);
$programtype = pg_result($record, $lt, 7);
}


// clean up data for html display

//change updated to Month, Day Year format
if (!$updated) {
	$updated = $langtext['Not Updated'];
}else{
	$updated = date('M j, Y', strtotime($updated)); 
}

// format url
if (!$url) {
}else{
	$http = "http://";
	$url = str_replace($http, "", $url);
	$url = $http . $url;  
}

// format address
$printaddress = $address;
if (!$address2) { 
	$printaddress .= '; '; 
}else{ 
	$printaddress .=  ' ' . $address2 . '; '; 
}
$printaddress .= $city . ' ';
$printaddress .= $state . ' ';
$printaddress .= $zip . ' '; 

// format ages
require('formatage.php');

// format activity categories
require('formatactivity.php');

// format start and end times
require('formattimes.php');

// format additional data
if (!$charge) {
	$charge = '';
}elseif ($charge=='t') {
	$charge = '<li>';
	$charge .= $langtext['This program charges a fee'];
}elseif ($charge=='f') {
	$charge = '';
}else{}

if (!$costfrequency) {
	$costfrequency = '';
}elseif ($costfrequency==1) {
	$costfrequency = $langtext['Weekly'];
}elseif ($costfrequency==2) {
	$costfrequency = $langtext['Monthly'];
}elseif ($costfrequency==3) {
	$costfrequency = $langtext['Quarterly'];
}elseif ($costfrequency==4) {
	$costfrequency = $langtext['Per School Semester'];
}elseif ($costfrequency==5) {
	$costfrequency = $langtext['Annual'];
}elseif ($costfrequency==6) {
	$costfrequency = $langtext['Summer'];
}else{}

if ((!$charge || $charge=='f') && !$costamount) {
	$costamount = '';
}elseif (!$costamount) {
	$costamount = '</li>';
	$charge = $charge . $costamount;
}else{	
	$costamountnum = '$' . number_format($costamount, 2);
	$costamount = ' (';
	$costamount .= $costfrequency . ' ';
	$costamount .= $langtext['cost'] . ': ';	
	$costamount .= $costamountnum . ')';
	$costamount .= '</li>';
	$charge = $charge . $costamount;
}

if (!$feeassistance) {
	$feeassistance = '';
}elseif ($feeassistance=='t') {
	$feeassistance = '<li>';
	$feeassistance .= $langtext['Financial assistance available'];
	$feeassistance .= '</li>';
}elseif ($feeassistance=='f') {
	$feeassistance = '';
}else{}
	
if (!$desassistance) {
	$desassistance = '';
}elseif ($desassistance=='t') {
	$desassistance = '<li>';
	$desassistance .= $langtext['DES assistance accepted'];
	$desassistance .= '</li>';
}elseif ($desassistance=='f') {
	$desassistance = '';
}else{}

if (!$scholarship) {
	$scholarship = '';
}elseif ($scholarship=='t') {
	$scholarship = '<li>';
	$scholarship .= $langtext['Scholarship assistance available'];
	$scholarship .= '</li>';
}elseif ($scholarship=='f') {
	$scholarship = '';
}else{}
	
if (!$mcdiscount) {
	$mcdiscount = '';
}elseif ($mcdiscount=='t') {
	$mcdiscount = '<li>';
	$mcdiscount .= $langtext['Multiple child discount available'];
	$mcdiscount .= '</li>';
}elseif ($mcdiscount=='f') {
	$mcdiscount = '';
}else{}

if (!$otherassistance) {
	$otherassistance = '';
}elseif ($otherassistance=='t') {
	if (!$otherassistancedescription) {
		$otherassistance = '<li>';
		$otherassistance .= $langtext['Other financial assistance available'];
		$otherassistance .= '</li>';
	}else{
		$otherassistance = '<li>';
		$otherassistance .= $langtext['Other financial assistance available'] . ' ';
		$otherassistance .= $otherassistancedescription;
		$otherassistance .= '</li>';
	}	
}elseif ($otherassistance=='f') {
	$otherassistance = '';
}else{}

if (!$transportation) {
	$transportation = '';
}elseif ($transportation=='t') {
	$transportation = '<li>';
	$transportation .= $langtext['Transportation assistance available'];
	$transportation .= '</li>';
}elseif ($transportation=='f') {
	$transportation = '';
}else{}

if (!$breakfast) {
	$breakfast = '';
}elseif ($breakfast=='t') {
	$breakfast = '<li>';
	$breakfast .= $langtext['Breakfast provided'];
	$breakfast .= '</li>';
}elseif ($breakfast=='f') {
	$breakfast = '';
}else{}

if (!$lunch) {
	$lunch = '';
}elseif ($lunch=='t') {
	$lunch = '<li>';
	$lunch .= $langtext['Lunch provided'];
	$lunch .= '</li>';
}elseif ($lunch=='f') {
	$lunch = '';
}else{}

if (!$dinner) {
	$dinner = '';
}elseif ($dinner=='t') {
	$dinner = '<li>';
	$dinner .= $langtext['Dinner provided'];
	$dinner .= '</li>';
}elseif ($dinner=='f') {
	$dinner = '';
}else{}

if (!$snacks) {
	$snacks = '';
}elseif ($snacks=='t') {
	$snacks = '<li>';
	$snacks .= $langtext['Snacks provided'];
	$snacks .= '</li>';
}elseif ($snacks=='f') {
	$snacks = '';
}else{}

if (!$spanish) {
	$spanish = '';
}elseif ($spanish=='t') {
	$spanish = '<li>';
	$spanish .= $langtext['Spanish spoken'];
	$spanish .= '</li>';
}elseif ($spanish=='f') {
	$spanish = '';
}else{}

if (!$otherlanguage) {
	$otherlanguage = '';
}elseif ($otherlanguage=='t') {
	$otherlanguage = '<li>';
	$otherlanguage .= $langtext['Other languages spoken'];
	$otherlanguage .= '</li>';
}elseif ($otherlanguage=='f') {
	$otherlanguage = '';
}else{}


if (!$slidescale) {
	$slidescale = '';
}elseif ($slidescale=='t') {
	$slidescale = '<li>';
	$slidescale .= $langtext['Fees assessed on a sliding scale'];
	$slidescale .= '</li>';
}elseif ($slidescale=='f') {
	$slidescale = '';
}else{}

if ((!$transportation || $transportation=='f') && !$transportcost) {
	$transportcost = '';
}elseif (!$transportcost) {
	$transportcost = '';
}else{
	$transportcostnum = '$' . number_format($transportcost, 2);
	$transportcost = '<li>';
	$transportcost .= $langtext['Average Monthly Transportation Cost'];
	$transportcost .= ': ';
	$transportcost .= $transportcostnum;
	$transportcost .= '</li>';
}

if (!$parentreferrals) {
	$parentreferrals = '';
}elseif ($parentreferrals=='t') {
	$parentreferrals = '<li>';
	$parentreferrals .= $langtext['Referrals for needed services provided'];
	$parentreferrals .= '</li>';
}elseif ($parentreferrals=='f') {
	$parentreferrals = '';
}else{}
  
if (!$parenteducation) {
	$parenteducation = '';
}elseif ($parenteducation=='t') {
	$parenteducation = '<li>';
	$parenteducation .= $langtext['Parent education provided'];
	$parenteducation .= '</li>';
}elseif ($parenteducation=='f') {
	$parenteducation = '';
}else{}

if (!$parentinfo) {
	$parentinfo = '';
}elseif ($parentinfo=='t') {
	$parentinfo = '<li>';
	$parentinfo .= $langtext['Information and handouts provided to parents'];
	$parentinfo .= '</li>';
}elseif ($parentinfo=='f') {
	$parentinfo = '';
}else{}

if (!$parentotherdescription) {
	$parentotherdescription = '';
}else{
	$parentotherdescription = '<li>';
	$parentotherdescription .= $langtext['Other items provided to parents'];
	$parentotherdescription .= ': ';
	$parentotherdescription .= $parentotherdescriptiontext;
	$parentotherdescription .= '</li>';
}

if (!$programtype) {
	$programtype = '';
}elseif ($programtype==1) {
	$programtype = '<li><b>';
	$programtype .= $langtext['Program type'];
	$programtype .= ':</b> ';
	$programtype .= $langtext['21st Century Community Center'];
	$programtype .= '</li>';
}elseif ($programtype==2) {
	$programtype = '<li><b>';
	$programtype .= $langtext['Program type'];
	$programtype .= ':</b> ';
	$programtype .= $langtext['Faith-based Program'];
	$programtype .= '</li>';
}elseif ($programtype==3) {
	$programtype = '<li><b>';
	$programtype .= $langtext['Program type'];
	$programtype .= ':</b> ';
	$programtype .= $langtext['Public School Based Program'];
	$programtype .= '</li>';
}elseif ($programtype==4) {
	$programtype = '<li><b>';
	$programtype .= $langtext['Program type'];
	$programtype .= ':</b> ';
	$programtype .= $langtext['Private School Based Program'];
	$programtype .= '</li>';
}elseif ($programtype==5) {
	$programtype = '<li><b>';
	$programtype .= $langtext['Program type'];
	$programtype .= ':</b> ';
	$programtype .= $langtext['Home Based Program'];
	$programtype .= '</li>';
}elseif ($programtype==6) {
	$programtype = '<li><b>';
	$programtype .= $langtext['Program type'];
	$programtype .= ':</b> ';
	$programtype .= $langtext['Corporate Run Program'];
	$programtype .= '</li>';
}elseif ($programtype==7) {
	$programtype = '<li><b>';
	$programtype .= $langtext['Program type'];
	$programtype .= ':</b> ';
	$programtype .= $langtext['Community Based Program'];
	$programtype .= '</li>';
}else{}


// for map popup
$contentsLayer .= 'var contentsLayer = "<h1>';
$contentsLayer .= $locationname;
$contentsLayer .= '</h1><b>';
$contentsLayer .= $langtext['Address'];
$contentsLayer .= ':</b> ';
$contentsLayer .= $printaddress;
$contentsLayer .= ' <br /><b>';
$contentsLayer .= $langtext['Public Transit Directions To Here From'];
$contentsLayer .= ' </b><br /><form action=\"http://maps.google.com/maps\" method=\"get\" target=\"_top\"><input type=\"hidden\" name=\"f\" value=\"d\" /><input type=\"hidden\" name=\"source\" value=\"s_d\" /><input type=\"text\" name=\"saddr\" id=\"saddr\" value=\"';
$contentsLayer .= $printsearchaddress;
$contentsLayer .= '\" /><input type=\"submit\" value=\"';
$contentsLayer .= $langtext['Go!'];
$contentsLayer .= '\" /><input type=\"hidden\" name=\"daddr\" value=\"';
$contentsLayer .= $printaddress;
$contentsLayer .= '\" /><input type=\"hidden\" name=\"hl\" value=\"en\" /><input type=\"hidden\" name=\"mra\" value=\"ls\" /><input type=\"hidden\" name=\"dirflg\" value=\"r\" /></form>"';


// adding in the make it count pledge through the wordpress api
// see if pledge page ID has been set first and pass that as url
$wp_pledge_id = '';
$pledgeIDquery = "SELECT wp_pledge_id FROM azcase_sites_locations_junction WHERE siteid = $siteid AND locationid = $locationid;";
$record = pg_query($connection, $pledgeIDquery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
	$wp_pledge_id = pg_result($record, $lt, 0);
}

if ($wp_pledge_id) {
	$WPUrl = "http://azafterschool.org/wp-json/posts?type=pledge&filter[page_id]=" . urlencode($wp_pledge_id);
} else {
	// remove extraneous characters
	$search =  '!"#$%&/()=?*+\'-.,;:_' ;
	$search = str_split($search);
	$sitenamesearch = str_replace($search, "", $sitename);
	$preps = array(' and', ' an', ' a', ' the', ' or', ' of', ' by');
	$sitenamesearch = str_replace($preps, "", $sitenamesearch);
	//let's only use the first four words for matching
	$sitenamesearch = explode(" ", $sitenamesearch);
	$sitenamesearch = array_slice($sitenamesearch, 0, 5);
	$sitenamesearch = implode(" ", $sitenamesearch);

	$WPUrl = "http://azafterschool.org/wp-json/posts?type=pledge&filter[s]=" . urlencode($sitenamesearch);
}

$pledgeQuery = file_get_contents($WPUrl);
$pledgeData = json_decode($pledgeQuery);
if ($pledgeData) {
	$pledge = 1;
	$pledgeURL = $pledgeData[0] -> link;
} else {
	$pledge = 0;
}


?>
<body onload="initialize()">
	<p><a href="advancedsearchhome.php?language=<?php echo $language; ?>">&#60;&#60; <?php echo $langtext['Search Again']; ?></a> | <a href="<?php echo $searchurl; ?>">&#60;&#60; <?php echo $langtext['Back to Your Search']; ?></a></p>
	<table width="100%">
		<tr>
			<td align="left"><span class="name"><?php echo $sitename; ?></span></td>
			<td align="right"><b><?php echo $langtext['Last Updated']; ?>:</b> <?php echo $updated; ?></td>
		</tr>
		<tr>
			<td align="left" valign="top"><b><?php echo $langtext['Website']; ?>: </b><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></td>
			<?php 
				if ($pledge == 1) {
			?>
					<td align="right"><a href="<?php echo $pledgeURL; ?>" target="_blank"><img src="MIC_Pledge_Badge.png"/></a></td>
			<?php 
				}
			?>
		</tr>
	</table>
	<br />
	<table width="924">
		<tr>
			<td width="374" valign="top" style="padding-right: 10px;">
				<b><?php echo $langtext['Address']; ?>: </b><?php echo $printaddress; ?><br />
				<b><?php echo $langtext['Phone']; ?>: </b><?php echo $phone; ?><br />
				<?php if (!$fax) {} else { echo '<b>'. $langtext['Fax'] . ':</b> '.$fax.'<br />'; } ?>
				<b><?php echo $langtext['Email']; ?>:</b> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br /><br />
				<b><?php echo $langtext['Activities']; ?>:</b><br />
				<?php echo $activities; ?>
				<b><?php echo $langtext['Ages Served']; ?>:</b> <?php echo $agesserved; ?>				
			</td>
			<td><div id="afterschoolgmap" style="border: 1px solid #979797; background-color: #e5e3df; width: 550px; height: 250px;"></div></td>
		</tr>
	</table>
	<br />
	<?php if ($summer=='t') { echo '<h1>' . $langtext['Summer Program'] . '</h1>'; }else{} ?>
	<table class="hoursTable" cellpadding="4">
		<tr>
			<th align="left" ><b><?php if ($summer=='t') { echo $langtext['Summer'] . ' '; }else{} ?><?php echo $langtext['Hours of Operation']; ?></b></th>
			<th align="right" ><b><?php echo $langtext['Morning Start Time']; ?></b></th>
			<th align="right" ><b><?php echo $langtext['Morning End Time']; ?></b></th>
			<th align="right" ><b><?php echo $langtext['Afternoon Start Time']; ?></b></th>
			<th align="right" ><b><?php echo $langtext['Afternoon End Time']; ?></b></th>
		</tr>
		<tr>
			<td class="firstcol" align="left"><b><?php echo $langtext['Monday']; ?>:</b></td>
			<?php echo $monday; ?>
		</tr>
		<tr class="alt">
			<td class="firstcol" align="left"><b><?php echo $langtext['Tuesday']; ?>:</b></td>
			<?php echo $tuesday; ?>
		</tr>
		<tr>
			<td class="firstcol" align="left"><b><?php echo $langtext['Wednesday']; ?>:</b></td>
			<?php echo $wednesday; ?>
		</tr>
		<tr class="alt">
			<td class="firstcol" align="left"><b><?php echo $langtext['Thursday']; ?>:</b></td>
			<?php echo $thursday; ?>
		</tr>
		<tr>
			<td class="firstcol" align="left"><b><?php echo $langtext['Friday']; ?>:</b></td>
			<?php echo $friday; ?>
		</tr>
		<tr>
			<th align="left" ><b><?php echo $langtext['Weekend Hours']; ?></b></th>
			<th align="center" colspan="2"><b><?php echo $langtext['Start Time']; ?></b></th>
			<th align="center" colspan="2"><b><?php echo $langtext['End Time']; ?></b></th>
		</tr>
		<tr>
			<td class="firstcol" align="left"><b><?php echo $langtext['Saturday']; ?>:</b></td>
			<?php echo $saturday; ?>
		</tr>
		<tr class="alt">
			<td class="firstcol" align="left"><b><?php echo $langtext['Sunday']; ?>:</b></td>
			<?php echo $sunday; ?>
		</tr>
	</table>
	<br />
	<h1><?php echo $langtext['Other Program Information']; ?>:</h1>
<?php
if (!$charge && !$costamount && !$feeassistance && !$desassistance && !$scholarship && !$slidescale && !$mcdiscount && !$otherassistance) {
}else{
	echo '<b>';
	echo $langtext['Financial'];
	echo '</b>';
}
?>	
	<ul>
		<?php 
		echo $charge;
		echo $feeassistance;
		echo $desassistance;
		echo $scholarship;
		echo $slidescale;
		echo $mcdiscount;
		echo $otherassistance;
		?>
	</ul>
<?php
if (!$transportation && !$transportcost && !$breakfast && !$lunch && !$dinner && !$snacks) {
}else{
	echo '<b>';
	echo $langtext['Transportation/Food'];
	echo '</b>';
}
?>	
	<ul>
		<?php 
		echo $transportation;
		echo $transportcost;
		echo $breakfast;
		echo $lunch;
		echo $dinner;
		echo $snacks;
		?>
	</ul>
<?php
if (!$programtype && !$spanish && !$otherlanguage && !$parentreferrals && !$parenteducation && !$parentinfo && !$parentotherdescription) {
}else{
	echo '<b>';
	echo $langtext['Other'];
	echo '</b>';
}
?>	
	<ul>
		<?php 
		echo $programtype;
		echo $spanish;
		echo $otherlanguage;
		echo $parentreferrals;
		echo $parenteducation;
		echo $parentinfo;
		echo $parentotherdescription;
		?>
	</ul>

<?php

// create footer
require('footer.php');
?>

<!--****Google Maps Key Script****-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC70RNwqu3YmSo5D-iEYDCQRWRB0Gt9QOQ&sensor=false<?php if ($language==2) { echo '&language=es';} else{} ?>"></script>

<!--****Javascript that creates the map****-->
<script type="text/javascript">
var map;
var infowindow = new google.maps.InfoWindow({"maxWidth": 300});


function initialize() {
	var centerLatLon = new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lon;?>);
	var myOptions = {
		center: centerLatLon,
		zoom: 15,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
        map = new google.maps.Map(document.getElementById("afterschoolgmap"), myOptions);
	var marker = new google.maps.Marker({
		position: centerLatLon,
		map: map,
		title:"<?php echo $locationname; ?>"
  	});

	<?php echo $contentsLayer; ?>

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.close();
		infowindow.setContent(contentsLayer);
		infowindow.open(map,marker);
	});


}

</script>


