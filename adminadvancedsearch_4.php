<?php

$summary4 = $_REQUEST['summary4'];
$cd4 = $_REQUEST['cd4'];
$sld4 = $_REQUEST['sld4'];
$elm4 = $_REQUEST['elm4'];
$union4 = $_REQUEST['union4'];
$city4 = $_REQUEST['city4'];
$activity4 = $_REQUEST['activity4'];
$ages4 = $_REQUEST['ages4'];

if ($summary4=='t' || $cd4=='t' || $sld4=='t' || $elm4=='t' || $union4=='t' || $city4=='t' || $activity4=='t' || $ages4=='t') {

?>
<div class="clear"></div>
<h1>Transportation, Food and Language Assistance</h1>
<?php
// if summary table is selected
if ($summary4=='t') {

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
$summary4row_0 = array( );
$summary4row_0[] = 'Category';
$summary4row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}



// add data to csv
$summary4row_1 = array( );
$summary4row_1[] = 'Number of Sites';
$summary4row_1[] = $sitescount;
$summary4row_2 = array( );
$summary4row_2[] = 'Number of Sites That Offer Transportation Assistance';
$summary4row_2[] = $transportationcount;
$summary4row_3 = array( );
$summary4row_3[] = 'Average Transportation Cost';
$summary4row_3[] = $transportcostavg;
$summary4row_4 = array( );
$summary4row_4[] = 'Number of Sites Where Snacks are Served';
$summary4row_4[] = $snackscount;
$summary4row_5 = array( );
$summary4row_5[] = 'Number of Sites Where Breakfast is Served';
$summary4row_5[] = $breakfastcount;
$summary4row_6 = array( );
$summary4row_6[] = 'Number of Sites Where Lunch is Served';
$summary4row_6[] = $lunchcount;
$summary4row_7 = array( );
$summary4row_7[] = 'Number of Sites Where Dinner is Served';
$summary4row_7[] = $dinnercount;
$summary4row_8 = array( );
$summary4row_8[] = 'Average Percentage of Students Participants in Free Lunch Program';
$summary4row_8[] = $freelunchavg;
$summary4row_9 = array( );
$summary4row_9[] = 'Number of Sites Where Spanish is Spoken';
$summary4row_9[] = $spanishcount;
$summary4row_10 = array( );
$summary4row_10[] = 'Number of Sites Where Other Languages are Spoken';
$summary4row_10[] = $otherlanguagecount;

// build csv file
$summary4file = fopen("export/advancedsearch_summary4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 10; $i++) {
	fputcsv($summary4file, ${'summary4row_'.$i});
}

fclose($summary4file); 


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Offer Transportation Assistance</td>
		<td align="right"><?php echo $transportationcount; ?></td>
	</tr>
	<tr>
		<td>Average Transportation Cost</td>
		<td align="right"><?php echo $transportcostavg; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Where Snacks are Served</td>
		<td align="right"><?php echo $snackscount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Where Breakfast is Served</td>
		<td align="right"><?php echo $breakfastcount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites Where Lunch is Served</td>
		<td align="right"><?php echo $lunchcount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites Where Dinner is Served</td>
		<td align="right"><?php echo $dinnercount; ?></td>
	</tr>
	<tr class="alt">
		<td>Average Percentage of Students Participants in Free Lunch Program</td>
		<td align="right"><?php echo $freelunchavg; ?></td>
	</tr>
	<tr>

		<td>Number of Sites Where Spanish is Spoken</td>
		<td align="right"><?php echo $spanishcount; ?></td>
	</tr>
	<tr class="alt">

		<td>Number of Sites Where Other Languages are Spoken</td>
		<td align="right"><?php echo $otherlanguagecount; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?php

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd4=='t') {

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
$cd4row_0 = array( );
$cd4row_0[] = 'Congressional District';
$cd4row_0[] = 'Number of Sites';
$cd4row_0[] = 'Number of Sites That Offer Transportation Assistance';
$cd4row_0[] = 'Average Transportation Cost';
$cd4row_0[] = 'Number of Sites Where Snacks are Served';
$cd4row_0[] = 'Number of Sites Where Breakfast is Served';
$cd4row_0[] = 'Number of Sites Where Lunch is Served';
$cd4row_0[] = 'Number of Sites Where Dinner is Served';
$cd4row_0[] = 'Average Percentage of Students Participants in Free Lunch Program';
$cd4row_0[] = 'Number of Sites Where Spanish is Spoken';
$cd4row_0[] = 'Number of Sites Where Other Languages are Spoken';


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

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($transportationcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($transportationcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd4row_'.$count} = array();
${'cd4row_'.$count}[] = $gid;
${'cd4row_'.$count}[] = $sitescount;
${'cd4row_'.$count}[] = $transportationcount;
${'cd4row_'.$count}[] = $transportcostavg;
${'cd4row_'.$count}[] = $snackscount;
${'cd4row_'.$count}[] = $breakfastcount;
${'cd4row_'.$count}[] = $lunchcount;
${'cd4row_'.$count}[] = $dinnercount;
${'cd4row_'.$count}[] = $freelunchavg;
${'cd4row_'.$count}[] = $spanishcount;
${'cd4row_'.$count}[] = $otherlanguagecount;


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

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
		<td align=\"right\">$transportationcount</td>
		<td align=\"right\">$transportcostavg</td>
		<td align=\"right\">$snackscount</td>
		<td align=\"right\">$breakfastcount</td>
		<td align=\"right\">$lunchcount</td>
		<td align=\"right\">$dinnercount</td>
		<td align=\"right\">$freelunchavg</td>
		<td align=\"right\">$spanishcount</td>
		<td align=\"right\">$otherlanguagecount</td>
	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Offer Transportation Assistance: <b>$transportationcount</b><br />Average Transportation Cost: <b>$transportcostavg</b><br />Number of Sites Where Snacks are Served: <b>$snackscount</b><br />Number of Sites Where Breakfast is Served: <b>$breakfastcount</b><br />Number of Sites Where Lunch is Served: <b>$lunchcount</b><br />Number of Sites Where Dinner is Served: <b>$dinnercount</b><br />Average Percentage of Students Participants in Free Lunch Program: <b>$freelunchavg</b><br />Number of Sites Where Spanish is Spoken: <b>$spanishcount</b><br />Number of Sites Where Other Languages are Spoken: <b>$otherlanguagecount</b><br />]]></description>";

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
$cd4file = fopen("export/advancedsearch_congressionaldistrict4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd4file, ${'cd4row_'.$i});
}

fclose($cd4file); 


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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict4.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Offer Transportation Assistance</th>
		<th>Average Transportation Cost</th>
		<th>Number of Sites Where Snacks are Served</th>
		<th>Number of Sites Where Breakfast is Served</th>
		<th>Number of Sites Where Lunch is Served</th>
		<th>Number of Sites Where Dinner is Served</th>
		<th>Average Percentage of Students Participants in Free Lunch Program</th>
		<th>Number of Sites Where Spanish is Spoken</th>
		<th>Number of Sites Where Other Languages are Spoken</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict4.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?php

}else{} // if ($cd4=='t') {


// if by state legislative districts is selected
if ($sld4=='t') {

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
$sld4row_0 = array( );
$sld4row_0[] = 'State Legislaltive District';
$sld4row_0[] = 'Number of Sites';
$sld4row_0[] = 'Number of Sites That Offer Transportation Assistance';
$sld4row_0[] = 'Average Transportation Cost';
$sld4row_0[] = 'Number of Sites Where Snacks are Served';
$sld4row_0[] = 'Number of Sites Where Breakfast is Served';
$sld4row_0[] = 'Number of Sites Where Lunch is Served';
$sld4row_0[] = 'Number of Sites Where Dinner is Served';
$sld4row_0[] = 'Average Percentage of Students Participants in Free Lunch Program';
$sld4row_0[] = 'Number of Sites Where Spanish is Spoken';
$sld4row_0[] = 'Number of Sites Where Other Languages are Spoken';

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

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($transportationcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($transportationcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld4row_'.$count} = array();
${'sld4row_'.$count}[] = $gid;
${'sld4row_'.$count}[] = $sitescount;
${'sld4row_'.$count}[] = $transportationcount;
${'sld4row_'.$count}[] = $transportcostavg;
${'sld4row_'.$count}[] = $snackscount;
${'sld4row_'.$count}[] = $breakfastcount;
${'sld4row_'.$count}[] = $lunchcount;
${'sld4row_'.$count}[] = $dinnercount;
${'sld4row_'.$count}[] = $freelunchavg;
${'sld4row_'.$count}[] = $spanishcount;
${'sld4row_'.$count}[] = $otherlanguagecount;


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

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
		<td align=\"right\">$transportationcount</td>
		<td align=\"right\">$transportcostavg</td>
		<td align=\"right\">$snackscount</td>
		<td align=\"right\">$breakfastcount</td>
		<td align=\"right\">$lunchcount</td>
		<td align=\"right\">$dinnercount</td>
		<td align=\"right\">$freelunchavg</td>
		<td align=\"right\">$spanishcount</td>
		<td align=\"right\">$otherlanguagecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Offer Transportation Assistance: <b>$transportationcount</b><br />Average Transportation Cost: <b>$transportcostavg</b><br />Number of Sites Where Snacks are Served: <b>$snackscount</b><br />Number of Sites Where Breakfast is Served: <b>$breakfastcount</b><br />Number of Sites Where Lunch is Served: <b>$lunchcount</b><br />Number of Sites Where Dinner is Served: <b>$dinnercount</b><br />Average Percentage of Students Participants in Free Lunch Program: <b>$freelunchavg</b><br />Number of Sites Where Spanish is Spoken: <b>$spanishcount</b><br />Number of Sites Where Other Languages are Spoken: <b>$otherlanguagecount</b><br />]]></description>";

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
$sld4file = fopen("export/advancedsearch_statelegislativedistrict4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld4file, ${'sld4row_'.$i});
}

fclose($sld4file); 

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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict4.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Offer Transportation Assistance</th>
		<th>Average Transportation Cost</th>
		<th>Number of Sites Where Snacks are Served</th>
		<th>Number of Sites Where Breakfast is Served</th>
		<th>Number of Sites Where Lunch is Served</th>
		<th>Number of Sites Where Dinner is Served</th>
		<th>Average Percentage of Students Participants in Free Lunch Program</th>
		<th>Number of Sites Where Spanish is Spoken</th>
		<th>Number of Sites Where Other Languages are Spoken</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict4.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($sld4=='t') {


// if by elementary school distircts is selected
if ($elm4=='t') {

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
$elm4row_0 = array( );
$elm4row_0[] = 'Elementary School District Name';
$elm4row_0[] = 'Number of Sites';
$elm4row_0[] = 'Number of Sites That Offer Transportation Assistance';
$elm4row_0[] = 'Average Transportation Cost';
$elm4row_0[] = 'Number of Sites Where Snacks are Served';
$elm4row_0[] = 'Number of Sites Where Breakfast is Served';
$elm4row_0[] = 'Number of Sites Where Lunch is Served';
$elm4row_0[] = 'Number of Sites Where Dinner is Served';
$elm4row_0[] = 'Average Percentage of Students Participants in Free Lunch Program';
$elm4row_0[] = 'Number of Sites Where Spanish is Spoken';
$elm4row_0[] = 'Number of Sites Where Other Languages are Spoken';


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

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($transportationcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($transportationcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm4row_'.$count} = array();
${'elm4row_'.$count}[] = $name;
${'elm4row_'.$count}[] = $sitescount;
${'elm4row_'.$count}[] = $transportationcount;
${'elm4row_'.$count}[] = $transportcostavg;
${'elm4row_'.$count}[] = $snackscount;
${'elm4row_'.$count}[] = $breakfastcount;
${'elm4row_'.$count}[] = $lunchcount;
${'elm4row_'.$count}[] = $dinnercount;
${'elm4row_'.$count}[] = $freelunchavg;
${'elm4row_'.$count}[] = $spanishcount;
${'elm4row_'.$count}[] = $otherlanguagecount;


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

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
		<td align=\"right\">$transportationcount</td>
		<td align=\"right\">$transportcostavg</td>
		<td align=\"right\">$snackscount</td>
		<td align=\"right\">$breakfastcount</td>
		<td align=\"right\">$lunchcount</td>
		<td align=\"right\">$dinnercount</td>
		<td align=\"right\">$freelunchavg</td>
		<td align=\"right\">$spanishcount</td>
		<td align=\"right\">$otherlanguagecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Offer Transportation Assistance: <b>$transportationcount</b><br />Average Transportation Cost: <b>$transportcostavg</b><br />Number of Sites Where Snacks are Served: <b>$snackscount</b><br />Number of Sites Where Breakfast is Served: <b>$breakfastcount</b><br />Number of Sites Where Lunch is Served: <b>$lunchcount</b><br />Number of Sites Where Dinner is Served: <b>$dinnercount</b><br />Average Percentage of Students Participants in Free Lunch Program: <b>$freelunchavg</b><br />Number of Sites Where Spanish is Spoken: <b>$spanishcount</b><br />Number of Sites Where Other Languages are Spoken: <b>$otherlanguagecount</b><br />]]></description>";

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
$elm4file = fopen("export/advancedsearch_elementaryschooldistrict4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm4file, ${'elm4row_'.$i});
}

fclose($elm4file); 

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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict4.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Offer Transportation Assistance</th>
		<th>Average Transportation Cost</th>
		<th>Number of Sites Where Snacks are Served</th>
		<th>Number of Sites Where Breakfast is Served</th>
		<th>Number of Sites Where Lunch is Served</th>
		<th>Number of Sites Where Dinner is Served</th>
		<th>Average Percentage of Students Participants in Free Lunch Program</th>
		<th>Number of Sites Where Spanish is Spoken</th>
		<th>Number of Sites Where Other Languages are Spoken</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict4.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($elm4=='t') {


// if by By Secondary/Union School District is selected
if ($union4=='t') {

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
$union4row_0 = array( );
$union4row_0[] = 'Secondary/Union School District Name';
$union4row_0[] = 'Number of Sites';
$union4row_0[] = 'Number of Sites That Offer Transportation Assistance';
$union4row_0[] = 'Average Transportation Cost';
$union4row_0[] = 'Number of Sites Where Snacks are Served';
$union4row_0[] = 'Number of Sites Where Breakfast is Served';
$union4row_0[] = 'Number of Sites Where Lunch is Served';
$union4row_0[] = 'Number of Sites Where Dinner is Served';
$union4row_0[] = 'Average Percentage of Students Participants in Free Lunch Program';
$union4row_0[] = 'Number of Sites Where Spanish is Spoken';
$union4row_0[] = 'Number of Sites Where Other Languages are Spoken';


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

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($transportationcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($transportationcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union4row_'.$count} = array();
${'union4row_'.$count}[] = $name;
${'union4row_'.$count}[] = $sitescount;
${'union4row_'.$count}[] = $transportationcount;
${'union4row_'.$count}[] = $transportcostavg;
${'union4row_'.$count}[] = $snackscount;
${'union4row_'.$count}[] = $breakfastcount;
${'union4row_'.$count}[] = $lunchcount;
${'union4row_'.$count}[] = $dinnercount;
${'union4row_'.$count}[] = $freelunchavg;
${'union4row_'.$count}[] = $spanishcount;


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

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
		<td align=\"right\">$transportationcount</td>
		<td align=\"right\">$transportcostavg</td>
		<td align=\"right\">$snackscount</td>
		<td align=\"right\">$breakfastcount</td>
		<td align=\"right\">$lunchcount</td>
		<td align=\"right\">$dinnercount</td>
		<td align=\"right\">$freelunchavg</td>
		<td align=\"right\">$spanishcount</td>
		<td align=\"right\">$otherlanguagecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Offer Transportation Assistance: <b>$transportationcount</b><br />Average Transportation Cost: <b>$transportcostavg</b><br />Number of Sites Where Snacks are Served: <b>$snackscount</b><br />Number of Sites Where Breakfast is Served: <b>$breakfastcount</b><br />Number of Sites Where Lunch is Served: <b>$lunchcount</b><br />Number of Sites Where Dinner is Served: <b>$dinnercount</b><br />Average Percentage of Students Participants in Free Lunch Program: <b>$freelunchavg</b><br />Number of Sites Where Spanish is Spoken: <b>$spanishcount</b><br />Number of Sites Where Other Languages are Spoken: <b>$otherlanguagecount</b><br />]]></description>";

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
$union4file = fopen("export/advancedsearch_unionschooldistrict4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union4file, ${'union4row_'.$i});
}

fclose($union4file); 

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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict4.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Offer Transportation Assistance</th>
		<th>Average Transportation Cost</th>
		<th>Number of Sites Where Snacks are Served</th>
		<th>Number of Sites Where Breakfast is Served</th>
		<th>Number of Sites Where Lunch is Served</th>
		<th>Number of Sites Where Dinner is Served</th>
		<th>Average Percentage of Students Participants in Free Lunch Program</th>
		<th>Number of Sites Where Spanish is Spoken</th>
		<th>Number of Sites Where Other Languages are Spoken</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict4.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($union4=='t') {


// if by az cities is selected
if ($city4=='t') {

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
$city4row_0 = array( );
$city4row_0[] = 'City Name';
$city4row_0[] = 'Number of Sites';
$city4row_0[] = 'Number of Sites That Offer Transportation Assistance';
$city4row_0[] = 'Average Transportation Cost';
$city4row_0[] = 'Number of Sites Where Snacks are Served';
$city4row_0[] = 'Number of Sites Where Breakfast is Served';
$city4row_0[] = 'Number of Sites Where Lunch is Served';
$city4row_0[] = 'Number of Sites Where Dinner is Served';
$city4row_0[] = 'Average Percentage of Students Participants in Free Lunch Program';
$city4row_0[] = 'Number of Sites Where Spanish is Spoken';
$city4row_0[] = 'Number of Sites Where Other Languages are Spoken';


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

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($transportationcount <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($transportationcount <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($transportationcount <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}

//echo $kmlstyle . '<br />';


// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city4row_'.$count} = array();
${'city4row_'.$count}[] = $name;
${'city4row_'.$count}[] = $sitescount;
${'city4row_'.$count}[] = $transportationcount;
${'city4row_'.$count}[] = $transportcostavg;
${'city4row_'.$count}[] = $snackscount;
${'city4row_'.$count}[] = $breakfastcount;
${'city4row_'.$count}[] = $lunchcount;
${'city4row_'.$count}[] = $dinnercount;
${'city4row_'.$count}[] = $freelunchavg;
${'city4row_'.$count}[] = $spanishcount;
${'city4row_'.$count}[] = $otherlanguagecount;


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

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
		<td align=\"right\">$transportationcount</td>
		<td align=\"right\">$transportcostavg</td>
		<td align=\"right\">$snackscount</td>
		<td align=\"right\">$breakfastcount</td>
		<td align=\"right\">$lunchcount</td>
		<td align=\"right\">$dinnercount</td>
		<td align=\"right\">$freelunchavg</td>
		<td align=\"right\">$spanishcount</td>
		<td align=\"right\">$otherlanguagecount</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Offer Transportation Assistance: <b>$transportationcount</b><br />Average Transportation Cost: <b>$transportcostavg</b><br />Number of Sites Where Snacks are Served: <b>$snackscount</b><br />Number of Sites Where Breakfast is Served: <b>$breakfastcount</b><br />Number of Sites Where Lunch is Served: <b>$lunchcount</b><br />Number of Sites Where Dinner is Served: <b>$dinnercount</b><br />Average Percentage of Students Participants in Free Lunch Program: <b>$freelunchavg</b><br />Number of Sites Where Spanish is Spoken: <b>$spanishcount</b><br />Number of Sites Where Other Languages are Spoken: <b>$otherlanguagecount</b><br />]]></description>";

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
$city4file = fopen("export/advancedsearch_cities4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city4file, ${'city4row_'.$i});
}

fclose($city4file); 

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

$locationkmlfile = fopen("export/advancedsearch_cities4.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Offer Transportation Assistance</th>
		<th>Average Transportation Cost</th>
		<th>Number of Sites Where Snacks are Served</th>
		<th>Number of Sites Where Breakfast is Served</th>
		<th>Number of Sites Where Lunch is Served</th>
		<th>Number of Sites Where Dinner is Served</th>
		<th>Average Percentage of Students Participants in Free Lunch Program</th>
		<th>Number of Sites Where Spanish is Spoken</th>
		<th>Number of Sites Where Other Languages are Spoken</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities4.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($city4=='t') {


// if by activity is selected
if ($activity4=='t') {

// set up array for csv
$activity4row_0 = array( );
$activity4row_0[] = 'Activity';
$activity4row_0[] = 'Number of Sites';
$activity4row_0[] = 'Number of Sites That Offer Transportation Assistance';
$activity4row_0[] = 'Average Transportation Cost';
$activity4row_0[] = 'Number of Sites Where Snacks are Served';
$activity4row_0[] = 'Number of Sites Where Breakfast is Served';
$activity4row_0[] = 'Number of Sites Where Lunch is Served';
$activity4row_0[] = 'Number of Sites Where Dinner is Served';
$activity4row_0[] = 'Average Percentage of Students Participants in Free Lunch Program';
$activity4row_0[] = 'Number of Sites Where Spanish is Spoken';
$activity4row_0[] = 'Number of Sites Where Other Languages are Spoken';


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

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity4row_'.$count} = array();
${'activity4row_'.$count}[] = $name;
${'activity4row_'.$count}[] = $sitescount;
${'activity4row_'.$count}[] = $transportationcount;
${'activity4row_'.$count}[] = $transportcostavg;
${'activity4row_'.$count}[] = $snackscount;
${'activity4row_'.$count}[] = $breakfastcount;
${'activity4row_'.$count}[] = $lunchcount;
${'activity4row_'.$count}[] = $dinnercount;
${'activity4row_'.$count}[] = $freelunchavg;
${'activity4row_'.$count}[] = $spanishcount;
${'activity4row_'.$count}[] = $otherlanguagecount;


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

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
		<td align=\"right\">$transportationcount</td>
		<td align=\"right\">$transportcostavg</td>
		<td align=\"right\">$snackscount</td>
		<td align=\"right\">$breakfastcount</td>
		<td align=\"right\">$lunchcount</td>
		<td align=\"right\">$dinnercount</td>
		<td align=\"right\">$freelunchavg</td>
		<td align=\"right\">$spanishcount</td>
		<td align=\"right\">$otherlanguagecount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity4file = fopen("export/advancedsearch_activity4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity4file, ${'activity4row_'.$i});
}

fclose($activity4file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Offer Transportation Assistance</th>
		<th>Average Transportation Cost</th>
		<th>Number of Sites Where Snacks are Served</th>
		<th>Number of Sites Where Breakfast is Served</th>
		<th>Number of Sites Where Lunch is Served</th>
		<th>Number of Sites Where Dinner is Served</th>
		<th>Average Percentage of Students Participants in Free Lunch Program</th>
		<th>Number of Sites Where Spanish is Spoken</th>
		<th>Number of Sites Where Other Languages are Spoken</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($activity4=='t') {


// if by activity is selected
if ($ages4=='t') {

// set up array for csv
$ages4row_0 = array( );
$ages4row_0[] = 'Ages Served';
$ages4row_0[] = 'Number of Sites';
$ages4row_0[] = 'Number of Sites That Offer Transportation Assistance';
$ages4row_0[] = 'Average Transportation Cost';
$ages4row_0[] = 'Number of Sites Where Snacks are Served';
$ages4row_0[] = 'Number of Sites Where Breakfast is Served';
$ages4row_0[] = 'Number of Sites Where Lunch is Served';
$ages4row_0[] = 'Number of Sites Where Dinner is Served';
$ages4row_0[] = 'Average Percentage of Students Participants in Free Lunch Program';
$ages4row_0[] = 'Number of Sites Where Spanish is Spoken';
$ages4row_0[] = 'Number of Sites Where Other Languages are Spoken';


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

// Total sites that offer transportaion assistance
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportationcount = pg_result($sitesresult, $lt, 0);
}

// Average trasportaion cost 
$sitescountquery = "SELECT avg(s.transportcost) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.transportation = TRUE AND s.transportcost IS NOT NULL;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$transportcostavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where snacks are served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.snacks = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$snackscount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where breakfast is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.breakfast = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$breakfastcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites where lunch is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.lunch = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$lunchcount = pg_result($sitesresult, $lt, 0);
}


// Total number of sites where dinner is served
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.dinner = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$dinnercount = pg_result($sitesresult, $lt, 0);
}


// average percentage of students attending part of the free lunch program
$sitescountquery = "SELECT avg(a.freelunch) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$freelunchavg = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with spanish
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.spanish = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$spanishcount = pg_result($sitesresult, $lt, 0);
}

// Total number of sites with other languages
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND a.otherlanguage = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$otherlanguagecount = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages4row_'.$count} = array();
${'ages4row_'.$count}[] = $name;
${'ages4row_'.$count}[] = $sitescount;
${'ages4row_'.$count}[] = $transportationcount;
${'ages4row_'.$count}[] = $transportcostavg;
${'ages4row_'.$count}[] = $snackscount;
${'ages4row_'.$count}[] = $breakfastcount;
${'ages4row_'.$count}[] = $lunchcount;
${'ages4row_'.$count}[] = $dinnercount;
${'ages4row_'.$count}[] = $freelunchavg;
${'ages4row_'.$count}[] = $spanishcount;
${'ages4row_'.$count}[] = $otherlanguagecount;


// clean up data for html
$sitescount = number_format($sitescount);
$transportationcount = number_format($transportationcount);
$transportcostavg = '$' . number_format($transportcostavg, 2);
$snackscount = number_format($snackscount);
$breakfastcount = number_format($breakfastcount);
$lunchcount = number_format($lunchcount);
$dinnercount = number_format($dinnercount);
$freelunchavg = number_format($freelunchavg, 2) . '%';
$spanishcount = number_format($spanishcount);
$otherlanguagecount = number_format($otherlanguagecount);

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
		<td align=\"right\">$transportationcount</td>
		<td align=\"right\">$transportcostavg</td>
		<td align=\"right\">$snackscount</td>
		<td align=\"right\">$breakfastcount</td>
		<td align=\"right\">$lunchcount</td>
		<td align=\"right\">$dinnercount</td>
		<td align=\"right\">$freelunchavg</td>
		<td align=\"right\">$spanishcount</td>
		<td align=\"right\">$otherlanguagecount</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages4file = fopen("export/advancedsearch_ages4.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages4file, ${'ages4row_'.$i});
}

fclose($ages4file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Offer Transportation Assistance</th>
		<th>Average Transportation Cost</th>
		<th>Number of Sites Where Snacks are Served</th>
		<th>Number of Sites Where Breakfast is Served</th>
		<th>Number of Sites Where Lunch is Served</th>
		<th>Number of Sites Where Dinner is Served</th>
		<th>Average Percentage of Students Participants in Free Lunch Program</th>
		<th>Number of Sites Where Spanish is Spoken</th>
		<th>Number of Sites Where Other Languages are Spoken</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages4.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($ages4=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
