<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$dveri = $_POST['dveri'];
$stmt = $db->prepare("INSERT INTO dveri VALUES ('','$dveri')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/dveri.php");