<?php
// Datos simulados de la "base de datos"
$usuarios = [
    ['email' => 'usuario1@example.com', 'password' => '12345678'],
    ['email' => 'usuario2@example.com', 'password' => 'contraseña'],
    ['email' => 'admin@example.com', 'password' => 'admin123']
];

// Obtener datos enviados por el formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Buscar el usuario en la base de datos
$usuarioEncontrado = false;

foreach ($usuarios as $usuario) {
    if ($usuario['email'] === $email && $usuario['password'] === $password) {
        $usuarioEncontrado = true;
        break;
    }
}

// Validar credenciales
if ($usuarioEncontrado) {
    // Credenciales correctas
    echo "<h1>¡Bienvenido, $email!</h1>";
    echo "<p>Inicio de sesión exitoso.</p>";
    echo '<a href="index2.0.html">Ir al sistema</a>';
} else {
    // Credenciales incorrectas
    echo "<h1>Error</h1>";
    echo "<p>Correo o contraseña incorrectos.</p>";
    echo '<a href="index.html">Volver al login</a>';
}
?>
