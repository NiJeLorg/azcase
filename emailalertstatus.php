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

global $connection;
/* Verify that user partner is admin or not */
$useremailsession = pg_escape_string($_SESSION['useremail']);
$partnerquery = "SELECT admin FROM azcase_users WHERE useremail = '$useremailsession';";
$result = pg_query($connection, $partnerquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$admin = pg_result($result, $lt, 0);
}
//admin = TRUE 
if ($admin=='t') {

//Get a "true" from the URL id the user is coming back from renewing all a user's sites. The div class is for a JQuery function to fade the updte message away after a few seconds.
if ($_REQUEST['renew']=='true') {
$printupdateresult = "<H1><div class=\"updatetext\">Users' sites were updated successfully!</div></H1>";
}else{}

//get all records that have been updated more than a year ago from today, and have a 1 in verified field
$emailquery = "SELECT azcase_users.userid, username, useremail, renewalemail, azcase_users.phone, azcase_users.address, azcase_users.city, count(*)
FROM azcase_user_sites_junction
JOIN azcase_users ON azcase_users.userid = azcase_user_sites_junction.userid
JOIN azcase_sites ON azcase_sites.siteid = azcase_user_sites_junction.siteid
WHERE azcase_sites.updated < CURRENT_DATE - INTERVAL '1 year' AND verified = 1
Group BY azcase_users.userid, username, useremail, zip, azcase_users.phone, azcase_users.address, azcase_users.city, renewalemail;";

//connect to db for data query
$emailresult = pg_query($connection, $emailquery);

//Table of users grouped by site count
$table = "
<form name=\"renewsites\" action=\"renewallsites.php\" method=\"POST\">
<input type=\"submit\" name=\"renew\" value=\"Renew Checked Users' Sites for Another Year &#62;&#62;\" />

<br /><br />
<table class = \"hoursTable\">
  <tr>
   <th><input type=\"button\" class=\"check\" value=\"Check All\" /></th>
   <th>Edit Sites</th>
   <th>Last Renewal Email Sent</th>
   <th>Contact Name</th>
   <th>Email</th>
   <th>Phone</th>
   <th>Address</th>  
   <th># of Sites</th>
  </tr>";

if (pg_numrows($emailresult)==0) {
//if no sites to renew
	$table = "<h1>No Sites to Verify</h1><p><a href=\"providerhome.php\">Go back</a> to the Admin Dashboard.</p>";
}else{

for ($lt = 0; $lt < pg_numrows($emailresult); $lt++) {
	

// Loop on rows in the result set.
$table.="<tr>\n";
    $row = pg_fetch_array($emailresult, $lt);


//get last updated renewal date for sites and make just date not time
$renewalemail = strtotime($row["renewalemail"]);
if ($renewalemail!=NULL) {
$renewalemail = date('Y-m-d',$renewalemail);
}else{
}


$table.= " 

<td align=\"center\"><input type=\"checkbox\" name=\"".$row['userid']."\" value=\"t\" /></td>
<td><a href=\"admineditusersites.php?user=" .$row["userid"]. "\">Edit Sites</a></td>
<td>". $renewalemail. "</td>
<td>". $row["username"]. "</td>
<td>". $row["useremail"]. "</td>
<td>". $row["phone"]. "</td>
<td>". $row["address"].", ".$row["city"]. "</td>
<td>". $row["count"]. "</td>
</tr>
  ";
   

} //close loop

$table.= "</table>
<br />
<input type=\"submit\" name=\"renew\" value=\"Renew Checked Users' Sites for Another Year &#62;&#62;\" />
</form>
";
} // close if else 
?>

<body>
<H1>Yearly Site Renewal List By User</H1>
<p><a href="providerhome.php">&#60;&#60; Back to Your Admin Dashboard</a></p>
<?php
echo $printupdateresult;
echo $table; 
// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>

<script language="JavaScript">
$(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('Uncheck All')
    },function(){
        $('input:checkbox').removeAttr('checked');
        $(this).val('Check All');        
    })
})

$(document).ready(function(){
   setTimeout(function(){
  $("div.updatetext").fadeOut("slow", function () {
  $("div.updatetext").remove();
      });
 
}, 2000);
 });
</script>


