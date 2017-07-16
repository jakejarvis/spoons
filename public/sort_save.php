<?php
include('config.php');
include('db_connect.php');

$order_array = explode(",", $_POST['order']);
foreach($order_array as $key => $value) {
  echo $value . ' > ' . $key . "\n";
  mysqli_query($conn, "UPDATE spooners SET order_num = " . $key . " WHERE id = " . $value) or die(mysqli_error($conn));
}
?>