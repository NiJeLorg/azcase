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

// grab data and clean up for database query
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];


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
<h1>Edit User Account Information</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="adminsearchusers.php?userid=<?php echo $userid; ?>&searchusername=<?php echo $searchusername; ?>&searchuseremail=<?php echo $searchuseremail; ?>&searchorgname=<?php echo $searchorgname; ?>">&#60;&#60; Back to Your Search Results For Users</a></p>
<span class="required">* Required</span>
<form name="editprovider" action="processadminedituser.php" method="POST" onSubmit="return validateForm();">
<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
<input type="hidden" name="useremailold" value="<?php echo $useremail; ?>" />
<input type="hidden" name="searchusername" value="<?php echo $searchusername; ?>" />
<input type="hidden" name="searchuseremail" value="<?php echo $searchuseremail; ?>" />
<input type="hidden" name="searchorgname" value="<?php echo $searchorgname; ?>" />

<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Your Name: </b></td>
		<td align="left"><input type="text" name="username" value="<?php echo $username; ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Email: </b></td>
		<td align="left"><input type="email" name="useremail" value="<?php echo $useremail; ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Organization Name: </b></td>
		<td align="left"><input type="text" name="orgname" value="<?php echo $orgname; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address: </b></td>
		<td align="left"><input type="text" name="address" value="<?php echo $address; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address Line 2: </b></td>
		<td align="left"><input type="text" name="address2" value="<?php echo $address2; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>City: </b></td>
		<td align="left"><input type="text" name="city" value="<?php echo $city; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>State: </b></td>
		<td align="left"><input type="text" name="state" size = "2" value="<?php echo $state; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip" size = "10" value="<?php echo $zip; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Phone: </b></td>
		<td align="left"><input type="text" name="phone" size = "10" value="<?php echo $phone; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Fax: </b></td>
		<td align="left"><input type="text" name="fax" size = "10" value="<?php echo $fax; ?>" /></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="image" src="save.jpg" alt="Save" name="action" value="Save" /></td>
	</tr>
	</table>
<br />
</p>
</form>
<br />

<?php
// close admin = TRUE
}else{}

// close logged_in
}else{}

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


