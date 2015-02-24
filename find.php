<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// language traslation script
require('language.php');

?>
<body>
<table class="homeTable" cellspacing="0" cellpadding="0">
	<tr>
		<td class="homeTableMenuItem">
			<a href="searchhome.php?language=<?php echo $language; ?>"><?php echo $langtext['Find Programs Near You']; ?></a>
		</td>
	</tr>
	<tr>
		<td class="homeTableMenuItem">
			<a href="providerhome.php?language=<?php echo $language; ?>"><?php echo $langtext['Provider Login']; ?></a>
		</td>
	</tr>
</table>
<br />
<br />

<?php

// create footer
require('footer.php');

?>
