<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// connect to database
require("connect.php");

// login to the system
require('login.php');

// processing login script
//displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// pull userid for ease of use later
$useremailsession = pg_escape_string($_SESSION['useremail']);
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

// loop through each new site and assign summer = TRUE, summer = FALSE or assign and create new record
// select all siteids from this user that a new
$siteidquery = "SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid AND newsite = TRUE ORDER BY siteid;";
$siteidresult = pg_query($connection, $siteidquery);
for ($lt1 = 0; $lt1 < pg_numrows($siteidresult); $lt1++) {
	$siteid = pg_result($siteidresult, $lt1, 0);
	$summerrequest = 1; // default value if now value is selected on last page
	$summerrequest = $_REQUEST["$siteid"]; 

	if ($summerrequest==1) {
		//update site to set summer = FALSE and set newsite in junction table to FALSE
		$updatesite = "UPDATE azcase_sites SET summer = FALSE WHERE siteid = $siteid;";
		pg_send_query($connection, $updatesite);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $updatesite\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		$updatesitejunc = "UPDATE azcase_user_sites_junction SET newsite = FALSE WHERE siteid = $siteid;";
		pg_send_query($connection, $updatesitejunc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $updatesitejunc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

	}elseif ($summerrequest==2) {
		//update site to set summer = TRUE and set newsite in junction table to FALSE
		$updatesite = "UPDATE azcase_sites SET summer = TRUE WHERE siteid = $siteid;";
		pg_send_query($connection, $updatesite);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $updatesite\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		$updatesitejunc = "UPDATE azcase_user_sites_junction SET newsite = FALSE WHERE siteid = $siteid;";
		pg_send_query($connection, $updatesitejunc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $updatesitejunc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}


	}elseif ($summerrequest==3) {
		// first, insert a copy of record into sites table
		$insertsite = "INSERT INTO azcase_sites (siteid, updated, name, namesp, phone, fax, email, pubemail, url, age5, age6, age7, age8, age9, age10, age11, age12, age13, age14, age15, age16, age17, age18, arts, character, leadership, mentoring, nutrition, prevention, sports, supportservices, academic, community, monstartmorning, tuestartmorning, wedstartmorning, thustartmorning, fristartmorning, monendmorning, tueendmorning, wedendmorning, thuendmorning, friendmorning, monstartafter, tuestartafter, wedstartafter, thustartafter, fristartafter, monendafter, tueendafter, wedendafter, thuendafter, friendafter, satstartweekend, sunstartweekend, satendweekend, sunendweekend, charge, costfrequency, costamount, feeassistance, desassistance, scholarship, mcdiscount, otherassistance, transportation, snacks, breakfast, lunch, dinner, freelunch, spanish, otherlanguage, verified, stem, college) SELECT nextval('azcase_sites_siteid_seq'::regclass), updated, name, namesp, phone, fax, email, pubemail, url, age5, age6, age7, age8, age9, age10, age11, age12, age13, age14, age15, age16, age17, age18, arts, character, leadership, mentoring, nutrition, prevention, sports, supportservices, academic, community, monstartmorning, tuestartmorning, wedstartmorning, thustartmorning, fristartmorning, monendmorning, tueendmorning, wedendmorning, thuendmorning, friendmorning, monstartafter, tuestartafter, wedstartafter, thustartafter, fristartafter, monendafter, tueendafter, wedendafter, thuendafter, friendafter, satstartweekend, sunstartweekend, satendweekend, sunendweekend, charge, costfrequency, costamount, feeassistance, desassistance, scholarship, mcdiscount, otherassistance, transportation, snacks, breakfast, lunch, dinner, freelunch, spanish, otherlanguage, verified, stem, college FROM azcase_sites WHERE siteid = $siteid;";
		pg_send_query($connection, $insertsite);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $insertsite\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// next copy over site survey data
		// get newly inserted site id for use here and later
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteidlastvalue = pg_result($record, $lt, 0);
		  }

		// pull location id for original site for use here and later
		$locationidquery = "SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteid;";
		$record = pg_query($connection, $locationidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $locationid = pg_result($record, $lt, 0);
		  }

		// copy site survey data
		// check to see if site survey data exists - if not skip
		$countquery = "SELECT count(*) FROM azcase_site_survey WHERE siteid = $siteid AND locationid = $locationid;";
		$countresult = pg_query($connection, $countquery);
		$countsite = pg_result($countresult, 0, 0);
		if ($countsite==0) {
		}else{
			$insertsitesurvey = "INSERT INTO azcase_site_survey (locationid, siteid, updated, capacity, atcapacity, served, costsame, slidescale, otherassistancedescription, transportcost, fulltimestaff, parttimestaff, volunteerstaff, workingstaff, parentreferrals, parenteducation, parentinfo, parentotherdescription, africanamerican, asianamerican, white, latino, nativeamerican, otherrace, programtype, budgetfederal, budgetlocal, budgetfees, budgetgrant, budgetreligious, barriersfull, barriersfulltext, fingerprint, drugtest, backgroundcheck, personalrefs, othercheck, prodevelop, prodevelophours, prodevelop_rankmost1, prodevelop_rank2, prodevelop_rank3, prodevelop_rank4, prodevelop_rankleast5, training_ownstaff, training_aascc, training_azcase, training_azdhs, training_naa, training_niost, training_shd, training_other, training_needs, training_needsother, training_needssecond, training_needssecond_other, evaluate_program, evaluate_type, youth_planactivity, youth_makerules, collab_school, collab_schoolfreq) SELECT locationid, currval('azcase_sites_siteid_seq'::regclass), updated, capacity, atcapacity, served, costsame, slidescale, otherassistancedescription, transportcost, fulltimestaff, parttimestaff, volunteerstaff, workingstaff, parentreferrals, parenteducation, parentinfo, parentotherdescription, africanamerican, asianamerican, white, latino, nativeamerican, otherrace, programtype, budgetfederal, budgetlocal, budgetfees, budgetgrant, budgetreligious, barriersfull, barriersfulltext, fingerprint, drugtest, backgroundcheck, personalrefs, othercheck, prodevelop, prodevelophours, prodevelop_rankmost1, prodevelop_rank2, prodevelop_rank3, prodevelop_rank4, prodevelop_rankleast5, training_ownstaff, training_aascc, training_azcase, training_azdhs, training_naa, training_niost, training_shd, training_other, training_needs, training_needsother, training_needssecond, training_needssecond_other, evaluate_program, evaluate_type, youth_planactivity, youth_makerules, collab_school, collab_schoolfreq FROM azcase_site_survey WHERE siteid = $siteid AND locationid = $locationid;";
			pg_send_query($connection, $insertsitesurvey);
			$res1 = pg_get_result($connection);
			$pgerror1 = pg_result_error($res1);
			if ($pgerror1!=FALSE) {
				require('header.php');
				echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
				require('footer.php');
				$to = "jd@nijel.org";
				$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
				$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $insertsitesurvey\nError: $pgerror1";
				mail($to,$subject,$message);
				die ();
			}else{}

		} // close if ($countsite==0)

		// next, insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteidlastvalue, $locationid);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// next set first site to summer = FLASE
		$updatesite = "UPDATE azcase_sites SET summer = FALSE WHERE siteid = $siteid;";
		pg_send_query($connection, $updatesite);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $updatesite\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// next set the second site to summer = TRUE
		$updatesite = "UPDATE azcase_sites SET summer = TRUE WHERE siteid = $siteidlastvalue;";
		pg_send_query($connection, $updatesite);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $updatesite\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// finally, add new association between all affilated users and new summer site
		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteidlastvalue, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processsummersites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processsummersites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

	} // close summerrequest

} // close siteid loop



// close logged_in
}else{}


header("Location: http://maps.nijel.org/azcase/newsummersites.php");
?>

