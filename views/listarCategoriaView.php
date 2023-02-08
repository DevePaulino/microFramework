<?php include_once("common/cabecera.php"); ?>
    <title>Categoria</title>
    
<body>
    <?php include_once("common/menu.php"); ?>
    <h2>Categoria</h2>
    <table>
        <tr>
            <th>ID
            </th>
            <th>Nombre
            </th>
        </tr>
        <?php
        //hacemos un bucle sobre items que contiene todas la categorias que ha realizado la consulta
        foreach ($items as $categoria) {
        ?>
        <tr>
            <td><?php echo $categoria->getCat_id() ?></td>
            <td><?php echo $categoria->getCat_nombre() ?></td>
            <!-- //creamos un enlace para editar cada una de las categorias --> 
            <td><a href="index.php?controlador=Categoria&accion=editar&cat_id=<?php echo $categoria->getCat_id() ?>">Editar</a>
            </td>
            <td><a <?php $categoria->blockLink($categoria)?>>Borrar</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <!-- //creamos un enlace para crear una categoria --> 
    <a href="index.php?controlador=Categoria&accion=nuevo">Añadir</a>
</body>
