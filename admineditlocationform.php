<?php
// create the add new sites form

// pull data for siteid 
$locationquery = "SELECT name, namesp, address, address2, city, state, zip FROM azcase_locations WHERE locationid = $locationid;";
$record = pg_query($connection, $locationquery);
for ($lt = 0; $lt < pg_numrows($record); $lt++) {
    $name = pg_result($record, $lt, 0);
    $namesp = pg_result($record, $lt, 1);
    $address = pg_result($record, $lt, 2);
    $address2 = pg_result($record, $lt, 3);
    $city = pg_result($record, $lt, 4);
    $state = pg_result($record, $lt, 5);
    $zip = pg_result($record, $lt, 6);
}

?>
<br />
<form name="editlocations" id="editlocations" action="processadmineditlocation.php" method="POST">
<input type="hidden" name="locationid" value="<?php echo $locationid; ?>" />
<input type="hidden" name="zoom" value="<?php echo $zoom; ?>" />
<input type="hidden" name="searchstreet" value="<?php echo $searchstreet; ?>" />
<input type="hidden" name="searchcity" value="<?php echo $searchcity; ?>" />
<input type="hidden" name="searchstate" value="<?php echo $searchstate; ?>" />
<input type="hidden" name="searchzip" value="<?php echo $searchzip; ?>" />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Location Name: </b></td>
		<td align="left"><input type="text" name="locationname" value="<?php echo $name; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location Name (Espanol): </b></td>
		<td align="left"><input type="text" name="locationnamesp" value="<?php echo $namesp; ?>" /></td>
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
		<td align="left"><input type="text" name="state" value="<?php echo $state; ?>" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip" value="<?php echo $zip; ?>" /></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="image" src="save.jpg" alt="Save" name="action" value="Save" /></td>
	</tr>
</table>
</form>



