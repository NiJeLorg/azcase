<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

$userid = $_SESSION['POSTuserid'];
$lastsiteid = $_REQUEST['lastsiteid'];

// increment site id
if (!$lastsiteid) {
	$siteidquery = "SELECT siteid FROM azcase_sites WHERE summer = TRUE AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid AND newsite = TRUE) ORDER BY siteid LIMIT 1;";
	$siteidresult = pg_query($connection, $siteidquery);
	for ($lt = 0; $lt < pg_numrows($siteidresult); $lt++) {
		$siteid = pg_result($siteidresult, $lt, 0);
	}
}else{
	$siteid = $lastsiteid + 1;
}

// if the siteid doesn't exist, then print thank you and link to choose summer sites
$countquery = "SELECT count(*) FROM azcase_user_sites_junction WHERE siteid = $siteid AND userid = $userid;";
$countresult = pg_query($connection, $countquery);
$countsite = pg_result($countresult, 0, 0);
if ($countsite==0) {
	header("Location: https://azcase.nijel.org/php/thankyousites.php");
}else{

// create header
require('header.php');

// if siteid exists then pull site name and location
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
} // close if ($countsite==0)

?>
<body>
<h3 class="azcase-text-color">Add Additional Information for Summer Site, <?php echo $sitename; ?></h3>
<p>Please make any changes below for the summer program, <strong><?php echo $sitename; ?></strong>, located at <strong><?php echo $locationname; echo ' (' . $printaddress . ')'; ?></strong>. Please note that these forms are <em>optional</em>, but the data you enter below will greatly assist the Arizona Center for Afterschool Excellence in our advocacy work. Thanks!</p>
<?php

// add in the new locations form
require('addnewsummersitesurveyform.php'); 

// create footer
require('footer.php');

?>

<script type="text/javascript">
function toggle(obj) {
	var el = document.getElementById(obj);
	if ( el.style.display == 'none' ) {
		el.style.display = '';
	}
	else {
	}
}

</script>






