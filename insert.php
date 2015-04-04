<?php
require_once ("inc/config.php");
require_once ("inc/mysql.php");

if (
    isset ($_GET['sensor']) && 
    strlen ($_GET['sensor']) > 0 &&
    isset ($_GET['data']) &&
    strlen ($_GET['data']) > 0

    )
{
    db_connect();
    $sensor = $_GET['sensor'];
    $data = $_GET['data'];
    insert_sensor_data ($sensor, $data);
    echo "OK";
} else {
    echo "ERR";
}
?>
