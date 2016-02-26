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
			<a href="searchhome.php?language=1">Continue in English &#62;&#62;</a>
		</td>
	</tr>
	<tr>
		<td class="homeTableMenuItem">
			<a href="searchhome.php?language=2">Continuar en Español &#62;&#62;</a>
		</td>
	</tr>
	<tr>
		<td class="homeTableMenuItem">
			<a href="providerhome.php?language=1">Provider Login &#62;&#62;</a>
		</td>
	</tr>
</table>
<br />
<div id="clear"></div>
<br />
<iframe style="display: block; margin: 0 auto;" src="https://player.vimeo.com/video/122768528?color=ffffff&byline=0&portrait=0" width="800" height="465" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<br />
<br />
<?php
// create footer
require('footer.php');

// geocode data on index page and admin index page
require('geocode.php');

?>
