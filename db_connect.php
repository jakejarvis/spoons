<?php
mysql_connect($db_host . ":" . $db_port, $db_user, $db_pass);
mysql_select_db($db_name);

mysql_query('SET time_zone = "America/New_York"');
?>