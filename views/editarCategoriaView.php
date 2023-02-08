<?php include_once("common/cabecera.php"); ?>
    <title>Editar Categoria</title>
	<body>
	<?php include_once("common/menu.php"); ?>
		<h2>Editar Categoria</h2>
	<form action="index.php">

		<input type="hidden" name="controlador" value="categoria">
		<input type="hidden" name="accion" value="editar">

		<?php echo isset($errores["categoria"]) ? "*" : "" ?>
		<!-- //recuperamos todos los valores de la categoria para poder editarlos --> 

		<label for="categoria">ID</label>
		<input type="text" readonly name="cat_id" value="<?php echo $item->getCat_id(); ?>">
		</br>

		<label for="categoria">Nombre</label>
		<input type="text" name="cat_nombre" value="<?php echo $item->getCat_nombre(); ?>">
		</br>
		<input type="submit" name="submit" value="Aceptar">
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