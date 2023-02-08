<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class CategoriaModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $cat_id;
    private $cat_nombre;
    

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getCat_id()
    {
        return $this->cat_id;
    }
    public function setCat_id($cat_id)
    {
        return $this->cat_id = $cat_id;
    }
    
    public function getCat_nombre()
    {
        return $this->cat_nombre;
    }

    public function setCat_nombre($cat_nombre)
    {
        $this->cat_nombre = $cat_nombre;

        return $this;
    }


    // Método para obtener todos los registros de la tabla categoria
    // Devuelve un array de objetos de la clase categoriaModel
    public function getAll()
    {
        //realizamos la consulta de todos los categoria
        $consulta = $this->db->prepare('SELECT * FROM categoria');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "categoriaModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto categoriaModel con un código determinado
    public function getById($cat_id)
    {
        $gsent = $this->db->prepare('SELECT * FROM categoria where cat_id = ?');
        $gsent->bindParam(1, $cat_id);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "categoriaModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }
    
    // Método que almacena en BD un objeto categoriaModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->cat_id)) {
            $consulta = $this->db->prepare('INSERT INTO categoria ( cat_nombre ) values ( ? )');
            $consulta->bindParam(1, $this->cat_nombre);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE categoria SET cat_nombre = ? WHERE cat_id =  ? ');
            $consulta->bindParam(1, $this->cat_nombre);
            $consulta->bindParam(2, $this->cat_id);
            $consulta->execute();
        }
    }

    // Método que elimina el categoriaModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM categoria WHERE cat_id =  ?');
        $consulta->bindParam(1, $this->getCat_id());
        $consulta->execute();
    }

    //metodo para bloquear el link en caso de que haya un articulo usandose en la categoria
    public function blockLink($categoria){
        $query=$this->db->prepare('SELECT * FROM articulo WHERE art_categoria= ?');
        $cat = $this->getCat_id();
        $query->bindParam(1, $cat);
        $query->execute();
        if($query->rowCount() > 0)
        //bloqueamos el enlace
        {
            echo"href=#";
        }
        //añadirmos el controlador de categoria con la funcion de borrar
        else{
            echo"href=\"index.php?controlador=Categoria&accion=borrar&cat_id=".$categoria->getCat_id()."\"";
        }

    }

}
?>