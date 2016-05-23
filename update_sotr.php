<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$fam = $_POST['fam'];
$imya = $_POST['imya'];
$ot = $_POST['ot'];
$otdel = $_POST['otdel'];
$dol = $_POST['dol'];
$stmt = $db->prepare("UPDATE sotrudnik SET familia = '$fam', imya = '$imya', otchestvo = '$ot', id_otdela = '$otdel',
 id_dolzhnosti = '$dol' WHERE id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/sotrudnik.php");