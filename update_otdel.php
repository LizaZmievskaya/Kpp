<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$otdel = $_POST['otdel'];
$stmt = $db->prepare("UPDATE otdel SET otdel = '$otdel' WHERE id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/otdel.php");