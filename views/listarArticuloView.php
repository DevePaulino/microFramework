<?php include_once("common/cabecera.php"); ?>
<?php
//Vamos a instanciar la categoriaModel para conseguir las categorias por su nombre
require "models/CategoriaModel.php";
$categ = new CategoriaModel();
?>
<body>
	<?php include_once("common/menu.php"); ?>
    <h2>Articulos</h2>
    <table>
        <tr>
            <th>ID
            </th>
            <th>Nombre
            </th>
            <th>Categoria
            </th>
            <th>Cantidad
            </th>
        </tr>
        <?php
        //hacemos un bucle sobre items que contiene todas los articulos que ha realizado la consulta.

        foreach ($items as $articulo) {
        ?>
        <tr>
            <td><?php echo $articulo->getArt_id() ?></td>
            <td><?php echo $articulo->getArt_nombre() ?></td>
            <td><?php
            //aqui es donde hacemos uso del objeto categ para extraer el nombre de la categoria según su id
                    $query = $categ->getById($articulo->getArt_categoria());
                    echo $query->getCat_nombre();
            ?></td>
            <td><?php echo $articulo->getArt_cantidad()?></td>
            <!-- //creamos un enlace para editar cada una de los articulos llamando al controlador Articulos con su funcion editar --> 
            <td><a href="index.php?controlador=Articulo&accion=editar&art_id=<?php echo $articulo->getArt_id() ?>">Editar</a>
            </td>
            <!-- //creamos un enlace para borrar cada una de los articulos llamando al controlador Articulos con su funcion borrar --> 
            <td><a href="index.php?controlador=Articulo&accion=borrar&art_id=<?php echo $articulo->getArt_id() ?>">Borrar</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <a href="index.php?controlador=articulo&accion=nuevo">Añadir</a>
</body>
<?php include_once("common/cabecera.php"); ?>
