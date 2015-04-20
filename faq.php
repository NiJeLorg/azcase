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



?>
<body>
<h1>Frequently Asked Questions</h1>
<h4 class="question">Q: Where can I get a tutorial overview on how to use the AZ Afterschool Program Directory to Add and Edit my programs?</h4>
<div class="answer">
<p>
A: Our <a href="http://vimeo.com/46100491">video tutorial</a> covers the features and functionality of the AZ Afterschool Program Directory for providers. If you still have questions or concerns about using the directory please <a href="http://azafterschool.org/getdoc/d3fac837-df7c-4f4d-8791-c8486a2c7fe6/Contact.aspx">contact us.</a>
</p>
</div>

<h4 class="question">Q: How do I report a problem with the AZ Afterschool Program Directory or request a new feature to be added to the directory?</h4>
<div class="answer">
<p>
A: Click on the <a href="ticketing.php">"Report an Issue"</a> link next to your login name and link to change your settings. This will take you to a form requesting you to explain your problem or suggestion. The form will be sent immediately to our developers.
</p>
</div>

<h4 class="question">Q: What is the difference between a "location" and a "site" in the AZ Afterschool Program Directory?</h4>
<div class="answer">
<p>
A: In the AZ Afterschool Program Directory a “location” is a physical place, with an address, from which you operate. A “site” is an organized program. A location can have multiple sites. For example, the location Lincoln Elementary School at 123 Elm St. might have three sites - Basketball Program, School Year Youth Program, and Summer Youth Program. Each site may have different options, such as days open and hours of operation, ages served, fees charged, and other information.
</p>
</div>

<h4 class="question">Q: How do I add a new site?</h4>
<div class="answer">
<p>
A: Click on the “Add New Sites” button on your provider dashboard. From here you will choose an existing location for your site or add a new location for your site. Once a location is chosen or entered, you will be able to fill out the information for your program.
</p>
</div>

<h4 class="question">Q: I want to add a new site, why do I need to check a map of my existing locations first?</h4>
<div class="answer">
<p>
A: Your new site may be held at a location that is already entered into the directory. We want ensure that all locations in the directory are unique. Before adding a new site, please check your list of locations where you operate. If all the locations where you operate are on the map, just click <a href="newsites.php">"Skip Adding New Locations"</a> and you can start adding new sites at these locations. If not, click <a href="newlocations.php">"Add New Locations"</a> to add new locations to the directory.
</p>
</div>

<h4 class="question">Q: Can I add multiple sites to the directory at one time?</h4>
<div class="answer">
<p>
A: Yes, if the sites have the same information on activities, ages served, and hours of operation, and other information you can add them at the same time. The sites can be located at different locations. After adding your first site, click the “Add an Additional Site” button to bring up a new site form. You can add up to 30 sites at once.
</p>
</div>

<h4 class="question">Q: How can I update an existing site?</h4>
<div class="answer">
<p>
A: Select the site you want to edit from the list of sites on your provider dashboard under “Existing Sites” and click the “Edit” link next to that site. Make your changes to the information about the site and click “Save and Continue”.
</p>
</div>

<h4 class="question">Q: Can I update multiple sites at once?</h4>
<div class="answer">
<p>
A: You should only choose to edit multiple sites if they have the exact same information and options. All settings will be applied to all selected sites - program activities, hours of operation, ages served, and other information.  If you want to edit multiple sites, select more than one site and then click “Edit Existing Sites”. 
</p>
</div>

<h4 class="question">Q: How do I designate that my program occurs in the summer versus during the school year?</h4>
<div class="answer">
<p>
A: You should only choose to edit multiple sites if they have the exact same information and options. All settings will be applied to all selected sites - program activities, hours of operation, ages served, and other information.  If you want to edit multiple sites, select more than one site and then click “Edit Existing Sites”. 
</p>
</div>

<h4 class="question">Q: If my program has both a school year and a summer schedule, do I need to list my program twice?</h4>
<div class="answer">
<p>
A: Yes, if your program has differences between the summer and school year then it should be listed as two separate sites at the same location. These difference may be days and hours of operation, fees charged, ages served, or other options. If there are no differences between your summer and school year program than you can list this as one site under, “This site operates during BOTH the academic year and the summer.“
</p>
</div>

<h4 class="question">Q: How can I assign a new user to share managment of my sites and locations with me? </h4>
<div class="answer">
<p>
A:  From your provider dashboard click on the link <a href="editprovider.php">“Edit These Data and Assign Other Users to Manage Data”</a> under the heading “Your Organization’s Data”.  From here, enter the email address of the person who will be sharing management under “Assign Other Users to Manage Data for NiJeL”. You can remove shared access under “Other Users Assigned to Manage Data for NiJeL”. You can also access these options from the “Settings” link.
</p>
</div>

<h4 class="question">Q: How can I take ownership of sites and locations for which I am newly responsible?</h4>
<div class="answer">
<p>
A: The easiest way to obtain ownership of sites in the directory is for someone in your organization to add you as a manager from their provider dashboard. If no one in your organization has access to the directory, please <a href="http://azafterschool.org/getdoc/d3fac837-df7c-4f4d-8791-c8486a2c7fe6/Contact.aspx">contact us</a> and we can give you access.
</p>
</div>

<h4 class="question">Q: I have logged into the directory but all I can see are the bar graphs and map on my provider dashboard. Where are the other options?</h4>
<div class="answer">
<p>
A: Some browsers do not show a scrollbar along the right hand side of the shaded directory area inset in the webpage. Please click within the shaded area and use the down arrow key or the scroll button on your mouse to scroll down within the shaded area to access the other options.
</p>
</div>




<?php

// close logged_in
}else{}

// create footer
require('footer.php');
?>


<script type="text/javascript">

	$('.answer').hide();
	
	$('.question').collapser({
		target: 'next',
		effect: 'slide',
		changeText: 0,
		expandClass: 'expIco',
		collapseClass: 'collIco'
	}, function(){
		$('.answer').slideUp();
	});


</script>

