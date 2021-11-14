<?php
session_start();
if (!isset($_POST['id'])) {
    header("Location: index.php");
    die();
}
require dirname(__DIR__, 2)."/vendor/autoload.php";
require dirname (__DIR__, 2).  "/src/Categoria.php";
(new Categoria)->delete($_POST['id']);
$_SESSION['mensaje']="Categoría borrada con éxito";
header("Location:index.php");