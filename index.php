<?php
if (isset($_POST['registration'])){
    header("Location: tables/registration.php");
} elseif (isset($_POST['clienty'])){
    header("Location: tables/dveri.php");
} elseif (isset($_POST['nomera'])){
    header("Location: tables/otdel.php");
} elseif (isset($_POST['class'])){
    header("Location: tables/dolzhnost.php");
} elseif (isset($_POST['sotrudniki'])){
    header("Location: tables/sotrudnik.php");
} elseif (isset($_POST['dolzhnost'])){
    header("Location: tables/dolzhnost.php");
} elseif (isset($_POST['svobodnie'])){
    header("Location: tables/svobodnie.php");
} elseif (isset($_POST['popular'])){
    header("Location: tables/otkritie.php");
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Shortcuts</a></li>
                <li><a href="#">Overview</a></li>
                <li><a href="#">Events</a></li>
            </ul>
        </div>
        <!-- Page Content -->
        <div id="page-content-wrapper">
        </div>
    </div>
    <!--<form method="post">
        <div class="list">
            <button name="registration" type="submit" class="btn btn-default">Регистрация</button>
            <button name="clienty" type="submit" class="btn btn-default">Клиенты</button>
            <button name="nomera" type="submit" class="btn btn-default">Номера</button>
            <button name="class" type="submit" class="btn btn-default">Классы номеров</button>
            <button name="sotrudniki" type="submit" class="btn btn-default">Сотрудники</button>
            <button name="dolzhnost" type="submit" class="btn btn-default">Должности</button>
            <button name="svobodnie" type="submit"  class="btn btn-default" style="margin-top: 50px;">Свободные номера</button>
            <button name="popular" type="submit" class="btn btn-default">Популярные номера месяца</button>
        </div>
    </form>-->

    
</div>
</body>
</html>