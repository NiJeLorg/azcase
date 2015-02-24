<?php
// insert new sites into database and connect site to users and locations

// add site1 if required values are present
if (!$sitename || !$locationid) {
}else{ 

	// update site information in database
	$updatesite = "UPDATE azcase_sites SET \"updated\" = '$updated', \"name\" = '$sitename', \"namesp\" = '$sitenamesp', \"phone\" = '$phone', \"fax\" = '$fax', \"email\" = '$email', \"pubemail\" = TRUE, \"url\" = '$url', \"age5\" = $age5, \"age6\" = $age6, \"age7\" = $age7, \"age8\" = $age8, \"age9\" = $age9, \"age10\" = $age10, \"age11\" = $age11, \"age12\" = $age12, \"age13\" = $age13, \"age14\" = $age14, \"age15\" = $age15, \"age16\" = $age16, \"age17\" = $age17, \"age18\" = $age18, \"arts\" = $arts, \"character\" = $character, \"leadership\" = $leadership, \"mentoring\" = $mentoring, \"nutrition\" = $nutrition, \"prevention\" = $prevention, \"sports\" = $sports, \"supportservices\" = $supportservices, \"academic\" = $academic, \"community\" = $community, \"monstartmorning\" = '$monstartmorning', \"tuestartmorning\" = '$tuestartmorning', \"wedstartmorning\" = '$wedstartmorning', \"thustartmorning\" = '$thustartmorning', \"fristartmorning\" = '$fristartmorning', \"monendmorning\" = '$monendmorning', \"tueendmorning\" = '$tueendmorning', \"wedendmorning\" = '$wedendmorning', \"thuendmorning\" = '$thuendmorning', \"friendmorning\" = '$friendmorning', \"monstartafter\" = '$monstartafter', \"tuestartafter\" = '$tuestartafter', \"wedstartafter\" = '$wedstartafter', \"thustartafter\" = '$thustartafter', \"fristartafter\" = '$fristartafter', \"monendafter\" = '$monendafter', \"tueendafter\" = '$tueendafter', \"wedendafter\" = '$wedendafter', \"thuendafter\" = '$thuendafter', \"friendafter\" = '$friendafter', \"satstartweekend\" = '$satstartweekend', \"satendweekend\" = '$satendweekend', \"sunstartweekend\" = '$sunstartweekend', \"sunendweekend\" = '$sunendweekend', \"charge\" = $charge, \"costfrequency\" = $costfrequency, \"costamount\" = $costamount, \"feeassistance\" = $feeassistance, \"scholarship\" = $scholarship, \"desassistance\" = $desassistance, \"mcdiscount\" = $mcdiscount, \"otherassistance\" = $otherassistance, \"transportation\" = $transportation, \"snacks\" = $snacks, \"breakfast\" = $breakfast, \"lunch\" = $lunch, \"dinner\" = $dinner, \"freelunch\" = $freelunch, \"spanish\" = $spanish, \"otherlanguage\" = $otherlanguage, \"stem\" = $stem, \"college\" = $college WHERE siteid = $siteid";
	pg_send_query($connection, $updatesite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h1>Save Error</h1><p>An error occured when you attempted to edit this site. An email was sent to NiJeL and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processadmineditsites.php Failed";
		$message = "User:" . $_SESSION['useremail'] . "\nPage: processadmineditsites.php\nFailed Query: $updatesite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

		// update site / location junction
		$updatesiteloc = "UPDATE azcase_sites_locations_junction SET \"locationid\" = $locationid WHERE siteid = $siteid;";
		pg_send_query($connection, $updatesiteloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to edit a site. An email was sent NiJeL and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processadmineditsites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processadmineditsites.php\nFailed Query: $updatesiteloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

} // close if (!$sitename || !$locationid)

