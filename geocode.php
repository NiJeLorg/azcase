<?php
define("MAPS_HOST", "maps.googleapis.com");
define("API_KEY", "AIzaSyBao-t3WsnhKNqNVnHdGsOwYLycL2pnw0E");

// https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY
$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/json";
$params = "&key=" . API_KEY;

include ('connect.php');

// declare my query and execute
$query = pg_exec($connection, "SELECT locationid, address, city, zip FROM azcase_locations WHERE lat is NULL AND lon is NULL;");


// Iterate through the rows, geocoding each address
for ($lt = 0; $lt < pg_numrows($query); $lt++) {
    $locationid = pg_result($query, $lt, 0);
    $street = pg_result($query, $lt, 1);
    $city = pg_result($query, $lt, 2);
    $zip = pg_result($query, $lt, 3);
    
    // explode street string to remove everything after a # sign, like apartment numbers
    $partsStreet = explode('#', $street);
    $partsStreet1 = $partsStreet[0];
    
    // trim whitespace for OSM
    $partsStreet1 = trim($partsStreet1);
    $city = trim($city);
    
    // prep strings for url
    $streeturl = urlencode($partsStreet1);
    $cityurl = urlencode($city);
    $zipurl = urlencode($zip);
    
    // form request URL        
    $request_url = $base_url . "?address=" . $streeturl . ",+" . $cityurl . ",+AZ," . $zipurl . $params;
	
	echo $request_url;

    //echo $request_url . '<br />';
    $json = json_decode(file_get_contents($request_url));

    $status = $json->status;

	echo $json->status;

    if ($status=='OK') {
				
		
		$lat = $json->results[0]->geometry->location->lat;	
		$lon = $json->results[0]->geometry->location->lng;
		echo $lat;
		echo $lon;

		if ($lat==''||$lon=='') {
			$geom = 'NULL';
			$lat = 0;
			$lon = 0;
		}else{
			$geom = "ST_GeomFromText('POINT($lon $lat)' ,4326)";
		}

	      $nquery = sprintf("UPDATE azcase_locations " .
	             " SET lat = '%s', lon = '%s', the_geom = %s" .
	             " WHERE locationid = '%s';",
	             pg_escape_string($lat),
	             pg_escape_string($lon),
				 $geom,
	             pg_escape_string($locationid));
      
	      //print("$nquery<br />\n");
		
	      pg_query($nquery);
		  
      } else {}

	  // sleep after each geocode for 1 seconds
	  sleep(1);
		  

}


?>
