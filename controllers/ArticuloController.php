<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class ArticuloController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los articulos almacenadas
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/articuloModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new ArticuloModel();

        //Le pedimos al modelo todos los items
        $listado = $items->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['items'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarArticuloView.php", $data);
    }

    public function index()
    {
        //Incluye el modelo que corresponde
        require_once 'models/articuloModel.php';

        //Creamos una instancia de nuestro "modelo"
        $items = new ArticuloModel();

        //Le pedimos al modelo todos los items
        $listado = $items->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['items'] = $listado;

        //Finalmente presentamos nuestra plantilla
        $this->view->show("listarArticuloView.php", $data);
    }

    // Método del controlador para crear un nuevo item
    public function nuevo()
    {
        require 'models/articuloModel.php';
        $item = new ArticuloModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['art_nombre']) || empty($_REQUEST['art_nombre']) || !isset($_REQUEST['art_cantidad']) || empty($_REQUEST['art_cantidad']) ||  !is_numeric($_REQUEST['art_cantidad']))
                $errores['articulo'] = "* Articulo: Error";
            if (empty($errores)) {
                $item->setArt_nombre($_REQUEST['art_nombre']);
                $item->setArt_categoria($_REQUEST['art_categoria']);
                $item->setArt_cantidad($_REQUEST['art_cantidad']);
                $item->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=Articulo&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("nuevoArticuloView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar()
    {

        require 'models/articuloModel.php';
        $items = new ArticuloModel();

        // Recuperar el item con el código recibido
        $item = $items->getById($_REQUEST['art_id']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            if (!isset($_REQUEST['art_nombre']) || empty($_REQUEST['art_nombre']) || !isset($_REQUEST['art_cantidad']) || empty($_REQUEST['art_cantidad']) ||  !is_numeric($_REQUEST['art_cantidad']))
                $errores['articulo'] = "* articulo: Error";

            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $item->setArt_nombre($_REQUEST['art_nombre']);
                $item->setArt_categoria($_REQUEST['art_categoria']);
                $item->setArt_cantidad($_REQUEST['art_cantidad']);
                $item->save();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php?controlador=Articulo&accion=listar");
            }
        }
        if (isset($_REQUEST['cancelar'])) {
            header("Location: index.php");
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("editarArticuloView.php", array('item' => $item, 'errores' => $errores));



    }

    
    public function borrar()
    {

        require 'models/articuloModel.php';
        $items = new ArticuloModel();

        // Recuperar el item con el código recibido
        $item = $items->getById($_REQUEST['art_id']);

        if ($item == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            if (!isset($_REQUEST['art_nombre']) || empty($_REQUEST['art_nombre']))
                $errores['articulo'] = "* articulo: Error";

            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $item->delete();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php");
            }
        }
        if (isset($_REQUEST['cancelar'])) {
            header("Location: index.php");
        } 
        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("eliminarArticuloView.php", array('item' => $item, 'errores' => $errores));

    }
}
?>