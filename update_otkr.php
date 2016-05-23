<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$dveri = $_POST['dveri'];
$sotr = $_POST['sotr'];
$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
$stmt = $db->prepare("UPDATE otkritie SET id_dveri = '$dveri', id_karti = '$sotr', data_vhod = '$d1', data_vihod = '$d2' WHERE id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/otkritie.php");