// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/image.png"
};

$(document).ready(function () {
    // Inicializa el formulario y lista los productos
    init();
    let edit = false;
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
                $('#products').html(template); // Actualiza la tabla de productos
            }
        });
    }

    // Inicializa el formulario y lista los productos
    function init() {
        var jsonString = JSON.stringify(baseJSON, null, 2);
        $('#description').val(jsonString); // Muestra el JSON en el textarea
        listarProductos(); // Lista productos al iniciar
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


    // Función para agregar producto
    $('#product-form').submit( function (e) {
        e.preventDefault();

        // Obtenemos el JSON desde el formulario
        let productoJsonString = $('#description').val();
        // Validamos que el JSON no esté vacío
        if (!$('#name').val() || !productoJsonString) {
            alert("Completa todos los campos.");
            return; // Sale de la función si hay campos vacíos
        }
        let finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();
        finalJSON['id'] = $('#productId').val();
        console.log(finalJSON);
        // Validamos el JSON
        if (!validarJSON(finalJSON)) {
            return; // Sale de la función si la validación falla
        }
        // Enviamos el JSON al servidor
        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        console.log(url);
        

        $.ajax({
            url: url,
            method: 'POST',
            data: JSON.stringify(finalJSON),
            contentType: 'application/json;charset=UTF-8',
            success: function (respuesta) {
                // Si la respuesta es una cadena, conviértela en un objeto JSON
                if (typeof respuesta === 'string') {
                    respuesta = JSON.parse(respuesta); // Convierte la cadena JSON en un objeto
                }
                console.log(respuesta); // Verifica la respuesta recibida
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;  
                  
                $('#container').html(template_bar); // Actualiza la barra de resultados
                // Haz visible la barra de estado (si está oculta)
                $('#product-result').removeClass('d-none').addClass('d-block');

                // Recarga la lista de productos
                listarProductos();
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

    // Función de valiadación
    function validarJSON(producto) {
        // Validar Nombre
        if (!producto.nombre || producto.nombre.trim() === "" || producto.nombre.length > 100) {
            alert("El nombre es requerido y debe tener 100 caracteres o menos.");
            return false;
        }

        // Validar Marca
        if (!producto.marca || producto.marca.trim() === "") {
            alert("La marca es requerida y debe seleccionarse de lista.");
            return false;
        }

        // Validar Modelo
        if (!producto.modelo || producto.modelo.trim() === "" || !/^[a-zA-Z0-9]+$/.test(producto.modelo) || producto.modelo.length > 25) {
            alert("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
            return false;
        }

        // Validar Precio
        if (isNaN(producto.precio) || producto.precio <= 99.99) {
            alert("El precio es requerido y debe ser mayor a 99.99.");
            return false;
        }

        // Validar Detalles
        if (producto.detalles && producto.detalles.length > 250) {
            alert("Los detalles deben tener 250 caracteres o menos.");
            return false;
        }

        // Validar Unidades
        if (isNaN(producto.unidades) || producto.unidades < 0) {
            alert("Las unidades son requeridas y deben ser mayor o igual a 0.");
            return false;
        }

        // Validar Imagen
        if (!producto.imagen || producto.imagen.trim() === "") {
            producto.imagen = "img/image.png"; // Asignar imagen por defecto
        }

        return true; // Todos los datos son válidos
    }
});
