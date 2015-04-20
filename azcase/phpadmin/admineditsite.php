<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

global $connection;
// accept site id
$siteid = $_REQUEST['siteid'];

?>
<body>
<h3 class="azcase-text-color">Admin Edit Program</h3>
<p>Please edit any data below. Thanks!</p>

<?php

// add in the new locations form
require('admineditsiteform.php'); 

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






