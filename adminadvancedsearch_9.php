<?php

$summary9 = $_REQUEST['summary9'];
$cd9 = $_REQUEST['cd9'];
$sld9 = $_REQUEST['sld9'];
$elm9 = $_REQUEST['elm9'];
$union9 = $_REQUEST['union9'];
$city9 = $_REQUEST['city9'];
$activity9 = $_REQUEST['activity9'];
$ages9 = $_REQUEST['ages9'];

if ($summary9=='t' || $cd9=='t' || $sld9=='t' || $elm9=='t' || $union9=='t' || $city9=='t' || $activity9=='t' || $ages9=='t') {

?>
<div class="clear"></div>
<h1>Budget Proportion</h1>
<?
// if summary table is selected
if ($summary9=='t') {

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
$summary9row_0 = array( );
$summary9row_0[] = 'Category';
$summary9row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary9row_1 = array( );
$summary9row_1[] = 'Number of Sites';
$summary9row_1[] = $sitescount;
$summary9row_2 = array( );
$summary9row_2[] = 'Average Percentage of Program Budget From Federal Government';
$summary9row_2[] = $budgetfederalavg;
$summary9row_3 = array( );
$summary9row_3[] = 'Average Percentage of Program Budget From State or Local Government';
$summary9row_3[] = $budgetlocalavg;
$summary9row_4 = array( );
$summary9row_4[] = 'Average Percentage of Program Budget From Parent Fees';
$summary9row_4[] = $budgetfeesavg;
$summary9row_5 = array( );
$summary9row_5[] = 'Average Percentage of Program Budget From Grants';
$summary9row_5[] = $budgetgrantavg;
$summary9row_6 = array( );
$summary9row_6[] = 'Average Percentage of Program Budget From Religious Organizations';
$summary9row_6[] = $budgetreligiousavg;

// build csv file
$summary9file = fopen("export/advancedsearch_summary9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 6; $i++) {
	fputcsv($summary9file, ${'summary9row_'.$i});
}

fclose($summary9file); 


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Percentage of Program Budget From Federal Government</td>
		<td align="right"><?php echo $budgetfederalavg; ?></td>
	</tr>
	<tr>
		<td>Average Percentage of Program Budget From State or Local Government</td>
		<td align="right"><?php echo $budgetlocalavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Percentage of Program Budget From Parent Fees</td>
		<td align="right"><?php echo $budgetfeesavg; ?></td>
	</tr>
	<tr>
		<td>Average Percentage of Program Budget From Grants</td>
		<td align="right"><?php echo $budgetgrantavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Percentage of Program Budget From Religious Organizations</td>
		<td align="right"><?php echo $budgetreligiousavg; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd9=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';


// set up array for csv
$cd9row_0 = array( );
$cd9row_0[] = 'Congressional District';
$cd9row_0[] = 'Number of Sites';
$cd9row_0[] = 'Average Percentage of Program Budget From Federal Government';
$cd9row_0[] = 'Average Percentage of Program Budget From State or Local Government';
$cd9row_0[] = 'Average Percentage of Program Budget From Parent Fees';
$cd9row_0[] = 'Average Percentage of Program Budget From Grants';
$cd9row_0[] = 'Average Percentage of Program Budget From Religious Organizations';


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

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($budgetfederalavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($budgetfederalavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($budgetfederalavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($budgetfederalavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($budgetfederalavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd9row_'.$count} = array();
${'cd9row_'.$count}[] = $gid;
${'cd9row_'.$count}[] = $sitescount;
${'cd9row_'.$count}[] = $budgetfederalavg;
${'cd9row_'.$count}[] = $budgetlocalavg;
${'cd9row_'.$count}[] = $budgetfeesavg;
${'cd9row_'.$count}[] = $budgetgrantavg;
${'cd9row_'.$count}[] = $budgetreligiousavg;


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

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
		<td align=\"right\">$budgetfederalavg</td>
		<td align=\"right\">$budgetlocalavg</td>
		<td align=\"right\">$budgetfeesavg</td>
		<td align=\"right\">$budgetgrantavg</td>
		<td align=\"right\">$budgetreligiousavg</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of Program Budget From Federal Government: <b>$budgetfederalavg</b><br />Average Percentage of Program Budget From State or Local Government: <b>$budgetlocalavg</b><br />Average Percentage of Program Budget From Parent Fees: <b>$budgetfeesavg</b><br />Average Percentage of Program Budget From Grants: <b>$budgetgrantavg</b><br />Average Percentage of Program Budget From Religious Organizations: <b>$budgetreligiousavg</b><br />]]></description>";

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
$cd9file = fopen("export/advancedsearch_congressionaldistrict9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd9file, ${'cd9row_'.$i});
}

fclose($cd9file); 


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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict9.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Average Percentage of Program Budget From Federal Government</th>
		<th>Average Percentage of Program Budget From State or Local Government</th>
		<th>Average Percentage of Program Budget From Parent Fees</th>
		<th>Average Percentage of Program Budget From Grants</th>
		<th>Average Percentage of Program Budget From Religious Organizations</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict9.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?

}else{} // if ($cd9=='t') {


// if by state legislative districts is selected
if ($sld9=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';


// set up array for csv
$sld9row_0 = array( );
$sld9row_0[] = 'State Legislaltive District';
$sld9row_0[] = 'Number of Sites';
$sld9row_0[] = 'Average Percentage of Program Budget From Federal Government';
$sld9row_0[] = 'Average Percentage of Program Budget From State or Local Government';
$sld9row_0[] = 'Average Percentage of Program Budget From Parent Fees';
$sld9row_0[] = 'Average Percentage of Program Budget From Grants';
$sld9row_0[] = 'Average Percentage of Program Budget From Religious Organizations';

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

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($budgetfederalavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($budgetfederalavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($budgetfederalavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($budgetfederalavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($budgetfederalavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld9row_'.$count} = array();
${'sld9row_'.$count}[] = $gid;
${'sld9row_'.$count}[] = $sitescount;
${'sld9row_'.$count}[] = $budgetfederalavg;
${'sld9row_'.$count}[] = $budgetlocalavg;
${'sld9row_'.$count}[] = $budgetfeesavg;
${'sld9row_'.$count}[] = $budgetgrantavg;
${'sld9row_'.$count}[] = $budgetreligiousavg;


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

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
		<td align=\"right\">$budgetfederalavg</td>
		<td align=\"right\">$budgetlocalavg</td>
		<td align=\"right\">$budgetfeesavg</td>
		<td align=\"right\">$budgetgrantavg</td>
		<td align=\"right\">$budgetreligiousavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of Program Budget From Federal Government: <b>$budgetfederalavg</b><br />Average Percentage of Program Budget From State or Local Government: <b>$budgetlocalavg</b><br />Average Percentage of Program Budget From Parent Fees: <b>$budgetfeesavg</b><br />Average Percentage of Program Budget From Grants: <b>$budgetgrantavg</b><br />Average Percentage of Program Budget From Religious Organizations: <b>$budgetreligiousavg</b><br />]]></description>";

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
$sld9file = fopen("export/advancedsearch_statelegislativedistrict9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld9file, ${'sld9row_'.$i});
}

fclose($sld9file); 

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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict9.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Average Percentage of Program Budget From Federal Government</th>
		<th>Average Percentage of Program Budget From State or Local Government</th>
		<th>Average Percentage of Program Budget From Parent Fees</th>
		<th>Average Percentage of Program Budget From Grants</th>
		<th>Average Percentage of Program Budget From Religious Organizations</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict9.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($sld9=='t') {


// if by elementary school distircts is selected
if ($elm9=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';


// set up array for csv
$elm9row_0 = array( );
$elm9row_0[] = 'Elementary School District Name';
$elm9row_0[] = 'Number of Sites';
$elm9row_0[] = 'Average Percentage of Program Budget From Federal Government';
$elm9row_0[] = 'Average Percentage of Program Budget From State or Local Government';
$elm9row_0[] = 'Average Percentage of Program Budget From Parent Fees';
$elm9row_0[] = 'Average Percentage of Program Budget From Grants';
$elm9row_0[] = 'Average Percentage of Program Budget From Religious Organizations';


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

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($budgetfederalavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($budgetfederalavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($budgetfederalavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($budgetfederalavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($budgetfederalavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm9row_'.$count} = array();
${'elm9row_'.$count}[] = $name;
${'elm9row_'.$count}[] = $sitescount;
${'elm9row_'.$count}[] = $budgetfederalavg;
${'elm9row_'.$count}[] = $budgetlocalavg;
${'elm9row_'.$count}[] = $budgetfeesavg;
${'elm9row_'.$count}[] = $budgetgrantavg;
${'elm9row_'.$count}[] = $budgetreligiousavg;


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

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
		<td align=\"right\">$budgetfederalavg</td>
		<td align=\"right\">$budgetlocalavg</td>
		<td align=\"right\">$budgetfeesavg</td>
		<td align=\"right\">$budgetgrantavg</td>
		<td align=\"right\">$budgetreligiousavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of Program Budget From Federal Government: <b>$budgetfederalavg</b><br />Average Percentage of Program Budget From State or Local Government: <b>$budgetlocalavg</b><br />Average Percentage of Program Budget From Parent Fees: <b>$budgetfeesavg</b><br />Average Percentage of Program Budget From Grants: <b>$budgetgrantavg</b><br />Average Percentage of Program Budget From Religious Organizations: <b>$budgetreligiousavg</b><br />]]></description>";

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
$elm9file = fopen("export/advancedsearch_elementaryschooldistrict9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm9file, ${'elm9row_'.$i});
}

fclose($elm9file); 

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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict9.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Average Percentage of Program Budget From Federal Government</th>
		<th>Average Percentage of Program Budget From State or Local Government</th>
		<th>Average Percentage of Program Budget From Parent Fees</th>
		<th>Average Percentage of Program Budget From Grants</th>
		<th>Average Percentage of Program Budget From Religious Organizations</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict9.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($elm9=='t') {


// if by By Secondary/Union School District is selected
if ($union9=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';


// set up array for csv
$union9row_0 = array( );
$union9row_0[] = 'Secondary/Union School District Name';
$union9row_0[] = 'Number of Sites';
$union9row_0[] = 'Average Percentage of Program Budget From Federal Government';
$union9row_0[] = 'Average Percentage of Program Budget From State or Local Government';
$union9row_0[] = 'Average Percentage of Program Budget From Parent Fees';
$union9row_0[] = 'Average Percentage of Program Budget From Grants';
$union9row_0[] = 'Average Percentage of Program Budget From Religious Organizations';


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

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($budgetfederalavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($budgetfederalavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($budgetfederalavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($budgetfederalavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($budgetfederalavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union9row_'.$count} = array();
${'union9row_'.$count}[] = $name;
${'union9row_'.$count}[] = $sitescount;
${'union9row_'.$count}[] = $budgetfederalavg;
${'union9row_'.$count}[] = $budgetlocalavg;
${'union9row_'.$count}[] = $budgetfeesavg;
${'union9row_'.$count}[] = $budgetgrantavg;
${'union9row_'.$count}[] = $budgetreligiousavg;


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

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
		<td align=\"right\">$budgetfederalavg</td>
		<td align=\"right\">$budgetlocalavg</td>
		<td align=\"right\">$budgetfeesavg</td>
		<td align=\"right\">$budgetgrantavg</td>
		<td align=\"right\">$budgetreligiousavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of Program Budget From Federal Government: <b>$budgetfederalavg</b><br />Average Percentage of Program Budget From State or Local Government: <b>$budgetlocalavg</b><br />Average Percentage of Program Budget From Parent Fees: <b>$budgetfeesavg</b><br />Average Percentage of Program Budget From Grants: <b>$budgetgrantavg</b><br />Average Percentage of Program Budget From Religious Organizations: <b>$budgetreligiousavg</b><br />]]></description>";

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
$union9file = fopen("export/advancedsearch_unionschooldistrict9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union9file, ${'union9row_'.$i});
}

fclose($union9file); 

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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict9.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Average Percentage of Program Budget From Federal Government</th>
		<th>Average Percentage of Program Budget From State or Local Government</th>
		<th>Average Percentage of Program Budget From Parent Fees</th>
		<th>Average Percentage of Program Budget From Grants</th>
		<th>Average Percentage of Program Budget From Religious Organizations</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict9.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($union9=='t') {


// if by az cities is selected
if ($city9=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';


// set up array for csv
$city9row_0 = array( );
$city9row_0[] = 'City Name';
$city9row_0[] = 'Number of Sites';
$city9row_0[] = 'Average Percentage of Program Budget From Federal Government';
$city9row_0[] = 'Average Percentage of Program Budget From State or Local Government';
$city9row_0[] = 'Average Percentage of Program Budget From Parent Fees';
$city9row_0[] = 'Average Percentage of Program Budget From Grants';
$city9row_0[] = 'Average Percentage of Program Budget From Religious Organizations';


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

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($budgetfederalavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($budgetfederalavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($budgetfederalavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($budgetfederalavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($budgetfederalavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city9row_'.$count} = array();
${'city9row_'.$count}[] = $name;
${'city9row_'.$count}[] = $sitescount;
${'city9row_'.$count}[] = $budgetfederalavg;
${'city9row_'.$count}[] = $budgetlocalavg;
${'city9row_'.$count}[] = $budgetfeesavg;
${'city9row_'.$count}[] = $budgetgrantavg;
${'city9row_'.$count}[] = $budgetreligiousavg;


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

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
		<td align=\"right\">$budgetfederalavg</td>
		<td align=\"right\">$budgetlocalavg</td>
		<td align=\"right\">$budgetfeesavg</td>
		<td align=\"right\">$budgetgrantavg</td>
		<td align=\"right\">$budgetreligiousavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of Program Budget From Federal Government: <b>$budgetfederalavg</b><br />Average Percentage of Program Budget From State or Local Government: <b>$budgetlocalavg</b><br />Average Percentage of Program Budget From Parent Fees: <b>$budgetfeesavg</b><br />Average Percentage of Program Budget From Grants: <b>$budgetgrantavg</b><br />Average Percentage of Program Budget From Religious Organizations: <b>$budgetreligiousavg</b><br />]]></description>";

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
$city9file = fopen("export/advancedsearch_cities9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city9file, ${'city9row_'.$i});
}

fclose($city9file); 

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

$locationkmlfile = fopen("export/advancedsearch_cities9.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Average Percentage of Program Budget From Federal Government</th>
		<th>Average Percentage of Program Budget From State or Local Government</th>
		<th>Average Percentage of Program Budget From Parent Fees</th>
		<th>Average Percentage of Program Budget From Grants</th>
		<th>Average Percentage of Program Budget From Religious Organizations</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities9.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($city9=='t') {


// if by activity is selected
if ($activity9=='t') {

// set up array for csv
$activity9row_0 = array( );
$activity9row_0[] = 'Activity';
$activity9row_0[] = 'Number of Sites';
$activity9row_0[] = 'Average Percentage of Program Budget From Federal Government';
$activity9row_0[] = 'Average Percentage of Program Budget From State or Local Government';
$activity9row_0[] = 'Average Percentage of Program Budget From Parent Fees';
$activity9row_0[] = 'Average Percentage of Program Budget From Grants';
$activity9row_0[] = 'Average Percentage of Program Budget From Religious Organizations';


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

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($budgetfederalavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($budgetfederalavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($budgetfederalavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($budgetfederalavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($budgetfederalavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity9row_'.$count} = array();
${'activity9row_'.$count}[] = $name;
${'activity9row_'.$count}[] = $sitescount;
${'activity9row_'.$count}[] = $budgetfederalavg;
${'activity9row_'.$count}[] = $budgetlocalavg;
${'activity9row_'.$count}[] = $budgetfeesavg;
${'activity9row_'.$count}[] = $budgetgrantavg;
${'activity9row_'.$count}[] = $budgetreligiousavg;


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

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
		<td align=\"right\">$budgetfederalavg</td>
		<td align=\"right\">$budgetlocalavg</td>
		<td align=\"right\">$budgetfeesavg</td>
		<td align=\"right\">$budgetgrantavg</td>
		<td align=\"right\">$budgetreligiousavg</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity9file = fopen("export/advancedsearch_activity9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity9file, ${'activity9row_'.$i});
}

fclose($activity9file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Average Percentage of Program Budget From Federal Government</th>
		<th>Average Percentage of Program Budget From State or Local Government</th>
		<th>Average Percentage of Program Budget From Parent Fees</th>
		<th>Average Percentage of Program Budget From Grants</th>
		<th>Average Percentage of Program Budget From Religious Organizations</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($activity9=='t') {


// if by activity is selected
if ($ages9=='t') {

// set up array for csv
$ages9row_0 = array( );
$ages9row_0[] = 'Ages Served';
$ages9row_0[] = 'Number of Sites';
$ages9row_0[] = 'Average Percentage of Program Budget From Federal Government';
$ages9row_0[] = 'Average Percentage of Program Budget From State or Local Government';
$ages9row_0[] = 'Average Percentage of Program Budget From Parent Fees';
$ages9row_0[] = 'Average Percentage of Program Budget From Grants';
$ages9row_0[] = 'Average Percentage of Program Budget From Religious Organizations';


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
//echo 'AND 0 = ' . $and0 . '<br />'; 
//echo 'AND 1 = ' . $and1 . '<br />'; 
//echo 'AND 2 = ' . $and2 . '<br />'; 
//echo 'AND 3 = ' . $and3 . '<br />'; 
//echo 'AND 4 = ' . $and4 . '<br />'; 
//echo 'AND 5 = ' . $and5 . '<br />'; 
//echo 'AND 6 = ' . $and6 . '<br />'; 
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from federal govt.
$sitescountquery = "SELECT avg(s.budgetfederal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfederalavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($budgetfederalavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($budgetfederalavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($budgetfederalavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($budgetfederalavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($budgetfederalavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// average percentage of budget comming from local govt.
$sitescountquery = "SELECT avg(s.budgetlocal) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetlocalavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from fees
$sitescountquery = "SELECT avg(s.budgetfees) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetfeesavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from grants
$sitescountquery = "SELECT avg(s.budgetgrant) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetgrantavg = pg_result($sitesresult, $lt, 0);
}

// average percentage of budget comming from religious organizations
$sitescountquery = "SELECT avg(s.budgetreligious) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$budgetreligiousavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages9row_'.$count} = array();
${'ages9row_'.$count}[] = $name;
${'ages9row_'.$count}[] = $sitescount;
${'ages9row_'.$count}[] = $budgetfederalavg;
${'ages9row_'.$count}[] = $budgetlocalavg;
${'ages9row_'.$count}[] = $budgetfeesavg;
${'ages9row_'.$count}[] = $budgetgrantavg;
${'ages9row_'.$count}[] = $budgetreligiousavg;


// clean up data for html
$sitescount = number_format($sitescount);
$budgetfederalavg = number_format($budgetfederalavg, 2) . '%';
$budgetlocalavg = number_format($budgetlocalavg, 2) . '%';
$budgetfeesavg = number_format($budgetfeesavg, 2) . '%';
$budgetgrantavg = number_format($budgetgrantavg, 2) . '%';
$budgetreligiousavg = number_format($budgetreligiousavg, 2) . '%';

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
		<td align=\"right\">$budgetfederalavg</td>
		<td align=\"right\">$budgetlocalavg</td>
		<td align=\"right\">$budgetfeesavg</td>
		<td align=\"right\">$budgetgrantavg</td>
		<td align=\"right\">$budgetreligiousavg</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages9file = fopen("export/advancedsearch_ages9.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages9file, ${'ages9row_'.$i});
}

fclose($ages9file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Average Percentage of Program Budget From Federal Government</th>
		<th>Average Percentage of Program Budget From State or Local Government</th>
		<th>Average Percentage of Program Budget From Parent Fees</th>
		<th>Average Percentage of Program Budget From Grants</th>
		<th>Average Percentage of Program Budget From Religious Organizations</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages9.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($ages9=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
