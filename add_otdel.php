<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$otdel = $_POST['otdel'];
$stmt = $db->prepare("INSERT INTO otdel VALUES ('','$otdel')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/otdel.php");