<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');


// call different scripts if approve or decline was selected
if (!$_REQUEST['decline']) {
	require('approvesites.php');
}elseif (!$_REQUEST['approve']) {
	require('declinesites.php');
}else{}


// create footer
require('footer.php');


?>

