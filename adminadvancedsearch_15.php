<?php

$summary15 = $_REQUEST['summary15'];
$cd15 = $_REQUEST['cd15'];
$sld15 = $_REQUEST['sld15'];
$elm15 = $_REQUEST['elm15'];
$union15 = $_REQUEST['union15'];
$city15 = $_REQUEST['city15'];
$activity15 = $_REQUEST['activity15'];
$ages15 = $_REQUEST['ages15'];

if ($summary15=='t' || $cd15=='t' || $sld15=='t' || $elm15=='t' || $union15=='t' || $city15=='t' || $activity15=='t' || $ages15=='t') {

?>
<div class="clear"></div>
<h1>Child/Teen Planned Activities and School Collaboration</h1>
<?php
// if summary table is selected
if ($summary15=='t') {

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
$summary15row_0 = array( );
$summary15row_0[] = 'Category';
$summary15row_0[] = 'Number of Sites';

// pull data
// Total number of sites
$sitescountquery = "SELECT count(*) FROM azcase_sites AS a JOIN azcase_site_survey AS s ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where;";
$sitesresult = pg_query($connection, $sitescountquery);
//echo $sitescountquery . '<br />';
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$sitescount = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}


// add data to csv
$summary15row_1 = array( );
$summary15row_1[] = 'Number of Sites';
$summary15row_1[] = $sitescount;
$summary15row_2 = array( );
$summary15row_2[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly';
$summary15row_2[] = $youth_planactivity1count;
$summary15row_3 = array( );
$summary15row_3[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$summary15row_3[] = $youth_planactivity2count;
$summary15row_4 = array( );
$summary15row_4[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly';
$summary15row_4[] = $youth_planactivity3count;
$summary15row_5 = array( );
$summary15row_5[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$summary15row_5[] = $youth_planactivity4count;
$summary15row_6 = array( );
$summary15row_6[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$summary15row_6[] = $youth_planactivity5count;
$summary15row_7 = array( );
$summary15row_7[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$summary15row_7[] = $youth_makerules1count;
$summary15row_8 = array( );
$summary15row_8[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$summary15row_8[] = $youth_makerules2count;
$summary15row_9 = array( );
$summary15row_9[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$summary15row_9[] = $youth_makerules3count;
$summary15row_10 = array( );
$summary15row_10[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$summary15row_10[] = $youth_makerules4count;
$summary15row_11 = array( );
$summary15row_11[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$summary15row_11[] = $youth_makerules5count;
$summary15row_12 = array( );
$summary15row_12[] = 'Number of Sites That Regularly Collaborate with Schools';
$summary15row_12[] = $collab_schoolcount;
$summary15row_13 = array( );
$summary15row_13[] = 'Number of Sites That Collaborate with Schools Weekly';
$summary15row_13[] = $collab_schoolfreq1count;
$summary15row_14 = array( );
$summary15row_14[] = 'Number of Sites That Collaborate with Schools Monthly';
$summary15row_14[] = $collab_schoolfreq2count;
$summary15row_15 = array( );
$summary15row_15[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$summary15row_15[] = $collab_schoolfreq3count;
$summary15row_16 = array( );
$summary15row_16[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';
$summary15row_16[] = $collab_schoolfreq4count;

// build csv file
$summary15file = fopen("export/advancedsearch_summary15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= 29; $i++) {
	fputcsv($summary15file, ${'summary15row_'.$i});
}

fclose($summary15file); 


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

?>
	<tr>
		<td>Number of Sites</td>
		<td align="right"><?php echo $sitescount; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly</td>
		<td align="right"><?php echo $youth_planactivity1count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites That Allow Children/Teens to Plan Activities Monthly</td>
		<td align="right"><?php echo $youth_planactivity2count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </td>
		<td align="right"><?php echo $youth_planactivity3count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites That Allow Children/Teens to Plan Activities Annually</td>
		<td align="right"><?php echo $youth_planactivity4count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</td>
		<td align="right"><?php echo $youth_planactivity5count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</td>
		<td align="right"><?php echo $youth_makerules1count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Allow Children/Teens to Create Rules Monthly </td>
		<td align="right"><?php echo $youth_makerules2count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites That Allow Children/Teens to Create Rules Quarterly </td>
		<td align="right"><?php echo $youth_makerules3count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Allow Children/Teens to Create Rules Annually</td>
		<td align="right"><?php echo $youth_makerules4count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </td>
		<td align="right"><?php echo $youth_makerules5count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Regularly Collaborate with Schools</td>
		<td align="right"><?php echo $collab_schoolcount; ?></td>
	</tr>
	<tr>
		<td>Number of Sites That Collaborate with Schools Weekly</td>
		<td align="right"><?php echo $collab_schoolfreq1count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Collaborate with Schools Monthly</td>
		<td align="right"><?php echo $collab_schoolfreq2count; ?></td>
	</tr>
	<tr>
		<td>Number of Sites That Collaborate with Schools Quarterly </td>
		<td align="right"><?php echo $collab_schoolfreq3count; ?></td>
	</tr>
	<tr class="alt">
		<td>Number of Sites That Collaborate with Schools Less Than Quarterly</td>
		<td align="right"><?php echo $collab_schoolfreq4count; ?></td>
	</tr>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_summary15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />


<?php

}else{} // if ($summary1=='t') {


// if by congressional district is selected
if ($cd15=='t') {

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
$cd15row_0 = array( );
$cd15row_0[] = 'Congressional District';
$cd15row_0[] = 'Number of Sites';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly ';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly ';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$cd15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$cd15row_0[] = 'Number of Sites That Regularly Collaborate with Schools';
$cd15row_0[] = 'Number of Sites That Collaborate with Schools Weekly';
$cd15row_0[] = 'Number of Sites That Collaborate with Schools Monthly';
$cd15row_0[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$cd15row_0[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';


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

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($youth_planactivity1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($youth_planactivity1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'cd15row_'.$count} = array();
${'cd15row_'.$count}[] = $gid;
${'cd15row_'.$count}[] = $sitescount;
${'cd15row_'.$count}[] = $youth_planactivity1count;
${'cd15row_'.$count}[] = $youth_planactivity2count;
${'cd15row_'.$count}[] = $youth_planactivity3count;
${'cd15row_'.$count}[] = $youth_planactivity4count;
${'cd15row_'.$count}[] = $youth_planactivity5count;
${'cd15row_'.$count}[] = $youth_makerules1count;
${'cd15row_'.$count}[] = $youth_makerules2count;
${'cd15row_'.$count}[] = $youth_makerules3count;
${'cd15row_'.$count}[] = $youth_makerules4count;
${'cd15row_'.$count}[] = $youth_makerules5count;
${'cd15row_'.$count}[] = $collab_schoolcount;
${'cd15row_'.$count}[] = $collab_schoolfreq1count;
${'cd15row_'.$count}[] = $collab_schoolfreq2count;
${'cd15row_'.$count}[] = $collab_schoolfreq3count;
${'cd15row_'.$count}[] = $collab_schoolfreq4count;


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

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
		<td align=\"right\">$youth_planactivity1count</td>
		<td align=\"right\">$youth_planactivity2count</td>
		<td align=\"right\">$youth_planactivity3count</td>
		<td align=\"right\">$youth_planactivity4count</td>
		<td align=\"right\">$youth_planactivity5count</td>
		<td align=\"right\">$youth_makerules1count</td>
		<td align=\"right\">$youth_makerules2count</td>
		<td align=\"right\">$youth_makerules3count</td>
		<td align=\"right\">$youth_makerules4count</td>
		<td align=\"right\">$youth_makerules5count</td>
		<td align=\"right\">$collab_schoolcount</td>
		<td align=\"right\">$collab_schoolfreq1count</td>
		<td align=\"right\">$collab_schoolfreq2count</td>
		<td align=\"right\">$collab_schoolfreq3count</td>
		<td align=\"right\">$collab_schoolfreq4count</td>

	</tr>
";

// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>Congressional District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly : <b>$youth_planactivity1count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Monthly: <b>$youth_planactivity2count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Quarterly : <b>$youth_planactivity3count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Annually: <b>$youth_planactivity4count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually: <b>$youth_planactivity5count</b><br />Number of Sites That Allow Children/Teens to Create Rules At Least Weekly: <b>$youth_makerules1count</b><br />Number of Sites That Allow Children/Teens to Create Rules Monthly : <b>$youth_makerules2count</b><br />Number of Sites That Allow Children/Teens to Create Rules Quarterly : <b>$youth_makerules3count</b><br />Number of Sites That Allow Children/Teens to Create Rules Annually : <b>$youth_makerules4count</b><br />Number of Sites That Allow Children/Teens to Create Rules Less Than Annually : <b>$youth_makerules5count</b><br />Number of Sites That Regularly Collaborate with Schools: <b>$collab_schoolcount</b><br />Number of Sites That Collaborate with Schools Weekly: <b>$collab_schoolfreq1count</b><br />Number of Sites That Collaborate with Schools Monthly: <b>$collab_schoolfreq2count</b><br />Number of Sites That Collaborate with Schools Quarterly : <b>$collab_schoolfreq3count</b><br />Number of Sites That Collaborate with Schools Less Than Quarterly: <b>$collab_schoolfreq4count</b><br />]]></description>";


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
$cd15file = fopen("export/advancedsearch_congressionaldistrict15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($cd15file, ${'cd15row_'.$i});
}

fclose($cd15file); 


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

$locationkmlfile = fopen("export/advancedsearch_congressionaldistrict15.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);


// table headers
?>
<h2>By Congressional District</h2>
<table class="hoursTable">
	<tr>
		<th>Congressional District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Monthly</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Annually</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Monthly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Annually </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </th>
		<th>Number of Sites That Regularly Collaborate with Schools</th>
		<th>Number of Sites That Collaborate with Schools Weekly</th>
		<th>Number of Sites That Collaborate with Schools Monthly</th>
		<th>Number of Sites That Collaborate with Schools Quarterly </th>
		<th>Number of Sites That Collaborate with Schools Less Than Quarterly</th>
	
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_congressionaldistrict15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_congressionaldistrict15.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />

<?php

}else{} // if ($cd15=='t') {


// if by state legislative districts is selected
if ($sld15=='t') {

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
$sld15row_0 = array( );
$sld15row_0[] = 'State Legislaltive District';
$sld15row_0[] = 'Number of Sites';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly ';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly ';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$sld15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$sld15row_0[] = 'Number of Sites That Regularly Collaborate with Schools';
$sld15row_0[] = 'Number of Sites That Collaborate with Schools Weekly';
$sld15row_0[] = 'Number of Sites That Collaborate with Schools Monthly';
$sld15row_0[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$sld15row_0[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';

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

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($youth_planactivity1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($youth_planactivity1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}



// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'sld15row_'.$count} = array();
${'sld15row_'.$count}[] = $gid;
${'sld15row_'.$count}[] = $sitescount;
${'sld15row_'.$count}[] = $youth_planactivity1count;
${'sld15row_'.$count}[] = $youth_planactivity2count;
${'sld15row_'.$count}[] = $youth_planactivity3count;
${'sld15row_'.$count}[] = $youth_planactivity4count;
${'sld15row_'.$count}[] = $youth_planactivity5count;
${'sld15row_'.$count}[] = $youth_makerules1count;
${'sld15row_'.$count}[] = $youth_makerules2count;
${'sld15row_'.$count}[] = $youth_makerules3count;
${'sld15row_'.$count}[] = $youth_makerules4count;
${'sld15row_'.$count}[] = $youth_makerules5count;
${'sld15row_'.$count}[] = $collab_schoolcount;
${'sld15row_'.$count}[] = $collab_schoolfreq1count;
${'sld15row_'.$count}[] = $collab_schoolfreq2count;
${'sld15row_'.$count}[] = $collab_schoolfreq3count;
${'sld15row_'.$count}[] = $collab_schoolfreq4count;


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

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
		<td align=\"right\">$youth_planactivity1count</td>
		<td align=\"right\">$youth_planactivity2count</td>
		<td align=\"right\">$youth_planactivity3count</td>
		<td align=\"right\">$youth_planactivity4count</td>
		<td align=\"right\">$youth_planactivity5count</td>
		<td align=\"right\">$youth_makerules1count</td>
		<td align=\"right\">$youth_makerules2count</td>
		<td align=\"right\">$youth_makerules3count</td>
		<td align=\"right\">$youth_makerules4count</td>
		<td align=\"right\">$youth_makerules5count</td>
		<td align=\"right\">$collab_schoolcount</td>
		<td align=\"right\">$collab_schoolfreq1count</td>
		<td align=\"right\">$collab_schoolfreq2count</td>
		<td align=\"right\">$collab_schoolfreq3count</td>
		<td align=\"right\">$collab_schoolfreq4count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>State Legislative District $gid</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly : <b>$youth_planactivity1count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Monthly: <b>$youth_planactivity2count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Quarterly : <b>$youth_planactivity3count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Annually: <b>$youth_planactivity4count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually: <b>$youth_planactivity5count</b><br />Number of Sites That Allow Children/Teens to Create Rules At Least Weekly: <b>$youth_makerules1count</b><br />Number of Sites That Allow Children/Teens to Create Rules Monthly : <b>$youth_makerules2count</b><br />Number of Sites That Allow Children/Teens to Create Rules Quarterly : <b>$youth_makerules3count</b><br />Number of Sites That Allow Children/Teens to Create Rules Annually : <b>$youth_makerules4count</b><br />Number of Sites That Allow Children/Teens to Create Rules Less Than Annually : <b>$youth_makerules5count</b><br />Number of Sites That Regularly Collaborate with Schools: <b>$collab_schoolcount</b><br />Number of Sites That Collaborate with Schools Weekly: <b>$collab_schoolfreq1count</b><br />Number of Sites That Collaborate with Schools Monthly: <b>$collab_schoolfreq2count</b><br />Number of Sites That Collaborate with Schools Quarterly : <b>$collab_schoolfreq3count</b><br />Number of Sites That Collaborate with Schools Less Than Quarterly: <b>$collab_schoolfreq4count</b><br />]]></description>";

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
$sld15file = fopen("export/advancedsearch_statelegislativedistrict15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($sld15file, ${'sld15row_'.$i});
}

fclose($sld15file); 

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

$locationkmlfile = fopen("export/advancedsearch_statelegislativedistrict15.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By State Legislative District</h2>
<table class="hoursTable">
	<tr>
		<th>State Legislative District</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Monthly</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Annually</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Monthly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Annually </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </th>
		<th>Number of Sites That Regularly Collaborate with Schools</th>
		<th>Number of Sites That Collaborate with Schools Weekly</th>
		<th>Number of Sites That Collaborate with Schools Monthly</th>
		<th>Number of Sites That Collaborate with Schools Quarterly </th>
		<th>Number of Sites That Collaborate with Schools Less Than Quarterly</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_statelegislativedistrict15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_statelegislativedistrict15.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($sld15=='t') {


// if by elementary school distircts is selected
if ($elm15=='t') {

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
$elm15row_0 = array( );
$elm15row_0[] = 'Elementary School District Name';
$elm15row_0[] = 'Number of Sites';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly ';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly ';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$elm15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$elm15row_0[] = 'Number of Sites That Regularly Collaborate with Schools';
$elm15row_0[] = 'Number of Sites That Collaborate with Schools Weekly';
$elm15row_0[] = 'Number of Sites That Collaborate with Schools Monthly';
$elm15row_0[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$elm15row_0[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';

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

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($youth_planactivity1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($youth_planactivity1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'elm15row_'.$count} = array();
${'elm15row_'.$count}[] = $name;
${'elm15row_'.$count}[] = $sitescount;
${'elm15row_'.$count}[] = $youth_planactivity1count;
${'elm15row_'.$count}[] = $youth_planactivity2count;
${'elm15row_'.$count}[] = $youth_planactivity3count;
${'elm15row_'.$count}[] = $youth_planactivity4count;
${'elm15row_'.$count}[] = $youth_planactivity5count;
${'elm15row_'.$count}[] = $youth_makerules1count;
${'elm15row_'.$count}[] = $youth_makerules2count;
${'elm15row_'.$count}[] = $youth_makerules3count;
${'elm15row_'.$count}[] = $youth_makerules4count;
${'elm15row_'.$count}[] = $youth_makerules5count;
${'elm15row_'.$count}[] = $collab_schoolcount;
${'elm15row_'.$count}[] = $collab_schoolfreq1count;
${'elm15row_'.$count}[] = $collab_schoolfreq2count;
${'elm15row_'.$count}[] = $collab_schoolfreq3count;
${'elm15row_'.$count}[] = $collab_schoolfreq4count;


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

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
		<td align=\"right\">$youth_planactivity1count</td>
		<td align=\"right\">$youth_planactivity2count</td>
		<td align=\"right\">$youth_planactivity3count</td>
		<td align=\"right\">$youth_planactivity4count</td>
		<td align=\"right\">$youth_planactivity5count</td>
		<td align=\"right\">$youth_makerules1count</td>
		<td align=\"right\">$youth_makerules2count</td>
		<td align=\"right\">$youth_makerules3count</td>
		<td align=\"right\">$youth_makerules4count</td>
		<td align=\"right\">$youth_makerules5count</td>
		<td align=\"right\">$collab_schoolcount</td>
		<td align=\"right\">$collab_schoolfreq1count</td>
		<td align=\"right\">$collab_schoolfreq2count</td>
		<td align=\"right\">$collab_schoolfreq3count</td>
		<td align=\"right\">$collab_schoolfreq4count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly : <b>$youth_planactivity1count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Monthly: <b>$youth_planactivity2count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Quarterly : <b>$youth_planactivity3count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Annually: <b>$youth_planactivity4count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually: <b>$youth_planactivity5count</b><br />Number of Sites That Allow Children/Teens to Create Rules At Least Weekly: <b>$youth_makerules1count</b><br />Number of Sites That Allow Children/Teens to Create Rules Monthly : <b>$youth_makerules2count</b><br />Number of Sites That Allow Children/Teens to Create Rules Quarterly : <b>$youth_makerules3count</b><br />Number of Sites That Allow Children/Teens to Create Rules Annually : <b>$youth_makerules4count</b><br />Number of Sites That Allow Children/Teens to Create Rules Less Than Annually : <b>$youth_makerules5count</b><br />Number of Sites That Regularly Collaborate with Schools: <b>$collab_schoolcount</b><br />Number of Sites That Collaborate with Schools Weekly: <b>$collab_schoolfreq1count</b><br />Number of Sites That Collaborate with Schools Monthly: <b>$collab_schoolfreq2count</b><br />Number of Sites That Collaborate with Schools Quarterly : <b>$collab_schoolfreq3count</b><br />Number of Sites That Collaborate with Schools Less Than Quarterly: <b>$collab_schoolfreq4count</b><br />]]></description>";

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
$elm15file = fopen("export/advancedsearch_elementaryschooldistrict15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($elm15file, ${'elm15row_'.$i});
}

fclose($elm15file); 

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

$locationkmlfile = fopen("export/advancedsearch_elementaryschooldistrict15.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Elementary School District</h2>
<table class="hoursTable">
	<tr>
		<th>Elementary School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Monthly</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Annually</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Monthly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Annually </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </th>
		<th>Number of Sites That Regularly Collaborate with Schools</th>
		<th>Number of Sites That Collaborate with Schools Weekly</th>
		<th>Number of Sites That Collaborate with Schools Monthly</th>
		<th>Number of Sites That Collaborate with Schools Quarterly </th>
		<th>Number of Sites That Collaborate with Schools Less Than Quarterly</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_elementaryschooldistrict15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_elementaryschooldistrict15.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($elm15=='t') {


// if by By Secondary/Union School District is selected
if ($union15=='t') {

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
$union15row_0 = array( );
$union15row_0[] = 'Secondary/Union School District Name';
$union15row_0[] = 'Number of Sites';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly ';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly ';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$union15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$union15row_0[] = 'Number of Sites That Regularly Collaborate with Schools';
$union15row_0[] = 'Number of Sites That Collaborate with Schools Weekly';
$union15row_0[] = 'Number of Sites That Collaborate with Schools Monthly';
$union15row_0[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$union15row_0[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';

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

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($youth_planactivity1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($youth_planactivity1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'union15row_'.$count} = array();
${'union15row_'.$count}[] = $name;
${'union15row_'.$count}[] = $sitescount;
${'union15row_'.$count}[] = $youth_planactivity1count;
${'union15row_'.$count}[] = $youth_planactivity2count;
${'union15row_'.$count}[] = $youth_planactivity3count;
${'union15row_'.$count}[] = $youth_planactivity4count;
${'union15row_'.$count}[] = $youth_planactivity5count;
${'union15row_'.$count}[] = $youth_makerules1count;
${'union15row_'.$count}[] = $youth_makerules2count;
${'union15row_'.$count}[] = $youth_makerules3count;
${'union15row_'.$count}[] = $youth_makerules4count;
${'union15row_'.$count}[] = $youth_makerules5count;
${'union15row_'.$count}[] = $collab_schoolcount;
${'union15row_'.$count}[] = $collab_schoolfreq1count;
${'union15row_'.$count}[] = $collab_schoolfreq2count;
${'union15row_'.$count}[] = $collab_schoolfreq3count;
${'union15row_'.$count}[] = $collab_schoolfreq4count;


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

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
		<td align=\"right\">$youth_planactivity1count</td>
		<td align=\"right\">$youth_planactivity2count</td>
		<td align=\"right\">$youth_planactivity3count</td>
		<td align=\"right\">$youth_planactivity4count</td>
		<td align=\"right\">$youth_planactivity5count</td>
		<td align=\"right\">$youth_makerules1count</td>
		<td align=\"right\">$youth_makerules2count</td>
		<td align=\"right\">$youth_makerules3count</td>
		<td align=\"right\">$youth_makerules4count</td>
		<td align=\"right\">$youth_makerules5count</td>
		<td align=\"right\">$collab_schoolcount</td>
		<td align=\"right\">$collab_schoolfreq1count</td>
		<td align=\"right\">$collab_schoolfreq2count</td>
		<td align=\"right\">$collab_schoolfreq3count</td>
		<td align=\"right\">$collab_schoolfreq4count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly : <b>$youth_planactivity1count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Monthly: <b>$youth_planactivity2count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Quarterly : <b>$youth_planactivity3count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Annually: <b>$youth_planactivity4count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually: <b>$youth_planactivity5count</b><br />Number of Sites That Allow Children/Teens to Create Rules At Least Weekly: <b>$youth_makerules1count</b><br />Number of Sites That Allow Children/Teens to Create Rules Monthly : <b>$youth_makerules2count</b><br />Number of Sites That Allow Children/Teens to Create Rules Quarterly : <b>$youth_makerules3count</b><br />Number of Sites That Allow Children/Teens to Create Rules Annually : <b>$youth_makerules4count</b><br />Number of Sites That Allow Children/Teens to Create Rules Less Than Annually : <b>$youth_makerules5count</b><br />Number of Sites That Regularly Collaborate with Schools: <b>$collab_schoolcount</b><br />Number of Sites That Collaborate with Schools Weekly: <b>$collab_schoolfreq1count</b><br />Number of Sites That Collaborate with Schools Monthly: <b>$collab_schoolfreq2count</b><br />Number of Sites That Collaborate with Schools Quarterly : <b>$collab_schoolfreq3count</b><br />Number of Sites That Collaborate with Schools Less Than Quarterly: <b>$collab_schoolfreq4count</b><br />]]></description>";

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
$union15file = fopen("export/advancedsearch_unionschooldistrict15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($union15file, ${'union15row_'.$i});
}

fclose($union15file); 

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

$locationkmlfile = fopen("export/advancedsearch_unionschooldistrict15.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By Secondary/Union School District</h2>
<table class="hoursTable">
	<tr>
		<th>Secondary/Union School District Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Monthly</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Annually</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Monthly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Annually </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </th>
		<th>Number of Sites That Regularly Collaborate with Schools</th>
		<th>Number of Sites That Collaborate with Schools Weekly</th>
		<th>Number of Sites That Collaborate with Schools Monthly</th>
		<th>Number of Sites That Collaborate with Schools Quarterly </th>
		<th>Number of Sites That Collaborate with Schools Less Than Quarterly</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_unionschooldistrict15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_unionschooldistrict15.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($union15=='t') {


// if by az cities is selected
if ($city15=='t') {

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
$city15row_0 = array( );
$city15row_0[] = 'City Name';
$city15row_0[] = 'Number of Sites';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly ';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly ';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$city15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$city15row_0[] = 'Number of Sites That Regularly Collaborate with Schools';
$city15row_0[] = 'Number of Sites That Collaborate with Schools Weekly';
$city15row_0[] = 'Number of Sites That Collaborate with Schools Monthly';
$city15row_0[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$city15row_0[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';


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

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($youth_planactivity1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($youth_planactivity1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'city15row_'.$count} = array();
${'city15row_'.$count}[] = $name;
${'city15row_'.$count}[] = $sitescount;
${'city15row_'.$count}[] = $youth_planactivity1count;
${'city15row_'.$count}[] = $youth_planactivity2count;
${'city15row_'.$count}[] = $youth_planactivity3count;
${'city15row_'.$count}[] = $youth_planactivity4count;
${'city15row_'.$count}[] = $youth_planactivity5count;
${'city15row_'.$count}[] = $youth_makerules1count;
${'city15row_'.$count}[] = $youth_makerules2count;
${'city15row_'.$count}[] = $youth_makerules3count;
${'city15row_'.$count}[] = $youth_makerules4count;
${'city15row_'.$count}[] = $youth_makerules5count;
${'city15row_'.$count}[] = $collab_schoolcount;
${'city15row_'.$count}[] = $collab_schoolfreq1count;
${'city15row_'.$count}[] = $collab_schoolfreq2count;
${'city15row_'.$count}[] = $collab_schoolfreq3count;
${'city15row_'.$count}[] = $collab_schoolfreq4count;


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

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
		<td align=\"right\">$youth_planactivity1count</td>
		<td align=\"right\">$youth_planactivity2count</td>
		<td align=\"right\">$youth_planactivity3count</td>
		<td align=\"right\">$youth_planactivity4count</td>
		<td align=\"right\">$youth_planactivity5count</td>
		<td align=\"right\">$youth_makerules1count</td>
		<td align=\"right\">$youth_makerules2count</td>
		<td align=\"right\">$youth_makerules3count</td>
		<td align=\"right\">$youth_makerules4count</td>
		<td align=\"right\">$youth_makerules5count</td>
		<td align=\"right\">$collab_schoolcount</td>
		<td align=\"right\">$collab_schoolfreq1count</td>
		<td align=\"right\">$collab_schoolfreq2count</td>
		<td align=\"right\">$collab_schoolfreq3count</td>
		<td align=\"right\">$collab_schoolfreq4count</td>
	</tr>
";


// add kml geometry and data to kml body
$kmlbody .= "	<Placemark>
		<name>$name</name>";
$kmlbody .= $kmlstyle;
$kmlbody .= "	<description><![CDATA[Number of Sites: <b>$sitescount</b><br />Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly : <b>$youth_planactivity1count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Monthly: <b>$youth_planactivity2count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Quarterly : <b>$youth_planactivity3count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Annually: <b>$youth_planactivity4count</b><br />Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually: <b>$youth_planactivity5count</b><br />Number of Sites That Allow Children/Teens to Create Rules At Least Weekly: <b>$youth_makerules1count</b><br />Number of Sites That Allow Children/Teens to Create Rules Monthly : <b>$youth_makerules2count</b><br />Number of Sites That Allow Children/Teens to Create Rules Quarterly : <b>$youth_makerules3count</b><br />Number of Sites That Allow Children/Teens to Create Rules Annually : <b>$youth_makerules4count</b><br />Number of Sites That Allow Children/Teens to Create Rules Less Than Annually : <b>$youth_makerules5count</b><br />Number of Sites That Regularly Collaborate with Schools: <b>$collab_schoolcount</b><br />Number of Sites That Collaborate with Schools Weekly: <b>$collab_schoolfreq1count</b><br />Number of Sites That Collaborate with Schools Monthly: <b>$collab_schoolfreq2count</b><br />Number of Sites That Collaborate with Schools Quarterly : <b>$collab_schoolfreq3count</b><br />Number of Sites That Collaborate with Schools Less Than Quarterly: <b>$collab_schoolfreq4count</b><br />]]></description>";

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
$city15file = fopen("export/advancedsearch_cities15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($city15file, ${'city15row_'.$i});
}

fclose($city15file); 

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

$locationkmlfile = fopen("export/advancedsearch_cities15.kml", "w");
fwrite($locationkmlfile, $kml);
fclose($locationkmlfile);



// table headers
?>
<h2>By City</h2>
<table class="hoursTable">
	<tr>
		<th>City Name</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Monthly</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Annually</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Monthly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Annually </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </th>
		<th>Number of Sites That Regularly Collaborate with Schools</th>
		<th>Number of Sites That Collaborate with Schools Weekly</th>
		<th>Number of Sites That Collaborate with Schools Monthly</th>
		<th>Number of Sites That Collaborate with Schools Quarterly </th>
		<th>Number of Sites That Collaborate with Schools Less Than Quarterly</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_cities15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />
<a href="export/advancedsearch_cities15.kml" style="text-decoration:none"><img src="icons/google_earth.png" border="0" /> Export as KML (Launches in Google Earth)</a>
<br /><br />


<?php

}else{} // if ($city15=='t') {


// if by activity is selected
if ($activity15=='t') {

// set up array for csv
$activity15row_0 = array( );
$activity15row_0[] = 'Activity';
$activity15row_0[] = 'Number of Sites';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly ';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly ';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$activity15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$activity15row_0[] = 'Number of Sites That Regularly Collaborate with Schools';
$activity15row_0[] = 'Number of Sites That Collaborate with Schools Weekly';
$activity15row_0[] = 'Number of Sites That Collaborate with Schools Monthly';
$activity15row_0[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$activity15row_0[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';


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

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($youth_planactivity1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($youth_planactivity1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'activity15row_'.$count} = array();
${'activity15row_'.$count}[] = $name;
${'activity15row_'.$count}[] = $sitescount;
${'activity15row_'.$count}[] = $youth_planactivity1count;
${'activity15row_'.$count}[] = $youth_planactivity2count;
${'activity15row_'.$count}[] = $youth_planactivity3count;
${'activity15row_'.$count}[] = $youth_planactivity4count;
${'activity15row_'.$count}[] = $youth_planactivity5count;
${'activity15row_'.$count}[] = $youth_makerules1count;
${'activity15row_'.$count}[] = $youth_makerules2count;
${'activity15row_'.$count}[] = $youth_makerules3count;
${'activity15row_'.$count}[] = $youth_makerules4count;
${'activity15row_'.$count}[] = $youth_makerules5count;
${'activity15row_'.$count}[] = $collab_schoolcount;
${'activity15row_'.$count}[] = $collab_schoolfreq1count;
${'activity15row_'.$count}[] = $collab_schoolfreq2count;
${'activity15row_'.$count}[] = $collab_schoolfreq3count;
${'activity15row_'.$count}[] = $collab_schoolfreq4count;


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

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
		<td align=\"right\">$youth_planactivity1count</td>
		<td align=\"right\">$youth_planactivity2count</td>
		<td align=\"right\">$youth_planactivity3count</td>
		<td align=\"right\">$youth_planactivity4count</td>
		<td align=\"right\">$youth_planactivity5count</td>
		<td align=\"right\">$youth_makerules1count</td>
		<td align=\"right\">$youth_makerules2count</td>
		<td align=\"right\">$youth_makerules3count</td>
		<td align=\"right\">$youth_makerules4count</td>
		<td align=\"right\">$youth_makerules5count</td>
		<td align=\"right\">$collab_schoolcount</td>
		<td align=\"right\">$collab_schoolfreq1count</td>
		<td align=\"right\">$collab_schoolfreq2count</td>
		<td align=\"right\">$collab_schoolfreq3count</td>
		<td align=\"right\">$collab_schoolfreq4count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$activity15file = fopen("export/advancedsearch_activity15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($activity15file, ${'activity15row_'.$i});
}

fclose($activity15file); 

// table headers
?>
<h2>By Activity</h2>
<table class="hoursTable">
	<tr>
		<th>Activity</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Monthly</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Annually</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Monthly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Annually </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </th>
		<th>Number of Sites That Regularly Collaborate with Schools</th>
		<th>Number of Sites That Collaborate with Schools Weekly</th>
		<th>Number of Sites That Collaborate with Schools Monthly</th>
		<th>Number of Sites That Collaborate with Schools Quarterly </th>
		<th>Number of Sites That Collaborate with Schools Less Than Quarterly</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_activity15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($activity15=='t') {


// if by activity is selected
if ($ages15=='t') {

// set up array for csv
$ages15row_0 = array( );
$ages15row_0[] = 'Ages Served';
$ages15row_0[] = 'Number of Sites';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly ';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Monthly';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Quarterly ';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Annually';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules At Least Weekly';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Monthly ';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Quarterly ';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Annually ';
$ages15row_0[] = 'Number of Sites That Allow Children/Teens to Create Rules Less Than Annually ';
$ages15row_0[] = 'Number of Sites That Regularly Collaborate with Schools';
$ages15row_0[] = 'Number of Sites That Collaborate with Schools Weekly';
$ages15row_0[] = 'Number of Sites That Collaborate with Schools Monthly';
$ages15row_0[] = 'Number of Sites That Collaborate with Schools Quarterly ';
$ages15row_0[] = 'Number of Sites That Collaborate with Schools Less Than Quarterly';


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

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity1count = pg_result($sitesresult, $lt, 0);
}

//echo "Site Count = $sitescount; Min sites = $minsites; diffonefifth = $diffonefifth <br />";  
// kml polygon fill style
if ($youth_planactivity1count <= ($minsites + $diffonefifth)) {
	$kmlstyle = "<styleUrl>#Q1</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*2)) {
	$kmlstyle = "<styleUrl>#Q2</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*3)) {
	$kmlstyle = "<styleUrl>#Q3</styleUrl>";
}elseif ($youth_planactivity1count <= ($minsites + $diffonefifth*4)) {
	$kmlstyle = "<styleUrl>#Q4</styleUrl>";
}elseif ($youth_planactivity1count <= $maxsites) {
	$kmlstyle = "<styleUrl>#Q5</styleUrl>";
}else{}


// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the children/teens at your site have the opportunity to plan activities/projects?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_planactivity = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_planactivity5count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules4count = pg_result($sitesresult, $lt, 0);
}

// frequently do the cities15children/teens at your site have the opportunity to create rules and expectations that are followed?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.youth_makerules = 5;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$youth_makerules5count = pg_result($sitesresult, $lt, 0);
}

// number of sites regularly collaborate
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_school = TRUE;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolcount = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 1;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq1count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 2;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq2count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 3;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq3count = pg_result($sitesresult, $lt, 0);
}

// frequently do the do you collaborate with the schools attended by the children/teens at this site?
$sitescountquery = "SELECT count(*) FROM azcase_site_survey AS s JOIN azcase_sites AS a ON a.siteid = s.siteid JOIN azcase_sites_locations_junction AS x ON a.siteid = x.siteid JOIN azcase_locations AS b ON b.locationid = x.locationid $join $where AND s.collab_schoolfreq = 4;";
$sitesresult = pg_query($connection, $sitescountquery);
for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$collab_schoolfreq4count = pg_result($sitesresult, $lt, 0);
}


// if values are zero, skip adding to table or csv
if ($sitescount==0) {
}else{

// add data to csv
${'ages15row_'.$count} = array();
${'ages15row_'.$count}[] = $name;
${'ages15row_'.$count}[] = $sitescount;
${'ages15row_'.$count}[] = $youth_planactivity1count;
${'ages15row_'.$count}[] = $youth_planactivity2count;
${'ages15row_'.$count}[] = $youth_planactivity3count;
${'ages15row_'.$count}[] = $youth_planactivity4count;
${'ages15row_'.$count}[] = $youth_planactivity5count;
${'ages15row_'.$count}[] = $youth_makerules1count;
${'ages15row_'.$count}[] = $youth_makerules2count;
${'ages15row_'.$count}[] = $youth_makerules3count;
${'ages15row_'.$count}[] = $youth_makerules4count;
${'ages15row_'.$count}[] = $youth_makerules5count;
${'ages15row_'.$count}[] = $collab_schoolcount;
${'ages15row_'.$count}[] = $collab_schoolfreq1count;
${'ages15row_'.$count}[] = $collab_schoolfreq2count;
${'ages15row_'.$count}[] = $collab_schoolfreq3count;
${'ages15row_'.$count}[] = $collab_schoolfreq4count;


// clean up data for html
$sitescount = number_format($sitescount);
$youth_planactivity1count = number_format($youth_planactivity1count);
$youth_planactivity2count = number_format($youth_planactivity2count);
$youth_planactivity3count = number_format($youth_planactivity3count);
$youth_planactivity4count = number_format($youth_planactivity4count);
$youth_planactivity5count = number_format($youth_planactivity5count);
$youth_makerules1count = number_format($youth_makerules1count);
$youth_makerules2count = number_format($youth_makerules2count);
$youth_makerules3count = number_format($youth_makerules3count);
$youth_makerules4count = number_format($youth_makerules4count);
$youth_makerules5count = number_format($youth_makerules5count);
$collab_schoolcount = number_format($collab_schoolcount);
$collab_schoolfreq1count = number_format($collab_schoolfreq1count);
$collab_schoolfreq2count = number_format($collab_schoolfreq2count);
$collab_schoolfreq3count = number_format($collab_schoolfreq3count);
$collab_schoolfreq4count = number_format($collab_schoolfreq4count);

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
		<td align=\"right\">$youth_planactivity1count</td>
		<td align=\"right\">$youth_planactivity2count</td>
		<td align=\"right\">$youth_planactivity3count</td>
		<td align=\"right\">$youth_planactivity4count</td>
		<td align=\"right\">$youth_planactivity5count</td>
		<td align=\"right\">$youth_makerules1count</td>
		<td align=\"right\">$youth_makerules2count</td>
		<td align=\"right\">$youth_makerules3count</td>
		<td align=\"right\">$youth_makerules4count</td>
		<td align=\"right\">$youth_makerules5count</td>
		<td align=\"right\">$collab_schoolcount</td>
		<td align=\"right\">$collab_schoolfreq1count</td>
		<td align=\"right\">$collab_schoolfreq2count</td>
		<td align=\"right\">$collab_schoolfreq3count</td>
		<td align=\"right\">$collab_schoolfreq4count</td>
	</tr>
";


} // close if ($sitescount==0) {

$count++;
} // close while loop

// build csv file
$ages15file = fopen("export/advancedsearch_ages15.csv", "w");
// Write table output to a CSV file
for($i = 0; $i <= $count; $i++) {
	fputcsv($ages15file, ${'ages15row_'.$i});
}

fclose($ages15file); 

// table headers
?>
<h2>By Ages Served</h2>
<table class="hoursTable">
	<tr>
		<th>Ages Served</th>
		<th>Number of Sites</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities At Least Weekly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Monthly</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Annually</th>
		<th>Number of Sites That Allow Children/Teens to Plan Activities Less Than Annually</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules At Least Weekly</th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Monthly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Quarterly </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Annually </th>
		<th>Number of Sites That Allow Children/Teens to Create Rules Less Than Annually </th>
		<th>Number of Sites That Regularly Collaborate with Schools</th>
		<th>Number of Sites That Collaborate with Schools Weekly</th>
		<th>Number of Sites That Collaborate with Schools Monthly</th>
		<th>Number of Sites That Collaborate with Schools Quarterly </th>
		<th>Number of Sites That Collaborate with Schools Less Than Quarterly</th>
	</tr>
<?php
echo $tablebody;
?>
</table>
<div class="clear"></div>
<br />
<a href="exportcsv.php?filename=advancedsearch_ages15.csv" style="text-decoration:none"><img src="icons/csv.png" border="0" /> Export as CSV</a>
<br /><br />

<?php

}else{} // if ($ages15=='t') {



// close if any are true
}else{} // if ($summary1=='t' || $cd1=='t' || $sld1=='t' || $elm1=='t' || $union1=='t' || $city1=='t' || $activity1=='t' || $ages1=='t') {





?>
