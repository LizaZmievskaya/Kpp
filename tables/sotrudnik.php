<?php
namespace lib;
include "../db.php";
class Sotrudnik extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT sotrudnik.id, sotrudnik.familia, sotrudnik.imya, sotrudnik.otchestvo,
dolzhnost, otdel FROM `sotrudnik`
LEFT JOIN `dolzhnost` ON sotrudnik.id_dolzhnosti=dolzhnost.id
LEFT JOIN `otdel` ON sotrudnik.id_otdela=otdel.id
ORDER BY sotrudnik.id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchDol(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `dolzhnost` ORDER BY id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchOtdel(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `otdel` ORDER BY id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Sotrudnik();
$rows = $out->fetchAll();
$dol = $out->fetchDol();
$otdel = $out->fetchOtdel();

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
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li><a href="otkritie.php">Открытие дверей</a></li>
            <li id="current"><a href="sotrudnik.php">Сотрудники</a></li>
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
                    <td width="100">№</td>
                    <td width="330">ФИО сотрудника</td>
                    <td width="160">Отдел</td>
                    <td width="200">Должность</td>
                    <td width="260"><button id="add-btn" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button></td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="table"  style="text-align: center;">
                    <?php for ($i = 0; $i < count($rows); $i++) {?>
                        <tr data-id="<?= $rows[$i]['id']?>" data-fam="<?= $rows[$i]['familia']?>"
                            data-imya="<?= $rows[$i]['imya']?>" data-ot="<?= $rows[$i]['otchestvo']?>"
                            data-otdel="<?= $rows[$i]['otdel']?>" data-dol="<?= $rows[$i]['dolzhnost']?>">
                            <td width="100"><?= $rows[$i]['id']?></td>
                            <td width="110"><?= $rows[$i]['familia']?></td>
                            <td width="110"><?= $rows[$i]['imya']?></td>
                            <td width="110"><?= $rows[$i]['otchestvo']?></td>
                            <td width="160"><?= $rows[$i]['otdel']?></td>
                            <td width="200"><?= $rows[$i]['dolzhnost']?></td>
                            <td width="260"><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
                                <input name="delete" type="button" class="btn btn-default" value="Удалить"></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </form>
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
                        <input name="id" type="text" class="form-control" id="inputID" required placeholder="ID">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fam" type="text" class="form-control" id="inputFam" required placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="imya" type="text" class="form-control" id="inputImya" required placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="ot" type="text" class="form-control" id="inputOt" required placeholder="Отчество">
                    </div>
                    <div class="form-horizontal m">
                        <label>Отдел</label>
                        <select name="otdel" class="form-control" required>
                            <?php for ($i = 0; $i < count($otdel); $i++) {?>
                                <option value="<?= $otdel[$i]['id']?>"><?= $otdel[$i]['otdel']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Должность</label>
                        <select name="dol" class="form-control" required>
                            <?php for ($i = 0; $i < count($dol); $i++) {?>
                                <option value="<?= $dol[$i]['id']?>"><?= $dol[$i]['dolzhnost']?></option>
                            <?php } ?>
                        </select>
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
            <form method="post" action="../update_sotr.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="id" type="text" class="form-control" id="inputID" readonly>
                    </div>
                    <div class="form-horizontal m">
                        <input name="fam" type="text" class="form-control" id="inputFam" required placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="imya" type="text" class="form-control" id="inputImya" required placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="ot" type="text" class="form-control" id="inputOt" required placeholder="Отчество">
                    </div>
                    <div class="form-horizontal m">
                        <label>Отдел</label>
                        <select name="otdel" class="form-control" required>
                            <?php for ($i = 0; $i < count($otdel); $i++) {?>
                                <option value="<?= $otdel[$i]['id']?>"><?= $otdel[$i]['otdel']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Должность</label>
                        <select name="dol" class="form-control" required>
                            <?php for ($i = 0; $i < count($dol); $i++) {?>
                                <option value="<?= $dol[$i]['id']?>"><?= $dol[$i]['dolzhnost']?></option>
                            <?php } ?>
                        </select>
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
<script src="../js/actions_sotr.js"></script>
</body>
</html>