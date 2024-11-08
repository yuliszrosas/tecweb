<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <script>
        // Función para obtener los parámetros de la URL
        function obtenerParametroURL(parametro) {
            let urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(parametro);
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Precargar los valores del producto en el formulario
            document.getElementById("nombre").value = obtenerParametroURL("nombre");
            document.getElementById("marca").value = obtenerParametroURL("marca");
            document.getElementById("modelo").value = obtenerParametroURL("modelo");
            document.getElementById("precio").value = obtenerParametroURL("precio");
            document.getElementById("detalles").value = obtenerParametroURL("detalles");
            document.getElementById("unidades").value = obtenerParametroURL("unidades");

            // Validar el formulario antes de enviarlo
            document.getElementById("formularioProducto").addEventListener("submit", function(event) {
                let nombre = document.getElementById("nombre").value.trim();
                let marca = document.getElementById("marca").value.trim();
                let modelo = document.getElementById("modelo").value.trim();
                let precio = parseFloat(document.getElementById("precio").value);
                let detalles = document.getElementById("detalles").value.trim();
                let unidades = parseInt(document.getElementById("unidades").value);
                let imagen = document.getElementById("imagen").value;

                // Validar los campos
                if (nombre === "" || nombre.length > 100) {
                    alert("El nombre es obligatorio y debe tener 100 caracteres o menos.");
                    event.preventDefault();
                    return;
                }
                if (marca === "" || marca.length > 100) {
                    alert("La marca es obligatoria y debe tener 100 caracteres o menos.");
                    event.preventDefault();
                    return;
                }
                if (modelo === "" || !/^[a-zA-Z0-9 ]+$/.test(modelo) || modelo.length > 25) {
                    alert("El modelo es obligatorio, debe ser alfanumérico y tener 25 caracteres o menos.");
                    event.preventDefault();
                    return;
                }
                if (isNaN(precio) || precio <= 99.99) {
                    alert("El precio es obligatorio y debe ser mayor a 99.99.");
                    event.preventDefault();
                    return;
                }
                if (detalles.length > 250) {
                    alert("Los detalles deben tener 250 caracteres o menos.");
                    event.preventDefault();
                    return;
                }
                if (isNaN(unidades) || unidades < 0) {
                    alert("Las unidades son obligatorias y deben ser mayores o iguales a 0.");
                    event.preventDefault();
                    return;
                }
                if (imagen === "") {
                    alert("No se ha seleccionado una imagen. Se utilizará una imagen por defecto.");
                    document.getElementById("imagen").value = "http://localhost/tecweb/practicas/p10/imagen_defecto.jpg";
                }
            });
        });
    </script>
</head>
<body>
    <h1>Modificar Producto</h1>
    <form id="formularioProducto" action="http://localhost/tecweb/practicas/p09/set_producto_v2.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>"/>

        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" required><br><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" maxlength="25" required><br><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" maxlength="100" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" max="9999999999.99" required><br><br>

        <label for="detalles">Detalles del producto:</label><br>
        <textarea id="detalles" name="detalles" maxlength="250" rows="4" cols="50" placeholder="No más de 250 caracteres de longitud..."></textarea><br><br>

        <label for="unidades">Unidades:</label>
        <input type="number" id="unidades" name="unidades" required><br><br>

        <label for="imagen">Imagen del producto:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>

        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>