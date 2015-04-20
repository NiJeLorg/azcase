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

?>
<body>
<h1>Add New Sites</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a> | <a href="existinglocations.php">&#60;&#60; Back to View Your Existing Locations</a></p>
<p>Please add new sites using the form below. Here you can add up to 30 sites or programs that have the <i>same information</i> on activities, ages served, and hours of operation. You'll have the opportunity later to add other sites that have different activities, hours, and ages served. Thank you!</p>
<p><b>Please note</b> that you will be able to designate these sites as <b>school year or summer sites</b> later on in the process.</p>
<?php

// add in the new locations form
require('addnewsitesform.php'); 

// close logged_in
}else{}

// create footer
require('footer.php');

// geocode data on index page and admin index page
require('geocode.php');

?>

<script type="text/javascript">

// check to see if name, phone, email 
function validateForm() {
	var sitename1 = document.newsites.sitename1.value;
	if (sitename1.length == 0) {
        alert("Please enter a site name.");
		document.newsites.sitename1.focus();
        return false;
    }

	var phone1 = document.newsites.phone1.value;
	if (phone1.length == 0) {
        alert("Please enter a phone number.");
		document.newsites.phone1.focus();
        return false;
    }
    
    	var email1 = document.newsites.email1.value;
	if (email1.length == 0) {
        alert("Please enter an email address.");
		document.newsites.email1.focus();
        return false;
    }

	// activity checkbox values
	var activity = document.newsites.activity.checked;
	var activityacademic = document.newsites.activityacademic.checked;
	var activityarts = document.newsites.activityarts.checked;
	var activitysports = document.newsites.activitysports.checked;
	var activitycommunity = document.newsites.activitycommunity.checked;
	var activitystem = document.newsites.activitystem.checked;
	var activitycollege = document.newsites.activitycollege.checked;
	var activityleadership = document.newsites.activityleadership.checked;
	var activitycharacter = document.newsites.activitycharacter.checked;
	var activityprevention = document.newsites.activityprevention.checked;
	var activitynutrition = document.newsites.activitynutrition.checked;
	var activitymentoring = document.newsites.activitymentoring.checked;
	var activitysupportservices = document.newsites.activitysupportservices.checked;
	
	if (activity == false && activityacademic == false && activityarts == false && activitysports == false && activitycommunity == false && activitystem == false && activitycollege == false && activityleadership == false && activitycharacter == false && activityprevention == false && activitynutrition == false && activitymentoring == false && activitysupportservices == false) {
        alert("Please select at least one program activity category.");
		document.newsites.activity.focus();
        return false;
    }
	
	// age checkbox values
	var age = document.newsites.age.checked;
	var age5 = document.newsites.age5.checked;
	var age6 = document.newsites.age6.checked;
	var age7 = document.newsites.age7.checked;
	var age8 = document.newsites.age8.checked;
	var age9 = document.newsites.age9.checked;
	var age10 = document.newsites.age10.checked;
	var age11 = document.newsites.age11.checked;
	var age12 = document.newsites.age12.checked;
	var age13 = document.newsites.age13.checked;
	var age14 = document.newsites.age14.checked;
	var age15 = document.newsites.age15.checked;
	var age16 = document.newsites.age16.checked;
	var age17 = document.newsites.age17.checked;
	var age18 = document.newsites.age18.checked;
	
	if (age == false && age5 == false && age6 == false && age7 == false && age8 == false && age9 == false && age10 == false && age11 == false && age12 == false && age13 == false && age14 == false && age15 == false && age16 == false && age17 == false && age18 == false) {
        alert("Please select at least one age category served.");
		document.newsites.age.focus();
        return false;
    }
    
	// times selected?
	var monstartmorning = document.newsites.monstartmorning.value;
	var monendmorning = document.newsites.monendmorning.value;
	var monstartafter = document.newsites.monstartafter.value;
	var monendafter = document.newsites.monendafter.value;
    
	var tuestartmorning = document.newsites.tuestartmorning.value;
	var tueendmorning = document.newsites.tueendmorning.value;
	var tuestartafter = document.newsites.tuestartafter.value;
	var tueendafter = document.newsites.tueendafter.value;
    
	var wedstartmorning = document.newsites.wedstartmorning.value;
	var wedendmorning = document.newsites.wedendmorning.value;
	var wedstartafter = document.newsites.wedstartafter.value;
	var wedendafter = document.newsites.wedendafter.value;
    
	var thustartmorning = document.newsites.thustartmorning.value;
	var thuendmorning = document.newsites.thuendmorning.value;
	var thustartafter = document.newsites.thustartafter.value;
	var thuendafter = document.newsites.thuendafter.value;

	var fristartmorning = document.newsites.fristartmorning.value;
	var friendmorning = document.newsites.friendmorning.value;
	var fristartafter = document.newsites.fristartafter.value;
	var friendafter = document.newsites.friendafter.value;

	var satstartweekend = document.newsites.satstartweekend.value;
	var satendweekend = document.newsites.satendweekend.value;
	var sunstartweekend = document.newsites.sunstartweekend.value;
	var sunendweekend = document.newsites.sunendweekend.value;

	if (monstartmorning == '00:00:00' && monendmorning == '00:00:00' && monstartafter == '00:00:00' && monendafter == '00:00:00' && 
	    tuestartmorning == '00:00:00' && tueendmorning == '00:00:00' && tuestartafter == '00:00:00' && tueendafter == '00:00:00' && 
	    wedstartmorning == '00:00:00' && wedendmorning == '00:00:00' && wedstartafter == '00:00:00' && wedendafter == '00:00:00' && 
	    thustartmorning == '00:00:00' && thuendmorning == '00:00:00' && thustartafter == '00:00:00' && thuendafter == '00:00:00' && 
	    fristartmorning == '00:00:00' && friendmorning == '00:00:00' && fristartafter == '00:00:00' && friendafter == '00:00:00' && 
	    satstartweekend == '00:00:00' && satendweekend == '00:00:00' && sunstartweekend == '00:00:00' && sunendweekend == '00:00:00') {
	    
        alert("Please select hours of operation.");
		document.newsites.monstartmorning.focus();
        return false;
    }
	    
	return true;
}


function inputFocus(i){
    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
}
function inputBlur(i){
    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
}

function toggle(obj) {
	var el = document.getElementById(obj);
	if ( el.style.display == 'none' ) {
		el.style.display = '';
	}
	else {
	}
}

function disablebutton(obj) {
	var db = document.getElementById(obj);
	db.disabled=true;	
}


function copyWeekdayTimes() {
	document.newsites.tuestartmorning.value=document.newsites.monstartmorning.value;
	document.newsites.wedstartmorning.value=document.newsites.monstartmorning.value;
	document.newsites.thustartmorning.value=document.newsites.monstartmorning.value;
	document.newsites.fristartmorning.value=document.newsites.monstartmorning.value;

	document.newsites.tueendmorning.value=document.newsites.monendmorning.value;
	document.newsites.wedendmorning.value=document.newsites.monendmorning.value;
	document.newsites.thuendmorning.value=document.newsites.monendmorning.value;
	document.newsites.friendmorning.value=document.newsites.monendmorning.value;

	document.newsites.tuestartafter.value=document.newsites.monstartafter.value;
	document.newsites.wedstartafter.value=document.newsites.monstartafter.value;
	document.newsites.thustartafter.value=document.newsites.monstartafter.value;
	document.newsites.fristartafter.value=document.newsites.monstartafter.value;

	document.newsites.tueendafter.value=document.newsites.monendafter.value;
	document.newsites.wedendafter.value=document.newsites.monendafter.value;
	document.newsites.thuendafter.value=document.newsites.monendafter.value;
	document.newsites.friendafter.value=document.newsites.monendafter.value;
}

function copyWeekendTimes() {
	document.newsites.sunstartweekend.value=document.newsites.satstartweekend.value;
	document.newsites.sunendweekend.value=document.newsites.satendweekend.value;
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






