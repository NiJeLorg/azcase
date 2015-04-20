<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

?>
<body>
<h3 class="azcase-text-color">Thank You!</h3>
<p>Thank you for adding your new sites! Please choose from the list below to continue. Thanks!</p>
<form name="form" id="form" action="processthankyou.php" method="POST">
	<input type="radio" name="thankyou" value="1"> I'm finished adding new sites.<br />
	<input type="radio" name="thankyou" value="2"> I'd like to add more new sites with different information.<br />
	<br /><br />
<input type="submit" class="btn btn-default" name="action" value="Continue &#62;&#62;" /></form>

<?php

// create footer
require('footer.php');

?>
