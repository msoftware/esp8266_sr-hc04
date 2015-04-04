<?php
require_once ("inc/config.php");
require_once ("inc/mysql.php");

db_connect();
delete_sensor_data ();
echo "OK";
?>
