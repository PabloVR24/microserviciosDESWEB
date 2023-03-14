<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de canciones</title>
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/styles2.css">
<?php
include('../includes/navbar.php')
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <ul id="lista-canciones"></ul>
            </div>
            <div class="col">
                <form>
                    <div class="form-gs">

                        <h3>Formulario de canciones</h3>
                        <label for="nombre">Nombre:</label>
                        <input class="controls" type="text" id="nombre" name="nombre"><br><br>

                        <label for="artista">Artista:</label>
                        <input class="controls" type="text" id="artista" name="artista"><br><br>

                        <label for="genero">Género:</label>
                        <input class="controls" type="text" id="genero" name="genero"><br><br>

                        <label for="año">Fecha de estreno:</label>
                        <input class="controls" type="date" id="año" name="año"><br><br>
                        <div class="btns">
                            <button id="update" class="buttons" type="button" onclick="actualizarCancion()">Actualizar</button>
                            <button id="create" class="buttons" type="button" onclick="crearCancion()">Crear</button>
                            <button id="delete" class="buttons" type="button" onclick="eliminarCancion()">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>



    <script>
        const listaCanciones = document.getElementById('lista-canciones');

        async function obtenerCanciones() {
            const response = await fetch('http://localhost:4000/canciones');
            const data = await response.json();

            listaCanciones.innerHTML = '';
            data.forEach((cancion) => {
                const li = document.createElement('li');
                li.textContent = `${cancion.id_cancion} - ${cancion.nombre_cancion} - (${cancion.artista_cancion}) - ${cancion.genero_cancion} - ${new Date(cancion.año_cancion).toLocaleString()}`;
                listaCanciones.appendChild(li);
            });
        }

        obtenerCanciones()

        function crearCancion() {
            const nombre_cancion = document.getElementById("nombre").value;
            const artista_cancion = document.getElementById("artista").value;
            const genero_cancion = document.getElementById("genero").value;
            const año_cancion = document.getElementById("año").value;

            const data = {
                nombre_cancion: nombre_cancion,
                artista_cancion: artista_cancion,
                genero_cancion: genero_cancion,
                año_cancion: año_cancion
            };

            fetch("http://localhost:4000/canciones", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO',
                        text: 'Registro Agregado con Exito',
                    })
                    obtenerCanciones()
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser agregado',
                        footer: error
                    })
                });
        }

        function actualizarCancion() {
            const nombre_cancion = document.getElementById("nombre").value;
            const artista_cancion = document.getElementById("artista").value;
            const genero_cancion = document.getElementById("genero").value;
            const año_cancion = document.getElementById("año").value;

            const id = prompt("Introduce el ID de la cancion que deseas actualizar:");

            const data = {
                nombre_cancion: nombre_cancion,
                artista_cancion: artista_cancion,
                genero_cancion: genero_cancion,
                año_cancion: año_cancion
            };

            fetch(`http:///localhost:4000/canciones/${id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO',
                        text: 'Registro Actualizado con Exito',
                    })
                    obtenerCanciones()
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser actualizado',
                        footer: error
                    })
                });
        }

        function eliminarCancion() {
            const id = prompt("Introduce el ID de la cancion que deseas eliminar:");

            fetch(`http:///localhost:4000/canciones/${id}`, {
                    method: "DELETE"
                })
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO',
                        text: 'Registro Eliminado con Exito',
                    })
                    obtenerCanciones()
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser eliminado',
                        footer: error
                    })
                });
        }
    </script>
</body>

</html>