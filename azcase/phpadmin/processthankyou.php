<?php

session_start(); 

$thankyou = $_REQUEST['thankyou'];

if ($thankyou==1 || !$thankyou) {
	// unset userid session 
	unset($_SESSION['POSTuserid']);
	echo "<script>parent.window.location = 'http://104.131.19.183/'</script>";
}elseif ($thankyou==2) {
	header("Location: http://104.131.19.183/php/newsites.php");
}else{}

?>
