<?php
$servername = "127.0.0.1"; // Dirección del servidor
$username = "tu_usuario"; // Reemplaza con el nombre de usuario de MySQL
$password = "tu_contraseña"; // Reemplaza con tu contraseña de MySQL
$dbname = "cadi"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa a la base de datos.";
?>
