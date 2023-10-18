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
$carrera= $_POST["carrera"];

// Conectar a la base de datos SQLite o crearla si no existe
$connection = new SQLite3('usuario.db');

if (!$connection) {
    die("No se pudo conectar a la base de datos");
}
// Crear la tabla si no existe
$connection->exec('
    CREATE TABLE IF NOT EXISTS usuario (
        id INTEGER PRIMARY KEY,
        nombre TEXT,
        apellido TEXT,
        edad TEXT,
        carrera TEXT
    )
');

$instruction_sql = "INSERT INTO usuario (nombre, apellido, edad,carrera) VALUES ('$nombre', '$apellido', '$edad','$carrera')";
$result = $connection->exec($instruction_sql);

if (!$result) {
    echo "Error: " . $connection->lastErrorMsg();
} else {
    // echo "Registro insertado exitosamente.<br>";
}

echo "<table id=\"formulario\">";
echo "<tr>";
echo "<th><h1>Nombre</h1></th>";
echo "<th><h1>Apellido</h1></th>";
echo "<th><h1>Edad</h1></th>";
echo "<th><h1>Carrera</h1></th>";
echo "<th><h1>id</h1></th>";
echo "</tr>";

$select_query = "SELECT * FROM usuario";
$select_result = $connection->query($select_query);

while ($row = $select_result->fetchArray()) {
    echo "<tr>";
    echo "<td><h2>" . $row["nombre"] . "</h2></td>";
    echo "<td><h2>" . $row["apellido"] . "</h2></td>";
    echo "<td><h2>" . $row["edad"] . "</h2></td>";
    echo "<td><h2>" . $row["carrera"] . "</h2></td>";
    echo "<td><h2>" . $row["id"] . "</h2></td>";
    echo "</tr>";
}

echo "</table>";
echo "<a href=\"index.php\">Volver </a>";

// Cerrar la conexión a la base de datos
$connection->close();
?>