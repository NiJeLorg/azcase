<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

?>
<body>
<h3 class="azcase-text-color">Create New Provider User Accounts</h3>
<form name="newprovider" action="processnewprovider.php" method="POST" onSubmit="return validateForm();">
<div class="col-md-6">
	<span class="required">* Required</span>
	<div class="form-group">
		<label>Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="username" value="" /></div>
	<div class="form-group">
		<label>Email: </label><span class="required">*</span>
		<input class="form-control" type="email" name="useremail" value="" /></div>
	<div class="form-group">
		<label>Password: </label><span class="required">* Between 8 and 32 characters.</span>
		<input class="form-control" type="password" name="password" value="" /></div>
	<div class="form-group">
		<label>Retype Password: </label><span class="required">*</span>
		<input class="form-control" type="password" name="rtpassword" value="" /></div>
	<div class="form-group">
		<label>Organization Name: </label>
		<input class="form-control" type="text" name="orgname" value="" /></div>
	<div class="form-group">
		<label>Address: </label>
		<input class="form-control" type="text" name="address" value="" /></div>
	<div class="form-group">
		<label>Address Line 2: </label>
		<input class="form-control" type="text" name="address2" value="" /></div>
	<div class="form-group">
		<label>City: </label>
		<input class="form-control" type="text" name="city" value="" /></div>
	<div class="form-group">
		<label>State: </label>
		<input class="form-control" type="text" name="state" size = "2" value="AZ" /></div>
	<div class="form-group">
		<label>Zip: </label>
		<input class="form-control" type="text" name="zip" size = "10" value="" /></div>
	<div class="form-group">
		<label>Phone: </label>
		<input class="form-control" type="text" name="phone" size = "10" value="" /></div>
	<div class="form-group">
		<label>Fax: </label>
		<input class="form-control" type="text" name="fax" size = "10" value="" /></div>
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
var username = document.newprovider.username.value;
var useremail = document.newprovider.useremail.value;
var one = document.newprovider.password.value;
var another = document.newprovider.rtpassword.value;

if (username.length < 1) {
        alert("Please enter your name.");
	document.newprovider.username.focus();
        return false;
    }

if (useremail.length < 1) {
        alert("Please enter an email address.");
	document.newprovider.useremail.focus();
        return false;
    }

if (one.length < 8) {
        alert("Passwords cannot be less then 8 characters. Please try again.");
	document.newprovider.password.focus();
        return false;
    }

if (one.length > 32) {
        alert("Passwords cannot be more than 32 characters. Please try again.");
	document.newprovider.password.focus();
        return false;
    }

if (another.length < 8) {
        alert("Passwords cannot be less then 8 characters. Please try again.");
	document.newprovider.rtpassword.focus();
        return false;
    }

if (another.length > 32) {
        alert("Passwords cannot be more than 32 characters. Please try again.");
	document.newprovider.rtpassword.focus();
        return false;
    }

if (one !== another) {
	alert("Passwords do not match. Please try again.");
	document.newprovider.password.focus();
	return false;
    }

return true;

}

</script>


