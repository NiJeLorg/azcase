<?php

session_start(); 

// privacy policy for cookies
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// connect to database
require("connect.php");

// create header
require('header.php');

// requests a user to log in if they haven't already
global $logged_in;
if($logged_in){

global $connection;

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
	$table = "<h3>This user has no sites to renew.</h3><p><a href=\"providerhome.php\">Go back</a> to the Admin Dashboard.</p>";
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
       $sitename = $sitename . ' <strong>(SUMMER SITE)</strong>';
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
<h3>Renew Sites for $username</h3>";

echo $body;
echo $table; 

// close admin = TRUE
}else{}

// close logged_in
}else{}

// create footer
require('footer.php');

?>
