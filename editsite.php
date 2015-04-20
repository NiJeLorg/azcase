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
require('header.php');

// processing login script
displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// accept site id
$siteid = $_REQUEST['siteid'];

?>
<body>
<h1>Edit Site</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a></p>
<p>Please edit any data below. Thanks!</p>
<?php

// add in the new locations form
require('editsiteform.php'); 

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

function validateForm() {
	var sitename = document.editsites.sitename.value;
	if (sitename.length == 0) {
        alert("Please enter a site name.");
		document.editsites.sitename.focus();
        return false;
    }
    
	var phone = document.editsites.phone.value;
	if (phone.length == 0) {
        alert("Please enter a phone number.");
		document.editsites.phone.focus();
        return false;
    }
    
    	var email = document.editsites.email.value;
	if (email.length == 0) {
        alert("Please enter an email address.");
		document.editsites.email.focus();
        return false;
    }

	// activity checkbox values
	var activity = document.editsites.activity.checked;
	var activityacademic = document.editsites.activityacademic.checked;
	var activityarts = document.editsites.activityarts.checked;
	var activitysports = document.editsites.activitysports.checked;
	var activitycommunity = document.editsites.activitycommunity.checked;
	var activitystem = document.editsites.activitystem.checked;
	var activitycollege = document.editsites.activitycollege.checked;
	var activityleadership = document.editsites.activityleadership.checked;
	var activitycharacter = document.editsites.activitycharacter.checked;
	var activityprevention = document.editsites.activityprevention.checked;
	var activitynutrition = document.editsites.activitynutrition.checked;
	var activitymentoring = document.editsites.activitymentoring.checked;
	var activitysupportservices = document.editsites.activitysupportservices.checked;
	
	if (activity == false && activityacademic == false && activityarts == false && activitysports == false && activitycommunity == false && activitystem == false && activitycollege == false && activityleadership == false && activitycharacter == false && activityprevention == false && activitynutrition == false && activitymentoring == false && activitysupportservices == false) {
        alert("Please select at least one program activity category.");
		document.editsites.activity.focus();
        return false;
    }
	
	// age checkbox values
	var age = document.editsites.age.checked;
	var age5 = document.editsites.age5.checked;
	var age6 = document.editsites.age6.checked;
	var age7 = document.editsites.age7.checked;
	var age8 = document.editsites.age8.checked;
	var age9 = document.editsites.age9.checked;
	var age10 = document.editsites.age10.checked;
	var age11 = document.editsites.age11.checked;
	var age12 = document.editsites.age12.checked;
	var age13 = document.editsites.age13.checked;
	var age14 = document.editsites.age14.checked;
	var age15 = document.editsites.age15.checked;
	var age16 = document.editsites.age16.checked;
	var age17 = document.editsites.age17.checked;
	var age18 = document.editsites.age18.checked;
	
	if (age == false && age5 == false && age6 == false && age7 == false && age8 == false && age9 == false && age10 == false && age11 == false && age12 == false && age13 == false && age14 == false && age15 == false && age16 == false && age17 == false && age18 == false) {
        alert("Please select at least one age category served.");
		document.editsites.age.focus();
        return false;
    }
    
	// times selected?
	var monstartmorning = document.editsites.monstartmorning.value;
	var monendmorning = document.editsites.monendmorning.value;
	var monstartafter = document.editsites.monstartafter.value;
	var monendafter = document.editsites.monendafter.value;
    
	var tuestartmorning = document.editsites.tuestartmorning.value;
	var tueendmorning = document.editsites.tueendmorning.value;
	var tuestartafter = document.editsites.tuestartafter.value;
	var tueendafter = document.editsites.tueendafter.value;
    
	var wedstartmorning = document.editsites.wedstartmorning.value;
	var wedendmorning = document.editsites.wedendmorning.value;
	var wedstartafter = document.editsites.wedstartafter.value;
	var wedendafter = document.editsites.wedendafter.value;
    
	var thustartmorning = document.editsites.thustartmorning.value;
	var thuendmorning = document.editsites.thuendmorning.value;
	var thustartafter = document.editsites.thustartafter.value;
	var thuendafter = document.editsites.thuendafter.value;

	var fristartmorning = document.editsites.fristartmorning.value;
	var friendmorning = document.editsites.friendmorning.value;
	var fristartafter = document.editsites.fristartafter.value;
	var friendafter = document.editsites.friendafter.value;

	var satstartweekend = document.editsites.satstartweekend.value;
	var satendweekend = document.editsites.satendweekend.value;
	var sunstartweekend = document.editsites.sunstartweekend.value;
	var sunendweekend = document.editsites.sunendweekend.value;

	if (monstartmorning == '00:00:00' && monendmorning == '00:00:00' && monstartafter == '00:00:00' && monendafter == '00:00:00' && 
	    tuestartmorning == '00:00:00' && tueendmorning == '00:00:00' && tuestartafter == '00:00:00' && tueendafter == '00:00:00' && 
	    wedstartmorning == '00:00:00' && wedendmorning == '00:00:00' && wedstartafter == '00:00:00' && wedendafter == '00:00:00' && 
	    thustartmorning == '00:00:00' && thuendmorning == '00:00:00' && thustartafter == '00:00:00' && thuendafter == '00:00:00' && 
	    fristartmorning == '00:00:00' && friendmorning == '00:00:00' && fristartafter == '00:00:00' && friendafter == '00:00:00' && 
	    satstartweekend == '00:00:00' && satendweekend == '00:00:00' && sunstartweekend == '00:00:00' && sunendweekend == '00:00:00') {
	    
        alert("Please select hours of operation.");
		document.editsites.monstartmorning.focus();
        return false;
    }
	    
	return true;
}




</script>

<!--****Check all boxes****-->
<script src="js/CheckBoxGroup.js" type="text/javascript"></script>
<script type="text/javascript">
	// set up check box groups
	var ageGroup = new CheckBoxGroup();
	ageGroup.addToGroup("age*");
	ageGroup.setControlBox("age");
	ageGroup.setMasterBehavior("all");
	var activityGroup = new CheckBoxGroup();
	activityGroup.addToGroup("activity*");
	activityGroup.setControlBox("activity");
	activityGroup.setMasterBehavior("all");

</script>






