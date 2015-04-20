<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

global $connection;


// grab data and clean up for database query
$userid = $_REQUEST['userid'];


// pull user/org info
$basicinfoquery = "SELECT 
userid,
username,
useremail,
updated,
orgname,
address,
address2,
city,
state,
zip,
phone,
fax
FROM azcase_users WHERE userid = $userid;";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
	$username = pg_result($basicinforesult, $lt, 1);
	$useremail = pg_result($basicinforesult, $lt, 2);
	$updated = pg_result($basicinforesult, $lt, 3);
	$orgname = pg_result($basicinforesult, $lt, 4);
	$address = pg_result($basicinforesult, $lt, 5);
	$address2 = pg_result($basicinforesult, $lt, 6);
	$city = pg_result($basicinforesult, $lt, 7);
	$state = pg_result($basicinforesult, $lt, 8);
	$zip = pg_result($basicinforesult, $lt, 9);
	$phone = pg_result($basicinforesult, $lt, 10);
	$fax = pg_result($basicinforesult, $lt, 11);
}


?>
<body>
<h3 class="azcase-text-color">Edit User Account Information</h3>
<span class="required">* Required</span>
<form name="editprovider" action="processadminedituser.php" method="POST" onSubmit="return validateForm();">
<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
<input type="hidden" name="useremailold" value="<?php echo $useremail; ?>" />
<div class="col-md-6">
	<div class="form-group">
		<label>Your Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="username" value="<?php echo $username; ?>" />
	</div>
	<div class="form-group">
		<label>Email: </label><span class="required">*</span>
		<input class="form-control" type="email" name="useremail" value="<?php echo $useremail; ?>" />
	</div>
	<div class="form-group">
		<label>Organization Name: </label>
		<input class="form-control" type="text" name="orgname" value="<?php echo $orgname; ?>" />
	</div>
	<div class="form-group">
		<label>Address: </label>
		<input class="form-control" type="text" name="address" value="<?php echo $address; ?>" />
	</div>
	<div class="form-group">
		<label>Address Line 2: </label>
		<input class="form-control" type="text" name="address2" value="<?php echo $address2; ?>" />
	</div>
	<div class="form-group">
		<label>City: </label>
		<input class="form-control" type="text" name="city" value="<?php echo $city; ?>" />
	</div>
	<div class="form-group">
		<label>State: </label>
		<input class="form-control" type="text" name="state" size = "2" value="<?php echo $state; ?>" />
	</div>
	<div class="form-group">
		<label>Zip: </label>
		<input class="form-control" type="text" name="zip" size = "10" value="<?php echo $zip; ?>" />
	</div>
	<div class="form-group">
		<label>Phone: </label>
		<input class="form-control" type="text" name="phone" size = "10" value="<?php echo $phone; ?>" />
	</div>
	<div class="form-group">
		<label>Fax: </label>
		<input class="form-control" type="text" name="fax" size = "10" value="<?php echo $fax; ?>" />
	</div>
	<input class="btn btn-default" type="submit" name="action" value="Save" />
</div>
</form>

<?php
// create footer
require('footer.php');

?>

<!-- validate that the fields are identical -->
<script type="text/javascript" language="JavaScript">

function validateForm() {
var username = document.editprovider.username.value;
var useremail = document.editprovider.useremail.value;

if (username.length < 1) {
        alert("Please enter a name.");
	document.newprovider.username.focus();
        return false;
    }

if (useremail.length < 1) {
        alert("Please enter an email address.");
	document.newprovider.useremail.focus();
        return false;
    }

return true;

}

</script>


