$(document).ready(function () {
    init();
    let edit = false;

    // Inicializa el formulario y lista los productos
    function init() {
        listarProductos();
        agregarValidacionesDeCampos(); // Añade las validaciones de campos

        // Suponiendo que tienes un input con el id "nombre"
        const nombreProductoInput = $('#nombre');

        // Agregar un evento input para validar el nombre del producto
        nombreProductoInput.on('input', function() {
            const nombreProducto = nombreProductoInput.val();
            
            // Solo hacer la verificación si el campo no está vacío
            if (nombreProducto) {
                verificarNombreUnico(nombreProducto);
            } else {
                // Si el campo está vacío, limpia la barra de estado
                actualizarBarraDeEstado("", ""); // Limpia el mensaje
            }
        });
    }

    // Función para listar productos usando jQuery y AJAX
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            method: 'GET',
            dataType: 'json',
            success: function (productos) {
                let template = '';
                productos.forEach(function (producto) {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td><a href="#" class="product-item"> ${producto.nombre} </a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#products').html(template);
            }
        });
    }

    // Añade eventos de validación al cambiar el foco de los campos
    function agregarValidacionesDeCampos() {
        $('#product-form input, #product-form textarea').on('blur', function () {
            validarCampo($(this));
        });
    }

    // Función para validar un campo específico
    function validarCampo(campo) {
        let valor = campo.val().trim();
        let nombreCampo = campo.attr('id');
        let mensajeError = "";

        switch (nombreCampo) {
            case "nombre":
                if (!valor || valor.length > 100) {
                    mensajeError = "El nombre es requerido y debe tener 100 caracteres o menos.";
                } else {
                    // Validación asíncrona para verificar si el nombre ya existe
                    verificarNombreUnico(valor);
                }
                break;
            case "marca":
                if (!valor) {
                    mensajeError = "La marca es requerida.";
                }
                break;
            case "modelo":
                if (!/^[a-zA-Z0-9]+$/.test(valor) || valor.length > 25) {
                    mensajeError = "El modelo debe ser alfanumérico y tener 25 caracteres o menos.";
                }
                break;
            case "precio":
                if (isNaN(valor) || valor <= 99.99) {
                    mensajeError = "El precio debe ser un número mayor a 99.99.";
                }
                break;
            case "detalles":
                if (valor.length > 250) {
                    mensajeError = "Los detalles deben tener 250 caracteres o menos.";
                }
                break;
            case "unidades":
                if (isNaN(valor) || valor < 0) {
                    mensajeError = "Las unidades deben ser un número mayor o igual a 0.";
                }
                break;
        }

        if (mensajeError) {
            actualizarBarraDeEstado(mensajeError, "error");
            return false;
        } else {
            actualizarBarraDeEstado("Campo válido", "success");
            return true;
        }
    }

   // Función para validar y agregar el producto
$('#product-form').submit(function (e) {
    e.preventDefault();

    let esValido = true;
    let mensajesError = []; // Array para almacenar mensajes de error

    // Validar cada campo del formulario
    $('#product-form input, #product-form textarea').each(function () {
        if (!validarCampo($(this))) {
            esValido = false;
            // Puedes almacenar el ID o nombre del campo en el array de mensajesError si deseas
            mensajesError.push($(this).attr('id')); // Guarda el ID del campo que falló
        }
    });

    // Si hay algún campo inválido, actualiza la barra de estado
    if (!esValido) {
        actualizarBarraDeEstado("Completa los campos correctamente: " + mensajesError.join(', '), "error");
        return; // Detiene el envío del formulario
    }
    

    // Recoger los datos directamente desde los campos del formulario
    let nombre = $('#nombre').val();
    let marca = $('#marca').val();
    let modelo = $('#modelo').val();
    let precio = parseFloat($('#precio').val());
    let detalles = $('#detalles').val();
    let unidades = parseInt($('#unidades').val());
    let imagen = $('#imagen').val() || "img/image.png"; // Imagen por defecto

    const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            nombre: nombre,
            marca: marca,
            modelo: modelo,
            precio: precio,
            detalles: detalles,
            unidades: unidades,
            imagen: imagen
        },
        success: function (respuesta) {
            if (typeof respuesta === 'string') {
                respuesta = JSON.parse(respuesta);
            }
            actualizarBarraDeEstado(respuesta.message, respuesta.status === "success" ? "success" : "error");
            listarProductos();
        }
    });
});

    // Verificar si el nombre del producto ya existe
    function verificarNombreUnico(nombre) {
        $.ajax({
            url: './backend/product-validate-name.php',
            method: 'POST',
            data: JSON.stringify({ nombre: nombre }),
            contentType: 'application/json;charset=UTF-8',
            success: function (respuesta) {
                if (typeof respuesta === 'string') {
                    respuesta = JSON.parse(respuesta);
                }
                if (respuesta.exists) {
                    actualizarBarraDeEstado("El nombre del producto ya existe.", "error");
                } else {
                    actualizarBarraDeEstado("Nombre disponible.", "success");
                }
            },
            error: function () {
                actualizarBarraDeEstado("Error al verificar el nombre del producto.", "error");
            }
        });
    }

    // Actualizar la barra de estado
    function actualizarBarraDeEstado(mensaje, tipo) {
        let clase = tipo === "success" ? "alert-success" : "alert-danger";
        let template = `<div class="alert ${clase}" role="alert">${mensaje}</div>`;
        $('#container').html(template).removeClass('d-none').addClass('d-block');
    }

     // Función para buscar productos
     $('#busqueda-form').submit(function (e) {
        e.preventDefault(); // Evita el comportamiento por defecto del formulario

        let search = $('#search').val(); // Obtiene el valor del campo de búsqueda

        $.ajax({
            url: './backend/product-search.php',
            method: 'GET',
            data: { search: search },
            dataType: 'json',
            success: function (productos) {
                let template = '';
                let template_bar = '';

                productos.forEach(function (producto) {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    template_bar += `<li>${producto.nombre}</li>`;
                });

                $('#container').html(template_bar); // Actualiza la barra de resultados
                $('#products').html(template); // Actualiza la tabla de productos
            }
        });
    });
    
    // Función para buscar productos 
    $('#search').keyup(function (e) {
        e.preventDefault(); // Evita el comportamiento por defecto del formulario

        let search = $('#search').val(); // Obtiene el valor del campo de búsqueda

        $.ajax({
            url: './backend/product-search.php',
            method: 'GET',
            data: { search: search },
            dataType: 'json',
            success: function (productos) {
                let template = '';
                let template_bar = '';

                productos.forEach(function (producto) {
                    
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    template_bar += `<li>${producto.nombre}</li>`;
                });

                $('#container').html(template_bar); // Actualiza la barra de resultados
                $('#product-result').removeClass('d-none').addClass('d-block');
                $('#products').html(template); // Actualiza la tabla de productos
            }
        });
    });

     // Función para eliminar producto
     $(document).on('click', '.product-delete', function () {
        if (confirm('¿Deseas eliminar el Producto?')) {
            let id = $(this).closest('tr').attr('productId');

            $.ajax({
                url: './backend/product-delete.php',
                method: 'GET',
                data: { id: id },
                success: function (respuesta) {
                    // Si la respuesta es una cadena, conviértela en un objeto JSON
                    if (typeof respuesta === 'string') {
                        respuesta = JSON.parse(respuesta); // Convierte la cadena JSON en un objeto
                    }
                    let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                    $('#container').html(template_bar); // Actualiza la barra de resultados
                    $('#product-result').removeClass('d-none').addClass('d-block');

                    // Recarga la lista de productos
                    listarProductos();
                }
            });
        }
    });

    // Obtener un producto por ID
    $(document).on('click', '.product-item', (e) => {
        const element = e.currentTarget.closest('tr'); // Encuentra el elemento <tr> más cercano
        const id = $(element).attr('productId'); // Obtiene el productId del atributo
        console.log(id);
        $.post('./backend/product-single.php', { id }, (response) => {
            const producto = JSON.parse(response);
            $('#name').val(producto.nombre); // Cambia 'name' por 'nombre'
            
            // Crea un objeto con solo los campos deseados
            const columnas = {
                precio: producto.precio,
                unidades: producto.unidades,
                modelo: producto.modelo,
                marca: producto.marca,
                detalles: producto.detalles,
                imagen: producto.imagen,
            };    

            $('#description').val(JSON.stringify(columnas, null, 2)); // Muestra el producto en formato JSON
            $('#productId').val(producto.id);
            edit = true; // Activa la edición
        });

        e.preventDefault(); // Previene la acción por defecto del enlace
    });
});
