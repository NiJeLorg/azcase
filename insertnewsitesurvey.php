<?php
// insert site survey info into the database
$insertsite = "INSERT INTO azcase_site_survey (\"siteid\", \"locationid\", \"updated\", \"capacity\", \"atcapacity\", \"served\", \"costsame\", \"slidescale\", \"otherassistancedescription\", \"transportcost\", \"fulltimestaff\", \"parttimestaff\", \"volunteerstaff\", \"workingstaff\", \"parentreferrals\", \"parenteducation\", \"parentinfo\", \"parentotherdescription\", \"africanamerican\", \"asianamerican\", \"latino\", \"nativeamerican\", \"white\", \"otherrace\", \"programtype\", \"budgetfederal\", \"budgetlocal\", \"budgetfees\", \"budgetgrant\", \"budgetreligious\", \"barriersfull\", \"barriersfulltext\", \"fingerprint\", \"drugtest\", \"backgroundcheck\", \"personalrefs\", \"othercheck\", \"prodevelop\", \"prodevelophours\", \"prodevelop_rankmost1\", \"prodevelop_rank2\", \"prodevelop_rank3\", \"prodevelop_rank4\", \"prodevelop_rankleast5\", \"training_ownstaff\", \"training_aascc\", \"training_azcase\", \"training_azdhs\", \"training_naa\", \"training_niost\", \"training_shd\", \"training_other\", \"training_needs\", \"training_needsother\", \"training_needssecond\", \"training_needssecond_other\", \"evaluate_program\", \"evaluate_type\", \"youth_planactivity\", \"youth_makerules\", \"collab_school\", \"collab_schoolfreq\") VALUES ($siteid, $locationid, '$updated', $capacity, $atcapacity, $served, $costsame, $slidescale, '$otherassistancedescription', $transportcost, $fulltimestaff, $parttimestaff, $volunteerstaff, $workingstaff, $parentreferrals, $parenteducation, $parentinfo, '$parentotherdescription', $africanamerican, $asianamerican, $latino, $nativeamerican, $white, $otherrace, $programtype, $budgetfederal, $budgetlocal, $budgetfees, $budgetgrant, $budgetreligious, $barriersfull, '$barriersfulltext', $fingerprint, $drugtest, $backgroundcheck, $personalrefs, $othercheck, $prodevelop, $prodevelophours, $prodevelop_rankmost1, $prodevelop_rank2, $prodevelop_rank3, $prodevelop_rank4, $prodevelop_rankleast5, $training_ownstaff, $training_aascc, $training_azcase, $training_azdhs, $training_naa, $training_niost, $training_shd, '$training_other', $training_needs, '$training_needsother', $training_needssecond, '$training_needssecond_other', $evaluate_program, $evaluate_type, $youth_planactivity, $youth_makerules, $collab_school, $collab_schoolfreq);";
	pg_send_query($connection, $insertsite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsitesurvey.php Failed";
		$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewsitesurvey.php\nFailed Query: $insertsite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}
?>
