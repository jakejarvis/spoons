<?php
require('vendor/autoload.php');

include_once('config.php');        // these have probably all been included already, but just in case...
include_once('functions.php');
include_once('db_connect.php');

if(!$initialized) {
  session_start();
  if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
    header("Location:" . $site_url . "/login");
    die();
  }

  $initialized = TRUE;
}
?>