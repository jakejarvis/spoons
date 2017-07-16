<?php
  /* site config */
  $site_url = getenv('SITE_URL');     // ex: https://idspoons.herokuapp.com   (no trailing slash)
  $site_password = getenv('SITE_PASSWORD');
  
  /* database config */
  if(getenv('JAWSDB_URL') !== null) {
    $db_parts = parse_url(getenv('JAWSDB_URL'));

    $db_host = $db_parts['host'];
    $db_user = $db_parts['user'];
    $db_pass = $db_parts['pass'];
    $db_name = ltrim($db_parts['path'],'/');
    $db_port = 3306;
  } else {
    $db_host = "localhost";
    $db_port = 8889;
    $db_user = "lol";
    $db_pass = "yourpassword";
    $db_name = "spoons";
  }
  
  $timezone_number = "-4:00";
  $timezone_name = "America/New_York";
  
  date_default_timezone_set($timezone_name);
?>
