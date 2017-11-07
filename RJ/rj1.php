<?php
header('Refresh: 2; URL=rj.php');
$DOCUMENT_ROOT = "/home/pi/www/html/RJ/arduino";
$date = date('H:i, jS F Y');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hot Water Setting</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>

<div>
    <h1>Hot Water Setting</h1>
</div>

<?php
echo "<p>Changed hot water status on " . $date . " to ";
$outputstring = $_POST[HW1H] . $_POST['ON'] . $_POST['OFF'] . $_POST['TIMED'] . "\n";
echo "$outputstring\n.";

if (substr($outputstring, 0, 2) == "ON") {
    exec('/home/pi/bin/arduinocmd/hwon');
    echo "Hot water switched on.";
    exec('/home/pi/bin/arduinocmd/hwboostreset');
} elseif (substr($outputstring, 0, 3) == "OFF") {
    exec('/home/pi/bin/arduinocmd/hwoff');
    exec('/home/pi/bin/arduinocmd/hwboostreset');
    echo "Hot water switched off.";
} elseif (substr($outputstring, 0, 5) == "TIMED") {
    exec('/home/pi/bin/arduinocmd/hwt');
    exec('/home/pi/bin/arduinocmd/hwboostreset');
    echo "Hot water switched to timed.";
} elseif (substr($outputstring, 0, 4) == "HW1H") {
    exec('/home/pi/bin/arduinocmd/hw1h > /dev/null &');
    echo "Hot Water Boost Function 1 hour";
} else {
    echo "oops!";

}

?>

<p><a href="rj.php">OK</a></p>
</body>
