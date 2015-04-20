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
require('header.php');

// processing login script
displayLogin();

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

// pull user id for ease of use below
$useremailsession = pg_escape_string($_SESSION['useremail']);
$useridquery = "SELECT userid FROM azcase_users WHERE useremail = '$useremailsession';";
$useridresult = pg_query($connection, $useridquery);
for ($lt = 0; $lt < pg_numrows($useridresult); $lt++) {
	$userid = pg_result($useridresult, $lt, 0);
}

?>
<body>
<h1>Choose a New Password</h1>
<p>Please choose a new password below. Your new password can contain any combination of letters numbers or symbols, but must be between 8 and 32 characters.</p>
<p>
<form name="resetpassword" action="changepasswordcomplete.php" method="POST" onSubmit="return validateForm();">
<input type="hidden" name="userid" value="<?php echo $userid; ?>">
<table cellpadding="2">
	<tr>
		<td align="right" width="125"><b>Password: </b></td>
		<td align="left"><input type="password" name="password" value="" /></td>
	</tr>
	<tr>
		<td align="right" width="125"><b>Retype Password: </b></td>
		<td align="left"><input type="password" name="rtpassword" value="" /></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="submit" name="resetpassword" value="Reset Password"></td></tr>
	</table>
<br />
</p>
</form>

<?

// close logged_in
}else{}

// create footer
require('footer.php');

?>

<!-- validate that the fields are identical -->
<script type="text/javascript" language="JavaScript">

function validateForm() {
var one = document.resetpassword.password.value;
var another = document.resetpassword.rtpassword.value;

if (one.length < 8) {
        alert("Passwords cannot be less then 8 characters. Please try again.");
	document.resetpassword.password.focus();
        return false;
    }

if (one.length > 32) {
        alert("Passwords cannot be more than 32 characters. Please try again.");
	document.resetpassword.password.focus();
        return false;
    }

if (another.length < 8) {
        alert("Passwords cannot be less then 8 characters. Please try again.");
	document.resetpassword.rtpassword.focus();
        return false;
    }

if (another.length > 32) {
        alert("Passwords cannot be more than 32 characters. Please try again.");
	document.resetpassword.rtpassword.focus();
        return false;
    }

if (one !== another) {
	alert("Passwords do not match. Please try again.");
	document.resetpassword.password.focus();
	return false;
    }

return true;

}

</script>

