<?php
// test sum number of school year sites for dashboard metric
$countsysitesquery = "SELECT count(*) FROM azcase_sites WHERE verified = 1 AND summer = FALSE;";
$countsysitesresult = pg_query($connection, $countsysitesquery);
$countsysites = pg_result($countsysitesresult, 0, 0);

if ($countsysites>0) {
	$countsysites = number_format($countsysites);
	$countsysitesdiv = "<div class=\"m\"><div class=\"mlabel\">Number of School-Year Sites:</div><div class=\"mnumber\">$countsysites</div></div>";
}else{}

// sum number of summer sites for dashboard metric
$countsumsitesquery = "SELECT count(*) FROM azcase_sites WHERE verified = 1 AND summer = TRUE;";
$countsumsitesresult = pg_query($connection, $countsumsitesquery);
$countsumsites = pg_result($countsumsitesresult, 0, 0);

if ($countsumsites>0) {
	$countsumsites = number_format($countsumsites);
	$countsumsitesdiv = "<div class=\"m\"><div class=\"mlabel\">Number of Summer Sites:</div><div class=\"mnumber\">$countsumsites</div></div>";
}else{}


// sum number of children served during the school year for dashboard metric
$countsyservedquery = "SELECT sum(served) FROM azcase_site_survey WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE verified = 1 AND summer = FALSE);";
$countsyservedresult = pg_query($connection, $countsyservedquery);
$countsyserved = pg_result($countsyservedresult, 0, 0);

if ($countsyserved>0) {
	$countsyserved = number_format($countsyserved);
	$countsyserveddiv = "<div class=\"m\"><div class=\"mlabel\">Number of Children Served (School-Year):</div><div class=\"mnumber\">$countsyserved</div></div>";
}else{}

// sum number of children served during the summer for dashboard metric
$countsumservedquery = "SELECT sum(served) FROM azcase_site_survey WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE verified = 1 AND summer = TRUE);";
$countsumservedresult = pg_query($connection, $countsumservedquery);
$countsumserved = pg_result($countsumservedresult, 0, 0);

if ($countsumserved>0) {
	$countsumserved = number_format($countsumserved);
	$countsumserveddiv = "<div class=\"m\"><div class=\"mlabel\">Number of Children Served (Summer):</div><div class=\"mnumber\">$countsumserved</div></div>";
}else{}


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
FROM azcase_sites WHERE verified = 1;";
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
FROM azcase_sites WHERE verified = 1;";
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

$agediv = "<p><b>Distribution of Ages Served Across All Sites</b></p><div id=\"AgeChart\"></div>";

} // close if sites exist


// pull data and create JS for monitary assistance
// set initial values to zero
$chargecount = 0;
$feeassistancecount = 0;
$desassistancecount = 0;
$scholarshipcount = 0;
$mcdiscountcount = 0;
$otherassistancecount = 0;
$transportationcount = 0;
$snackscount = 0;
$breakfastcount = 0;
$lunchcount = 0;
$dinnercount = 0;

$sitefeequery = "SELECT 
charge,
feeassistance,
desassistance,
scholarship,
mcdiscount,
otherassistance,
transportation,
snacks,
breakfast,
lunch,
dinner
FROM azcase_sites WHERE verified = 1;";
$sitefeeresult = pg_query($connection, $sitefeequery);

// if no locations exist in the search radius, then don't attempt to create the map 
if (pg_numrows($sitefeeresult)==0) {
}else{

for ($lt = 0; $lt < pg_numrows($sitefeeresult); $lt++) {
	$charge = pg_result($sitefeeresult, $lt, 0);
	$feeassistance = pg_result($sitefeeresult, $lt, 1);
	$desassistance = pg_result($sitefeeresult, $lt, 2);
	$scholarship = pg_result($sitefeeresult, $lt, 3);
	$mcdiscount = pg_result($sitefeeresult, $lt, 4);
	$otherassistance = pg_result($sitefeeresult, $lt, 5);
	$transportation = pg_result($sitefeeresult, $lt, 6);
	$snacks = pg_result($sitefeeresult, $lt, 7);
	$breakfast = pg_result($sitefeeresult, $lt, 8);
	$lunch = pg_result($sitefeeresult, $lt, 9);
	$dinner = pg_result($sitefeeresult, $lt, 10);

if ($charge=='t') {
	$chargecount = $chargecount + 1;
}else{}

if ($feeassistance=='t') {
	$feeassistancecount = $feeassistancecount + 1;
}else{}

if ($desassistance=='t') {
	$desassistancecount = $desassistancecount + 1;
}else{}

if ($scholarship=='t') {
	$scholarshipcount = $scholarshipcount + 1;
}else{}

if ($mcdiscount=='t') {
	$mcdiscountcount = $mcdiscountcount + 1;
}else{}

if ($otherassistance=='t') {
	$otherassistancecount = $otherassistancecount + 1;
}else{}

if ($transportation=='t') {
	$transportationcount = $transportationcount + 1;
}else{}

if ($snacks=='t') {
	$snackscount = $snackscount + 1;
}else{}

if ($breakfast=='t') {
	$breakfastcount = $breakfastcount + 1;
}else{}

if ($lunch=='t') {
	$lunchcount = $lunchcount + 1;
}else{}

if ($dinner=='t') {
	$dinnercount = $dinnercount + 1;
}else{}

} // close query

if (!$chartjs) {
	$chartjs = "<script type=\"text/javascript\" src=\"http://www.google.com/jsapi\"></script>
	<script type=\"text/javascript\">
		google.load(\"visualization\", \"1\", {packages:['corechart']});
	";
}else{}

$chartjs .= "
	google.setOnLoadCallback(drawFeeChart);
	function drawFeeChart() {

	var data = google.visualization.arrayToDataTable([
		['Assistance', 'Number of Sites'],
		['Charges Fee', $chargecount],
		['Fee Assistance', $feeassistancecount],
		['DES Assistance', $desassistancecount],
		['Scholarships', $scholarshipcount],
		['Multiple Child Discounts', $mcdiscountcount],
		['Other Assistance', $otherassistancecount],
		['Transportation Assistance', $transportationcount],
		['Serves Snacks', $snackscount],
		['Serves Breakfast', $breakfastcount],
		['Serves Lunch', $lunchcount],
		['Serves Dinner', $dinnercount]
	]);

	var options = {
		width: 400,
		height: 200,
		legend: {position: 'none'},
		hAxis: {title: 'Number of Sites'},
		isStacked: false,
		colors: ['#BC2122'],
		backgroundColor: '#F7F5F6',
		chartArea:{width:\"60%\",left:\"35%\",height:\"80%\",top:\"5%\"}
	};


	var chart = new google.visualization.BarChart(document.getElementById('FeeBar'));
	chart.draw(data, options);
	}
";

$feediv = "<p><b>Distribution of Assistance Across All Sites</b></p><div id=\"FeeBar\"></div>";

} // close if sites exist


$africanamericancount = 0;
$asianamericancount = 0;
$whitecount = 0;
$latinocount = 0;
$nativeamericancount = 0;
$otherracecount = 0;

// pull data and create JS for race/ethnicity
// set initial values to zero

$siteracequery = "SELECT 
africanamerican,
asianamerican,
white,
latino,
nativeamerican,
otherrace,
served
FROM azcase_site_survey WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE verified = 1);";
$siteraceresult = pg_query($connection, $siteracequery);

// if no locations exist in the search radius, then don't attempt to create the map 
if (pg_numrows($siteraceresult)==0) {
}else{

for ($lt = 0; $lt < pg_numrows($siteraceresult); $lt++) {
	$africanamerican = pg_result($siteraceresult, $lt, 0);
	$asianamerican = pg_result($siteraceresult, $lt, 1);
	$white = pg_result($siteraceresult, $lt, 2);
	$latino = pg_result($siteraceresult, $lt, 3);
	$nativeamerican = pg_result($siteraceresult, $lt, 4);
	$otherrace = pg_result($siteraceresult, $lt, 5);
	$served = pg_result($siteraceresult, $lt, 5);

	if ($served>0) {
		// zero out the add variables
		$africanamericanadd = 0;
		$asianamericanadd = 0;
		$whiteadd = 0;
		$latinoadd = 0;
		$nativeamericanadd = 0;
		$otherraceadd = 0;
		
		// multiply the percent of each race by number served and set to add variable, then add to total count
		$africanamericanadd = ($africanamerican/100) * $served;
		$africanamericanadd = round($africanamericanadd);
		$africanamericancount = $africanamericancount + $africanamericanadd;

		$asianamericanadd = ($asianamerican/100) * $served;
		$asianamericanadd = round($asianamericanadd);
		$asianamericancount = $asianamericancount + $asianamericanadd;

		$whiteadd = ($white/100) * $served;
		$whiteadd = round($whiteadd);
		$whitecount = $whitecount + $whiteadd;

		$latinoadd = ($latino/100) * $served;
		$latinoadd = round($latinoadd);
		$latinocount = $latinocount + $latinoadd;

		$nativeamericanadd = ($nativeamerican/100) * $served;
		$nativeamericanadd = round($nativeamericanadd);
		$nativeamericancount = $nativeamericancount + $nativeamericanadd;

		$otherraceadd = ($otherrace/100) * $served;
		$otherraceadd = round($otherraceadd);
		$otherracecount = $otherracecount + $otherraceadd;


	}else{}

} // close query

if (!$chartjs) {
	$chartjs = "<script type=\"text/javascript\" src=\"http://www.google.com/jsapi\"></script>
	<script type=\"text/javascript\">
		google.load(\"visualization\", \"1\", {packages:['corechart']});
	";
}else{}

$chartjs .= "
	google.setOnLoadCallback(drawRaceChart);
	function drawRaceChart() {

	var data = google.visualization.arrayToDataTable([
		['Race/Ethnicity', 'Number Served'],
		['African American', $africanamericancount],
		['Asian American', $asianamericancount],
		['White', $whitecount],
		['Latino', $latinocount],
		['Native American', $nativeamericancount],
		['Other Race', $otherracecount]
	]);

	var options = {
		width: 400,
		height: 200,
		backgroundColor: '#F7F5F6',
		chartArea:{left:\"5%\",height:\"100%\",top:\"0%\"}
	};


	var chart = new google.visualization.PieChart(document.getElementById('RacePie'));
	chart.draw(data, options);
	}
";

$racediv = "<p><b>Distribution of Race/Ethnicity Across All Sites</b></p><div id=\"RacePie\"></div>";

} // close if sites exist



// close the js if we made any pie or bar charts 
if (!$chartjs) {
}else{
	$chartjs .= "</script>";
}

?>
<body>
<h1>Admin Dashboard</h1>
<table width="875">
	<tr>
		<td valign="top">
			<?php echo $activitiesdiv; ?>
		</td>
		<td valign="top">
			<?php echo $racediv; ?>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<?php echo $agediv; ?>
		</td>
		<td valign="top">
			<?php echo $feediv; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top">
			<?php echo $countsysitesdiv; echo $countsyserveddiv; echo $countsumsitesdiv; echo $countsumserveddiv;?>
		</td>
	</tr>

</table>
<br />
<h1>Actions</h1>
<a href="verifysites.php">Verify Sites &#62;&#62;</a> <br /><br />
<a href="adminsearchhome.php">Search for Users, Locations and Sites &#62;&#62;</a> <br /><br />
<a href="adminadvancedsearchhome.php">Advanced Search &#62;&#62;</a> <br /><br />
<a href="emailalertstatus.php">View Email Alert Status &#62;&#62;</a> <br /><br />
<a href="adminexportdata.php">Export Data &#62;&#62;</a> <br /><br />
<?php 

// create footer
require('footer.php');

echo $chartjs;

?>


