<?php

$summary10 = $_REQUEST['summary10'];
$cd10 = $_REQUEST['cd10'];
$sld10 = $_REQUEST['sld10'];
$elm10 = $_REQUEST['elm10'];
$union10 = $_REQUEST['union10'];
$city10 = $_REQUEST['city10'];
$activity10 = $_REQUEST['activity10'];
$ages10 = $_REQUEST['ages10'];

if ($summary10=='t' || $cd10=='t' || $sld10=='t' || $elm10=='t' || $union10=='t' || $city10=='t' || $activity10=='t' || $ages10=='t') {

?>
<div class="clear"></div>
<h3>Barriers to Full Attendence</h3>
<?
// if summary table is selected
if ($summary10=='t') {

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
$summary10row_0 = array( );
$summary10row_0[] = 'Category';
$summary10row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary10row_1 = array( );
$summary10row_1[] = 'Number of Sites';
$summary10row_1[] = $sitescount;
$summary10row_2 = array( );
$summary10row_2[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$summary10row_2[] = $barriersfull1count;
$summary10row_3 = array( );
$summary10row_3[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$summary10row_3[] = $barriersfull2count;
$summary10row_4 = array( );
$summary10row_4[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$summary10row_4[] = $barriersfull3count;
$summary10row_5 = array( );
$summary10row_5[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$summary10row_5[] = $barriersfull4count;
$summary10row_6 = array( );
$summary10row_6[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$summary10row_6[] = $barriersfull5count;
$summary10row_7 = array( );
$summary10row_7[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$summary10row_7[] = $barriersfull7count;
$summary10row_8 = array( );
$summary10row_8[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$summary10row_8[] = $barriersfull8count;
$summary10row_9 = array( );
$summary10row_9[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';
$summary10row_9[] = $barriersfull6count;

// build csv file
$summary10file = fopen("export/advancedsearch_summary10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 9; $i++) {
	fputcsv($summary10file, ${'summary10row_'.$i});
}

fclose($summary10file); 


// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </td>
		<td align="right"><?php echo $barriersfull1count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</td>
		<td align="right"><?php echo $barriersfull2count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</td>
		<td align="right"><?php echo $barriersfull3count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</td>
		<td align="right"><?php echo $barriersfull4count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</td>
		<td align="right"><?php echo $barriersfull5count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</td>
		<td align="right"><?php echo $barriersfull7count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</td>
		<td align="right"><?php echo $barriersfull8count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</td>
		<td align="right"><?php echo $barriersfull6count; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd10=='t') {

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
$cd10row_0 = array( );
$cd10row_0[] = 'Congressional District';
$cd10row_0[] = 'Number of Sites';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$cd10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';


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

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($barriersfull1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($barriersfull1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd10row_'.$count} = array();
${'cd10row_'.$count}[] = $gid;
${'cd10row_'.$count}[] = $sitescount;
${'cd10row_'.$count}[] = $barriersfull1count;
${'cd10row_'.$count}[] = $barriersfull2count;
${'cd10row_'.$count}[] = $barriersfull3count;
${'cd10row_'.$count}[] = $barriersfull4count;
${'cd10row_'.$count}[] = $barriersfull5count;
${'cd10row_'.$count}[] = $barriersfull7count;
${'cd10row_'.$count}[] = $barriersfull8count;
${'cd10row_'.$count}[] = $barriersfull6count;



// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

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
		<td align=\"right\">$barriersfull1count</td>
		<td align=\"right\">$barriersfull2count</td>
		<td align=\"right\">$barriersfull3count</td>
		<td align=\"right\">$barriersfull4count</td>
		<td align=\"right\">$barriersfull5count</td>
		<td align=\"right\">$barriersfull7count</td>
		<td align=\"right\">$barriersfull8count</td>
		<td align=\"right\">$barriersfull6count</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest : <strong>$barriersfull1count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens: <strong>$barriersfull2count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation: <strong>$barriersfull3count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff: <strong>$barriersfull4count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged: <strong>$barriersfull5count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception: <strong>$barriersfull7count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception: <strong>$barriersfull8count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other: <strong>$barriersfull6count</strong><br />]]></description>";

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
$cd10file = fopen("export/advancedsearch_congressionaldistrict10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd10file, ${'cd10row_'.$i});
}

fclose($cd10file); 


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
	      <href>http://maps.nijel.org/azcase_dev/azcase/phpadmin/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict10.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h4>By Congressional District</h4>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict10.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?

}else{} // if ($cd10=='t') {


// if by state legislative districts is selected
if ($sld10=='t') {

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
$sld10row_0 = array( );
$sld10row_0[] = 'State Legislaltive District';
$sld10row_0[] = 'Number of Sites';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$sld10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';

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

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($barriersfull1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($barriersfull1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld10row_'.$count} = array();
${'sld10row_'.$count}[] = $gid;
${'sld10row_'.$count}[] = $sitescount;
${'sld10row_'.$count}[] = $barriersfull1count;
${'sld10row_'.$count}[] = $barriersfull2count;
${'sld10row_'.$count}[] = $barriersfull3count;
${'sld10row_'.$count}[] = $barriersfull4count;
${'sld10row_'.$count}[] = $barriersfull5count;
${'sld10row_'.$count}[] = $barriersfull7count;
${'sld10row_'.$count}[] = $barriersfull8count;
${'sld10row_'.$count}[] = $barriersfull6count;


// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

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
		<td align=\"right\">$barriersfull1count</td>
		<td align=\"right\">$barriersfull2count</td>
		<td align=\"right\">$barriersfull3count</td>
		<td align=\"right\">$barriersfull4count</td>
		<td align=\"right\">$barriersfull5count</td>
		<td align=\"right\">$barriersfull7count</td>
		<td align=\"right\">$barriersfull8count</td>
		<td align=\"right\">$barriersfull6count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest : <strong>$barriersfull1count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens: <strong>$barriersfull2count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation: <strong>$barriersfull3count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff: <strong>$barriersfull4count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged: <strong>$barriersfull5count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception: <strong>$barriersfull7count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception: <strong>$barriersfull8count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other: <strong>$barriersfull6count</strong><br />]]></description>";

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
$sld10file = fopen("export/advancedsearch_statelegislativedistrict10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld10file, ${'sld10row_'.$i});
}

fclose($sld10file); 

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
	      <href>http://maps.nijel.org/azcase_dev/azcase/phpadmin/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict10.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By State Legislative District</h4>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict10.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($sld10=='t') {


// if by elementary school distircts is selected
if ($elm10=='t') {

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
$elm10row_0 = array( );
$elm10row_0[] = 'Elementary School District Name';
$elm10row_0[] = 'Number of Sites';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$elm10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';


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

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($barriersfull1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($barriersfull1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm10row_'.$count} = array();
${'elm10row_'.$count}[] = $name;
${'elm10row_'.$count}[] = $sitescount;
${'elm10row_'.$count}[] = $barriersfull1count;
${'elm10row_'.$count}[] = $barriersfull2count;
${'elm10row_'.$count}[] = $barriersfull3count;
${'elm10row_'.$count}[] = $barriersfull4count;
${'elm10row_'.$count}[] = $barriersfull5count;
${'elm10row_'.$count}[] = $barriersfull7count;
${'elm10row_'.$count}[] = $barriersfull8count;
${'elm10row_'.$count}[] = $barriersfull6count;


// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

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
		<td align=\"right\">$barriersfull1count</td>
		<td align=\"right\">$barriersfull2count</td>
		<td align=\"right\">$barriersfull3count</td>
		<td align=\"right\">$barriersfull4count</td>
		<td align=\"right\">$barriersfull5count</td>
		<td align=\"right\">$barriersfull7count</td>
		<td align=\"right\">$barriersfull8count</td>
		<td align=\"right\">$barriersfull6count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest : <strong>$barriersfull1count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens: <strong>$barriersfull2count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation: <strong>$barriersfull3count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff: <strong>$barriersfull4count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged: <strong>$barriersfull5count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception: <strong>$barriersfull7count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception: <strong>$barriersfull8count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other: <strong>$barriersfull6count</strong><br />]]></description>";

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
$elm10file = fopen("export/advancedsearch_elementaryschooldistrict10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm10file, ${'elm10row_'.$i});
}

fclose($elm10file); 

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
	      <href>http://maps.nijel.org/azcase_dev/azcase/phpadmin/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict10.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By Elementary School District</h4>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict10.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($elm10=='t') {


// if by By Secondary/Union School District is selected
if ($union10=='t') {

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
$union10row_0 = array( );
$union10row_0[] = 'Secondary/Union School District Name';
$union10row_0[] = 'Number of Sites';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$union10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';


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

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($barriersfull1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($barriersfull1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union10row_'.$count} = array();
${'union10row_'.$count}[] = $name;
${'union10row_'.$count}[] = $sitescount;
${'union10row_'.$count}[] = $barriersfull1count;
${'union10row_'.$count}[] = $barriersfull2count;
${'union10row_'.$count}[] = $barriersfull3count;
${'union10row_'.$count}[] = $barriersfull4count;
${'union10row_'.$count}[] = $barriersfull5count;
${'union10row_'.$count}[] = $barriersfull7count;
${'union10row_'.$count}[] = $barriersfull8count;
${'union10row_'.$count}[] = $barriersfull6count;


// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

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
		<td align=\"right\">$barriersfull1count</td>
		<td align=\"right\">$barriersfull2count</td>
		<td align=\"right\">$barriersfull3count</td>
		<td align=\"right\">$barriersfull4count</td>
		<td align=\"right\">$barriersfull5count</td>
		<td align=\"right\">$barriersfull7count</td>
		<td align=\"right\">$barriersfull8count</td>
		<td align=\"right\">$barriersfull6count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest : <strong>$barriersfull1count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens: <strong>$barriersfull2count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation: <strong>$barriersfull3count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff: <strong>$barriersfull4count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged: <strong>$barriersfull5count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception: <strong>$barriersfull7count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception: <strong>$barriersfull8count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other: <strong>$barriersfull6count</strong><br />]]></description>";

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
$union10file = fopen("export/advancedsearch_unionschooldistrict10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union10file, ${'union10row_'.$i});
}

fclose($union10file); 

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
	      <href>http://maps.nijel.org/azcase_dev/azcase/phpadmin/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict10.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By Secondary/Union School District</h4>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict10.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($union10=='t') {


// if by az cities is selected
if ($city10=='t') {

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
$city10row_0 = array( );
$city10row_0[] = 'City Name';
$city10row_0[] = 'Number of Sites';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$city10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';


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

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($barriersfull1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($barriersfull1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($barriersfull1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city10row_'.$count} = array();
${'city10row_'.$count}[] = $name;
${'city10row_'.$count}[] = $sitescount;
${'city10row_'.$count}[] = $barriersfull1count;
${'city10row_'.$count}[] = $barriersfull2count;
${'city10row_'.$count}[] = $barriersfull3count;
${'city10row_'.$count}[] = $barriersfull4count;
${'city10row_'.$count}[] = $barriersfull5count;
${'city10row_'.$count}[] = $barriersfull7count;
${'city10row_'.$count}[] = $barriersfull8count;
${'city10row_'.$count}[] = $barriersfull6count;


// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

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
		<td align=\"right\">$barriersfull1count</td>
		<td align=\"right\">$barriersfull2count</td>
		<td align=\"right\">$barriersfull3count</td>
		<td align=\"right\">$barriersfull4count</td>
		<td align=\"right\">$barriersfull5count</td>
		<td align=\"right\">$barriersfull7count</td>
		<td align=\"right\">$barriersfull8count</td>
		<td align=\"right\">$barriersfull6count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <strong>$sitescount</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest : <strong>$barriersfull1count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens: <strong>$barriersfull2count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation: <strong>$barriersfull3count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff: <strong>$barriersfull4count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged: <strong>$barriersfull5count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception: <strong>$barriersfull7count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception: <strong>$barriersfull8count</strong><br />Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other: <strong>$barriersfull6count</strong><br />]]></description>";

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
$city10file = fopen("export/advancedsearch_cities10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city10file, ${'city10row_'.$i});
}

fclose($city10file); 

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
	      <href>http://maps.nijel.org/azcase_dev/azcase/phpadmin/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_cities10.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h4>By City</h4>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities10.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($city10=='t') {


// if by activity is selected
if ($activity10=='t') {

// set up array for csv
$activity10row_0 = array( );
$activity10row_0[] = 'Activity';
$activity10row_0[] = 'Number of Sites';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$activity10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';


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

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity10row_'.$count} = array();
${'activity10row_'.$count}[] = $name;
${'activity10row_'.$count}[] = $sitescount;
${'activity10row_'.$count}[] = $barriersfull1count;
${'activity10row_'.$count}[] = $barriersfull2count;
${'activity10row_'.$count}[] = $barriersfull3count;
${'activity10row_'.$count}[] = $barriersfull4count;
${'activity10row_'.$count}[] = $barriersfull5count;
${'activity10row_'.$count}[] = $barriersfull7count;
${'activity10row_'.$count}[] = $barriersfull8count;
${'activity10row_'.$count}[] = $barriersfull6count;


// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

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
		<td align=\"right\">$barriersfull1count</td>
		<td align=\"right\">$barriersfull2count</td>
		<td align=\"right\">$barriersfull3count</td>
		<td align=\"right\">$barriersfull4count</td>
		<td align=\"right\">$barriersfull5count</td>
		<td align=\"right\">$barriersfull7count</td>
		<td align=\"right\">$barriersfull8count</td>
		<td align=\"right\">$barriersfull6count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity10file = fopen("export/advancedsearch_activity10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity10file, ${'activity10row_'.$i});
}

fclose($activity10file); 

// table headers
?>
<h4>By Activity</h4>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($activity10=='t') {


// if by activity is selected
if ($ages10=='t') {

// set up array for csv
$ages10row_0 = array( );
$ages10row_0[] = 'Ages Served';
$ages10row_0[] = 'Number of Sites';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest ';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception';
$ages10row_0[] = 'Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other';


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
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Children/teens lose interest
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull1count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Insufficient/inadequate recruitment of children/teens
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull2count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of available transportation to the site
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull3count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Lack of staff
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull4count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Program fees charged
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull5count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Other
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull6count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Parent perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull7count = pg_result($sitesresult, $lt, 0);
}

// number fo sites where biggest barrierto operating at full attendence is Child perception
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.barriersfull = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$barriersfull8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages10row_'.$count} = array();
${'ages10row_'.$count}[] = $name;
${'ages10row_'.$count}[] = $sitescount;
${'ages10row_'.$count}[] = $barriersfull1count;
${'ages10row_'.$count}[] = $barriersfull2count;
${'ages10row_'.$count}[] = $barriersfull3count;
${'ages10row_'.$count}[] = $barriersfull4count;
${'ages10row_'.$count}[] = $barriersfull5count;
${'ages10row_'.$count}[] = $barriersfull7count;
${'ages10row_'.$count}[] = $barriersfull8count;
${'ages10row_'.$count}[] = $barriersfull6count;


// clean up data for html
$sitescount = number_format($sitescount);
$barriersfull1count = number_format($barriersfull1count);
$barriersfull2count = number_format($barriersfull2count);
$barriersfull3count = number_format($barriersfull3count);
$barriersfull4count = number_format($barriersfull4count);
$barriersfull5count = number_format($barriersfull5count);
$barriersfull6count = number_format($barriersfull6count);
$barriersfull7count = number_format($barriersfull7count);
$barriersfull8count = number_format($barriersfull8count);

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
		<td align=\"right\">$barriersfull1count</td>
		<td align=\"right\">$barriersfull2count</td>
		<td align=\"right\">$barriersfull3count</td>
		<td align=\"right\">$barriersfull4count</td>
		<td align=\"right\">$barriersfull5count</td>
		<td align=\"right\">$barriersfull7count</td>
		<td align=\"right\">$barriersfull8count</td>
		<td align=\"right\">$barriersfull6count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages10file = fopen("export/advancedsearch_ages10.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages10file, ${'ages10row_'.$i});
}

fclose($ages10file); 

// table headers
?>
<h4>By Ages Served</h4>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Children/Teens Lose Interest </th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Insufficient/Inadequate Recruitment of Children/Teens</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Available Transportation</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Lack of Staff</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Program Fees Charged</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Parent Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Child Perception</th>
		<th>Number of Sites Where Biggest Barrier to Operating at Full Attendence is Other</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages10.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($ages10=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
