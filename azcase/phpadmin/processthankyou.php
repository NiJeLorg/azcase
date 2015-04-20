<?php

session_start(); 

$thankyou = $_REQUEST['thankyou'];

if ($thankyou==1 || !$thankyou) {
	// unset userid session 
	unset($_SESSION['POSTuserid']);
	echo "<script>parent.window.location = 'http://127.0.0.1:8000/'</script>";
}elseif ($thankyou==2) {
	header("Location: http://maps.nijel.org/azcase_dev/azcase/phpadmin/newsites.php");
}else{}

?>
