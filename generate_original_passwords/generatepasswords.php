<?php

include ('../phpconnect/phpconnect.php');

// assign a random password to each user - we'll eventually email everyone in the system and send them their password

function random_string( )
  {
    $character_set_array = array( );
    $character_set_array[ ] = array( 'count' => 7, 'characters' => 'abcdefghijklmnopqrstuvwxyz' );
    $character_set_array[ ] = array( 'count' => 1, 'characters' => '0123456789' );
    $temp_array = array( );
    foreach ( $character_set_array as $character_set )
    {
      for ( $i = 0; $i < $character_set[ 'count' ]; $i++ )
      {
        $temp_array[ ] = $character_set[ 'characters' ][ rand( 0, strlen( $character_set[ 'characters' ] ) - 1 ) ];
      }
    }
    shuffle( $temp_array );
    return implode( '', $temp_array );
  }

$emptypasswordquery = "SELECT userid FROM azcase_users WHERE password IS NULL;";
$result = pg_query($connection, $emptypasswordquery);
for ($lt = 0; $lt < pg_numrows($result); $lt++) {
	$userid = pg_result($result, $lt, 0);

	$password = random_string();
	echo $password . '<br />';
	$md5pass = md5($password);

	$updatequery = "UPDATE azcase_users SET password = '$md5pass' WHERE userid = $userid;";
	pg_query($connection, $updatequery);

}

?>
