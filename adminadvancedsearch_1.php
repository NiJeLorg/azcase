<?php

$summary1 = $_REQUEST['summary1'];
$cd1 = $_REQUEST['cd1'];
$sld1 = $_REQUEST['sld1'];
$elm1 = $_REQUEST['elm1'];
$union1 = $_REQUEST['union1'];
$city1 = $_REQUEST['city1'];
$activity1 = $_REQUEST['activity1'];
$ages1 = $_REQUEST['ages1'];

if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {

?>
<div class="clear"></div>
<h1>Sites, Activities and Ages Served</h1>
<?php
// if summary table is selected
if ($summary1=='t') {

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereages;

// table headers
?>
<h2>Summary Table</h2>
<table class="hoursTable">
	<tr>
		<th>Category</th>
		<th>Number of Sites</th>
	</tr>	
<?php
$summary1row_0 = array( );
$summary1row_0[] = 'Category';
$summary1row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary1row_1 = array( );
$summary1row_1[] = 'Number of Sites';
$summary1row_1[] = $sitescount;
$summary1row_2 = array( );
$summary1row_2[] = 'Number of School Year Sites';
$summary1row_2[] = $schoolyearsitescount;
$summary1row_3 = array( );
$summary1row_3[] = 'Number of Summer Sites';
$summary1row_3[] = $summersitescount;
$summary1row_4 = array( );
$summary1row_4[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$summary1row_4[] = $academicsitescount;
$summary1row_5 = array( );
$summary1row_5[] = 'Number of Sites with Arts and Culture as an Activity';
$summary1row_5[] = $artssitescount;
$summary1row_6 = array( );
$summary1row_6[] = 'Number of Sites with Sports and Recreation as an Activity';
$summary1row_6[] = $sportssitescount;
$summary1row_7 = array( );
$summary1row_7[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$summary1row_7[] = $communitysitescount;
$summary1row_8 = array( );
$summary1row_8[] = 'Number of Sites with Character Education as an Activity';
$summary1row_8[] = $charactersitescount;
$summary1row_9 = array( );
$summary1row_9[] = 'Number of Sites with Leadership as an Activity';
$summary1row_9[] = $leadershipsitescount;
$summary1row_10 = array( );
$summary1row_10[] = 'Number of Sites with Nutrition as an Activity';
$summary1row_10[] = $nutritionsitescount;
$summary1row_11 = array( );
$summary1row_11[] = 'Number of Sites with Prevention as an Activity';
$summary1row_11[] = $preventionsitescount;
$summary1row_12 = array( );
$summary1row_12[] = 'Number of Sites with Mentoring as an Activity';
$summary1row_12[] = $mentoringsitescount;
$summary1row_13 = array( );
$summary1row_13[] = 'Number of Sites with Support Services as an Activity';
$summary1row_13[] = $supportservicessitescount;
$summary1row_14 = array( );
$summary1row_14[] = 'Number of Sites with STEM as an Activity';
$summary1row_14[] = $stemsitescount;
$summary1row_15 = array( );
$summary1row_15[] = 'Number of Sites with College and Career Readiness as an Activity';
$summary1row_15[] = $collegesitescount;
$summary1row_16 = array( );
$summary1row_16[] = 'Number of Sites Serving Ages 5-8';
$summary1row_16[] = $age5_8sitescount;
$summary1row_17 = array( );
$summary1row_17[] = 'Number of Sites Serving Ages 9-11';
$summary1row_17[] = $age9_11sitescount;
$summary1row_18 = array( );
$summary1row_18[] = 'Number of Sites Serving Ages 12-14';
$summary1row_18[] = $age12_14sitescount;
$summary1row_19 = array( );
$summary1row_19[] = 'Number of Sites Serving Ages 15-18';
$summary1row_19[] = $age15_18sitescount;

// build csv file
$summary1file = fopen("export/advancedsearch_summary1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 19; $i++) {
	fputcsv($summary1file, ${'summary1row_'.$i});
}

fclose($summary1file); 


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of School Year Sites</td>
		<td align="right"><?php echo $schoolyearsitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Summer Sites</td>
		<td align="right"><?php echo $summersitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites with Tutoring/Academic Enrichment as an Activity</td>
		<td align="right"><?php echo $academicsitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites with Arts and Culture as an Activity</td>
		<td align="right"><?php echo $artssitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites with Sports and Recreation as an Activity</td>
		<td align="right"><?php echo $sportssitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites with Volunteering/Community Service as an Activity</td>
		<td align="right"><?php echo $communitysitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites with Character Education as an Activity</td>
		<td align="right"><?php echo $charactersitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites with Leadership as an Activity</td>
		<td align="right"><?php echo $leadershipsitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites with Nutrition as an Activity</td>
		<td align="right"><?php echo $nutritionsitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites with Prevention as an Activity</td>
		<td align="right"><?php echo $preventionsitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites with Mentoring as an Activity</td>
		<td align="right"><?php echo $mentoringsitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites with Support Services as an Activity</td>
		<td align="right"><?php echo $supportservicessitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites with STEM as an Activity</td>
		<td align="right"><?php echo $stemsitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites with College and Career Readiness as an Activity</td>
		<td align="right"><?php echo $collegesitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites Serving Ages 5-8</td>
		<td align="right"><?php echo $age5_8sitescount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites Serving Ages 9-11</td>
		<td align="right"><?php echo $age9_11sitescount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites Serving Ages 12-14</td>
		<td align="right"><?php echo $age12_14sitescount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Serving Ages 15-18</td>
		<td align="right"><?php echo $age15_18sitescount; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?php

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd1=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) GROUP BY c.gid;";
//echo $sitescountquery . '<br />';
$maxminsitesresult = pg_query($connection, $maxminsitescountquery);
$maxminsites = pg_fetch_all($maxminsitesresult);
$maxsites = max($maxminsites);
$maxsites = $maxsites['count'];
$minsites = min($maxminsites);
$minsites = $minsites['count'];
$difference = $maxsites - $minsites;
$diffonefifth = $difference/5;
 


// set up array for csv
$cd1row_0 = array( );
$cd1row_0[] = 'Congressional District';
$cd1row_0[] = 'Number of Sites';
$cd1row_0[] = 'Number of School Year Sites';
$cd1row_0[] = 'Number of Summer Sites';
$cd1row_0[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$cd1row_0[] = 'Number of Sites with Arts and Culture as an Activity';
$cd1row_0[] = 'Number of Sites with Sports and Recreation as an Activity';
$cd1row_0[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$cd1row_0[] = 'Number of Sites with Character Education as an Activity';
$cd1row_0[] = 'Number of Sites with Leadership as an Activity';
$cd1row_0[] = 'Number of Sites with Nutrition as an Activity';
$cd1row_0[] = 'Number of Sites with Prevention as an Activity';
$cd1row_0[] = 'Number of Sites with Mentoring as an Activity';
$cd1row_0[] = 'Number of Sites with Support Services as an Activity';
$cd1row_0[] = 'Number of Sites with STEM as an Activity';
$cd1row_0[] = 'Number of Sites with College and Career Readiness as an Activity';
$cd1row_0[] = 'Number of Sites Serving Ages 5-8';
$cd1row_0[] = 'Number of Sites Serving Ages 9-11';
$cd1row_0[] = 'Number of Sites Serving Ages 12-14';
$cd1row_0[] = 'Number of Sites Serving Ages 15-18';


$count = 1;
$tablebody = '';
// loop through each category/geography to build body of table
$azcongressquery = "SELECT gid FROM az_congress ORDER BY gid;";
$azcongressresult = pg_query($connection, $azcongressquery);
for ($azcongresslt = 0; $azcongresslt < pg_numrows($azcongressresult); $azcongresslt++) {
	$gid = pg_result($azcongressresult, $azcongresslt, 0);

if ($azcongresswhere=='') {
	$azcongressjoin = " JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) ";
	$azcongresswherebyazcongress = " (c.gid = $gid)";
	$and0 = "AND";
}elseif ($azcongresswhere!='') {
	${'azcongressfilter'.$gid} = $_REQUEST["azcongressfilter$gid"];
	if (${'azcongressfilter'.$gid}=='t') {
		$azcongresswherebyazcongress = " (c.gid = $gid)";
	}else{
		$azcongresswherebyazcongress = " (c.gid = 999)";
	} // if (${'fundidfilter'.$fundid}=='t') {
}else{} // if ($wherefundid=='') {

// reset ands to beginning state
require('setands.php');


// ensure that and1 = AND if other where statements are in use
if ($statelegwhere!='' || $elemschooldistrictwhere!='' || $unionschooldistrictwhere!='' || $citieswhere!='' || $whereactivity!='' || $whereages!='') {
	$and1 = "AND";
}else{
	$and1 = '';
}

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswherebyazcongress . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereages;

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
//echo $sitescountquery . '<br />';
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($sitescount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($sitescount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd1row_'.$count} = array();
${'cd1row_'.$count}[] = $gid;
${'cd1row_'.$count}[] = $sitescount;
${'cd1row_'.$count}[] = $schoolyearsitescount;
${'cd1row_'.$count}[] = $summersitescount;
${'cd1row_'.$count}[] = $academicsitescount;
${'cd1row_'.$count}[] = $artssitescount;
${'cd1row_'.$count}[] = $sportssitescount;
${'cd1row_'.$count}[] = $communitysitescount;
${'cd1row_'.$count}[] = $charactersitescount;
${'cd1row_'.$count}[] = $leadershipsitescount;
${'cd1row_'.$count}[] = $nutritionsitescount;
${'cd1row_'.$count}[] = $preventionsitescount;
${'cd1row_'.$count}[] = $mentoringsitescount;
${'cd1row_'.$count}[] = $supportservicessitescount;
${'cd1row_'.$count}[] = $stemsitescount;
${'cd1row_'.$count}[] = $collegesitescount;
${'cd1row_'.$count}[] = $age5_8sitescount;
${'cd1row_'.$count}[] = $age9_11sitescount;
${'cd1row_'.$count}[] = $age12_14sitescount;
${'cd1row_'.$count}[] = $age15_18sitescount;


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

// highlight odd rows
if ($count&1){
	$trclass = "<tr>";
}else{
	$trclass = "<tr class=\"alt\">";
}

$tablebody .= "
	$trclass
		<td>CD $gid</td>
		<td align=\"right\">$sitescount</td>
		<td align=\"right\">$schoolyearsitescount</td>
		<td align=\"right\">$summersitescount</td>
		<td align=\"right\">$academicsitescount</td>
		<td align=\"right\">$artssitescount</td>
		<td align=\"right\">$sportssitescount</td>
		<td align=\"right\">$communitysitescount</td>
		<td align=\"right\">$charactersitescount</td>
		<td align=\"right\">$leadershipsitescount</td>
		<td align=\"right\">$nutritionsitescount</td>
		<td align=\"right\">$preventionsitescount</td>
		<td align=\"right\">$mentoringsitescount</td>
		<td align=\"right\">$supportservicessitescount</td>
		<td align=\"right\">$stemsitescount</td>
		<td align=\"right\">$collegesitescount</td>
		<td align=\"right\">$age5_8sitescount</td>
		<td align=\"right\">$age9_11sitescount</td>
		<td align=\"right\">$age12_14sitescount</td>
		<td align=\"right\">$age15_18sitescount</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of School Year Sites: <b>$schoolyearsitescount</b><br />Number of Summer Sites: <b>$summersitescount</b><br />Number of Sites with Tutoring/Academic Enrichment as an Activity: <b>$academicsitescount</b><br />Number of Sites with Arts and Culture as an Activity: <b>$artssitescount</b><br />Number of Sites with Sports and Recreation as an Activity: <b>$sportssitescount</b><br />Number of Sites with Volunteering/Community Service as an Activity: <b>$communitysitescount</b><br />Number of Sites with Character Education as an Activity: <b>$charactersitescount</b><br />Number of Sites with Leadership as an Activity: <b>$leadershipsitescount</b><br />Number of Sites with Nutrition as an Activity: <b>$nutritionsitescount</b><br />Number of Sites with Prevention as an Activity: <b>$preventionsitescount</b><br />Number of Sites with Mentoring as an Activity: <b>$mentoringsitescount</b><br />Number of Sites with Support Services as an Activity: <b>$supportservicessitescount</b><br />Number of Sites with STEM as an Activity: <b>$stemsitescount</b><br />Number of Sites with College and Career Readiness as an Activity: <b>$collegesitescount</b><br />Number of Sites Serving Ages 5-8: <b>$age5_8sitescount</b><br />Number of Sites Serving Ages 9-11: <b>$age9_11sitescount</b><br />Number of Sites Serving Ages 12-14: <b>$age12_14sitescount</b><br />Number of Sites Serving Ages 15-18: <b>$age15_18sitescount<br />]]></description>";

// pull kml geometry
$kmlgeomquery = "SELECT ST_AsKML(the_geom) FROM az_congress WHERE gid = $gid;";
$sitesresult = pg_query($connection, $kmlgeomquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$geom = pg_result($sitesresult, $lt, 0);
}

$kmlbody .= $geom;
$kmlbody .= "</Placemark>";

$count++;
} // close if ($sitescount==0) {

} // close cd loop

// build csv file
$cd1file = fopen("export/advancedsearch_congressionaldistrict1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd1file, ${'cd1row_'.$i});
}

fclose($cd1file); 


// create kml header with five thematic styles
$kmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns:geo=\"http://www.opengis.net/kml/2.2\">
<Document>
  <name>Arizona Afterschool Program Directory Sites by Congressional District</name>
  <description>Arizona Afterschool Program Directory Sites by Congressional District KML File</description>
	<Style id='Q1'><PolyStyle><color>afd9f0fe</color></PolyStyle></Style>
	<Style id='Q2'><PolyStyle><color>af8accfd</color></PolyStyle></Style>
	<Style id='Q3'><PolyStyle><color>af598dfc</color></PolyStyle></Style>
	<Style id='Q4'><PolyStyle><color>af334ae3</color></PolyStyle></Style>
	<Style id='Q5'><PolyStyle><color>af0000b3</color></PolyStyle></Style>
	  <ScreenOverlay>
	    <visibility>1</visibility>
	    <Icon>
	      <href>https://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
	    </Icon>
	    <overlayXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <screenXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <rotationXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <size x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	  </ScreenOverlay>
";

$kmlfooter = "
</Document>
</kml>
";

$kml = $kmlheader . $kmlbody . $kmlfooter;

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict1.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of School Year Sites</th>
		<th>Number of Summer Sites</th>
		<th>Number of Sites with Tutoring / Academic Enrichment as an Activity</th>
		<th>Number of Sites with Arts and Culture as an Activity</th>
		<th>Number of Sites with Sports and Recreation as an Activity</th>
		<th>Number of Sites with Volunteering / Community Service as an Activity</th>
		<th>Number of Sites with Character Education as an Activity</th>
		<th>Number of Sites with Leadership as an Activity</th>
		<th>Number of Sites with Nutrition as an Activity</th>
		<th>Number of Sites with Prevention as an Activity</th>
		<th>Number of Sites with Mentoring as an Activity</th>
		<th>Number of Sites with Support Services as an Activity</th>
		<th>Number of Sites with STEM as an Activity</th>
		<th>Number of Sites with College and Career Readiness as an Activity</th>
		<th>Number of Sites Serving Ages 5-8</th>
		<th>Number of Sites Serving Ages 9-11</th>
		<th>Number of Sites Serving Ages 12-14</th>
		<th>Number of Sites Serving Ages 15-18</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict1.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?php

}else{} // if ($cd1=='t') {


// if by state legislative districts is selected
if ($sld1=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_legisl AS d ON ST_Contains(d.the_geom, b.the_geom) GROUP BY d.gid;";
//echo $sitescountquery . '<br />';
$maxminsitesresult = pg_query($connection, $maxminsitescountquery);
$maxminsites = pg_fetch_all($maxminsitesresult);
$maxsites = max($maxminsites);
$maxsites = $maxsites['count'];
$minsites = min($maxminsites);
$minsites = $minsites['count'];
$difference = $maxsites - $minsites;
$diffonefifth = $difference/5;

// set up array for csv
$sld1row_0 = array( );
$sld1row_0[] = 'State Legislaltive District';
$sld1row_0[] = 'Number of Sites';
$sld1row_0[] = 'Number of School Year Sites';
$sld1row_0[] = 'Number of Summer Sites';
$sld1row_0[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$sld1row_0[] = 'Number of Sites with Arts and Culture as an Activity';
$sld1row_0[] = 'Number of Sites with Sports and Recreation as an Activity';
$sld1row_0[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$sld1row_0[] = 'Number of Sites with Character Education as an Activity';
$sld1row_0[] = 'Number of Sites with Leadership as an Activity';
$sld1row_0[] = 'Number of Sites with Nutrition as an Activity';
$sld1row_0[] = 'Number of Sites with Prevention as an Activity';
$sld1row_0[] = 'Number of Sites with Mentoring as an Activity';
$sld1row_0[] = 'Number of Sites with Support Services as an Activity';
$sld1row_0[] = 'Number of Sites with STEM as an Activity';
$sld1row_0[] = 'Number of Sites with College and Career Readiness as an Activity';
$sld1row_0[] = 'Number of Sites Serving Ages 5-8';
$sld1row_0[] = 'Number of Sites Serving Ages 9-11';
$sld1row_0[] = 'Number of Sites Serving Ages 12-14';
$sld1row_0[] = 'Number of Sites Serving Ages 15-18';


$count = 1;
$tablebody = '';
// loop through each category/geography to build body of table
$statelegquery = "SELECT gid FROM az_legisl ORDER BY gid;";
$statelegresult = pg_query($connection, $statelegquery);
for ($stateleglt = 0; $stateleglt < pg_numrows($statelegresult); $stateleglt++) {
	$gid = pg_result($statelegresult, $stateleglt, 0);

if ($statelegwhere=='') {
	$statelegjoin = " JOIN az_legisl AS d ON ST_Contains(d.the_geom, b.the_geom) ";
	$statelegwherebystateleg = " (d.gid = $gid)";
	$and0 = "AND";
}elseif ($statelegwhere!='') {
	${'statelegfilter'.$gid} = $_REQUEST["statelegfilter$gid"];
	if (${'statelegfilter'.$gid}=='t') {
		$statelegwherebystateleg = " (d.gid = $gid)";
	}else{
		$statelegwherebystateleg = " (d.gid = 999)";
	} // if (${'fundidfilter'.$fundid}=='t') {
}else{} // if ($wherefundid=='') {

// reset ands to beginning state
require('setands.php');


// ensure that and1 = AND if other where statements are in use
if ($azcongresswhere!='') {
	$and1 = "AND";
}else{
	$and1 = '';
}

if ($elemschooldistrictwhere!='' || $unionschooldistrictwhere!='' || $citieswhere!='' || $whereactivity!='' || $whereages!='') {
	$and2 = "AND";
}else{
	$and2 = '';
}

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwherebystateleg . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereages;

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
//echo $sitescountquery . '<br />';
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($sitescount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($sitescount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld1row_'.$count} = array();
${'sld1row_'.$count}[] = $gid;
${'sld1row_'.$count}[] = $sitescount;
${'sld1row_'.$count}[] = $schoolyearsitescount;
${'sld1row_'.$count}[] = $summersitescount;
${'sld1row_'.$count}[] = $academicsitescount;
${'sld1row_'.$count}[] = $artssitescount;
${'sld1row_'.$count}[] = $sportssitescount;
${'sld1row_'.$count}[] = $communitysitescount;
${'sld1row_'.$count}[] = $charactersitescount;
${'sld1row_'.$count}[] = $leadershipsitescount;
${'sld1row_'.$count}[] = $nutritionsitescount;
${'sld1row_'.$count}[] = $preventionsitescount;
${'sld1row_'.$count}[] = $mentoringsitescount;
${'sld1row_'.$count}[] = $supportservicessitescount;
${'sld1row_'.$count}[] = $stemsitescount;
${'sld1row_'.$count}[] = $collegesitescount;
${'sld1row_'.$count}[] = $age5_8sitescount;
${'sld1row_'.$count}[] = $age9_11sitescount;
${'sld1row_'.$count}[] = $age12_14sitescount;
${'sld1row_'.$count}[] = $age15_18sitescount;


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

// highlight odd rows
if ($count&1){
	$trclass = "<tr>";
}else{
	$trclass = "<tr class=\"alt\">";
}

$tablebody .= "
	$trclass
		<td>SLD $gid</td>
		<td align=\"right\">$sitescount</td>
		<td align=\"right\">$schoolyearsitescount</td>
		<td align=\"right\">$summersitescount</td>
		<td align=\"right\">$academicsitescount</td>
		<td align=\"right\">$artssitescount</td>
		<td align=\"right\">$sportssitescount</td>
		<td align=\"right\">$communitysitescount</td>
		<td align=\"right\">$charactersitescount</td>
		<td align=\"right\">$leadershipsitescount</td>
		<td align=\"right\">$nutritionsitescount</td>
		<td align=\"right\">$preventionsitescount</td>
		<td align=\"right\">$mentoringsitescount</td>
		<td align=\"right\">$supportservicessitescount</td>
		<td align=\"right\">$stemsitescount</td>
		<td align=\"right\">$collegesitescount</td>
		<td align=\"right\">$age5_8sitescount</td>
		<td align=\"right\">$age9_11sitescount</td>
		<td align=\"right\">$age12_14sitescount</td>
		<td align=\"right\">$age15_18sitescount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of School Year Sites: <b>$schoolyearsitescount</b><br />Number of Summer Sites: <b>$summersitescount</b><br />Number of Sites with Tutoring/Academic Enrichment as an Activity: <b>$academicsitescount</b><br />Number of Sites with Arts and Culture as an Activity: <b>$artssitescount</b><br />Number of Sites with Sports and Recreation as an Activity: <b>$sportssitescount</b><br />Number of Sites with Volunteering/Community Service as an Activity: <b>$communitysitescount</b><br />Number of Sites with Character Education as an Activity: <b>$charactersitescount</b><br />Number of Sites with Leadership as an Activity: <b>$leadershipsitescount</b><br />Number of Sites with Nutrition as an Activity: <b>$nutritionsitescount</b><br />Number of Sites with Prevention as an Activity: <b>$preventionsitescount</b><br />Number of Sites with Mentoring as an Activity: <b>$mentoringsitescount</b><br />Number of Sites with Support Services as an Activity: <b>$supportservicessitescount</b><br />Number of Sites with STEM as an Activity: <b>$stemsitescount</b><br />Number of Sites with College and Career Readiness as an Activity: <b>$collegesitescount</b><br />Number of Sites Serving Ages 5-8: <b>$age5_8sitescount</b><br />Number of Sites Serving Ages 9-11: <b>$age9_11sitescount</b><br />Number of Sites Serving Ages 12-14: <b>$age12_14sitescount</b><br />Number of Sites Serving Ages 15-18: <b>$age15_18sitescount<br />]]></description>";

// pull kml geometry
$kmlgeomquery = "SELECT ST_AsKML(the_geom) FROM az_legisl WHERE gid = $gid;";
$sitesresult = pg_query($connection, $kmlgeomquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$geom = pg_result($sitesresult, $lt, 0);
}

$kmlbody .= $geom;
$kmlbody .= "</Placemark>";

$count++;
} // close if ($sitescount==0) {

} // close cd loop

// build csv file
$sld1file = fopen("export/advancedsearch_statelegislativedistrict1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld1file, ${'sld1row_'.$i});
}

fclose($sld1file); 

// create kml header with five thematic styles
$kmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns:geo=\"http://www.opengis.net/kml/2.2\">
<Document>
  <name>Arizona Afterschool Program Directory Sites by State Legislative District</name>
  <description>Arizona Afterschool Program Directory Sites by State Legislative District KML File</description>
	<Style id='Q1'><PolyStyle><color>afd9f0fe</color></PolyStyle></Style>
	<Style id='Q2'><PolyStyle><color>af8accfd</color></PolyStyle></Style>
	<Style id='Q3'><PolyStyle><color>af598dfc</color></PolyStyle></Style>
	<Style id='Q4'><PolyStyle><color>af334ae3</color></PolyStyle></Style>
	<Style id='Q5'><PolyStyle><color>af0000b3</color></PolyStyle></Style>
	  <ScreenOverlay>
	    <visibility>1</visibility>
	    <Icon>
	      <href>https://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
	    </Icon>
	    <overlayXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <screenXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <rotationXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <size x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	  </ScreenOverlay>
";

$kmlfooter = "
</Document>
</kml>
";

$kml = $kmlheader . $kmlbody . $kmlfooter;

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict1.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of School Year Sites</th>
		<th>Number of Summer Sites</th>
		<th>Number of Sites with Tutoring / Academic Enrichment as an Activity</th>
		<th>Number of Sites with Arts and Culture as an Activity</th>
		<th>Number of Sites with Sports and Recreation as an Activity</th>
		<th>Number of Sites with Volunteering / Community Service as an Activity</th>
		<th>Number of Sites with Character Education as an Activity</th>
		<th>Number of Sites with Leadership as an Activity</th>
		<th>Number of Sites with Nutrition as an Activity</th>
		<th>Number of Sites with Prevention as an Activity</th>
		<th>Number of Sites with Mentoring as an Activity</th>
		<th>Number of Sites with Support Services as an Activity</th>
		<th>Number of Sites with STEM as an Activity</th>
		<th>Number of Sites with College and Career Readiness as an Activity</th>
		<th>Number of Sites Serving Ages 5-8</th>
		<th>Number of Sites Serving Ages 9-11</th>
		<th>Number of Sites Serving Ages 12-14</th>
		<th>Number of Sites Serving Ages 15-18</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict1.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($sld1=='t') {


// if by elementary school distircts is selected
if ($elm1=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_elm_districts AS e ON ST_Contains(e.the_geom, b.the_geom) GROUP BY e.gid;";
//echo $sitescountquery . '<br />';
$maxminsitesresult = pg_query($connection, $maxminsitescountquery);
$maxminsites = pg_fetch_all($maxminsitesresult);
$maxsites = max($maxminsites);
$maxsites = $maxsites['count'];
$minsites = min($maxminsites);
$minsites = $minsites['count'];
$difference = $maxsites - $minsites;
$diffonefifth = $difference/5;

// set up array for csv
$elm1row_0 = array( );
$elm1row_0[] = 'Elementary School District Name';
$elm1row_0[] = 'Number of Sites';
$elm1row_0[] = 'Number of School Year Sites';
$elm1row_0[] = 'Number of Summer Sites';
$elm1row_0[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$elm1row_0[] = 'Number of Sites with Arts and Culture as an Activity';
$elm1row_0[] = 'Number of Sites with Sports and Recreation as an Activity';
$elm1row_0[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$elm1row_0[] = 'Number of Sites with Character Education as an Activity';
$elm1row_0[] = 'Number of Sites with Leadership as an Activity';
$elm1row_0[] = 'Number of Sites with Nutrition as an Activity';
$elm1row_0[] = 'Number of Sites with Prevention as an Activity';
$elm1row_0[] = 'Number of Sites with Mentoring as an Activity';
$elm1row_0[] = 'Number of Sites with Support Services as an Activity';
$elm1row_0[] = 'Number of Sites with STEM as an Activity';
$elm1row_0[] = 'Number of Sites with College and Career Readiness as an Activity';
$elm1row_0[] = 'Number of Sites Serving Ages 5-8';
$elm1row_0[] = 'Number of Sites Serving Ages 9-11';
$elm1row_0[] = 'Number of Sites Serving Ages 12-14';
$elm1row_0[] = 'Number of Sites Serving Ages 15-18';


$count = 1;
$tablebody = '';
// loop through each category/geography to build body of table
$elemschooldistrictquery = "SELECT gid, name10 FROM az_elm_districts ORDER BY name10;";
$elemschooldistrictresult = pg_query($connection, $elemschooldistrictquery);
for ($elemschooldistrictlt = 0; $elemschooldistrictlt < pg_numrows($elemschooldistrictresult); $elemschooldistrictlt++) {
	$gid = pg_result($elemschooldistrictresult, $elemschooldistrictlt, 0);
	$name = pg_result($elemschooldistrictresult, $elemschooldistrictlt, 1);

if ($elemschooldistrictwhere=='') {
	$elemschooldistrictjoin = " JOIN az_elm_districts AS e ON ST_Contains(e.the_geom, b.the_geom) ";
	$elemschooldistrictwherebyelemschooldistrict = " (e.gid = $gid)";
	$and0 = "AND";
}elseif ($elemschooldistrictwhere!='') {
	${'elemschooldistrictfilter'.$gid} = $_REQUEST["elemschooldistrictfilter$gid"];
	if (${'elemschooldistrictfilter'.$gid}=='t') {
		$elemschooldistrictwherebyelemschooldistrict = " (e.gid = $gid)";
	}else{
		$elemschooldistrictwherebyelemschooldistrict = " (e.gid = 999)";
	} // if (${'fundidfilter'.$fundid}=='t') {
}else{} // if ($wherefundid=='') {

// reset ands to beginning state
require('setands.php');


// ensure that and1 = AND if other where statements are in use
if ($azcongresswhere!='' || $statelegwhere!='') {
	$and2 = "AND";
}else{
	$and2 = '';
}

if ($unionschooldistrictwhere!='' || $citieswhere!='' || $whereactivity!='' || $whereages!='') {
	$and3 = "AND";
}else{
	$and3 = '';
}

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwherebyelemschooldistrict . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereages;

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
//echo $sitescountquery . '<br />';
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($sitescount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($sitescount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm1row_'.$count} = array();
${'elm1row_'.$count}[] = $name;
${'elm1row_'.$count}[] = $sitescount;
${'elm1row_'.$count}[] = $schoolyearsitescount;
${'elm1row_'.$count}[] = $summersitescount;
${'elm1row_'.$count}[] = $academicsitescount;
${'elm1row_'.$count}[] = $artssitescount;
${'elm1row_'.$count}[] = $sportssitescount;
${'elm1row_'.$count}[] = $communitysitescount;
${'elm1row_'.$count}[] = $charactersitescount;
${'elm1row_'.$count}[] = $leadershipsitescount;
${'elm1row_'.$count}[] = $nutritionsitescount;
${'elm1row_'.$count}[] = $preventionsitescount;
${'elm1row_'.$count}[] = $mentoringsitescount;
${'elm1row_'.$count}[] = $supportservicessitescount;
${'elm1row_'.$count}[] = $stemsitescount;
${'elm1row_'.$count}[] = $collegesitescount;
${'elm1row_'.$count}[] = $age5_8sitescount;
${'elm1row_'.$count}[] = $age9_11sitescount;
${'elm1row_'.$count}[] = $age12_14sitescount;
${'elm1row_'.$count}[] = $age15_18sitescount;


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

// highlight odd rows
if ($count&1){
	$trclass = "<tr>";
}else{
	$trclass = "<tr class=\"alt\">";
}

$tablebody .= "
	$trclass
		<td>$name</td>
		<td align=\"right\">$sitescount</td>
		<td align=\"right\">$schoolyearsitescount</td>
		<td align=\"right\">$summersitescount</td>
		<td align=\"right\">$academicsitescount</td>
		<td align=\"right\">$artssitescount</td>
		<td align=\"right\">$sportssitescount</td>
		<td align=\"right\">$communitysitescount</td>
		<td align=\"right\">$charactersitescount</td>
		<td align=\"right\">$leadershipsitescount</td>
		<td align=\"right\">$nutritionsitescount</td>
		<td align=\"right\">$preventionsitescount</td>
		<td align=\"right\">$mentoringsitescount</td>
		<td align=\"right\">$supportservicessitescount</td>
		<td align=\"right\">$stemsitescount</td>
		<td align=\"right\">$collegesitescount</td>
		<td align=\"right\">$age5_8sitescount</td>
		<td align=\"right\">$age9_11sitescount</td>
		<td align=\"right\">$age12_14sitescount</td>
		<td align=\"right\">$age15_18sitescount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of School Year Sites: <b>$schoolyearsitescount</b><br />Number of Summer Sites: <b>$summersitescount</b><br />Number of Sites with Tutoring/Academic Enrichment as an Activity: <b>$academicsitescount</b><br />Number of Sites with Arts and Culture as an Activity: <b>$artssitescount</b><br />Number of Sites with Sports and Recreation as an Activity: <b>$sportssitescount</b><br />Number of Sites with Volunteering/Community Service as an Activity: <b>$communitysitescount</b><br />Number of Sites with Character Education as an Activity: <b>$charactersitescount</b><br />Number of Sites with Leadership as an Activity: <b>$leadershipsitescount</b><br />Number of Sites with Nutrition as an Activity: <b>$nutritionsitescount</b><br />Number of Sites with Prevention as an Activity: <b>$preventionsitescount</b><br />Number of Sites with Mentoring as an Activity: <b>$mentoringsitescount</b><br />Number of Sites with Support Services as an Activity: <b>$supportservicessitescount</b><br />Number of Sites with STEM as an Activity: <b>$stemsitescount</b><br />Number of Sites with College and Career Readiness as an Activity: <b>$collegesitescount</b><br />Number of Sites Serving Ages 5-8: <b>$age5_8sitescount</b><br />Number of Sites Serving Ages 9-11: <b>$age9_11sitescount</b><br />Number of Sites Serving Ages 12-14: <b>$age12_14sitescount</b><br />Number of Sites Serving Ages 15-18: <b>$age15_18sitescount<br />]]></description>";

// pull kml geometry
$kmlgeomquery = "SELECT ST_AsKML(the_geom) FROM az_elm_districts WHERE gid = $gid;";
$sitesresult = pg_query($connection, $kmlgeomquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$geom = pg_result($sitesresult, $lt, 0);
}

$kmlbody .= $geom;
$kmlbody .= "</Placemark>";

$count++;
} // close if ($sitescount==0) {

} // close cd loop

// build csv file
$elm1file = fopen("export/advancedsearch_elementaryschooldistrict1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm1file, ${'elm1row_'.$i});
}

fclose($elm1file); 

// create kml header with five thematic styles
$kmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns:geo=\"http://www.opengis.net/kml/2.2\">
<Document>
  <name>Arizona Afterschool Program Directory Sites by Elementary School District</name>
  <description>Arizona Afterschool Program Directory Sites by Elementary School District KML File</description>
	<Style id='Q1'><PolyStyle><color>afd9f0fe</color></PolyStyle></Style>
	<Style id='Q2'><PolyStyle><color>af8accfd</color></PolyStyle></Style>
	<Style id='Q3'><PolyStyle><color>af598dfc</color></PolyStyle></Style>
	<Style id='Q4'><PolyStyle><color>af334ae3</color></PolyStyle></Style>
	<Style id='Q5'><PolyStyle><color>af0000b3</color></PolyStyle></Style>
	  <ScreenOverlay>
	    <visibility>1</visibility>
	    <Icon>
	      <href>https://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
	    </Icon>
	    <overlayXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <screenXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <rotationXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <size x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	  </ScreenOverlay>
";

$kmlfooter = "
</Document>
</kml>
";

$kml = $kmlheader . $kmlbody . $kmlfooter;

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict1.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of School Year Sites</th>
		<th>Number of Summer Sites</th>
		<th>Number of Sites with Tutoring / Academic Enrichment as an Activity</th>
		<th>Number of Sites with Arts and Culture as an Activity</th>
		<th>Number of Sites with Sports and Recreation as an Activity</th>
		<th>Number of Sites with Volunteering / Community Service as an Activity</th>
		<th>Number of Sites with Character Education as an Activity</th>
		<th>Number of Sites with Leadership as an Activity</th>
		<th>Number of Sites with Nutrition as an Activity</th>
		<th>Number of Sites with Prevention as an Activity</th>
		<th>Number of Sites with Mentoring as an Activity</th>
		<th>Number of Sites with Support Services as an Activity</th>
		<th>Number of Sites with STEM as an Activity</th>
		<th>Number of Sites with College and Career Readiness as an Activity</th>
		<th>Number of Sites Serving Ages 5-8</th>
		<th>Number of Sites Serving Ages 9-11</th>
		<th>Number of Sites Serving Ages 12-14</th>
		<th>Number of Sites Serving Ages 15-18</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict1.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($elm1=='t') {


// if by By Secondary/Union School District is selected
if ($union1=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_union_second_school_distcts AS f ON ST_Contains(f.the_geom, b.the_geom) GROUP BY f.gid;";
//echo $sitescountquery . '<br />';
$maxminsitesresult = pg_query($connection, $maxminsitescountquery);
$maxminsites = pg_fetch_all($maxminsitesresult);
$maxsites = max($maxminsites);
$maxsites = $maxsites['count'];
$minsites = min($maxminsites);
$minsites = $minsites['count'];
$difference = $maxsites - $minsites;
$diffonefifth = $difference/5;

// set up array for csv
$union1row_0 = array( );
$union1row_0[] = 'Secondary/Union School District Name';
$union1row_0[] = 'Number of Sites';
$union1row_0[] = 'Number of School Year Sites';
$union1row_0[] = 'Number of Summer Sites';
$union1row_0[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$union1row_0[] = 'Number of Sites with Arts and Culture as an Activity';
$union1row_0[] = 'Number of Sites with Sports and Recreation as an Activity';
$union1row_0[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$union1row_0[] = 'Number of Sites with Character Education as an Activity';
$union1row_0[] = 'Number of Sites with Leadership as an Activity';
$union1row_0[] = 'Number of Sites with Nutrition as an Activity';
$union1row_0[] = 'Number of Sites with Prevention as an Activity';
$union1row_0[] = 'Number of Sites with Mentoring as an Activity';
$union1row_0[] = 'Number of Sites with Support Services as an Activity';
$union1row_0[] = 'Number of Sites with STEM as an Activity';
$union1row_0[] = 'Number of Sites with College and Career Readiness as an Activity';
$union1row_0[] = 'Number of Sites Serving Ages 5-8';
$union1row_0[] = 'Number of Sites Serving Ages 9-11';
$union1row_0[] = 'Number of Sites Serving Ages 12-14';
$union1row_0[] = 'Number of Sites Serving Ages 15-18';


$count = 1;
$tablebody = '';
// loop through each category/geography to build body of table
$unionschooldistrictquery = "SELECT gid, name10 FROM az_union_second_school_distcts ORDER BY name10;";
$unionschooldistrictresult = pg_query($connection, $unionschooldistrictquery);
for ($unionschooldistrictlt = 0; $unionschooldistrictlt < pg_numrows($unionschooldistrictresult); $unionschooldistrictlt++) {
	$gid = pg_result($unionschooldistrictresult, $unionschooldistrictlt, 0);
	$name = pg_result($unionschooldistrictresult, $unionschooldistrictlt, 1);

if ($unionschooldistrictwhere=='') {
	$unionschooldistrictjoin = " JOIN az_union_second_school_distcts AS f ON ST_Contains(f.the_geom, b.the_geom) ";
	$unionschooldistrictwherebyunionschooldistrict = " (f.gid = $gid)";
	$and0 = "AND";
}elseif ($unionschooldistrictwhere!='') {
	${'unionschooldistrictfilter'.$gid} = $_REQUEST["unionschooldistrictfilter$gid"];
	if (${'unionschooldistrictfilter'.$gid}=='t') {
		$unionschooldistrictwherebyunionschooldistrict = " (f.gid = $gid)";
	}else{
		$unionschooldistrictwherebyunionschooldistrict = " (f.gid = 999)";
	} // if (${'fundidfilter'.$fundid}=='t') {
}else{} // if ($wherefundid=='') {

// reset ands to beginning state
require('setands.php');


// ensure that and1 = AND if other where statements are in use
if ($azcongresswhere!='' || $statelegwhere!='' || $elemschooldistrictwhere!='') {
	$and3 = "AND";
}else{
	$and3 = '';
}

if ($citieswhere!='' || $whereactivity!='' || $whereages!='') {
	$and4 = "AND";
}else{
	$and4 = '';
}

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwherebyunionschooldistrict . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereages;

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
//echo $sitescountquery . '<br />';
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($sitescount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($sitescount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union1row_'.$count} = array();
${'union1row_'.$count}[] = $name;
${'union1row_'.$count}[] = $sitescount;
${'union1row_'.$count}[] = $schoolyearsitescount;
${'union1row_'.$count}[] = $summersitescount;
${'union1row_'.$count}[] = $academicsitescount;
${'union1row_'.$count}[] = $artssitescount;
${'union1row_'.$count}[] = $sportssitescount;
${'union1row_'.$count}[] = $communitysitescount;
${'union1row_'.$count}[] = $charactersitescount;
${'union1row_'.$count}[] = $leadershipsitescount;
${'union1row_'.$count}[] = $nutritionsitescount;
${'union1row_'.$count}[] = $preventionsitescount;
${'union1row_'.$count}[] = $mentoringsitescount;
${'union1row_'.$count}[] = $supportservicessitescount;
${'union1row_'.$count}[] = $stemsitescount;
${'union1row_'.$count}[] = $collegesitescount;
${'union1row_'.$count}[] = $age5_8sitescount;
${'union1row_'.$count}[] = $age9_11sitescount;
${'union1row_'.$count}[] = $age12_14sitescount;
${'union1row_'.$count}[] = $age15_18sitescount;


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

// highlight odd rows
if ($count&1){
	$trclass = "<tr>";
}else{
	$trclass = "<tr class=\"alt\">";
}

$tablebody .= "
	$trclass
		<td>$name</td>
		<td align=\"right\">$sitescount</td>
		<td align=\"right\">$schoolyearsitescount</td>
		<td align=\"right\">$summersitescount</td>
		<td align=\"right\">$academicsitescount</td>
		<td align=\"right\">$artssitescount</td>
		<td align=\"right\">$sportssitescount</td>
		<td align=\"right\">$communitysitescount</td>
		<td align=\"right\">$charactersitescount</td>
		<td align=\"right\">$leadershipsitescount</td>
		<td align=\"right\">$nutritionsitescount</td>
		<td align=\"right\">$preventionsitescount</td>
		<td align=\"right\">$mentoringsitescount</td>
		<td align=\"right\">$supportservicessitescount</td>
		<td align=\"right\">$stemsitescount</td>
		<td align=\"right\">$collegesitescount</td>
		<td align=\"right\">$age5_8sitescount</td>
		<td align=\"right\">$age9_11sitescount</td>
		<td align=\"right\">$age12_14sitescount</td>
		<td align=\"right\">$age15_18sitescount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of School Year Sites: <b>$schoolyearsitescount</b><br />Number of Summer Sites: <b>$summersitescount</b><br />Number of Sites with Tutoring/Academic Enrichment as an Activity: <b>$academicsitescount</b><br />Number of Sites with Arts and Culture as an Activity: <b>$artssitescount</b><br />Number of Sites with Sports and Recreation as an Activity: <b>$sportssitescount</b><br />Number of Sites with Volunteering/Community Service as an Activity: <b>$communitysitescount</b><br />Number of Sites with Character Education as an Activity: <b>$charactersitescount</b><br />Number of Sites with Leadership as an Activity: <b>$leadershipsitescount</b><br />Number of Sites with Nutrition as an Activity: <b>$nutritionsitescount</b><br />Number of Sites with Prevention as an Activity: <b>$preventionsitescount</b><br />Number of Sites with Mentoring as an Activity: <b>$mentoringsitescount</b><br />Number of Sites with Support Services as an Activity: <b>$supportservicessitescount</b><br />Number of Sites with STEM as an Activity: <b>$stemsitescount</b><br />Number of Sites with College and Career Readiness as an Activity: <b>$collegesitescount</b><br />Number of Sites Serving Ages 5-8: <b>$age5_8sitescount</b><br />Number of Sites Serving Ages 9-11: <b>$age9_11sitescount</b><br />Number of Sites Serving Ages 12-14: <b>$age12_14sitescount</b><br />Number of Sites Serving Ages 15-18: <b>$age15_18sitescount<br />]]></description>";

// pull kml geometry
$kmlgeomquery = "SELECT ST_AsKML(the_geom) FROM az_union_second_school_distcts WHERE gid = $gid;";
$sitesresult = pg_query($connection, $kmlgeomquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$geom = pg_result($sitesresult, $lt, 0);
}

$kmlbody .= $geom;
$kmlbody .= "</Placemark>";

$count++;
} // close if ($sitescount==0) {

} // close cd loop

// build csv file
$union1file = fopen("export/advancedsearch_unionschooldistrict1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union1file, ${'union1row_'.$i});
}

fclose($union1file); 

// create kml header with five thematic styles
$kmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns:geo=\"http://www.opengis.net/kml/2.2\">
<Document>
  <name>Arizona Afterschool Program Directory Sites by Secondary/Union School District</name>
  <description>Arizona Afterschool Program Directory Sites by Secondary/Union School District KML File</description>
	<Style id='Q1'><PolyStyle><color>afd9f0fe</color></PolyStyle></Style>
	<Style id='Q2'><PolyStyle><color>af8accfd</color></PolyStyle></Style>
	<Style id='Q3'><PolyStyle><color>af598dfc</color></PolyStyle></Style>
	<Style id='Q4'><PolyStyle><color>af334ae3</color></PolyStyle></Style>
	<Style id='Q5'><PolyStyle><color>af0000b3</color></PolyStyle></Style>
	  <ScreenOverlay>
	    <visibility>1</visibility>
	    <Icon>
	      <href>https://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
	    </Icon>
	    <overlayXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <screenXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <rotationXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <size x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	  </ScreenOverlay>
";

$kmlfooter = "
</Document>
</kml>
";

$kml = $kmlheader . $kmlbody . $kmlfooter;

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict1.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of School Year Sites</th>
		<th>Number of Summer Sites</th>
		<th>Number of Sites with Tutoring / Academic Enrichment as an Activity</th>
		<th>Number of Sites with Arts and Culture as an Activity</th>
		<th>Number of Sites with Sports and Recreation as an Activity</th>
		<th>Number of Sites with Volunteering / Community Service as an Activity</th>
		<th>Number of Sites with Character Education as an Activity</th>
		<th>Number of Sites with Leadership as an Activity</th>
		<th>Number of Sites with Nutrition as an Activity</th>
		<th>Number of Sites with Prevention as an Activity</th>
		<th>Number of Sites with Mentoring as an Activity</th>
		<th>Number of Sites with Support Services as an Activity</th>
		<th>Number of Sites with STEM as an Activity</th>
		<th>Number of Sites with College and Career Readiness as an Activity</th>
		<th>Number of Sites Serving Ages 5-8</th>
		<th>Number of Sites Serving Ages 9-11</th>
		<th>Number of Sites Serving Ages 12-14</th>
		<th>Number of Sites Serving Ages 15-18</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict1.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($union1=='t') {


// if by az cities is selected
if ($city1=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_cities AS g ON ST_Contains(g.the_geom, b.the_geom) GROUP BY g.gid;";
//echo $sitescountquery . '<br />';
$maxminsitesresult = pg_query($connection, $maxminsitescountquery);
$maxminsites = pg_fetch_all($maxminsitesresult);
$maxsites = max($maxminsites);
$maxsites = $maxsites['count'];
$minsites = min($maxminsites);
$minsites = $minsites['count'];
$difference = $maxsites - $minsites;
$diffonefifth = $difference/5;

// set up array for csv
$city1row_0 = array( );
$city1row_0[] = 'City Name';
$city1row_0[] = 'Number of Sites';
$city1row_0[] = 'Number of School Year Sites';
$city1row_0[] = 'Number of Summer Sites';
$city1row_0[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$city1row_0[] = 'Number of Sites with Arts and Culture as an Activity';
$city1row_0[] = 'Number of Sites with Sports and Recreation as an Activity';
$city1row_0[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$city1row_0[] = 'Number of Sites with Character Education as an Activity';
$city1row_0[] = 'Number of Sites with Leadership as an Activity';
$city1row_0[] = 'Number of Sites with Nutrition as an Activity';
$city1row_0[] = 'Number of Sites with Prevention as an Activity';
$city1row_0[] = 'Number of Sites with Mentoring as an Activity';
$city1row_0[] = 'Number of Sites with Support Services as an Activity';
$city1row_0[] = 'Number of Sites with STEM as an Activity';
$city1row_0[] = 'Number of Sites with College and Career Readiness as an Activity';
$city1row_0[] = 'Number of Sites Serving Ages 5-8';
$city1row_0[] = 'Number of Sites Serving Ages 9-11';
$city1row_0[] = 'Number of Sites Serving Ages 12-14';
$city1row_0[] = 'Number of Sites Serving Ages 15-18';


$count = 1;
$tablebody = '';
// loop through each category/geography to build body of table
$citiesquery = "SELECT gid, name10 FROM az_cities ORDER BY name10;";
$citiesresult = pg_query($connection, $citiesquery);
for ($citieslt = 0; $citieslt < pg_numrows($citiesresult); $citieslt++) {
	$gid = pg_result($citiesresult, $citieslt, 0);
	$name = pg_result($citiesresult, $citieslt, 1);

if ($citieswhere=='') {
	$citiesjoin = " JOIN az_cities AS g ON ST_Contains(g.the_geom, b.the_geom) ";
	$citieswherebycities = " (g.gid = $gid)";
	$and0 = "AND";
}elseif ($citieswhere!='') {
	${'citiesfilter'.$gid} = $_REQUEST["citiesfilter$gid"];
	if (${'citiesfilter'.$gid}=='t') {
		$citieswherebycities = " (g.gid = $gid)";
	}else{
		$citieswherebycities = " (g.gid = 999)";
	} // if (${'fundidfilter'.$fundid}=='t') {
}else{} // if ($wherefundid=='') {

// reset ands to beginning state
require('setands.php');


// ensure that and1 = AND if other where statements are in use
if ($azcongresswhere!='' || $statelegwhere!='' || $elemschooldistrictwhere!='' || $unionschooldistrictwhere!='') {
	$and4 = "AND";
}else{
	$and4 = '';
}

if ($whereactivity!='' || $whereages!='') {
	$and5 = "AND";
}else{
	$and5 = '';
}

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswherebycities . $and5 . $whereactivity . $and6 . $whereages;

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
//echo $sitescountquery . '<br />';
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($sitescount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($sitescount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($sitescount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city1row_'.$count} = array();
${'city1row_'.$count}[] = $name;
${'city1row_'.$count}[] = $sitescount;
${'city1row_'.$count}[] = $schoolyearsitescount;
${'city1row_'.$count}[] = $summersitescount;
${'city1row_'.$count}[] = $academicsitescount;
${'city1row_'.$count}[] = $artssitescount;
${'city1row_'.$count}[] = $sportssitescount;
${'city1row_'.$count}[] = $communitysitescount;
${'city1row_'.$count}[] = $charactersitescount;
${'city1row_'.$count}[] = $leadershipsitescount;
${'city1row_'.$count}[] = $nutritionsitescount;
${'city1row_'.$count}[] = $preventionsitescount;
${'city1row_'.$count}[] = $mentoringsitescount;
${'city1row_'.$count}[] = $supportservicessitescount;
${'city1row_'.$count}[] = $stemsitescount;
${'city1row_'.$count}[] = $collegesitescount;
${'city1row_'.$count}[] = $age5_8sitescount;
${'city1row_'.$count}[] = $age9_11sitescount;
${'city1row_'.$count}[] = $age12_14sitescount;
${'city1row_'.$count}[] = $age15_18sitescount;


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

// highlight odd rows
if ($count&1){
	$trclass = "<tr>";
}else{
	$trclass = "<tr class=\"alt\">";
}

$tablebody .= "
	$trclass
		<td>$name</td>
		<td align=\"right\">$sitescount</td>
		<td align=\"right\">$schoolyearsitescount</td>
		<td align=\"right\">$summersitescount</td>
		<td align=\"right\">$academicsitescount</td>
		<td align=\"right\">$artssitescount</td>
		<td align=\"right\">$sportssitescount</td>
		<td align=\"right\">$communitysitescount</td>
		<td align=\"right\">$charactersitescount</td>
		<td align=\"right\">$leadershipsitescount</td>
		<td align=\"right\">$nutritionsitescount</td>
		<td align=\"right\">$preventionsitescount</td>
		<td align=\"right\">$mentoringsitescount</td>
		<td align=\"right\">$supportservicessitescount</td>
		<td align=\"right\">$stemsitescount</td>
		<td align=\"right\">$collegesitescount</td>
		<td align=\"right\">$age5_8sitescount</td>
		<td align=\"right\">$age9_11sitescount</td>
		<td align=\"right\">$age12_14sitescount</td>
		<td align=\"right\">$age15_18sitescount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of School Year Sites: <b>$schoolyearsitescount</b><br />Number of Summer Sites: <b>$summersitescount</b><br />Number of Sites with Tutoring/Academic Enrichment as an Activity: <b>$academicsitescount</b><br />Number of Sites with Arts and Culture as an Activity: <b>$artssitescount</b><br />Number of Sites with Sports and Recreation as an Activity: <b>$sportssitescount</b><br />Number of Sites with Volunteering/Community Service as an Activity: <b>$communitysitescount</b><br />Number of Sites with Character Education as an Activity: <b>$charactersitescount</b><br />Number of Sites with Leadership as an Activity: <b>$leadershipsitescount</b><br />Number of Sites with Nutrition as an Activity: <b>$nutritionsitescount</b><br />Number of Sites with Prevention as an Activity: <b>$preventionsitescount</b><br />Number of Sites with Mentoring as an Activity: <b>$mentoringsitescount</b><br />Number of Sites with Support Services as an Activity: <b>$supportservicessitescount</b><br />Number of Sites with STEM as an Activity: <b>$stemsitescount</b><br />Number of Sites with College and Career Readiness as an Activity: <b>$collegesitescount</b><br />Number of Sites Serving Ages 5-8: <b>$age5_8sitescount</b><br />Number of Sites Serving Ages 9-11: <b>$age9_11sitescount</b><br />Number of Sites Serving Ages 12-14: <b>$age12_14sitescount</b><br />Number of Sites Serving Ages 15-18: <b>$age15_18sitescount<br />]]></description>";

// pull kml geometry
$kmlgeomquery = "SELECT ST_AsKML(the_geom) FROM az_cities WHERE gid = $gid;";
$sitesresult = pg_query($connection, $kmlgeomquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$geom = pg_result($sitesresult, $lt, 0);
}

$kmlbody .= $geom;
$kmlbody .= "</Placemark>";

$count++;
} // close if ($sitescount==0) {

} // close cd loop

// build csv file
$city1file = fopen("export/advancedsearch_cities1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city1file, ${'city1row_'.$i});
}

fclose($city1file); 

// create kml header with five thematic styles
$kmlheader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns:geo=\"http://www.opengis.net/kml/2.2\">
<Document>
  <name>Arizona Afterschool Program Directory Sites by City</name>
  <description>Arizona Afterschool Program Directory Sites by City KML File</description>
	<Style id='Q1'><PolyStyle><color>afd9f0fe</color></PolyStyle></Style>
	<Style id='Q2'><PolyStyle><color>af8accfd</color></PolyStyle></Style>
	<Style id='Q3'><PolyStyle><color>af598dfc</color></PolyStyle></Style>
	<Style id='Q4'><PolyStyle><color>af334ae3</color></PolyStyle></Style>
	<Style id='Q5'><PolyStyle><color>af0000b3</color></PolyStyle></Style>
	  <ScreenOverlay>
	    <visibility>1</visibility>
	    <Icon>
	      <href>https://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
	    </Icon>
	    <overlayXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <screenXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <rotationXY x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	    <size x=\"0\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
	  </ScreenOverlay>
";

$kmlfooter = "
</Document>
</kml>
";

$kml = $kmlheader . $kmlbody . $kmlfooter;

$locationkmlfile = fopen("export/advancedsearch_cities1.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of School Year Sites</th>
		<th>Number of Summer Sites</th>
		<th>Number of Sites with Tutoring / Academic Enrichment as an Activity</th>
		<th>Number of Sites with Arts and Culture as an Activity</th>
		<th>Number of Sites with Sports and Recreation as an Activity</th>
		<th>Number of Sites with Volunteering / Community Service as an Activity</th>
		<th>Number of Sites with Character Education as an Activity</th>
		<th>Number of Sites with Leadership as an Activity</th>
		<th>Number of Sites with Nutrition as an Activity</th>
		<th>Number of Sites with Prevention as an Activity</th>
		<th>Number of Sites with Mentoring as an Activity</th>
		<th>Number of Sites with Support Services as an Activity</th>
		<th>Number of Sites with STEM as an Activity</th>
		<th>Number of Sites with College and Career Readiness as an Activity</th>
		<th>Number of Sites Serving Ages 5-8</th>
		<th>Number of Sites Serving Ages 9-11</th>
		<th>Number of Sites Serving Ages 12-14</th>
		<th>Number of Sites Serving Ages 15-18</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities1.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($city1=='t') {


// if by activity is selected
if ($activity1=='t') {

// set up array for csv
$activity1row_0 = array( );
$activity1row_0[] = 'Activity';
$activity1row_0[] = 'Number of Sites';
$activity1row_0[] = 'Number of School Year Sites';
$activity1row_0[] = 'Number of Summer Sites';
$activity1row_0[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$activity1row_0[] = 'Number of Sites with Arts and Culture as an Activity';
$activity1row_0[] = 'Number of Sites with Sports and Recreation as an Activity';
$activity1row_0[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$activity1row_0[] = 'Number of Sites with Character Education as an Activity';
$activity1row_0[] = 'Number of Sites with Leadership as an Activity';
$activity1row_0[] = 'Number of Sites with Nutrition as an Activity';
$activity1row_0[] = 'Number of Sites with Prevention as an Activity';
$activity1row_0[] = 'Number of Sites with Mentoring as an Activity';
$activity1row_0[] = 'Number of Sites with Support Services as an Activity';
$activity1row_0[] = 'Number of Sites with STEM as an Activity';
$activity1row_0[] = 'Number of Sites with College and Career Readiness as an Activity';
$activity1row_0[] = 'Number of Sites Serving Ages 5-8';
$activity1row_0[] = 'Number of Sites Serving Ages 9-11';
$activity1row_0[] = 'Number of Sites Serving Ages 12-14';
$activity1row_0[] = 'Number of Sites Serving Ages 15-18';


$count = 1;
$tablebody = '';
// loop through each category/geography to build body of table

while ($count <= 12) {

// set activity name and set up where statement
if ($count==1) {
	$name = "Tutoring/Academic Enrichment";
	$whereactivitycount = " (a.academic = TRUE)";
}elseif ($count==2) {
	$name = "Arts and Culture";
	$whereactivitycount = " (a.arts = TRUE)";
}elseif ($count==3) {
	$name = "Sports and Recreation";
	$whereactivitycount = " (a.sports = TRUE)";
}elseif ($count==4) {
	$name = "Volunteering/Community Service";
	$whereactivitycount = " (a.community = TRUE)";
}elseif ($count==5) {
	$name = "Character Education";
	$whereactivitycount = " (a.character = TRUE)";
}elseif ($count==6) {
	$name = "Leadership";
	$whereactivitycount = " (a.leadership = TRUE)";
}elseif ($count==7) {
	$name = "Nutrition";
	$whereactivitycount = " (a.nutrition = TRUE)";
}elseif ($count==8) {
	$name = "Prevention";
	$whereactivitycount = " (a.prevention = TRUE)";
}elseif ($count==9) {
	$name = "Mentoring";
	$whereactivitycount = " (a.mentoring = TRUE)";
}elseif ($count==10) {
	$name = "Support Services (medical, dental, mental health, etc.)";
	$whereactivitycount = " (a.supportservices = TRUE)";
}elseif ($count==11) {
	$name = "Science, Technology, Engineering, and Mathematics";
	$whereactivitycount = " (a.stem = TRUE)";
}elseif ($count==12) {
	$name = "College and Career Readiness";
	$whereactivitycount = " (a.college = TRUE)";
}else{}


if ($whereactivity=='') {
	$whereactivitybyactivity = $whereactivitycount;
	$and0 = "AND";
}elseif ($whereactivity!='') {
	// see if this filter has been checked
	if ($count==1) {
		if ($academic=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.academic = NULL)";
		} 
	}elseif ($count==2) {
		if ($arts=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.arts = NULL)";
		} 
	}elseif ($count==3) {
		if ($sports=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.sports = NULL)";
		} 
	}elseif ($count==4) {
		if ($community=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.community = NULL)";
		} 
	}elseif ($count==5) {
		if ($character=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.character = NULL)";
		} 
	}elseif ($count==6) {
		if ($leadership=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.leadership = NULL)";
		} 
	}elseif ($count==7) {
		if ($nutrition=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.nutrition = NULL)";
		} 
	}elseif ($count==8) {
		if ($prevention=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.prevention = NULL)";
		} 
	}elseif ($count==9) {
		if ($mentoring=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.mentoring = NULL)";
		} 
	}elseif ($count==10) {
		if ($supportservices=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.supportservices = NULL)";
		} 
	}elseif ($count==11) {
		if ($stem=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.stem = NULL)";
		} 
	}elseif ($count==12) {
		if ($college=='t') {
			$whereactivitybyactivity = $whereactivitycount;
		}else{
			$whereactivitybyactivity = " (a.college = NULL)";
		} 
	}else{}

}else{} // if ($wherefundid=='') {

// reset ands to beginning state
require('setands.php');


// ensure that and1 = AND if other where statements are in use
if ($azcongresswhere!='' || $statelegwhere!='' || $elemschooldistrictwhere!='' || $unionschooldistrictwhere!='' || $citieswhere!='') {
	$and5 = "AND";
}else{
	$and5 = '';
}

if ($whereages!='') {
	$and6 = "AND";
}else{
	$and6 = '';
}

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivitybyactivity . $and6 . $whereages;

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
//echo $sitescountquery . '<br />';
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity1row_'.$count} = array();
${'activity1row_'.$count}[] = $name;
${'activity1row_'.$count}[] = $sitescount;
${'activity1row_'.$count}[] = $schoolyearsitescount;
${'activity1row_'.$count}[] = $summersitescount;
${'activity1row_'.$count}[] = $academicsitescount;
${'activity1row_'.$count}[] = $artssitescount;
${'activity1row_'.$count}[] = $sportssitescount;
${'activity1row_'.$count}[] = $communitysitescount;
${'activity1row_'.$count}[] = $charactersitescount;
${'activity1row_'.$count}[] = $leadershipsitescount;
${'activity1row_'.$count}[] = $nutritionsitescount;
${'activity1row_'.$count}[] = $preventionsitescount;
${'activity1row_'.$count}[] = $mentoringsitescount;
${'activity1row_'.$count}[] = $supportservicessitescount;
${'activity1row_'.$count}[] = $stemsitescount;
${'activity1row_'.$count}[] = $collegesitescount;
${'activity1row_'.$count}[] = $age5_8sitescount;
${'activity1row_'.$count}[] = $age9_11sitescount;
${'activity1row_'.$count}[] = $age12_14sitescount;
${'activity1row_'.$count}[] = $age15_18sitescount;


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

// highlight odd rows
if ($count&1){
	$trclass = "<tr>";
}else{
	$trclass = "<tr class=\"alt\">";
}

$tablebody .= "
	$trclass
		<td>$name</td>
		<td align=\"right\">$sitescount</td>
		<td align=\"right\">$schoolyearsitescount</td>
		<td align=\"right\">$summersitescount</td>
		<td align=\"right\">$academicsitescount</td>
		<td align=\"right\">$artssitescount</td>
		<td align=\"right\">$sportssitescount</td>
		<td align=\"right\">$communitysitescount</td>
		<td align=\"right\">$charactersitescount</td>
		<td align=\"right\">$leadershipsitescount</td>
		<td align=\"right\">$nutritionsitescount</td>
		<td align=\"right\">$preventionsitescount</td>
		<td align=\"right\">$mentoringsitescount</td>
		<td align=\"right\">$supportservicessitescount</td>
		<td align=\"right\">$stemsitescount</td>
		<td align=\"right\">$collegesitescount</td>
		<td align=\"right\">$age5_8sitescount</td>
		<td align=\"right\">$age9_11sitescount</td>
		<td align=\"right\">$age12_14sitescount</td>
		<td align=\"right\">$age15_18sitescount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity1file = fopen("export/advancedsearch_activity1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity1file, ${'activity1row_'.$i});
}

fclose($activity1file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of School Year Sites</th>
		<th>Number of Summer Sites</th>
		<th>Number of Sites with Tutoring / Academic Enrichment as an Activity</th>
		<th>Number of Sites with Arts and Culture as an Activity</th>
		<th>Number of Sites with Sports and Recreation as an Activity</th>
		<th>Number of Sites with Volunteering / Community Service as an Activity</th>
		<th>Number of Sites with Character Education as an Activity</th>
		<th>Number of Sites with Leadership as an Activity</th>
		<th>Number of Sites with Nutrition as an Activity</th>
		<th>Number of Sites with Prevention as an Activity</th>
		<th>Number of Sites with Mentoring as an Activity</th>
		<th>Number of Sites with Support Services as an Activity</th>
		<th>Number of Sites with STEM as an Activity</th>
		<th>Number of Sites with College and Career Readiness as an Activity</th>
		<th>Number of Sites Serving Ages 5-8</th>
		<th>Number of Sites Serving Ages 9-11</th>
		<th>Number of Sites Serving Ages 12-14</th>
		<th>Number of Sites Serving Ages 15-18</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($activity1=='t') {


// if by activity is selected
if ($ages1=='t') {

// set up array for csv
$ages1row_0 = array( );
$ages1row_0[] = 'Ages Served';
$ages1row_0[] = 'Number of Sites';
$ages1row_0[] = 'Number of School Year Sites';
$ages1row_0[] = 'Number of Summer Sites';
$ages1row_0[] = 'Number of Sites with Tutoring/Academic Enrichment as an Activity';
$ages1row_0[] = 'Number of Sites with Arts and Culture as an Activity';
$ages1row_0[] = 'Number of Sites with Sports and Recreation as an Activity';
$ages1row_0[] = 'Number of Sites with Volunteering/Community Service as an Activity';
$ages1row_0[] = 'Number of Sites with Character Education as an Activity';
$ages1row_0[] = 'Number of Sites with Leadership as an Activity';
$ages1row_0[] = 'Number of Sites with Nutrition as an Activity';
$ages1row_0[] = 'Number of Sites with Prevention as an Activity';
$ages1row_0[] = 'Number of Sites with Mentoring as an Activity';
$ages1row_0[] = 'Number of Sites with Support Services as an Activity';
$ages1row_0[] = 'Number of Sites with STEM as an Activity';
$ages1row_0[] = 'Number of Sites with College and Career Readiness as an Activity';
$ages1row_0[] = 'Number of Sites Serving Ages 5-8';
$ages1row_0[] = 'Number of Sites Serving Ages 9-11';
$ages1row_0[] = 'Number of Sites Serving Ages 12-14';
$ages1row_0[] = 'Number of Sites Serving Ages 15-18';


$count = 1;
$tablebody = '';
// loop through each category/geography to build body of table

while ($count <= 4) {

// set activity name and set up where statement
if ($count==1) {
	$name = "5-8";
	$whereagescount = " (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE)";
}elseif ($count==2) {
	$name = "9-11";
	$whereagescount = " (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE)";
}elseif ($count==3) {
	$name = "12-14";
	$whereagescount = " (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE)";
}elseif ($count==4) {
	$name = "15-18";
	$whereagescount = " (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE)";
}else{}


if ($whereages=='') {
	$whereagesbyages = $whereagescount;
	$and0 = "AND";
}elseif ($whereages!='') {
	// see if this filter has been checked
	if ($count==1) {
		if ($age5_8=='t') {
			$whereagesbyages = $whereagescount;
		}else{
			$whereagesbyages = " (a.age5 = NULL AND a.age6 = NULL AND a.age7 = NULL AND a.age8 = NULL)";
		} 
	}elseif ($count==2) {
		if ($age9_11=='t') {
			$whereagesbyages = $whereagescount;
		}else{
			$whereagesbyages = " (a.age9 = NULL AND a.age10 = NULL AND a.age11 = NULL)";
		} 
	}elseif ($count==3) {
		if ($age12_14=='t') {
			$whereagesbyages = $whereagescount;
		}else{
			$whereagesbyages = " (a.age12 = NULL AND a.age13 = NULL AND a.age14 = NULL)";
		} 
	}elseif ($count==4) {
		if ($age15_18=='t') {
			$whereagesbyages = $whereagescount;
		}else{
			$whereagesbyages = " (a.age15 = NULL AND a.age16 = NULL AND a.age17 = NULL AND a.age18 = NULL)";
		} 
	}else{}

}else{} // if ($wherefundid=='') {

// reset ands to beginning state
require('setands.php');


// ensure that and1 = AND if other where statements are in use
if ($azcongresswhere!='' || $statelegwhere!='' || $elemschooldistrictwhere!='' || $unionschooldistrictwhere!='' || $citieswhere!='' || $whereactivity!='') {
	$and6 = "AND";
}else{
	$and6 = '';
}


// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereagesbyages;

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
//echo $sitescountquery . '<br />';
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of school year sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = FALSE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$schoolyearsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of summer sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.summer = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$summersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of tutoring/academic enrichment sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.academic = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$academicsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Arts and Culture sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.arts = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$artssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Sports and Recreation sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.sports = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sportssitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Volunteering/Community Service sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.community = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$communitysitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Character Education sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.character = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$charactersitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Leadership sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.leadership = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$leadershipsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Nutrition sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.nutrition = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nutritionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Prevention sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.prevention = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$preventionsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Mentoring sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mentoring = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mentoringsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of Support Services sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.supportservices = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$supportservicessitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of STEM sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.stem = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$stemsitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of College and Career Readiness sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.college = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collegesitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 5-9 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age5 = TRUE OR a.age6 = TRUE OR a.age7 = TRUE OR a.age8 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age5_8sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 9-11 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age9 = TRUE OR a.age10 = TRUE OR a.age11 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age9_11sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 12-14 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age12 = TRUE OR a.age13 = TRUE OR a.age14 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age12_14sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of ages 15-18 sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND (a.age15 = TRUE OR a.age16 = TRUE OR a.age17 = TRUE OR a.age18 = TRUE);";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$age15_18sitescount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages1row_'.$count} = array();
${'ages1row_'.$count}[] = $name;
${'ages1row_'.$count}[] = $sitescount;
${'ages1row_'.$count}[] = $schoolyearsitescount;
${'ages1row_'.$count}[] = $summersitescount;
${'ages1row_'.$count}[] = $academicsitescount;
${'ages1row_'.$count}[] = $artssitescount;
${'ages1row_'.$count}[] = $sportssitescount;
${'ages1row_'.$count}[] = $communitysitescount;
${'ages1row_'.$count}[] = $charactersitescount;
${'ages1row_'.$count}[] = $leadershipsitescount;
${'ages1row_'.$count}[] = $nutritionsitescount;
${'ages1row_'.$count}[] = $preventionsitescount;
${'ages1row_'.$count}[] = $mentoringsitescount;
${'ages1row_'.$count}[] = $supportservicessitescount;
${'ages1row_'.$count}[] = $stemsitescount;
${'ages1row_'.$count}[] = $collegesitescount;
${'ages1row_'.$count}[] = $age5_8sitescount;
${'ages1row_'.$count}[] = $age9_11sitescount;
${'ages1row_'.$count}[] = $age12_14sitescount;
${'ages1row_'.$count}[] = $age15_18sitescount;


// clean up data for html
$sitescount = number_format($sitescount);
$schoolyearsitescount = number_format($schoolyearsitescount);
$summersitescount = number_format($summersitescount);
$academicsitescount = number_format($academicsitescount);
$artssitescount = number_format($artssitescount);
$sportssitescount = number_format($sportssitescount);
$communitysitescount = number_format($communitysitescount);
$charactersitescount = number_format($charactersitescount);
$leadershipsitescount = number_format($leadershipsitescount);
$nutritionsitescount = number_format($nutritionsitescount);
$preventionsitescount = number_format($preventionsitescount);
$mentoringsitescount = number_format($mentoringsitescount);
$supportservicessitescount = number_format($supportservicessitescount);
$stemsitescount = number_format($stemsitescount);
$collegesitescount = number_format($collegesitescount);
$age5_8sitescount = number_format($age5_8sitescount);
$age9_11sitescount = number_format($age9_11sitescount);
$age12_14sitescount = number_format($age12_14sitescount);
$age15_18sitescount = number_format($age15_18sitescount);

// highlight odd rows
if ($count&1){
	$trclass = "<tr>";
}else{
	$trclass = "<tr class=\"alt\">";
}

$tablebody .= "
	$trclass
		<td>$name</td>
		<td align=\"right\">$sitescount</td>
		<td align=\"right\">$schoolyearsitescount</td>
		<td align=\"right\">$summersitescount</td>
		<td align=\"right\">$academicsitescount</td>
		<td align=\"right\">$artssitescount</td>
		<td align=\"right\">$sportssitescount</td>
		<td align=\"right\">$communitysitescount</td>
		<td align=\"right\">$charactersitescount</td>
		<td align=\"right\">$leadershipsitescount</td>
		<td align=\"right\">$nutritionsitescount</td>
		<td align=\"right\">$preventionsitescount</td>
		<td align=\"right\">$mentoringsitescount</td>
		<td align=\"right\">$supportservicessitescount</td>
		<td align=\"right\">$stemsitescount</td>
		<td align=\"right\">$collegesitescount</td>
		<td align=\"right\">$age5_8sitescount</td>
		<td align=\"right\">$age9_11sitescount</td>
		<td align=\"right\">$age12_14sitescount</td>
		<td align=\"right\">$age15_18sitescount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages1file = fopen("export/advancedsearch_ages1.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages1file, ${'ages1row_'.$i});
}

fclose($ages1file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of School Year Sites</th>
		<th>Number of Summer Sites</th>
		<th>Number of Sites with Tutoring / Academic Enrichment as an Activity</th>
		<th>Number of Sites with Arts and Culture as an Activity</th>
		<th>Number of Sites with Sports and Recreation as an Activity</th>
		<th>Number of Sites with Volunteering / Community Service as an Activity</th>
		<th>Number of Sites with Character Education as an Activity</th>
		<th>Number of Sites with Leadership as an Activity</th>
		<th>Number of Sites with Nutrition as an Activity</th>
		<th>Number of Sites with Prevention as an Activity</th>
		<th>Number of Sites with Mentoring as an Activity</th>
		<th>Number of Sites with Support Services as an Activity</th>
		<th>Number of Sites with STEM as an Activity</th>
		<th>Number of Sites with College and Career Readiness as an Activity</th>
		<th>Number of Sites Serving Ages 5-8</th>
		<th>Number of Sites Serving Ages 9-11</th>
		<th>Number of Sites Serving Ages 12-14</th>
		<th>Number of Sites Serving Ages 15-18</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages1.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($ages1=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
