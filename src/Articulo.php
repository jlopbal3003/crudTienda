<?php
require "Conexion.php";
class Articulo extends Conexion {
    private $id;
    private $nombre;
    private $precio;
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }
    
    function create() {
        $insert = "insert into articulos(nombre, precio) values(:n, :p)";
        $stmt = $this->conexion->prepare($insert);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':p' => $this->precio
            ]);
        } catch (PDOException $ex) {
            die("Error al insertar el artículo: " . $ex->getMessage());
        }
    }

    function read() {
        $consulta = "select * from articulos where id=:i";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([':i' => $this->id]);
        } catch (PDOException $ex) {
            die("Error al recuperar el articulo: " . $ex->getMessage());
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function update() {
        $update = "update articulos set nombre=:n, precio=:p where id=:i";
        $stmt = $this->conexion->prepare($update);
        try {
            $stmt->execute([
                ':i' => $this->id,
                ':n' => $this->nombre,
                ':p' => $this->precio
            ]);
        } catch (PDOException $ex) {
            die("Error al actualizar el articulo: " . $ex->getMessage());
        }
    }
    
    function delete($id){
        $delete="delete from articulos where id=:i";
        $stmt = $this->conexion->prepare($delete);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar artículo: ".$ex->getMessage());
        }
    }

    public function readAll() {
        $q = "select * from articulos";
        $stmt = $this->conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al leer articulos: ".$ex->getMessage());
        }
        return $stmt;
    }

    public function devolverArticulo($id){
        $q="select * from articulos where id=:i";
        $stmt = $this->conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al devolver artículo: ".$ex->getMessage());
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function generarAleatorio(){
        $faker= Faker\Factory::create('es_ES');
        (new Articulo)->setNombre(ucfirst($faker->words(4, true)))
        ->setPrecio($faker->randomNumber(3))
        ->create();
    }
}