<?php
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

$userid = $_SESSION['POSTuserid'];

?>
<body>
<h3 class="azcase-text-color">Academic Year and Summer Operations at Your Programs</h3>
<p>Please indicate below if your programs operate in the school year, summer or both. Thanks!</p>
<?php
// create loop to populate the summer selection form
// build form variable to echo
$summerform = "<form name=\"summer\" id=\"summer\" action=\"processsummersites.php\" method=\"POST\">";

// select all siteids from this user that a new
$siteidquery = "SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid AND newsite = TRUE ORDER BY siteid;";
$siteidresult = pg_query($connection, $siteidquery);
for ($lt1 = 0; $lt1 < pg_numrows($siteidresult); $lt1++) {
	$siteid = pg_result($siteidresult, $lt1, 0);

	// pull site name and location to print
	$sitenamequery = "SELECT name FROM azcase_sites WHERE siteid = $siteid;";
	$sitenameresult = pg_query($connection, $sitenamequery);
	for ($lt = 0; $lt < pg_numrows($sitenameresult); $lt++) {
		$sitename = pg_result($sitenameresult, $lt, 0);
	}

	$locationquery = "SELECT name, address, address2, city, state, zip, locationid FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteid);";
	$locationresult = pg_query($connection, $locationquery);
	for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
		$locationname = pg_result($locationresult, $lt, 0);
		$address = pg_result($locationresult, $lt, 1);
		$address2 = pg_result($locationresult, $lt, 2);
		$city = pg_result($locationresult, $lt, 3);
		$state = pg_result($locationresult, $lt, 4);
		$zip = pg_result($locationresult, $lt, 5);		
		$locationid = pg_result($locationresult, $lt, 6);		
	}
	// format address
	$printaddress = $address;
	if (!$address2) { 
		$printaddress .=  '; '; 
	}else{ 
		$printaddress .=  ' ' . $address2 . '; ';
	}
	if (!$city) { 
	}else{ 
		$printaddress .= $city . ' ';
	}
	if (!$state) { 
	}elseif (!$zip) {
		$printaddress .= $state;	
	}else{ 
		$printaddress .= $state . ' ';
	}
	if (!$zip) { 
	}else{ 
		$printaddress .= $zip; 
	}

	// add siteid selection array to summerform variable
	$summerform .= "<h4><u>$sitename at $locationname ($printaddress)</u></h4>";
	$summerform .= "<input type=\"radio\" name=\"$siteid\" value=\"1\"> This site <b>ONLY</b> operates during the <b>academic year</b>.<br />";
	$summerform .= "<input type=\"radio\" name=\"$siteid\" value=\"2\"> This site <b>ONLY</b> operates during the <b>summer</b>.<br />";
	$summerform .= "<input type=\"radio\" name=\"$siteid\" value=\"3\"> This site operates during <b>BOTH</b> the <b>academic year and the summer</b>.<br />";
	$summerform .= "<br /><br />";

} // close siteid loop

// end form and create submit button
$summerform .= "<input type=\"submit\" class=\"btn btn-default
\" name=\"action\" value=\"Save and Continue &#62;&#62;\" /></form>";

// print the form
echo $summerform;


// create footer
require('footer.php');

?>
