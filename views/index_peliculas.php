<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de películas</title>
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/styles.css">

<?php
include('../includes/navbar.php')
?>

<body>
    <div class="container">



        <div class="row">
            <div class="col">
                <form>

                    <div class="form-gs">

                        <h3>Formulario de películas</h3>
                        <label for="nombre">Nombre:</label>
                        <input class="controls" type="text" id="nombre" name="nombre"><br><br>

                        <label for="director">Director:</label>
                        <input class="controls" type="text" id="director" name="director"><br><br>

                        <label for="genero">Género:</label>
                        <input class="controls" type="text" id="genero" name="genero"><br><br>

                        <label for="fecha_estreno">Fecha de estreno:</label>
                        <input class="controls" type="date" id="fecha_estreno" name="fecha_estreno"><br><br>
                        <div class="btns">
                            <button id="update" class="buttons" type="button" onclick="actualizarPelicula()">Actualizar</button>
                            <button id="create" class="buttons" type="button" onclick="crearPelicula()">Crear</button>
                            <button id="delete" class="buttons" type="button" onclick="eliminarPelicula()">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <ul id="lista-peliculas"></ul>
            </div>
        </div>

    </div>



    <script>
        const listaPeliculas = document.getElementById('lista-peliculas');

        async function obtenerPeliculas() {
            const response = await fetch('http://localhost:3000/api/peliculas');
            const data = await response.json();

            listaPeliculas.innerHTML = '';
            data.forEach((pelicula) => {
                const li = document.createElement('li');
                li.textContent = `${pelicula.id_pelicula} - ${pelicula.nombre_pelicula} - (${pelicula.director}) - ${pelicula.genero} - ${new Date(pelicula.fecha_estreno).toLocaleString()}`;
                listaPeliculas.appendChild(li);
            });
        }

        obtenerPeliculas()

        function crearPelicula() {
            const nombre = document.getElementById("nombre").value;
            const director = document.getElementById("director").value;
            const genero = document.getElementById("genero").value;
            const fechaEstreno = document.getElementById("fecha_estreno").value;

            const data = {
                nombre_pelicula: nombre,
                director: director,
                genero: genero,
                fecha_estreno: fechaEstreno
            };

            fetch("http://localhost:3000/api/peliculas", {
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
                    obtenerPeliculas()
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser agregado',
                        footer: 'Mirar terminal para mas detalles'
                    })
                });
        }

        function actualizarPelicula() {
            const nombre = document.getElementById("nombre").value;
            const director = document.getElementById("director").value;
            const genero = document.getElementById("genero").value;
            const fechaEstreno = document.getElementById("fecha_estreno").value;

            const id = prompt("Introduce el ID de la película que deseas actualizar:");

            const data = {
                nombre_pelicula: nombre,
                director: director,
                genero: genero,
                fecha_estreno: fechaEstreno
            };

            fetch(`http://localhost:3000/api/peliculas/${id}`, {
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
                    obtenerPeliculas()
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser actualizado',
                        footer: 'Mirar terminal para mas detalles'
                    })
                });
        }

        function eliminarPelicula() {
            const id = prompt("Introduce el ID de la película que deseas eliminar:");

            fetch(`http://localhost:3000/api/peliculas/${id}`, {
                    method: "DELETE"
                })
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO',
                        text: 'Registro Eliminado con Exito',
                    })
                    obtenerPeliculas()
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser eliminado',
                        footer: 'Mirar terminal para mas detalles'
                    })
                });
        }
    </script>
</body>

</html>