<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

global $connection;

// accept site id
$locationid = $_REQUEST['locationid'];

?>
<body>
<h3 class="azcase-text-color">Admin Edit Location</h3>
<p>Please edit any data below. Thanks!</p>
<?php

// add in the new locations form
require('admineditlocationform.php'); 

// create footer
require('footer.php');


?>
