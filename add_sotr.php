<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$fam = $_POST['fam'];
$imya = $_POST['imya'];
$ot = $_POST['ot'];
$otdel = $_POST['otdel'];
$dol = $_POST['dol'];
$stmt = $db->prepare("INSERT INTO sotrudnik VALUES ('$id','$fam','$imya','$ot','$otdel','$dol')");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/kpp/tables/sotrudnik.php");