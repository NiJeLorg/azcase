<?php
ini_set('session.cache_limiter', 'nocache');
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
<h1>New User Saved and Assigned to Manage Your Data</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a> | <a href="editprovider.php">&#60;&#60; Back to Editing Your Organizational Information</a></p>
<p>Thank you for creating an account for <?php echo $useremail; ?> and assigning them the ability to manage your data. An email was sent to <?php echo $useremail; ?> providing instructions on changing their password and logging in to the system. Please have them log in to the system to review your data with them, and please <a href="ticketing.php">report any issues</a> that you may have. Thanks!</p> 

<?php
// create footer
require('footer.php');
?>

