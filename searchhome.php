<?php
ini_set('session.cache_limiter', 'private');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// language traslation script
require('language.php');


?>

<body>
<h1><?php echo $langtext['Find Programs Near You']; ?></h1>
<p>
<form name="search" action="search.php" method="POST" onSubmit="return validateForm();">
<table cellpadding="2">
	<tr>
		<td align="right" width="100"><b><?php echo $langtext['Within']; ?>: </b></td>
		<td align="left">
			<select name="zoom">
			<option value="12">15</option>
			<option value="13" selected="selected">5</option>
			<option value="14">3</option>
			</select> <?php echo $langtext['miles of']; ?>:
		</td>
	</tr>
	<tr>
		<td align="right" width="75"><b><?php echo $langtext['Address']; ?>: </b></td>
		<td align="left"><input type="text" name="searchstreet" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="75"><b><?php echo $langtext['City']; ?>: </b></td>
		<td align="left"><input type="text" name="searchcity" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="75"><b><?php echo $langtext['State']; ?>: </b></td>
		<td align="left"><input type="text" name="searchstate" size = "2" value="AZ" /></td>
	</tr>
	<tr>
		<td align="right" width="75"><b><?php echo $langtext['Zip']; ?>: </b></td>
		<td align="left"><input type="text" name="searchzip" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="75"><b><?php echo $langtext['Language']; ?>: </b></td>
		<td align="left">
			<select name="language">
			<option value="1" <?php if ($language==1) { echo 'selected="selected"'; }else{} ?>>English</option>
			<option value="2" <?php if ($language==2) { echo 'selected="selected"'; }else{} ?>>Español</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="image" src="search.jpg" alt="Search" name="action" value="Search" /></td>
	</tr>
	</table>
<br />
</p>
</form>
<br />
<h2><a href="advancedsearchhome.php?language=<?php echo $language; ?>"><?php echo $langtext['Click Here For Advanced Search Options']; ?></a></h2>
<p><?php echo $langtext['Search for programs based on activities available, ages served, or special features, including financial assistance, acceptance of DES Child Care subsidies, availability of summer programs, and other specialized program options.']; ?>
</p>

<?php

// create footer
require('footer.php');
?>

<!-- form validation -->
<script type="text/javascript" language="JavaScript">
function validateForm()
{
var valid = "0123456789-";
var hyphencount = 0;

// check if zip code is in right form
for (var i=0; i < document.forms[0].elements[4].value.length; i++) {
temp = "" + document.forms[0].elements[4].value.substring(i, i+1);
if (temp == "-") hyphencount++;
if (valid.indexOf(temp) == "-1") {
alert("<?php echo $langtext['Invalid characters in your zip code.  Please try again.']; ?>");
document.search.searchzip.focus();
return false;
}
}
if ((hyphencount > 1) || ((document.forms[0].elements[4].value.length==10) && ""+document.forms[0].elements[4].value.charAt(5)!="-")) {
alert("<?php echo $langtext['The hyphen character should be used with a properly formatted 5 digit+four zip code, like 12345-6789. Please try again.']; ?>");
document.search.searchzip.focus();
return false;
   }

return true;
}
</script>

