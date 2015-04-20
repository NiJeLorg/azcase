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
<div class="col-md-6">
	<div class="form-group"><label>Location Name: </label>
		<input class="form-control" type="text" name="locationname" value="<?php echo $name; ?>" />
	</div>
	<div class="form-group"><label>Location Name (Espanol): </label>
		<input class="form-control" type="text" name="locationnamesp" value="<?php echo $namesp; ?>" />
	</div>
	<div class="form-group"><label>Address: </label>
		<input class="form-control" type="text" name="address" value="<?php echo $address; ?>" />
	</div>
	<div class="form-group"><label>Address Line 2: </label>
		<input class="form-control" type="text" name="address2" value="<?php echo $address2; ?>" />
	</div>
	<div class="form-group"><label>City: </label>
		<input class="form-control" type="text" name="city" value="<?php echo $city; ?>" />
	</div>
	<div class="form-group"><label>State: </label>
		<input class="form-control" type="text" name="state" value="<?php echo $state; ?>" />
	</div>
	<div class="form-group"><label>Zip: </label>
		<input class="form-control" type="text" name="zip" value="<?php echo $zip; ?>" />
	</div>
	<input class="btn btn-default" type="submit" name="action" value="Save" />
</div>
</form>



