<?php
if(mail("jd@nijel.org","A Subject Here","Hi there,\nThis email was sent using PHP's mail function."))
print "Email successfully sent";
else
print "An error occured";
?>