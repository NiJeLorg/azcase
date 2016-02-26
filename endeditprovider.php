<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require("header.php");

$useremailsession = pg_escape_string($_SESSION['useremail']);
// check to see if user changed their email - if so log out and if not print new data
$countquery = "SELECT count(*) FROM azcase_users WHERE useremail = '$useremailsession';";
$countresult = pg_query($connection, $countquery);
$countemail = pg_result($countresult, 0, 0);

if ($countemail>0) {

}else{
}

echo $pagecontent;

// create footer
require('footer.php');
?>

