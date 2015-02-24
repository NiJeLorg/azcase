<?php
// insert new sites into database and connect site to users and locations

// add site if required values are present
if (!$sitename || !$locationid) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"siteid_old\", \"summer\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename', '$sitenamesp', '$phone', '$fax', '$email', TRUE, '$url', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $siteid_old, $summer, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processeditbatchsites.php Failed";
		$message = "User:" . $_SESSION['useremail'] . "\nPage: processeditbatchsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt2 = 0; $lt2 < pg_numrows($record); $lt2++) {
		    $siteid = pg_result($record, $lt2, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processeditbatchsites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processeditbatchsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt3 = 0; $lt3 < pg_numrows($pullusersrecord); $lt3++) {
		    $insertuserid = pg_result($pullusersrecord, $lt3, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processeditbatchsites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processeditbatchsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

		// set old site to verified = 3 - purgatory!
		$updatesiteid = "UPDATE azcase_sites SET verified = 3 WHERE siteid = $siteid_old;";
		// do this silently
		pg_send_query($connection, $updatesiteid);

		// replicate the site survey data for this new site id
		// check to see if site survey data exists - if not skip
		$countquery = "SELECT count(*) FROM azcase_site_survey WHERE siteid = $siteid_old AND locationid = $locationid;";
		$countresult = pg_query($connection, $countquery);
		$countsite = pg_result($countresult, 0, 0);
		if ($countsite==0) {
		}else{
			$insertsitesurvey = "INSERT INTO azcase_site_survey (locationid, siteid, updated, capacity, atcapacity, served, costsame, slidescale, otherassistancedescription, transportcost, fulltimestaff, parttimestaff, volunteerstaff, workingstaff, parentreferrals, parenteducation, parentinfo, parentotherdescription, africanamerican, asianamerican, white, latino, nativeamerican, otherrace, programtype, budgetfederal, budgetlocal, budgetfees, budgetgrant, budgetreligious, barriersfull, barriersfulltext, fingerprint, drugtest, backgroundcheck, personalrefs, othercheck, prodevelop, prodevelophours, prodevelop_rankmost1, prodevelop_rank2, prodevelop_rank3, prodevelop_rank4, prodevelop_rankleast5, training_ownstaff, training_aascc, training_azcase, training_azdhs, training_naa, training_niost, training_shd, training_other, training_needs, training_needsother, training_needssecond, training_needssecond_other, evaluate_program, evaluate_type, youth_planactivity, youth_makerules, collab_school, collab_schoolfreq) SELECT locationid, currval('azcase_sites_siteid_seq'::regclass), updated, capacity, atcapacity, served, costsame, slidescale, otherassistancedescription, transportcost, fulltimestaff, parttimestaff, volunteerstaff, workingstaff, parentreferrals, parenteducation, parentinfo, parentotherdescription, africanamerican, asianamerican, white, latino, nativeamerican, otherrace, programtype, budgetfederal, budgetlocal, budgetfees, budgetgrant, budgetreligious, barriersfull, barriersfulltext, fingerprint, drugtest, backgroundcheck, personalrefs, othercheck, prodevelop, prodevelophours, prodevelop_rankmost1, prodevelop_rank2, prodevelop_rank3, prodevelop_rank4, prodevelop_rankleast5, training_ownstaff, training_aascc, training_azcase, training_azdhs, training_naa, training_niost, training_shd, training_other, training_needs, training_needsother, training_needssecond, training_needssecond_other, evaluate_program, evaluate_type, youth_planactivity, youth_makerules, collab_school, collab_schoolfreq FROM azcase_site_survey WHERE siteid = $siteid_old AND locationid = $locationid;";
			pg_send_query($connection, $insertsitesurvey);
			$res1 = pg_get_result($connection);
			$pgerror1 = pg_result_error($res1);
			if ($pgerror1!=FALSE) {
				require('header.php');
				echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
				require('footer.php');
				$to = "jd@nijel.org";
				$subject = "AZ Afterschool Program Directory Error: processeditbatchsites.php Failed";
				$message = "User:" . $_SESSION['useremail'] . "\nPage: processeditbatchsites.php\nFailed Query: $insertsitesurvey\nError: $pgerror1";
				mail($to,$subject,$message);
				die ();
			}else{}

		} // close if ($countsite==0)


} // close if (!$sitename || !$locationid)

