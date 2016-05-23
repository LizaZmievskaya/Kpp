<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$dveri = $_POST['dveri'];
$sotr = $_POST['sotr'];
$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
$stmt = $db->prepare("INSERT INTO otkritie VALUES ('','$dveri','$sotr','$d1','$d2')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/otkritie.php");