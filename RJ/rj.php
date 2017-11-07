<?php
$DOCUMENT_ROOT = "/home/pi/www/html/RJ/arduino";
$ARDUINO_OUT = "/home/pi/ardip";
$date = date('H:i, jS F Y');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Heating System Remote Interface</title>
    <link rel="stylesheet" href="styles.css"/>

</head>
<body>
<h1>Heating System Remote Interface (Arduino UNO R3)</h1>

<?php
echo "<p>As at " . $date . "</p> ";
exec('/home/pi/bin/awknew', $result);
foreach ($result as $line)
    echo "$line\n";


// READ BOOST STATE


@ $fp = fopen("$ARDUINO_OUT/booststate", 'r');
if (!$fp) {
    echo "<p>Error opening BSTATE file.</p>";
    exit;
}
$boost = fgets($fp, 999);
fclose($fp);
echo "<p><b> " . $boost . "</b></p>";

@ $fp = fopen("$ARDUINO_OUT/chbooststate", 'r');
if (!$fp) {
    echo "<p>Error opening CHBSTATE file.</p>";
    exit;
}
$chboost = fgets($fp, 999);
fclose($fp);
echo "<p><b> " . $chboost . "</b></p>"

?>
<h2>Hot Water</h2>


<form>
    <table>
        <tr>
            <?php
            // READ HOT WATER STATUS FROM FILE
            @ $fp = fopen("$ARDUINO_OUT/hwstate", 'r');
            if (!$fp) {
                echo "<p>Error opening file.</p>";
                exit;
            }
            $hws = fgets($fp, 999);
            fclose($fp);
            echo "<td><b>Current status: " . $hws . "</b></td>";
            ?>
        </tr>
    </table>
</form>

<form action="rj1.php" method="post">
    <table>
        <tr>
            <td><input type="submit" value="ON" name="ON"></td>
            <td><input type="submit" value="OFF" name="OFF"></td>
            <td><input type="submit" value="TIMED" name="TIMED"></td>
            <td><input type="submit" value="HW1H" name="HW1H"></td>
        </tr>
    </table>

</form>

<h2>Central Heating</h2>

<form>
    <table>
        <tr>
            <?php
            // READ CENTRAL HEATING STATUS FROM FILE
            @ $fp = fopen("$ARDUINO_OUT/chstate", 'r');
            if (!$fp) {
                echo "<p>Error opening file.</p>";
                exit;
            }
            $chs = fgets($fp, 999);
            fclose($fp);
            echo "<td><b>Current status: " . $chs . "</b></td>";
            ?>
        </tr>
    </table>
</form>

<form action="rj2.php" method="post">
    <table>
        <tr>
            <td><input type="submit" value="ON" name="ON"></td>
            <td><input type="submit" value="OFF" name="OFF"></td>
            <td><input type="submit" value="TIMED" name="TIMED"></td>
            <td><input type="submit" value="CH1H" name="CH1H"></td>
        </tr>
    </table>

</form>


<h2>Diagnostics</h2>

<?php
// READ SUPPLY VOLTAGE AND OUTFLOW TEMPERATURE FROM FILES
@ $fp = fopen("$ARDUINO_OUT/supply.voltage", 'r');
if (!$fp) {
    echo "<p>Error opening file.</p>";
    exit;
}
$supply = fgets($fp, 999);
fclose($fp);
echo "<p><b>Supply voltage: " . $supply . "</b></p>";

@ $fp = fopen("$ARDUINO_OUT/temperature", 'r');
if (!$fp) {
    echo "<p>Error opening file.</p>";
    exit;
}
$flowtemp = fgets($fp, 999);
fclose($fp);
echo "<p><b>HW Cyl outflow temperature: " . $flowtemp . "</b></p>";


?>
<p><a href="log.php">Log File</a></p>

</body>
</html>
