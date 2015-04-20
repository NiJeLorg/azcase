<?php
// insert new sites into database and connect site to users and locations
global $connection;

// add site1 if required values are present
if (!$sitename1 || !$locationid1) {
	require('header.php');
	echo "<h3>Please Enter Data for a Site</h3><p>You did not enter any data on your sites on the last page. Please go back and add try again. Thanks! </p>";
	require('footer.php');
	die ();
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename1', '$sitenamesp1', '$phone1', '$fax1', '$email1', TRUE, '$url1', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid1);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo $insertthissiteuser;
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop


} // close if (!$sitename1 || !$locationid1)

// add site1 if required values are present
if (!$sitename2 || !$locationid2) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename2', '$sitenamesp2', '$phone2', '$fax2', '$email2', TRUE, '$url2', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid2);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename2 || !$locationid2)

// add site1 if required values are present
if (!$sitename3 || !$locationid3) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename3', '$sitenamesp3', '$phone3', '$fax3', '$email3', TRUE, '$url3', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid3);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename3 || !$locationid3)

// add site1 if required values are present
if (!$sitename4 || !$locationid4) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename4', '$sitenamesp4', '$phone4', '$fax4', '$email4', TRUE, '$url4', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid4);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename4 || !$locationid4)

// add site1 if required values are present
if (!$sitename5 || !$locationid5) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename5', '$sitenamesp5', '$phone5', '$fax5', '$email5', TRUE, '$url5', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid5);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename5 || !$locationid5)

// add site1 if required values are present
if (!$sitename6 || !$locationid6) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename6', '$sitenamesp6', '$phone6', '$fax6', '$email6', TRUE, '$url6', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid6);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename6 || !$locationid6)

// add site1 if required values are present
if (!$sitename7 || !$locationid7) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename7', '$sitenamesp7', '$phone7', '$fax7', '$email7', TRUE, '$url7', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid7);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename7 || !$locationid7)

// add site1 if required values are present
if (!$sitename8 || !$locationid8) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename8', '$sitenamesp8', '$phone8', '$fax8', '$email8', TRUE, '$url8', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid8);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename8 || !$locationid8)

// add site1 if required values are present
if (!$sitename9 || !$locationid9) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename9', '$sitenamesp9', '$phone9', '$fax9', '$email9', TRUE, '$url9', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid9);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename9 || !$locationid9)

// add site1 if required values are present
if (!$sitename10 || !$locationid10) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename10', '$sitenamesp10', '$phone10', '$fax10', '$email10', TRUE, '$url10', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid10);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename10 || !$locationid10)

// add site1 if required values are present
if (!$sitename11 || !$locationid11) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename11', '$sitenamesp11', '$phone11', '$fax11', '$email11', TRUE, '$url11', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid11);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename11 || !$locationid11)

// add site1 if required values are present
if (!$sitename12 || !$locationid12) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename12', '$sitenamesp12', '$phone12', '$fax12', '$email12', TRUE, '$url12', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid12);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename12 || !$locationid12)

// add site1 if required values are present
if (!$sitename13 || !$locationid13) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename13', '$sitenamesp13', '$phone13', '$fax13', '$email13', TRUE, '$url13', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid13);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename13 || !$locationid13)

// add site1 if required values are present
if (!$sitename14 || !$locationid14) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename14', '$sitenamesp14', '$phone14', '$fax14', '$email14', TRUE, '$url14', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid14);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename14 || !$locationid14)

// add site1 if required values are present
if (!$sitename15 || !$locationid15) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename15', '$sitenamesp15', '$phone15', '$fax15', '$email15', TRUE, '$url15', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid15);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename15 || !$locationid15)

// add site1 if required values are present
if (!$sitename16 || !$locationid16) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename16', '$sitenamesp16', '$phone16', '$fax16', '$email16', TRUE, '$url16', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid16);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename16 || !$locationid16)

// add site1 if required values are present
if (!$sitename17 || !$locationid17) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename17', '$sitenamesp17', '$phone17', '$fax17', '$email17', TRUE, '$url17', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid17);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename17 || !$locationid17)

// add site1 if required values are present
if (!$sitename18 || !$locationid18) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename18', '$sitenamesp18', '$phone18', '$fax18', '$email18', TRUE, '$url18', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid18);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename18 || !$locationid18)

// add site1 if required values are present
if (!$sitename19 || !$locationid19) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename19', '$sitenamesp19', '$phone19', '$fax19', '$email19', TRUE, '$url19', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid19);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename19 || !$locationid19)

// add site1 if required values are present
if (!$sitename20 || !$locationid20) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename20', '$sitenamesp20', '$phone20', '$fax20', '$email20', TRUE, '$url20', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid20);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename20 || !$locationid20)

// add site1 if required values are present
if (!$sitename21 || !$locationid21) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename21', '$sitenamesp21', '$phone21', '$fax21', '$email21', TRUE, '$url21', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid21);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename21 || !$locationid21)

// add site1 if required values are present
if (!$sitename22 || !$locationid22) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename22', '$sitenamesp22', '$phone22', '$fax22', '$email22', TRUE, '$url22', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid22);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename22 || !$locationid22)

// add site1 if required values are present
if (!$sitename23 || !$locationid23) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename23', '$sitenamesp23', '$phone23', '$fax23', '$email23', TRUE, '$url23', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid23);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename23 || !$locationid23)

// add site1 if required values are present
if (!$sitename24 || !$locationid24) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename24', '$sitenamesp24', '$phone24', '$fax24', '$email24', TRUE, '$url24', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid24);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename24 || !$locationid24)

// add site1 if required values are present
if (!$sitename25 || !$locationid25) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename25', '$sitenamesp25', '$phone25', '$fax25', '$email25', TRUE, '$url25', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid25);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename25 || !$locationid25)

// add site1 if required values are present
if (!$sitename26 || !$locationid26) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename26', '$sitenamesp26', '$phone26', '$fax26', '$email26', TRUE, '$url26', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid26);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename26 || !$locationid26)

// add site1 if required values are present
if (!$sitename27 || !$locationid27) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename27', '$sitenamesp27', '$phone27', '$fax27', '$email27', TRUE, '$url27', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid27);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename27 || !$locationid27)

// add site1 if required values are present
if (!$sitename28 || !$locationid28) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename28', '$sitenamesp28', '$phone28', '$fax28', '$email28', TRUE, '$url28', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid28);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename28 || !$locationid28)

// add site1 if required values are present
if (!$sitename29 || !$locationid29) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename29', '$sitenamesp29', '$phone29', '$fax29', '$email29', TRUE, '$url29', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid29);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename29 || !$locationid29)

// add site1 if required values are present
if (!$sitename30 || !$locationid30) {
}else{ 

	// insert site into the database and connect it to this user
	$insertsite = "INSERT INTO azcase_sites (\"siteid\", \"updated\", \"name\", \"namesp\", \"phone\", \"fax\", \"email\", \"pubemail\", \"url\", \"age5\", \"age6\", \"age7\", \"age8\", \"age9\", \"age10\", \"age11\", \"age12\", \"age13\", \"age14\", \"age15\", \"age16\", \"age17\", \"age18\", \"arts\", \"character\", \"leadership\", \"mentoring\", \"nutrition\", \"prevention\", \"sports\", \"supportservices\", \"academic\", \"community\", \"monstartmorning\", \"tuestartmorning\", \"wedstartmorning\", \"thustartmorning\", \"fristartmorning\", \"monendmorning\", \"tueendmorning\", \"wedendmorning\", \"thuendmorning\", \"friendmorning\", \"monstartafter\", \"tuestartafter\", \"wedstartafter\", \"thustartafter\", \"fristartafter\", \"monendafter\", \"tueendafter\", \"wedendafter\", \"thuendafter\", \"friendafter\", \"satstartweekend\", \"satendweekend\", \"sunstartweekend\", \"sunendweekend\", \"charge\", \"costfrequency\", \"costamount\", \"feeassistance\", \"scholarship\", \"desassistance\", \"mcdiscount\", \"otherassistance\", \"transportation\", \"snacks\", \"breakfast\", \"lunch\", \"dinner\", \"freelunch\", \"spanish\", \"otherlanguage\", \"verified\", \"stem\", \"college\") VALUES (DEFAULT, '$updated', '$sitename30', '$sitenamesp30', '$phone30', '$fax30', '$email30', TRUE, '$url30', $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12, $age13, $age14, $age15, $age16, $age17, $age18, $arts, $character, $leadership, $mentoring, $nutrition, $prevention, $sports, $supportservices, $academic, $community, '$monstartmorning', '$tuestartmorning', '$wedstartmorning', '$thustartmorning', '$fristartmorning', '$monendmorning', '$tueendmorning', '$wedendmorning', '$thuendmorning', '$friendmorning', '$monstartafter', '$tuestartafter', '$wedstartafter', '$thustartafter', '$fristartafter', '$monendafter', '$tueendafter', '$wedendafter', '$thuendafter', '$friendafter', '$satstartweekend', '$satendweekend', '$sunstartweekend', '$sunendweekend', $charge, $costfrequency, $costamount, $feeassistance, $scholarship, $desassistance, $mcdiscount, $otherassistance, $transportation, $snacks, $breakfast, $lunch, $dinner, $freelunch, $spanish, $otherlanguage, 2, $stem, $college);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
		$message = "\nPage: processnewsites.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// link site to location
		// pull siteid just assigned
		$siteidquery = "SELECT last_value FROM azcase_sites_siteid_seq;";
		$record = pg_query($connection, $siteidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $siteid = pg_result($record, $lt, 0);
		  }
		
		// insert new site to site/location table
		$insertsiteloc = "INSERT INTO azcase_sites_locations_junction (\"siteid\", \"locationid\") VALUES ($siteid, $locationid30);";
		pg_send_query($connection, $insertsiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// insert this user, then any linked users
		$insertthissiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($userid, $siteid, TRUE);";
		pg_send_query($connection, $insertthissiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertthissiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link site to all users that are allowed to edit these sites and assign this as an newly added site
		$pullusersquery = "SELECT userid FROM azcase_users WHERE userid <> $userid AND userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid));";
		$pullusersrecord = pg_query($connection, $pullusersquery);
		for ($lt = 0; $lt < pg_numrows($pullusersrecord); $lt++) {
		    $insertuserid = pg_result($pullusersrecord, $lt, 0);

		$insertsiteuser = "INSERT INTO azcase_user_sites_junction (\"userid\", \"siteid\", \"newsite\") VALUES ($insertuserid, $siteid, TRUE);";
		pg_send_query($connection, $insertsiteuser);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewsites.php Failed";
			$message = "\nPage: processnewsites.php\nFailed Query: $insertsiteuser\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		} // close userid loop

} // close if (!$sitename30 || !$locationid30)





