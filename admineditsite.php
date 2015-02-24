<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// login to the system
require('login.php');

// create header
//require('header.php');

// processing login script
//displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

global $connection;
/* Verify that user partner is admin or not */
$useremailsession = pg_escape_string($_SESSION['useremail']);
$partnerquery = "SELECT admin FROM azcase_users WHERE useremail = '$useremailsession';";
$result = pg_query($connection, $partnerquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$admin = pg_result($result, $lt, 0);
}

if ($admin=='t') {


// accept site id
$siteid = $_REQUEST['siteid'];

// grab search terms if coming from search page
$searchname = $_REQUEST['searchname'];
$searchemail = $_REQUEST['searchemail'];
$searchphone = $_REQUEST['searchphone'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];


// add backtrack link if coming from search page
if (!$searchname && !$searchemail && !$searchphone && !$searchusername && !$searchuseremail && !$searchorgname) {
	$backurl = '';
}elseif (!$searchname && !$searchemail && !$searchphone){
	$backurl = " | <a href=\"adminsearchusers.php?searchusername=$searchusername&searchuseremail=$searchuseremail&searchorgname=$searchorgname\">&#60;&#60; Back to Your User Search Results</a>";
}elseif (!$searchusername && !$searchuseremail && !$searchorgname){
	$backurl = " | <a href=\"adminsearchsites.php?searchname=$searchname&searchemail=$searchemail&searchphone=$searchphone\">&#60;&#60; Back to Your Search Results For Sites</a>";
}


?>
<body>
<h1>Admin Edit Site</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="verifysites.php">&#60;&#60; Back to Verify Sites</a><?php echo $backurl; ?></p>
<p>Please edit any data below. Thanks!</p>
<?php

// add in the new locations form
require('admineditsiteform.php'); 

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');


?>

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






