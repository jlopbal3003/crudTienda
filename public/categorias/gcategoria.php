<?php
require dirname(__DIR__, 2)."/vendor/autoload.php";
require dirname (__DIR__, 2).  "/src/Categoria.php";
(new Categoria)->generarAleatorio();
header("Location:index.php");