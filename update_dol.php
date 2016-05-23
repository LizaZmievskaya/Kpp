<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$dol = $_POST['dol'];
$stmt = $db->prepare("UPDATE dolzhnost SET dolzhnost = '$dol' WHERE id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/dolzhnost.php");