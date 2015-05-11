<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');


global $connection;

// select sites that verified = 2 grouped by userid
$sitesquery = "SELECT 
siteid,
name,
age5,
age6,
age7,
age8,
age9,
age10,
age11,
age12,
age13,
age14,
age15,
age16,
age17,
age18,
arts,
character,
leadership,
mentoring,
nutrition,
prevention,
sports,
supportservices,
academic,
community,
summer,
updated,
verified,
siteid_old,
stem,
college
FROM azcase_sites WHERE verified = 2 ORDER BY siteid;";
$sitesresult = pg_query($connection, $sitesquery);

// loop though sites if there are sties to verify - if not skip
if (pg_numrows($sitesresult)==0) {
	$sitestable = "<h3>No Sites to Verify</h3><p><a href=\"providerhome.php\">Go back</a> to the Admin Dashboard.</p>";
}else{

// create table to add sites to with form to batch edit or delete
$sitestable = "
<form name=\"approvedecline\" action=\"approvedeclinesites.php\" method=\"POST\">
<button type=\"button\" class=\"btn btn-default btn-sm\" id=\"selectAllVerify\">Select All</button>
<button type=\"button\" class=\"btn btn-default btn-sm\" id=\"selectNoneVerify\">Select None</button>
<button type=\"button\" class=\"btn btn-default btn-sm\" id=\"editPrograms\">Edit</button>
<input class=\"btn btn-default btn-sm\" type=\"submit\" name=\"approve\" value=\"Approve Selected Sites &#62;&#62;\" />
<input class=\"btn btn-default btn-sm\" type=\"submit\" name=\"decline\" value=\"Decline Selected Sites &#62;&#62;\" />
<br />
<table id=\"verifyTable\" class=\"table	table-condensed table-striped\"><thead>
<th>Select</th>
<th>Site Name</th>
<th>Address</th>
<th>Activites</th>
<th>Ages Served</th>
<th>Last Updated</th>
</thead>
<tbody>
";


for ($lt = 0; $lt < pg_numrows($sitesresult); $lt++) {
	$siteid = pg_result($sitesresult, $lt, 0);
	$sitename = pg_result($sitesresult, $lt, 1);
	$age5 = pg_result($sitesresult, $lt, 2);
	$age6 = pg_result($sitesresult, $lt, 3);
	$age7 = pg_result($sitesresult, $lt, 4);
	$age8 = pg_result($sitesresult, $lt, 5);
	$age9 = pg_result($sitesresult, $lt, 6);
	$age10 = pg_result($sitesresult, $lt, 7);
	$age11 = pg_result($sitesresult, $lt, 8);
	$age12 = pg_result($sitesresult, $lt, 9);
	$age13 = pg_result($sitesresult, $lt, 10);
	$age14 = pg_result($sitesresult, $lt, 11);
	$age15 = pg_result($sitesresult, $lt, 12);
	$age16 = pg_result($sitesresult, $lt, 13);
	$age17 = pg_result($sitesresult, $lt, 14);
	$age18 = pg_result($sitesresult, $lt, 15);
	$arts = pg_result($sitesresult, $lt, 16);
	$character = pg_result($sitesresult, $lt, 17);
	$leadership = pg_result($sitesresult, $lt, 18);
	$mentoring = pg_result($sitesresult, $lt, 19);
	$nutrition = pg_result($sitesresult, $lt, 20);
	$prevention = pg_result($sitesresult, $lt, 21);
	$sports = pg_result($sitesresult, $lt, 22);
	$supportservices = pg_result($sitesresult, $lt, 23);
	$academic = pg_result($sitesresult, $lt, 24);
	$community = pg_result($sitesresult, $lt, 25);
	$summer = pg_result($sitesresult, $lt, 26);
	$siteupdated = pg_result($sitesresult, $lt, 27);
	$verified = pg_result($sitesresult, $lt, 28);
	$siteid_old = pg_result($sitesresult, $lt, 29);
	$stem = pg_result($sitesresult, $lt, 30);
	$college = pg_result($sitesresult, $lt, 31);

// format updated date
$siteupdated = date("M j, Y", strtotime($siteupdated));

// format ages
require('formatage.php');

// format activity categories
require('formatactivity.php');

// pull address location for this site
$siteaddressquery = "SELECT address, address2, city, state, zip, locationid FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteid);";
$siteaddressresult = pg_query($connection, $siteaddressquery);
for ($lt1 = 0; $lt1 < pg_numrows($siteaddressresult); $lt1++) {
	$siteaddress = pg_result($siteaddressresult, $lt1, 0);
	$siteaddress2 = pg_result($siteaddressresult, $lt1, 1);
	$sitecity = pg_result($siteaddressresult, $lt1, 2);
	$sitestate = pg_result($siteaddressresult, $lt1, 3);
	$sitezip = pg_result($siteaddressresult, $lt1, 4);
	$locationid = pg_result($siteaddressresult, $lt1, 5);
}

// format address
$printsiteaddress = $siteaddress;
if (!$siteaddress2) { 
	$printsiteaddress .= '<br />'; 
}else{ 
	$printsiteaddress .=  ' ' . $siteaddress2 . '<br />'; 
}
$printsiteaddress .= $sitecity . ' ';
$printsiteaddress .= $sitestate . ' ';
$printsiteaddress .= $sitezip . ' '; 

if (!$siteid_old) {
	$trclass = "<tr class=\"notverified\">";
	$sitename = $sitename . ' <strong>(NEW SITE)</strong>';
}else{
	$trclass = "<tr>";
}

// Add (SUMMER SITE) to the end of the site name 
if ($summer=='t') {
	$sitename = $sitename . ' <strong>(SUMMER SITE)</strong>';
}else{}

// add a new row to the sites table
$sitestable .= $trclass;

// if verified is 2, then don't allow editing or checkbox
$sitestable .= "<td align=\"center\"><input type=\"checkbox\" name=\"$siteid\" value=\"t\" /></td>";

$sitestable .= "<td>$sitename</td>
<td>$printsiteaddress</td>
<td>$activities</td>
<td>$agesserved</td>
<td>$siteupdated</td>
</tr>";

} // close site loop

// close up the sites table
$sitestable .= "
</tbody>
</table>
</form>
";

} // close if then if sites exist

?>
<body>
<h3 class="azcase-text-color">Verify Sites</h3>
<p>Below you can choose to approve or decline sites that are newly added or recently editied. Please select the boxes for any sites you would like to approve or decline and then click the appropriate button. Note that newly added sites are highlighted in a darker grey. Thanks!</p>

<?php
echo $sitestable;


// create footer
require('footer.php');

?>

<script type="text/javascript">
$().ready(new function(){
	$("#selectAllVerify").click(function () {
		$("#verifyTable input:checkbox").prop( "checked", true );
	});
	$("#selectNoneVerify").click(function () {
		$("#verifyTable input:checkbox").prop( "checked", false );
	});


	$("#editPrograms").click(function (event) {
		if ($("#verifyTable input:checkbox:checked").length > 1) {
			event.preventDefault();
			alert("You can only edit one program at a time. Please select only one program to edit. Thanks!");
		} else {
			var siteid = $("#verifyTable input:checkbox:checked").attr("name");
			parent.window.location = "http://azcase.nijel.org/editPrograms?siteid=" + siteid;	
		}
	});

});

</script>

