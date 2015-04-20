<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// connect to database
require("connect.php");

// login to the system
require('login.php');

// processing login script
displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// grab siteid from hidden
$siteid = $_REQUEST['siteid'];

// pull userid for ease of use later
$useremailsession = pg_escape_string($_SESSION['useremail']);
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

// set updated
$updated = date('Y-m-d H:i:s');

// store data passed
$locationname1 = stripslashes($_REQUEST['locationname1']);
$locationname2 = stripslashes($_REQUEST['locationname2']);
$locationname3 = stripslashes($_REQUEST['locationname3']);
$locationname4 = stripslashes($_REQUEST['locationname4']);
$locationname5 = stripslashes($_REQUEST['locationname5']);

$locationname1 = pg_escape_string($locationname1);
$locationname2 = pg_escape_string($locationname2);
$locationname3 = pg_escape_string($locationname3);
$locationname4 = pg_escape_string($locationname4);
$locationname5 = pg_escape_string($locationname5);

$locationnamesp1 = stripslashes($_REQUEST['locationnamesp1']);
$locationnamesp2 = stripslashes($_REQUEST['locationnamesp2']);
$locationnamesp3 = stripslashes($_REQUEST['locationnamesp3']);
$locationnamesp4 = stripslashes($_REQUEST['locationnamesp4']);
$locationnamesp5 = stripslashes($_REQUEST['locationnamesp5']);

$locationnamesp1 = pg_escape_string($locationnamesp1);
$locationnamesp2 = pg_escape_string($locationnamesp2);
$locationnamesp3 = pg_escape_string($locationnamesp3);
$locationnamesp4 = pg_escape_string($locationnamesp4);
$locationnamesp5 = pg_escape_string($locationnamesp5);

$address1 = stripslashes($_REQUEST['address1']);
$address2 = stripslashes($_REQUEST['address2']);
$address3 = stripslashes($_REQUEST['address3']);
$address4 = stripslashes($_REQUEST['address4']);
$address5 = stripslashes($_REQUEST['address5']);

$address1 = pg_escape_string($address1);
$address2 = pg_escape_string($address2);
$address3 = pg_escape_string($address3);
$address4 = pg_escape_string($address4);
$address5 = pg_escape_string($address5);

$address21 = stripslashes($_REQUEST['address21']);
$address22 = stripslashes($_REQUEST['address22']);
$address23 = stripslashes($_REQUEST['address23']);
$address24 = stripslashes($_REQUEST['address24']);
$address25 = stripslashes($_REQUEST['address25']);

$address21 = pg_escape_string($address21);
$address22 = pg_escape_string($address22);
$address23 = pg_escape_string($address23);
$address24 = pg_escape_string($address24);
$address25 = pg_escape_string($address25);

$city1 = stripslashes($_REQUEST['city1']);
$city2 = stripslashes($_REQUEST['city2']);
$city3 = stripslashes($_REQUEST['city3']);
$city4 = stripslashes($_REQUEST['city4']);
$city5 = stripslashes($_REQUEST['city5']);

$city1 = pg_escape_string($city1);
$city2 = pg_escape_string($city2);
$city3 = pg_escape_string($city3);
$city4 = pg_escape_string($city4);
$city5 = pg_escape_string($city5);

$state1 = stripslashes($_REQUEST['state1']);
$state2 = stripslashes($_REQUEST['state2']);
$state3 = stripslashes($_REQUEST['state3']);
$state4 = stripslashes($_REQUEST['state4']);
$state5 = stripslashes($_REQUEST['state5']);

$state1 = pg_escape_string($state1);
$state2 = pg_escape_string($state2);
$state3 = pg_escape_string($state3);
$state4 = pg_escape_string($state4);
$state5 = pg_escape_string($state5);

$zip1 = stripslashes($_REQUEST['zip1']);
$zip2 = stripslashes($_REQUEST['zip2']);
$zip3 = stripslashes($_REQUEST['zip3']);
$zip4 = stripslashes($_REQUEST['zip4']);
$zip5 = stripslashes($_REQUEST['zip5']);

$zip1 = pg_escape_string($zip1);
$zip2 = pg_escape_string($zip2);
$zip3 = pg_escape_string($zip3);
$zip4 = pg_escape_string($zip4);
$zip5 = pg_escape_string($zip5);


// add location1 if required values are present
if (!$locationname1 || !$address1 || !$city1 || !$state1 || !$zip1) {
}else{ 
	// check to see if this location exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_locations WHERE address = '$address1' AND city = '$city1';";
	$countresult = pg_query($connection, $countquery);
	$countaddress = pg_result($countresult, 0, 0);

	if ($countaddress>0) {
		require('header.php');
		echo "<body><h1>Error: Location Already Exists in the System</h1><p>It appears that you attmepted to add a location that already exists in the system. Please <a href=\"newlocations.php\"go back</a> and search for this location on the map. Thanks!</p>";
		require('footer.php');
		die();
	}else{
		// insert location into the database and connect it to this user
		$insertlocation = "INSERT INTO azcase_locations (\"locationid\", \"updated\", \"name\", \"namesp\", \"address\", \"address2\", \"city\", \"state\", \"zip\", \"lat\", \"lon\") VALUES (DEFAULT, '$updated', '$locationname1', '$locationnamesp1', '$address1', '$address21', '$city1', '$state1', '$zip1', NULL, NULL);";
		pg_send_query($connection, $insertlocation);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertlocation\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link location to user
		// pull locationid just assigned
		$locationidquery = "SELECT last_value FROM azcase_locations_locationid_seq;";
		$record = pg_query($connection, $locationidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $locationid = pg_result($record, $lt, 0);
		  }
		
		// insert new location to temp user/location temp table
		$insertuserloc = "INSERT INTO azcase_user_locations_junction (\"userid\", \"locationid\") VALUES ($userid, $locationid);";
		pg_send_query($connection, $insertuserloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertuserloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}
		 
	} // close if count address

} // close if location1 exists


// add location2 if required values are present
if (!$locationname2 || !$address2 || !$city2 || !$state2 || !$zip2) {
}else{ 
	// check to see if this location exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_locations WHERE address = '$address2' AND city = '$city2';";
	$countresult = pg_query($connection, $countquery);
	$countaddress = pg_result($countresult, 0, 0);

	if ($countaddress>0) {
		require('header.php');
		echo "<body><h1>Error: Location Already Exists in the System</h1><p>It appears that you attmepted to add a location that already exists in the system. Please <a href=\"newlocations.php\"go back</a> and search for this location on the map. Thanks!</p>";
		require('footer.php');
		die();
	}else{
		// insert location into the database and connect it to this user
		$insertlocation = "INSERT INTO azcase_locations (\"locationid\", \"updated\", \"name\", \"namesp\", \"address\", \"address2\", \"city\", \"state\", \"zip\", \"lat\", \"lon\") VALUES (DEFAULT, '$updated', '$locationname2', '$locationnamesp2', '$address2', '$address22', '$city2', '$state2', '$zip2', NULL, NULL);";
		pg_send_query($connection, $insertlocation);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertlocation\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link location to user
		// pull locationid just assigned
		$locationidquery = "SELECT last_value FROM azcase_locations_locationid_seq;";
		$record = pg_query($connection, $locationidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $locationid = pg_result($record, $lt, 0);
		  }
		
		// insert new location to temp user/location temp table
		$insertuserloc = "INSERT INTO azcase_user_locations_junction (\"userid\", \"locationid\") VALUES ($userid, $locationid);";
		pg_send_query($connection, $insertuserloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertuserloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

	} // close if count address

} // close if location2 exists


// add location3 if required values are present
if (!$locationname3 || !$address3 || !$city3 || !$state3 || !$zip3) {
}else{ 
	// check to see if this location exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_locations WHERE address = '$address3' AND city = '$city3';";
	$countresult = pg_query($connection, $countquery);
	$countaddress = pg_result($countresult, 0, 0);

	if ($countaddress>0) {
		require('header.php');
		echo "<body><h1>Error: Location Already Exists in the System</h1><p>It appears that you attmepted to add a location that already exists in the system. Please <a href=\"newlocations.php\"go back</a> and search for this location on the map. Thanks!</p>";
		require('footer.php');
		die();
	}else{
		// insert location into the database and connect it to this user
		$insertlocation = "INSERT INTO azcase_locations (\"locationid\", \"updated\", \"name\", \"namesp\", \"address\", \"address2\", \"city\", \"state\", \"zip\", \"lat\", \"lon\") VALUES (DEFAULT, '$updated', '$locationname3', '$locationnamesp3', '$address3', '$address23', '$city3', '$state3', '$zip3', NULL, NULL);";
		pg_send_query($connection, $insertlocation);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertlocation\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link location to user
		// pull locationid just assigned
		$locationidquery = "SELECT last_value FROM azcase_locations_locationid_seq;";
		$record = pg_query($connection, $locationidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $locationid = pg_result($record, $lt, 0);
		  }
		
		// insert new location to temp user/location temp table
		$insertuserloc = "INSERT INTO azcase_user_locations_junction (\"userid\", \"locationid\") VALUES ($userid, $locationid);";
		pg_send_query($connection, $insertuserloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertuserloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}


	} // close if count address

} // close if location3 exists


// add location4 if required values are present
if (!$locationname4 || !$address4 || !$city4 || !$state4 || !$zip4) {
}else{ 
	// check to see if this location exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_locations WHERE address = '$address4' AND city = '$city4';";
	$countresult = pg_query($connection, $countquery);
	$countaddress = pg_result($countresult, 0, 0);

	if ($countaddress>0) {
		require('header.php');
		echo "<body><h1>Error: Location Already Exists in the System</h1><p>It appears that you attmepted to add a location that already exists in the system. Please <a href=\"newlocations.php\"go back</a> and search for this location on the map. Thanks!</p>";
		require('footer.php');
		die();
	}else{
		// insert location into the database and connect it to this user
		$insertlocation = "INSERT INTO azcase_locations (\"locationid\", \"updated\", \"name\", \"namesp\", \"address\", \"address2\", \"city\", \"state\", \"zip\", \"lat\", \"lon\") VALUES (DEFAULT, '$updated', '$locationname4', '$locationnamesp4', '$address4', '$address24', '$city4', '$state4', '$zip4', NULL, NULL);";
		pg_send_query($connection, $insertlocation);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertlocation\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link location to user
		// pull locationid just assigned
		$locationidquery = "SELECT last_value FROM azcase_locations_locationid_seq;";
		$record = pg_query($connection, $locationidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $locationid = pg_result($record, $lt, 0);
		  }
		
		// insert new location to temp user/location temp table
		$insertuserloc = "INSERT INTO azcase_user_locations_junction (\"userid\", \"locationid\") VALUES ($userid, $locationid);";
		pg_send_query($connection, $insertuserloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertuserloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}


	} // close if count address

} // close if location4 exists


// add location5 if required values are present
if (!$locationname5 || !$address5 || !$city5 || !$state5 || !$zip5) {
}else{ 
	// check to see if this location exists in the database already - not a perfect matching search
	$countquery = "SELECT count(*) FROM azcase_locations WHERE address = '$address5' AND city = '$city5';";
	$countresult = pg_query($connection, $countquery);
	$countaddress = pg_result($countresult, 0, 0);

	if ($countaddress>0) {
		require('header.php');
		echo "<body><h1>Error: Location Already Exists in the System</h1><p>It appears that you attmepted to add a location that already exists in the system. Please <a href=\"newlocations.php\"go back</a> and search for this location on the map. Thanks!</p>";
		require('footer.php');
		die();
	}else{
		// insert location into the database and connect it to this user
		$insertlocation = "INSERT INTO azcase_locations (\"locationid\", \"updated\", \"name\", \"namesp\", \"address\", \"address2\", \"city\", \"state\", \"zip\", \"lat\", \"lon\") VALUES (DEFAULT, '$updated', '$locationname5', '$locationnamesp5', '$address5', '$address25', '$city5', '$state5', '$zip5', NULL, NULL);";
		pg_send_query($connection, $insertlocation);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertlocation\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// link location to user
		// pull locationid just assigned
		$locationidquery = "SELECT last_value FROM azcase_locations_locationid_seq;";
		$record = pg_query($connection, $locationidquery);
		  for ($lt = 0; $lt < pg_numrows($record); $lt++) {
		    $locationid = pg_result($record, $lt, 0);
		  }
		
		// insert new location to temp user/location temp table
		$insertuserloc = "INSERT INTO azcase_user_locations_junction (\"userid\", \"locationid\") VALUES ($userid, $locationid);";
		pg_send_query($connection, $insertuserloc);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new location. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processnewlocations.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processnewlocations.php\nFailed Query: $insertuserloc\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}


	} // close if count address

} // close if location5 exists


// close logged_in
}else{}


header("Location: http://maps.nijel.org/azcase_dev/editsite.php?siteid=$siteid");
?>

