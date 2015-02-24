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

// email user and thank them for adding their data, verification process
$subject = "AZ Afterschool Program Directory | A Group of Your Sites Have Been Removed";
$headers = "From: Genevieve Burns <gburns@azafterschool.org> \r\n";
$headers .= "Content-type: text/html\r\n"; 

$message = "
Hello " . $_SESSION['useremail'] . ",
<br /><br />
You have opted to remove a group of sites from the AZ Afterschool Program Directory. If you believe this was done in error, please email us at Genevieve Burns <gburns@azafterschool.org>  and let us know which sites you believe were removed in error. 
<br /><br />
Thanks,
<br />
Arizona Center for Afterschool Excellence
";

mail($_SESSION['useremail'],$subject,$message,$headers);


?>
<body>
<h1>Sites Successfully Removed</h1>
<p>The sites you selected have been removed from the AZ Afterschool Program Directory. If you believe this was done in error, please email us at <a href="mailto:Genevieve Burns <gburns@azafterschool.org> ">Genevieve Burns <gburns@azafterschool.org> </a> and let us know which sites you believe were removed in error. Please click continue to be taken back to the provider dashboard. Thanks!</p>
<form name="form" id="form" action="providerhome.php" method="POST">
<input type="submit" name="action" value="Continue &#62;&#62;" /></form>

<?php
// close logged_in
}else{}

// create footer
require('footer.php');

?>
