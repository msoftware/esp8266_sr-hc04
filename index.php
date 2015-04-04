<html>
<head>
<meta http-equiv="refresh" content="5; URL=http://test.1br.de/sr-hc04/">
</head>
<body>
<?php
require_once ("inc/config.php");
require_once ("inc/mysql.php");

db_connect();
$sensor = "HC_SR04_001";
$data = get_sensor_data ($sensor);

if ($data != false)
{
    echo "<table border='1'>";
    echo "<tr><td>Distance:</td><td>Time:</td><td>Zustand:</td></tr>";
    foreach ($data as $item)
    {
	if ($item['data'] < 4) 
        {
            $result = "geschlossen";
        } else {
            $result = "offen";
        }
        echo "<tr><td>" . $item['data'];
        echo "</td><td>" . date("H:i:s d.m.Y", $item['time']);
        echo "</td><td>" . $result;
	echo "</td></tr>";
    }
    echo "</table>";
}
echo "<a href='delete.php'>Delete</a>";
?>
