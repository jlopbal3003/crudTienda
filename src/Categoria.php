<?php
require "Conexion.php";
class Categoria extends Conexion {
    private $id;
    private $nombre;
    private $descripcion;
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
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    function create() {
        $insert = "insert into categorias(nombre, descripcion) values(:n, :d)";
        $stmt = $this->conexion->prepare($insert);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':d' => $this->descripcion
            ]);
        } catch (PDOException $ex) {
            die("Error al insertar la categoría: " . $ex->getMessage());
        }
    }

    function read() {
        $consulta = "select * from categorias where id=:i";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([':i' => $this->id]);
        } catch (PDOException $ex) {
            die("Error al recuperar la categoría: " . $ex->getMessage());
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function update() {
        $update = "update categorias set nombre=:n, descripcion=:d where id=:i";
        $stmt = $this->conexion->prepare($update);
        try {
            $stmt->execute([
                ':i' => $this->id,
                ':n' => $this->nombre,
                ':d' => $this->descripcion
            ]);
        } catch (PDOException $ex) {
            die("Error al actualizar el articulo: " . $ex->getMessage());
        }
    }

    function delete($id){
        $delete="delete from categorias where id=:i";
        $stmt = $this->conexion->prepare($delete);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar categoría: ".$ex->getMessage());
        }
    }

    public function readAll() {
        $q = "select * from categorias";
        $stmt = $this->conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al leer categorías: ".$ex->getMessage());
        }
        return $stmt;
    }

    public function devolverCategoria($id){
        $q="select * from categorias where id=:i";
        $stmt = $this->conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al devolver categoría: ".$ex->getMessage());
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function generarAleatorio(){
        $faker= Faker\Factory::create('es_ES');
        (new Categoria)->setNombre(ucfirst($faker->words(4, true)))
        ->setDescripcion($faker->text(200))
        ->create();
    }
}