const express = require("express");
const mysql = require("mysql");
const bodyParser = require("body-parser");
const cors = require('cors');

const app = express();
app.use(bodyParser.json());
app.use(cors());

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor iniciado en el puerto ${PORT}`);
});

const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "practicas1",
});

db.connect((err) => {
    if (err) {
        console.log(err);
        throw err;
    }
    console.log("Conectado a la base de datos MySQL");
});

// Rutas de CRUD para la tabla "peliculas"
app.get("/api/peliculas", (req, res) => {
    db.query("SELECT * FROM peliculas", (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.get("/api/peliculas/:id", (req, res) => {
    const id = req.params.id;
    db.query(
        `SELECT * FROM peliculas WHERE id_pelicula = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send(result);
        }
    );
});

app.post("/api/peliculas", (req, res) => {
    const nombre = req.body.nombre_pelicula;
    const director = req.body.director;
    const genero = req.body.genero;
    const fechaEstreno = req.body.fecha_estreno;

    db.query(
        `INSERT INTO peliculas (nombre_pelicula, director, genero, fecha_estreno) VALUES ('${nombre}', '${director}', '${genero}', '${fechaEstreno}')`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Pelicula agregada con éxito");
        }
    );
});

app.put("/api/peliculas/:id", (req, res) => {
    const id = req.params.id;
    const nombre = req.body.nombre_pelicula;
    const director = req.body.director;
    const genero = req.body.genero;
    const fechaEstreno = req.body.fecha_estreno;

    db.query(
        `UPDATE peliculas SET nombre_pelicula = '${nombre}', director = '${director}', genero = '${genero}', fecha_estreno = '${fechaEstreno}' WHERE id_pelicula = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Pelicula actualizada con éxito");
        }
    );
});

app.delete("/api/peliculas/:id", (req, res) => {
    const id = req.params.id;

    db.query(`DELETE FROM peliculas WHERE id_pelicula = ${id}`, (err, result) => {
        if (err) {
            console.log(err);
            res.status(500).send("Error al eliminar película");
        } else {
            console.log(`Película eliminada con ID: ${id}`);
            res.status(200).send("Película eliminada correctamente");
        }
    });
});