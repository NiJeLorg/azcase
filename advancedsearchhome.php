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
<form name="search" action="advancedsearch.php" method="POST" onSubmit="return validateForm();">
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
	</table>
	<br />
	<h1><?php echo $langtext['Advanced Search Options']; ?></h1>
	<p><?php echo $langtext['To narrow your search results, make one or more selections below. Please note that the information below is not currently available for all programs, but providers are continuing to add and update their directory listings.']; ?>
	</p>
	<b><?php echo $langtext['Select From School Year or Summer Programs']; ?>:</b>
	<table cellpadding="0">
		<tr>
			<td align="right" width="25"><input type="radio" name="summer" value="1" /> </td>
			<td align="left"><?php echo $langtext['Programs that are open ONLY during the school year']; ?></td>
		</tr>
		<tr>
			<td align="right" width="25"><input type="radio" name="summer" value="2" /> </td>
			<td align="left"><?php echo $langtext['Programs that are open ONLY during the summer']; ?></td>
		</tr>
		<tr>
			<td align="right" width="25"><input type="radio" name="summer" value="3" /> </td>
			<td align="left"><?php echo $langtext['Programs that are open during BOTH the school year and summer']; ?></td>
		</tr>
	</table>
	<br />
	<b><?php echo $langtext['Select Program Activities']; ?>:</b>
	<table cellpadding="0">
		<tr>
			<td align="right" width="25"><input type="checkbox" name="academic" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Tutoring/Academic Enrichment']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="arts" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Arts and Culture']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="sports" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Sports and Recreation']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="community" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Volunteering/Community Service']; ?></td>
		</tr>
		<tr>
			<td align="right" width="25"><input type="checkbox" name="stem" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Science, Technology, Engineering, and Mathematics']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="college" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['College and Career Readiness']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="leadership" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Leadership']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="character" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Character Education']; ?></td>
		</tr>
		<tr>
			<td align="right" width="25"><input type="checkbox" name="prevention" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Prevention']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="nutrition" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Nutrition']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="mentoring" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Mentoring']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="supportservices" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Support Services (medical, dental, mental health, etc.)']; ?></td>
		</tr>
	</table>
	<br />
	<b><?php echo $langtext['Select Ages Served']; ?>:</b>
	<table cellpadding="0">
		<tr>
			<td align="right" width="25"><input type="checkbox" name="age5_8" value="TRUE"> </td>
			<td align="left" width="175">5 - 8</td>
			<td align="right" width="25"><input type="checkbox" name="age9_11" value="TRUE"> </td>
			<td align="left" width="175">9 - 11</td>
			<td align="right" width="25"><input type="checkbox" name="age12_14" value="TRUE"> </td>
			<td align="left" width="175">12 - 14</td>
			<td align="right" width="25"><input type="checkbox" name="age15_18" value="TRUE"> </td>
			<td align="left" width="175">15 - 18</td>
		</tr>
	</table>
	<br />
	
	<b><?php echo $langtext['Select Special Features']; ?>:</b>
	<table cellpadding="0">
		<tr>
			<td align="right" width="25"><input type="checkbox" name="charge" value="FALSE"> </td>
			<td align="left" width="175"><?php echo $langtext['No Fee']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="feeassistance" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Financial Assistance Available']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="scholarship" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Scholarships Available']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="desassistance" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Accepts DES Child Care Subsidy']; ?></td>
		</tr>
		<tr>
			<td align="right" width="25"><input type="checkbox" name="transportation" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Transportation Provided']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="food" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Provides Snacks and/or Meals']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="spanish" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Spanish-speaking Staff']; ?></td>
			<td align="right" width="25"><input type="checkbox" name="otherlanguage" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Other Languages Spoken']; ?></td>
		</tr>
		<tr>
			<td align="right" width="25"><input type="checkbox" name="mcdiscount" value="TRUE"> </td>
			<td align="left" width="175"><?php echo $langtext['Multiple Child Discount Available']; ?></td>
		</tr>
		<tr>
			<td colspan="8" align="right"><input type="image" src="search.jpg" alt="Search" name="action" value="Search" /></td>
		</tr>
	</table>
	</form>

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

