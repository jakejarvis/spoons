<?php
  // Create connection
  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  mysqli_query($conn, 'SET time_zone = "' . $timezone_name . '"');
?>
