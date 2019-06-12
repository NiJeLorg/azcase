<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// login to the system
require('login.php');

// create header
//require('header.php');

// processing login script
//displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// pull userid for ease of use later
$useremailsession = pg_escape_string($_SESSION['useremail']);
$basicinfoquery = "SELECT 
userid
FROM azcase_users WHERE useremail = '$useremailsession';";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$userid = pg_result($basicinforesult, $lt, 0);
}

$updatesitejunc = "UPDATE azcase_user_sites_junction SET newsite = FALSE WHERE siteid IN (SELECT siteid FROM azcase_user_sites_junction WHERE userid = $userid AND newsite = TRUE AND siteid IN (SELECT siteid FROM azcase_sites WHERE siteid_old IS NOT NULL));";
pg_send_query($connection, $updatesitejunc);
$res1 = pg_get_result($connection);
$pgerror1 = pg_result_error($res1);
if ($pgerror1!=FALSE) {
	require('header.php');
	echo "<h1>Save Error</h1><p>An error occured when you attempted to submit a new site. An email was sent to the AZ Afterschool Program Directory adminstrator and we will address this problem. We're sorry for any inconvenience</p>";
	require('footer.php');
	$to = "jd@nijel.org";
	$subject = "AZ Afterschool Program Directory Error: thankyoueditbatchsite.php Failed";
	$message = "User:" . $_SESSION['useremail'] . "\nPage: thankyoueditbatchsite.php\nFailed Query:" .$updatesitejunc. "\nError:" .$pgerror1;
	mail($to,$subject,$message);
	die ();
}else{}


// email administrators and let them know that a user has just added new sties
// loop though all administrators and email them about new additons
$adminquery = "SELECT useremail FROM azcase_users WHERE admin = TRUE;";
$adminresult = pg_query($connection, $adminquery );
for ($lt = 0; $lt < pg_numrows($adminresult); $lt++) {
	$email = pg_result($adminresult, $lt, 0);

	/* Send new password to this email address */
	$subject = "AZ Afterschool Program Directory | A Group of Sites Has Been Edited";
	$headers = "From: AzCASE <azcase.directory@gmail.com> \r\n";
	$headers .= "Content-type: text/html\r\n"; 
	$url = "http://azafterschool.org/directory/";

	$message = "
	Hello $email,
	<br /><br />
	A user has edited a group of sites in the AZ Afterschool Program Directory, and before they are updated to reflect the new data, an administrator must approve these changes. You as an administrator can approve or decline these changes by logging in to the system at the link below. 
	<br /><br />
	<a href=\"". $url ."\">". $url ."</a>
	<br /><br />
	Once you log in, go to \"Verify Sites\" in the \"Actions\" section of your administrator dashboard to verify these edits. 
	<br /><br />
	Thanks,
	<br />
	Arizona Center for Afterschool Excellence
	";

	mail($email,$subject,$message,$headers);

} // admin loop

// email user and thank them for adding their data, verification process
$subject = "AZ Afterschool Program Directory | A Group of Your Sites Have Been Edited";
$headers = "From: AzCASE <azcase.directory@gmail.com> \r\n";
$headers .= "Content-type: text/html\r\n"; 
$url = "http://azafterschool.org/directory/";

$message = "
Hello " . $_SESSION['useremail'] . ",
<br /><br />
Thank you for editing a group of your sites in the to the AZ Afterschool Program Directory! Before changes appear on the public map, they will need be verified by an administrator at the Arizona Center for Afterschool Excellence. When that happens, we will notify you at this email address. These sites now appear in your provider dashboard under \"Existing Sites,\" with a darker grey shading indicating that these sites have not yet been verified. You can get to your provider dashboard by going to the main AZ Afterschool Program Directory page and clicking on \"Provider Login\".
<br /><br />
<a href=\"". $url ."\">". $url ."</a>
<br /><br />
Thanks,
<br />
Arizona Center for Afterschool Excellence
";

mail($_SESSION['useremail'],$subject,$message,$headers);


?>
<body>
<h1>Thank You!</h1>
<p>Thank you for updating your sites! Please click continue to be taken back to the provider dashboard. Thanks!</p>
<form name="form" id="form" action="providerhome.php" method="POST">
<input type="submit" name="action" value="Continue &#62;&#62;" /></form>

<?php
// close logged_in
}else{}

// create footer
require('footer.php');

?>
