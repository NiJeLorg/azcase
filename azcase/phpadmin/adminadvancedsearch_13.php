<?php

$summary13 = $_REQUEST['summary13'];
$cd13 = $_REQUEST['cd13'];
$sld13 = $_REQUEST['sld13'];
$elm13 = $_REQUEST['elm13'];
$union13 = $_REQUEST['union13'];
$city13 = $_REQUEST['city13'];
$activity13 = $_REQUEST['activity13'];
$ages13 = $_REQUEST['ages13'];

if ($summary13=='t' || $cd13=='t' || $sld13=='t' || $elm13=='t' || $union13=='t' || $city13=='t' || $activity13=='t' || $ages13=='t') {

?>
<div class="clear"></div>
<h3>Who Preforms Staff Training</h3>
<?
// if summary table is selected
if ($summary13=='t') {

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereages;

// table headers
?>
<h4>Summary Table</h4>
<table class="hoursTable">
	<tr>
		<th>Category</th>
		<th>Number of Sites</th>
	</tr>	
<?
$summary13row_0 = array( );
$summary13row_0[] = 'Category';
$summary13row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}

// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary13row_1 = array( );
$summary13row_1[] = 'Number of Sites';
$summary13row_1[] = $sitescount;
$summary13row_2 = array( );
$summary13row_2[] = 'Number of Sites That Train Their Own Staff';
$summary13row_2[] = $training_ownstaffcount;
$summary13row_3 = array( );
$summary13row_3[] = 'Number of Sites Trained by AASCC';
$summary13row_3[] = $training_aascccount;
$summary13row_4 = array( );
$summary13row_4[] = 'Number of Sites Trained by AZCASE';
$summary13row_4[] = $training_azcasecount;
$summary13row_5 = array( );
$summary13row_5[] = 'Number of Sites Trained by AZDES';
$summary13row_5[] = $training_azdhscount;
$summary13row_6 = array( );
$summary13row_6[] = 'Number of Sites Trained by NAA';
$summary13row_6[] = $training_naacount;
$summary13row_7 = array( );
$summary13row_7[] = 'Number of Sites Trained by NOIST';
$summary13row_7[] = $training_niostcount;
$summary13row_8 = array( );
$summary13row_8[] = 'Number of Sites Trained by SHD';
$summary13row_8[] = $training_shdcount;
$summary13row_9 = array( );
$summary13row_9[] = 'Number of Sites Trained by Other';
$summary13row_9[] = $training_othercount;
$summary13row_10 = array( );
$summary13row_10[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$summary13row_10[] = $training_needs2count;
$summary13row_11 = array( );
$summary13row_11[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$summary13row_11[] = $training_needs3count;
$summary13row_12 = array( );
$summary13row_12[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$summary13row_12[] = $training_needs4count;
$summary13row_13 = array( );
$summary13row_13[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$summary13row_13[] = $training_needs5count;
$summary13row_14 = array( );
$summary13row_14[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$summary13row_14[] = $training_needs6count;
$summary13row_15 = array( );
$summary13row_15[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$summary13row_15[] = $training_needs7count;
$summary13row_16 = array( );
$summary13row_16[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$summary13row_16[] = $training_needs8count;
$summary13row_17 = array( );
$summary13row_17[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$summary13row_17[] = $training_needs9count;
$summary13row_18 = array( );
$summary13row_18[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$summary13row_18[] = $training_needs11count;
$summary13row_19 = array( );
$summary13row_19[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$summary13row_19[] = $training_needs10count;
$summary13row_20 = array( );
$summary13row_20[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$summary13row_20[] = $training_needssecond2count;
$summary13row_21 = array( );
$summary13row_21[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$summary13row_21[] = $training_needssecond3count;
$summary13row_22 = array( );
$summary13row_22[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$summary13row_22[] = $training_needssecond4count;
$summary13row_23 = array( );
$summary13row_23[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$summary13row_23[] = $training_needssecond5count;
$summary13row_24 = array( );
$summary13row_24[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$summary13row_24[] = $training_needssecond6count;
$summary13row_25 = array( );
$summary13row_25[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$summary13row_25[] = $training_needssecond7count;
$summary13row_26 = array( );
$summary13row_26[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$summary13row_26[] = $training_needssecond8count;
$summary13row_27 = array( );
$summary13row_27[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$summary13row_27[] = $training_needssecond9count;
$summary13row_28 = array( );
$summary13row_28[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$summary13row_28[] = $training_needssecond11count;
$summary13row_29 = array( );
$summary13row_29[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';
$summary13row_29[] = $training_needssecond10count;

// build csv file
$summary13file = fopen("export/advancedsearch_summary13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 29; $i++) {
	fputcsv($summary13file, ${'summary13row_'.$i});
}

fclose($summary13file); 


// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Train Their Own Staff</td>
		<td align="right"><?php echo $training_ownstaffcount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Trained by AASCC</td>
		<td align="right"><?php echo $training_aascccount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Trained by AZCASE </td>
		<td align="right"><?php echo $training_azcasecount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Trained by AZDHS</td>
		<td align="right"><?php echo $training_azdhscount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Trained by NAA</td>
		<td align="right"><?php echo $training_naacount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Trained by NOIST</td>
		<td align="right"><?php echo $training_niostcount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Trained by SHD</td>
		<td align="right"><?php echo $training_shdcount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Trained by Other</td>
		<td align="right"><?php echo $training_othercount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development</td>
		<td align="right"><?php echo $training_needs2count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </td>
		<td align="right"><?php echo $training_needs3count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</td>
		<td align="right"><?php echo $training_needs4count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</td>
		<td align="right"><?php echo $training_needs5count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</td>
		<td align="right"><?php echo $training_needs6count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </td>
		<td align="right"><?php echo $training_needs7count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</td>
		<td align="right"><?php echo $training_needs8count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</td>
		<td align="right"><?php echo $training_needs9count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Most Important Area for Staff Training: Youth Engagement</td>
		<td align="right"><?php echo $training_needs11count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Most Important Area for Staff Training: Other</td>
		<td align="right"><?php echo $training_needs10count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </td>
		<td align="right"><?php echo $training_needssecond2count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</td>
		<td align="right"><?php echo $training_needssecond3count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</td>
		<td align="right"><?php echo $training_needssecond4count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</td>
		<td align="right"><?php echo $training_needssecond5count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</td>
		<td align="right"><?php echo $training_needssecond6count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</td>
		<td align="right"><?php echo $training_needssecond7count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</td>
		<td align="right"><?php echo $training_needssecond8count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</td>
		<td align="right"><?php echo $training_needssecond9count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</td>
		<td align="right"><?php echo $training_needssecond11count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites - Second Most Important Area for Staff Training: Other</td>
		<td align="right"><?php echo $training_needssecond10count; ?></td>
	</tr>

</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd13=='t') {

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
$cd13row_0 = array( );
$cd13row_0[] = 'Congressional District';
$cd13row_0[] = 'Number of Sites';
$cd13row_0[] = 'Number of Sites That Train Their Own Staff ';
$cd13row_0[] = 'Number of Sites Trained by AASCC';
$cd13row_0[] = 'Number of Sites Trained by AZCASE ';
$cd13row_0[] = 'Number of Sites Trained by AZDHS';
$cd13row_0[] = 'Number of Sites Trained by NAA';
$cd13row_0[] = 'Number of Sites Trained by NOIST';
$cd13row_0[] = 'Number of Sites Trained by SHD';
$cd13row_0[] = 'Number of Sites Trained by Other';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$cd13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$cd13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';



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

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($training_ownstaffcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($training_ownstaffcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd13row_'.$count} = array();
${'cd13row_'.$count}[] = $gid;
${'cd13row_'.$count}[] = $sitescount;
${'cd13row_'.$count}[] = $training_ownstaffcount;
${'cd13row_'.$count}[] = $training_aascccount;
${'cd13row_'.$count}[] = $training_azcasecount;
${'cd13row_'.$count}[] = $training_azdhscount;
${'cd13row_'.$count}[] = $training_naacount;
${'cd13row_'.$count}[] = $training_niostcount;
${'cd13row_'.$count}[] = $training_shdcount;
${'cd13row_'.$count}[] = $training_othercount;
${'cd13row_'.$count}[] = $training_needs2count;
${'cd13row_'.$count}[] = $training_needs3count;
${'cd13row_'.$count}[] = $training_needs4count;
${'cd13row_'.$count}[] = $training_needs5count;
${'cd13row_'.$count}[] = $training_needs6count;
${'cd13row_'.$count}[] = $training_needs7count;
${'cd13row_'.$count}[] = $training_needs8count;
${'cd13row_'.$count}[] = $training_needs9count;
${'cd13row_'.$count}[] = $training_needs11count;
${'cd13row_'.$count}[] = $training_needs10count;
${'cd13row_'.$count}[] = $training_needssecond2count;
${'cd13row_'.$count}[] = $training_needssecond3count;
${'cd13row_'.$count}[] = $training_needssecond4count;
${'cd13row_'.$count}[] = $training_needssecond5count;
${'cd13row_'.$count}[] = $training_needssecond6count;
${'cd13row_'.$count}[] = $training_needssecond7count;
${'cd13row_'.$count}[] = $training_needssecond8count;
${'cd13row_'.$count}[] = $training_needssecond9count;
${'cd13row_'.$count}[] = $training_needssecond11count;
${'cd13row_'.$count}[] = $training_needssecond10count;



// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

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
		<td align=\"right\">$training_ownstaffcount</td>
		<td align=\"right\">$training_aascccount</td>
		<td align=\"right\">$training_azcasecount</td>
		<td align=\"right\">$training_azdhscount</td>
		<td align=\"right\">$training_naacount</td>
		<td align=\"right\">$training_niostcount</td>
		<td align=\"right\">$training_shdcount</td>
		<td align=\"right\">$training_othercount</td>
		<td align=\"right\">$training_needs2count</td>
		<td align=\"right\">$training_needs3count</td>
		<td align=\"right\">$training_needs4count</td>
		<td align=\"right\">$training_needs5count</td>
		<td align=\"right\">$training_needs6count</td>
		<td align=\"right\">$training_needs7count</td>
		<td align=\"right\">$training_needs8count</td>
		<td align=\"right\">$training_needs9count</td>
		<td align=\"right\">$training_needs11count</td>
		<td align=\"right\">$training_needs10count</td>
		<td align=\"right\">$training_needssecond2count</td>
		<td align=\"right\">$training_needssecond3count</td>
		<td align=\"right\">$training_needssecond4count</td>
		<td align=\"right\">$training_needssecond5count</td>
		<td align=\"right\">$training_needssecond6count</td>
		<td align=\"right\">$training_needssecond7count</td>
		<td align=\"right\">$training_needssecond8count</td>
		<td align=\"right\">$training_needssecond9count</td>
		<td align=\"right\">$training_needssecond11count</td>
		<td align=\"right\">$training_needssecond10count</td>

	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites That Train Their Own Staff : <strong>$training_ownstaffcount</strong><br />Number of Sites Trained by AASCC: <strong>$training_aascccount</strong><br />Number of Sites Trained by AZCASE : <strong>$training_azcasecount</strong><br />Number of Sites Trained by AZDHS: <strong>$training_azdhscount</strong><br />Number of Sites Trained by NAA: <strong>$training_naacount</strong><br />Number of Sites Trained by NOIST: <strong>$training_niostcount</strong><br />Number of Sites Trained by SHD: <strong>$training_shdcount</strong><br />Number of Sites Trained by Other: <strong>$training_othercount</strong><br />Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needs2count</strong><br />Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development : <strong>$training_needs3count</strong><br />Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needs4count</strong><br />Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needs5count</strong><br />Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needs6count</strong><br />Number of Sites - Most Important Area for Staff Training: Effective Program Operation : <strong>$training_needs7count</strong><br />Number of Sites - Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needs8count</strong><br />Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needs9count</strong><br />Number of Sites - Most Important Area for Staff Training: Youth Engagement: <strong>$training_needs11count</strong><br />Number of Sites - Most Important Area for Staff Training: Other: <strong>$training_needs10count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needssecond2count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development: <strong>$training_needssecond3count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needssecond4count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needssecond5count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needssecond6count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation: <strong>$training_needssecond7count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needssecond8count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needssecond9count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Youth Engagement: <strong>$training_needssecond11count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Other: <strong>$training_needssecond10count</strong><br />]]></description>";


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
$cd13file = fopen("export/advancedsearch_congressionaldistrict13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd13file, ${'cd13row_'.$i});
}

fclose($cd13file); 


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
	      <href>http://104.131.19.183/php/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict13.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h4>By Congressional District</h4>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Train Their Own Staff </th>
		<th>Number of Sites Trained by AASCC</th>
		<th>Number of Sites Trained by AZCASE </th>
		<th>Number of Sites Trained by AZDHS</th>
		<th>Number of Sites Trained by NAA</th>
		<th>Number of Sites Trained by NOIST</th>
		<th>Number of Sites Trained by SHD</th>
		<th>Number of Sites Trained by Other</th>
		<th>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </th>
		<th>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Most Important Area for Staff Training: Other</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Other</th>
	
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict13.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?

}else{} // if ($cd13=='t') {


// if by state legislative districts is selected
if ($sld13=='t') {

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
$sld13row_0 = array( );
$sld13row_0[] = 'State Legislaltive District';
$sld13row_0[] = 'Number of Sites';
$sld13row_0[] = 'Number of Sites That Train Their Own Staff ';
$sld13row_0[] = 'Number of Sites Trained by AASCC';
$sld13row_0[] = 'Number of Sites Trained by AZCASE ';
$sld13row_0[] = 'Number of Sites Trained by AZDHS';
$sld13row_0[] = 'Number of Sites Trained by NAA';
$sld13row_0[] = 'Number of Sites Trained by NOIST';
$sld13row_0[] = 'Number of Sites Trained by SHD';
$sld13row_0[] = 'Number of Sites Trained by Other';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$sld13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$sld13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';

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

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($training_ownstaffcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($training_ownstaffcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld13row_'.$count} = array();
${'sld13row_'.$count}[] = $gid;
${'sld13row_'.$count}[] = $sitescount;
${'sld13row_'.$count}[] = $training_ownstaffcount;
${'sld13row_'.$count}[] = $training_aascccount;
${'sld13row_'.$count}[] = $training_azcasecount;
${'sld13row_'.$count}[] = $training_azdhscount;
${'sld13row_'.$count}[] = $training_naacount;
${'sld13row_'.$count}[] = $training_niostcount;
${'sld13row_'.$count}[] = $training_shdcount;
${'sld13row_'.$count}[] = $training_othercount;
${'sld13row_'.$count}[] = $training_needs2count;
${'sld13row_'.$count}[] = $training_needs3count;
${'sld13row_'.$count}[] = $training_needs4count;
${'sld13row_'.$count}[] = $training_needs5count;
${'sld13row_'.$count}[] = $training_needs6count;
${'sld13row_'.$count}[] = $training_needs7count;
${'sld13row_'.$count}[] = $training_needs8count;
${'sld13row_'.$count}[] = $training_needs9count;
${'sld13row_'.$count}[] = $training_needs11count;
${'sld13row_'.$count}[] = $training_needs10count;
${'sld13row_'.$count}[] = $training_needssecond2count;
${'sld13row_'.$count}[] = $training_needssecond3count;
${'sld13row_'.$count}[] = $training_needssecond4count;
${'sld13row_'.$count}[] = $training_needssecond5count;
${'sld13row_'.$count}[] = $training_needssecond6count;
${'sld13row_'.$count}[] = $training_needssecond7count;
${'sld13row_'.$count}[] = $training_needssecond8count;
${'sld13row_'.$count}[] = $training_needssecond9count;
${'sld13row_'.$count}[] = $training_needssecond11count;
${'sld13row_'.$count}[] = $training_needssecond10count;


// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

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
		<td align=\"right\">$training_ownstaffcount</td>
		<td align=\"right\">$training_aascccount</td>
		<td align=\"right\">$training_azcasecount</td>
		<td align=\"right\">$training_azdhscount</td>
		<td align=\"right\">$training_naacount</td>
		<td align=\"right\">$training_niostcount</td>
		<td align=\"right\">$training_shdcount</td>
		<td align=\"right\">$training_othercount</td>
		<td align=\"right\">$training_needs2count</td>
		<td align=\"right\">$training_needs3count</td>
		<td align=\"right\">$training_needs4count</td>
		<td align=\"right\">$training_needs5count</td>
		<td align=\"right\">$training_needs6count</td>
		<td align=\"right\">$training_needs7count</td>
		<td align=\"right\">$training_needs8count</td>
		<td align=\"right\">$training_needs9count</td>
		<td align=\"right\">$training_needs11count</td>
		<td align=\"right\">$training_needs10count</td>
		<td align=\"right\">$training_needssecond2count</td>
		<td align=\"right\">$training_needssecond3count</td>
		<td align=\"right\">$training_needssecond4count</td>
		<td align=\"right\">$training_needssecond5count</td>
		<td align=\"right\">$training_needssecond6count</td>
		<td align=\"right\">$training_needssecond7count</td>
		<td align=\"right\">$training_needssecond8count</td>
		<td align=\"right\">$training_needssecond9count</td>
		<td align=\"right\">$training_needssecond11count</td>
		<td align=\"right\">$training_needssecond10count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites That Train Their Own Staff : <strong>$training_ownstaffcount</strong><br />Number of Sites Trained by AASCC: <strong>$training_aascccount</strong><br />Number of Sites Trained by AZCASE : <strong>$training_azcasecount</strong><br />Number of Sites Trained by AZDHS: <strong>$training_azdhscount</strong><br />Number of Sites Trained by NAA: <strong>$training_naacount</strong><br />Number of Sites Trained by NOIST: <strong>$training_niostcount</strong><br />Number of Sites Trained by SHD: <strong>$training_shdcount</strong><br />Number of Sites Trained by Other: <strong>$training_othercount</strong><br />Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needs2count</strong><br />Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development : <strong>$training_needs3count</strong><br />Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needs4count</strong><br />Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needs5count</strong><br />Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needs6count</strong><br />Number of Sites - Most Important Area for Staff Training: Effective Program Operation : <strong>$training_needs7count</strong><br />Number of Sites - Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needs8count</strong><br />Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needs9count</strong><br />Number of Sites - Most Important Area for Staff Training: Youth Engagement: <strong>$training_needs11count</strong><br />Number of Sites - Most Important Area for Staff Training: Other: <strong>$training_needs10count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needssecond2count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development: <strong>$training_needssecond3count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needssecond4count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needssecond5count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needssecond6count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation: <strong>$training_needssecond7count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needssecond8count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needssecond9count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Youth Engagement: <strong>$training_needssecond11count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Other: <strong>$training_needssecond10count</strong><br />]]></description>";

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
$sld13file = fopen("export/advancedsearch_statelegislativedistrict13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld13file, ${'sld13row_'.$i});
}

fclose($sld13file); 

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
	      <href>http://104.131.19.183/php/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict13.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By State Legislative District</h4>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Train Their Own Staff </th>
		<th>Number of Sites Trained by AASCC</th>
		<th>Number of Sites Trained by AZCASE </th>
		<th>Number of Sites Trained by AZDHS</th>
		<th>Number of Sites Trained by NAA</th>
		<th>Number of Sites Trained by NOIST</th>
		<th>Number of Sites Trained by SHD</th>
		<th>Number of Sites Trained by Other</th>
		<th>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </th>
		<th>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Most Important Area for Staff Training: Other</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict13.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($sld13=='t') {


// if by elementary school distircts is selected
if ($elm13=='t') {

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
$elm13row_0 = array( );
$elm13row_0[] = 'Elementary School District Name';
$elm13row_0[] = 'Number of Sites';
$elm13row_0[] = 'Number of Sites That Train Their Own Staff ';
$elm13row_0[] = 'Number of Sites Trained by AASCC';
$elm13row_0[] = 'Number of Sites Trained by AZCASE ';
$elm13row_0[] = 'Number of Sites Trained by AZDHS';
$elm13row_0[] = 'Number of Sites Trained by NAA';
$elm13row_0[] = 'Number of Sites Trained by NOIST';
$elm13row_0[] = 'Number of Sites Trained by SHD';
$elm13row_0[] = 'Number of Sites Trained by Other';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$elm13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$elm13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';


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

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($training_ownstaffcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($training_ownstaffcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm13row_'.$count} = array();
${'elm13row_'.$count}[] = $name;
${'elm13row_'.$count}[] = $sitescount;
${'elm13row_'.$count}[] = $training_ownstaffcount;
${'elm13row_'.$count}[] = $training_aascccount;
${'elm13row_'.$count}[] = $training_azcasecount;
${'elm13row_'.$count}[] = $training_azdhscount;
${'elm13row_'.$count}[] = $training_naacount;
${'elm13row_'.$count}[] = $training_niostcount;
${'elm13row_'.$count}[] = $training_shdcount;
${'elm13row_'.$count}[] = $training_othercount;
${'elm13row_'.$count}[] = $training_needs2count;
${'elm13row_'.$count}[] = $training_needs3count;
${'elm13row_'.$count}[] = $training_needs4count;
${'elm13row_'.$count}[] = $training_needs5count;
${'elm13row_'.$count}[] = $training_needs6count;
${'elm13row_'.$count}[] = $training_needs7count;
${'elm13row_'.$count}[] = $training_needs8count;
${'elm13row_'.$count}[] = $training_needs9count;
${'elm13row_'.$count}[] = $training_needs11count;
${'elm13row_'.$count}[] = $training_needs10count;
${'elm13row_'.$count}[] = $training_needssecond2count;
${'elm13row_'.$count}[] = $training_needssecond3count;
${'elm13row_'.$count}[] = $training_needssecond4count;
${'elm13row_'.$count}[] = $training_needssecond5count;
${'elm13row_'.$count}[] = $training_needssecond6count;
${'elm13row_'.$count}[] = $training_needssecond7count;
${'elm13row_'.$count}[] = $training_needssecond8count;
${'elm13row_'.$count}[] = $training_needssecond9count;
${'elm13row_'.$count}[] = $training_needssecond11count;
${'elm13row_'.$count}[] = $training_needssecond10count;


// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

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
		<td align=\"right\">$training_ownstaffcount</td>
		<td align=\"right\">$training_aascccount</td>
		<td align=\"right\">$training_azcasecount</td>
		<td align=\"right\">$training_azdhscount</td>
		<td align=\"right\">$training_naacount</td>
		<td align=\"right\">$training_niostcount</td>
		<td align=\"right\">$training_shdcount</td>
		<td align=\"right\">$training_othercount</td>
		<td align=\"right\">$training_needs2count</td>
		<td align=\"right\">$training_needs3count</td>
		<td align=\"right\">$training_needs4count</td>
		<td align=\"right\">$training_needs5count</td>
		<td align=\"right\">$training_needs6count</td>
		<td align=\"right\">$training_needs7count</td>
		<td align=\"right\">$training_needs8count</td>
		<td align=\"right\">$training_needs9count</td>
		<td align=\"right\">$training_needs11count</td>
		<td align=\"right\">$training_needs10count</td>
		<td align=\"right\">$training_needssecond2count</td>
		<td align=\"right\">$training_needssecond3count</td>
		<td align=\"right\">$training_needssecond4count</td>
		<td align=\"right\">$training_needssecond5count</td>
		<td align=\"right\">$training_needssecond6count</td>
		<td align=\"right\">$training_needssecond7count</td>
		<td align=\"right\">$training_needssecond8count</td>
		<td align=\"right\">$training_needssecond9count</td>
		<td align=\"right\">$training_needssecond11count</td>
		<td align=\"right\">$training_needssecond10count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites That Train Their Own Staff : <strong>$training_ownstaffcount</strong><br />Number of Sites Trained by AASCC: <strong>$training_aascccount</strong><br />Number of Sites Trained by AZCASE : <strong>$training_azcasecount</strong><br />Number of Sites Trained by AZDHS: <strong>$training_azdhscount</strong><br />Number of Sites Trained by NAA: <strong>$training_naacount</strong><br />Number of Sites Trained by NOIST: <strong>$training_niostcount</strong><br />Number of Sites Trained by SHD: <strong>$training_shdcount</strong><br />Number of Sites Trained by Other: <strong>$training_othercount</strong><br />Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needs2count</strong><br />Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development : <strong>$training_needs3count</strong><br />Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needs4count</strong><br />Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needs5count</strong><br />Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needs6count</strong><br />Number of Sites - Most Important Area for Staff Training: Effective Program Operation : <strong>$training_needs7count</strong><br />Number of Sites - Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needs8count</strong><br />Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needs9count</strong><br />Number of Sites - Most Important Area for Staff Training: Youth Engagement: <strong>$training_needs11count</strong><br />Number of Sites - Most Important Area for Staff Training: Other: <strong>$training_needs10count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needssecond2count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development: <strong>$training_needssecond3count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needssecond4count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needssecond5count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needssecond6count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation: <strong>$training_needssecond7count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needssecond8count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needssecond9count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Youth Engagement: <strong>$training_needssecond11count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Other: <strong>$training_needssecond10count</strong><br />]]></description>";

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
$elm13file = fopen("export/advancedsearch_elementaryschooldistrict13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm13file, ${'elm13row_'.$i});
}

fclose($elm13file); 

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
	      <href>http://104.131.19.183/php/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict13.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By Elementary School District</h4>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Train Their Own Staff </th>
		<th>Number of Sites Trained by AASCC</th>
		<th>Number of Sites Trained by AZCASE </th>
		<th>Number of Sites Trained by AZDHS</th>
		<th>Number of Sites Trained by NAA</th>
		<th>Number of Sites Trained by NOIST</th>
		<th>Number of Sites Trained by SHD</th>
		<th>Number of Sites Trained by Other</th>
		<th>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </th>
		<th>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Most Important Area for Staff Training: Other</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict13.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($elm13=='t') {


// if by By Secondary/Union School District is selected
if ($union13=='t') {

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
$union13row_0 = array( );
$union13row_0[] = 'Secondary/Union School District Name';
$union13row_0[] = 'Number of Sites';
$union13row_0[] = 'Number of Sites That Train Their Own Staff ';
$union13row_0[] = 'Number of Sites Trained by AASCC';
$union13row_0[] = 'Number of Sites Trained by AZCASE ';
$union13row_0[] = 'Number of Sites Trained by AZDHS';
$union13row_0[] = 'Number of Sites Trained by NAA';
$union13row_0[] = 'Number of Sites Trained by NOIST';
$union13row_0[] = 'Number of Sites Trained by SHD';
$union13row_0[] = 'Number of Sites Trained by Other';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$union13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$union13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';


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

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($training_ownstaffcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($training_ownstaffcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union13row_'.$count} = array();
${'union13row_'.$count}[] = $name;
${'union13row_'.$count}[] = $sitescount;
${'union13row_'.$count}[] = $training_ownstaffcount;
${'union13row_'.$count}[] = $training_aascccount;
${'union13row_'.$count}[] = $training_azcasecount;
${'union13row_'.$count}[] = $training_azdhscount;
${'union13row_'.$count}[] = $training_naacount;
${'union13row_'.$count}[] = $training_niostcount;
${'union13row_'.$count}[] = $training_shdcount;
${'union13row_'.$count}[] = $training_othercount;
${'union13row_'.$count}[] = $training_needs2count;
${'union13row_'.$count}[] = $training_needs3count;
${'union13row_'.$count}[] = $training_needs4count;
${'union13row_'.$count}[] = $training_needs5count;
${'union13row_'.$count}[] = $training_needs6count;
${'union13row_'.$count}[] = $training_needs7count;
${'union13row_'.$count}[] = $training_needs8count;
${'union13row_'.$count}[] = $training_needs9count;
${'union13row_'.$count}[] = $training_needs11count;
${'union13row_'.$count}[] = $training_needs10count;
${'union13row_'.$count}[] = $training_needssecond2count;
${'union13row_'.$count}[] = $training_needssecond3count;
${'union13row_'.$count}[] = $training_needssecond4count;
${'union13row_'.$count}[] = $training_needssecond5count;
${'union13row_'.$count}[] = $training_needssecond6count;
${'union13row_'.$count}[] = $training_needssecond7count;
${'union13row_'.$count}[] = $training_needssecond8count;
${'union13row_'.$count}[] = $training_needssecond9count;
${'union13row_'.$count}[] = $training_needssecond11count;
${'union13row_'.$count}[] = $training_needssecond10count;


// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

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
		<td align=\"right\">$training_ownstaffcount</td>
		<td align=\"right\">$training_aascccount</td>
		<td align=\"right\">$training_azcasecount</td>
		<td align=\"right\">$training_azdhscount</td>
		<td align=\"right\">$training_naacount</td>
		<td align=\"right\">$training_niostcount</td>
		<td align=\"right\">$training_shdcount</td>
		<td align=\"right\">$training_othercount</td>
		<td align=\"right\">$training_needs2count</td>
		<td align=\"right\">$training_needs3count</td>
		<td align=\"right\">$training_needs4count</td>
		<td align=\"right\">$training_needs5count</td>
		<td align=\"right\">$training_needs6count</td>
		<td align=\"right\">$training_needs7count</td>
		<td align=\"right\">$training_needs8count</td>
		<td align=\"right\">$training_needs9count</td>
		<td align=\"right\">$training_needs11count</td>
		<td align=\"right\">$training_needs10count</td>
		<td align=\"right\">$training_needssecond2count</td>
		<td align=\"right\">$training_needssecond3count</td>
		<td align=\"right\">$training_needssecond4count</td>
		<td align=\"right\">$training_needssecond5count</td>
		<td align=\"right\">$training_needssecond6count</td>
		<td align=\"right\">$training_needssecond7count</td>
		<td align=\"right\">$training_needssecond8count</td>
		<td align=\"right\">$training_needssecond9count</td>
		<td align=\"right\">$training_needssecond11count</td>
		<td align=\"right\">$training_needssecond10count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites That Train Their Own Staff : <strong>$training_ownstaffcount</strong><br />Number of Sites Trained by AASCC: <strong>$training_aascccount</strong><br />Number of Sites Trained by AZCASE : <strong>$training_azcasecount</strong><br />Number of Sites Trained by AZDHS: <strong>$training_azdhscount</strong><br />Number of Sites Trained by NAA: <strong>$training_naacount</strong><br />Number of Sites Trained by NOIST: <strong>$training_niostcount</strong><br />Number of Sites Trained by SHD: <strong>$training_shdcount</strong><br />Number of Sites Trained by Other: <strong>$training_othercount</strong><br />Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needs2count</strong><br />Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development : <strong>$training_needs3count</strong><br />Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needs4count</strong><br />Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needs5count</strong><br />Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needs6count</strong><br />Number of Sites - Most Important Area for Staff Training: Effective Program Operation : <strong>$training_needs7count</strong><br />Number of Sites - Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needs8count</strong><br />Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needs9count</strong><br />Number of Sites - Most Important Area for Staff Training: Youth Engagement: <strong>$training_needs11count</strong><br />Number of Sites - Most Important Area for Staff Training: Other: <strong>$training_needs10count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needssecond2count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development: <strong>$training_needssecond3count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needssecond4count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needssecond5count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needssecond6count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation: <strong>$training_needssecond7count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needssecond8count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needssecond9count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Youth Engagement: <strong>$training_needssecond11count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Other: <strong>$training_needssecond10count</strong><br />]]></description>";

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
$union13file = fopen("export/advancedsearch_unionschooldistrict13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union13file, ${'union13row_'.$i});
}

fclose($union13file); 

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
	      <href>http://104.131.19.183/php/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict13.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By Secondary/Union School District</h4>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Train Their Own Staff </th>
		<th>Number of Sites Trained by AASCC</th>
		<th>Number of Sites Trained by AZCASE </th>
		<th>Number of Sites Trained by AZDHS</th>
		<th>Number of Sites Trained by NAA</th>
		<th>Number of Sites Trained by NOIST</th>
		<th>Number of Sites Trained by SHD</th>
		<th>Number of Sites Trained by Other</th>
		<th>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </th>
		<th>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Most Important Area for Staff Training: Other</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict13.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($union13=='t') {


// if by az cities is selected
if ($city13=='t') {

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
$city13row_0 = array( );
$city13row_0[] = 'City Name';
$city13row_0[] = 'Number of Sites';
$city13row_0[] = 'Number of Sites That Train Their Own Staff ';
$city13row_0[] = 'Number of Sites Trained by AASCC';
$city13row_0[] = 'Number of Sites Trained by AZCASE ';
$city13row_0[] = 'Number of Sites Trained by AZDHS';
$city13row_0[] = 'Number of Sites Trained by NAA';
$city13row_0[] = 'Number of Sites Trained by NOIST';
$city13row_0[] = 'Number of Sites Trained by SHD';
$city13row_0[] = 'Number of Sites Trained by Other';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$city13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$city13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';


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

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($training_ownstaffcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($training_ownstaffcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($training_ownstaffcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city13row_'.$count} = array();
${'city13row_'.$count}[] = $name;
${'city13row_'.$count}[] = $sitescount;
${'city13row_'.$count}[] = $training_ownstaffcount;
${'city13row_'.$count}[] = $training_aascccount;
${'city13row_'.$count}[] = $training_azcasecount;
${'city13row_'.$count}[] = $training_azdhscount;
${'city13row_'.$count}[] = $training_naacount;
${'city13row_'.$count}[] = $training_niostcount;
${'city13row_'.$count}[] = $training_shdcount;
${'city13row_'.$count}[] = $training_othercount;
${'city13row_'.$count}[] = $training_needs2count;
${'city13row_'.$count}[] = $training_needs3count;
${'city13row_'.$count}[] = $training_needs4count;
${'city13row_'.$count}[] = $training_needs5count;
${'city13row_'.$count}[] = $training_needs6count;
${'city13row_'.$count}[] = $training_needs7count;
${'city13row_'.$count}[] = $training_needs8count;
${'city13row_'.$count}[] = $training_needs9count;
${'city13row_'.$count}[] = $training_needs11count;
${'city13row_'.$count}[] = $training_needs10count;
${'city13row_'.$count}[] = $training_needssecond2count;
${'city13row_'.$count}[] = $training_needssecond3count;
${'city13row_'.$count}[] = $training_needssecond4count;
${'city13row_'.$count}[] = $training_needssecond5count;
${'city13row_'.$count}[] = $training_needssecond6count;
${'city13row_'.$count}[] = $training_needssecond7count;
${'city13row_'.$count}[] = $training_needssecond8count;
${'city13row_'.$count}[] = $training_needssecond9count;
${'city13row_'.$count}[] = $training_needssecond11count;
${'city13row_'.$count}[] = $training_needssecond10count;


// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

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
		<td align=\"right\">$training_ownstaffcount</td>
		<td align=\"right\">$training_aascccount</td>
		<td align=\"right\">$training_azcasecount</td>
		<td align=\"right\">$training_azdhscount</td>
		<td align=\"right\">$training_naacount</td>
		<td align=\"right\">$training_niostcount</td>
		<td align=\"right\">$training_shdcount</td>
		<td align=\"right\">$training_othercount</td>
		<td align=\"right\">$training_needs2count</td>
		<td align=\"right\">$training_needs3count</td>
		<td align=\"right\">$training_needs4count</td>
		<td align=\"right\">$training_needs5count</td>
		<td align=\"right\">$training_needs6count</td>
		<td align=\"right\">$training_needs7count</td>
		<td align=\"right\">$training_needs8count</td>
		<td align=\"right\">$training_needs9count</td>
		<td align=\"right\">$training_needs11count</td>
		<td align=\"right\">$training_needs10count</td>
		<td align=\"right\">$training_needssecond2count</td>
		<td align=\"right\">$training_needssecond3count</td>
		<td align=\"right\">$training_needssecond4count</td>
		<td align=\"right\">$training_needssecond5count</td>
		<td align=\"right\">$training_needssecond6count</td>
		<td align=\"right\">$training_needssecond7count</td>
		<td align=\"right\">$training_needssecond8count</td>
		<td align=\"right\">$training_needssecond9count</td>
		<td align=\"right\">$training_needssecond11count</td>
		<td align=\"right\">$training_needssecond10count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites That Train Their Own Staff : <strong>$training_ownstaffcount</strong><br />Number of Sites Trained by AASCC: <strong>$training_aascccount</strong><br />Number of Sites Trained by AZCASE : <strong>$training_azcasecount</strong><br />Number of Sites Trained by AZDHS: <strong>$training_azdhscount</strong><br />Number of Sites Trained by NAA: <strong>$training_naacount</strong><br />Number of Sites Trained by NOIST: <strong>$training_niostcount</strong><br />Number of Sites Trained by SHD: <strong>$training_shdcount</strong><br />Number of Sites Trained by Other: <strong>$training_othercount</strong><br />Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needs2count</strong><br />Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development : <strong>$training_needs3count</strong><br />Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needs4count</strong><br />Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needs5count</strong><br />Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needs6count</strong><br />Number of Sites - Most Important Area for Staff Training: Effective Program Operation : <strong>$training_needs7count</strong><br />Number of Sites - Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needs8count</strong><br />Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needs9count</strong><br />Number of Sites - Most Important Area for Staff Training: Youth Engagement: <strong>$training_needs11count</strong><br />Number of Sites - Most Important Area for Staff Training: Other: <strong>$training_needs10count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development : <strong>$training_needssecond2count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development: <strong>$training_needssecond3count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families: <strong>$training_needssecond4count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development: <strong>$training_needssecond5count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism: <strong>$training_needssecond6count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation: <strong>$training_needssecond7count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues: <strong>$training_needssecond8count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs: <strong>$training_needssecond9count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Youth Engagement: <strong>$training_needssecond11count</strong><br />Number of Sites - Second Most Important Area for Staff Training: Other: <strong>$training_needssecond10count</strong><br />]]></description>";

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
$city13file = fopen("export/advancedsearch_cities13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city13file, ${'city13row_'.$i});
}

fclose($city13file); 

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
	      <href>http://104.131.19.183/php/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_cities13.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By City</h4>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Train Their Own Staff </th>
		<th>Number of Sites Trained by AASCC</th>
		<th>Number of Sites Trained by AZCASE </th>
		<th>Number of Sites Trained by AZDHS</th>
		<th>Number of Sites Trained by NAA</th>
		<th>Number of Sites Trained by NOIST</th>
		<th>Number of Sites Trained by SHD</th>
		<th>Number of Sites Trained by Other</th>
		<th>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </th>
		<th>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Most Important Area for Staff Training: Other</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities13.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($city13=='t') {


// if by activity is selected
if ($activity13=='t') {

// set up array for csv
$activity13row_0 = array( );
$activity13row_0[] = 'Activity';
$activity13row_0[] = 'Number of Sites';
$activity13row_0[] = 'Number of Sites That Train Their Own Staff ';
$activity13row_0[] = 'Number of Sites Trained by AASCC';
$activity13row_0[] = 'Number of Sites Trained by AZCASE ';
$activity13row_0[] = 'Number of Sites Trained by AZDHS';
$activity13row_0[] = 'Number of Sites Trained by NAA';
$activity13row_0[] = 'Number of Sites Trained by NOIST';
$activity13row_0[] = 'Number of Sites Trained by SHD';
$activity13row_0[] = 'Number of Sites Trained by Other';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$activity13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$activity13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';


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

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}



// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity13row_'.$count} = array();
${'activity13row_'.$count}[] = $name;
${'activity13row_'.$count}[] = $sitescount;
${'activity13row_'.$count}[] = $training_ownstaffcount;
${'activity13row_'.$count}[] = $training_aascccount;
${'activity13row_'.$count}[] = $training_azcasecount;
${'activity13row_'.$count}[] = $training_azdhscount;
${'activity13row_'.$count}[] = $training_naacount;
${'activity13row_'.$count}[] = $training_niostcount;
${'activity13row_'.$count}[] = $training_shdcount;
${'activity13row_'.$count}[] = $training_othercount;
${'activity13row_'.$count}[] = $training_needs2count;
${'activity13row_'.$count}[] = $training_needs3count;
${'activity13row_'.$count}[] = $training_needs4count;
${'activity13row_'.$count}[] = $training_needs5count;
${'activity13row_'.$count}[] = $training_needs6count;
${'activity13row_'.$count}[] = $training_needs7count;
${'activity13row_'.$count}[] = $training_needs8count;
${'activity13row_'.$count}[] = $training_needs9count;
${'activity13row_'.$count}[] = $training_needs11count;
${'activity13row_'.$count}[] = $training_needs10count;
${'activity13row_'.$count}[] = $training_needssecond2count;
${'activity13row_'.$count}[] = $training_needssecond3count;
${'activity13row_'.$count}[] = $training_needssecond4count;
${'activity13row_'.$count}[] = $training_needssecond5count;
${'activity13row_'.$count}[] = $training_needssecond6count;
${'activity13row_'.$count}[] = $training_needssecond7count;
${'activity13row_'.$count}[] = $training_needssecond8count;
${'activity13row_'.$count}[] = $training_needssecond9count;
${'activity13row_'.$count}[] = $training_needssecond11count;
${'activity13row_'.$count}[] = $training_needssecond10count;


// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

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
		<td align=\"right\">$training_ownstaffcount</td>
		<td align=\"right\">$training_aascccount</td>
		<td align=\"right\">$training_azcasecount</td>
		<td align=\"right\">$training_azdhscount</td>
		<td align=\"right\">$training_naacount</td>
		<td align=\"right\">$training_niostcount</td>
		<td align=\"right\">$training_shdcount</td>
		<td align=\"right\">$training_othercount</td>
		<td align=\"right\">$training_needs2count</td>
		<td align=\"right\">$training_needs3count</td>
		<td align=\"right\">$training_needs4count</td>
		<td align=\"right\">$training_needs5count</td>
		<td align=\"right\">$training_needs6count</td>
		<td align=\"right\">$training_needs7count</td>
		<td align=\"right\">$training_needs8count</td>
		<td align=\"right\">$training_needs9count</td>
		<td align=\"right\">$training_needs11count</td>
		<td align=\"right\">$training_needs10count</td>
		<td align=\"right\">$training_needssecond2count</td>
		<td align=\"right\">$training_needssecond3count</td>
		<td align=\"right\">$training_needssecond4count</td>
		<td align=\"right\">$training_needssecond5count</td>
		<td align=\"right\">$training_needssecond6count</td>
		<td align=\"right\">$training_needssecond7count</td>
		<td align=\"right\">$training_needssecond8count</td>
		<td align=\"right\">$training_needssecond9count</td>
		<td align=\"right\">$training_needssecond11count</td>
		<td align=\"right\">$training_needssecond10count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity13file = fopen("export/advancedsearch_activity13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity13file, ${'activity13row_'.$i});
}

fclose($activity13file); 

// table headers
?>
<h4>By Activity</h4>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Train Their Own Staff </th>
		<th>Number of Sites Trained by AASCC</th>
		<th>Number of Sites Trained by AZCASE </th>
		<th>Number of Sites Trained by AZDHS</th>
		<th>Number of Sites Trained by NAA</th>
		<th>Number of Sites Trained by NOIST</th>
		<th>Number of Sites Trained by SHD</th>
		<th>Number of Sites Trained by Other</th>
		<th>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </th>
		<th>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Most Important Area for Staff Training: Other</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($activity13=='t') {


// if by activity is selected
if ($ages13=='t') {

// set up array for csv
$ages13row_0 = array( );
$ages13row_0[] = 'Ages Served';
$ages13row_0[] = 'Number of Sites';
$ages13row_0[] = 'Number of Sites That Train Their Own Staff ';
$ages13row_0[] = 'Number of Sites Trained by AASCC';
$ages13row_0[] = 'Number of Sites Trained by AZCASE ';
$ages13row_0[] = 'Number of Sites Trained by AZDHS';
$ages13row_0[] = 'Number of Sites Trained by NAA';
$ages13row_0[] = 'Number of Sites Trained by NOIST';
$ages13row_0[] = 'Number of Sites Trained by SHD';
$ages13row_0[] = 'Number of Sites Trained by Other';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development ';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Effective Program Operation ';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Health and Safety Issues';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Youth Engagement';
$ages13row_0[] = 'Number of Sites - Most Important Area for Staff Training: Other';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development ';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Youth Engagement';
$ages13row_0[] = 'Number of Sites - Second Most Important Area for Staff Training: Other';


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

// number of sites train their own staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_ownstaff = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_ownstaffcount = pg_result($sitesresult, $lt, 0);
}



// number of sites trained by training_aascc
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_aascc = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_aascccount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azcase
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azcase = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azcasecount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_azdhs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_azdhs = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_azdhscount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_naa
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_naa = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_naacount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_niost
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_niost = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_niostcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_shd
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_shd = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_shdcount = pg_result($sitesresult, $lt, 0);
}

// number of sites training_other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_other = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_othercount = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needs = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needs11count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond2count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond3count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond4count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond5count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond6count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond7count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond8count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 9;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond9count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 10;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond10count = pg_result($sitesresult, $lt, 0);
}

// number of sites most important area in which your staff needs the most training Advancement of Physical/Intellectual Development
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.training_needssecond = 11;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$training_needssecond11count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages13row_'.$count} = array();
${'ages13row_'.$count}[] = $name;
${'ages13row_'.$count}[] = $sitescount;
${'ages13row_'.$count}[] = $training_ownstaffcount;
${'ages13row_'.$count}[] = $training_aascccount;
${'ages13row_'.$count}[] = $training_azcasecount;
${'ages13row_'.$count}[] = $training_azdhscount;
${'ages13row_'.$count}[] = $training_naacount;
${'ages13row_'.$count}[] = $training_niostcount;
${'ages13row_'.$count}[] = $training_shdcount;
${'ages13row_'.$count}[] = $training_othercount;
${'ages13row_'.$count}[] = $training_needs2count;
${'ages13row_'.$count}[] = $training_needs3count;
${'ages13row_'.$count}[] = $training_needs4count;
${'ages13row_'.$count}[] = $training_needs5count;
${'ages13row_'.$count}[] = $training_needs6count;
${'ages13row_'.$count}[] = $training_needs7count;
${'ages13row_'.$count}[] = $training_needs8count;
${'ages13row_'.$count}[] = $training_needs9count;
${'ages13row_'.$count}[] = $training_needs11count;
${'ages13row_'.$count}[] = $training_needs10count;
${'ages13row_'.$count}[] = $training_needssecond2count;
${'ages13row_'.$count}[] = $training_needssecond3count;
${'ages13row_'.$count}[] = $training_needssecond4count;
${'ages13row_'.$count}[] = $training_needssecond5count;
${'ages13row_'.$count}[] = $training_needssecond6count;
${'ages13row_'.$count}[] = $training_needssecond7count;
${'ages13row_'.$count}[] = $training_needssecond8count;
${'ages13row_'.$count}[] = $training_needssecond9count;
${'ages13row_'.$count}[] = $training_needssecond11count;
${'ages13row_'.$count}[] = $training_needssecond10count;


// clean up data for html
$sitescount = number_format($sitescount);
$training_ownstaffcount = number_format($training_ownstaffcount);
$training_aascccount = number_format($training_aascccount);
$training_azcasecount = number_format($training_azcasecount);
$training_azdhscount = number_format($training_azdhscount);
$training_naacount = number_format($training_naacount);
$training_niostcount = number_format($training_niostcount);
$training_shdcount = number_format($training_shdcount);
$training_othercount = number_format($training_othercount);
$training_needs2count = number_format($training_needs2count);
$training_needs3count = number_format($training_needs3count);
$training_needs4count = number_format($training_needs4count);
$training_needs5count = number_format($training_needs5count);
$training_needs6count = number_format($training_needs6count);
$training_needs7count = number_format($training_needs7count);
$training_needs8count = number_format($training_needs8count);
$training_needs9count = number_format($training_needs9count);
$training_needs11count = number_format($training_needs11count);
$training_needs10count = number_format($training_needs10count);
$training_needssecond2count = number_format($training_needssecond2count);
$training_needssecond3count = number_format($training_needssecond3count);
$training_needssecond4count = number_format($training_needssecond4count);
$training_needssecond5count = number_format($training_needssecond5count);
$training_needssecond6count = number_format($training_needssecond6count);
$training_needssecond7count = number_format($training_needssecond7count);
$training_needssecond8count = number_format($training_needssecond8count);
$training_needssecond9count = number_format($training_needssecond9count);
$training_needssecond11count = number_format($training_needssecond11count);
$training_needssecond10count = number_format($training_needssecond10count);

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
		<td align=\"right\">$training_ownstaffcount</td>
		<td align=\"right\">$training_aascccount</td>
		<td align=\"right\">$training_azcasecount</td>
		<td align=\"right\">$training_azdhscount</td>
		<td align=\"right\">$training_naacount</td>
		<td align=\"right\">$training_niostcount</td>
		<td align=\"right\">$training_shdcount</td>
		<td align=\"right\">$training_othercount</td>
		<td align=\"right\">$training_needs2count</td>
		<td align=\"right\">$training_needs3count</td>
		<td align=\"right\">$training_needs4count</td>
		<td align=\"right\">$training_needs5count</td>
		<td align=\"right\">$training_needs6count</td>
		<td align=\"right\">$training_needs7count</td>
		<td align=\"right\">$training_needs8count</td>
		<td align=\"right\">$training_needs9count</td>
		<td align=\"right\">$training_needs11count</td>
		<td align=\"right\">$training_needs10count</td>
		<td align=\"right\">$training_needssecond2count</td>
		<td align=\"right\">$training_needssecond3count</td>
		<td align=\"right\">$training_needssecond4count</td>
		<td align=\"right\">$training_needssecond5count</td>
		<td align=\"right\">$training_needssecond6count</td>
		<td align=\"right\">$training_needssecond7count</td>
		<td align=\"right\">$training_needssecond8count</td>
		<td align=\"right\">$training_needssecond9count</td>
		<td align=\"right\">$training_needssecond11count</td>
		<td align=\"right\">$training_needssecond10count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages13file = fopen("export/advancedsearch_ages13.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages13file, ${'ages13row_'.$i});
}

fclose($ages13file); 

// table headers
?>
<h4>By Ages Served</h4>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Train Their Own Staff </th>
		<th>Number of Sites Trained by AASCC</th>
		<th>Number of Sites Trained by AZCASE </th>
		<th>Number of Sites Trained by AZDHS</th>
		<th>Number of Sites Trained by NAA</th>
		<th>Number of Sites Trained by NOIST</th>
		<th>Number of Sites Trained by SHD</th>
		<th>Number of Sites Trained by Other</th>
		<th>Number of Sites - Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Enhancement of Social and Emotional Development </th>
		<th>Number of Sites - Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Most Important Area for Staff Training: Effective Program Operation </th>
		<th>Number of Sites - Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Most Important Area for Staff Training: Other</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Advancement of Physical/Intellectual Development </th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Enhancement of Social and Emotional Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Positive Relationships with Families</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Observing and Recording Principles of Child Growth and Development</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Commitment to Professionalism</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Effective Program Operation</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Health and Safety Issues</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Availability of Community Services and Resources, including those available to children with special needs</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Youth Engagement</th>
		<th>Number of Sites - Second Most Important Area for Staff Training: Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages13.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($ages13=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
