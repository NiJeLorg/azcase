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
////displayLogin();

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
?>
<body>
<h1>Admin: Search For Users, Sites and Locations</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a></p>
<h2>Search for Users</h2>
<form name="searchusers" action="adminsearchusers.php" method="POST">
<table cellpadding="2">
	<tr>
		<td align="right" width="75"><b>Name: </b></td>
		<td align="left"><input type="text" name="searchusername" value=""/></td>
	</tr>
	<tr>
		<td align="right" width="75"><b>Email: </b></td>
		<td align="left"><input type="email" name="searchuseremail" value=""/></td>
	</tr>
	<tr>
		<td align="right" width="75"><b>Organization Name: </b></td>
		<td align="left"><input type="text" name="searchorgname" value=""/></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="image" src="search.jpg" alt="Search" name="action" value="Search" /></td>
	</tr>
	</table>
<br />
</p>
</form>
<h2>Search for Sites</h2>
<form name="searchsites" action="adminsearchsites.php" method="POST">
<table cellpadding="2">
	<tr>
		<td align="right" width="75"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="searchname" value=""/></td>
	</tr>
	<tr>
		<td align="right" width="75"><b>Site Email: </b></td>
		<td align="left"><input type="email" name="searchemail" value=""/></td>
	</tr>
	<tr>
		<td align="right" width="75"><b>Site Phone Number: </b></td>
		<td align="left"><input type="text" name="searchphone" value=""/></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="image" src="search.jpg" alt="Search" name="action" value="Search" /></td>
	</tr>
	</table>
<br />
</p>
</form>
<h2>Search for Locations</h2>
<form name="search" action="adminsearchlocations.php" method="POST" onSubmit="return validateForm();">
<table cellpadding="2">
	<tr>
		<td align="right" width="75"><b>Within: </b></td>
		<td align="left">
			<select name="zoom">
			<option value="12">15</option>
			<option value="13" selected="selected">5</option>
			<option value="14">3</option>
			</select> miles of:
		</td>
	</tr>
	<tr>
		<td align="right" width="75"><b>Address: </b></td>
		<td align="left"><input type="text" name="searchstreet" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="75"><b>City: </b></td>
		<td align="left"><input type="text" name="searchcity" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="75"><b>State: </b></td>
		<td align="left"><input type="text" name="searchstate" size = "2" value="AZ" /></td>
	</tr>
	<tr>
		<td align="right" width="75"><b>Zip: </b></td>
		<td align="left"><input type="text" name="searchzip" size = "10" value="" /></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="image" src="search.jpg" alt="Search" name="action" value="Search" /></td>
	</tr>
	</table>
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

<script language="JavaScript">
function validateForm()
{
var valid = "0123456789-";
var hyphencount = 0;

// check if zip code is in right form
for (var i=0; i < document.forms[0].elements[4].value.length; i++) {
temp = "" + document.forms[0].elements[4].value.substring(i, i+1);
if (temp == "-") hyphencount++;
if (valid.indexOf(temp) == "-1") {
alert("'Invalid characters in your zip code.  Please try again.");
document.search.searchzip.focus();
return false;
}
}
if ((hyphencount > 1) || ((document.forms[0].elements[4].value.length==10) && ""+document.forms[0].elements[4].value.charAt(5)!="-")) {
alert("The hyphen character should be used with a properly formatted 5 digit+four zip code, like 12345-6789. Please try again.");
document.search.searchzip.focus();
return false;
   }

return true;
}

</script>

