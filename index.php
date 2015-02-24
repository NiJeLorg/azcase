<?php
ini_set('session.cache_limiter', 'nocache');
session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

?>
<body>
<table class="homeTable" cellspacing="0" cellpadding="0">
	<tr>
		<td class="homeTableMenuItem">
			<a href="find.php?language=1">Continue in English &#62;&#62;</a>
		</td>
	</tr>
	<tr>
		<td class="homeTableMenuItem">
			<a href="find.php?language=2">Continuar en Español &#62;&#62;</a>
		</td>
	</tr>
</table>
<br />
<div id="clear"></div>
<br />
<h1 align="center">AZ Afterschool Program Directory Video Tutorial</h1>
<iframe src="http://player.vimeo.com/video/46246966?byline=0&amp;portrait=0" width="890" height="500" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<br />
<br />
<?php
// create footer
require('footer.php');

// geocode data on index page and admin index page
require('geocode.php');

?>
