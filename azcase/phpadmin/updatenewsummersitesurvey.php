<?php
// insert site survey info into the database
$updatesite = "UPDATE azcase_site_survey SET \"updated\" = '$updated', \"capacity\" = $capacity, \"atcapacity\" = $atcapacity, \"served\" = $served, \"costsame\" = $costsame, \"slidescale\" = $slidescale, \"otherassistancedescription\" = '$otherassistancedescription', \"transportcost\" = $transportcost, \"fulltimestaff\" = $fulltimestaff, \"parttimestaff\" = $parttimestaff, \"volunteerstaff\" = $volunteerstaff, \"workingstaff\" = $workingstaff, \"parentreferrals\" = $parentreferrals, \"parenteducation\" = $parenteducation, \"parentinfo\" = $parentinfo, \"parentotherdescription\" = '$parentotherdescription', \"africanamerican\" = $africanamerican, \"asianamerican\" = $asianamerican, \"latino\" = $latino, \"nativeamerican\" = $nativeamerican, \"white\" = $white, \"otherrace\" = $otherrace, \"programtype\" = $programtype, \"budgetfederal\" = $budgetfederal, \"budgetlocal\" = $budgetlocal, \"budgetfees\" = $budgetfees, \"budgetgrant\" = $budgetgrant, \"budgetreligious\" = $budgetreligious, \"barriersfull\" = $barriersfull, \"barriersfulltext\" = '$barriersfulltext', \"fingerprint\" = $fingerprint, \"drugtest\" = $drugtest, \"backgroundcheck\" = $backgroundcheck, \"personalrefs\" = $personalrefs, \"othercheck\" = $othercheck, \"prodevelop\" = $prodevelop, \"prodevelophours\" = $prodevelophours, \"prodevelop_rankmost1\" = $prodevelop_rankmost1, \"prodevelop_rank2\" = $prodevelop_rank2, \"prodevelop_rank3\" = $prodevelop_rank3, \"prodevelop_rank4\" = $prodevelop_rank4, \"prodevelop_rankleast5\" = $prodevelop_rankleast5, \"training_ownstaff\" = $training_ownstaff, \"training_aascc\" = $training_aascc, \"training_azcase\" = $training_azcase, \"training_azdhs\" = $training_azdhs, \"training_naa\" = $training_naa, \"training_niost\" = $training_niost, \"training_shd\" = $training_shd, \"training_other\" = '$training_other', \"training_needs\" = $training_needs, \"training_needsother\" = '$training_needsother', \"training_needssecond\" = $training_needssecond, \"training_needssecond_other\" = '$training_needssecond_other', \"evaluate_program\" = $evaluate_program, \"evaluate_type\" = $evaluate_type, \"youth_planactivity\" = $youth_planactivity, \"youth_makerules\" = $youth_makerules, \"collab_school\" = $collab_school, \"collab_schoolfreq\" = $collab_schoolfreq WHERE siteid = $siteid AND locationid = $locationid;";
	pg_send_query($connection, $updatesite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsummersitesurvey.php Failed";
		$message = "\nPage: processnewsummersitesurvey.php\nFailed Query: $updatesite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}
?>
