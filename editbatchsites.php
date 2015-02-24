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
$sitelocnames = '<b>Sites Selected:</b><ul>';
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

		$sitelocnames .= "<li><b>$sitename</b>, located at <b>$locationname</b> ($printaddress)</li>";

		// add hidden siteids
		$hiddensites .= "<input type=\"hidden\" name=\"$siteidloop\" value=\"t\" />";

	}else{}


} // close siteidloop

// close sitelocnames
$sitelocnames .= '</ul>';

// pull data for last siteid 
$sitequery = "SELECT age5, age6, age7, age8, age9, age10, age11, age12, age13, age14, age15, age16, age17, age18, arts, character, leadership, mentoring, nutrition, prevention, sports, supportservices, academic, community, monstartmorning, tuestartmorning, wedstartmorning, thustartmorning, fristartmorning, monendmorning, tueendmorning, wedendmorning, thuendmorning, friendmorning, monstartafter, tuestartafter, wedstartafter, thustartafter, fristartafter, monendafter, tueendafter, wedendafter, thuendafter, friendafter, satstartweekend, sunstartweekend, satendweekend, sunendweekend, charge, costfrequency, costamount, feeassistance, desassistance, scholarship, mcdiscount, otherassistance, transportation, snacks, breakfast, lunch, dinner, freelunch, spanish, otherlanguage, stem, college FROM azcase_sites WHERE siteid = $siteid;";
$siteresult = pg_query($connection, $sitequery);
for ($lt = 0; $lt < pg_numrows($siteresult); $lt++) {
	$age5 = pg_result($siteresult, $lt, 0);
	$age6 = pg_result($siteresult, $lt, 1);
	$age7 = pg_result($siteresult, $lt, 2);
	$age8 = pg_result($siteresult, $lt, 3);
	$age9 = pg_result($siteresult, $lt, 4);
	$age10 = pg_result($siteresult, $lt, 5);
	$age11 = pg_result($siteresult, $lt, 6);
	$age12 = pg_result($siteresult, $lt, 7);
	$age13 = pg_result($siteresult, $lt, 8);
	$age14 = pg_result($siteresult, $lt, 9);
	$age15 = pg_result($siteresult, $lt, 10);
	$age16 = pg_result($siteresult, $lt, 11);
	$age17 = pg_result($siteresult, $lt, 12);
	$age18 = pg_result($siteresult, $lt, 13);
	$arts = pg_result($siteresult, $lt, 14);
	$character = pg_result($siteresult, $lt, 15);
	$leadership = pg_result($siteresult, $lt, 16);
	$mentoring = pg_result($siteresult, $lt, 17);
	$nutrition = pg_result($siteresult, $lt, 18);
	$prevention = pg_result($siteresult, $lt, 19);
	$sports = pg_result($siteresult, $lt, 20);
	$supportservices = pg_result($siteresult, $lt, 21);
	$academic = pg_result($siteresult, $lt, 22);
	$community = pg_result($siteresult, $lt, 23);
	$monstartmorning = pg_result($siteresult, $lt, 24);
	$tuestartmorning = pg_result($siteresult, $lt, 25);
	$wedstartmorning = pg_result($siteresult, $lt, 26);
	$thustartmorning = pg_result($siteresult, $lt, 27);
	$fristartmorning = pg_result($siteresult, $lt, 28);
	$monendmorning = pg_result($siteresult, $lt, 29);
	$tueendmorning = pg_result($siteresult, $lt, 30);
	$wedendmorning = pg_result($siteresult, $lt, 31);
	$thuendmorning = pg_result($siteresult, $lt, 32);
	$friendmorning = pg_result($siteresult, $lt, 33);
	$monstartafter = pg_result($siteresult, $lt, 34);
	$tuestartafter = pg_result($siteresult, $lt, 35);
	$wedstartafter = pg_result($siteresult, $lt, 36);
	$thustartafter = pg_result($siteresult, $lt, 37);
	$fristartafter = pg_result($siteresult, $lt, 38);
	$monendafter = pg_result($siteresult, $lt, 39);
	$tueendafter = pg_result($siteresult, $lt, 40);
	$wedendafter = pg_result($siteresult, $lt, 41);
	$thuendafter = pg_result($siteresult, $lt, 42);
	$friendafter = pg_result($siteresult, $lt, 43);
	$satstartweekend = pg_result($siteresult, $lt, 44);
	$sunstartweekend = pg_result($siteresult, $lt, 45);
	$satendweekend = pg_result($siteresult, $lt, 46);
	$sunendweekend = pg_result($siteresult, $lt, 47);
	$charge = pg_result($siteresult, $lt, 48);
	$costfrequency = pg_result($siteresult, $lt, 49);
	$costamount = pg_result($siteresult, $lt, 50);
	$feeassistance = pg_result($siteresult, $lt, 51);
	$desassistance = pg_result($siteresult, $lt, 52);
	$scholarship = pg_result($siteresult, $lt, 53);
	$mcdiscount = pg_result($siteresult, $lt, 54);
	$otherassistance = pg_result($siteresult, $lt, 55);
	$transportation = pg_result($siteresult, $lt, 56);
	$snacks = pg_result($siteresult, $lt, 57);
	$breakfast = pg_result($siteresult, $lt, 58);
	$lunch = pg_result($siteresult, $lt, 59);
	$dinner = pg_result($siteresult, $lt, 60);
	$freelunch = pg_result($siteresult, $lt, 61);
	$spanish = pg_result($siteresult, $lt, 62);
	$otherlanguage = pg_result($siteresult, $lt, 63);
	$stem = pg_result($siteresult, $lt, 64);
	$college = pg_result($siteresult, $lt, 65);

}

// create times combo box options
$mtimescboxoptions = '';
$atimescboxoptions = '';
//morning times
$mtimescboxoptions .= "<option value=\"00:00:00\">--</option>";
$mtimescboxoptions .= "<option value=\"05:00:00\">5:00 AM</option>";
$mtimescboxoptions .= "<option value=\"05:15:00\">5:15 AM</option>";
$mtimescboxoptions .= "<option value=\"05:30:00\">5:30 AM</option>";
$mtimescboxoptions .= "<option value=\"05:45:00\">5:45 AM</option>";
$mtimescboxoptions .= "<option value=\"06:00:00\">6:00 AM</option>";
$mtimescboxoptions .= "<option value=\"06:15:00\">6:15 AM</option>";
$mtimescboxoptions .= "<option value=\"06:30:00\">6:30 AM</option>";
$mtimescboxoptions .= "<option value=\"06:45:00\">6:45 AM</option>";
$mtimescboxoptions .= "<option value=\"07:00:00\">7:00 AM</option>";
$mtimescboxoptions .= "<option value=\"07:15:00\">7:15 AM</option>";
$mtimescboxoptions .= "<option value=\"07:30:00\">7:30 AM</option>";
$mtimescboxoptions .= "<option value=\"07:45:00\">7:45 AM</option>";
$mtimescboxoptions .= "<option value=\"08:00:00\">8:00 AM</option>";
$mtimescboxoptions .= "<option value=\"08:15:00\">8:15 AM</option>";
$mtimescboxoptions .= "<option value=\"08:30:00\">8:30 AM</option>";
$mtimescboxoptions .= "<option value=\"08:45:00\">8:45 AM</option>";
$mtimescboxoptions .= "<option value=\"09:00:00\">9:00 AM</option>";
$mtimescboxoptions .= "<option value=\"09:15:00\">9:15 AM</option>";
$mtimescboxoptions .= "<option value=\"09:30:00\">9:30 AM</option>";
$mtimescboxoptions .= "<option value=\"09:45:00\">9:45 AM</option>";
$mtimescboxoptions .= "<option value=\"10:00:00\">10:00 AM</option>";
$mtimescboxoptions .= "<option value=\"10:15:00\">10:15 AM</option>";
$mtimescboxoptions .= "<option value=\"10:30:00\">10:30 AM</option>";
$mtimescboxoptions .= "<option value=\"10:45:00\">10:45 AM</option>";
$mtimescboxoptions .= "<option value=\"11:00:00\">11:00 AM</option>";
$mtimescboxoptions .= "<option value=\"11:15:00\">11:15 AM</option>";
$mtimescboxoptions .= "<option value=\"11:30:00\">11:30 AM</option>";
$mtimescboxoptions .= "<option value=\"11:45:00\">11:45 AM</option>";

//afternoon times
$atimescboxoptions .= "<option value=\"00:00:00\">--</option>";
$atimescboxoptions .= "<option value=\"12:00:00\">12:00 PM</option>";
$atimescboxoptions .= "<option value=\"12:15:00\">12:15 PM</option>";
$atimescboxoptions .= "<option value=\"12:30:00\">12:30 PM</option>";
$atimescboxoptions .= "<option value=\"12:45:00\">12:45 PM</option>";
$atimescboxoptions .= "<option value=\"13:00:00\">1:00 PM</option>";
$atimescboxoptions .= "<option value=\"13:15:00\">1:15 PM</option>";
$atimescboxoptions .= "<option value=\"13:30:00\">1:30 PM</option>";
$atimescboxoptions .= "<option value=\"13:45:00\">1:45 PM</option>";
$atimescboxoptions .= "<option value=\"14:00:00\">2:00 PM</option>";
$atimescboxoptions .= "<option value=\"14:15:00\">2:15 PM</option>";
$atimescboxoptions .= "<option value=\"14:30:00\">2:30 PM</option>";
$atimescboxoptions .= "<option value=\"14:45:00\">2:45 PM</option>";
$atimescboxoptions .= "<option value=\"15:00:00\">3:00 PM</option>";
$atimescboxoptions .= "<option value=\"15:15:00\">3:15 PM</option>";
$atimescboxoptions .= "<option value=\"15:30:00\">3:30 PM</option>";
$atimescboxoptions .= "<option value=\"15:45:00\">3:45 PM</option>";
$atimescboxoptions .= "<option value=\"16:00:00\">4:00 PM</option>";
$atimescboxoptions .= "<option value=\"16:15:00\">4:15 PM</option>";
$atimescboxoptions .= "<option value=\"16:30:00\">4:30 PM</option>";
$atimescboxoptions .= "<option value=\"16:45:00\">4:45 PM</option>";
$atimescboxoptions .= "<option value=\"17:00:00\">5:00 PM</option>";
$atimescboxoptions .= "<option value=\"17:15:00\">5:15 PM</option>";
$atimescboxoptions .= "<option value=\"17:30:00\">5:30 PM</option>";
$atimescboxoptions .= "<option value=\"17:45:00\">5:45 PM</option>";
$atimescboxoptions .= "<option value=\"18:00:00\">6:00 PM</option>";
$atimescboxoptions .= "<option value=\"18:15:00\">6:15 PM</option>";
$atimescboxoptions .= "<option value=\"18:30:00\">6:30 PM</option>";
$atimescboxoptions .= "<option value=\"18:45:00\">6:45 PM</option>";
$atimescboxoptions .= "<option value=\"19:00:00\">7:00 PM</option>";
$atimescboxoptions .= "<option value=\"19:15:00\">7:15 PM</option>";
$atimescboxoptions .= "<option value=\"19:30:00\">7:30 PM</option>";
$atimescboxoptions .= "<option value=\"19:45:00\">7:45 PM</option>";
$atimescboxoptions .= "<option value=\"20:00:00\">8:00 PM</option>";
$atimescboxoptions .= "<option value=\"20:15:00\">8:15 PM</option>";
$atimescboxoptions .= "<option value=\"20:30:00\">8:30 PM</option>";
$atimescboxoptions .= "<option value=\"20:45:00\">8:45 PM</option>";
$atimescboxoptions .= "<option value=\"21:00:00\">9:00 PM</option>";
$atimescboxoptions .= "<option value=\"21:15:00\">9:15 PM</option>";
$atimescboxoptions .= "<option value=\"21:30:00\">9:30 PM</option>";
$atimescboxoptions .= "<option value=\"21:45:00\">9:45 PM</option>";
$atimescboxoptions .= "<option value=\"22:00:00\">10:00 PM</option>";
$atimescboxoptions .= "<option value=\"22:15:00\">10:15 PM</option>";
$atimescboxoptions .= "<option value=\"22:30:00\">10:30 PM</option>";
$atimescboxoptions .= "<option value=\"22:45:00\">10:45 PM</option>";
$atimescboxoptions .= "<option value=\"23:00:00\">11:00 PM</option>";
$atimescboxoptions .= "<option value=\"23:15:00\">11:15 PM</option>";
$atimescboxoptions .= "<option value=\"23:30:00\">11:30 PM</option>";
$atimescboxoptions .= "<option value=\"23:45:00\">11:45 PM</option>";

// create base times combo box options
$timescboxoptions = '';
$timescboxoptions .= "<option value=\"00:00:00\">--</option>";
$timescboxoptions .= "<option value=\"05:00:00\">5:00 AM</option>";
$timescboxoptions .= "<option value=\"05:15:00\">5:15 AM</option>";
$timescboxoptions .= "<option value=\"05:30:00\">5:30 AM</option>";
$timescboxoptions .= "<option value=\"05:45:00\">5:45 AM</option>";
$timescboxoptions .= "<option value=\"06:00:00\">6:00 AM</option>";
$timescboxoptions .= "<option value=\"06:15:00\">6:15 AM</option>";
$timescboxoptions .= "<option value=\"06:30:00\">6:30 AM</option>";
$timescboxoptions .= "<option value=\"06:45:00\">6:45 AM</option>";
$timescboxoptions .= "<option value=\"07:00:00\">7:00 AM</option>";
$timescboxoptions .= "<option value=\"07:15:00\">7:15 AM</option>";
$timescboxoptions .= "<option value=\"07:30:00\">7:30 AM</option>";
$timescboxoptions .= "<option value=\"07:45:00\">7:45 AM</option>";
$timescboxoptions .= "<option value=\"08:00:00\">8:00 AM</option>";
$timescboxoptions .= "<option value=\"08:15:00\">8:15 AM</option>";
$timescboxoptions .= "<option value=\"08:30:00\">8:30 AM</option>";
$timescboxoptions .= "<option value=\"08:45:00\">8:45 AM</option>";
$timescboxoptions .= "<option value=\"09:00:00\">9:00 AM</option>";
$timescboxoptions .= "<option value=\"09:15:00\">9:15 AM</option>";
$timescboxoptions .= "<option value=\"09:30:00\">9:30 AM</option>";
$timescboxoptions .= "<option value=\"09:45:00\">9:45 AM</option>";
$timescboxoptions .= "<option value=\"10:00:00\">10:00 AM</option>";
$timescboxoptions .= "<option value=\"10:15:00\">10:15 AM</option>";
$timescboxoptions .= "<option value=\"10:30:00\">10:30 AM</option>";
$timescboxoptions .= "<option value=\"10:45:00\">10:45 AM</option>";
$timescboxoptions .= "<option value=\"11:00:00\">11:00 AM</option>";
$timescboxoptions .= "<option value=\"11:15:00\">11:15 AM</option>";
$timescboxoptions .= "<option value=\"11:30:00\">11:30 AM</option>";
$timescboxoptions .= "<option value=\"11:45:00\">11:45 AM</option>";
$timescboxoptions .= "<option value=\"12:00:00\">12:00 PM</option>";
$timescboxoptions .= "<option value=\"12:15:00\">12:15 PM</option>";
$timescboxoptions .= "<option value=\"12:30:00\">12:30 PM</option>";
$timescboxoptions .= "<option value=\"12:45:00\">12:45 PM</option>";
$timescboxoptions .= "<option value=\"13:00:00\">1:00 PM</option>";
$timescboxoptions .= "<option value=\"13:15:00\">1:15 PM</option>";
$timescboxoptions .= "<option value=\"13:30:00\">1:30 PM</option>";
$timescboxoptions .= "<option value=\"13:45:00\">1:45 PM</option>";
$timescboxoptions .= "<option value=\"14:00:00\">2:00 PM</option>";
$timescboxoptions .= "<option value=\"14:15:00\">2:15 PM</option>";
$timescboxoptions .= "<option value=\"14:30:00\">2:30 PM</option>";
$timescboxoptions .= "<option value=\"14:45:00\">2:45 PM</option>";
$timescboxoptions .= "<option value=\"15:00:00\">3:00 PM</option>";
$timescboxoptions .= "<option value=\"15:15:00\">3:15 PM</option>";
$timescboxoptions .= "<option value=\"15:30:00\">3:30 PM</option>";
$timescboxoptions .= "<option value=\"15:45:00\">3:45 PM</option>";
$timescboxoptions .= "<option value=\"16:00:00\">4:00 PM</option>";
$timescboxoptions .= "<option value=\"16:15:00\">4:15 PM</option>";
$timescboxoptions .= "<option value=\"16:30:00\">4:30 PM</option>";
$timescboxoptions .= "<option value=\"16:45:00\">4:45 PM</option>";
$timescboxoptions .= "<option value=\"17:00:00\">5:00 PM</option>";
$timescboxoptions .= "<option value=\"17:15:00\">5:15 PM</option>";
$timescboxoptions .= "<option value=\"17:30:00\">5:30 PM</option>";
$timescboxoptions .= "<option value=\"17:45:00\">5:45 PM</option>";
$timescboxoptions .= "<option value=\"18:00:00\">6:00 PM</option>";
$timescboxoptions .= "<option value=\"18:15:00\">6:15 PM</option>";
$timescboxoptions .= "<option value=\"18:30:00\">6:30 PM</option>";
$timescboxoptions .= "<option value=\"18:45:00\">6:45 PM</option>";
$timescboxoptions .= "<option value=\"19:00:00\">7:00 PM</option>";
$timescboxoptions .= "<option value=\"19:15:00\">7:15 PM</option>";
$timescboxoptions .= "<option value=\"19:30:00\">7:30 PM</option>";
$timescboxoptions .= "<option value=\"19:45:00\">7:45 PM</option>";
$timescboxoptions .= "<option value=\"20:00:00\">8:00 PM</option>";
$timescboxoptions .= "<option value=\"20:15:00\">8:15 PM</option>";
$timescboxoptions .= "<option value=\"20:30:00\">8:30 PM</option>";
$timescboxoptions .= "<option value=\"20:45:00\">8:45 PM</option>";
$timescboxoptions .= "<option value=\"21:00:00\">9:00 PM</option>";
$timescboxoptions .= "<option value=\"21:15:00\">9:15 PM</option>";
$timescboxoptions .= "<option value=\"21:30:00\">9:30 PM</option>";
$timescboxoptions .= "<option value=\"21:45:00\">9:45 PM</option>";
$timescboxoptions .= "<option value=\"22:00:00\">10:00 PM</option>";
$timescboxoptions .= "<option value=\"22:15:00\">10:15 PM</option>";
$timescboxoptions .= "<option value=\"22:30:00\">10:30 PM</option>";
$timescboxoptions .= "<option value=\"22:45:00\">10:45 PM</option>";
$timescboxoptions .= "<option value=\"23:00:00\">11:00 PM</option>";
$timescboxoptions .= "<option value=\"23:15:00\">11:15 PM</option>";
$timescboxoptions .= "<option value=\"23:30:00\">11:30 PM</option>";
$timescboxoptions .= "<option value=\"23:45:00\">11:45 PM</option>";


// create combo boxes based on which start times are given 
// start times
if (!$monstartmorning || $monstartmorning=='00:00:00') {
	$monstartmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $monstartmorning . '"';
	$replace = 'value="' . $monstartmorning . '" selected="selected"';
	$monstartmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$tuestartmorning || $tuestartmorning=='00:00:00') {
	$tuestartmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $tuestartmorning . '"';
	$replace = 'value="' . $tuestartmorning . '" selected="selected"';
	$tuestartmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$wedstartmorning || $wedstartmorning=='00:00:00') {
	$wedstartmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $wedstartmorning . '"';
	$replace = 'value="' . $wedstartmorning . '" selected="selected"';
	$wedstartmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$thustartmorning || $thustartmorning=='00:00:00') {
	$thustartmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $thustartmorning . '"';
	$replace = 'value="' . $thustartmorning . '" selected="selected"';
	$thustartmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$fristartmorning || $fristartmorning=='00:00:00') {
	$fristartmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $fristartmorning . '"';
	$replace = 'value="' . $fristartmorning . '" selected="selected"';
	$fristartmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$monstartafter || $monstartafter=='00:00:00') {
	$monstartaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $monstartafter . '"';
	$replace = 'value="' . $monstartafter . '" selected="selected"';
	$monstartaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$tuestartafter || $tuestartafter=='00:00:00') {
	$tuestartaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $tuestartafter . '"';
	$replace = 'value="' . $tuestartafter . '" selected="selected"';
	$tuestartaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$wedstartafter || $wedstartafter=='00:00:00') {
	$wedstartaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $wedstartafter . '"';
	$replace = 'value="' . $wedstartafter . '" selected="selected"';
	$wedstartaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$thustartafter || $thustartafter=='00:00:00') {
	$thustartaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $thustartafter . '"';
	$replace = 'value="' . $thustartafter . '" selected="selected"';
	$thustartaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$fristartafter || $fristartafter=='00:00:00') {
	$fristartaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $fristartafter . '"';
	$replace = 'value="' . $fristartafter . '" selected="selected"';
	$fristartaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$satstartweekend || $satstartweekend=='00:00:00') {
	$satstartweekendcboxoptions = $timescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $satstartweekend . '"';
	$replace = 'value="' . $satstartweekend . '" selected="selected"';
	$satstartweekendcboxoptions = str_replace($needle, $replace, $timescboxoptions);
}

if (!$sunstartweekend || $sunstartweekend=='00:00:00') {
	$sunstartweekendcboxoptions = $timescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $sunstartweekend . '"';
	$replace = 'value="' . $sunstartweekend . '" selected="selected"';
	$sunstartweekendcboxoptions = str_replace($needle, $replace, $timescboxoptions);
}


// end times
if (!$monendmorning || $monendmorning=='00:00:00') {
	$monendmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $monendmorning . '"';
	$replace = 'value="' . $monendmorning . '" selected="selected"';
	$monendmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$tueendmorning || $tueendmorning=='00:00:00') {
	$tueendmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $tueendmorning . '"';
	$replace = 'value="' . $tueendmorning . '" selected="selected"';
	$tueendmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$wedendmorning || $wedendmorning=='00:00:00') {
	$wedendmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $wedendmorning . '"';
	$replace = 'value="' . $wedendmorning . '" selected="selected"';
	$wedendmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$thuendmorning || $thuendmorning=='00:00:00') {
	$thuendmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $thuendmorning . '"';
	$replace = 'value="' . $thuendmorning . '" selected="selected"';
	$thuendmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$friendmorning || $friendmorning=='00:00:00') {
	$friendmorningcboxoptions = $mtimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $friendmorning . '"';
	$replace = 'value="' . $friendmorning . '" selected="selected"';
	$friendmorningcboxoptions = str_replace($needle, $replace, $mtimescboxoptions);
}

if (!$monendafter || $monendafter=='00:00:00') {
	$monendaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $monendafter . '"';
	$replace = 'value="' . $monendafter . '" selected="selected"';
	$monendaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$tueendafter || $tueendafter=='00:00:00') {
	$tueendaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $tueendafter . '"';
	$replace = 'value="' . $tueendafter . '" selected="selected"';
	$tueendaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$wedendafter || $wedendafter=='00:00:00') {
	$wedendaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $wedendafter . '"';
	$replace = 'value="' . $wedendafter . '" selected="selected"';
	$wedendaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$thuendafter || $thuendafter=='00:00:00') {
	$thuendaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $thuendafter . '"';
	$replace = 'value="' . $thuendafter . '" selected="selected"';
	$thuendaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$friendafter || $friendafter=='00:00:00') {
	$friendaftercboxoptions = $atimescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $friendafter . '"';
	$replace = 'value="' . $friendafter . '" selected="selected"';
	$friendaftercboxoptions = str_replace($needle, $replace, $atimescboxoptions);
}

if (!$satendweekend || $satendweekend=='00:00:00') {
	$satendweekendcboxoptions = $timescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $satendweekend . '"';
	$replace = 'value="' . $satendweekend . '" selected="selected"';
	$satendweekendcboxoptions = str_replace($needle, $replace, $timescboxoptions);
}

if (!$sunendweekend || $sunendweekend=='00:00:00') {
	$sunendweekendcboxoptions = $timescboxoptions;
}else{
	$needle = '';
	$replace = '';
	$needle = 'value="' . $sunendweekend . '"';
	$replace = 'value="' . $sunendweekend . '" selected="selected"';
	$sunendweekendcboxoptions = str_replace($needle, $replace, $timescboxoptions);
}


// create cost combo box options
$i = 1;
$costamount = number_format($costamount, 0, '', '');
$costcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 10000) {
	$costnum = '$' . number_format($i);
	// add selected to the opttion that matches the cost amount
	if ($costamount==$i) {
		$costcboxoptions .= "<option value=\"$i\" selected=\"selected\">$costnum</option>";
	}else{
		$costcboxoptions .= "<option value=\"$i\">$costnum</option>";
	}
	$i++; 
}

// create free lunch combo box options
$i = 1;
$freelunch = number_format($freelunch, 0, '', '');
$freelunchcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$freelunchnum = $i . '%';
	if ($freelunch==$i) {
		$freelunchcboxoptions .= "<option value=\"$i\" selected=\"selected\">$freelunchnum</option>";
	}else{
		$freelunchcboxoptions .= "<option value=\"$i\">$freelunchnum</option>";
	}
	$i++; 
}


?>
<body>
<h1>Edit Group of Sites</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a></p>
<p>Below you may edit the batch of sites you just selected together on the same page. Please note that the activites, hours, ages served and other data below will be reflected across all the sites you selected. Thanks!</p>
<form name="editsites" id="editsites" action="processeditbatchsites.php" method="POST">
<?php echo $hiddensites;  echo $sitelocnames; ?>
<br /><br />
<b>Select Program Activities:</b> 
<table cellpadding="2">
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activity" value="TRUE"> </td>
		<td align="left" width="175"><i>Check/Uncheck All</i></td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityacademic" value="TRUE" <?php if ($academic=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Tutoring/Academic Enrichment</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityarts" value="TRUE" <?php if ($arts=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Arts and Culture</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitysports" value="TRUE" <?php if ($sports=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Sports and Recreation</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitycommunity" value="TRUE" <?php if ($community=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Volunteering/Community Service</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitystem" value="TRUE" <?php if ($stem=='t') { echo 'checked="checked"'; }else{} ?>> </td>
		<td align="left" width="175">Science, Technology, Engineering, and Mathematics</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitycollege" value="TRUE" <?php if ($college=='t') { echo 'checked="checked"'; }else{} ?>> </td>
		<td align="left" width="175">College and Career Readiness</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityleadership" value="TRUE" <?php if ($leadership=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Leadership</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitycharacter" value="TRUE" <?php if ($character=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Character Education</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityprevention" value="TRUE" <?php if ($prevention=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Prevention</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitynutrition" value="TRUE" <?php if ($nutrition=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Nutrition</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitymentoring" value="TRUE" <?php if ($mentoring=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Mentoring</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitysupportservices" value="TRUE" <?php if ($supportservices=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Support Services (medical, dental, mental health, etc.)</td>
	</tr>
</table>
<br />
<b>Select Ages Served:</b>
<table cellpadding="2">
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age" value="TRUE"> </td>
		<td align="left" width="175"><i>Check/Uncheck All</i></td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age5" value="TRUE" <?php if ($age5=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 5</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age6" value="TRUE" <?php if ($age6=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 6</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age7" value="TRUE" <?php if ($age7=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 7</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age8" value="TRUE" <?php if ($age8=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 8</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age9" value="TRUE" <?php if ($age9=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 9</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age10" value="TRUE" <?php if ($age10=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 10</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age11" value="TRUE" <?php if ($age11=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 11</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age12" value="TRUE" <?php if ($age12=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 12</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age13" value="TRUE" <?php if ($age13=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 13</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age14" value="TRUE" <?php if ($age14=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 14</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age15" value="TRUE" <?php if ($age15=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 15</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age16" value="TRUE" <?php if ($age16=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 16</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age17" value="TRUE" <?php if ($age17=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 17</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age18" value="TRUE" <?php if ($age18=='t') { echo 'checked="checked"'; }else{} ?>></td>
		<td align="left" width="175">Age 18</td>
	</tr>

</table>
<br />
<br />
<table class="hoursTable" cellpadding="4">
	<tr>
		<th align="left" ><b>Select Hours of Operation:</b></th>
		<th align="right" ><b>Morning Start Time</b></th>
		<th align="right" ><b>Morning End Time</b></th>
		<th align="right" ><b>Afternoon Start Time</b></th>
		<th align="right" ><b>Afternoon End Time</b></th>
		<th class="lastcol"></th>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Monday:</b></td>
		<td align="center"><select name="monstartmorning"><?php echo $monstartmorningcboxoptions; ?></select></td>
		<td align="center"><select name="monendmorning"><?php echo $monendmorningcboxoptions; ?></select></td>
		<td align="center"><select name="monstartafter"><?php echo $monstartaftercboxoptions; ?></select></td>
		<td align="center"><select name="monendafter"><?php echo $monendaftercboxoptions; ?></select></td>
		<td class="lastcol"><a href="javascript:copyWeekdayTimes();">Copy and paste first row</a></td>
	</tr>
	<tr class="alt">
		<td class="firstcol" align="left"><b>Tuesday:</b></td>
		<td align="center"><select name="tuestartmorning"><?php echo $tuestartmorningcboxoptions; ?></select></td>
		<td align="center"><select name="tueendmorning"><?php echo $tueendmorningcboxoptions; ?></select></td>
		<td align="center"><select name="tuestartafter"><?php echo $tuestartaftercboxoptions; ?></select></td>
		<td align="center"><select name="tueendafter"><?php echo $tueendaftercboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Wednesday:</b></td>
		<td align="center"><select name="wedstartmorning"><?php echo $wedstartmorningcboxoptions; ?></select></td>
		<td align="center"><select name="wedendmorning"><?php echo $wedendmorningcboxoptions; ?></select></td>
		<td align="center"><select name="wedstartafter"><?php echo $wedstartaftercboxoptions; ?></select></td>
		<td align="center"><select name="wedendafter"><?php echo $wedendaftercboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr class="alt">
		<td class="firstcol" align="left"><b>Thursday:</b></td>
		<td align="center"><select name="thustartmorning"><?php echo $thustartmorningcboxoptions; ?></select></td>
		<td align="center"><select name="thuendmorning"><?php echo $thuendmorningcboxoptions; ?></select></td>
		<td align="center"><select name="thustartafter"><?php echo $thustartaftercboxoptions; ?></select></td>
		<td align="center"><select name="thuendafter"><?php echo $thuendaftercboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Friday:</b></td>
		<td align="center"><select name="fristartmorning"><?php echo $fristartmorningcboxoptions; ?></select></td>
		<td align="center"><select name="friendmorning"><?php echo $friendmorningcboxoptions; ?></select></td>
		<td align="center"><select name="fristartafter"><?php echo $fristartaftercboxoptions; ?></select></td>
		<td align="center"><select name="friendafter"><?php echo $friendaftercboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr>
		<th align="left" ><b>Weekend Hours</b></th>
		<th align="center" colspan="2"><b>Start Time</b></th>
		<th align="center" colspan="2"><b>End Time</b></th>
		<th class="lastcol"></th>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Saturday:</b></td>
		<td align="center" colspan="2"><select name="satstartweekend"><?php echo $satstartweekendcboxoptions; ?></select></td>
		<td align="center" colspan="2"><select name="satendweekend"><?php echo $satendweekendcboxoptions; ?></select></td>
		<td class="lastcol"><a href="javascript:copyWeekendTimes();">Copy and paste first row</a></td>
	</tr>
	<tr class="alt">
		<td class="firstcol" align="left"><b>Sunday:</b></td>
		<td align="center" colspan="2"><select name="sunstartweekend"><?php echo $sunstartweekendcboxoptions; ?></select></td>
		<td align="center" colspan="2"><select name="sunendweekend"><?php echo $sunendweekendcboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
</table>
<br />
<b>Other Information:</b>
<ul>
	<li>These sites charge a fee? <input type="radio" name="charge" value="TRUE" <?php if ($charge=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="charge" value="FALSE" <?php if ($charge=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li><select name="costfrequency"><option value="NULL">--</option><option value="1" <?php if ($costfrequency==1) { echo 'selected="selected"'; }else{} ?>>Weekly</option><option value="2" <?php if ($costfrequency==2) { echo 'selected="selected"'; }else{} ?>>Monthly</option><option value="3" <?php if ($costfrequency==3) { echo 'selected="selected"'; }else{} ?>>Quarterly</option><option value="4" <?php if ($costfrequency==4) { echo 'selected="selected"'; }else{} ?>>Per School Semester</option><option value="5" <?php if ($costfrequency==5) { echo 'selected="selected"'; }else{} ?>>Annual</option><option value="6" <?php if ($costfrequency==6) { echo 'selected="selected"'; }else{} ?>>Summer</option></select> cost: <select name="costamount"><?php echo $costcboxoptions; ?></select></li>
	<li>Fee assistance available? <input type="radio" name="feeassistance" value="TRUE" <?php if ($feeassistance=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="feeassistance" value="FALSE" <?php if ($feeassistance=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Scholarships available? <input type="radio" name="scholarship" value="TRUE" <?php if ($scholarship=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="scholarship" value="FALSE" <?php if ($scholarship=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Accepts DES child care subsidy? <input type="radio" name="desassistance" value="TRUE" <?php if ($desassistance=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="desassistance" value="FALSE" <?php if ($desassistance=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Multiple child discount available? <input type="radio" name="mcdiscount" value="TRUE" <?php if ($mcdiscount=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="mcdiscount" value="FALSE" <?php if ($mcdiscount=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Other financial assistance available? <input type="radio" name="otherassistance" value="TRUE" <?php if ($otherassistance=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="otherassistance" value="FALSE" <?php if ($otherassistance=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Transportation provided? <input type="radio" name="transportation" value="TRUE" <?php if ($transportation=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="transportation" value="FALSE" <?php if ($transportation=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Snacks provided? <input type="radio" name="snacks" value="TRUE" <?php if ($snacks=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="snacks" value="FALSE" <?php if ($snacks=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Breakfast provided? <input type="radio" name="breakfast" value="TRUE" <?php if ($breakfast=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="breakfast" value="FALSE" <?php if ($breakfast=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Lunch provided? <input type="radio" name="lunch" value="TRUE" <?php if ($lunch=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="lunch" value="FALSE" <?php if ($lunch=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Dinner provided? <input type="radio" name="dinner" value="TRUE" <?php if ($dinner=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="dinner" value="FALSE" <?php if ($dinner=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>What percentage of your clientèle receive a free or reduced lunch at their school? <select name="freelunch"><?php echo $freelunchcboxoptions; ?></select></li>
	<li>Spanish spoken? <input type="radio" name="spanish" value="TRUE" <?php if ($spanish=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="spanish" value="FALSE" <?php if ($spanish=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	<li>Other languages spoken? <input type="radio" name="otherlanguage" value="TRUE" <?php if ($otherlanguage=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="otherlanguage" value="FALSE" <?php if ($otherlanguage=='f') { echo 'checked="checked"'; }else{} ?>> No</li>

</ul>
<br />
<input type="submit" name="button1" value="Save and Continue &#62;&#62;" />
</form>


<script type="text/javascript">

function copyWeekdayTimes() {
	document.editsites.tuestartmorning.value=document.editsites.monstartmorning.value;
	document.editsites.wedstartmorning.value=document.editsites.monstartmorning.value;
	document.editsites.thustartmorning.value=document.editsites.monstartmorning.value;
	document.editsites.fristartmorning.value=document.editsites.monstartmorning.value;

	document.editsites.tueendmorning.value=document.editsites.monendmorning.value;
	document.editsites.wedendmorning.value=document.editsites.monendmorning.value;
	document.editsites.thuendmorning.value=document.editsites.monendmorning.value;
	document.editsites.friendmorning.value=document.editsites.monendmorning.value;

	document.editsites.tuestartafter.value=document.editsites.monstartafter.value;
	document.editsites.wedstartafter.value=document.editsites.monstartafter.value;
	document.editsites.thustartafter.value=document.editsites.monstartafter.value;
	document.editsites.fristartafter.value=document.editsites.monstartafter.value;

	document.editsites.tueendafter.value=document.editsites.monendafter.value;
	document.editsites.wedendafter.value=document.editsites.monendafter.value;
	document.editsites.thuendafter.value=document.editsites.monendafter.value;
	document.editsites.friendafter.value=document.editsites.monendafter.value;
}

function copyWeekendTimes() {
	document.editsites.sunstartweekend.value=document.editsites.satstartweekend.value;
	document.editsites.sunendweekend.value=document.editsites.satendweekend.value;
}


</script>

<!--****Check all boxes****-->
<script src="js/CheckBoxGroup.js" type="text/javascript"></script>
<script type="text/javascript">
	var ageGroup = new CheckBoxGroup();
	ageGroup.addToGroup("age*");
	ageGroup.setControlBox("age");
	ageGroup.setMasterBehavior("all");
	var activityGroup = new CheckBoxGroup();
	activityGroup.addToGroup("activity*");
	activityGroup.setControlBox("activity");
	activityGroup.setMasterBehavior("all");

</script>






