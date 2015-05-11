<?php
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');


// select congressional districts and create table to put in filter area
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


// select state legislative district and create table to put in filter area
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


// select elementary school district and create table to put in filter area
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


// select school district and create table to put in filter area
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


// select cites and create table to put in filter area
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



?>
<body>
<h3 class="azcase-text-color">Admin: Advanced Search</h3>
<h4 class="azcase-text-color">Choose Site/Location Filters (Optional)</h4>
<form name="searchusers" action="adminadvancedsearch.php" method="POST">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Select Data by Congressional District
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <?php echo $azcongress; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Select Data by State Legislative District
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <?php echo $stateleg; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Select Data by Elementary School District
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <?php echo $elemschooldistrict; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Select Data by Secondary/Union School District
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        <?php echo $unionschooldistrict; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Select Data by City
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
        <?php echo $cities; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSix">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          Select Data by Activity
        </a>
      </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
      <div class="panel-body">
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
    </div>
  </div>
  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingSeven">
	      <h4 class="panel-title">
	        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
	          Select Data by Ages Served
	        </a>
	      </h4>
	    </div>
	    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
	      <div class="panel-body">
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
	    </div>
	</div>
	<div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingEight">
	      <h4 class="panel-title">
	        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
	          Select Data by School Year or Summer Sites
	        </a>
	      </h4>
	    </div>
	    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
	      <div class="panel-body">
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
	    </div>
	  </div>
  </div>
</div>
<br />
<div class="clear"></div>
<h4 class="azcase-text-color">Choose Tables to be Displayed</h4>
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
		<td align="center"><input type="checkbox" name="summary1" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd1" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld1" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm1" value="t" /></td>
		<td align="center"><input type="checkbox" name="union1" value="t" /></td>
		<td align="center"><input type="checkbox" name="city1" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity1" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages1" value="t" /></td>
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
		<td align="center"><input type="checkbox" name="summary3" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd3" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld3" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm3" value="t" /></td>
		<td align="center"><input type="checkbox" name="union3" value="t" /></td>
		<td align="center"><input type="checkbox" name="city3" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity3" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages3" value="t" /></td>
	</tr>
	<tr>
		<td>Transportation, Food and Language Assistance</td>
		<td align="center"><input type="checkbox" name="summary4" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd4" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld4" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm4" value="t" /></td>
		<td align="center"><input type="checkbox" name="union4" value="t" /></td>
		<td align="center"><input type="checkbox" name="city4" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity4" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages4" value="t" /></td>
	</tr>
	<tr class="alt">
		<td>Capacity and Staffing</td>
		<td align="center"><input type="checkbox" name="summary5" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd5" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld5" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm5" value="t" /></td>
		<td align="center"><input type="checkbox" name="union5" value="t" /></td>
		<td align="center"><input type="checkbox" name="city5" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity5" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages5" value="t" /></td>
	</tr>
	<tr>
		<td>Parent Services</td>
		<td align="center"><input type="checkbox" name="summary6" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd6" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld6" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm6" value="t" /></td>
		<td align="center"><input type="checkbox" name="union6" value="t" /></td>
		<td align="center"><input type="checkbox" name="city6" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity6" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages6" value="t" /></td>
	</tr>
	<tr class="alt">
		<td>Race/Ethnicity Distribution</td>
		<td align="center"><input type="checkbox" name="summary7" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd7" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld7" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm7" value="t" /></td>
		<td align="center"><input type="checkbox" name="union7" value="t" /></td>
		<td align="center"><input type="checkbox" name="city7" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity7" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages7" value="t" /></td>
	</tr>
	<tr>
		<td>Program Types</td>
		<td align="center"><input type="checkbox" name="summary8" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd8" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld8" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm8" value="t" /></td>
		<td align="center"><input type="checkbox" name="union8" value="t" /></td>
		<td align="center"><input type="checkbox" name="city8" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity8" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages8" value="t" /></td>
	</tr>
	<tr class="alt">
		<td>Budget Proportion</td>
		<td align="center"><input type="checkbox" name="summary9" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd9" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld9" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm9" value="t" /></td>
		<td align="center"><input type="checkbox" name="union9" value="t" /></td>
		<td align="center"><input type="checkbox" name="city9" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity9" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages9" value="t" /></td>
	</tr>
	<tr>
		<td>Barriers to Full Attendence</td>
		<td align="center"><input type="checkbox" name="summary10" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd10" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld10" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm10" value="t" /></td>
		<td align="center"><input type="checkbox" name="union10" value="t" /></td>
		<td align="center"><input type="checkbox" name="city10" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity10" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages10" value="t" /></td>
	</tr>
	<tr class="alt">
		<td>New Staff Testing</td>
		<td align="center"><input type="checkbox" name="summary11" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd11" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld11" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm11" value="t" /></td>
		<td align="center"><input type="checkbox" name="union11" value="t" /></td>
		<td align="center"><input type="checkbox" name="city11" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity11" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages11" value="t" /></td>
	</tr>
	<tr>
		<td>Staff Professional Development</td>
		<td align="center"><input type="checkbox" name="summary12" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd12" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld12" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm12" value="t" /></td>
		<td align="center"><input type="checkbox" name="union12" value="t" /></td>
		<td align="center"><input type="checkbox" name="city12" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity12" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages12" value="t" /></td>
	</tr>
	<tr class="alt">
		<td>Who Preforms Staff Training </td>
		<td align="center"><input type="checkbox" name="summary13" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd13" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld13" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm13" value="t" /></td>
		<td align="center"><input type="checkbox" name="union13" value="t" /></td>
		<td align="center"><input type="checkbox" name="city13" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity13" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages13" value="t" /></td>
	</tr>
	<tr>
		<td>Program Evaluation</td>
		<td align="center"><input type="checkbox" name="summary14" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd14" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld14" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm14" value="t" /></td>
		<td align="center"><input type="checkbox" name="union14" value="t" /></td>
		<td align="center"><input type="checkbox" name="city14" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity14" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages14" value="t" /></td>
	</tr>
	<tr class="alt">
		<td>Child/Teen Planned Activities and School Collaboration</td>
		<td align="center"><input type="checkbox" name="summary15" value="t" /></td>
		<td align="center"><input type="checkbox" name="cd15" value="t" /></td>
		<td align="center"><input type="checkbox" name="sld15" value="t" /></td>
		<td align="center"><input type="checkbox" name="elm15" value="t" /></td>
		<td align="center"><input type="checkbox" name="union15" value="t" /></td>
		<td align="center"><input type="checkbox" name="city15" value="t" /></td>
		<td align="center"><input type="checkbox" name="activity15" value="t" /></td>
		<td align="center"><input type="checkbox" name="ages15" value="t" /></td>
	</tr>
</table>
<br />
<table><tr><td><input class="btn btn-default" type="submit" value="Search" name="action"></td><td><p style="visibility:hidden;" id="progress"/><img id="progress_image" style="padding-left:5px;padding-top:5px;" src="loading.gif" alt=""> Please Wait…</p></td></tr></table>
</form>
<br />
<br />

<?php


// create footer
require('footer.php');

?>

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


