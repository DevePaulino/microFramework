<?php include_once("common/cabecera.php"); ?>
    <title>Nuevo Articulo</title>

<body>
	<?php include_once("common/menu.php"); ?>
	<h2>Nuevo articulo</h2>
	<!-- creamos un formulario para crear el articulo-->
	<form action="index.php">

		<input type="hidden" name="controlador" value="Articulo">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["articulo"]) ? "*" : "" ?>
		<label for="articulo">Nombre</label>
		<input type="text" name="art_nombre">
		</br>

		<?php echo isset($errores["articulo"]) ? "*" : "" ?>
		<label for="articulo">Categoria</label>
		<select name="art_categoria">
			<?php
			require "models/CategoriaModel.php";
			//instanciamos un objeto de Categoria para listar todas las categorias y metelarlsa en el formulario
			$categorias = new CategoriaModel();
			$listCat = $categorias->getAll();

			foreach ($listCat as $cat) {
				echo "<option value='" . $cat->getCat_id() . "'>
					                 " . $cat->getCat_nombre() .
					"</option>";
			}

			?>
		</select>
		<br>
		<?php echo isset($errores["articulo"]) ? "*" : "" ?>
		<label for="articulo">Cantidad</label>
		<input type="text" name="art_cantidad">
		</br>
		<input type="submit" name="submit" value="Aceptar">
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