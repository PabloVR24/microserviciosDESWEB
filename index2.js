const express = require("express");
const mysql = require("mysql");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();

app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "practicas2",
});

db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log("Conexión exitosa a la base de datos.");
});

// Ruta para obtener todas las canciones
app.get("/canciones", (req, res) => {
    const sql = "SELECT * FROM canciones";
    db.query(sql, (err, result) => {
        if (err) {
            throw err;
        }
        res.send(result);
    });
});

// Ruta para obtener una canción por su ID
app.get("/canciones/:id", (req, res) => {
    const id = req.params.id;
    const sql = `SELECT * FROM canciones WHERE id_cancion = ${id}`;
    db.query(sql, (err, result) => {
        if (err) {
            throw err;
        }
        res.send(result);
    });
});

// Ruta para agregar una nueva canción
app.post("/canciones", (req, res) => {
    const { nombre_cancion, artista_cancion, genero_cancion, año_cancion } =
    req.body;
    const sql = `INSERT INTO canciones (nombre_cancion, artista_cancion, genero_cancion, año_cancion) VALUES ('${nombre_cancion}', '${artista_cancion}', '${genero_cancion}', '${año_cancion}')`;
    db.query(sql, (err, result) => {
        if (err) {
            throw err;
        }
        res.send("Canción añadida correctamente.");
    });
});

// Ruta para actualizar una canción por su ID
app.put("/canciones/:id", (req, res) => {
    const id = req.params.id;
    const { nombre_cancion, artista_cancion, genero_cancion, año_cancion } =
    req.body;
    const sql = `UPDATE canciones SET nombre_cancion = '${nombre_cancion}', artista_cancion = '${artista_cancion}', genero_cancion = '${genero_cancion}', año_cancion = '${año_cancion}' WHERE id_cancion = ${id}`;
    db.query(sql, (err, result) => {
        if (err) {
            throw err;
        }
        res.send("Canción actualizada correctamente.");
    });
});

// Ruta para eliminar una canción por su ID
app.delete("/canciones/:id", (req, res) => {
    const id = req.params.id;
    const sql = `DELETE FROM canciones WHERE id_cancion = ${id}`;
    db.query(sql, (err, result) => {
        if (err) {
            throw err;
        }
        res.send("Canción eliminada correctamente.");
    });
});

const port = process.env.PORT || 4000;
app.listen(port, () => {
    console.log(`El servidor está corriendo en el puerto ${port}`);
});