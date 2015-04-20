<?php
// list of sites to be approved

// create a loop that captures all checked siteids and fills a variable with their name and location as well as creates a hidden input to pass to the next page
$sitelocnames = '<strong>Sites Selected for Approval:</strong><ul>';
$hiddensites = '';
$siteidloopquery = "SELECT siteid, name, summer FROM azcase_sites WHERE verified = 2 ORDER BY name, summer;";
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

		$sitelocnames .= "<li><strong>$sitename</strong>, located at <b>$locationname</b> ($printaddress)</li>";

		// add hidden siteids
		$hiddensites .= "<input type=\"hidden\" name=\"$siteidloop\" value=\"t\" />";

	}else{}


} // close siteidloop

// close sitelocnames
$sitelocnames .= '</ul>';

?>
<body>
<h3 class="azcase-text-color">Approve a Group of Sites</h3>
<p>Below you may approve the group of sites you just selected. Please review these sites below and then click "approve" if you aggree to approve these sites. Thanks!</p>
<form name="approvesites" id="approvesites" action="processapprovesites.php" method="POST">
<?php echo $hiddensites;  echo $sitelocnames; ?>
<br />
<input class="btn btn-default" type="submit" name="button1" value="Approve &#62;&#62;" />
</form>

