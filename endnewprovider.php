<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

$url = "https://azcase.nijel.org/phpsite/index.php";
?>
<body>
<h1>Thank You for Signing Up for an Account</h1>
<p>Thank you for signing up for an account on the account on the <a href="https://azcase.nijel.org/phpsite/index.php">AZ Afterschool Program Directory.</a> To get started, please <a href="https://azcase.nijel.org/phpsite/providerhome.php">login</a> to the provider area to add your out-of-school-time locations and sites to the system. Thanks!</p>

<?php

// create footer
require('footer.php');
?>

