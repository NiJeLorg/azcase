<?php

$summary6 = $_REQUEST['summary6'];
$cd6 = $_REQUEST['cd6'];
$sld6 = $_REQUEST['sld6'];
$elm6 = $_REQUEST['elm6'];
$union6 = $_REQUEST['union6'];
$city6 = $_REQUEST['city6'];
$activity6 = $_REQUEST['activity6'];
$ages6 = $_REQUEST['ages6'];

if ($summary6=='t' || $cd6=='t' || $sld6=='t' || $elm6=='t' || $union6=='t' || $city6=='t' || $activity6=='t' || $ages6=='t') {

?>
<div class="clear"></div>
<h1>Capacity and Staffing</h1>
<?
// if summary table is selected
if ($summary6=='t') {

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
$summary6row_0 = array( );
$summary6row_0[] = 'Category';
$summary6row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}



// add data to csv
$summary6row_1 = array( );
$summary6row_1[] = 'Number of Sites';
$summary6row_1[] = $sitescount;
$summary6row_2 = array( );
$summary6row_2[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$summary6row_2[] = $parentreferralscount;
$summary6row_3 = array( );
$summary6row_3[] = 'Number of Sites Providing Parental Education';
$summary6row_3[] = $parenteducationcount;
$summary6row_4 = array( );
$summary6row_4[] = 'Number of Sites Providing Information and Handouts to Parents';
$summary6row_4[] = $parentinfocount;

// build csv file
$summary6file = fopen("export/advancedsearch_summary6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 4; $i++) {
	fputcsv($summary6file, ${'summary6row_'.$i});
}

fclose($summary6file); 


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Providing Referrals for Needed Parental Services</td>
		<td align="right"><?php echo $parentreferralscount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Providing Parental Education</td>
		<td align="right"><?php echo $parenteducationcount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Providing Information and Handouts to Parents</td>
		<td align="right"><?php echo $parentinfocount; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd6=='t') {

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
$cd6row_0 = array( );
$cd6row_0[] = 'Congressional District';
$cd6row_0[] = 'Number of Sites';
$cd6row_0[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$cd6row_0[] = 'Number of Sites Providing Parental Education';
$cd6row_0[] = 'Number of Sites Providing Information and Handouts to Parents';


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

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($parentreferralscount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($parentreferralscount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd6row_'.$count} = array();
${'cd6row_'.$count}[] = $gid;
${'cd6row_'.$count}[] = $sitescount;
${'cd6row_'.$count}[] = $parentreferralscount;
${'cd6row_'.$count}[] = $parenteducationcount;
${'cd6row_'.$count}[] = $parentinfocount;


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

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
		<td align=\"right\">$parentreferralscount</td>
		<td align=\"right\">$parenteducationcount</td>
		<td align=\"right\">$parentinfocount</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites Providing Referrals for Needed Parental Services: <b>$parentreferralscount</b><br />Number of Sites Providing Parental Education: <b>$parenteducationcount</b><br />Number of Sites Providing Information and Handouts to Parents: <b>$parentinfocount</b><br />]]></description>";

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
$cd6file = fopen("export/advancedsearch_congressionaldistrict6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd6file, ${'cd6row_'.$i});
}

fclose($cd6file); 


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
	      <href>http://azcase.nijel.org/phpsite/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict6.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites Providing Referrals for Needed Parental Services</th>
		<th>Number of Sites Providing Parental Education</th>
		<th>Number of Sites Providing Information and Handouts to Parents</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict6.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?

}else{} // if ($cd6=='t') {


// if by state legislative districts is selected
if ($sld6=='t') {

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
$sld6row_0 = array( );
$sld6row_0[] = 'State Legislaltive District';
$sld6row_0[] = 'Number of Sites';
$sld6row_0[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$sld6row_0[] = 'Number of Sites Providing Parental Education';
$sld6row_0[] = 'Number of Sites Providing Information and Handouts to Parents';

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

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($parentreferralscount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($parentreferralscount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld6row_'.$count} = array();
${'sld6row_'.$count}[] = $gid;
${'sld6row_'.$count}[] = $sitescount;
${'sld6row_'.$count}[] = $parentreferralscount;
${'sld6row_'.$count}[] = $parenteducationcount;
${'sld6row_'.$count}[] = $parentinfocount;


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

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
		<td align=\"right\">$parentreferralscount</td>
		<td align=\"right\">$parenteducationcount</td>
		<td align=\"right\">$parentinfocount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites Providing Referrals for Needed Parental Services: <b>$parentreferralscount</b><br />Number of Sites Providing Parental Education: <b>$parenteducationcount</b><br />Number of Sites Providing Information and Handouts to Parents: <b>$parentinfocount</b><br />]]></description>";

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
$sld6file = fopen("export/advancedsearch_statelegislativedistrict6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld6file, ${'sld6row_'.$i});
}

fclose($sld6file); 

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
	      <href>http://azcase.nijel.org/phpsite/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict6.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites Providing Referrals for Needed Parental Services</th>
		<th>Number of Sites Providing Parental Education</th>
		<th>Number of Sites Providing Information and Handouts to Parents</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict6.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($sld6=='t') {


// if by elementary school distircts is selected
if ($elm6=='t') {

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
$elm6row_0 = array( );
$elm6row_0[] = 'Elementary School District Name';
$elm6row_0[] = 'Number of Sites';
$elm6row_0[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$elm6row_0[] = 'Number of Sites Providing Parental Education';
$elm6row_0[] = 'Number of Sites Providing Information and Handouts to Parents';


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

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($parentreferralscount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($parentreferralscount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm6row_'.$count} = array();
${'elm6row_'.$count}[] = $name;
${'elm6row_'.$count}[] = $sitescount;
${'elm6row_'.$count}[] = $parentreferralscount;
${'elm6row_'.$count}[] = $parenteducationcount;
${'elm6row_'.$count}[] = $parentinfocount;


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

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
		<td align=\"right\">$parentreferralscount</td>
		<td align=\"right\">$parenteducationcount</td>
		<td align=\"right\">$parentinfocount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites Providing Referrals for Needed Parental Services: <b>$parentreferralscount</b><br />Number of Sites Providing Parental Education: <b>$parenteducationcount</b><br />Number of Sites Providing Information and Handouts to Parents: <b>$parentinfocount</b><br />]]></description>";

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
$elm6file = fopen("export/advancedsearch_elementaryschooldistrict6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm6file, ${'elm6row_'.$i});
}

fclose($elm6file); 

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
	      <href>http://azcase.nijel.org/phpsite/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict6.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites Providing Referrals for Needed Parental Services</th>
		<th>Number of Sites Providing Parental Education</th>
		<th>Number of Sites Providing Information and Handouts to Parents</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict6.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($elm6=='t') {


// if by By Secondary/Union School District is selected
if ($union6=='t') {

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
$union6row_0 = array( );
$union6row_0[] = 'Secondary/Union School District Name';
$union6row_0[] = 'Number of Sites';
$union6row_0[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$union6row_0[] = 'Number of Sites Providing Parental Education';
$union6row_0[] = 'Number of Sites Providing Information and Handouts to Parents';


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

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($parentreferralscount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($parentreferralscount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union6row_'.$count} = array();
${'union6row_'.$count}[] = $name;
${'union6row_'.$count}[] = $sitescount;
${'union6row_'.$count}[] = $parentreferralscount;
${'union6row_'.$count}[] = $parenteducationcount;
${'union6row_'.$count}[] = $parentinfocount;


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

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
		<td align=\"right\">$parentreferralscount</td>
		<td align=\"right\">$parenteducationcount</td>
		<td align=\"right\">$parentinfocount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites Providing Referrals for Needed Parental Services: <b>$parentreferralscount</b><br />Number of Sites Providing Parental Education: <b>$parenteducationcount</b><br />Number of Sites Providing Information and Handouts to Parents: <b>$parentinfocount</b><br />]]></description>";

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
$union6file = fopen("export/advancedsearch_unionschooldistrict6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union6file, ${'union6row_'.$i});
}

fclose($union6file); 

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
	      <href>http://azcase.nijel.org/phpsite/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict6.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites Providing Referrals for Needed Parental Services</th>
		<th>Number of Sites Providing Parental Education</th>
		<th>Number of Sites Providing Information and Handouts to Parents</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict6.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($union6=='t') {


// if by az cities is selected
if ($city6=='t') {

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
$city6row_0 = array( );
$city6row_0[] = 'City Name';
$city6row_0[] = 'Number of Sites';
$city6row_0[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$city6row_0[] = 'Number of Sites Providing Parental Education';
$city6row_0[] = 'Number of Sites Providing Information and Handouts to Parents';


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

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($parentreferralscount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($parentreferralscount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($parentreferralscount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city6row_'.$count} = array();
${'city6row_'.$count}[] = $name;
${'city6row_'.$count}[] = $sitescount;
${'city6row_'.$count}[] = $parentreferralscount;
${'city6row_'.$count}[] = $parenteducationcount;
${'city6row_'.$count}[] = $parentinfocount;


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

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
		<td align=\"right\">$parentreferralscount</td>
		<td align=\"right\">$parenteducationcount</td>
		<td align=\"right\">$parentinfocount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites Providing Referrals for Needed Parental Services: <b>$parentreferralscount</b><br />Number of Sites Providing Parental Education: <b>$parenteducationcount</b><br />Number of Sites Providing Information and Handouts to Parents: <b>$parentinfocount</b><br />]]></description>";

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
$city6file = fopen("export/advancedsearch_cities6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city6file, ${'city6row_'.$i});
}

fclose($city6file); 

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
	      <href>http://azcase.nijel.org/phpsite/icons/legend.png</href>
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

$locationkmlfile = fopen("export/advancedsearch_cities6.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites Providing Referrals for Needed Parental Services</th>
		<th>Number of Sites Providing Parental Education</th>
		<th>Number of Sites Providing Information and Handouts to Parents</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities6.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?

}else{} // if ($city6=='t') {


// if by activity is selected
if ($activity6=='t') {

// set up array for csv
$activity6row_0 = array( );
$activity6row_0[] = 'Activity';
$activity6row_0[] = 'Number of Sites';
$activity6row_0[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$activity6row_0[] = 'Number of Sites Providing Parental Education';
$activity6row_0[] = 'Number of Sites Providing Information and Handouts to Parents';


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

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity6row_'.$count} = array();
${'activity6row_'.$count}[] = $name;
${'activity6row_'.$count}[] = $sitescount;
${'activity6row_'.$count}[] = $parentreferralscount;
${'activity6row_'.$count}[] = $parenteducationcount;
${'activity6row_'.$count}[] = $parentinfocount;


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

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
		<td align=\"right\">$parentreferralscount</td>
		<td align=\"right\">$parenteducationcount</td>
		<td align=\"right\">$parentinfocount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity6file = fopen("export/advancedsearch_activity6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity6file, ${'activity6row_'.$i});
}

fclose($activity6file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites Providing Referrals for Needed Parental Services</th>
		<th>Number of Sites Providing Parental Education</th>
		<th>Number of Sites Providing Information and Handouts to Parents</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($activity6=='t') {


// if by activity is selected
if ($ages6=='t') {

// set up array for csv
$ages6row_0 = array( );
$ages6row_0[] = 'Ages Served';
$ages6row_0[] = 'Number of Sites';
$ages6row_0[] = 'Number of Sites Providing Referrals for Needed Parental Services';
$ages6row_0[] = 'Number of Sites Providing Parental Education';
$ages6row_0[] = 'Number of Sites Providing Information and Handouts to Parents';


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

// number of sites that  provide referrals for needed parental services
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentreferrals = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentreferralscount = pg_result($sitesresult, $lt, 0);
}

// total sites that provide parent education
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parenteducation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parenteducationcount = pg_result($sitesresult, $lt, 0);
}

// Total number sites that provide parent info
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.parentinfo = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$parentinfocount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages6row_'.$count} = array();
${'ages6row_'.$count}[] = $name;
${'ages6row_'.$count}[] = $sitescount;
${'ages6row_'.$count}[] = $parentreferralscount;
${'ages6row_'.$count}[] = $parenteducationcount;
${'ages6row_'.$count}[] = $parentinfocount;


// clean up data for html
$sitescount = number_format($sitescount);
$parentreferralscount = number_format($parentreferralscount);
$parenteducationcount = number_format($parenteducationcount);
$parentinfocount = number_format($parentinfocount);

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
		<td align=\"right\">$parentreferralscount</td>
		<td align=\"right\">$parenteducationcount</td>
		<td align=\"right\">$parentinfocount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages6file = fopen("export/advancedsearch_ages6.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages6file, ${'ages6row_'.$i});
}

fclose($ages6file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites Providing Referrals for Needed Parental Services</th>
		<th>Number of Sites Providing Parental Education</th>
		<th>Number of Sites Providing Information and Handouts to Parents</th>
	</tr>
<?
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages6.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?

}else{} // if ($ages6=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
