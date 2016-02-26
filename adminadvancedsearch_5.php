<?php

$summary5 = $_REQUEST['summary5'];
$cd5 = $_REQUEST['cd5'];
$sld5 = $_REQUEST['sld5'];
$elm5 = $_REQUEST['elm5'];
$union5 = $_REQUEST['union5'];
$city5 = $_REQUEST['city5'];
$activity5 = $_REQUEST['activity5'];
$ages5 = $_REQUEST['ages5'];

if ($summary5=='t' || $cd5=='t' || $sld5=='t' || $elm5=='t' || $union5=='t' || $city5=='t' || $activity5=='t' || $ages5=='t') {

?>
<div class="clear"></div>
<h1>Capacity and Staffing</h1>
<?php
// if summary table is selected
if ($summary5=='t') {

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
$summary5row_0 = array( );
$summary5row_0[] = 'Category';
$summary5row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary5row_1 = array( );
$summary5row_1[] = 'Number of Sites';
$summary5row_1[] = $sitescount;
$summary5row_2 = array( );
$summary5row_2[] = 'Average Site Capacity';
$summary5row_2[] = $capacityavg;
$summary5row_3 = array( );
$summary5row_3[] = 'Number of Sites at Capacity';
$summary5row_3[] = $atcapacitycount;
$summary5row_4 = array( );
$summary5row_4[] = 'Number of Children Served';
$summary5row_4[] = $servedcount;
$summary5row_5 = array( );
$summary5row_5[] = 'Average Number of Children Served';
$summary5row_5[] = $servedavg;
$summary5row_6 = array( );
$summary5row_6[] = 'Average Number Full-Time Staff';
$summary5row_6[] = $fulltimestaffavg;
$summary5row_7 = array( );
$summary5row_7[] = 'Average Number Part-Time Staff';
$summary5row_7[] = $parttimestaffavg;
$summary5row_8 = array( );
$summary5row_8[] = 'Average Number Volunteer Staff';
$summary5row_8[] = $volunteerstaffavg;
$summary5row_9 = array( );
$summary5row_9[] = 'Average Number Working Staff';
$summary5row_9[] = $workingstaffavg;

// build csv file
$summary5file = fopen("export/advancedsearch_summary5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 9; $i++) {
	fputcsv($summary5file, ${'summary5row_'.$i});
}

fclose($summary5file); 


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Site Capacity</td>
		<td align="right"><?php echo $capacityavg; ?></td>
	</tr>
	<tr>
		<td>Number of Sites at Capacity</td>
		<td align="right"><?php echo $atcapacitycount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Children Served</td>
		<td align="right"><?php echo $servedcount; ?></td>
	</tr>
	<tr>
		<td>Average Number of Children Served</td>
		<td align="right"><?php echo $servedavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Number Full-Time Staff</td>
		<td align="right"><?php echo $fulltimestaffavg; ?></td>
	</tr>
	<tr>
		<td>Average Number Part-Time Staff</td>
		<td align="right"><?php echo $parttimestaffavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Number Volunteer Staff</td>
		<td align="right"><?php echo $volunteerstaffavg; ?></td>
	</tr>
	<tr>
		<td>Average Number Working Staff</td>
		<td align="right"><?php echo $workingstaffavg; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?php

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd5=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_congress AS c ON ST_Contains(c.the_geom, b.the_geom) GROUP BY c.gid;";
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
$cd5row_0 = array( );
$cd5row_0[] = 'Congressional District';
$cd5row_0[] = 'Number of Sites';
$cd5row_0[] = 'Average Site Capacity';
$cd5row_0[] = 'Number of Sites at Capacity';
$cd5row_0[] = 'Number of Children Served';
$cd5row_0[] = 'Average Number of Children Served';
$cd5row_0[] = 'Average Number Full-Time Staff';
$cd5row_0[] = 'Average Number Part-Time Staff';
$cd5row_0[] = 'Average Number Volunteer Staff';
$cd5row_0[] = 'Average Number Working Staff';


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

// clear ands from above except and0
$and1 = '';
$and2 = '';
$and3 = '';
$and4 = '';
$and5 = '';
$and6 = '';


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

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($servedcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($servedcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd5row_'.$count} = array();
${'cd5row_'.$count}[] = $gid;
${'cd5row_'.$count}[] = $sitescount;
${'cd5row_'.$count}[] = $capacityavg;
${'cd5row_'.$count}[] = $atcapacitycount;
${'cd5row_'.$count}[] = $servedcount;
${'cd5row_'.$count}[] = $servedavg;
${'cd5row_'.$count}[] = $fulltimestaffavg;
${'cd5row_'.$count}[] = $parttimestaffavg;
${'cd5row_'.$count}[] = $volunteerstaffavg;
${'cd5row_'.$count}[] = $workingstaffavg;


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

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
		<td align=\"right\">$capacityavg</td>
		<td align=\"right\">$atcapacitycount</td>
		<td align=\"right\">$servedcount</td>
		<td align=\"right\">$servedavg</td>
		<td align=\"right\">$fulltimestaffavg</td>
		<td align=\"right\">$parttimestaffavg</td>
		<td align=\"right\">$volunteerstaffavg</td>
		<td align=\"right\">$workingstaffavg</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Site Capacity: <b>$capacityavg</b><br />Number of Sites at Capacity: <b>$atcapacitycount</b><br />Number of Children Served: <b>$servedcount</b><br />Average Number of Children Served: <b>$servedavg</b><br />Average Number Full-Time Staff: <b>$fulltimestaffavg</b><br />Average Number Part-Time Staff: <b>$parttimestaffavg</b><br />Average Number Volunteer Staff: <b>$volunteerstaffavg</b><br />Average Number Working Staff: <b>$workingstaffavg</b><br />]]></description>";

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
$cd5file = fopen("export/advancedsearch_congressionaldistrict5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd5file, ${'cd5row_'.$i});
}

fclose($cd5file); 


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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict5.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Average Site Capacity</th>
		<th>Number of Sites at Capacity</th>
		<th>Number of Children Served</th>
		<th>Average Number of Children Served</th>
		<th>Average Number Full-Time Staff</th>
		<th>Average Number Part-Time Staff</th>
		<th>Average Number Volunteer Staff</th>
		<th>Average Number Working Staff</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict5.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?php

}else{} // if ($cd5=='t') {


// if by state legislative districts is selected
if ($sld5=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_legisl AS d ON ST_Contains(d.the_geom, b.the_geom) GROUP BY d.gid;";
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
$sld5row_0 = array( );
$sld5row_0[] = 'State Legislaltive District';
$sld5row_0[] = 'Number of Sites';
$sld5row_0[] = 'Average Site Capacity';
$sld5row_0[] = 'Number of Sites at Capacity';
$sld5row_0[] = 'Number of Children Served';
$sld5row_0[] = 'Average Number of Children Served';
$sld5row_0[] = 'Average Number Full-Time Staff';
$sld5row_0[] = 'Average Number Part-Time Staff';
$sld5row_0[] = 'Average Number Volunteer Staff';
$sld5row_0[] = 'Average Number Working Staff';

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

// clear ands from above except and0
$and1 = '';
$and2 = '';
$and3 = '';
$and4 = '';
$and5 = '';
$and6 = '';


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

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($servedcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($servedcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld5row_'.$count} = array();
${'sld5row_'.$count}[] = $gid;
${'sld5row_'.$count}[] = $sitescount;
${'sld5row_'.$count}[] = $capacityavg;
${'sld5row_'.$count}[] = $atcapacitycount;
${'sld5row_'.$count}[] = $servedcount;
${'sld5row_'.$count}[] = $servedavg;
${'sld5row_'.$count}[] = $fulltimestaffavg;
${'sld5row_'.$count}[] = $parttimestaffavg;
${'sld5row_'.$count}[] = $volunteerstaffavg;
${'sld5row_'.$count}[] = $workingstaffavg;


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

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
		<td align=\"right\">$capacityavg</td>
		<td align=\"right\">$atcapacitycount</td>
		<td align=\"right\">$servedcount</td>
		<td align=\"right\">$servedavg</td>
		<td align=\"right\">$fulltimestaffavg</td>
		<td align=\"right\">$parttimestaffavg</td>
		<td align=\"right\">$volunteerstaffavg</td>
		<td align=\"right\">$workingstaffavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Site Capacity: <b>$capacityavg</b><br />Number of Sites at Capacity: <b>$atcapacitycount</b><br />Number of Children Served: <b>$servedcount</b><br />Average Number of Children Served: <b>$servedavg</b><br />Average Number Full-Time Staff: <b>$fulltimestaffavg</b><br />Average Number Part-Time Staff: <b>$parttimestaffavg</b><br />Average Number Volunteer Staff: <b>$volunteerstaffavg</b><br />Average Number Working Staff: <b>$workingstaffavg</b><br />]]></description>";

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
$sld5file = fopen("export/advancedsearch_statelegislativedistrict5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld5file, ${'sld5row_'.$i});
}

fclose($sld5file); 

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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict5.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Average Site Capacity</th>
		<th>Number of Sites at Capacity</th>
		<th>Number of Children Served</th>
		<th>Average Number of Children Served</th>
		<th>Average Number Full-Time Staff</th>
		<th>Average Number Part-Time Staff</th>
		<th>Average Number Volunteer Staff</th>
		<th>Average Number Working Staff</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict5.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($sld5=='t') {


// if by elementary school distircts is selected
if ($elm5=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_elm_districts AS e ON ST_Contains(e.the_geom, b.the_geom) GROUP BY e.gid;";
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
$elm5row_0 = array( );
$elm5row_0[] = 'Elementary School District Name';
$elm5row_0[] = 'Number of Sites';
$elm5row_0[] = 'Average Site Capacity';
$elm5row_0[] = 'Number of Sites at Capacity';
$elm5row_0[] = 'Number of Children Served';
$elm5row_0[] = 'Average Number of Children Served';
$elm5row_0[] = 'Average Number Full-Time Staff';
$elm5row_0[] = 'Average Number Part-Time Staff';
$elm5row_0[] = 'Average Number Volunteer Staff';
$elm5row_0[] = 'Average Number Working Staff';


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

// clear ands from above except and0
$and1 = '';
$and2 = '';
$and3 = '';
$and4 = '';
$and5 = '';
$and6 = '';


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

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($servedcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($servedcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm5row_'.$count} = array();
${'elm5row_'.$count}[] = $name;
${'elm5row_'.$count}[] = $sitescount;
${'elm5row_'.$count}[] = $capacityavg;
${'elm5row_'.$count}[] = $atcapacitycount;
${'elm5row_'.$count}[] = $servedcount;
${'elm5row_'.$count}[] = $servedavg;
${'elm5row_'.$count}[] = $fulltimestaffavg;
${'elm5row_'.$count}[] = $parttimestaffavg;
${'elm5row_'.$count}[] = $volunteerstaffavg;
${'elm5row_'.$count}[] = $workingstaffavg;


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

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
		<td align=\"right\">$capacityavg</td>
		<td align=\"right\">$atcapacitycount</td>
		<td align=\"right\">$servedcount</td>
		<td align=\"right\">$servedavg</td>
		<td align=\"right\">$fulltimestaffavg</td>
		<td align=\"right\">$parttimestaffavg</td>
		<td align=\"right\">$volunteerstaffavg</td>
		<td align=\"right\">$workingstaffavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Site Capacity: <b>$capacityavg</b><br />Number of Sites at Capacity: <b>$atcapacitycount</b><br />Number of Children Served: <b>$servedcount</b><br />Average Number of Children Served: <b>$servedavg</b><br />Average Number Full-Time Staff: <b>$fulltimestaffavg</b><br />Average Number Part-Time Staff: <b>$parttimestaffavg</b><br />Average Number Volunteer Staff: <b>$volunteerstaffavg</b><br />Average Number Working Staff: <b>$workingstaffavg</b><br />]]></description>";

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
$elm5file = fopen("export/advancedsearch_elementaryschooldistrict5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm5file, ${'elm5row_'.$i});
}

fclose($elm5file); 

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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict5.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Average Site Capacity</th>
		<th>Number of Sites at Capacity</th>
		<th>Number of Children Served</th>
		<th>Average Number of Children Served</th>
		<th>Average Number Full-Time Staff</th>
		<th>Average Number Part-Time Staff</th>
		<th>Average Number Volunteer Staff</th>
		<th>Average Number Working Staff</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict5.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($elm5=='t') {


// if by By Secondary/Union School District is selected
if ($union5=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_union_second_school_distcts AS f ON ST_Contains(f.the_geom, b.the_geom) GROUP BY f.gid;";
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
$union5row_0 = array( );
$union5row_0[] = 'Secondary/Union School District Name';
$union5row_0[] = 'Number of Sites';
$union5row_0[] = 'Average Site Capacity';
$union5row_0[] = 'Number of Sites at Capacity';
$union5row_0[] = 'Number of Children Served';
$union5row_0[] = 'Average Number of Children Served';
$union5row_0[] = 'Average Number Full-Time Staff';
$union5row_0[] = 'Average Number Part-Time Staff';
$union5row_0[] = 'Average Number Volunteer Staff';
$union5row_0[] = 'Average Number Working Staff';


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

// clear ands from above except and0
$and1 = '';
$and2 = '';
$and3 = '';
$and4 = '';
$and5 = '';
$and6 = '';


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

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($servedcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($servedcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union5row_'.$count} = array();
${'union5row_'.$count}[] = $name;
${'union5row_'.$count}[] = $sitescount;
${'union5row_'.$count}[] = $capacityavg;
${'union5row_'.$count}[] = $atcapacitycount;
${'union5row_'.$count}[] = $servedcount;
${'union5row_'.$count}[] = $servedavg;
${'union5row_'.$count}[] = $fulltimestaffavg;
${'union5row_'.$count}[] = $parttimestaffavg;
${'union5row_'.$count}[] = $volunteerstaffavg;
${'union5row_'.$count}[] = $workingstaffavg;


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

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
		<td align=\"right\">$capacityavg</td>
		<td align=\"right\">$atcapacitycount</td>
		<td align=\"right\">$servedcount</td>
		<td align=\"right\">$servedavg</td>
		<td align=\"right\">$fulltimestaffavg</td>
		<td align=\"right\">$parttimestaffavg</td>
		<td align=\"right\">$volunteerstaffavg</td>
		<td align=\"right\">$workingstaffavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Site Capacity: <b>$capacityavg</b><br />Number of Sites at Capacity: <b>$atcapacitycount</b><br />Number of Children Served: <b>$servedcount</b><br />Average Number of Children Served: <b>$servedavg</b><br />Average Number Full-Time Staff: <b>$fulltimestaffavg</b><br />Average Number Part-Time Staff: <b>$parttimestaffavg</b><br />Average Number Volunteer Staff: <b>$volunteerstaffavg</b><br />Average Number Working Staff: <b>$workingstaffavg</b><br />]]></description>";

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
$union5file = fopen("export/advancedsearch_unionschooldistrict5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union5file, ${'union5row_'.$i});
}

fclose($union5file); 

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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict5.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Average Site Capacity</th>
		<th>Number of Sites at Capacity</th>
		<th>Number of Children Served</th>
		<th>Average Number of Children Served</th>
		<th>Average Number Full-Time Staff</th>
		<th>Average Number Part-Time Staff</th>
		<th>Average Number Volunteer Staff</th>
		<th>Average Number Working Staff</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict5.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($union5=='t') {


// if by az cities is selected
if ($city5=='t') {

// set up KML polygon fill styles for thematic mapping
$kmlbody = '';
$maxminsitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid JOIN az_cities AS g ON ST_Contains(g.the_geom, b.the_geom) GROUP BY g.gid;";
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
$city5row_0 = array( );
$city5row_0[] = 'City Name';
$city5row_0[] = 'Number of Sites';
$city5row_0[] = 'Average Site Capacity';
$city5row_0[] = 'Number of Sites at Capacity';
$city5row_0[] = 'Number of Children Served';
$city5row_0[] = 'Average Number of Children Served';
$city5row_0[] = 'Average Number Full-Time Staff';
$city5row_0[] = 'Average Number Part-Time Staff';
$city5row_0[] = 'Average Number Volunteer Staff';
$city5row_0[] = 'Average Number Working Staff';


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

// clear ands from above except and0
$and1 = '';
$and2 = '';
$and3 = '';
$and4 = '';
$and5 = '';
$and6 = '';


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

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($servedcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($servedcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($servedcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city5row_'.$count} = array();
${'city5row_'.$count}[] = $name;
${'city5row_'.$count}[] = $sitescount;
${'city5row_'.$count}[] = $capacityavg;
${'city5row_'.$count}[] = $atcapacitycount;
${'city5row_'.$count}[] = $servedcount;
${'city5row_'.$count}[] = $servedavg;
${'city5row_'.$count}[] = $fulltimestaffavg;
${'city5row_'.$count}[] = $parttimestaffavg;
${'city5row_'.$count}[] = $volunteerstaffavg;
${'city5row_'.$count}[] = $workingstaffavg;


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

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
		<td align=\"right\">$capacityavg</td>
		<td align=\"right\">$atcapacitycount</td>
		<td align=\"right\">$servedcount</td>
		<td align=\"right\">$servedavg</td>
		<td align=\"right\">$fulltimestaffavg</td>
		<td align=\"right\">$parttimestaffavg</td>
		<td align=\"right\">$volunteerstaffavg</td>
		<td align=\"right\">$workingstaffavg</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Average Site Capacity: <b>$capacityavg</b><br />Number of Sites at Capacity: <b>$atcapacitycount</b><br />Number of Children Served: <b>$servedcount</b><br />Average Number of Children Served: <b>$servedavg</b><br />Average Number Full-Time Staff: <b>$fulltimestaffavg</b><br />Average Number Part-Time Staff: <b>$parttimestaffavg</b><br />Average Number Volunteer Staff: <b>$volunteerstaffavg</b><br />Average Number Working Staff: <b>$workingstaffavg</b><br />]]></description>";

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
$city5file = fopen("export/advancedsearch_cities5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city5file, ${'city5row_'.$i});
}

fclose($city5file); 

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

$locationkmlfile = fopen("export/advancedsearch_cities5.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Average Site Capacity</th>
		<th>Number of Sites at Capacity</th>
		<th>Number of Children Served</th>
		<th>Average Number of Children Served</th>
		<th>Average Number Full-Time Staff</th>
		<th>Average Number Part-Time Staff</th>
		<th>Average Number Volunteer Staff</th>
		<th>Average Number Working Staff</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities5.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($city5=='t') {


// if by activity is selected
if ($activity5=='t') {

// set up array for csv
$activity5row_0 = array( );
$activity5row_0[] = 'Activity';
$activity5row_0[] = 'Number of Sites';
$activity5row_0[] = 'Average Site Capacity';
$activity5row_0[] = 'Number of Sites at Capacity';
$activity5row_0[] = 'Number of Children Served';
$activity5row_0[] = 'Average Number of Children Served';
$activity5row_0[] = 'Average Number Full-Time Staff';
$activity5row_0[] = 'Average Number Part-Time Staff';
$activity5row_0[] = 'Average Number Volunteer Staff';
$activity5row_0[] = 'Average Number Working Staff';


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

// clear ands from above except and0
$and1 = '';
$and2 = '';
$and3 = '';
$and4 = '';
$and5 = '';
$and6 = '';


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

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity5row_'.$count} = array();
${'activity5row_'.$count}[] = $name;
${'activity5row_'.$count}[] = $sitescount;
${'activity5row_'.$count}[] = $capacityavg;
${'activity5row_'.$count}[] = $atcapacitycount;
${'activity5row_'.$count}[] = $servedcount;
${'activity5row_'.$count}[] = $servedavg;
${'activity5row_'.$count}[] = $fulltimestaffavg;
${'activity5row_'.$count}[] = $parttimestaffavg;
${'activity5row_'.$count}[] = $volunteerstaffavg;
${'activity5row_'.$count}[] = $workingstaffavg;


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

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
		<td align=\"right\">$capacityavg</td>
		<td align=\"right\">$atcapacitycount</td>
		<td align=\"right\">$servedcount</td>
		<td align=\"right\">$servedavg</td>
		<td align=\"right\">$fulltimestaffavg</td>
		<td align=\"right\">$parttimestaffavg</td>
		<td align=\"right\">$volunteerstaffavg</td>
		<td align=\"right\">$workingstaffavg</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity5file = fopen("export/advancedsearch_activity5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity5file, ${'activity5row_'.$i});
}

fclose($activity5file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Average Site Capacity</th>
		<th>Number of Sites at Capacity</th>
		<th>Number of Children Served</th>
		<th>Average Number of Children Served</th>
		<th>Average Number Full-Time Staff</th>
		<th>Average Number Part-Time Staff</th>
		<th>Average Number Volunteer Staff</th>
		<th>Average Number Working Staff</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($activity5=='t') {


// if by activity is selected
if ($ages5=='t') {

// set up array for csv
$ages5row_0 = array( );
$ages5row_0[] = 'Ages Served';
$ages5row_0[] = 'Number of Sites';
$ages5row_0[] = 'Average Site Capacity';
$ages5row_0[] = 'Number of Sites at Capacity';
$ages5row_0[] = 'Number of Children Served';
$ages5row_0[] = 'Average Number of Children Served';
$ages5row_0[] = 'Average Number Full-Time Staff';
$ages5row_0[] = 'Average Number Part-Time Staff';
$ages5row_0[] = 'Average Number Volunteer Staff';
$ages5row_0[] = 'Average Number Working Staff';


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

// clear ands from above except and0
$and1 = '';
$and2 = '';
$and3 = '';
$and4 = '';
$and5 = '';
$and6 = '';


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

// Average capacity
$sitescountquery = "SELECT avg(s.capacity) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$capacityavg = pg_result($sitesresult, $lt, 0);
}

// total sites at capacity 
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.atcapacity = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$atcapacitycount = pg_result($sitesresult, $lt, 0);
}

// Total number of children served
$sitescountquery = "SELECT sum(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedcount = pg_result($sitesresult, $lt, 0);
}

// Average number of children served
$sitescountquery = "SELECT avg(s.served) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$servedavg = pg_result($sitesresult, $lt, 0);
}


// average number of fulltimestaff
$sitescountquery = "SELECT avg(s.fulltimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$fulltimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of parttimestaff
$sitescountquery = "SELECT avg(s.parttimestaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parttimestaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of volunteerstaff
$sitescountquery = "SELECT avg(s.volunteerstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$volunteerstaffavg = pg_result($sitesresult, $lt, 0);
}

// Total number of workingstaff
$sitescountquery = "SELECT avg(s.workingstaff) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$workingstaffavg = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages5row_'.$count} = array();
${'ages5row_'.$count}[] = $name;
${'ages5row_'.$count}[] = $sitescount;
${'ages5row_'.$count}[] = $capacityavg;
${'ages5row_'.$count}[] = $atcapacitycount;
${'ages5row_'.$count}[] = $servedcount;
${'ages5row_'.$count}[] = $servedavg;
${'ages5row_'.$count}[] = $fulltimestaffavg;
${'ages5row_'.$count}[] = $parttimestaffavg;
${'ages5row_'.$count}[] = $volunteerstaffavg;
${'ages5row_'.$count}[] = $workingstaffavg;


// clean up data for html
$sitescount = number_format($sitescount);
$capacityavg = number_format($capacityavg, 2);
$atcapacitycount = number_format($atcapacitycount);
$servedcount = number_format($servedcount);
$servedavg = number_format($servedavg, 2);
$fulltimestaffavg = number_format($fulltimestaffavg, 2);
$parttimestaffavg = number_format($parttimestaffavg, 2);
$volunteerstaffavg = number_format($volunteerstaffavg, 2);
$workingstaffavg = number_format($workingstaffavg, 2);

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
		<td align=\"right\">$capacityavg</td>
		<td align=\"right\">$atcapacitycount</td>
		<td align=\"right\">$servedcount</td>
		<td align=\"right\">$servedavg</td>
		<td align=\"right\">$fulltimestaffavg</td>
		<td align=\"right\">$parttimestaffavg</td>
		<td align=\"right\">$volunteerstaffavg</td>
		<td align=\"right\">$workingstaffavg</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages5file = fopen("export/advancedsearch_ages5.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages5file, ${'ages5row_'.$i});
}

fclose($ages5file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Average Site Capacity</th>
		<th>Number of Sites at Capacity</th>
		<th>Number of Children Served</th>
		<th>Average Number of Children Served</th>
		<th>Average Number Full-Time Staff</th>
		<th>Average Number Part-Time Staff</th>
		<th>Average Number Volunteer Staff</th>
		<th>Average Number Working Staff</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages5.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($ages5=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
