<?php
// create the add new sites form
// create location combo box options
$locationcboxoptions = '';
$locationcboxquery = "SELECT locationid, name, address, address2, city, state, zip FROM azcase_locations ORDER BY name;";
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


$usercboxoptions = '';
$usercboxquery = "SELECT userid, username, useremail FROM azcase_users ORDER BY username;";
$usercboxresult = pg_query($connection, $usercboxquery);
for ($lt = 0; $lt < pg_numrows($usercboxresult); $lt++) {
	$userid = pg_result($usercboxresult, $lt, 0);
	$username = pg_result($usercboxresult, $lt, 1);
	$useremail = pg_result($usercboxresult, $lt, 2);
	$usercboxoptions .= "<option value=\"$userid\">$username ($useremail)</option>";

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

<br />
<form name="newsites" id="newsites" action="processnewsites.php" method="POST" onSubmit="return validateForm();">
<div class="col-md-6">
	<span class="required">* Required</span>
	<div class="form-group">
		<label>Primary User Account: </label><span class="required">*</span>
		<select class="form-control" name="userid"><?php echo $usercboxoptions; ?></select>
		<p><em><small>Please note that all users who can edit programs this user can edit will automatically be able to edit this new program as well.</small></em></p>
		<a href="newprovider.php">Add New User</a>
	</div>
	<hr />
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename1" value="" />
	</div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp1" value="" />
	</div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid1"><?php echo $locationcboxoptions; ?></select>
		<a href="newlocations.php">Add New Locations</a>
	</div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone1" size = "10" value="" />
	</div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax1" size = "10" value="" />
	</div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email1" value="" />
	</div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url1" value="" />
	</div>
	<button type="button" class="btn btn-default" id="nl2_button" onClick="toggle('nl2_add'); disablebutton('nl2_button');">Add An Additional Program</button>
</div>
<div class="clearfix"></div>
<div id="nl2_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename2" value="" />
	</div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp2" value="" />
	</div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" class="form-control" name="locationid2"><?php echo $locationcboxoptions; ?></select>
		<a href="newlocations.php">Add New Locations</a>
	</div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone2" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax2" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email2" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url2" value="" /></div>

<button type="button" class="btn btn-default" id="nl3_button" onClick="toggle('nl3_add'); disablebutton('nl3_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl3_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename3" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp3" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid3" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone3" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax3" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email3" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url3" value="" /></div>

<button type="button" class="btn btn-default" id="nl4_button" onClick="toggle('nl4_add'); disablebutton('nl4_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl4_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename4" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp4" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid4" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone4" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax4" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email4" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url4" value="" /></div>

<button type="button" class="btn btn-default" id="nl5_button" onClick="toggle('nl5_add'); disablebutton('nl5_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl5_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename5" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp5" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid5" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone5" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax5" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email5" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url5" value="" /></div>

<button type="button" class="btn btn-default" id="nl6_button" onClick="toggle('nl6_add'); disablebutton('nl6_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl6_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename6" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp6" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid6" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone6" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax6" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email6" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url6" value="" /></div>

<button type="button" class="btn btn-default" id="nl7_button" onClick="toggle('nl7_add'); disablebutton('nl7_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl7_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename7" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp7" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid7" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone7" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax7" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email7" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url7" value="" /></div>

<button type="button" class="btn btn-default" id="nl8_button" onClick="toggle('nl8_add'); disablebutton('nl8_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl8_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename8" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp8" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid8" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone8" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax8" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email8" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url8" value="" /></div>

<button type="button" class="btn btn-default" id="nl9_button" onClick="toggle('nl9_add'); disablebutton('nl9_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl9_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename9" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp9" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid9" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone9" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax9" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email9" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url9" value="" /></div>

<button type="button" class="btn btn-default" id="nl10_button" onClick="toggle('nl10_add'); disablebutton('nl10_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl10_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename10" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp10" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid10" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone10" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax10" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email10" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url10" value="" /></div>

<button type="button" class="btn btn-default" id="nl11_button" onClick="toggle('nl11_add'); disablebutton('nl11_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl11_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename11" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp11" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid11" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone11" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax11" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email11" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url11" value="" /></div>

<button type="button" class="btn btn-default" id="nl12_button" onClick="toggle('nl12_add'); disablebutton('nl12_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl12_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename12" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp12" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid12" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone12" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax12" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email12" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url12" value="" /></div>

<button type="button" class="btn btn-default" id="nl13_button" onClick="toggle('nl13_add'); disablebutton('nl13_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl13_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename13" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp13" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid13" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone13" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax13" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email13" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url13" value="" /></div>

<button type="button" class="btn btn-default" id="nl14_button" onClick="toggle('nl14_add'); disablebutton('nl14_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl14_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename14" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp14" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid14" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone14" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax14" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email14" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url14" value="" /></div>

<button type="button" class="btn btn-default" id="nl15_button" onClick="toggle('nl15_add'); disablebutton('nl15_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl15_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename15" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp15" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid15" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone15" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax15" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email15" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url15" value="" /></div>

<button type="button" class="btn btn-default" id="nl16_button" onClick="toggle('nl16_add'); disablebutton('nl16_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl16_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename16" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp16" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid16" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone16" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax16" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email16" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url16" value="" /></div>

<button type="button" class="btn btn-default" id="nl17_button" onClick="toggle('nl17_add'); disablebutton('nl17_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl17_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename17" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp17" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid17" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone17" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax17" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email17" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url17" value="" /></div>

<button type="button" class="btn btn-default" id="nl18_button" onClick="toggle('nl18_add'); disablebutton('nl18_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl18_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename18" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp18" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid18" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone18" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax18" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email18" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url18" value="" /></div>

<button type="button" class="btn btn-default" id="nl19_button" onClick="toggle('nl19_add'); disablebutton('nl19_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl19_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename19" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp19" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid19" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone19" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax19" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email19" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url19" value="" /></div>

<button type="button" class="btn btn-default" id="nl20_button" onClick="toggle('nl20_add'); disablebutton('nl20_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl20_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename20" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp20" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid20" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone20" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax20" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email20" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url20" value="" /></div>

<button type="button" class="btn btn-default" id="nl21_button" onClick="toggle('nl21_add'); disablebutton('nl21_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl21_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename21" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp21" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid21" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone21" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax21" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email21" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url21" value="" /></div>

<button type="button" class="btn btn-default" id="nl22_button" onClick="toggle('nl22_add'); disablebutton('nl22_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl22_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename22" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp22" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid22" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone22" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax22" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email22" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url22" value="" /></div>

<button type="button" class="btn btn-default" id="nl23_button" onClick="toggle('nl23_add'); disablebutton('nl23_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl23_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename23" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp23" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid23" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone23" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax23" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email23" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url23" value="" /></div>

<button type="button" class="btn btn-default" id="nl24_button" onClick="toggle('nl24_add'); disablebutton('nl24_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl24_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename24" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp24" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid24" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone24" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax24" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email24" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url24" value="" /></div>

<button type="button" class="btn btn-default" id="nl25_button" onClick="toggle('nl25_add'); disablebutton('nl25_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl25_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename25" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp25" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid25" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone25" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax25" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email25" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url25" value="" /></div>

<button type="button" class="btn btn-default" id="nl26_button" onClick="toggle('nl26_add'); disablebutton('nl26_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl26_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename26" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp26" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid26" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone26" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax26" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email26" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url26" value="" /></div>

<button type="button" class="btn btn-default" id="nl27_button" onClick="toggle('nl27_add'); disablebutton('nl27_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl27_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename27" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp27" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid27" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone27" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax27" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email27" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url27" value="" /></div>

<button type="button" class="btn btn-default" id="nl28_button" onClick="toggle('nl28_add'); disablebutton('nl28_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl28_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename28" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp28" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid28" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone28" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax28" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email28" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url28" value="" /></div>

<button type="button" class="btn btn-default" id="nl29_button" onClick="toggle('nl29_add'); disablebutton('nl29_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl29_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename29" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp29" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid29" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone29" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax29" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email29" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url29" value="" /></div>

<button type="button" class="btn btn-default" id="nl30_button" onClick="toggle('nl30_add'); disablebutton('nl30_button');">Add An Additional Program</button>
</div>
</div>
<div class="clearfix"></div>
<div id="nl30_add" style="display:none">
<br />
<div class="col-md-6">
	<div class="form-group">
		<label>Program Name: </label><span class="required">*</span>
		<input class="form-control" type="text" name="sitename30" value="" /></div>
	<div class="form-group">
		<label>Program Name (Espanol): </label>
		<input class="form-control" type="text" name="sitenamesp30" value="" /></div>
	<div class="form-group">
		<label>Location: </label><span class="required">*</span>
		<select class="form-control" name="locationid30" ><?php echo $locationcboxoptions; ?></select><a href="newlocations.php">Add New Locations</a></div>
	<div class="form-group">
		<label>Program Phone: </label><span class="required">*</span>
		<input class="form-control" type="text" name="phone30" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Fax: </label>
		<input class="form-control" type="text" name="fax30" size = "10" value="" /></div>
	<div class="form-group">
		<label>Program Email: </label><span class="required">*</span>
		<input class="form-control" type="text" name="email30" value="" /></div>
	<div class="form-group">
		<label>Program Website: </label>
		<input class="form-control" type="text" name="url30" value="" /></div>
</div>
</div>
<div class="clearfix"></div>
<br />
<br />
<h4 class="azcase-text-color">Activities, Ages Served and Hours of Operation for These Programs</h4>
<div class="col-md-12">
	<strong>Select Program Activities:</strong><span class="required">*</span> 
	<div class="checkbox">
		<label><input type="checkbox" onClick="activityGroup.check(this)" name="activity" value="TRUE"><em>Check/Uncheck All</em></label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="activityGroup.check(this)" name="activityacademic" value="TRUE">Tutoring/Academic Enrichment</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activityarts" value="TRUE">Arts and Culture</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitysports" value="TRUE">Sports and Recreation</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitycommunity" value="TRUE">Volunteering/Community Service</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitystem" value="TRUE">Science, Technology, Engineering, and Mathematics</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitycollege" value="TRUE">College and Career Readiness</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activityleadership" value="TRUE">Leadership</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitycharacter" value="TRUE">Character Education<</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activityprevention" value="TRUE">Prevention</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitynutrition" value="TRUE">Nutrition</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitymentoring" value="TRUE">Mentoring</label>
	</div>
	<div class="checkbox">
			<label><input type="checkbox" onClick="activityGroup.check(this)" name="activitysupportservices" value="TRUE">Support Services (medical, dental, mental health, etc.)</label>
	</div>
</div>
<br />
<div class="col-md-12">
	<strong>Select Ages Served:</strong><span class="required">*</span>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age" value="TRUE"><em>Check/Uncheck All</em></label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age5" value="TRUE">Age 5</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age6" value="TRUE">Age 6</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age7" value="TRUE">Age 7</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age8" value="TRUE">Age 8</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age9" value="TRUE">Age 9</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age10" value="TRUE">Age 10</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age11" value="TRUE">Age 11</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age12" value="TRUE">Age 12</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age13" value="TRUE">Age 13</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age14" value="TRUE">Age 14</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age15" value="TRUE">Age 15</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age16" value="TRUE">Age 16</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age17" value="TRUE">Age 17</label>
	</div>
	<div class="checkbox">
		<label><input type="checkbox" onClick="ageGroup.check(this)" name="age18" value="TRUE">Age 18</label>
	</div>
</div>
<br />
<br />
<div class="col-md-12">
<table class="hoursTable" cellpadding="4">
	<tr>
		<th align="left" ><strong>Select Hours of Operation:</strong><span class="required">*</span></th>
		<th align="right" ><strong>Morning Start Time</strong></th>
		<th align="right" ><strong>Morning End Time</strong></th>
		<th align="right" ><strong>Afternoon Start Time</strong></th>
		<th align="right" ><strong>Afternoon End Time</strong></th>
		<th class="lastcol"></th>
	</tr>
	<tr>
		<td class="firstcol" align="left"><strong>Monday:</strong></td>
		<td align="center"><select class="form-control" name="monstartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="monendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="monstartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="monendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"><a href="javascript:copyWeekdayTimes();">Copy and paste first row</a></td>
	<tr class="alt">
		<td class="firstcol" align="left"><strong>Tuesday:</strong></td>
		<td align="center"><select class="form-control" name="tuestartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="tueendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="tuestartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="tueendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	<tr>
		<td class="firstcol" align="left"><strong>Wednesday:</strong></td>
		<td align="center"><select class="form-control" name="wedstartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="wedendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="wedstartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="wedendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	<tr class="alt">
		<td class="firstcol" align="left"><strong>Thursday:</strong></td>
		<td align="center"><select class="form-control" name="thustartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="thuendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="thustartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="thuendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	<tr>
		<td class="firstcol" align="left"><strong>Friday:</strong></td>
		<td align="center"><select class="form-control" name="fristartmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="friendmorning"><?php echo $mtimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="fristartafter"><?php echo $atimescboxoptions; ?></select></td>
		<td align="center"><select class="form-control" name="friendafter"><?php echo $atimescboxoptions; ?></select></td>
		<td class="lastcol"></td>
	<tr>
		<th align="left" ><strong>Weekend Hours</strong></th>
		<th align="center" colspan="2"><strong>Start Time</strong></th>
		<th align="center" colspan="2"><strong>End Time</strong></th>
		<th class="lastcol"></th>
	</tr>
	<tr>
		<td class="firstcol" align="left"><strong>Saturday:</strong></td>
		<td align="center" colspan="2"><select class="form-control" name="satstartweekend"><?php echo $timescboxoptions; ?></select></td>
		<td align="center" colspan="2"><select class="form-control" name="satendweekend"><?php echo $timescboxoptions; ?></select></td>
		<td class="lastcol"><a href="javascript:copyWeekendTimes();">Copy and paste first row</a></td>
	<tr class="alt">
		<td class="firstcol" align="left"><strong>Sunday:</strong></td>
		<td align="center" colspan="2"><select class="form-control" name="sunstartweekend"><?php echo $timescboxoptions; ?></select></td>
		<td align="center" colspan="2"><select class="form-control" name="sunendweekend"><?php echo $timescboxoptions; ?></select></td>
		<td class="lastcol"></td>
</table>
</div>
<div class="clearfix"></div>
<br />
<div class="col-md-6">
<strong>Other Information:</strong>
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
<input class="btn btn-default" type="submit" name="action" value="Save and Continue &#62;&#62;" />
</div>
</form>



