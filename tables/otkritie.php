<?php
namespace lib;
include "../db.php";
class Otkritie extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT otkritie.id, dveri, familia, imya, data_vhod, data_vihod
FROM `otkritie` LEFT JOIN `dveri` ON otkritie.id_dveri=dveri.id
LEFT JOIN `sotrudnik` ON otkritie.id_karti=sotrudnik.id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchDveri(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM dveri ORDER BY dveri");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchSotr(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM sotrudnik");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Otkritie();
$rows = $out->fetchAll();
$dveri = $out->fetchDveri();
$sotr = $out->fetchSotr();

?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>
<body>
<div>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li id="current"><a href="otkritie.php">Открытие дверей</a></li>
                <li><a href="sotrudnik.php">Сотрудники</a></li>
                <li><a href="dolzhnost.php">Должности</a></li>
                <li><a href="otdel.php">Отделы</a></li>
                <li><a href="dveri.php">Двери</a></li>
                <li><a href="today.php">Открытие за сегодня</a></li>
            </ul>
        </div>
        <!-- Page Content -->
        <div id="page-content-wrapper" class="container">
            <form method="post">
                <table class="title table table-striped" style="text-align: center;">
                    <tr>
                        <td width="50">№</td>
                        <td width="150">Дверь</td>
                        <td width="250">Сотрудник</td>
                        <td width="200">Дата/время входа</td>
                        <td width="200">Дата/время выхода</td>
                        <td width="260"><button id="add-btn" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button></td>
                    </tr>
                </table>
                <div class="table-responsive">
                    <table class="table"  style="text-align: center;">
                        <?php for ($i = 0; $i < count($rows); $i++) {?>
                            <tr data-id="<?= $rows[$i]['id']?>" data-dveri="<?= $rows[$i]['dveri']?>"
                                data-fam="<?= $rows[$i]['familia']?>" data-imya="<?= $rows[$i]['imya']?>"
                                data-d1="<?= $rows[$i]['data_vhod']?>" data-d2="<?= $rows[$i]['data_vihod']?>">
                                <td width="50"><?= $rows[$i]['id']?></td>
                                <td width="150"><?= $rows[$i]['dveri']?></td>
                                <td width="125"><?= $rows[$i]['familia']?></td>
                                <td width="125"><?= $rows[$i]['imya']?></td>
                                <td width="200"><?= date('d.m.Y h:m:s', strtotime($rows[$i]['data_vhod']))?></td>
                                <td width="200"><?= date('d.m.Y h:m:s', strtotime($rows[$i]['data_vihod']))?></td>
                                <td width="260"><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
                                    <input name="delete" type="button" class="btn btn-default" value="Удалить"></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ADD MODAL-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Добавление новой записи</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <label>Дверь</label>
                        <select name="dveri" class="form-control" required>
                            <?php for ($i = 0; $i < count($dveri); $i++) {?>
                                <option value="<?= $dveri[$i]['id']?>"><?= $dveri[$i]['dveri']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Сотрудник</label>
                        <select name="sotr" class="form-control" required>
                            <?php for ($i = 0; $i < count($sotr); $i++) {?>
                                <option value="<?= $sotr[$i]['id']?>"><?= $sotr[$i]['familia']?> <?= $sotr[$i]['imya']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Дата/время входа</label>
                        <input name="d1" type="datetime-local" class="form-control" required id="inputD1">
                    </div>
                    <div class="form-horizontal m">
                        <label>Дата/время выхода</label>
                        <input name="d2" type="datetime-local" class="form-control" required id="inputD2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button name="add" type="submit" class="btn btn-default">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--EDIT MODAL-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Редактирование записи</h4>
            </div>
            <form method="post" action="../update_otkr.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <label>Дверь</label>
                        <select name="dveri" class="form-control" required>
                            <?php for ($i = 0; $i < count($dveri); $i++) {?>
                                <option value="<?= $dveri[$i]['id']?>"><?= $dveri[$i]['dveri']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Сотрудник</label>
                        <select name="sotr" class="form-control" required>
                            <?php for ($i = 0; $i < count($sotr); $i++) {?>
                                <option value="<?= $sotr[$i]['id']?>"><?= $sotr[$i]['familia']?> <?= $sotr[$i]['imya']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Дата/время входа</label>
                        <input name="d1" type="datetime-local" class="form-control" required id="inputD1">
                    </div>
                    <div class="form-horizontal m">
                        <label>Дата/время выхода</label>
                        <input name="d2" type="datetime-local" class="form-control" required id="inputD2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button name="save" type="submit" class="btn btn-default">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/actions_otkr.js"></script>
</body>
</html>