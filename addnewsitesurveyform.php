<?php
// create the add new site survey form

// create capacity combo box
$i = 1;
$capacitycboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 1000) {
	$capacity = number_format($i);
	$capacitycboxoptions .= "<option value=\"$i\">$capacity</option>";
	$i++; 
}

// create transport cost combo box
$i = 0;
$transportcostcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 1000) {
	$transportcost = '$' . number_format($i);
	$transportcostcboxoptions .= "<option value=\"$i\">$transportcost</option>";
	$i++; 
}

// create staff combo box
$i = 1;
$staffcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 500) {
	$staff = number_format($i);
	$staffcboxoptions .= "<option value=\"$i\">$staff</option>";
	$i++;
}

// create race combo box
$i = 0;
$racecboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$race = number_format($i) . '%';
	$racecboxoptions .= "<option value=\"$i\">$race</option>";
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

if ($charge=='t') {
	$costsame = "<p>Does everyone pay the same amount at this site? <input type=\"radio\" name=\"costsame\" value=\"TRUE\"> Yes <input type=\"radio\" name=\"costsame\" value=\"FALSE\"> No</p>";
}else{
	$costsame = '';
}

if ($otherassistance=='t') {
	$otherassistancedescription = "<p>Please describe what other financial assistance is available at this site.</p><textarea name=\"otherassistancedescription\" rows=\"2\" cols=\"50\"></textarea><br />";
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
		<form name="skipthissite" id="skipthissite" action="newsitesurvey.php" method="POST">
			<input type="hidden" name="lastsiteid" value="<?php echo $siteid; ?>" />
			<input type="submit" name="action" value="Skip This Site &#62;&#62;" />
		</form>
		</td>
		<td>
		<form name="skipallsites" id="skipallsites" action="summersites.php" method="POST">
			<input type="submit" name="action" value="Skip All Sites &#62;&#62;" />
		</form>
		</td>
	</tr>
</table>
<br />
<form name="newsitesurvey" id="newsitesurvey" action="processnewsitesurvey.php" method="POST" onSubmit="return validateForm();">
<input type="hidden" name="siteid" value="<?php echo $siteid; ?>" />
<input type="hidden" name="locationid" value="<?php echo $locationid; ?>" />
	<p>What is the capacity of this site? <select name="capacity"><?php echo $capacitycboxoptions; ?></select></p>
	<p>Does this site run at capacity? <input type="radio" name="atcapacity" value="TRUE"> Yes <input type="radio" name="atcapacity" value="FALSE"> No</p>
	<p>On a typical day this site is operating, how many children or teens attend at this site? <select name="served"><?php echo $capacitycboxoptions; ?></select></p>
	<?php echo $costsame; ?>
	<p>Is sliding scale assistance available at this site? <input type="radio" name="slidescale" value="TRUE"> Yes <input type="radio" name="slidescale" value="FALSE"> No</p>
	<?php echo $otherassistancedescription; ?>
	<?php echo $transportcost; ?>
	<p>What is the number of full-time, paid staff at this site? <select name="fulltimestaff"><?php echo $staffcboxoptions; ?></select></p>
	<p>What is the number of part-time, paid staff at this site? <select name="parttimestaff"><?php echo $staffcboxoptions; ?></select></p>
	<p>What is the number of volunteer staff at this site? <select name="volunteerstaff"><?php echo $staffcboxoptions; ?></select></p>
	<p>On a typical day, how many staff members are working at this site? <select name="workingstaff"><?php echo $staffcboxoptions; ?></select></p>
	<p>Do you provide referrals for needed parental services at this site? <input type="radio" name="parentreferrals" value="TRUE"> Yes <input type="radio" name="parentreferrals" value="FALSE"> No</p>
	<p>Do you provide parent education at this site? <input type="radio" name="parenteducation" value="TRUE"> Yes <input type="radio" name="parenteducation" value="FALSE"> No</p>
	<p>Do you provide information and handouts to parents at this site? <input type="radio" name="parentinfo" value="TRUE"> Yes <input type="radio" name="parentinfo" value="FALSE"> No</p>
	<p>Please describe any other items or services provided to parents at this site. <br /><textarea name="parentotherdescription" rows="3" cols="50"></textarea></p>
	<p>What percentage of your total clientele at this site are:</p>
	<ul>
		<li>African American? <select name="africanamerican"><?php echo $racecboxoptions; ?></select></li>
		<li>Asian American? <select name="asianamerican"><?php echo $racecboxoptions; ?></select></li>
		<li>Latino? <select name="latino"><?php echo $racecboxoptions; ?></select></li>
		<li>Native American? <select name="nativeamerican"><?php echo $racecboxoptions; ?></select></li>
		<li>White? <select name="white"><?php echo $racecboxoptions; ?></select></li>
		<li>Another race or ethnicity? <select name="otherrace"><?php echo $racecboxoptions; ?></select></li>
	</ul>
	<br />
	<p>Which response best describes the type of program operating at the site? <select name="programtype"><option value="NULL">--</option><option value="1">21st century community center</option><option value="2">Faith-based program</option><option value="3">Public school based program</option><option value="4">Private school based program</option><option value="5">Home based program</option><option value="6">Corperate run program</option><option value="7">Community based program</option></select></p>
	<p>What percentage of your program budget at this site comes from:</p>
	<ul>
		<li>The federal government? <select name="budgetfederal"><?php echo $racecboxoptions; ?></select></li>
		<li>The state or local government? <select name="budgetlocal"><?php echo $racecboxoptions; ?></select></li>
		<li>Parent fees? <select name="budgetfees"><?php echo $racecboxoptions; ?></select></li>
		<li>Grants? <select name="budgetgrant"><?php echo $racecboxoptions; ?></select></li>
		<li>Religious organizations? <select name="budgetreligious"><?php echo $racecboxoptions; ?></select></li>
	</ul>
	<br />
	<p>What is the <i>biggest</i> barrier to operating at full attendence at this site? <select name="barriersfull"><option value="NULL">--</option><option value="1">Children/teens lose interest</option><option value="2">Insufficient/inadequate recruitment of children/teens</option><option value="3">Lack of available transportation to the site</option><option value="4">Lack of staff</option><option value="5">Program fees charged</option><option value="7">Parent perception</option><option value="8">Child perception</option><option value="6" onClick="toggle('bftext');">Other</option></select></p>
	<div id="bftext" style="display:none"><p>Please describe any other barriers you see to operating at full attendence at this site.<br /><textarea name="barriersfulltext" rows="3" cols="50"></textarea></p></div>
	<p>When hiring staff for this site, which of the following do you require?</p>
	<ul>
		<li>Fingerprinting? <input type="radio" name="fingerprint" value="TRUE"> Yes <input type="radio" name="fingerprint" value="FALSE"> No</li>
		<li>Drug Test? <input type="radio" name="drugtest" value="TRUE"> Yes <input type="radio" name="drugtest" value="FALSE"> No</li>
		<li>Background Check? <input type="radio" name="backgroundcheck" value="TRUE"> Yes <input type="radio" name="backgroundcheck" value="FALSE"> No</li>
		<li>Personal References? <input type="radio" name="personalrefs" value="TRUE"> Yes <input type="radio" name="personalrefs" value="FALSE"> No</li>
		<li>Other? <input type="radio" name="othercheck" value="TRUE"> Yes <input type="radio" name="othercheck" value="FALSE"> No</li>
	</ul>
	<br />
	<p>How often do you provide staff training/professional development throughout the year for staff at this site? <select name="prodevelop"><option value="NULL">--</option><option value="1">Monthly</option><option value="2">Quarterly</option><option value="3">Semi-annually</option><option value="4">Annually</option><option value="5">Less than once a year</option></select></p>
	<p>Approximately how many hours of training/professional development do you provide to your staff at this site per year? <select name="prodevelophours"><?php echo $staffcboxoptions; ?></select></p>
	<p>Rank from <i>most to least</i> used the following delivery methods that you use for your staff's training/professional development at this site.</p>
	<ol>
		<li><select name="prodevelop_rankmost1" id="prodevelop_rankmost1"><option value="NULL">--</option><option value="1">On-line training</option><option value="2">Workshops/conferences</option><option value="3">Trainers specializing in specific subject matter</option><option value="4">Peer to peer coaching</option><option value="5">Supervision</option></select></li>
		<li><select name="prodevelop_rank2" id="prodevelop_rank2"><option value="NULL">--</option><option value="1">On-line training</option><option value="2">Workshops/conferences</option><option value="3">Trainers specializing in specific subject matter</option><option value="4">Peer to peer coaching</option><option value="5">Supervision</option></select></li>
		<li><select name="prodevelop_rank3" id="prodevelop_rank3"><option value="NULL">--</option><option value="1">On-line training</option><option value="2">Workshops/conferences</option><option value="3">Trainers specializing in specific subject matter</option><option value="4">Peer to peer coaching</option><option value="5">Supervision</option></select></li>
		<li><select name="prodevelop_rank4" id="prodevelop_rank4"><option value="NULL">--</option><option value="1">On-line training</option><option value="2">Workshops/conferences</option><option value="3">Trainers specializing in specific subject matter</option><option value="4">Peer to peer coaching</option><option value="5">Supervision</option></select></li>
		<li><select name="prodevelop_rankleast5" id="prodevelop_rankleast5"><option value="NULL">--</option><option value="1">On-line training</option><option value="2">Workshops/conferences</option><option value="3">Trainers specializing in specific subject matter</option><option value="4">Peer to peer coaching</option><option value="5">Supervision</option></select></li>
	</ol>
	<br />
	<p>Who trains your staff for this site?</p>
	<ul>
		<li>Our own staff? <input type="radio" name="training_ownstaff" value="TRUE"> Yes <input type="radio" name="training_ownstaff" value="FALSE"> No</li>
		<li>Arizona Association of Supportive Child Care? <input type="radio" name="training_aascc" value="TRUE"> Yes <input type="radio" name="training_aascc" value="FALSE"> No</li>
		<li>Arizona Center for Afterschool Excellence? <input type="radio" name="training_azcase" value="TRUE"> Yes <input type="radio" name="training_azcase" value="FALSE"> No</li>
		<li>Arizona Department of Health Services? <input type="radio" name="training_azdhs" value="TRUE"> Yes <input type="radio" name="training_azdhs" value="FALSE"> No</li>
		<li>National Afterschool Association? <input type="radio" name="training_naa" value="TRUE"> Yes <input type="radio" name="training_naa" value="FALSE"> No</li>
		<li>National Institute on Out-of-School Time (NIOST)? <input type="radio" name="training_niost" value="TRUE"> Yes <input type="radio" name="training_niost" value="FALSE"> No</li>
		<li>Southwest Human Development? <input type="radio" name="training_shd" value="TRUE"> Yes <input type="radio" name="training_shd" value="FALSE"> No</li>
		<li>Other? <input type="text" name="training_other" value=""></li>
	</ul>
	<br />
	<p>Name the <i>one</i> most important area in which your staff needs the most training at this site. <select name="training_needs"><option value="NULL">--</option><option value="2">Advancement of Physical/Intellectual Development</option><option value="3">Enhancement of Social and Emotional Development</option><option value="4">Positive Relationships with Families</option><option value="5"> Observing and Recording Principles of Child Growth and Development</option><option value="6">Commitment to Professionalism</option><option value="7">Effective Program Operation</option><option value="8">Health and Safety Issues</option><option value="9">Availability of Community Services and Resources, including those available to children with special needs</option><option value="11">Youth engagement</option><option value="10" onClick="toggle('trainingtext');">Other</option></select></p>
	<div id="trainingtext" style="display:none"><p>Please describe.<br /><textarea name="training_needsother" rows="3" cols="50"></textarea></p></div>
	<p>Name the <i>second</i> most important area in which your staff needs the most training at this site. <select name="training_needssecond"><option value="NULL">--</option><option value="2">Advancement of Physical/Intellectual Development</option><option value="3">Enhancement of Social and Emotional Development</option><option value="4">Positive Relationships with Families</option><option value="5"> Observing and Recording Principles of Child Growth and Development</option><option value="6">Commitment to Professionalism</option><option value="7">Effective Program Operation</option><option value="8">Health and Safety Issues</option><option value="9">Availability of Community Services and Resources, including those available to children with special needs</option><option value="11">Youth engagement</option><option value="10" onClick="toggle('trainingtext2');">Other</option></select></p>
	<div id="trainingtext2" style="display:none"><p>Please describe.<br /><textarea name="training_needssecond_other" rows="3" cols="50"></textarea></p></div>
	<p>Do you evaluate the quality of your program at this site? <input type="radio" name="evaluate_program" value="TRUE" onClick="toggle('evaldiv');"> Yes <input type="radio" name="evaluate_program" value="FALSE"> No</p>
	<div id="evaldiv" style="display:none"><p>How do you assess the quality of your program at this site? <select name="evaluate_type"><option value="NULL">--</option><option value="1">Informal self-assessment</option><option value="4">Formal self-assessment with agreed upon criteria</option><option value="5">Parent/client survey</option><option value="6">Host school evaluation</option><option value="7">Nationally recognized assessment or accreditation tool</option><option value="8">Other</option></select></p></div>
	<p>How frequently do the children/teens at your site have the opportunity to plan activities/projects? <select name="youth_planactivity"><option value="NULL">--</option><option value="1">At least weekly</option><option value="2">Monthly</option><option value="3">Quarterly</option><option value="4">Annually</option><option value="5">Less than annually</option></select></p>
	<p>How often do the children/teens at your site have the opportunity to create rules and expectations that are followed? <select name="youth_makerules"><option value="NULL">--</option><option value="1">At least weekly</option><option value="2">Monthly</option><option value="3">Quarterly</option><option value="4">Annually</option><option value="5">Less than annually</option></select></p>
	<p>Do you and/or your staff regularly collaborate with the schools attended by the children/teens at this site? <input type="radio" name="collab_school" value="TRUE" onClick="toggle('collab_schoolfreqdiv');"> Yes <input type="radio" name="collab_school" value="FALSE"> No</p>
	<div id="collab_schoolfreqdiv" style="display:none"><p>How often do you collaborate with the schools attended by the children/teens at this site? <select name="collab_schoolfreq"><option value="NULL">--</option><option value="1">Weekly</option><option value="2">Monthly</option><option value="3">Quarterly</option><option value="4">Less than quarterly</option></select></p></div>


<br />
<input type="submit" name="action" value="Save and Continue &#62;&#62;" />
</form>

