<?php

$summary14 = $_REQUEST['summary14'];
$cd14 = $_REQUEST['cd14'];
$sld14 = $_REQUEST['sld14'];
$elm14 = $_REQUEST['elm14'];
$union14 = $_REQUEST['union14'];
$city14 = $_REQUEST['city14'];
$activity14 = $_REQUEST['activity14'];
$ages14 = $_REQUEST['ages14'];

if ($summary14=='t' || $cd14=='t' || $sld14=='t' || $elm14=='t' || $union14=='t' || $city14=='t' || $activity14=='t' || $ages14=='t') {

?>
<div class="clear"></div>
<h1>Program Evaluation</h1>
<?php
// if summary table is selected
if ($summary14=='t') {

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
$summary14row_0 = array( );
$summary14row_0[] = 'Category';
$summary14row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}



// add data to csv
$summary14row_1 = array( );
$summary14row_1[] = 'Number of Sites';
$summary14row_1[] = $sitescount;
$summary14row_2 = array( );
$summary14row_2[] = 'Number of Sites That Evaluate The Quality of The Site';
$summary14row_2[] = $evaluate_programcount;
$summary14row_3 = array( );
$summary14row_3[] = 'Number of Sites Perform Informal Self-Assessments';
$summary14row_3[] = $evaluate_type1count;
$summary14row_4 = array( );
$summary14row_4[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria';
$summary14row_4[] = $evaluate_type4count;
$summary14row_5 = array( );
$summary14row_5[] = 'Number of Sites Perform Parent/Client Surveys';
$summary14row_5[] = $evaluate_type5count;
$summary14row_6 = array( );
$summary14row_6[] = 'Number of Sites Perform Host School Evaluations';
$summary14row_6[] = $evaluate_type6count;
$summary14row_7 = array( );
$summary14row_7[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$summary14row_7[] = $evaluate_type7count;
$summary14row_8 = array( );
$summary14row_8[] = 'Number of Sites Perform Evaluations with Other Tools';
$summary14row_8[] = $evaluate_type8count;

// build csv file
$summary14file = fopen("export/advancedsearch_summary14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 8; $i++) {
	fputcsv($summary14file, ${'summary14row_'.$i});
}

fclose($summary14file); 


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Evaluate The Quality of The Site</td>
		<td align="right"><?php echo $evaluate_programcount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Perform Informal Self-Assessments</td>
		<td align="right"><?php echo $evaluate_type1count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </td>
		<td align="right"><?php echo $evaluate_type4count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Perform Parent/Client Surveys</td>
		<td align="right"><?php echo $evaluate_type5count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Perform Host School Evaluations</td>
		<td align="right"><?php echo $evaluate_type6count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</td>
		<td align="right"><?php echo $evaluate_type7count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Perform Evaluations with Other Tools</td>
		<td align="right"><?php echo $evaluate_type8count; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?php

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd14=='t') {

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
$cd14row_0 = array( );
$cd14row_0[] = 'Congressional District';
$cd14row_0[] = 'Number of Sites';
$cd14row_0[] = 'Number of Sites That Evaluate The Quality of The Site ';
$cd14row_0[] = 'Number of Sites Perform Informal Self-Assessments';
$cd14row_0[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria ';
$cd14row_0[] = 'Number of Sites Perform Parent/Client Surveys';
$cd14row_0[] = 'Number of Sites Perform Host School Evaluations';
$cd14row_0[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$cd14row_0[] = 'Number of Sites Perform Evaluations with Other Tools';



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

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($evaluate_programcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($evaluate_programcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd14row_'.$count} = array();
${'cd14row_'.$count}[] = $gid;
${'cd14row_'.$count}[] = $sitescount;
${'cd14row_'.$count}[] = $evaluate_programcount;
${'cd14row_'.$count}[] = $evaluate_type1count;
${'cd14row_'.$count}[] = $evaluate_type4count;
${'cd14row_'.$count}[] = $evaluate_type5count;
${'cd14row_'.$count}[] = $evaluate_type6count;
${'cd14row_'.$count}[] = $evaluate_type7count;
${'cd14row_'.$count}[] = $evaluate_type8count;


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

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
		<td align=\"right\">$evaluate_programcount</td>
		<td align=\"right\">$evaluate_type1count</td>
		<td align=\"right\">$evaluate_type4count</td>
		<td align=\"right\">$evaluate_type5count</td>
		<td align=\"right\">$evaluate_type6count</td>
		<td align=\"right\">$evaluate_type7count</td>
		<td align=\"right\">$evaluate_type8count</td>

	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Evaluate The Quality of The Site : <b>$evaluate_programcount</b><br />Number of Sites Perform Informal Self-Assessments: <b>$evaluate_type1count</b><br />Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria : <b>$evaluate_type4count</b><br />Number of Sites Perform Parent/Client Surveys: <b>$evaluate_type5count</b><br />Number of Sites Perform Host School Evaluations: <b>$evaluate_type6count</b><br />Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools: <b>$evaluate_type7count</b><br />Number of Sites Perform Evaluations with Other Tools: <b>$evaluate_type8count</b><br />]]></description>";


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
$cd14file = fopen("export/advancedsearch_congressionaldistrict14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd14file, ${'cd14row_'.$i});
}

fclose($cd14file); 


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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict14.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Evaluate The Quality of The Site </th>
		<th>Number of Sites Perform Informal Self-Assessments</th>
		<th>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </th>
		<th>Number of Sites Perform Parent/Client Surveys</th>
		<th>Number of Sites Perform Host School Evaluations</th>
		<th>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</th>
		<th>Number of Sites Perform Evaluations with Other Tools</th>
	
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict14.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?php

}else{} // if ($cd14=='t') {


// if by state legislative districts is selected
if ($sld14=='t') {

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
$sld14row_0 = array( );
$sld14row_0[] = 'State Legislaltive District';
$sld14row_0[] = 'Number of Sites';
$sld14row_0[] = 'Number of Sites That Evaluate The Quality of The Site ';
$sld14row_0[] = 'Number of Sites Perform Informal Self-Assessments';
$sld14row_0[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria ';
$sld14row_0[] = 'Number of Sites Perform Parent/Client Surveys';
$sld14row_0[] = 'Number of Sites Perform Host School Evaluations';
$sld14row_0[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$sld14row_0[] = 'Number of Sites Perform Evaluations with Other Tools';

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

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($evaluate_programcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($evaluate_programcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld14row_'.$count} = array();
${'sld14row_'.$count}[] = $gid;
${'sld14row_'.$count}[] = $sitescount;
${'sld14row_'.$count}[] = $evaluate_programcount;
${'sld14row_'.$count}[] = $evaluate_type1count;
${'sld14row_'.$count}[] = $evaluate_type4count;
${'sld14row_'.$count}[] = $evaluate_type5count;
${'sld14row_'.$count}[] = $evaluate_type6count;
${'sld14row_'.$count}[] = $evaluate_type7count;
${'sld14row_'.$count}[] = $evaluate_type8count;


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

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
		<td align=\"right\">$evaluate_programcount</td>
		<td align=\"right\">$evaluate_type1count</td>
		<td align=\"right\">$evaluate_type4count</td>
		<td align=\"right\">$evaluate_type5count</td>
		<td align=\"right\">$evaluate_type6count</td>
		<td align=\"right\">$evaluate_type7count</td>
		<td align=\"right\">$evaluate_type8count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Evaluate The Quality of The Site : <b>$evaluate_programcount</b><br />Number of Sites Perform Informal Self-Assessments: <b>$evaluate_type1count</b><br />Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria : <b>$evaluate_type4count</b><br />Number of Sites Perform Parent/Client Surveys: <b>$evaluate_type5count</b><br />Number of Sites Perform Host School Evaluations: <b>$evaluate_type6count</b><br />Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools: <b>$evaluate_type7count</b><br />Number of Sites Perform Evaluations with Other Tools: <b>$evaluate_type8count</b><br />]]></description>";

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
$sld14file = fopen("export/advancedsearch_statelegislativedistrict14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld14file, ${'sld14row_'.$i});
}

fclose($sld14file); 

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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict14.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Evaluate The Quality of The Site </th>
		<th>Number of Sites Perform Informal Self-Assessments</th>
		<th>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </th>
		<th>Number of Sites Perform Parent/Client Surveys</th>
		<th>Number of Sites Perform Host School Evaluations</th>
		<th>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</th>
		<th>Number of Sites Perform Evaluations with Other Tools</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict14.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($sld14=='t') {


// if by elementary school distircts is selected
if ($elm14=='t') {

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
$elm14row_0 = array( );
$elm14row_0[] = 'Elementary School District Name';
$elm14row_0[] = 'Number of Sites';
$elm14row_0[] = 'Number of Sites That Evaluate The Quality of The Site ';
$elm14row_0[] = 'Number of Sites Perform Informal Self-Assessments';
$elm14row_0[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria ';
$elm14row_0[] = 'Number of Sites Perform Parent/Client Surveys';
$elm14row_0[] = 'Number of Sites Perform Host School Evaluations';
$elm14row_0[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$elm14row_0[] = 'Number of Sites Perform Evaluations with Other Tools';


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

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($evaluate_programcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($evaluate_programcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm14row_'.$count} = array();
${'elm14row_'.$count}[] = $name;
${'elm14row_'.$count}[] = $sitescount;
${'elm14row_'.$count}[] = $evaluate_programcount;
${'elm14row_'.$count}[] = $evaluate_type1count;
${'elm14row_'.$count}[] = $evaluate_type4count;
${'elm14row_'.$count}[] = $evaluate_type5count;
${'elm14row_'.$count}[] = $evaluate_type6count;
${'elm14row_'.$count}[] = $evaluate_type7count;
${'elm14row_'.$count}[] = $evaluate_type8count;


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

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
		<td align=\"right\">$evaluate_programcount</td>
		<td align=\"right\">$evaluate_type1count</td>
		<td align=\"right\">$evaluate_type4count</td>
		<td align=\"right\">$evaluate_type5count</td>
		<td align=\"right\">$evaluate_type6count</td>
		<td align=\"right\">$evaluate_type7count</td>
		<td align=\"right\">$evaluate_type8count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Evaluate The Quality of The Site : <b>$evaluate_programcount</b><br />Number of Sites Perform Informal Self-Assessments: <b>$evaluate_type1count</b><br />Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria : <b>$evaluate_type4count</b><br />Number of Sites Perform Parent/Client Surveys: <b>$evaluate_type5count</b><br />Number of Sites Perform Host School Evaluations: <b>$evaluate_type6count</b><br />Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools: <b>$evaluate_type7count</b><br />Number of Sites Perform Evaluations with Other Tools: <b>$evaluate_type8count</b><br />]]></description>";

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
$elm14file = fopen("export/advancedsearch_elementaryschooldistrict14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm14file, ${'elm14row_'.$i});
}

fclose($elm14file); 

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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict14.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Evaluate The Quality of The Site </th>
		<th>Number of Sites Perform Informal Self-Assessments</th>
		<th>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </th>
		<th>Number of Sites Perform Parent/Client Surveys</th>
		<th>Number of Sites Perform Host School Evaluations</th>
		<th>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</th>
		<th>Number of Sites Perform Evaluations with Other Tools</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict14.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($elm14=='t') {


// if by By Secondary/Union School District is selected
if ($union14=='t') {

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
$union14row_0 = array( );
$union14row_0[] = 'Secondary/Union School District Name';
$union14row_0[] = 'Number of Sites';
$union14row_0[] = 'Number of Sites That Evaluate The Quality of The Site ';
$union14row_0[] = 'Number of Sites Perform Informal Self-Assessments';
$union14row_0[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria ';
$union14row_0[] = 'Number of Sites Perform Parent/Client Surveys';
$union14row_0[] = 'Number of Sites Perform Host School Evaluations';
$union14row_0[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$union14row_0[] = 'Number of Sites Perform Evaluations with Other Tools';


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

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($evaluate_programcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($evaluate_programcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union14row_'.$count} = array();
${'union14row_'.$count}[] = $name;
${'union14row_'.$count}[] = $sitescount;
${'union14row_'.$count}[] = $evaluate_programcount;
${'union14row_'.$count}[] = $evaluate_type1count;
${'union14row_'.$count}[] = $evaluate_type4count;
${'union14row_'.$count}[] = $evaluate_type5count;
${'union14row_'.$count}[] = $evaluate_type6count;
${'union14row_'.$count}[] = $evaluate_type7count;
${'union14row_'.$count}[] = $evaluate_type8count;


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

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
		<td align=\"right\">$evaluate_programcount</td>
		<td align=\"right\">$evaluate_type1count</td>
		<td align=\"right\">$evaluate_type4count</td>
		<td align=\"right\">$evaluate_type5count</td>
		<td align=\"right\">$evaluate_type6count</td>
		<td align=\"right\">$evaluate_type7count</td>
		<td align=\"right\">$evaluate_type8count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Evaluate The Quality of The Site : <b>$evaluate_programcount</b><br />Number of Sites Perform Informal Self-Assessments: <b>$evaluate_type1count</b><br />Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria : <b>$evaluate_type4count</b><br />Number of Sites Perform Parent/Client Surveys: <b>$evaluate_type5count</b><br />Number of Sites Perform Host School Evaluations: <b>$evaluate_type6count</b><br />Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools: <b>$evaluate_type7count</b><br />Number of Sites Perform Evaluations with Other Tools: <b>$evaluate_type8count</b><br />]]></description>";

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
$union14file = fopen("export/advancedsearch_unionschooldistrict14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union14file, ${'union14row_'.$i});
}

fclose($union14file); 

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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict14.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Evaluate The Quality of The Site </th>
		<th>Number of Sites Perform Informal Self-Assessments</th>
		<th>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </th>
		<th>Number of Sites Perform Parent/Client Surveys</th>
		<th>Number of Sites Perform Host School Evaluations</th>
		<th>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</th>
		<th>Number of Sites Perform Evaluations with Other Tools</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict14.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($union14=='t') {


// if by az cities is selected
if ($city14=='t') {

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
$city14row_0 = array( );
$city14row_0[] = 'City Name';
$city14row_0[] = 'Number of Sites';
$city14row_0[] = 'Number of Sites That Evaluate The Quality of The Site ';
$city14row_0[] = 'Number of Sites Perform Informal Self-Assessments';
$city14row_0[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria ';
$city14row_0[] = 'Number of Sites Perform Parent/Client Surveys';
$city14row_0[] = 'Number of Sites Perform Host School Evaluations';
$city14row_0[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$city14row_0[] = 'Number of Sites Perform Evaluations with Other Tools';


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

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($evaluate_programcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($evaluate_programcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($evaluate_programcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city14row_'.$count} = array();
${'city14row_'.$count}[] = $name;
${'city14row_'.$count}[] = $sitescount;
${'city14row_'.$count}[] = $evaluate_programcount;
${'city14row_'.$count}[] = $evaluate_type1count;
${'city14row_'.$count}[] = $evaluate_type4count;
${'city14row_'.$count}[] = $evaluate_type5count;
${'city14row_'.$count}[] = $evaluate_type6count;
${'city14row_'.$count}[] = $evaluate_type7count;
${'city14row_'.$count}[] = $evaluate_type8count;


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

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
		<td align=\"right\">$evaluate_programcount</td>
		<td align=\"right\">$evaluate_type1count</td>
		<td align=\"right\">$evaluate_type4count</td>
		<td align=\"right\">$evaluate_type5count</td>
		<td align=\"right\">$evaluate_type6count</td>
		<td align=\"right\">$evaluate_type7count</td>
		<td align=\"right\">$evaluate_type8count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Evaluate The Quality of The Site : <b>$evaluate_programcount</b><br />Number of Sites Perform Informal Self-Assessments: <b>$evaluate_type1count</b><br />Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria : <b>$evaluate_type4count</b><br />Number of Sites Perform Parent/Client Surveys: <b>$evaluate_type5count</b><br />Number of Sites Perform Host School Evaluations: <b>$evaluate_type6count</b><br />Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools: <b>$evaluate_type7count</b><br />Number of Sites Perform Evaluations with Other Tools: <b>$evaluate_type8count</b><br />]]></description>";

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
$city14file = fopen("export/advancedsearch_cities14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city14file, ${'city14row_'.$i});
}

fclose($city14file); 

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

$locationkmlfile = fopen("export/advancedsearch_cities14.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Evaluate The Quality of The Site </th>
		<th>Number of Sites Perform Informal Self-Assessments</th>
		<th>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </th>
		<th>Number of Sites Perform Parent/Client Surveys</th>
		<th>Number of Sites Perform Host School Evaluations</th>
		<th>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</th>
		<th>Number of Sites Perform Evaluations with Other Tools</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities14.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($city14=='t') {


// if by activity is selected
if ($activity14=='t') {

// set up array for csv
$activity14row_0 = array( );
$activity14row_0[] = 'Activity';
$activity14row_0[] = 'Number of Sites';
$activity14row_0[] = 'Number of Sites That Evaluate The Quality of The Site ';
$activity14row_0[] = 'Number of Sites Perform Informal Self-Assessments';
$activity14row_0[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria ';
$activity14row_0[] = 'Number of Sites Perform Parent/Client Surveys';
$activity14row_0[] = 'Number of Sites Perform Host School Evaluations';
$activity14row_0[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$activity14row_0[] = 'Number of Sites Perform Evaluations with Other Tools';


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

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}


// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity14row_'.$count} = array();
${'activity14row_'.$count}[] = $name;
${'activity14row_'.$count}[] = $sitescount;
${'activity14row_'.$count}[] = $evaluate_programcount;
${'activity14row_'.$count}[] = $evaluate_type1count;
${'activity14row_'.$count}[] = $evaluate_type4count;
${'activity14row_'.$count}[] = $evaluate_type5count;
${'activity14row_'.$count}[] = $evaluate_type6count;
${'activity14row_'.$count}[] = $evaluate_type7count;
${'activity14row_'.$count}[] = $evaluate_type8count;


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

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
		<td align=\"right\">$evaluate_programcount</td>
		<td align=\"right\">$evaluate_type1count</td>
		<td align=\"right\">$evaluate_type4count</td>
		<td align=\"right\">$evaluate_type5count</td>
		<td align=\"right\">$evaluate_type6count</td>
		<td align=\"right\">$evaluate_type7count</td>
		<td align=\"right\">$evaluate_type8count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity14file = fopen("export/advancedsearch_activity14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity14file, ${'activity14row_'.$i});
}

fclose($activity14file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Evaluate The Quality of The Site </th>
		<th>Number of Sites Perform Informal Self-Assessments</th>
		<th>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </th>
		<th>Number of Sites Perform Parent/Client Surveys</th>
		<th>Number of Sites Perform Host School Evaluations</th>
		<th>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</th>
		<th>Number of Sites Perform Evaluations with Other Tools</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($activity14=='t') {


// if by activity is selected
if ($ages14=='t') {

// set up array for csv
$ages14row_0 = array( );
$ages14row_0[] = 'Ages Served';
$ages14row_0[] = 'Number of Sites';
$ages14row_0[] = 'Number of Sites That Evaluate The Quality of The Site ';
$ages14row_0[] = 'Number of Sites Perform Informal Self-Assessments';
$ages14row_0[] = 'Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria ';
$ages14row_0[] = 'Number of Sites Perform Parent/Client Surveys';
$ages14row_0[] = 'Number of Sites Perform Host School Evaluations';
$ages14row_0[] = 'Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools';
$ages14row_0[] = 'Number of Sites Perform Evaluations with Other Tools';


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

// number of sites that evaluate their programs
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_program = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_programcount = pg_result($sitesresult, $lt, 0);
}


// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type1count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type4count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type5count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 6;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type6count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 7;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type7count = pg_result($sitesresult, $lt, 0);
}

// number of sites assess the quality of your program
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.evaluate_type = 8;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$evaluate_type8count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages14row_'.$count} = array();
${'ages14row_'.$count}[] = $name;
${'ages14row_'.$count}[] = $sitescount;
${'ages14row_'.$count}[] = $evaluate_programcount;
${'ages14row_'.$count}[] = $evaluate_type1count;
${'ages14row_'.$count}[] = $evaluate_type4count;
${'ages14row_'.$count}[] = $evaluate_type5count;
${'ages14row_'.$count}[] = $evaluate_type6count;
${'ages14row_'.$count}[] = $evaluate_type7count;
${'ages14row_'.$count}[] = $evaluate_type8count;


// clean up data for html
$sitescount = number_format($sitescount);
$evaluate_programcount = number_format($evaluate_programcount);
$evaluate_type1count = number_format($evaluate_type1count);
$evaluate_type4count = number_format($evaluate_type4count);
$evaluate_type5count = number_format($evaluate_type5count);
$evaluate_type6count = number_format($evaluate_type6count);
$evaluate_type7count = number_format($evaluate_type7count);
$evaluate_type8count = number_format($evaluate_type8count);

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
		<td align=\"right\">$evaluate_programcount</td>
		<td align=\"right\">$evaluate_type1count</td>
		<td align=\"right\">$evaluate_type4count</td>
		<td align=\"right\">$evaluate_type5count</td>
		<td align=\"right\">$evaluate_type6count</td>
		<td align=\"right\">$evaluate_type7count</td>
		<td align=\"right\">$evaluate_type8count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages14file = fopen("export/advancedsearch_ages14.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages14file, ${'ages14row_'.$i});
}

fclose($ages14file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Evaluate The Quality of The Site </th>
		<th>Number of Sites Perform Informal Self-Assessments</th>
		<th>Number of Sites Perform Formal Self-Assessments with Agreed Upon Criteria </th>
		<th>Number of Sites Perform Parent/Client Surveys</th>
		<th>Number of Sites Perform Host School Evaluations</th>
		<th>Number of Sites Perform Evaluations with Nationally Recognized Assessments or Accreditation Tools</th>
		<th>Number of Sites Perform Evaluations with Other Tools</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages14.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($ages14=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
