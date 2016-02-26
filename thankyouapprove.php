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

?>
<body>
<h1>Sites Approved Successfully!</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="verifysites.php">&#60;&#60; Back to Verify Sites</a></p>
<p>You successfully approved a group of sites, which will now be included on the AZ Afterschool Map. An email was sent to each user associated with each site you approved to notify them of this action. Thanks!</p>

<?php
// close logged_in
}else{}

// create footer
require('footer.php');

?>
