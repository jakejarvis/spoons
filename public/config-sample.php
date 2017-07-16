<?php
  /* site config */
  $site_url = "https://idspoons.herokuapp.com";
  $site_password = "asdf1234";
  
  if(isset(getenv('JAWSDB_URL'))) {
    $db_parts = parse_url(getenv('JAWSDB_URL'));

    $db_host = $db_parts['host'];
    $db_user = $db_parts['user'];
    $db_pass = $db_parts['pass'];
    $db_name = ltrim($db_parts['path'],'/');
    $db_port = 3306;
  } else {
    $db_host = "localhost";
    $db_port = 8889;
    $db_user = "root";
    $db_pass = "lol";
    $db_name = "spoons";
  }
  
  $timezone_number = "-4:00";
  $timezone_name = "America/New_York";
  
  date_default_timezone_set($timezone_name);
?>
