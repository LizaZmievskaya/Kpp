<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$dol = $_POST['dol'];
$stmt = $db->prepare("INSERT INTO dolzhnost VALUES ('','$dol')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/dolzhnost.php");