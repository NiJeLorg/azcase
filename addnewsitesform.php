<?php
// create the add new sites form

// pull user id for ease of use below
$useremailsession = pg_escape_string($_SESSION['useremail']);
$useridquery = "SELECT userid FROM azcase_users WHERE useremail = '$useremailsession';";
$useridresult = pg_query($connection, $useridquery);
for ($lt = 0; $lt < pg_numrows($useridresult); $lt++) {
	$userid = pg_result($useridresult, $lt, 0);
}

// create location combo box options
$locationcboxoptions = '';
$locationcboxquery = "SELECT locationid, name, address, address2, city, state, zip FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid)) OR locationid IN (SELECT locationid FROM azcase_user_locations_junction WHERE userid = $userid) ORDER BY name;";
$locationcboxresult = pg_query($connection, $locationcboxquery);
for ($lt = 0; $lt < pg_numrows($locationcboxresult); $lt++) {
	$locationid = pg_result($locationcboxresult, $lt, 0);
	$name = pg_result($locationcboxresult, $lt, 1);
	$address = pg_result($locationcboxresult, $lt, 2);
	$address2 = pg_result($locationcboxresult, $lt, 3);
	$city = pg_result($locationcboxresult, $lt, 4);
	$state = pg_result($locationcboxresult, $lt, 5);
	$zip = pg_result($locationcboxresult, $lt, 6);

	// format address
	$printaddress = $address;
	if (!$address2) { 
		$printaddress .=  '; '; 
	}else{ 
		$printaddress .=  ' ' . $address2 . '; ';
	}
	if (!$city) { 
	}else{ 
		$printaddress .= $city . ' ';
	}
	if (!$state) { 
	}elseif (!$zip) {
		$printaddress .= $state;	
	}else{ 
		$printaddress .= $state . ' ';
	}
	if (!$zip) { 
	}else{ 
		$printaddress .= $zip; 
	}


	$locationcboxoptions .= "<option value=\"$locationid\">$name ($printaddress)</option>";

}


// create times combo box options
$mtimescboxoptions = '';
$atimescboxoptions = '';
//morning times
$mtimescboxoptions .= "<option value=\"00:00:00\">--</option>";
$mtimescboxoptions .= "<option value=\"05:00:00\">5:00 AM</option>";
$mtimescboxoptions .= "<option value=\"05:15:00\">5:15 AM</option>";
$mtimescboxoptions .= "<option value=\"05:30:00\">5:30 AM</option>";
$mtimescboxoptions .= "<option value=\"05:45:00\">5:45 AM</option>";
$mtimescboxoptions .= "<option value=\"06:00:00\">6:00 AM</option>";
$mtimescboxoptions .= "<option value=\"06:15:00\">6:15 AM</option>";
$mtimescboxoptions .= "<option value=\"06:30:00\">6:30 AM</option>";
$mtimescboxoptions .= "<option value=\"06:45:00\">6:45 AM</option>";
$mtimescboxoptions .= "<option value=\"07:00:00\">7:00 AM</option>";
$mtimescboxoptions .= "<option value=\"07:15:00\">7:15 AM</option>";
$mtimescboxoptions .= "<option value=\"07:30:00\">7:30 AM</option>";
$mtimescboxoptions .= "<option value=\"07:45:00\">7:45 AM</option>";
$mtimescboxoptions .= "<option value=\"08:00:00\">8:00 AM</option>";
$mtimescboxoptions .= "<option value=\"08:15:00\">8:15 AM</option>";
$mtimescboxoptions .= "<option value=\"08:30:00\">8:30 AM</option>";
$mtimescboxoptions .= "<option value=\"08:45:00\">8:45 AM</option>";
$mtimescboxoptions .= "<option value=\"09:00:00\">9:00 AM</option>";
$mtimescboxoptions .= "<option value=\"09:15:00\">9:15 AM</option>";
$mtimescboxoptions .= "<option value=\"09:30:00\">9:30 AM</option>";
$mtimescboxoptions .= "<option value=\"09:45:00\">9:45 AM</option>";
$mtimescboxoptions .= "<option value=\"10:00:00\">10:00 AM</option>";
$mtimescboxoptions .= "<option value=\"10:15:00\">10:15 AM</option>";
$mtimescboxoptions .= "<option value=\"10:30:00\">10:30 AM</option>";
$mtimescboxoptions .= "<option value=\"10:45:00\">10:45 AM</option>";
$mtimescboxoptions .= "<option value=\"11:00:00\">11:00 AM</option>";
$mtimescboxoptions .= "<option value=\"11:15:00\">11:15 AM</option>";
$mtimescboxoptions .= "<option value=\"11:30:00\">11:30 AM</option>";
$mtimescboxoptions .= "<option value=\"11:45:00\">11:45 AM</option>";

//afternoon times
$atimescboxoptions .= "<option value=\"00:00:00\">--</option>";
$atimescboxoptions .= "<option value=\"12:00:00\">12:00 PM</option>";
$atimescboxoptions .= "<option value=\"12:15:00\">12:15 PM</option>";
$atimescboxoptions .= "<option value=\"12:30:00\">12:30 PM</option>";
$atimescboxoptions .= "<option value=\"12:45:00\">12:45 PM</option>";
$atimescboxoptions .= "<option value=\"13:00:00\">1:00 PM</option>";
$atimescboxoptions .= "<option value=\"13:15:00\">1:15 PM</option>";
$atimescboxoptions .= "<option value=\"13:30:00\">1:30 PM</option>";
$atimescboxoptions .= "<option value=\"13:45:00\">1:45 PM</option>";
$atimescboxoptions .= "<option value=\"14:00:00\">2:00 PM</option>";
$atimescboxoptions .= "<option value=\"14:15:00\">2:15 PM</option>";
$atimescboxoptions .= "<option value=\"14:30:00\">2:30 PM</option>";
$atimescboxoptions .= "<option value=\"14:45:00\">2:45 PM</option>";
$atimescboxoptions .= "<option value=\"15:00:00\">3:00 PM</option>";
$atimescboxoptions .= "<option value=\"15:15:00\">3:15 PM</option>";
$atimescboxoptions .= "<option value=\"15:30:00\">3:30 PM</option>";
$atimescboxoptions .= "<option value=\"15:45:00\">3:45 PM</option>";
$atimescboxoptions .= "<option value=\"16:00:00\">4:00 PM</option>";
$atimescboxoptions .= "<option value=\"16:15:00\">4:15 PM</option>";
$atimescboxoptions .= "<option value=\"16:30:00\">4:30 PM</option>";
$atimescboxoptions .= "<option value=\"16:45:00\">4:45 PM</option>";
$atimescboxoptions .= "<option value=\"17:00:00\">5:00 PM</option>";
$atimescboxoptions .= "<option value=\"17:15:00\">5:15 PM</option>";
$atimescboxoptions .= "<option value=\"17:30:00\">5:30 PM</option>";
$atimescboxoptions .= "<option value=\"17:45:00\">5:45 PM</option>";
$atimescboxoptions .= "<option value=\"18:00:00\">6:00 PM</option>";
$atimescboxoptions .= "<option value=\"18:15:00\">6:15 PM</option>";
$atimescboxoptions .= "<option value=\"18:30:00\">6:30 PM</option>";
$atimescboxoptions .= "<option value=\"18:45:00\">6:45 PM</option>";
$atimescboxoptions .= "<option value=\"19:00:00\">7:00 PM</option>";
$atimescboxoptions .= "<option value=\"19:15:00\">7:15 PM</option>";
$atimescboxoptions .= "<option value=\"19:30:00\">7:30 PM</option>";
$atimescboxoptions .= "<option value=\"19:45:00\">7:45 PM</option>";
$atimescboxoptions .= "<option value=\"20:00:00\">8:00 PM</option>";
$atimescboxoptions .= "<option value=\"20:15:00\">8:15 PM</option>";
$atimescboxoptions .= "<option value=\"20:30:00\">8:30 PM</option>";
$atimescboxoptions .= "<option value=\"20:45:00\">8:45 PM</option>";
$atimescboxoptions .= "<option value=\"21:00:00\">9:00 PM</option>";
$atimescboxoptions .= "<option value=\"21:15:00\">9:15 PM</option>";
$atimescboxoptions .= "<option value=\"21:30:00\">9:30 PM</option>";
$atimescboxoptions .= "<option value=\"21:45:00\">9:45 PM</option>";
$atimescboxoptions .= "<option value=\"22:00:00\">10:00 PM</option>";
$atimescboxoptions .= "<option value=\"22:15:00\">10:15 PM</option>";
$atimescboxoptions .= "<option value=\"22:30:00\">10:30 PM</option>";
$atimescboxoptions .= "<option value=\"22:45:00\">10:45 PM</option>";
$atimescboxoptions .= "<option value=\"23:00:00\">11:00 PM</option>";
$atimescboxoptions .= "<option value=\"23:15:00\">11:15 PM</option>";
$atimescboxoptions .= "<option value=\"23:30:00\">11:30 PM</option>";
$atimescboxoptions .= "<option value=\"23:45:00\">11:45 PM</option>";

// all times
$timescboxoptions = '';
$timescboxoptions .= "<option value=\"00:00:00\">--</option>";
$timescboxoptions .= "<option value=\"05:00:00\">5:00 AM</option>";
$timescboxoptions .= "<option value=\"05:15:00\">5:15 AM</option>";
$timescboxoptions .= "<option value=\"05:30:00\">5:30 AM</option>";
$timescboxoptions .= "<option value=\"05:45:00\">5:45 AM</option>";
$timescboxoptions .= "<option value=\"06:00:00\">6:00 AM</option>";
$timescboxoptions .= "<option value=\"06:15:00\">6:15 AM</option>";
$timescboxoptions .= "<option value=\"06:30:00\">6:30 AM</option>";
$timescboxoptions .= "<option value=\"06:45:00\">6:45 AM</option>";
$timescboxoptions .= "<option value=\"07:00:00\">7:00 AM</option>";
$timescboxoptions .= "<option value=\"07:15:00\">7:15 AM</option>";
$timescboxoptions .= "<option value=\"07:30:00\">7:30 AM</option>";
$timescboxoptions .= "<option value=\"07:45:00\">7:45 AM</option>";
$timescboxoptions .= "<option value=\"08:00:00\">8:00 AM</option>";
$timescboxoptions .= "<option value=\"08:15:00\">8:15 AM</option>";
$timescboxoptions .= "<option value=\"08:30:00\">8:30 AM</option>";
$timescboxoptions .= "<option value=\"08:45:00\">8:45 AM</option>";
$timescboxoptions .= "<option value=\"09:00:00\">9:00 AM</option>";
$timescboxoptions .= "<option value=\"09:15:00\">9:15 AM</option>";
$timescboxoptions .= "<option value=\"09:30:00\">9:30 AM</option>";
$timescboxoptions .= "<option value=\"09:45:00\">9:45 AM</option>";
$timescboxoptions .= "<option value=\"10:00:00\">10:00 AM</option>";
$timescboxoptions .= "<option value=\"10:15:00\">10:15 AM</option>";
$timescboxoptions .= "<option value=\"10:30:00\">10:30 AM</option>";
$timescboxoptions .= "<option value=\"10:45:00\">10:45 AM</option>";
$timescboxoptions .= "<option value=\"11:00:00\">11:00 AM</option>";
$timescboxoptions .= "<option value=\"11:15:00\">11:15 AM</option>";
$timescboxoptions .= "<option value=\"11:30:00\">11:30 AM</option>";
$timescboxoptions .= "<option value=\"11:45:00\">11:45 AM</option>";
$timescboxoptions .= "<option value=\"12:00:00\">12:00 PM</option>";
$timescboxoptions .= "<option value=\"12:15:00\">12:15 PM</option>";
$timescboxoptions .= "<option value=\"12:30:00\">12:30 PM</option>";
$timescboxoptions .= "<option value=\"12:45:00\">12:45 PM</option>";
$timescboxoptions .= "<option value=\"13:00:00\">1:00 PM</option>";
$timescboxoptions .= "<option value=\"13:15:00\">1:15 PM</option>";
$timescboxoptions .= "<option value=\"13:30:00\">1:30 PM</option>";
$timescboxoptions .= "<option value=\"13:45:00\">1:45 PM</option>";
$timescboxoptions .= "<option value=\"14:00:00\">2:00 PM</option>";
$timescboxoptions .= "<option value=\"14:15:00\">2:15 PM</option>";
$timescboxoptions .= "<option value=\"14:30:00\">2:30 PM</option>";
$timescboxoptions .= "<option value=\"14:45:00\">2:45 PM</option>";
$timescboxoptions .= "<option value=\"15:00:00\">3:00 PM</option>";
$timescboxoptions .= "<option value=\"15:15:00\">3:15 PM</option>";
$timescboxoptions .= "<option value=\"15:30:00\">3:30 PM</option>";
$timescboxoptions .= "<option value=\"15:45:00\">3:45 PM</option>";
$timescboxoptions .= "<option value=\"16:00:00\">4:00 PM</option>";
$timescboxoptions .= "<option value=\"16:15:00\">4:15 PM</option>";
$timescboxoptions .= "<option value=\"16:30:00\">4:30 PM</option>";
$timescboxoptions .= "<option value=\"16:45:00\">4:45 PM</option>";
$timescboxoptions .= "<option value=\"17:00:00\">5:00 PM</option>";
$timescboxoptions .= "<option value=\"17:15:00\">5:15 PM</option>";
$timescboxoptions .= "<option value=\"17:30:00\">5:30 PM</option>";
$timescboxoptions .= "<option value=\"17:45:00\">5:45 PM</option>";
$timescboxoptions .= "<option value=\"18:00:00\">6:00 PM</option>";
$timescboxoptions .= "<option value=\"18:15:00\">6:15 PM</option>";
$timescboxoptions .= "<option value=\"18:30:00\">6:30 PM</option>";
$timescboxoptions .= "<option value=\"18:45:00\">6:45 PM</option>";
$timescboxoptions .= "<option value=\"19:00:00\">7:00 PM</option>";
$timescboxoptions .= "<option value=\"19:15:00\">7:15 PM</option>";
$timescboxoptions .= "<option value=\"19:30:00\">7:30 PM</option>";
$timescboxoptions .= "<option value=\"19:45:00\">7:45 PM</option>";
$timescboxoptions .= "<option value=\"20:00:00\">8:00 PM</option>";
$timescboxoptions .= "<option value=\"20:15:00\">8:15 PM</option>";
$timescboxoptions .= "<option value=\"20:30:00\">8:30 PM</option>";
$timescboxoptions .= "<option value=\"20:45:00\">8:45 PM</option>";
$timescboxoptions .= "<option value=\"21:00:00\">9:00 PM</option>";
$timescboxoptions .= "<option value=\"21:15:00\">9:15 PM</option>";
$timescboxoptions .= "<option value=\"21:30:00\">9:30 PM</option>";
$timescboxoptions .= "<option value=\"21:45:00\">9:45 PM</option>";
$timescboxoptions .= "<option value=\"22:00:00\">10:00 PM</option>";
$timescboxoptions .= "<option value=\"22:15:00\">10:15 PM</option>";
$timescboxoptions .= "<option value=\"22:30:00\">10:30 PM</option>";
$timescboxoptions .= "<option value=\"22:45:00\">10:45 PM</option>";
$timescboxoptions .= "<option value=\"23:00:00\">11:00 PM</option>";
$timescboxoptions .= "<option value=\"23:15:00\">11:15 PM</option>";
$timescboxoptions .= "<option value=\"23:30:00\">11:30 PM</option>";
$timescboxoptions .= "<option value=\"23:45:00\">11:45 PM</option>";




// create cost combo box options
$i = 1;
$costcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 10000) {
	$costnum = '$' . number_format($i);
	$costcboxoptions .= "<option value=\"$i\">$costnum</option>";
	$i++; 
}

// create free lunch combo box options
$i = 1;
$freelunchcboxoptions = "<option value=\"NULL\">--</option>";
while ($i <= 100) {
	$freelunchnum = $i . '%';
	$freelunchcboxoptions .= "<option value=\"$i\">$freelunchnum</option>";
	$i++; 
}


?>
<br />
<span class="required">* Required</span>
<form name="newsites" id="newsites" action="processnewsites.php" method="POST" onSubmit="return validateForm();">
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename1" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp1" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid1" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone1" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax1" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email1" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url1" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl2_button" onClick="toggle('nl2_add'); disablebutton('nl2_button');">Add An Additional Site</button></td>
	</tr>
</table>
<div id="nl2_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename2" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp2" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid2" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone2" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax2" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email2" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url2" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl3_button" onClick="toggle('nl3_add'); disablebutton('nl3_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl3_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename3" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp3" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid3" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone3" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax3" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email3" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url3" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl4_button" onClick="toggle('nl4_add'); disablebutton('nl4_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl4_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename4" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp4" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid4" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone4" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax4" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email4" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url4" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl5_button" onClick="toggle('nl5_add'); disablebutton('nl5_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl5_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename5" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp5" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid5" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone5" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax5" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email5" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url5" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl6_button" onClick="toggle('nl6_add'); disablebutton('nl6_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl6_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename6" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp6" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid6" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone6" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax6" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email6" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url6" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl7_button" onClick="toggle('nl7_add'); disablebutton('nl7_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl7_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename7" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp7" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid7" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone7" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax7" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email7" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url7" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl8_button" onClick="toggle('nl8_add'); disablebutton('nl8_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl8_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename8" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp8" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid8" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone8" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax8" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email8" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url8" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl9_button" onClick="toggle('nl9_add'); disablebutton('nl9_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl9_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename9" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp9" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid9" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone9" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax9" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email9" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url9" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl10_button" onClick="toggle('nl10_add'); disablebutton('nl10_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl10_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename10" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid10" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone10" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax10" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url10" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl11_button" onClick="toggle('nl11_add'); disablebutton('nl11_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl11_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename11" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp11" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid11" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone11" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax11" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email11" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url11" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl12_button" onClick="toggle('nl12_add'); disablebutton('nl12_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl12_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename12" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp12" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid12" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone12" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax12" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email12" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url12" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl13_button" onClick="toggle('nl13_add'); disablebutton('nl13_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl13_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename13" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp13" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid13" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone13" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax13" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email13" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url13" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl14_button" onClick="toggle('nl14_add'); disablebutton('nl14_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl14_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename14" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp14" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid14" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone14" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax14" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email14" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url14" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl15_button" onClick="toggle('nl15_add'); disablebutton('nl15_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl15_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename15" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp15" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid15" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone15" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax15" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email15" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url15" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl16_button" onClick="toggle('nl16_add'); disablebutton('nl16_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl16_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename16" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp16" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid16" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone16" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax16" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email16" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url16" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl17_button" onClick="toggle('nl17_add'); disablebutton('nl17_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl17_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename17" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp17" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid17" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone17" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax17" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email17" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url17" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl18_button" onClick="toggle('nl18_add'); disablebutton('nl18_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl18_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename18" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp18" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid18" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone18" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax18" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email18" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url18" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl19_button" onClick="toggle('nl19_add'); disablebutton('nl19_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl19_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename19" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp19" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid19" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone19" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax19" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email19" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url19" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl20_button" onClick="toggle('nl20_add'); disablebutton('nl20_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl20_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename20" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp20" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid20" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone20" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax20" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email20" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url20" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl21_button" onClick="toggle('nl21_add'); disablebutton('nl21_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl21_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename21" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp21" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid21" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone21" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax21" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email21" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url21" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl22_button" onClick="toggle('nl22_add'); disablebutton('nl22_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl22_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename22" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp22" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid22" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone22" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax22" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email22" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url22" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl23_button" onClick="toggle('nl23_add'); disablebutton('nl23_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl23_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename23" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp23" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid23" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone23" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax23" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email23" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url23" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl24_button" onClick="toggle('nl24_add'); disablebutton('nl24_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl24_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename24" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp24" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid24" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone24" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax24" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email24" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url24" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl25_button" onClick="toggle('nl25_add'); disablebutton('nl25_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl25_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename25" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp25" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid25" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone25" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax25" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email25" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url25" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl26_button" onClick="toggle('nl26_add'); disablebutton('nl26_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl26_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename26" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp26" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid26" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone26" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax26" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email26" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url26" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl27_button" onClick="toggle('nl27_add'); disablebutton('nl27_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl27_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename27" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp27" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid27" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone27" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax27" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email27" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url27" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl28_button" onClick="toggle('nl28_add'); disablebutton('nl28_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl28_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename28" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp28" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid28" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone28" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax28" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email28" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url28" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl29_button" onClick="toggle('nl29_add'); disablebutton('nl29_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl29_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename29" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp29" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid29" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone29" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax29" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email29" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url29" value="" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><button type="button" id="nl30_button" onClick="toggle('nl30_add'); disablebutton('nl30_button');">Add An Additional Site</button></td>
	</tr>
</table>
</div>
<div id="nl30_add" style="display:none">
<br />
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Site Name: </b></td>
		<td align="left"><input type="text" name="sitename30" value="" /><span class="required">* </span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Name (Espanol): </b></td>
		<td align="left"><input type="text" name="sitenamesp30" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Location: </b></td>
		<td align="left"><select name="locationid30" style="width: 250px;"><?php echo $locationcboxoptions; ?></select><span class="required">* </span><a href="newlocations.php">Add New Locations</a></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Phone: </b></td>
		<td align="left"><input type="text" name="phone30" size = "10" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Fax: </b></td>
		<td align="left"><input type="text" name="fax30" size = "10" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Email: </b></td>
		<td align="left"><input type="text" name="email30" value="" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Site Website: </b></td>
		<td align="left"><input type="text" name="url30" value="" /></td>
	</tr>
</table>
</div>
<br />
<br />
<h1>Activities, Ages Served and Hours of Operation for These Sites</h1>
<b>Select Program Activities:</b><span class="required">*</span> 
<table cellpadding="2">
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activity" value="TRUE"> </td>
		<td align="left" width="175"><i>Check/Uncheck All</i></td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityacademic" value="TRUE"> </td>
		<td align="left" width="175">Tutoring/Academic Enrichment</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityarts" value="TRUE"> </td>
		<td align="left" width="175">Arts and Culture</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitysports" value="TRUE"> </td>
		<td align="left" width="175">Sports and Recreation</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitycommunity" value="TRUE"> </td>
		<td align="left" width="175">Volunteering/Community Service</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitystem" value="TRUE"> </td>
		<td align="left" width="175">Science, Technology, Engineering, and Mathematics</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitycollege" value="TRUE"> </td>
		<td align="left" width="175">College and Career Readiness</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityleadership" value="TRUE"> </td>
		<td align="left" width="175">Leadership</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitycharacter" value="TRUE"> </td>
		<td align="left" width="175">Character Education</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activityprevention" value="TRUE"> </td>
		<td align="left" width="175">Prevention</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitynutrition" value="TRUE"> </td>
		<td align="left" width="175">Nutrition</td>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitymentoring" value="TRUE"> </td>
		<td align="left" width="175">Mentoring</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="activityGroup.check(this)" name="activitysupportservices" value="TRUE"> </td>
		<td align="left" width="175">Support Services (medical, dental, mental health, etc.)</td>
	</tr>
</table>
<br />
<b>Select Ages Served:</b><span class="required">*</span>
<table cellpadding="2">
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age" value="TRUE"> </td>
		<td align="left" width="175"><i>Check/Uncheck All</i></td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age5" value="TRUE"> </td>
		<td align="left" width="175">Age 5</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age6" value="TRUE"> </td>
		<td align="left" width="175">Age 6</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age7" value="TRUE"> </td>
		<td align="left" width="175">Age 7</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age8" value="TRUE"> </td>
		<td align="left" width="175">Age 8</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age9" value="TRUE"> </td>
		<td align="left" width="175">Age 9</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age10" value="TRUE"> </td>
		<td align="left" width="175">Age 10</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age11" value="TRUE"> </td>
		<td align="left" width="175">Age 11</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age12" value="TRUE"> </td>
		<td align="left" width="175">Age 12</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age13" value="TRUE"> </td>
		<td align="left" width="175">Age 13</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age14" value="TRUE"> </td>
		<td align="left" width="175">Age 14</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age15" value="TRUE"> </td>
		<td align="left" width="175">Age 15</td>
	</tr>
	<tr>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age16" value="TRUE"> </td>
		<td align="left" width="175">Age 16</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age17" value="TRUE"> </td>
		<td align="left" width="175">Age 17</td>
		<td align="right" width="25"><input type="checkbox" onClick="ageGroup.check(this)" name="age18" value="TRUE"> </td>
		<td align="left" width="175">Age 18</td>
	</tr>

</table>
<br />
<br />
<table class="hoursTable" cellpadding="4">
	<tr>
		<th align="left" ><b>Select Hours of Operation:</b><span class="required">*</span></th>
		<th align="right" ><b>Morning Start Time</b></th>
		<th align="right" ><b>Morning End Time</b></th>
		<th align="right" ><b>Afternoon Start Time</b></th>
		<th align="right" ><b>Afternoon End Time</b></th>
		<th class="lastcol"></th>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Monday:</b></td>
		<td align="center"><select name="monstartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="monendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="monstartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select name="monendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"><a href="javascript:copyWeekdayTimes();">Copy and paste first row</a></td>
	</tr>
	<tr class="alt">
		<td class="firstcol" align="left"><b>Tuesday:</b></td>
		<td align="center"><select name="tuestartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="tueendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="tuestartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select name="tueendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Wednesday:</b></td>
		<td align="center"><select name="wedstartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="wedendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="wedstartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select name="wedendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr class="alt">
		<td class="firstcol" align="left"><b>Thursday:</b></td>
		<td align="center"><select name="thustartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="thuendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="thustartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select name="thuendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Friday:</b></td>
		<td align="center"><select name="fristartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="friendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select name="fristartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select name="friendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
	<tr>
		<th align="left" ><b>Weekend Hours</b></th>
		<th align="center" colspan="2"><b>Start Time</b></th>
		<th align="center" colspan="2"><b>End Time</b></th>
		<th class="lastcol"></th>
	</tr>
	<tr>
		<td class="firstcol" align="left"><b>Saturday:</b></td>
		<td align="center" colspan="2"><select name="satstartweekend"><?php echo $timescboxoptions; ?></select></td>
		<td align="center" colspan="2"><select name="satendweekend"><?php echo $timescboxoptions; ?></select></td>
		<td class="lastcol"><a href="javascript:copyWeekendTimes();">Copy and paste first row</a></td>
	</tr>
	<tr class="alt">
		<td class="firstcol" align="left"><b>Sunday:</b></td>
		<td align="center" colspan="2"><select name="sunstartweekend"><?php echo $timescboxoptions; ?></select></td>
		<td align="center" colspan="2"><select name="sunendweekend"><?php echo $timescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	</tr>
</table>
<br />
<b>Other Information:</b>
<ul>
	<li>These sites charge a fee? <input type="radio" name="charge" value="TRUE" onClick="toggle('fee');"> Yes <input type="radio" name="charge" value="FALSE"> No</li>
	<div id="fee" style="display:none"><li><select name="costfrequency"><option value="NULL">--</option><option value="1">Weekly</option><option value="2">Monthly</option><option value="3">Quarterly</option><option value="4">Per School Semester</option><option value="5">Annual</option><option value="6">Summer</option></select> cost: <select name="costamount"><?php echo $costcboxoptions; ?></select></li></div>
	<li>Fee assistance available? <input type="radio" name="feeassistance" value="TRUE"> Yes <input type="radio" name="feeassistance" value="FALSE"> No</li>
	<li>Scholarships available? <input type="radio" name="scholarship" value="TRUE"> Yes <input type="radio" name="scholarship" value="FALSE"> No</li>
	<li>Accepts DES child care subsidy? <input type="radio" name="desassistance" value="TRUE"> Yes <input type="radio" name="desassistance" value="FALSE"> No</li>
	<li>Multiple child discount available? <input type="radio" name="mcdiscount" value="TRUE"> Yes <input type="radio" name="mcdiscount" value="FALSE"> No</li>
	<li>Other financial assistance available? <input type="radio" name="otherassistance" value="TRUE"> Yes <input type="radio" name="otherassistance" value="FALSE"> No</li>
	<li>Transportation provided? <input type="radio" name="transportation" value="TRUE"> Yes <input type="radio" name="transportation" value="FALSE"> No</li>
	<li>Snacks provided? <input type="radio" name="snacks" value="TRUE"> Yes <input type="radio" name="snacks" value="FALSE"> No</li>
	<li>Breakfast provided? <input type="radio" name="breakfast" value="TRUE"> Yes <input type="radio" name="breakfast" value="FALSE"> No</li>
	<li>Lunch provided? <input type="radio" name="lunch" value="TRUE"> Yes <input type="radio" name="lunch" value="FALSE"> No</li>
	<li>Dinner provided? <input type="radio" name="dinner" value="TRUE"> Yes <input type="radio" name="dinner" value="FALSE"> No</li>
	<li>What percentage of your clientèle receive a free or reduced lunch at their school? <select name="freelunch"><?php echo $freelunchcboxoptions; ?></select></li>
	<li>Spanish spoken? <input type="radio" name="spanish" value="TRUE"> Yes <input type="radio" name="spanish" value="FALSE"> No</li>
	<li>Other languages spoken? <input type="radio" name="otherlanguage" value="TRUE"> Yes <input type="radio" name="otherlanguage" value="FALSE"> No</li>

</ul>

<br />
<input type="submit" name="action" value="Save and Continue &#62;&#62;" />
</form>



