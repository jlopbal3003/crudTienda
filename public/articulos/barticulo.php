<?php
session_start();
if (!isset($_POST['id'])) {
    header("Location: index.php");
    die();
}
require dirname(__DIR__, 2)."/vendor/autoload.php";
require dirname (__DIR__, 2).  "/src/Articulo.php";
(new Articulo)->delete($_POST['id']);
$_SESSION['mensaje']="Artículo borrado con éxito";
header("Location:index.php");