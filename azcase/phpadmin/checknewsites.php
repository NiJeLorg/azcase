<?php
// check all sites added to make sure that none already exist in the database before adding any new data
if (!$sitename1 || !$locationid1) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename1') AND locationid = $locationid1;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid1;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename1 || !$locationid1)

if (!$sitename2 || !$locationid2) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename2') AND locationid = $locationid2;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid2;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename2 || !$locationid2)

if (!$sitename3 || !$locationid3) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename3') AND locationid = $locationid3;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid3;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename3 || !$locationid3)

if (!$sitename4 || !$locationid4) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename4') AND locationid = $locationid4;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid4;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename4 || !$locationid4)

if (!$sitename5 || !$locationid5) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename5') AND locationid = $locationid5;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid5;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename5 || !$locationid5)

if (!$sitename6 || !$locationid6) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename6') AND locationid = $locationid6;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid6;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename6 || !$locationid6)

if (!$sitename7 || !$locationid7) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename7') AND locationid = $locationid7;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid7;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename7 || !$locationid7)

if (!$sitename8 || !$locationid8) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename8') AND locationid = $locationid8;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid8;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename8 || !$locationid8)

if (!$sitename9 || !$locationid9) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename9') AND locationid = $locationid9;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid9;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename9 || !$locationid9)

if (!$sitename10 || !$locationid10) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename10') AND locationid = $locationid10;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid10;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename10 || !$locationid10)

if (!$sitename11 || !$locationid11) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename11') AND locationid = $locationid11;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid11;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename11 || !$locationid11)

if (!$sitename12 || !$locationid12) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename12') AND locationid = $locationid12;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid12;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename12 || !$locationid12)

if (!$sitename13 || !$locationid13) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename13') AND locationid = $locationid13;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid13;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename13 || !$locationid13)

if (!$sitename14 || !$locationid14) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename14') AND locationid = $locationid14;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid14;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename14 || !$locationid14)

if (!$sitename15 || !$locationid15) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename15') AND locationid = $locationid15;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid15;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename15 || !$locationid15)

if (!$sitename16 || !$locationid16) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename16') AND locationid = $locationid16;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid16;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename16 || !$locationid16)

if (!$sitename17 || !$locationid17) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename17') AND locationid = $locationid17;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid17;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename17 || !$locationid17)

if (!$sitename18 || !$locationid18) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename18') AND locationid = $locationid18;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid18;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename18 || !$locationid18)

if (!$sitename19 || !$locationid19) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename19') AND locationid = $locationid19;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid19;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename19 || !$locationid19)

if (!$sitename20 || !$locationid20) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename20') AND locationid = $locationid20;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid20;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename20 || !$locationid20)

if (!$sitename21 || !$locationid21) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename21') AND locationid = $locationid21;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid21;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename21 || !$locationid21)

if (!$sitename22 || !$locationid22) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename22') AND locationid = $locationid22;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid22;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename22 || !$locationid22)

if (!$sitename23 || !$locationid23) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename23') AND locationid = $locationid23;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid23;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename23 || !$locationid23)

if (!$sitename24 || !$locationid24) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename24') AND locationid = $locationid24;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid24;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename24 || !$locationid24)

if (!$sitename25 || !$locationid25) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename25') AND locationid = $locationid25;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid25;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename25 || !$locationid25)

if (!$sitename26 || !$locationid26) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename26') AND locationid = $locationid26;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid26;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename26 || !$locationid26)

if (!$sitename27 || !$locationid27) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename27') AND locationid = $locationid27;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid27;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename27 || !$locationid27)

if (!$sitename28 || !$locationid28) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename28') AND locationid = $locationid28;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid28;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename28 || !$locationid28)

if (!$sitename29 || !$locationid29) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename29') AND locationid = $locationid29;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid29;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename29 || !$locationid29)

if (!$sitename30 || !$locationid30) {
}else{ 
	// check to see if this site exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE name = '$sitename30') AND locationid = $locationid30;";
	$countresult = pg_query($connection, $countquery);
	$countsite = pg_result($countresult, 0, 0);
	if ($countsite>0) {
		require('header.php');
		$locationquery = "SELECT name, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid30;";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt = 0; $lt < pg_numrows($locationresult); $lt++) {
			$locationname = pg_result($locationresult, $lt, 0);
			$address = pg_result($locationresult, $lt, 1);
			$address2 = pg_result($locationresult, $lt, 2);
			$city = pg_result($locationresult, $lt, 3);
			$state = pg_result($locationresult, $lt, 4);
			$zip = pg_result($locationresult, $lt, 5);		
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

		echo "<body><h3>Error: The Site $sitename Already Exists in the System at $locationname</h3><p>It appears that you attmepted to add a site, $sitename that already exists in the system at the location, $locationname ($printaddress). Please <a href=\"newsites.php\">go back</a> and remove this site from the list of sites you're attempting to add. Thanks!</p>";
		require('footer.php');
		die();
	}else{}
} // close if (!$sitename30 || !$locationid30)




?>

