<?php

session_start(); 

// connect to database
require("connect.php");

$userid = $_SESSION['POSTuserid'];

// set updated
$updated = date('Y-m-d H:i:s');

$siteid = $_REQUEST['siteid'];
$academic = $_REQUEST['activityacademic'];
$arts = $_REQUEST['activityarts'];
$sports = $_REQUEST['activitysports'];
$community = $_REQUEST['activitycommunity'];
$character = $_REQUEST['activitycharacter'];
$leadership = $_REQUEST['activityleadership'];
$nutrition = $_REQUEST['activitynutrition'];
$prevention = $_REQUEST['activityprevention'];
$mentoring = $_REQUEST['activitymentoring'];
$supportservices = $_REQUEST['activitysupportservices'];
$stem = $_REQUEST['activitystem'];
$college = $_REQUEST['activitycollege'];


if ($academic=="TRUE") {
}else{
	$academic = "FALSE";
}

if ($arts=="TRUE") {
}else{
	$arts = "FALSE";
}

if ($sports=="TRUE") {
}else{
	$sports = "FALSE";
}

if ($community=="TRUE") {
}else{
	$community = "FALSE";
}

if ($character=="TRUE") {
}else{
	$character = "FALSE";
}

if ($leadership=="TRUE") {
}else{
	$leadership = "FALSE";
}

if ($nutrition=="TRUE") {
}else{
	$nutrition = "FALSE";
}

if ($prevention=="TRUE") {
}else{
	$prevention = "FALSE";
}

if ($mentoring=="TRUE") {
}else{
	$mentoring = "FALSE";
}

if ($supportservices=="TRUE") {
}else{
	$supportservices = "FALSE";
}

if ($stem=="TRUE") {
}else{
	$stem = "FALSE";
}

if ($college=="TRUE") {
}else{
	$college = "FALSE";
}

$age5 = $_REQUEST['age5'];
$age6 = $_REQUEST['age6'];
$age7 = $_REQUEST['age7'];
$age8 = $_REQUEST['age8'];
$age9 = $_REQUEST['age9'];
$age10 = $_REQUEST['age10'];
$age11 = $_REQUEST['age11'];
$age12 = $_REQUEST['age12'];
$age13 = $_REQUEST['age13'];
$age14 = $_REQUEST['age14'];
$age15 = $_REQUEST['age15'];
$age16 = $_REQUEST['age16'];
$age17 = $_REQUEST['age17'];
$age18 = $_REQUEST['age18'];

if ($age5=="TRUE") {
}else{
	$age5 = "FALSE";
}

if ($age6=="TRUE") {
}else{
	$age6 = "FALSE";
}

if ($age7=="TRUE") {
}else{
	$age7 = "FALSE";
}

if ($age8=="TRUE") {
}else{
	$age8 = "FALSE";
}

if ($age9=="TRUE") {
}else{
	$age9 = "FALSE";
}

if ($age10=="TRUE") {
}else{
	$age10 = "FALSE";
}

if ($age11=="TRUE") {
}else{
	$age11 = "FALSE";
}

if ($age12=="TRUE") {
}else{
	$age12 = "FALSE";
}

if ($age13=="TRUE") {
}else{
	$age13 = "FALSE";
}

if ($age14=="TRUE") {
}else{
	$age14 = "FALSE";
}

if ($age15=="TRUE") {
}else{
	$age15 = "FALSE";
}

if ($age16=="TRUE") {
}else{
	$age16 = "FALSE";
}

if ($age17=="TRUE") {
}else{
	$age17 = "FALSE";
}

if ($age18=="TRUE") {
}else{
	$age18 = "FALSE";
}

$monstart = $_REQUEST['monstart'];
$monend = $_REQUEST['monend'];

$tuestart = $_REQUEST['tuestart'];
$tueend = $_REQUEST['tueend'];

$wedstart = $_REQUEST['wedstart'];
$wedend = $_REQUEST['wedend'];

$thustart = $_REQUEST['thustart'];
$thuend = $_REQUEST['thuend'];

$fristart = $_REQUEST['fristart'];
$friend = $_REQUEST['friend'];

$satstartweekend = $_REQUEST['satstartweekend'];
$satendweekend = $_REQUEST['satendweekend'];

$sunstartweekend = $_REQUEST['sunstartweekend'];
$sunendweekend = $_REQUEST['sunendweekend'];

//convert weekday times to time
$monstarttime = strtotime($monstart);
$monendtime = strtotime($monend);

$tuestarttime = strtotime($tuestart);
$tueendtime = strtotime($tueend);

$wedstarttime = strtotime($wedstart);
$wedendtime = strtotime($wedend);

$thustarttime = strtotime($thustart);
$thuendtime = strtotime($thuend);

$fristarttime = strtotime($fristart);
$friendtime = strtotime($friend);



// if user picked morning times put in moring variables and if afternoon times, afternoon variables
if ($monstart=='00:00:00') {
	$monstartmorning = '00:00:00';
	$monstartafter = '00:00:00';
}elseif ($monstarttime<strtotime('12:00:00')) {
	$monstartmorning = $monstart;
	$monstartafter = '00:00:00';
}else{
	$monstartmorning = '00:00:00';
	$monstartafter = $monstart;
}

if ($tuestart=='00:00:00') {
	$tuestartmorning = '00:00:00';
	$tuestartafter = '00:00:00';
}elseif ($tuestarttime<strtotime('12:00:00')) {
	$tuestartmorning = $tuestart;
	$tuestartafter = '00:00:00';
}else{
	$tuestartmorning = '00:00:00';
	$tuestartafter = $tuestart;
}

if ($wedstart=='00:00:00') {
	$wedstartmorning = '00:00:00';
	$wedstartafter = '00:00:00';
}elseif ($wedstarttime<strtotime('12:00:00')) {
	$wedstartmorning = $wedstart;
	$wedstartafter = '00:00:00';
}else{
	$wedstartmorning = '00:00:00';
	$wedstartafter = $wedstart;
}

if ($thustart=='00:00:00') {
	$thustartmorning = '00:00:00';
	$thustartafter = '00:00:00';
}elseif ($thustarttime<strtotime('12:00:00')) {
	$thustartmorning = $thustart;
	$thustartafter = '00:00:00';
}else{
	$thustartmorning = '00:00:00';
	$thustartafter = $thustart;
}

if ($fristart=='00:00:00') {
	$fristartmorning = '00:00:00';
	$fristartafter = '00:00:00';
}elseif ($fristarttime<strtotime('12:00:00')) {
	$fristartmorning = $fristart;
	$fristartafter = '00:00:00';
}else{
	$fristartmorning = '00:00:00';
	$fristartafter = $fristart;
}

if ($monend=='00:00:00') {
	$monendmorning = '00:00:00';
	$monendafter = '00:00:00';
}elseif ($monendtime<strtotime('12:00:00')) {
	$monendmorning = $monend;
	$monendafter = '00:00:00';
}else{
	$monendmorning = '00:00:00';
	$monendafter = $monend;
}

if ($tueend=='00:00:00') {
	$tueendmorning = '00:00:00';
	$tueendafter = '00:00:00';
}elseif ($tueendtime<strtotime('12:00:00')) {
	$tueendmorning = $tueend;
	$tueendafter = '00:00:00';
}else{
	$tueendmorning = '00:00:00';
	$tueendafter = $tueend;
}

if ($wedend=='00:00:00') {
	$wedendmorning = '00:00:00';
	$wedendafter = '00:00:00';
}elseif ($wedendtime<strtotime('12:00:00')) {
	$wedendmorning = $wedend;
	$wedendafter = '00:00:00';
}else{
	$wedendmorning = '00:00:00';
	$wedendafter = $wedend;
}

if ($thuend=='00:00:00') {
	$thuendmorning = '00:00:00';
	$thuendafter = '00:00:00';
}elseif ($thuendtime<strtotime('12:00:00')) {
	$thuendmorning = $thuend;
	$thuendafter = '00:00:00';
}else{
	$thuendmorning = '00:00:00';
	$thuendafter = $thuend;
}

if ($friend=='00:00:00') {
	$friendmorning = '00:00:00';
	$friendafter = '00:00:00';
}elseif ($friendtime<strtotime('12:00:00')) {
	$friendmorning = $friend;
	$friendafter = '00:00:00';
}else{
	$friendmorning = '00:00:00';
	$friendafter = $friend;
}

$charge = $_REQUEST['charge'];
$costfrequency = $_REQUEST['costfrequency'];
$costamount = $_REQUEST['costamount'];
$feeassistance = $_REQUEST['feeassistance'];
$scholarship = $_REQUEST['scholarship'];
$desassistance = $_REQUEST['desassistance'];
$mcdiscount = $_REQUEST['mcdiscount'];
$otherassistance = $_REQUEST['otherassistance'];
$transportation = $_REQUEST['transportation'];
$snacks = $_REQUEST['snacks'];
$breakfast = $_REQUEST['breakfast'];
$lunch = $_REQUEST['lunch'];
$dinner = $_REQUEST['dinner'];
$freelunch = $_REQUEST['freelunch'];
$spanish = $_REQUEST['spanish'];
$otherlanguage = $_REQUEST['otherlanguage'];

if ($charge=="TRUE") {
}else{
	$charge = "FALSE";
}

if ($feeassistance=="TRUE") {
}else{
	$feeassistance = "FALSE";
}

if ($scholarship=="TRUE") {
}else{
	$scholarship = "FALSE";
}

if ($desassistance=="TRUE") {
}else{
	$desassistance = "FALSE";
}

if ($mcdiscount=="TRUE") {
}else{
	$mcdiscount = "FALSE";
}

if ($otherassistance=="TRUE") {
}else{
	$otherassistance = "FALSE";
}

if ($transportation=="TRUE") {
}else{
	$transportation = "FALSE";
}

if ($snacks=="TRUE") {
}else{
	$snacks = "FALSE";
}

if ($breakfast=="TRUE") {
}else{
	$breakfast = "FALSE";
}

if ($lunch=="TRUE") {
}else{
	$lunch = "FALSE";
}

if ($dinner=="TRUE") {
}else{
	$dinner = "FALSE";
}

if ($spanish=="TRUE") {
}else{
	$spanish = "FALSE";
}

if ($otherlanguage=="TRUE") {
}else{
	$otherlanguage = "FALSE";
}

//update new sites
//if action = Save For THIS Summer Site and Continue &#62;&#62; then save this site and pass header back to newsummersites
if (!$_REQUEST['button2']) {
	// update just this site with these data
	$updatesite = "UPDATE azcase_sites SET \"age5\" = $age5, \"age6\" = $age6, \"age7\" = $age7, \"age8\" = $age8, \"age9\" = $age9, \"age10\" = $age10, \"age11\" = $age11, \"age12\" = $age12, \"age13\" = $age13, \"age14\" = $age14, \"age15\" = $age15, \"age16\" = $age16, \"age17\" = $age17, \"age18\" = $age18, \"arts\" = $arts, \"character\" = $character, \"leadership\" = $leadership, \"mentoring\" = $mentoring, \"nutrition\" = $nutrition, \"prevention\" = $prevention, \"sports\" = $sports, \"supportservices\" = $supportservices, \"academic\" = $academic, \"community\" = $community, \"monstartmorning\" = '$monstartmorning', \"tuestartmorning\" = '$tuestartmorning', \"wedstartmorning\" = '$wedstartmorning', \"thustartmorning\" = '$thustartmorning', \"fristartmorning\" = '$fristartmorning', \"monendmorning\" = '$monendmorning', \"tueendmorning\" = '$tueendmorning', \"wedendmorning\" = '$wedendmorning', \"thuendmorning\" = '$thuendmorning', \"friendmorning\" = '$friendmorning', \"monstartafter\" = '$monstartafter', \"tuestartafter\" = '$tuestartafter',  \"wedstartafter\" = '$wedstartafter', \"thustartafter\" = '$thustartafter', \"fristartafter\" = '$fristartafter', \"monendafter\" = '$monendafter', \"tueendafter\" = '$tueendafter', \"wedendafter\" = '$wedendafter', \"thuendafter\" = '$thuendafter', \"friendafter\" = '$friendafter', \"satstartweekend\" = '$satstartweekend', \"satendweekend\" = '$satendweekend', \"sunstartweekend\" = '$sunstartweekend', \"sunendweekend\" = '$sunendweekend', \"charge\" = $charge, \"costfrequency\" = $costfrequency, \"costamount\" = $costamount, \"feeassistance\" = $feeassistance, \"scholarship\" = $scholarship, \"desassistance\" = $desassistance, \"mcdiscount\" = $mcdiscount, \"otherassistance\" = $otherassistance, \"transportation\" = $transportation, \"snacks\" = $snacks, \"breakfast\" = $breakfast, \"lunch\" = $lunch, \"dinner\" = $dinner, \"freelunch\" = $freelunch, \"spanish\" = $spanish, \"otherlanguage\" = $otherlanguage, \"stem\" = $stem, \"college\" = $college WHERE siteid = $siteid;";
	pg_send_query($connection, $updatesite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsummersites.php Failed";
		$message = "\nPage: processnewsummersites.php\nFailed Query: $updatesite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}
	
	header("Location: http://maps.nijel.org/azcase_dev/azcase/phpadmin/newsummersites.php?lastsiteid=$siteid");

}elseif (!$_REQUEST['button1']) {
	// update all summer sites with these data
	$updatesite = "UPDATE azcase_sites SET \"age5\" = $age5, \"age6\" = $age6, \"age7\" = $age7, \"age8\" = $age8, \"age9\" = $age9, \"age10\" = $age10, \"age11\" = $age11, \"age12\" = $age12, \"age13\" = $age13, \"age14\" = $age14, \"age15\" = $age15, \"age16\" = $age16, \"age17\" = $age17, \"age18\" = $age18, \"arts\" = $arts, \"character\" = $character, \"leadership\" = $leadership, \"mentoring\" = $mentoring, \"nutrition\" = $nutrition, \"prevention\" = $prevention, \"sports\" = $sports, \"supportservices\" = $supportservices, \"academic\" = $academic, \"community\" = $community, \"monstartmorning\" = '$monstartmorning', \"tuestartmorning\" = '$tuestartmorning', \"wedstartmorning\" = '$wedstartmorning', \"thustartmorning\" = '$thustartmorning', \"fristartmorning\" = '$fristartmorning', \"monendmorning\" = '$monendmorning', \"tueendmorning\" = '$tueendmorning', \"wedendmorning\" = '$wedendmorning', \"thuendmorning\" = '$thuendmorning', \"friendmorning\" = '$friendmorning', \"monstartafter\" = '$monstartafter', \"tuestartafter\" = '$tuestartafter',  \"wedstartafter\" = '$wedstartafter', \"thustartafter\" = '$thustartafter', \"fristartafter\" = '$fristartafter', \"monendafter\" = '$monendafter', \"tueendafter\" = '$tueendafter', \"wedendafter\" = '$wedendafter', \"thuendafter\" = '$thuendafter', \"friendafter\" = '$friendafter', \"satstartweekend\" = '$satstartweekend', \"satendweekend\" = '$satendweekend', \"sunstartweekend\" = '$sunstartweekend', \"sunendweekend\" = '$sunendweekend', \"charge\" = $charge, \"costfrequency\" = $costfrequency, \"costamount\" = $costamount, \"feeassistance\" = $feeassistance, \"scholarship\" = $scholarship, \"desassistance\" = $desassistance, \"mcdiscount\" = $mcdiscount, \"otherassistance\" = $otherassistance, \"transportation\" = $transportation, \"snacks\" = $snacks, \"breakfast\" = $breakfast, \"lunch\" = $lunch, \"dinner\" = $dinner, \"freelunch\" = $freelunch, \"spanish\" = $spanish, \"otherlanguage\" = $otherlanguage, \"stem\" = $stem, \"college\" = $college WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid AND newsite = TRUE);";
	pg_send_query($connection, $updatesite);
	$res1 = pg_get_result($connection);
	$pgerror1 = pg_result_error($res1);
	if ($pgerror1!=FALSE) {
		require('header.php');
		echo "<h3>Save Error</h3><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
		require('footer.php');
		$to = "jd@nijel.org";
		$subject = "AZ Afterschool Program Directory Error: processnewsummersites.php Failed";
		$message = "\nPage: processnewsummersites.php\nFailed Query: $updatesite\nError: $pgerror1";
		mail($to,$subject,$message);
		die ();
	}else{}

	header("Location: http://maps.nijel.org/azcase_dev/azcase/phpadmin/newsummersitesurvey.php");

} // close if action

?>

