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
?>
<?php
//admin = TRUE 
if ($admin=='t') {

$searchuser = $_REQUEST['user'];

$renewquery = "SELECT azcase_sites.siteid, azcase_sites.name, azcase_users.username, azcase_sites.summer, azcase_sites.updated
FROM azcase_user_sites_junction
JOIN azcase_users ON azcase_users.userid = azcase_user_sites_junction.userid
JOIN azcase_sites ON azcase_sites.siteid = azcase_user_sites_junction.siteid
WHERE azcase_users.userid=$searchuser
Order BY azcase_sites.name;";


//connect to db for data query
$renewresult = pg_query($connection, $renewquery);

$table = "
<table class = \"hoursTable\">
  <tr>
   <th>Sites</th>
   <th>Last Updated</th>
  </tr>";

if (pg_numrows($renewresult)==0) {
//if no sites to renew
	$table = "<h1>This user has no sites to renew.</h1><p><a href=\"providerhome.php\">Go back</a> to the Admin Dashboard.</p>";
}else{
for ($lt = 0; $lt < pg_numrows($renewresult); $lt++) {
	
// Loop on rows in the result set.
$table.="<tr>\n";
    $row = pg_fetch_array($renewresult, $lt);
//get user name for page name
$username = $row["username"];
//get site name
$sitename = $row["name"];
//get summer status
$summer = $row["summer"];

//get last updated date for sites and make just date not time
$updated = strtotime($row["updated"]);
$updated_date = date('Y-m-d',$updated); 


 // Add (SUMMER SITE) to the end of the site name
if ($summer=='t') {
       $sitename = $sitename . ' <b>(SUMMER SITE)</b>';
}else{}

$table.= " 

<td><a href=\"admineditsite.php?siteid=" . $row["siteid"]. "\">$sitename</a></td>
<td>$updated_date</td>
</tr>
  ";



} //close loop

$table.= "</table>
<br />";

} // close if else 

$body= "<body>
<H1>Renew Sites for $username</H1>
<p><a href=\"emailalertstatus.php\">&#60;&#60; Back to Renewal List</a></p>";

echo $body;
echo $table; 

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>
