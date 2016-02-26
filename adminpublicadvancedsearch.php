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

// select all admin 
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




?>
<body>
<h1>Admin: Public Advanced Search Settings</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="adminadvancedsearchhome.php">&#60;&#60; Back to Advanced Search Home</a></p>
<h2>Choose Site/Location Filters for Display</h2>
<form name="searchusers" action="processadminpublicadvancedsearch.php" method="POST">
<table class="hoursTable">
	<tr>
		<td>Select Data by Congressional District</td>
		<td>ON<input type="radio" name="azcongress" value="t" <?php if ($azcongress=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="azcongress" value="f" <?php if ($azcongress=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
	<tr class="alt">
		<td>Select Data by State Legislative District</td>
		<td>ON<input type="radio" name="stateleg" value="t" <?php if ($stateleg=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="stateleg" value="f" <?php if ($stateleg=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
	<tr>
		<td>Select Data by Elementary School District</td>
		<td>ON<input type="radio" name="elemschooldistrict" value="t" <?php if ($elemschooldistrict=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="elemschooldistrict" value="f" <?php if ($elemschooldistrict=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
	<tr class="alt">
		<td>Select Data by Secondary/Union School District</td>
		<td>ON<input type="radio" name="unionschooldistrict" value="t" <?php if ($unionschooldistrict=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="unionschooldistrict" value="f" <?php if ($unionschooldistrict=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
	<tr>
		<td>Select Data by City</td>
		<td>ON<input type="radio" name="city" value="t" <?php if ($city=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="city" value="f" <?php if ($city=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
	<tr class="alt">
		<td>Select Data by Activity</td>
		<td>ON<input type="radio" name="activity" value="t" <?php if ($activity=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="activity" value="f" <?php if ($activity=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
	<tr>
		<td>Select Data by Ages Served</td>
		<td>ON<input type="radio" name="ages" value="t" <?php if ($ages=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="ages" value="f" <?php if ($ages=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
	<tr class="alt">
		<td>Select Data by School Year or Summer Sites</td>
		<td>ON<input type="radio" name="summer" value="t" <?php if ($summer=='t') { echo 'checked="checked"'; } ?>> OFF <input type="radio" name="summer" value="f" <?php if ($summer=='f') { echo 'checked="checked"'; } ?>></td>
	</tr>
</table>

<br />
<div class="clear"></div>
<h2>Choose Tables to be Displayed</h2>
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
		<td align="center"><input type="checkbox" name="summary1" value="t" <?php if ($summary1=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd1" value="t" <?php if ($cd1=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld1" value="t" <?php if ($sld1=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm1" value="t" <?php if ($elm1=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union1" value="t" <?php if ($union1=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city1" value="t" <?php if ($city1=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity1" value="t" <?php if ($activity1=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages1" value="t" <?php if ($ages1=='t') { echo 'checked="checked"'; } ?> /></td>
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
		<td align="center"><input type="checkbox" name="summary3" value="t" <?php if ($summary3=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd3" value="t" <?php if ($cd3=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld3" value="t" <?php if ($sld3=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm3" value="t" <?php if ($elm3=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union3" value="t" <?php if ($union3=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city3" value="t" <?php if ($city3=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity3" value="t" <?php if ($activity3=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages3" value="t" <?php if ($ages3=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td>Transportation, Food and Language Assistance</td>
		<td align="center"><input type="checkbox" name="summary4" value="t" <?php if ($summary4=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd4" value="t" <?php if ($cd4=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld4" value="t" <?php if ($sld4=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm4" value="t" <?php if ($elm4=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union4" value="t" <?php if ($union4=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city4" value="t" <?php if ($city4=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity4" value="t" <?php if ($activity4=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages4" value="t" <?php if ($ages4=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr class="alt">
		<td>Capacity and Staffing</td>
		<td align="center"><input type="checkbox" name="summary5" value="t" <?php if ($summary5=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd5" value="t" <?php if ($cd5=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld5" value="t" <?php if ($sld5=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm5" value="t" <?php if ($elm5=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union5" value="t" <?php if ($union5=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city5" value="t" <?php if ($city5=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity5" value="t" <?php if ($activity5=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages5" value="t" <?php if ($ages5=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td>Parent Services</td>
		<td align="center"><input type="checkbox" name="summary6" value="t" <?php if ($summary6=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd6" value="t" <?php if ($cd6=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld6" value="t" <?php if ($sld6=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm6" value="t" <?php if ($elm6=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union6" value="t" <?php if ($union6=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city6" value="t" <?php if ($city6=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity6" value="t" <?php if ($activity6=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages6" value="t" <?php if ($ages6=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr class="alt">
		<td>Race/Ethnicity Distribution</td>
		<td align="center"><input type="checkbox" name="summary7" value="t" <?php if ($summary7=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd7" value="t" <?php if ($cd7=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld7" value="t" <?php if ($sld7=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm7" value="t" <?php if ($elm7=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union7" value="t" <?php if ($union7=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city7" value="t" <?php if ($city7=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity7" value="t" <?php if ($activity7=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages7" value="t" <?php if ($ages7=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td>Program Types</td>
		<td align="center"><input type="checkbox" name="summary8" value="t" <?php if ($summary8=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd8" value="t" <?php if ($cd8=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld8" value="t" <?php if ($sld8=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm8" value="t" <?php if ($elm8=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union8" value="t" <?php if ($union8=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city8" value="t" <?php if ($city8=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity8" value="t" <?php if ($activity8=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages8" value="t" <?php if ($ages8=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr class="alt">
		<td>Budget Proportion</td>
		<td align="center"><input type="checkbox" name="summary9" value="t" <?php if ($summary9=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd9" value="t" <?php if ($cd9=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld9" value="t" <?php if ($sld9=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm9" value="t" <?php if ($elm9=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union9" value="t" <?php if ($union9=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city9" value="t" <?php if ($city9=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity9" value="t" <?php if ($activity9=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages9" value="t" <?php if ($ages9=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td>Barriers to Full Attendence</td>
		<td align="center"><input type="checkbox" name="summary10" value="t" <?php if ($summary10=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd10" value="t" <?php if ($cd10=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld10" value="t" <?php if ($sld10=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm10" value="t" <?php if ($elm10=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union10" value="t" <?php if ($union10=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city10" value="t" <?php if ($city10=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity10" value="t" <?php if ($activity10=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages10" value="t" <?php if ($ages10=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr class="alt">
		<td>New Staff Testing</td>
		<td align="center"><input type="checkbox" name="summary11" value="t" <?php if ($summary11=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd11" value="t" <?php if ($cd11=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld11" value="t" <?php if ($sld11=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm11" value="t" <?php if ($elm11=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union11" value="t" <?php if ($union11=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city11" value="t" <?php if ($city11=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity11" value="t" <?php if ($activity11=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages11" value="t" <?php if ($ages11=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td>Staff Professional Development</td>
		<td align="center"><input type="checkbox" name="summary12" value="t" <?php if ($summary12=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd12" value="t" <?php if ($cd12=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld12" value="t" <?php if ($sld12=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm12" value="t" <?php if ($elm12=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union12" value="t" <?php if ($union12=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city12" value="t" <?php if ($city12=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity12" value="t" <?php if ($activity12=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages12" value="t" <?php if ($ages12=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr class="alt">
		<td>Who Preforms Staff Training </td>
		<td align="center"><input type="checkbox" name="summary13" value="t" <?php if ($summary13=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd13" value="t" <?php if ($cd13=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld13" value="t" <?php if ($sld13=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm13" value="t" <?php if ($elm13=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union13" value="t" <?php if ($union13=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city13" value="t" <?php if ($city13=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity13" value="t" <?php if ($activity13=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages13" value="t" <?php if ($ages13=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td>Program Evaluation</td>
		<td align="center"><input type="checkbox" name="summary14" value="t" <?php if ($summary14=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd14" value="t" <?php if ($cd14=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld14" value="t" <?php if ($sld14=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm14" value="t" <?php if ($elm14=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union14" value="t" <?php if ($union14=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city14" value="t" <?php if ($city14=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity14" value="t" <?php if ($activity14=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages14" value="t" <?php if ($ages14=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr class="alt">
		<td>Child/Teen Planned Activities and School Collaboration</td>
		<td align="center"><input type="checkbox" name="summary15" value="t" <?php if ($summary15=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="cd15" value="t" <?php if ($cd15=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="sld15" value="t" <?php if ($sld15=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="elm15" value="t" <?php if ($elm15=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="union15" value="t" <?php if ($union15=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="city15" value="t" <?php if ($city15=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="activity15" value="t" <?php if ($activity15=='t') { echo 'checked="checked"'; } ?> /></td>
		<td align="center"><input type="checkbox" name="ages15" value="t" <?php if ($ages15=='t') { echo 'checked="checked"'; } ?> /></td>
	</tr>
</table>
<br />
<input type="submit" value="Save" name="action" />
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

