<?php
include('config.php');
session_start();
session_destroy();
header("Location:" . $site_url . "/login");
?>