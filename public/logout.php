<?php
include('config.php');
session_start();
setcookie('remembered', 'FALSE', 1);
session_destroy();
header("Location:" . $site_url . "/login");
?>