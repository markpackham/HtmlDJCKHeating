<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Heating System Log</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<h1> Heating System Log </h1>

<?php
echo nl2br(file_get_contents('/home/pi/heating.log'));
?>

<p><a href="rj.php">Main Page</a></p>
</body>

</html>
