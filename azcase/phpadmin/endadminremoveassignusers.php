<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');


// grab data and clean up for database query and for return to last page
$userid = $_REQUEST['userid'];

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
<h3 class="azcase-text-color">Users Removed from Managing Data for <?php echo $username; ?> (<?php echo $useremail1; ?>)</h3>
<p><a href="http://azcase.nijel.org/" target="_top">Back to Admin Dashboard</a></p>

<?php

// create footer
require('footer.php');
?>

