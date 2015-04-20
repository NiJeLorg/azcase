<?php
// create the add new locations where your organization operates form
?>
<h3 class="azcase-text-color">Add New Locations</h3>
<p>Add up to five new locations with this form.</p>
<form name="newlocation" action="processnewlocations.php" method="POST" onSubmit="return validateForm();">
<div class="col-md-6">
	<span class="required">* Required</span>
	<div class="form-group">
		<label>Location Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="locationname1" value="" />
	</div>
	<div class="form-group">
		<label>Location Name (Espanol): </label>
		<input class="form-control" type="text" name="locationnamesp1" value="" />
	</div>
	<div class="form-group">
		<label>Address: </label><span class="required">*</span>
		<input class="form-control" type="text" name="address1" value="" />
	</div>
	<div class="form-group">
		<label>Address Line 2: </label>
		<input class="form-control" type="text" name="address21" value="" />
	</div>
	<div class="form-group">
		<label>City: </label><span class="required">*</span>
		<input class="form-control" type="text" name="city1" value="" />
	</div>
	<div class="form-group">
		<label>State: </label><span class="required">*</span>
		<input class="form-control" type="text" name="state1" size = "2" value="AZ" />
	</div>
	<div class="form-group">
		<label>Zip: </label><span class="required">*</span>
		<input class="form-control" type="text" name="zip1" size = "10" value="" />
	</div>
<button type="button" class="btn btn-default" id="nl2_button" onClick="toggle('nl2_add'); disablebutton('nl2_button');">Add An Additional Location</button>
	</div>
</div>
<div class="clearfix"></div>
<div id="nl2_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Location Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="locationname2" value="" />
	</div>
	<div class="form-group">
		<label>Location Name (Espanol): </label>
		<input class="form-control" type="text" name="locationnamesp2" value="" />
	</div>
	<div class="form-group">
		<label>Address: </label><span class="required">*</span>
		<input class="form-control" type="text" name="address2" value="" />
	</div>
	<div class="form-group">
		<label>Address Line 2: </label>
		<input class="form-control" type="text" name="address22" value="" />
	</div>
	<div class="form-group">
		<label>City: </label><span class="required">*</span>
		<input class="form-control" type="text" name="city2" value="" />
	</div>
	<div class="form-group">
		<label>State: </label><span class="required">*</span>
		<input class="form-control" type="text" name="state2" size = "2" value="AZ" />
	</div>
	<div class="form-group">
		<label>Zip: </label><span class="required">*</span>
		<input class="form-control" type="text" name="zip2" size = "10" value="" />
	</div>

<button type="button" class="btn btn-default" id="nl3_button" onClick="toggle('nl3_add'); disablebutton('nl3_button');">Add An Additional Location</button>
	</div>
</div>
</div>
<div class="clearfix"></div>
<div id="nl3_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Location Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="locationname3" value="" />
	</div>
	<div class="form-group">
		<label>Location Name (Espanol): </label>
		<input class="form-control" type="text" name="locationnamesp3" value="" />
	</div>
	<div class="form-group">
		<label>Address: </label><span class="required">*</span>
		<input class="form-control" type="text" name="address3" value="" />
	</div>
	<div class="form-group">
		<label>Address Line 2: </label>
		<input class="form-control" type="text" name="address23" value="" />
	</div>
	<div class="form-group">
		<label>City: </label><span class="required">*</span>
		<input class="form-control" type="text" name="city3" value="" />
	</div>
	<div class="form-group">
		<label>State: </label><span class="required">*</span>
		<input class="form-control" type="text" name="state3" size = "2" value="AZ" />
	</div>
	<div class="form-group">
		<label>Zip: </label><span class="required">*</span>
		<input class="form-control" type="text" name="zip3" size = "10" value="" />
	</div>

<button type="button" class="btn btn-default" id="nl4_button" onClick="toggle('nl4_add'); disablebutton('nl4_button');">Add An Additional Location</button>
	</div>
</div>
</div>
<div class="clearfix"></div>
<div id="nl4_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Location Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="locationname4" value="" />
	</div>
	<div class="form-group">
		<label>Location Name (Espanol): </label>
		<input class="form-control" type="text" name="locationnamesp4" value="" />
	</div>
	<div class="form-group">
		<label>Address: </label><span class="required">*</span>
		<input class="form-control" type="text" name="address4" value="" />
	</div>
	<div class="form-group">
		<label>Address Line 2: </label>
		<input class="form-control" type="text" name="address24" value="" />
	</div>
	<div class="form-group">
		<label>City: </label><span class="required">*</span>
		<input class="form-control" type="text" name="city4" value="" />
	</div>
	<div class="form-group">
		<label>State: </label><span class="required">*</span>
		<input class="form-control" type="text" name="state4" size = "2" value="AZ" />
	</div>
	<div class="form-group">
		<label>Zip: </label><span class="required">*</span>
		<input class="form-control" type="text" name="zip4" size = "10" value="" />
	</div>

<button type="button" class="btn btn-default" id="nl5_button" onClick="toggle('nl5_add'); disablebutton('nl5_button');">Add An Additional Location</button>
	</div>
</div>
</div>
<div class="clearfix"></div>
<div id="nl5_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Location Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="locationname5" value="" />
	</div>
	<div class="form-group">
		<label>Location Name (Espanol): </label>
		<input class="form-control" type="text" name="locationnamesp5" value="" />
	</div>
	<div class="form-group">
		<label>Address: </label><span class="required">*</span>
		<input class="form-control" type="text" name="address5" value="" />
	</div>
	<div class="form-group">
		<label>Address Line 2: </label>
		<input class="form-control" type="text" name="address25" value="" />
	</div>
	<div class="form-group">
		<label>City: </label><span class="required">*</span>
		<input class="form-control" type="text" name="city5" value="" />
	</div>
	<div class="form-group">
		<label>State: </label><span class="required">*</span>
		<input class="form-control" type="text" name="state5" size = "2" value="AZ" />
	</div>
	<div class="form-group">
		<label>Zip: </label><span class="required">*</span>
		<input class="form-control" type="text" name="zip5" size = "10" value="" />
	</div>
</div>
</div>
<div class="clearfix"></div>
<br />
<div class="col-md-6">
	<input class="btn btn-default" type="submit" name="action" value="Save New Locations &#62;&#62;" />
</div>
</form>



