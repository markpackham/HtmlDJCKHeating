<?php
header('Refresh: 2; URL=rj.php');
$DOCUMENT_ROOT = "/home/pi/www/html/RJ/arduino";
$date = date('H:i, jS F Y');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Central Heating Setting</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>

<div>
    <h1>Central Heating Setting</h1>
</div>

<?php
echo "<p>Changed central heating status on " . $date . " to ";
$outputstring = $_POST[CH1H] . $_POST['ON'] . $_POST['OFF'] . $_POST['TIMED'] . "\n";
echo "$outputstring\n.";

if (substr($outputstring, 0, 2) == "ON") {
    exec('/home/pi/bin/arduinocmd/chon');
    exec('/home/pi/bin/arduinocmd/chboostreset');
    echo "Central heating switched on.";
} elseif (substr($outputstring, 0, 3) == "OFF") {
    exec('/home/pi/bin/arduinocmd/choff');
    exec('/home/pi/bin/arduinocmd/chboostreset');
    echo "Central heating switched off.";
} elseif (substr($outputstring, 0, 5) == "TIMED") {
    exec('/home/pi/bin/arduinocmd/cht');
    exec('/home/pi/bin/arduinocmd/chboostreset');
    echo "Central heating switched to timed.";
} elseif (substr($outputstring, 0, 4) == "CH1H") {
    exec('/home/pi/bin/arduinocmd/ch1h > /dev/null &');
    echo "Central Heating Boost Function 1 Hour";
} else {
    echo "oops!";
}

?>

<p><a href="rj.php">OK</a></p>

</body>


