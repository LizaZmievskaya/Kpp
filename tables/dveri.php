<?php
namespace lib;
include "../db.php";
class Dveri extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `dveri` ORDER BY id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Dveri();
$rows = $out->fetchAll();

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
            <li><a href="sotrudnik.php">Сотрудники</a></li>
            <li><a href="dolzhnost.php">Должности</a></li>
            <li><a href="otdel.php">Отделы</a></li>
            <li id="current"><a href="dveri.php">Двери</a></li>
            <li><a href="dostup.php">Доступ</a></li>
        </ul>
    </div>
    <!-- Page Content -->
    <div id="page-content-wrapper" class="container">
        <form method="post">
            <table class="title table table-striped" style="text-align: center;">
                <tr>
                    <td width="50">№</td>
                    <td width="700">Дверь</td>
                    <td width="260"></td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="table"  style="text-align: center;">
                    <?php for ($i = 0; $i < count($rows); $i++) {?>
                        <tr>
                            <td width="50"><?= $rows[$i]['id']?></td>
                            <td width="700"><?= $rows[$i]['dveri']?></td>
                            <td width="260"><button type="button" class="btn btn-default">Изменить</button>
                                <button type="button" class="btn btn-default">Удалить</button></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </form>
    </div>
</div>
<script src="../js/actions_readers.js"></script>
</body>
</html>