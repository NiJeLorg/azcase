<?php
// this is a very simple api to receive requests from the Make it Count pledge to see if the resource is in the directory
// connect to database


function resource_in_directory($siteName, $locationName) {
	require("connect.php");
	//query database for name
	// find a replace all special characters with nothing
	$siteName = urldecode($siteName);
	$locationName = urldecode($locationName);
	// split string by spaces
	$nameArray = explode(" ", $siteName);
	$locationArray = explode(" ", $locationName);
	// loop through name array and add to like statement
	foreach ($nameArray as &$value) {
	    $value = "name ILIKE '%$value%'";
	}
	foreach ($locationArray as &$value) {
	    $value = "name ILIKE '%$value%'";
	}
	$sitesLike = implode(" AND ", $nameArray);
	$locationsLike = implode(" AND ", $locationArray);

	$sitequery = "SELECT siteid, locationid FROM azcase_sites_locations_junction WHERE siteid IN (SELECT siteid FROM azcase_sites WHERE $like);";
	$sitequery = "SELECT siteid FROM azcase_sites WHERE $sitesLike;";
	$siteresult = pg_query($connection, $sitequery);
	$sitesids = pg_fetch_all_columns($siteresult, 0);

	$locationquery = "SELECT locationid FROM azcase_locations WHERE $locationsLike;";
	$locationresult = pg_query($connection, $locationquery);
	$locationids = pg_fetch_all_columns($locationresult, 0);

	$sitesids = implode(",", $sitesids);
	$locationids = implode(",", $locationids);

	$sitelocationquery = "SELECT siteid, locationid FROM azcase_sites_locations_junction WHERE siteid IN ($sitesids) AND locationid IN ($locationids);";
	$sitelocationresult = pg_query($connection, $sitelocationquery);
	$sitelocationids = pg_fetch_row($sitelocationresult, 0);	

	if ($sitelocationids) {
		return $sitelocationids;
	} else {
		return 'No Data';
	}


}

function resource_by_id($id) {
	require("connect.php");
	//query database for name
	// find a replace all special characters with nothing
	$id = urldecode($id);

	$sitelocationquery = "SELECT siteid, locationid FROM azcase_sites_locations_junction WHERE wp_pledge_id = $id;";
	$sitelocationresult = pg_query($connection, $sitelocationquery);
	$sitelocationids = pg_fetch_row($sitelocationresult, 0);	

	if ($sitelocationids) {
		return $sitelocationids;
	} else {
		return 'No Data';
	}


}

if (isset($_GET["action"])) {
    if (isset($_GET["site"]) && isset($_GET["location"])) {
    	$value = resource_in_directory($_GET["site"], $_GET["location"]);
    } else if (isset($_GET["id"])) {
    	$value = resource_by_id($_GET["id"]);
    } else {
    	$value = "Missing argument";
    }
}

exit(json_encode($value));

?>

