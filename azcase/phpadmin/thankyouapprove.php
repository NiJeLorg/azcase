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
<h3 class="azcase-text-color">Sites Approved Successfully!</h3>
<p><a href="http://azcase.nijel.org/" target="_top">Back to Admin Dashboard</a></p>
<p>You successfully approved a group of sites. An email was sent to each user associated with each site you approved to notify them of this action. Thanks!</p>
<?php

// create footer
require('footer.php');

?>
