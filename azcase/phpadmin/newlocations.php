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
<?php

// add in the new locations form
require('addnewlocationsform.php'); 

// create footer
require('footer.php');

?>

<script type="text/javascript">
function inputFocus(i){
    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
}
function inputBlur(i){
    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
}
</script>

<script language="javascript">
function toggle(obj) {
	var el = document.getElementById(obj);
	if ( el.style.display == 'none' ) {
		el.style.display = '';
	}
	else {
	}
}
</script>

<script language="javascript">
function disablebutton(obj) {
	var db = document.getElementById(obj);
	db.disabled=true;	
}
</script>



