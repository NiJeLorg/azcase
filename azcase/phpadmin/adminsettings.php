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

global $connection;
/* Verify that user partner is admin or not */
$useremailsession = pg_escape_string($_SESSION['useremail']);
$partnerquery = "SELECT admin FROM azcase_users WHERE useremail = '$useremailsession';";
$result = pg_query($connection, $partnerquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$admin = pg_result($result, $lt, 0);
}

if ($admin=='t') {

// pull user/org info
$basicinfoquery = "SELECT 
userid,
username,
updated,
orgname,
address,
address2,
city,
state,
zip,
phone,
fax
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
	$username = pg_result($basicinforesult, $lt, 1);
	$updated = pg_result($basicinforesult, $lt, 2);
	$orgname = pg_result($basicinforesult, $lt, 3);
	$address = pg_result($basicinforesult, $lt, 4);
	$address2 = pg_result($basicinforesult, $lt, 5);
	$city = pg_result($basicinforesult, $lt, 6);
	$state = pg_result($basicinforesult, $lt, 7);
	$zip = pg_result($basicinforesult, $lt, 8);
	$phone = pg_result($basicinforesult, $lt, 9);
	$fax = pg_result($basicinforesult, $lt, 10);
}


?>
<body>
<h1>Edit Your Account Information</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a></p>
<span class="required">* Required</span>
<form name="editprovider" action="processadminsettings.php" method="POST" onSubmit="return validateForm();">
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Your Name: </b></td>
		<td align="left"><input type="text" name="username" value="<?php echo $username; ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Email: </b></td>
		<td align="left"><input type="email" name="useremail" value="<?php echo $_SESSION['useremail']; ?>" /><span class="required">* This is your login id.</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Password: </b></td>
		<td align="left"><a href="changepassword.php">Change Password</a></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
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
<h1>Assign New Administrators</h1>
<p>If you would like to add other users to assist in administering the AZ Afterschool Program Directory, please enter their email address below.</p>
<form name="search" action="assignadmins.php" method="POST">
<table cellpadding="2">
	<tr>
		<td align="right" width="75"><b>Email: </b></td>
		<td align="left"><input type="email" name="email" value=""/></td>
		<td align="left"><input type="image" src="search.jpg" alt="Search" name="action" value="Search" /></td>
	</tr>
	</table>
<br />
</p>
</form>
<?php
// create list of users already assigned to manage this users content


$otherusersquery = "SELECT userid, username, useremail FROM azcase_users WHERE userid <> $userid AND admin = TRUE;";
$otherusersresult = pg_query($connection, $otherusersquery);

// loop though sites if user has sites associated - if not skip
if (pg_numrows($otherusersresult)==0) {
}else{

$otheruserstable = "<h1>Other Administrators</h1>
<p>If you would like to remove any users from the administrators group, please select them below.</p>
<form name=\"editremove\" action=\"processremoveassignedadmins.php\" method=\"POST\">
<table class=\"hoursTable\"><tr>
<th>Select</th>
<th>Name</th>
<th>Email</th>
</tr>
";

for ($lt = 0; $lt < pg_numrows($otherusersresult); $lt++) {
	$assigneduserid = pg_result($otherusersresult, $lt, 0);
	$assignedusername = pg_result($otherusersresult, $lt, 1);
	$assigneduseremail = pg_result($otherusersresult, $lt, 2);

if ($lt&1) {
	$trclass = "<tr class=\"alt\">";
}else{
	$trclass = "<tr>";
}

// add a new row to the sites table
$otheruserstable .= $trclass;
$otheruserstable .= "<td align=\"center\"><input type=\"checkbox\" name=\"$assigneduserid\" value=\"t\" /></td>
<td>$assignedusername</td>
<td>$assigneduseremail</td>
</tr>";

} // close other users loop

// close up the sites table
$otheruserstable .= "
</table>
<br />
<input type=\"submit\" name=\"remove\" value=\"Remove Adminitrators\" />
</form>
";

} // close if then if other users exist

echo $otheruserstable;

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
        alert("Please enter your name.");
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


