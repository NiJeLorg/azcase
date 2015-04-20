<?php

$summary8 = $_REQUEST['summary8'];
$cd8 = $_REQUEST['cd8'];
$sld8 = $_REQUEST['sld8'];
$elm8 = $_REQUEST['elm8'];
$union8 = $_REQUEST['union8'];
$city8 = $_REQUEST['city8'];
$activity8 = $_REQUEST['activity8'];
$ages8 = $_REQUEST['ages8'];

if ($summary8=='t' || $cd8=='t' || $sld8=='t' || $elm8=='t' || $union8=='t' || $city8=='t' || $activity8=='t' || $ages8=='t') {

?>
<div class="clear"></div>
<h1>Program Types</h1>
<?
// if summary table is selected
if ($summary8=='t') {

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
$summary8row_0 = array( );
$summary8row_0[] = 'Category';
$summary8row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary8row_1 = array( );
$summary8row_1[] = 'Number of Sites';
$summary8row_1[] = $sitescount;
$summary8row_2 = array( );
$summary8row_2[] = 'Number of 21st Century Community Centers';
$summary8row_2[] = $programtype1count;
$summary8row_3 = array( );
$summary8row_3[] = 'Number of Faith-Based Programs';
$summary8row_3[] = $programtype2count;
$summary8row_4 = array( );
$summary8row_4[] = 'Number of Public School Based Programs';
$summary8row_4[] = $programtype3count;
$summary8row_5 = array( );
$summary8row_5[] = 'Number of Private School Based Programs';
$summary8row_5[] = $programtype4count;
$summary8row_6 = array( );
$summary8row_6[] = 'Number of Home Based Programs';
$summary8row_6[] = $programtype5count;
$summary8row_7 = array( );
$summary8row_7[] = 'Number of Corperate Run Programs';
$summary8row_7[] = $programtype6count;
$summary8row_8 = array( );
$summary8row_8[] = 'Number of Community Based Programs';
$summary8row_8[] = $programtype7count;

// build csv file
$summary8file = fopen("export/advancedsearch_summary8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 8; $i++) {
	fputcsv($summary8file, ${'summary8row_'.$i});
}

fclose($summary8file); 


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of 21st Century Community Centers</td>
		<td align="right"><?php echo $programtype1count; ?></td>
	</tr>
	<tr>
		<td>Number of Faith-Based Programs</td>
		<td align="right"><?php echo $programtype2count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Public School Based Programs</td>
		<td align="right"><?php echo $programtype3count; ?></td>
	</tr>
	<tr>
		<td>Number of Private School Based Programs</td>
		<td align="right"><?php echo $programtype4count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Home Based Programs</td>
		<td align="right"><?php echo $programtype5count; ?></td>
	</tr>
	<tr>
		<td>Number of Corperate Run Programs</td>
		<td align="right"><?php echo $programtype6count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Community Based Programs</td>
		<td align="right"><?php echo $programtype7count; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd8=='t') {

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
$cd8row_0 = array( );
$cd8row_0[] = 'Congressional District';
$cd8row_0[] = 'Number of Sites';
$cd8row_0[] = 'Number of 21st Century Community Centers';
$cd8row_0[] = 'Number of Faith-Based Programs';
$cd8row_0[] = 'Number of Public School Based Programs';
$cd8row_0[] = 'Number of Private School Based Programs';
$cd8row_0[] = 'Number of Home Based Programs';
$cd8row_0[] = 'Number of Corperate Run Programs';
$cd8row_0[] = 'Number of Community Based Programs';


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

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($programtype1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($programtype1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd8row_'.$count} = array();
${'cd8row_'.$count}[] = $gid;
${'cd8row_'.$count}[] = $sitescount;
${'cd8row_'.$count}[] = $programtype1count;
${'cd8row_'.$count}[] = $programtype2count;
${'cd8row_'.$count}[] = $programtype3count;
${'cd8row_'.$count}[] = $programtype4count;
${'cd8row_'.$count}[] = $programtype5count;
${'cd8row_'.$count}[] = $programtype6count;
${'cd8row_'.$count}[] = $programtype7count;


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

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
		<td align=\"right\">$programtype1count</td>
		<td align=\"right\">$programtype2count</td>
		<td align=\"right\">$programtype3count</td>
		<td align=\"right\">$programtype4count</td>
		<td align=\"right\">$programtype5count</td>
		<td align=\"right\">$programtype6count</td>
		<td align=\"right\">$programtype7count</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of 21st Century Community Centers: <b>$programtype1count</b><br />Number of Faith-Based Programs: <b>$programtype2count</b><br />Number of Public School Based Programs: <b>$programtype3count</b><br />Number of Private School Based Programs: <b>$programtype4count</b><br />Number of Home Based Programs: <b>$programtype5count</b><br />Number of Corperate Run Programs: <b>$programtype6count</b><br />Number of Community Based Programs: <b>$programtype7count</b><br />]]></description>";

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
$cd8file = fopen("export/advancedsearch_congressionaldistrict8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd8file, ${'cd8row_'.$i});
}

fclose($cd8file); 


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
	      <href>http://maps.nijel.org/azcase_dev/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict8.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of 21st Century Community Centers</th>
		<th>Number of Faith-Based Programs</th>
		<th>Number of Public School Based Programs</th>
		<th>Number of Private School Based Programs</th>
		<th>Number of Home Based Programs</th>
		<th>Number of Corperate Run Programs</th>
		<th>Number of Community Based Programs</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict8.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?

}else{} // if ($cd8=='t') {


// if by state legislative districts is selected
if ($sld8=='t') {

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
$sld8row_0 = array( );
$sld8row_0[] = 'State Legislaltive District';
$sld8row_0[] = 'Number of Sites';
$sld8row_0[] = 'Number of 21st Century Community Centers';
$sld8row_0[] = 'Number of Faith-Based Programs';
$sld8row_0[] = 'Number of Public School Based Programs';
$sld8row_0[] = 'Number of Private School Based Programs';
$sld8row_0[] = 'Number of Home Based Programs';
$sld8row_0[] = 'Number of Corperate Run Programs';
$sld8row_0[] = 'Number of Community Based Programs';

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

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($programtype1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($programtype1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld8row_'.$count} = array();
${'sld8row_'.$count}[] = $gid;
${'sld8row_'.$count}[] = $sitescount;
${'sld8row_'.$count}[] = $programtype1count;
${'sld8row_'.$count}[] = $programtype2count;
${'sld8row_'.$count}[] = $programtype3count;
${'sld8row_'.$count}[] = $programtype4count;
${'sld8row_'.$count}[] = $programtype5count;
${'sld8row_'.$count}[] = $programtype6count;
${'sld8row_'.$count}[] = $programtype7count;


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

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
		<td align=\"right\">$programtype1count</td>
		<td align=\"right\">$programtype2count</td>
		<td align=\"right\">$programtype3count</td>
		<td align=\"right\">$programtype4count</td>
		<td align=\"right\">$programtype5count</td>
		<td align=\"right\">$programtype6count</td>
		<td align=\"right\">$programtype7count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of 21st Century Community Centers: <b>$programtype1count</b><br />Number of Faith-Based Programs: <b>$programtype2count</b><br />Number of Public School Based Programs: <b>$programtype3count</b><br />Number of Private School Based Programs: <b>$programtype4count</b><br />Number of Home Based Programs: <b>$programtype5count</b><br />Number of Corperate Run Programs: <b>$programtype6count</b><br />Number of Community Based Programs: <b>$programtype7count</b><br />]]></description>";

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
$sld8file = fopen("export/advancedsearch_statelegislativedistrict8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld8file, ${'sld8row_'.$i});
}

fclose($sld8file); 

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
	      <href>http://maps.nijel.org/azcase_dev/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict8.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of 21st Century Community Centers</th>
		<th>Number of Faith-Based Programs</th>
		<th>Number of Public School Based Programs</th>
		<th>Number of Private School Based Programs</th>
		<th>Number of Home Based Programs</th>
		<th>Number of Corperate Run Programs</th>
		<th>Number of Community Based Programs</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict8.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($sld8=='t') {


// if by elementary school distircts is selected
if ($elm8=='t') {

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
$elm8row_0 = array( );
$elm8row_0[] = 'Elementary School District Name';
$elm8row_0[] = 'Number of Sites';
$elm8row_0[] = 'Number of 21st Century Community Centers';
$elm8row_0[] = 'Number of Faith-Based Programs';
$elm8row_0[] = 'Number of Public School Based Programs';
$elm8row_0[] = 'Number of Private School Based Programs';
$elm8row_0[] = 'Number of Home Based Programs';
$elm8row_0[] = 'Number of Corperate Run Programs';
$elm8row_0[] = 'Number of Community Based Programs';


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

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($programtype1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($programtype1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm8row_'.$count} = array();
${'elm8row_'.$count}[] = $name;
${'elm8row_'.$count}[] = $sitescount;
${'elm8row_'.$count}[] = $programtype1count;
${'elm8row_'.$count}[] = $programtype2count;
${'elm8row_'.$count}[] = $programtype3count;
${'elm8row_'.$count}[] = $programtype4count;
${'elm8row_'.$count}[] = $programtype5count;
${'elm8row_'.$count}[] = $programtype6count;
${'elm8row_'.$count}[] = $programtype7count;


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

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
		<td align=\"right\">$programtype1count</td>
		<td align=\"right\">$programtype2count</td>
		<td align=\"right\">$programtype3count</td>
		<td align=\"right\">$programtype4count</td>
		<td align=\"right\">$programtype5count</td>
		<td align=\"right\">$programtype6count</td>
		<td align=\"right\">$programtype7count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of 21st Century Community Centers: <b>$programtype1count</b><br />Number of Faith-Based Programs: <b>$programtype2count</b><br />Number of Public School Based Programs: <b>$programtype3count</b><br />Number of Private School Based Programs: <b>$programtype4count</b><br />Number of Home Based Programs: <b>$programtype5count</b><br />Number of Corperate Run Programs: <b>$programtype6count</b><br />Number of Community Based Programs: <b>$programtype7count</b><br />]]></description>";

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
$elm8file = fopen("export/advancedsearch_elementaryschooldistrict8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm8file, ${'elm8row_'.$i});
}

fclose($elm8file); 

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
	      <href>http://maps.nijel.org/azcase_dev/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict8.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of 21st Century Community Centers</th>
		<th>Number of Faith-Based Programs</th>
		<th>Number of Public School Based Programs</th>
		<th>Number of Private School Based Programs</th>
		<th>Number of Home Based Programs</th>
		<th>Number of Corperate Run Programs</th>
		<th>Number of Community Based Programs</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict8.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($elm8=='t') {


// if by By Secondary/Union School District is selected
if ($union8=='t') {

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
$union8row_0 = array( );
$union8row_0[] = 'Secondary/Union School District Name';
$union8row_0[] = 'Number of Sites';
$union8row_0[] = 'Number of 21st Century Community Centers';
$union8row_0[] = 'Number of Faith-Based Programs';
$union8row_0[] = 'Number of Public School Based Programs';
$union8row_0[] = 'Number of Private School Based Programs';
$union8row_0[] = 'Number of Home Based Programs';
$union8row_0[] = 'Number of Corperate Run Programs';
$union8row_0[] = 'Number of Community Based Programs';


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

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($programtype1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($programtype1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union8row_'.$count} = array();
${'union8row_'.$count}[] = $name;
${'union8row_'.$count}[] = $sitescount;
${'union8row_'.$count}[] = $programtype1count;
${'union8row_'.$count}[] = $programtype2count;
${'union8row_'.$count}[] = $programtype3count;
${'union8row_'.$count}[] = $programtype4count;
${'union8row_'.$count}[] = $programtype5count;
${'union8row_'.$count}[] = $programtype6count;
${'union8row_'.$count}[] = $programtype7count;


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

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
		<td align=\"right\">$programtype1count</td>
		<td align=\"right\">$programtype2count</td>
		<td align=\"right\">$programtype3count</td>
		<td align=\"right\">$programtype4count</td>
		<td align=\"right\">$programtype5count</td>
		<td align=\"right\">$programtype6count</td>
		<td align=\"right\">$programtype7count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of 21st Century Community Centers: <b>$programtype1count</b><br />Number of Faith-Based Programs: <b>$programtype2count</b><br />Number of Public School Based Programs: <b>$programtype3count</b><br />Number of Private School Based Programs: <b>$programtype4count</b><br />Number of Home Based Programs: <b>$programtype5count</b><br />Number of Corperate Run Programs: <b>$programtype6count</b><br />Number of Community Based Programs: <b>$programtype7count</b><br />]]></description>";

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
$union8file = fopen("export/advancedsearch_unionschooldistrict8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union8file, ${'union8row_'.$i});
}

fclose($union8file); 

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
	      <href>http://maps.nijel.org/azcase_dev/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict8.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of 21st Century Community Centers</th>
		<th>Number of Faith-Based Programs</th>
		<th>Number of Public School Based Programs</th>
		<th>Number of Private School Based Programs</th>
		<th>Number of Home Based Programs</th>
		<th>Number of Corperate Run Programs</th>
		<th>Number of Community Based Programs</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict8.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($union8=='t') {


// if by az cities is selected
if ($city8=='t') {

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
$city8row_0 = array( );
$city8row_0[] = 'City Name';
$city8row_0[] = 'Number of Sites';
$city8row_0[] = 'Number of 21st Century Community Centers';
$city8row_0[] = 'Number of Faith-Based Programs';
$city8row_0[] = 'Number of Public School Based Programs';
$city8row_0[] = 'Number of Private School Based Programs';
$city8row_0[] = 'Number of Home Based Programs';
$city8row_0[] = 'Number of Corperate Run Programs';
$city8row_0[] = 'Number of Community Based Programs';


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

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($programtype1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($programtype1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($programtype1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city8row_'.$count} = array();
${'city8row_'.$count}[] = $name;
${'city8row_'.$count}[] = $sitescount;
${'city8row_'.$count}[] = $programtype1count;
${'city8row_'.$count}[] = $programtype2count;
${'city8row_'.$count}[] = $programtype3count;
${'city8row_'.$count}[] = $programtype4count;
${'city8row_'.$count}[] = $programtype5count;
${'city8row_'.$count}[] = $programtype6count;
${'city8row_'.$count}[] = $programtype7count;


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

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
		<td align=\"right\">$programtype1count</td>
		<td align=\"right\">$programtype2count</td>
		<td align=\"right\">$programtype3count</td>
		<td align=\"right\">$programtype4count</td>
		<td align=\"right\">$programtype5count</td>
		<td align=\"right\">$programtype6count</td>
		<td align=\"right\">$programtype7count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of 21st Century Community Centers: <b>$programtype1count</b><br />Number of Faith-Based Programs: <b>$programtype2count</b><br />Number of Public School Based Programs: <b>$programtype3count</b><br />Number of Private School Based Programs: <b>$programtype4count</b><br />Number of Home Based Programs: <b>$programtype5count</b><br />Number of Corperate Run Programs: <b>$programtype6count</b><br />Number of Community Based Programs: <b>$programtype7count</b><br />]]></description>";

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
$city8file = fopen("export/advancedsearch_cities8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city8file, ${'city8row_'.$i});
}

fclose($city8file); 

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
	      <href>http://maps.nijel.org/azcase_dev/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_cities8.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of 21st Century Community Centers</th>
		<th>Number of Faith-Based Programs</th>
		<th>Number of Public School Based Programs</th>
		<th>Number of Private School Based Programs</th>
		<th>Number of Home Based Programs</th>
		<th>Number of Corperate Run Programs</th>
		<th>Number of Community Based Programs</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities8.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($city8=='t') {


// if by activity is selected
if ($activity8=='t') {

// set up array for csv
$activity8row_0 = array( );
$activity8row_0[] = 'Activity';
$activity8row_0[] = 'Number of Sites';
$activity8row_0[] = 'Number of 21st Century Community Centers';
$activity8row_0[] = 'Number of Faith-Based Programs';
$activity8row_0[] = 'Number of Public School Based Programs';
$activity8row_0[] = 'Number of Private School Based Programs';
$activity8row_0[] = 'Number of Home Based Programs';
$activity8row_0[] = 'Number of Corperate Run Programs';
$activity8row_0[] = 'Number of Community Based Programs';


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

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity8row_'.$count} = array();
${'activity8row_'.$count}[] = $name;
${'activity8row_'.$count}[] = $sitescount;
${'activity8row_'.$count}[] = $programtype1count;
${'activity8row_'.$count}[] = $programtype2count;
${'activity8row_'.$count}[] = $programtype3count;
${'activity8row_'.$count}[] = $programtype4count;
${'activity8row_'.$count}[] = $programtype5count;
${'activity8row_'.$count}[] = $programtype6count;
${'activity8row_'.$count}[] = $programtype7count;


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

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
		<td align=\"right\">$programtype1count</td>
		<td align=\"right\">$programtype2count</td>
		<td align=\"right\">$programtype3count</td>
		<td align=\"right\">$programtype4count</td>
		<td align=\"right\">$programtype5count</td>
		<td align=\"right\">$programtype6count</td>
		<td align=\"right\">$programtype7count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity8file = fopen("export/advancedsearch_activity8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity8file, ${'activity8row_'.$i});
}

fclose($activity8file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of 21st Century Community Centers</th>
		<th>Number of Faith-Based Programs</th>
		<th>Number of Public School Based Programs</th>
		<th>Number of Private School Based Programs</th>
		<th>Number of Home Based Programs</th>
		<th>Number of Corperate Run Programs</th>
		<th>Number of Community Based Programs</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($activity8=='t') {


// if by activity is selected
if ($ages8=='t') {

// set up array for csv
$ages8row_0 = array( );
$ages8row_0[] = 'Ages Served';
$ages8row_0[] = 'Number of Sites';
$ages8row_0[] = 'Number of 21st Century Community Centers';
$ages8row_0[] = 'Number of Faith-Based Programs';
$ages8row_0[] = 'Number of Public School Based Programs';
$ages8row_0[] = 'Number of Private School Based Programs';
$ages8row_0[] = 'Number of Home Based Programs';
$ages8row_0[] = 'Number of Corperate Run Programs';
$ages8row_0[] = 'Number of Community Based Programs';


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

// number of sites 21st century community centers
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype1count = pg_result($sitesresult, $lt, 0);
}

// number of sites Faith-based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype2count = pg_result($sitesresult, $lt, 0);
}

// number of sites Public school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype3count = pg_result($sitesresult, $lt, 0);
}

// number of sites Private school based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype4count = pg_result($sitesresult, $lt, 0);
}

// number of sites Home based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype5count = pg_result($sitesresult, $lt, 0);
}

// number of sites Corperate run program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype6count = pg_result($sitesresult, $lt, 0);
}

// number of sites Community based program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.programtype = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$programtype7count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages8row_'.$count} = array();
${'ages8row_'.$count}[] = $name;
${'ages8row_'.$count}[] = $sitescount;
${'ages8row_'.$count}[] = $programtype1count;
${'ages8row_'.$count}[] = $programtype2count;
${'ages8row_'.$count}[] = $programtype3count;
${'ages8row_'.$count}[] = $programtype4count;
${'ages8row_'.$count}[] = $programtype5count;
${'ages8row_'.$count}[] = $programtype6count;
${'ages8row_'.$count}[] = $programtype7count;


// clean up data for html
$sitescount = number_format($sitescount);
$programtype1count = number_format($programtype1count);
$programtype2count = number_format($programtype2count);
$programtype3count = number_format($programtype3count);
$programtype4count = number_format($programtype4count);
$programtype5count = number_format($programtype5count);
$programtype6count = number_format($programtype6count);
$programtype7count = number_format($programtype7count);

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
		<td align=\"right\">$programtype1count</td>
		<td align=\"right\">$programtype2count</td>
		<td align=\"right\">$programtype3count</td>
		<td align=\"right\">$programtype4count</td>
		<td align=\"right\">$programtype5count</td>
		<td align=\"right\">$programtype6count</td>
		<td align=\"right\">$programtype7count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages8file = fopen("export/advancedsearch_ages8.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages8file, ${'ages8row_'.$i});
}

fclose($ages8file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of 21st Century Community Centers</th>
		<th>Number of Faith-Based Programs</th>
		<th>Number of Public School Based Programs</th>
		<th>Number of Private School Based Programs</th>
		<th>Number of Home Based Programs</th>
		<th>Number of Corperate Run Programs</th>
		<th>Number of Community Based Programs</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages8.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($ages8=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
