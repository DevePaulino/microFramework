
<?php include_once("common/cabecera.php"); ?>
    <title>Eliminar Articulo</title>
	<body>
	<?php include_once("common/menu.php"); ?>
<h2>Confirma su eliminación</h2>
	<form action="index.php">

		<input type="hidden" name="controlador" value="Articulo">
		<input type="hidden" name="accion" value="borrar">
		<!-- //mostramos cada una de las propiedades del objeto para visualizarla antes de confirmar su borrado --> 
		<?php echo isset($errores["articulo"]) ? "*" : "" ?>
		<label for="articulo">ID</label>
		<input type="text" readonly name="art_id" value="<?php echo $item->getArt_id(); ?>">
		</br>

		<label for="articulo">Nombre</label>
		<input type="text" readonly name="art_nombre" value="<?php echo $item->getArt_nombre(); ?>">
		</br>

		<label for="articulo">Categoria</label>
		<input type="text" readonly name="art_categoria" value="<?php echo $item->getArt_categoria(); ?>">
		</br>

		<label for="articulo">Cantidad</label>
		<input type="text" readonly name="art_cantidad" value="<?php echo $item->getArt_cantidad(); ?>">
		</br>
		<input type="submit" name="submit" value="Borrar">
		<input type="submit" name="cancelar" value="Cancelar">

	</form>
	</br>
	<?php
if (isset($errores)):
	foreach ($errores as $key => $error):
		echo $error . "</br>";
	endforeach;
endif;
?>

</body>

</html>