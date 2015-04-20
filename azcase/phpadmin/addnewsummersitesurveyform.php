<?php
// create the add new site survey form

// pull data for siteid locationid
$sitesurveyquery = "SELECT capacity, atcapacity, served, costsame, slidescale, otherassistancedescription, transportcost, fulltimestaff, parttimestaff, volunteerstaff, workingstaff, parentreferrals, parenteducation, parentinfo, parentotherdescription, africanamerican, asianamerican, white, latino, nativeamerican, otherrace, programtype, budgetfederal, budgetlocal, budgetfees, budgetgrant, budgetreligious, barriersfull, barriersfulltext, fingerprint, drugtest, backgroundcheck, personalrefs, othercheck, prodevelop, prodevelophours, prodevelop_rankmost1, prodevelop_rank2, prodevelop_rank3, prodevelop_rank4, prodevelop_rankleast5, training_ownstaff, training_aascc, training_azcase, training_azdhs, training_naa, training_niost, training_shd, training_other, training_needs, training_needsother, training_needssecond, training_needssecond_other, evaluate_program, evaluate_type, youth_planactivity, youth_makerules, collab_school, collab_schoolfreq FROM azcase_site_survey WHERE siteid = $siteid AND locationid = $locationid;";
$sitesurveyresult = pg_query($connection, $sitesurveyquery);
for ($lt = 0; $lt < pg_numrows($sitesurveyresult); $lt++) {
	$capacity = pg_result($sitesurveyresult, $lt, 0);
	$atcapacity = pg_result($sitesurveyresult, $lt, 1);
	$served = pg_result($sitesurveyresult, $lt, 2);
	$costsame = pg_result($sitesurveyresult, $lt, 3);
	$slidescale = pg_result($sitesurveyresult, $lt, 4);
	$otherassistancedescription = pg_result($sitesurveyresult, $lt, 5);
	$transportcost = pg_result($sitesurveyresult, $lt, 6);
	$fulltimestaff = pg_result($sitesurveyresult, $lt, 7);
	$parttimestaff = pg_result($sitesurveyresult, $lt, 8);
	$volunteerstaff = pg_result($sitesurveyresult, $lt, 9);
	$workingstaff = pg_result($sitesurveyresult, $lt, 10);
	$parentreferrals = pg_result($sitesurveyresult, $lt, 11);
	$parenteducation = pg_result($sitesurveyresult, $lt, 12);
	$parentinfo = pg_result($sitesurveyresult, $lt, 13);
	$parentotherdescription = pg_result($sitesurveyresult, $lt, 14);
	$africanamerican = pg_result($sitesurveyresult, $lt, 15);
	$asianamerican = pg_result($sitesurveyresult, $lt, 16);
	$white = pg_result($sitesurveyresult, $lt, 17);
	$latino = pg_result($sitesurveyresult, $lt, 18);
	$nativeamerican = pg_result($sitesurveyresult, $lt, 19);
	$otherrace = pg_result($sitesurveyresult, $lt, 20);
	$programtype = pg_result($sitesurveyresult, $lt, 21);
	$budgetfederal = pg_result($sitesurveyresult, $lt, 22);
	$budgetlocal = pg_result($sitesurveyresult, $lt, 23);
	$budgetfees = pg_result($sitesurveyresult, $lt, 24);
	$budgetgrant = pg_result($sitesurveyresult, $lt, 25);
	$budgetreligious = pg_result($sitesurveyresult, $lt, 26);
	$barriersfull = pg_result($sitesurveyresult, $lt, 27);
	$barriersfulltext = pg_result($sitesurveyresult, $lt, 28);
	$fingerprint = pg_result($sitesurveyresult, $lt, 29);
	$drugtest = pg_result($sitesurveyresult, $lt, 30);
	$backgroundcheck = pg_result($sitesurveyresult, $lt, 31);
	$personalrefs = pg_result($sitesurveyresult, $lt, 32);
	$othercheck = pg_result($sitesurveyresult, $lt, 33);
	$prodevelop = pg_result($sitesurveyresult, $lt, 34);
	$prodevelophours = pg_result($sitesurveyresult, $lt, 35);
	$prodevelop_rankmost1 = pg_result($sitesurveyresult, $lt, 36);
	$prodevelop_rank2 = pg_result($sitesurveyresult, $lt, 37);
	$prodevelop_rank3 = pg_result($sitesurveyresult, $lt, 38);
	$prodevelop_rank4 = pg_result($sitesurveyresult, $lt, 39);
	$prodevelop_rankleast5 = pg_result($sitesurveyresult, $lt, 40);
	$training_ownstaff = pg_result($sitesurveyresult, $lt, 41);
	$training_aascc = pg_result($sitesurveyresult, $lt, 42);
	$training_azcase = pg_result($sitesurveyresult, $lt, 43);
	$training_azdhs = pg_result($sitesurveyresult, $lt, 44);
	$training_naa = pg_result($sitesurveyresult, $lt, 45);
	$training_niost = pg_result($sitesurveyresult, $lt, 46);
	$training_shd = pg_result($sitesurveyresult, $lt, 47);
	$training_other = pg_result($sitesurveyresult, $lt, 48);
	$training_needs = pg_result($sitesurveyresult, $lt, 49);
	$training_needsother = pg_result($sitesurveyresult, $lt, 50);
	$training_needssecond = pg_result($sitesurveyresult, $lt, 51);
	$training_needssecond_other = pg_result($sitesurveyresult, $lt, 52);
	$evaluate_program = pg_result($sitesurveyresult, $lt, 53);
	$evaluate_type = pg_result($sitesurveyresult, $lt, 54);
	$youth_planactivity = pg_result($sitesurveyresult, $lt, 55);
	$youth_makerules = pg_result($sitesurveyresult, $lt, 56);
	$collab_school = pg_result($sitesurveyresult, $lt, 57);
	$collab_schoolfreq = pg_result($sitesurveyresult, $lt, 58);
}

// create capacity combo box
$i = 1;
$capacity = number_format($capacity, 0, '', '');
$capacitycboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 1000) {
	$capacitynum = number_format($i);
	if ($capacity==$i) {
		$capacitycboxoptions .= "<option value=\"$i\" selected=\"selected\">$capacitynum</option>";
	}else{
		$capacitycboxoptions .= "<option value=\"$i\">$capacitynum</option>";
	}
	$i++; 
}

// create served combo box
$i = 1;
$served = number_format($served, 0, '', '');
$servedcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 1000) {
	$servednum = number_format($i);
	if ($served==$i) {
		$servedcboxoptions .= "<option value=\"$i\" selected=\"selected\">$servednum</option>";
	}else{
		$servedcboxoptions .= "<option value=\"$i\">$servednum</option>";
	}
	$i++; 
}



// create transport cost combo box
$i = 0;
$transportcost = number_format($transportcost, 0, '', '');
$transportcostcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 1000) {
	$transportcostnum = '$' . number_format($i);
	if ($transportcost==$i) {
		$transportcostcboxoptions .= "<option value=\"$i\" selected=\"selected\">$transportcostnum</option>";
	}else{
		$transportcostcboxoptions .= "<option value=\"$i\">$transportcostnum</option>";
	}
	$i++; 
}

// create staff combo box
$i = 1;
$fulltimestaff = number_format($fulltimestaff, 0, '', '');
$fulltimestaffcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 500) {
	$fulltimestaffnum = number_format($i);
	if ($fulltimestaff==$i) {
		$fulltimestaffcboxoptions .= "<option value=\"$i\" selected=\"selected\">$fulltimestaffnum</option>";
	}else{
		$fulltimestaffcboxoptions .= "<option value=\"$i\">$fulltimestaffnum</option>";
	}
	$i++;
}

// create staff combo box
$i = 1;
$parttimestaff = number_format($parttimestaff, 0, '', '');
$parttimestaffcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 500) {
	$parttimestaffnum = number_format($i);
	if ($parttimestaff==$i) {
		$parttimestaffcboxoptions .= "<option value=\"$i\" selected=\"selected\">$parttimestaffnum</option>";
	}else{
		$parttimestaffcboxoptions .= "<option value=\"$i\">$parttimestaffnum</option>";
	}
	$i++;
}

// create staff combo box
$i = 1;
$volunteerstaff = number_format($volunteerstaff, 0, '', '');
$volunteerstaffcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 500) {
	$volunteerstaffnum = number_format($i);
	if ($volunteerstaff==$i) {
		$volunteerstaffcboxoptions .= "<option value=\"$i\" selected=\"selected\">$volunteerstaffnum</option>";
	}else{
		$volunteerstaffcboxoptions .= "<option value=\"$i\">$volunteerstaffnum</option>";
	}
	$i++;
}

// create staff combo box
$i = 1;
$workingstaff = number_format($workingstaff, 0, '', '');
$workingstaffcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 500) {
	$workingstaffnum = number_format($i);
	if ($workingstaff==$i) {
		$workingstaffcboxoptions .= "<option value=\"$i\" selected=\"selected\">$workingstaffnum</option>";
	}else{
		$workingstaffcboxoptions .= "<option value=\"$i\">$workingstaffnum</option>";
	}
	$i++;
}

// create prodevelophours combo box
$i = 1;
$prodevelophours = number_format($prodevelophours, 0, '', '');
$prodevelophourscboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 500) {
	$prodevelophoursnum = number_format($i);
	if ($prodevelophours==$i) {
		$prodevelophourscboxoptions .= "<option value=\"$i\" selected=\"selected\">$prodevelophoursnum</option>";
	}else{
		$prodevelophourscboxoptions .= "<option value=\"$i\">$prodevelophoursnum</option>";
	}
	$i++;
}


// create race combo box
$i = 0;
$africanamerican = number_format($africanamerican, 0, '', '');
$africanamericancboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$africanamericannum = number_format($i) . '%';
	if ($africanamerican==$i) {
		$africanamericancboxoptions .= "<option value=\"$i\" selected=\"selected\">$africanamericannum</option>";
	}else{
		$africanamericancboxoptions .= "<option value=\"$i\">$africanamericannum</option>";
	}
	$i++;
}

// create race combo box
$i = 0;
$asianamerican = number_format($asianamerican, 0, '', '');
$asianamericancboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$asianamericannum = number_format($i) . '%';
	if ($asianamerican==$i) {
		$asianamericancboxoptions .= "<option value=\"$i\" selected=\"selected\">$asianamericannum</option>";
	}else{
		$asianamericancboxoptions .= "<option value=\"$i\">$asianamericannum</option>";
	}
	$i++;
}

// create race combo box
$i = 0;
$white = number_format($white, 0, '', '');
$whitecboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$whitenum = number_format($i) . '%';
	if ($white==$i) {
		$whitecboxoptions .= "<option value=\"$i\" selected=\"selected\">$whitenum</option>";
	}else{
		$whitecboxoptions .= "<option value=\"$i\">$whitenum</option>";
	}
	$i++;
}

// create race combo box
$i = 0;
$latino = number_format($latino, 0, '', '');
$latinocboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$latinonum = number_format($i) . '%';
	if ($latino==$i) {
		$latinocboxoptions .= "<option value=\"$i\" selected=\"selected\">$latinonum</option>";
	}else{
		$latinocboxoptions .= "<option value=\"$i\">$latinonum</option>";
	}
	$i++;
}

// create race combo box
$i = 0;
$nativeamerican = number_format($nativeamerican, 0, '', '');
$nativeamericancboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$nativeamericannum = number_format($i) . '%';
	if ($nativeamerican==$i) {
		$nativeamericancboxoptions .= "<option value=\"$i\" selected=\"selected\">$nativeamericannum</option>";
	}else{
		$nativeamericancboxoptions .= "<option value=\"$i\">$nativeamericannum</option>";
	}
	$i++;
}

// create race combo box
$i = 0;
$otherrace = number_format($otherrace, 0, '', '');
$otherracecboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$otherracenum = number_format($i) . '%';
	if ($otherrace==$i) {
		$otherracecboxoptions .= "<option value=\"$i\" selected=\"selected\">$otherracenum</option>";
	}else{
		$otherracecboxoptions .= "<option value=\"$i\">$otherracenum</option>";
	}
	$i++;
}

// create budget combo box
$i = 0;
$budgetfederal = number_format($budgetfederal, 0, '', '');
$budgetfederalcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$budgetfederalnum = number_format($i) . '%';
	if ($budgetfederal==$i) {
		$budgetfederalcboxoptions .= "<option value=\"$i\" selected=\"selected\">$budgetfederalnum</option>";
	}else{
		$budgetfederalcboxoptions .= "<option value=\"$i\">$budgetfederalnum</option>";
	}
	$i++;
}

// create budget combo box
$i = 0;
$budgetlocal = number_format($budgetlocal, 0, '', '');
$budgetlocalcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$budgetlocalnum = number_format($i) . '%';
	if ($budgetlocal==$i) {
		$budgetlocalcboxoptions .= "<option value=\"$i\" selected=\"selected\">$budgetlocalnum</option>";
	}else{
		$budgetlocalcboxoptions .= "<option value=\"$i\">$budgetlocalnum</option>";
	}
	$i++;
}

// create budget combo box
$i = 0;
$budgetfees = number_format($budgetfees, 0, '', '');
$budgetfeescboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$budgetfeesnum = number_format($i) . '%';
	if ($budgetfees==$i) {
		$budgetfeescboxoptions .= "<option value=\"$i\" selected=\"selected\">$budgetfeesnum</option>";
	}else{
		$budgetfeescboxoptions .= "<option value=\"$i\">$budgetfeesnum</option>";
	}
	$i++;
}

// create budget combo box
$i = 0;
$budgetgrant = number_format($budgetgrant, 0, '', '');
$budgetgrantcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$budgetgrantnum = number_format($i) . '%';
	if ($budgetgrant==$i) {
		$budgetgrantcboxoptions .= "<option value=\"$i\" selected=\"selected\">$budgetgrantnum</option>";
	}else{
		$budgetgrantcboxoptions .= "<option value=\"$i\">$budgetgrantnum</option>";
	}
	$i++;
}

// create budget combo box
$i = 0;
$budgetreligious = number_format($budgetreligious, 0, '', '');
$budgetreligiouscboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$budgetreligiousnum = number_format($i) . '%';
	if ($budgetreligious==$i) {
		$budgetreligiouscboxoptions .= "<option value=\"$i\" selected=\"selected\">$budgetreligiousnum</option>";
	}else{
		$budgetreligiouscboxoptions .= "<option value=\"$i\">$budgetreligiousnum</option>";
	}
	$i++;
}




// does the site charge?
$chargequery = "SELECT charge, otherassistance, transportation FROM azcase_sites WHERE siteid = $siteid;";
$chargeresult = pg_query($connection, $chargequery);
for ($lt = 0; $lt < pg_numrows($chargeresult); $lt++) {
	$charge = pg_result($chargeresult, $lt, 0);
	$otherassistance = pg_result($chargeresult, $lt, 1);
	$transportation = pg_result($chargeresult, $lt, 2);

}



if ($charge=='t' && $costsame=='t') {
	$costsame = "<p>Does everyone pay the same amount at this site? <input type=\"radio\" name=\"costsame\" value=\"TRUE\" checked=\"checked\"> Yes <input type=\"radio\" name=\"costsame\" value=\"FALSE\"> No</p>";
}elseif ($charge=='t' && $costsame=='f') {
	$costsame = "<p>Does everyone pay the same amount at this site? <input type=\"radio\" name=\"costsame\" value=\"TRUE\"> Yes <input type=\"radio\" name=\"costsame\" value=\"FALSE\" checked=\"checked\"> No</p>";
}else{
	$costsame = '';
}

if ($otherassistance=='t') {
	$otherassistancedescription = "<p>Please describe what other financial assistance is available at this site.</p><textarea name=\"otherassistancedescription\" rows=\"2\" cols=\"50\">$otherassistancedescription</textarea><br />";
}else{
	$otherassistancedescription = '';
}

if ($transportation=='t') {
	$transportcost = "<p>What is the average monthly transportation cost to this site? <select name=\"transportcost\">$transportcostcboxoptions</select></p>";
}else{
	$transportcost = '';
}

?>
<table>
	<tr>
		<td>
		<form name="skipthissite" id="skipthissite" action="newsummersitesurvey.php" method="POST">
			<input type="hidden" name="lastsiteid" value="<?php echo $siteid; ?>" />
			<input type="submit" class="btn btn-default" name="action" value="Skip This Site &#62;&#62;" />
		</form>
		</td>
		<td>
		<form name="skipallsites" id="skipallsites" action="thankyousites.php" method="POST">
			<input type="submit" class="btn btn-default" name="action" value="Skip All Sites &#62;&#62;" />
		</form>
		</td>
	</tr>
</table>
<br />
<form name="newsummersitesurvey" id="newsummersitesurvey" action="processnewsummersitesurvey.php" method="POST" onSubmit="return validateForm();">
<input type="hidden" name="siteid" value="<?php echo $siteid; ?>" />
<input type="hidden" name="locationid" value="<?php echo $locationid; ?>" />
	<p>What is the capacity of this site? <select name="capacity"><?php echo $capacitycboxoptions; ?></select></p>
	<p>Does this site run at capacity? <input type="radio" name="atcapacity" value="TRUE" <?php if ($atcapacity=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="atcapacity" value="FALSE" <?php if ($atcapacity=='f') { echo 'checked="checked"'; }else{} ?>> No</p>
	<p>On a typical day this site is operating, how many children or teens attend at this site? <select name="served"><?php echo $servedcboxoptions; ?></select></p>
	<?php echo $costsame; ?>
	<p>Is sliding scale assistance available at this site? <input type="radio" name="slidescale" value="TRUE" <?php if ($slidescale=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="slidescale" value="FALSE" <?php if ($slidescale=='f') { echo 'checked="checked"'; }else{} ?>> No</p>
	<?php echo $otherassistancedescription; ?>
	<?php echo $transportcost; ?>
	<p>What is the number of full-time, paid staff at this site? <select name="fulltimestaff"><?php echo $fulltimestaffcboxoptions; ?></select></p>
	<p>What is the number of part-time, paid staff at this site? <select name="parttimestaff"><?php echo $parttimestaffcboxoptions; ?></select></p>
	<p>What is the number of volunteer staff at this site? <select name="volunteerstaff"><?php echo $volunteerstaffcboxoptions; ?></select></p>
	<p>On a typical day, how many staff members are working at this site? <select name="workingstaff"><?php echo $workingstaffcboxoptions; ?></select></p>
	<p>Do you provide referrals for needed parental services at this site? <input type="radio" name="parentreferrals" value="TRUE" <?php if ($parentreferrals=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="parentreferrals" value="FALSE" <?php if ($parentreferrals=='f') { echo 'checked="checked"'; }else{} ?>> No</p>
	<p>Do you provide parent education at this site? <input type="radio" name="parenteducation" value="TRUE" <?php if ($parenteducation=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="parenteducation" value="FALSE" <?php if ($parenteducation=='f') { echo 'checked="checked"'; }else{} ?>> No</p>
	<p>Do you provide information and handouts to parents at this site? <input type="radio" name="parentinfo" value="TRUE" <?php if ($parentinfo=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="parentinfo" value="FALSE" <?php if ($parentinfo=='f') { echo 'checked="checked"'; }else{} ?>> No</p>
	<p>Please describe any other items or services provided to parents at this site. <br /><textarea name="parentotherdescription" rows="3" cols="50"><?php echo $parentotherdescription; ?></textarea></p>
	<p>What percentage of your total clientele at this site are:</p>
	<ul>
		<li>African American? <select name="africanamerican"><?php echo $africanamericancboxoptions; ?></select></li>
		<li>Asian American? <select name="asianamerican"><?php echo $asianamericancboxoptions; ?></select></li>
		<li>Latino? <select name="latino"><?php echo $latinocboxoptions; ?></select></li>
		<li>Native American? <select name="nativeamerican"><?php echo $nativeamericancboxoptions; ?></select></li>
		<li>White? <select name="white"><?php echo $whitecboxoptions; ?></select></li>
		<li>Another race or ethnicity? <select name="otherrace"><?php echo $otherracecboxoptions; ?></select></li>
	</ul>
	<br />
	<p>Which response best describes the type of program operating at the site? <select name="programtype"><option value="NULL">--</option><option value="1" <?php if ($programtype==1) { echo 'selected="selected"'; }else{} ?>>21st century community center</option><option value="2" <?php if ($programtype==2) { echo 'selected="selected"'; }else{} ?>>Faith-based program</option><option value="3" <?php if ($programtype==3) { echo 'selected="selected"'; }else{} ?>>Public school based program</option><option value="4" <?php if ($programtype==4) { echo 'selected="selected"'; }else{} ?>>Private school based program</option><option value="5" <?php if ($programtype==5) { echo 'selected="selected"'; }else{} ?>>Home based program</option><option value="6" <?php if ($programtype==6) { echo 'selected="selected"'; }else{} ?>>Corperate run program</option><option value="7">Community based program</option></select></p>
	<p>What percentage of your program budget at this site comes from:</p>
	<ul>
		<li>The federal government? <select name="budgetfederal"><?php echo $budgetfederalcboxoptions; ?></select></li>
		<li>The state or local government? <select name="budgetlocal"><?php echo $budgetlocalcboxoptions; ?></select></li>
		<li>Parent fees? <select name="budgetfees"><?php echo $budgetfeescboxoptions; ?></select></li>
		<li>Grants? <select name="budgetgrant"><?php echo $budgetgrantcboxoptions; ?></select></li>
		<li>Religious organizations? <select name="budgetreligious"><?php echo $budgetreligiouscboxoptions; ?></select></li>
	</ul>
	<br />
	<p>What is the <em>biggest</em> barrier to operating at full attendence at this site? <select name="barriersfull"><option value="NULL">--</option><option value="1" <?php if ($barriersfull==1) { echo 'selected="selected"'; }else{} ?>>Children/teens lose interest</option><option value="2" <?php if ($barriersfull==2) { echo 'selected="selected"'; }else{} ?>>Insufficient/inadequate recruitment of children/teens</option><option value="3" <?php if ($barriersfull==3) { echo 'selected="selected"'; }else{} ?>>Lack of available transportation to the site</option><option value="4" <?php if ($barriersfull==4) { echo 'selected="selected"'; }else{} ?>>Lack of staff</option><option value="5" <?php if ($barriersfull==5) { echo 'selected="selected"'; }else{} ?>>Program fees charged</option><option value="7" <?php if ($barriersfull==7) { echo 'selected="selected"'; }else{} ?>>Parent perception</option><option value="8" <?php if ($barriersfull==8) { echo 'selected="selected"'; }else{} ?>>Child perception</option><option value="6" <?php if ($barriersfull==6) { echo 'selected="selected"'; }else{} ?>>Other</option></select></p>
	<p>Please describe any other barriers you see to operating at full attendence at this site.<br /><textarea name="barriersfulltext" rows="3" cols="50"><?php echo $barriersfulltext; ?></textarea></p>
	<p>When hiring staff for this site, which of the following do you require?</p>
	<ul>
		<li>Fingerprinting? <input type="radio" name="fingerprint" value="TRUE" <?php if ($fingerprint=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="fingerprint" value="FALSE" <?php if ($fingerprint=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Drug Test? <input type="radio" name="drugtest" value="TRUE" <?php if ($drugtest=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="drugtest" value="FALSE" <?php if ($drugtest=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Background Check? <input type="radio" name="backgroundcheck" value="TRUE" <?php if ($backgroundcheck=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="backgroundcheck" value="FALSE" <?php if ($backgroundcheck=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Personal References? <input type="radio" name="personalrefs" value="TRUE" <?php if ($personalrefs=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="personalrefs" value="FALSE" <?php if ($personalrefs=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Other? <input type="radio" name="othercheck" value="TRUE" <?php if ($othercheck=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="othercheck" value="FALSE" <?php if ($othercheck=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
	</ul>
	<br />
	<p>How often do you provide staff training/professional development throughout the year for staff at this site? <select name="prodevelop"><option value="NULL">--</option><option value="1" <?php if ($prodevelop==1) { echo 'selected="selected"'; }else{} ?>>Monthly</option><option value="2" <?php if ($prodevelop==2) { echo 'selected="selected"'; }else{} ?>>Quarterly</option><option value="3" <?php if ($prodevelop==3) { echo 'selected="selected"'; }else{} ?>>Semi-annually</option><option value="4" <?php if ($prodevelop==4) { echo 'selected="selected"'; }else{} ?>>Annually</option><option value="5" <?php if ($prodevelop==5) { echo 'selected="selected"'; }else{} ?>>Less than once a year</option></select></p>
	<p>Approximately how many hours of training/professional development do you provide to your staff at this site per year? <select name="prodevelophours"><?php echo $prodevelophourscboxoptions; ?></select></p>
	<p>Rank from <em>most to least</em> used the following delivery methods that you use for your staff's training/professional development at this site.</p>
	<ol>
		<li><select name="prodevelop_rankmost1" id="prodevelop_rankmost1"><option value="NULL">--</option><option value="1" <?php if ($prodevelop_rankmost1==1) { echo 'selected="selected"'; }else{} ?>>On-line training</option><option value="2" <?php if ($prodevelop_rankmost1==2) { echo 'selected="selected"'; }else{} ?>>Workshops/conferences</option><option value="3" <?php if ($prodevelop_rankmost1==3) { echo 'selected="selected"'; }else{} ?>>Trainers specializing in specific subject matter</option><option value="4" <?php if ($prodevelop_rankmost1==4) { echo 'selected="selected"'; }else{} ?>>Peer to peer coaching</option><option value="5" <?php if ($prodevelop_rankmost1==5) { echo 'selected="selected"'; }else{} ?>>Supervision</option></select></li>
		<li><select name="prodevelop_rank2" id="prodevelop_rank2"><option value="NULL">--</option><option value="1" <?php if ($prodevelop_rank2==1) { echo 'selected="selected"'; }else{} ?>>On-line training</option><option value="2" <?php if ($prodevelop_rank2==2) { echo 'selected="selected"'; }else{} ?>>Workshops/conferences</option><option value="3" <?php if ($prodevelop_rank2==3) { echo 'selected="selected"'; }else{} ?>>Trainers specializing in specific subject matter</option><option value="4" <?php if ($prodevelop_rank2==4) { echo 'selected="selected"'; }else{} ?>>Peer to peer coaching</option><option value="5" <?php if ($prodevelop_rank2==5) { echo 'selected="selected"'; }else{} ?>>Supervision</option></select></li>
		<li><select name="prodevelop_rank3" id="prodevelop_rank3"><option value="NULL">--</option><option value="1" <?php if ($prodevelop_rank3==1) { echo 'selected="selected"'; }else{} ?>>On-line training</option><option value="2" <?php if ($prodevelop_rank3==2) { echo 'selected="selected"'; }else{} ?>>Workshops/conferences</option><option value="3" <?php if ($prodevelop_rank3==3) { echo 'selected="selected"'; }else{} ?>>Trainers specializing in specific subject matter</option><option value="4" <?php if ($prodevelop_rank3==4) { echo 'selected="selected"'; }else{} ?>>Peer to peer coaching</option><option value="5" <?php if ($prodevelop_rank3==5) { echo 'selected="selected"'; }else{} ?>>Supervision</option></select></li>
		<li><select name="prodevelop_rank4" id="prodevelop_rank4"><option value="NULL">--</option><option value="1" <?php if ($prodevelop_rank4==1) { echo 'selected="selected"'; }else{} ?>>On-line training</option><option value="2" <?php if ($prodevelop_rank4==2) { echo 'selected="selected"'; }else{} ?>>Workshops/conferences</option><option value="3" <?php if ($prodevelop_rank4==3) { echo 'selected="selected"'; }else{} ?>>Trainers specializing in specific subject matter</option><option value="4" <?php if ($prodevelop_rank4==4) { echo 'selected="selected"'; }else{} ?>>Peer to peer coaching</option><option value="5" <?php if ($prodevelop_rank4==5) { echo 'selected="selected"'; }else{} ?>>Supervision</option></select></li>
		<li><select name="prodevelop_rankleast5" id="prodevelop_rankleast5"><option value="NULL">--</option><option value="1" <?php if ($prodevelop_rankleast5==1) { echo 'selected="selected"'; }else{} ?>>On-line training</option><option value="2" <?php if ($prodevelop_rankleast5==2) { echo 'selected="selected"'; }else{} ?>>Workshops/conferences</option><option value="3" <?php if ($prodevelop_rankleast5==3) { echo 'selected="selected"'; }else{} ?>>Trainers specializing in specific subject matter</option><option value="4" <?php if ($prodevelop_rankleast5==4) { echo 'selected="selected"'; }else{} ?>>Peer to peer coaching</option><option value="5" <?php if ($prodevelop_rankleast5==5) { echo 'selected="selected"'; }else{} ?>>Supervision</option></select></li>
	</ol>
	<br />
	<p>Who trains your staff for this site?</p>
	<ul>
		<li>Our own staff? <input type="radio" name="training_ownstaff" value="TRUE" <?php if ($training_ownstaff=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="training_ownstaff" value="FALSE" <?php if ($training_ownstaff=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Arizona Association of Supportive Child Care? <input type="radio" name="training_aascc" value="TRUE" <?php if ($training_aascc=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="training_aascc" value="FALSE" <?php if ($training_aascc=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Arizona Center for Afterschool Excellence? <input type="radio" name="training_azcase" value="TRUE" <?php if ($training_azcase=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="training_azcase" value="FALSE" <?php if ($training_azcase=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Arizona Department of Health Services? <input type="radio" name="training_azdhs" value="TRUE" <?php if ($training_azdhs=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="training_azdhs" value="FALSE" <?php if ($training_azdhs=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>National Afterschool Association? <input type="radio" name="training_naa" value="TRUE" <?php if ($training_naa=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="training_naa" value="FALSE" <?php if ($training_naa=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>National Institute on Out-of-School Time (NIOST)? <input type="radio" name="training_niost" value="TRUE" <?php if ($training_niost=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="training_niost" value="FALSE" <?php if ($training_niost=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Southwest Human Development? <input type="radio" name="training_shd" value="TRUE" <?php if ($training_shd=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="training_shd" value="FALSE" <?php if ($training_shd=='f') { echo 'checked="checked"'; }else{} ?>> No</li>
		<li>Other? <input type="text" name="training_other" value="<?php echo $training_other; ?>"></li>
	</ul>
	<br />
	<p>Name the <em>one</em> most important area in which your staff needs the most training at this site. <select name="training_needs"><option value="NULL">--</option><option value="2" <?php if ($training_needs==2) { echo 'selected="selected"'; }else{} ?>>Advancement of Physical/Intellectual Development</option><option value="3" <?php if ($training_needs==3) { echo 'selected="selected"'; }else{} ?>>Enhancement of Social and Emotional Development</option><option value="4" <?php if ($training_needs==4) { echo 'selected="selected"'; }else{} ?>>Positive Relationships with Families</option><option value="5" <?php if ($training_needs==5) { echo 'selected="selected"'; }else{} ?>> Observing and Recording Principles of Child Growth and Development</option><option value="6" <?php if ($training_needs==6) { echo 'selected="selected"'; }else{} ?>>Commitment to Professionalism</option><option value="7" <?php if ($training_needs==7) { echo 'selected="selected"'; }else{} ?>>Effective Program Operation</option><option value="8" <?php if ($training_needs==8) { echo 'selected="selected"'; }else{} ?>>Health and Safety Issues</option><option value="9" <?php if ($training_needs==9) { echo 'selected="selected"'; }else{} ?>>Availability of Community Services and Resources, including those available to children with special needs</option><option value="11" <?php if ($training_needs==11) { echo 'selected="selected"'; }else{} ?>>Youth engagement</option><option value="10" <?php if ($training_needs==10) { echo 'selected="selected"'; }else{} ?>>Other</option></select></p>
	<p>Please describe if "other" selected above.<br /><textarea name="training_needsother" rows="3" cols="50"><?php echo $training_needsother; ?></textarea></p></div>
	<p>Name the <em>second</em> most important area in which your staff needs the most training at this site. <select name="training_needssecond"><option value="NULL">--</option><option value="2" <?php if ($training_needssecond==2) { echo 'selected="selected"'; }else{} ?>>Advancement of Physical/Intellectual Development</option><option value="3" <?php if ($training_needssecond==3) { echo 'selected="selected"'; }else{} ?>>Enhancement of Social and Emotional Development</option><option value="4" <?php if ($training_needssecond==4) { echo 'selected="selected"'; }else{} ?>>Positive Relationships with Families</option><option value="5" <?php if ($training_needssecond==5) { echo 'selected="selected"'; }else{} ?>> Observing and Recording Principles of Child Growth and Development</option><option value="6" <?php if ($training_needssecond==6) { echo 'selected="selected"'; }else{} ?>>Commitment to Professionalism</option><option value="7" <?php if ($training_needssecond==7) { echo 'selected="selected"'; }else{} ?>>Effective Program Operation</option><option value="8" <?php if ($training_needssecond==8) { echo 'selected="selected"'; }else{} ?>>Health and Safety Issues</option><option value="9" <?php if ($training_needssecond==9) { echo 'selected="selected"'; }else{} ?>>Availability of Community Services and Resources, including those available to children with special needs</option><option value="11" <?php if ($training_needssecond==11) { echo 'selected="selected"'; }else{} ?>>Youth engagement</option><option value="10" <?php if ($training_needssecond==10) { echo 'selected="selected"'; }else{} ?>>Other</option></select></p>
	<p>Please describe if "other" selected above.<br /><textarea name="training_needssecond_other" rows="3" cols="50"><?php echo $training_needssecond_other; ?></textarea></p></div>
	<p>Do you evaluate the quality of your program at this site? <input type="radio" name="evaluate_program" value="TRUE" <?php if ($evaluate_program=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="evaluate_program" value="FALSE" <?php if ($evaluate_program=='f') { echo 'checked="checked"'; }else{} ?>> No</p>
	<p>How do you assess the quality of your program at this site? <select name="evaluate_type"><option value="NULL">--</option><option value="1" <?php if ($evaluate_type==1) { echo 'selected="selected"'; }else{} ?>>Informal self-assessment</option><option value="4" <?php if ($evaluate_type==4) { echo 'selected="selected"'; }else{} ?>>Formal self-assessment with agreed upon criteria</option><option value="5" <?php if ($evaluate_type==5) { echo 'selected="selected"'; }else{} ?>>Parent/client survey</option><option value="6" <?php if ($evaluate_type==6) { echo 'selected="selected"'; }else{} ?>>Host school evaluation</option><option value="7" <?php if ($evaluate_type==7) { echo 'selected="selected"'; }else{} ?>>Nationally recognized assessment or accreditation tool</option><option value="8" <?php if ($evaluate_type==8) { echo 'selected="selected"'; }else{} ?>>Other</option></select></p></div>
	<p>How frequently do the children/teens at your site have the opportunity to plan activities/projects? <select name="youth_planactivity"><option value="NULL">--</option><option value="1" <?php if ($youth_planactivity==1) { echo 'selected="selected"'; }else{} ?>>At least weekly</option><option value="2" <?php if ($youth_planactivity==2) { echo 'selected="selected"'; }else{} ?>>Monthly</option><option value="3" <?php if ($youth_planactivity==3) { echo 'selected="selected"'; }else{} ?>>Quarterly</option><option value="4" <?php if ($youth_planactivity==4) { echo 'selected="selected"'; }else{} ?>>Annually</option><option value="5" <?php if ($youth_planactivity==5) { echo 'selected="selected"'; }else{} ?>>Less than annually</option></select></p>
	<p>How often do the children/teens at your site have the opportunity to create rules and expectations that are followed? <select name="youth_makerules"><option value="NULL">--</option><option value="1" <?php if ($youth_makerules==1) { echo 'selected="selected"'; }else{} ?>>At least weekly</option><option value="2" <?php if ($youth_makerules==2) { echo 'selected="selected"'; }else{} ?>>Monthly</option><option value="3" <?php if ($youth_makerules==3) { echo 'selected="selected"'; }else{} ?>>Quarterly</option><option value="4" <?php if ($youth_makerules==4) { echo 'selected="selected"'; }else{} ?>>Annually</option><option value="5" <?php if ($youth_makerules==5) { echo 'selected="selected"'; }else{} ?>>Less than annually</option></select></p>
	<p>Do you and/or your staff regularly collaborate with the schools attended by the children/teens at this site? <input type="radio" name="collab_school" value="TRUE" <?php if ($collab_school=='t') { echo 'checked="checked"'; }else{} ?>> Yes <input type="radio" name="collab_school" value="FALSE" <?php if ($collab_school=='f') { echo 'checked="checked"'; }else{} ?>> No</p>
	<p>How often do you collaborate with the schools attended by the children/teens at this site? <select name="collab_schoolfreq"><option value="NULL">--</option><option value="1" <?php if ($youth_makerules==1) { echo 'selected="selected"'; }else{} ?>>Weekly</option><option value="2" <?php if ($youth_makerules==2) { echo 'selected="selected"'; }else{} ?>>Monthly</option><option value="3" <?php if ($youth_makerules==3) { echo 'selected="selected"'; }else{} ?>>Quarterly</option><option value="4" <?php if ($youth_makerules==4) { echo 'selected="selected"'; }else{} ?>>Less than quarterly</option></select></p>


<br />
<input type="submit" class="btn btn-default" name="action" value="Save and Continue &#62;&#62;" />
</form>

