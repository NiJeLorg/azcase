<?php
// create the add new locations where your organization operates form
?>
<br />
<h1>Add New Locations Where Your Organizaiton Operates</h1>
<p>Please add any new locations that are not aviable on the map above. You can add up to five new locations here. If you need to add more than five, please return to this form to add more. Thanks! <br />
<span class="required">* Required</span>
<form name="newlocation" action="processnewlocations.php" method="POST" onSubmit="return validateForm();">
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Location Name: </b></td>
		<td align="left"><input type="text" name="locationname1" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location Name (Espanol): </b></td>
		<td align="left"><input type="text" name="locationnamesp1" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address: </b></td>
		<td align="left"><input type="text" name="address1" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address Line 2: </b></td>
		<td align="left"><input type="text" name="address21" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>City: </b></td>
		<td align="left"><input type="text" name="city1" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>State: </b></td>
		<td align="left"><input type="text" name="state1" size = "2" value="AZ" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip1" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl2_button" onClick="toggle('nl2_add'); disablebutton('nl2_button');">Add An Additional Location</button></td>
	</tr>
</table>
<div id="nl2_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Location Name: </b></td>
		<td align="left"><input type="text" name="locationname2" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location Name (Espanol): </b></td>
		<td align="left"><input type="text" name="locationnamesp2" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address: </b></td>
		<td align="left"><input type="text" name="address2" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address Line 2: </b></td>
		<td align="left"><input type="text" name="address22" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>City: </b></td>
		<td align="left"><input type="text" name="city2" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>State: </b></td>
		<td align="left"><input type="text" name="state2" size = "2" value="AZ" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip2" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl3_button" onClick="toggle('nl3_add'); disablebutton('nl3_button');">Add An Additional Location</button></td>
	</tr>
</table>
</div>
<div id="nl3_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Location Name: </b></td>
		<td align="left"><input type="text" name="locationname3" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location Name (Espanol): </b></td>
		<td align="left"><input type="text" name="locationnamesp3" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address: </b></td>
		<td align="left"><input type="text" name="address3" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address Line 2: </b></td>
		<td align="left"><input type="text" name="address23" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>City: </b></td>
		<td align="left"><input type="text" name="city3" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>State: </b></td>
		<td align="left"><input type="text" name="state3" size = "2" value="AZ" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip3" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl4_button" onClick="toggle('nl4_add'); disablebutton('nl4_button');">Add An Additional Location</button></td>
	</tr>
</table>
</div>
<div id="nl4_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Location Name: </b></td>
		<td align="left"><input type="text" name="locationname4" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location Name (Espanol): </b></td>
		<td align="left"><input type="text" name="locationnamesp4" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address: </b></td>
		<td align="left"><input type="text" name="address4" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address Line 2: </b></td>
		<td align="left"><input type="text" name="address24" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>City: </b></td>
		<td align="left"><input type="text" name="city4" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>State: </b></td>
		<td align="left"><input type="text" name="state4" size = "2" value="AZ" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip4" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl5_button" onClick="toggle('nl5_add'); disablebutton('nl5_button');">Add An Additional Location</button></td>
	</tr>
</table>
</div>
<div id="nl5_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Location Name: </b></td>
		<td align="left"><input type="text" name="locationname5" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location Name (Espanol): </b></td>
		<td align="left"><input type="text" name="locationnamesp5" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address: </b></td>
		<td align="left"><input type="text" name="address5" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Address Line 2: </b></td>
		<td align="left"><input type="text" name="address25" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>City: </b></td>
		<td align="left"><input type="text" name="city5" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>State: </b></td>
		<td align="left"><input type="text" name="state5" size = "2" value="AZ" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Zip: </b></td>
		<td align="left"><input type="text" name="zip5" size = "10" value="" /><span class="required">*</span></td>
	</tr>
</table>
</div>
<br />
<input type="submit" name="action" value="Save New Locations and Continue &#62;&#62;" />
</form>



