<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');


?>
<body>
<h3 class="azcase-text-color">New Location(s) Saved</h3>
<p><a href="http://127.0.0.1:8000/" target="_top">Back to Admin Dashboard</a></p>

<?php

// create footer
require('footer.php');
?>

