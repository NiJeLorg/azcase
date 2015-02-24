<?php
ini_set('session.cache_limiter', 'nocache');
// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
session_start(); 


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
<h1>Report an Issue</h1>
<iframe src="https://docs.google.com/spreadsheet/embeddedform?formkey=dHppVDNfNWpRcnV2WUk4YVU1cko1dnc6MQ" width="760" height="854" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>

<?php

// close logged_in
}else{}

// create footer
require('footer.php');
?>

