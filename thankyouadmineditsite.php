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

// grab search terms if coming from search page
$searchname = $_REQUEST['searchname'];
$searchemail = $_REQUEST['searchemail'];
$searchphone = $_REQUEST['searchphone'];

// add backtrack link if coming from search page
if (!$searchname && !$searchemail && !$searchphone) {
	$backurl = '';
}else{
	$backurl = " | <a href=\"adminsearchsites.php?searchname=$searchname&searchemail=$searchemail&searchphone=$searchphone\">&#60;&#60; Back to Your Search Results For Sites</a>";
}

?>
<body>
<h1>Site Updated Successfully!</h1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a> | <a href="verifysites.php">&#60;&#60; Back to Verify Sites</a><?php echo $backurl; ?></p>


<?php
// close logged_in
}else{}

// create footer
require('footer.php');

?>
