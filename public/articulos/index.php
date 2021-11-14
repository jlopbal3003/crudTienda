<?php
session_start();
require dirname (__DIR__, 2).  "/src/Articulo.php";
require dirname (__DIR__, 2)."/vendor/autoload.php";
$articulos=(new Articulo)->readAll();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Tienda</title>
    </head>
    <body style="background-color:#FFE87C">
        <h3 class="text-center">Artículos</h3>
        <div class="container mt-2">
            <?php
            if(isset($_SESSION['mensaje'])){
                echo <<<TXT
                <div class="alert alert-primary" role="alert">
                {$_SESSION['mensaje']}
                </div>
                TXT;
                unset($_SESSION['mensaje']);
            }
            ?>
            <a href="../index.php" class="btn btn-success my-2">&nbsp;<i class="fas fa-arrow-circle-left"></i>&nbsp;</a>
            <a href="carticulo.php" class="btn btn-info my-2"><i class="fas fa-plus"></i> Nuevo artículo</a>
            <a href="garticulo.php" class="btn btn-secondary my-2"><i class="fas fa-question"></i> Generar aleatorio</a>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($fila=$articulos->fetch(PDO::FETCH_OBJ)){
                echo <<< TXT
                <tr>
                    <th scope="row">{$fila->id}</th>
                    <td>{$fila->nombre}</td>
                    <td>{$fila->precio}</td>
                    <td>{$fila->categoria_id}</td>
                    <td style="text-align: right;">
                        <form name='s' action='barticulo.php' method='POST'>
                            <input type='hidden' name='id' value='{$fila->id}'>
                            <a href="uarticulo.php?id={$fila->id}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea borrar el artículo?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                TXT;
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>