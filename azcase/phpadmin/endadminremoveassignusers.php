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
<h3>Users Removed from Managing Data for <?php echo $username; ?> (<?php echo $useremail1; ?>)</h3>
<?php

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');
?>

