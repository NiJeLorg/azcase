<?php

session_start();

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

$useremail = $_REQUEST['useremail'];

?>
<body>
<h3>New User Saved and Assigned to Administer the System</h3>
<p>Thank you for creating an adminstrative account for <?php echo $useremail; ?>. An email was sent to <?php echo $useremail; ?> providing instructions on changing their password and logging in to the system. Please have them log in to the system to review the administrative area, and please <a href="ticketing.php">report any issues</a> that you may have. Thanks!</p> 

<?php
// create footer
require('footer.php');
?>

