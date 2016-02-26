<?php

$summary3 = $_REQUEST['summary3'];
$cd3 = $_REQUEST['cd3'];
$sld3 = $_REQUEST['sld3'];
$elm3 = $_REQUEST['elm3'];
$union3 = $_REQUEST['union3'];
$city3 = $_REQUEST['city3'];
$activity3 = $_REQUEST['activity3'];
$ages3 = $_REQUEST['ages3'];

if ($summary3=='t' || $cd3=='t' || $sld3=='t' || $elm3=='t' || $union3=='t' || $city3=='t' || $activity3=='t' || $ages3=='t') {

?>
<div class="clear"></div>
<h1>Charges, Costs and Finacial Assistance</h1>
<?php
// if summary table is selected
if ($summary3=='t') {

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
$summary3row_0 = array( );
$summary3row_0[] = 'Category';
$summary3row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary3row_1 = array( );
$summary3row_1[] = 'Number of Sites';
$summary3row_1[] = $sitescount;
$summary3row_2 = array( );
$summary3row_2[] = 'Number of Sites That Charge a Fee';
$summary3row_2[] = $chargecount;
$summary3row_3 = array( );
$summary3row_3[] = 'Number of Sites that Charge Weekly';
$summary3row_3[] = $costfrequency1count;
$summary3row_4 = array( );
$summary3row_4[] = 'Average Cost Amount Weekly';
$summary3row_4[] = $costamountavg1;
$summary3row_5 = array( );
$summary3row_5[] = 'Number of Sites that Charge Monthly';
$summary3row_5[] = $costfrequency2count;
$summary3row_6 = array( );
$summary3row_6[] = 'Average Cost Amount Monthly';
$summary3row_6[] = $costamountavg2;
$summary3row_7 = array( );
$summary3row_7[] = 'Number of Sites that Charge Quarterly';
$summary3row_7[] = $costfrequency3count;
$summary3row_8 = array( );
$summary3row_8[] = 'Average Cost Amount Quarterly';
$summary3row_8[] = $costamountavg3;
$summary3row_9 = array( );
$summary3row_9[] = 'Number of Sites that Charge Per School Semester';
$summary3row_9[] = $costfrequency4count;
$summary3row_10 = array( );
$summary3row_10[] = 'Average Cost Amount Per School Semester';
$summary3row_10[] = $costamountavg4;
$summary3row_11 = array( );
$summary3row_11[] = 'Number of Sites that Charge Annually';
$summary3row_11[] = $costfrequency5count;
$summary3row_12 = array( );
$summary3row_12[] = 'Average Cost Amount Annually';
$summary3row_12[] = $costamountavg5;
$summary3row_13 = array( );
$summary3row_13[] = 'Number of Sites that Charge for a Summer Session';
$summary3row_13[] = $costfrequency6count;
$summary3row_14 = array( );
$summary3row_14[] = 'Average Cost Amount Summer Session';
$summary3row_14[] = $costamountavg6;
$summary3row_15 = array( );
$summary3row_15[] = 'Number of Sites Offering Financial Assistance';
$summary3row_15[] = $feeassistancecount;
$summary3row_16 = array( );
$summary3row_16[] = 'Number of Sites Offering Scholarships';
$summary3row_16[] = $scholarshipcount;
$summary3row_17 = array( );
$summary3row_17[] = 'Number of Sites Offering DES Assistance';
$summary3row_17[] = $desassistancecount;
$summary3row_18 = array( );
$summary3row_18[] = 'Number of Sites Offering Multiple Child Discounts';
$summary3row_18[] = $mcdiscountcount;
$summary3row_19 = array( );
$summary3row_19[] = 'Number of Sites Offering Other Finacial Assistance';
$summary3row_19[] = $otherassistancecount;

// build csv file
$summary3file = fopen("export/advancedsearch_summary3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 19; $i++) {
	fputcsv($summary3file, ${'summary3row_'.$i});
}

fclose($summary3file); 


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);
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
		<td>Number of Sites That Charge a Fee</td>
		<td align="right"><?php echo $chargecount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Charge Weekly (Avg. Cost)</td>
		<td align="right"><?php echo $costfrequency1count . ' (' . $costamountavg1 . ')'; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites that Charge Monthly (Avg. Cost)</td>
		<td align="right"><?php echo $costfrequency2count . ' (' . $costamountavg2 . ')'; ?></td>
	</tr>
	<tr>
		<td>Number of Sites that Charge Quarterly (Avg. Cost)</td>
		<td align="right"><?php echo $costfrequency3count . ' (' . $costamountavg3 . ')'; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites that Charge Per School Semester (Avg. Cost)</td>
		<td align="right"><?php echo $costfrequency4count . ' (' . $costamountavg4 . ')'; ?></td>
	</tr>
	<tr>

		<td>Number of Sites that Charge Annually (Avg. Cost)</td>
		<td align="right"><?php echo $costfrequency5count . ' (' . $costamountavg5 . ')'; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites that Charge for a Summer Session (Avg. Cost)</td>
		<td align="right"><?php echo $costfrequency6count . ' (' . $costamountavg6 . ')'; ?></td>
	</tr>
	<tr>

		<td>Number of Sites Offering Financial Assistance</td>
		<td align="right"><?php echo $feeassistancecount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites Offering Scholarships</td>
		<td align="right"><?php echo $scholarshipcount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites Offering DES Assistance</td>
		<td align="right"><?php echo $desassistancecount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites Offering Multiple Child Discounts</td>
		<td align="right"><?php echo $mcdiscountcount; ?></td>
	</tr>
	<tr>

		<td>Number of Sites Offering Other Finacial Assistance</td>
		<td align="right"><?php echo $otherassistancecount; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?php

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd3=='t') {

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
$cd3row_0 = array( );
$cd3row_0[] = 'Congressional District';
$cd3row_0[] = 'Number of Sites';
$cd3row_0[] = 'Number of Sites That Charge a Fee';
$cd3row_0[] = 'Number of Sites that Charge Weekly';
$cd3row_0[] = 'Average Cost Amount Weekly';
$cd3row_0[] = 'Number of Sites that Charge Monthly';
$cd3row_0[] = 'Average Cost Amount Monthly';
$cd3row_0[] = 'Number of Sites that Charge Quarterly';
$cd3row_0[] = 'Average Cost Amount Quarterly';
$cd3row_0[] = 'Number of Sites that Charge Per School Semester';
$cd3row_0[] = 'Average Cost Amount Per School Semester';
$cd3row_0[] = 'Number of Sites that Charge Annually';
$cd3row_0[] = 'Average Cost Amount Annually';
$cd3row_0[] = 'Number of Sites that Charge for a Summer Session';
$cd3row_0[] = 'Average Cost Amount Summer Session';
$cd3row_0[] = 'Number of Sites Offering Financial Assistance';
$cd3row_0[] = 'Number of Sites Offering Scholarships';
$cd3row_0[] = 'Number of Sites Offering DES Assistance';
$cd3row_0[] = 'Number of Sites Offering Multiple Child Discounts';
$cd3row_0[] = 'Number of Sites Offering Other Finacial Assistance';


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

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($chargecount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($chargecount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd3row_'.$count} = array();
${'cd3row_'.$count}[] = $gid;
${'cd3row_'.$count}[] = $sitescount;
${'cd3row_'.$count}[] = $chargecount;
${'cd3row_'.$count}[] = $costfrequency1count;
${'cd3row_'.$count}[] = $costamountavg1;
${'cd3row_'.$count}[] = $costfrequency2count;
${'cd3row_'.$count}[] = $costamountavg2;
${'cd3row_'.$count}[] = $costfrequency3count;
${'cd3row_'.$count}[] = $costamountavg3;
${'cd3row_'.$count}[] = $costfrequency4count;
${'cd3row_'.$count}[] = $costamountavg4;
${'cd3row_'.$count}[] = $costfrequency5count;
${'cd3row_'.$count}[] = $costamountavg5;
${'cd3row_'.$count}[] = $costfrequency6count;
${'cd3row_'.$count}[] = $costamountavg6;
${'cd3row_'.$count}[] = $feeassistancecount;
${'cd3row_'.$count}[] = $scholarshipcount;
${'cd3row_'.$count}[] = $desassistancecount;
${'cd3row_'.$count}[] = $mcdiscountcount;
${'cd3row_'.$count}[] = $otherassistancecount;


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);

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
		<td align=\"right\">$chargecount</td>
		<td align=\"right\">$costfrequency1count ($costamountavg1)</td>
		<td align=\"right\">$costfrequency2count ($costamountavg2)</td>
		<td align=\"right\">$costfrequency3count ($costamountavg3)</td>
		<td align=\"right\">$costfrequency4count ($costamountavg4)</td>
		<td align=\"right\">$costfrequency5count ($costamountavg5)</td>
		<td align=\"right\">$costfrequency6count ($costamountavg6)</td>
		<td align=\"right\">$feeassistancecount</td>
		<td align=\"right\">$scholarshipcount</td>
		<td align=\"right\">$desassistancecount</td>
		<td align=\"right\">$mcdiscountcount</td>
		<td align=\"right\">$otherassistancecount</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Charge a Fee: <b>$chargecount</b><br />Number of Sites that Charge Weekly (Avg. Cost): <b>$costfrequency1count ($costamountavg1)</b><br />Number of Sites that Charge Monthly (Avg. Cost): <b>$costfrequency2count ($costamountavg2)</b><br />Number of Sites that Charge Quarterly (Avg. Cost): <b>$costfrequency3count ($costamountavg3)</b><br />Number of Sites that Charge Per School Semester (Avg. Cost): <b>$costfrequency4count ($costamountavg4)</b><br />Number of Sites that Charge Annually (Avg. Cost): <b>$costfrequency5count ($costamountavg5)</b><br />Number of Sites that Charge for a Summer Session (Avg. Cost): <b>$costfrequency6count ($costamountavg6)</b><br />Number of Sites Offering Financial Assistance: <b>$feeassistancecount</b><br />Number of Sites Offering Scholarships: <b>$scholarshipcount</b><br />Number of Sites Offering DES Assistance: <b>$desassistancecount</b><br />Number of Sites Offering Multiple Child Discounts: <b>$mcdiscountcount</b><br />Number of Sites Offering Other Finacial Assistance: <b>$otherassistancecount</b><br />]]></description>";

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
$cd3file = fopen("export/advancedsearch_congressionaldistrict3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd3file, ${'cd3row_'.$i});
}

fclose($cd3file); 


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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict3.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Charge a Fee</th>
		<th>Number of Sites that Charge Weekly (Avg. Cost)</th>
		<th>Number of Sites that Charge Monthly (Avg. Cost)</th>
		<th>Number of Sites that Charge Quarterly (Avg. Cost)</th>
		<th>Number of Sites that Charge Per School Semester (Avg. Cost)</th>
		<th>Number of Sites that Charge Annually (Avg. Cost)</th>
		<th>Number of Sites that Charge for a Summer Session (Avg. Cost)</th>
		<th>Number of Sites Offering Financial Assistance</th>
		<th>Number of Sites Offering Scholarships</th>
		<th>Number of Sites Offering DES Assistance</th>
		<th>Number of Sites Offering Multiple Child Discounts</th>
		<th>Number of Sites Offering Other Finacial Assistance</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict3.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?php

}else{} // if ($cd3=='t') {


// if by state legislative districts is selected
if ($sld3=='t') {

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
$sld3row_0 = array( );
$sld3row_0[] = 'State Legislaltive District';
$sld3row_0[] = 'Number of Sites';
$sld3row_0[] = 'Number of Sites That Charge a Fee';
$sld3row_0[] = 'Number of Sites that Charge Weekly';
$sld3row_0[] = 'Average Cost Amount Weekly';
$sld3row_0[] = 'Number of Sites that Charge Monthly';
$sld3row_0[] = 'Average Cost Amount Monthly';
$sld3row_0[] = 'Number of Sites that Charge Quarterly';
$sld3row_0[] = 'Average Cost Amount Quarterly';
$sld3row_0[] = 'Number of Sites that Charge Per School Semester';
$sld3row_0[] = 'Average Cost Amount Per School Semester';
$sld3row_0[] = 'Number of Sites that Charge Annually';
$sld3row_0[] = 'Average Cost Amount Annually';
$sld3row_0[] = 'Number of Sites that Charge for a Summer Session';
$sld3row_0[] = 'Average Cost Amount Summer Session';
$sld3row_0[] = 'Number of Sites Offering Financial Assistance';
$sld3row_0[] = 'Number of Sites Offering Scholarships';
$sld3row_0[] = 'Number of Sites Offering DES Assistance';
$sld3row_0[] = 'Number of Sites Offering Multiple Child Discounts';
$sld3row_0[] = 'Number of Sites Offering Other Finacial Assistance';


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

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($chargecount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($chargecount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld3row_'.$count} = array();
${'sld3row_'.$count}[] = $gid;
${'sld3row_'.$count}[] = $sitescount;
${'sld3row_'.$count}[] = $chargecount;
${'sld3row_'.$count}[] = $costfrequency1count;
${'sld3row_'.$count}[] = $costamountavg1;
${'sld3row_'.$count}[] = $costfrequency2count;
${'sld3row_'.$count}[] = $costamountavg2;
${'sld3row_'.$count}[] = $costfrequency3count;
${'sld3row_'.$count}[] = $costamountavg3;
${'sld3row_'.$count}[] = $costfrequency4count;
${'sld3row_'.$count}[] = $costamountavg4;
${'sld3row_'.$count}[] = $costfrequency5count;
${'sld3row_'.$count}[] = $costamountavg5;
${'sld3row_'.$count}[] = $costfrequency6count;
${'sld3row_'.$count}[] = $costamountavg6;
${'sld3row_'.$count}[] = $feeassistancecount;
${'sld3row_'.$count}[] = $scholarshipcount;
${'sld3row_'.$count}[] = $desassistancecount;
${'sld3row_'.$count}[] = $mcdiscountcount;
${'sld3row_'.$count}[] = $otherassistancecount;


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);

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
		<td align=\"right\">$chargecount</td>
		<td align=\"right\">$costfrequency1count ($costamountavg1)</td>
		<td align=\"right\">$costfrequency2count ($costamountavg2)</td>
		<td align=\"right\">$costfrequency3count ($costamountavg3)</td>
		<td align=\"right\">$costfrequency4count ($costamountavg4)</td>
		<td align=\"right\">$costfrequency5count ($costamountavg5)</td>
		<td align=\"right\">$costfrequency6count ($costamountavg6)</td>
		<td align=\"right\">$feeassistancecount</td>
		<td align=\"right\">$scholarshipcount</td>
		<td align=\"right\">$desassistancecount</td>
		<td align=\"right\">$mcdiscountcount</td>
		<td align=\"right\">$otherassistancecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Charge a Fee: <b>$chargecount</b><br />Number of Sites that Charge Weekly (Avg. Cost): <b>$costfrequency1count ($costamountavg1)</b><br />Number of Sites that Charge Monthly (Avg. Cost): <b>$costfrequency2count ($costamountavg2)</b><br />Number of Sites that Charge Quarterly (Avg. Cost): <b>$costfrequency3count ($costamountavg3)</b><br />Number of Sites that Charge Per School Semester (Avg. Cost): <b>$costfrequency4count ($costamountavg4)</b><br />Number of Sites that Charge Annually (Avg. Cost): <b>$costfrequency5count ($costamountavg5)</b><br />Number of Sites that Charge for a Summer Session (Avg. Cost): <b>$costfrequency6count ($costamountavg6)</b><br />Number of Sites Offering Financial Assistance: <b>$feeassistancecount</b><br />Number of Sites Offering Scholarships: <b>$scholarshipcount</b><br />Number of Sites Offering DES Assistance: <b>$desassistancecount</b><br />Number of Sites Offering Multiple Child Discounts: <b>$mcdiscountcount</b><br />Number of Sites Offering Other Finacial Assistance: <b>$otherassistancecount</b><br />]]></description>";

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
$sld3file = fopen("export/advancedsearch_statelegislativedistrict3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld3file, ${'sld3row_'.$i});
}

fclose($sld3file); 

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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict3.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Charge a Fee</th>
		<th>Number of Sites that Charge Weekly (Avg. Cost)</th>
		<th>Number of Sites that Charge Monthly (Avg. Cost)</th>
		<th>Number of Sites that Charge Quarterly (Avg. Cost)</th>
		<th>Number of Sites that Charge Per School Semester (Avg. Cost)</th>
		<th>Number of Sites that Charge Annually (Avg. Cost)</th>
		<th>Number of Sites that Charge for a Summer Session (Avg. Cost)</th>
		<th>Number of Sites Offering Financial Assistance</th>
		<th>Number of Sites Offering Scholarships</th>
		<th>Number of Sites Offering DES Assistance</th>
		<th>Number of Sites Offering Multiple Child Discounts</th>
		<th>Number of Sites Offering Other Finacial Assistance</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict3.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($sld3=='t') {


// if by elementary school distircts is selected
if ($elm3=='t') {

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
$elm3row_0 = array( );
$elm3row_0[] = 'Elementary School District Name';
$elm3row_0[] = 'Number of Sites';
$elm3row_0[] = 'Number of Sites That Charge a Fee';
$elm3row_0[] = 'Number of Sites that Charge Weekly';
$elm3row_0[] = 'Average Cost Amount Weekly';
$elm3row_0[] = 'Number of Sites that Charge Monthly';
$elm3row_0[] = 'Average Cost Amount Monthly';
$elm3row_0[] = 'Number of Sites that Charge Quarterly';
$elm3row_0[] = 'Average Cost Amount Quarterly';
$elm3row_0[] = 'Number of Sites that Charge Per School Semester';
$elm3row_0[] = 'Average Cost Amount Per School Semester';
$elm3row_0[] = 'Number of Sites that Charge Annually';
$elm3row_0[] = 'Average Cost Amount Annually';
$elm3row_0[] = 'Number of Sites that Charge for a Summer Session';
$elm3row_0[] = 'Average Cost Amount Summer Session';
$elm3row_0[] = 'Number of Sites Offering Financial Assistance';
$elm3row_0[] = 'Number of Sites Offering Scholarships';
$elm3row_0[] = 'Number of Sites Offering DES Assistance';
$elm3row_0[] = 'Number of Sites Offering Multiple Child Discounts';
$elm3row_0[] = 'Number of Sites Offering Other Finacial Assistance';


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

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($chargecount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($chargecount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm3row_'.$count} = array();
${'elm3row_'.$count}[] = $name;
${'elm3row_'.$count}[] = $sitescount;
${'elm3row_'.$count}[] = $chargecount;
${'elm3row_'.$count}[] = $costfrequency1count;
${'elm3row_'.$count}[] = $costamountavg1;
${'elm3row_'.$count}[] = $costfrequency2count;
${'elm3row_'.$count}[] = $costamountavg2;
${'elm3row_'.$count}[] = $costfrequency3count;
${'elm3row_'.$count}[] = $costamountavg3;
${'elm3row_'.$count}[] = $costfrequency4count;
${'elm3row_'.$count}[] = $costamountavg4;
${'elm3row_'.$count}[] = $costfrequency5count;
${'elm3row_'.$count}[] = $costamountavg5;
${'elm3row_'.$count}[] = $costfrequency6count;
${'elm3row_'.$count}[] = $costamountavg6;
${'elm3row_'.$count}[] = $feeassistancecount;
${'elm3row_'.$count}[] = $scholarshipcount;
${'elm3row_'.$count}[] = $desassistancecount;
${'elm3row_'.$count}[] = $mcdiscountcount;
${'elm3row_'.$count}[] = $otherassistancecount;


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);

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
		<td align=\"right\">$chargecount</td>
		<td align=\"right\">$costfrequency1count ($costamountavg1)</td>
		<td align=\"right\">$costfrequency2count ($costamountavg2)</td>
		<td align=\"right\">$costfrequency3count ($costamountavg3)</td>
		<td align=\"right\">$costfrequency4count ($costamountavg4)</td>
		<td align=\"right\">$costfrequency5count ($costamountavg5)</td>
		<td align=\"right\">$costfrequency6count ($costamountavg6)</td>
		<td align=\"right\">$feeassistancecount</td>
		<td align=\"right\">$scholarshipcount</td>
		<td align=\"right\">$desassistancecount</td>
		<td align=\"right\">$mcdiscountcount</td>
		<td align=\"right\">$otherassistancecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Charge a Fee: <b>$chargecount</b><br />Number of Sites that Charge Weekly (Avg. Cost): <b>$costfrequency1count ($costamountavg1)</b><br />Number of Sites that Charge Monthly (Avg. Cost): <b>$costfrequency2count ($costamountavg2)</b><br />Number of Sites that Charge Quarterly (Avg. Cost): <b>$costfrequency3count ($costamountavg3)</b><br />Number of Sites that Charge Per School Semester (Avg. Cost): <b>$costfrequency4count ($costamountavg4)</b><br />Number of Sites that Charge Annually (Avg. Cost): <b>$costfrequency5count ($costamountavg5)</b><br />Number of Sites that Charge for a Summer Session (Avg. Cost): <b>$costfrequency6count ($costamountavg6)</b><br />Number of Sites Offering Financial Assistance: <b>$feeassistancecount</b><br />Number of Sites Offering Scholarships: <b>$scholarshipcount</b><br />Number of Sites Offering DES Assistance: <b>$desassistancecount</b><br />Number of Sites Offering Multiple Child Discounts: <b>$mcdiscountcount</b><br />Number of Sites Offering Other Finacial Assistance: <b>$otherassistancecount</b><br />]]></description>";

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
$elm3file = fopen("export/advancedsearch_elementaryschooldistrict3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm3file, ${'elm3row_'.$i});
}

fclose($elm3file); 

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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict3.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Charge a Fee</th>
		<th>Number of Sites that Charge Weekly (Avg. Cost)</th>
		<th>Number of Sites that Charge Monthly (Avg. Cost)</th>
		<th>Number of Sites that Charge Quarterly (Avg. Cost)</th>
		<th>Number of Sites that Charge Per School Semester (Avg. Cost)</th>
		<th>Number of Sites that Charge Annually (Avg. Cost)</th>
		<th>Number of Sites that Charge for a Summer Session (Avg. Cost)</th>
		<th>Number of Sites Offering Financial Assistance</th>
		<th>Number of Sites Offering Scholarships</th>
		<th>Number of Sites Offering DES Assistance</th>
		<th>Number of Sites Offering Multiple Child Discounts</th>
		<th>Number of Sites Offering Other Finacial Assistance</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict3.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($elm3=='t') {


// if by By Secondary/Union School District is selected
if ($union3=='t') {

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
$union3row_0 = array( );
$union3row_0[] = 'Secondary/Union School District Name';
$union3row_0[] = 'Number of Sites';
$union3row_0[] = 'Number of Sites That Charge a Fee';
$union3row_0[] = 'Number of Sites that Charge Weekly';
$union3row_0[] = 'Average Cost Amount Weekly';
$union3row_0[] = 'Number of Sites that Charge Monthly';
$union3row_0[] = 'Average Cost Amount Monthly';
$union3row_0[] = 'Number of Sites that Charge Quarterly';
$union3row_0[] = 'Average Cost Amount Quarterly';
$union3row_0[] = 'Number of Sites that Charge Per School Semester';
$union3row_0[] = 'Average Cost Amount Per School Semester';
$union3row_0[] = 'Number of Sites that Charge Annually';
$union3row_0[] = 'Average Cost Amount Annually';
$union3row_0[] = 'Number of Sites that Charge for a Summer Session';
$union3row_0[] = 'Average Cost Amount Summer Session';
$union3row_0[] = 'Number of Sites Offering Financial Assistance';
$union3row_0[] = 'Number of Sites Offering Scholarships';
$union3row_0[] = 'Number of Sites Offering DES Assistance';
$union3row_0[] = 'Number of Sites Offering Multiple Child Discounts';
$union3row_0[] = 'Number of Sites Offering Other Finacial Assistance';


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

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($chargecount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($chargecount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union3row_'.$count} = array();
${'union3row_'.$count}[] = $name;
${'union3row_'.$count}[] = $sitescount;
${'union3row_'.$count}[] = $chargecount;
${'union3row_'.$count}[] = $costfrequency1count;
${'union3row_'.$count}[] = $costamountavg1;
${'union3row_'.$count}[] = $costfrequency2count;
${'union3row_'.$count}[] = $costamountavg2;
${'union3row_'.$count}[] = $costfrequency3count;
${'union3row_'.$count}[] = $costamountavg3;
${'union3row_'.$count}[] = $costfrequency4count;
${'union3row_'.$count}[] = $costamountavg4;
${'union3row_'.$count}[] = $costfrequency5count;
${'union3row_'.$count}[] = $costamountavg5;
${'union3row_'.$count}[] = $costfrequency6count;
${'union3row_'.$count}[] = $costamountavg6;
${'union3row_'.$count}[] = $feeassistancecount;
${'union3row_'.$count}[] = $scholarshipcount;
${'union3row_'.$count}[] = $desassistancecount;
${'union3row_'.$count}[] = $mcdiscountcount;
${'union3row_'.$count}[] = $otherassistancecount;


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);

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
		<td align=\"right\">$chargecount</td>
		<td align=\"right\">$costfrequency1count ($costamountavg1)</td>
		<td align=\"right\">$costfrequency2count ($costamountavg2)</td>
		<td align=\"right\">$costfrequency3count ($costamountavg3)</td>
		<td align=\"right\">$costfrequency4count ($costamountavg4)</td>
		<td align=\"right\">$costfrequency5count ($costamountavg5)</td>
		<td align=\"right\">$costfrequency6count ($costamountavg6)</td>
		<td align=\"right\">$feeassistancecount</td>
		<td align=\"right\">$scholarshipcount</td>
		<td align=\"right\">$desassistancecount</td>
		<td align=\"right\">$mcdiscountcount</td>
		<td align=\"right\">$otherassistancecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Charge a Fee: <b>$chargecount</b><br />Number of Sites that Charge Weekly (Avg. Cost): <b>$costfrequency1count ($costamountavg1)</b><br />Number of Sites that Charge Monthly (Avg. Cost): <b>$costfrequency2count ($costamountavg2)</b><br />Number of Sites that Charge Quarterly (Avg. Cost): <b>$costfrequency3count ($costamountavg3)</b><br />Number of Sites that Charge Per School Semester (Avg. Cost): <b>$costfrequency4count ($costamountavg4)</b><br />Number of Sites that Charge Annually (Avg. Cost): <b>$costfrequency5count ($costamountavg5)</b><br />Number of Sites that Charge for a Summer Session (Avg. Cost): <b>$costfrequency6count ($costamountavg6)</b><br />Number of Sites Offering Financial Assistance: <b>$feeassistancecount</b><br />Number of Sites Offering Scholarships: <b>$scholarshipcount</b><br />Number of Sites Offering DES Assistance: <b>$desassistancecount</b><br />Number of Sites Offering Multiple Child Discounts: <b>$mcdiscountcount</b><br />Number of Sites Offering Other Finacial Assistance: <b>$otherassistancecount</b><br />]]></description>";

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
$union3file = fopen("export/advancedsearch_unionschooldistrict3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union3file, ${'union3row_'.$i});
}

fclose($union3file); 

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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict3.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Charge a Fee</th>
		<th>Number of Sites that Charge Weekly (Avg. Cost)</th>
		<th>Number of Sites that Charge Monthly (Avg. Cost)</th>
		<th>Number of Sites that Charge Quarterly (Avg. Cost)</th>
		<th>Number of Sites that Charge Per School Semester (Avg. Cost)</th>
		<th>Number of Sites that Charge Annually (Avg. Cost)</th>
		<th>Number of Sites that Charge for a Summer Session (Avg. Cost)</th>
		<th>Number of Sites Offering Financial Assistance</th>
		<th>Number of Sites Offering Scholarships</th>
		<th>Number of Sites Offering DES Assistance</th>
		<th>Number of Sites Offering Multiple Child Discounts</th>
		<th>Number of Sites Offering Other Finacial Assistance</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict3.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($union3=='t') {


// if by az cities is selected
if ($city3=='t') {

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
$city3row_0 = array( );
$city3row_0[] = 'City Name';
$city3row_0[] = 'Number of Sites';
$city3row_0[] = 'Number of Sites That Charge a Fee';
$city3row_0[] = 'Number of Sites that Charge Weekly';
$city3row_0[] = 'Average Cost Amount Weekly';
$city3row_0[] = 'Number of Sites that Charge Monthly';
$city3row_0[] = 'Average Cost Amount Monthly';
$city3row_0[] = 'Number of Sites that Charge Quarterly';
$city3row_0[] = 'Average Cost Amount Quarterly';
$city3row_0[] = 'Number of Sites that Charge Per School Semester';
$city3row_0[] = 'Average Cost Amount Per School Semester';
$city3row_0[] = 'Number of Sites that Charge Annually';
$city3row_0[] = 'Average Cost Amount Annually';
$city3row_0[] = 'Number of Sites that Charge for a Summer Session';
$city3row_0[] = 'Average Cost Amount Summer Session';
$city3row_0[] = 'Number of Sites Offering Financial Assistance';
$city3row_0[] = 'Number of Sites Offering Scholarships';
$city3row_0[] = 'Number of Sites Offering DES Assistance';
$city3row_0[] = 'Number of Sites Offering Multiple Child Discounts';
$city3row_0[] = 'Number of Sites Offering Other Finacial Assistance';


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

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($chargecount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($chargecount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($chargecount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city3row_'.$count} = array();
${'city3row_'.$count}[] = $name;
${'city3row_'.$count}[] = $sitescount;
${'city3row_'.$count}[] = $chargecount;
${'city3row_'.$count}[] = $costfrequency1count;
${'city3row_'.$count}[] = $costamountavg1;
${'city3row_'.$count}[] = $costfrequency2count;
${'city3row_'.$count}[] = $costamountavg2;
${'city3row_'.$count}[] = $costfrequency3count;
${'city3row_'.$count}[] = $costamountavg3;
${'city3row_'.$count}[] = $costfrequency4count;
${'city3row_'.$count}[] = $costamountavg4;
${'city3row_'.$count}[] = $costfrequency5count;
${'city3row_'.$count}[] = $costamountavg5;
${'city3row_'.$count}[] = $costfrequency6count;
${'city3row_'.$count}[] = $costamountavg6;
${'city3row_'.$count}[] = $feeassistancecount;
${'city3row_'.$count}[] = $scholarshipcount;
${'city3row_'.$count}[] = $desassistancecount;
${'city3row_'.$count}[] = $mcdiscountcount;
${'city3row_'.$count}[] = $otherassistancecount;


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);

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
		<td align=\"right\">$chargecount</td>
		<td align=\"right\">$costfrequency1count ($costamountavg1)</td>
		<td align=\"right\">$costfrequency2count ($costamountavg2)</td>
		<td align=\"right\">$costfrequency3count ($costamountavg3)</td>
		<td align=\"right\">$costfrequency4count ($costamountavg4)</td>
		<td align=\"right\">$costfrequency5count ($costamountavg5)</td>
		<td align=\"right\">$costfrequency6count ($costamountavg6)</td>
		<td align=\"right\">$feeassistancecount</td>
		<td align=\"right\">$scholarshipcount</td>
		<td align=\"right\">$desassistancecount</td>
		<td align=\"right\">$mcdiscountcount</td>
		<td align=\"right\">$otherassistancecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Charge a Fee: <b>$chargecount</b><br />Number of Sites that Charge Weekly (Avg. Cost): <b>$costfrequency1count ($costamountavg1)</b><br />Number of Sites that Charge Monthly (Avg. Cost): <b>$costfrequency2count ($costamountavg2)</b><br />Number of Sites that Charge Quarterly (Avg. Cost): <b>$costfrequency3count ($costamountavg3)</b><br />Number of Sites that Charge Per School Semester (Avg. Cost): <b>$costfrequency4count ($costamountavg4)</b><br />Number of Sites that Charge Annually (Avg. Cost): <b>$costfrequency5count ($costamountavg5)</b><br />Number of Sites that Charge for a Summer Session (Avg. Cost): <b>$costfrequency6count ($costamountavg6)</b><br />Number of Sites Offering Financial Assistance: <b>$feeassistancecount</b><br />Number of Sites Offering Scholarships: <b>$scholarshipcount</b><br />Number of Sites Offering DES Assistance: <b>$desassistancecount</b><br />Number of Sites Offering Multiple Child Discounts: <b>$mcdiscountcount</b><br />Number of Sites Offering Other Finacial Assistance: <b>$otherassistancecount</b><br />]]></description>";

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
$city3file = fopen("export/advancedsearch_cities3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city3file, ${'city3row_'.$i});
}

fclose($city3file); 

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

$locationkmlfile = fopen("export/advancedsearch_cities3.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Charge a Fee</th>
		<th>Number of Sites that Charge Weekly (Avg. Cost)</th>
		<th>Number of Sites that Charge Monthly (Avg. Cost)</th>
		<th>Number of Sites that Charge Quarterly (Avg. Cost)</th>
		<th>Number of Sites that Charge Per School Semester (Avg. Cost)</th>
		<th>Number of Sites that Charge Annually (Avg. Cost)</th>
		<th>Number of Sites that Charge for a Summer Session (Avg. Cost)</th>
		<th>Number of Sites Offering Financial Assistance</th>
		<th>Number of Sites Offering Scholarships</th>
		<th>Number of Sites Offering DES Assistance</th>
		<th>Number of Sites Offering Multiple Child Discounts</th>
		<th>Number of Sites Offering Other Finacial Assistance</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities3.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($city3=='t') {


// if by activity is selected
if ($activity3=='t') {

// set up array for csv
$activity3row_0 = array( );
$activity3row_0[] = 'Activity';
$activity3row_0[] = 'Number of Sites';
$activity3row_0[] = 'Number of Sites That Charge a Fee';
$activity3row_0[] = 'Number of Sites that Charge Weekly';
$activity3row_0[] = 'Average Cost Amount Weekly';
$activity3row_0[] = 'Number of Sites that Charge Monthly';
$activity3row_0[] = 'Average Cost Amount Monthly';
$activity3row_0[] = 'Number of Sites that Charge Quarterly';
$activity3row_0[] = 'Average Cost Amount Quarterly';
$activity3row_0[] = 'Number of Sites that Charge Per School Semester';
$activity3row_0[] = 'Average Cost Amount Per School Semester';
$activity3row_0[] = 'Number of Sites that Charge Annually';
$activity3row_0[] = 'Average Cost Amount Annually';
$activity3row_0[] = 'Number of Sites that Charge for a Summer Session';
$activity3row_0[] = 'Average Cost Amount Summer Session';
$activity3row_0[] = 'Number of Sites Offering Financial Assistance';
$activity3row_0[] = 'Number of Sites Offering Scholarships';
$activity3row_0[] = 'Number of Sites Offering DES Assistance';
$activity3row_0[] = 'Number of Sites Offering Multiple Child Discounts';
$activity3row_0[] = 'Number of Sites Offering Other Finacial Assistance';


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

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity3row_'.$count} = array();
${'activity3row_'.$count}[] = $name;
${'activity3row_'.$count}[] = $sitescount;
${'activity3row_'.$count}[] = $chargecount;
${'activity3row_'.$count}[] = $costfrequency1count;
${'activity3row_'.$count}[] = $costamountavg1;
${'activity3row_'.$count}[] = $costfrequency2count;
${'activity3row_'.$count}[] = $costamountavg2;
${'activity3row_'.$count}[] = $costfrequency3count;
${'activity3row_'.$count}[] = $costamountavg3;
${'activity3row_'.$count}[] = $costfrequency4count;
${'activity3row_'.$count}[] = $costamountavg4;
${'activity3row_'.$count}[] = $costfrequency5count;
${'activity3row_'.$count}[] = $costamountavg5;
${'activity3row_'.$count}[] = $costfrequency6count;
${'activity3row_'.$count}[] = $costamountavg6;
${'activity3row_'.$count}[] = $feeassistancecount;
${'activity3row_'.$count}[] = $scholarshipcount;
${'activity3row_'.$count}[] = $desassistancecount;
${'activity3row_'.$count}[] = $mcdiscountcount;
${'activity3row_'.$count}[] = $otherassistancecount;


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);

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
		<td align=\"right\">$chargecount</td>
		<td align=\"right\">$costfrequency1count ($costamountavg1)</td>
		<td align=\"right\">$costfrequency2count ($costamountavg2)</td>
		<td align=\"right\">$costfrequency3count ($costamountavg3)</td>
		<td align=\"right\">$costfrequency4count ($costamountavg4)</td>
		<td align=\"right\">$costfrequency5count ($costamountavg5)</td>
		<td align=\"right\">$costfrequency6count ($costamountavg6)</td>
		<td align=\"right\">$feeassistancecount</td>
		<td align=\"right\">$scholarshipcount</td>
		<td align=\"right\">$desassistancecount</td>
		<td align=\"right\">$mcdiscountcount</td>
		<td align=\"right\">$otherassistancecount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity3file = fopen("export/advancedsearch_activity3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity3file, ${'activity3row_'.$i});
}

fclose($activity3file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Charge a Fee</th>
		<th>Number of Sites that Charge Weekly (Avg. Cost)</th>
		<th>Number of Sites that Charge Monthly (Avg. Cost)</th>
		<th>Number of Sites that Charge Quarterly (Avg. Cost)</th>
		<th>Number of Sites that Charge Per School Semester (Avg. Cost)</th>
		<th>Number of Sites that Charge Annually (Avg. Cost)</th>
		<th>Number of Sites that Charge for a Summer Session (Avg. Cost)</th>
		<th>Number of Sites Offering Financial Assistance</th>
		<th>Number of Sites Offering Scholarships</th>
		<th>Number of Sites Offering DES Assistance</th>
		<th>Number of Sites Offering Multiple Child Discounts</th>
		<th>Number of Sites Offering Other Finacial Assistance</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($activity3=='t') {


// if by activity is selected
if ($ages3=='t') {

// set up array for csv
$ages3row_0 = array( );
$ages3row_0[] = 'Ages Served';
$ages3row_0[] = 'Number of Sites';
$ages3row_0[] = 'Number of Sites That Charge a Fee';
$ages3row_0[] = 'Number of Sites that Charge Weekly';
$ages3row_0[] = 'Average Cost Amount Weekly';
$ages3row_0[] = 'Number of Sites that Charge Monthly';
$ages3row_0[] = 'Average Cost Amount Monthly';
$ages3row_0[] = 'Number of Sites that Charge Quarterly';
$ages3row_0[] = 'Average Cost Amount Quarterly';
$ages3row_0[] = 'Number of Sites that Charge Per School Semester';
$ages3row_0[] = 'Average Cost Amount Per School Semester';
$ages3row_0[] = 'Number of Sites that Charge Annually';
$ages3row_0[] = 'Average Cost Amount Annually';
$ages3row_0[] = 'Number of Sites that Charge for a Summer Session';
$ages3row_0[] = 'Average Cost Amount Summer Session';
$ages3row_0[] = 'Number of Sites Offering Financial Assistance';
$ages3row_0[] = 'Number of Sites Offering Scholarships';
$ages3row_0[] = 'Number of Sites Offering DES Assistance';
$ages3row_0[] = 'Number of Sites Offering Multiple Child Discounts';
$ages3row_0[] = 'Number of Sites Offering Other Finacial Assistance';


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

// Total number of sites that charge a fee
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$chargecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Weekly (1)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency1count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Weekly (1)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg1 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Monthly (2)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency2count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Monthly (2)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg2 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Quarterly (3)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency3count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Quarterly (3)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg3 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Per School Semester (4)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency4count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Per School Semester (4)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg4 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Annual (5)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency5count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Annual (5)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg5 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where charge frequency is Summer (6)
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costfrequency6count = pg_result($sitesresult, $lt, 0);
}

// Average cost amount Summer (6)
$sitescountquery = "SELECT avg(a.costamount) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.charge = TRUE AND a.costfrequency = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$costamountavg6 = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with fee assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.feeassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$feeassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with DES assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.desassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$desassistancecount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering scholarships
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.scholarship = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$scholarshipcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering MC discounts
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.mcdiscount = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$mcdiscountcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites offering other financial assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherassistance = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherassistancecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages3row_'.$count} = array();
${'ages3row_'.$count}[] = $name;
${'ages3row_'.$count}[] = $sitescount;
${'ages3row_'.$count}[] = $chargecount;
${'ages3row_'.$count}[] = $costfrequency1count;
${'ages3row_'.$count}[] = $costamountavg1;
${'ages3row_'.$count}[] = $costfrequency2count;
${'ages3row_'.$count}[] = $costamountavg2;
${'ages3row_'.$count}[] = $costfrequency3count;
${'ages3row_'.$count}[] = $costamountavg3;
${'ages3row_'.$count}[] = $costfrequency4count;
${'ages3row_'.$count}[] = $costamountavg4;
${'ages3row_'.$count}[] = $costfrequency5count;
${'ages3row_'.$count}[] = $costamountavg5;
${'ages3row_'.$count}[] = $costfrequency6count;
${'ages3row_'.$count}[] = $costamountavg6;
${'ages3row_'.$count}[] = $feeassistancecount;
${'ages3row_'.$count}[] = $scholarshipcount;
${'ages3row_'.$count}[] = $desassistancecount;
${'ages3row_'.$count}[] = $mcdiscountcount;
${'ages3row_'.$count}[] = $otherassistancecount;


// clean up data for html
$sitescount = number_format($sitescount);
$chargecount = number_format($chargecount);
$costfrequency1count = number_format($costfrequency1count);
$costamountavg1 = '$' . number_format($costamountavg1, 2);
$costfrequency2count = number_format($costfrequency2count);
$costamountavg2 = '$' . number_format($costamountavg2, 2);
$costfrequency3count = number_format($costfrequency3count);
$costamountavg3 = '$' . number_format($costamountavg3, 2);
$costfrequency4count = number_format($costfrequency4count);
$costamountavg4 = '$' . number_format($costamountavg4, 2);
$costfrequency5count = number_format($costfrequency5count);
$costamountavg5 = '$' . number_format($costamountavg5, 2);
$costfrequency6count = number_format($costfrequency6count);
$costamountavg6 = '$' . number_format($costamountavg6, 2);
$feeassistancecount = number_format($feeassistancecount);
$scholarshipcount = number_format($scholarshipcount);
$desassistancecount = number_format($desassistancecount);
$mcdiscountcount = number_format($mcdiscountcount);
$otherassistancecount = number_format($otherassistancecount);

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
		<td align=\"right\">$chargecount</td>
		<td align=\"right\">$costfrequency1count ($costamountavg1)</td>
		<td align=\"right\">$costfrequency2count ($costamountavg2)</td>
		<td align=\"right\">$costfrequency3count ($costamountavg3)</td>
		<td align=\"right\">$costfrequency4count ($costamountavg4)</td>
		<td align=\"right\">$costfrequency5count ($costamountavg5)</td>
		<td align=\"right\">$costfrequency6count ($costamountavg6)</td>
		<td align=\"right\">$feeassistancecount</td>
		<td align=\"right\">$scholarshipcount</td>
		<td align=\"right\">$desassistancecount</td>
		<td align=\"right\">$mcdiscountcount</td>
		<td align=\"right\">$otherassistancecount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages3file = fopen("export/advancedsearch_ages3.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages3file, ${'ages3row_'.$i});
}

fclose($ages3file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Charge a Fee</th>
		<th>Number of Sites that Charge Weekly (Avg. Cost)</th>
		<th>Number of Sites that Charge Monthly (Avg. Cost)</th>
		<th>Number of Sites that Charge Quarterly (Avg. Cost)</th>
		<th>Number of Sites that Charge Per School Semester (Avg. Cost)</th>
		<th>Number of Sites that Charge Annually (Avg. Cost)</th>
		<th>Number of Sites that Charge for a Summer Session (Avg. Cost)</th>
		<th>Number of Sites Offering Financial Assistance</th>
		<th>Number of Sites Offering Scholarships</th>
		<th>Number of Sites Offering DES Assistance</th>
		<th>Number of Sites Offering Multiple Child Discounts</th>
		<th>Number of Sites Offering Other Finacial Assistance</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages3.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($ages3=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
