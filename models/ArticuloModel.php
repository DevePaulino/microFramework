<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class ArticuloModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $art_id;
    private $art_nombre;
    private $art_categoria;
    private $art_cantidad;
    

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getArt_id()
    {
        return $this->art_id;
    }
    public function setArt_id($art_id)
    {
        return $this->art_id = $art_id;
    }
    
    public function getArt_nombre()
    {
        return $this->art_nombre;
    }

     
    public function setArt_nombre($art_nombre)
    {
        $this->art_nombre = $art_nombre;

        return $this;
    }

    
    public function getArt_categoria()
    {
        return $this->art_categoria;
    }

   
    public function setArt_categoria($art_categoria)
    {
        $this->art_categoria = $art_categoria;

        return $this;
    }

    public function getArt_cantidad()
    {
        return $this->art_cantidad;
    }

    
    public function setArt_cantidad($art_cantidad)
    {
        $this->art_cantidad = $art_cantidad;

        return $this;
    }

    // Método para obtener todos los registros de la tabla articulo
    // Devuelve un array de objetos de la clase articuloModel
    public function getAll()
    {
        //realizamos la consulta de todos los articulo
        $consulta = $this->db->prepare('SELECT * FROM articulo');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "articuloModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto articuloModel con un código determinado
    public function getById($art_id)
    {
        $gsent = $this->db->prepare('SELECT * FROM articulo where art_id = ?');
        $gsent->bindParam(1, $art_id);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "articuloModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto articuloModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->art_id)) {
            $consulta = $this->db->prepare('INSERT INTO articulo ( art_nombre, art_categoria,art_cantidad ) values ( ?,?,?)');
            $consulta->bindParam(1, $this->getArt_nombre());
            $consulta->bindParam(2, $this->getArt_categoria());
            $consulta->bindParam(3, $this->getArt_cantidad());
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE articulo SET art_nombre = ?, art_categoria = ?, art_cantidad = ? WHERE art_id =  ? ');
            $consulta->bindParam(1, $this->getArt_nombre());
            $consulta->bindParam(2, $this->getArt_categoria());
            $consulta->bindParam(3, $this->getArt_cantidad());
            $consulta->bindParam(4, $this->getArt_id());
            $consulta->execute();
        }
    }

    // Método que elimina el articuloModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM articulo WHERE art_id =  ?');
        $consulta->bindParam(1, $this->getArt_id());
        $consulta->execute();
    }

}
?>