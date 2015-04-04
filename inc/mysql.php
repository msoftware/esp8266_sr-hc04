<?php

function db_connect()
{
    $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$link) die('Verbindung nicht möglich : ' . mysql_error());

    $db_selected = mysql_select_db(DB_NAME, $link);
    if (!$db_selected) die ('Kann foo nicht benutzen : ' . mysql_error());
}

function select_data ($sql)
{
    $ret = array ();
    $result = mysql_query($sql);

    if (!$result) die ("SQL Error ($sql): " . mysql_error());

    if (mysql_num_rows($result) == 0) 
    return false;

    while ($row = mysql_fetch_assoc($result)) {
        $ret[] = $row;
    }

    mysql_free_result($result);
    return $ret;
}

function execute_sql ($sql)
{
    $result = mysql_query($sql);;
    if (!$result) die ("SQL Error ($sql): " . mysql_error());
    return $result;
}

function get_sensor_data ($sensor)
{
    $sensor = mysql_escape_string ($sensor);
    $sql = "SELECT * FROM `daten` WHERE sensor = '$sensor' ORDER BY time DESC";
    return select_data ($sql);
}

function delete_sensor_data ()
{
    $sql = "DELETE FROM `daten`;";
    execute_sql ($sql);
}

function insert_sensor_data ($sensor, $data)
{
    $time = time ();
    $sensor = mysql_escape_string ($sensor);
    $data = mysql_escape_string ($data);
    $sql = "INSERT INTO `daten` (`sensor`, `data`, `time`) VALUES ('$sensor', '$data', '$time');";
    execute_sql ($sql);
}

?>
