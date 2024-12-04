<?php
session_start();

session_destroy(); 
setcookie('felhasznalonev', '', time() - 3600);

header('Location: login.php');
exit();