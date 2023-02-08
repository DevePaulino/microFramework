
<?php include_once("common/cabecera.php"); ?>
    <title>Eliminar Articulo</title>
	<body>
	<?php include_once("common/menu.php"); ?>
<h2>Confirma su eliminación</h2>
	<form action="index.php">

		<input type="hidden" name="controlador" value="Categoria">
		<input type="hidden" name="accion" value="borrar">

		<?php echo isset($errores["Categoria"]) ? "*" : "" ?>
		<label for="articulo">ID</label>
		<!-- //mostramos el id que vamos a eliminar con la propiedad de solo lectura --> 
		<input type="text" readonly name="cat_id" value="<?php echo $item->getCat_id(); ?>">
		</br>
		<label for="articulo">Nombre</label>
		<!-- //mostramos la categoria que vamos a eliminar con la propiedad de solo lectura --> 
		<input type="text" readonly name="cat_nombre" value="<?php echo $item->getCat_nombre(); ?>">
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