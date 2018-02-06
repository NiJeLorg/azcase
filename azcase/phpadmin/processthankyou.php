<?php

session_start(); 

$thankyou = $_REQUEST['thankyou'];

if ($thankyou==1 || !$thankyou) {
	// unset userid session 
	unset($_SESSION['POSTuserid']);
	echo "<script>parent.window.location = 'https://azcase.nijel.org/'</script>";
}elseif ($thankyou==2) {
	header("Location: https://azcase.nijel.org/php/newsites.php");
}else{}

?>
