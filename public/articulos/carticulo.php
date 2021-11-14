<?php
session_start();
require dirname(__DIR__, 2)."/vendor/autoload.php";
require dirname (__DIR__, 2).  "/src/Articulo.php";

if(isset($_POST['btnCrear'])){
    $nombre=trim(ucwords($_POST['nombre']));
    $precio=trim($_POST['precio']);
    (new Articulo)->setNombre($nombre)
    ->setPrecio($precio)
    ->create();
    $_SESSION['mensaje']="Artículo creado.";
    header("Location:index.php");
}
else{
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
        <h3 class="text-center">Nuevo artículo</h3>
        <div class="container mt-2">
            <div class="bg-primary p-4 text-white rounded shadow-lg mx-auto" style="width:40rem">
                <form name="carticulo" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="mb-3">
                        <a href="index.php" class="btn btn-success my-2">&nbsp;<i class="fas fa-arrow-circle-left"></i>&nbsp;</a>
                    </div>
                    <div class="mb-3">
                        <label for="n" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="n" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="p" class="form-label">Precio:</label>
                        <input type="text" class="form-control" id="p" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="c" class="form-label">Categoría:</label>
                        <input type="text" class="form-control" id="c" name="categoria" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="btnCrear" class="btn btn-info"><i class="fas fa-save"></i> Crear</button>
                        <button type="reset" name="btnLimpiar" class="btn btn-warning"><i class="fas fa-broom"></i> Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php } ?>