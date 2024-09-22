<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<?php
		// Definir el tope de productos a mostrar basado en el parámetro de la URL
		if(isset($_GET['tope']) && is_numeric($_GET['tope'])) {
			$limit = $_GET['tope']; // Si el parámetro tope está definido y es numérico, se usa ese valor
		} else {
			$limit = 10; // Si no está definido, se usa un valor predeterminado de 10
		}

		/** SE CREA EL OBJETO DE CONEXION */
		@$link = new mysqli('localhost', 'root', '', 'marketzone');	

		/** comprobar la conexión */
		if ($link->connect_errno) 
		{
			die('Falló la conexión: '.$link->connect_error.'<br/>');
			    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
		}

		/** Crear una consulta que selecciona productos hasta el límite */
		$query = "SELECT * FROM productos LIMIT {$limit}";

		if ( $result = $link->query($query) ) 
		{
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

		$link->close();
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Productos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<h3>PRODUCTOS</h3>

		<br/>

		<?php if( !empty($rows) ) : ?>
			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($rows as $row) : ?>
					<tr>
						<th scope="row"><?= $row['id'] ?></th>
						<td><?= $row['nombre'] ?></td>
						<td><?= $row['marca'] ?></td>
						<td><?= $row['modelo'] ?></td>
						<td><?= $row['precio'] ?></td>
						<td><?= $row['unidades'] ?></td>
						<td><?= utf8_encode($row['detalles']) ?></td>
						<td><img src="<?= $row['imagen'] ?>" alt="Imagen del producto" width="100"></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		<?php else : ?>
			<p>No hay productos disponibles.</p>
		<?php endif; ?>
	</body>
</html>
