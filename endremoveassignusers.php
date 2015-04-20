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
require('header.php');

// processing login script
displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

$useremail = $_REQUEST['useremail'];

?>
<body>
<h1>Users Removed from Managing Your Data</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Provider Dashboard</a> | <a href="editprovider.php">&#60;&#60; Back to Editing Your Organizational Information</a></p>

<?php

// close logged_in
}else{}

// create footer
require('footer.php');
?>

