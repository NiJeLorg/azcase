<?php

$summary12 = $_REQUEST['summary12'];
$cd12 = $_REQUEST['cd12'];
$sld12 = $_REQUEST['sld12'];
$elm12 = $_REQUEST['elm12'];
$union12 = $_REQUEST['union12'];
$city12 = $_REQUEST['city12'];
$activity12 = $_REQUEST['activity12'];
$ages12 = $_REQUEST['ages12'];

if ($summary12=='t' || $cd12=='t' || $sld12=='t' || $elm12=='t' || $union12=='t' || $city12=='t' || $activity12=='t' || $ages12=='t') {

?>
<div class="clear"></div>
<h1>Staff Professional Development</h1>
<?
// if summary table is selected
if ($summary12=='t') {

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
<?
$summary12row_0 = array( );
$summary12row_0[] = 'Category';
$summary12row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}



// add data to csv
$summary12row_1 = array( );
$summary12row_1[] = 'Number of Sites';
$summary12row_1[] = $sitescount;
$summary12row_2 = array( );
$summary12row_2[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly';
$summary12row_2[] = $prodevelop1count;
$summary12row_3 = array( );
$summary12row_3[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$summary12row_3[] = $prodevelop2count;
$summary12row_4 = array( );
$summary12row_4[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually';
$summary12row_4[] = $prodevelop3count;
$summary12row_5 = array( );
$summary12row_5[] = 'Number of Sites that Provide Staff Training/Professional Development Annually';
$summary12row_5[] = $prodevelop4count;
$summary12row_6 = array( );
$summary12row_6[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$summary12row_6[] = $prodevelop5count;
$summary12row_7 = array( );
$summary12row_7[] = 'Average Hours of Training/Professional Development Provided';
$summary12row_7[] = $prodevelophoursavg;
$summary12row_8 = array( );
$summary12row_8[] = 'Number of Sites that Rank On-line Training First';
$summary12row_8[] = $prodevelop_rankmost11count;
$summary12row_9 = array( );
$summary12row_9[] = 'Number of Sites that Rank Workshops/Conferences First';
$summary12row_9[] = $prodevelop_rankmost12count;
$summary12row_10 = array( );
$summary12row_10[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$summary12row_10[] = $prodevelop_rankmost13count;
$summary12row_11 = array( );
$summary12row_11[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$summary12row_11[] = $prodevelop_rankmost14count;
$summary12row_12 = array( );
$summary12row_12[] = 'Number of Sites that Rank Supervision First';
$summary12row_12[] = $prodevelop_rankmost15count;
$summary12row_13 = array( );
$summary12row_13[] = 'Number of Sites that Rank On-line Training Second';
$summary12row_13[] = $prodevelop_rank21count;
$summary12row_14 = array( );
$summary12row_14[] = 'Number of Sites that Rank Workshops/Conferences Second';
$summary12row_14[] = $prodevelop_rank22count;
$summary12row_15 = array( );
$summary12row_15[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$summary12row_15[] = $prodevelop_rank23count;
$summary12row_16 = array( );
$summary12row_16[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$summary12row_16[] = $prodevelop_rank24count;
$summary12row_17 = array( );
$summary12row_17[] = 'Number of Sites that Rank Supervision Second';
$summary12row_17[] = $prodevelop_rank25count;
$summary12row_18 = array( );
$summary12row_18[] = 'Number of Sites that Rank On-line Training Third';
$summary12row_18[] = $prodevelop_rank31count;
$summary12row_19 = array( );
$summary12row_19[] = 'Number of Sites that Rank Workshops/Conferences Third';
$summary12row_19[] = $prodevelop_rank32count;
$summary12row_20 = array( );
$summary12row_20[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$summary12row_20[] = $prodevelop_rank33count;
$summary12row_21 = array( );
$summary12row_21[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$summary12row_21[] = $prodevelop_rank34count;
$summary12row_22 = array( );
$summary12row_22[] = 'Number of Sites that Rank Supervision Third';
$summary12row_22[] = $prodevelop_rank35count;
$summary12row_23 = array( );
$summary12row_23[] = 'Number of Sites that Rank On-line Training Fourth';
$summary12row_23[] = $prodevelop_rank41count;
$summary12row_24 = array( );
$summary12row_24[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$summary12row_24[] = $prodevelop_rank42count;
$summary12row_25 = array( );
$summary12row_25[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$summary12row_25[] = $prodevelop_rank43count;
$summary12row_26 = array( );
$summary12row_26[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$summary12row_26[] = $prodevelop_rank44count;
$summary12row_27 = array( );
$summary12row_27[] = 'Number of Sites that Rank Supervision Fourth';
$summary12row_27[] = $prodevelop_rank45count;
$summary12row_28 = array( );
$summary12row_28[] = 'Number of Sites that Rank On-line Training Last';
$summary12row_28[] = $prodevelop_rankleast51count;
$summary12row_29 = array( );
$summary12row_29[] = 'Number of Sites that Rank Workshops/Conferences Last';
$summary12row_29[] = $prodevelop_rankleast52count;
$summary12row_30 = array( );
$summary12row_30[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$summary12row_30[] = $prodevelop_rankleast53count;
$summary12row_31 = array( );
$summary12row_31[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$summary12row_31[] = $prodevelop_rankleast54count;
$summary12row_32 = array( );
$summary12row_32[] = 'Number of Sites that Rank Supervision Last';
$summary12row_32[] = $prodevelop_rankleast55count;

// build csv file
$summary12file = fopen("export/advancedsearch_summary12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 32; $i++) {
	fputcsv($summary12file, ${'summary12row_'.$i});
}

fclose($summary12file); 


// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Provide Staff Training/Professional Development Monthly</td>
		<td align="right"><?php echo $prodevelop1count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Provide Staff Training/Professional Development Quarterly</td>
		<td align="right"><?php echo $prodevelop2count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Provide Staff Training/Professional Development Semi-annually </td>
		<td align="right"><?php echo $prodevelop3count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Provide Staff Training/Professional Development Annually </td>
		<td align="right"><?php echo $prodevelop4count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</td>
		<td align="right"><?php echo $prodevelop5count; ?></td>
	</tr>
	<tr>
		<td>Average Hours of Training/Professional Development Provided</td>
		<td align="right"><?php echo $prodevelophoursavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank On-line Training First</td>
		<td align="right"><?php echo $prodevelop_rankmost11count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Workshops/Conferences First</td>
		<td align="right"><?php echo $prodevelop_rankmost12count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</td>
		<td align="right"><?php echo $prodevelop_rankmost13count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Peer to Peer Coaching First</td>
		<td align="right"><?php echo $prodevelop_rankmost14count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Supervision First</td>
		<td align="right"><?php echo $prodevelop_rankmost15count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank On-line Training Second</td>
		<td align="right"><?php echo $prodevelop_rank21count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Workshops/Conferences Second</td>
		<td align="right"><?php echo $prodevelop_rank22count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</td>
		<td align="right"><?php echo $prodevelop_rank23count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Peer to Peer Coaching Second</td>
		<td align="right"><?php echo $prodevelop_rank24count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Supervision Second</td>
		<td align="right"><?php echo $prodevelop_rank25count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank On-line Training Third</td>
		<td align="right"><?php echo $prodevelop_rank31count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Workshops/Conferences Third</td>
		<td align="right"><?php echo $prodevelop_rank32count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</td>
		<td align="right"><?php echo $prodevelop_rank33count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Peer to Peer Coaching Third</td>
		<td align="right"><?php echo $prodevelop_rank34count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Supervision Third</td>
		<td align="right"><?php echo $prodevelop_rank35count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank On-line Training Fourth</td>
		<td align="right"><?php echo $prodevelop_rank41count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Workshops/Conferences Fourth</td>
		<td align="right"><?php echo $prodevelop_rank42count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</td>
		<td align="right"><?php echo $prodevelop_rank43count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Peer to Peer Coaching Fourth</td>
		<td align="right"><?php echo $prodevelop_rank44count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Supervision Fourth</td>
		<td align="right"><?php echo $prodevelop_rank45count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank On-line Training Last</td>
		<td align="right"><?php echo $prodevelop_rankleast51count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Workshops/Conferences Last</td>
		<td align="right"><?php echo $prodevelop_rankleast52count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</td>
		<td align="right"><?php echo $prodevelop_rankleast53count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Rank Peer to Peer Coaching Last</td>
		<td align="right"><?php echo $prodevelop_rankleast54count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites that Rank Supervision Last</td>
		<td align="right"><?php echo $prodevelop_rankleast55count; ?></td>
	</tr>

</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd12=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT s.prodevelophours FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) GROUP BY c.gid;";
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
$cd12row_0 = array( );
$cd12row_0[] = 'Congressional District';
$cd12row_0[] = 'Number of Sites';
$cd12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly ';
$cd12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$cd12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually ';
$cd12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Annually ';
$cd12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$cd12row_0[] = 'Average Hours of Training/Professional Development Provided';
$cd12row_0[] = 'Number of Sites that Rank On-line Training First';
$cd12row_0[] = 'Number of Sites that Rank Workshops/Conferences First';
$cd12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$cd12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$cd12row_0[] = 'Number of Sites that Rank Supervision First';
$cd12row_0[] = 'Number of Sites that Rank On-line Training Second';
$cd12row_0[] = 'Number of Sites that Rank Workshops/Conferences Second';
$cd12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$cd12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$cd12row_0[] = 'Number of Sites that Rank Supervision Second';
$cd12row_0[] = 'Number of Sites that Rank On-line Training Third';
$cd12row_0[] = 'Number of Sites that Rank Workshops/Conferences Third';
$cd12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$cd12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$cd12row_0[] = 'Number of Sites that Rank Supervision Third';
$cd12row_0[] = 'Number of Sites that Rank On-line Training Fourth';
$cd12row_0[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$cd12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$cd12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$cd12row_0[] = 'Number of Sites that Rank Supervision Fourth';
$cd12row_0[] = 'Number of Sites that Rank On-line Training Last';
$cd12row_0[] = 'Number of Sites that Rank Workshops/Conferences Last';
$cd12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$cd12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$cd12row_0[] = 'Number of Sites that Rank Supervision Last';



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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($prodevelophoursavg <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($prodevelophoursavg <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd12row_'.$count} = array();
${'cd12row_'.$count}[] = $gid;
${'cd12row_'.$count}[] = $sitescount;
${'cd12row_'.$count}[] = $prodevelop1count;
${'cd12row_'.$count}[] = $prodevelop2count;
${'cd12row_'.$count}[] = $prodevelop3count;
${'cd12row_'.$count}[] = $prodevelop4count;
${'cd12row_'.$count}[] = $prodevelop5count;
${'cd12row_'.$count}[] = $prodevelophoursavg;
${'cd12row_'.$count}[] = $prodevelop_rankmost11count;
${'cd12row_'.$count}[] = $prodevelop_rankmost12count;
${'cd12row_'.$count}[] = $prodevelop_rankmost13count;
${'cd12row_'.$count}[] = $prodevelop_rankmost14count;
${'cd12row_'.$count}[] = $prodevelop_rankmost15count;
${'cd12row_'.$count}[] = $prodevelop_rank21count;
${'cd12row_'.$count}[] = $prodevelop_rank22count;
${'cd12row_'.$count}[] = $prodevelop_rank23count;
${'cd12row_'.$count}[] = $prodevelop_rank24count;
${'cd12row_'.$count}[] = $prodevelop_rank25count;
${'cd12row_'.$count}[] = $prodevelop_rank31count;
${'cd12row_'.$count}[] = $prodevelop_rank32count;
${'cd12row_'.$count}[] = $prodevelop_rank33count;
${'cd12row_'.$count}[] = $prodevelop_rank34count;
${'cd12row_'.$count}[] = $prodevelop_rank35count;
${'cd12row_'.$count}[] = $prodevelop_rank41count;
${'cd12row_'.$count}[] = $prodevelop_rank42count;
${'cd12row_'.$count}[] = $prodevelop_rank43count;
${'cd12row_'.$count}[] = $prodevelop_rank44count;
${'cd12row_'.$count}[] = $prodevelop_rank45count;
${'cd12row_'.$count}[] = $prodevelop_rankleast51count;
${'cd12row_'.$count}[] = $prodevelop_rankleast52count;
${'cd12row_'.$count}[] = $prodevelop_rankleast53count;
${'cd12row_'.$count}[] = $prodevelop_rankleast54count;
${'cd12row_'.$count}[] = $prodevelop_rankleast55count;



// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

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
		<td align=\"right\">$prodevelop1count</td>
		<td align=\"right\">$prodevelop2count</td>
		<td align=\"right\">$prodevelop3count</td>
		<td align=\"right\">$prodevelop4count</td>
		<td align=\"right\">$prodevelop5count</td>
		<td align=\"right\">$prodevelophoursavg</td>
		<td align=\"right\">$prodevelop_rankmost11count</td>
		<td align=\"right\">$prodevelop_rankmost12count</td>
		<td align=\"right\">$prodevelop_rankmost13count</td>
		<td align=\"right\">$prodevelop_rankmost14count</td>
		<td align=\"right\">$prodevelop_rankmost15count</td>
		<td align=\"right\">$prodevelop_rank21count</td>
		<td align=\"right\">$prodevelop_rank22count</td>
		<td align=\"right\">$prodevelop_rank23count</td>
		<td align=\"right\">$prodevelop_rank24count</td>
		<td align=\"right\">$prodevelop_rank25count</td>
		<td align=\"right\">$prodevelop_rank31count</td>
		<td align=\"right\">$prodevelop_rank32count</td>
		<td align=\"right\">$prodevelop_rank33count</td>
		<td align=\"right\">$prodevelop_rank34count</td>
		<td align=\"right\">$prodevelop_rank35count</td>
		<td align=\"right\">$prodevelop_rank41count</td>
		<td align=\"right\">$prodevelop_rank42count</td>
		<td align=\"right\">$prodevelop_rank43count</td>
		<td align=\"right\">$prodevelop_rank44count</td>
		<td align=\"right\">$prodevelop_rank45count</td>
		<td align=\"right\">$prodevelop_rankleast51count</td>
		<td align=\"right\">$prodevelop_rankleast52count</td>
		<td align=\"right\">$prodevelop_rankleast53count</td>
		<td align=\"right\">$prodevelop_rankleast54count</td>
		<td align=\"right\">$prodevelop_rankleast55count</td>

	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites that Provide Staff Training/Professional Development Monthly : <b>$prodevelop1count</b><br />Number of Sites that Provide Staff Training/Professional Development Quarterly: <b>$prodevelop2count</b><br />Number of Sites that Provide Staff Training/Professional Development Semi-annually : <b>$prodevelop3count</b><br />Number of Sites that Provide Staff Training/Professional Development Annually : <b>$prodevelop4count</b><br />Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year: <b>$prodevelop5count</b><br />Average Hours of Training/Professional Development Provided: <b>$prodevelophoursavg</b><br />Number of Sites that Rank On-line Training First: <b>$prodevelop_rankmost11count</b><br />Number of Sites that Rank Workshops/Conferences First: <b>$prodevelop_rankmost12count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter First: <b>$prodevelop_rankmost13count</b><br />Number of Sites that Rank Peer to Peer Coaching First: <b>$prodevelop_rankmost14count</b><br />Number of Sites that Rank Supervision First: <b>$prodevelop_rankmost15count</b><br />Number of Sites that Rank On-line Training Second: <b>$prodevelop_rank21count</b><br />Number of Sites that Rank Workshops/Conferences Second: <b>$prodevelop_rank22count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second: <b>$prodevelop_rank23count</b><br />Number of Sites that Rank Peer to Peer Coaching Second: <b>$prodevelop_rank24count</b><br />Number of Sites that Rank Supervision Second: <b>$prodevelop_rank25count</b><br />Number of Sites that Rank On-line Training Third: <b>$prodevelop_rank31count</b><br />Number of Sites that Rank Workshops/Conferences Third: <b>$prodevelop_rank32count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third: <b>$prodevelop_rank33count</b><br />Number of Sites that Rank Peer to Peer Coaching Third: <b>$prodevelop_rank34count</b><br />Number of Sites that Rank Supervision Third: <b>$prodevelop_rank35count</b><br />Number of Sites that Rank On-line Training Fourth: <b>$prodevelop_rank41count</b><br />Number of Sites that Rank Workshops/Conferences Fourth: <b>$prodevelop_rank42count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth: <b>$prodevelop_rank43count</b><br />Number of Sites that Rank Peer to Peer Coaching Fourth: <b>$prodevelop_rank44count</b><br />Number of Sites that Rank Supervision Fourth: <b>$prodevelop_rank45count</b><br />Number of Sites that Rank On-line Training Last: <b>$prodevelop_rankleast51count</b><br />Number of Sites that Rank Workshops/Conferences Last: <b>$prodevelop_rankleast52count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last: <b>$prodevelop_rankleast53count</b><br />Number of Sites that Rank Peer to Peer Coaching Last: <b>$prodevelop_rankleast54count</b><br />Number of Sites that Rank Supervision Last: <b>$prodevelop_rankleast55count</b><br />]]></description>";


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
$cd12file = fopen("export/advancedsearch_congressionaldistrict12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd12file, ${'cd12row_'.$i});
}

fclose($cd12file); 


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
	      <href>http://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict12.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Monthly </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Quarterly</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Semi-annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</th>
		<th>Average Hours of Training/Professional Development Provided</th>
		<th>Number of Sites that Rank On-line Training First</th>
		<th>Number of Sites that Rank Workshops/Conferences First</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</th>
		<th>Number of Sites that Rank Peer to Peer Coaching First</th>
		<th>Number of Sites that Rank Supervision First</th>
		<th>Number of Sites that Rank On-line Training Second</th>
		<th>Number of Sites that Rank Workshops/Conferences Second</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Second</th>
		<th>Number of Sites that Rank Supervision Second</th>
		<th>Number of Sites that Rank On-line Training Third</th>
		<th>Number of Sites that Rank Workshops/Conferences Third</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Third</th>
		<th>Number of Sites that Rank Supervision Third</th>
		<th>Number of Sites that Rank On-line Training Fourth</th>
		<th>Number of Sites that Rank Workshops/Conferences Fourth</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Fourth</th>
		<th>Number of Sites that Rank Supervision Fourth</th>
		<th>Number of Sites that Rank On-line Training Last</th>
		<th>Number of Sites that Rank Workshops/Conferences Last</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Last</th>
		<th>Number of Sites that Rank Supervision Last</th>
	
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict12.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?

}else{} // if ($cd12=='t') {


// if by state legislative districts is selected
if ($sld12=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT s.prodevelophours FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) GROUP BY c.gid;";
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
$sld12row_0 = array( );
$sld12row_0[] = 'State Legislaltive District';
$sld12row_0[] = 'Number of Sites';
$sld12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly ';
$sld12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$sld12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually ';
$sld12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Annually ';
$sld12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$sld12row_0[] = 'Average Hours of Training/Professional Development Provided';
$sld12row_0[] = 'Number of Sites that Rank On-line Training First';
$sld12row_0[] = 'Number of Sites that Rank Workshops/Conferences First';
$sld12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$sld12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$sld12row_0[] = 'Number of Sites that Rank Supervision First';
$sld12row_0[] = 'Number of Sites that Rank On-line Training Second';
$sld12row_0[] = 'Number of Sites that Rank Workshops/Conferences Second';
$sld12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$sld12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$sld12row_0[] = 'Number of Sites that Rank Supervision Second';
$sld12row_0[] = 'Number of Sites that Rank On-line Training Third';
$sld12row_0[] = 'Number of Sites that Rank Workshops/Conferences Third';
$sld12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$sld12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$sld12row_0[] = 'Number of Sites that Rank Supervision Third';
$sld12row_0[] = 'Number of Sites that Rank On-line Training Fourth';
$sld12row_0[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$sld12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$sld12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$sld12row_0[] = 'Number of Sites that Rank Supervision Fourth';
$sld12row_0[] = 'Number of Sites that Rank On-line Training Last';
$sld12row_0[] = 'Number of Sites that Rank Workshops/Conferences Last';
$sld12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$sld12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$sld12row_0[] = 'Number of Sites that Rank Supervision Last';

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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($prodevelophoursavg <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($prodevelophoursavg <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld12row_'.$count} = array();
${'sld12row_'.$count}[] = $gid;
${'sld12row_'.$count}[] = $sitescount;
${'sld12row_'.$count}[] = $prodevelop1count;
${'sld12row_'.$count}[] = $prodevelop2count;
${'sld12row_'.$count}[] = $prodevelop3count;
${'sld12row_'.$count}[] = $prodevelop4count;
${'sld12row_'.$count}[] = $prodevelop5count;
${'sld12row_'.$count}[] = $prodevelophoursavg;
${'sld12row_'.$count}[] = $prodevelop_rankmost11count;
${'sld12row_'.$count}[] = $prodevelop_rankmost12count;
${'sld12row_'.$count}[] = $prodevelop_rankmost13count;
${'sld12row_'.$count}[] = $prodevelop_rankmost14count;
${'sld12row_'.$count}[] = $prodevelop_rankmost15count;
${'sld12row_'.$count}[] = $prodevelop_rank21count;
${'sld12row_'.$count}[] = $prodevelop_rank22count;
${'sld12row_'.$count}[] = $prodevelop_rank23count;
${'sld12row_'.$count}[] = $prodevelop_rank24count;
${'sld12row_'.$count}[] = $prodevelop_rank25count;
${'sld12row_'.$count}[] = $prodevelop_rank31count;
${'sld12row_'.$count}[] = $prodevelop_rank32count;
${'sld12row_'.$count}[] = $prodevelop_rank33count;
${'sld12row_'.$count}[] = $prodevelop_rank34count;
${'sld12row_'.$count}[] = $prodevelop_rank35count;
${'sld12row_'.$count}[] = $prodevelop_rank41count;
${'sld12row_'.$count}[] = $prodevelop_rank42count;
${'sld12row_'.$count}[] = $prodevelop_rank43count;
${'sld12row_'.$count}[] = $prodevelop_rank44count;
${'sld12row_'.$count}[] = $prodevelop_rank45count;
${'sld12row_'.$count}[] = $prodevelop_rankleast51count;
${'sld12row_'.$count}[] = $prodevelop_rankleast52count;
${'sld12row_'.$count}[] = $prodevelop_rankleast53count;
${'sld12row_'.$count}[] = $prodevelop_rankleast54count;
${'sld12row_'.$count}[] = $prodevelop_rankleast55count;


// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

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
		<td align=\"right\">$prodevelop1count</td>
		<td align=\"right\">$prodevelop2count</td>
		<td align=\"right\">$prodevelop3count</td>
		<td align=\"right\">$prodevelop4count</td>
		<td align=\"right\">$prodevelop5count</td>
		<td align=\"right\">$prodevelophoursavg</td>
		<td align=\"right\">$prodevelop_rankmost11count</td>
		<td align=\"right\">$prodevelop_rankmost12count</td>
		<td align=\"right\">$prodevelop_rankmost13count</td>
		<td align=\"right\">$prodevelop_rankmost14count</td>
		<td align=\"right\">$prodevelop_rankmost15count</td>
		<td align=\"right\">$prodevelop_rank21count</td>
		<td align=\"right\">$prodevelop_rank22count</td>
		<td align=\"right\">$prodevelop_rank23count</td>
		<td align=\"right\">$prodevelop_rank24count</td>
		<td align=\"right\">$prodevelop_rank25count</td>
		<td align=\"right\">$prodevelop_rank31count</td>
		<td align=\"right\">$prodevelop_rank32count</td>
		<td align=\"right\">$prodevelop_rank33count</td>
		<td align=\"right\">$prodevelop_rank34count</td>
		<td align=\"right\">$prodevelop_rank35count</td>
		<td align=\"right\">$prodevelop_rank41count</td>
		<td align=\"right\">$prodevelop_rank42count</td>
		<td align=\"right\">$prodevelop_rank43count</td>
		<td align=\"right\">$prodevelop_rank44count</td>
		<td align=\"right\">$prodevelop_rank45count</td>
		<td align=\"right\">$prodevelop_rankleast51count</td>
		<td align=\"right\">$prodevelop_rankleast52count</td>
		<td align=\"right\">$prodevelop_rankleast53count</td>
		<td align=\"right\">$prodevelop_rankleast54count</td>
		<td align=\"right\">$prodevelop_rankleast55count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites that Provide Staff Training/Professional Development Monthly : <b>$prodevelop1count</b><br />Number of Sites that Provide Staff Training/Professional Development Quarterly: <b>$prodevelop2count</b><br />Number of Sites that Provide Staff Training/Professional Development Semi-annually : <b>$prodevelop3count</b><br />Number of Sites that Provide Staff Training/Professional Development Annually : <b>$prodevelop4count</b><br />Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year: <b>$prodevelop5count</b><br />Average Hours of Training/Professional Development Provided: <b>$prodevelophoursavg</b><br />Number of Sites that Rank On-line Training First: <b>$prodevelop_rankmost11count</b><br />Number of Sites that Rank Workshops/Conferences First: <b>$prodevelop_rankmost12count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter First: <b>$prodevelop_rankmost13count</b><br />Number of Sites that Rank Peer to Peer Coaching First: <b>$prodevelop_rankmost14count</b><br />Number of Sites that Rank Supervision First: <b>$prodevelop_rankmost15count</b><br />Number of Sites that Rank On-line Training Second: <b>$prodevelop_rank21count</b><br />Number of Sites that Rank Workshops/Conferences Second: <b>$prodevelop_rank22count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second: <b>$prodevelop_rank23count</b><br />Number of Sites that Rank Peer to Peer Coaching Second: <b>$prodevelop_rank24count</b><br />Number of Sites that Rank Supervision Second: <b>$prodevelop_rank25count</b><br />Number of Sites that Rank On-line Training Third: <b>$prodevelop_rank31count</b><br />Number of Sites that Rank Workshops/Conferences Third: <b>$prodevelop_rank32count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third: <b>$prodevelop_rank33count</b><br />Number of Sites that Rank Peer to Peer Coaching Third: <b>$prodevelop_rank34count</b><br />Number of Sites that Rank Supervision Third: <b>$prodevelop_rank35count</b><br />Number of Sites that Rank On-line Training Fourth: <b>$prodevelop_rank41count</b><br />Number of Sites that Rank Workshops/Conferences Fourth: <b>$prodevelop_rank42count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth: <b>$prodevelop_rank43count</b><br />Number of Sites that Rank Peer to Peer Coaching Fourth: <b>$prodevelop_rank44count</b><br />Number of Sites that Rank Supervision Fourth: <b>$prodevelop_rank45count</b><br />Number of Sites that Rank On-line Training Last: <b>$prodevelop_rankleast51count</b><br />Number of Sites that Rank Workshops/Conferences Last: <b>$prodevelop_rankleast52count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last: <b>$prodevelop_rankleast53count</b><br />Number of Sites that Rank Peer to Peer Coaching Last: <b>$prodevelop_rankleast54count</b><br />Number of Sites that Rank Supervision Last: <b>$prodevelop_rankleast55count</b><br />]]></description>";

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
$sld12file = fopen("export/advancedsearch_statelegislativedistrict12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld12file, ${'sld12row_'.$i});
}

fclose($sld12file); 

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
	      <href>http://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict12.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Monthly </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Quarterly</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Semi-annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</th>
		<th>Average Hours of Training/Professional Development Provided</th>
		<th>Number of Sites that Rank On-line Training First</th>
		<th>Number of Sites that Rank Workshops/Conferences First</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</th>
		<th>Number of Sites that Rank Peer to Peer Coaching First</th>
		<th>Number of Sites that Rank Supervision First</th>
		<th>Number of Sites that Rank On-line Training Second</th>
		<th>Number of Sites that Rank Workshops/Conferences Second</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Second</th>
		<th>Number of Sites that Rank Supervision Second</th>
		<th>Number of Sites that Rank On-line Training Third</th>
		<th>Number of Sites that Rank Workshops/Conferences Third</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Third</th>
		<th>Number of Sites that Rank Supervision Third</th>
		<th>Number of Sites that Rank On-line Training Fourth</th>
		<th>Number of Sites that Rank Workshops/Conferences Fourth</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Fourth</th>
		<th>Number of Sites that Rank Supervision Fourth</th>
		<th>Number of Sites that Rank On-line Training Last</th>
		<th>Number of Sites that Rank Workshops/Conferences Last</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Last</th>
		<th>Number of Sites that Rank Supervision Last</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict12.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($sld12=='t') {


// if by elementary school distircts is selected
if ($elm12=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT s.prodevelophours FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) GROUP BY c.gid;";
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
$elm12row_0 = array( );
$elm12row_0[] = 'Elementary School District Name';
$elm12row_0[] = 'Number of Sites';
$elm12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly ';
$elm12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$elm12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually ';
$elm12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Annually ';
$elm12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$elm12row_0[] = 'Average Hours of Training/Professional Development Provided';
$elm12row_0[] = 'Number of Sites that Rank On-line Training First';
$elm12row_0[] = 'Number of Sites that Rank Workshops/Conferences First';
$elm12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$elm12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$elm12row_0[] = 'Number of Sites that Rank Supervision First';
$elm12row_0[] = 'Number of Sites that Rank On-line Training Second';
$elm12row_0[] = 'Number of Sites that Rank Workshops/Conferences Second';
$elm12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$elm12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$elm12row_0[] = 'Number of Sites that Rank Supervision Second';
$elm12row_0[] = 'Number of Sites that Rank On-line Training Third';
$elm12row_0[] = 'Number of Sites that Rank Workshops/Conferences Third';
$elm12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$elm12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$elm12row_0[] = 'Number of Sites that Rank Supervision Third';
$elm12row_0[] = 'Number of Sites that Rank On-line Training Fourth';
$elm12row_0[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$elm12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$elm12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$elm12row_0[] = 'Number of Sites that Rank Supervision Fourth';
$elm12row_0[] = 'Number of Sites that Rank On-line Training Last';
$elm12row_0[] = 'Number of Sites that Rank Workshops/Conferences Last';
$elm12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$elm12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$elm12row_0[] = 'Number of Sites that Rank Supervision Last';


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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($prodevelophoursavg <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($prodevelophoursavg <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm12row_'.$count} = array();
${'elm12row_'.$count}[] = $name;
${'elm12row_'.$count}[] = $sitescount;
${'elm12row_'.$count}[] = $prodevelop1count;
${'elm12row_'.$count}[] = $prodevelop2count;
${'elm12row_'.$count}[] = $prodevelop3count;
${'elm12row_'.$count}[] = $prodevelop4count;
${'elm12row_'.$count}[] = $prodevelop5count;
${'elm12row_'.$count}[] = $prodevelophoursavg;
${'elm12row_'.$count}[] = $prodevelop_rankmost11count;
${'elm12row_'.$count}[] = $prodevelop_rankmost12count;
${'elm12row_'.$count}[] = $prodevelop_rankmost13count;
${'elm12row_'.$count}[] = $prodevelop_rankmost14count;
${'elm12row_'.$count}[] = $prodevelop_rankmost15count;
${'elm12row_'.$count}[] = $prodevelop_rank21count;
${'elm12row_'.$count}[] = $prodevelop_rank22count;
${'elm12row_'.$count}[] = $prodevelop_rank23count;
${'elm12row_'.$count}[] = $prodevelop_rank24count;
${'elm12row_'.$count}[] = $prodevelop_rank25count;
${'elm12row_'.$count}[] = $prodevelop_rank31count;
${'elm12row_'.$count}[] = $prodevelop_rank32count;
${'elm12row_'.$count}[] = $prodevelop_rank33count;
${'elm12row_'.$count}[] = $prodevelop_rank34count;
${'elm12row_'.$count}[] = $prodevelop_rank35count;
${'elm12row_'.$count}[] = $prodevelop_rank41count;
${'elm12row_'.$count}[] = $prodevelop_rank42count;
${'elm12row_'.$count}[] = $prodevelop_rank43count;
${'elm12row_'.$count}[] = $prodevelop_rank44count;
${'elm12row_'.$count}[] = $prodevelop_rank45count;
${'elm12row_'.$count}[] = $prodevelop_rankleast51count;
${'elm12row_'.$count}[] = $prodevelop_rankleast52count;
${'elm12row_'.$count}[] = $prodevelop_rankleast53count;
${'elm12row_'.$count}[] = $prodevelop_rankleast54count;
${'elm12row_'.$count}[] = $prodevelop_rankleast55count;


// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

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
		<td align=\"right\">$prodevelop1count</td>
		<td align=\"right\">$prodevelop2count</td>
		<td align=\"right\">$prodevelop3count</td>
		<td align=\"right\">$prodevelop4count</td>
		<td align=\"right\">$prodevelop5count</td>
		<td align=\"right\">$prodevelophoursavg</td>
		<td align=\"right\">$prodevelop_rankmost11count</td>
		<td align=\"right\">$prodevelop_rankmost12count</td>
		<td align=\"right\">$prodevelop_rankmost13count</td>
		<td align=\"right\">$prodevelop_rankmost14count</td>
		<td align=\"right\">$prodevelop_rankmost15count</td>
		<td align=\"right\">$prodevelop_rank21count</td>
		<td align=\"right\">$prodevelop_rank22count</td>
		<td align=\"right\">$prodevelop_rank23count</td>
		<td align=\"right\">$prodevelop_rank24count</td>
		<td align=\"right\">$prodevelop_rank25count</td>
		<td align=\"right\">$prodevelop_rank31count</td>
		<td align=\"right\">$prodevelop_rank32count</td>
		<td align=\"right\">$prodevelop_rank33count</td>
		<td align=\"right\">$prodevelop_rank34count</td>
		<td align=\"right\">$prodevelop_rank35count</td>
		<td align=\"right\">$prodevelop_rank41count</td>
		<td align=\"right\">$prodevelop_rank42count</td>
		<td align=\"right\">$prodevelop_rank43count</td>
		<td align=\"right\">$prodevelop_rank44count</td>
		<td align=\"right\">$prodevelop_rank45count</td>
		<td align=\"right\">$prodevelop_rankleast51count</td>
		<td align=\"right\">$prodevelop_rankleast52count</td>
		<td align=\"right\">$prodevelop_rankleast53count</td>
		<td align=\"right\">$prodevelop_rankleast54count</td>
		<td align=\"right\">$prodevelop_rankleast55count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites that Provide Staff Training/Professional Development Monthly : <b>$prodevelop1count</b><br />Number of Sites that Provide Staff Training/Professional Development Quarterly: <b>$prodevelop2count</b><br />Number of Sites that Provide Staff Training/Professional Development Semi-annually : <b>$prodevelop3count</b><br />Number of Sites that Provide Staff Training/Professional Development Annually : <b>$prodevelop4count</b><br />Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year: <b>$prodevelop5count</b><br />Average Hours of Training/Professional Development Provided: <b>$prodevelophoursavg</b><br />Number of Sites that Rank On-line Training First: <b>$prodevelop_rankmost11count</b><br />Number of Sites that Rank Workshops/Conferences First: <b>$prodevelop_rankmost12count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter First: <b>$prodevelop_rankmost13count</b><br />Number of Sites that Rank Peer to Peer Coaching First: <b>$prodevelop_rankmost14count</b><br />Number of Sites that Rank Supervision First: <b>$prodevelop_rankmost15count</b><br />Number of Sites that Rank On-line Training Second: <b>$prodevelop_rank21count</b><br />Number of Sites that Rank Workshops/Conferences Second: <b>$prodevelop_rank22count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second: <b>$prodevelop_rank23count</b><br />Number of Sites that Rank Peer to Peer Coaching Second: <b>$prodevelop_rank24count</b><br />Number of Sites that Rank Supervision Second: <b>$prodevelop_rank25count</b><br />Number of Sites that Rank On-line Training Third: <b>$prodevelop_rank31count</b><br />Number of Sites that Rank Workshops/Conferences Third: <b>$prodevelop_rank32count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third: <b>$prodevelop_rank33count</b><br />Number of Sites that Rank Peer to Peer Coaching Third: <b>$prodevelop_rank34count</b><br />Number of Sites that Rank Supervision Third: <b>$prodevelop_rank35count</b><br />Number of Sites that Rank On-line Training Fourth: <b>$prodevelop_rank41count</b><br />Number of Sites that Rank Workshops/Conferences Fourth: <b>$prodevelop_rank42count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth: <b>$prodevelop_rank43count</b><br />Number of Sites that Rank Peer to Peer Coaching Fourth: <b>$prodevelop_rank44count</b><br />Number of Sites that Rank Supervision Fourth: <b>$prodevelop_rank45count</b><br />Number of Sites that Rank On-line Training Last: <b>$prodevelop_rankleast51count</b><br />Number of Sites that Rank Workshops/Conferences Last: <b>$prodevelop_rankleast52count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last: <b>$prodevelop_rankleast53count</b><br />Number of Sites that Rank Peer to Peer Coaching Last: <b>$prodevelop_rankleast54count</b><br />Number of Sites that Rank Supervision Last: <b>$prodevelop_rankleast55count</b><br />]]></description>";

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
$elm12file = fopen("export/advancedsearch_elementaryschooldistrict12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm12file, ${'elm12row_'.$i});
}

fclose($elm12file); 

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
	      <href>http://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict12.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Monthly </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Quarterly</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Semi-annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</th>
		<th>Average Hours of Training/Professional Development Provided</th>
		<th>Number of Sites that Rank On-line Training First</th>
		<th>Number of Sites that Rank Workshops/Conferences First</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</th>
		<th>Number of Sites that Rank Peer to Peer Coaching First</th>
		<th>Number of Sites that Rank Supervision First</th>
		<th>Number of Sites that Rank On-line Training Second</th>
		<th>Number of Sites that Rank Workshops/Conferences Second</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Second</th>
		<th>Number of Sites that Rank Supervision Second</th>
		<th>Number of Sites that Rank On-line Training Third</th>
		<th>Number of Sites that Rank Workshops/Conferences Third</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Third</th>
		<th>Number of Sites that Rank Supervision Third</th>
		<th>Number of Sites that Rank On-line Training Fourth</th>
		<th>Number of Sites that Rank Workshops/Conferences Fourth</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Fourth</th>
		<th>Number of Sites that Rank Supervision Fourth</th>
		<th>Number of Sites that Rank On-line Training Last</th>
		<th>Number of Sites that Rank Workshops/Conferences Last</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Last</th>
		<th>Number of Sites that Rank Supervision Last</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict12.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($elm12=='t') {


// if by By Secondary/Union School District is selected
if ($union12=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT s.prodevelophours FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) GROUP BY c.gid;";
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
$union12row_0 = array( );
$union12row_0[] = 'Secondary/Union School District Name';
$union12row_0[] = 'Number of Sites';
$union12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly ';
$union12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$union12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually ';
$union12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Annually ';
$union12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$union12row_0[] = 'Average Hours of Training/Professional Development Provided';
$union12row_0[] = 'Number of Sites that Rank On-line Training First';
$union12row_0[] = 'Number of Sites that Rank Workshops/Conferences First';
$union12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$union12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$union12row_0[] = 'Number of Sites that Rank Supervision First';
$union12row_0[] = 'Number of Sites that Rank On-line Training Second';
$union12row_0[] = 'Number of Sites that Rank Workshops/Conferences Second';
$union12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$union12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$union12row_0[] = 'Number of Sites that Rank Supervision Second';
$union12row_0[] = 'Number of Sites that Rank On-line Training Third';
$union12row_0[] = 'Number of Sites that Rank Workshops/Conferences Third';
$union12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$union12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$union12row_0[] = 'Number of Sites that Rank Supervision Third';
$union12row_0[] = 'Number of Sites that Rank On-line Training Fourth';
$union12row_0[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$union12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$union12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$union12row_0[] = 'Number of Sites that Rank Supervision Fourth';
$union12row_0[] = 'Number of Sites that Rank On-line Training Last';
$union12row_0[] = 'Number of Sites that Rank Workshops/Conferences Last';
$union12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$union12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$union12row_0[] = 'Number of Sites that Rank Supervision Last';


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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($prodevelophoursavg <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($prodevelophoursavg <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union12row_'.$count} = array();
${'union12row_'.$count}[] = $name;
${'union12row_'.$count}[] = $sitescount;
${'union12row_'.$count}[] = $prodevelop1count;
${'union12row_'.$count}[] = $prodevelop2count;
${'union12row_'.$count}[] = $prodevelop3count;
${'union12row_'.$count}[] = $prodevelop4count;
${'union12row_'.$count}[] = $prodevelop5count;
${'union12row_'.$count}[] = $prodevelophoursavg;
${'union12row_'.$count}[] = $prodevelop_rankmost11count;
${'union12row_'.$count}[] = $prodevelop_rankmost12count;
${'union12row_'.$count}[] = $prodevelop_rankmost13count;
${'union12row_'.$count}[] = $prodevelop_rankmost14count;
${'union12row_'.$count}[] = $prodevelop_rankmost15count;
${'union12row_'.$count}[] = $prodevelop_rank21count;
${'union12row_'.$count}[] = $prodevelop_rank22count;
${'union12row_'.$count}[] = $prodevelop_rank23count;
${'union12row_'.$count}[] = $prodevelop_rank24count;
${'union12row_'.$count}[] = $prodevelop_rank25count;
${'union12row_'.$count}[] = $prodevelop_rank31count;
${'union12row_'.$count}[] = $prodevelop_rank32count;
${'union12row_'.$count}[] = $prodevelop_rank33count;
${'union12row_'.$count}[] = $prodevelop_rank34count;
${'union12row_'.$count}[] = $prodevelop_rank35count;
${'union12row_'.$count}[] = $prodevelop_rank41count;
${'union12row_'.$count}[] = $prodevelop_rank42count;
${'union12row_'.$count}[] = $prodevelop_rank43count;
${'union12row_'.$count}[] = $prodevelop_rank44count;
${'union12row_'.$count}[] = $prodevelop_rank45count;
${'union12row_'.$count}[] = $prodevelop_rankleast51count;
${'union12row_'.$count}[] = $prodevelop_rankleast52count;
${'union12row_'.$count}[] = $prodevelop_rankleast53count;
${'union12row_'.$count}[] = $prodevelop_rankleast54count;
${'union12row_'.$count}[] = $prodevelop_rankleast55count;


// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

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
		<td align=\"right\">$prodevelop1count</td>
		<td align=\"right\">$prodevelop2count</td>
		<td align=\"right\">$prodevelop3count</td>
		<td align=\"right\">$prodevelop4count</td>
		<td align=\"right\">$prodevelop5count</td>
		<td align=\"right\">$prodevelophoursavg</td>
		<td align=\"right\">$prodevelop_rankmost11count</td>
		<td align=\"right\">$prodevelop_rankmost12count</td>
		<td align=\"right\">$prodevelop_rankmost13count</td>
		<td align=\"right\">$prodevelop_rankmost14count</td>
		<td align=\"right\">$prodevelop_rankmost15count</td>
		<td align=\"right\">$prodevelop_rank21count</td>
		<td align=\"right\">$prodevelop_rank22count</td>
		<td align=\"right\">$prodevelop_rank23count</td>
		<td align=\"right\">$prodevelop_rank24count</td>
		<td align=\"right\">$prodevelop_rank25count</td>
		<td align=\"right\">$prodevelop_rank31count</td>
		<td align=\"right\">$prodevelop_rank32count</td>
		<td align=\"right\">$prodevelop_rank33count</td>
		<td align=\"right\">$prodevelop_rank34count</td>
		<td align=\"right\">$prodevelop_rank35count</td>
		<td align=\"right\">$prodevelop_rank41count</td>
		<td align=\"right\">$prodevelop_rank42count</td>
		<td align=\"right\">$prodevelop_rank43count</td>
		<td align=\"right\">$prodevelop_rank44count</td>
		<td align=\"right\">$prodevelop_rank45count</td>
		<td align=\"right\">$prodevelop_rankleast51count</td>
		<td align=\"right\">$prodevelop_rankleast52count</td>
		<td align=\"right\">$prodevelop_rankleast53count</td>
		<td align=\"right\">$prodevelop_rankleast54count</td>
		<td align=\"right\">$prodevelop_rankleast55count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites that Provide Staff Training/Professional Development Monthly : <b>$prodevelop1count</b><br />Number of Sites that Provide Staff Training/Professional Development Quarterly: <b>$prodevelop2count</b><br />Number of Sites that Provide Staff Training/Professional Development Semi-annually : <b>$prodevelop3count</b><br />Number of Sites that Provide Staff Training/Professional Development Annually : <b>$prodevelop4count</b><br />Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year: <b>$prodevelop5count</b><br />Average Hours of Training/Professional Development Provided: <b>$prodevelophoursavg</b><br />Number of Sites that Rank On-line Training First: <b>$prodevelop_rankmost11count</b><br />Number of Sites that Rank Workshops/Conferences First: <b>$prodevelop_rankmost12count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter First: <b>$prodevelop_rankmost13count</b><br />Number of Sites that Rank Peer to Peer Coaching First: <b>$prodevelop_rankmost14count</b><br />Number of Sites that Rank Supervision First: <b>$prodevelop_rankmost15count</b><br />Number of Sites that Rank On-line Training Second: <b>$prodevelop_rank21count</b><br />Number of Sites that Rank Workshops/Conferences Second: <b>$prodevelop_rank22count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second: <b>$prodevelop_rank23count</b><br />Number of Sites that Rank Peer to Peer Coaching Second: <b>$prodevelop_rank24count</b><br />Number of Sites that Rank Supervision Second: <b>$prodevelop_rank25count</b><br />Number of Sites that Rank On-line Training Third: <b>$prodevelop_rank31count</b><br />Number of Sites that Rank Workshops/Conferences Third: <b>$prodevelop_rank32count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third: <b>$prodevelop_rank33count</b><br />Number of Sites that Rank Peer to Peer Coaching Third: <b>$prodevelop_rank34count</b><br />Number of Sites that Rank Supervision Third: <b>$prodevelop_rank35count</b><br />Number of Sites that Rank On-line Training Fourth: <b>$prodevelop_rank41count</b><br />Number of Sites that Rank Workshops/Conferences Fourth: <b>$prodevelop_rank42count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth: <b>$prodevelop_rank43count</b><br />Number of Sites that Rank Peer to Peer Coaching Fourth: <b>$prodevelop_rank44count</b><br />Number of Sites that Rank Supervision Fourth: <b>$prodevelop_rank45count</b><br />Number of Sites that Rank On-line Training Last: <b>$prodevelop_rankleast51count</b><br />Number of Sites that Rank Workshops/Conferences Last: <b>$prodevelop_rankleast52count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last: <b>$prodevelop_rankleast53count</b><br />Number of Sites that Rank Peer to Peer Coaching Last: <b>$prodevelop_rankleast54count</b><br />Number of Sites that Rank Supervision Last: <b>$prodevelop_rankleast55count</b><br />]]></description>";

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
$union12file = fopen("export/advancedsearch_unionschooldistrict12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union12file, ${'union12row_'.$i});
}

fclose($union12file); 

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
	      <href>http://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict12.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Monthly </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Quarterly</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Semi-annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</th>
		<th>Average Hours of Training/Professional Development Provided</th>
		<th>Number of Sites that Rank On-line Training First</th>
		<th>Number of Sites that Rank Workshops/Conferences First</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</th>
		<th>Number of Sites that Rank Peer to Peer Coaching First</th>
		<th>Number of Sites that Rank Supervision First</th>
		<th>Number of Sites that Rank On-line Training Second</th>
		<th>Number of Sites that Rank Workshops/Conferences Second</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Second</th>
		<th>Number of Sites that Rank Supervision Second</th>
		<th>Number of Sites that Rank On-line Training Third</th>
		<th>Number of Sites that Rank Workshops/Conferences Third</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Third</th>
		<th>Number of Sites that Rank Supervision Third</th>
		<th>Number of Sites that Rank On-line Training Fourth</th>
		<th>Number of Sites that Rank Workshops/Conferences Fourth</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Fourth</th>
		<th>Number of Sites that Rank Supervision Fourth</th>
		<th>Number of Sites that Rank On-line Training Last</th>
		<th>Number of Sites that Rank Workshops/Conferences Last</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Last</th>
		<th>Number of Sites that Rank Supervision Last</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict12.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($union12=='t') {


// if by az cities is selected
if ($city12=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT s.prodevelophours FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) GROUP BY c.gid;";
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
$city12row_0 = array( );
$city12row_0[] = 'City Name';
$city12row_0[] = 'Number of Sites';
$city12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly ';
$city12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$city12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually ';
$city12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Annually ';
$city12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$city12row_0[] = 'Average Hours of Training/Professional Development Provided';
$city12row_0[] = 'Number of Sites that Rank On-line Training First';
$city12row_0[] = 'Number of Sites that Rank Workshops/Conferences First';
$city12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$city12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$city12row_0[] = 'Number of Sites that Rank Supervision First';
$city12row_0[] = 'Number of Sites that Rank On-line Training Second';
$city12row_0[] = 'Number of Sites that Rank Workshops/Conferences Second';
$city12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$city12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$city12row_0[] = 'Number of Sites that Rank Supervision Second';
$city12row_0[] = 'Number of Sites that Rank On-line Training Third';
$city12row_0[] = 'Number of Sites that Rank Workshops/Conferences Third';
$city12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$city12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$city12row_0[] = 'Number of Sites that Rank Supervision Third';
$city12row_0[] = 'Number of Sites that Rank On-line Training Fourth';
$city12row_0[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$city12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$city12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$city12row_0[] = 'Number of Sites that Rank Supervision Fourth';
$city12row_0[] = 'Number of Sites that Rank On-line Training Last';
$city12row_0[] = 'Number of Sites that Rank Workshops/Conferences Last';
$city12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$city12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$city12row_0[] = 'Number of Sites that Rank Supervision Last';


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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($prodevelophoursavg <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($prodevelophoursavg <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($prodevelophoursavg <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city12row_'.$count} = array();
${'city12row_'.$count}[] = $name;
${'city12row_'.$count}[] = $sitescount;
${'city12row_'.$count}[] = $prodevelop1count;
${'city12row_'.$count}[] = $prodevelop2count;
${'city12row_'.$count}[] = $prodevelop3count;
${'city12row_'.$count}[] = $prodevelop4count;
${'city12row_'.$count}[] = $prodevelop5count;
${'city12row_'.$count}[] = $prodevelophoursavg;
${'city12row_'.$count}[] = $prodevelop_rankmost11count;
${'city12row_'.$count}[] = $prodevelop_rankmost12count;
${'city12row_'.$count}[] = $prodevelop_rankmost13count;
${'city12row_'.$count}[] = $prodevelop_rankmost14count;
${'city12row_'.$count}[] = $prodevelop_rankmost15count;
${'city12row_'.$count}[] = $prodevelop_rank21count;
${'city12row_'.$count}[] = $prodevelop_rank22count;
${'city12row_'.$count}[] = $prodevelop_rank23count;
${'city12row_'.$count}[] = $prodevelop_rank24count;
${'city12row_'.$count}[] = $prodevelop_rank25count;
${'city12row_'.$count}[] = $prodevelop_rank31count;
${'city12row_'.$count}[] = $prodevelop_rank32count;
${'city12row_'.$count}[] = $prodevelop_rank33count;
${'city12row_'.$count}[] = $prodevelop_rank34count;
${'city12row_'.$count}[] = $prodevelop_rank35count;
${'city12row_'.$count}[] = $prodevelop_rank41count;
${'city12row_'.$count}[] = $prodevelop_rank42count;
${'city12row_'.$count}[] = $prodevelop_rank43count;
${'city12row_'.$count}[] = $prodevelop_rank44count;
${'city12row_'.$count}[] = $prodevelop_rank45count;
${'city12row_'.$count}[] = $prodevelop_rankleast51count;
${'city12row_'.$count}[] = $prodevelop_rankleast52count;
${'city12row_'.$count}[] = $prodevelop_rankleast53count;
${'city12row_'.$count}[] = $prodevelop_rankleast54count;
${'city12row_'.$count}[] = $prodevelop_rankleast55count;


// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

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
		<td align=\"right\">$prodevelop1count</td>
		<td align=\"right\">$prodevelop2count</td>
		<td align=\"right\">$prodevelop3count</td>
		<td align=\"right\">$prodevelop4count</td>
		<td align=\"right\">$prodevelop5count</td>
		<td align=\"right\">$prodevelophoursavg</td>
		<td align=\"right\">$prodevelop_rankmost11count</td>
		<td align=\"right\">$prodevelop_rankmost12count</td>
		<td align=\"right\">$prodevelop_rankmost13count</td>
		<td align=\"right\">$prodevelop_rankmost14count</td>
		<td align=\"right\">$prodevelop_rankmost15count</td>
		<td align=\"right\">$prodevelop_rank21count</td>
		<td align=\"right\">$prodevelop_rank22count</td>
		<td align=\"right\">$prodevelop_rank23count</td>
		<td align=\"right\">$prodevelop_rank24count</td>
		<td align=\"right\">$prodevelop_rank25count</td>
		<td align=\"right\">$prodevelop_rank31count</td>
		<td align=\"right\">$prodevelop_rank32count</td>
		<td align=\"right\">$prodevelop_rank33count</td>
		<td align=\"right\">$prodevelop_rank34count</td>
		<td align=\"right\">$prodevelop_rank35count</td>
		<td align=\"right\">$prodevelop_rank41count</td>
		<td align=\"right\">$prodevelop_rank42count</td>
		<td align=\"right\">$prodevelop_rank43count</td>
		<td align=\"right\">$prodevelop_rank44count</td>
		<td align=\"right\">$prodevelop_rank45count</td>
		<td align=\"right\">$prodevelop_rankleast51count</td>
		<td align=\"right\">$prodevelop_rankleast52count</td>
		<td align=\"right\">$prodevelop_rankleast53count</td>
		<td align=\"right\">$prodevelop_rankleast54count</td>
		<td align=\"right\">$prodevelop_rankleast55count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites that Provide Staff Training/Professional Development Monthly : <b>$prodevelop1count</b><br />Number of Sites that Provide Staff Training/Professional Development Quarterly: <b>$prodevelop2count</b><br />Number of Sites that Provide Staff Training/Professional Development Semi-annually : <b>$prodevelop3count</b><br />Number of Sites that Provide Staff Training/Professional Development Annually : <b>$prodevelop4count</b><br />Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year: <b>$prodevelop5count</b><br />Average Hours of Training/Professional Development Provided: <b>$prodevelophoursavg</b><br />Number of Sites that Rank On-line Training First: <b>$prodevelop_rankmost11count</b><br />Number of Sites that Rank Workshops/Conferences First: <b>$prodevelop_rankmost12count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter First: <b>$prodevelop_rankmost13count</b><br />Number of Sites that Rank Peer to Peer Coaching First: <b>$prodevelop_rankmost14count</b><br />Number of Sites that Rank Supervision First: <b>$prodevelop_rankmost15count</b><br />Number of Sites that Rank On-line Training Second: <b>$prodevelop_rank21count</b><br />Number of Sites that Rank Workshops/Conferences Second: <b>$prodevelop_rank22count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second: <b>$prodevelop_rank23count</b><br />Number of Sites that Rank Peer to Peer Coaching Second: <b>$prodevelop_rank24count</b><br />Number of Sites that Rank Supervision Second: <b>$prodevelop_rank25count</b><br />Number of Sites that Rank On-line Training Third: <b>$prodevelop_rank31count</b><br />Number of Sites that Rank Workshops/Conferences Third: <b>$prodevelop_rank32count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third: <b>$prodevelop_rank33count</b><br />Number of Sites that Rank Peer to Peer Coaching Third: <b>$prodevelop_rank34count</b><br />Number of Sites that Rank Supervision Third: <b>$prodevelop_rank35count</b><br />Number of Sites that Rank On-line Training Fourth: <b>$prodevelop_rank41count</b><br />Number of Sites that Rank Workshops/Conferences Fourth: <b>$prodevelop_rank42count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth: <b>$prodevelop_rank43count</b><br />Number of Sites that Rank Peer to Peer Coaching Fourth: <b>$prodevelop_rank44count</b><br />Number of Sites that Rank Supervision Fourth: <b>$prodevelop_rank45count</b><br />Number of Sites that Rank On-line Training Last: <b>$prodevelop_rankleast51count</b><br />Number of Sites that Rank Workshops/Conferences Last: <b>$prodevelop_rankleast52count</b><br />Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last: <b>$prodevelop_rankleast53count</b><br />Number of Sites that Rank Peer to Peer Coaching Last: <b>$prodevelop_rankleast54count</b><br />Number of Sites that Rank Supervision Last: <b>$prodevelop_rankleast55count</b><br />]]></description>";

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
$city12file = fopen("export/advancedsearch_cities12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city12file, ${'city12row_'.$i});
}

fclose($city12file); 

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
	      <href>http://azcase.nijel.org/phpsite/azcase/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_cities12.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Monthly </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Quarterly</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Semi-annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</th>
		<th>Average Hours of Training/Professional Development Provided</th>
		<th>Number of Sites that Rank On-line Training First</th>
		<th>Number of Sites that Rank Workshops/Conferences First</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</th>
		<th>Number of Sites that Rank Peer to Peer Coaching First</th>
		<th>Number of Sites that Rank Supervision First</th>
		<th>Number of Sites that Rank On-line Training Second</th>
		<th>Number of Sites that Rank Workshops/Conferences Second</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Second</th>
		<th>Number of Sites that Rank Supervision Second</th>
		<th>Number of Sites that Rank On-line Training Third</th>
		<th>Number of Sites that Rank Workshops/Conferences Third</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Third</th>
		<th>Number of Sites that Rank Supervision Third</th>
		<th>Number of Sites that Rank On-line Training Fourth</th>
		<th>Number of Sites that Rank Workshops/Conferences Fourth</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Fourth</th>
		<th>Number of Sites that Rank Supervision Fourth</th>
		<th>Number of Sites that Rank On-line Training Last</th>
		<th>Number of Sites that Rank Workshops/Conferences Last</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Last</th>
		<th>Number of Sites that Rank Supervision Last</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities12.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($city12=='t') {


// if by activity is selected
if ($activity12=='t') {

// set up array for csv
$activity12row_0 = array( );
$activity12row_0[] = 'Activity';
$activity12row_0[] = 'Number of Sites';
$activity12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly ';
$activity12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$activity12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually ';
$activity12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Annually ';
$activity12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$activity12row_0[] = 'Average Hours of Training/Professional Development Provided';
$activity12row_0[] = 'Number of Sites that Rank On-line Training First';
$activity12row_0[] = 'Number of Sites that Rank Workshops/Conferences First';
$activity12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$activity12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$activity12row_0[] = 'Number of Sites that Rank Supervision First';
$activity12row_0[] = 'Number of Sites that Rank On-line Training Second';
$activity12row_0[] = 'Number of Sites that Rank Workshops/Conferences Second';
$activity12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$activity12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$activity12row_0[] = 'Number of Sites that Rank Supervision Second';
$activity12row_0[] = 'Number of Sites that Rank On-line Training Third';
$activity12row_0[] = 'Number of Sites that Rank Workshops/Conferences Third';
$activity12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$activity12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$activity12row_0[] = 'Number of Sites that Rank Supervision Third';
$activity12row_0[] = 'Number of Sites that Rank On-line Training Fourth';
$activity12row_0[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$activity12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$activity12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$activity12row_0[] = 'Number of Sites that Rank Supervision Fourth';
$activity12row_0[] = 'Number of Sites that Rank On-line Training Last';
$activity12row_0[] = 'Number of Sites that Rank Workshops/Conferences Last';
$activity12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$activity12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$activity12row_0[] = 'Number of Sites that Rank Supervision Last';


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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity12row_'.$count} = array();
${'activity12row_'.$count}[] = $name;
${'activity12row_'.$count}[] = $sitescount;
${'activity12row_'.$count}[] = $prodevelop1count;
${'activity12row_'.$count}[] = $prodevelop2count;
${'activity12row_'.$count}[] = $prodevelop3count;
${'activity12row_'.$count}[] = $prodevelop4count;
${'activity12row_'.$count}[] = $prodevelop5count;
${'activity12row_'.$count}[] = $prodevelophoursavg;
${'activity12row_'.$count}[] = $prodevelop_rankmost11count;
${'activity12row_'.$count}[] = $prodevelop_rankmost12count;
${'activity12row_'.$count}[] = $prodevelop_rankmost13count;
${'activity12row_'.$count}[] = $prodevelop_rankmost14count;
${'activity12row_'.$count}[] = $prodevelop_rankmost15count;
${'activity12row_'.$count}[] = $prodevelop_rank21count;
${'activity12row_'.$count}[] = $prodevelop_rank22count;
${'activity12row_'.$count}[] = $prodevelop_rank23count;
${'activity12row_'.$count}[] = $prodevelop_rank24count;
${'activity12row_'.$count}[] = $prodevelop_rank25count;
${'activity12row_'.$count}[] = $prodevelop_rank31count;
${'activity12row_'.$count}[] = $prodevelop_rank32count;
${'activity12row_'.$count}[] = $prodevelop_rank33count;
${'activity12row_'.$count}[] = $prodevelop_rank34count;
${'activity12row_'.$count}[] = $prodevelop_rank35count;
${'activity12row_'.$count}[] = $prodevelop_rank41count;
${'activity12row_'.$count}[] = $prodevelop_rank42count;
${'activity12row_'.$count}[] = $prodevelop_rank43count;
${'activity12row_'.$count}[] = $prodevelop_rank44count;
${'activity12row_'.$count}[] = $prodevelop_rank45count;
${'activity12row_'.$count}[] = $prodevelop_rankleast51count;
${'activity12row_'.$count}[] = $prodevelop_rankleast52count;
${'activity12row_'.$count}[] = $prodevelop_rankleast53count;
${'activity12row_'.$count}[] = $prodevelop_rankleast54count;
${'activity12row_'.$count}[] = $prodevelop_rankleast55count;


// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

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
		<td align=\"right\">$prodevelop1count</td>
		<td align=\"right\">$prodevelop2count</td>
		<td align=\"right\">$prodevelop3count</td>
		<td align=\"right\">$prodevelop4count</td>
		<td align=\"right\">$prodevelop5count</td>
		<td align=\"right\">$prodevelophoursavg</td>
		<td align=\"right\">$prodevelop_rankmost11count</td>
		<td align=\"right\">$prodevelop_rankmost12count</td>
		<td align=\"right\">$prodevelop_rankmost13count</td>
		<td align=\"right\">$prodevelop_rankmost14count</td>
		<td align=\"right\">$prodevelop_rankmost15count</td>
		<td align=\"right\">$prodevelop_rank21count</td>
		<td align=\"right\">$prodevelop_rank22count</td>
		<td align=\"right\">$prodevelop_rank23count</td>
		<td align=\"right\">$prodevelop_rank24count</td>
		<td align=\"right\">$prodevelop_rank25count</td>
		<td align=\"right\">$prodevelop_rank31count</td>
		<td align=\"right\">$prodevelop_rank32count</td>
		<td align=\"right\">$prodevelop_rank33count</td>
		<td align=\"right\">$prodevelop_rank34count</td>
		<td align=\"right\">$prodevelop_rank35count</td>
		<td align=\"right\">$prodevelop_rank41count</td>
		<td align=\"right\">$prodevelop_rank42count</td>
		<td align=\"right\">$prodevelop_rank43count</td>
		<td align=\"right\">$prodevelop_rank44count</td>
		<td align=\"right\">$prodevelop_rank45count</td>
		<td align=\"right\">$prodevelop_rankleast51count</td>
		<td align=\"right\">$prodevelop_rankleast52count</td>
		<td align=\"right\">$prodevelop_rankleast53count</td>
		<td align=\"right\">$prodevelop_rankleast54count</td>
		<td align=\"right\">$prodevelop_rankleast55count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity12file = fopen("export/advancedsearch_activity12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity12file, ${'activity12row_'.$i});
}

fclose($activity12file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Monthly </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Quarterly</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Semi-annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</th>
		<th>Average Hours of Training/Professional Development Provided</th>
		<th>Number of Sites that Rank On-line Training First</th>
		<th>Number of Sites that Rank Workshops/Conferences First</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</th>
		<th>Number of Sites that Rank Peer to Peer Coaching First</th>
		<th>Number of Sites that Rank Supervision First</th>
		<th>Number of Sites that Rank On-line Training Second</th>
		<th>Number of Sites that Rank Workshops/Conferences Second</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Second</th>
		<th>Number of Sites that Rank Supervision Second</th>
		<th>Number of Sites that Rank On-line Training Third</th>
		<th>Number of Sites that Rank Workshops/Conferences Third</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Third</th>
		<th>Number of Sites that Rank Supervision Third</th>
		<th>Number of Sites that Rank On-line Training Fourth</th>
		<th>Number of Sites that Rank Workshops/Conferences Fourth</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Fourth</th>
		<th>Number of Sites that Rank Supervision Fourth</th>
		<th>Number of Sites that Rank On-line Training Last</th>
		<th>Number of Sites that Rank Workshops/Conferences Last</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Last</th>
		<th>Number of Sites that Rank Supervision Last</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($activity12=='t') {


// if by activity is selected
if ($ages12=='t') {

// set up array for csv
$ages12row_0 = array( );
$ages12row_0[] = 'Ages Served';
$ages12row_0[] = 'Number of Sites';
$ages12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Monthly ';
$ages12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Quarterly';
$ages12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Semi-annually ';
$ages12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Annually ';
$ages12row_0[] = 'Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year';
$ages12row_0[] = 'Average Hours of Training/Professional Development Provided';
$ages12row_0[] = 'Number of Sites that Rank On-line Training First';
$ages12row_0[] = 'Number of Sites that Rank Workshops/Conferences First';
$ages12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter First';
$ages12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching First';
$ages12row_0[] = 'Number of Sites that Rank Supervision First';
$ages12row_0[] = 'Number of Sites that Rank On-line Training Second';
$ages12row_0[] = 'Number of Sites that Rank Workshops/Conferences Second';
$ages12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second';
$ages12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Second';
$ages12row_0[] = 'Number of Sites that Rank Supervision Second';
$ages12row_0[] = 'Number of Sites that Rank On-line Training Third';
$ages12row_0[] = 'Number of Sites that Rank Workshops/Conferences Third';
$ages12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third';
$ages12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Third';
$ages12row_0[] = 'Number of Sites that Rank Supervision Third';
$ages12row_0[] = 'Number of Sites that Rank On-line Training Fourth';
$ages12row_0[] = 'Number of Sites that Rank Workshops/Conferences Fourth';
$ages12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth';
$ages12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Fourth';
$ages12row_0[] = 'Number of Sites that Rank Supervision Fourth';
$ages12row_0[] = 'Number of Sites that Rank On-line Training Last';
$ages12row_0[] = 'Number of Sites that Rank Workshops/Conferences Last';
$ages12row_0[] = 'Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last';
$ages12row_0[] = 'Number of Sites that Rank Peer to Peer Coaching Last';
$ages12row_0[] = 'Number of Sites that Rank Supervision Last';


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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development monthly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop1count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Quarterly
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop2count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Semi-annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop3count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Annually
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop4count = pg_result($sitesresult, $lt, 0);
}

// number of sites provide staff training/professional development Less than once a year
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop5count = pg_result($sitesresult, $lt, 0);
}

// average hours of training/professional development per year
$sitescountquery = "SELECT avg(prodevelophours) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelophoursavg = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost11count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost12count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost13count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost14count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankmost1 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankmost15count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank21count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank22count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank23count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank24count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank2 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank25count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank31count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank32count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank33count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank34count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank3 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank35count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank41count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank42count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank43count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank44count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rank4 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rank45count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used On-line training
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast51count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Workshops/conferences
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast52count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Trainers specializing in specific subject matter
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast53count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Peer to peer coaching
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast54count = pg_result($sitesresult, $lt, 0);
}

// number of sites that most used Supervision
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.prodevelop_rankleast5 = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$prodevelop_rankleast55count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages12row_'.$count} = array();
${'ages12row_'.$count}[] = $name;
${'ages12row_'.$count}[] = $sitescount;
${'ages12row_'.$count}[] = $prodevelop1count;
${'ages12row_'.$count}[] = $prodevelop2count;
${'ages12row_'.$count}[] = $prodevelop3count;
${'ages12row_'.$count}[] = $prodevelop4count;
${'ages12row_'.$count}[] = $prodevelop5count;
${'ages12row_'.$count}[] = $prodevelophoursavg;
${'ages12row_'.$count}[] = $prodevelop_rankmost11count;
${'ages12row_'.$count}[] = $prodevelop_rankmost12count;
${'ages12row_'.$count}[] = $prodevelop_rankmost13count;
${'ages12row_'.$count}[] = $prodevelop_rankmost14count;
${'ages12row_'.$count}[] = $prodevelop_rankmost15count;
${'ages12row_'.$count}[] = $prodevelop_rank21count;
${'ages12row_'.$count}[] = $prodevelop_rank22count;
${'ages12row_'.$count}[] = $prodevelop_rank23count;
${'ages12row_'.$count}[] = $prodevelop_rank24count;
${'ages12row_'.$count}[] = $prodevelop_rank25count;
${'ages12row_'.$count}[] = $prodevelop_rank31count;
${'ages12row_'.$count}[] = $prodevelop_rank32count;
${'ages12row_'.$count}[] = $prodevelop_rank33count;
${'ages12row_'.$count}[] = $prodevelop_rank34count;
${'ages12row_'.$count}[] = $prodevelop_rank35count;
${'ages12row_'.$count}[] = $prodevelop_rank41count;
${'ages12row_'.$count}[] = $prodevelop_rank42count;
${'ages12row_'.$count}[] = $prodevelop_rank43count;
${'ages12row_'.$count}[] = $prodevelop_rank44count;
${'ages12row_'.$count}[] = $prodevelop_rank45count;
${'ages12row_'.$count}[] = $prodevelop_rankleast51count;
${'ages12row_'.$count}[] = $prodevelop_rankleast52count;
${'ages12row_'.$count}[] = $prodevelop_rankleast53count;
${'ages12row_'.$count}[] = $prodevelop_rankleast54count;
${'ages12row_'.$count}[] = $prodevelop_rankleast55count;


// clean up data for html
$sitescount = number_format($sitescount);
$prodevelop1count = number_format($prodevelop1count);
$prodevelop2count = number_format($prodevelop2count);
$prodevelop3count = number_format($prodevelop3count);
$prodevelop4count = number_format($prodevelop4count);
$prodevelop5count = number_format($prodevelop5count);
$prodevelophoursavg = number_format($prodevelophoursavg, 2);
$prodevelop_rankmost11count = number_format($prodevelop_rankmost11count);
$prodevelop_rankmost12count = number_format($prodevelop_rankmost12count);
$prodevelop_rankmost13count = number_format($prodevelop_rankmost13count);
$prodevelop_rankmost14count = number_format($prodevelop_rankmost14count);
$prodevelop_rankmost15count = number_format($prodevelop_rankmost15count);
$prodevelop_rank21count = number_format($prodevelop_rank21count);
$prodevelop_rank22count = number_format($prodevelop_rank22count);
$prodevelop_rank23count = number_format($prodevelop_rank23count);
$prodevelop_rank24count = number_format($prodevelop_rank24count);
$prodevelop_rank25count = number_format($prodevelop_rank25count);
$prodevelop_rank31count = number_format($prodevelop_rank31count);
$prodevelop_rank32count = number_format($prodevelop_rank32count);
$prodevelop_rank33count = number_format($prodevelop_rank33count);
$prodevelop_rank34count = number_format($prodevelop_rank34count);
$prodevelop_rank35count = number_format($prodevelop_rank35count);
$prodevelop_rank41count = number_format($prodevelop_rank41count);
$prodevelop_rank42count = number_format($prodevelop_rank42count);
$prodevelop_rank43count = number_format($prodevelop_rank43count);
$prodevelop_rank44count = number_format($prodevelop_rank44count);
$prodevelop_rank45count = number_format($prodevelop_rank45count);
$prodevelop_rankleast51count = number_format($prodevelop_rankleast51count);
$prodevelop_rankleast52count = number_format($prodevelop_rankleast52count);
$prodevelop_rankleast53count = number_format($prodevelop_rankleast53count);
$prodevelop_rankleast54count = number_format($prodevelop_rankleast54count);
$prodevelop_rankleast55count = number_format($prodevelop_rankleast55count);

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
		<td align=\"right\">$prodevelop1count</td>
		<td align=\"right\">$prodevelop2count</td>
		<td align=\"right\">$prodevelop3count</td>
		<td align=\"right\">$prodevelop4count</td>
		<td align=\"right\">$prodevelop5count</td>
		<td align=\"right\">$prodevelophoursavg</td>
		<td align=\"right\">$prodevelop_rankmost11count</td>
		<td align=\"right\">$prodevelop_rankmost12count</td>
		<td align=\"right\">$prodevelop_rankmost13count</td>
		<td align=\"right\">$prodevelop_rankmost14count</td>
		<td align=\"right\">$prodevelop_rankmost15count</td>
		<td align=\"right\">$prodevelop_rank21count</td>
		<td align=\"right\">$prodevelop_rank22count</td>
		<td align=\"right\">$prodevelop_rank23count</td>
		<td align=\"right\">$prodevelop_rank24count</td>
		<td align=\"right\">$prodevelop_rank25count</td>
		<td align=\"right\">$prodevelop_rank31count</td>
		<td align=\"right\">$prodevelop_rank32count</td>
		<td align=\"right\">$prodevelop_rank33count</td>
		<td align=\"right\">$prodevelop_rank34count</td>
		<td align=\"right\">$prodevelop_rank35count</td>
		<td align=\"right\">$prodevelop_rank41count</td>
		<td align=\"right\">$prodevelop_rank42count</td>
		<td align=\"right\">$prodevelop_rank43count</td>
		<td align=\"right\">$prodevelop_rank44count</td>
		<td align=\"right\">$prodevelop_rank45count</td>
		<td align=\"right\">$prodevelop_rankleast51count</td>
		<td align=\"right\">$prodevelop_rankleast52count</td>
		<td align=\"right\">$prodevelop_rankleast53count</td>
		<td align=\"right\">$prodevelop_rankleast54count</td>
		<td align=\"right\">$prodevelop_rankleast55count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages12file = fopen("export/advancedsearch_ages12.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages12file, ${'ages12row_'.$i});
}

fclose($ages12file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Monthly </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Quarterly</th>
		<th>Number of Sites that Provide Staff Training/Professional Development Semi-annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Annually </th>
		<th>Number of Sites that Provide Staff Training/Professional Development Less Than Once a Year</th>
		<th>Average Hours of Training/Professional Development Provided</th>
		<th>Number of Sites that Rank On-line Training First</th>
		<th>Number of Sites that Rank Workshops/Conferences First</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter First</th>
		<th>Number of Sites that Rank Peer to Peer Coaching First</th>
		<th>Number of Sites that Rank Supervision First</th>
		<th>Number of Sites that Rank On-line Training Second</th>
		<th>Number of Sites that Rank Workshops/Conferences Second</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Second</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Second</th>
		<th>Number of Sites that Rank Supervision Second</th>
		<th>Number of Sites that Rank On-line Training Third</th>
		<th>Number of Sites that Rank Workshops/Conferences Third</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Third</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Third</th>
		<th>Number of Sites that Rank Supervision Third</th>
		<th>Number of Sites that Rank On-line Training Fourth</th>
		<th>Number of Sites that Rank Workshops/Conferences Fourth</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Fourth</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Fourth</th>
		<th>Number of Sites that Rank Supervision Fourth</th>
		<th>Number of Sites that Rank On-line Training Last</th>
		<th>Number of Sites that Rank Workshops/Conferences Last</th>
		<th>Number of Sites that Rank Trainers Specializing in Specific Subject Matter Last</th>
		<th>Number of Sites that Rank Peer to Peer Coaching Last</th>
		<th>Number of Sites that Rank Supervision Last</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages12.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($ages12=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
