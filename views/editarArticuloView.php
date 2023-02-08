<?php include_once("common/cabecera.php"); ?>
    <title>Editar Articulo</title>
	<body>
	<?php include_once("common/menu.php"); ?>
		<h2>Editar Articulo</h2>
	<form action="index.php">
		<!-- //recuperamos todos los valores de la categoria para poder editarlos --> 

		<input type="hidden" name="controlador" value="Articulo">
		<input type="hidden" name="accion" value="editar">

		<?php echo isset($errores["articulo"]) ? "*" : "" ?>
		<label for="articulo">ID</label>
		<input type="text" readonly name="art_id" value="<?php echo $item->getArt_id(); ?>">
		</br>

		<label for="articulo">Nombre</label>
		<input type="text" name="art_nombre" value="<?php echo $item->getArt_nombre(); ?>">
		</br>

		<select name="art_categoria">
			<?php
			require "models/CategoriaModel.php";
			$categorias = new CategoriaModel();
			$listCat = $categorias->getAll();

			foreach ($listCat as $cat) {
				//metemos la condicion para que se quede seleccionada la categoria que tenia como valor de atributo
				if($cat->getCat_id() == $item->getArt_categoria())
				{
					echo "<option value='" . $cat->getCat_id() . "'selected>
					                 " . $cat->getCat_nombre() .
					"</option>";
				}else{
				echo "<option value='" . $cat->getCat_id() . "'>
					                 " . $cat->getCat_nombre() .
					"</option>";
				}
			}

			?>
		</select>
		<br>

		<label for="articulo">Cantidad</label>
		<input type="text" name="art_cantidad" value="<?php echo $item->getArt_cantidad(); ?>">
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