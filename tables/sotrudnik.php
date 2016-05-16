<?php
namespace lib;
include "../db.php";
class Sotrudnik extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `sotrudnik`
LEFT JOIN `dolzhnost` ON sotrudnik.id_dolzhnosti=dolzhnost.id
LEFT JOIN `otdel` ON sotrudnik.id_otdela=otdel.id
ORDER BY sotrudnik.id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Sotrudnik();
$rows = $out->fetchAll();

?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
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
            <li><a href="dostup.php">Доступ</a></li>
        </ul>
    </div>
    <!-- Page Content -->
    <div id="page-content-wrapper" class="container">
        <form method="post">
            <table class="title table table-striped" style="text-align: center;">
                <tr>
                    <td width="80">№</td>
                    <td width="330">ФИО сотрудника</td>
                    <td width="160">Отдел</td>
                    <td width="200">Должность</td>
                    <td width="260"></td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="table"  style="text-align: center;">
                    <?php for ($i = 0; $i < count($rows); $i++) {?>
                        <tr>
                            <td width="80"><?= $rows[$i]['id']?></td>
                            <td width="110"><?= $rows[$i]['familia']?></td>
                            <td width="110"><?= $rows[$i]['imya']?></td>
                            <td width="110"><?= $rows[$i]['otchestvo']?></td>
                            <td width="160"><?= $rows[$i]['otdel']?></td>
                            <td width="200"><?= $rows[$i]['dolzhnost']?></td>
                            <td width="260"><button type="button" class="btn btn-default">Изменить</button>
                                <button type="button" class="btn btn-default">Удалить</button></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>