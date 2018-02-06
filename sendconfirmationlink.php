<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// store email address submitted
$email = stripslashes($_REQUEST['email']);
$email = trim($email);


// check for valid email address
require('EmailAddressValidator.php');

$validator = new EmailAddressValidator;
if ($validator->check_email_address($email)) {

// search for the email in the database. if the email doesn't exist, ask user to try again or sign up for a new account.

$emaildb = pg_escape_string($email);


/* Verify that user is in database */
$passquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$emaildb';";
$countpassresult = pg_query($connection, $passquery);
$countpass = pg_result($countpassresult, 0, 0);
if ($countpass==0) {
	/* Notify that no email exists and kill script */
	echo "<h1>Email Address Does Not Exist in System</h1><p>The email address you entered is not included in our system. Please go back and try again with another email address or <a href=\"newprovider.php\">sign up for a new account</a>.</p><p>Email address entered: <b>$email</b></p>";
	require('footer.php');
	die();
}else{
	/* randomly select new 8 character password and replace this in database */
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	$randompassword = generateRandomString();
	$md5pass = md5($randompassword);

	$uquery = "UPDATE azcase_users SET temp_pass = '$md5pass' WHERE useremail = '$emaildb';";
	pg_send_query($connection, $uquery);

	/* Send new password to this email address */
	$subject = "AZ Afterschool Program Directory | Password Reset";
	$headers = "From: Genevieve Burns <gburns@azafterschool.org> \r\n";
	$headers .= "Content-type: text/html\r\n"; 
	$url = "https://azcase.nijel.org/phpsite/resetpassword.php?42=$randompassword";

	$message = "
Hello $email,
<br /><br />
To reset your AZ Afterschool Program Directory password, simply click the link below. That will take you to a web page where you can create a new password.
<br /><br />
<a href=\"$url\">$url</a>
<br /><br />
If you weren't trying to reset your password, don't worry - your account is still secure and no one has been given access to it. Most likely, someone just mistyped their email address while trying to reset their own password.
<br /><br />
Thanks,
<br />
Arizona Center for Afterschool Excellence
	";
	
	mail($email,$subject,$message,$headers);

} /* close if(!$result || (pg_num_rows($result) < 1)){ */

?>
<body>
<h1>Email Sent to Reset Password</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Provider Login</a></p>
<p>An email was sent to <b><?php echo $email; ?></b> with a link to create a new password. Please follow this link to update your password. Thanks!</p>

<?php
}else{
	echo "<h1>Invalid Email Address</h1><p>The email address you entered was invalid. Please go back and try again.</p><p>Email address entered: <b>$email</b></p>";
}

// create footer
require('footer.php');
?>

