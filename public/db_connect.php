<?php
//mysql_connect($db_host . ":" . $db_port, $db_user, $db_pass);
//mysql_select_db($db_name);

//mysql_query('SET time_zone = "' . $timezone_number . '"');


// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
