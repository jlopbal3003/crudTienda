<?php
require dirname(__DIR__, 2)."/vendor/autoload.php";
require dirname (__DIR__, 2).  "/src/Articulo.php";
(new Articulo)->generarAleatorio();
header("Location:index.php");