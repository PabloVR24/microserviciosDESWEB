# Microservicios

## Microservicio 1
Requisitos
- [NodeJS](https://nodejs.org/en/)
- La misma base de datos de Led 

Ir a ```C:\xampp\htdocs```  
Clonar el repositorio con ```git clone```
```
git clone https://github.com/PabloVR24/microserviciosDESWEB
```

Iniciar el servidor Apache y MySQL
![Conexion Apache/MySQL](/src/images/1.png)

Abrir al archivo ```index.js```  
Modificar los renglones 15 - 20 conforme a las credenciales de tu base de datos

![Renglones 15 - 20](/src/images/2.png)  
[Para saber el nombre de tu base de datos ir a ```http://localhost/phpmyadmin/```]

Guardar cambios

Iniciar una terminal dentro del proyecto (cmd / PowerShell / bash)
![Terminal](/src/images/3.png)

Ejecutar el comando
```
npm install express mysql body-parser cors
```

Una vez instalado lo anterior procedemos a usar el comando
```
node index.js
```

Nota: NO USAR ```nodemon```

En tu navegador ir a 
```
http://localhost/microserviciosDESWEB/views/index_peliculas.php
```
Veremos la siguiente pantalla como se muestra en la imagen
![PANTALLA](/src/images/4.png)

### CREATE
Para crear un registro en nuestra base de datos, llenaremos el formulario Y daremos clic en el boton CREAR

### UPDATE
Para actualizar llenaremos el formulario y daremos click en actualizar  
Nos aparecera un mensaje asi:
![PANTALLA](/src/images/5.png)


Aqui tendremos que poner el ID de la pelicula que queremos editar. 

### DELETE
Para eliminar un dato, simplemente pulsaremos el boton Eliminar y nos pedira el ID de la pelicula que queramos borrar. Se mostrara algo parecido a la imagen anterior 

## Microservicio 2
El segundo microservicio tiene la misma funcionalidad que el primero, pero se deben agregar varias cosas para que funcione xd

1.- Crear una nueva base de datos llamada **practicas2**  
2.- En una instancia de Queries SQL ejecutaremos el siguiente Query:
```
use practicas2

CREATE TABLE canciones (
  id_cancion INT AUTO_INCREMENT,
  nombre_cancion VARCHAR(45),
  artista_cancion VARCHAR(45),
  genero_cancion VARCHAR(45),
  año_cancion VARCHAR(45),
  PRIMARY KEY (id_cancion)
);
```

Iniciar otra terminal dentro del proyecto (cmd / PowerShell / bash)

![Otra terminal](/src/images/6.png)

Utilizaremos el comando
```
node index2.js
```

Nota: NO USAR ```nodemon``` POR LO QUE MAS QUIERAS

En tu navegador ir a 
```
http://localhost/microserviciosDESWEB/views/index_canciones.php
```
Veremos la siguiente pantalla como se muestra en la imagen
![PANTALLA](/src/images/7.png)

### CREATE
Para crear un registro en nuestra base de datos, llenaremos el formulario Y daremos clic en el boton CREAR

### UPDATE
Para actualizar llenaremos el formulario y daremos click en actualizar  
Nos aparecera un mensaje asi:
![PANTALLA](/src/images/5.png)


Aqui tendremos que poner el ID de la pelicula que queremos editar. 

### DELETE
Para eliminar un dato, simplemente pulsaremos el boton Eliminar y nos pedira el ID de la pelicula que queramos borrar. Se mostrara algo parecido a la imagen anterior 


