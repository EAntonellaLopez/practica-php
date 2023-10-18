<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
</body>
</html>
<?php 

   $nombre = $_POST["nombre"];
   $apellido = $_POST["apellido"];
   $edad = $_POST["edad"];
   $carrera = $_POST["carrera"];
   echo"<div class=\"formulario\"> ";
   echo" nombre {$nombre} ";
   echo" apellido {$apellido} ";
   echo" edad {$edad} ";
   echo" carrera {$carrera} ";
   echo "</div>";
   echo "<a href=\"index.php\">Volver a inicio</a>";
$connection = new SQLite3('estudiantes.db');

    if (!$connection){

        die("No se pudo conectar");

    }
    $connection->exec(

        'CREATE TABLE IF NO EXISTS alumno(

            id INTEGER PRIMARY KEY,
            nombre TEXT,
            apellido TEXT,
            edad TEXT,
            carrera TEXT
        )'

    );
    $query = "INSERT INTO alumno (nombre,apellido,edad,carrera) 
    VALUES ('$nombre','$apellido','$edad','$carrera')";

    $resultado = $connection->exec($query);
    if(!$resultado){
        echo"Se guardo correctamente!";
    }

   ?>