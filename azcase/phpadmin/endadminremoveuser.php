<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

global $connection;

if ($admin=='t') {

// bring search data across
$searchusername = $_REQUEST['searchusername'];
$searchuseremail = $_REQUEST['searchuseremail'];
$searchorgname = $_REQUEST['searchorgname'];


$pagecontent = "
<body>
<h3>User Removed</h3>
";

echo $pagecontent;

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');
?>

