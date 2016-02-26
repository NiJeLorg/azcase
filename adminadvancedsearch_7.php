<?php

$summary7 = $_REQUEST['summary7'];
$cd7 = $_REQUEST['cd7'];
$sld7 = $_REQUEST['sld7'];
$elm7 = $_REQUEST['elm7'];
$union7 = $_REQUEST['union7'];
$city7 = $_REQUEST['city7'];
$activity7 = $_REQUEST['activity7'];
$ages7 = $_REQUEST['ages7'];

if ($summary7=='t' || $cd7=='t' || $sld7=='t' || $elm7=='t' || $union7=='t' || $city7=='t' || $activity7=='t' || $ages7=='t') {

?>
<div class="clear"></div>
<h1>Race/Ethnicity Distribution</h1>
<?
// if summary table is selected
if ($summary7=='t') {

// build full join and where statements
$join = $azcongressjoin . $statelegjoin . $elemschooldistrictjoin . $unionschooldistrictjoin . $citiesjoin;
$where = $whereverified . $and0 . $azcongresswhere . $and1 . $statelegwhere . $and2 . $elemschooldistrictwhere . $and3 . $unionschooldistrictwhere . $and4 . $citieswhere . $and5 . $whereactivity . $and6 . $whereages;

// table headers
?>
<h2>Summary Table</h2>
<table class="hoursTable">
	<tr>
		<th>Category</th>
		<th>Number of Sites/Percent Category</th>
	</tr>	
<?
$summary7row_0 = array( );
$summary7row_0[] = 'Category';
$summary7row_0[] = 'Number of Sites/Percent Category';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($latinoavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($latinoavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($latinoavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($latinoavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($latinoavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary7row_1 = array( );
$summary7row_1[] = 'Number of Sites';
$summary7row_1[] = $sitescount;
$summary7row_2 = array( );
$summary7row_2[] = 'Average Percentage of African Americans';
$summary7row_2[] = $africanamericanavg;
$summary7row_3 = array( );
$summary7row_3[] = 'Average Percentage of Asian Americans';
$summary7row_3[] = $asianamericanavg;
$summary7row_4 = array( );
$summary7row_4[] = 'Average Percentage of Latinos';
$summary7row_4[] = $latinoavg;
$summary7row_5 = array( );
$summary7row_5[] = 'Average Percentage of Native Americans';
$summary7row_5[] = $nativeamericanavg;
$summary7row_6 = array( );
$summary7row_6[] = 'Average Percentage of Whites';
$summary7row_6[] = $whiteavg;
$summary7row_7 = array( );
$summary7row_7[] = 'Average Percentage of Other Race or Ethnicity';
$summary7row_7[] = $otherraceavg;

// build csv file
$summary7file = fopen("export/advancedsearch_summary7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 7; $i++) {
	fputcsv($summary7file, ${'summary7row_'.$i});
}

fclose($summary7file); 


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Percentage of African Americans</td>
		<td align="right"><?php echo $africanamericanavg; ?></td>
	</tr>
	<tr>
		<td>Average Percentage of Asian Americans</td>
		<td align="right"><?php echo $asianamericanavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Percentage of Latinos</td>
		<td align="right"><?php echo $latinoavg; ?></td>
	</tr>
	<tr>
		<td>Average Percentage of Native Americans</td>
		<td align="right"><?php echo $nativeamericanavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Percentage of Whites</td>
		<td align="right"><?php echo $whiteavg; ?></td>
	</tr>
	<tr>
		<td>Average Percentage of Other Race or Ethnicity</td>
		<td align="right"><?php echo $otherraceavg; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd7=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';


// set up array for csv
$cd7row_0 = array( );
$cd7row_0[] = 'Congressional District';
$cd7row_0[] = 'Number of Sites';
$cd7row_0[] = 'Average Percentage of African Americans';
$cd7row_0[] = 'Average Percentage of Asian Americans';
$cd7row_0[] = 'Average Percentage of Latinos';
$cd7row_0[] = 'Average Percentage of Native Americans';
$cd7row_0[] = 'Average Percentage of Whites';
$cd7row_0[] = 'Average Percentage of Other Race or Ethnicity';


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

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($latinoavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($latinoavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($latinoavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($latinoavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($latinoavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd7row_'.$count} = array();
${'cd7row_'.$count}[] = $gid;
${'cd7row_'.$count}[] = $sitescount;
${'cd7row_'.$count}[] = $africanamericanavg;
${'cd7row_'.$count}[] = $asianamericanavg;
${'cd7row_'.$count}[] = $latinoavg;
${'cd7row_'.$count}[] = $nativeamericanavg;
${'cd7row_'.$count}[] = $whiteavg;
${'cd7row_'.$count}[] = $otherraceavg;


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

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
		<td align=\"right\">$africanamericanavg</td>
		<td align=\"right\">$asianamericanavg</td>
		<td align=\"right\">$latinoavg</td>
		<td align=\"right\">$nativeamericanavg</td>
		<td align=\"right\">$whiteavg</td>
		<td align=\"right\">$otherraceavg</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of African Americans: <b>$africanamericanavg</b><br />Average Percentage of Asian Americans: <b>$asianamericanavg</b><br />Average Percentage of Latinos: <b>$latinoavg</b><br />Average Percentage of Native Americans: <b>$nativeamericanavg</b><br />Average Percentage of Whites: <b>$whiteavg</b><br />Average Percentage of Other Race or Ethnicity: <b>$otherraceavg</b><br />]]></description>";

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
$cd7file = fopen("export/advancedsearch_congressionaldistrict7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd7file, ${'cd7row_'.$i});
}

fclose($cd7file); 


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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict7.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Average Percentage of African Americans</th>
		<th>Average Percentage of Asian Americans</th>
		<th>Average Percentage of Latinos</th>
		<th>Average Percentage of Native Americans</th>
		<th>Average Percentage of Whites</th>
		<th>Average Percentage of Other Race or Ethnicity</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict7.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?

}else{} // if ($cd7=='t') {


// if by state legislative districts is selected
if ($sld7=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';

// set up array for csv
$sld7row_0 = array( );
$sld7row_0[] = 'State Legislaltive District';
$sld7row_0[] = 'Number of Sites';
$sld7row_0[] = 'Average Percentage of African Americans';
$sld7row_0[] = 'Average Percentage of Asian Americans';
$sld7row_0[] = 'Average Percentage of Latinos';
$sld7row_0[] = 'Average Percentage of Native Americans';
$sld7row_0[] = 'Average Percentage of Whites';
$sld7row_0[] = 'Average Percentage of Other Race or Ethnicity';

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

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($latinoavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($latinoavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($latinoavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($latinoavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($latinoavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld7row_'.$count} = array();
${'sld7row_'.$count}[] = $gid;
${'sld7row_'.$count}[] = $sitescount;
${'sld7row_'.$count}[] = $africanamericanavg;
${'sld7row_'.$count}[] = $asianamericanavg;
${'sld7row_'.$count}[] = $latinoavg;
${'sld7row_'.$count}[] = $nativeamericanavg;
${'sld7row_'.$count}[] = $whiteavg;
${'sld7row_'.$count}[] = $otherraceavg;


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

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
		<td align=\"right\">$africanamericanavg</td>
		<td align=\"right\">$asianamericanavg</td>
		<td align=\"right\">$latinoavg</td>
		<td align=\"right\">$nativeamericanavg</td>
		<td align=\"right\">$whiteavg</td>
		<td align=\"right\">$otherraceavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of African Americans: <b>$africanamericanavg</b><br />Average Percentage of Asian Americans: <b>$asianamericanavg</b><br />Average Percentage of Latinos: <b>$latinoavg</b><br />Average Percentage of Native Americans: <b>$nativeamericanavg</b><br />Average Percentage of Whites: <b>$whiteavg</b><br />Average Percentage of Other Race or Ethnicity: <b>$otherraceavg</b><br />]]></description>";

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
$sld7file = fopen("export/advancedsearch_statelegislativedistrict7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld7file, ${'sld7row_'.$i});
}

fclose($sld7file); 

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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict7.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Average Percentage of African Americans</th>
		<th>Average Percentage of Asian Americans</th>
		<th>Average Percentage of Latinos</th>
		<th>Average Percentage of Native Americans</th>
		<th>Average Percentage of Whites</th>
		<th>Average Percentage of Other Race or Ethnicity</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict7.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($sld7=='t') {


// if by elementary school distircts is selected
if ($elm7=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';

// set up array for csv
$elm7row_0 = array( );
$elm7row_0[] = 'Elementary School District Name';
$elm7row_0[] = 'Number of Sites';
$elm7row_0[] = 'Average Percentage of African Americans';
$elm7row_0[] = 'Average Percentage of Asian Americans';
$elm7row_0[] = 'Average Percentage of Latinos';
$elm7row_0[] = 'Average Percentage of Native Americans';
$elm7row_0[] = 'Average Percentage of Whites';
$elm7row_0[] = 'Average Percentage of Other Race or Ethnicity';


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

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($latinoavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($latinoavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($latinoavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($latinoavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($latinoavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm7row_'.$count} = array();
${'elm7row_'.$count}[] = $name;
${'elm7row_'.$count}[] = $sitescount;
${'elm7row_'.$count}[] = $africanamericanavg;
${'elm7row_'.$count}[] = $asianamericanavg;
${'elm7row_'.$count}[] = $latinoavg;
${'elm7row_'.$count}[] = $nativeamericanavg;
${'elm7row_'.$count}[] = $whiteavg;
${'elm7row_'.$count}[] = $otherraceavg;


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

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
		<td align=\"right\">$africanamericanavg</td>
		<td align=\"right\">$asianamericanavg</td>
		<td align=\"right\">$latinoavg</td>
		<td align=\"right\">$nativeamericanavg</td>
		<td align=\"right\">$whiteavg</td>
		<td align=\"right\">$otherraceavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of African Americans: <b>$africanamericanavg</b><br />Average Percentage of Asian Americans: <b>$asianamericanavg</b><br />Average Percentage of Latinos: <b>$latinoavg</b><br />Average Percentage of Native Americans: <b>$nativeamericanavg</b><br />Average Percentage of Whites: <b>$whiteavg</b><br />Average Percentage of Other Race or Ethnicity: <b>$otherraceavg</b><br />]]></description>";

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
$elm7file = fopen("export/advancedsearch_elementaryschooldistrict7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm7file, ${'elm7row_'.$i});
}

fclose($elm7file); 

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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict7.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Average Percentage of African Americans</th>
		<th>Average Percentage of Asian Americans</th>
		<th>Average Percentage of Latinos</th>
		<th>Average Percentage of Native Americans</th>
		<th>Average Percentage of Whites</th>
		<th>Average Percentage of Other Race or Ethnicity</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict7.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($elm7=='t') {


// if by By Secondary/Union School District is selected
if ($union7=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';

// set up array for csv
$union7row_0 = array( );
$union7row_0[] = 'Secondary/Union School District Name';
$union7row_0[] = 'Number of Sites';
$union7row_0[] = 'Average Percentage of African Americans';
$union7row_0[] = 'Average Percentage of Asian Americans';
$union7row_0[] = 'Average Percentage of Latinos';
$union7row_0[] = 'Average Percentage of Native Americans';
$union7row_0[] = 'Average Percentage of Whites';
$union7row_0[] = 'Average Percentage of Other Race or Ethnicity';


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

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($latinoavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($latinoavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($latinoavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($latinoavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($latinoavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union7row_'.$count} = array();
${'union7row_'.$count}[] = $name;
${'union7row_'.$count}[] = $sitescount;
${'union7row_'.$count}[] = $africanamericanavg;
${'union7row_'.$count}[] = $asianamericanavg;
${'union7row_'.$count}[] = $latinoavg;
${'union7row_'.$count}[] = $nativeamericanavg;
${'union7row_'.$count}[] = $whiteavg;
${'union7row_'.$count}[] = $otherraceavg;


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

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
		<td align=\"right\">$africanamericanavg</td>
		<td align=\"right\">$asianamericanavg</td>
		<td align=\"right\">$latinoavg</td>
		<td align=\"right\">$nativeamericanavg</td>
		<td align=\"right\">$whiteavg</td>
		<td align=\"right\">$otherraceavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of African Americans: <b>$africanamericanavg</b><br />Average Percentage of Asian Americans: <b>$asianamericanavg</b><br />Average Percentage of Latinos: <b>$latinoavg</b><br />Average Percentage of Native Americans: <b>$nativeamericanavg</b><br />Average Percentage of Whites: <b>$whiteavg</b><br />Average Percentage of Other Race or Ethnicity: <b>$otherraceavg</b><br />]]></description>";

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
$union7file = fopen("export/advancedsearch_unionschooldistrict7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union7file, ${'union7row_'.$i});
}

fclose($union7file); 

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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict7.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Average Percentage of African Americans</th>
		<th>Average Percentage of Asian Americans</th>
		<th>Average Percentage of Latinos</th>
		<th>Average Percentage of Native Americans</th>
		<th>Average Percentage of Whites</th>
		<th>Average Percentage of Other Race or Ethnicity</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict7.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($union7=='t') {


// if by az cities is selected
if ($city7=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';

// set up array for csv
$city7row_0 = array( );
$city7row_0[] = 'City Name';
$city7row_0[] = 'Number of Sites';
$city7row_0[] = 'Average Percentage of African Americans';
$city7row_0[] = 'Average Percentage of Asian Americans';
$city7row_0[] = 'Average Percentage of Latinos';
$city7row_0[] = 'Average Percentage of Native Americans';
$city7row_0[] = 'Average Percentage of Whites';
$city7row_0[] = 'Average Percentage of Other Race or Ethnicity';


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

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($latinoavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($latinoavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($latinoavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($latinoavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($latinoavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city7row_'.$count} = array();
${'city7row_'.$count}[] = $name;
${'city7row_'.$count}[] = $sitescount;
${'city7row_'.$count}[] = $africanamericanavg;
${'city7row_'.$count}[] = $asianamericanavg;
${'city7row_'.$count}[] = $latinoavg;
${'city7row_'.$count}[] = $nativeamericanavg;
${'city7row_'.$count}[] = $whiteavg;
${'city7row_'.$count}[] = $otherraceavg;


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

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
		<td align=\"right\">$africanamericanavg</td>
		<td align=\"right\">$asianamericanavg</td>
		<td align=\"right\">$latinoavg</td>
		<td align=\"right\">$nativeamericanavg</td>
		<td align=\"right\">$whiteavg</td>
		<td align=\"right\">$otherraceavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Percentage of African Americans: <b>$africanamericanavg</b><br />Average Percentage of Asian Americans: <b>$asianamericanavg</b><br />Average Percentage of Latinos: <b>$latinoavg</b><br />Average Percentage of Native Americans: <b>$nativeamericanavg</b><br />Average Percentage of Whites: <b>$whiteavg</b><br />Average Percentage of Other Race or Ethnicity: <b>$otherraceavg</b><br />]]></description>";

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
$city7file = fopen("export/advancedsearch_cities7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city7file, ${'city7row_'.$i});
}

fclose($city7file); 

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

$locationkmlfile = fopen("export/advancedsearch_cities7.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Average Percentage of African Americans</th>
		<th>Average Percentage of Asian Americans</th>
		<th>Average Percentage of Latinos</th>
		<th>Average Percentage of Native Americans</th>
		<th>Average Percentage of Whites</th>
		<th>Average Percentage of Other Race or Ethnicity</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities7.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($city7=='t') {


// if by activity is selected
if ($activity7=='t') {

// set up array for csv
$activity7row_0 = array( );
$activity7row_0[] = 'Activity';
$activity7row_0[] = 'Number of Sites';
$activity7row_0[] = 'Average Percentage of African Americans';
$activity7row_0[] = 'Average Percentage of Asian Americans';
$activity7row_0[] = 'Average Percentage of Latinos';
$activity7row_0[] = 'Average Percentage of Native Americans';
$activity7row_0[] = 'Average Percentage of Whites';
$activity7row_0[] = 'Average Percentage of Other Race or Ethnicity';


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

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity7row_'.$count} = array();
${'activity7row_'.$count}[] = $name;
${'activity7row_'.$count}[] = $sitescount;
${'activity7row_'.$count}[] = $africanamericanavg;
${'activity7row_'.$count}[] = $asianamericanavg;
${'activity7row_'.$count}[] = $latinoavg;
${'activity7row_'.$count}[] = $nativeamericanavg;
${'activity7row_'.$count}[] = $whiteavg;
${'activity7row_'.$count}[] = $otherraceavg;


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

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
		<td align=\"right\">$africanamericanavg</td>
		<td align=\"right\">$asianamericanavg</td>
		<td align=\"right\">$latinoavg</td>
		<td align=\"right\">$nativeamericanavg</td>
		<td align=\"right\">$whiteavg</td>
		<td align=\"right\">$otherraceavg</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity7file = fopen("export/advancedsearch_activity7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity7file, ${'activity7row_'.$i});
}

fclose($activity7file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Average Percentage of African Americans</th>
		<th>Average Percentage of Asian Americans</th>
		<th>Average Percentage of Latinos</th>
		<th>Average Percentage of Native Americans</th>
		<th>Average Percentage of Whites</th>
		<th>Average Percentage of Other Race or Ethnicity</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($activity7=='t') {


// if by activity is selected
if ($ages7=='t') {

// set up array for csv
$ages7row_0 = array( );
$ages7row_0[] = 'Ages Served';
$ages7row_0[] = 'Number of Sites';
$ages7row_0[] = 'Average Percentage of African Americans';
$ages7row_0[] = 'Average Percentage of Asian Americans';
$ages7row_0[] = 'Average Percentage of Latinos';
$ages7row_0[] = 'Average Percentage of Native Americans';
$ages7row_0[] = 'Average Percentage of Whites';
$ages7row_0[] = 'Average Percentage of Other Race or Ethnicity';


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

// Average percentage of african americans
$sitescountquery = "SELECT avg(s.africanamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$africanamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of asian americans
$sitescountquery = "SELECT avg(s.asianamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$asianamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of latinos
$sitescountquery = "SELECT avg(s.latino) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$latinoavg = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($latinoavg <= 20) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($latinoavg <= 40) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($latinoavg <= 60) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($latinoavg <= 80) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($latinoavg <= 100) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average percentage of native americans
$sitescountquery = "SELECT avg(s.nativeamerican) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$nativeamericanavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of whites
$sitescountquery = "SELECT avg(s.white) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$whiteavg = pg_result($sitesresult, $lt, 0);
}

// Average percentage of other race
$sitescountquery = "SELECT avg(s.otherrace) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherraceavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages7row_'.$count} = array();
${'ages7row_'.$count}[] = $name;
${'ages7row_'.$count}[] = $sitescount;
${'ages7row_'.$count}[] = $africanamericanavg;
${'ages7row_'.$count}[] = $asianamericanavg;
${'ages7row_'.$count}[] = $latinoavg;
${'ages7row_'.$count}[] = $nativeamericanavg;
${'ages7row_'.$count}[] = $whiteavg;
${'ages7row_'.$count}[] = $otherraceavg;


// clean up data for html
$sitescount = number_format($sitescount);
$africanamericanavg = number_format($africanamericanavg, 2) . '%';
$asianamericanavg = number_format($asianamericanavg, 2) . '%';
$latinoavg = number_format($latinoavg, 2) . '%';
$nativeamericanavg = number_format($nativeamericanavg, 2) . '%';
$whiteavg = number_format($whiteavg, 2) . '%';
$otherraceavg = number_format($otherraceavg, 2) . '%';

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
		<td align=\"right\">$africanamericanavg</td>
		<td align=\"right\">$asianamericanavg</td>
		<td align=\"right\">$latinoavg</td>
		<td align=\"right\">$nativeamericanavg</td>
		<td align=\"right\">$whiteavg</td>
		<td align=\"right\">$otherraceavg</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages7file = fopen("export/advancedsearch_ages7.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages7file, ${'ages7row_'.$i});
}

fclose($ages7file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Average Percentage of African Americans</th>
		<th>Average Percentage of Asian Americans</th>
		<th>Average Percentage of Latinos</th>
		<th>Average Percentage of Native Americans</th>
		<th>Average Percentage of Whites</th>
		<th>Average Percentage of Other Race or Ethnicity</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages7.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($ages7=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
