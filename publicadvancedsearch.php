<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// bring in filters from the advanced search page and build the big where statement

// set where to null
$where = '';
$join = '';

// azcongress where statements
$azcongresswhere = '';
$azcongresssearch = '';
$azcongresscounter = 0;
$azcongressquery = "SELECT gid FROM az_congress ORDER BY gid;";
$result = pg_query($connection, $azcongressquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$gid = pg_result($result, $lt, 0);

${'azcongressfilter'.$gid} = $_REQUEST["azcongressfilter$gid"];

if (${'azcongressfilter'.$gid}=='t') {
	if ($azcongresscounter==0) {
		$azcongresswhere = " (";
	}elseif ($azcongresscounter>0) {
		$azcongresswhere .= " OR";
	}else{}

	$azcongresswhere .= " c.gid = $gid";
	$azcongresssearch .= "$gid; ";
	$azcongresscounter++;
} // if (${'countryfilter'.$country}=='t') {

// close bracket around where if last itteration though loop
if (pg_numrows($result)-1==$lt && $azcongresswhere!='') {
	$azcongresswhere .= ") ";
	$azcongressjoin = " JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) ";
}else{}
	
} // for ($lt = 0; $lt < pg_numrows($result); $lt++) {

// stateleg where statements
$statelegwhere = '';
$statelegsearch = '';
$statelegcounter = 0;
$statelegquery = "SELECT gid FROM az_legisl ORDER BY gid;";
$result = pg_query($connection, $statelegquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$gid = pg_result($result, $lt, 0);

${'statelegfilter'.$gid} = $_REQUEST["statelegfilter$gid"];

if (${'statelegfilter'.$gid}=='t') {
	if ($statelegcounter==0) {
		$statelegwhere = " (";
	}elseif ($statelegcounter>0) {
		$statelegwhere .= " OR";
	}else{}

	$statelegwhere .= " d.gid = $gid";
	$statelegsearch .= "$gid; ";
	$statelegcounter++;
} // if (${'countryfilter'.$country}=='t') {

// close bracket around where if last itteration though loop
if (pg_numrows($result)-1==$lt && $statelegwhere!='') {
	$statelegwhere .= ") ";
	$statelegjoin = " JOIN az_legisl AS d ON ST_Contains(d.the_geom, b.the_geom) ";
}else{}
	
} // for ($lt = 0; $lt < pg_numrows($result); $lt++) {

// elemschooldistrict where statements
$elemschooldistrictwhere = '';
$elemschooldistrictsearch = '';
$elemschooldistrictcounter = 0;
$elemschooldistrictquery = "SELECT gid, name10 FROM az_elm_districts ORDER BY name10;";
$result = pg_query($connection, $elemschooldistrictquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$gid = pg_result($result, $lt, 0);
	$name = pg_result($result, $lt, 1);

${'elemschooldistrictfilter'.$gid} = $_REQUEST["elemschooldistrictfilter$gid"];

if (${'elemschooldistrictfilter'.$gid}=='t') {
	if ($elemschooldistrictcounter==0) {
		$elemschooldistrictwhere = " (";
	}elseif ($elemschooldistrictcounter>0) {
		$elemschooldistrictwhere .= " OR";
	}else{}

	$elemschooldistrictwhere .= " e.gid = $gid";
	$elemschooldistrictsearch .= "$name; ";
	$elemschooldistrictcounter++;
} // if (${'countryfilter'.$country}=='t') {

// close bracket around where if last itteration though loop
if (pg_numrows($result)-1==$lt && $elemschooldistrictwhere!='') {
	$elemschooldistrictwhere .= ") ";
	$elemschooldistrictjoin = " JOIN az_elm_districts AS e ON ST_Contains(e.the_geom, b.the_geom) ";
}else{}
	
} // for ($lt = 0; $lt < pg_numrows($result); $lt++) {

// unionschooldistrict where statements
$unionschooldistrictwhere = '';
$unionschooldistrictsearch = '';
$unionschooldistrictcounter = 0;
$unionschooldistrictquery = "SELECT gid, name10 FROM az_union_second_school_distcts ORDER BY name10;";
$result = pg_query($connection, $unionschooldistrictquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$gid = pg_result($result, $lt, 0);
	$name = pg_result($result, $lt, 1);

${'unionschooldistrictfilter'.$gid} = $_REQUEST["unionschooldistrictfilter$gid"];

if (${'unionschooldistrictfilter'.$gid}=='t') {
	if ($unionschooldistrictcounter==0) {
		$unionschooldistrictwhere = " (";
	}elseif ($unionschooldistrictcounter>0) {
		$unionschooldistrictwhere .= " OR";
	}else{}

	$unionschooldistrictwhere .= " f.gid = $gid";
	$unionschooldistrictsearch .= "$name; ";
	$unionschooldistrictcounter++;
} // if (${'countryfilter'.$country}=='t') {

// close bracket around where if last itteration though loop
if (pg_numrows($result)-1==$lt && $unionschooldistrictwhere!='') {
	$unionschooldistrictwhere .= ") ";
	$unionschooldistrictjoin = " JOIN az_union_second_school_distcts AS f ON ST_Contains(f.the_geom, b.the_geom) ";
}else{}
	
} // for ($lt = 0; $lt < pg_numrows($result); $lt++) {

// cities where statements
$citieswhere = '';
$citiessearch = '';
$citiescounter = 0;
$citiesquery = "SELECT gid, name10 FROM az_cities ORDER BY name10;";
$result = pg_query($connection, $citiesquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$gid = pg_result($result, $lt, 0);
	$name = pg_result($result, $lt, 1);

${'citiesfilter'.$gid} = $_REQUEST["citiesfilter$gid"];

if (${'citiesfilter'.$gid}=='t') {
	if ($citiescounter==0) {
		$citieswhere = " (";
	}elseif ($citiescounter>0) {
		$citieswhere .= " OR";
	}else{}

	$citieswhere .= " g.gid = $gid";
	$citiessearch .= "$name; ";
	$citiescounter++;
} // if (${'countryfilter'.$country}=='t') {

// close bracket around where if last itteration though loop
if (pg_numrows($result)-1==$lt && $citieswhere!='') {
	$citieswhere .= ") ";
	$citiesjoin = " JOIN az_cities AS g ON ST_Contains(g.the_geom, b.the_geom) ";
}else{}
	
} // for ($lt = 0; $lt < pg_numrows($result); $lt++) {

// category where statements
$whereactivity = '';
$academic = $_REQUEST["catfilteracademic"];
$arts = $_REQUEST["catfilterarts"];
$sports = $_REQUEST["catfiltersports"];
$community = $_REQUEST["catfiltercommunity"];
$stem = $_REQUEST["catfilterstem"];
$college = $_REQUEST["catfiltercollege"];
$leadership = $_REQUEST["catfilterleadership"];
$character = $_REQUEST["catfiltercharacter"];
$prevention = $_REQUEST["catfilterprevention"];
$nutrition = $_REQUEST["catfilternutrition"];
$mentoring = $_REQUEST["catfiltermentoring"];
$supportservices = $_REQUEST["catfiltersupportservices"];

// bracket around activity categories if any activity categories are checked
if ($academic=="t" || $arts=="t" || $sports=="t" || $community=="t" || $character=="t" || $leadership=="t" || $nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
	$whereactivity .= ' (';
}else{} 

if ($academic=="t") {
	$whereactivity .= " a.academic = TRUE";
	if ($arts=="t" || $sports=="t" || $community=="t" || $character=="t" || $leadership=="t" || $nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Tutoring/Academic Enrichment; ';
}else{}

if ($arts=="t") {
	$whereactivity .= " a.arts = TRUE";
	if ($sports=="t" || $community=="t" || $character=="t" || $leadership=="t" || $nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Arts and Culture; ';
}else{}

if ($sports=="t") {
	$whereactivity .= " a.sports = TRUE";
	if ($community=="t" || $character=="t" || $leadership=="t" || $nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Sports and Recreation; ';
}else{}


if ($community=="t") {
	$whereactivity .= " a.community = TRUE";
	if ($character=="t" || $leadership=="t" || $nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Volunteering/Community Service; ';
}else{}

if ($character=="t")	{
	$whereactivity .= " a.character = TRUE";
	if ($leadership=="t" || $nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Character Education; ';
}else{}

if ($leadership=="t") {
	$whereactivity .= " a.leadership = TRUE";
	if ($nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Leadership; ';
}else{}

if ($nutrition=="t") {
	$whereactivity .= " a.nutrition = TRUE";
	if ($prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Nutrition; ';
}else{}

if ($prevention=="t") {
	$whereactivity .= " a.prevention = TRUE";
	if ($mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Prevention; ';
}else{}

if ($mentoring=="t")	{
	$whereactivity .= " a.mentoring = TRUE";
	if ($supportservices=="t" || $stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Mentoring; ';
}else{}

if ($supportservices=="t") {
	$whereactivity .= " a.supportservices = TRUE";
	if ($stem=="t" || $college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Support Services (medical, dental, mental health, etc.); ';
}else{}

if ($stem=="t") {
	$whereactivity .= " a.stem = TRUE";
	if ($college=="t") {
		$whereactivity .= " OR";
	}else{}
	$categorysearch .= 'Science, Technology, Engineering, and Mathematics; ';
}else{}

if ($college=="t") {
	$whereactivity .= " a.college = TRUE";
	$categorysearch .= 'College and Career Readiness';
}else{}


// bracket around activity categories if any activity categories are checked
if ($academic=="t" || $arts=="t" || $sports=="t" || $community=="t" || $character=="t" || $leadership=="t" || $nutrition=="t" || $prevention=="t" || $mentoring=="t" || $supportservices=="t" || $stem=="t" || $college=="t") {
	$whereactivity .= ') ';
}else{} 


// age where statements
$whereages = '';
$age5_8 = $_REQUEST["agefilterage5_8"];
$age9_11 = $_REQUEST["agefilterage9_11"];
$age12_14 = $_REQUEST["agefilterage12_14"];
$age15_18 = $_REQUEST["agefilterage15_18"];


// bracket around age categories if any age categories are checked
if ($age5_8=="t" || $age9_11=="t" || $age12_14=="t" || $age15_18=="t") {
	$whereages .= ' (';
}else{} 

if ($age5_8=="t") {	
	$whereages .= " (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE)";
	if ($age9_11=="t" || $age12_14=="t" || $age15_18=="t") {
		$whereages .= " OR";
	}else{}
	$agesearch .= "5-8; ";
}else{}

if ($age9_11=="t") {	
	$whereages .= " (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE)";
	if ($age12_14=="t" || $age15_18=="t") {
		$whereages .= " OR";
	}else{}
	$agesearch .= "9-11; ";
}else{}

if ($age12_14=="t") {	
	$whereages .= " (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE)";
	if ($age15_18=="t") {
		$whereages .= " OR";
	}else{}
	$agesearch .= "12-14; ";
}else{}

if ($age15_18=="t") {	
	$whereages .= " (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE)";
	$agesearch .= "15-18";
}else{}

// bracket around age categories if any age categories are checked
if ($age5_8=="t" || $age9_11=="t" || $age12_14=="t" || $age15_18=="t") {
	$whereages .= ') ';
}else{} 


// build FULL where statement
$summeronly = $_REQUEST["summeronly"];

// WHERE statement always begins with WHERE verified = 1 and see if summer only or school year only was selected
if ($azcongresswhere!='' || $statelegwhere!='' || $elemschooldistrictwhere!='' || $unionschooldistrictwhere!='' || $citieswhere!='' || $whereactivity!='' || $whereages!='') {
	$whereverified = "WHERE verified = 1 ";
	$and0 = " AND";
	// create you searched for section
	$yousearchedfor = '<h2>Site/Location Filters Chosen</h2>';
	$yousearchedfor .= '<ul>';

	if ($summeronly=='t') {
		$whereverified .= "AND summer = TRUE ";
		$yousearchedfor .= '<li><b>Summer Sites Only</b></li>';
	}elseif ($summeronly=='f') {
		$whereverified .= "AND summer = FALSE ";
		$yousearchedfor .= '<li><b>School Year Sites Only</b></li>';
	}else{}

}else{
	$whereverified = "WHERE verified = 1 ";
	if ($summeronly=='t') {
		$whereverified .= "AND summer = TRUE ";
		$yousearchedfor = '<h2>Site/Location Filters Chosen</h2>';
		$yousearchedfor .= '<ul>';
		$yousearchedfor .= '<li><b>Summer Sites Only</b></li>';
	}elseif ($summeronly=='f') {
		$whereverified .= "AND summer = FALSE ";
		$yousearchedfor = '<h2>Site/Location Filters Chosen</h2>';
		$yousearchedfor .= '<ul>';
		$yousearchedfor .= '<li><b>School Year Sites Only</b></li>';
	}else{}
		$and0 = '';
}

// reset ands to beginning state
require('setands.php');


// set up you searched for fields
if (!$azcongresssearch) {
}else{
	$yousearchedfor .= '<li><b>Congresional Districts:</b> ' . $azcongresssearch . '</li>';
}

if (!$statelegsearch) {
}else{
	$yousearchedfor .= '<li><b>State Legislative Districts:</b> ' . $statelegsearch . '</li>';
}

if (!$elemschooldistrictsearch) {
}else{
	$yousearchedfor .= '<li><b>Elementary School Districts:</b> ' . $elemschooldistrictsearch . '</li>';
}

if (!$unionschooldistrictsearch) {
}else{
	$yousearchedfor .= '<li><b>Secondary/Union School Districts:</b> ' . $unionschooldistrictsearch . '</li>';
}

if (!$citiessearch) {
}else{
	$yousearchedfor .= '<li><b>City:</b> ' . $citiessearch . '</li>';
}

if (!$categorysearch) {
}else{
	$yousearchedfor .= '<li><b>Activities:</b> ' . $categorysearch . '</li>';
}

if (!$agesearch) {
}else{
	$yousearchedfor .= '<li><b>Ages Served:</b> ' . $agesearch . '</li>';
}

$yousearchedfor .= "</ul><br />";


?>
<body>
<h1>Public Advanced Search Results</h1>
<p><a href="publicadvancedsearchhome.php">&#60;&#60; Back to Public Advanced Search</a></p>
<?php 
echo $yousearchedfor; 

// require scripts to add tables

// sites tables
require('adminadvancedsearch_1.php');

// charge table
require('adminadvancedsearch_3.php');

// transport table
require('adminadvancedsearch_4.php');

// staffing table
require('adminadvancedsearch_5.php');

// Parent Services table
require('adminadvancedsearch_6.php');

// race and ethnicity table
require('adminadvancedsearch_7.php');

// Program Types table
require('adminadvancedsearch_8.php');

// Budget Proportion table
require('adminadvancedsearch_9.php');

// barriers table
require('adminadvancedsearch_10.php');

// staff testing table
require('adminadvancedsearch_11.php');

// staff professional development table
require('adminadvancedsearch_12.php');

// staff training table
require('adminadvancedsearch_13.php');

// evaluation table
require('adminadvancedsearch_14.php');

// Child/Teen Planned Activities and School Collaboration table
require('adminadvancedsearch_15.php');

// create footer
require('footer.php');

?>
