<?php
$db = new PDO('mysql:host=localhost; dbname=kpp', 'root', '');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$table = $_POST['table'];
$ident = $_POST['ident'];
$stmt = $db->prepare("DELETE FROM $table WHERE $ident = '$id'");
$stmt->execute();
echo json_encode(['status'=>'success']);