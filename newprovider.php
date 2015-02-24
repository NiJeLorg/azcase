<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

?>
<body>
<h1>Sign Up for an Account</h1>
<p>Please sign up below to add your programs and sites to the AZ Afterschool Program Directory. <br />
<span class="required">* Required</span>
</p>
<form name="newprovider" action="processnewprovider.php" method="POST" onSubmit="return validateForm();">
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Your Name: </b></td>
		<td align="left"><input type="text" name="username" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Email: </b></td>
		<td align="left"><input type="email" name="useremail" value="" /><span class="required">* This will be your login id.</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Password: </b></td>
		<td align="left"><input type="password" name="password" value="" /><span class="required">* Between 8 and 32 characters.</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Retype Password: </b></td>
		<td align="left"><input type="password" name="rtpassword" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Organization Name: </b></td>
		<td align="left"><input type="text" name="orgname" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address: </b></td>
		<td align="left"><input type="text" name="address" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address Line 2: </b></td>
		<td align="left"><input type="text" name="address2" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>City: </b></td>
		<td align="left"><input type="text" name="city" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>State: </b></td>
		<td align="left"><input type="text" name="state" size = "2" value="AZ" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Phone: </b></td>
		<td align="left"><input type="text" name="phone" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Fax: </b></td>
		<td align="left"><input type="text" name="fax" size = "10" value="" /></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="image" src="save.jpg" alt="Save" name="action" value="Save" /></td>
	</tr>
	</table>
<br />
</p>
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


