<?php include_once("common/cabecera.php"); ?>
<title>Articulos</title>

<body>
	<!-- creamos un formulario para crear las categoria-->
	<?php include_once("common/menu.php"); ?>
	<h2>Nueva Categoria</h2>
	<form action="index.php">

		<input type="hidden" name="controlador" value="categoria">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["categoria"]) ? "*" : "" ?>
		<label for="articulo">Nombre</label>
		<input type="text" name="cat_nombre">
		<input type="submit" name="submit" value="Aceptar">
	</form>
	</br>
	<?php
	if (isset($errores)) :
		foreach ($errores as $key => $error) :
			echo $error . "</br>";
		endforeach;
	endif;
	?>

</body>

</html>