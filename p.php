<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        
<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "formulario");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge y limpia datos
    $nombre = htmlspecialchars($_POST["nombre"]);
    $correo = htmlspecialchars($_POST["correo"]);

    // Prepara y ejecuta la consulta
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $correo);

    if ($stmt->execute()) {
        echo "<p>Datos guardados correctamente.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

$conexion->close();
?>
</body>
</html>