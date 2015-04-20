<?php
ini_set('session.cache_limiter', 'private');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

global $connection;

// pull public settings to determine which filters and tables to show
$sitescountquery = "SELECT
 gid,
 azcongress,
 stateleg,
 elemschooldistrict,
 unionschooldistrict,
 city,
 activity,
 ages,
 summer,
 summary1,
 cd1,
 sld1,
 elm1,
 union1,
 city1,
 activity1,
 ages1,
 summary3,
 cd3,
 sld3,
 elm3,
 union3,
 city3,
 activity3,
 ages3,
 summary4,
 cd4,
 sld4,
 elm4,
 union4,
 city4,
 activity4,
 ages4,
 summary5,
 cd5,
 sld5,
 elm5,
 union5,
 city5,
 activity5,
 ages5,
 summary6,
 cd6,
 sld6,
 elm6,
 union6,
 city6,
 activity6,
 ages6,
 summary7,
 cd7,
 sld7,
 elm7,
 union7,
 city7,
 activity7,
 ages7,
 summary8,
 cd8,
 sld8,
 elm8,
 union8,
 city8,
 activity8,
 ages8,
 summary9,
 cd9,
 sld9,
 elm9,
 union9,
 city9,
 activity9,
 ages9,
 summary10,
 cd10,
 sld10,
 elm10,
 union10,
 city10,
 activity10,
 ages10,
 summary11,
 cd11,
 sld11,
 elm11,
 union11,
 city11,
 activity11,
 ages11,
 summary12,
 cd12,
 sld12,
 elm12,
 union12,
 city12,
 activity12,
 ages12,
 summary13,
 cd13,
 sld13,
 elm13,
 union13,
 city13,
 activity13,
 ages13,
 summary14,
 cd14,
 sld14,
 elm14,
 union14,
 city14,
 activity14,
 ages14,
 summary15,
 cd15,
 sld15,
 elm15,
 union15,
 city15,
 activity15,
 ages15
FROM azcase_publicadvancedsearch WHERE gid = 1;
";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$gid = pg_result($sitesresult, $lt, 0);
	$azcongress = pg_result($sitesresult, $lt, 1);
	$stateleg = pg_result($sitesresult, $lt, 2);
	$elemschooldistrict = pg_result($sitesresult, $lt, 3);
	$unionschooldistrict = pg_result($sitesresult, $lt, 4);
	$city = pg_result($sitesresult, $lt, 5);
	$activity = pg_result($sitesresult, $lt, 6);
	$ages = pg_result($sitesresult, $lt, 7);
	$summer = pg_result($sitesresult, $lt, 8);
	$summary1 = pg_result($sitesresult, $lt, 9);
	$cd1 = pg_result($sitesresult, $lt, 10);
	$sld1 = pg_result($sitesresult, $lt, 11);
	$elm1 = pg_result($sitesresult, $lt, 12);
	$union1 = pg_result($sitesresult, $lt, 13);
	$city1 = pg_result($sitesresult, $lt, 14);
	$activity1 = pg_result($sitesresult, $lt, 15);
	$ages1 = pg_result($sitesresult, $lt, 16);
	$summary3 = pg_result($sitesresult, $lt, 17);
	$cd3 = pg_result($sitesresult, $lt, 18);
	$sld3 = pg_result($sitesresult, $lt, 19);
	$elm3 = pg_result($sitesresult, $lt, 20);
	$union3 = pg_result($sitesresult, $lt, 21);
	$city3 = pg_result($sitesresult, $lt, 22);
	$activity3 = pg_result($sitesresult, $lt, 23);
	$ages3 = pg_result($sitesresult, $lt, 24);
	$summary4 = pg_result($sitesresult, $lt, 25);
	$cd4 = pg_result($sitesresult, $lt, 26);
	$sld4 = pg_result($sitesresult, $lt, 27);
	$elm4 = pg_result($sitesresult, $lt, 28);
	$union4 = pg_result($sitesresult, $lt, 29);
	$city4 = pg_result($sitesresult, $lt, 30);
	$activity4 = pg_result($sitesresult, $lt, 31);
	$ages4 = pg_result($sitesresult, $lt, 32);
	$summary5 = pg_result($sitesresult, $lt, 33);
	$cd5 = pg_result($sitesresult, $lt, 34);
	$sld5 = pg_result($sitesresult, $lt, 35);
	$elm5 = pg_result($sitesresult, $lt, 36);
	$union5 = pg_result($sitesresult, $lt, 37);
	$city5 = pg_result($sitesresult, $lt, 38);
	$activity5 = pg_result($sitesresult, $lt, 39);
	$ages5 = pg_result($sitesresult, $lt, 40);
	$summary6 = pg_result($sitesresult, $lt, 41);
	$cd6 = pg_result($sitesresult, $lt, 42);
	$sld6 = pg_result($sitesresult, $lt, 43);
	$elm6 = pg_result($sitesresult, $lt, 44);
	$union6 = pg_result($sitesresult, $lt, 45);
	$city6 = pg_result($sitesresult, $lt, 46);
	$activity6 = pg_result($sitesresult, $lt, 47);
	$ages6 = pg_result($sitesresult, $lt, 48);
	$summary7 = pg_result($sitesresult, $lt, 49);
	$cd7 = pg_result($sitesresult, $lt, 50);
	$sld7 = pg_result($sitesresult, $lt, 51);
	$elm7 = pg_result($sitesresult, $lt, 52);
	$union7 = pg_result($sitesresult, $lt, 53);
	$city7 = pg_result($sitesresult, $lt, 54);
	$activity7 = pg_result($sitesresult, $lt, 55);
	$ages7 = pg_result($sitesresult, $lt, 56);
	$summary8 = pg_result($sitesresult, $lt, 57);
	$cd8 = pg_result($sitesresult, $lt, 58);
	$sld8 = pg_result($sitesresult, $lt, 59);
	$elm8 = pg_result($sitesresult, $lt, 60);
	$union8 = pg_result($sitesresult, $lt, 61);
	$city8 = pg_result($sitesresult, $lt, 62);
	$activity8 = pg_result($sitesresult, $lt, 63);
	$ages8 = pg_result($sitesresult, $lt, 64);
	$summary9 = pg_result($sitesresult, $lt, 65);
	$cd9 = pg_result($sitesresult, $lt, 66);
	$sld9 = pg_result($sitesresult, $lt, 67);
	$elm9 = pg_result($sitesresult, $lt, 68);
	$union9 = pg_result($sitesresult, $lt, 69);
	$city9 = pg_result($sitesresult, $lt, 70);
	$activity9 = pg_result($sitesresult, $lt, 71);
	$ages9 = pg_result($sitesresult, $lt, 72);
	$summary10 = pg_result($sitesresult, $lt, 73);
	$cd10 = pg_result($sitesresult, $lt, 74);
	$sld10 = pg_result($sitesresult, $lt, 75);
	$elm10 = pg_result($sitesresult, $lt, 76);
	$union10 = pg_result($sitesresult, $lt, 77);
	$city10 = pg_result($sitesresult, $lt, 78);
	$activity10 = pg_result($sitesresult, $lt, 79);
	$ages10 = pg_result($sitesresult, $lt, 80);
	$summary11 = pg_result($sitesresult, $lt, 81);
	$cd11 = pg_result($sitesresult, $lt, 82);
	$sld11 = pg_result($sitesresult, $lt, 83);
	$elm11 = pg_result($sitesresult, $lt, 84);
	$union11 = pg_result($sitesresult, $lt, 85);
	$city11 = pg_result($sitesresult, $lt, 86);
	$activity11 = pg_result($sitesresult, $lt, 87);
	$ages11 = pg_result($sitesresult, $lt, 88);
	$summary12 = pg_result($sitesresult, $lt, 89);
	$cd12 = pg_result($sitesresult, $lt, 90);
	$sld12 = pg_result($sitesresult, $lt, 91);
	$elm12 = pg_result($sitesresult, $lt, 92);
	$union12 = pg_result($sitesresult, $lt, 93);
	$city12 = pg_result($sitesresult, $lt, 94);
	$activity12 = pg_result($sitesresult, $lt, 95);
	$ages12 = pg_result($sitesresult, $lt, 96);
	$summary13 = pg_result($sitesresult, $lt, 97);
	$cd13 = pg_result($sitesresult, $lt, 98);
	$sld13 = pg_result($sitesresult, $lt, 99);
	$elm13 = pg_result($sitesresult, $lt, 100);
	$union13 = pg_result($sitesresult, $lt, 101);
	$city13 = pg_result($sitesresult, $lt, 102);
	$activity13 = pg_result($sitesresult, $lt, 103);
	$ages13 = pg_result($sitesresult, $lt, 104);
	$summary14 = pg_result($sitesresult, $lt, 105);
	$cd14 = pg_result($sitesresult, $lt, 106);
	$sld14 = pg_result($sitesresult, $lt, 107);
	$elm14 = pg_result($sitesresult, $lt, 108);
	$union14 = pg_result($sitesresult, $lt, 109);
	$city14 = pg_result($sitesresult, $lt, 110);
	$activity14 = pg_result($sitesresult, $lt, 111);
	$ages14 = pg_result($sitesresult, $lt, 112);
	$summary15 = pg_result($sitesresult, $lt, 113);
	$cd15 = pg_result($sitesresult, $lt, 114);
	$sld15 = pg_result($sitesresult, $lt, 115);
	$elm15 = pg_result($sitesresult, $lt, 116);
	$union15 = pg_result($sitesresult, $lt, 117);
	$city15 = pg_result($sitesresult, $lt, 118);
	$activity15 = pg_result($sitesresult, $lt, 119);
	$ages15 = pg_result($sitesresult, $lt, 120);
}



// select congressional districts and create table to put in filter area
if ($azcongress=='t') {
$azcongress = "<table cellpadding=\"0\"><tr><td align=\"right\"><input type=\"checkbox\" name=\"azcongressfilter\" value=\"t\" onClick=\"azcongressfilterGroup.check(this)\"></td><td align=\"left\" width=\"200\">Check/Uncheck All</td>";

$azcongressquery = "SELECT gid FROM az_congress ORDER BY gid;";
$azcongressresult = pg_query($connection, $azcongressquery);
for ($lt = 0; $lt < pg_numrows($azcongressresult); $lt++) {
	$gid = pg_result($azcongressresult, $lt, 0);

	if ($lt==0) {
		$tropen = '<tr>';
		$trclose = '';
	}elseif ($lt%4==0 && $lt+1==pg_numrows($azcongressresult)) {
		$tropen = '</tr><tr>';
		$trclose = '</tr>';
	}elseif ($lt+1==pg_numrows($azcongressresult)) {
		$tropen = '';
		$trclose = '</tr>';
	}elseif ($lt%4==0) {
		$tropen = '</tr><tr>';
		$trclose = '';
	}else {
		$tropen = '';
		$trclose = '';
	}

	$azcongress .= "$tropen<td align=\"right\"><input type=\"checkbox\" name=\"azcongressfilter$gid\" value=\"t\" onClick=\"azcongressfilterGroup.check(this)\"></td><td align=\"left\" width=\"350\">Congressional District $gid</td>$trclose";

}

// close azcongress
$azcongress .= "</table>";
}else{}


// select state legislative district and create table to put in filter area
if ($stateleg=='t') {
$stateleg = "<table cellpadding=\"0\"><tr><td align=\"right\"><input type=\"checkbox\" name=\"statelegfilter\" value=\"t\" onClick=\"statelegfilterGroup.check(this)\"></td><td align=\"left\" width=\"120\">Check/Uncheck All</td></tr>";

$statelegquery = "SELECT gid FROM az_legisl ORDER BY gid;";
$statelegresult = pg_query($connection, $statelegquery);
for ($lt = 0; $lt < pg_numrows($statelegresult); $lt++) {
	$gid = pg_result($statelegresult, $lt, 0);

	if ($lt==0) {
		$tropen = '<tr>';
		$trclose = '';
	}elseif ($lt%4==0 && $lt+1==pg_numrows($statelegresult)) {
		$tropen = '</tr><tr>';
		$trclose = '</tr>';
	}elseif ($lt+1==pg_numrows($statelegresult)) {
		$tropen = '';
		$trclose = '</tr>';
	}elseif ($lt%4==0) {
		$tropen = '</tr><tr>';
		$trclose = '';
	}else {
		$tropen = '';
		$trclose = '';
	}


	$stateleg .= "$tropen<td align=\"right\"><input type=\"checkbox\" name=\"statelegfilter$gid\" value=\"t\" onClick=\"statelegfilterGroup.check(this)\"></td><td align=\"left\" width=\"350\">State Legislative District $gid</td>$trclose";

}

// close stateleg
$stateleg .= "</table>";
}else{}


// select elementary school district and create table to put in filter area
if ($elemschooldistrict=='t') {
$elemschooldistrict = "<table cellpadding=\"0\"><tr><td align=\"right\"><input type=\"checkbox\" name=\"elemschooldistrictfilter\" value=\"t\" onClick=\"elemschooldistrictfilterGroup.check(this)\"></td><td align=\"left\" width=\"120\">Check/Uncheck All</td></tr>";

$elemschooldistrictquery = "SELECT gid, name10 FROM az_elm_districts ORDER BY name10;";
$elemschooldistrictresult = pg_query($connection, $elemschooldistrictquery);
for ($lt = 0; $lt < pg_numrows($elemschooldistrictresult); $lt++) {
	$gid = pg_result($elemschooldistrictresult, $lt, 0);
	$name = pg_result($elemschooldistrictresult, $lt, 1);

	if ($lt==0) {
		$tropen = '<tr>';
		$trclose = '';
	}elseif ($lt%4==0 && $lt+1==pg_numrows($elemschooldistrictresult)) {
		$tropen = '</tr><tr>';
		$trclose = '</tr>';
	}elseif ($lt+1==pg_numrows($elemschooldistrictresult)) {
		$tropen = '';
		$trclose = '</tr>';
	}elseif ($lt%4==0) {
		$tropen = '</tr><tr>';
		$trclose = '';
	}else {
		$tropen = '';
		$trclose = '';
	}


	$elemschooldistrict .= "$tropen<td align=\"right\"><input type=\"checkbox\" name=\"elemschooldistrictfilter$gid\" value=\"t\" onClick=\"elemschooldistrictfilterGroup.check(this)\"></td><td align=\"left\" width=\"350\">$name</td>$trclose";

}

// close elemschooldistrict
$elemschooldistrict .= "</table>";
}else{}


// select school district and create table to put in filter area
if ($unionschooldistrict=='t') {
$unionschooldistrict = "<table cellpadding=\"0\"><tr><td align=\"right\"><input type=\"checkbox\" name=\"unionschooldistrictfilter\" value=\"t\" onClick=\"unionschooldistrictfilterGroup.check(this)\"></td><td align=\"left\" width=\"120\">Check/Uncheck All</td></tr></table><table cellpadding=\"0\">";

$unionschooldistrictquery = "SELECT gid, name10 FROM az_union_second_school_distcts ORDER BY name10;";
$unionschooldistrictresult = pg_query($connection, $unionschooldistrictquery);
for ($lt = 0; $lt < pg_numrows($unionschooldistrictresult); $lt++) {
	$gid = pg_result($unionschooldistrictresult, $lt, 0);
	$name = pg_result($unionschooldistrictresult, $lt, 1);	

	if ($lt==0) {
		$tropen = '<tr>';
		$trclose = '';
	}elseif ($lt%4==0 && $lt+1==pg_numrows($unionschooldistrictresult)) {
		$tropen = '</tr><tr>';
		$trclose = '</tr>';
	}elseif ($lt+1==pg_numrows($unionschooldistrictresult)) {
		$tropen = '';
		$trclose = '</tr>';
	}elseif ($lt%4==0) {
		$tropen = '</tr><tr>';
		$trclose = '';
	}else {
		$tropen = '';
		$trclose = '';
	}


	$unionschooldistrict .= "$tropen<td align=\"right\"><input type=\"checkbox\" name=\"unionschooldistrictfilter$gid\" value=\"t\" onClick=\"unionschooldistrictfilterGroup.check(this)\"></td><td align=\"left\" width=\"350\">$name</td>$trclose";

}

// close unionschooldistrict
$unionschooldistrict .= "</table>";
}else{}


// select cites and create table to put in filter area
if ($city=='t') {
$cities = "<table cellpadding=\"0\"><tr><td align=\"right\"><input type=\"checkbox\" name=\"citiesfilter\" value=\"t\" onClick=\"citiesfilterGroup.check(this)\"></td><td align=\"left\" width=\"120\">Check/Uncheck All</td></tr>";

$citiesquery = "SELECT gid, name10 FROM az_cities ORDER BY name10;";
$citiesresult = pg_query($connection, $citiesquery);
for ($lt = 0; $lt < pg_numrows($citiesresult); $lt++) {
	$gid = pg_result($citiesresult, $lt, 0);
	$name = pg_result($citiesresult, $lt, 1);

	if ($lt==0) {
		$tropen = '<tr>';
		$trclose = '';
	}elseif ($lt%4==0 && $lt+1==pg_numrows($citiesresult)) {
		$tropen = '</tr><tr>';
		$trclose = '</tr>';
	}elseif ($lt+1==pg_numrows($citiesresult)) {
		$tropen = '';
		$trclose = '</tr>';
	}elseif ($lt%4==0) {
		$tropen = '</tr><tr>';
		$trclose = '';
	}else {
		$tropen = '';
		$trclose = '';
	}

	$cities .= "$tropen<td align=\"right\"><input type=\"checkbox\" name=\"citiesfilter$gid\" value=\"t\" onClick=\"citiesfilterGroup.check(this)\"></td><td align=\"left\" width=\"350\">$name</td>$trclose";

}

// close cities
$cities .= "</table>";
}else{}



?>
<body>
<h3>Public Advanced Search: AZ Afterschool Program Directory</h3>
<h4>Choose Site/Location Filters (Optional)</h4>
<form name="searchusers" action="publicadvancedsearch.php" method="POST">
<div class="boxes">
<?php if ($azcongress=='f') {}else{ ?>
	<h4 class="heading">Select Data by Congressional District</h4>
		<div class="panel"><?php echo $azcongress; ?></div>
<?php } 
if ($stateleg=='f') {}else{ ?>
	<h4 class="heading">Select Data by State Legislative District</h4>
		<div class="panel"><?php echo $stateleg; ?></div>
<?php } 
if ($elemschooldistrict=='f') {}else{ ?>
	<h4 class="heading">Select Data by Elementary School District</h4>
		<div class="panel"><?php echo $elemschooldistrict; ?></div>
<?php } 
if ($unionschooldistrict=='f') {}else{ ?>
	<h4 class="heading">Select Data by Secondary/Union School District</h4>
		<div class="panel"><?php echo $unionschooldistrict; ?></div>
<?php } 
if ($city=='f') {}else{ ?>
	<h4 class="heading">Select Data by City</h4>
		<div class="panel"><?php echo $cities; ?></div>
<?php } 
if ($activity=='f') {}else{ ?>
	<h4 class="heading">Select Data by Activity</h4>
		<div class="panel">
			<table cellpadding="0">
				<tr>
					<td align="right"><input type="checkbox" name="catfilter" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Check/Uncheck All</td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="catfilteracademic" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Tutoring/Academic Enrichment</td>
					<td align="right"><input type="checkbox" name="catfilterarts" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Arts and Culture</td>
					<td align="right"><input type="checkbox" name="catfiltersports" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Sports and Recreation</td>
					<td align="right"><input type="checkbox" name="catfiltercommunity" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Volunteering/Community Service</td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="catfilterstem" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Science, Technology, Engineering, and Mathematics</td>
					<td align="right"><input type="checkbox" name="catfiltercollege" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">College and Career Readiness</td>
					<td align="right"><input type="checkbox" name="catfilterleadership" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Leadership</td>
					<td align="right"><input type="checkbox" name="catfiltercharacter" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Character Education</td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="catfilterprevention" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Prevention</td>
					<td align="right"><input type="checkbox" name="catfilternutrition" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Nutrition</td>
					<td align="right"><input type="checkbox" name="catfiltermentoring" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Mentoring</td>
					<td align="right"><input type="checkbox" name="catfiltersupportservices" value="t" onClick="catfilterGroup.check(this)"> </td>
					<td align="left" width="350">Support Services (medical, dental, mental health, etc.)</td>
				</tr>
			</table>

		</div>
<?php } 
if ($ages=='f') {}else{ ?>
	<h4 class="heading">Select Data by Ages Served</h4>
		<div class="panel">
			<table cellpadding="0">
				<tr>
					<td align="right"><input type="checkbox" name="agefilter" value="t" onClick="agefilterGroup.check(this)"> </td>
					<td align="left" width="350">Check/Uncheck All</td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="agefilterage5_8" value="t" onClick="agefilterGroup.check(this)"> </td>
					<td align="left" width="350">5 - 8</td>
					<td align="right"><input type="checkbox" name="agefilterage9_11" value="t" onClick="agefilterGroup.check(this)"> </td>
					<td align="left" width="350">9 - 11</td>
					<td align="right"><input type="checkbox" name="agefilterage12_14" value="t" onClick="agefilterGroup.check(this)"> </td>
					<td align="left" width="350">12 - 14</td>
					<td align="right"><input type="checkbox" name="agefilterage15_18" value="t" onClick="agefilterGroup.check(this)"> </td>
					<td align="left" width="350">15 - 18</td>
				</tr>
			</table>

		</div>
<?php } 
if ($summer=='f') {}else{ ?>
	<h4 class="heading">Select Data by School Year or Summer Sites</h4>
		<div class="panel">
			<table cellpadding="0">
				<tr>
					<td align="right"><input type="radio" name="summeronly" value="f"> </td>
					<td align="left" width="350">School Year Sites Only</td>
					<td align="right"><input type="radio" name="summeronly" value="t"> </td>
					<td align="left" width="350">Summer Sites Only</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>

		</div>
<?php } ?>


</div>
<br />
<div class="clear"></div>
<h4>Choose Tables to be Displayed</h4>
<table class="hoursTable">
	<tr>
		<th>Tables/Group By</th>
		<th>Summary Table</th>
		<th>By Congressional District</th>
		<th>By State Legislative District</th>
		<th>By Elementary School District</th>
		<th>By Secondary/Union School District</th>
		<th>By City</th>
		<th>By Activity</th>
		<th>By Ages Served</th>
	</tr>
	<tr>
		<td>Sites, Activities and Ages Served</td>
<?php if ($summary1=='t') { ?>
		<td align="center"><input type="checkbox" name="summary1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd1=='t') { ?>
		<td align="center"><input type="checkbox" name="cd1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld1=='t') { ?>
		<td align="center"><input type="checkbox" name="sld1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm1=='t') { ?>
		<td align="center"><input type="checkbox" name="elm1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union1=='t') { ?>
		<td align="center"><input type="checkbox" name="union1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city1=='t') { ?>
		<td align="center"><input type="checkbox" name="city1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity1=='t') { ?>
		<td align="center"><input type="checkbox" name="activity1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages1=='t') { ?>
		<td align="center"><input type="checkbox" name="ages1" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<!--<tr>
		<td>Locations</td>
		<td align="center"><input type="checkbox" name="summary2" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd2" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld2" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm2" value="t" /></td>
		<td align="center"><input type="checkbox" name="union2" value="t" /></td>
		<td align="center"><input type="checkbox" name="city2" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity2" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages2" value="t" /></td>
	</tr>-->
	<tr class="alt">
		<td>Charges, Costs and Finacial Assistance</td>
<?php if ($summary3=='t') { ?>
		<td align="center"><input type="checkbox" name="summary3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd3=='t') { ?>
		<td align="center"><input type="checkbox" name="cd3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld3=='t') { ?>
		<td align="center"><input type="checkbox" name="sld3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm3=='t') { ?>
		<td align="center"><input type="checkbox" name="elm3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union3=='t') { ?>
		<td align="center"><input type="checkbox" name="union3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city3=='t') { ?>
		<td align="center"><input type="checkbox" name="city3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity3=='t') { ?>
		<td align="center"><input type="checkbox" name="activity3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages3=='t') { ?>
		<td align="center"><input type="checkbox" name="ages3" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr>
		<td>Transportation, Food and Language Assistance</td>
<?php if ($summary4=='t') { ?>
		<td align="center"><input type="checkbox" name="summary4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd4=='t') { ?>
		<td align="center"><input type="checkbox" name="cd4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld4=='t') { ?>
		<td align="center"><input type="checkbox" name="sld4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm4=='t') { ?>
		<td align="center"><input type="checkbox" name="elm4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union4=='t') { ?>
		<td align="center"><input type="checkbox" name="union4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city4=='t') { ?>
		<td align="center"><input type="checkbox" name="city4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity4=='t') { ?>
		<td align="center"><input type="checkbox" name="activity4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages4=='t') { ?>
		<td align="center"><input type="checkbox" name="ages4" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr class="alt">
		<td>Capacity and Staffing</td>
<?php if ($summary5=='t') { ?>
		<td align="center"><input type="checkbox" name="summary5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd5=='t') { ?>
		<td align="center"><input type="checkbox" name="cd5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld5=='t') { ?>
		<td align="center"><input type="checkbox" name="sld5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm5=='t') { ?>
		<td align="center"><input type="checkbox" name="elm5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union5=='t') { ?>
		<td align="center"><input type="checkbox" name="union5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city5=='t') { ?>
		<td align="center"><input type="checkbox" name="city5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity5=='t') { ?>
		<td align="center"><input type="checkbox" name="activity5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages5=='t') { ?>
		<td align="center"><input type="checkbox" name="ages5" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr>
		<td>Parent Services</td>
<?php if ($summary6=='t') { ?>
		<td align="center"><input type="checkbox" name="summary6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd6=='t') { ?>
		<td align="center"><input type="checkbox" name="cd6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld6=='t') { ?>
		<td align="center"><input type="checkbox" name="sld6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm6=='t') { ?>
		<td align="center"><input type="checkbox" name="elm6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union6=='t') { ?>
		<td align="center"><input type="checkbox" name="union6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city6=='t') { ?>
		<td align="center"><input type="checkbox" name="city6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity6=='t') { ?>
		<td align="center"><input type="checkbox" name="activity6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages6=='t') { ?>
		<td align="center"><input type="checkbox" name="ages6" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr class="alt">
		<td>Race/Ethnicity Distribution</td>
<?php if ($summary7=='t') { ?>
		<td align="center"><input type="checkbox" name="summary7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd7=='t') { ?>
		<td align="center"><input type="checkbox" name="cd7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld7=='t') { ?>
		<td align="center"><input type="checkbox" name="sld7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm7=='t') { ?>
		<td align="center"><input type="checkbox" name="elm7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union7=='t') { ?>
		<td align="center"><input type="checkbox" name="union7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city7=='t') { ?>
		<td align="center"><input type="checkbox" name="city7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity7=='t') { ?>
		<td align="center"><input type="checkbox" name="activity7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages7=='t') { ?>
		<td align="center"><input type="checkbox" name="ages7" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr>
		<td>Program Types</td>
<?php if ($summary8=='t') { ?>
		<td align="center"><input type="checkbox" name="summary8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd8=='t') { ?>
		<td align="center"><input type="checkbox" name="cd8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld8=='t') { ?>
		<td align="center"><input type="checkbox" name="sld8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm8=='t') { ?>
		<td align="center"><input type="checkbox" name="elm8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union8=='t') { ?>
		<td align="center"><input type="checkbox" name="union8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city8=='t') { ?>
		<td align="center"><input type="checkbox" name="city8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity8=='t') { ?>
		<td align="center"><input type="checkbox" name="activity8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages8=='t') { ?>
		<td align="center"><input type="checkbox" name="ages8" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr class="alt">
		<td>Budget Proportion</td>
<?php if ($summary9=='t') { ?>
		<td align="center"><input type="checkbox" name="summary9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd9=='t') { ?>
		<td align="center"><input type="checkbox" name="cd9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld9=='t') { ?>
		<td align="center"><input type="checkbox" name="sld9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm9=='t') { ?>
		<td align="center"><input type="checkbox" name="elm9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union9=='t') { ?>
		<td align="center"><input type="checkbox" name="union9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city9=='t') { ?>
		<td align="center"><input type="checkbox" name="city9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity9=='t') { ?>
		<td align="center"><input type="checkbox" name="activity9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages9=='t') { ?>
		<td align="center"><input type="checkbox" name="ages9" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr>
		<td>Barriers to Full Attendence</td>
<?php if ($summary10=='t') { ?>
		<td align="center"><input type="checkbox" name="summary10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd10=='t') { ?>
		<td align="center"><input type="checkbox" name="cd10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld10=='t') { ?>
		<td align="center"><input type="checkbox" name="sld10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm10=='t') { ?>
		<td align="center"><input type="checkbox" name="elm10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union10=='t') { ?>
		<td align="center"><input type="checkbox" name="union10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city10=='t') { ?>
		<td align="center"><input type="checkbox" name="city10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity10=='t') { ?>
		<td align="center"><input type="checkbox" name="activity10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages10=='t') { ?>
		<td align="center"><input type="checkbox" name="ages10" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr class="alt">
		<td>New Staff Testing</td>
<?php if ($summary11=='t') { ?>
		<td align="center"><input type="checkbox" name="summary11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd11=='t') { ?>
		<td align="center"><input type="checkbox" name="cd11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld11=='t') { ?>
		<td align="center"><input type="checkbox" name="sld11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm11=='t') { ?>
		<td align="center"><input type="checkbox" name="elm11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union11=='t') { ?>
		<td align="center"><input type="checkbox" name="union11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city11=='t') { ?>
		<td align="center"><input type="checkbox" name="city11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity11=='t') { ?>
		<td align="center"><input type="checkbox" name="activity11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages11=='t') { ?>
		<td align="center"><input type="checkbox" name="ages11" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr>
		<td>Staff Professional Development</td>
<?php if ($summary12=='t') { ?>
		<td align="center"><input type="checkbox" name="summary12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd12=='t') { ?>
		<td align="center"><input type="checkbox" name="cd12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld12=='t') { ?>
		<td align="center"><input type="checkbox" name="sld12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm12=='t') { ?>
		<td align="center"><input type="checkbox" name="elm12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union12=='t') { ?>
		<td align="center"><input type="checkbox" name="union12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city12=='t') { ?>
		<td align="center"><input type="checkbox" name="city12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity12=='t') { ?>
		<td align="center"><input type="checkbox" name="activity12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages12=='t') { ?>
		<td align="center"><input type="checkbox" name="ages12" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr class="alt">
		<td>Who Preforms Staff Training </td>
<?php if ($summary13=='t') { ?>
		<td align="center"><input type="checkbox" name="summary13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd13=='t') { ?>
		<td align="center"><input type="checkbox" name="cd13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld13=='t') { ?>
		<td align="center"><input type="checkbox" name="sld13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm13=='t') { ?>
		<td align="center"><input type="checkbox" name="elm13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union13=='t') { ?>
		<td align="center"><input type="checkbox" name="union13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city13=='t') { ?>
		<td align="center"><input type="checkbox" name="city13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity13=='t') { ?>
		<td align="center"><input type="checkbox" name="activity13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages13=='t') { ?>
		<td align="center"><input type="checkbox" name="ages13" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr>
		<td>Program Evaluation</td>
<?php if ($summary14=='t') { ?>
		<td align="center"><input type="checkbox" name="summary14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd14=='t') { ?>
		<td align="center"><input type="checkbox" name="cd14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld14=='t') { ?>
		<td align="center"><input type="checkbox" name="sld14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm14=='t') { ?>
		<td align="center"><input type="checkbox" name="elm14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union14=='t') { ?>
		<td align="center"><input type="checkbox" name="union14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city14=='t') { ?>
		<td align="center"><input type="checkbox" name="city14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity14=='t') { ?>
		<td align="center"><input type="checkbox" name="activity14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages14=='t') { ?>
		<td align="center"><input type="checkbox" name="ages14" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
	<tr class="alt">
		<td>Child/Teen Planned Activities and School Collaboration</td>
<?php if ($summary15=='t') { ?>
		<td align="center"><input type="checkbox" name="summary15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($cd15=='t') { ?>
		<td align="center"><input type="checkbox" name="cd15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($sld15=='t') { ?>
		<td align="center"><input type="checkbox" name="sld15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($elm15=='t') { ?>
		<td align="center"><input type="checkbox" name="elm15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($union15=='t') { ?>
		<td align="center"><input type="checkbox" name="union15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($city15=='t') { ?>
		<td align="center"><input type="checkbox" name="city15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($activity15=='t') { ?>
		<td align="center"><input type="checkbox" name="activity15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php }
if ($ages15=='t') { ?>
		<td align="center"><input type="checkbox" name="ages15" value="t" /></td>
<?php }else{ ?>
		<td align="center">N/A</td>
<?php } ?>
	</tr>
</table>
<br />
<table><tr><td><input type="image" value="Search" name="action" alt="Search" src="search.jpg" onclick="return loadSubmit()"></td><td><p style="visibility:hidden;" id="progress"/><img id="progress_image" style="padding-left:5px;padding-top:5px;" src="loading.gif" alt=""> Please Wait…</p></td></tr></table>
</form>
<br />
<br />

<?php

// create footer
require('footer.php');

?>

<script type="text/javascript">
$(document).ready(function(){

	$('.panel').hide();

	$('.heading').collapser({
		target: 'next',
		effect: 'slide',
		changeText: 0,
		expandClass: 'expIco',
		collapseClass: 'collIco'
	}, function(){
		$('.panel').slideUp();
	});

});

</script>

<!--****Check all boxes****-->
<script src="js/CheckBoxGroup.js" type="text/javascript"></script>
<script type="text/javascript">
	var azcongressfilterGroup = new CheckBoxGroup();
	azcongressfilterGroup.addToGroup("azcongressfilter*");
	azcongressfilterGroup.setControlBox("azcongressfilter");
	azcongressfilterGroup.setMasterBehavior("all");
	var statelegfilterGroup = new CheckBoxGroup();
	statelegfilterGroup.addToGroup("statelegfilter*");
	statelegfilterGroup.setControlBox("statelegfilter");
	statelegfilterGroup.setMasterBehavior("all");
	var elemschooldistrictfilterGroup = new CheckBoxGroup();
	elemschooldistrictfilterGroup.addToGroup("elemschooldistrictfilter*");
	elemschooldistrictfilterGroup.setControlBox("elemschooldistrictfilter");
	elemschooldistrictfilterGroup.setMasterBehavior("all");
	var unionschooldistrictfilterGroup = new CheckBoxGroup();
	unionschooldistrictfilterGroup.addToGroup("unionschooldistrictfilter*");
	unionschooldistrictfilterGroup.setControlBox("unionschooldistrictfilter");
	unionschooldistrictfilterGroup.setMasterBehavior("all");
	var citiesfilterGroup = new CheckBoxGroup();
	citiesfilterGroup.addToGroup("citiesfilter*");
	citiesfilterGroup.setControlBox("citiesfilter");
	citiesfilterGroup.setMasterBehavior("all");
	var catfilterGroup = new CheckBoxGroup();
	catfilterGroup.addToGroup("catfilter*");
	catfilterGroup.setControlBox("catfilter");
	catfilterGroup.setMasterBehavior("all");
	var agefilterGroup = new CheckBoxGroup();
	agefilterGroup.addToGroup("agefilter*");
	agefilterGroup.setControlBox("agefilter");
	agefilterGroup.setMasterBehavior("all");

</script>


