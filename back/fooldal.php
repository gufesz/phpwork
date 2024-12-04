<?php
session_start(); 

if (!isset($_SESSION['felhasznalonev']) && !isset($_COOKIE['felhasznalonev'])) {
    header("Location: login.php"); 
    exit();
}

$felhasznalonev = $_SESSION['felhasznalonev'] ?? $_COOKIE['felhasznalonev'];

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h2>gufewi</h2>
    <a href="kijel.php">kijelentkezes</a>
</body>
</html>


