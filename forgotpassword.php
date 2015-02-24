<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// recover user emails and passwords

?>
<body>
<h1>Password Reset</h1>
<p>Enter your e-mail address and we will send you a message with link to reset your password.</p>
<form name="search" action="sendconfirmationlink.php" method="POST">
<table cellpadding="2">
	<tr>
		<td align="right" width="75"><b>Email: </b></td>
		<td align="left"><input type="email" name="email" value=""/></td>
		<td align="left"><input type="submit" name="action" value="Reset Password" /></td>
	</tr>
	</table>
<br />

</p>
</form>

<?php

// create footer
require('footer.php');
?>

