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


// set updated
$updated = date('Y-m-d H:i:s');

// create loop to dertermine which sites where chosen - set chosen ones verified = 1
$siteidloopquery = "SELECT siteid, name, summer FROM azcase_sites WHERE verified = 2;";
$siteidloopresult = pg_query($connection, $siteidloopquery);
for ($lt = 0; $lt < pg_numrows($siteidloopresult); $lt++) {
	$siteidloop = pg_result($siteidloopresult, $lt, 0);
	if (isset($_REQUEST["$siteidloop"])) {

		// set each site chosen to verified = 1
		$updatesiteid = "UPDATE azcase_sites SET verified = 1 WHERE siteid = $siteidloop;";
		pg_send_query($connection, $updatesiteid);
		$res1 = pg_get_result($connection);
		$pgerror1 = pg_result_error($res1);
		if ($pgerror1!=FALSE) {
			require('header.php');
			echo "<h1>Save Error</h1><p>An error occured when you attempted to approve a site. An email was sent to NiJeL and we will address this problem. We're sorry for any inconvenience</p>";
			require('footer.php');
			$to = "jd@nijel.org";
			$subject = "AZ Afterschool Program Directory Error: processapprovesites.php Failed";
			$message = "User:" . $_SESSION['useremail'] . "\nPage: processapprovesites.php\nFailed Query: $updatesiteid\nError: $pgerror1";
			mail($to,$subject,$message);
			die ();
		}else{}

		// email user that their site has been approved. 
		// pull data to accompany the email
		$sitename = pg_result($siteidloopresult, $lt, 1);
		$summer = pg_result($siteidloopresult, $lt, 2);

		$locationquery = "SELECT name, address, address2, city, state, zip, locationid FROM azcase_locations WHERE locationid IN (SELECT locationid FROM azcase_sites_locations_junction WHERE siteid = $siteidloop);";
		$locationresult = pg_query($connection, $locationquery);
		for ($lt1 = 0; $lt1 < pg_numrows($locationresult); $lt1++) {
			$locationname = pg_result($locationresult, $lt1, 0);
			$address = pg_result($locationresult, $lt1, 1);
			$address2 = pg_result($locationresult, $lt1, 2);
			$city = pg_result($locationresult, $lt1, 3);
			$state = pg_result($locationresult, $lt1, 4);
			$zip = pg_result($locationresult, $lt1, 5);		
			$locationid = pg_result($locationresult, $lt1, 6);		
		}
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
		
		// Add (SUMMER SITE) to the end of the site name 
		if ($summer=='t') {
			$sitename = $sitename . ' (SUMMER SITE)';
		}else{}


		// pull email addresses for users tied to site and loop through emailing them all		
		$userquery = "SELECT useremail FROM azcase_users WHERE userid IN (SELECT userid FROM azcase_user_sites_junction WHERE siteid = $siteidloop);";
		$userresult = pg_query($connection, $userquery );
		for ($lt2 = 0; $lt2 < pg_numrows($userresult); $lt2++) {
			$email = pg_result($userresult, $lt2, 0);

			/* Send new password to this email address */
			$subject = "AZ Afterschool Program Directory | $sitename Has Been Approved";
			$headers = "From: Genevieve Burns <gburns@azafterschool.org> \r\n";
			$headers .= "Content-type: text/html\r\n"; 
			$url = "http://azafterschool.org/directory/";

			$message = "
			Hello $email,
			<br /><br />
			Thank you again for adding your site, $sitename, located at $locationname</b> ($printaddress) to the AZ Afterschool Program Directory! Your recent additions to this site have been approved, and you can now view your site on our map by following the link below and clicking on \"Find Programs Near You.\"
			<br /><br />
			<a href=\"$url\">$url</a>
			<br /><br />
			Thanks,
			<br />
			Arizona Center for Afterschool Excellence
			";
			mail($email,$subject,$message,$headers);

		} // user email loop

	}else{} // close if ($_REQUEST["$siteidloop"]=='t')
} // close for loop

// close logged_in
}else{}


header("Location: http://maps.nijel.org/azcase_dev/thankyouapprove.php");
?>

