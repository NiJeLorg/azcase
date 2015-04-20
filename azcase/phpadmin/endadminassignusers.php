<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

global $connection;

if ($admin=='t') {

// grab data and clean up for database query and for return to last page
$userid = $_REQUEST['userid'];
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];

// pass new email
$useremail = $_REQUEST['useremail'];

// get data for user id passed
$basicinfoquery = "SELECT 
username,
useremail
FROM azcase_users WHERE userid = $userid;";
$basicinforesult = pg_query($connection, $basicinfoquery);
for ($lt = 0; $lt < pg_numrows($basicinforesult); $lt++) {
	$username = pg_result($basicinforesult, $lt, 0);
	$useremail1 = pg_result($basicinforesult, $lt, 1);
}


?>
<body>
<h3>New User Saved and Assigned to Manage Data for <?php echo $username; ?> (<?php echo $useremail1; ?>)</h3>
<p>Thank you for creating an account for <?php echo $useremail; ?> and assigning them the ability to manage data for <?php echo $username; ?> (<?php echo $useremail1; ?>). An email was sent to <?php echo $useremail; ?> providing instructions on changing their password and logging in to the system. Please have them log in to the system to review these data. Thanks!</p> 

<?php

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');
?>

