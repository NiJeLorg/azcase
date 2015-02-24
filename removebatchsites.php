<?php
// create the add new sites form

// pull user id for ease of use below
$useremailsession = pg_escape_string($_SESSION['useremail']);
$useridquery = "SELECT userid FROM azcase_users WHERE useremail = '$useremailsession';";
$useridresult = pg_query($connection, $useridquery);
for ($lt = 0; $lt < pg_numrows($useridresult); $lt++) {
	$userid = pg_result($useridresult, $lt, 0);
}

// create a loop that captures all checked siteids and fills a variable with their name and location as well as creates a hidden input to pass to the next page
$sitelocnames = '<b>Sites Selected for Removal:</b><ul>';
$hiddensites = '';
$siteidloopquery = "SELECT siteid, name, summer FROM azcase_sites WHERE (verified = 1 OR verified = 2) AND siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid) ORDER BY name, summer;";
$siteidloopresult = pg_query($connection, $siteidloopquery);
for ($lt = 0; $lt < pg_numrows($siteidloopresult); $lt++) {
	$siteidloop = pg_result($siteidloopresult, $lt, 0);
	if ($_REQUEST["$siteidloop"]=='t') {
		// hold a siteid that the user picked below
		$siteid = $siteidloop;
		// add to site/location name variable
		$sitename = pg_result($siteidloopresult, $lt, 1);
		$summer = pg_result($siteidloopresult, $lt, 2);
		
		$locationquery = "SELECT name, address, address2, city, state, zip, locationid FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteidloop);";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt1 = 0; $lt1 < pg_numrows($locationresult); $lt1++) {
			$locationname = pg_result($locationresult, $lt1, 0);
			$address = pg_result($locationresult, $lt1, 1);
			$address2 = pg_result($locationresult, $lt1, 2);
			$city = pg_result($locationresult, $lt1, 3);
			$state = pg_result($locationresult, $lt1, 4);
			$zip = pg_result($locationresult, $lt1, 5);		
			$locationid = pg_result($locationresult, $lt1, 6);		
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
		
		// Add (SUMMER SITE) to the end of the site name 
		if ($summer=='t') {
			$sitename = $sitename . ' (SUMMER SITE)';
		}else{}

		$sitelocnames .= "<li><b><a href=\"site.php?siteid=$siteid&locationid=$locationid\">$sitename</a></b>, located at <b>$locationname</b> ($printaddress)</li>";

		// add hidden siteids
		$hiddensites .= "<input type=\"hidden\" name=\"$siteidloop\" value=\"t\" />";

	}else{}


} // close siteidloop

// close sitelocnames
$sitelocnames .= '</ul>';


?>
<body>
<h1>Remvoe Group of Sites</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a></p>
<p>You have selected to <b>remove</b> the sites listed below. Please double check your selection.</p>
<form name="removesites" id="removesites" action="processremovebatchsites.php" method="POST">
<?php echo $hiddensites;  echo $sitelocnames; ?>
<br /><br />

<br />
<input type="submit" name="button1" value="Remove These Sites &#62;&#62;" />
</form>

